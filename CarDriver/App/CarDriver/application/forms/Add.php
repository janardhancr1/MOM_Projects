<?php
class Application_Form_Add extends Application_Form_MainForm
{
	public function init()
	{
		$db = Zend_Db_Table::getDefaultAdapter(); 
		
		$select = $db->select()
			->from('rt_results_main',array(new Zend_Db_Expr('max(id) as maxId')));
		$res = $db->query($select)->fetchAll();
		
		$enterId = new Zend_Form_Element_Text('id', array("readonly" => "readonly"));
		$enterId->setLabel('id')
		->setAttrib('class', 'inputbar')
		->setValue($res[0]['maxId'] + 1) ;
		
	
		$enterId->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$select = $db->select()
	             ->from('rt_results_main')
	             ->where('rt_model_year IS NOT NULL')
	             ->order('rt_model_year DESC');
        $rt_model_years = $db->query($select)->fetchAll();
	       
		if (count($rt_model_years)!=0){
				$rt_model_years_prepared[0]= "Select from list";
				foreach ($rt_model_years as $Yea){
						$rt_model_years_prepared[$Yea['rt_model_year']]= $Yea['rt_model_year'];
				}
		}
		
		$rt_model_year = new Zend_Form_Element_Select('rt_model_year',array('style'=>'width:150px;'));
		$rt_model_year->setLabel('Year')
					  ->addMultiOptions($rt_model_years_prepared);
		
		$rt_model_year->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_year_ids_prepared[0]= "Select from list";
		$objDOM = new DOMDocument(); 
		$objDOM->load("http://buyersguide.caranddriver.com/api/years?mode=xml"); 
		$xpath = new DOMXPath($objDOM);
		$query = '//response/data/row/name';
		$entries = $xpath->query($query);
		foreach( $entries as $entry )
		{
		    $name  = $entry->nodeValue;
		    $id  = $entry->previousSibling->nodeValue;
		    $bg_year_ids_prepared[$id]= $name;
		 }
		rsort($bg_year_ids_prepared);
		$bg_year_id = new Zend_Form_Element_Select('bg_year_id',array('style'=>'width:150px;'));
		$bg_year_id->setLabel('Mapped BG Year')
					->addMultiOptions($bg_year_ids_prepared);
		$bg_year_id->setAttrib('onchange','AutoFillSubModel(this.value)');
	
		$bg_year_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
	
		$rt_controlled_make_prepared = $this->gatMultioptions("Make");
		
		$rt_controlled_make = new Zend_Form_Element_Select('rt_controlled_make',array('style'=>'width:150px;'));
		$rt_controlled_make->setLabel('Make')
					->addMultiOptions($rt_controlled_make_prepared);
	
		$rt_controlled_make->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_make_ids_prepared[0]= "Select from list";
		$objDOM = new DOMDocument(); 
		$objDOM->load("http://buyersguide.caranddriver.com/api/makes?mode=xml"); 
		$xpath = new DOMXPath($objDOM);
		$query = '//response/data/row/name';
		$entries = $xpath->query($query);
		foreach( $entries as $entry )
		{
		    $name  = $entry->nodeValue;
		    $id  = $entry->previousSibling->nodeValue;
		    $bg_make_ids_prepared[$id]= $name;
		 }
		
		$bg_make_id = new Zend_Form_Element_Select('bg_make_id',array('style'=>'width:150px;'));
		$bg_make_id->setLabel('Mapped BG Make ID')
					->addMultiOptions($bg_make_ids_prepared);
		$bg_make_id->setAttrib('onchange','AutoFillModel(this.value)');
	
		$bg_make_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$select = $db->select()
	             ->from('rt_results_main');
        $rt_models = $db->query($select)->fetchAll();
	       
        $rt_model_prepared[0]= "Select from list";
		if (count($rt_models)!=0){
				foreach ($rt_models as $rt_mod){
						$rt_model_prepared[$rt_mod['rt_model']]= $rt_mod['rt_model'];
				}
		}
		
		$rt_model = new Zend_Form_Element_Select('rt_model',array('style'=>'width:150px;'));
		$rt_model->setLabel('Model')
					->addMultiOptions($rt_model_prepared);
	
		$rt_model->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$bg_model_ids_prepared[0]= "Select from list";
		
		$session_makeid = new Zend_Session_Namespace('makeid');
		$session_global = new Zend_Session_Namespace('global');
    	$makeid = "0";
		if(isset($session_makeid->make_id))
		{
			//$makeid = $_SESSION['makid'];
			$makeid = $session_makeid->make_id;
			$bg_model_ids_prepared[0]= "Select from list";
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
			    	$bg_model_ids_prepared[$id]= $name;
			    }
			 }
		}
		
		$bg_model_id = new Zend_Form_Element_Select('bg_model_id',array('style'=>'width:150px;'));
		$bg_model_id->setLabel('Mapped BG Model ID')
		->addMultiOptions($bg_model_ids_prepared);
		
	
		$bg_model_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$bg_submodel_ids_prepared[0]= "Select from list";
		$session_yearid = new Zend_Session_Namespace('yearid');
		$session_global_year = new Zend_Session_Namespace('global_year');
    	//$modelid = $session_modelid->modelid;
		if(isset($session_yearid->year_id))
		{
			$yearid =$session_yearid->year_id;
			$bg_submodel_ids_prepared[0]= "Select from list";
			$objDOM = new DOMDocument(); 
			$objDOM->load("http://buyersguide.caranddriver.com/api/submodels?mode=xml"); 
			$xpath = new DOMXPath($objDOM);
			$query = '//response/data/row/year_id';
	        
	        $entries = $xpath->query($query);
	        
			foreach( $entries as $entry)
			{
			    if($yearid == $entry->nodeValue)
			    { 	
			    	$name  = $entry->previousSibling->previousSibling->nodeValue;
			    	$id  = $entry->previousSibling->previousSibling->previousSibling->nodeValue;
			    	$bg_submodel_ids_prepared[$id]= $name;
			    }
			 }
		}
		
		
		$bg_submodel_id = new Zend_Form_Element_Select('bg_submodel_id',array('style'=>'width:150px;'));
		$bg_submodel_id->setLabel('Mapped BG Submodel ID')
		->addMultiOptions($bg_submodel_ids_prepared);
	
		$bg_submodel_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_issue_year = new Zend_Form_Element_Text('rt_issue_year');
		$rt_issue_year->setLabel('Mag Issue Year');
	
		$rt_issue_year->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_issue = new Zend_Form_Element_Text('rt_issue');
		$rt_issue->setLabel('Maga Issue Month');
	
		$rt_issue->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_published = new Zend_Form_Element_Text('rt_published');
		$rt_published->setLabel('Web or Print');
	
		$rt_published->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		 
		$rt_controlled_sort_prepared = $this->gatMultioptions("Sort");
		
		$rt_controlled_sort = new Zend_Form_Element_Select('rt_controlled_sort',array('style'=>'width:150px;'));
		$rt_controlled_sort->setLabel('Production Type')
					->addMultiOptions($rt_controlled_sort_prepared);
	
		$rt_controlled_sort->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_engine_prepared = $this->gatMultioptions("Engine");
		
		$rt_controlled_engine = new Zend_Form_Element_Select('rt_controlled_engine',array('style'=>'width:150px;'));
		$rt_controlled_engine->setLabel('Engine Location')
					->addMultiOptions($rt_controlled_engine_prepared);
	
		$rt_controlled_engine->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt_controlled_drive_prepared = $this->gatMultioptions("Drive");
		
		$rt_controlled_drive = new Zend_Form_Element_Select('rt_controlled_drive',array('style'=>'width:150px;'));
		$rt_controlled_drive->setLabel('Driven Wheels')
					->addMultiOptions($rt_controlled_drive_prepared);
	
		$rt_controlled_drive->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt2_passengers = new Zend_Form_Element_Text('rt2_passengers');
		$rt2_passengers->setLabel('Number of Passengers');
	
		$rt2_passengers->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt_doors = new Zend_Form_Element_Text('rt_doors');
		$rt_doors->setLabel('Number of Doors');
	
		$rt_doors->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_controlled_body_prepared = $this->gatMultioptions("Body");
		
		$rt_controlled_body = new Zend_Form_Element_Select('rt_controlled_body',array('style'=>'width:150px;'));
		$rt_controlled_body->setLabel('Body Style')
					->addMultiOptions($rt_controlled_body_prepared);
	
		$rt_controlled_body->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt_base_price = new Zend_Form_Element_Text('rt_base_price');
		$rt_base_price->setLabel('Base Price');
	
		$rt_base_price->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_base_price_notes = new Zend_Form_Element_Text('rt_base_price_notes');
		$rt_base_price_notes->setLabel('Base Price Notes');
	
		$rt_base_price_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt_price_as_tested = new Zend_Form_Element_Text('rt_price_as_tested');
		$rt_price_as_tested->setLabel('Price as Tested');
		
		$rt_price_as_tested->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_price_as_tested_notes = new Zend_Form_Element_Text('rt_price_as_tested_notes');
		$rt_price_as_tested_notes->setLabel('Price as Tested Notes');
		
		$rt_price_as_tested_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_controlled_type_prepared = $this->gatMultioptions("Type");
		$rt_controlled_type = new Zend_Form_Element_Select('rt_controlled_type',array('style'=>'width:150px;'));
		$rt_controlled_type->setLabel('Engine Type')
					->addMultiOptions($rt_controlled_type_prepared);
	
		$rt_controlled_type->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_no_cyl = new Zend_Form_Element_Text('rt_no_cyl');
		$rt_no_cyl->setLabel('Number of Cylinders');
	
		$rt_no_cyl->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt3_bore_mm = new Zend_Form_Element_Text('rt3_bore_mm');
		$rt3_bore_mm->setLabel('Cylinder Bore');
	
		$rt3_bore_mm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_stroke_mm = new Zend_Form_Element_Text('rt3_stroke_mm');
		$rt3_stroke_mm->setLabel('Cylinder Stroke');
		
		$rt3_stroke_mm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_disp_cc = new Zend_Form_Element_Text('rt_disp_cc');
		$rt_disp_cc->setLabel('Engine Disp');
		
		$rt_disp_cc->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_comp_ratio = new Zend_Form_Element_Text('rt3_comp_ratio');
		$rt3_comp_ratio->setLabel('Compression Ratio');
	
		$rt3_comp_ratio->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt2_fuel_sys = new Zend_Form_Element_Text('rt2_fuel_sys');
		$rt2_fuel_sys->setLabel('Fuel System');
	
		$rt2_fuel_sys->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_valve_gear = new Zend_Form_Element_Text('rt3_valve_gear');
		$rt3_valve_gear->setLabel('Valve Setup');
		
		$rt3_valve_gear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt3_valves_per_cyl = new Zend_Form_Element_Text('rt3_valves_per_cyl');
		$rt3_valves_per_cyl->setLabel('Valves Per Cylinder');
	
		$rt3_valves_per_cyl->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_turbo_superchg_prepared = $this->gatMultioptions("Turbo/Superchg");
		
		$rt_controlled_turbo_superchg = new Zend_Form_Element_Select('rt_controlled_turbo_superchg',array('style'=>'width:150px;'));
		$rt_controlled_turbo_superchg->setLabel('Forced Induction')
					->addMultiOptions($rt_controlled_turbo_superchg_prepared);
	
		$rt_controlled_turbo_superchg->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt3_boost_psi = new Zend_Form_Element_Text('rt3_boost_psi');
		$rt3_boost_psi->setLabel('Boost in psi');
	
		$rt3_boost_psi->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_peak_hp = new Zend_Form_Element_Text('rt_peak_hp');
		$rt_peak_hp->setLabel('Peak Horsepower');
	
		$rt_peak_hp->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_rpm = new Zend_Form_Element_Text('rt_rpm');
		$rt_rpm->setLabel('Peak Horsepower RPM');
		
		$rt_rpm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_peak_hp_notes = new Zend_Form_Element_Text('rt_peak_hp_notes');
		$rt_peak_hp_notes->setLabel('Peak Horsepower Notes');
	
		$rt_peak_hp_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_peak_torque = new Zend_Form_Element_Text('rt_peak_torque');
		$rt_peak_torque->setLabel('Peak Torque');
		
		$rt_peak_torque->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_rpmt = new Zend_Form_Element_Text('rt_rpmt');
		$rt_rpmt->setLabel('Peak Torque RPM');
		
		$rt_rpmt->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_peak_torque_notes = new Zend_Form_Element_Text('rt_peak_torque_notes');
		$rt_peak_torque_notes->setLabel('Peak Torque Notes');
		
		$rt_peak_torque_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_redline = new Zend_Form_Element_Text('rt_redline');
		$rt_redline->setLabel('Redline');
		
		$rt_redline->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_specific_power = new Zend_Form_Element_Text('rt3_specific_power');
		$rt3_specific_power->setLabel('Spec pow (hp/liter)');
		
		$rt3_specific_power->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_power_to_weight = new Zend_Form_Element_Text('rt_power_to_weight');
		$rt_power_to_weight->setLabel('Power/Weight (hp/lb)');
		
		$rt_power_to_weight->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_controlled_transmission_prepared= $this->gatMultioptions("Transmission");
		
		$rt_controlled_transmission = new Zend_Form_Element_Select('rt_controlled_transmission',array('style'=>'width:150px;'));
		$rt_controlled_transmission->setLabel('Transmission Type')
					->addMultiOptions($rt_controlled_transmission_prepared);
	
		$rt_controlled_transmission->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt3_final_drive_ratio = new Zend_Form_Element_Text('rt3_final_drive_ratio');
		$rt3_final_drive_ratio->setLabel('Final Drive');
		
		$rt3_final_drive_ratio->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_max_mph_1000_rpm = new Zend_Form_Element_Text('rt3_max_mph_1000_rpm');
		$rt3_max_mph_1000_rpm->setLabel('Top Gear mph/1000rpm');
		
		$rt3_max_mph_1000_rpm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_wheelbase = new Zend_Form_Element_Text('rt3_wheelbase');
		$rt3_wheelbase->setLabel('Wheelbase');
	
		$rt3_wheelbase->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_length = new Zend_Form_Element_Text('rt3_length');
		$rt3_length->setLabel('Length');
		
		$rt3_length->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_width = new Zend_Form_Element_Text('rt3_width');
		$rt3_width->setLabel('Width');
	
		$rt3_width->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt3_height = new Zend_Form_Element_Text('rt3_height');
		$rt3_height->setLabel('Height');
		
		$rt3_height->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_frontal_area = new Zend_Form_Element_Text('rt3_frontal_area');
		$rt3_frontal_area->setLabel('Frontal Area');
		
		$rt3_frontal_area->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt3_frontal_area_notes = new Zend_Form_Element_Text('rt3_frontal_area_notes');
		$rt3_frontal_area_notes->setLabel('Frontal Area Notes');
		
		$rt3_frontal_area_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_cd = new Zend_Form_Element_Text('rt3_cd');
		$rt3_cd->setLabel('Coefficient of Drag');
	
		$rt3_cd->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_weight = new Zend_Form_Element_Text('rt_weight');
		$rt_weight->setLabel('Curb Weight');
		
		$rt_weight->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_percent_on_front = new Zend_Form_Element_Text('rt_percent_on_front');
		$rt_percent_on_front->setLabel('Pct. Weight on Front');
	
		$rt_percent_on_front->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_percent_on_rear = new Zend_Form_Element_Text('rt_percent_on_rear');
		$rt_percent_on_rear->setLabel('Pct. Weight on Rear');
	
		$rt_percent_on_rear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$select = $db->select()
	             ->from(array('rtd'=>'rt_dropdown_descriptions'),array('rtd.id_descriptions As dropdownid', 'rtd.description As description'))
	             ->joinInner(array('rtl'=>'rt_dropdown_lookup'),'rtl.id_descriptions=rtd.id_descriptions')
	             ->joinInner(array('rtdt'=>'rt_dropdown_types'),'rtdt.id_types=rtl.id_types')
	             ->where('rtdt.rt_types = ?', 'Airbags')
	             ->group('rtd.id_descriptions')
	             ->order('rtd.description ASC');
	
	    $results = $db->query($select)->fetchAll();
	    
	    $multioptions_prepared = "";
	    $rt_controlled_airbags_prepared[0]= "Select from list";
		if (count($results)!=0){
				foreach ($results as $result){
						$rt_controlled_airbags_prepared[$result['dropdownid']]= $result['description'];
				}
		}
		
		$rt2_controlled_airbags = new Zend_Form_Element_Select('rt2_controlled_airbags',array('style'=>'width:150px;'));
		$rt2_controlled_airbags->setLabel('Listing of Airbag Positions')
					->addMultiOptions($rt_controlled_airbags_prepared);
	
		$rt2_controlled_airbags->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt2_int_vol_front = new Zend_Form_Element_Text('rt2_int_vol_front');
		$rt2_int_vol_front->setLabel('Interior Volume');
	
		$rt2_int_vol_front->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_mid = new Zend_Form_Element_Text('rt2_mid');
		$rt2_mid->setLabel('Vol Behind Mid Row');
	
		$rt2_mid->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_rear = new Zend_Form_Element_Text('rt2_rear');
		$rt2_rear->setLabel('Vol Behind Rear Row');
	
		$rt2_rear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt3_trunk = new Zend_Form_Element_Text('rt3_trunk');
		$rt3_trunk->setLabel('Trunk Volume');
		
		$rt3_trunk->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt2_turning_cirl = new Zend_Form_Element_Text('rt2_turning_cir');
		$rt2_turning_cirl->setLabel('Turning Radius');
	
		$rt2_turning_cirl->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt2_anti_lock = new Zend_Form_Element_Text('rt2_anti_lock');
		$rt2_anti_lock->setLabel('Anti-Lock Brakes?');
	
		$rt2_anti_lock->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_traction_control = new Zend_Form_Element_Text('rt2_traction_control');
		$rt2_traction_control->setLabel('Traction Control?');
	
		$rt2_traction_control->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_trac_defeatable = new Zend_Form_Element_Text('rt2_trac_defeatable');
		$rt2_trac_defeatable->setLabel('Tc Defeatable?');
	
		$rt2_trac_defeatable->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt2_stability_control = new Zend_Form_Element_Text('rt2_stability_control');
		$rt2_stability_control->setLabel('Stability Control');
	
		$rt2_stability_control->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt2_stab_defeatable = new Zend_Form_Element_Text('rt2_stab_defeatable');
		$rt2_stab_defeatable->setLabel('Esc Defeatable?');
	
		$rt2_stab_defeatable->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt3_10mph = new Zend_Form_Element_Text('rt3_10mph');
		$rt3_10mph->setLabel('0-10 Accel');
	
		$rt3_10mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_20mph = new Zend_Form_Element_Text('rt3_20mph');
		$rt3_20mph->setLabel('0-20 Accel');
	
		$rt3_20mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_30mph = new Zend_Form_Element_Text('rt2_30mph');
		$rt2_30mph->setLabel('0-30 Accel');
	
		$rt2_30mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_40mph = new Zend_Form_Element_Text('rt3_40mph');
		$rt3_40mph->setLabel('0-40 Accel');
	
		$rt3_40mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_50mph = new Zend_Form_Element_Text('rt3_50mph');
		$rt3_50mph->setLabel('0-50 Accel');
	
		$rt3_50mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_60mph = new Zend_Form_Element_Text('rt_60mph');
		$rt_60mph->setLabel('0-60 Accel');
	
		$rt_60mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_70mph = new Zend_Form_Element_Text('rt3_70mph');
		$rt3_70mph->setLabel('0-70 Accel');
	
		$rt3_70mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt3_80mph = new Zend_Form_Element_Text('rt3_80mph');
		$rt3_80mph->setLabel('0-80 Accel');
	
		$rt3_80mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_90mph = new Zend_Form_Element_Text('rt3_90mph');
		$rt3_90mph->setLabel('0-90 Accel');
	
		$rt3_90mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_100mph = new Zend_Form_Element_Text('rt2_100mph');
		$rt2_100mph->setLabel('0-100 Accel');
	
		$rt2_100mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_110mph = new Zend_Form_Element_Text('rt3_110mph');
		$rt3_110mph->setLabel('0-110 Accel');
	
		$rt3_110mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_120mph = new Zend_Form_Element_Text('rt3_120mph');
		$rt3_120mph->setLabel('0-120 Accel');
	
		$rt3_120mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_130mph = new Zend_Form_Element_Text('rt2_130mph');
		$rt2_130mph->setLabel('0-130 Accel');
	
		$rt2_130mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_140mph = new Zend_Form_Element_Text('rt3_140mph');
		$rt3_140mph->setLabel('0-140 Accel');
	
		$rt3_140mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_150mph = new Zend_Form_Element_Text('rt3_150mph');
		$rt3_150mph->setLabel('0-150 Accel');
	
		$rt3_150mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_160mph = new Zend_Form_Element_Text('rt3_160mph');
		$rt3_160mph->setLabel('0-160 Accel');
	
		$rt3_160mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_170mph = new Zend_Form_Element_Text('rt3_170mph');
		$rt3_170mph->setLabel('0-170 Accel');
	
		$rt3_170mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_180mph = new Zend_Form_Element_Text('rt3_180mph');
		$rt3_180mph->setLabel('0-180 Accel');
	
		$rt3_180mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_190mph = new Zend_Form_Element_Text('rt3_190mph');
		$rt3_190mph->setLabel('0-190 Accel');
	
		$rt3_190mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_200mph = new Zend_Form_Element_Text('rt3_200mph');
		$rt3_200mph->setLabel('0-200 Accel');
	
		$rt3_200mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_ss60 = new Zend_Form_Element_Text('rt_ss60');
		$rt_ss60->setLabel('5-60 ss Accel');
		
		$rt_ss60->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt2_30_50TG = new Zend_Form_Element_Text('rt2_30_50TG');
		$rt2_30_50TG->setLabel('Top-Gear Accel 30-50');
		
		$rt2_30_50TG->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_50_70TG = new Zend_Form_Element_Text('rt2_50-70TG');
		$rt2_50_70TG->setLabel('Top-Gear Accel 50-70');
		
		$rt2_50_70TG->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_sum_of_tg_times = new Zend_Form_Element_Text('rt2_sum_of_tg_times');
		$rt2_sum_of_tg_times->setLabel('Sum of the above 2');
	
		$rt2_sum_of_tg_times->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt_quarter_time = new Zend_Form_Element_Text('rt_quarter_time');
		$rt_quarter_time->setLabel('Quarter Mile Time');
	
		$rt_quarter_time->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Text('rt_speed_qtr_mile_speed_trap');
		$rt_speed_qtr_mile_speed_trap->setLabel('Quarter Trap Speed');
	
		$rt_speed_qtr_mile_speed_trap->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt_top_speed = new Zend_Form_Element_Text('rt_top_speed');
		$rt_top_speed->setLabel('Top Speed');
	
		$rt_top_speed->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_ts_limit_prepared = $this->gatMultioptions("TS limit");
		
		$rt_controlled_ts_limit = new Zend_Form_Element_Select('rt_controlled_ts_limit',array('style'=>'width:150px;'));
		$rt_controlled_ts_limit->setLabel('Top Speed Limit')
					->addMultiOptions($rt_controlled_ts_limit_prepared);
	
		$rt_controlled_ts_limit->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_top_speed_notes = new Zend_Form_Element_Text('rt_top_speed_notes');
		$rt_top_speed_notes->setLabel('Top Speed Notes');
	
		$rt_top_speed_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_70_mph_braking = new Zend_Form_Element_Text('rt_70_mph_braking');
		$rt_70_mph_braking->setLabel('Braking from 70');
	
		$rt_70_mph_braking->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_skidpad = new Zend_Form_Element_Text('rt2_skidpad');
		$rt2_skidpad->setLabel('Skidpad Grip');
		
		$rt2_skidpad->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_emergency_lane_change = new Zend_Form_Element_Text('rt2_emergency_lane_change');
		$rt2_emergency_lane_change->setLabel('MPH in Lane Change');
		
		$rt2_emergency_lane_change->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt_slalom = new Zend_Form_Element_Text('rt_slalom');
		$rt_slalom->setLabel('Slalom Speed');
		
		$rt_slalom->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_fuel_prepared = $this->gatMultioptions("Fuel");
		
		$rt_controlled_fuel = new Zend_Form_Element_Select('rt_controlled_fuel',array('style'=>'width:150px;'));
		$rt_controlled_fuel->setLabel('Fuel Type')
					->addMultiOptions($rt_controlled_fuel_prepared);
	
		$rt_controlled_fuel->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_fuel_cap = new Zend_Form_Element_Text('rt3_fuel_cap');
		$rt3_fuel_cap->setLabel('Fuel Capacity');
		
		$rt3_fuel_cap->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_epa_city_fe = new Zend_Form_Element_Text('rt2_epa_city_fe');
		$rt2_epa_city_fe->setLabel('EPA City');
	
		$rt2_epa_city_fe->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_epa_city_fe_notes = new Zend_Form_Element_Text('rt2_epa_city_fe_notes');
		$rt2_epa_city_fe_notes->setLabel('EPA City Notes');
	
		$rt2_epa_city_fe_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt2_highway_fe = new Zend_Form_Element_Text('rt2_highway_fe');
		$rt2_highway_fe->setLabel('EPA Highway');
	
		$rt2_highway_fe->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_highway_fe_notes = new Zend_Form_Element_Text('rt2_highway_fe_notes');
		$rt2_highway_fe_notes->setLabel('EPA HIghway Notes');
	
		$rt2_highway_fe_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_cd_observed_fe = new Zend_Form_Element_Text('rt_cd_observed_fe');
		$rt_cd_observed_fe->setLabel('C/D Observed Economy');
	
		$rt_cd_observed_fe->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_sound_level_idle = new Zend_Form_Element_Text('rt2_sound_level_idle');
		$rt2_sound_level_idle->setLabel('Sound Level Idle');
	
		$rt2_sound_level_idle->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt2_wot = new Zend_Form_Element_Text('rt2_wot');
		$rt2_wot->setLabel('DB at Wot');
	
		$rt2_wot->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt2_70cr = new Zend_Form_Element_Text('rt2_70cr');
		$rt2_70cr->setLabel('DB at 70 MPH Cruise');
		
		$rt2_70cr->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_70co = new Zend_Form_Element_Text('rt3_70co');
		$rt3_70co->setLabel('BD at 70 Coast');
	
		$rt3_70co->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_lt_oil = new Zend_Form_Element_Text('rt3_lt_oil');
		$rt3_lt_oil->setLabel('Long-term Oil Used');
		
		$rt3_lt_oil->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		
		$rt3_lt_stps_sched = new Zend_Form_Element_Text('rt3_lt_stps_sched');
		$rt3_lt_stps_sched->setLabel('LT Scheduled Stops');
		
		$rt3_lt_stps_sched->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_lt_stps_unsched = new Zend_Form_Element_Text('rt3_lt_stps_unsched');
		$rt3_lt_stps_unsched->setLabel('LT Unscheduled Stops');
		
		$rt3_lt_stps_unsched->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_lt_serv = new Zend_Form_Element_Text('rt3_lt_serv');
		$rt3_lt_serv->setLabel('Costs for LT Service');
		
		$rt3_lt_serv->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt3_lt_wear = new Zend_Form_Element_Text('rt3_lt_wear');
		$rt3_lt_wear->setLabel('Costs for LT Wear');
		
		$rt3_lt_wear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_lt_repiar = new Zend_Form_Element_Text('rt3_lt_repair');
		$rt3_lt_repiar->setLabel('Costs for LT Repair');
		
		$rt3_lt_repiar->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_50_mph = new Zend_Form_Element_Text('rt2_50_mph');
		$rt2_50_mph->setLabel('rt2_50_mph');
		
		$rt2_50_mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_70_mph = new Zend_Form_Element_Text('rt2_70_mph');
		$rt2_70_mph->setLabel('rt2_70_mph');
		
		$rt2_70_mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_et_factor = new Zend_Form_Element_Text('rt3_et_factor');
		$rt3_et_factor->setLabel('rt3_et_factor');
		
		$rt3_et_factor->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_road_hp_30mph = new Zend_Form_Element_Text('rt3_road_hp_30mph');
		$rt3_road_hp_30mph->setLabel('rt3_road_hp_30mph');
		
		$rt3_road_hp_30mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_sp_factor = new Zend_Form_Element_Text('rt3_sp_factor');
		$rt3_sp_factor->setLabel('rt3_sp_factor');
		
		$rt3_sp_factor->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_peak_bmep = new Zend_Form_Element_Text('rt3_peak_bmep');
		$rt3_peak_bmep->setLabel('rt3_peak_bmep');
		
		$rt3_peak_bmep->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt3_peal_bmep = new Zend_Form_Element_Text('rt3_peal_bmep');
		$rt3_peal_bmep->setLabel('rt3_peal_bmep');
		
		$rt3_peal_bmep->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_controlled_make_ids_prepared[0]= "Select from list";
		$bg_controlled_make_id = new Zend_Form_Element_Select('bg_controlled_make_id',array('style'=>'width:150px;'));
		$bg_controlled_make_id->setLabel('bg_cont_make_id')
					->addMultiOptions($bg_controlled_make_ids_prepared);
	
		$bg_controlled_make_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$bg_controlled_model_ids_prepared[0]= "Select from list";
		$bg_controlled_model_id = new Zend_Form_Element_Select('bg_controlled_model_id',array('style'=>'width:150px;'));
		$bg_controlled_model_id->setLabel('bg_cont_model_id')
					->addMultiOptions($bg_controlled_model_ids_prepared);
	
		$bg_controlled_model_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt_original_table_ids_prepared[0]= "Select from list";
		$rt_original_table_id = new Zend_Form_Element_Select('rt_original_table_id',array('style'=>'width:150px;'));
		$rt_original_table_id->setLabel('Original Year')
					->addMultiOptions($rt_original_table_ids_prepared);
	
		$rt_original_table_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td','colspan' => 4)),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$review_changes = new Zend_Form_Element_Submit('review_cganges');
		$review_changes->setLabel('Review');
		
		$review_changes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td', 'colspan' => 3,'align' => 'right')),
		));
		
		$cancel = new Zend_Form_Element_Submit('cancel');
		$cancel->setLabel('Cancel');
		
		$cancel->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td', 'colspan' => 4, 'align' => 'left')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$this->addElements(array(
		$enterId,
		$rt_model_year,
		$bg_year_id, 
		$rt_controlled_make,
		$bg_make_id,
		$rt_model,
		$bg_model_id,
		$bg_submodel_id,
		$rt_issue_year,
		$rt_issue,
		$rt_published,
		$rt_controlled_sort,
		$rt_controlled_engine,
		$rt_controlled_drive,
		$rt2_passengers,
		$rt_doors,
		$rt_controlled_body,
		$rt_base_price,
		$rt_base_price_notes,
		$rt_price_as_tested,
		$rt_price_as_tested_notes,
		$rt_controlled_type,
		$rt_no_cyl,
		$rt3_bore_mm,
		$rt3_stroke_mm,
		$rt_disp_cc,
		$rt3_comp_ratio,
		$rt2_fuel_sys,
		$rt3_valve_gear,
		$rt3_valves_per_cyl,
		$rt_controlled_turbo_superchg,
		$rt3_boost_psi,
		$rt_peak_hp,
		$rt_rpm,
		$rt_peak_hp_notes,
		$rt_peak_torque,
		$rt_rpmt,
		$rt_peak_torque_notes,
		$rt_redline,
		$rt3_specific_power,
		$rt_power_to_weight,
		$rt_controlled_transmission,
		$rt3_final_drive_ratio,
		$rt3_max_mph_1000_rpm,
		$rt3_wheelbase,
		$rt3_length,
		$rt3_width,
		$rt3_height,
		$rt3_frontal_area,
		$rt3_frontal_area_notes,
		$rt3_cd,
		$rt_weight,
		$rt_percent_on_front,
		$rt_percent_on_rear,
		$rt2_controlled_airbags,
		$rt2_int_vol_front,
		$rt2_mid,
		$rt2_rear,
		$rt3_trunk,
		$rt2_turning_cirl,
		$rt2_turning_cir,
		$rt2_anti_lock,
		$rt2_traction_control,
		$rt2_trac_defeatable,
		$rt2_stability_control,
		$rt2_stab_defeatable,
		$rt3_10mph,
		$rt3_20mph,
		$rt2_30mph,
		$rt3_40mph,
		$rt3_50mph,
		$rt_60mph,
		$rt3_70mph,
		$rt3_80mph,
		$rt3_90mph,
		$rt2_100mph,
		$rt3_110mph,
		$rt3_120mph,
		$rt2_130mph,
		$rt3_140mph,
		$rt3_150mph,
		$rt3_160mph,
		$rt3_170mph,
		$rt3_180mph,
		$rt3_190mph,
		$rt3_200mph,
		$rt_ss60,
		$rt2_30_50TG,
		$rt2_50_70TG,
		$rt2_sum_of_tg_times,
		$rt_quarter_time,
		$rt_speed_qtr_mile_speed_trap,
		$rt_top_speed,
		$rt_controlled_ts_limit,
		$rt_top_speed_notes,
		$rt_70_mph_braking,
		$rt2_skidpad,
		$rt2_emergency_lane_change,
		$rt_slalom,
		$rt_controlled_fuel,
		$rt3_fuel_cap,
		$rt2_epa_city_fe,
		$rt2_epa_city_fe_notes,
		$rt2_highway_fe,
		$rt2_highway_fe_notes,
		$rt_cd_observed_fe,
		$rt2_sound_level_idle,
		$rt2_wot,
		$rt2_70cr,
		$rt3_70co,
		$rt3_lt_oil,
		$rt3_lt_stps_sched,
		$rt3_lt_stps_unsched,
		$rt3_lt_serv,
		$rt3_lt_wear,
		$rt3_lt_repiar,
		$rt2_50_mph,
		$rt2_70_mph,
		$rt3_et_factor,
		$rt3_road_hp_30mph,
		$rt3_sp_factor,
		$rt3_peak_bmep,
		$rt3_peal_bmep,
		$bg_controlled_make_id,
		$bg_controlled_model_id,
		$rt_original_table_id,
		$review_changes,
		$cancel
		));
		
		$this->setDecorators(array(
		'FormElements',
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '3', 'width' => '90%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
		'Form'
		));
		
	}
	
	private function gatMultioptions($type)
	{
		$db = Zend_Db_Table::getDefaultAdapter(); 
		
		$select = $db->select()
	             ->from(array('rtd'=>'rt_dropdown_descriptions'),array('rtd.id_descriptions As dropdownid', 'rtd.description As description'))
	             ->joinInner(array('rtl'=>'rt_dropdown_lookup'),'rtl.id_descriptions=rtd.id_descriptions')
	             ->joinInner(array('rtdt'=>'rt_dropdown_types'),'rtdt.id_types=rtl.id_types')
	             ->where('rtdt.rt_types = ?', $type)
	             ->group('rtd.id_descriptions')
	             ->order('rtd.description ASC');
	
	    $results = $db->query($select)->fetchAll();
	    
	    $multioptions_prepared = "";
		if (count($results)!=0){
				$multioptions_prepared[0]= "Select from list";
				foreach ($results as $result){
						$multioptions_prepared[$result['dropdownid']]= $result['description'];
				}
		}
		return $multioptions_prepared;
	}
}
?>