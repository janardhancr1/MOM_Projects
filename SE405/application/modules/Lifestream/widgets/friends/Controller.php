<?php

class Lifestream_Widget_FriendsController extends Engine_Content_Widget_Abstract
{
  
  
  public function indexAction()
  {
    
    if(!Semods_Utils::isUser()) {
      return false;
    }

    $stream_service = Engine_Api::_()->getApi('core','lifestream');    
    $socialdna_service = Engine_Api::_()->getApi('core','socialdna');
    
    $services = $socialdna_service->getUserServices(Semods_Utils::getUserId());
    foreach($services as $service_key => $service) {
      if($service['openidservice_can_message'] == 0) {
        unset($services[$service_key]);
      }
    }
    
    $enabled_services = $socialdna_service->getServices(false,true);
    foreach($enabled_services as $service_key => $service) {
      if($service['openidservice_can_message'] == 0) {
        unset($enabled_services[$service_key]);
      }
    }
    
    $service_connected = (count($services) > 0);
    $this->view->service_connected      = $service_connected;
    $this->view->openid_services        = $services;
    $this->view->enabled_openid_services = $enabled_services;

  }

  public function getCacheKey()
  {
    //return true;
    return false;
  }
}