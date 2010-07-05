<?php

class Core_AdminMessageController extends Core_Controller_Action_Admin
{
  public function mailAction()
  {
    $this->view->form = $form = new Core_Form_Admin_Message_Mail();

    if( !$this->getRequest()->isPost() ) {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }
  }
}