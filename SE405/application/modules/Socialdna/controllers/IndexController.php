<?php

class Socialdna_IndexController extends Core_Controller_Action_Standard
{

  public function init()
  {
    $ajaxContext = $this->_helper->getHelper('AjaxContext');
    $ajaxContext
      ->addActionContext('connect', 'json')
      ->addActionContext('autologin', 'json')

      ->addActionContext('publishfeedstory', 'json')
      ->addActionContext('clearstory', 'json')
      ->addActionContext('storynopublish', 'json')
      ->addActionContext('storyautopublish', 'json')
      ->addActionContext('composefeedstory', 'json')
      ->addActionContext('sendmessage', 'json')
      ->addActionContext('updatestatus', 'json')
      ->addActionContext('getfriends', 'json')
      ->addActionContext('suppressconnect', 'json')
      ->addActionContext('getalbums', 'json')
      ->initContext();
  }

  
  public function indexAction()
  {

    $this->_helper->requireUser->isValid();
    
    $api = Engine_Api::_()->getApi('core', 'socialdna');
    $settings = Engine_Api::_()->getApi('settings', 'core');

    $this->view->navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_main', array(), 'socialdna_main');

    $task = $this->getRequest()->get('task');
    $openid_service = $this->getRequest()->get('openidservice');

    if(($task == 'disconnect') && ($openid_service != '')) {

      $api->unlinkUserFromOpenid( Semods_Utils::getUserId(), $openid_service );
      $session = new Zend_Session_Namespace('Socialdna');
      $session->openidconnect_user_id = null;

      return $this->_helper->redirector->gotoRoute(array(), 'socialdna');
      
    }

    $openidconnect_user_services = $api->getUserServices(Semods_Utils::getUserId());
    $openid_services = $api->getServices(false, true);
    $openid_servicesx = $api->getServices(false, true);

    $this->view->openid_services = $openid_services;
    $this->view->openid_servicesx = $openid_servicesx;
    $this->view->openidconnect_user_services = $openidconnect_user_services;

  }
  



  public function settingsAction()
  {
    

    $this->_helper->requireUser->isValid();
    
    $api = Engine_Api::_()->getApi('core', 'socialdna');
    $settings = Engine_Api::_()->getApi('settings', 'core');

    $this->view->navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_main', array(), 'socialdna_settings');

    $task = $this->getRequest()->get('task');
    $openid_service = $this->getRequest()->get('openidservice');



    // Load feed stories
    if(Engine_Api::_()->getDbTable('modules','core')->hasModule('socialdnapublisher')) {

      $feedApi = Engine_Api::_()->getApi('feed', 'socialdnapublisher');
      $feed_actions = $feedApi->loadFeedActions('facebook',true);

    } else {
      
      $feed_actions = array();
      
    }


      


    if($task == 'dosave') {

      if(Engine_Api::_()->getDbTable('modules','core')->hasModule('socialdnapublisher')) {

      $actiontype_disallowed = array();

      $feedstory = $this->getRequest()->get('feedstory',array());
      $feedstory = !empty($feedstory) ? $feedstory : array();
      $feedstoryauto = $this->getRequest()->get('feedstoryauto',array());
      $feedstoryauto = !empty($feedstoryauto) ? $feedstoryauto : array();

      $openidconnect_autostatus = (int)$this->getRequest()->get('openidconnect_autostatus',0);

      $feedstory_nopublish = array();
      $feedstory_auto = array();
      
      if($openidconnect_autostatus == 1) {
        $feedstory_auto[] = 'status';
      }

      if($openidconnect_autostatus == 2) {
        $feedstory_nopublish[] = 'status';
      }

      foreach($feed_actions as $feed_action) {

        if(!isset($feedstory[$feed_action['feedstory_id']]) || $feedstory[$feed_action['feedstory_id']] == 0) {
          $feedstory_nopublish[] = $feed_action['feedstory_type'];
        }

        if(!isset($feedstoryauto[$feed_action['feedstory_id']]) || $feedstoryauto[$feed_action['feedstory_id']] == 0) {
          $feedstory_auto[] = $feed_action['feedstory_type'];
        }

      }

      $feedstory_nopublish = implode(',',$feedstory_nopublish);
      $feedstory_auto = implode(',',$feedstory_auto);
      
      $api->updateOpenidUserSettings(Semods_Utils::getUserId(), array('publishfeeds'      => $feedstory_nopublish,
                                                                      'autopublishfeeds'  => $feedstory_auto,
                                                                      'autostatus'        => $openidconnect_autostatus,
                                                                        )
                                       );
        
      }


      $openidconnect_autologin = (int)$this->getRequest()->get('openidconnect_autologin');


      $api->updateOpenidUserSettings(Semods_Utils::getUserId(), array('autologin'         => $openidconnect_autologin
                                                                      )
                                     );


      return $this->_helper->redirector->gotoRoute(array('success' => '1'), 'socialdna_settings');

    }



    $user_settings = $api->getOpenidUserSettings(Semods_Utils::getUserId());

    $user_feedstories = (isset($user_settings['publishfeeds']) && !empty($user_settings['publishfeeds'])) ? explode(',', $user_settings['publishfeeds']) : array();
    $user_feedstoriesauto = (isset($user_settings['autopublishfeeds']) && !empty($user_settings['autopublishfeeds'])) ? explode(',', $user_settings['autopublishfeeds']) : array();

    $openidconnect_facebook_feed_stories = array();

    foreach($feed_actions as $feed_action) {

      $feedstory_selected = 1;
      if(in_array($feed_action['feedstory_type'], $user_feedstories)) {
        $feedstory_selected = 0;
      }
      $feedstory_auto = 1;
      if(in_array($feed_action['feedstory_type'], $user_feedstoriesauto)) {
        $feedstory_auto = 0;
      }

      $feedstory_desc = $feed_action['feedstory_desc'];

      $openidconnect_facebook_feed_stories[] = array( 'feedstory_id'        => $feed_action['feedstory_id'],
                                                      'feedstory_selected'  => $feedstory_selected,
                                                      'feedstory_desc'      => $feedstory_desc,
                                                      'feedstory_auto'      => $feedstory_auto,
                                                      'feedstory_publishprompt' => $feed_action['feedstory_publishprompt'],
                                                      'feedstory_icon'      => $feed_action['feedstory_icon'],
                                                    );
    }


    $openidconnect_autostatus = Semods_Utils::g($user_settings, 'autostatus', Semods_Utils::getSetting('socialdna.openidconnect_autostatus',0) );

    
    $this->view->openidconnect_autologin = Semods_Utils::g($user_settings,'autologin',0);
    $this->view->openidconnect_facebook_feed_stories = $openidconnect_facebook_feed_stories;
    $this->view->openidconnect_autostatus = $openidconnect_autostatus;
    $this->view->success = (int)$this->getRequest()->get('success');

  }
  


  public function friendsAction() {
    
    
    
  }
  
  
  
  
  









  /*** AJAX ***/

  public function connectAction() {

    $response = array('status'    => 0,
                     );

    $this->_helper->requireUser->isValid();
    
    $openid_service = $this->_getParam('openidservice','');
    $openid_session = $this->_getParam('openidsession','');

    $status = 0;
    $err_msg = '';
    
    $session = new Zend_Session_Namespace('Socialdna');
    $session->openid_imported_fields = null;

    $service = Engine_Api::_()->getApi('core', 'socialdna');
    $translator = Zend_Registry::get('Zend_Translate');

    // API
    if($openid_service == '') {
      $service->getOpenidapi($openid_session);
      $openid_service = $service->openid_service_id;
    }

    $openid_service_info = $service->getService($openid_service);

    // no service or disabled
    if(empty($openid_service_info)) {

      $status = 1;
      $err_msg = $translator->translate('socialdna_connect_invalid_service');

    } else {

      $api = $service->getOpenidapi($openid_session, $openid_service);

      $openid_user_id = $service->getOpenidUserId(Semods_Utils::getUserId(), $openid_service);
      
      $user_id = $service->getUserIdFromService($service->openid_user_id, $openid_service);
      
      //if(($openid_user_id == 0) || ($openid_user_id != $api->getFieldValue('user_id'))) {
      if(($openid_user_id != 0) && ($openid_user_id != $service->openid_user_id)) {

        $status = 1;
        $err_msg = $translator->translate('socialdna_connect_account_linked') . $openid_service;

      } else if(($user_id != 0) && ($user_id != Semods_Utils::getUserId())) {

        $status = 1;
        $err_msg = $translator->translate('socialdna_connect_account_linked_another');
        
      } else if($openid_user_id == 0) {

        $service->linkUserToOpenid(Semods_Utils::getUserId());
        $service->updateSession($openid_session, $openid_service, Semods_Utils::getUserId());
        
      } else {  // $openid_user_id == $user_id

        $service->updateSession($openid_session, $openid_service, Semods_Utils::getUserId());
        
      }
      
    }
    

    $response = array('status'  => $status,
                      'err_msg' => $err_msg,
                      'service' => $openid_service_info['openidservice_name']
                      );


    foreach($response as $key => $val) {
      $this->view->$key = $val;
    }
    
  }



  public function autologinAction($task = '') {
    
    // 1: user checked "autologin me"
    // 0: prompt
    // other: nothing

    $status = 1;
    $autologin = 2;

    $session = new Zend_Session_Namespace('Socialdna');
    $session->openid_imported_fields = null;

    $openidconnect_suppress_autologin = isset($session->openidconnect_suppress_autologin) ? $session->openidconnect_suppress_autologin : false;
    
    if(!$openidconnect_suppress_autologin) {
      $openid_service = $this->_getParam('openidservice','api');

      $service = Engine_Api::_()->getApi('core', 'socialdna');

      list($logged_in, $user) = $service->login_openid('',$openid_service, false);
      
      // not important if enabled or verified
      if($logged_in) {
                
        $user_id = $user['openid_user_id'];
    
        if($task == 'autologinnexttime') {
          $service->setAutoLogin($user_id, 1);
        }
    
        if($task == 'autologinsuppress') {
          
          $session->openidconnect_suppress_autologin = true;
          
          $autologinremember = (int)$this->_getParam('autologinremember',0);
          if($autologinremember) {
            $service->setAutoLogin($user_id, 2);
          }
        }
        
        $status = 0;
        $autologin = $service->getAutoLogin($user_id);
    
      }
    }



    
    $response = array('status' => '0',
                      'autologin' => $autologin
                      );


    foreach($response as $key => $val) {
      $this->view->$key = $val;
    }
    
  }
  

  function autologinnexttimeAction() {
    $this->autologinAction('autologinnexttime');
  }

  function autologinsuppressAction() {
    $this->autologinAction('autologinsuppress');
  }






  function storynopublishAction() {
    
    $actiontype_name = $this->_getParam('story_type');
    $openid_service = 'facebook';
    
    if(Semods_Utils::isUser()) {

      $feed_api = Engine_Api::_()->getApi('feed', 'socialdnapublisher');
      $feed_actions = $feed_api->loadFeedActions($openid_service, true);
      
      $service = Engine_Api::_()->getApi('core', 'socialdna');

      $user_settings = $service->getOpenidUserSettings(Semods_Utils::getUserId());      
      $user_feedstories = (isset($user_settings['publishfeeds']) && !empty($user_settings['publishfeeds'])) ? explode(',', $user_settings['publishfeeds']) : array();
            
      // see if user already opted out of this story      
      if(!in_array($actiontype_name, $user_feedstories) && array_key_exists($actiontype_name, $feed_actions)) {
    
        $user_feedstories[] = $actiontype_name;
        
        $user_feedstories = implode(',',$user_feedstories);

        $service->updateOpenidUserSettings(Semods_Utils::getUserId(), array('publishfeeds'  => $user_feedstories) );
    
      }

    }

  }
    


  function storyautopublishAction() {
    
    $actiontype_name = $this->_getParam('story_type');
    $openid_service = 'facebook';
    
    if(Semods_Utils::isUser()) {

      $feed_api = Engine_Api::_()->getApi('feed', 'socialdnapublisher');
      $feed_actions = $feed_api->loadFeedActions($openid_service, true);
      
      $service = Engine_Api::_()->getApi('core', 'socialdna');
      $user_settings = $service->getOpenidUserSettings(Semods_Utils::getUserId());      
      $user_feedstories = (isset($user_settings['autopublishfeeds']) && !empty($user_settings['autopublishfeeds'])) ? explode(',', $user_settings['autopublishfeeds']) : array();
            
      if(!in_array($actiontype_name, $user_feedstories) && array_key_exists($actiontype_name, $feed_actions)) {
    
        $user_feedstories[] = $actiontype_name;
        
        $user_feedstories = implode(',',$user_feedstories);

        $service->updateOpenidUserSettings(Semods_Utils::getUserId(), array('autopublishfeeds'  => $user_feedstories) );
    
      }

    }

  }


  function composefeedstoryAction() {

    $actiontype_name = $this->_getParam('story_type');
    $story_params = $this->_getParam('story_params');
  
    $story_params = html_entity_decode( $story_params, ENT_QUOTES );
    $story_params = Zend_Json::decode($story_params);
    $story_params = (array)$story_params;

    $feed_api = Engine_Api::_()->getApi('feed', 'socialdnapublisher');
    $openidconnect_facebook_feed_actions = $feed_api->loadFeedActions();
    
    // current user
    $user = Semods_Utils::getUser();
  
    $openidconnect_feed_story = array();
    
    $status = 1;
    
    $feed_story = false;

    if(array_key_exists($actiontype_name,$openidconnect_facebook_feed_actions)) {
    
      $function_name = Semods_Utils::g($feed_story_template,'feedstory_compiler','');
  
      if($function_name == '') {
        $function_name = 'openidconnect_feedstory_compose_'.$actiontype_name;
      }
  
      $feed_story_template = $openidconnect_facebook_feed_actions[$actiontype_name];
      
      if(function_exists($function_name)) {

        $feed_story = call_user_func_array($function_name, $story_params);
        
      } else {
        
        // try plugin -> event
        
      }
  
      if($feed_story !== false) {

        $feed_api->compileFeedStory($feed_story, $feed_story_template, $user);
        
        unset($feed_story['vars']);
        
        $openidconnect_feed_story = array(
                                          'user_message'        => Semods_Utils::g($feed_story,'user_message', Semods_Utils::g($feed_story_template,'feedstory_usermessage','') ),
                                          'user_prompt'         => Semods_Utils::g($feed_story,'user_prompt', Semods_Utils::g($feed_story_template,'feedstory_userprompt','') ),
  
                                          'data'                => $feed_story,
                                          'publish_using'       => Semods_Utils::g($feed_story,'publish_using', Semods_Utils::g($feed_story_template,'feedstory_publishusing','feed') ),
  
                                          'story_type'          => $actiontype_name,
                                          );
  
        $status = 0;
        
      }
      
      
    }

    
    $response = array('status' => $status,
                      'openidconnect_feed_story' => $openidconnect_feed_story
                      );
    
    foreach($response as $key => $val) {
      $this->view->$key = $val;
    }

  }



  function publishfeedstoryAction() {

    $actiontype_name = $this->_getParam('story_type');
    $story_params = $this->_getParam('story_params');

    $user_message = $this->_getParam('user_message');
    $update_session = (int)$this->_getParam('update_session',0);
  
    $services = $this->_getParam('services','');
  
    $story_params = html_entity_decode( $story_params, ENT_QUOTES );
    $story_params = Zend_Json::decode($story_params);
    $story_params = (array)$story_params;

    $feed_api = Engine_Api::_()->getApi('feed', 'socialdnapublisher');
    $service = Engine_Api::_()->getApi('core', 'socialdna');
    
    $openidconnect_feed_story = $feed_api->prepareFeedStory($actiontype_name, $story_params, true);
    
    $openidconnect_feed_story['user_message'] = $user_message;
    
    $status = 0;
    
    if($openidconnect_feed_story != false) {

      if($update_session) {
        $service->updateSession('','facebook',Semods_Utils::getUserId());
      }
      
      $result = $feed_api->publishFeedStory($openidconnect_feed_story, $services);
      
      if($result === false) {

        if(($feed_api->err_code == 200) || ($feed_api->err_code == 204)) {
          $status = $feed_api->err_code;
        }

      } else {

        $feed_api->destroySessionFeedStory();      

      }        
      
    }
    
    
    $response = array('status' => $status
                      );
    
    foreach($response as $key => $val) {
      $this->view->$key = $val;
    }

    
  }

  function sendmessageAction() {

    $to = $this->_getParam('to');
    $subject = trim($this->_getParam('subject'));
    $message = trim($this->_getParam('message'));
  
    if(empty($subject) && empty($message)) {
      $response = array('status' => 0
                        );

      foreach($response as $key => $val) {
        $this->view->$key = $val;
      }
      
      return;

    }

    $service = Engine_Api::_()->getApi('core', 'socialdna');

    $api = $service->getPublisherapi(); 
    $user_id = Semods_Utils::getUserId();      


    // stats 
    $stats = array();
    $users = explode(',', $to);

    $status = 0;

    for($i = 0; $i < count($users) / 2; $i++) {
      
      $r_service_id = (int)$users[$i*2+1];

      if($service->getServiceId($r_service_id) == 0) {
        continue;
      }

      $stats[$r_service_id] = isset($stats[$r_service_id]) ? $stats[$r_service_id]+1 : 1;
      
    }
    
    foreach($stats as $service_id => $value) {
      $service->update_stats('msg', $service_id, $value);
    }

    $result = $api->send_message($user_id, $to, $message, $subject);

    if(($result === false) || (isset($result['err_code']) && ($result['err_code'] != 0))){

      if(($result['err_code'] == 200) || ($result['err_code'] == 205) || ($result['err_code'] == 100)) {
        $status = $result['err_code'];
      }

    }
    
    
    $response = array('status' => $status
                      );
    
    foreach($response as $key => $val) {
      $this->view->$key = $val;
    }
    
  }


  function updatestatusAction() {

    $reference_id = $this->_getParam('reference_id');
    $message = trim($this->_getParam('message'));
    $services = $this->_getParam('services');
  
    if(empty($message)) {
      $response = array('status' => 0
                        );

      foreach($response as $key => $val) {
        $this->view->$key = $val;
      }
      
      return;
      
    }


    $service = Engine_Api::_()->getApi('core', 'socialdna');
    $api = $service->getPublisherapi(); 
    $user_id = Semods_Utils::getUserId();      

    $result = $api->publish_status($message, $user_id, $services, $reference_id);
    $stats_type = 'status';

    $published = Semods_Utils::g($result,'published','');
    $published = explode(',',$published);
    
    if(!empty($published)) {
      foreach($published as $published_service) {
        $service->update_stats($stats_type, $published_service);
      }
    }

    
    $status = 0;
    
    $response = array('status' => $status
                      );
    
    foreach($response as $key => $val) {
      $this->view->$key = $val;
    }
    
  }


  function getfriendsAction() {

    $openid_service = $this->_getParam('openidservice');
    $page = $this->_getParam('page',0);
    $suggest = $this->_getParam('suggest','');

    $service = Engine_Api::_()->getApi('core', 'socialdna');

    $response = $service->getSocialFriends($openid_service, $page, $suggest);
    
    $friends = array();
    
    foreach($response['friends'] as $row) {

      $friends[] = array('n'  => wordwrap($row['openidfriend_name'], 15, "\n", true),
                         's'  => $row['openidfriend_service_id'],
                         't'  => $row['openidfriend_thumb'],
                         'u'  => $row['openidfriend_user_id'],
                         'st' => wordwrap($row['openidfriend_status'], 15, "\n", true),
                         'l'  => Semods_Utils::g($row,'openidfriend_link',''),
                         );
      
    }
    
    
    $status = 0;
    
    
    
    $response = array('status'          => $status,
                      'friends'         => $friends,
                      'total_friends'   => $response['total_friends'],
                      'page'            => $response['page'],
                      'page_from'       => $response['page_from'],
                      'page_to'         => $response['page_to'],
                      );
    
    foreach($response as $key => $val) {
      $this->view->$key = $val;
    }
    
    
  }

    
  function suppressconnectAction() {
    
    $session = new Zend_Session_Namespace('Socialdna');
    $session->openidconnect_suppress_connect = true;
    
  }
    
    
  function clearstoryAction() {

    $story_type = $this->_getParam('story_type','all');

    $feed_api = Engine_Api::_()->getApi('feed', 'socialdnapublisher');

    $feed_api->destroySessionFeedStory($story_type);      
    
  }


  function getalbumsAction() {

    $update_session = (int)$this->_getParam('update_session',0);

    $service = Engine_Api::_()->getApi('core', 'socialdna');
    
    if($update_session) {
      $service->updateSession('','facebook',Semods_Utils::getUserId());
    }


    $status = 0;

    if($service->shouldUpdateSocialAlbums()) {

      $result = $service->updateSocialAlbums();

      if($result === false) {

        if(($service->err_code == 200) || ($service->err_code == 204)) {
          $status = $service->err_code;
        }
        
      }        
      
    }

    $albums = array();

    if($status == 0) {

      $albums = $service->getSocialAlbums();
    
    }
    
    $response = array('status'  => $status,
                      );
    
    foreach($response as $key => $val) {
      $this->view->$key = $val;
    }
    
  }
    

  
}
