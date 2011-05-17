<?php
class Application_Form_Add extends Application_Form_MainForm
{
	public function init()
	{
		$db = Zend_Db_Table::getDefaultAdapter(); 
		
		$enterId = new Zend_Form_Element_Text('id');
		$enterId->setLabel('id')
		->setAttrib('class', 'inputbar');
		
		$enterId->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		));
		
		$select = $db->select()
	             ->from('rt_results_main')
	             ->where('rt_model_year IS NOT NULL')
	             ->order('rt_model_year DESC');
        $rt_model_years = $db->query($select)->fetchAll();
	       
		if (count($rt_model_years)!=0){
				$rt_model_years_prepared[0]= "Select or Leave blank";
				foreach ($rt_model_years as $Yea){
						$rt_model_years_prepared[$Yea['id']]= $Yea['rt_model_year'];
				}
		}
		
		$rt_model_year = new Zend_Form_Element_Select('rt_model_year');
		$rt_model_year->setLabel('rt_model_year')
					  ->addMultiOptions($rt_model_years_prepared);
		
		$rt_model_year->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$select = $db->select()
	             ->from('bg_make')
	             ->where('state = ?', 'published')
	             ->order('name ASC');
        $makeids = $db->query($select)->fetchAll();
	       
		if (count($makeids)!=0){
				$bg_make_ids_prepared[0]= "Select or Leave blank";
				foreach ($makeids as $makeid){
						$bg_make_ids_prepared[$makeid['id']]= $makeid['name'];
				}
		}
		
		$bg_make_id = new Zend_Form_Element_Select('bg_make_id');
		$bg_make_id->setLabel('bg_make_id')
					->addMultiOptions($bg_make_ids_prepared);;
	
		$bg_make_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		
		));
		
		$rt_published = new Zend_Form_Element_Text('rt_published');
		$rt_published->setLabel('rt_published');
	
		$rt_published->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$select = $db->select()
	             ->from('bg_model')
	             ->where('state = ?', 'published')
	             ->order('name ASC');
        $modelids = $db->query($select)->fetchAll();
	       
		if (count($modelids)!=0){
				$bg_model_ids_prepared[0]= "Select or Leave blank";
				foreach ($modelids as $modelid){
						$bg_model_ids_prepared[$modelid['id']]= $modelid['name'];
				}
		}
		
		$bg_model_id = new Zend_Form_Element_Select('bg_model_id');
		$bg_model_id->setLabel('bg_model_id')
					->addMultiOptions($bg_model_ids_prepared);
	
		$bg_model_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		));
		
		$rt_issue = new Zend_Form_Element_Text('rt_issue');
		$rt_issue->setLabel('rt_issue');
	
		$rt_issue->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$bg_submodel_ids_prepared[0]= "Select or Leave blank";
		$bg_submodel_id = new Zend_Form_Element_Select('bg_submodel_id');
		$bg_submodel_id->setLabel('bg_submodel_id')
					->addMultiOptions($bg_submodel_ids_prepared);
	
		$bg_submodel_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		));
		
		$rt_issue_year = new Zend_Form_Element_Text('rt_issue_year');
		$rt_issue_year->setLabel('rt_issue_year');
	
		$rt_issue_year->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
		));
		
		$select = $db->select()
	             ->from('bg_year')
	             ->where('state = ?', 'published')
	             ->order('name DESC');
        $bgyearids = $db->query($select)->fetchAll();
	       
		if (count($bgyearids)!=0){
				$bg_year_ids_prepared[0]= "Select or Leave blank";
				foreach ($bgyearids as $bgyearid){
						$bg_year_ids_prepared[$bgyearid['id']]= $bgyearid['name'];
				}
		}
		
		$bg_year_id = new Zend_Form_Element_Select('bg_year_id');
		$bg_year_id->setLabel('bg_year_id')
					->addMultiOptions($bg_year_ids_prepared);
	
		$bg_year_id->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td')),
		));
		
		$rt_percent_on_year = new Zend_Form_Element_Text('rt_percent_on_year');
		$rt_percent_on_year->setLabel('rt_percent_on_year');
	
		$rt_percent_on_year->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td')),
		array('Label', array('tag' => 'td', 'style' => 'text-align:right;')),
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
		$rt_percent_on_year
		));
		
		$this->setDecorators(array(
		'FormElements',
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'center', 'cellpadding' => '3', 'width' => '100%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
		'Form'
		));
		
	}
}
?>