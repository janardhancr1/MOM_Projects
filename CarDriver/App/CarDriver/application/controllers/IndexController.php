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
         
         $conn = new Application_Form_MainForm();
         $db = $conn->getDbConnection();
         
         $select = $db->select()
             ->from('rt_results_main');
        $result = Zend_Paginator::factory($db->query($select)->fetchAll());
        $this->view->paginator = $result;
   		$this->view->paginator->setItemCountPerPage(25);
        $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );
       
    }
    


}

