<?php
class Application_Form_Add1 extends Application_Form_MainForm
{
	public function init()
	{
		$db = Zend_Db_Table::getDefaultAdapter(); 
		
		$rt_peak_torque = new Zend_Form_Element_Text('rt_peak_torque');
		$rt_peak_torque->setLabel('rt_peak_torque');
		
		$rt_peak_torque->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_anti_lock = new Zend_Form_Element_Text('rt2_anti_lock');
		$rt2_anti_lock->setLabel('rt2_anti_lock');
	
		$rt2_anti_lock->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_peak_torque_notes = new Zend_Form_Element_Text('rt_peak_torque_notes');
		$rt_peak_torque_notes->setLabel('rt_peak_torque_notes');
		
		$rt_peak_torque_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_epa_city_fe = new Zend_Form_Element_Text('rt2_epa_city_fe');
		$rt2_epa_city_fe->setLabel('rt2_epa_city_fe');
	
		$rt2_epa_city_fe->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_power_to_weight = new Zend_Form_Element_Text('rt_power_to_weight');
		$rt_power_to_weight->setLabel('rt_power_to_weight');
		
		$rt_power_to_weight->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_epa_city_fe_notes = new Zend_Form_Element_Text('rt2_epa_city_fe_notes');
		$rt2_epa_city_fe_notes->setLabel('rt2_epa_city_fe_notes');
	
		$rt2_epa_city_fe_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_price_as_tested = new Zend_Form_Element_Text('rt_price_as_tested');
		$rt_price_as_tested->setLabel('rt_price_as_tested');
		
		$rt_price_as_tested->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_fuel_sys = new Zend_Form_Element_Text('rt2_fuel_sys');
		$rt2_fuel_sys->setLabel('rt2_fuel_sys');
	
		$rt2_fuel_sys->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_price_as_tested_notes = new Zend_Form_Element_Text('rt_price_as_tested_notes');
		$rt_price_as_tested_notes->setLabel('rt_price_as_tested_notes');
		
		$rt_price_as_tested_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_highway_fe = new Zend_Form_Element_Text('rt2_highway_fe');
		$rt2_highway_fe->setLabel('rt2_highway_fe');
	
		$rt2_highway_fe->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_redline = new Zend_Form_Element_Text('rt_redline');
		$rt_redline->setLabel('rt_redline');
		
		$rt_redline->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_highway_fe_notes = new Zend_Form_Element_Text('rt2_highway_fe_notes');
		$rt2_highway_fe_notes->setLabel('rt2_highway_fe_notes');
	
		$rt2_highway_fe_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_disp_cc = new Zend_Form_Element_Text('rt_disp_cc');
		$rt_disp_cc->setLabel('rt_disp_cc');
		
		$rt_disp_cc->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_int_vol_front = new Zend_Form_Element_Text('rt2_int_vol_front');
		$rt2_int_vol_front->setLabel('rt2_int_vol_front');
	
		$rt2_int_vol_front->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_rpm = new Zend_Form_Element_Text('rt_rpm');
		$rt_rpm->setLabel('rt_rpm');
		
		$rt_rpm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_mid = new Zend_Form_Element_Text('rt2_mid');
		$rt2_mid->setLabel('rt2_mid');
	
		$rt2_mid->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_rpmt = new Zend_Form_Element_Text('rt_rpmt');
		$rt_rpmt->setLabel('rt_rpmt');
		
		$rt_rpmt->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_passengers = new Zend_Form_Element_Text('rt2_passengers');
		$rt2_passengers->setLabel('rt2_passengers');
	
		$rt2_passengers->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_slalom = new Zend_Form_Element_Text('rt_slalom');
		$rt_slalom->setLabel('rt_slalom');
		
		$rt_slalom->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_rear = new Zend_Form_Element_Text('rt2_rear');
		$rt2_rear->setLabel('rt2_rear');
	
		$rt2_rear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_ss60 = new Zend_Form_Element_Text('rt_ss60');
		$rt_ss60->setLabel('rt_ss60');
		
		$rt_ss60->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_sound_level_idle = new Zend_Form_Element_Text('rt2_sound_level_idle');
		$rt2_sound_level_idle->setLabel('rt2_sound_level_idle');
	
		$rt2_sound_level_idle->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt_weight = new Zend_Form_Element_Text('rt_weight');
		$rt_weight->setLabel('rt_weight');
		
		$rt_weight->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_stab_defeatable = new Zend_Form_Element_Text('rt2_stab_defeatable');
		$rt2_stab_defeatable->setLabel('rt2_stab_defeatable');
	
		$rt2_stab_defeatable->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_emergency_lane_change = new Zend_Form_Element_Text('rt2_emergency_lane_change');
		$rt2_emergency_lane_change->setLabel('rt2_emergency_lane_change');
		
		$rt2_emergency_lane_change->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_stability_control = new Zend_Form_Element_Text('rt2_stability_control');
		$rt2_stability_control->setLabel('rt2_stability_control');
	
		$rt2_stability_control->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_skidpad = new Zend_Form_Element_Text('rt2_skidpad');
		$rt2_skidpad->setLabel('rt2_skidpad');
		
		$rt2_skidpad->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_sum_of_tg_times = new Zend_Form_Element_Text('rt2_sum_of_tg_times');
		$rt2_sum_of_tg_times->setLabel('rt2_sum_of_tg_times');
	
		$rt2_sum_of_tg_times->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_100_mph = new Zend_Form_Element_Text('rt2_100_mph');
		$rt2_100_mph->setLabel('rt2_100_mph');
		
		$rt2_100_mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_trac_defeatable = new Zend_Form_Element_Text('rt2_trac_defeatable');
		$rt2_trac_defeatable->setLabel('rt2_trac_defeatable');
	
		$rt2_trac_defeatable->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_130_mph = new Zend_Form_Element_Text('rt2_130_mph');
		$rt2_130_mph->setLabel('rt2_130_mph');
		
		$rt2_130_mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_traction_control = new Zend_Form_Element_Text('rt2_traction_control');
		$rt2_traction_control->setLabel('rt2_traction_control');
	
		$rt2_traction_control->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_30_50TG = new Zend_Form_Element_Text('rt2_30_50TG');
		$rt2_30_50TG->setLabel('rt2_30_50TG');
		
		$rt2_30_50TG->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_turning_cirl = new Zend_Form_Element_Text('rt2_turning_cir');
		$rt2_turning_cirl->setLabel('rt2_turning_cir');
	
		$rt2_turning_cirl->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_30_mph = new Zend_Form_Element_Text('rt2_30_mph');
		$rt2_30_mph->setLabel('rt2_30_mph');
		
		$rt2_30_mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt2_wot = new Zend_Form_Element_Text('rt2_wot');
		$rt2_wot->setLabel('rt2_wot');
	
		$rt2_wot->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_50_70TG = new Zend_Form_Element_Text('rt2_50-70TG');
		$rt2_50_70TG->setLabel('rt2_50-70TG');
		
		$rt2_50_70TG->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_boost_psi = new Zend_Form_Element_Text('rt3_boost_psi');
		$rt3_boost_psi->setLabel('rt3_boost_psi');
	
		$rt3_boost_psi->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_50_mph = new Zend_Form_Element_Text('rt2_50_mph');
		$rt2_50_mph->setLabel('rt2_50_mph');
		
		$rt2_50_mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_bore_mm = new Zend_Form_Element_Text('rt3_bore_mm');
		$rt3_bore_mm->setLabel('rt3_bore_mm');
	
		$rt3_bore_mm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt2_70cr = new Zend_Form_Element_Text('rt2_70cr');
		$rt2_70cr->setLabel('rt2_70cr');
		
		$rt2_70cr->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_cd = new Zend_Form_Element_Text('rt3_cd');
		$rt3_cd->setLabel('rt3_cd');
	
		$rt3_cd->setDecorators(array(
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
		
		$rt3_comp_ratio = new Zend_Form_Element_Text('rt3_comp_ratio');
		$rt3_comp_ratio->setLabel('rt3_comp_ratio');
	
		$rt3_comp_ratio->setDecorators(array(
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
		if (count($results)!=0){
				$rt_controlled_airbags_prepared[0]= "Select from list";
				foreach ($results as $result){
						$rt_controlled_airbags_prepared[$result['dropdownid']]= $result['description'];
				}
		}
		
		$rt2_controlled_airbags = new Zend_Form_Element_Select('rt2_controlled_airbags',array('style'=>'width:150px;'));
		$rt2_controlled_airbags->setLabel('rt2_controlled_airbags')
					->addMultiOptions($rt_controlled_airbags_prepared);
	
		$rt2_controlled_airbags->setDecorators(array(
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
		
		$submit1 = new Zend_Form_Element_Submit('submit1','Next');
		
		$submit1->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td', 'colspan' => 4, 'align' => 'right')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$this->addElements(array(
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
		$submit1
		));
		
		
		
		$this->setDecorators(array(
		'FormElements',
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '3', 'width' => '80%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
		'Form'
		));
	}
}
?>