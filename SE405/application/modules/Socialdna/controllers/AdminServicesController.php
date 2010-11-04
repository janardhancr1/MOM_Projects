<?php

class Socialdna_AdminServicesController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {
    
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_admin_main', array(), 'socialdna_admin_main_services');


    if($this->getRequest()->isPost()) {
      
      $request = $this->getRequest();

      $setting_openidconnect_iconstyle = $request->get('setting_openidconnect_iconstyle','');
      $setting_openidconnect_autostatus = (int)$request->get('setting_openidconnect_autostatus',0);

      $is_error = 0;
      
      Semods_Utils::setSetting('socialdna_openidconnect_iconstyle',$setting_openidconnect_iconstyle);
      Semods_Utils::setSetting('openidconnect_autostatus',$setting_openidconnect_autostatus);
      


      /* SERVICES */

      $table = Engine_Api::_()->getDbTable('services','socialdna');
      
      $openid_services = $request->get('openid_services', array());
      foreach($openid_services['e'] as $service_id => $service_enabled) {
        $table->update(array('openidservice_enabled' => $service_enabled), array( "openidservice_id = ?" => $service_id));
      }

      foreach($openid_services['p'] as $service_id => $value) {
        $table->update(array('openidservice_publisher' => $value), array( "openidservice_id = ?" => $service_id));
      }

      foreach($openid_services['s'] as $service_id => $value) {
        $table->update(array('openidservice_signup' => $value), array( "openidservice_id = ?" => $service_id));
      }

      foreach($openid_services['o'] as $service_id => $value) {
        $table->update(array('openidservice_showorder' => $value), array( "openidservice_id = ?" => $service_id));
      }

      // CACHING
      Semods_Utils::removeCache('openidconnect_services_0_0');
      Semods_Utils::removeCache('openidconnect_services_0_1');
      Semods_Utils::removeCache('openidconnect_services_1_0');
      Semods_Utils::removeCache('openidconnect_services_1_1');
      Semods_Utils::removeCache('openidconnect_services_map');
        

      if ($is_error == 0) {
        // redirect to self
      }

    }



    $setting_openidconnect_maxicons = Semods_Utils::getSetting('socialdna_openidconnect_maxicons',0);
    $setting_openidconnect_iconstyle = Semods_Utils::getSetting('socialdna_openidconnect_iconstyle','');
    $setting_openidconnect_iconsblockwidth = Semods_Utils::getSetting('socialdna_openidconnect_iconsblockwidth','');
    $setting_openidconnect_iconsblockstyle = Semods_Utils::getSetting('socialdna_openidconnect_iconsblockstyle','');

    $setting_openidconnect_autostatus = Semods_Utils::getSetting('openidconnect_autostatus',0);

    $openid_services = Engine_Api::_()->getApi('core', 'socialdna')->getServices();


    $this->view->openid_services = $openid_services;
    $this->view->setting_openidconnect_maxicons = $setting_openidconnect_maxicons;
    $this->view->setting_openidconnect_iconstyle = $setting_openidconnect_iconstyle;
    $this->view->setting_openidconnect_iconsblockwidth = $setting_openidconnect_iconsblockwidth;
    $this->view->setting_openidconnect_iconsblockstyle = $setting_openidconnect_iconsblockstyle;
    $this->view->setting_openidconnect_autostatus = $setting_openidconnect_autostatus;
          
    
  }



  public function editAction()
  {

    $service_id = $this->getRequest()->get('service_id');
    
    $service = Engine_Api::_()->getApi('core', 'socialdna');

    $openid_service = $service->getService($service_id);
      
    if(!$openid_service) {
      return $this->_helper->_redirector->gotoRoute(array('module' => 'socialdna', 'controller' => 'services', 'action' => 'index'), 'admin_default', true);
    }


    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_admin_main', array(), 'socialdna_admin_main_services');

    $this->view->form = $form = new Socialdna_Form_Admin_Services_Edit();

    if($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {

      $values = $form->getValues();
      
      $api_key = $values['api_key'];
      $secret = $values['secret'];

      $api_key = preg_replace('/[^0-9a-zA-Z_\-]+/','',$api_key);
      $secret = preg_replace('/[^0-9a-zA-Z_\-]+/','',$secret);

      $is_error = 1;
      $error = '';
      
      $publisherapi = $service->getPublisherapi();
      $result = $publisherapi->set_application_settings($service_id, $api_key, $secret);
      
      if($result === false) {
        $error = $publisherapi->getErrorMessage();
      } else if ($result['success'] != 1) {
        $error = $result['err_msg'];
      } else {
        $is_error = 0;
      }
      
      if($is_error == 0) {
        
        $table = Engine_Api::_()->getDbTable('services','socialdna');

        $table->update(array('openidservice_branding_key' => $api_key,
                             'openidservice_branding_secret'  => $secret
                             ),
                       array( "openidservice_id = ?" => $service_id)
                       );

        $is_error = 0;

        // CACHING
        Semods_Utils::removeCache('openidconnect_services_0_0');
        Semods_Utils::removeCache('openidconnect_services_0_1');
        Semods_Utils::removeCache('openidconnect_services_1_0');
        Semods_Utils::removeCache('openidconnect_services_1_1');
        
        
        return $this->_helper->_redirector->gotoRoute(array('module' => 'socialdna', 'controller' => 'services', 'action' => 'index'), 'admin_default', true);
        
      } else {
        
        
        $this->view->form->addError($error);
        
      }
    
    } else {
      
      
      $form->api_key->setValue($openid_service['openidservice_branding_key']);
      $form->secret->setValue($openid_service['openidservice_branding_secret']);
      
    }

    
    $this->view->openid_service = $openid_service;
    $form->service_id->setValue($service_id);
    $form->setTitle( $this->view->translate('socialdna_admin_service_settings_title') . ' - ' . $openid_service['openidservice_displayname']);
    
  }

}