<?php

class IndexController extends Zend_Controller_Action
{

	public $form_values;
	
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
    	 
    	 if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    	 {
    	 	$form_values = $this->view->form->getValues();
    	 	$table = new Application_Model_Form1();
    	 	
    	    require_once('Zend/Session.php');
    	 	$session1 = new Zend_Session_Namespace('form1');
    	    $session1->form1 = $form_values;
    	 
    	 	/*$db = $table->getAdapter();
    		$db->beginTransaction();
		    try
		    {
		    	  $results1 = $table->createRow();
			      $results1->setFromArray($form_values);
			      $results1->save();
			      $db->commit();
		    }
		    catch(Exception $e)
		    {
		    	$db->rollBack();
      			throw $e;
		    	
		    }*/
    	 	
    	 	$this->_redirect("index/add1/");
    	 	
    	 }
    	
    }
    
    public function add1Action()
    {
    	//require_once('Zend/Session.php');
    	 //$session = new Zend_Session_Namespace('form1');
    	
    	$form = new Application_Form_Add1();
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    	 {
    	 	$form_values = $this->view->form->getValues();
    	 	//$table = new Application_Model_Form2();
    	 	
    	 	require_once('Zend/Session.php');
    	 	$session2 = new Zend_Session_Namespace('form2');
    	 	$session2->form2 = $form_values;
    	 	/*$db = $table->getAdapter();
    		$db->beginTransaction();
		    try
		    {
		    	  $results1 = $table->createRow();
			      $results1->setFromArray($form_values);
			      $results1->save();
			      $db->commit();
		    }
		    catch(Exception $e)
		    {
		    	$db->rollBack();
      			throw $e;
		    	
		    }*/
    	 	$this->_redirect("index/add2/");
    	 	
    	 }
    	
    }
    
    public function add2Action()
    {
    	//$session2 = new Zend_Session_Namespace('form2');
    	//print_r($session2->form2);
    	//exit;
    	$form = new Application_Form_Add2();
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    	 {
    	 	$form_values = $this->view->form->getValues();
    	 	$table = new Application_Model_Form3();
    	 	
    	 	require_once('Zend/Session.php');
    	 	$session3 = new Zend_Session_Namespace('form3');
    	 	$session3->form3 = $form_values;
    	 	/*$db = $table->getAdapter();
    		$db->beginTransaction();
		    try
		    {
		    	  $results1 = $table->createRow();
			      $results1->setFromArray($form_values);
			      $results1->save();
			      $db->commit();
		    }
		    catch(Exception $e)
		    {
		    	$db->rollBack();
      			throw $e;
		    	
		    }*/
    	 	$this->_redirect("index/review/");
    	 	
    	 }
    }
    
    public function reviewAction()
    {
    	$db = Zend_Db_Table::getDefaultAdapter(); 
		
		$select = $db->select()
			->from('rt_results_main',array(new Zend_Db_Expr('max(id) as maxId')));
		$res = $db->query($select)->fetchAll();
		$id = $res[0]['maxId'] + 1;
		$this->view->id = $id;
		
		$review = new Application_Form_Review();
		$this->view->form = $review;
		if ($this->getRequest()->isPost() && $review->isValid($this->getRequest()->getPost()))
	    {
	     	$session1 = new Zend_Session_Namespace('form1');
			$session2 = new Zend_Session_Namespace('form2');
			$session3 = new Zend_Session_Namespace('form3');
			
			$form1_Values = $session1->form1;
			$form2_Values = $session2->form2;
			$form3_Values = $session3->form3;
			
			$rt_results_main = array();
			
			$review_values = $this->view->form->getValues();
			
			$rt_results_main['rt_model_year'] = $review_values['rt_model_year'];
			$rt_results_main['bg_make_id'] = $review_values['bg_make_id'];
			$rt_results_main['rt_published'] = $review_values['rt_published'];
			$rt_results_main['bg_model_id'] = $review_values['bg_model_id'];
			$rt_results_main['rt_issue'] = $review_values['rt_issue'];
			$rt_results_main['bg_submodel_id'] = $review_values['bg_submodel_id'];
			$rt_results_main['rt_issue_year'] = $review_values['rt_issue_year'];
			$rt_results_main['bg_year_id 	'] = $review_values['bg_year_id 	'];
			$rt_results_main['rt_percent_on_rear'] = $review_values['rt_percent_on_rear'];
			$rt_results_main['bg_controlled_make_id'] = $review_values['bg_controlled_make_id'];
			$rt_results_main['rt_percent_on_front'] = $review_values['rt_percent_on_front'];
			$rt_results_main['bg_controlled_model_id'] = $review_values['bg_controlled_model_id'];
			$rt_results_main['rt_60_mph'] = $review_values['rt_60_mph'];
			$rt_results_main['rt_original_table_id'] = $review_values['rt_original_table_id'];
			$rt_results_main['rt_70_mph_braking'] = $review_values['rt_70_mph_braking'];
			$rt_results_main['rt_controlled_body'] = $review_values['rt_controlled_body'];
			$rt_results_main['rt_top_speed'] = $review_values['rt_top_speed'];
			$rt_results_main['rt_controlled_engine'] = $review_values['rt_controlled_engine'];
			$rt_results_main['rt_top_speed_notes'] = $review_values['rt_top_speed_notes'];
			$rt_results_main['rt_controlled_fuel'] = $review_values['rt_controlled_fuel'];
			$rt_results_main['rt_controlled_make'] = $review_values['rt_controlled_make'];
			$rt_results_main['rt_base_price_notes'] = $review_values['rt_base_price_notes'];
			$rt_results_main['rt_controlled_sort'] = $review_values['rt_controlled_sort'];
			$rt_results_main['rt_speed_qtr_mile_speed_trap'] = $review_values['rt_speed_qtr_mile_speed_trap'];
			$rt_results_main['rt_controlled_transmission'] = $review_values['rt_controlled_transmission'];
			$rt_results_main['rt_quarter_time'] = $review_values['rt_quarter_time'];
			$rt_results_main['rt_controlled_drive'] = $review_values['rt_controlled_drive'];
			$rt_results_main['rt_doors'] = $review_values['rt_doors'];
			$rt_results_main['rt_controlled_ts_limit'] = $review_values['rt_controlled_ts_limit'];
			$rt_results_main['rt_cd_observed_fe'] = $review_values['rt_cd_observed_fe'];
			$rt_results_main['rt_controlled_turbo_superchg'] = $review_values['rt_controlled_turbo_superchg'];
			$rt_results_main['rt_no_cyl'] = $review_values['rt_no_cyl'];
			$rt_results_main['rt_controlled_type'] = $review_values['rt_controlled_type'];
			$rt_results_main['rt_peak_hp'] = $review_values['rt_peak_hp'];
			$rt_results_main['rt_model'] = $review_values['rt_model'];
			$rt_results_main['rt_peak_hp_notes'] = $review_values['rt_peak_hp_notes'];
			$rt_results_main['rt_power_to_weight'] = $review_values['rt_power_to_weight'];
			$rt_results_main['rt_price_as_tested'] = $review_values['rt_price_as_tested'];
			$rt_results_main['rt_price_as_tested_notes'] = $review_values['rt_price_as_tested_notes'];
			$rt_results_main['rt_redline'] = $review_values['rt_redline'];
			$rt_results_main['rt_disp_cc'] = $review_values['rt_disp_cc'];
			$rt_results_main['rt_rpm'] = $review_values['rt_rpm'];
			$rt_results_main['rt_rpmt'] = $review_values['rt_rpmt'];
			$rt_results_main['rt_slalom'] = $review_values['rt_slalom'];
			$rt_results_main['rt_ss60'] = $review_values['rt_ss60'];
			$rt_results_main['rt_weight'] = $review_values['rt_weight'];
			
			$table = new Application_Model_Form2();
			$db = $table->getAdapter();
    		$db->beginTransaction();
		    try
		    {
		    	  $results1 = $table->createRow();
			      $results1->setFromArray($rt_results_main);
			      $results1->save();
			      $db->commit();
		    }
		    catch(Exception $e)
		    {
		    	$db->rollBack();
      			throw $e;
		    	
		    }
			$this->_redirect("index/");
			
	    }
    }


}

