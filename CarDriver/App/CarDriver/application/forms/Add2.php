<?php
class Application_Form_Add2 extends Application_Form_MainForm
{
	public function init()
	{
		$rt3_final_drive_ratio = new Zend_Form_Element_Text('rt3_final_drive_ratio');
		$rt3_final_drive_ratio->setLabel('rt3_final_drive_ratio');
		
		$rt3_final_drive_ratio->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_width = new Zend_Form_Element_Text('rt3_width');
		$rt3_width->setLabel('rt3_width');
	
		$rt3_width->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_frontal_area = new Zend_Form_Element_Text('rt3_frontal_area');
		$rt3_frontal_area->setLabel('rt3_frontal_area');
		
		$rt3_frontal_area->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_valves_per_cyl = new Zend_Form_Element_Text('rt3_valves_per_cyl');
		$rt3_valves_per_cyl->setLabel('rt3_valves_per_cyl');
	
		$rt3_valves_per_cyl->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_frontal_area_notes = new Zend_Form_Element_Text('rt3_frontal_area_notes');
		$rt3_frontal_area_notes->setLabel('rt3_frontal_area_notes');
		
		$rt3_frontal_area_notes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_wheelbase = new Zend_Form_Element_Text('rt3_wheelbase');
		$rt3_wheelbase->setLabel('rt3_wheelbase');
	
		$rt3_wheelbase->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_fuel_cap = new Zend_Form_Element_Text('rt3_fuel_cap');
		$rt3_fuel_cap->setLabel('rt3_fuel_cap');
		
		$rt3_fuel_cap->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_70co = new Zend_Form_Element_Text('rt3_70co');
		$rt3_70co->setLabel('rt3_70co');
	
		$rt3_70co->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_height = new Zend_Form_Element_Text('rt3_height');
		$rt3_height->setLabel('rt3_height');
		
		$rt3_height->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_10mph = new Zend_Form_Element_Text('rt3_10mph');
		$rt3_10mph->setLabel('rt3_10mph');
	
		$rt3_10mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_length = new Zend_Form_Element_Text('rt3_length');
		$rt3_length->setLabel('rt3_length');
		
		$rt3_length->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_20mph = new Zend_Form_Element_Text('rt3_20mph');
		$rt3_20mph->setLabel('rt3_20mph');
	
		$rt3_20mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_lt_oil = new Zend_Form_Element_Text('rt3_lt_oil');
		$rt3_lt_oil->setLabel('rt3_lt_oil');
		
		$rt3_lt_oil->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_40mph = new Zend_Form_Element_Text('rt3_40mph');
		$rt3_40mph->setLabel('rt3_40mph');
	
		$rt3_40mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_lt_repiar = new Zend_Form_Element_Text('rt3_lt_repair');
		$rt3_lt_repiar->setLabel('rt3_lt_repair');
		
		$rt3_lt_repiar->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_50mph = new Zend_Form_Element_Text('rt3_50mph');
		$rt3_50mph->setLabel('rt3_50mph');
	
		$rt3_50mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_lt_serv = new Zend_Form_Element_Text('rt3_lt_serv');
		$rt3_lt_serv->setLabel('rt3_lt_serv');
		
		$rt3_lt_serv->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_70mph = new Zend_Form_Element_Text('rt3_70mph');
		$rt3_70mph->setLabel('rt3_70mph');
	
		$rt3_70mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_lt_stps_sched = new Zend_Form_Element_Text('rt3_lt_stps_sched');
		$rt3_lt_stps_sched->setLabel('rt3_lt_stps_sched');
		
		$rt3_lt_stps_sched->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_80mph = new Zend_Form_Element_Text('rt3_80mph');
		$rt3_80mph->setLabel('rt3_80mph');
	
		$rt3_80mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_lt_stps_unsched = new Zend_Form_Element_Text('rt3_lt_stps_unsched');
		$rt3_lt_stps_unsched->setLabel('rt3_lt_stps_unsched');
		
		$rt3_lt_stps_unsched->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_90mph = new Zend_Form_Element_Text('rt3_90mph');
		$rt3_90mph->setLabel('rt3_90mph');
	
		$rt3_90mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_lt_wear = new Zend_Form_Element_Text('rt3_lt_wear');
		$rt3_lt_wear->setLabel('rt3_lt_wear');
		
		$rt3_lt_wear->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_110mph = new Zend_Form_Element_Text('rt3_110mph');
		$rt3_110mph->setLabel('rt3_110mph');
	
		$rt3_110mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_max_mph_1000_rpm = new Zend_Form_Element_Text('rt3_max_mph_1000_rpm');
		$rt3_max_mph_1000_rpm->setLabel('rt3_max_mph_1000_rpm');
		
		$rt3_max_mph_1000_rpm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_120mph = new Zend_Form_Element_Text('rt3_120mph');
		$rt3_120mph->setLabel('rt3_120mph');
	
		$rt3_120mph->setDecorators(array(
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
		
		$rt3_140mph = new Zend_Form_Element_Text('rt3_140mph');
		$rt3_140mph->setLabel('rt3_140mph');
	
		$rt3_140mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_peal_bmep = new Zend_Form_Element_Text('rt3_peal_bmep');
		$rt3_peal_bmep->setLabel('rt3_peal_bmep');
		
		$rt3_peal_bmep->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_150mph = new Zend_Form_Element_Text('rt3_150mph');
		$rt3_150mph->setLabel('rt3_150mph');
	
		$rt3_150mph->setDecorators(array(
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
		
		$rt3_160mph = new Zend_Form_Element_Text('rt3_160mph');
		$rt3_160mph->setLabel('rt3_160mph');
	
		$rt3_160mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_sp_factor = new Zend_Form_Element_Text('rt3_sp_factor');
		$rt3_sp_factor->setLabel('rt3_sp_factor');
		
		$rt3_sp_factor->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_170mph = new Zend_Form_Element_Text('rt3_170mph');
		$rt3_170mph->setLabel('rt3_170mph');
	
		$rt3_170mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_specific_power = new Zend_Form_Element_Text('rt3_specific_power');
		$rt3_specific_power->setLabel('rt3_specific_power');
		
		$rt3_specific_power->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_180mph = new Zend_Form_Element_Text('rt3_180mph');
		$rt3_180mph->setLabel('rt3_180mph');
	
		$rt3_180mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_stroke_mm = new Zend_Form_Element_Text('rt3_stroke_mm');
		$rt3_stroke_mm->setLabel('rt3_stroke_mm');
		
		$rt3_stroke_mm->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_190mph = new Zend_Form_Element_Text('rt3_190mph');
		$rt3_190mph->setLabel('rt3_190mph');
	
		$rt3_190mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_trunk = new Zend_Form_Element_Text('rt3_trunk');
		$rt3_trunk->setLabel('rt3_trunk');
		
		$rt3_trunk->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		));
		
		$rt3_200mph = new Zend_Form_Element_Text('rt3_200mph');
		$rt3_200mph->setLabel('rt3_200mph');
	
		$rt3_200mph->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td','style' => 'float:right;')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$rt3_valve_gear = new Zend_Form_Element_Text('rt3_valve_gear');
		$rt3_valve_gear->setLabel('rt3_valve_gear');
		
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
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '3', 'width' => '80%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
		'Form'
		));
	}
}
?>