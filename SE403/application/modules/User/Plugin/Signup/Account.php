<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Account.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_Plugin_Signup_Account extends Core_Plugin_FormSequence_Abstract
{
  protected $_name = 'account';

  //protected $_title = 'Create Account';

  protected $_formClass = 'User_Form_Signup_Account';

  protected $_script = array('signup/form/account.tpl', 'user');

  protected $_adminFormClass = 'User_Form_Admin_Signup_Account';

  protected $_adminScript = array('admin-signup/account.tpl', 'user');

  public $email = null;

  public function onView()
  {
    // Init facebook login link
  		if ('none' != Engine_Api::_()->getApi('settings', 'core')->core_facebook_enable) {
			$facebook = User_Model_DbTable_Facebook::getFBInstance();
			if ($facebook->getSession()) {
					
				try {

					$me  = $facebook->api('/me');
					/*$me = array(
						'email' => 'janardhanacr@hotmail.com',
						'name' => 'janardhancr',
						'first_name' => 'jana',
						'last_name' => 'cr',
						'gender' => 'male',
						'birthdate' => '10/11/1978',
					);*/
					$uid = Engine_Api::_()->getDbtable('Facebook', 'User')->fetchRow(array('facebook_uid = ?'=>$facebook->getUser()));

					if ($uid)
					$uid = $uid->user_id;
					if ($uid) {
						// prevent Facebook users with established accounts from signing up again
						Engine_Api::_()->user()->getAuth()->getStorage()->write($uid);
						$this->getForm()->getElement('facebook')->setContent('<script type="text/javascript">window.location.reload();</script>"');
						return;
					} else {
						// pre-fill facebook data into signup process
						$this->getForm()->removeElement('facebook');

						if ($this->getForm()->getElement('email')->getValue() == '')
						$this->getForm()->getElement('email')->setValue($me['email']);

						if ($this->getForm()->getElement('username')->getValue() == '')
						$this->getForm()->getElement('username')->setValue(preg_replace('/[^A-Za-z]/', '', $me['name']));

						$this->getForm()->password->renderPassword = true;
						$this->getForm()->passconf->renderPassword = true; 
						
						$this->getForm()->getElement('password')->setAttrib('style', 'display:none');
						$this->getForm()->getElement('password')->removeValidator('NotEmpty');
						$this->getForm()->getElement('password')->removeValidator('StringLength');
						$this->getForm()->getElement('password')->setRequired(false);
						$this->getForm()->getElement('password')->setDescription('Always use your Facebook password to login to Momburbia');
						$this->getForm()->getElement('password')->setValue("facebook");

						$this->getForm()->getElement('passconf')->setAttrib('style', 'display:none');
						$this->getForm()->getElement('passconf')->removeValidator('NotEmpty');
						$this->getForm()->getElement('passconf')->removeValidator('Engine_Validate_Callback');
						$this->getForm()->getElement('passconf')->setRequired(false);
						$this->getForm()->getElement('passconf')->setDescription('Always use your Facebook password to login to Momburbia');
						$this->getForm()->getElement('passconf')->setValue("facebook");
						
						$maps    = Engine_Api::_()->fields()->getFieldsMaps('user');
						$fb_data = array();
						foreach (array('gender', 'first_name', 'last_name', 'birthdate') as $field_alias) {
							if (isset($me[$field_alias])) {
								$field    = Engine_Api::_()->fields()->getFieldsObjectsByAlias('user', $field_alias);
								$field_id = $field[$field_alias]['field_id'];
								foreach ($maps as $map) {
									if ($field_id == $map->child_id) {
										$fb_data[$map->getKey()] = $me[$field_alias];
									}
								}
							}
						}
						$this->getSession()->data = $fb_data;
					}
				} catch (Exception $e) {
					$this->getForm()->removeElement('facebook');
				}
			}
		}
  }
  public function onProcess()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    $random =  ($settings->getSetting('user.signup.random', 0) == 1);
    $data = $this->getSession()->data;
    if ($random)
    {
      $data['password'] = Engine_Api::_()->user()->randomPass(10);
    }
    $user = Engine_Api::_()->getDbtable('users', 'user')->createRow();
    $user->setFromArray($data);
    $user->save();
    Engine_Api::_()->user()->setViewer($user);

    // Increment signup counter
    Engine_Api::_()->getDbtable('statistics', 'core')->increment('user.creations');


    if ($user->verified && $user->enabled) 
    {
      // Create activity for them
      Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($user, $user, 'signup');
      // Set user as logged in if not have to verify email
      Engine_Api::_()->user()->getAuth()->getStorage()->write($user->getIdentity());
    }

    $email_params = array(
      'displayname' => $user->getTitle(),
      'email' => $user->email,
      'link' => 'http://' . $_SERVER['HTTP_HOST'] . Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'user_login'),
    );
    if ($random)
    {
      $email_params['password'] = $data['password'];
    }
    switch ($settings->getSetting('user.signup.verifyemail', 0)) {
      case 0:
        // only override admin setting if random passwords are being created
        if ($random) {
          Engine_Api::_()->getApi('mail', 'core')->sendSystem(
            $user,
            'core_welcome_password',
            $email_params
          );
        }
        break;

      case 1:
        // send welcome email
        Engine_Api::_()->getApi('mail', 'core')->sendSystem(
          $user,
          $random ? 'core_welcome_password':'core_welcome',
          $email_params
        );
        break;

      case 2:
        // verify email before enabling account
        $verify_table = Engine_Api::_()->getDbtable('verify', 'user');
        $verify_row = $verify_table->createRow();
        $verify_row->user_id = $user->getIdentity();
        $verify_row->code = md5($user->email . $user->creation_date . $settings->getSetting('core.secret', 'staticSalt') . (string) rand(1000000, 9999999));
        $verify_row->date = $user->creation_date;
        $verify_row->save();
        $email_params['link'] =  'http://' . $_SERVER['HTTP_HOST'] . Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action'=>'verify', 'email'=>$user->email, 'verify'=>$verify_row->code), 'user_signup');
        Engine_Api::_()->getApi('mail', 'core')->sendSystem(
          $user,
          $random ? 'core_verification_password' : 'core_verification',
          $email_params
        );
        break;

      default:
        // do nothing
    }
  }

  public function onAdminProcess($form)
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    $values = $form->getValues();
    $settings->user_signup = $values;
    if ($values['inviteonly'] == 1)
    {
      $step_table = Engine_Api::_()->getDbtable('signup', 'user');
      $step_row = $step_table->fetchRow($step_table->select()->where('class = ?', 'User_Plugin_Signup_Invite'));
      $step_row->enable = 0;
    }
  }

}