<?php

class Socialdna_AdminFacebookController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {
    
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_admin_main', array(), 'socialdna_admin_main_facebook');

    $this->view->form = $form = new Socialdna_Form_Admin_Facebook();

    if( $this->getRequest()->isPost()&& $form->isValid($this->getRequest()->getPost()))
    {
      $form->saveAdminSettings();
      
    }


  }


}