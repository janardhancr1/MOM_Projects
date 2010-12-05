<?php
class Socialdna_AuthController extends Core_Controller_Action_Standard
{
  protected $_authAdapter;

  public function loginAction()
  {
    
    // Already logged in
    if( Engine_Api::_()->user()->getViewer()->getIdentity() )
    {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('You are already signed in.');
      if( null === $this->_helper->contextSwitch->getCurrentContext() )
      {
        $this->_helper->redirector->gotoRoute(array(), 'home');
      }
      return;
    }

    // Make form
    $this->view->form = $form = new User_Form_Login();

    $session = new Zend_Session_Namespace('socialdna_auth');
    if($session->require_auth) {
      //$form->addError('Please sign in to continue..');
      $form->return_url->setValue($session->return_url);
      
      $session->require_auth = false;
      $session->return_url = '';
    }



    // Not a post
    if( !$this->getRequest()->isPost() )
    {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('No action taken');
      return;
    }

    // Form not valid
    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid data');
      return;
    }

    // Check login creds
    extract($form->getValues()); // $email, $password, $remember
    $user_table = Engine_Api::_()->getDbtable('users', 'user');
    $user_select = $user_table->select()
      ->where('email = ?', $email);          // If post exists
    $user = $user_table->fetchRow($user_select);

    if(empty($user)){
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('No record of a member with that email was found.');
      $form->addError(Zend_Registry::get('Zend_Translate')->_('No record of a member with that email was found.'));
      return;
    }
    
    if (!$user->verified || !$user->enabled)
    {
      $this->view->status = false;

      $error = 'This account still requires either email verification or admin approval.';

      if (!empty($user) && !$user->verified) $error .= ' Click <a href="%s">here</a> to resend the email.';
      $error = Zend_Registry::get('Zend_Translate')->_($error);
      
      if (!empty($user) && !$user->verified) {
        $resend_url = $this->_helper->url->url(array('action' => 'resend', 'email'=>$email), 'user_signup', true);
        $error= sprintf($error, $resend_url);
      }

      $form->getDecorator('errors')->setOption('escape', false);
      $form->addError($error);
      return;
    }
    $authResult = Engine_Api::_()->user()->authenticate($email, $password);
    $authCode = $authResult->getCode();
    Engine_Api::_()->user()->setViewer();

    if( $authCode != Zend_Auth_Result::SUCCESS )
    {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid credentials');
      $form->addError(Zend_Registry::get('Zend_Translate')->_('Invalid credentials supplied'));
      return;
    }

    // -- Success! --
    
    // Remember
    if( $remember )
    {
      $lifetime = 1209600; // Two weeks
      Zend_Session::getSaveHandler()->setLifetime($lifetime, true);
      Zend_Session::rememberMe($lifetime);
    }

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
    
    return $this->_redirectAfterLogin($form->getValue('return_url'));
  }


  protected function _redirectAfterLogin($uri = null) {

    // Do redirection only if normal context
    if( null === $this->_helper->contextSwitch->getCurrentContext() )
    {
      // Redirect by form
      //$uri = $form->getValue('return_url');
      if( $uri )
      {
        return $this->_redirect($uri, array('prependBase' => false));
        
      }

      // Redirect by session
      $session = new Zend_Session_Namespace('Redirect');
      if( isset($session->uri) )
      {
        $uri  = $session->uri;
        $opts = $session->options;
        $session->unsetAll();
        return $this->_redirect($uri, $opts);
      }
      else if( isset($session->route) )
      {
        $session->unsetAll();
        return $this->_helper->redirector->gotoRoute($session->params, $session->route, $session->reset);
      }
      else
      {
        return $this->_helper->redirector->gotoRoute(array('action' => 'home'), 'user_general');
      }
    }
    
  }


  
  
  
  
  public function loginsocialAction()
  {
    
      // clear cached values
      $session = new Zend_Session_Namespace('Socialdna');
      $session->openid_imported_fields = null;
      
      $request = $this->getRequest();
      
      $service = Engine_Api::_()->getApi('core', 'socialdna');

      $openid_session = $request->get('openidsession');
      $openid_service = $request->get('openidservice');
      $inpopup = $request->get('inpopup');
      $next = $request->get('next','');
      

      if($next == 'socialdna_facebook') {
        $next = Zend_Controller_Front::getInstance()->getRouter()->assemble(array(
                  'module'      => 'socialdna',
                  'controller'  => 'facebook',
                  'action'      => 'index'),
                'default');
      } elseif($next == 'socialdna_facebookinvite') {
        $next = Zend_Controller_Front::getInstance()->getRouter()->assemble(array(
                  'module'      => 'socialdna',
                  'controller'  => 'facebook',
                  'action'      => 'invite'),
                'default');
      }
      
      if($inpopup == 1) {
        echo <<< EOC
<script>
if(window.opener && window.opener.openidconnect_onlogincomplete) {
window.opener.openidconnect_onlogincomplete('$openid_session','$openid_service');
} else {
window.close();
}
</script>
EOC;
        exit;
      }
      
      // API
      if($openid_service == '') {
        $service->getOpenidapi($openid_session);
        $openid_service = $service->openid_service_id;
      }

      $viewer = Engine_Api::_()->user()->getViewer();
      
      // if user -> see if connected and/or link to openid?
      if ($viewer->getIdentity())
      {
        if($service->isUserConnected($viewer->getIdentity(),$openid_service)) {
          
          return $this->_redirectAfterLogin($next);
          
        }

        return $this->_helper->redirector->gotoRoute(array('openidsession' =>  $openid_session, 'openidservice' =>  $openid_service, 'next'  => $next), 'socialdna_link');

      }


      list($logged_in, $viewer) = $service->login_openid($openid_session, $openid_service);
      
      
      if ($logged_in)
      {
        return $this->_redirectAfterLogin($next);
        
      }
      else
      {
          
      }

      $session = new Zend_Session_Namespace('Socialdna_Signup');
      $session->openid_session = $openid_session;
      $session->openidservice = $openid_service;

      // if still here, means login failed -> quick signup
      return $this->_helper->redirector->gotoRoute(array('openidsession' =>  $openid_session, 'openidservice' =>  $openid_service, 'next'  => $next), 'socialdna_quicksignup');

  }
  
}
