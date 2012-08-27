<?php

class IndexController extends Zend_Controller_Action
{

	public $form_values;

	public function init()
	{

	}


	public function loginAction()
	{
		$form = new Application_Form_Login();
		$this->view->form = $form;
			
		$message = '';
		$this->view->message = $message;
			
		if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
		{
			$form_values = $this->view->form->getValues();
			$session_login = new Zend_Session_Namespace('Login');
			$session_login->user = $form_values['user_name'];
			$session_login->password = $form_values['password'];

			$result = $this->verifyLogin();

			if($result)
			$this->_redirect("index/");
			else
			{
				$message = 'Invalid credentials!';
				$this->view->message = $message;
			}

		}
	}


	private function verifyLogin()
	{
		$session_login = new Zend_Session_Namespace('Login');
		$username = $session_login->user;
		$password = md5($session_login->password);
			
		if(!$username)
		$username= '';
		if(!$password)
		$password= '';
		$db = Zend_Db_Table::getDefaultAdapter();
			
		$select = $db->select()
		->from('user')
		->where('user_name = ?', $username)
		->where('password = ?', $password);
		
		$res = $db->query($select)->fetchAll();

		if($res)
		return true;
		else
		return false;
	}

	private function getUser()
	{
		$session_login = new Zend_Session_Namespace('Login');
		$username = $session_login->user;
		$password = md5($session_login->password);
			
		if(!$username)
		$username= '';
		if(!$password)
		$password= '';
		$db = Zend_Db_Table::getDefaultAdapter();
			
		$select = $db->select()
		->from('user')
		->where('user_name = ?', $username)
		->where('password = ?', $password);

		$res = $db->query($select)->fetchAll();

		if($res)
		{
			$this->view->loggedIn = true;
			$this->view->loggedInUser = $res[0]["user_name"];
			$this->view->loggedInUserRole = $res[0]["role"];
		}
		else
		return false;
	}


	public function signoutAction()
	{
		$session_login = new Zend_Session_Namespace('Login');
		unset($session_login->user);
		unset($session_login->password);
		$this->_redirect("index/login");
	}


	public function indexAction()
	{
		$result = $this->verifyLogin();

		if(!$result)
		$this->_redirect("index/login");

		$this->getUser();
		$form = new Application_Form_Search();
		$this->view->form = $form;
			
		$formright = new Application_Form_SearchRight();
		$this->view->formright = $formright;
			
		$form2 = new Application_Form_Search2();
		$this->view->form2 = $form2;

		$db = Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()
		->from(array('rrm'=>'rt_results_main'),array('rrm.id As main_results_id',
				'rrm.rt_published As publish', 
				'rrm.rt_model_year As year', 
				'rrm.rt_controlled_make As make', 
				'rrm.rt_model As model',
				'rrm.rt_issue_year As issue_year',
				'rrm.rt_issue As issue_month', 
				'rrm.rt_controlled_sort As production_type', 
				'rrm.rt_doors As doors', 
				'rrm.rt_controlled_body As body_style',
				'rrm.rt_peak_hp As peak_horse_power'));
			
		if (($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
		|| ($this->getRequest()->isPost() && $formright->isValid($this->getRequest()->getPost()))
		|| ($this->getRequest()->isPost() && $form2->isValid($this->getRequest()->getPost())))
		{

			$this->_helper->redirector->gotoRouteAndExit(array(
		        'page' => 1,
		        'id'   => $this->getRequest()->getPost('id'),
		        'year' => $this->getRequest()->getPost('year'),
		      	'make' => $this->getRequest()->getPost('make'),
          	    'model' => $this->getRequest()->getPost('model'),
          	    'submodel' => $this->getRequest()->getPost('submodel'),
          	 	'name' => $this->getRequest()->getPost('name'),
			));

		}
		else
		{
			$form->getElement('id')->setValue($this->_getParam('id'));
			$formright->getElement('year')->setValue($this->_getParam('year'));
			$formright->getElement('make')->setValue($this->_getParam('make'));
			$formright->getElement('model')->setValue($this->_getParam('model'));
			$formright->getElement('submodel')->setValue($this->_getParam('submodel'));
			$form2->getElement('name')->setValue($this->_getParam('name'));

		}
		$export_array = array();
		$export_array['id'] = '';
		$export_array['year'] = '';
		$export_array['make'] = '';
		$export_array['model'] = '';
		$export_array['submodel'] = '';
		$export_array['name'] = '';
		if(($this->_getParam('id')))
		{
			$select->where('rrm.id =?', $this->_getParam('id'));
			$export_array['id'] = $this->_getParam('id');

		}
		if(($this->_getParam('year')))
		{
			$select->where('rrm.bg_year_id =?', $this->_getParam('year'));
			$export_array['year'] = $this->_getParam('year');
		}
		if(($this->_getParam('model')))
		{
			$select->where('rrm.bg_model_id =?', $this->_getParam('model'));
			$export_array['model'] = $this->_getParam('model');
		}
		if(($this->_getParam('make')))
		{
			$select->where('rrm.bg_make_id =?', $this->_getParam('make'));
			$export_array['make'] = $this->_getParam('make');
		}
		if(($this->_getParam('submodel')))
		{
			$select->where('rrm.bg_submodel_id =?', $this->_getParam('submodel'));
			$export_array['submodel'] = $this->_getParam('submodel');
		}
		if(($this->_getParam('name')))
		{
			$export_array['name'] = $this->_getParam('name');
			$select1 = $db->select()
			->from(array('rdd'=>'rt_dropdown_descriptions'),array('rdd.id_descriptions As id'))
			->where('rdd.description =?', $this->_getParam('name'));
			$result = $db->query($select1)->fetchAll();
			if(!empty($result))
			$select->orWhere('rrm.rt_controlled_make =?', $result[0]['id']);
			$select->orWhere('rrm.rt_model =?', $this->_getParam('name'));
			$select->orWhere('rrm.rt_model_year =?', $this->_getParam('name'));
		}

		//$select->where('rrm.bg_year_id =?', '1956');
		$export_result = $db->query($select)->fetchAll();

		require_once('Zend/Session.php');
		$session_export = new Zend_Session_Namespace('export');
		$session_export->export = $export_array;
			
		$result = Zend_Paginator::factory($export_result);
		$this->view->paginator = $result;
		$this->view->paginator->setItemCountPerPage(25);
		$this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );
		$this->view->paginator->setPageRange(5);
	}


	public function addAction()
	{
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");

		$this->getUser();
		$form = new Application_Form_Add();
		$this->view->form = $form;

		if($this->view->loggedInUserRole == 2)
		{
			$form->removeElement("review_cganges");
			$form->removeElement("cancel");
		}

		if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
		{
			if(isset($_POST['cancel']))
			{
				$this->_redirect("index/");
			}
			$form_values = $this->view->form->getValues();

			require_once('Zend/Session.php');
			$session_formvalues = new Zend_Session_Namespace('FormValues');
			$session_formvalues->FormValues = $form_values;

			//print_r($form_values);
			//exit;

			$this->_redirect("index/review/");

		}
			
	}


	public function reviewAction()
	{
		$result = $this->verifyLogin();
			
		if(!$result)
			$this->_redirect("index/login");

		$this->getUser();
		
		if($this->view->loggedInUserRole == 2)
			$this->_redirect("index");
			
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
			$session_formvalues = new Zend_Session_Namespace('FormValues');
			//print_r($session_formvalues->FormValues);
			//print_r($review_values);
			//exit;

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
			$filename ="";
			if(isset($review_values['image'])) {
				// upload the picture
				$review->image->receive();
				$filename = $review_values['image'];
			}
			else
			{
				$filename = $session_formvalues->FormValues["image1"];
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

			$rt_results_level_3['first_stop_70'] = $review_values['first_stop_70'];
			$rt_results_level_3['longest_stop70'] = $review_values['longest_stop70'];
			$rt_results_level_3['transaction_off'] = $review_values['transaction_off'];
			$rt_results_level_3['partially_defeatable'] = $review_values['partially_defeatable'];
			$rt_results_level_3['fully_defeatable'] = $review_values['fully_defeatable'];
			$rt_results_level_3['competition_mode'] = $review_values['competition_mode'];
			$rt_results_level_3['launch_control'] = $review_values['launch_control'];
			$rt_results_level_3['permanent'] = $review_values['permanent'];
			$rt_results_level_3['center_of_gravity_height'] = $review_values['center_of_gravity_height'];
			$rt_results_level_3['skidpad_diameter'] = $review_values['skidpad_diameter'];
			$rt_results_level_3['test_notes'] = $review_values['test_notes'];
			$rt_results_level_3['test_location'] = $review_values['test_location'];
			$rt_results_level_3['test_location_detail'] = $review_values['test_location_detail'];
			$rt_results_level_3['tester'] = $review_values['tester'];
			$rt_results_level_3['image'] = $filename;
			$rt_results_level_3['url_for_story_relationship'] = $review_values['url_for_story_relationship'];
			$rt_results_level_3['ez_id'] = $review_values['ez_id'];
			$rt_results_level_3['suppress_public_display'] = $review_values['suppress_public_display'];


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
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");

		$this->getUser();
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
		$this->view->label = "Edit";
		if($this->view->loggedInUserRole == 2)
		{
			$form->removeElement("review_cganges");
			$form->removeElement("cancel");
			$this->view->label = "View";
		}
		// Populate form
		$form->populate($results);
			
		$this->view->form = $form;
			
		if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
		{
			if(isset($_POST['cancel']))
			{
				$this->_redirect("index/");
			}
			$form_values = $this->view->form->getValues();

			require_once('Zend/Session.php');
			$session1 = new Zend_Session_Namespace('FormValues');
			$session1->FormValues = $form_values;

			$this->_redirect("index/reviewedit/id/".$this->_getParam('id'));

		}

	}


	public function deleteAction()
	{
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");
		if($this->view->loggedInUserRole == 2 || $this->view->loggedInUserRole == 1)
			$this->_redirect("index");
			
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete("rt_results_main", "id=" .$this->_getParam('id'));
		$db->delete("rt_results_level_2", "id=" .$this->_getParam('id'));
		$db->delete("rt_results_level_3", "id=" .$this->_getParam('id'));
			
		$this->_redirect("index/");
	}


	public function revieweditAction()
	{
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");

		$this->getUser();
		if($this->view->loggedInUserRole == 2)
			$this->_redirect("index");
		
		$db = Zend_Db_Table::getDefaultAdapter();

		$this->view->id = $this->_getParam('id');

		$review = new Application_Form_Reviewedit($this->_getParam('id'));
			
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

			if(isset($_POST['ClearImage']))
			{
				$data = array(
    				'image'      => NULL,
				);
				$where[] = "id = ".$this->_getParam('id');
				$db->update("rt_results_level_3", $data, $where);
				$this->_redirect("index/");
			}

			$select = $db->select()
			->from('rt_results_main')
			->where('id = ?', $this->_getParam('id'));
			$rt_results_main_before =  $db->query($select)->fetchAll();

			$select = $db->select()
			->from('rt_results_level_2')
			->where('id = ?', $this->_getParam('id'));
			$rt_results_level_2_before =  $db->query($select)->fetchAll();

			$select = $db->select()
			->from('rt_results_level_3')
			->where('id = ?', $this->_getParam('id'));
			$rt_results_level_3_before =  $db->query($select)->fetchAll();

			$rt_results_main = array();
			$rt_results_level_2 = array();
			$rt_results_level_3 = array();

			$review_values = $this->view->form->getValues();

			//print_r($review_values);
			//print_r($rt_results_level_3_before);

			if($review_values['rt_model_year'] != $rt_results_main_before['rt_model_year'])
			$rt_results_main['rt_model_year'] = $review_values['rt_model_year'];

			if($review_values['bg_make_id'] != $rt_results_main_before['bg_make_id'])
			$rt_results_main['bg_make_id'] = $review_values['bg_make_id'];

			if($review_values['rt_published'] != $rt_results_main_before['rt_published'])
			$rt_results_main['rt_published'] = $review_values['rt_published'];

			if($review_values['bg_model_id'] != $rt_results_main_before['bg_model_id'])
			$rt_results_main['bg_model_id'] = $review_values['bg_model_id'];

			if(isset($review_values['rt_issue']) || $review_values['rt_issue'] != $rt_results_main_before['rt_issue'])
			$rt_results_main['rt_issue'] = $review_values['rt_issue'];

			if($review_values['bg_submodel_id'] != $rt_results_main_before['bg_submodel_id'])
			$rt_results_main['bg_submodel_id'] = $review_values['bg_submodel_id'];

			if(isset($review_values['rt_issue_year']) || $review_values['rt_issue_year'] != $rt_results_main_before['rt_issue_year'])
			$rt_results_main['rt_issue_year'] = $review_values['rt_issue_year'];

			if($review_values['bg_year_id'] != $rt_results_main_before['bg_year_id'])
			$rt_results_main['bg_year_id'] = $review_values['bg_year_id'];

			if(isset($review_values['rt_percent_on_rear']) || $review_values['rt_percent_on_rear'] != $rt_results_main_before['rt_percent_on_rear'])
			$rt_results_main['rt_percent_on_rear'] = $review_values['rt_percent_on_rear'];

			if(isset($review_values['bg_controlled_make_id']) || $review_values['bg_controlled_make_id'] != $rt_results_main_before['bg_controlled_make_id'])
			$rt_results_main['bg_controlled_make_id'] = $review_values['bg_controlled_make_id'];

			if(isset($review_values['rt_percent_on_front']) || $review_values['rt_percent_on_front'] != $rt_results_main_before['rt_percent_on_front'])
			$rt_results_main['rt_percent_on_front'] = $review_values['rt_percent_on_front'];

			if(isset($review_values['bg_controlled_model_id']) || $review_values['bg_controlled_model_id'] != $rt_results_main_before['bg_controlled_model_id'])
			$rt_results_main['bg_controlled_model_id'] = $review_values['bg_controlled_model_id'];

			if(isset($review_values['rt_60_mph']) || $review_values['rt_60_mph'] != $rt_results_main_before['rt_60_mph'])
			$rt_results_main['rt_60_mph'] = $review_values['rt_60_mph'];

			if(isset($review_values['rt_original_table_id']) || $review_values['rt_original_table_id'] != $rt_results_main_before['rt_original_table_id'])
			$rt_results_main['rt_original_table_id'] = $review_values['rt_original_table_id'];

			if(isset($review_values['rt_70_mph_braking']) || $review_values['rt_70_mph_braking'] != $rt_results_main_before['rt_70_mph_braking'])
			$rt_results_main['rt_70_mph_braking'] = $review_values['rt_70_mph_braking'];

			if($review_values['rt_controlled_body'] != $rt_results_main_before['rt_controlled_body'])
			$rt_results_main['rt_controlled_body'] = $review_values['rt_controlled_body'];

			if( isset($review_values['rt_top_speed']) || $review_values['rt_top_speed'] != $rt_results_main_before['rt_top_speed'])
			$rt_results_main['rt_top_speed'] = $review_values['rt_top_speed'];

			if($review_values['rt_controlled_engine'] != $rt_results_main_before['rt_controlled_engine'])
			$rt_results_main['rt_controlled_engine'] = $review_values['rt_controlled_engine'];

			if(isset($review_values['rt_top_speed_notes']) || $review_values['rt_top_speed_notes'] != $rt_results_main_before['rt_top_speed_notes'])
			$rt_results_main['rt_top_speed_notes'] = $review_values['rt_top_speed_notes'];

			if($review_values['rt_controlled_fuel'] != $rt_results_main_before['rt_controlled_fuel'])
			$rt_results_main['rt_controlled_fuel'] = $review_values['rt_controlled_fuel'];

			if($review_values['rt_controlled_make'] != $rt_results_main_before['rt_controlled_make'])
			$rt_results_main['rt_controlled_make'] = $review_values['rt_controlled_make'];

			if(isset($review_values['rt_base_price_notes']) || $review_values['rt_base_price_notes'] != $rt_results_main_before['rt_base_price_notes'])
			$rt_results_main['rt_base_price_notes'] = $review_values['rt_base_price_notes'];

			if(isset($review_values['rt_base_price']) || $review_values['rt_base_price'] != $rt_results_main_before['rt_base_price'])
			$rt_results_main['rt_base_price'] = $review_values['rt_base_price'];

			if($review_values['rt_controlled_sort'] != $rt_results_main_before['rt_controlled_sort'])
			$rt_results_main['rt_controlled_sort'] = $review_values['rt_controlled_sort'];

			if(isset($review_values['rt_speed_qtr_mile_speed_trap']) || $review_values['rt_speed_qtr_mile_speed_trap'] != $rt_results_main_before['rt_speed_qtr_mile_speed_trap'])
			$rt_results_main['rt_speed_qtr_mile_speed_trap'] = $review_values['rt_speed_qtr_mile_speed_trap'];

			if($review_values['rt_controlled_transmission'] != $rt_results_main_before['rt_controlled_transmission'])
			$rt_results_main['rt_controlled_transmission'] = $review_values['rt_controlled_transmission'];

			if(isset($review_values['rt_quarter_time']) || $review_values['rt_quarter_time'] != $rt_results_main_before['rt_quarter_time'])
			$rt_results_main['rt_quarter_time'] = $review_values['rt_quarter_time'];

			if($review_values['rt_controlled_drive'] != $rt_results_main_before['rt_controlled_drive'])
			$rt_results_main['rt_controlled_drive'] = $review_values['rt_controlled_drive'];

			if(isset($review_values['rt_doors']) || $review_values['rt_doors'] != $rt_results_main_before['rt_doors'])
			$rt_results_main['rt_doors'] = $review_values['rt_doors'];

			if($review_values['rt_controlled_ts_limit'] != $rt_results_main_before['rt_controlled_ts_limit'])
			$rt_results_main['rt_controlled_ts_limit'] = $review_values['rt_controlled_ts_limit'];

			if(isset($review_values['rt_cd_observed_fe']) || $review_values['rt_cd_observed_fe'] != $rt_results_main_before['rt_cd_observed_fe'])
			$rt_results_main['rt_cd_observed_fe'] = $review_values['rt_cd_observed_fe'];

			if($review_values['rt_controlled_turbo_superchg'] != $rt_results_main_before['rt_controlled_turbo_superchg'])
			$rt_results_main['rt_controlled_turbo_superchg'] = $review_values['rt_controlled_turbo_superchg'];

			if(isset($review_values['rt_no_cyl']) || $review_values['rt_no_cyl'] != $rt_results_main_before['rt_no_cyl'])
			$rt_results_main['rt_no_cyl'] = $review_values['rt_no_cyl'];

			if($review_values['rt_controlled_type'] != $rt_results_main_before['rt_controlled_type'])
			$rt_results_main['rt_controlled_type'] = $review_values['rt_controlled_type'];

			if(isset($review_values['rt_peak_hp']) || $review_values['rt_peak_hp'] != $rt_results_main_before['rt_peak_hp'])
			$rt_results_main['rt_peak_hp'] = $review_values['rt_peak_hp'];

			if(isset($review_values['rt_model']) || $review_values['rt_model'] != $rt_results_main_before['rt_model'])
			$rt_results_main['rt_model'] = $review_values['rt_model'];

			if(isset($review_values['rt_peak_hp_notes']) || $review_values['rt_peak_hp_notes'] != $rt_results_main_before['rt_peak_hp_notes'])
			$rt_results_main['rt_peak_hp_notes'] = $review_values['rt_peak_hp_notes'];

			if(isset($review_values['rt_power_to_weight']) || $review_values['rt_power_to_weight'] != $rt_results_main_before['rt_power_to_weight'])
			$rt_results_main['rt_power_to_weight'] = $review_values['rt_power_to_weight'];

			if(isset($review_values['rt_price_as_tested']) || $review_values['rt_price_as_tested'] != $rt_results_main_before['rt_price_as_tested'])
			$rt_results_main['rt_price_as_tested'] = $review_values['rt_price_as_tested'];

			if(isset($review_values['rt_price_as_tested_notes']) || $review_values['rt_price_as_tested_notes'] != $rt_results_main_before['rt_price_as_tested_notes'])
			$rt_results_main['rt_price_as_tested_notes'] = $review_values['rt_price_as_tested_notes'];

			if(isset($review_values['rt_redline']) || $review_values['rt_redline'] != $rt_results_main_before['rt_redline'])
			$rt_results_main['rt_redline'] = $review_values['rt_redline'];

			if(isset($review_values['rt_disp_cc']) || $review_values['rt_disp_cc'] != $rt_results_main_before['rt_disp_cc'])
			$rt_results_main['rt_disp_cc'] = $review_values['rt_disp_cc'];

			if(isset($review_values['rt_rpm']) || $review_values['rt_rpm'] != $rt_results_main_before['rt_rpm'])
			$rt_results_main['rt_rpm'] = $review_values['rt_rpm'];

			if(isset($review_values['rt_rpmt']) || $review_values['rt_rpmt'] != $rt_results_main_before['rt_rpmt'])
			$rt_results_main['rt_rpmt'] = $review_values['rt_rpmt'];

			if(isset($review_values['rt_slalom']) || $review_values['rt_slalom'] != $rt_results_main_before['rt_slalom'])
			$rt_results_main['rt_slalom'] = $review_values['rt_slalom'];

			if(isset($review_values['rt_ss60']) || $review_values['rt_ss60'] != $rt_results_main_before['rt_ss60'])
			$rt_results_main['rt_ss60'] = $review_values['rt_ss60'];

			if(isset($review_values['rt_weight']) || $review_values['rt_weight'] != $rt_results_main_before['rt_weight'])
			$rt_results_main['rt_weight'] = $review_values['rt_weight'];

			if(isset($review_values['rt_peak_torque']) || $review_values['rt_peak_torque'] != $rt_results_main_before['rt_peak_torque'])
			$rt_results_main['rt_peak_torque'] = $review_values['rt_peak_torque'];

			if(isset($review_values['rt_peak_torque_notes']) || $review_values['rt_peak_torque_notes'] != $rt_results_main_before['rt_peak_torque_notes'])
			$rt_results_main['rt_peak_torque_notes'] = $review_values['rt_peak_torque_notes'];

			$where[] = "id = ".$this->_getParam('id');

			if(sizeof($rt_results_main) > 0)
			{
				try
				{
					$n = $db->update("rt_results_main", $rt_results_main, $where);
				}
				catch(Exception $e)
				{
					$db->rollBack();
					throw $e;

				}
			}

			if(isset($review_values['rt2_emergency_lane_change']) || $review_values['rt2_emergency_lane_change'] != $rt_results_level_2_before['rt2_emergency_lane_change'])
			$rt_results_level_2['rt2_emergency_lane_change'] = $review_values['rt2_emergency_lane_change'];

			if(isset($review_values['rt2_skidpad']) || $review_values['rt2_skidpad'] != $rt_results_level_2_before['rt2_skidpad'])
			$rt_results_level_2['rt2_skidpad'] = $review_values['rt2_skidpad'];

			if(isset($review_values['rt2_100_mph']) || $review_values['rt2_100_mph'] != $rt_results_level_2_before['rt2_100_mph'])
			$rt_results_level_2['rt2_100_mph'] = $review_values['rt2_100_mph'];

			if(isset($review_values['rt2_130_mph']) || $review_values['rt2_130_mph'] != $rt_results_level_2_before['rt2_130_mph'])
			$rt_results_level_2['rt2_130_mph'] = $review_values['rt2_130_mph'];

			if(isset($review_values['rt2_30_50TG']) || $review_values['rt2_30_50TG'] != $rt_results_level_2_before['rt2_30_50TG'])
			$rt_results_level_2['rt2_30_50TG'] = $review_values['rt2_30_50TG'];

			if(isset($review_values['rt2_30_mph']) || $review_values['rt2_30_mph'] != $rt_results_level_2_before['rt2_30_mph'])
			$rt_results_level_2['rt2_30_mph'] = $review_values['rt2_30_mph'];

			if(isset($review_values['rt2_50_70TG']) || $review_values['rt2_50_70TG'] != $rt_results_level_2_before['rt2_50_70TG'])
			$rt_results_level_2['rt2_50_70TG'] = $review_values['rt2_50_70TG'];

			if(isset($review_values['rt2_70cr']) || $review_values['rt2_70cr'] != $rt_results_level_2_before['rt2_70cr'])
			$rt_results_level_2['rt2_70cr'] = $review_values['rt2_70cr'];

			if($review_values['rt2_controlled_airbags'] != $rt_results_level_2_before['rt2_controlled_airbags'])
			$rt_results_level_2['rt2_controlled_airbags'] = $review_values['rt2_controlled_airbags'];

			if(isset($review_values['rt2_anti_lock']) || $review_values['rt2_anti_lock'] != $rt_results_level_2_before['rt2_anti_lock'])
			$rt_results_level_2['rt2_anti_lock'] = $review_values['rt2_anti_lock'];

			if(isset($review_values['rt2_epa_city_fe']) || $review_values['rt2_epa_city_fe'] != $rt_results_level_2_before['rt2_epa_city_fe'])
			$rt_results_level_2['rt2_epa_city_fe'] = $review_values['rt2_epa_city_fe'];

			if(isset($review_values['rt2_epa_city_fe_notes']) || $review_values['rt2_epa_city_fe_notes'] != $rt_results_level_2_before['rt2_epa_city_fe_notes'])
			$rt_results_level_2['rt2_epa_city_fe_notes'] = $review_values['rt2_epa_city_fe_notes'];

			if(isset($review_values['rt2_fuel_sys']) || $review_values['rt2_fuel_sys'] != $rt_results_level_2_before['rt2_fuel_sys'])
			$rt_results_level_2['rt2_fuel_sys'] = $review_values['rt2_fuel_sys'];

			if(isset($review_values['rt2_highway_fe']) || $review_values['rt2_highway_fe'] != $rt_results_level_2_before['rt2_highway_fe'])
			$rt_results_level_2['rt2_highway_fe'] = $review_values['rt2_highway_fe'];

			if(isset($review_values['rt2_highway_fe_notes']) || $review_values['rt2_highway_fe_notes'] != $rt_results_level_2_before['rt2_highway_fe_notes'])
			$rt_results_level_2['rt2_highway_fe_notes'] = $review_values['rt2_highway_fe_notes'];

			if(isset($review_values['rt2_int_vol_front']) || $review_values['rt2_int_vol_front'] != $rt_results_level_2_before['rt2_int_vol_front'])
			$rt_results_level_2['rt2_int_vol_front'] = $review_values['rt2_int_vol_front'];

			if(isset($review_values['rt2_mid']) || $review_values['rt2_mid'] != $rt_results_level_2_before['rt2_mid'])
			$rt_results_level_2['rt2_mid'] = $review_values['rt2_mid'];

			if(isset($review_values['rt2_passengers']) || $review_values['rt2_passengers'] != $rt_results_level_2_before['rt2_passengers'])
			$rt_results_level_2['rt2_passengers'] = $review_values['rt2_passengers'];

			if(isset($review_values['rt2_rear']) || $review_values['rt2_rear'] != $rt_results_level_2_before['rt2_rear'])
			$rt_results_level_2['rt2_rear'] = $review_values['rt2_rear'];

			if(isset($review_values['rt2_sound_level_idle']) || $review_values['rt2_sound_level_idle'] != $rt_results_level_2_before['rt2_sound_level_idle'])
			$rt_results_level_2['rt2_sound_level_idle'] = $review_values['rt2_sound_level_idle'];

			if(isset($review_values['rt2_stab_defeatable']) || $review_values['rt2_stab_defeatable'] != $rt_results_level_2_before['rt2_stab_defeatable'])
			$rt_results_level_2['rt2_stab_defeatable'] = $review_values['rt2_stab_defeatable'];

			if(isset($review_values['rt2_stability_control']) || $review_values['rt2_stability_control'] != $rt_results_level_2_before['rt2_stability_control'])
			$rt_results_level_2['rt2_stability_control'] = $review_values['rt2_stability_control'];

			if(isset($review_values['rt2_sum_of_tg_times']) || $review_values['rt2_sum_of_tg_times'] != $rt_results_level_2_before['rt2_sum_of_tg_times'])
			$rt_results_level_2['rt2_sum_of_tg_times'] = $review_values['rt2_sum_of_tg_times'];

			if(isset($review_values['rt2_trac_defeatable']) || $review_values['rt2_trac_defeatable'] != $rt_results_level_2_before['rt2_trac_defeatable'])
			$rt_results_level_2['rt2_trac_defeatable'] = $review_values['rt2_trac_defeatable'];

			if(isset($review_values['rt2_traction_control']) || $review_values['rt2_traction_control'] != $rt_results_level_2_before['rt2_traction_control'])
			$rt_results_level_2['rt2_traction_control'] = $review_values['rt2_traction_control'];

			if(isset($review_values['rt2_turning_cir']) || $review_values['rt2_turning_cir'] != $rt_results_level_2_before['rt2_turning_cir'])
			$rt_results_level_2['rt2_turning_cir'] = $review_values['rt2_turning_cir'];

			if(isset($review_values['rt2_wot']) || $review_values['rt2_wot'] != $rt_results_level_2_before['rt2_wot'])
			$rt_results_level_2['rt2_wot'] = $review_values['rt2_wot'];

			if(isset($review_values['rt2_50_mph']) || $review_values['rt2_50_mph'] != $rt_results_level_2_before['rt2_50_mph'])
			$rt_results_level_2['rt2_50_mph'] = $review_values['rt2_50_mph'];

			if(isset($review_values['rt2_70_mph']) || $review_values['rt2_70_mph'] != $rt_results_level_2_before['rt2_70_mph'])
			$rt_results_level_2['rt2_70_mph'] = $review_values['rt2_70_mph'];

			if(sizeof($rt_results_level_2) > 0)
			{
				try
				{
					$n = $db->update("rt_results_level_2", $rt_results_level_2, $where);
				}
				catch(Exception $e)
				{
					$db->rollBack();
					throw $e;

				}
			}
			$filename = "";
			if(isset($review_values['image'])) {
				$filename = $review_values['image'];
				$review->image->receive();
			}
			else
			{
				$filename = $review_values["image1"];
			}
			//echo "uploaded file name -". $filename;

			if(isset($review_values['rt3_boost_psi']) || $review_values['rt3_boost_psi'] != $rt_results_level_3_before['rt3_boost_psi'])
			$rt_results_level_3['rt3_boost_psi'] = $review_values['rt3_boost_psi'];

			if(isset($review_values['rt3_bore_mm']) || $review_values['rt3_bore_mm'] != $rt_results_level_3_before['rt3_bore_mm'])
			$rt_results_level_3['rt3_bore_mm'] = $review_values['rt3_bore_mm'];

			if(isset($review_values['rt3_cd']) || $review_values['rt3_cd'] != $rt_results_level_3_before['rt3_cd'])
			$rt_results_level_3['rt3_cd'] = $review_values['rt3_cd'];

			if(isset($review_values['rt3_comp_ratio']) || $review_values['rt3_comp_ratio'] != $rt_results_level_3_before['rt3_comp_ratio'])
			$rt_results_level_3['rt3_comp_ratio'] = $review_values['rt3_comp_ratio'];

			if(isset($review_values['rt3_final_drive_ratio']) || $review_values['rt3_final_drive_ratio'] != $rt_results_level_3_before['rt3_final_drive_ratio'])
			$rt_results_level_3['rt3_final_drive_ratio'] = $review_values['rt3_final_drive_ratio'];

			if(isset($review_values['rt3_frontal_area']) || $review_values['rt3_frontal_area'] != $rt_results_level_3_before['rt3_frontal_area'])
			$rt_results_level_3['rt3_frontal_area'] = $review_values['rt3_frontal_area'];

			if(isset($review_values['rt3_frontal_area_notes']) || $review_values['rt3_frontal_area_notes'] != $rt_results_level_3_before['rt3_frontal_area_notes'])
			$rt_results_level_3['rt3_frontal_area_notes'] = $review_values['rt3_frontal_area_notes'];

			if(isset($review_values['rt3_fuel_cap']) || $review_values['rt3_fuel_cap'] != $rt_results_level_3_before['rt3_fuel_cap'])
			$rt_results_level_3['rt3_fuel_cap'] = $review_values['rt3_fuel_cap'];

			if(isset($review_values['rt3_height']) || $review_values['rt3_height'] != $rt_results_level_3_before['rt3_height'])
			$rt_results_level_3['rt3_height'] = $review_values['rt3_height'];

			if(isset($review_values['rt3_length']) || $review_values['rt3_length'] != $rt_results_level_3_before['rt3_length'])
			$rt_results_level_3['rt3_length'] = $review_values['rt3_length'];

			if(isset($review_values['rt3_lt_oil']) || $review_values['rt3_lt_oil'] != $rt_results_level_3_before['rt3_lt_oil'])
			$rt_results_level_3['rt3_lt_oil'] = $review_values['rt3_lt_oil'];

			if(isset($review_values['rt3_lt_repair']) || $review_values['rt3_lt_repair'] != $rt_results_level_3_before['rt3_lt_repair'])
			$rt_results_level_3['rt3_lt_repair'] = $review_values['rt3_lt_repair'];

			if(isset($review_values['rt3_lt_serv']) || $review_values['rt3_lt_serv'] != $rt_results_level_3_before['rt3_lt_serv'])
			$rt_results_level_3['rt3_lt_serv'] = $review_values['rt3_lt_serv'];

			if(isset($review_values['rt3_lt_stps_sched']) || $review_values['rt3_lt_stps_sched'] != $rt_results_level_3_before['rt3_lt_stps_sched'])
			$rt_results_level_3['rt3_lt_stps_sched'] = $review_values['rt3_lt_stps_sched'];

			if(isset($review_values['rt3_lt_stps_sched']) || $review_values['rt3_lt_stps_sched'] != $rt_results_level_3_before['rt3_lt_stps_sched'])
			$rt_results_level_3['rt3_lt_stps_unsched'] = $review_values['rt3_lt_stps_unsched'];

			if(isset($review_values['rt3_lt_wear']) || $review_values['rt3_lt_wear'] != $rt_results_level_3_before['rt3_lt_wear'])
			$rt_results_level_3['rt3_lt_wear'] = $review_values['rt3_lt_wear'];

			if(isset($review_values['rt3_max_mph_1000_rpm']) || $review_values['rt3_max_mph_1000_rpm'] != $rt_results_level_3_before['rt3_max_mph_1000_rpm'])
			$rt_results_level_3['rt3_max_mph_1000_rpm'] = $review_values['rt3_max_mph_1000_rpm'];

			if(isset($review_values['rt3_specific_power']) || $review_values['rt3_specific_power'] != $rt_results_level_3_before['rt3_specific_power'])
			$rt_results_level_3['rt3_specific_power'] = $review_values['rt3_specific_power'];

			if(isset($review_values['rt3_stroke_mm']) || $review_values['rt3_stroke_mm'] != $rt_results_level_3_before['rt3_stroke_mm'])
			$rt_results_level_3['rt3_stroke_mm'] = $review_values['rt3_stroke_mm'];

			if(isset($review_values['rt3_trunk']) || $review_values['rt3_trunk'] != $rt_results_level_3_before['rt3_trunk'])
			$rt_results_level_3['rt3_trunk'] = $review_values['rt3_trunk'];

			if(isset($review_values['rt3_valve_gear']) || $review_values['rt3_valve_gear'] != $rt_results_level_3_before['rt3_valve_gear'])
			$rt_results_level_3['rt3_valve_gear'] = $review_values['rt3_valve_gear'];

			if(isset($review_values['rt3_width']) || $review_values['rt3_width'] != $rt_results_level_3_before['rt3_width'])
			$rt_results_level_3['rt3_width'] = $review_values['rt3_width'];

			if(isset($review_values['rt3_valves_per_cyl']) || $review_values['rt3_valves_per_cyl'] != $rt_results_level_3_before['rt3_valves_per_cyl'])
			$rt_results_level_3['rt3_valves_per_cyl'] = $review_values['rt3_valves_per_cyl'];

			if(isset($review_values['rt3_wheelbase']) || $review_values['rt3_wheelbase'] != $rt_results_level_3_before['rt3_wheelbase'])
			$rt_results_level_3['rt3_wheelbase'] = $review_values['rt3_wheelbase'];

			if(isset($review_values['rt3_70co']) || $review_values['rt3_70co'] != $rt_results_level_3_before['rt3_70co'])
			$rt_results_level_3['rt3_70co'] = $review_values['rt3_70co'];

			if(isset($review_values['rt3_10mph']) || $review_values['rt3_10mph'] != $rt_results_level_3_before['rt3_10mph'])
			$rt_results_level_3['rt3_10mph'] = $review_values['rt3_10mph'];

			if(isset($review_values['rt3_20mph']) || $review_values['rt3_20mph'] != $rt_results_level_3_before['rt3_20mph'])
			$rt_results_level_3['rt3_20mph'] = $review_values['rt3_20mph'];

			if(isset($review_values['rt3_40mph']) || $review_values['rt3_40mph'] != $rt_results_level_3_before['rt3_40mph'])
			$rt_results_level_3['rt3_40mph'] = $review_values['rt3_40mph'];

			if(isset($review_values['rt3_50mph']) || $review_values['rt3_50mph'] != $rt_results_level_3_before['rt3_50mph'])
			$rt_results_level_3['rt3_50mph'] = $review_values['rt3_50mph'];

			if(isset($review_values['rt3_70mph']) || $review_values['rt3_70mph'] != $rt_results_level_3_before['rt3_70mph'])
			$rt_results_level_3['rt3_70mph'] = $review_values['rt3_70mph'];

			if(isset($review_values['rt3_80mph']) || $review_values['rt3_80mph'] != $rt_results_level_3_before['rt3_80mph'])
			$rt_results_level_3['rt3_80mph'] = $review_values['rt3_80mph'];

			if(isset($review_values['rt3_90mph']) || $review_values['rt3_90mph'] != $rt_results_level_3_before['rt3_90mph'])
			$rt_results_level_3['rt3_90mph'] = $review_values['rt3_90mph'];

			if(isset($review_values['rt3_110mph']) || $review_values['rt3_110mph'] != $rt_results_level_3_before['rt3_110mph'])
			$rt_results_level_3['rt3_110mph'] = $review_values['rt3_110mph'];

			if(isset($review_values['rt3_120mph']) || $review_values['rt3_120mph'] != $rt_results_level_3_before['rt3_120mph'])
			$rt_results_level_3['rt3_120mph'] = $review_values['rt3_120mph'];

			if(isset($review_values['rt3_140mph']) || $review_values['rt3_140mph'] != $rt_results_level_3_before['rt3_140mph'])
			$rt_results_level_3['rt3_140mph'] = $review_values['rt3_140mph'];

			if(isset($review_values['rt3_150mph']) || $review_values['rt3_150mph'] != $rt_results_level_3_before['rt3_150mph'])
			$rt_results_level_3['rt3_150mph'] = $review_values['rt3_150mph'];

			if(isset($review_values['rt3_160mph']) || $review_values['rt3_160mph'] != $rt_results_level_3_before['rt3_160mph'])
			$rt_results_level_3['rt3_160mph'] = $review_values['rt3_160mph'];

			if(isset($review_values['rt3_170mph']) || $review_values['rt3_170mph'] != $rt_results_level_3_before['rt3_170mph'])
			$rt_results_level_3['rt3_170mph'] = $review_values['rt3_170mph'];

			if(isset($review_values['rt3_180mph']) || $review_values['rt3_180mph'] != $rt_results_level_3_before['rt3_180mph'])
			$rt_results_level_3['rt3_180mph'] = $review_values['rt3_180mph'];

			if(isset($review_values['rt3_190mph']) || $review_values['rt3_190mph'] != $rt_results_level_3_before['rt3_190mph'])
			$rt_results_level_3['rt3_190mph'] = $review_values['rt3_190mph'];

			if(isset($review_values['rt3_200mph']) || $review_values['rt3_200mph'] != $rt_results_level_3_before['rt3_200mph'])
			$rt_results_level_3['rt3_200mph'] = $review_values['rt3_200mph'];

			if(isset($review_values['rt3_et_factor']) || $review_values['rt3_et_factor'] != $rt_results_level_3_before['rt3_et_factor'])
			$rt_results_level_3['rt3_et_factor'] = $review_values['rt3_et_factor'];

			if(isset($review_values['rt3_road_hp_30mph']) || $review_values['rt3_road_hp_30mph'] != $rt_results_level_3_before['rt3_road_hp_30mph'])
			$rt_results_level_3['rt3_road_hp_30mph'] = $review_values['rt3_road_hp_30mph'];

			if(isset($review_values['rt3_sp_factor']) || $review_values['rt3_sp_factor'] != $rt_results_level_3_before['rt3_sp_factor'])
			$rt_results_level_3['rt3_sp_factor'] = $review_values['rt3_sp_factor'];

			if(isset($review_values['rt3_peak_bmep']) || $review_values['rt3_peak_bmep'] != $rt_results_level_3_before['rt3_peak_bmep'])
			$rt_results_level_3['rt3_peak_bmep'] = $review_values['rt3_peak_bmep'];

			if(isset($review_values['rt3_peal_bmep']) || $review_values['rt3_peal_bmep'] != $rt_results_level_3_before['rt3_peal_bmep'])
			$rt_results_level_3['rt3_peal_bmep'] = $review_values['rt3_peal_bmep'];

			if(isset($review_values['first_stop_70']) || $review_values['first_stop_70'] != $rt_results_level_3_before['first_stop_70'])
			$rt_results_level_3['first_stop_70'] = $review_values['first_stop_70'];

			if(isset($review_values['longest_stop70']) || $review_values['longest_stop70'] != $rt_results_level_3_before['longest_stop70'])
			$rt_results_level_3['longest_stop70'] = $review_values['longest_stop70'];

			if(isset($review_values['transaction_off']) || $review_values['transaction_off'] != $rt_results_level_3_before['transaction_off'])
			$rt_results_level_3['transaction_off'] = $review_values['transaction_off'];

			if(isset($review_values['partially_defeatable']) || $review_values['partially_defeatable'] != $rt_results_level_3_before['partially_defeatable'])
			$rt_results_level_3['partially_defeatable'] = $review_values['partially_defeatable'];

			if(isset($review_values['fully_defeatable']) || $review_values['fully_defeatable'] != $rt_results_level_3_before['fully_defeatable'])
			$rt_results_level_3['fully_defeatable'] = $review_values['fully_defeatable'];

			if(isset($review_values['competition_mode']) || $review_values['competition_mode'] != $rt_results_level_3_before['competition_mode'])
			$rt_results_level_3['competition_mode'] = $review_values['competition_mode'];

			if(isset($review_values['launch_control']) || $review_values['launch_control'] != $rt_results_level_3_before['launch_control'])
			$rt_results_level_3['launch_control'] = $review_values['launch_control'];

			if(isset($review_values['permanent']) || $review_values['permanent'] != $rt_results_level_3_before['permanent'])
			$rt_results_level_3['permanent'] = $review_values['permanent'];

			if(isset($review_values['center_of_gravity_height']) || $review_values['center_of_gravity_height'] != $rt_results_level_3_before['center_of_gravity_height'])
			$rt_results_level_3['center_of_gravity_height'] = $review_values['center_of_gravity_height'];

			if(isset($review_values['skidpad_diameter']) || $review_values['skidpad_diameter'] != $rt_results_level_3_before['skidpad_diameter'])
			$rt_results_level_3['skidpad_diameter'] = $review_values['skidpad_diameter'];

			if(isset($review_values['test_notes']) || $review_values['test_notes'] != $rt_results_level_3_before['test_notes'])
			$rt_results_level_3['test_notes'] = $review_values['test_notes'];

			if(isset($review_values['test_location']) || $review_values['test_location'] != $rt_results_level_3_before['test_location'])
			$rt_results_level_3['test_location'] = $review_values['test_location'];

			if(isset($review_values['test_location_detail']) || $review_values['test_location_detail'] != $rt_results_level_3_before['test_location_detail'])
			$rt_results_level_3['test_location_detail'] = $review_values['test_location_detail'];

			if(isset($review_values['tester']) || $review_values['tester'] != $rt_results_level_3_before['tester'])
			$rt_results_level_3['tester'] = $review_values['tester'];

			if(isset($review_values['image']) || $review_values['image'] != $rt_results_level_3_before['image'])
			$rt_results_level_3['image'] = $filename;
			else
			$rt_results_level_3['image'] = $filename;



			if(isset($review_values['url_for_story_relationship']) || $review_values['url_for_story_relationship'] != $rt_results_level_3_before['url_for_story_relationship'])
			$rt_results_level_3['url_for_story_relationship'] = $review_values['url_for_story_relationship'];

			if(isset($review_values['ez_id']) || $review_values['ez_id'] != $rt_results_level_3_before['ez_id'])
			$rt_results_level_3['ez_id'] = $review_values['ez_id'];

			if(isset($review_values['suppress_public_display']) || $review_values['suppress_public_display'] != $rt_results_level_3_before['suppress_public_display'])
			$rt_results_level_3['suppress_public_display'] = $review_values['suppress_public_display'];

			if(sizeof($rt_results_level_3) > 0)
			{
				try
				{
					$n = $db->update("rt_results_level_3", $rt_results_level_3, $where);
				}
				catch(Exception $e)
				{
					$db->rollBack();
					throw $e;

				}

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
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");

		$this->getUser();
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
			->from(array('rdd' => 'rt_dropdown_descriptions'), array('rdl.id As id_desp', 'rdd.description As description'))
			->joininner(array('rdl' => 'rt_dropdown_lookup'), 'rdl.id_descriptions = rdd.id_descriptions')
			->where('rdl.id_types =?', $this->_getParam('rt_types'))
			->order('rdd.description ASC');
			$res = $db->query($select)->fetchAll();
			$this->view->results = $res;
			$this->view->rt_type = $this->_getParam('rt_types');
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
		$db_remote = $this->getDbConnection();
			
		if($makeid)
		{
			require_once('Zend/Session.php');
			$session_makeid = new Zend_Session_Namespace('makeid');
			$session_makeid->make_id = $makeid;
			//$_SESSION['makid'] = $makeid;
		}
			
		$select = $db_remote->select()
		->from('bg_model')
		->where('make_id = ?', $makeid)
		->order('name ASC');

		$bg_model_ids = $db_remote->query($select)->fetchAll();

		//if (count($bg_model_ids)!=0){
		foreach ($bg_model_ids as $Mod){
			$name = $Mod['name'];
			$id = $Mod['id'];
			$return .= $id.'~'.$name.';';
			//}
		}
		/*$models_prepared[0]= "Select or Leave blank";
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
		 }*/
		echo $return;
	}

	public function populatesubmodelAction()
	{
		$return = '0~Select or Leave blank;';
		$yearid = $this->_getParam('yearid');
		$modelid = $this->_getParam('modelid');
		$db_remote = $this->getDbConnection();
		if($yearid && $modelid)
		{
			require_once('Zend/Session.php');
			$session_yearid = new Zend_Session_Namespace('yearid');
			$session_yearid->year_id = $yearid;
			$session_yearid->model_id = $modelid;
		}
		/*$objDOM = new DOMDocument();
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
		 $xml = file_get_contents("http://buyersguide.caranddriver.com/api/submodels/bymodelid?id=".$modelid."&mode=xml");
		 $xml = str_replace("10best", "best10", $xml);

		 $objDOM = new DOMDocument();
		 $objDOM->loadXML($xml);
		 $xpath = new DOMXPath($objDOM);
		 $query = '//response/data/row/model_id';

		 $entries = $xpath->query($query);
		 foreach( $entries as $entry)
		 {
		 if($yearid == $entry->nextSibling->nodeValue)
		 {
		 $name  = $entry->previousSibling->nodeValue;
		 $id  = $entry->previousSibling->previousSibling->nodeValue;
		 $return .= $id.'~'.$name.';';
		 }
		 }*/

		$select = $db_remote->select()
		->from('bg_submodel')
		->where('model_id = ?', $modelid)
		->where('year_id = ?', $yearid)
		->order('name ASC');
		$bg_submodel_ids = $db_remote->query($select)->fetchAll();

		//if (count($bg_model_ids)!=0){
		foreach ($bg_submodel_ids as $Mod){
			$name = $Mod['name'];
			$id = $Mod['id'];
			$return .= $id.'~'.$name.';';
			//}
		}
			
		echo $return;
	}


	public function csvexportAction()
	{
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");
			
		$session_export = new Zend_Session_Namespace('export');
		$export_array = $session_export->export;

		set_time_limit(600);

		$db = Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()
		->from(array('rrm'=>'rt_results_main'),array('rrm.id As main_results_id',
         'rrm.rt_published As publish', 
		'rrm.rt_model_year As year', 
		'rrm.rt_controlled_make As make', 
		'rrm.rt_model As model',
		'rrm.rt_issue_year As issue_year',
		'rrm.rt_issue As issue_month', 
		'rrm.rt_controlled_sort As production_type', 
		'rrm.rt_doors As doors', 
		'rrm.rt_controlled_body As body_style',
		'rrm.rt_peak_hp As peak_horse_power',
		'rrm.bg_make_id As Make(BG)',
		'rrm.bg_model_id As Model(BG)',
		'rrm.bg_submodel_id As Sub-Model(BG)',
		'rrm.bg_year_id AS Year(BG)',
		'rrm.bg_controlled_make_id AS bg_controlled_make_id ',
		'rrm.bg_controlled_model_id AS bg_controlled_model_id',
		'rrm.rt_original_table_id As rt_original_table_id',
		'rrm.rt_controlled_engine AS Engine_Location',
		'rrm.rt_controlled_fuel As Fuel_Type',
		'rrm.rt_controlled_transmission As Transmission_Type',
		'rrm.rt_controlled_drive As Driven_Wheels',
		'rrm.rt_controlled_ts_limit As Top_Speed_Limit',
		'rrm.rt_controlled_turbo_superchg As Forced_Induction',
		'rrm.rt_controlled_type As Engine_Type',
		'rrm.rt_percent_on_rear As Pct_Weight_on_Rear',
		'rrm.rt_percent_on_front As Pct_Weight_on_Front',
		'rrm.rt_60_mph As 0-60_Accel',
		'rrm.rt_70_mph_braking As Braking_from_70',
		'rrm.rt_top_speed As Top_Speed',
		'rrm.rt_top_speed_notes As Top_Speed_Notes',
		'rrm.rt_base_price As Base_Price',
		'rrm.rt_base_price_notes As Base_Price_Notes',
		'rrm.rt_speed_qtr_mile_speed_trap As Quarter_Trap_Speed',
		'rrm.rt_quarter_time As Quarter_Mile_Time',
		'rrm.rt_cd_observed_fe As CD_Observed_Economy',
		'rrm.rt_no_cyl As Number_of_Cylinders',
		'rrm.rt_peak_hp_notes As Peak_Horsepower_Notes',
		'rrm.rt_peak_torque As Peak_Torque',
		'rrm.rt_peak_torque_notes As Peak_Torque_Notes',
		'rrm.rt_power_to_weight As Power_Weight_hp_lb',
		'rrm.rt_price_as_tested As Price_as_Tested',
		'rrm.rt_price_as_tested_notes As Price_as_Tested_Notes',
		'rrm.rt_redline As Readline',
		'rrm.rt_disp_cc As Engine_Disp',
		'rrm.rt_rpm As Peak_Horsepower_RPM',
		'rrm.rt_rpmt As Peak_Torque_RPM',
		'rrm.rt_slalom As Slalom_Speed',
		'rrm.rt_ss60 As 5-60_ss_accel',
		'rrm.rt_weight As Curb_Weight'
		
		         
		))

		->join(array('rr2' => 'rt_results_level_2'), 'rr2.id = rrm.id', array('rr2.rt2_emergency_lane_change As MPH_in_Lane_Change',
		'rr2.rt2_skidpad As Skidpad_Grip',
		'rr2.rt2_100_mph As 0-100_Accel',
		'rr2.rt2_130_mph As 0-130_Accel',
		'rr2.rt2_30_50TG As Top-Gear_Accel_30-50',
		'rr2.rt2_30_mph As 0-30_Accel',
		'rr2.rt2_50_70TG As Top-Gear_Accel_50-70',
		'rr2.rt2_50_mph As rt2_0-50_Accel',
		'rr2.rt2_70cr As DB_at_70_MPH_Cruise',
		'rr2.rt2_70_mph As rt2_0-70_Accel',
		'rr2.rt2_controlled_airbags As Airbags',
		'rr2.rt2_anti_lock As Anti-Lock_Brakes',
		'rr2.rt2_epa_city_fe As EPA_Citys',
		'rr2.rt2_epa_city_fe_notes As EPA_City_Notes',
		'rr2.rt2_fuel_sys As Fuel_System',
		'rr2.rt2_highway_fe As EPA_Highway',
		'rr2.rt2_highway_fe_notes As EPA_Highway_Notes',
		'rr2.rt2_int_vol_front As Interior_Volume_Front',
		'rr2.rt2_mid As Vol_Behind_Mid_Row',
		'rr2.rt2_passengers As Number_of_Passengers',
		'rr2.rt2_rear As Vol_Behind_Rear_Row',
		'rr2.rt2_sound_level_idle As Sound_Level_Idle',
		'rr2.rt2_stab_defeatable As Esc_Defeatable',
		'rr2.rt2_stability_control As Stability_Control',
		'rr2.rt2_sum_of_tg_times As Sum_of_the_above_2',
		'rr2.rt2_trac_defeatable As Tc_Defeatable',
		'rr2.rt2_traction_control As Traction_Control',
		'rr2.rt2_turning_cir As Turning_Radius',
		'rr2.rt2_wot As DB_at_Wot'))
		->joininner(array('rr3' => 'rt_results_level_3'), 'rr3.id = rr2.id', array('rr3.rt3_boost_psi As Boost_in_psi',
         'rr3.rt3_bore_mm As Cylinder_bore',
         'rr3.rt3_cd As Coefficient_of_drag',
         'rr3.rt3_comp_ratio As Compression_ratio',
         'rr3.rt3_et_factor As rt3_et_factor',
         'rr3.rt3_final_drive_ratio As Final_drive',
         'rr3.rt3_frontal_area As Frontal_area',
         'rr3.rt3_frontal_area_notes As Frontal_area_notes',
         'rr3.rt3_fuel_cap As Fual_capacity',
         'rr3.rt3_height As Height',
         'rr3.rt3_length As Length',
         'rr3.rt3_wheelbase As rt3_wheelbase',
         'rr3.center_of_gravity_height As center_of_gravity_height',
         'rr3.rt3_lt_oil As Long_tem_oil_used',
         'rr3.rt3_lt_repair As Costs_for_lt_repair',
         'rr3.rt3_lt_serv As Costs_for_lt_service',
         'rr3.rt3_lt_stps_sched As LT_scheduled_stops',
         'rr3.rt3_lt_stps_unsched As LT_unscheduled_stops',
         'rr3.rt3_lt_wear As Costs_for_LT_wear',
         'rr3.rt3_max_mph_1000_rpm As Top_gear_mph_1000rpm',
         'rr3.rt3_peak_bmep As rt3_peak_bmep',
         'rr3.rt3_peal_bmep As rt3_peal_bmep',
         'rr3.rt3_road_hp_30mph As rt3_road_hp_30mph',
         'rr3.rt3_sp_factor As rt3_sp_factor',
         'rr3.rt3_specific_power As Spec_pow_hp_liter)',
         'rr3.rt3_stroke_mm As Cylinder_stroke',
         'rr3.rt3_trunk As Trunk_volume',
         'rr3.rt3_valve_gear As Valve_setup',
         'rr3.rt3_valves_per_cyl As Valves_per_cylinder',
         'rr3.rt3_width As Width',
         'rr3.rt3_70co As DB_at_70_coast',
         'rr3.url_for_story_relationship As url_for_story_relationship',
         'rr3.ez_id As ez_id',
         'rr3.suppress_public_display As suppress_public_display',
         'rr3.skidpad_diameter As skidpad_diameter',
         'rr3.first_stop_70 As first_stop_70',
         'rr3.longest_stop70 As longest_stop70',
         'rr3.transaction_off As transaction_off',
         'rr3.partially_defeatable As partially_defeatable',
         'rr3.fully_defeatable As fully_defeatable',
         'rr3.competition_mode As competition_mode',
         'rr3.launch_control As launch_control',
         'rr3.permanent As permanent',
         'rr3.test_location As test_location',
         'rr3.test_location_detail As test_location_detail',
         'rr3.test_notes As test_notes',
         'rr3.tester As tester',
         'rr3.rt3_10mph As 0-10_Accel',
         'rr3.rt3_20mph As 0-20_Accel',
         'rr3.rt3_40mph As 0-40_Accel',
         'rr3.rt3_50mph As 0-50_Accel',
         'rr3.rt3_70mph As 0-70_Accel',
         'rr3.rt3_80mph As 0-80_Accel',
         'rr3.rt3_90mph As 0-90_Accel',
         'rr3.rt3_110mph As 0-110_Accel',
         'rr3.rt3_120mph As 0-120_Accel',
         'rr3.rt3_140mph As 0-140_Accel',
         'rr3.rt3_150mph As 0-150_Accel',
         'rr3.rt3_160mph As 0-160_Accel',
         'rr3.rt3_170mph As 0-170_Accel',
         'rr3.rt3_180mph As 0-180_Accel',
         'rr3.rt3_190mph As 0-190_Accel',
         'rr3.rt3_200mph As 0-200_Accel'));


		if(!empty($export_array))
		{
			if(!empty($export_array['id']))
			$select->where('rrm.id =?',$export_array['id']);
			if(!empty($export_array['year']))
			$select->where('rrm.bg_year_id =?',$export_array['year']);
			if(!empty($export_array['model']))
			$select->where('rrm.bg_model_id =?',$export_array['model']);
			if(!empty($export_array['make']))
			$select->where('rrm.bg_make_id =?',$export_array['make']);
			if(!empty($export_array['submodel']))
			$select->where('rrm.bg_submodel_id =?',$export_array['submodel']);
			if(!empty($export_array['name']))
			{
				$db_remote = $this->getDbConnection();

				$bgMakeIdSelect = $db_remote->select()
				->from(array('bgmk' => 'bg_make'), array('bgmk.id As id'))
				->where('bgmk.name=?', $export_array['name']);
				$bgMakeId = $db_remote->query($bgMakeIdSelect)->fetchAll();

				$bgModelIdSelect = $db_remote->select()
				->from(array('bgmd' => 'bg_model'), array('bgmd.id As id'))
				->where('bgmd.name=?', $export_array['name']);
				$bgModelId = $db_remote->query($bgModelIdSelect)->fetchAll();


				$bgYearIdSelect = $db_remote->select()
				->from(array('bgyr' => 'bg_year'), array('bgyr.id As id'))
				->where('bgyr.name=?', $export_array['name']);
				$bgYearId = $db_remote->query($bgYearIdSelect)->fetchAll();

				if(!empty($bgMakeId))
				$select->where('rrm.bg_make_id =?', $bgMakeId[0]['id']);
				if(!empty($bgModelId[0]['id']))
				$select->where('rrm.bg_model_id =?', $bgModelId[0]['id']);
				if(!empty($bgYearId[0]['id']))
				$select->where('rrm.bg_Year_id =?', $bgYearId[0]['id']);

			}
		}
		//$select->where('rrm.id =?',1);
		$export_result = $db->query($select)->fetchAll();

		//$db_remote = $this->getDbConnection();

		header("Content-type:text/octect-stream");
		header("Content-Disposition:attachment;filename=data.csv");
		print "\"ID\",\"Web or Print\",\"Year\",\"Make\",\"Model\",\"Mag Issue Year\",\"Mag Issue Month\",\"Production Type\",\"Number of Doors\",\"Body Style\",\"Peak Horsepower\",\"Make(BG)\",\"Model(BG)\",\"Sub-Model(BG)\",\"Year(BG)\",\"bg_controlled_make_id\",\"bg_controlled_model_id\",\"rt_original_table_id\",\"Engine Location\",\"Fuel Type\",\"Transmission Type\",\"Driven Wheels\",\"Top Speed Limit\",\"Forced Induction\",\"Engine Type\",\"Pct. weight on Rear\",\"Pct. Weight on Front\",\"0-60 Accel\",\"Shortest 70\",\"Top Speed\",\"Top Speed Notes\",\"Base Price\",\"Base Price Notes\",\"Quarter Trap Speed\",\"Quarter Mile Time\",\"CD Observed Economy\",\"Number of Cylinders\",\"Peak Horsepower Notes\",\"Peak Torque\",\"Peak Torque notes\",\"Power Weight hp lb\",\"Price as Tested\",\"Price as Tested Notes\",\"Redline\",\"Engine Disp\",\"Peak Horsepower RPM\",\"Peak Torque RPM\",\"Slalom Speed\",\"5-60 as accel\",\"Curb Weight\",\"MPH in Lane Change\",\"Skidpad Grip\",\"0-100 Accel\",\"0-130 Accel\",\"Top Gear Accel 30-50\",\"0-30 Accel\",\"Top Gear Accel 50-70\",\"rt2_50_mph\",\"DB at 70 MPH Cruise\",\"rt2_70_mph\",\"Airbags\",\"Anti Lock Brakes\",\"EPA City\",\"EPA City Notes\",\"Fuel system\",\"EPA Highway\",\"EPA Highway Notes\",\"Interior Volume Front\",\"Vol Behind Mid Row\",\"Number of Passengers\",\"Vol Behind Rear Row\",\"Sound Level Idle\",\"ESC Defeatable\",\"Stability Control\",\"Sum Of 2\",\"TC Defeatable\",\"Traction Control\",\"Turning Radius\",\"DB at Wot\",\"Boost in psi\",\"Cylinder Bore\",\"Coefficient of Drag\",\"Compression Ratio\",\"rt3_et_factor\",\"Final Drive\",\"Frontal Area\",\"Frontal Area Notes\",\"Fuel Capacity\",\"height\",\"Length\",\"Wheelbase\",\"Center of Gravity Height\",\"Long Term Oil Used\",\"Costs for lt Repair\",\"costs for lt service\",\"Lt Scheduled Stops\",\"Lt Unscheduled Stops\",\"Costs for LT Wear\",\"Top Gear MPH 1000rmp\",\"rt3_peak_bmep\",\"rt3_peal_bmep\",\"rt3_road_hp_30mph\",\"rt3_sp_factor\",\"Spec Pow hp Liter\",\"Cylinder Stroke\",\"Trunk Volume\",\"Valve Setup\",\"Valves Per Cylinder\",\"Width\",\" DB at 70 coast\",\"URL for story relationship\",\"EZ ID\",\"Suppress public display\",\"Skidpad diameter\",\"First stop 70\",\"Longest stop 70\",\"Traction off\",\"Partially defeatable\",\"Fully defeatable\",\"Competition mode\",\"Launch control\",\"Permanent\",\"Test location\",\"Test location detail\",\"Test notes\",\"Tester\",\"0-10 Accel\",\"0-20 Accel\",\"0-40 Accel\",\"0-50 Accel\",\"0-70 Accel\",\"0-80 Accel\",\"0-90 Accel\",\"0-110 Accel\",\"0-120 Accel\",\"0-140 Accel\",\"0-150 Accel\",\"0-160 Accel\",\"0-170 Accel\",\"0-180 Accel\",\"0-190 Accel\",\"0-200 Accel\"\n";
		foreach ($export_result as $row) {
			$row['make'] = $this->getData($row['make']);
			$row['body_style'] = $this->getData($row['body_style']);
			$row['production_type'] = $this->getData($row['production_type']);
			$row['Engine_Location'] = $this->getData($row['Engine_Location']);
			$row['Driven_Wheels'] = $this->getData($row['Driven_Wheels']);
			$row['Engine_Type'] = $this->getData($row['Engine_Type']);
			$row['Forced_Induction'] = $this->getData($row['Forced_Induction']);
			$row['Transmission_Type'] = $this->getData($row['Transmission_Type']);
			$row['Airbags'] = $this->getData($row['Airbags']);
			$row['Top_Speed_Limit'] = $this->getData($row['Top_Speed_Limit']);
			$row['Fuel_Type'] = $this->getData($row['Fuel_Type']);
			$row['Make(BG)'] = $this->getBGData("bg_make", $row['Make(BG)']);
			$row['Model(BG)'] = $this->getBGData("bg_model", $row['Model(BG)']);
			$row['Sub-Model(BG)'] = $this->getBGData("bg_submodel", $row['Sub-Model(BG)']);
			$row['Year(BG)'] = $this->getBGData("bg_year", $row['Year(BG)']);
			$row['Anti-Lock_Brakes'] = $this->toYesNo($row['Anti-Lock_Brakes']);
			$row['Stability_Control'] = $this->toYesNo($row['Stability_Control']);
			$row['Traction_Control'] = $this->toYesNo($row['Traction_Control']);
			$row['Tc_Defeatable'] = $this->toYesNo($row['Tc_Defeatable']);
			$row['issue_month'] = $this->toMonthString($row['issue_month']);
			$row['fully_defeatable'] = $this->toYesNo($row['fully_defeatable']);
			$row['launch_control'] = $this->toYesNo($row['launch_control']);
			$row['transaction_off'] = $this->toYesNo($row['transaction_off']);
			$row['partially_defeatable'] = $this->toYesNo($row['partially_defeatable']);
			$row['competition_mode'] = $this->toYesNo($row['competition_mode']);
			$row['permanent'] = $this->toYesNo($row['permanent']);
			$row['suppress_public_display'] = $this->toYesNo($row['suppress_public_display']);
			/*$bgMakes = $db_remote->select()
			 ->from(array('bgmk' => 'bg_make'), array('bgmk.name As bg_make'))
			 ->where('bgmk.name=?', $row['Make(BG)']);
			 $bgMake = $db_remote->query($bgMakes)->fetchAll();
			 	
			 $bgModels = $db_remote->select()
			 ->from(array('bgmd' => 'bg_model'), array('bgmd.name As bg_model'))
			 ->where('bgmd.name=?', $row['Model(BG)']);
			 $bgModel = $db_remote->query($bgModels)->fetchAll();
			 	
			 	
			 $bgYears = $db_remote->select()
			 ->from(array('bgyr' => 'bg_year'), array('bgyr.name As bg_year'))
			 ->where('bgyr.name=?', $row['Year(BG)']);
			 $bgYear = $db_remote->query($bgYears)->fetchAll();
			 	
			 $bgSubmodels = $db_remote->select()
			 ->from(array('bgsm' => 'bg_submodel'), array('bgsm.name As bg_submodel'))
			 ->where('bgyr.name=?', $row['Sub-Model(BG)']);
			 	
			 $bgSubmodel = $db_remote->query($bgSubmodels)->fetchAll();
			 $final = str_replace($row['Make(BG)'], $bgMake[0]['bg_make'], $final);
			 $final = str_replace($row['Model(BG'], $bgModel[0]['bg_model'], $final);
			 $final = str_replace($row['Year(BG)'], $bgYear[0]['bg_year'], $final);
			 $final = str_replace($row['Sub-Model(BG)'], $bgSubmodels[0]['bg_submodel'], $final);*/
			print '"' . stripslashes(implode('","',$row)) . "\"\n";
		}

		exit;
	}

	public function excelexportAction()
	{
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");
			
		$session_export = new Zend_Session_Namespace('export');
		$export_array = $session_export->export;

		set_time_limit(600);

		$db = Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()
		->from(array('rrm'=>'rt_results_main'),array('rrm.id As main_results_id',
         'rrm.rt_published As publish', 
		'rrm.rt_model_year As year', 
		'rrm.rt_controlled_make As make', 
		'rrm.rt_model As model',
		'rrm.rt_issue_year As issue_year',
		'rrm.rt_issue As issue_month', 
		'rrm.rt_controlled_sort As production_type', 
		'rrm.rt_doors As doors', 
		'rrm.rt_controlled_body As body_style',
		'rrm.rt_peak_hp As peak_horse_power',
		'rrm.bg_make_id As Make(BG)',
		'rrm.bg_model_id As Model(BG)',
		'rrm.bg_submodel_id As Sub-Model(BG)',
		'rrm.bg_year_id AS Year(BG)',
		'rrm.bg_controlled_make_id AS bg_controlled_make_id ',
		'rrm.bg_controlled_model_id AS bg_controlled_model_id',
		'rrm.rt_original_table_id As rt_original_table_id',
		'rrm.rt_controlled_engine AS Engine_Location',
		'rrm.rt_controlled_fuel As Fuel_Type',
		'rrm.rt_controlled_transmission As Transmission_Type',
		'rrm.rt_controlled_drive As Driven_Wheels',
		'rrm.rt_controlled_ts_limit As Top_Speed_Limit',
		'rrm.rt_controlled_turbo_superchg As Forced_Induction',
		'rrm.rt_controlled_type As Engine_Type',
		'rrm.rt_percent_on_rear As Pct_Weight_on_Rear',
		'rrm.rt_percent_on_front As Pct_Weight_on_Front',
		'rrm.rt_60_mph As 0-60_Accel',
		'rrm.rt_70_mph_braking As Braking_from_70',
		'rrm.rt_top_speed As Top_Speed',
		'rrm.rt_top_speed_notes As Top_Speed_Notes',
		'rrm.rt_base_price As Base_Price',
		'rrm.rt_base_price_notes As Base_Price_Notes',
		'rrm.rt_speed_qtr_mile_speed_trap As Quarter_Trap_Speed',
		'rrm.rt_quarter_time As Quarter_Mile_Time',
		'rrm.rt_cd_observed_fe As CD_Observed_Economy',
		'rrm.rt_no_cyl As Number_of_Cylinders',
		'rrm.rt_peak_hp_notes As Peak_Horsepower_Notes',
		'rrm.rt_peak_torque As Peak_Torque',
		'rrm.rt_peak_torque_notes As Peak_Torque_Notes',
		'rrm.rt_power_to_weight As Power_Weight_hp_lb',
		'rrm.rt_price_as_tested As Price_as_Tested',
		'rrm.rt_price_as_tested_notes As Price_as_Tested_Notes',
		'rrm.rt_redline As Readline',
		'rrm.rt_disp_cc As Engine_Disp',
		'rrm.rt_rpm As Peak_Horsepower_RPM',
		'rrm.rt_rpmt As Peak_Torque_RPM',
		'rrm.rt_slalom As Slalom_Speed',
		'rrm.rt_ss60 As 5-60_ss_accel',
		'rrm.rt_weight As Curb_Weight'
		
		         
		))
		
		->join(array('rr2' => 'rt_results_level_2'), 'rr2.id = rrm.id', array('rr2.rt2_emergency_lane_change As MPH_in_Lane_Change',
		'rr2.rt2_skidpad As Skidpad_Grip',
		'rr2.rt2_100_mph As 0-100_Accel',
		'rr2.rt2_130_mph As 0-130_Accel',
		'rr2.rt2_30_50TG As Top-Gear_Accel_30-50',
		'rr2.rt2_30_mph As 0-30_Accel',
		'rr2.rt2_50_70TG As Top-Gear_Accel_50-70',
		'rr2.rt2_50_mph As rt2_0-50_Accel',
		'rr2.rt2_70cr As DB_at_70_MPH_Cruise',
		'rr2.rt2_70_mph As rt2_0-70_Accel',
		'rr2.rt2_controlled_airbags As Airbags',
		'rr2.rt2_anti_lock As Anti-Lock_Brakes',
		'rr2.rt2_epa_city_fe As EPA_Citys',
		'rr2.rt2_epa_city_fe_notes As EPA_City_Notes',
		'rr2.rt2_fuel_sys As Fuel_System',
		'rr2.rt2_highway_fe As EPA_Highway',
		'rr2.rt2_highway_fe_notes As EPA_Highway_Notes',
		'rr2.rt2_int_vol_front As Interior_Volume_Front',
		'rr2.rt2_mid As Vol_Behind_Mid_Row',
		'rr2.rt2_passengers As Number_of_Passengers',
		'rr2.rt2_rear As Vol_Behind_Rear_Row',
		'rr2.rt2_sound_level_idle As Sound_Level_Idle',
		'rr2.rt2_stab_defeatable As Esc_Defeatable',
		'rr2.rt2_stability_control As Stability_Control',
		'rr2.rt2_sum_of_tg_times As Sum_of_the_above_2',
		'rr2.rt2_trac_defeatable As Tc_Defeatable',
		'rr2.rt2_traction_control As Traction_Control',
		'rr2.rt2_turning_cir As Turning_Radius',
		'rr2.rt2_wot As DB_at_Wot'))
		->joininner(array('rr3' => 'rt_results_level_3'), 'rr3.id = rr2.id', array('rr3.rt3_boost_psi As Boost_in_psi',
         'rr3.rt3_bore_mm As Cylinder_bore',
         'rr3.rt3_cd As Coefficient_of_drag',
         'rr3.rt3_comp_ratio As Compression_ratio',
         'rr3.rt3_et_factor As rt3_et_factor',
         'rr3.rt3_final_drive_ratio As Final_drive',
         'rr3.rt3_frontal_area As Frontal_area',
         'rr3.rt3_frontal_area_notes As Frontal_area_notes',
         'rr3.rt3_fuel_cap As Fual_capacity',
         'rr3.rt3_height As Height',
         'rr3.rt3_length As Length',
         'rr3.rt3_wheelbase As rt3_wheelbase',
         'rr3.center_of_gravity_height As center_of_gravity_height',
         'rr3.rt3_lt_oil As Long_tem_oil_used',
         'rr3.rt3_lt_repair As Costs_for_lt_repair',
         'rr3.rt3_lt_serv As Costs_for_lt_service',
         'rr3.rt3_lt_stps_sched As LT_scheduled_stops',
         'rr3.rt3_lt_stps_unsched As LT_unscheduled_stops',
         'rr3.rt3_lt_wear As Costs_for_LT_wear',
         'rr3.rt3_max_mph_1000_rpm As Top_gear_mph_1000rpm',
         'rr3.rt3_peak_bmep As rt3_peak_bmep',
         'rr3.rt3_peal_bmep As rt3_peal_bmep',
         'rr3.rt3_road_hp_30mph As rt3_road_hp_30mph',
         'rr3.rt3_sp_factor As rt3_sp_factor',
         'rr3.rt3_specific_power As Spec_pow_hp_liter)',
         'rr3.rt3_stroke_mm As Cylinder_stroke',
         'rr3.rt3_trunk As Trunk_volume',
         'rr3.rt3_valve_gear As Valve_setup',
         'rr3.rt3_valves_per_cyl As Valves_per_cylinder',
         'rr3.rt3_width As Width',
         'rr3.rt3_70co As DB_at_70_coast',
         'rr3.url_for_story_relationship As url_for_story_relationship',
         'rr3.ez_id As ez_id',
         'rr3.suppress_public_display As suppress_public_display',
         'rr3.skidpad_diameter As skidpad_diameter',
         'rr3.first_stop_70 As first_stop_70',
         'rr3.longest_stop70 As longest_stop70',
         'rr3.transaction_off As transaction_off',
         'rr3.partially_defeatable As partially_defeatable',
         'rr3.fully_defeatable As fully_defeatable',
         'rr3.competition_mode As competition_mode',
         'rr3.launch_control As launch_control',
         'rr3.permanent As permanent',
         'rr3.test_location As test_location',
         'rr3.test_location_detail As test_location_detail',
         'rr3.test_notes As test_notes',
         'rr3.tester As tester',
         'rr3.rt3_10mph As 0-10_Accel',
         'rr3.rt3_20mph As 0-20_Accel',
         'rr3.rt3_40mph As 0-40_Accel',
         'rr3.rt3_50mph As 0-50_Accel',
         'rr3.rt3_70mph As 0-70_Accel',
         'rr3.rt3_80mph As 0-80_Accel',
         'rr3.rt3_90mph As 0-90_Accel',
         'rr3.rt3_110mph As 0-110_Accel',
         'rr3.rt3_120mph As 0-120_Accel',
         'rr3.rt3_140mph As 0-140_Accel',
         'rr3.rt3_150mph As 0-150_Accel',
         'rr3.rt3_160mph As 0-160_Accel',
         'rr3.rt3_170mph As 0-170_Accel',
         'rr3.rt3_180mph As 0-180_Accel',
         'rr3.rt3_190mph As 0-190_Accel',
         'rr3.rt3_200mph As 0-200_Accel'));


if(!empty($export_array))
{
	if(!empty($export_array['id']))
	$select->where('rrm.id =?',$export_array['id']);
	if(!empty($export_array['year']))
	$select->where('rrm.bg_year_id =?',$export_array['year']);
	if(!empty($export_array['model']))
	$select->where('rrm.bg_model_id =?',$export_array['model']);
	if(!empty($export_array['make']))
	$select->where('rrm.bg_make_id =?',$export_array['make']);
	if(!empty($export_array['submodel']))
	$select->where('rrm.bg_submodel_id =?',$export_array['submodel']);
	if(!empty($export_array['name']))
	{
		$db_remote = $this->getDbConnection();

		$bgMakeIdSelect = $db_remote->select()
		->from(array('bgmk' => 'bg_make'), array('bgmk.id As id'))
		->where('bgmk.name=?', $export_array['name']);
		$bgMakeId = $db_remote->query($bgMakeIdSelect)->fetchAll();

		$bgModelIdSelect = $db_remote->select()
		->from(array('bgmd' => 'bg_model'), array('bgmd.id As id'))
		->where('bgmd.name=?', $export_array['name']);
		$bgModelId = $db_remote->query($bgModelIdSelect)->fetchAll();


		$bgYearIdSelect = $db_remote->select()
		->from(array('bgyr' => 'bg_year'), array('bgyr.id As id'))
		->where('bgyr.name=?', $export_array['name']);
		$bgYearId = $db_remote->query($bgYearIdSelect)->fetchAll();

		if(!empty($bgMakeId))
		$select->where('rrm.bg_make_id =?', $bgMakeId[0]['id']);
		if(!empty($bgModelId[0]['id']))
		$select->where('rrm.bg_model_id =?', $bgModelId[0]['id']);
		if(!empty($bgYearId[0]['id']))
		$select->where('rrm.bg_Year_id =?', $bgYearId[0]['id']);

	}
}
//$select->where('rrm.id =?',1);
$export_result = $db->query($select)->fetchAll();

header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=data.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "\"ID\"\t\"Web or Print\"\t\"Year\"\t\"Make\"\t\"Model\"\t\"Mag Issue Year\"\t\"Mag Issue Month\"\t\"Production Type\"\t\"Number of Doors\"\t\"Body Style\"\t\"Peak Horsepower\"\t\"Make(BG)\"\t\"Model(BG)\"\t\"Sub-Model(BG)\"\t\"Year(BG)\"\t\"bg_controlled_make_id\"\t\"bg_controlled_model_id\"\t\"rt_original_table_id\"\t\"Engine Location\"\t\"Fuel Type\"\t\"Transmission Type\"\t\"Driven Wheels\"\t\"Top Speed Limit\"\t\"Forced Induction\"\t\"Engine Type\"\t\"Pct. weight on Rear\"\t\"Pct. Weight on Front\"\t\"0-60 Accel\"\t\"Shortest 70\"\t\"Top Speed\"\t\"Top Speed Notes\"\t\"Base Price\"\t\"Base Price Notes\"\t\"Quarter Trap Speed\"\t\"Quarter Mile Time\"\t\"CD Observed Economy\"\t\"Number of Cylinders\"\t\"Peak Horsepower Notes\"\t\"Peak Torque\"\t\"Peak Torque notes\"\t\"Power Weight hp lb\"\t\"Price as Tested\"\t\"Price as Tested Notes\"\t\"Redline\"\t\"Engine Disp\"\t\"Peak Horsepower RPM\"\t\"Peak Torque RPM\"\t\"Slalom Speed\"\t\"5-60 as accel\"\t\"Curb Weight\"\t\"MPH in Lane Change\"\t\"Skidpad Grip\"\t\"0-100 Accel\"\t\"0-130 Accel\"\t\"Top Gear Accel 30-50\"\t\"0-30 Accel\"\t\"Top Gear Accel 50-70\"\t\"rt2_50_mph\"\t\"DB at 70 MPH Cruise\"\t\"rt2_70_mph\"\t\"Airbags\"\t\"Anti Lock Brakes\"\t\"EPA City\"\t\"EPA City Notes\"\t\"Fuel system\"\t\"EPA Highway\"\t\"EPA Highway Notes\"\t\"Interior Volume Front\"\t\"Vol Behind Mid Row\"\t\"Number of Passengers\"\t\"Vol Behind Rear Row\"\t\"Sound Level Idle\"\t\"ESC Defeatable\"\t\"Stability Control\"\t\"Sum Of 2\"\t\"TC Defeatable\"\t\"Traction Control\"\t\"Turning Radius\"\t\"DB at Wot\"\t\"Boost in psi\"\t\"Cylinder Bore\"\t\"Coefficient of Drag\"\t\"Compression Ratio\"\t\"rt3_et_factor\"\t\"Final Drive\"\t\"Frontal Area\"\t\"Frontal Area Notes\"\t\"Fuel Capacity\"\t\"height\"\t\"Length\"\t\"Wheelbase\"\t\"Center of Gravity Height\"\t\"Long Term Oil Used\"\t\"Costs for lt Repair\"\t\"costs for lt service\"\t\"Lt Scheduled Stops\"\t\"Lt Unscheduled Stops\"\t\"Costs for LT Wear\"\t\"Top Gear MPH 1000rmp\"\t\"rt3_peak_bmep\"\t\"rt3_peal_bmep\"\t\"rt3_road_hp_30mph\"\t\"rt3_sp_factor\"\t\"Spec Pow hp Liter\"\t\"Cylinder Stroke\"\t\"Trunk Volume\"\t\"Valve Setup\"\t\"Valves Per Cylinder\"\t\"Width\"\t\" DB at 70 coast\"\t\"URL for story relationship\"\t\"EZ ID\"\t\"Suppress public display\"\t\"Skidpad diameter\"\t\"First stop 70\"\t\"Longest stop 70\"\t\"Traction off\"\t\"Partially defeatable\"\t\"Fully defeatable\"\t\"Competition mode\"\t\"Launch control\"\t\"Permanent\"\t\"Test location\"\t\"Test location detail\"\t\"Test notes\"\t\"Tester\"\t\"0-10 Accel\"\t\"0-20 Accel\"\t\"0-40 Accel\"\t\"0-50 Accel\"\t\"0-70 Accel\"\t\"0-80 Accel\"\t\"0-90 Accel\"\t\"0-110 Accel\"\t\"0-120 Accel\"\t\"0-140 Accel\"\t\"0-150 Accel\"\t\"0-160 Accel\"\t\"0-170 Accel\"\t\"0-180 Accel\"\t\"0-190 Accel\"\t\"0-200 Accel\"\n";
foreach ($export_result as $row) {
	$row['make'] = $this->getData($row['make']);
	$row['body_style'] = $this->getData($row['body_style']);
	$row['production_type'] = $this->getData($row['production_type']);
	$row['Engine_Location'] = $this->getData($row['Engine_Location']);
	$row['Driven_Wheels'] = $this->getData($row['Driven_Wheels']);
	$row['Engine_Type'] = $this->getData($row['Engine_Type']);
	$row['Forced_Induction'] = $this->getData($row['Forced_Induction']);
	$row['Transmission_Type'] = $this->getData($row['Transmission_Type']);
	$row['Airbags'] = $this->getData($row['Airbags']);
	$row['Top_Speed_Limit'] = $this->getData($row['Top_Speed_Limit']);
	$row['Fuel_Type'] = $this->getData($row['Fuel_Type']);
	$row['Make(BG)'] = $this->getBGData("bg_make", $row['Make(BG)']);
	$row['Model(BG)'] = $this->getBGData("bg_model", $row['Model(BG)']);
	$row['Sub-Model(BG)'] = $this->getBGData("bg_submodel", $row['Sub-Model(BG)']);
	$row['Year(BG)'] = $this->getBGData("bg_year", $row['Year(BG)']);
	$row['Anti-Lock_Brakes'] = $this->toYesNo($row['Anti-Lock_Brakes']);
	$row['Stability_Control'] = $this->toYesNo($row['Stability_Control']);
	$row['Traction_Control'] = $this->toYesNo($row['Traction_Control']);
	$row['Tc_Defeatable'] = $this->toYesNo($row['Tc_Defeatable']);
	$row['issue_month'] = $this->toMonthString($row['issue_month']);
	$row['fully_defeatable'] = $this->toYesNo($row['fully_defeatable']);
	$row['launch_control'] = $this->toYesNo($row['launch_control']);
	$row['transaction_off'] = $this->toYesNo($row['transaction_off']);
	$row['partially_defeatable'] = $this->toYesNo($row['partially_defeatable']);
	$row['competition_mode'] = $this->toYesNo($row['competition_mode']);
	$row['permanent'] = $this->toYesNo($row['permanent']);
	$row['suppress_public_display'] = $this->toYesNo($row['suppress_public_display']);
	/*$bgMakes = $db_remote->select()
	 ->from(array('bgmk' => 'bg_make'), array('bgmk.name As bg_make'))
	 ->where('bgmk.name=?', $row['Make(BG)']);
	 $bgMake = $db_remote->query($bgMakes)->fetchAll();
			
	 $bgModels = $db_remote->select()
	 ->from(array('bgmd' => 'bg_model'), array('bgmd.name As bg_model'))
	 ->where('bgmd.name=?', $row['Model(BG)']);
	 $bgModel = $db_remote->query($bgModels)->fetchAll();
			
			
	 $bgYears = $db_remote->select()
	 ->from(array('bgyr' => 'bg_year'), array('bgyr.name As bg_year'))
	 ->where('bgyr.name=?', $row['Year(BG)']);
	 $bgYear = $db_remote->query($bgYears)->fetchAll();
			
	 $bgSubmodels = $db_remote->select()
	 ->from(array('bgsm' => 'bg_submodel'), array('bgsm.name As bg_submodel'))
	 ->where('bgyr.name=?', $row['Sub-Model(BG)']);
			
	 $bgSubmodel = $db_remote->query($bgSubmodels)->fetchAll();
	 $final = str_replace($row['Make(BG)'], $bgMake[0]['bg_make'], $final);
	 $final = str_replace($row['Model(BG'], $bgModel[0]['bg_model'], $final);
	 $final = str_replace($row['Year(BG)'], $bgYear[0]['bg_yrar'], $final);
	 $final = str_replace($row['Sub-Model(BG)'], $bgSubmodels[0]['bg_submodel'], $final);*/
	print stripslashes(implode("\t",$row)) . "\n";
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

		public function usersAction()
		{
			$result = $this->verifyLogin();
			$this->view->message = "";
			if(!$result)
			$this->_redirect("index/login");
	
			$this->getUser();
			
			if($this->view->loggedInUserRole != 0)
				$this->_redirect("index");
				
			$db = Zend_Db_Table::getDefaultAdapter();
			$select = $db->select()
				->from("user")
				->order('user_name ASC');
				$res = $db->query($select)->fetchAll();
				$this->view->results = $res;
			$form = new Application_Form_User();
			$this->view->form = $form;
			if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()))
			{
				$form_values = $this->view->form->getValues();
				
				if($this->validateuser($form_values["user_name"]))
				{
					$this->view->message = "User Name alread exists";
				}
				else
				{
					$form_values["password"] = md5($form_values["password"]);
					$table = new Application_Model_User();
					$db = $table->getAdapter();
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
							
					}
					$this->_redirect("index/users");
				}
			}
	}
	
	private function validateuser($name)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$select = $db->select()
		->from('user')
		->where('user_name = ?', $name);

		$res = $db->query($select)->fetchAll();

		if($res)
			return true;
		else
			return false;
	}
	
	public function deleteuserAction()
	{
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");
		if($this->view->loggedInUserRole != 0)
			$this->_redirect("index");
			
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->delete("user", "id=" .$this->_getParam('id'));
			
		$this->_redirect("index/users");
	}
	
	public function getData($id)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		if(isset($id))
		{
		 $select = $db->select()
		 ->from(array('rdd'=>'rt_dropdown_descriptions'),array('rdd.description As desp'))
		 ->joininner(array('rdl' => 'rt_dropdown_lookup'), 'rdl.id_descriptions = rdd.id_descriptions')
		 ->where('rdl.id =?', $id);
		 $result = $db->query($select)->fetchAll();
		 if(isset($result[0]))
		 return $result[0]['desp'];
		 else
		 return "-";
		}
		else
		return "-";
	}

	public function toYesNo($value)
	{
		if($value==1)
		{
		 return "Yes";
		}
		else
		return "No";
	}

	public function toMonthString($value)
	{

		switch ($value) {
			case 1:
				return "January";
				break;
			case 2:
				return "February";
				break;
			case 3:
				return "March";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "May";
				break;
			case 6:
				return "June";
				break;
			case 7:
				return "July";
				break;
			case 8:
				return "August";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "October";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "December";
				break;
		}
	}


	public function getBGData($table, $id)
	{
		$db_remote = $this->getDbConnection();
		if(isset($id))
		{
			$select = $db_remote->select()
			->from(array('bgmk' => $table), array('bgmk.name As name'))
			->where('bgmk.id=?', $id);
			$result = $db_remote->query($select)->fetchAll();
			if(isset($result[0]))
			return $result[0]['name'];
			else
			return "-";
		}
		else
		return "-";
	}


	public function deletedropdowndescriptionAction()
	{
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");
			
		$db = Zend_Db_Table::getDefaultAdapter();

		$id = $this->_getParam('id');
		$id_types = $this->_getParam('rt_types');
			
		$this->view->rt_types = $id_types;
		$this->view->id = $id;

		$select = $db->select()
		->from('rt_dropdown_lookup')
		->where('id =?', $id);
			
		$reslt = $db->query($select)->fetchAll();

		$select = $db->select()
		->from('rt_dropdown_descriptions')
		->where('id_descriptions =?', $reslt[0]['id_descriptions']);
			
		$res = $db->query($select)->fetchAll();

		$this->view->description = $res[0];

		if (!$this->getRequest()->isPost())
		return;

		try
		{
			$db->delete('rt_dropdown_descriptions', 'id_descriptions = '.$reslt[0]['id_descriptions']);
			$db->delete('rt_dropdown_lookup','id = '.$id);
		}
		catch(Exception $e)
		{
			$db->rollBack();
			throw $e;

		}
		$this->_redirect("index/manageconrolledlist/rt_types/".$id_types);
	}

	public function editdropdowndescriptionAction()
	{
		$result = $this->verifyLogin();
			
		if(!$result)
		$this->_redirect("index/login");
			
		$id = $this->_getParam('id');
		$rt_types = $this->_getParam('rt_types');

		$db = Zend_Db_Table::getDefaultAdapter();

		$select = $db->select()
		->from('rt_dropdown_lookup')
		->where('id =?', $id);
			
		$reslt = $db->query($select)->fetchAll();

		$select = $db->select()
		->from('rt_dropdown_descriptions')
		->where('id_descriptions =?', $reslt[0]['id_descriptions']);
			
		$res = $db->query($select)->fetchAll();

		$this->view->description = $res[0];
		$this->view->rt_types = $rt_types;
		$this->view->id = $id;

		if (!$this->getRequest()->isPost())
		return;
			
		$dropdown_descriptions['description'] = $_POST['description'];

		$where[] = 'id_descriptions = '.$reslt[0]['id_descriptions'];
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

	public function getDbConnection()
	{
		$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'production');

		$db_remote = new Zend_Db_Adapter_Pdo_Mysql(array(
          'host'     => $config->external->db->params->host,
          'username' => $config->external->db->params->username,
          'password' => $config->external->db->params->password,
          'dbname'   => $config->external->db->params->dbname
		));

		return $db_remote;
	}

}


