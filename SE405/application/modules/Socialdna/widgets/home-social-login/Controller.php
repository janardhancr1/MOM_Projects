<?php

class Socialdna_Widget_HomeSocialLoginController extends Engine_Content_Widget_Abstract
{

  // debug
  var $openid_layout;


  public function indexAction()
  {
    
    $this->openid_layout = Semods_Utils::getSetting('socialdna_openidconnect_iconstyle','');
    
    // DEBUG - DEMO
    //$this->openid_layout = rand(10,15);
    
    /* <user.widgets.login-or-signup> */
    
    // Do not show if logged in
    if( Engine_Api::_()->user()->getViewer()->getIdentity() )
    {
      $this->setNoRender();
      return;
    }
    
    // Display form
    $form = $this->view->form = new User_Form_Login();;
    $form->setTitle(null)->setDescription(null);
    $form->removeElement('forgot');
    $form->removeElement('facebook');


    /* </user.widgets.login-or-signup> */











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
    
    //$openid_max_unfold = Semods_Utils::getSetting('socialdna.openidconnect_maxicons',0);
    $openid_max_unfold = 0;
    
    $openid_services_more = array();
    //if($openid_max_unfold != 0) {
    //  $openid_services_more = array_slice( $openid_services, $openid_max_unfold -1 );
    //  $openid_services = array_slice( $openid_services, 0, $openid_max_unfold - 1);
    //}
    
    
    // DEBUG 4 DEMO
    //if($this->openid_layout == 13) {
    //  $openid_services = array_slice($openid_services,0,11);
    //} elseif($this->openid_layout == 14) {
    //  $openid_services = array_slice($openid_services,0,14);
    //} elseif($this->openid_layout == 15) {
    //  $openid_services = array_slice($openid_services,0,32);
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
    //$this->getElement()->removeDecorator('Container');
    
  }

  public function getCacheKey()
  {
    return false;
  }
}