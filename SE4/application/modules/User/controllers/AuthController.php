<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AuthController.php 6656 2010-07-01 01:21:27Z jung $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_AuthController extends Core_Controller_Action_Standard
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

    // Facebook login
    if ('none' == Engine_Api::_()->getApi('settings', 'core')->core_facebook_enable) {
      $form->removeElement('facebook');
    } else {
      $facebook  = User_Model_DbTable_Facebook::getFBInstance();
      if ($facebook->getSession()) {
        $form->removeElement('facebook');
        try {
          $me  = $facebook->api('/me');
          $uid = Engine_Api::_()->getDbtable('Facebook', 'User')->fetchRow(array('facebook_uid = ?' => $facebook->getUser()));
          if ($uid)
            $uid = $uid->user_id;
          if ($uid) {
            // already integrated user account; sign in
            Engine_Api::_()->user()->getAuth()->getStorage()->write($uid);
            if( null === $this->_helper->contextSwitch->getCurrentContext() )
              $this->_helper->redirector->gotoRoute(array(), 'home');
            return;
          } else {
            //$form->setAction($this->view->url(array('controller'=>'settings','action'=>'general'), 'user_extended'));
            $form->addNotice($this->view->translate('USER_FORM_AUTH_FACEBOOK_NOACCOUNT', 
                                $this->view->url(array(), 'user_signup'),
                                $this->view->url(array('controller'=>'settings','action'=>'general'), 'user_extended')));
          }
        } catch (Facebook_Exception $e) {}
      }
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
    if (!((!empty($user) && $user->verified && $user->enabled)))
    {
      $this->view->status = false;

      $error = 'This account still requires either email verification or admin approval.';
      if (!$user->verified) $error .= ' Click <a href="%s">here</a> to resend the email.';

      $error = Zend_Registry::get('Zend_Translate')->_($error);
      
      if (!$user->verified) {
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
    
    // Do redirection only if normal context
    if( null === $this->_helper->contextSwitch->getCurrentContext() )
    {
      // Redirect by form
      $uri = $form->getValue('return_url');
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

  public function logoutAction()
  {
    // Check if already logged out
    $viewer = Engine_Api::_()->user()->getViewer();
    if( !$viewer->getIdentity() )
    {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('You are already logged out.');
      if( null === $this->_helper->ajaxContext->getCurrentContext() )
      {
        $this->_helper->redirector->gotoRoute(array(), 'home');
      }
      return;
    }

    // Test activity @todo remove
    Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $viewer, 'logout');

    $table = $this->_helper->api()->getItemTable('user');
    $onlineTable = $this->_helper->api()->getDbtable('online', 'user')
    ->delete(array(
        'user_id = ?' => $viewer->getIdentity(),
      ));

    // Facebook
    if ('none' != Engine_Api::_()->getApi('settings', 'core')->core_facebook_enable) {
      $fb_id = Engine_Api::_()->getDbtable('facebook', 'user')->find($viewer->getIdentity())->current();
      if ($fb_id && $fb_id->facebook_uid) {
        $facebook = User_Model_DbTable_Facebook::getFBInstance();
        if ($facebook->getSession()) {
          Engine_Api::_()->user()->getAuth()->clearIdentity();
          $this->_helper->redirector->gotoUrlAndExit($facebook->getLogoutUrl());
          exit;
        }
      }
    }
    
    // Logout
    Engine_Api::_()->user()->getAuth()->clearIdentity();
    $this->view->status = true;
    $this->view->message =  Zend_Registry::get('Zend_Translate')->_('You are now logged out.');
    if( null === $this->_helper->ajaxContext->getCurrentContext() )
    {
      return $this->_helper->redirector->gotoRouteAndExit(array(), 'home');
    }
  }

  public function forgotAction()
  {
    // no logged in users
    if( Engine_Api::_()->user()->getViewer()->getIdentity() ) {
      return $this->_helper->redirector->gotoRoute(array('action' => 'home'), 'user_general', true);
    }

    // Make form
    $this->view->form = $form = new User_Form_Auth_Forgot();

    // Check request
    if( !$this->getRequest()->isPost() ) {
      return;
    }

    // Check data
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    // Check for existing user
    $user = new User_Model_User($form->getValue('email'));
    if( !$user || !$user->getIdentity() ) {
      $form->addError('A user account with that email was not found.');
      return;
    }

    // Check to make sure they're enabled
    if( !$user->isEnabled() ) {
      $form->addError('That user account has not yet been verified or disabled by an admin.');
      return;
    }

    // Ok now we can do the fun stuff
    $forgotTable = Engine_Api::_()->getDbtable('forgot', 'user');
    $db = $forgotTable->getAdapter();
    $db->beginTransaction();

    try
    {
      // Delete any existing reset password codes
      $forgotTable->delete(array(
        'user_id = ?' => $user->getIdentity(),
      ));

      // Create a new reset password code
      $code = base_convert(md5($user->salt . $user->email . $user->user_id . uniqid(time(), true)), 16, 36);
      $forgotTable->insert(array(
        'user_id' => $user->getIdentity(),
        'code' => $code,
        'creation_date' => date('Y-m-d H:i:s'),
      ));

      // Send user an email
      Engine_Api::_()->getApi('mail', 'core')->sendSystem($user, 'core_lostpassword', array(
        'displayname' => $user->getTitle(),
        'email' => $user->email,
        'link' => 'http://' . $_SERVER['HTTP_HOST'] . $this->_helper->url->url(array('action' => 'reset', 'code' => $code, 'uid' => $user->getIdentity())),
      ));

      // Show success
      $this->view->sent = true;

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }

  public function resetAction()
  {
    // no logged in users
    if( Engine_Api::_()->user()->getViewer()->getIdentity() ) {
      return $this->_helper->redirector->gotoRoute(array('action' => 'home'), 'user_general', true);
    }

    // Check for empty params
    $user_id = $this->_getParam('uid');
    $code = $this->_getParam('code');

    if( empty($user_id) || empty($code) ) {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }

    // Check user
    $user = Engine_Api::_()->getItem('user', $user_id);
    if( !$user || !$user->getIdentity() ) {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }

    // Check code
    $forgotTable = Engine_Api::_()->getDbtable('forgot', 'user');
    $forgotRow = $forgotTable->find($user->getIdentity())->current();
    if( $forgotRow->user_id !== $user->getIdentity() ) {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }

    // Code expired
    // Note: Let's set the current timeout for 6 hours for now
    $min_creation_date = time() - (3600 * 6);
    if( strtotime($forgotRow->creation_date) < $min_creation_date ) { // @todo The strtotime might not work exactly right
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }
    
    // Make form
    $this->view->form = $form = new User_Form_Auth_Reset();
    $form->setAction($this->_helper->url->url(array()));

    // Check request
    if( !$this->getRequest()->isPost() ) {
      return;
    }

    // Check data
    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    // Process
    $values = $form->getValues();

    // Check same password
    if( $values['password'] !== $values['password_confirm'] ) {
      $form->addError('The passwords you entered did not match.');
      return;
    }
    
    // Db
    $db = $user->getTable()->getAdapter();
    $db->beginTransaction();

    try
    {
      // Delete the lost password code now
      $forgotTable->delete(array(
        'user_id = ?' => $user->getIdentity(),
      ));
      
      // This gets handled by the post-update hook
      $user->password = $values['password'];
      $user->save();
      
      $db->commit();

      $this->view->reset = true;
      //return $this->_helper->redirector->gotoRoute(array(), 'user_login', true);
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }

  public function facebookSuccessAction()
  {
    $code = $this->_getParam('code');
    if ('none' == Engine_Api::_()->getApi('settings', 'core')->core_facebook_enable) {
      $form->removeElement('facebook');
    } else {
      $facebook  = User_Model_DbTable_Facebook::getFBInstance();
      if ($facebook->getSession()) {
        die("hi facebooker");
      }
    }
    
    if (!$code) {
      $this->_forward('login');
      return;
    }

    $access_token = User_Model_DbTable_Facebook::getAccessToken($code);
  }
  public function facebookSuccess2Action()
  {
    // Decode session data
    $fbSessionData = $this->_getParam('session');
    $fbSessionData = Zend_Json::decode($fbSessionData);
    
    // No data, redirect to home
    if( empty($fbSessionData) ) {
      return;
    }
    
    // Check if we have an associated user
    $facebookTable = Engine_Api::_()->getDbtable('facebook', 'user');
    $select = $facebookTable->select()->where('facebook_uid = ?', $fbSessionData['uid']);
    $row = $facebookTable->fetchRow($select);

    $viewer = Engine_Api::_()->user()->getViewer();
    $user = null;
    if( null !== $row ) {
      $user = Engine_Api::_()->getItem('user', $row->user_id);
    }

    $doCookies = false;
    
    // Associated, but another user is logged in
    if( null !== $user && $viewer->getIdentity() && !$user->isSelf($viewer) ) {
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Another member has already associated with that facebook account');
      return;
    }

    // Not associated and a user is not logged in
    if( null === $user && !$viewer->getIdentity() ) {
      // We should ideally redirect to signup
      return;
    }

    // Not associated and a user is logged in
    if( null !== $user && $viewer->getIdentity() ) {
      $doCookies = true;

      // Associate user with facebook account
      $facebookTable->insert(array(
        'user_id' => $user->getIdentity(),
        'facebook_uid' => $fbSessionData['uid'],
      ));

      return;
    }

    // Associated and not logged in
    if( null !== $user && !$viewer->getIdentity() ) {
      $doCookies = true;
      Engine_Api::_()->user()->getAuth()->getStorage()->write($user->email);
    }

    if( $doCookies ) {
      // Get api stuff
      $config = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.facebook');
      $prefix = $config['key'] . '_';

      // Set cookies
      setcookie($prefix . 'user', $fbSessionData['uid'], null, $this->view->baseUrl());
      setcookie($prefix . 'session_key', $fbSessionData['session_key'], null, $this->view->baseUrl());
      setcookie($prefix . 'expires', $fbSessionData['expires'], null, $this->view->baseUrl());
      setcookie($prefix . 'secret', $fbSessionData['secret'], null, $this->view->baseUrl());

      // Fake it
      $_COOKIE[$prefix . 'user'] = $fbSessionData['uid'];
      $_COOKIE[$prefix . 'session_key'] = $fbSessionData['session_key'];
      $_COOKIE[$prefix . 'expires'] = $fbSessionData['expires'];
      $_COOKIE[$prefix . 'secret'] = $fbSessionData['secret'];
    }


    /*
    $config = Engine_Api::_()->getApi('settings', 'core')->getSetting('core.facebook');
    $fb = new Facebook_Core($config['key'], $config['secret']);
    $user_id = $fb->require_login();
    $fb->get_loggedin_user();
     * 
     */
  }

  public function facebookCancelAction()
  {
    
  }
}
