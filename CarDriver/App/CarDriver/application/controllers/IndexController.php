<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
      
    }

    public function indexAction()
    {
         $form = new Application_Form_Search();
         $this->view->form = $form;
    }
    


}

