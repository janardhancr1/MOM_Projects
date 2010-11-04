<?php

class Socialdna_Widget_BootController extends Engine_Content_Widget_Abstract
{
  
  var $openid_layout = 2;
  
  
  public function indexAction()
  {


    $viewer = Engine_Api::_()->user()->getViewer();

    $service = Engine_Api::_()->getApi('core', 'socialdna');
    

    $openidconnect_facebook_api_key = Semods_Utils::getSetting('socialdna.facebook_api_key');
    $openidconnect_facebook_user_id = $service->getCurrentOpenidUserId('facebook');
    
    $openidconnect_hook_logout = Semods_Utils::getSetting('socialdna.hook_logout',1);
    $openidconnect_autologin = Semods_Utils::getSetting('socialdna.autologin',1);
    
    $openidconnect_facebookemail = Semods_Utils::getSetting('socialdna.openidconnect_facebookemail',1);
    
    $openidconnect_request_connect = false;
    

    /*** PUBLISHER ***/
    
    // services to show in publisher
    $openid_services = $service->getServices(false, true);
    $publisher_services = array();
    foreach($openid_services as $openid_service) {
      if($openid_service['openidservice_publisher'] == 1) {
        $publisher_services[] = $openid_service['openidservice_name'];
      }
    }
    
        
    /*** FEED STORY ***/
    
    // see if have feed action story queued
    if(Engine_Api::_()->getDbTable('modules','core')->hasModule('socialdnapublisher')) {
      
    $feed_service = Engine_Api::_()->getApi('feed', 'socialdnapublisher');
    $openidconnect_feed_story = $feed_service->getSessionFeedStory();
    
    } else {
      
      $openidconnect_feed_story = null;
      
    }
    
    $openidconnect_feed_story_publish = false;
    
    if(!is_null($openidconnect_feed_story)) {
      
      if(Semods_Utils::isUser()) {
    
        // check page
        $page_check = Semods_Utils::g($openidconnect_feed_story,'page_check','');

        $publish = true;


        $request = Zend_Controller_Front::getInstance()->getRequest();

        if(!empty($page_check)) {
          
          $page_check = unserialize($page_check);
          
          if(!empty($page_check) && is_array($page_check)) {
            foreach($page_check as $check) {
              if(($check['module'] == $request->getModuleName()) && ($check['controller'] == $request->getControllerName()) && ($check['action'] == $request->getActionName()) && ($check['publish'] == false)) {
                $publish = false;
                break;
              }
            }
          
          }
          
        }
        
        if($publish) {
          
          $story_params = $openidconnect_feed_story['story_params_'];
          $story_type = $openidconnect_feed_story['story_type'];
          
          $openidconnect_feed_story = $feed_service->prepareFeedStory($story_type, $story_params);

          if($openidconnect_feed_story != false) {

            $openidconnect_feed_story_publish = true;
            
          } else {

            $feed_service->destroySessionFeedStory();
            
          }
          
        }          
        
      } else {
        
        $feed_service->destroySessionFeedStory();
      }
      
    }
    
    $openidconnect_user_services = array();
    
    if($openidconnect_feed_story) {
      $openidconnect_user_services = $service->getUserServices(Semods_Utils::getUserId());
    }
    
    // at least one with "newsfeed"
    $can_publish = false;
    foreach($openidconnect_user_services as $openidconnect_user_service) {
      if($openidconnect_user_service['openidservice_can_newsfeed'] || $openidconnect_user_service['openidservice_can_status']) {
        $can_publish = true;
        break;
      }        
    }
    
    if(!$can_publish) {
      $openidconnect_feed_story_publish = false;
    }
    
    
    // @tbd: signup teaser

    $facebook_locale = Semods_Utils::getSetting('socialdna.facebook_locale','en_US');

    $user_avatar = $this->view->itemPhoto($viewer, 'thumb.icon');
    
    $openidconnect_relay_url = 'http://' . Semods_Utils::getSetting('socialdna.openidconnect_rpurl','');
    
    $this->view->openidconnect_facebook_api_key    = $openidconnect_facebook_api_key;
    $this->view->openidconnect_facebook_user_id    = $openidconnect_facebook_user_id;

    $this->view->openidconnect_feed_story_publish  = $openidconnect_feed_story_publish;
    $this->view->openidconnect_hook_logout         = (int)$openidconnect_hook_logout;
    $this->view->openidconnect_autologin           = (int)$openidconnect_autologin;
    $this->view->openidconnect_fbe                 = (int)$openidconnect_facebookemail;
    $this->view->openidconnect_request_connect     = (int)$openidconnect_request_connect;
    $this->view->openidconnect_autologin_url       = $this->view->url(array(), 'socialdna_login');
    $this->view->openidconnect_logout_url          = $this->view->url(array(), 'user_logout');
    $this->view->openidconnect_feed_story          = $openidconnect_feed_story;
    
    $this->view->openidconnect_user_services       = $openidconnect_user_services;
    $this->view->openidconnect_publisher_services  = $publisher_services;
    
    $this->view->openidconnect_relay_url           = $openidconnect_relay_url;

    $this->view->facebook_locale                   = $facebook_locale;
    $this->view->user_avatar                       = $user_avatar;

    
    
    $this->getElement()->removeDecorator('Title');
    $this->getElement()->removeDecorator('Container');
    
  }

  public function getCacheKey()
  {
    return false;
  }
}