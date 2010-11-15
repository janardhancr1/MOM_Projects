<?php

class Lifestream_Widget_UserhomeStreamController extends Engine_Content_Widget_Abstract
{
  
  
  public function indexAction()
  {
    
    if(!Semods_Utils::isUser()) {
      return false;
    }

    $viewer = Engine_Api::_()->user()->getViewer();
      
    $only_check_if_cached = $this->_getParam('only_check_if_cached',true);

    $wall_via_ajax = $this->_getParam('ajax',0);
       
    if($wall_via_ajax) {
      $only_check_if_cached = false;
    }
    
    $page = $this->_getParam('page',1);
    $refresh = $this->_getParam('refresh',0);

    $hide_pager = $socialstream_refresh = $this->_getParam('socialstream_refresh',0);
    
    $stream_service = Engine_Api::_()->getApi('core','lifestream');    
    $socialdna_service = Engine_Api::_()->getApi('core','socialdna');
    
    $services = $socialdna_service->getUserServices(Semods_Utils::getUserId());
    foreach($services as $service_key => $service) {
      if($service['openidservice_can_stream'] == 0) {
        unset($services[$service_key]);
      }
    }
    
    $enabled_services = $socialdna_service->getServices(false,true);
    foreach($enabled_services as $service_key => $service) {
      if($service['openidservice_can_stream'] == 0) {
        unset($enabled_services[$service_key]);
      }
    }
    
    $result = $stream_service->getPosts($only_check_if_cached, $page, $refresh);
    
    $service_connected = (count($services) > 0);
    
    $user_avatar = $this->view->itemPhoto($viewer, 'thumb.icon');
    
    $this->view->newsfeed = $result['posts'];
    $this->view->permissions_required   = $result['permissions_required'];
    $this->view->service_connected      = $service_connected;
    $this->view->wait_for_data          = $result['wait_for_data'];
    $this->view->wall_via_ajax          = $wall_via_ajax;
    $this->view->page                   = $page;
    $this->view->openid_services        = $services;
    $this->view->enabled_openid_services = $enabled_services;
    $this->view->hide_pager             = $hide_pager;
    $this->view->user_avatar            = $user_avatar;

  }

  public function getCacheKey()
  {
    return false;
  }
}