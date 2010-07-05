<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: SignupController.php 6605 2010-06-28 21:24:32Z jung $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_SignupController extends Core_Controller_Action_Standard
{
  public function init()
  {
  }
  
  public function indexAction()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');

    // If the user is logged in, they can't sign up now can they?
    if( Engine_Api::_()->user()->getViewer()->getIdentity() )
    {
      return $this->_helper->redirector->gotoRoute(array(), 'default', true);
    }
    
    $formSequenceHelper = $this->_helper->formSequence;
    foreach( $this->_helper->api()->getDbtable('signup', 'user')->fetchAll() as $row )
    {
      if( $row->enable == 1 )
      {
        $class = $row->class;
        $formSequenceHelper->setPlugin(new $class, $row->order);
      }
    }

    // This will handle everything until done, where it will return true
    if( $this->_helper->formSequence() )
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

        return $this->_helper->_redirector->gotoRoute(array(), 'core_home', true);
      }
      else
      {
        return $this->_helper->_redirector->gotoRoute(array('action' => 'confirm', 'approved'=>$approved, 'verified'=>$verified), 'user_signup', true);
      }
      //return $this->render('complete');
    }
  }

  public function verifyAction()
  {

    $verify = $this->getRequest()->getParam('verify');
    $email = $this->getRequest()->getParam('email');
    $settings = Engine_Api::_()->getApi('settings', 'core');

    if ($verify && $email){
    //    $user = Engine_Api::_()->getDbtable('users', 'user')->createRow();
      $user_table = Engine_Api::_()->getDbtable('users', 'user');
      $user_select = $user_table->select()
        ->where('email = ?', $email);          // If post exists
      $user = $user_table->fetchRow($user_select);

      $verify_table =  Engine_Api::_()->getDbtable('verify', 'user');
      $row = $verify_table->fetchRow($verify_table->select()->where('user_id = ?', $user->getIdentity()));
      if ($row->code == $verify)
      {
        $row->delete(); 
        $user->verified = 1;
        $user->save();
        if ($user->verified && $user->enabled)
        {
          // update networks
          Engine_Api::_()->network()->recalculate($user);

          // Create activity for them
          Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($user, $user, 'signup');
        }

      }
    }
    else{
     die('nocode');
    }
  }

  public function takenAction()
  {
    $username = $this->_getParam('username');
    $email = $this->_getParam('email');

    // Sent both or neither username/email
    if( (bool) $username == (bool) $email )
    {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid param count');
      return;
    }

    // Username must be alnum
    if( $username )
    {
      $validator = new Zend_Validate_Alnum();
      if( !$validator->isValid($username) )
      {
        $this->view->status = false;
        $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid param value');
        //$this->view->errors = $validator->getErrors();
        return;
      }

      $table = Engine_Api::_()->getItemTable('user');
      $row = $table->fetchRow($table->select()->where('username = ?', $username)->limit(1));

      $this->view->status = true;
      $this->view->taken = ( $row !== null );
      return;
    }

    if( $email )
    {
      $validator = new Zend_Validate_EmailAddress();
      if( !$validator->isValid($email) )
      {
        $this->view->status = false;
        $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid param value');
        //$this->view->errors = $validator->getErrors();
        return;
      }

      $table = Engine_Api::_()->getItemTable('user');
      $row = $table->fetchRow($table->select()->where('email = ?', $email)->limit(1));

      $this->view->status = true;
      $this->view->taken = ( $row !== null );
      return;
    }
  }

  public function confirmAction()
  {
    $this->view->approved = $this->getRequest()->getParam('approved');
    $this->view->verified = $this->getRequest()->getParam('verified');

  }


  public function resendAction()
  {
    $email = $this->_getParam('email');

    //    $user = Engine_Api::_()->getDbtable('users', 'user')->createRow();
    $user_table = Engine_Api::_()->getDbtable('users', 'user');
    $user_select = $user_table->select()
      ->where('email = ?', $email);          // If post exists
    $user = $user_table->fetchRow($user_select);

    // resend verify email
    $verify_table = Engine_Api::_()->getDbtable('verify', 'user');
    $verify_row = $verify_table->fetchRow($verify_table->select()->where('user_id = ?', $user->user_id)->limit(1));
    $email_params['link'] =  'http://' . $_SERVER['HTTP_HOST'] . Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action'=>'verify', 'email'=>$email, 'verify'=>$verify_row->code), 'user_signup');
    Engine_Api::_()->getApi('mail', 'core')->sendSystem(
      $user,
      'core_verification',
      $email_params
    );

  }
}