<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: SettingsController.php 6631 2010-06-29 20:17:26Z steve $
 * @author     Steve
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_SettingsController extends Core_Controller_Action_User
{
  protected $_user;
  
  public function init()
  {
    // Can specifiy custom id
    $id = $this->_getParam('id', null);
    $subject = null;
    if( null === $id )
    {
      $subject = $this->_helper->api()->user()->getViewer();
      $this->_helper->api()->core()->setSubject($subject);
    }
    else
    {
      $subject = $this->_helper->api()->user()->getUser($id);
      $this->_helper->api()->core()->setSubject($subject);
    }

    // Set up require's
    $this->_helper->requireUser();
    $this->_helper->requireAuth()->setAuthParams(
      $subject,
      null,
      'edit'
    );

    // Set up navigation
    $this->view->navigation = $navigation = $this->_helper->api()
      ->getApi('menus', 'core')
      ->getNavigation('user_settings', array('params'=>array('id'=>$id)));

    /*
    $viewer = Engine_Api::_()->user()->getViewer();
    if ( !$viewer->getIdentity() ) {
      $session = new Zend_Session_Namespace('Redirect');
      $session->uri     = 'user/settings';
      $session->options = array();
      $this->_redirect('login');
    }
     *
     */

    $contextSwitch = $this->_helper->contextSwitch;
    $contextSwitch
      //->addActionContext('reject', 'json')
      ->initContext();
  }
  
  public function generalAction()
  {
    // Config vars
    $user = $this->_helper->api()->core()->getSubject();
    $this->view->form = $form = new User_Form_Settings_General(array('item' => $user));

    // Set up profile type options
    /*
    $aliasedFields = $user->fields()->getFieldsObjectsByAlias();
    if( isset($aliasedFields['profile_type']) )
    {
      $options = $aliasedFields['profile_type']->getElementParams($user);
      unset($options['options']['order']);
      $form->accountType->setOptions($options['options']);
    }
    else
    { */
      $form->removeElement('accountType');
    /* } */

    // Set up notification options
    $notificationTypes = Engine_Api::_()->getDbtable('notificationTypes', 'activity')->getNotificationTypesAssoc();
    $form->emailAlerts->setMultiOptions($notificationTypes);

    // Removed disabled features
    if( !Engine_Api::_()->authorization()->isAllowed('user', $user, 'username') ) {
      $form->removeElement('username');
    }

    // Facebook
    if ('none' != Engine_Api::_()->getApi('settings', 'core')->getSetting('core.facebook.enable', 'none')) {
      $facebook = User_Model_DbTable_Facebook::getFBInstance();
      if ($facebook->getSession()) {
        $fb_uid = Engine_Api::_()->getDbtable('facebook', 'user')->fetchRow(array('user_id = ?'=>Engine_Api::_()->user()->getViewer()->getIdentity()));
        if ($fb_uid && $fb_uid->facebook_uid)
            $fb_uid  = $fb_uid->facebook_uid;
        else
            $fb_uid  = null;

        try {
          $facebook->api('/me');
          if ($fb_uid && $facebook->getUser() != $fb_uid) {
            $form->removeElement('facebook_id');
            $form->getElement('facebook')->addError('You appear to be logged into a different Facebook account than what was registered with this account.  Please log out of Facebook using the button below to log into your correct Facebook account.');
            $form->getElement('facebook')->setContent($this->view->translate('<button onclick="window.location.href=this.value;return false;" value="%s">Logout of Facebook</button>', $facebook->getLogoutUrl()));
          } else {
            $form->removeElement('facebook');
            $form->getElement('facebook_id')->setAttrib('checked', (bool) $fb_uid);
          }
        } catch (Exception $e) {
          $form->removeElement('facebook');
          $form->removeElement('facebook_id');
        }
      } else {
        @$form->removeElement('facebook_id');
      }
    } else {
      // these should already be removed inside the form, but lets do it again.
      @$form->removeElement('facebook');
      @$form->removeElement('facebook_id');
    }

    
    // Check if post and populate
    if( !$this->getRequest()->isPost() )
    {
      $form->populate($user->toArray());

      // Populate notification settings
      $notificationTypesEnabled = Engine_Api::_()->getDbtable('notificationSettings', 'activity')->getEnabledNotifications($user);
      $form->emailAlerts->setValue($notificationTypesEnabled);

      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid method');
      return;
    }

    // Check if valid
    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid data');
      return;
    }

    // -- Process --

    // Set values for user object
    $user->setFromArray($form->getValues());
    $user->save();

    // Update account type
    /*
    $accountType = $form->getValue('accountType');
    if( isset($aliasedFields['profile_type']) )
    {
      $valueRow = $aliasedFields['profile_type']->getValue($user);
      if( null === $valueRow ) {
        $valueRow = Engine_Api::_()->fields()->getTable('user', 'values')->createRow();
        $valueRow->field_id = $aliasedFields['profile_type']->field_id;
        $valueRow->item_id = $user->getIdentity();
      }
      $valueRow->value = $accountType;
      $valueRow->save();
    }
     * 
     */

    // Update facebook settings
    if (isset($facebook) && $form->getElement('facebook_id')) {
      if ($facebook->getSession()) {
        try {
          $facebook->api('/me');
          $uid   = Engine_Api::_()->user()->getViewer()->getIdentity();
          $table = Engine_Api::_()->getDbtable('facebook', 'user');
          $row   = $table->find($uid)->current();
          if (!$row) {
            $row = $table->createRow();
            $row->user_id = $uid;
          }
          $row->facebook_uid = $this->getRequest()->getPost('facebook_id')
                             ? $facebook->getUser()
                             : 0;
          $row->save();
          $form->removeElement('facebook');
        } catch (Exception $e) {}
      }
    }
    
    // Update notification settings
    $emailAlerts = $form->emailAlerts->getValue();
    if (!is_array($emailAlerts))
      $emailAlerts = array();
    Engine_Api::_()->getDbtable('notificationSettings', 'activity')->setEnabledNotifications($user, $emailAlerts);

    // Send success message
    $this->view->status = true;
    $this->view->message = Zend_Registry::get('Zend_Translate')->_('Settings saved.');
    $form->addNotice(Zend_Registry::get('Zend_Translate')->_('Settings were successfully saved.'));
  }

  public function privacyAction()
  {
    $this->view->form = $form = new User_Form_Settings_Privacy();
    $user = $this->_helper->api()->core()->getSubject();
    $settings = Engine_Api::_()->getApi('settings', 'core');

    // Init blocked
    $this->view->blockedUsers = array();

    if( Engine_Api::_()->authorization()->isAllowed('user', $user, 'block') ) {
      foreach ($user->getBlockedUsers() as $blocked_user_id) {
        $this->view->blockedUsers[] = Engine_Api::_()->user()->getUser($blocked_user_id);
      }
    } else {
      $form->removeElement('blockList');
    }

    // Set up notification options
    $actionTypes = Engine_Api::_()->getDbtable('actionTypes', 'activity')->getActionTypesAssoc();
    if ($settings->getSetting('user.friends.direction') == 1)
    {
      unset($actionTypes['friends']);
    }
    else
    {
      unset($actionTypes['friends_follow']);
    }
    $form->publishTypes->setMultiOptions($actionTypes);

    // Check if post and populate
    if( !$this->getRequest()->isPost() )
    {
      $form->populate($user->toArray());

      // Populate action settings
      $actionTypesEnabled = Engine_Api::_()->getDbtable('actionSettings', 'activity')->getEnabledActions($user);
      //var_dump($actionTypesEnabled);die();
      $form->publishTypes->setValue($actionTypesEnabled);

      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid data');
      return;
    }

    $form->save();
    $user->setFromArray($form->getValues())
      ->save();

    // Update notification settings
    $publishTypes = $form->publishTypes->getValue();
    Engine_Api::_()->getDbtable('actionSettings', 'activity')->setEnabledActions($user, (array) $publishTypes);
  }
  
  public function passwordAction()
  {
    $this->view->form = $form = new User_Form_Settings_Password();
    $user = $this->_helper->api()->core()->getSubject();
    
    // Process form
    if( $this->getRequest()->isPost() )
    {
      if( $form->isValid($this->getRequest()->getPost()) )
      {
        $isError = false;

        // Check old password
        $authAdapter = Engine_Api::_()->user()->getAuthAdapter();
        $authResult = $authAdapter
          ->setIdentity($user->email)
          ->setCredential($form->getValue('oldPassword'))
          ->authenticate();
        $authCode = $authResult->getCode();
        if( $authCode != Zend_Auth_Result::SUCCESS )
        {
          $isError = true;
          $form->getElement('oldPassword')->addError(Zend_Registry::get('Zend_Translate')->_('Old password did not match'));
        }
        
        // Check conf
        if( $form->getValue('passwordConfirm') !== $form->getValue('password') )
        {
          $isError = true;
          $form->getElement('passwordConfirm')->addError(Zend_Registry::get('Zend_Translate')->_('Passwords did not match'));
        }

        if( !$isError && !$form->isErrors() )
        {
          $user->setFromArray($form->getValues());
          $user->save();
          $form->addNotice(Zend_Registry::get('Zend_Translate')->_('Settings were successfully saved.'));
        }
      }
    }

    // Init form
    else
    {
      $form->populate($user->toArray());
    }
  }

  public function networkAction()
  {
    $this->view->navigation = $navigation = $this->_helper->api()
      ->getApi('menus', 'core')
      ->getNavigation('user_settings');

    $viewer = $this->_helper->api()->user()->getViewer();
    
    $this->view->networks = Engine_Api::_()->getDbtable('membership', 'network')->getMembershipsOf($viewer);
    $this->view->form = $form = new User_Form_Settings_Network();

    if( !$this->getRequest()->isPost() ) {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    // Process
    $viewer = Engine_Api::_()->user()->getViewer();
    
    if( $form->getValue('join_id') ) {
      $network = Engine_Api::_()->getItem('network', $form->getValue('join_id'));
      if( null === $network ) {
        $form->addError(Zend_Registry::get('Zend_Translate')->_('Network not found'));
      } else if( $network->assignment != 0 ) {
        $form->addError(Zend_Registry::get('Zend_Translate')->_('Network not found'));
      } else {
        $network->membership()->addMember($viewer)
          ->setUserApproved($viewer)
          ->setResourceApproved($viewer);
      }
    } else if( $form->getValue('leave_id') ) {
      $network = Engine_Api::_()->getItem('network', $form->getValue('leave_id'));
      if( null === $network ) {
        $form->addError(Zend_Registry::get('Zend_Translate')->_('Network not found'));
      } else if( $network->assignment != 0 ) {
        $form->addError(Zend_Registry::get('Zend_Translate')->_('Network not found'));
      } else {
        $network->membership()->removeMember($viewer);
      }
    }

    $this->_helper->redirector->gotoRoute(array());
  }
  
  public function deleteAction()
  {
    $user = $this->_helper->api()->core()->getSubject();
    if( !$this->_helper->requireAuth()->setAuthParams($user, null, 'delete')->isValid() ) return;
    $this->view->isLastSuperAdmin   = false;
    if (1 === count(Engine_Api::_()->user()->getSuperAdmins()) && 1 === $user->level_id)
      $this->view->isLastSuperAdmin = true;
    

    /*
    if( !Engine_Api::_()->authorization()->isAllowed('user', $user, 'block') ) {
      
    }
     * 
     */
    
    $this->view->form = $form = new User_Form_Settings_Delete();
    
    // Special auth case

    if( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) )
    {
      $db = $this->_helper->api()->getDbtable('users', 'user')->getAdapter();
      $db->beginTransaction();

      try
      {
        $user->delete();
        $db->commit();
      }

      catch( Exception $e )
      {
        $db->rollBack();
        throw $e;
      }

      $this->_helper->api()->user()->setViewer(null);
      return $this->_helper->redirector->gotoRoute(array(), 'core_home');
      // @todo
    }
  }



  /* Utility */

  protected $_navigation;
  
  public function getNavigation()
  {
    if( is_null($this->_navigation) ) {
      $this->_navigation = new Zend_Navigation();
      $this->_navigation->addPages(array(
        array(
          'label'      => 'General',
          'route'      => 'user_extended',
          'action'     => 'general',
          'controller' => 'settings',
          'module'     => 'user'
        ),
        array(
          'label'      => 'Privacy',
          'route'      => 'user_extended',
          'action'     => 'privacy',
          'controller' => 'settings',
          'module'     => 'user'
        ),
        array(
          'label'      => 'Change Password',
          'route'      => 'user_extended',
          'action'     => 'password',
          'controller' => 'settings',
          'module'     => 'user'
        ),
        /* @todo re-enable after preview
        array(
          'label'      => 'Delete Account',
          'route'      => 'user_extended',
          'action'     => 'delete',
          'controller' => 'settings',
          'module'     => 'user'
        ),*/
      ));
    }
    return $this->_navigation;
  }

}