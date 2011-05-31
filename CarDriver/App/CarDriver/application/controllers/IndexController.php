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
        
         $db = Zend_Db_Table::getDefaultAdapter(); 
         $select = $db->select()
         ->from(array('rrm'=>'rt_results_main'),array('rrm.id As main_results_id', 'rrm.rt_published As publish_date', 
             'rrm.rt_model_year As year', 'rrm.rt_controlled_make As make', 'rrm.rt_model As model', 
             'rrm.bg_make_id As mapped_bg_make_id','rrm.bg_model_id As mapped_bg_model_id','rrm.bg_submodel_id As mapped_bg_submodel_id','rrm.bg_year_id As bg_year_id'));
            /* ->from(array('rrm'=>'rt_results_main'),array('rrm.id As main_results_id', 'rrm.rt_published As publish_date', 
             'rrm.rt_model_year As year', 'rrm.rt_controlled_make As make', 'rrm.rt_model As model', 
             'rrm.bg_make_id As mapped_bg_make_id','rrm.bg_model_id As mapped_bg_model_id','rrm.bg_submodel_id As mapped_bg_submodel_id'))
             ->joinInner(array('by'=>'bg_year'),'by.id=rrm.bg_year_id');*/
 
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
        		$select->where('rrm.id =?', $this->_getParam('id'));
         if(($this->_getParam('year')))
        		$select->where('rrm.bg_year_id =?', $this->_getParam('year'));
         if(($this->_getParam('model')))
        		$select->where('rrm.bg_model_id =?', $this->_getParam('model'));
         if(($this->_getParam('make')))
        		$select->where('rrm.bg_make_id =?', $this->_getParam('make'));
        		
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
    	 	
    	    require_once('Zend/Session.php');
    	 	$session1 = new Zend_Session_Namespace('form1');
    	    $session1->form1 = $form_values;
    	    
    	 	$this->_redirect("index/add1/");
    	 	
    	 }
    	
    }
    
    public function add1Action()
    {
    	$form = new Application_Form_Add1();
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    	 {
    	 	$form_values = $this->view->form->getValues();
    	 	
    	 	require_once('Zend/Session.php');
    	 	$session2 = new Zend_Session_Namespace('form2');
    	 	$session2->form2 = $form_values;
    	 	
    	 	$this->_redirect("index/add2/");
    	 	
    	 }
    	
    }
    
    public function add2Action()
    {
    	$form = new Application_Form_Add2();
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    	 {
    	 	if(isset($_POST['cancel']))
    	 	{
    	 		$this->_redirect("index/");
    	 	}
    	 		
    	 	$form_values = $this->view->form->getValues();
    	 	
    	 	require_once('Zend/Session.php');
    	 	$session3 = new Zend_Session_Namespace('form3');
    	 	$session3->form3 = $form_values;
    	 	
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
	    	if(isset($_POST['cancel']))
    	 	{
    	 		$this->_redirect("index/");
    	 	}
			$rt_results_main = array();
			$rt_results_level_2 = array();
			$rt_results_level_3 = array();
			
			$review_values = $this->view->form->getValues();
			
			$rt_results_main['rt_model_year'] = $review_values['rt_model_year'];
			$rt_results_main['bg_make_id'] = $review_values['bg_make_id'];
			$rt_results_main['rt_published'] = $review_values['rt_published'];
			$rt_results_main['bg_model_id'] = $review_values['bg_model_id'];
			$rt_results_main['rt_issue'] = $review_values['rt_issue'];
			$rt_results_main['bg_submodel_id'] = $review_values['bg_submodel_id'];
			$rt_results_main['rt_issue_year'] = $review_values['rt_issue_year'];
			$rt_results_main['bg_year_id'] = $review_values['bg_year_id 	'];
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
			
			$table = new Application_Model_ResultsMain();
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
		    
		    $rt_results_level_2['rt2_emergency_lane_change'] = $review_values['rt2_emergency_lane_change'];
		    $rt_results_level_2['rt2_skidpad'] = $review_values['rt2_skidpad'];
		    $rt_results_level_2['rt2_100_mph'] = $review_values['rt2_100_mph'];
		    $rt_results_level_2['rt2_130_mph'] = $review_values['rt2_130_mph'];
		    $rt_results_level_2['rt2_30_50TG'] = $review_values['rt2_30_50TG'];
		    $rt_results_level_2['rt2_30_mph'] = $review_values['rt2_30_mph'];
		    $rt_results_level_2['rt2_50_70TG'] = $review_values['rt2_50_70TG'];
		    $rt_results_level_2['rt2_50_mph'] = $review_values['rt2_50_mph'];
		    $rt_results_level_2['rt2_70cr'] = $review_values['rt2_70cr'];
		    $rt_results_level_2['rt2_70_mph'] = $review_values['rt2_70_mph'];
		    $rt_results_level_2['rt2_controlled_airbags'] = $review_values['rt2_controlled_airbags'];
		    $rt_results_level_2['rt2_anti_lock'] = $review_values['rt2_anti_lock'];
		    $rt_results_level_2['rt2_epa_city_fe'] = $review_values['rt2_epa_city_fe'];
		    $rt_results_level_2['rt2_epa_city_fe_notes'] = $review_values['rt2_epa_city_fe_notes'];
		    $rt_results_level_2['rt2_fuel_sys'] = $review_values['rt2_fuel_sys'];
		    $rt_results_level_2['rt2_highway_fe'] = $review_values['rt2_highway_fe'];
		    $rt_results_level_2['rt2_highway_fe_notes'] = $review_values['rt2_highway_fe_notes'];
		    $rt_results_level_2['rt2_int_vol_front'] = $review_values['rt2_int_vol_front'];
		    $rt_results_level_2['rt2_mid'] = $review_values['rt2_mid'];
		    $rt_results_level_2['rt2_passengers'] = $review_values['rt2_passengers'];
		    $rt_results_level_2['rt2_rear'] = $review_values['rt2_rear'];
		    $rt_results_level_2['rt2_sound_level_idle'] = $review_values['rt2_sound_level_idle'];
		    $rt_results_level_2['rt2_stab_defeatable'] = $review_values['rt2_stab_defeatable'];
		    $rt_results_level_2['rt2_stability_control'] = $review_values['rt2_stability_control'];
		    $rt_results_level_2['rt2_sum_of_tg_times'] = $review_values['rt2_sum_of_tg_times'];
		    $rt_results_level_2['rt2_trac_defeatable'] = $review_values['rt2_trac_defeatable'];
		    $rt_results_level_2['rt2_traction_control'] = $review_values['rt2_traction_control'];
		    $rt_results_level_2['rt2_turning_cir'] = $review_values['rt2_turning_cir'];
		    $rt_results_level_2['rt2_wot'] = $review_values['rt2_wot'];
		    
	   		$table = new Application_Model_ResultsLevel2();
			$db = $table->getAdapter();
    		$db->beginTransaction();
		    try
		    {
		    	  $results1 = $table->createRow();
			      $results1->setFromArray($rt_results_level_2);
			      $results1->save();
			      $db->commit();
		    }
		    catch(Exception $e)
		    {
		    	$db->rollBack();
      			throw $e;
		    	
		    }
		    
		    $rt_results_level_3['rt3_boost_psi'] = $review_values['rt3_boost_psi'];
		    $rt_results_level_3['rt3_bore_mm'] = $review_values['rt3_bore_mm'];
		    $rt_results_level_3['rt3_cd'] = $review_values['rt3_cd'];
		    $rt_results_level_3['rt3_comp_ratio'] = $review_values['rt3_comp_ratio'];
		    $rt_results_level_3['rt3_et_factor'] = $review_values['rt3_et_factor'];
		    $rt_results_level_3['rt3_final_drive_ratio'] = $review_values['rt3_final_drive_ratio'];
		    $rt_results_level_3['rt3_frontal_area'] = $review_values['rt3_frontal_area'];
		    $rt_results_level_3['rt3_frontal_area_notes'] = $review_values['rt3_frontal_area_notes'];
		    $rt_results_level_3['rt3_fuel_cap'] = $review_values['rt3_fuel_cap'];
		    $rt_results_level_3['rt3_height'] = $review_values['rt3_height'];
		    $rt_results_level_3['rt3_length'] = $review_values['rt3_length'];
		    $rt_results_level_3['rt3_lt_oil'] = $review_values['rt3_lt_oil'];
		    $rt_results_level_3['rt3_lt_repiar'] = $review_values['rt3_lt_repiar'];
		    $rt_results_level_3['rt3_lt_serv'] = $review_values['rt3_lt_serv'];
		    $rt_results_level_3['rt3_lt_stps_sched'] = $review_values['rt3_lt_stps_sched'];
		    $rt_results_level_3['rt3_lt_stps_unsched'] = $review_values['rt3_lt_stps_unsched'];
		    $rt_results_level_3['rt3_lt_wear'] = $review_values['rt3_lt_wear'];
		    $rt_results_level_3['rt3_max_mph_1000_rpm'] = $review_values['rt3_max_mph_1000_rpm'];
		    $rt_results_level_3['rt3_peak_bmep'] = $review_values['rt3_peak_bmep'];
		    $rt_results_level_3['rt3_peal_bmep'] = $review_values['rt3_peal_bmep'];
		    $rt_results_level_3['rt3_road_hp_30mph'] = $review_values['rt3_road_hp_30mph'];
		    $rt_results_level_3['rt3_sp_factor'] = $review_values['rt3_sp_factor'];
		    $rt_results_level_3['rt3_specific_power'] = $review_values['rt3_specific_power'];
		    $rt_results_level_3['rt3_stroke_mm'] = $review_values['rt3_stroke_mm'];
		    $rt_results_level_3['rt3_trunk'] = $review_values['rt3_trunk'];
		    $rt_results_level_3['rt3_valve_gear'] = $review_values['rt3_valve_gear'];
		    $rt_results_level_3['rt3_width'] = $review_values['rt3_width'];
		    $rt_results_level_3['rt3_valves_per_cyl'] = $review_values['rt3_valves_per_cyl'];
		    $rt_results_level_3['rt3_wheelbase'] = $review_values['rt3_wheelbase'];
		    $rt_results_level_3['rt3_70co'] = $review_values['rt3_70co'];
		    $rt_results_level_3['rt3_10mph'] = $review_values['rt3_10mph'];
		    $rt_results_level_3['rt3_20mph'] = $review_values['rt3_20mph'];
		    $rt_results_level_3['rt3_40mph'] = $review_values['rt3_40mph'];
		    $rt_results_level_3['rt3_50mph'] = $review_values['rt3_50mph'];
		    $rt_results_level_3['rt3_70mph'] = $review_values['rt3_70mph'];
		    $rt_results_level_3['rt3_80mph'] = $review_values['rt3_80mph'];
		    $rt_results_level_3['rt3_90mph'] = $review_values['rt3_90mph'];
		    $rt_results_level_3['rt3_110mph'] = $review_values['rt3_110mph'];
		    $rt_results_level_3['rt3_120mph'] = $review_values['rt3_120mph'];
		    $rt_results_level_3['rt3_140mph'] = $review_values['rt3_140mph'];
		    $rt_results_level_3['rt3_150mph'] = $review_values['rt3_150mph'];
		    $rt_results_level_3['rt3_160mph'] = $review_values['rt3_160mph'];
		    $rt_results_level_3['rt3_170mph'] = $review_values['rt3_170mph'];
		    $rt_results_level_3['rt3_180mph'] = $review_values['rt3_180mph'];
		    $rt_results_level_3['rt3_190mph'] = $review_values['rt3_190mph'];
		    $rt_results_level_3['rt3_200mph'] = $review_values['rt3_200mph'];
		    
	    	$table = new Application_Model_ResultsLevel3();
			$db = $table->getAdapter();
    		$db->beginTransaction();
		    try
		    {
		    	  $results1 = $table->createRow();
			      $results1->setFromArray($rt_results_level_3);
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
    
    public function editAction()
    {
    	$db = Zend_Db_Table::getDefaultAdapter();
    	
    	$select = $db->select()
            ->from('rt_results_main')
            ->where('id = ?', $this->_getParam('id'));
       
        $results_main = $db->query($select)->fetchAll();
        
        // Prepare form
    	$form = new Application_Form_Edit();
    	
    	// Populate form
    	$form->populate($results_main[0]);
    	
    	$this->view->form = $form;
    	
     	if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    	{
    	 	$form_values = $this->view->form->getValues();
    	 	
    	    require_once('Zend/Session.php');
    	 	$session1 = new Zend_Session_Namespace('form1');
    	    $session1->form1 = $form_values;
    	    
    	 	$this->_redirect("index/edit1/id/".$this->_getParam('id'));
    	 	
    	}
        
    }
    
    public function edit1Action()
    {
    	$db = Zend_Db_Table::getDefaultAdapter();
    	
    	$select = $db->select()
            ->from('rt_results_main')
            ->where('id = ?', $this->_getParam('id'));
       
        $results_main = $db->query($select)->fetchAll();
        
    	$select = $db->select()
            ->from('rt_results_level_2')
            ->where('id = ?', $this->_getParam('id'));
       
        $results_level_2 = $db->query($select)->fetchAll();
        
        $select = $db->select()
            ->from('rt_results_level_3')
            ->where('id = ?', $this->_getParam('id'));
       
        $results_level_3 = $db->query($select)->fetchAll();
        
        $session1 = new Zend_Session_Namespace('form1');
        $form1_Values = $session1->form1;
        
        $results2 = array_merge($results_main[0], $results_level_2[0], $results_level_3[0]);
        
        // Prepare form
    	$form = new Application_Form_Edit1();
    	
    	$form->populate($results2);
    	
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    	{
    	 	$form_values = $this->view->form->getValues();
    	 	
    	    require_once('Zend/Session.php');
    	 	$session2 = new Zend_Session_Namespace('form2');
    	    $session2->form2 = $form_values;
    	    
    	 	$this->_redirect("index/edit2/id/".$this->_getParam('id'));
    	 	
    	}
    	
    }
    
    public function edit2Action()
    {
    	$db = Zend_Db_Table::getDefaultAdapter();
    	
    	$select = $db->select()
            ->from('rt_results_level_2')
            ->where('id = ?', $this->_getParam('id'));
       
        $results_level_2 = $db->query($select)->fetchAll();
        
    	$select = $db->select()
            ->from('rt_results_level_3')
            ->where('id = ?', $this->_getParam('id'));
       
        $results_level_3 = $db->query($select)->fetchAll();
        
        $session2 = new Zend_Session_Namespace('form2');
        $form2_Values = $session2->form1;
        
        $results3 = array_merge($results_level_2[0], $results_level_3[0]);
        
        // Prepare form
    	$form = new Application_Form_Edit2();
    	
    	$form->populate($results3);
    	
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    	 {
    	 	if(isset($_POST['cancel']))
    	 	{
    	 		$this->_redirect("index/");
    	 	}
    	 	$form_values = $this->view->form->getValues();
    	 	
    	 	require_once('Zend/Session.php');
    	 	$session3 = new Zend_Session_Namespace('form3');
    	 	$session3->form3 = $form_values;
    	 	
    	 	$this->_redirect("index/reviewedit/id/".$this->_getParam('id'));
    	 	
    	 }
    	
    }
    
    public function revieweditAction()
    {
    	$db = Zend_Db_Table::getDefaultAdapter(); 
		
		$this->view->id = $this->_getParam('id');
		
    	$review = new Application_Form_Review($this->_getParam('id'));
    	
    	$this->view->form = $review;
    	
    	if ($this->getRequest()->isPost() && $review->isValid($this->getRequest()->getPost()))
    	{
    		if(isset($_POST['cancel']))
    	 	{
    	 		$this->_redirect("index/");
    	 	}
    		$rt_results_main = array();
			$rt_results_level_2 = array();
			$rt_results_level_3 = array();
			
			$review_values = $this->view->form->getValues();
			
			$rt_results_main['rt_model_year'] = $review_values['rt_model_year'];
			$rt_results_main['bg_make_id'] = $review_values['bg_make_id'];
			$rt_results_main['rt_published'] = $review_values['rt_published'];
			$rt_results_main['bg_model_id'] = $review_values['bg_model_id'];
			$rt_results_main['rt_issue'] = $review_values['rt_issue'];
			$rt_results_main['bg_submodel_id'] = $review_values['bg_submodel_id'];
			$rt_results_main['rt_issue_year'] = $review_values['rt_issue_year'];
			$rt_results_main['bg_year_id'] = $review_values['bg_year_id 	'];
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
			
			$where[] = "id = ".$this->_getParam('id');

		    try
		    {
		    	  $n = $db->update("rt_results_main", $rt_results_main, $where);
		    }
		    catch(Exception $e)
		    {
		    	$db->rollBack();
      			throw $e;
		    	
		    }
		    
		    $rt_results_level_2['rt2_emergency_lane_change'] = $review_values['rt2_emergency_lane_change'];
		    $rt_results_level_2['rt2_skidpad'] = $review_values['rt2_skidpad'];
		    $rt_results_level_2['rt2_100_mph'] = $review_values['rt2_100_mph'];
		    $rt_results_level_2['rt2_130_mph'] = $review_values['rt2_130_mph'];
		    $rt_results_level_2['rt2_30_50TG'] = $review_values['rt2_30_50TG'];
		    $rt_results_level_2['rt2_30_mph'] = $review_values['rt2_30_mph'];
		    $rt_results_level_2['rt2_50_70TG'] = $review_values['rt2_50_70TG'];
		    $rt_results_level_2['rt2_50_mph'] = $review_values['rt2_50_mph'];
		    $rt_results_level_2['rt2_70cr'] = $review_values['rt2_70cr'];
		    $rt_results_level_2['rt2_70_mph'] = $review_values['rt2_70_mph'];
		    $rt_results_level_2['rt2_controlled_airbags'] = $review_values['rt2_controlled_airbags'];
		    $rt_results_level_2['rt2_anti_lock'] = $review_values['rt2_anti_lock'];
		    $rt_results_level_2['rt2_epa_city_fe'] = $review_values['rt2_epa_city_fe'];
		    $rt_results_level_2['rt2_epa_city_fe_notes'] = $review_values['rt2_epa_city_fe_notes'];
		    $rt_results_level_2['rt2_fuel_sys'] = $review_values['rt2_fuel_sys'];
		    $rt_results_level_2['rt2_highway_fe'] = $review_values['rt2_highway_fe'];
		    $rt_results_level_2['rt2_highway_fe_notes'] = $review_values['rt2_highway_fe_notes'];
		    $rt_results_level_2['rt2_int_vol_front'] = $review_values['rt2_int_vol_front'];
		    $rt_results_level_2['rt2_mid'] = $review_values['rt2_mid'];
		    $rt_results_level_2['rt2_passengers'] = $review_values['rt2_passengers'];
		    $rt_results_level_2['rt2_rear'] = $review_values['rt2_rear'];
		    $rt_results_level_2['rt2_sound_level_idle'] = $review_values['rt2_sound_level_idle'];
		    $rt_results_level_2['rt2_stab_defeatable'] = $review_values['rt2_stab_defeatable'];
		    $rt_results_level_2['rt2_stability_control'] = $review_values['rt2_stability_control'];
		    $rt_results_level_2['rt2_sum_of_tg_times'] = $review_values['rt2_sum_of_tg_times'];
		    $rt_results_level_2['rt2_trac_defeatable'] = $review_values['rt2_trac_defeatable'];
		    $rt_results_level_2['rt2_traction_control'] = $review_values['rt2_traction_control'];
		    $rt_results_level_2['rt2_turning_cir'] = $review_values['rt2_turning_cir'];
		    $rt_results_level_2['rt2_wot'] = $review_values['rt2_wot'];
		    
    		try
		    {
		    	  $n = $db->update("rt_results_level_2", $rt_results_level_2, $where);
		    }
		    catch(Exception $e)
		    {
		    	$db->rollBack();
      			throw $e;
		    	
		    }
		    
		    $rt_results_level_3['rt3_boost_psi'] = $review_values['rt3_boost_psi'];
		    $rt_results_level_3['rt3_bore_mm'] = $review_values['rt3_bore_mm'];
		    $rt_results_level_3['rt3_cd'] = $review_values['rt3_cd'];
		    $rt_results_level_3['rt3_comp_ratio'] = $review_values['rt3_comp_ratio'];
		    $rt_results_level_3['rt3_et_factor'] = $review_values['rt3_et_factor'];
		    $rt_results_level_3['rt3_final_drive_ratio'] = $review_values['rt3_final_drive_ratio'];
		    $rt_results_level_3['rt3_frontal_area'] = $review_values['rt3_frontal_area'];
		    $rt_results_level_3['rt3_frontal_area_notes'] = $review_values['rt3_frontal_area_notes'];
		    $rt_results_level_3['rt3_fuel_cap'] = $review_values['rt3_fuel_cap'];
		    $rt_results_level_3['rt3_height'] = $review_values['rt3_height'];
		    $rt_results_level_3['rt3_length'] = $review_values['rt3_length'];
		    $rt_results_level_3['rt3_lt_oil'] = $review_values['rt3_lt_oil'];
		    $rt_results_level_3['rt3_lt_repair'] = $review_values['rt3_lt_repair'];
		    $rt_results_level_3['rt3_lt_serv'] = $review_values['rt3_lt_serv'];
		    $rt_results_level_3['rt3_lt_stps_sched'] = $review_values['rt3_lt_stps_sched'];
		    $rt_results_level_3['rt3_lt_stps_unsched'] = $review_values['rt3_lt_stps_unsched'];
		    $rt_results_level_3['rt3_lt_wear'] = $review_values['rt3_lt_wear'];
		    $rt_results_level_3['rt3_max_mph_1000_rpm'] = $review_values['rt3_max_mph_1000_rpm'];
		    $rt_results_level_3['rt3_peak_bmep'] = $review_values['rt3_peak_bmep'];
		    $rt_results_level_3['rt3_peal_bmep'] = $review_values['rt3_peal_bmep'];
		    $rt_results_level_3['rt3_road_hp_30mph'] = $review_values['rt3_road_hp_30mph'];
		    $rt_results_level_3['rt3_sp_factor'] = $review_values['rt3_sp_factor'];
		    $rt_results_level_3['rt3_specific_power'] = $review_values['rt3_specific_power'];
		    $rt_results_level_3['rt3_stroke_mm'] = $review_values['rt3_stroke_mm'];
		    $rt_results_level_3['rt3_trunk'] = $review_values['rt3_trunk'];
		    $rt_results_level_3['rt3_valve_gear'] = $review_values['rt3_valve_gear'];
		    $rt_results_level_3['rt3_width'] = $review_values['rt3_width'];
		    $rt_results_level_3['rt3_valves_per_cyl'] = $review_values['rt3_valves_per_cyl'];
		    $rt_results_level_3['rt3_wheelbase'] = $review_values['rt3_wheelbase'];
		    $rt_results_level_3['rt3_70co'] = $review_values['rt3_70co'];
		    $rt_results_level_3['rt3_10mph'] = $review_values['rt3_10mph'];
		    $rt_results_level_3['rt3_20mph'] = $review_values['rt3_20mph'];
		    $rt_results_level_3['rt3_40mph'] = $review_values['rt3_40mph'];
		    $rt_results_level_3['rt3_50mph'] = $review_values['rt3_50mph'];
		    $rt_results_level_3['rt3_70mph'] = $review_values['rt3_70mph'];
		    $rt_results_level_3['rt3_80mph'] = $review_values['rt3_80mph'];
		    $rt_results_level_3['rt3_90mph'] = $review_values['rt3_90mph'];
		    $rt_results_level_3['rt3_110mph'] = $review_values['rt3_110mph'];
		    $rt_results_level_3['rt3_120mph'] = $review_values['rt3_120mph'];
		    $rt_results_level_3['rt3_140mph'] = $review_values['rt3_140mph'];
		    $rt_results_level_3['rt3_150mph'] = $review_values['rt3_150mph'];
		    $rt_results_level_3['rt3_160mph'] = $review_values['rt3_160mph'];
		    $rt_results_level_3['rt3_170mph'] = $review_values['rt3_170mph'];
		    $rt_results_level_3['rt3_180mph'] = $review_values['rt3_180mph'];
		    $rt_results_level_3['rt3_190mph'] = $review_values['rt3_190mph'];
		    $rt_results_level_3['rt3_200mph'] = $review_values['rt3_200mph'];
		    
    		try
		    {
		    	  $n = $db->update("rt_results_level_3", $rt_results_level_3, $where);
		    }
		    catch(Exception $e)
		    {
		    	$db->rollBack();
      			throw $e;
		    	
		    }
		    $this->_redirect("index/");
    	}
    }
    
    public function manageconrolledlistAction()
    {
    	$db = Zend_Db_Table::getDefaultAdapter(); 
    	
    	$select = $db->select()
			->from('bg_year',array(new Zend_Db_Expr('count(*) as total')));
			
		$res = $db->query($select)->fetchAll();
		
		$this->view->total_bg_year = $res[0]['total'];
		
		$select = $db->select()
			->from('bg_make',array(new Zend_Db_Expr('count(*) as total')));
			
		$res = $db->query($select)->fetchAll();
		
		$this->view->total_bg_make = $res[0]['total'];
		
		$select = $db->select()
			->from('bg_model',array(new Zend_Db_Expr('count(*) as total')));
			
		$res = $db->query($select)->fetchAll();
		
		$this->view->total_bg_model = $res[0]['total'];
		
		$select = $db->select()
			->from('rt_dropdown_types',array(new Zend_Db_Expr('count(*) as total')));
			
		$res = $db->query($select)->fetchAll();
		
		$this->view->total_rt_dropdown_types = $res[0]['total'];
		
		$select = $db->select()
			->from('rt_dropdown_lookup',array(new Zend_Db_Expr('count(*) as total')));
			
		$res = $db->query($select)->fetchAll();
		
		$this->view->total_rt_dropdown_lookup = $res[0]['total'];
		
		$select = $db->select()
			->from('rt_dropdown_descriptions',array(new Zend_Db_Expr('count(*) as total')));
			
		$res = $db->query($select)->fetchAll();
		
		$this->view->total_rt_dropdown_descriptions = $res[0]['total'];
    }
    


}

