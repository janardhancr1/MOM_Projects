<?php

class Socialdna_AdminSettingsController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {
    
    // if just installed, redirect to "Getting Started"
    if(Semods_Utils::getSetting('socialdna_welcome',0) == 0) {
      Semods_Utils::setSetting('socialdna_welcome',1);
      return $this->_helper->_redirector->gotoRoute(array('module' => 'socialdna', 'controller' => 'help', 'action' => 'index', 'show' => '0'), 'admin_default', true);
    }
    
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_admin_main', array(), 'socialdna_admin_main_settings');
    
    $settings = Engine_Api::_()->getApi('settings', 'core');

    $this->view->form = $form = new Socialdna_Form_AdminSettings();
    
    if( $this->getRequest()->isPost()&& $form->isValid($this->getRequest()->getPost()))
    {
      $form->saveAdminSettings();
      
    }
  }


}