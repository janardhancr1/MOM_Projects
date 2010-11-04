<?php

class Socialdna_Plugin_Signup_Account extends Core_Plugin_FormSequence_Abstract
{
  protected $_name = 'account';

  protected $_formClass = 'User_Form_Signup_Account';

  //protected $_script = array('signup/form/account.tpl', 'user');
  protected $_script = array('quicksignup/form/account.tpl', 'socialdna');

  protected $_adminFormClass = 'User_Form_Admin_Signup_Account';

  protected $_adminScript = array('admin-signup/account.tpl', 'user');

  public $email = null;
  
  public function getForm() {
    
    if( is_null($this->_form) ) {
      parent::getForm();
    }

    // @todo - is this flexible enough?
    // to avoid any possible modifications adding fields, make sure only our fields are around

    $session = new Zend_Session_Namespace('Socialdna_Signup');

    //$fields_ignore = array('submit','code');
    $fields_ignore = array('submit','code', 'email');
    
    $fields = Engine_Api::_()->getDbTable('settings','socialdna')->getSetting('socialdna.signup_required_fields');
    $fields = explode(',', $fields);
    
    foreach($this->_form->getElements() as $key => $val) {
      if(!in_array($key, $fields) && !in_array($key, $fields_ignore)) {
        $this->_form->removeElement($key);
      }
    }

    
    if($this->_form->getElement('code') && ($this->_form->getElement('code')->getValue() == '')) {

      $inviteSession = new Zend_Session_Namespace('invite');
      
      if( !empty($inviteSession->invite_code) ) {
        $this->_form->getElement('code')->setValue($inviteSession->invite_code);
      }
      
    }
   
    return $this->_form;
    
  }

  public function onView()
  {

    // Set default action
    $this->getForm()->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'socialdna_quicksignup'));

  }
  
  public function onSubmitIsValid() {
    
    // set default profile type, if should

    $fields = Engine_Api::_()->getDbTable('settings','socialdna')->getSetting('socialdna.signup_required_fields');
    $fields = explode(',', $fields);
    
    // default profile_type
    if(!in_array('profile_type', $fields)) {

      $this->getSession()->data['profile_type'] = Semods_Utils::getSetting('socialdna.signup_profilecat_default');

    } else {

      // if only 1 profile type - set it
      
      $topStructure = Engine_Api::_()->fields()->getFieldStructureTop('user');
      if( (count($topStructure) == 1) && ($topStructure[0]->getChild()->type == 'profile_type') ) {
        $profileTypeField = $topStructure[0]->getChild();
        $options = $profileTypeField->getOptions();
        
        if( count($options) == 1 ) {
          $this->getSession()->data['profile_type'] = $options[0]->option_id;
        }
      }
        
    }

    // default language
    if(!in_array('language', $fields)) {
  
      // Prepare default langauge
      $defaultLanguage = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.locale.locale', 'en');
      if(empty($defaultLanguage)) {
        $defaultLanguage = 'en';
      }

      $this->getSession()->data['language'] = $defaultLanguage;

    }
    
  }
  
  
  public function onSubmitNotIsValid() {
    
    // if just landed and got errors - clear them
    $session = $this->getSession(); // new Zend_Session_Namespace('Socialdna_Signup');

    // not first landing ?
    if(isset($session->landing) && ($session->landing == 1)) {
      return;
    }
    
    $session->landing = 1;

    // hide errors
    $this->_form->removeDecorator('FormErrors');
    
  }
  
  
  public function onProcess()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    //$random =  ($settings->getSetting('user.signup.random', 0) == 1);
    $random =  true;
    $data = $this->getSession()->data;

    // Add email and code to invite session if available
    $inviteSession = new Zend_Session_Namespace('invite');
    if( isset($data['email']) ) {
      $inviteSession->signup_email = $data['email'];
    }
    if( isset($data['code']) ) {
      $inviteSession->signup_code = $data['code'];
    }

    if ($random)
    {
      $password = $data['password'] = Engine_Api::_()->user()->randomPass(10);
    }
    $user = Engine_Api::_()->getDbtable('users', 'user')->createRow();
    $user->setFromArray($data);
    $user->save();
  
    // auto-verify
    $user->verified = 1;
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

    $mailType = 'core_welcome_password';
    $mailParams = array(
      'host' => $_SERVER['HTTP_HOST'],
      'email' => $user->email,
      'password' => $password,
      'date' => time(),
      'recipient_title' => $user->getTitle(),
      'recipient_link' => $user->getHref(),
      'recipient_photo' => $user->getPhotoUrl('thumb.icon'),
      'object_link' => ( _ENGINE_SSL ? 'https://' : 'http://' )
        . $_SERVER['HTTP_HOST']
        . Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'user_login', true),
    );

    if ($random)
    {
      $email_params['password'] = $data['password'];
    }
    
    // Do not require email verification for social connecting users

    // send welcome email
    Engine_Api::_()->getApi('mail', 'core')->sendSystem(
      $user,
      $mailType,
      $mailParams
    );

    

  }

}