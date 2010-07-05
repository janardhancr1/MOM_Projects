<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Invite.php 6518 2010-06-23 01:22:43Z shaun $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Invite_Form_Invite extends Engine_Form
{
  public $invalid_emails  = array();
  public $already_members = array();
  public $emails_sent     = 0;

  public function init()
  {
    // Init settings object
    $settings  = Engine_Api::_()->getApi('settings', 'core');
    $translate = Zend_Registry::get('Zend_Translate');
    
    // Init form
    $this->setTitle('Invite Your Friends')
         ->setDescription('_INVITE_FORM_DESCRIPTION');
    $this->setLegend('');
    

    // Init recipients
    $this->addElement(new Engine_Form_Element_Textarea('recipients', array(
        'label' => 'Recipients',
        'description' => 'Comma-separated list, or one-email-per-line.'
      )));
      $this->recipients->getDecorator('Description')->setOptions(array('placement' => 'APPEND'));


    // Init custom message
    if ($settings->getSetting('invite.allowCustomMessage', 1) > 0) {
      $this->addElement(new Engine_Form_Element_Textarea('message', array(
          'label' => 'Custom Message',
          'required' => FALSE,
          'allowEmpty' => TRUE,
          'description' => 'Use %invite_url% to add a link to our sign up page.',
          'value' => $settings->getSetting('invite.message', '%invite_url%'),
          'filters' => array(
              new Engine_Filter_Censor(),
          )
        )));
    }
    $this->message->getDecorator('Description')->setOptions(array('placement' => 'APPEND'));

    if (Engine_Api::_()->getApi('settings', 'core')->core_spam_invite) {
      $this->addElement('captcha', 'captcha', array(
        'description' => '_CAPTCHA_DESCRIPTION',
        'captcha' => 'image',
        'required' => true,
        'captchaOptions' => array(
          'wordLen' => 6,
          'fontSize' => '30',
          'timeout' => 300,
          'imgDir' => APPLICATION_PATH . '/public/temporary/',
          'imgUrl' => $this->getView()->baseUrl().'/public/temporary',
          'font' => APPLICATION_PATH . '/application/modules/Core/externals/fonts/arial.ttf'
        )));
    }

    // Init submit
    $this->addElement('button', 'submit', array(
        'type'  => 'submit',
        'label' => 'Send Invites',
      ));


  }

  public function sendInvites()
  {
    $user = Engine_Api::_()->user()->getViewer();
    $settings    = Engine_Api::_()->getApi('settings', 'core');
    $translate   = Zend_Registry::get('Zend_Translate');
    $recipients  = preg_split("/[\s,]+/",          $this->getElement('recipients')->getValue() );
    $message     = ($this->getElement('message') ? $this->getElement('message')->getValue() : '');
    $message     = trim($message);
    if (is_array($recipients) && !empty($recipients)) {
      // Initiate objects to be used below
      $table       = Engine_Api::_()->getDbtable('invites', 'invite');
      // Iterate through each recipient
      $already_members       = Engine_Api::_()->invite()->findIdsByEmail($recipients);
      $this->already_members = Engine_Api::_()->user()->getUserMulti($already_members);
      foreach ($recipients as $recipient) {
        // perform tests on each recipient before sending invite
        $recipient = trim($recipient);
        // watch out for poorly formatted emails
        if (!empty($recipient) && !array_key_exists($recipient, $already_members)) {
          // Passed the tests, lets start inserting database entry
          // generate unique invite code and confirm it truly is unique
          do {
            $invite_code  = substr(md5(rand(0,999).$recipient), 10, 7);
            $code_check   = $table->select()->where('code = ?', $invite_code);
          } while (null !== $table->fetchRow($code_check));

          // per-user string formatting
          $invite_url     = "http://{$_SERVER['HTTP_HOST']}"
                          . Zend_Controller_Front::getInstance()->getRouter()->assemble(array(
                                'module'     => 'invite',
                                'controller' => 'signup',
                                'action'     => $invite_code), 'default');

          // insert the invite into the database
          $db = Engine_Db_Table::getDefaultAdapter();
          $db->beginTransaction();
          try {
            $row = $table->createRow();
            $row->user_id   = $user->getIdentity();
            $row->recipient = $recipient;
            $row->code      = $invite_code;
            $row->timestamp = date('Y-m-d H:i:s');
            $row->message   = $message;
            $row->save();
            $mail_settings =   array(
                   'displayname' => $user->getTitle(),
                   'email' => $recipient,
                   'message' => $message,
                   'link' => 'http://' . $_SERVER['HTTP_HOST'] . Zend_Controller_Front::getInstance()->getRouter()->assemble(array('code'=>$invite_code, 'email'=>$recipient), 'user_signup'));
            // send email
            $user->invites_used++;
            if ($settings->getSetting('user.signup.inviteonly') == 2) {
              $mail_settings['code'] = $invite_code;
              Engine_Api::_()->getApi('mail', 'core')->sendSystem(
                $recipient,
                 'core_invitecode',
                 $mail_settings 
              );
            }
	    else
            {
              $mail_settings['code'] = $row['code'];
              Engine_Api::_()->getApi('mail', 'core')->sendSystem(
                $recipient,
                 'core_invite',
                 $mail_settings 
              );
            }


            
            // mail sent, so commit
            $this->emails_sent++;
            $db->commit();
          } catch ( Zend_Mail_Transport_Exception $e) {
            $db->rollBack();
          }
        } // end if (!array_key_exists($recipient, $already_members))
      } // end foreach ($recipients as $recipient)
    } // end if (is_array($recipients) && !empty($recipients))
    $user->save();
    return $this->emails_sent;
  } // end public function sendInvites()

}
