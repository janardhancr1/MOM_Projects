<?php

class Socialdna_QuicksignupController extends Core_Controller_Action_Standard
{
  public function init()
  {
  }
  
  public function indexAction()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');

    $task = $this->getRequest()->get('task');
    
    // If the user is logged in, they can't sign up now can they?
    if( Engine_Api::_()->user()->getViewer()->getIdentity() )
    {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }

    $session = new Zend_Session_Namespace('Socialdna_Signup');

    $openid_session = $session->openid_session;
    $openid_service = $session->openidservice;
    
    if(empty($openid_session) && empty($openid_service)) {
      $openid_session = $session->openid_session = $this->_getParam('openidsession','');
      $openid_service = $session->openidservice = $this->_getParam('openidservice','');
    }
    
    $this->openid_session = $openid_session;
    $this->openid_service = $openid_service;

    $service = Engine_Api::_()->getApi('core', 'socialdna');
    $service->signup_via_openid = true;

    $this->openidapi = $service->getOpenidapi($openid_session, $openid_service);
    
    // no service 
    if($service->openid_service_id == 0) {
      return $this->_helper->redirector->gotoRoute(array('action' => 'home'), 'user_general');
      //return $this->_helper->_redirector->gotoRoute(array(), 'core_home', true);
    }


    if($task == 'signuplogin') {
      $this->loginAction();
      
      // hide signup errors
      $account_form_session = new Zend_Session_Namespace('Socialdna_Plugin_Signup_Account');
      $account_form_session->landing = null;
      
    } 
    




    // Signup

    
    $formSequenceHelper = $this->_helper->formSequenceEx;


    $formSequenceHelper->setPlugin(new Socialdna_Plugin_Signup_Account(), 1);
    $formSequenceHelper->setPlugin(new Socialdna_Plugin_Signup_Fields(), 2);
    $formSequenceHelper->setPlugin(new Socialdna_Plugin_Signup_Photo(), 3);



    $openid_signup_required_fields = Engine_Api::_()->getDbTable('settings','socialdna')->getSetting('socialdna.signup_required_fields');
    $openid_signup_required_fields = !empty($openid_signup_required_fields)  ? explode(',',$openid_signup_required_fields) : array();

    $session->fields = $openid_signup_required_fields;

    $openid_signup_email = intval(in_array("email",$openid_signup_required_fields));
    $openid_signup_timezone = intval(in_array("timezone",$openid_signup_required_fields));
    $openid_signup_terms = intval(in_array("terms",$openid_signup_required_fields));

    $openid_service_id = intval($service->getOpenidFieldValue('openid_service_id'));
    $openid_service_info = $service->getService($openid_service_id);

    $openid_user_fullname = $service->getOpenidFieldValue('name');
    if($openid_user_fullname == '') {

      $openid_user_fullname = $service->getOpenidFieldValue('first_name') . ' ' . $service->getOpenidFieldValue('last_name');
      $openid_user_fullname = trim($openid_user_fullname);
      
    }
    $openid_user_thumb = $service->getOpenidFieldValue('pic_square');
    if($openid_user_thumb == '') {
      $openid_user_thumb = $service->getOpenidFieldValue('pic_big');
    }
    
    $this->view->openid_user_thumb = $openid_user_thumb;
    $this->view->openid_user_fullname = $openid_user_fullname;
    $this->view->openid_service_info = $openid_service_info;
    

    $inviteSession = new Zend_Session_Namespace('invite');

    if( !empty($inviteSession->invite_email) && (Semods_Utils::g($_POST,'email','') == '') ) {
      $_POST['email'] = $inviteSession->invite_email;
    }

    
    $service->mapOpenidFields( $_POST, $_POST );


    // fake post and stuff field values
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $_POST['timezone'] = $settings->getSetting('core.locale.timezone');

    // Languages
    $translate    = Zend_Registry::get('Zend_Translate');
    $languageList = $translate->getList();

    // Prepare default langauge
    $defaultLanguage = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.locale.locale', 'en');
    if( !in_array($defaultLanguage, $languageList) ) {
      if( $defaultLanguage == 'auto' && isset($languageList['en']) ) {
        $defaultLanguage = 'en';
      } else {
        $defaultLanguage = null;
      }
    }
    $_POST['language'] = $defaultLanguage;
    $_POST['submit'] = '';
    

    // This will handle everything until done, where it will return true
    if( $this->_helper->formSequenceEx() )
    {
      $viewer = Engine_Api::_()->user()->getViewer();
      $approved = $viewer->enabled;
      $verified = $viewer->verified;
      if (!($viewer->enabled && $viewer->verified))
      {
        Engine_Api::_()->user()->setViewer(null);
      }
      if ($approved && $verified)
      {
        // update networks
        Engine_Api::_()->network()->recalculate($viewer);
        
        if(($openid_service_id == 1) && (Semods_Utils::getSetting('socialdna.redirect_after_openid_signup') == 1)) {
          return $this->_helper->_redirector->gotoRoute(array(), 'socialdna_facebookinvite', true);
        } else {
          return $this->_helper->_redirector->gotoRoute(array(), 'core_home', true);
        }
        
      }
      else
      {
        return $this->_helper->_redirector->gotoRoute(array('action' => 'confirm', 'approved'=>$approved, 'verified'=>$verified), 'user_signup', true);
      }
    }

    $this->view->task = $task;
    
  }


  public function loginAction() {
    


    // Check login creds
    $email = $this->getRequest()->get('email');
    $password = $this->getRequest()->get('password');
    
    $user_table = Engine_Api::_()->getDbtable('users', 'user');
    $user_select = $user_table->select()
      ->where('email = ?', $email);          // If post exists
    $user = $user_table->fetchRow($user_select);

    if(empty($user)){
      $this->view->error_message = Zend_Registry::get('Zend_Translate')->_('No record of a member with that email was found.');
      return;
    }
    
    if (!$user->verified || !$user->enabled)
    {

      $error = 'This account still requires either email verification or admin approval.';

      if (!empty($user) && !$user->verified) $error .= ' Click <a href="%s">here</a> to resend the email.';
      $error = Zend_Registry::get('Zend_Translate')->_($error);
      
      if (!empty($user) && !$user->verified) {
        $resend_url = $this->_helper->url->url(array('action' => 'resend', 'email'=>$email), 'user_signup', true);
        $error= sprintf($error, $resend_url);
      }

      $this->view->error_message = $error;
      return;
    }
    $authResult = Engine_Api::_()->user()->authenticate($email, $password);
    $authCode = $authResult->getCode();
    Engine_Api::_()->user()->setViewer();

    if( $authCode != Zend_Auth_Result::SUCCESS )
    {
      $this->view->error_message = Zend_Registry::get('Zend_Translate')->_('Invalid credentials supplied');
      return;
    }

    // -- Success! --
    
    // Increment sign-in count
    Engine_Api::_()->getDbtable('statistics', 'core')->increment('user.logins');

    // Test activity @todo remove
    $viewer = Engine_Api::_()->user()->getViewer();
    if( $viewer->getIdentity() )
    {
      $viewer->lastlogin_date = date("Y-m-d H:i:s");
      $viewer->lastlogin_ip   = $_SERVER['REMOTE_ADDR'];
      $viewer->save();
      Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $viewer, 'login');
    }

    // Assign sid to view for json context
    $this->view->status = true;
    $this->view->message = Zend_Registry::get('Zend_Translate')->_('Login successful');
    $this->view->sid = Zend_Session::getId();
    $this->view->sname = Zend_Session::getOptions('name');


    return $this->_helper->_redirector->gotoRoute(array('openidsession' =>  $this->openid_session, 'openidservice' =>  $this->openid_service), 'socialdna_link', true);
    
  }

}