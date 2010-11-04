<?php

class Socialdna_AdminHelpController extends Core_Controller_Action_Admin
{


  public function indexAction()
  {

    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_admin_main', array(), 'socialdna_admin_main_help');
      
    $this->view->show = $this->_getParam('show','');

  }


}