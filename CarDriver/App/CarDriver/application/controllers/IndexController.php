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
         
         $formright = new Application_Form_SearchRight();
         $this->view->formright = $formright;
        
         $db = Zend_Db_Table::getDefaultAdapter(); 
         $select = $db->select()
         ->from(array('rrm'=>'rt_results_main'),array('rrm.id As main_results_id', 
         		'rrm.rt_published As publish', 
             	'rrm.rt_model_year As year', 'rrm.rt_controlled_make As make', 'rrm.rt_model As model','rrm.rt_issue_year As issue_year',
         		'rrm.rt_issue As issue_month', 'rrm.rt_controlled_sort As production_type', 'rrm.rt_doors As doors', 'rrm.rt_controlled_body As body_style',
         		'rrm.rt_peak_hp As peak_horse_power'));
         
         if (($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
         	  || ($this->getRequest()->isPost() && $formright->isValid($this->getRequest()->getPost())))
          {
          	 $this->_helper->redirector->gotoRouteAndExit(array(
		        'page' => 1,
		        'id'   => $this->getRequest()->getPost('id'),
		        'year' => $this->getRequest()->getPost('year'),
		      	'make' => $this->getRequest()->getPost('make'),
          	    'model' => $this->getRequest()->getPost('model'),
          	    'submodel' => $this->getRequest()->getPost('submodel'),
		      ));
          }
         else
         {
         	$form->getElement('id')->setValue($this->_getParam('id'));
         	$formright->getElement('year')->setValue($this->_getParam('year'));
         	$formright->getElement('make')->setValue($this->_getParam('make'));
         	$formright->getElement('model')->setValue($this->_getParam('model'));
         	$formright->getElement('submodel')->setValue($this->_getParam('submodel'));
         	
         }
         if(($this->_getParam('id')))
        		$select->where('rrm.id =?', $this->_getParam('id'));
         if(($this->_getParam('year')))
        		$select->where('rrm.bg_year_id =?', $this->_getParam('year'));
         if(($this->_getParam('model')))
        		$select->where('rrm.bg_model_id =?', $this->_getParam('model'));
         if(($this->_getParam('make')))
        		$select->where('rrm.bg_make_id =?', $this->_getParam('make'));
         if(($this->_getParam('submodel')))
        		$select->where('rrm.bg_submodel_id =?', $this->_getParam('submodel'));
        		
        $export_result = $db->query($select)->fetchAll();

        require_once('Zend/Session.php');
     	$session_export = new Zend_Session_Namespace('export');
        $session_export->export = $export_result;	
        	
        $result = Zend_Paginator::factory($export_result);
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
    	 	$session_formvalues = new Zend_Session_Namespace('FormValues');
    	    $session_formvalues->FormValues = $form_values;
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
		
		$review = new Application_Form_Review($id);
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
			$rt_results_main['bg_year_id'] = $review_values['bg_year_id'];
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
			$rt_results_main['rt_base_price'] = $review_values['rt_base_price'];
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
			$rt_results_main['rt_peak_torque'] = $review_values['rt_peak_torque'];
			$rt_results_main['rt_peak_torque_notes'] = $review_values['rt_peak_torque_notes'];
			
			
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
		    
		    $select = $db->select()
			->from('rt_results_main',array(new Zend_Db_Expr('max(id) as maxId')));
			$res = $db->query($select)->fetchAll();
		    
			$rt_results_level_2['id'] = $res[0]['maxId'];
		    $rt_results_level_2['rt2_emergency_lane_change'] = $review_values['rt2_emergency_lane_change'];
		    $rt_results_level_2['rt2_skidpad'] = $review_values['rt2_skidpad'];
		    $rt_results_level_2['rt2_100_mph'] = $review_values['rt2_100_mph'];
		    $rt_results_level_2['rt2_130_mph'] = $review_values['rt2_130_mph'];
		    $rt_results_level_2['rt2_30_50TG'] = $review_values['rt2_30_50TG'];
		    $rt_results_level_2['rt2_30_mph'] = $review_values['rt2_30_mph'];
		    $rt_results_level_2['rt2_50_70TG'] = $review_values['rt2_50_70TG'];
		    $rt_results_level_2['rt2_70cr'] = $review_values['rt2_70cr'];
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
		    $rt_results_level_2['rt2_50_mph'] = $review_values['rt2_50_mph'];
		    $rt_results_level_2['rt2_70_mph'] = $review_values['rt2_70_mph'];
		    
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
		    
		    $rt_results_level_3['id'] = $res[0]['maxId'];
		    $rt_results_level_3['rt3_boost_psi'] = $review_values['rt3_boost_psi'];
		    $rt_results_level_3['rt3_bore_mm'] = $review_values['rt3_bore_mm'];
		    $rt_results_level_3['rt3_cd'] = $review_values['rt3_cd'];
		    $rt_results_level_3['rt3_comp_ratio'] = $review_values['rt3_comp_ratio'];
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
		    $rt_results_level_3['rt3_et_factor'] = $review_values['rt3_et_factor'];
		    $rt_results_level_3['rt3_road_hp_30mph'] = $review_values['rt3_road_hp_30mph'];
		    $rt_results_level_3['rt3_sp_factor'] = $review_values['rt3_sp_factor'];
		    $rt_results_level_3['rt3_peak_bmep'] = $review_values['rt3_peak_bmep'];
		    $rt_results_level_3['rt3_peal_bmep'] = $review_values['rt3_peal_bmep'];
		    
		    
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
			
		    $session_makeid = new Zend_Session_Namespace('makeid');
			unset($session_makeid->make_id);
			$session_yearid = new Zend_Session_Namespace('yearid');
			unset($session_yearid->year_id);
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
        
        $select = $db->select()
            ->from('rt_results_level_2')
            ->where('id = ?', $this->_getParam('id'));
       
        $results_level_2 = $db->query($select)->fetchAll();
        
        $select = $db->select()
            ->from('rt_results_level_3')
            ->where('id = ?', $this->_getParam('id'));
       
        $results_level_3 = $db->query($select)->fetchAll();
        
        $results = array();
        if(isset($results_main[0]))
        {
        	$res1 = $results_main[0];
        	$results = $res1;
        }
        else
        	$res1 = array();
        	
        if(isset($results_level_2[0]))
        {
        	$res2 = $results_level_2[0];
        	$results = array_merge($res1, $res2);
        }
        else
        	$res2 = array();
        	
        if(isset($results_level_3[0]))
        {
        	$res3 = $results_level_3[0];
        	$results = array_merge($res1, $res2, $res3);
        }
        else
        	$res3 = array();
        
        
        
        require_once('Zend/Session.php');
        $session_makeid = new Zend_Session_Namespace('makeid');
    	$session_makeid->make_id = $results_main[0]['bg_make_id'];
    	$session_yearid = new Zend_Session_Namespace('yearid');
    	$session_yearid->year_id = $results_main[0]['bg_year_id'];
    	$session_yearid->model_id = $results_main[0]['bg_model_id'];
     	
        // Prepare form
    	$form = new Application_Form_Edit();

    	// Populate form
    	$form->populate($results);
    	
    	$this->view->form = $form;
    	
     	if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
    	{
    	 	$form_values = $this->view->form->getValues();
    	 	
    	    require_once('Zend/Session.php');
    	 	$session1 = new Zend_Session_Namespace('FormValues');
    	    $session1->FormValues = $form_values;
    	    
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
    	 		$session_makeid = new Zend_Session_Namespace('makeid');
				unset($session_makeid->make_id);
				$session_yearid = new Zend_Session_Namespace('yearid');
				unset($session_yearid->year_id);
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
			$rt_results_main['bg_year_id'] = $review_values['bg_year_id'];
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
			$rt_results_main['rt_base_price'] = $review_values['rt_base_price'];
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
			$rt_results_main['rt_peak_torque'] = $review_values['rt_peak_torque'];
			$rt_results_main['rt_peak_torque_notes'] = $review_values['rt_peak_torque_notes'];
			
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
		    $rt_results_level_2['rt2_70cr'] = $review_values['rt2_70cr'];
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
		    $rt_results_level_2['rt2_50_mph'] = $review_values['rt2_50_mph'];
		    $rt_results_level_2['rt2_70_mph'] = $review_values['rt2_70_mph'];
		    
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
		    $rt_results_level_3['rt3_et_factor'] = $review_values['rt3_et_factor'];
		    $rt_results_level_3['rt3_road_hp_30mph'] = $review_values['rt3_road_hp_30mph'];
		    $rt_results_level_3['rt3_sp_factor'] = $review_values['rt3_sp_factor'];
		    $rt_results_level_3['rt3_peak_bmep'] = $review_values['rt3_peak_bmep'];
		    $rt_results_level_3['rt3_peal_bmep'] = $review_values['rt3_peal_bmep'];
		    
    		try
		    {
		    	  $n = $db->update("rt_results_level_3", $rt_results_level_3, $where);
		    }
		    catch(Exception $e)
		    {
		    	$db->rollBack();
      			throw $e;
		    	
		    }
		        $session_makeid = new Zend_Session_Namespace('makeid');
				unset($session_makeid->make_id);
				$session_yearid = new Zend_Session_Namespace('yearid');
				unset($session_yearid->year_id);
		    	$this->_redirect("index/");
    	}
    }
    
    public function manageconrolledlistAction()
    {
    	$db = Zend_Db_Table::getDefaultAdapter(); 
		$db1 = Zend_Db_Table::getDefaultAdapter();
		$form = new Application_Form_DropdownDescriptions();
		$this->view->form = $form;
		if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
     	{
     		 $form_values = $this->view->form->getValues();
     		 if(isset($_POST['submit13']))
    	 	 {
    	 		 $this->_redirect("index/manageconrolledlist/rt_types/".$form_values['rt_types']);
    	 		
    	 	 }
		     if(isset($form_values['description']) && (trim($form_values['description']) != '') 
		     	&& $form_values['rt_types'] > 0)
		     {	
		     	$table = new Application_Model_DropdownDescriptions();
				$db = $table->getAdapter();
	    		$db->beginTransaction();
			    try
			    {
			    	  $vals['description'] = $form_values['description'];
			    	  $results1 = $table->createRow();
				      $results1->setFromArray($vals);
				      $results1->save();
				      $db->commit();
				      
			    }
			    catch(Exception $e)
			    {
			    	$db->rollBack();
	      			throw $e;
			    	
			    }
			     $values['id_descriptions'] = $this->gatLastInseredId();
				 $values['id_types'] = $form_values['rt_types'];
			    if( isset($values['id_descriptions']))
			    {
				    $table = new Application_Model_DropdownLookup();
					$db = $table->getAdapter();
		    		$db->beginTransaction();
			     	try
				    {
				    	  $results1 = $table->createRow();
					      $results1->setFromArray($values);
					      $results1->save();
					      $db->commit();
				    }
				    catch(Exception $e)
				    {
				    	$db->rollBack();
		      			throw $e;
				    	
				    }
			    }
			   $this->_redirect("index/manageconrolledlist/rt_types/".$form_values['rt_types']);
		     }
     		$this->_helper->redirector->gotoRouteAndExit(array(
          	    'rt_types' => $this->getRequest()->getPost('rt_types'),
		     ));
     	}
		else
        {
         	$form->getElement('rt_types')->setValue($this->_getParam('rt_types'));
        }
        if($this->_getParam('rt_types'))
        {
         	$select = $db->select()
			->from(array('rdd' => 'rt_dropdown_descriptions'), array('rdd.id_descriptions As id_desp', 'rdd.description As description'))
			->joininner(array('rdl' => 'rt_dropdown_lookup'), 'rdl.id_descriptions = rdd.id_descriptions')
			->where('rdl.id_types =?', $this->_getParam('rt_types'));
			$res = $db->query($select)->fetchAll();
		    $this->view->results = $res;
        }
        
    }
    
    private function gatLastInseredId()
    {
    	$db = Zend_Db_Table::getDefaultAdapter(); 
		
		$select = $db->select()
			->from('rt_dropdown_descriptions',array(new Zend_Db_Expr('max(id_descriptions) as maxId')));
		$res = $db->query($select)->fetchAll();
		$id = $res[0]['maxId'];
		return $id;
    }
    
    public function populatemodelAction()
    {
    	$return = '0~select from list;';
    	$makeid = $this->_getParam('id');
    	
    	if($makeid)
    	{
    		require_once('Zend/Session.php');
    	 	$session_makeid = new Zend_Session_Namespace('makeid');
    	 	$session_makeid->make_id = $makeid;
    		//$_SESSION['makid'] = $makeid;
    	}
     	$models_prepared[0]= "Select or Leave blank";
		$objDOM = new DOMDocument(); 
		$objDOM->load("http://buyersguide.caranddriver.com/api/models?mode=xml"); 
		$xpath = new DOMXPath($objDOM);
		$query = '//response/data/row/make_id';
		
		$entries = $xpath->query($query);
		foreach( $entries as $entry )
		{
			$make_id = $entry->nodeValue;
		    if($makeid == $make_id)
		    {
		    	$name  = $entry->previousSibling->nodeValue;
		    	$id  = $entry->previousSibling->previousSibling->nodeValue;
		    	$return .= $id.'~'.$name.';';
		    }
		 }
		echo $return;
    }
    
 	public function populatesubmodelAction()
    {
    	$return = '0~Select or Leave blank;';
    	$yearid = $this->_getParam('yearid');
    	$modelid = $this->_getParam('modelid');
    	if($yearid && $modelid)
    	{
    		require_once('Zend/Session.php');
    	 	$session_yearid = new Zend_Session_Namespace('yearid');
    	 	$session_yearid->year_id = $yearid;
    	 	$session_yearid->model_id = $modelid;
    	}
		$objDOM = new DOMDocument(); 
		$objDOM->load("http://buyersguide.caranddriver.com/api/submodels?mode=xml"); 
		$xpath = new DOMXPath($objDOM);
		$query = '//response/data/row/year_id';
        
        $entries = $xpath->query($query);
		foreach( $entries as $entry)
		{
		    if($yearid == $entry->nodeValue && $modelid == $entry->previousSibling->nodeValue)
		    { 	
		    	$name  = $entry->previousSibling->previousSibling->nodeValue;
		    	$id  = $entry->previousSibling->previousSibling->previousSibling->nodeValue;
		    	$return .= $id.'~'.$name.';';
		    }
		 }
		echo $return;
    }
    
	public function csvexportAction()
	{
		$session_export = new Zend_Session_Namespace('export');
        $result = $session_export->export;

	   header("Content-type:text/octect-stream");
	   header("Content-Disposition:attachment;filename=data.csv");
	   print "\"ID\",\"Publish Date\",\"Year\",\"Make\",\"Model\",\"Mag Issue Year\",\"Mag Issue Month\",\"Production Type\",\"Number of Doors\", \"Body Style\", \"Peak Horsepower\"\n";
	    foreach ($result as $row) {
	        $make = $this->getData($row['make']);
	        $body_style = $this->getData($row['body_style']);
	        $production_type = $this->getData($row['production_type']);
	        $final = str_replace($row['make'], $make, $row);
	        $final = str_replace($row['body_style'], $body_style, $final);
	        $final = str_replace($row['production_type'], $production_type, $final);
	        print '"' . stripslashes(implode('","',$final)) . "\"\n";
	    }

	    exit;
	}
	
	public function excelexportAction()
	{
		
		$session_export = new Zend_Session_Namespace('export');
        $result = $session_export->export;
		
	   	header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=data.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		 print "ID\tPublish Date\tYear\tMake\tModel\tMag Issue Year\tMag Issue Month\tProduction Type\tNumber of Doors\tBody Style\tPeak Horsepower\n";
		foreach ($result as $row) {
	        $make = $this->getData($row['make']);
	        $body_style = $this->getData($row['body_style']);
	        $production_type = $this->getData($row['production_type']);
	        $final = str_replace($row['make'], $make, $row);
	        $final = str_replace($row['body_style'], $body_style, $final);
	        $final = str_replace($row['production_type'], $production_type, $final);
	        print stripslashes(implode("\t",$final)) . "\n";
	    }
	    exit;
	}
	
	private function getExcelData($data)
	{
	    $retval = "";
	    if (is_array($data)  && !empty($data))
	    {
	     $row = 0;
	     foreach(array_values($data) as $_data){
	     
	      $make = $this->getData($_data['make']);
	      $body_style = $this->getData($_data['body_style']);
	      $production_type = $this->getData($_data['production_type']);
	      $final = str_replace($row['make'], $make, $_data);
	      $final = str_replace($row['body_style'], $body_style, $final);
	      $final = str_replace($row['production_type'], $production_type, $final);
	      if (is_array($final) && !empty($final))
	      {
	          if ($row == 0)
	          {
	              // write the column headers
	              $retval = implode("\t",array_keys($final));
	              $retval .= "\n";
	          }
	           //create a line of values for this row...
	              $retval .= implode("\t",array_values($final));
	              $retval .= "\n";
	              //increment the row so we don't create headers all over again
	              $row++;
	       }
	     }
	    }
	    exit;
	  return $retval;
 	}
 	
 	public function getData($id)
	{
		 $db = Zend_Db_Table::getDefaultAdapter(); 
		if(isset($id))
		{
		 $select = $db->select()
	         ->from(array('rdd'=>'rt_dropdown_descriptions'),array('rdd.description As desp'))
	         ->where('rdd.id_descriptions =?', $id);
	         $result = $db->query($select)->fetchAll();
	         if(isset($result[0]))
	         	return $result[0]['desp'];
	         else
	         	return "-";
		}
		else
		return "-";
	}
	
	
	public function deletedropdowndescriptionAction()
  	{
  		$db = Zend_Db_Table::getDefaultAdapter(); 
  		
  		$id = $this->_getParam('id');
      	$id_types = $this->_getParam('rt_types');
      	
  		$this->view->rt_types = $id_types;
  		$this->view->id = $id;
  		
  		$select = $db->select()
			->from('rt_dropdown_descriptions')
			->where('id_descriptions =?', $id); 
			
  		$res = $db->query($select)->fetchAll();
  		
  		$this->view->description = $res[0];
  		
  		if (!$this->getRequest()->isPost())
      	return;
      	

      	try
      	{
      		$db->delete('rt_dropdown_descriptions', 'id_descriptions = '.$this->_getParam('id'));
      		$db->delete('rt_dropdown_lookup','id_descriptions = '.$id);
      	}
  	 	catch(Exception $e)
	    {
	    	echo $e;
	    	exit;
	    	$db->rollBack();
      		throw $e;
	    	
	    }
	    $this->_redirect("index/manageconrolledlist/rt_types/".$id_types);
  	}
  	
  	public function editdropdowndescriptionAction()
  	{
  		$id = $this->_getParam('id');
  		$rt_types = $this->_getParam('rt_types');
  		
  		$db = Zend_Db_Table::getDefaultAdapter();
  		
  		$select = $db->select()
			->from('rt_dropdown_descriptions')
			->where('id_descriptions =?', $id); 
			
  		$res = $db->query($select)->fetchAll();
  		
  		$this->view->description = $res[0];
  		$this->view->rt_types = $rt_types;
  		$this->view->id = $id;
  		
  		if (!$this->getRequest()->isPost())
      	return;
      	
      	$dropdown_descriptions['description'] = $_POST['description'];
      
      	$where[] = 'id_descriptions = '.$id;
      	try
      	{
      		$res = $db->update('rt_dropdown_descriptions', $dropdown_descriptions, $where);
      		
      	}
  	 	catch(Exception $e)
	    {
	    	$db->rollBack();
      		throw $e;
	    }
	    $this->_redirect("index/manageconrolledlist/rt_types/".$rt_types);
      
  	}
	
}

