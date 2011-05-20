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
		$rt_model_year->setLabel('rt_model_year')
					  ->addMultiOptions($rt_model_years_prepared);
		
		$rt_model_year->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$select = $db->select()
	             ->from('bg_make')
	             ->where('state = ?', 'published')
	             ->order('name ASC');
        $makeids = $db->query($select)->fetchAll();
	       
		if (count($makeids)!=0){
				$bg_make_ids_prepared[0]= "Select from list";
				foreach ($makeids as $makeid){
						$bg_make_ids_prepared[$makeid['id']]= $makeid['name'];
				}
		}
		
		$bg_make_id = new Zend_Form_Element_Select('bg_make_id',array('style'=>'width:150px;'));
		$bg_make_id->setLabel('bg_make_id')
					->addMultiOptions($bg_make_ids_prepared);
	
		$bg_make_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		
		));
		
		$rt_published = new Zend_Form_Element_Text('rt_published');
		$rt_published->setLabel('rt_published');
	
		$rt_published->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$select = $db->select()
	             ->from('bg_model')
	             ->where('state = ?', 'published')
	             ->order('name ASC');
        $modelids = $db->query($select)->fetchAll();
	       
		if (count($modelids)!=0){
				$bg_model_ids_prepared[0]= "Select from list";
				foreach ($modelids as $modelid){
						$bg_model_ids_prepared[$modelid['id']]= $modelid['name'];
				}
		}
		
		$bg_model_id = new Zend_Form_Element_Select('bg_model_id',array('style'=>'width:150px;'));
		$bg_model_id->setLabel('bg_model_id')
					->addMultiOptions($bg_model_ids_prepared);
	
		$bg_model_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_issue = new Zend_Form_Element_Text('rt_issue');
		$rt_issue->setLabel('rt_issue');
	
		$rt_issue->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_submodel_ids_prepared[0]= "Select from list";
		$bg_submodel_id = new Zend_Form_Element_Select('bg_submodel_id',array('style'=>'width:150px;'));
		$bg_submodel_id->setLabel('bg_submodel_id')
					->addMultiOptions($bg_submodel_ids_prepared);
	
		$bg_submodel_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_issue_year = new Zend_Form_Element_Text('rt_issue_year');
		$rt_issue_year->setLabel('rt_issue_year');
	
		$rt_issue_year->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$select = $db->select()
	             ->from('bg_year')
	             ->where('state = ?', 'published')
	             ->order('name DESC');
        $bgyearids = $db->query($select)->fetchAll();
	       
		if (count($bgyearids)!=0){
				$bg_year_ids_prepared[0]= "Select from list";
				foreach ($bgyearids as $bgyearid){
						$bg_year_ids_prepared[$bgyearid['id']]= $bgyearid['name'];
				}
		}
		
		$bg_year_id = new Zend_Form_Element_Select('bg_year_id',array('style'=>'width:150px;'));
		$bg_year_id->setLabel('bg_year_id')
					->addMultiOptions($bg_year_ids_prepared);
	
		$bg_year_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_percent_on_rear = new Zend_Form_Element_Text('rt_percent_on_rear');
		$rt_percent_on_rear->setLabel('rt_percent_on_rear');
	
		$rt_percent_on_rear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_controlled_make_ids_prepared[0]= "Select from list";
		$bg_controlled_make_id = new Zend_Form_Element_Select('bg_controlled_make_id',array('style'=>'width:150px;'));
		$bg_controlled_make_id->setLabel('bg_controlled_make_id')
					->addMultiOptions($bg_controlled_make_ids_prepared);
	
		$bg_controlled_make_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_percent_on_front = new Zend_Form_Element_Text('rt_percent_on_front');
		$rt_percent_on_front->setLabel('rt_percent_on_front');
	
		$rt_percent_on_front->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_controlled_model_ids_prepared[0]= "Select from list";
		$bg_controlled_model_id = new Zend_Form_Element_Select('bg_controlled_model_id',array('style'=>'width:150px;'));
		$bg_controlled_model_id->setLabel('bg_controlled_model_id')
					->addMultiOptions($bg_controlled_model_ids_prepared);
	
		$bg_controlled_model_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_60_mph = new Zend_Form_Element_Text('rt_60_mph');
		$rt_60_mph->setLabel('rt_60_mph');
	
		$rt_60_mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_original_table_ids_prepared[0]= "Select from list";
		$rt_original_table_id = new Zend_Form_Element_Select('rt_original_table_id',array('style'=>'width:150px;'));
		$rt_original_table_id->setLabel('rt_original_table_id')
					->addMultiOptions($rt_original_table_ids_prepared);
	
		$rt_original_table_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_70_mph_braking = new Zend_Form_Element_Text('rt_70_mph_braking');
		$rt_70_mph_braking->setLabel('rt_70_mph_braking');
	
		$rt_70_mph_braking->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_body_prepared = $this->gatMultioptions("Body");
		
		$rt_controlled_body = new Zend_Form_Element_Select('rt_controlled_body',array('style'=>'width:150px;'));
		$rt_controlled_body->setLabel('rt_controlled_body')
					->addMultiOptions($rt_controlled_body_prepared);
	
		$rt_controlled_body->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_top_speed = new Zend_Form_Element_Text('rt_top_speed');
		$rt_top_speed->setLabel('rt_top_speed');
	
		$rt_top_speed->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_engine_prepared = $this->gatMultioptions("Engine");
		
		$rt_controlled_engine = new Zend_Form_Element_Select('rt_controlled_engine',array('style'=>'width:150px;'));
		$rt_controlled_engine->setLabel('rt_controlled_engine')
					->addMultiOptions($rt_controlled_engine_prepared);
	
		$rt_controlled_engine->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_top_speed_notes = new Zend_Form_Element_Text('rt_top_speed_notes');
		$rt_top_speed_notes->setLabel('rt_top_speed_notes');
	
		$rt_top_speed_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_fuel_prepared = $this->gatMultioptions("Fuel");
		
		$rt_controlled_fuel = new Zend_Form_Element_Select('rt_controlled_fuel',array('style'=>'width:150px;'));
		$rt_controlled_fuel->setLabel('rt_controlled_fuel')
					->addMultiOptions($rt_controlled_fuel_prepared);
	
		$rt_controlled_fuel->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_base_price = new Zend_Form_Element_Text('rt_base_price');
		$rt_base_price->setLabel('rt_base_price');
	
		$rt_base_price->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_make_prepared = $this->gatMultioptions("Make");
		
		$rt_controlled_make = new Zend_Form_Element_Select('rt_controlled_make',array('style'=>'width:150px;'));
		$rt_controlled_make->setLabel('rt_controlled_make')
					->addMultiOptions($rt_controlled_make_prepared);
	
		$rt_controlled_make->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_base_price_notes = new Zend_Form_Element_Text('rt_base_price_notes');
		$rt_base_price_notes->setLabel('rt_base_price_notes');
	
		$rt_base_price_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
	    
		$rt_controlled_sort_prepared = $this->gatMultioptions("Sort");
		
		$rt_controlled_sort = new Zend_Form_Element_Select('rt_controlled_sort',array('style'=>'width:150px;'));
		$rt_controlled_sort->setLabel('rt_controlled_sort')
					->addMultiOptions($rt_controlled_sort_prepared);
	
		$rt_controlled_sort->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Text('rt_speed_qtr_mile_speed_trap');
		$rt_speed_qtr_mile_speed_trap->setLabel('rt_speed_qtr_mile_speed_trap');
	
		$rt_speed_qtr_mile_speed_trap->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_transmission_prepared= $this->gatMultioptions("Transmission");
		
		$rt_controlled_transmission = new Zend_Form_Element_Select('rt_controlled_transmission',array('style'=>'width:150px;'));
		$rt_controlled_transmission->setLabel('rt_controlled_transmission')
					->addMultiOptions($rt_controlled_transmission_prepared);
	
		$rt_controlled_transmission->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_quarter_time = new Zend_Form_Element_Text('rt_quarter_time');
		$rt_quarter_time->setLabel('rt_quarter_time');
	
		$rt_quarter_time->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_drive_prepared = $this->gatMultioptions("Drive");
		
		$rt_controlled_drive = new Zend_Form_Element_Select('rt_controlled_drive',array('style'=>'width:150px;'));
		$rt_controlled_drive->setLabel('rt_controlled_drive')
					->addMultiOptions($rt_controlled_drive_prepared);
	
		$rt_controlled_drive->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_doors = new Zend_Form_Element_Text('rt_doors');
		$rt_doors->setLabel('rt_doors');
	
		$rt_doors->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_ts_limit_prepared = $this->gatMultioptions("TS limit");
		
		$rt_controlled_ts_limit = new Zend_Form_Element_Select('rt_controlled_ts_limit',array('style'=>'width:150px;'));
		$rt_controlled_ts_limit->setLabel('rt_controlled_ts_limit')
					->addMultiOptions($rt_controlled_ts_limit_prepared);
	
		$rt_controlled_ts_limit->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_cd_observed_fe = new Zend_Form_Element_Text('rt_cd_observed_fe');
		$rt_cd_observed_fe->setLabel('rt_cd_observed_fe');
	
		$rt_cd_observed_fe->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_turbo_superchg_prepared = $this->gatMultioptions("Turbo/Superchg");
		
		$rt_controlled_turbo_superchg = new Zend_Form_Element_Select('rt_controlled_turbo_superchg',array('style'=>'width:150px;'));
		$rt_controlled_turbo_superchg->setLabel('rt_controlled_turbo_superchg')
					->addMultiOptions($rt_controlled_turbo_superchg_prepared);
	
		$rt_controlled_turbo_superchg->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_no_cyl = new Zend_Form_Element_Text('rt_no_cyl');
		$rt_no_cyl->setLabel('rt_no_cyl');
	
		$rt_no_cyl->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_controlled_type_prepared = $this->gatMultioptions("Type");
		
		$rt_controlled_type = new Zend_Form_Element_Select('rt_controlled_type',array('style'=>'width:150px;'));
		$rt_controlled_type->setLabel('rt_controlled_type')
					->addMultiOptions($rt_controlled_type_prepared);
	
		$rt_controlled_type->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_peak_hp = new Zend_Form_Element_Text('rt_peak_hp');
		$rt_peak_hp->setLabel('rt_peak_hp');
	
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
		$rt_model->setLabel('rt_model')
					->addMultiOptions($rt_model_prepared);
	
		$rt_model->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt_peak_hp_notes = new Zend_Form_Element_Text('rt_peak_hp_notes');
		$rt_peak_hp_notes->setLabel('rt_peak_hp_notes');
	
		$rt_peak_hp_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$submit = new Zend_Form_Element_Submit('submit','Next');
		
		$submit->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td', 'colspan' => 4, 'align' => 'right')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$this->addElements(array(
		$enterId,
		$rt_model_year,
		$bg_make_id,
		$rt_published,
		$bg_model_id,
		$rt_issue,
		$bg_submodel_id,
		$rt_issue_year,
		$bg_year_id,
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
		$submit
		));
		
		$this->setDecorators(array(
		'FormElements',
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '3', 'width' => '80%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
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