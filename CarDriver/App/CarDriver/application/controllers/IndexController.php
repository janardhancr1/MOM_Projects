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
         
         $formright = new Application_Form_SearchRight($this->_getParam('make'));
         $this->view->formright = $formright;
         
         $conn = new Application_Form_MainForm();
         $db = Zend_Db_Table::getDefaultAdapter(); 
         $select = $db->select()
             ->from('rt_results_main');
         if (($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
         	  || ($this->getRequest()->isPost() && $formright->isValid($this->getRequest()->getPost())))
          {
          	 $this->_helper->redirector->gotoRouteAndExit(array(
		        'page' => 1,
		        'id'   => $this->getRequest()->getPost('id'),
		        'year' => $this->getRequest()->getPost('year'),
		      	'make' => $this->getRequest()->getPost('make'),
          	    'model' => $this->getRequest()->getPost('model'),
		      ));
          }
         else
         {
         	$form->getElement('id')->setValue($this->_getParam('id'));
         	$formright->getElement('year')->setValue($this->_getParam('year'));
         	$formright->getElement('make')->setValue($this->_getParam('make'));
         	$formright->getElement('model')->setValue($this->_getParam('model'));
         	
         }
         if(($this->_getParam('id')))
        		$select->where('id =?', $this->_getParam('id'));
         if(($this->_getParam('year')))
        		$select->where('bg_year_id =?', $this->_getParam('year'));
         if(($this->_getParam('model')))
        		$select->where('bg_model_id =?', $this->_getParam('model'));
         if(($this->_getParam('make')))
        		$select->where('bg_make_id =?', $this->_getParam('make'));
        		
        $result = Zend_Paginator::factory($db->query($select)->fetchAll());
        $this->view->paginator = $result;
   		$this->view->paginator->setItemCountPerPage(25);
        $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );
        $this->view->paginator->setPageRange(5);
       
    }
    
    public function addAction()
    {
    	 $form = new Application_Form_Add();
    	 $this->view->form = $form;
    	
    }
    


}

