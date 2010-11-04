<?php
class Socialdna_FacebookController extends Core_Controller_Action_Standard
{
  public function indexAction()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    
    $viewer = Engine_Api::_()->user()->getViewer();
    
    // requires user
    $this->_helper->requireUser()->isValid();


    $this->view->navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_main', array(), 'socialdna_facebook');


    $request = $this->getRequest();

    $openid_service = 'facebook';
    $task = $request->get('task');

    $service = Engine_Api::_()->getApi('core', 'socialdna');

    if($task == 'disconnect') {

      $service->unlinkUserFromOpenid( Semods_Utils::getUserId(), 1 /* facebook */ );        
      return $this->_helper->redirector->gotoRoute(array(), 'socialdna_facebook');
      
    }
    
    $linked_friends = array();
    $unlinked_friends = array();
    $linked_friends_stats = array();

    // check if account linked
    $service_connected = $service->isUserConnected(null,$openid_service);
    
    if($service_connected) {

      $facebook_service = Engine_Api::_()->getApi('facebook', 'socialdna');

      $linked_friends_stats = $facebook_service->getLinkedFriendsStats();
      
      $linked_friends = $facebook_service->getLinkedFriends(0, 25);
      
      // out of sync data
      if(count($linked_friends) == 0) {
        $linked_friends_stats['connected_friends']= 0;
        $linked_friends_stats['unconnected_friends']= 0;
      }
      $unlinked_friends = $facebook_service->getUnlinkedFriends(25);

    }
    
    $this->view->linked_friends = $linked_friends;
    $this->view->unlinked_friends = $unlinked_friends;
    $this->view->linked_friends_stats = $linked_friends_stats;
    $this->view->service_connected = $service_connected;
    
    $this->view->openid_facebook_landingpage = !$service_connected ? '' : $this->view->url( array('openidservice' => 'facebook', 'next' => 'socialdnafacebook'), 'socialdna_login' );
    
  }



  public function inviteAction()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    
    $viewer = Engine_Api::_()->user()->getViewer();
    
    $this->_helper->requireUser()->isValid();

    $this->view->navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_main', array(), 'socialdna_facebookinvite');

    $request = $this->getRequest();

    $openid_service = 'facebook';
    $task = $request->get('task');

    $service = Engine_Api::_()->getApi('core', 'socialdna');



    // TBD: if not connected -> redirect / connect
    $justinvited = $request->get('justinvited',0);
    $ids = $request->get('ids');
    
    if($justinvited == 1) {
      
      // if no id's posted --> skip
      if(!is_array($ids) || empty($ids)) {        
        return $this->_helper->redirector->gotoRoute(array('action' => 'home'), 'user_general');
      } else {
        
        // check it's post just 2bsure
        if($request->isPost() && is_array($ids) && (count($ids) > 0)) {
          Engine_Hooks_Dispatcher::_()->callEvent('onFriendsinviterStats', array('user'  => $viewer, 'invites_count'  => count($ids)));
        }
        
        // @tbd - message "invited"
        return $this->_helper->redirector->gotoRoute(array('justinvited' => 2), 'socialdna_facebookinvite');
      }
    
    }
    
    $openidconnect_facebook_invitemessage = Engine_Api::_()->getDbTable('settings','socialdna')->getSetting('socialdna.facebook_invitemessage','');
    $openidconnect_feed_public_site_name = Semods_Utils::getSetting('core_general_site_title', $this->view->translate('_SITE_TITLE'));
    $openidconnect_facebook_inviteactiontext = Semods_Utils::getSetting('socialdna.facebook_inviteactiontext','');

   
    
    $openid_invite_facebook_action = "http://{$_SERVER['HTTP_HOST']}" . $this->view->url(array('justinvited' => 1), 'socialdna_facebookinvite') . '?justinvited=1';
    $openid_invite_facebook_type = '';
    
    $openid_invite_facebook_max = 100;

    $invite_url     = "http://{$_SERVER['HTTP_HOST']}"
                    . Zend_Controller_Front::getInstance()->getRouter()->assemble(array(
                          'module'     => 'core',
                          'controller' => 'signup',
                          ), 'default') . '?ref=' . $viewer->getIdentity();
    
    $invitation_message = str_ireplace( array('[full_name]',
                                              '[site_name]',
                                              '[signup_link]'),

                                       array($viewer->getTitle(),
                                             $openidconnect_feed_public_site_name,
                                             $invite_url
                                            ),
                                      $openidconnect_facebook_invitemessage
                                     );
    
    // "type" param must be not empty, otherwise the invitation control breaks
    if(empty($openidconnect_feed_public_site_name)) {
      $openidconnect_feed_public_site_name = $_SERVER['HTTP_HOST'];
    }
    
    $this->view->openidconnect_facebook_invitemessage    = $invitation_message;
    $this->view->openidconnect_feed_public_site_name     = $openidconnect_feed_public_site_name;
    $this->view->openidconnect_facebook_inviteactiontext = $openidconnect_facebook_inviteactiontext;
    $this->view->justinvited                             = $justinvited;

    $this->view->openid_invite_facebook_action           = $openid_invite_facebook_action;
    $this->view->openid_invite_facebook_type             = $openidconnect_feed_public_site_name;
    $this->view->openid_invite_facebook_content          = $invitation_message;
    $this->view->openid_invite_facebook_max              = $openid_invite_facebook_max;
    $this->view->openid_invite_facebook_actiontext       = $openidconnect_facebook_inviteactiontext;
    
    $this->view->openid_facebook_landingpage             = $this->view->url(array('openidservice' => 'facebook', 'next' => 'socialdna_facebookinvite'), 'socialdna_login' );    
    

  }



  public function settingsAction() {

    $this->_helper->requireUser()->isValid();

    $this->view->navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_main', array(), 'socialdna_facebooksettings');

    $settings = Engine_Api::_()->getApi('settings', 'core');
    $request = $this->getRequest();
    $service = Engine_Api::_()->getApi('core', 'socialdna');
    $feed_service = Engine_Api::_()->getApi('feed', 'socialdna');
    
    $this->view->form = $form = new Socialdna_Form_Settings_Facebook();


    if( $this->getRequest()->isPost() ) {

      if( $form->isValid($this->getRequest()->getPost()) ) {

        $openidconnect_autologin = (int)$form->getValue('openidconnect_autologin');
      
        $service->updateOpenidUserSettings(Semods_Utils::getUserId(), array('autologin' => $openidconnect_autologin) );

        // Send success message
        $this->view->status = true;
        $this->view->message = Zend_Registry::get('Zend_Translate')->_('Settings saved.');  // facebook_settings_successfully_updated
        $form->addNotice(Zend_Registry::get('Zend_Translate')->_('Settings were successfully saved.'));
        
      }
      else
      {
        $this->view->status = false;
        $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid data');
        return;
      }

    } else {

      $user_settings = $service->getOpenidUserSettings(Semods_Utils::getUserId());

      $form->openidconnect_autologin->setValue( Semods_Utils::g($user_settings,'autologin',0) );
      
    }

  }
  

  public function friendsAction() {

    $this->_helper->requireUser()->isValid();


    $this->view->navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_main', array(), 'socialdna_facebookfriends');



    $viewer = Engine_Api::_()->user()->getViewer();
    $table = Engine_Api::_()->getItemTable('user');
    $select = $this->_helper->api()->user()->getViewer()->membership()->getMembersObjectSelect();


    // Get search params
    $page = (int)  $this->_getParam('page', 1);
    $ajax = (bool) $this->_getParam('ajax', false);
    $options = array();

    // Get table info
    $userTableName = $table->info('name');

    $searchTable = Engine_Api::_()->fields()->getTable('user', 'search');
    $searchTableName = $searchTable->info('name');

    $profile_type = ''; //@$options['profile_type'];
    $displayname = ''; //@$options['displayname'];

    $select
      ->joinLeft($searchTableName, "`{$searchTableName}`.`item_id` = `{$userTableName}`.`user_id`", null)
      ->where("{$userTableName}.search = ?", 1)
      ->order("{$userTableName}.displayname ASC");


    /*** <FACEBOOK FRIENDS> ***/

    $facebook_service_id = 1;

    $subselect_table  = Engine_Api::_()->getDbTable('users', 'socialdna');

    $subselect = $subselect_table->select()
                  ->from($subselect_table->info('name'), 'openid_user_id')
                  ->where('openid_service_id = ?', $facebook_service_id);

    $select->where("{$userTableName}.user_id IN ({$subselect->__toString()})" );
    

    /*** </FACEBOOK FRIENDS> ***/


    // Build search part of query
    $searchParts = Engine_Api::_()->fields()->getSearchQuery('user', $options);
    foreach( $searchParts as $k => $v ) {
      $select->where("`{$searchTableName}`.{$k}", $v);
    }

    // Build paginator
    $paginator = Zend_Paginator::factory($select);
    $paginator->setItemCountPerPage(10);
    $paginator->setCurrentPageNumber($page);
    
    $this->view->page = $page;
    $this->view->ajax = $ajax;
    $this->view->users = $paginator;
    $this->view->totalUsers = $paginator->getTotalItemCount();
    $this->view->userCount = $paginator->getCurrentItemCount();    

    if( $this->_getParam('ajax') ) {
      $this->renderScript('_browseUsers.tpl');
    }
    
  }
  
}