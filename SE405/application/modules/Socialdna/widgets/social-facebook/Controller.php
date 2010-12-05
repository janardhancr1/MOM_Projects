<?php

class Socialdna_Widget_SocialFacebookController extends Engine_Content_Widget_Abstract
{
  
  //var $openid_layout = 2;


  // debug
  var $openid_layout = 777;
  
  
  public function indexAction()
  {

    //$viewer = Engine_Api::_()->user()->getViewer();

    //if( !Engine_Api::_()->getDbTable('teasersettings', 'socialdna')->checkEnabled($viewer) ) {
    //  $this->setNoRender();
    //  return;
    //}
    //

    global $socialdna_social_login_title_text;
    
    $this->view->title_text = isset($socialdna_social_login_title_text) ? $socialdna_social_login_title_text : 'socialdna_signup_using';

    $openid_relay_url = Semods_Utils::getSetting('socialdna.openidconnect_rpurl','');

    $service = Engine_Api::_()->getApi('core', 'socialdna');
    
    $openid_services = $service->getServices(true,true);
    
    $facebook_service = $service->getService('facebook');
    $facebook_enabled = $facebook_service && ($facebook_service['openidservice_enabled'] == 1) && ($facebook_service['openidservice_signup'] == 1);
    
    foreach($openid_services as $key => $openid_service) {
      if($openid_service['openidservice_signup'] == 0) {
        unset($openid_services[$key]);
      }
    }
    
    // debug
    //$openid_max_unfold = Semods_Utils::getSetting('socialdna.openidconnect_maxicons',0);
    $openid_max_unfold = 0;
    
    $openid_services_more = array();
    //if($openid_max_unfold != 0) {
    //  $openid_services_more = array_slice( $openid_services, $openid_max_unfold -1 );
    //  $openid_services = array_slice( $openid_services, 0, $openid_max_unfold - 1);
    //}

    $this->view->services_per_row = (int)((count($openid_services) + (int)$facebook_enabled) / 2);

    $this->view->facebook_enabled = $facebook_enabled;
    $this->view->openid_services = $openid_services;
    $this->view->openid_relay_url = $openid_relay_url;
    $this->view->openid_layout = $this->openid_layout;
    $this->view->openid_services_more = $openid_services_more;
    $this->view->openid_icons_block_width = Semods_Utils::getSetting('socialdna.openidconnect_iconsblockwidth','260');
    $this->view->openid_icons_block_style = Semods_Utils::getSetting('socialdna.openidconnect_iconsblockstyle','');
    
    $this->view->openid_login_block_instance = 1;
    
    $this->getElement()->removeDecorator('Title');
    $this->getElement()->removeDecorator('Container');
    
  }

  public function getCacheKey()
  {
    return false;
  }
}