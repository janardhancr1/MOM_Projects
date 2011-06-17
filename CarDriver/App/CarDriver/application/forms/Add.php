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
		
		$rt_published = new Zend_Form_Element_Text('rt_published');
		$rt_published->setLabel('Publish Date');
	
		$rt_published->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_model_ids_prepared[0]= "Select from list";
		
		$session_makeid = new Zend_Session_Namespace('makeid');
    	$makeid = "0";
		if(isset($session_makeid->makeid))
		{
			//$makeid = $_SESSION['makid'];
			$makeid = $session_makeid->makeid;
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
		->addMultiOptions($bg_model_ids_prepared)
		->setValue($makeid);
		
	
		$bg_model_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_issue = new Zend_Form_Element_Text('rt_issue');
		$rt_issue->setLabel('Magazine Issue Month');
	
		$rt_issue->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		/*$bg_submodel_ids_prepared[0]= "Select from list";
		$session_modelid = new Zend_Session_Namespace('modelid');
    	$modid = "0";
		if(isset($session_modelid->modelid))
		{
			$modid =$session_modelid->modelid;
			$bg_submodel_ids_prepared[0]= "Select from list";
			$objDOM = new DOMDocument(); 
			$objDOM->load("http://buyersguide.caranddriver.com/api/submodels?mode=xml"); 
			$xpath = new DOMXPath($objDOM);
			$query = '//response/data/row/model_id';
	        
	        $entries = $xpath->query($query);
	        
			foreach( $entries as $entry)
			{
			    if($modid == $entry->nodeValue)
			    { 	
			    	$name  = $entry->previousSibling->nodeValue;
			    	$id  = $entry->previousSibling->previousSibling->nodeValue;
			    	$bg_submodel_ids_prepared[$id]= $name;
			    }
			 }
		}*/
		$bg_year_ids_prepared[0]= "Select from list";
		$objDOM = new DOMDocument(); 
		$objDOM->load("http://buyersguide.caranddriver.com/api/years?mode=xml"); 
		$row = $objDOM->getElementsByTagName("row"); 
		foreach( $row as $value )
		{
		    $names = $value->getElementsByTagName("name");
		    $name  = $names->item(0)->nodeValue;
			
			$ids = $value->getElementsByTagName("id");
		    $id  = $ids->item(0)->nodeValue;
			
		    $bg_year_ids_prepared[$id]= $name;
		 }
		
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
	
		
		$rt_issue_year = new Zend_Form_Element_Text('rt_issue_year');
		$rt_issue_year->setLabel('Magazine Issue Year');
	
		$rt_issue_year->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_submodel_ids_prepared[0]= "Select from list";
		$session_yearid = new Zend_Session_Namespace('yearid');
    	//$modelid = $session_modelid->modelid;
		if(isset($session_yearid->yearid))
		{
			$yearid =$session_yearid->yearid;
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
		->addMultiOptions($bg_submodel_ids_prepared)
		->setValue($modid);
	
		$bg_submodel_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
	
		
		
		$rt_percent_on_rear = new Zend_Form_Element_Text('rt_percent_on_rear');
		$rt_percent_on_rear->setLabel('Percent of Weight on Back Axle');
	
		$rt_percent_on_rear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_controlled_make_ids_prepared[0]= "Select from list";
		$bg_controlled_make_id = new Zend_Form_Element_Select('bg_controlled_make_id',array('style'=>'width:150px;'));
		$bg_controlled_make_id->setLabel('Mapped BG Controlled Make')
					->addMultiOptions($bg_controlled_make_ids_prepared);
	
		$bg_controlled_make_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_percent_on_front = new Zend_Form_Element_Text('rt_percent_on_front');
		$rt_percent_on_front->setLabel('Percent of Weight on Front Axle');
	
		$rt_percent_on_front->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_controlled_model_ids_prepared[0]= "Select from list";
		$bg_controlled_model_id = new Zend_Form_Element_Select('bg_controlled_model_id',array('style'=>'width:150px;'));
		$bg_controlled_model_id->setLabel('Mapped BG Controlled Model')
					->addMultiOptions($bg_controlled_model_ids_prepared);
	
		$bg_controlled_model_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_60_mph = new Zend_Form_Element_Text('rt_60_mph');
		$rt_60_mph->setLabel('Acceleration to 60 MPH');
	
		$rt_60_mph->setDecorators(array(
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
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_70_mph_braking = new Zend_Form_Element_Text('rt_70_mph_braking');
		$rt_70_mph_braking->setLabel('Braking from 70 MPH');
	
		$rt_70_mph_braking->setDecorators(array(
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
		
		$rt_top_speed = new Zend_Form_Element_Text('rt_top_speed');
		$rt_top_speed->setLabel('Top Speed');
	
		$rt_top_speed->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_engine_prepared = $this->gatMultioptions("Engine");
		
		$rt_controlled_engine = new Zend_Form_Element_Select('rt_controlled_engine',array('style'=>'width:150px;'));
		$rt_controlled_engine->setLabel('Engine Placement')
					->addMultiOptions($rt_controlled_engine_prepared);
	
		$rt_controlled_engine->setDecorators(array(
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
		
		$rt_base_price = new Zend_Form_Element_Text('rt_base_price');
		$rt_base_price->setLabel('Base Price');
	
		$rt_base_price->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
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
		));
		
		$rt_base_price_notes = new Zend_Form_Element_Text('rt_base_price_notes');
		$rt_base_price_notes->setLabel('Base Price Notes');
	
		$rt_base_price_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
	    
		$rt_controlled_sort_prepared = $this->gatMultioptions("Sort");
		
		$rt_controlled_sort = new Zend_Form_Element_Select('rt_controlled_sort',array('style'=>'width:150px;'));
		$rt_controlled_sort->setLabel('Production Type (Limited)')
					->addMultiOptions($rt_controlled_sort_prepared);
	
		$rt_controlled_sort->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Text('rt_speed_qtr_mile_speed_trap');
		$rt_speed_qtr_mile_speed_trap->setLabel('Speed At End of Quarter Mile');
	
		$rt_speed_qtr_mile_speed_trap->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
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
		
		$rt_controlled_drive_prepared = $this->gatMultioptions("Drive");
		
		$rt_controlled_drive = new Zend_Form_Element_Select('rt_controlled_drive',array('style'=>'width:150px;'));
		$rt_controlled_drive->setLabel('Drivetrain Type')
					->addMultiOptions($rt_controlled_drive_prepared);
	
		$rt_controlled_drive->setDecorators(array(
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
		
		$rt_controlled_ts_limit_prepared = $this->gatMultioptions("TS limit");
		
		$rt_controlled_ts_limit = new Zend_Form_Element_Select('rt_controlled_ts_limit',array('style'=>'width:150px;'));
		$rt_controlled_ts_limit->setLabel('Top Speed Limiter')
					->addMultiOptions($rt_controlled_ts_limit_prepared);
	
		$rt_controlled_ts_limit->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_cd_observed_fe = new Zend_Form_Element_Text('rt_cd_observed_fe');
		$rt_cd_observed_fe->setLabel('Observed Fuel Economy');
	
		$rt_cd_observed_fe->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_turbo_superchg_prepared = $this->gatMultioptions("Turbo/Superchg");
		
		$rt_controlled_turbo_superchg = new Zend_Form_Element_Select('rt_controlled_turbo_superchg',array('style'=>'width:150px;'));
		$rt_controlled_turbo_superchg->setLabel('Forced Induction Type')
					->addMultiOptions($rt_controlled_turbo_superchg_prepared);
	
		$rt_controlled_turbo_superchg->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_no_cyl = new Zend_Form_Element_Text('rt_no_cyl');
		$rt_no_cyl->setLabel('Number of Cylinders');
	
		$rt_no_cyl->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_type_prepared = $this->gatMultioptions("Type");
		
		$rt_controlled_type = new Zend_Form_Element_Select('rt_controlled_type',array('style'=>'width:150px;'));
		$rt_controlled_type->setLabel('Engine Cylinder Configuration')
					->addMultiOptions($rt_controlled_type_prepared);
	
		$rt_controlled_type->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_peak_hp = new Zend_Form_Element_Text('rt_peak_hp');
		$rt_peak_hp->setLabel('Peak Horsepower');
	
		$rt_peak_hp->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
	   $select = $db->select()
	             ->from('rt_results_main');
        $rt_models = $db->query($select)->fetchAll();
	       
		if (count($rt_models)!=0){
				$rt_model_prepared[0]= "Select from list";
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
		));
		
		$rt_peak_hp_notes = new Zend_Form_Element_Text('rt_peak_hp_notes');
		$rt_peak_hp_notes->setLabel('Peak Horsepower Notes');
	
		$rt_peak_hp_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_peak_torque = new Zend_Form_Element_Text('rt_peak_torque');
		$rt_peak_torque->setLabel('Peak Torque');
		
		$rt_peak_torque->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_anti_lock = new Zend_Form_Element_Text('rt2_anti_lock');
		$rt2_anti_lock->setLabel('ABS');
	
		$rt2_anti_lock->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_peak_torque_notes = new Zend_Form_Element_Text('rt_peak_torque_notes');
		$rt_peak_torque_notes->setLabel('Peak Torque Notes');
		
		$rt_peak_torque_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_epa_city_fe = new Zend_Form_Element_Text('rt2_epa_city_fe');
		$rt2_epa_city_fe->setLabel('EPA City MPG');
	
		$rt2_epa_city_fe->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_power_to_weight = new Zend_Form_Element_Text('rt_power_to_weight');
		$rt_power_to_weight->setLabel('Horsepower per Pound');
		
		$rt_power_to_weight->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_epa_city_fe_notes = new Zend_Form_Element_Text('rt2_epa_city_fe_notes');
		$rt2_epa_city_fe_notes->setLabel('EPA City MPG Notes');
	
		$rt2_epa_city_fe_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_price_as_tested = new Zend_Form_Element_Text('rt_price_as_tested');
		$rt_price_as_tested->setLabel('Price as Tested');
		
		$rt_price_as_tested->setDecorators(array(
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
		
		$rt_price_as_tested_notes = new Zend_Form_Element_Text('rt_price_as_tested_notes');
		$rt_price_as_tested_notes->setLabel('Price as Tested Notes');
		
		$rt_price_as_tested_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_highway_fe = new Zend_Form_Element_Text('rt2_highway_fe');
		$rt2_highway_fe->setLabel('EPA Highway MPG');
	
		$rt2_highway_fe->setDecorators(array(
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
		
		$rt2_highway_fe_notes = new Zend_Form_Element_Text('rt2_highway_fe_notes');
		$rt2_highway_fe_notes->setLabel('EPA HIghway MPG Notes');
	
		$rt2_highway_fe_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_disp_cc = new Zend_Form_Element_Text('rt_disp_cc');
		$rt_disp_cc->setLabel('Engine Displacement in cc');
		
		$rt_disp_cc->setDecorators(array(
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
		
		$rt_rpm = new Zend_Form_Element_Text('rt_rpm');
		$rt_rpm->setLabel('Peak Horsepower RPM');
		
		$rt_rpm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_mid = new Zend_Form_Element_Text('rt2_mid');
		$rt2_mid->setLabel('Interior Volume Behind Middle Row Seats');
	
		$rt2_mid->setDecorators(array(
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
		
		$rt2_passengers = new Zend_Form_Element_Text('rt2_passengers');
		$rt2_passengers->setLabel('Number of Passengers');
	
		$rt2_passengers->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_slalom = new Zend_Form_Element_Text('rt_slalom');
		$rt_slalom->setLabel('Slalom Speed');
		
		$rt_slalom->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_rear = new Zend_Form_Element_Text('rt2_rear');
		$rt2_rear->setLabel('Interior Volume Behind Rear Row Seats');
	
		$rt2_rear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_ss60 = new Zend_Form_Element_Text('rt_ss60');
		$rt_ss60->setLabel('Acceleration from 5 to 60 MPH');
		
		$rt_ss60->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_sound_level_idle = new Zend_Form_Element_Text('rt2_sound_level_idle');
		$rt2_sound_level_idle->setLabel('Sound Level At Idle');
	
		$rt2_sound_level_idle->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_weight = new Zend_Form_Element_Text('rt_weight');
		$rt_weight->setLabel('Curb Weight');
		
		$rt_weight->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_stab_defeatable = new Zend_Form_Element_Text('rt2_stab_defeatable');
		$rt2_stab_defeatable->setLabel('Stability Control Fully Defeatable');
	
		$rt2_stab_defeatable->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_emergency_lane_change = new Zend_Form_Element_Text('rt2_emergency_lane_change');
		$rt2_emergency_lane_change->setLabel('Speed In Emergency Lane Change');
		
		$rt2_emergency_lane_change->setDecorators(array(
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
		
		$rt2_skidpad = new Zend_Form_Element_Text('rt2_skidpad');
		$rt2_skidpad->setLabel('Skidpad');
		
		$rt2_skidpad->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_sum_of_tg_times = new Zend_Form_Element_Text('rt2_sum_of_tg_times');
		$rt2_sum_of_tg_times->setLabel('Sum of Top Gear Acceleration Times');
	
		$rt2_sum_of_tg_times->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
	
		
		$rt2_trac_defeatable = new Zend_Form_Element_Text('rt2_trac_defeatable');
		$rt2_trac_defeatable->setLabel('Traction Control Fully Defeatable');
	
		$rt2_trac_defeatable->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		
		));
		
		$rt2_130_mph = new Zend_Form_Element_Text('rt2_130_mph');
		$rt2_130_mph->setLabel('Acceleration to 130 MPH');
		
		$rt2_130_mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_traction_control = new Zend_Form_Element_Text('rt2_traction_control');
		$rt2_traction_control->setLabel('Traction Control');
	
		$rt2_traction_control->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		
		));
		
		$rt2_30_50TG = new Zend_Form_Element_Text('rt2_30_50TG');
		$rt2_30_50TG->setLabel('Top Gear Acceleration from 30 to 50 MPH');
		
		$rt2_30_50TG->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_turning_cirl = new Zend_Form_Element_Text('rt2_turning_cir');
		$rt2_turning_cirl->setLabel('Turning Radius');
	
		$rt2_turning_cirl->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		
		));
		
		$rt2_30_mph = new Zend_Form_Element_Text('rt2_30_mph');
		$rt2_30_mph->setLabel('Acceleration to 30 MPH');
		
		$rt2_30_mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_wot = new Zend_Form_Element_Text('rt2_wot');
		$rt2_wot->setLabel('Sound Level At Wide Open Throttle');
	
		$rt2_wot->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		
		));
		
		$rt2_50_70TG = new Zend_Form_Element_Text('rt2_50-70TG');
		$rt2_50_70TG->setLabel('Top Gear Acceleration from 50 to 70 MPH');
		
		$rt2_50_70TG->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_boost_psi = new Zend_Form_Element_Text('rt3_boost_psi');
		$rt3_boost_psi->setLabel('Forced Induction Boost Pressure in psi');
	
		$rt3_boost_psi->setDecorators(array(
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
		
		$rt2_70cr = new Zend_Form_Element_Text('rt2_70cr');
		$rt2_70cr->setLabel('Sound Level At 70 MPH Crusing');
		
		$rt2_70cr->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_cd = new Zend_Form_Element_Text('rt3_cd');
		$rt3_cd->setLabel('Coefficient of Drag');
	
		$rt3_cd->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt3_comp_ratio = new Zend_Form_Element_Text('rt3_comp_ratio');
		$rt3_comp_ratio->setLabel('Engine Compression Ratio');
	
		$rt3_comp_ratio->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		
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
		if (count($results)!=0){
				$rt_controlled_airbags_prepared[0]= "Select from list";
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
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		$rt3_final_drive_ratio = new Zend_Form_Element_Text('rt3_final_drive_ratio');
		$rt3_final_drive_ratio->setLabel('Final Drive Ratio');
		
		$rt3_final_drive_ratio->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_width = new Zend_Form_Element_Text('rt3_width');
		$rt3_width->setLabel('Vehicle Width');
	
		$rt3_width->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_frontal_area = new Zend_Form_Element_Text('rt3_frontal_area');
		$rt3_frontal_area->setLabel('Vehicle Frontal Area');
		
		$rt3_frontal_area->setDecorators(array(
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
		
		$rt3_frontal_area_notes = new Zend_Form_Element_Text('rt3_frontal_area_notes');
		$rt3_frontal_area_notes->setLabel('Vehicle Frontal Area Notes');
		
		$rt3_frontal_area_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_wheelbase = new Zend_Form_Element_Text('rt3_wheelbase');
		$rt3_wheelbase->setLabel('Wheelbase Length');
	
		$rt3_wheelbase->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_fuel_cap = new Zend_Form_Element_Text('rt3_fuel_cap');
		$rt3_fuel_cap->setLabel('Fuel Capacity');
		
		$rt3_fuel_cap->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_70co = new Zend_Form_Element_Text('rt3_70co');
		$rt3_70co->setLabel('Sound at 70 MPH Coasting');
	
		$rt3_70co->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_height = new Zend_Form_Element_Text('rt3_height');
		$rt3_height->setLabel('Vehicle Height');
		
		$rt3_height->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		$rt3_length = new Zend_Form_Element_Text('rt3_length');
		$rt3_length->setLabel('Vehicle Length');
		
		$rt3_length->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt3_lt_oil = new Zend_Form_Element_Text('rt3_lt_oil');
		$rt3_lt_oil->setLabel('Long-term Oil Used');
		
		$rt3_lt_oil->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		
		$rt3_lt_repiar = new Zend_Form_Element_Text('rt3_lt_repair');
		$rt3_lt_repiar->setLabel('Long-term Costs for Repair');
		
		$rt3_lt_repiar->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		
		$rt3_lt_serv = new Zend_Form_Element_Text('rt3_lt_serv');
		$rt3_lt_serv->setLabel('Long-term Costs for Service');
		
		$rt3_lt_serv->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		
		$rt3_lt_stps_sched = new Zend_Form_Element_Text('rt3_lt_stps_sched');
		$rt3_lt_stps_sched->setLabel('Long-term Scheduled Stops');
		
		$rt3_lt_stps_sched->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		
		$rt3_lt_stps_unsched = new Zend_Form_Element_Text('rt3_lt_stps_unsched');
		$rt3_lt_stps_unsched->setLabel('Long-term Unscheduled Stops');
		
		$rt3_lt_stps_unsched->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		
		$rt3_lt_wear = new Zend_Form_Element_Text('rt3_lt_wear');
		$rt3_lt_wear->setLabel('Long-term Costs for Wear');
		
		$rt3_lt_wear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_max_mph_1000_rpm = new Zend_Form_Element_Text('rt3_max_mph_1000_rpm');
		$rt3_max_mph_1000_rpm->setLabel('Top Gear MPH per 1000 RPM');
		
		$rt3_max_mph_1000_rpm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		
		
		$rt3_specific_power = new Zend_Form_Element_Text('rt3_specific_power');
		$rt3_specific_power->setLabel('Horsepower per Liter');
		
		$rt3_specific_power->setDecorators(array(
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
		
		
		
		$rt3_trunk = new Zend_Form_Element_Text('rt3_trunk');
		$rt3_trunk->setLabel('Trunk Volume');
		
		$rt3_trunk->setDecorators(array(
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
		array(array('data'=>'HtmlTag'), array('tag' => 'td','colspan' => 2)),
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
		$bg_make_id,
		$rt_published,
		$bg_model_id,
		$rt_issue,
		$bg_year_id,
		$rt_issue_year,
		$bg_submodel_id,
		$rt_percent_on_rear,
		$bg_controlled_make_id,
		$rt_percent_on_front,
		$bg_controlled_model_id,
		$rt_60_mph,
		$rt_original_table_id,
		$rt_70_mph_braking,
		$rt_controlled_body,
		$rt_top_speed,
		$rt_controlled_engine,
		$rt_top_speed_notes,
		$rt_controlled_fuel,
		$rt_base_price,
		$rt_controlled_make,
		$rt_base_price_notes,
		$rt_controlled_sort,
		$rt_speed_qtr_mile_speed_trap,
		$rt_controlled_transmission,
		$rt_quarter_time,
		$rt_controlled_drive,
		$rt_doors,
		$rt_controlled_ts_limit,
		$rt_cd_observed_fe,
		$rt_controlled_turbo_superchg,
		$rt_no_cyl,
		$rt_controlled_type,
		$rt_peak_hp,
		$rt_model,
		$rt_peak_hp_notes,
		$rt_peak_torque,
		$rt2_anti_lock,
		$rt_peak_torque_notes,
		$rt2_epa_city_fe,
		$rt_power_to_weight,
		$rt2_epa_city_fe_notes,
		$rt_price_as_tested,
		$rt2_fuel_sys,
		$rt_price_as_tested_notes,
		$rt2_highway_fe,
		$rt_redline,
		$rt2_highway_fe_notes,
		$rt_disp_cc,
		$rt2_int_vol_front,
		$rt_rpm,
		$rt2_mid,
		$rt_rpmt,
		$rt2_passengers,
		$rt_slalom,
		$rt2_rear,
		$rt_ss60,
		$rt2_sound_level_idle,
		$rt_weight,
		$rt2_stab_defeatable,
		$rt2_emergency_lane_change,
		$rt2_stability_control,
		$rt2_skidpad,
		$rt2_sum_of_tg_times,
		$rt2_100_mph,
		$rt2_trac_defeatable,
		$rt2_130_mph,
		$rt2_traction_control,
		$rt2_30_50TG,
		$rt2_turning_cirl,
		$rt2_30_mph,
		$rt2_wot,
		$rt2_50_70TG,
		$rt3_boost_psi,
		$rt2_50_mph,
		$rt3_bore_mm,
		$rt2_70cr,
		$rt3_cd,
		$rt2_70_mph,
		$rt3_comp_ratio,
		$rt2_controlled_airbags,
		$rt3_et_factor,
		$rt3_final_drive_ratio,
		$rt3_width,
		$rt3_frontal_area,
		$rt3_valves_per_cyl,
		$rt3_frontal_area_notes,
		$rt3_wheelbase,
		$rt3_fuel_cap,
		$rt3_70co,
		$rt3_height,
		$rt3_10mph,
		$rt3_length,
		$rt3_20mph,
		$rt3_lt_oil,
		$rt3_40mph,
		$rt3_lt_repiar,
		$rt3_50mph,
		$rt3_lt_serv,
		$rt3_70mph,
		$rt3_lt_stps_sched,
		$rt3_80mph,
		$rt3_lt_stps_unsched,
		$rt3_90mph,
		$rt3_lt_wear,
		$rt3_110mph,
		$rt3_max_mph_1000_rpm,
		$rt3_120mph,
		$rt3_peak_bmep,
		$rt3_140mph,
		$rt3_peal_bmep,
		$rt3_150mph,
		$rt3_road_hp_30mph,
		$rt3_160mph,
		$rt3_sp_factor,
		$rt3_170mph,
		$rt3_specific_power,
		$rt3_180mph,
		$rt3_stroke_mm,
		$rt3_190mph,
		$rt3_trunk,
		$rt3_200mph,
		$rt3_valve_gear,
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