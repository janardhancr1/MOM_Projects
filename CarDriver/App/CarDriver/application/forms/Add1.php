<?php
class Application_Form_Add1 extends Application_Form_MainForm
{
	public function init()
	{
		$db = Zend_Db_Table::getDefaultAdapter(); 
		
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
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '3', 'width' => '100%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
		'Form'
		));
	}
}
?>