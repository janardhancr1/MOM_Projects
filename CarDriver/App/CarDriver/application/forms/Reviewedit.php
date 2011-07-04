<?php
class Application_Form_Reviewedit extends Application_Form_MainForm
{
	public $id;
	
	public function __construct($id) 
  	{ 
     	$this->id = $id;
     	parent::__construct();
     
  	} 
	public function init()
	{
		$session_formvalues = new Zend_Session_Namespace('FormValues');
		
		$form1_Values = $session_formvalues->FormValues;
		
		$db = Zend_Db_Table::getDefaultAdapter(); 
		
		
		if(!empty($this->id))
		{
			$select = $db->select()
		             ->from('rt_results_main')
		             ->where('id = ?', $this->id);
			$rt_results_main =  $db->query($select)->fetchAll();
			
			$select = $db->select()
		             ->from('rt_results_level_2')
		             ->where('id = ?', $this->id);
			$rt_results_level_2 =  $db->query($select)->fetchAll();
			
			$select = $db->select()
		             ->from('rt_results_level_3')
		             ->where('id = ?', $this->id);
			$rt_results_level_3 =  $db->query($select)->fetchAll();
		}
		
	
		if(!empty($form1_Values['bg_year_id']) && $form1_Values['bg_year_id'] != $rt_results_main[0]['bg_year_id'])
		{	
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
		    arsort($bg_year_ids_prepared);
			$bg_year_id = new Zend_Form_Element_Select('bg_year_id',array('style'=>'width:150px;'));
			$bg_year_id->addMultiOptions($bg_year_ids_prepared)
					->setValue($form1_Values['bg_year_id']);
					
		
			$before_bg_year_id = new Zend_Form_Element_Text('before_bg_year_id',array("readonly" => "readonly"));
			$before_bg_year_id->setLabel('Year(BG)');
			
			if($rt_results_main)
				$before_bg_year_id->setValue($rt_results_main[0]['bg_year_id']);
			
			$bg_year_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_bg_year_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_bg_year_id,$bg_year_id));
			
					
		}
		else
		{
			$bg_year_id = new Zend_Form_Element_Hidden('bg_year_id');
			$bg_year_id ->removeDecorator('label')
          	->removeDecorator('HtmlTag');
			$bg_year_id->setValue($form1_Values['bg_year_id']);
			$this->addElement($bg_year_id);
		}
		
		if(!empty($form1_Values['bg_make_id']) && $form1_Values['bg_make_id'] != $rt_results_main[0]['bg_make_id'])
		{
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
			$bg_make_id->addMultiOptions($bg_make_ids_prepared)
						->setValue($form1_Values['bg_make_id']);
			$bg_make_id->setAttrib('onchange','AutoFillModel(this.value)');		
				
			$before_bg_make_id = new Zend_Form_Element_Text('before_bg_make_id',array("readonly" => "readonly"));
			$before_bg_make_id->setLabel('Make(BG)');
			
			if($rt_results_main)
				$before_bg_make_id->setValue($rt_results_main[0]['bg_make_id']);
			
			$bg_make_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_bg_make_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			
			));
			
			$this->addElements(array($before_bg_make_id,$bg_make_id));
		}
		else
		{
			$bg_make_id = new Zend_Form_Element_Hidden('bg_make_id');
			$bg_make_id ->removeDecorator('label')
          	->removeDecorator('HtmlTag');
			$bg_make_id->setValue($form1_Values['bg_make_id']);
			$this->addElement($bg_make_id);
		}
		
		if(!empty($form1_Values['bg_make_id']) && !empty($form1_Values['bg_model_id']) 
			&&  $form1_Values['bg_model_id'] != $rt_results_main[0]['bg_model_id'])
		{
			$bg_model_ids_prepared[0]= "Select from list";
		    $session_makeid = new Zend_Session_Namespace('makeid');
			if(isset($session_makeid->make_id))
			{
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
			$bg_model_id->addMultiOptions($bg_model_ids_prepared)
						->setValue($form1_Values['bg_model_id']);
			$bg_model_id->setAttrib('onchange','AutoFillSubModel(this.value)');
			
						
			$before_bg_model_id = new Zend_Form_Element_Text('before_bg_model_id',array("readonly" => "readonly"));
			$before_bg_model_id->setLabel('Model(BG)');
			
			if($rt_results_main)
				$before_bg_model_id->setValue($rt_results_main[0]['bg_model_id']);
			
			$bg_model_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			
			));
			
			$before_bg_model_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			
			));
			
			$this->addElements(array($before_bg_model_id,$bg_model_id));
		}
		else
		{
			$bg_model_id = new Zend_Form_Element_Hidden('bg_model_id');
			$bg_model_id ->removeDecorator('label')
          	->removeDecorator('HtmlTag');
			$bg_model_id->setValue($form1_Values['bg_model_id']);
			$this->addElement($bg_model_id);
		}	
		
		if(!empty($form1_Values['bg_make_id']) && !empty($form1_Values['bg_model_id']) && !empty($form1_Values['bg_year_id']) 
			&&  $form1_Values['bg_submodel_id'] != $rt_results_main[0]['bg_submodel_id'])
		{
			$bg_submodel_ids_prepared[0]= "Select from list";
			$session_yearid = new Zend_Session_Namespace('yearid');
			if(isset($session_yearid->year_id) && isset($session_yearid->model_id))
			{
				$yearid = $session_yearid->year_id;
				$modelid = $session_yearid->model_id;
				$bg_submodel_ids_prepared[0]= "Select from list";
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
				    	$bg_submodel_ids_prepared[$id]= $name;
				    }
				 }
			}
				
			$bg_submodel_id = new Zend_Form_Element_Select('bg_submodel_id',array('style'=>'width:150px;'));
			$bg_submodel_id->addMultiOptions($bg_submodel_ids_prepared)
						->setValue($form1_Values['bg_submodel_id']);
						
			$before_bg_submodel_id = new Zend_Form_Element_Text('before_bg_submodel_id',array("readonly" => "readonly"));
			$before_bg_submodel_id->setLabel('Sub-model(BG)');
			
			if($rt_results_main)
				$before_bg_submodel_id->setValue($rt_results_main[0]['bg_submodel_id']);
			
			$bg_submodel_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_bg_submodel_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_bg_submodel_id,$bg_submodel_id));
				
		}
		else
		{
			$bg_submodel_id = new Zend_Form_Element_Hidden('bg_submodel_id');
			$bg_submodel_id ->removeDecorator('label')
          	->removeDecorator('HtmlTag');
			$bg_submodel_id->setValue($form1_Values['bg_submodel_id']);
			$this->addElement($bg_submodel_id);
		}
		
		
		if(!empty($form1_Values['rt_model_year']) && $form1_Values['rt_model_year'] != $rt_results_main[0]['rt_model_year'])
		{
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
			$rt_model_year->addMultiOptions($rt_model_years_prepared)
						  ->setValue($form1_Values['rt_model_year']);
			
			$before_rt_model_year = new Zend_Form_Element_Text('before_rt_model_year',array("readonly" => "readonly"));
			$before_rt_model_year->setLabel('Year');
			
			if($rt_results_main)
			$before_rt_model_year->setValue($rt_results_main[0]['rt_model_year']);
			
			/*$model_year_delete = new Zend_Form_Element_Anchor("modelyear_Delete", array('href'=>'#'));

			$model_year_delete->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));*/
			
			$rt_model_year->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_model_year->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			
			
			$this->addElements(array($before_rt_model_year,$rt_model_year));
		}
		else
		{
			$rt_model_year = new Zend_Form_Element_Hidden('rt_model_year');
			$rt_model_year ->removeDecorator('label')
          	->removeDecorator('HtmlTag');
			$rt_model_year->setValue($form1_Values['rt_model_year']);
			$this->addElement($rt_model_year);
		}
		if(!empty($form1_Values['rt_controlled_make']) && $form1_Values['rt_controlled_make'] != $rt_results_main[0]['rt_controlled_make'])
		{
			$rt_controlled_make_prepared = $this->gatMultioptions("Make");
		
			$rt_controlled_make = new Zend_Form_Element_Select('rt_controlled_make',array('style'=>'width:150px;'));
			$rt_controlled_make->addMultiOptions($rt_controlled_make_prepared)
						->setValue($form1_Values['rt_controlled_make']);
						
			$before_rt_controlled_make = new Zend_Form_Element_Text('before_rt_controlled_make',array("readonly" => "readonly"));
			$before_rt_controlled_make->setLabel('Make');
			
			if($rt_results_main)
								$before_rt_controlled_make->setValue($rt_results_main[0]['rt_controlled_make']);
			
			$rt_controlled_make->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_make->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_make,$rt_controlled_make));
		}
		else
		{
			$rt_controlled_make = new Zend_Form_Element_Hidden('rt_controlled_make');
			$rt_controlled_make ->removeDecorator('label')
          	->removeDecorator('HtmlTag');
			$rt_controlled_make->setValue($form1_Values['rt_controlled_make']);
			$this->addElement($rt_controlled_make);
		}
		
		if(!empty($form1_Values['rt_model']) && $form1_Values['rt_model'] != $rt_results_main[0]['rt_model'])
		{
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
			$rt_model->addMultiOptions($rt_model_prepared)
						->setValue($form1_Values['rt_model']);
						
			$before_rt_model = new Zend_Form_Element_Text('before_rt_model',array("readonly" => "readonly"));
			$before_rt_model->setLabel('Model');
			
			if($rt_results_main)
								$before_rt_model->setValue($rt_results_main[0]['rt_model']);
			
			$rt_model->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_model->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_model,$rt_model));
		}
		else
		{
			$rt_model = new Zend_Form_Element_Hidden('rt_model');
			$rt_model ->removeDecorator('label')
          			  ->removeDecorator('HtmlTag');
			$rt_model->setValue($form1_Values['rt_model']);
			$this->addElement($rt_model);
		}
		if(!empty($form1_Values['rt_issue_year']) && $form1_Values['rt_issue_year'] != $rt_results_main[0]['rt_issue_year'])
		{
			$rt_issue_year = new Zend_Form_Element_Text('rt_issue_year');
			$rt_issue_year->setValue($form1_Values['rt_issue_year']);

			$before_rt_issue_year = new Zend_Form_Element_Text('before_rt_issue_year',array("readonly" => "readonly"));
			$before_rt_issue_year->setLabel('Mag Issue Year');
			
			if($rt_results_main)
				$before_rt_issue_year->setValue($rt_results_main[0]['rt_issue_year']);
			
			$rt_issue_year->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_issue_year->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_issue_year,$rt_issue_year));				
		}
		else
		{
			$rt_issue_year = new Zend_Form_Element_Hidden('rt_issue_year');
			$rt_issue_year ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_issue_year->setValue($form1_Values['rt_issue_year']);
			$this->addElement($rt_issue_year);
		}
		
		if(!empty($form1_Values['rt_issue']) && $form1_Values['rt_issue'] != $rt_results_main[0]['rt_issue'])
		{
			$rt_issue = new Zend_Form_Element_Text('rt_issue');
			$rt_issue->setValue($form1_Values['rt_issue']);
			
			$before_rt_issue = new Zend_Form_Element_Text('before_rt_issue',array("readonly" => "readonly"));
			$before_rt_issue->setLabel('Mag Issue Month');
			
			if($rt_results_main)
				$before_rt_issue->setValue($rt_results_main[0]['rt_issue']);
			
			$rt_issue->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			
			));
			
			$before_rt_issue->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			
			));
			
			$this->addElements(array($before_rt_issue,$rt_issue));
			
		}
		else
		{
			$rt_issue = new Zend_Form_Element_Hidden('rt_issue');
			$rt_issue ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_issue->setValue($form1_Values['rt_issue']);
			$this->addElement($rt_issue);
		}
		
		if(!empty($form1_Values['rt_published']) && $form1_Values['rt_published'] != $rt_results_main[0]['rt_published'])
		{
			$rt_published = new Zend_Form_Element_Text('rt_published');
			$rt_published->setValue($form1_Values['rt_published']);
			
			
			$before_rt_published = new Zend_Form_Element_Text('before_rt_published',array("readonly" => "readonly"));
			$before_rt_published->setLabel('Web or print');
			
			if($rt_results_main)
					$before_rt_published->setValue($rt_results_main[0]['rt_published']);
			
			$rt_published->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_published->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_published,$rt_published));
		}
		else
		{
			$rt_published = new Zend_Form_Element_Hidden('rt_published');
			$rt_published ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_published->setValue($form1_Values['rt_published']);
			$this->addElement($rt_published);
		}
		if(!empty($form1_Values['rt_controlled_sort']) && $form1_Values['rt_controlled_sort'] != $rt_results_main[0]['rt_controlled_sort'])
		{
			$rt_controlled_sort_prepared = $this->gatMultioptions("Sort");
		
			$rt_controlled_sort = new Zend_Form_Element_Select('rt_controlled_sort',array('style'=>'width:150px;'));
			$rt_controlled_sort->addMultiOptions($rt_controlled_sort_prepared)
						->setValue($form1_Values['rt_controlled_sort']);
						
			$before_rt_controlled_sort = new Zend_Form_Element_Text('before_rt_controlled_sort',array("readonly" => "readonly"));
			$before_rt_controlled_sort->setLabel('Production Type');
			
			if($rt_results_main)
								$before_rt_controlled_sort->setValue($rt_results_main[0]['rt_controlled_sort']);
			
			$rt_controlled_sort->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_sort->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_sort,$rt_controlled_sort));
		}
		else
		{
			$rt_controlled_sort = new Zend_Form_Element_Hidden('rt_controlled_sort');
			$rt_controlled_sort ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_controlled_sort->setValue($form1_Values['rt_controlled_sort']);
			$this->addElement($rt_controlled_sort);
		}
		if(!empty($form1_Values['rt_controlled_engine']) && $form1_Values['rt_controlled_engine'] != $rt_results_main[0]['rt_controlled_engine'])
		{
			$rt_controlled_engine_prepared = $this->gatMultioptions("Engine");
		
			$rt_controlled_engine = new Zend_Form_Element_Select('rt_controlled_engine',array('style'=>'width:150px;'));
			$rt_controlled_engine->addMultiOptions($rt_controlled_engine_prepared)
						->setValue($form1_Values['rt_controlled_engine']);
			
			$before_rt_controlled_engine = new Zend_Form_Element_Text('before_rt_controlled_engine',array("readonly" => "readonly"));
			$before_rt_controlled_engine->setLabel('Engine Location');
			
			if($rt_results_main)
								$before_rt_controlled_engine->setValue($rt_results_main[0]['rt_controlled_engine']);
			
			$rt_controlled_engine->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_engine->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_engine,$rt_controlled_engine));
		}
		else
		{
			$rt_controlled_engine = new Zend_Form_Element_Hidden('rt_controlled_engine');
			$rt_controlled_engine ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_controlled_engine->setValue($form1_Values['rt_controlled_engine']);
			$this->addElement($rt_controlled_engine);
		}
		if(!empty($form1_Values['rt_controlled_drive']) && $form1_Values['rt_controlled_drive'] != $rt_results_main[0]['rt_controlled_drive'])
		{
			$rt_controlled_drive_prepared = $this->gatMultioptions("Drive");
		
			$rt_controlled_drive = new Zend_Form_Element_Select('rt_controlled_drive',array('style'=>'width:150px;'));
			$rt_controlled_drive->addMultiOptions($rt_controlled_drive_prepared)
						->setValue($form1_Values['rt_controlled_drive']);
						
			$before_rt_controlled_drive = new Zend_Form_Element_Text('before_rt_controlled_drive',array("readonly" => "readonly"));
			$before_rt_controlled_drive->setLabel('Driven Wheels');
			
			if($rt_results_main)
								$before_rt_controlled_drive->setValue($rt_results_main[0]['rt_controlled_drive']);
			
			$rt_controlled_drive->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_drive->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_drive,$rt_controlled_drive));
		}
		else
		{
			$rt_controlled_drive = new Zend_Form_Element_Hidden('rt_controlled_drive');
			$rt_controlled_drive ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_controlled_drive->setValue($form1_Values['rt_controlled_drive']);
			$this->addElement($rt_controlled_drive);
		}
		if(!empty($form1_Values['rt2_passengers']) && $form1_Values['rt2_passengers'] != $rt_results_level_2[0]['rt2_passengers'])
		{
			$rt2_passengers = new Zend_Form_Element_Text('rt2_passengers');
			$rt2_passengers->setValue($form1_Values['rt2_passengers']);
			
			$before_rt2_passengers = new Zend_Form_Element_Text('before_rt2_passengers',array("readonly" => "readonly"));
			$before_rt2_passengers->setLabel('Number of Passengers');
			
			if($rt_results_level_2)
									  $before_rt2_passengers->setValue($rt_results_level_2[0]['rt2_passengers']);
			
			$rt2_passengers->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_passengers->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_passengers,$rt2_passengers));
		}
		else
		{
			$rt2_passengers = new Zend_Form_Element_Hidden('rt2_passengers');
			$rt2_passengers ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_passengers->setValue($form1_Values['rt2_passengers']);
			$this->addElement($rt2_passengers);
		}
		
		if(!empty($form1_Values['rt_doors']) && $form1_Values['rt_doors'] != $rt_results_main[0]['rt_doors'])
		{
			$rt_doors = new Zend_Form_Element_Text('rt_doors');
			$rt_doors->setValue($form1_Values['rt_doors']);
			
			$before_rt_doors = new Zend_Form_Element_Text('before_rt_doors',array("readonly" => "readonly"));
			$before_rt_doors->setLabel('Number of Doors');
			
			if($rt_results_main)
								$before_rt_doors->setValue($rt_results_main[0]['rt_doors']);
			
			$rt_doors->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_doors->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_doors,$rt_doors));
		}
		else
		{
			$rt_doors = new Zend_Form_Element_Hidden('rt_doors');
			$rt_doors ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_doors->setValue($form1_Values['rt_doors']);
			$this->addElement($rt_doors);
		}
		if(!empty($form1_Values['rt_controlled_body']) && $form1_Values['rt_controlled_body'] != $rt_results_main[0]['rt_controlled_body'])
		{
			$rt_controlled_body_prepared = $this->gatMultioptions("Body");
		
			$rt_controlled_body = new Zend_Form_Element_Select('rt_controlled_body',array('style'=>'width:150px;'));
			$rt_controlled_body->addMultiOptions($rt_controlled_body_prepared)
						->setValue($form1_Values['rt_controlled_body']);
			
			$before_rt_controlled_body = new Zend_Form_Element_Text('before_rt_controlled_body',array("readonly" => "readonly"));
			$before_rt_controlled_body->setLabel('Body Style');
			
			if($rt_results_main)
								$before_rt_controlled_body->setValue($rt_results_main[0]['rt_controlled_body']);
			
			$rt_controlled_body->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_body->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_body,$rt_controlled_body));			
		}
		else
		{
			$rt_controlled_body = new Zend_Form_Element_Hidden('rt_controlled_body');
			$rt_controlled_body ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_controlled_body->setValue($form1_Values['rt_controlled_body']);
			$this->addElement($rt_controlled_body);
		}
		if(!empty($form1_Values['rt_base_price']) && $form1_Values['rt_base_price'] != $rt_results_main[0]['rt_base_price'])
		{
			$rt_base_price = new Zend_Form_Element_Text('rt_base_price');
			$rt_base_price->setValue($form1_Values['rt_base_price']);
			
			$before_rt_base_price = new Zend_Form_Element_Text('before_rt_base_price',array("readonly" => "readonly"));
			$before_rt_base_price->setLabel('Base Price');
			
			if($rt_results_main)
								$before_rt_base_price->setValue($rt_results_main[0]['rt_base_price']);
			
			$rt_base_price->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_base_price->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_base_price,$rt_base_price));
		}
		else
		{
			$rt_base_price = new Zend_Form_Element_Hidden('rt_base_price');
			$rt_base_price ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_base_price->setValue($form1_Values['rt_base_price']);
			$this->addElement($rt_base_price);
		}
		
		if(!empty($form1_Values['rt_base_price_notes']) && $form1_Values['rt_base_price_notes'] != $rt_results_main[0]['rt_base_price_notes'])
		{
			$rt_base_price_notes = new Zend_Form_Element_Text('rt_base_price_notes');
			$rt_base_price_notes->setValue($form1_Values['rt_base_price_notes']);
			
			$before_rt_base_price_notes = new Zend_Form_Element_Text('before_rt_base_price_notes',array("readonly" => "readonly"));
			$before_rt_base_price_notes->setLabel('Base Price Notes');
			
			if($rt_results_main)
								$before_rt_base_price_notes->setValue($rt_results_main[0]['rt_base_price_notes']);
			
			$rt_base_price_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_base_price_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_base_price_notes,$rt_base_price_notes));
		}
		else
		{
			$rt_base_price_notes = new Zend_Form_Element_Hidden('rt_base_price_notes');
			$rt_base_price_notes ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_base_price_notes->setValue($form1_Values['rt_base_price_notes']);
			$this->addElement($rt_base_price_notes);
		}
		if(!empty($form1_Values['rt_price_as_tested']) && $form1_Values['rt_price_as_tested'] != $rt_results_main[0]['rt_price_as_tested'])
		{
			$rt_price_as_tested = new Zend_Form_Element_Text('rt_price_as_tested');
			$rt_price_as_tested->setValue($form1_Values['rt_price_as_tested']);
			
			$before_rt_price_as_tested = new Zend_Form_Element_Text('before_rt_price_as_tested',array("readonly" => "readonly"));
			$before_rt_price_as_tested->setLabel('Price as Tested');
			
			if($rt_results_main)
									  $before_rt_price_as_tested->setValue($rt_results_main[0]['rt_price_as_tested']);
			
			$rt_price_as_tested->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_price_as_tested->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_price_as_tested,$rt_price_as_tested));
		}
		else
		{
			$rt_price_as_tested = new Zend_Form_Element_Hidden('rt_price_as_tested');
			$rt_price_as_tested ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_price_as_tested->setValue($form1_Values['rt_price_as_tested']);
			$this->addElement($rt_price_as_tested);
		}
		
		if(!empty($form1_Values['rt_price_as_tested_notes']) && $form1_Values['rt_price_as_tested_notes'] != $rt_results_main[0]['rt_price_as_tested_notes'])
		{
			$rt_price_as_tested_notes = new Zend_Form_Element_Text('rt_price_as_tested_notes');
			$rt_price_as_tested_notes->setValue($form1_Values['rt_price_as_tested_notes']);
			
			$before_rt_price_as_tested_notes = new Zend_Form_Element_Text('before_rt_price_as_tested_notes',array("readonly" => "readonly"));
			$before_rt_price_as_tested_notes->setLabel('Price as Tested Notes');
			
			if($rt_results_main)
									  $before_rt_price_as_tested_notes->setValue($rt_results_main[0]['rt_price_as_tested_notes']);
			
			$rt_price_as_tested_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_price_as_tested_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_price_as_tested_notes,$rt_price_as_tested_notes));
		}
		else
		{
			$rt_price_as_tested_notes = new Zend_Form_Element_Hidden('rt_price_as_tested_notes');
			$rt_price_as_tested_notes ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_price_as_tested_notes->setValue($form1_Values['rt_price_as_tested_notes']);
			$this->addElement($rt_price_as_tested_notes);
		}
		
		if(!empty($form1_Values['rt_controlled_type']) && $form1_Values['rt_controlled_type'] != $rt_results_main[0]['rt_controlled_type'])
		{
			$rt_controlled_type_prepared = $this->gatMultioptions("Type");
		
			$rt_controlled_type = new Zend_Form_Element_Select('rt_controlled_type',array('style'=>'width:150px;'));
			$rt_controlled_type->addMultiOptions($rt_controlled_type_prepared)
						->setValue($form1_Values['rt_controlled_type']);
						
			$before_rt_controlled_type = new Zend_Form_Element_Text('before_rt_controlled_type',array("readonly" => "readonly"));
			$before_rt_controlled_type->setLabel('Engine Type');
			
			if($rt_results_main)
								$before_rt_controlled_type->setValue($rt_results_main[0]['rt_controlled_type']);
			
			$rt_controlled_type->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_type->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_type,$rt_controlled_type));
		}
		else
		{
			$rt_controlled_type = new Zend_Form_Element_Hidden('rt_controlled_type');
			$rt_controlled_type ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_controlled_type->setValue($form1_Values['rt_controlled_type']);
			$this->addElement($rt_controlled_type);
		}
		
		if(!empty($form1_Values['rt_no_cyl'])&& $form1_Values['rt_no_cyl'] != $rt_results_main[0]['rt_no_cyl'])
		{
			$rt_no_cyl = new Zend_Form_Element_Text('rt_no_cyl');
			$rt_no_cyl->setValue($form1_Values['rt_no_cyl']);
			
			$before_rt_no_cyl = new Zend_Form_Element_Text('before_rt_no_cyl',array("readonly" => "readonly"));
			$before_rt_no_cyl->setLabel('Number of Cylinders');
			
			if($rt_results_main)
								$before_rt_no_cyl->setValue($rt_results_main[0]['rt_no_cyl']);
			
			$rt_no_cyl->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_no_cyl->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_no_cyl,$rt_no_cyl));
		}
		else
		{
			$rt_no_cyl = new Zend_Form_Element_Hidden('rt_no_cyl');
			$rt_no_cyl ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_no_cyl->setValue($form1_Values['rt_no_cyl']);
			$this->addElement($rt_no_cyl);
		}
		if(!empty($form1_Values['rt3_bore_mm']) && $form1_Values['rt3_bore_mm'] != $rt_results_level_3[0]['rt3_bore_mm'])
		{
			$rt3_bore_mm = new Zend_Form_Element_Text('rt3_bore_mm');
			$rt3_bore_mm->setValue($form1_Values['rt3_bore_mm']);
			
			$before_rt3_bore_mm = new Zend_Form_Element_Text('before_rt3_bore_mm',array("readonly" => "readonly"));
			$before_rt3_bore_mm->setLabel('Cylinder Bore');
			
			if($rt_results_level_3)
										$before_rt3_bore_mm->setValue($rt_results_level_3[0]['rt3_bore_mm']);
			
			$rt3_bore_mm->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_bore_mm->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_bore_mm,$rt3_bore_mm));
		}
		else
		{
			$rt3_bore_mm = new Zend_Form_Element_Hidden('rt3_bore_mm');
			$rt3_bore_mm ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_bore_mm->setValue($form1_Values['rt3_bore_mm']);
			$this->addElement($rt3_bore_mm);
		}
		
		if(!empty($form1_Values['rt3_stroke_mm']) && $form1_Values['rt3_stroke_mm'] != $rt_results_level_3[0]['rt3_stroke_mm'])
		{
			$rt3_stroke_mm = new Zend_Form_Element_Text('rt3_stroke_mm');
			$rt3_stroke_mm->setValue($form1_Values['rt3_stroke_mm']);
			
			$before_rt3_stroke_mm = new Zend_Form_Element_Text('before_rt3_stroke_mm',array("readonly" => "readonly"));
			$before_rt3_stroke_mm->setLabel('Cylinder Stroke');
			
			if($rt_results_level_3)
								 $before_rt3_stroke_mm->setValue($rt_results_level_3[0]['rt3_stroke_mm']);
			
			$rt3_stroke_mm->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_stroke_mm->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_stroke_mm,$rt3_stroke_mm));
		}
		else
		{
			$rt3_stroke_mm = new Zend_Form_Element_Hidden('rt3_stroke_mm');
			$rt3_stroke_mm ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_stroke_mm->setValue($form1_Values['rt3_stroke_mm']);
			$this->addElement($rt3_stroke_mm);
		}
		if(!empty($form1_Values['rt_disp_cc']) && $form1_Values['rt_disp_cc'] != $rt_results_main[0]['rt_disp_cc'])
		{
			$rt_disp_cc = new Zend_Form_Element_Text('rt_disp_cc');
			$rt_disp_cc->setValue($form1_Values['rt_disp_cc']);
			
			$before_rt_disp_cc = new Zend_Form_Element_Text('before_rt_disp_cc',array("readonly" => "readonly"));
			$before_rt_disp_cc->setLabel('Engine Disp');
			
			if($rt_results_main)
									  $before_rt_disp_cc->setValue($rt_results_main[0]['rt_disp_cc']);
			
			$rt_disp_cc->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_disp_cc->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_disp_cc,$rt_disp_cc));
		}
		else
		{
			$rt_disp_cc = new Zend_Form_Element_Hidden('rt_disp_cc');
			$rt_disp_cc ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_disp_cc->setValue($form1_Values['rt_disp_cc']);
			$this->addElement($rt_disp_cc);
		}
		if(!empty($form1_Values['rt3_comp_ratio']) && $form1_Values['rt3_comp_ratio'] != $rt_results_level_3[0]['rt3_comp_ratio'])
		{
			$rt3_comp_ratio = new Zend_Form_Element_Text('rt3_comp_ratio');
			$rt3_comp_ratio->setValue($form1_Values['rt3_comp_ratio']);
			
			$before_rt3_comp_ratio = new Zend_Form_Element_Text('before_rt3_comp_ratio',array("readonly" => "readonly"));
			$before_rt3_comp_ratio->setLabel('Compression Ratio');
			
			if($rt_results_level_3)
										$before_rt3_comp_ratio->setValue($rt_results_level_3[0]['rt3_comp_ratio']);
			
			$rt3_comp_ratio->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_comp_ratio->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_comp_ratio,$rt3_comp_ratio));
		}
		else
		{
			$rt3_comp_ratio = new Zend_Form_Element_Hidden('rt3_comp_ratio');
			$rt3_comp_ratio ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_comp_ratio->setValue($form1_Values['rt3_comp_ratio']);
			$this->addElement($rt3_comp_ratio);
		}
		if(!empty($form1_Values['rt2_fuel_sys']) && $form1_Values['rt2_fuel_sys'] != $rt_results_level_2[0]['rt2_fuel_sys'])
		{
			$rt2_fuel_sys = new Zend_Form_Element_Text('rt2_fuel_sys');
			$rt2_fuel_sys->setValue($form1_Values['rt2_fuel_sys']);
			
			$before_rt2_fuel_sys = new Zend_Form_Element_Text('before_rt2_fuel_sys',array("readonly" => "readonly"));
			$before_rt2_fuel_sys->setLabel('Fuel System');
			
			if($rt_results_level_2)
									  $before_rt2_fuel_sys->setValue($rt_results_level_2[0]['rt2_fuel_sys']);
			
			$rt2_fuel_sys->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_fuel_sys->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_fuel_sys,$rt2_fuel_sys));
		}
		else
		{
			$rt2_fuel_sys = new Zend_Form_Element_Hidden('rt2_fuel_sys');
			$rt2_fuel_sys ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_fuel_sys->setValue($form1_Values['rt2_fuel_sys']);
			$this->addElement($rt2_fuel_sys);
		}
		if(!empty($form1_Values['rt3_valve_gear']) && $form1_Values['rt3_valve_gear'] != $rt_results_level_3[0]['rt3_valve_gear'])
		{
			$rt3_valve_gear = new Zend_Form_Element_Text('rt3_valve_gear');
			$rt3_valve_gear->setValue($form1_Values['rt3_valve_gear']);
			
			$before_rt3_valve_gear = new Zend_Form_Element_Text('before_rt3_valve_gear',array("readonly" => "readonly"));
			$before_rt3_valve_gear->setLabel('Valve Setup');
			
			if($rt_results_level_3)
								 $before_rt3_valve_gear->setValue($rt_results_level_3[0]['rt3_valve_gear']);
			
			$rt3_valve_gear->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_valve_gear->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_valve_gear,$rt3_valve_gear));
		}
		else
		{
			$rt3_valve_gear = new Zend_Form_Element_Hidden('rt3_valve_gear');
			$rt3_valve_gear ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_valve_gear->setValue($form1_Values['rt3_valve_gear']);
			$this->addElement($rt3_valve_gear);
		}
		if(!empty($form1_Values['rt3_valves_per_cyl']) && $form1_Values['rt3_valves_per_cyl'] != $rt_results_level_3[0]['rt3_valves_per_cyl'])
		{
			$rt3_valves_per_cyl = new Zend_Form_Element_Text('rt3_valves_per_cyl');
			$rt3_valves_per_cyl->setValue($form1_Values['rt3_valves_per_cyl']);
			
			$before_rt3_valves_per_cyl = new Zend_Form_Element_Text('before_rt3_valves_per_cyl',array("readonly" => "readonly"));
			$before_rt3_valves_per_cyl->setLabel('Valves Per Cylinder');
			
			if($rt_results_level_3)
								 $before_rt3_valves_per_cyl->setValue($rt_results_level_3[0]['rt3_valves_per_cyl']);
			
			$rt3_valves_per_cyl->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_valves_per_cyl->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_valves_per_cyl,$rt3_valves_per_cyl));
		}
		else
		{
			$rt3_valves_per_cyl = new Zend_Form_Element_Hidden('rt3_valves_per_cyl');
			$rt3_valves_per_cyl ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_valves_per_cyl->setValue($form1_Values['rt3_valves_per_cyl']);
			$this->addElement($rt3_valves_per_cyl);
		}
		if(!empty($form1_Values['rt_controlled_turbo_superchg']) && $form1_Values['rt_controlled_turbo_superchg'] != $rt_results_main[0]['rt_controlled_turbo_superchg'])
		{
			$rt_controlled_turbo_superchg_prepared = $this->gatMultioptions("Turbo/Superchg");
		
			$rt_controlled_turbo_superchg = new Zend_Form_Element_Select('rt_controlled_turbo_superchg',array('style'=>'width:150px;'));
			$rt_controlled_turbo_superchg->addMultiOptions($rt_controlled_turbo_superchg_prepared)
						->setValue($form1_Values['rt_controlled_turbo_superchg']);
						
			$before_rt_controlled_turbo_superchg = new Zend_Form_Element_Text('before_rt_controlled_turbo_superchg',array("readonly" => "readonly"));
			$before_rt_controlled_turbo_superchg->setLabel('Forced Induction');
			
			if($rt_results_main)
								$before_rt_controlled_turbo_superchg->setValue($rt_results_main[0]['rt_controlled_turbo_superchg']);
			
			$rt_controlled_turbo_superchg->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_turbo_superchg->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_turbo_superchg,$rt_controlled_turbo_superchg));
		}
		else
		{
			$rt_controlled_turbo_superchg = new Zend_Form_Element_Hidden('rt_controlled_turbo_superchg');
			$rt_controlled_turbo_superchg ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_controlled_turbo_superchg->setValue($form1_Values['rt_controlled_turbo_superchg']);
			$this->addElement($rt_controlled_turbo_superchg);
		}
		
		if(!empty($form1_Values['rt3_boost_psi']) && $form1_Values['rt3_boost_psi'] != $rt_results_level_3[0]['rt3_boost_psi'])
		{
			$rt3_boost_psi = new Zend_Form_Element_Text('rt3_boost_psi');
			$rt3_boost_psi->setValue($form1_Values['rt3_boost_psi']);
			
			$before_rt3_boost_psi = new Zend_Form_Element_Text('before_rt3_boost_psi',array("readonly" => "readonly"));
			$before_rt3_boost_psi->setLabel('Boost in psi');
			
			if($rt_results_level_3)
										$before_rt3_boost_psi->setValue($rt_results_level_3[0]['rt3_boost_psi']);
			
			$rt3_boost_psi->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_boost_psi->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_boost_psi,$rt3_boost_psi));
		}
		else
		{
			$rt3_boost_psi = new Zend_Form_Element_Hidden('rt3_boost_psi');
			$rt3_boost_psi ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_boost_psi->setValue($form1_Values['rt3_boost_psi']);
			$this->addElement($rt3_boost_psi);
		}
		if(!empty($form1_Values['rt_peak_hp']) && $form1_Values['rt_peak_hp'] != $rt_results_main[0]['rt_peak_hp'])
		{
			$rt_peak_hp = new Zend_Form_Element_Text('rt_peak_hp');
			$rt_peak_hp->setValue($form1_Values['rt_peak_hp']);
			
			$before_rt_peak_hp = new Zend_Form_Element_Text('before_rt_peak_hp',array("readonly" => "readonly"));
			$before_rt_peak_hp->setLabel('Peak Horsepower');
			
			if($rt_results_main)
								$before_rt_peak_hp->setValue($rt_results_main[0]['rt_peak_hp']);
			
			$rt_peak_hp->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_peak_hp->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_peak_hp,$rt_peak_hp));
		}
		else
		{
			$rt_peak_hp = new Zend_Form_Element_Hidden('rt_peak_hp');
			$rt_peak_hp ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_peak_hp->setValue($form1_Values['rt_peak_hp']);
			$this->addElement($rt_peak_hp);
		}
		if(!empty($form1_Values['rt_rpm']) && $form1_Values['rt_rpm'] != $rt_results_main[0]['rt_rpm'])
		{
			$rt_rpm = new Zend_Form_Element_Text('rt_rpm');
			$rt_rpm->setValue($form1_Values['rt_rpm']);
			
			$before_rt_rpm = new Zend_Form_Element_Text('before_rt_rpm',array("readonly" => "readonly"));
			$before_rt_rpm->setLabel('Peak Horsepower RPM');
			
			if($rt_results_main)
									  $before_rt_rpm->setValue($rt_results_main[0]['rt_rpm']);
			
			$rt_rpm->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_rpm->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_rpm,$rt_rpm));
		}
		else
		{
			$rt_rpm = new Zend_Form_Element_Hidden('rt_rpm');
			$rt_rpm ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_rpm->setValue($form1_Values['rt_rpm']);
			$this->addElement($rt_rpm);
		}
		if(!empty($form1_Values['rt_peak_hp_notes']) && $form1_Values['rt_peak_hp_notes'] != $rt_results_main[0]['rt_peak_hp_notes'])
		{
			$rt_peak_hp_notes = new Zend_Form_Element_Text('rt_peak_hp_notes');
			$rt_peak_hp_notes->setValue($form1_Values['rt_peak_hp_notes']);
			
			$before_rt_peak_hp_notes = new Zend_Form_Element_Text('before_rt_peak_hp_notes',array("readonly" => "readonly"));
			$before_rt_peak_hp_notes->setLabel('Peak Horsepower Notes');
			
			if($rt_results_main)
								$before_rt_peak_hp_notes->setValue($rt_results_main[0]['rt_peak_hp_notes']);
			
			$rt_peak_hp_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_peak_hp_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_peak_hp_notes,$rt_peak_hp_notes));
		}
		else
		{
			$rt_peak_hp_notes = new Zend_Form_Element_Hidden('rt_peak_hp_notes');
			$rt_peak_hp_notes ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_peak_hp_notes->setValue($form1_Values['rt_peak_hp_notes']);
			$this->addElement($rt_peak_hp_notes);
		}
		if(!empty($form1_Values['rt_peak_torque']) && $form1_Values['rt_peak_torque'] != $rt_results_main[0]['rt_peak_torque'])
		{
			$rt_peak_torque = new Zend_Form_Element_Text('rt_peak_torque');
			$rt_peak_torque->setValue($form1_Values['rt_peak_torque']);
			
			$before_rt_peak_torque = new Zend_Form_Element_Text('before_rt_peak_torque',array("readonly" => "readonly"));
			$before_rt_peak_torque->setLabel('Peak Torque');
			
			if($rt_results_main)
								$before_rt_peak_torque->setValue($rt_results_main[0]['rt_peak_torque']);
			
			$rt_peak_torque->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_peak_torque->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_peak_torque,$rt_peak_torque));
		}
		else
		{
			$rt_peak_torque = new Zend_Form_Element_Hidden('rt_peak_torque');
			$rt_peak_torque ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_peak_torque->setValue($form1_Values['rt_peak_torque']);
			$this->addElement($rt_peak_torque);
		}
		
		if(!empty($form1_Values['rt_rpmt']) && $form1_Values['rt_rpmt'] != $rt_results_main[0]['rt_rpmt'])
		{
			$rt_rpmt = new Zend_Form_Element_Text('rt_rpmt');
			$rt_rpmt->setValue($form1_Values['rt_rpmt']);
			
			$before_rt_rpmt = new Zend_Form_Element_Text('before_rt_rpmt',array("readonly" => "readonly"));
			$before_rt_rpmt->setLabel('Peak Torque RPM');
			
			if($rt_results_main)
									  $before_rt_rpmt->setValue($rt_results_main[0]['rt_rpmt']);
			
			$rt_rpmt->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_rpmt->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_rpmt,$rt_rpmt));
		}
		else
		{
			$rt_rpmt = new Zend_Form_Element_Hidden('rt_rpmt');
			$rt_rpmt ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_rpmt->setValue($form1_Values['rt_rpmt']);
			$this->addElement($rt_rpmt);
		}
		if(!empty($form1_Values['rt_peak_torque_notes']) && $form1_Values['rt_peak_torque_notes'] != $rt_results_main[0]['rt_peak_torque_notes'])
		{
			$rt_peak_torque_notes = new Zend_Form_Element_Text('rt_peak_torque_notes');
			$rt_peak_torque_notes->setValue($form1_Values['rt_peak_torque_notes']);
			
			$before_rt_peak_torque_notes = new Zend_Form_Element_Text('before_rt_peak_torque_notes',array("readonly" => "readonly"));
			$before_rt_peak_torque_notes->setLabel('Peak Torque Notes');
			
			if($rt_results_main)
								$before_rt_peak_torque_notes->setValue($rt_results_main[0]['rt_peak_torque_notes']);
			
			$rt_peak_torque_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_peak_torque_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_peak_torque_notes,$rt_peak_torque_notes));
		}
		else
		{
			$rt_peak_torque_notes = new Zend_Form_Element_Hidden('rt_peak_torque_notes');
			$rt_peak_torque_notes ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_peak_torque_notes->setValue($form1_Values['rt_peak_torque_notes']);
			$this->addElement($rt_peak_torque_notes);
		}
		if(!empty($form1_Values['rt_redline']) && $form1_Values['rt_redline'] != $rt_results_main[0]['rt_redline'])
		{
			$rt_redline = new Zend_Form_Element_Text('rt_redline');
			$rt_redline->setValue($form1_Values['rt_redline']);
			
			$before_rt_redline = new Zend_Form_Element_Text('before_rt_redline',array("readonly" => "readonly"));
			$before_rt_redline->setLabel('Redline');
			
			if($rt_results_main)
									  $before_rt_redline->setValue($rt_results_main[0]['rt_redline']);
			
			$rt_redline->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_redline->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_redline,$rt_redline));
		}
		else
		{
			$rt_redline = new Zend_Form_Element_Hidden('rt_redline');
			$rt_redline ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_redline->setValue($form1_Values['rt_redline']);
			$this->addElement($rt_redline);
		}
		if(!empty($form1_Values['rt3_specific_power']) && $form1_Values['rt3_specific_power'] != $rt_results_level_3[0]['rt3_specific_power'])
		{
			$rt3_specific_power = new Zend_Form_Element_Text('rt3_specific_power');
			$rt3_specific_power->setValue($form1_Values['rt3_specific_power']);
			
			$before_rt3_specific_power = new Zend_Form_Element_Text('before_rt3_specific_power',array("readonly" => "readonly"));
			$before_rt3_specific_power->setLabel('Spec pow (hp/liter)');
			
			if($rt_results_level_3)
								 $before_rt3_specific_power->setValue($rt_results_level_3[0]['rt3_specific_power']);
			
			$rt3_specific_power->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_specific_power->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_specific_power,$rt3_specific_power));
		}
		else
		{
			$rt3_specific_power = new Zend_Form_Element_Hidden('rt3_specific_power');
			$rt3_specific_power ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_specific_power->setValue($form1_Values['rt3_specific_power']);
			$this->addElement($rt3_specific_power);
		}
		if(!empty($form1_Values['rt_power_to_weight']) && $form1_Values['rt_power_to_weight'] != $rt_results_main[0]['rt_power_to_weight'])
		{
			$rt_power_to_weight = new Zend_Form_Element_Text('rt_power_to_weight');
			$rt_power_to_weight->setValue($form1_Values['rt_power_to_weight']);
			
			$before_rt_power_to_weight = new Zend_Form_Element_Text('before_rt_power_to_weight',array("readonly" => "readonly"));
			$before_rt_power_to_weight->setLabel('Power/Weight (hp/lb)');
			
			if($rt_results_main)
					$before_rt_power_to_weight->setValue($rt_results_main[0]['rt_power_to_weight']);
			
			$rt_power_to_weight->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_power_to_weight->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_power_to_weight,$rt_power_to_weight));
		}
		else
		{
			$rt_power_to_weight = new Zend_Form_Element_Hidden('rt_power_to_weight');
			$rt_power_to_weight ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_power_to_weight->setValue($form1_Values['rt_power_to_weight']);
			$this->addElement($rt_power_to_weight);
		}
		if(!empty($form1_Values['rt_controlled_transmission']) && $form1_Values['rt_controlled_transmission'] != $rt_results_main[0]['rt_controlled_transmission'])
		{
			$rt_controlled_transmission_prepared= $this->gatMultioptions("Transmission");
		
			$rt_controlled_transmission = new Zend_Form_Element_Select('rt_controlled_transmission',array('style'=>'width:150px;'));
			$rt_controlled_transmission->addMultiOptions($rt_controlled_transmission_prepared)
						->setValue($form1_Values['rt_controlled_transmission']);
						
			$before_rt_controlled_transmission = new Zend_Form_Element_Text('before_rt_controlled_transmission',array("readonly" => "readonly"));
			$before_rt_controlled_transmission->setLabel('Transmission Type');
			
			if($rt_results_main)
								$before_rt_controlled_transmission->setValue($rt_results_main[0]['rt_controlled_transmission']);
			
			$rt_controlled_transmission->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_transmission->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_transmission,$rt_controlled_transmission));
		}
		else
		{
			$rt_controlled_transmission = new Zend_Form_Element_Hidden('rt_controlled_transmission');
			$rt_controlled_transmission ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_controlled_transmission->setValue($form1_Values['rt_controlled_transmission']);
			$this->addElement($rt_controlled_transmission);
		}
		if(!empty($form1_Values['rt3_final_drive_ratio']) && $form1_Values['rt3_final_drive_ratio'] != $rt_results_level_3[0]['rt3_final_drive_ratio'])
		{
			$rt3_final_drive_ratio = new Zend_Form_Element_Text('rt3_final_drive_ratio');
			$rt3_final_drive_ratio->setValue($form1_Values['rt3_final_drive_ratio']);
			
			$before_rt3_final_drive_ratio = new Zend_Form_Element_Text('before_rt3_final_drive_ratio',array("readonly" => "readonly"));
			$before_rt3_final_drive_ratio->setLabel('Final Drive');
			
			if($rt_results_level_3)
										$before_rt3_final_drive_ratio->setValue($rt_results_level_3[0]['rt3_final_drive_ratio']);
			
			$rt3_final_drive_ratio->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_final_drive_ratio->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_final_drive_ratio,$rt3_final_drive_ratio));
		}
		else
		{
			$rt3_final_drive_ratio = new Zend_Form_Element_Hidden('rt3_final_drive_ratio');
			$rt3_final_drive_ratio ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_final_drive_ratio->setValue($form1_Values['rt3_final_drive_ratio']);
			$this->addElement($rt3_final_drive_ratio);
		}
		if(!empty($form1_Values['rt3_max_mph_1000_rpm']) && $form1_Values['rt3_max_mph_1000_rpm'] != $rt_results_level_3[0]['rt3_max_mph_1000_rpm'])
		{
			$rt3_max_mph_1000_rpm = new Zend_Form_Element_Text('rt3_max_mph_1000_rpm');
			$rt3_max_mph_1000_rpm->setValue($form1_Values['rt3_max_mph_1000_rpm']);
			
			$before_rt3_max_mph_1000_rpm = new Zend_Form_Element_Text('before_rt3_max_mph_1000_rpm',array("readonly" => "readonly"));
			$before_rt3_max_mph_1000_rpm->setLabel('Top Gear mph/1000rpm');
			
			if($rt_results_level_3)
								 $before_rt3_max_mph_1000_rpm->setValue($rt_results_level_3[0]['rt3_max_mph_1000_rpm']);
			
			$rt3_max_mph_1000_rpm->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_max_mph_1000_rpm->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_max_mph_1000_rpm,$rt3_max_mph_1000_rpm));
		}
		else
		{
			$rt3_max_mph_1000_rpm = new Zend_Form_Element_Hidden('rt3_max_mph_1000_rpm');
			$rt3_max_mph_1000_rpm ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_max_mph_1000_rpm->setValue($form1_Values['rt3_max_mph_1000_rpm']);
			$this->addElement($rt3_max_mph_1000_rpm);
		}
		if(!empty($form1_Values['rt3_wheelbase']) && $form1_Values['rt3_wheelbase'] != $rt_results_level_3[0]['rt3_wheelbase'])
		{
			$rt3_wheelbase = new Zend_Form_Element_Text('rt3_wheelbase');
			$rt3_wheelbase->setValue($form1_Values['rt3_wheelbase']);
			
			$before_rt3_wheelbase = new Zend_Form_Element_Text('before_rt3_wheelbase',array("readonly" => "readonly"));
			$before_rt3_wheelbase->setLabel('Wheelbase');
			
			if($rt_results_level_3)
								 $before_rt3_wheelbase->setValue($rt_results_level_3[0]['rt3_wheelbase']);
			
			$rt3_wheelbase->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_wheelbase->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_wheelbase,$rt3_wheelbase));
		}
		else
		{
			$rt3_wheelbase = new Zend_Form_Element_Hidden('rt3_wheelbase');
			$rt3_wheelbase ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_wheelbase->setValue($form1_Values['rt3_wheelbase']);
			$this->addElement($rt3_wheelbase);
		}
		
		if(!empty($form1_Values['rt3_length']) && $form1_Values['rt3_length'] != $rt_results_level_3[0]['rt3_length'])
		{
			$rt3_length = new Zend_Form_Element_Text('rt3_length');
			$rt3_length->setValue($form1_Values['rt3_length']);
			
			$before_rt3_length = new Zend_Form_Element_Text('before_rt3_length',array("readonly" => "readonly"));
			$before_rt3_length->setLabel('Length');
			
			if($rt_results_level_3)
								 $before_rt3_length->setValue($rt_results_level_3[0]['rt3_length']);
			
			$rt3_length->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_length->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_length,$rt3_length));
		}
		else
		{
			$rt3_length = new Zend_Form_Element_Hidden('rt3_length');
			$rt3_length ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_length->setValue($form1_Values['rt3_length']);
			$this->addElement($rt3_length);
		}
		if(!empty($form1_Values['rt3_width']) && $form1_Values['rt3_width'] != $rt_results_level_3[0]['rt3_width'])
		{
			$rt3_width = new Zend_Form_Element_Text('rt3_width');
			$rt3_width->setValue($form1_Values['rt3_width']);
			
			$before_rt3_width = new Zend_Form_Element_Text('before_rt3_width',array("readonly" => "readonly"));
			$before_rt3_width->setLabel('Width');
			
			if($rt_results_level_3)
								 $before_rt3_width->setValue($rt_results_level_3[0]['rt3_width']);
			
			$rt3_width->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_width->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_width,$rt3_width));
		}
		else
		{
			$rt3_width = new Zend_Form_Element_Hidden('rt3_width');
			$rt3_width ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_width->setValue($form1_Values['rt3_width']);
			$this->addElement($rt3_width);
		}
		if(!empty($form1_Values['rt3_height']) && $form1_Values['rt3_height'] != $rt_results_level_3[0]['rt3_height'])
		{
			$rt3_height = new Zend_Form_Element_Text('rt3_height');
			$rt3_height->setValue($form1_Values['rt3_height']);
			
			$before_rt3_height = new Zend_Form_Element_Text('before_rt3_height',array("readonly" => "readonly"));
			$before_rt3_height->setLabel('Height');
			
			if($rt_results_level_3)
								 $before_rt3_height->setValue($rt_results_level_3[0]['rt3_height']);
			
			$rt3_height->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_height->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_height,$rt3_height));
		}
		else
		{
			$rt3_height = new Zend_Form_Element_Hidden('rt3_height');
			$rt3_height ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_height->setValue($form1_Values['rt3_height']);
			$this->addElement($rt3_height);
		}
		if(!empty($form1_Values['rt3_frontal_area']) && $form1_Values['rt3_frontal_area'] != $rt_results_level_3[0]['rt3_frontal_area'])
		{
			$rt3_frontal_area = new Zend_Form_Element_Text('rt3_frontal_area');
			$rt3_frontal_area->setValue($form1_Values['rt3_frontal_area']);
			
			$before_rt3_frontal_area = new Zend_Form_Element_Text('before_rt3_frontal_area',array("readonly" => "readonly"));
			$before_rt3_frontal_area->setLabel('Frontal Area');
			
			if($rt_results_level_3)
								 $before_rt3_frontal_area->setValue($rt_results_level_3[0]['rt3_frontal_area']);
			
			$rt3_frontal_area->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_frontal_area->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_frontal_area,$rt3_frontal_area));
		}
		else
		{
			$rt3_frontal_area = new Zend_Form_Element_Hidden('rt3_frontal_area');
			$rt3_frontal_area ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_frontal_area->setValue($form1_Values['rt3_frontal_area']);
			$this->addElement($rt3_frontal_area);
		}
		if(!empty($form1_Values['rt3_frontal_area_notes']) && $form1_Values['rt3_frontal_area_notes'] != $rt_results_level_3[0]['rt3_frontal_area_notes'])
		{
			$rt3_frontal_area_notes = new Zend_Form_Element_Text('rt3_frontal_area_notes');
			$rt3_frontal_area_notes->setValue($form1_Values['rt3_frontal_area_notes']);
			
			$before_rt3_frontal_area_notes = new Zend_Form_Element_Text('before_rt3_frontal_area_notes',array("readonly" => "readonly"));
			$before_rt3_frontal_area_notes->setLabel('Frontal Area Notes');
			
			if($rt_results_level_3)
								 $before_rt3_frontal_area_notes->setValue($rt_results_level_3[0]['rt3_frontal_area_notes']);
			
			$rt3_frontal_area_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_frontal_area_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_frontal_area_notes,$rt3_frontal_area_notes));
		}
		else
		{
			$rt3_frontal_area_notes = new Zend_Form_Element_Hidden('rt3_frontal_area_notes');
			$rt3_frontal_area_notes ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_frontal_area_notes->setValue($form1_Values['rt3_frontal_area_notes']);
			$this->addElement($rt3_frontal_area_notes);
		}
		if(!empty($form1_Values['rt3_cd']) && $form1_Values['rt3_cd'] != $rt_results_level_3[0]['rt3_cd'])
		{
			$rt3_cd = new Zend_Form_Element_Text('rt3_cd');
			$rt3_cd->setValue($form1_Values['rt3_cd']);
			
			$before_rt3_cd = new Zend_Form_Element_Text('before_rt3_cd',array("readonly" => "readonly"));
			$before_rt3_cd->setLabel('Coefficient of Drag');
			
			if($rt_results_level_3)
										$before_rt3_cd->setValue($rt_results_level_3[0]['rt3_cd']);
			
			$rt3_cd->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_cd->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_cd,$rt3_cd));
		}
		else
		{
			$rt3_cd = new Zend_Form_Element_Hidden('rt3_cd');
			$rt3_cd ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_cd->setValue($form1_Values['rt3_cd']);
			$this->addElement($rt3_cd);
		}
		if(!empty($form1_Values['rt_weight']) && $form1_Values['rt_weight'] != $rt_results_main[0]['rt_weight'])
		{
			$rt_weight = new Zend_Form_Element_Text('rt_weight');
			$rt_weight->setValue($form1_Values['rt_weight']);
			
			$before_rt_weight = new Zend_Form_Element_Text('before_rt_weight',array("readonly" => "readonly"));
			$before_rt_weight->setLabel('Curb Weight');
			
			if($rt_results_main)
			 $before_rt_weight->setValue($rt_results_main[0]['rt_weight']);
			
			$rt_weight->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_weight->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_weight,$rt_weight));
		}
		else
		{
			$rt_weight = new Zend_Form_Element_Hidden('rt_weight');
			$rt_weight ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_weight->setValue($form1_Values['rt_weight']);
			$this->addElement($rt_weight);
		}
		if(!empty($form1_Values['rt_percent_on_front']) && $form1_Values['rt_percent_on_front'] != $rt_results_main[0]['rt_percent_on_front'])
		{
			$rt_percent_on_front = new Zend_Form_Element_Text('rt_percent_on_front');
			$rt_percent_on_front->setValue($form1_Values['rt_percent_on_front']);

			$before_rt_percent_on_front = new Zend_Form_Element_Text('before_rt_percent_on_front',array("readonly" => "readonly"));
			$before_rt_percent_on_front->setLabel('Pct. Weight on Front');
			
			if($rt_results_main)
				$before_rt_percent_on_front->setValue($rt_results_main[0]['rt_percent_on_front']);
			
			$rt_percent_on_front->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_percent_on_front->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_percent_on_front,$rt_percent_on_front));			
		}
		else
		{
			$rt_percent_on_front = new Zend_Form_Element_Hidden('rt_percent_on_front');
			$rt_percent_on_front ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_percent_on_front->setValue($form1_Values['rt_percent_on_front']);
			$this->addElement($rt_percent_on_front);
		}
		if(!empty($form1_Values['rt_percent_on_rear']) && $form1_Values['rt_percent_on_rear'] != $rt_results_main[0]['rt_percent_on_rear'])
		{
			$rt_percent_on_rear = new Zend_Form_Element_Text('rt_percent_on_rear');
			$rt_percent_on_rear->setValue($form1_Values['rt_percent_on_rear']);

			$before_rt_percent_on_rear = new Zend_Form_Element_Text('before_rt_percent_on_rear',array("readonly" => "readonly"));
			$before_rt_percent_on_rear->setLabel('Pct. Weight on Rear');
			
			if($rt_results_main)
				$before_rt_percent_on_rear->setValue($rt_results_main[0]['rt_percent_on_rear']);
			
			$rt_percent_on_rear->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_percent_on_rear->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_percent_on_rear,$rt_percent_on_rear));			
		}
		else
		{
			$rt_percent_on_rear = new Zend_Form_Element_Hidden('rt_percent_on_rear');
			$rt_percent_on_rear ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_percent_on_rear->setValue($form1_Values['rt_percent_on_rear']);
			$this->addElement($rt_percent_on_rear);
		}
		if(!empty($form1_Values['rt2_controlled_airbags']) && $form1_Values['rt2_controlled_airbags'] != $rt_results_level_2[0]['rt2_controlled_airbags'])
		{
			$rt_controlled_airbags_prepared = $this->gatMultioptions("Airbags");
			
			$rt2_controlled_airbags = new Zend_Form_Element_Select('rt2_controlled_airbags',array('style'=>'width:150px;'));
			$rt2_controlled_airbags->addMultiOptions($rt_controlled_airbags_prepared)
						->setValue($form1_Values['rt2_controlled_airbags']);
						
			$before_rt2_controlled_airbags = new Zend_Form_Element_Text('before_rt2_controlled_airbags',array("readonly" => "readonly"));
			$before_rt2_controlled_airbags->setLabel('Listing of Airbag Positions');
			
			if($rt_results_level_2)
										$before_rt2_controlled_airbags->setValue($rt_results_level_2[0]['rt2_controlled_airbags']);
			
			$rt2_controlled_airbags->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_controlled_airbags->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_controlled_airbags,$rt2_controlled_airbags));
		}
		else
		{
			$rt2_controlled_airbags = new Zend_Form_Element_Hidden('rt2_controlled_airbags');
			$rt2_controlled_airbags ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_controlled_airbags->setValue($form1_Values['rt2_controlled_airbags']);
			$this->addElement($rt2_controlled_airbags);
		}
		if(!empty($form1_Values['rt2_int_vol_front']) && $form1_Values['rt2_int_vol_front'] != $rt_results_level_2[0]['rt2_int_vol_front'])
		{
			$rt2_int_vol_front = new Zend_Form_Element_Text('rt2_int_vol_front');
			$rt2_int_vol_front->setValue($form1_Values['rt2_int_vol_front']);
			
			$before_rt2_int_vol_front = new Zend_Form_Element_Text('before_rt2_int_vol_front',array("readonly" => "readonly"));
			$before_rt2_int_vol_front->setLabel('Interior Volume');
			
			if($rt_results_level_2)
									  $before_rt2_int_vol_front->setValue($rt_results_level_2[0]['rt2_int_vol_front']);
			
			$rt2_int_vol_front->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_int_vol_front->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_int_vol_front,$rt2_int_vol_front));
		}
		else
		{
			$rt2_int_vol_front = new Zend_Form_Element_Hidden('rt2_int_vol_front');
			$rt2_int_vol_front ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_int_vol_front->setValue($form1_Values['rt2_int_vol_front']);
			$this->addElement($rt2_int_vol_front);
		}
		if(!empty($form1_Values['rt2_mid']) && $form1_Values['rt2_mid'] != $rt_results_level_2[0]['rt2_mid'])
		{
			$rt2_mid = new Zend_Form_Element_Text('rt2_mid');
			$rt2_mid->setValue($form1_Values['rt2_mid']);
			
			$before_rt2_mid = new Zend_Form_Element_Text('before_rt2_mid',array("readonly" => "readonly"));
			$before_rt2_mid->setLabel('Vol Behind Mid Row');
			
			if($rt_results_level_2)
									  $before_rt2_mid->setValue($rt_results_level_2[0]['rt2_mid']);
			
			$rt2_mid->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_mid->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_mid,$rt2_mid));
		}
		else
		{
			$rt2_mid = new Zend_Form_Element_Hidden('rt2_mid');
			$rt2_mid ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_mid->setValue($form1_Values['rt2_mid']);
			$this->addElement($rt2_mid);
		}
		if(!empty($form1_Values['rt2_rear']) && $form1_Values['rt2_rear'] != $rt_results_level_2[0]['rt2_rear'])
		{
			$rt2_rear = new Zend_Form_Element_Text('rt2_rear');
			$rt2_rear->setValue($form1_Values['rt2_rear']);
			
			$before_rt2_rear = new Zend_Form_Element_Text('before_rt2_rear',array("readonly" => "readonly"));
			$before_rt2_rear->setLabel('Vol Behind Rear Row');
			
			if($rt_results_level_2)
									  $before_rt2_rear->setValue($rt_results_level_2[0]['rt2_rear']);
			
			$rt2_rear->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_rear->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_rear,$rt2_rear));
		}
		else
		{
			$rt2_rear = new Zend_Form_Element_Hidden('rt2_rear');
			$rt2_rear ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_rear->setValue($form1_Values['rt2_rear']);
			$this->addElement($rt2_rear);
		}
		if(!empty($form1_Values['rt3_trunk']) && $form1_Values['rt3_trunk'] != $rt_results_level_3[0]['rt3_trunk'])
		{
			$rt3_trunk = new Zend_Form_Element_Text('rt3_trunk');
			$rt3_trunk->setValue($form1_Values['rt3_trunk']);
			
			$before_rt3_trunk = new Zend_Form_Element_Text('before_rt3_trunk',array("readonly" => "readonly"));
			$before_rt3_trunk->setLabel('Trunk Volume');
			
			if($rt_results_level_3)
								 $before_rt3_trunk->setValue($rt_results_level_3[0]['rt3_trunk']);
			
			$rt3_trunk->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_trunk->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_trunk,$rt3_trunk));
		}
		else
		{
			$rt3_trunk = new Zend_Form_Element_Hidden('rt3_trunk');
			$rt3_trunk ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_trunk->setValue($form1_Values['rt3_trunk']);
			$this->addElement($rt3_trunk);
		}
		if(!empty($form1_Values['rt2_turning_cir']) && $form1_Values['rt2_turning_cir'] != $rt_results_level_2[0]['rt2_turning_cir'])
		{
			$rt2_turning_cir = new Zend_Form_Element_Text('rt2_turning_cir');
			$rt2_turning_cir->setValue($form1_Values['rt2_turning_cir']);
			
			$before_rt2_turning_cir = new Zend_Form_Element_Text('before_rt2_turning_cir',array("readonly" => "readonly"));
			$before_rt2_turning_cir->setLabel('Turning Radius');
			
			if($rt_results_level_2)
										$before_rt2_turning_cir->setValue($rt_results_level_2[0]['rt2_turning_cir']);
			
			$rt2_turning_cir->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_turning_cir->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_turning_cir,$rt2_turning_cir));
		}
		else
		{
			$rt2_turning_cir = new Zend_Form_Element_Hidden('rt2_turning_cir');
			$rt2_turning_cir ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_turning_cir->setValue($form1_Values['rt2_turning_cir']);
			$this->addElement($rt2_turning_cir);
		}
		if(!empty($form1_Values['rt2_anti_lock']) && $form1_Values['rt2_anti_lock'] != $rt_results_level_2[0]['rt2_anti_lock'])
		{
			$rt2_anti_lock = new Zend_Form_Element_Text('rt2_anti_lock');
			$rt2_anti_lock->setValue($form1_Values['rt2_anti_lock']);
			
			$before_rt2_anti_lock = new Zend_Form_Element_Text('before_rt2_anti_lock',array("readonly" => "readonly"));
			$before_rt2_anti_lock->setLabel('Anti-Lock Brakes?');
			
			if($rt_results_level_2)
								$before_rt2_anti_lock->setValue($rt_results_level_2[0]['rt2_anti_lock']);
			
			$rt2_anti_lock->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_anti_lock->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_anti_lock,$rt2_anti_lock));
		}
		else
		{
			$rt2_anti_lock = new Zend_Form_Element_Hidden('rt2_anti_lock');
			$rt2_anti_lock ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_anti_lock->setValue($form1_Values['rt2_anti_lock']);
			$this->addElement($rt2_anti_lock);
		}
		if(!empty($form1_Values['rt2_traction_control']) && $form1_Values['rt2_traction_control'] != $rt_results_level_2[0]['rt2_traction_control'])
		{
			$rt2_traction_control = new Zend_Form_Element_Text('rt2_traction_control');
			$rt2_traction_control->setValue($form1_Values['rt2_traction_control']);
			
			$before_rt2_traction_control = new Zend_Form_Element_Text('before_rt2_traction_control',array("readonly" => "readonly"));
			$before_rt2_traction_control->setLabel('Traction Control');
			
			if($rt_results_level_2)
										$before_rt2_traction_control->setValue($rt_results_level_2[0]['rt2_traction_control']);
			
			$rt2_traction_control->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_traction_control->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_traction_control,$rt2_traction_control));
		}
		else
		{
			$rt2_traction_control = new Zend_Form_Element_Hidden('rt2_traction_control');
			$rt2_traction_control ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_traction_control->setValue($form1_Values['rt2_traction_control']);
			$this->addElement($rt2_traction_control);
		}
		if(!empty($form1_Values['rt2_trac_defeatable']) && $form1_Values['rt2_trac_defeatable'] != $rt_results_level_2[0]['rt2_trac_defeatable'])
		{
			$rt2_trac_defeatable = new Zend_Form_Element_Text('rt2_trac_defeatable');
			$rt2_trac_defeatable->setValue($form1_Values['rt2_trac_defeatable']);
			
			$before_rt2_trac_defeatable = new Zend_Form_Element_Text('before_rt2_trac_defeatable',array("readonly" => "readonly"));
			$before_rt2_trac_defeatable->setLabel('Tc Defeatable?');
			
			if($rt_results_level_2)
										$before_rt2_trac_defeatable->setValue($rt_results_level_2[0]['rt2_trac_defeatable']);
			
			$rt2_trac_defeatable->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_trac_defeatable->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_trac_defeatable,$rt2_trac_defeatable));
		}
		else
		{
			$rt2_trac_defeatable = new Zend_Form_Element_Hidden('rt2_trac_defeatable');
			$rt2_trac_defeatable ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_trac_defeatable->setValue($form1_Values['rt2_trac_defeatable']);
			$this->addElement($rt2_trac_defeatable);
		}
		if(!empty($form1_Values['rt2_stability_control']) && $form1_Values['rt2_stability_control'] != $rt_results_level_2[0]['rt2_stability_control'])
		{
			$rt2_stability_control = new Zend_Form_Element_Text('rt2_stability_control');
			$rt2_stability_control->setValue($form1_Values['rt2_stability_control']);
			
			$before_rt2_stability_control = new Zend_Form_Element_Text('before_rt2_stability_control',array("readonly" => "readonly"));
			$before_rt2_stability_control->setLabel('Stability Control');
			
			if($rt_results_level_2)
										$before_rt2_stability_control->setValue($rt_results_level_2[0]['rt2_stability_control']);
			
			$rt2_stability_control->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_stability_control->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_stability_control,$rt2_stability_control));
		}
		else
		{
			$rt2_stability_control = new Zend_Form_Element_Hidden('rt2_stability_control');
			$rt2_stability_control ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_stability_control->setValue($form1_Values['rt2_stability_control']);
			$this->addElement($rt2_stability_control);
		}
		if(!empty($form1_Values['rt2_stab_defeatable']) && $form1_Values['rt2_stab_defeatable'] != $rt_results_level_2[0]['rt2_stab_defeatable'])
		{
			$rt2_stab_defeatable = new Zend_Form_Element_Text('rt2_stab_defeatable');
			$rt2_stab_defeatable->setValue($form1_Values['rt2_stab_defeatable']);
			
			$before_rt2_stab_defeatable = new Zend_Form_Element_Text('before_rt2_stab_defeatable',array("readonly" => "readonly"));
			$before_rt2_stab_defeatable->setLabel('Esc Defeatable?');
			
			if($rt_results_level_2)
										$before_rt2_stab_defeatable->setValue($rt_results_level_2[0]['rt2_stab_defeatable']);
			
			$rt2_stab_defeatable->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_stab_defeatable->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_stab_defeatable,$rt2_stab_defeatable));
		}
		else
		{
			$rt2_stab_defeatable = new Zend_Form_Element_Hidden('rt2_stab_defeatable');
			$rt2_stab_defeatable ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_stab_defeatable->setValue($form1_Values['rt2_stab_defeatable']);
			$this->addElement($rt2_stab_defeatable);
		}
		if(!empty($form1_Values['rt3_10mph']) && $form1_Values['rt3_10mph'] != $rt_results_level_3[0]['rt3_10mph'])
		{
			$rt3_10mph = new Zend_Form_Element_Text('rt3_10mph');
			$rt3_10mph->setValue($form1_Values['rt3_10mph']);
			
			$before_rt3_10mph = new Zend_Form_Element_Text('before_rt3_10mph',array("readonly" => "readonly"));
			$before_rt3_10mph->setLabel('0-10 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_10mph->setValue($rt_results_level_3[0]['rt3_10mph']);
			
			$rt3_10mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_10mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_10mph,$rt3_10mph));
		}
		else
		{
			$rt3_10mph = new Zend_Form_Element_Hidden('rt3_10mph');
			$rt3_10mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_10mph->setValue($form1_Values['rt3_10mph']);
			$this->addElement($rt3_10mph);
		}
		if(!empty($form1_Values['rt3_20mph']) && $form1_Values['rt3_20mph'] != $rt_results_level_3[0]['rt3_20mph'])
		{
			$rt3_20mph = new Zend_Form_Element_Text('rt3_20mph');
			$rt3_20mph->setValue($form1_Values['rt3_20mph']);
			
			$before_rt3_20mph = new Zend_Form_Element_Text('before_rt3_20mph',array("readonly" => "readonly"));
			$before_rt3_20mph->setLabel('0-20 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_20mph->setValue($rt_results_level_3[0]['rt3_20mph']);
			
			$rt3_20mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_20mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_20mph,$rt3_20mph));
		}
		else
		{
			$rt3_20mph = new Zend_Form_Element_Hidden('rt3_20mph');
			$rt3_20mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_20mph->setValue($form1_Values['rt3_20mph']);
			$this->addElement($rt3_20mph);
		}
		if(!empty($form1_Values['rt2_30_mph']) && $form1_Values['rt2_30_mph'] != $rt_results_level_2[0]['rt2_30_mph'])
		{
			$rt2_30mph = new Zend_Form_Element_Text('rt2_30_mph');
			$rt2_30mph->setValue($form1_Values['rt2_30_mph']);
			
			$before_rt2_30mph = new Zend_Form_Element_Text('before_rt2_30_mph',array("readonly" => "readonly"));
			$before_rt2_30mph->setLabel('0-30 Accel');
			
			if($rt_results_level_2)
								 $before_rt2_30mph->setValue($rt_results_level_2[0]['rt2_30_mph']);
			
			$rt2_30mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_30mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_30mph,$rt2_30mph));
		}
		else
		{
			$rt2_30_mph = new Zend_Form_Element_Hidden('rt2_30_mph');
			$rt2_30_mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_30_mph->setValue($form1_Values['rt2_30_mph']);
			$this->addElement($rt2_30_mph);
		}
		if(!empty($form1_Values['rt3_40mph']) && $form1_Values['rt3_40mph'] != $rt_results_level_3[0]['rt3_40mph'])
		{
			$rt3_40mph = new Zend_Form_Element_Text('rt3_40mph');
			$rt3_40mph->setValue($form1_Values['rt3_40mph']);
			
			$before_rt3_40mph = new Zend_Form_Element_Text('before_rt3_40mph',array("readonly" => "readonly"));
			$before_rt3_40mph->setLabel('0-40 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_40mph->setValue($rt_results_level_3[0]['rt3_40mph']);
			
			$rt3_40mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_40mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_40mph,$rt3_40mph));
		}
		else
		{
			$rt3_40mph = new Zend_Form_Element_Hidden('rt3_40mph');
			$rt3_40mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_40mph->setValue($form1_Values['rt3_40mph']);
			$this->addElement($rt3_40mph);
		}
		if(!empty($form1_Values['rt3_50mph']) && $form1_Values['rt3_50mph'] != $rt_results_level_3[0]['rt3_50mph'])
		{
			$rt3_50mph = new Zend_Form_Element_Text('rt3_50mph');
			$rt3_50mph->setValue($form1_Values['rt3_50mph']);
			
			$before_rt3_50mph = new Zend_Form_Element_Text('before_rt3_50mph',array("readonly" => "readonly"));
			$before_rt3_50mph->setLabel('0-50 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_50mph->setValue($rt_results_level_3[0]['rt3_50mph']);
			
			$rt3_50mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_50mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_50mph,$rt3_50mph));
		}
		else
		{
			$rt3_50mph = new Zend_Form_Element_Hidden('rt3_50mph');
			$rt3_50mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_50mph->setValue($form1_Values['rt3_50mph']);
			$this->addElement($rt3_50mph);
		}
		if(!empty($form1_Values['rt_60_mph']) && $form1_Values['rt_60_mph'] != $rt_results_main[0]['rt_60_mph'])
		{
			$rt_60mph = new Zend_Form_Element_Text('rt_60_mph');
			$rt_60mph->setValue($form1_Values['rt_60_mph']);
			
			$before_rt_60mph = new Zend_Form_Element_Text('before_rt_60mph',array("readonly" => "readonly"));
			$before_rt_60mph->setLabel('0-50 Accel');
			
			if($rt_results_main)
								 $before_rt_60mph->setValue($rt_results_main[0]['rt_60_mph']);
			
			$rt_60mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_60mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_60mph,$rt_60mph));
		}
		else
		{
			$rt_60_mph = new Zend_Form_Element_Hidden('rt_60_mph');
			$rt_60_mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_60_mph->setValue($form1_Values['rt_60_mph']);
			$this->addElement($rt_60_mph);
		}
		if(!empty($form1_Values['rt3_70mph']) && $form1_Values['rt3_70mph'] != $rt_results_level_3[0]['rt3_70mph'])
		{
			$rt3_70mph = new Zend_Form_Element_Text('rt3_70mph');
			$rt3_70mph->setValue($form1_Values['rt3_70mph']);
			
			$before_rt3_70mph = new Zend_Form_Element_Text('before_rt3_70mph',array("readonly" => "readonly"));
			$before_rt3_70mph->setLabel('0-70 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_70mph->setValue($rt_results_level_3[0]['rt3_70mph']);
			
			$rt3_70mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_70mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_70mph,$rt3_70mph));
		}
		else
		{
			$rt3_70mph = new Zend_Form_Element_Hidden('rt3_70mph');
			$rt3_70mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_70mph->setValue($form1_Values['rt3_70mph']);
			$this->addElement($rt3_70mph);
		}
		if(!empty($form1_Values['rt3_80mph']) && $form1_Values['rt3_80mph'] != $rt_results_level_3[0]['rt3_80mph'])
		{
			$rt3_80mph = new Zend_Form_Element_Text('rt3_80mph');
			$rt3_80mph->setValue($form1_Values['rt3_80mph']);
			
			$before_rt3_80mph = new Zend_Form_Element_Text('before_rt3_80mph',array("readonly" => "readonly"));
			$before_rt3_80mph->setLabel('0-80 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_80mph->setValue($rt_results_level_3[0]['rt3_80mph']);
			
			$rt3_80mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_80mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_80mph,$rt3_80mph));
		}
		else
		{
			$rt3_80mph = new Zend_Form_Element_Hidden('rt3_80mph');
			$rt3_80mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_80mph->setValue($form1_Values['rt3_80mph']);
			$this->addElement($rt3_80mph);
		}
		if(!empty($form1_Values['rt3_90mph']) && $form1_Values['rt3_90mph'] != $rt_results_level_3[0]['rt3_90mph'])
		{
			$rt3_90mph = new Zend_Form_Element_Text('rt3_90mph');
			$rt3_90mph->setValue($form1_Values['rt3_90mph']);
			
			$before_rt3_90mph = new Zend_Form_Element_Text('before_rt3_90mph',array("readonly" => "readonly"));
			$before_rt3_90mph->setLabel('0-90Accel');
			
			if($rt_results_level_3)
								 $before_rt3_90mph->setValue($rt_results_level_3[0]['rt3_90mph']);
			
			$rt3_90mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_90mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_90mph,$rt3_90mph));
		}
		else
		{
			$rt3_90mph = new Zend_Form_Element_Hidden('rt3_90mph');
			$rt3_90mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_90mph->setValue($form1_Values['rt3_90mph']);
			$this->addElement($rt3_90mph);
		}
		if(!empty($form1_Values['rt2_100_mph']) && $form1_Values['rt2_100_mph'] != $rt_results_level_2[0]['rt2_100_mph'])
		{
			$rt2_100mph = new Zend_Form_Element_Text('rt2_100_mph');
			$rt2_100mph->setValue($form1_Values['rt2_100_mph']);
			
			$before_rt2_100mph = new Zend_Form_Element_Text('before_rt2_100mph',array("readonly" => "readonly"));
			$before_rt2_100mph->setLabel('0-100Accel');
			
			if($rt_results_level_2)
								 $before_rt2_100mph->setValue($rt_results_level_2[0]['rt2_100_mph']);
			
			$rt2_100mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_100mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_100mph,$rt2_100mph));
		}
		else
		{
			$rt2_100_mph = new Zend_Form_Element_Hidden('rt2_100_mph');
			$rt2_100_mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_100_mph->setValue($form1_Values['rt2_100_mph']);
			$this->addElement($rt2_100_mph);
		}
		if(!empty($form1_Values['rt3_110mph']) && $form1_Values['rt3_110mph'] != $rt_results_level_3[0]['rt3_110mph'])
		{
			$rt3_110mph = new Zend_Form_Element_Text('rt3_110mph');
			$rt3_110mph->setValue($form1_Values['rt3_110mph']);
			
			$before_rt3_110mph = new Zend_Form_Element_Text('before_rt3_110mph',array("readonly" => "readonly"));
			$before_rt3_110mph->setLabel('0-110Accel');
			
			if($rt_results_level_3)
								 $before_rt3_110mph->setValue($rt_results_level_3[0]['rt3_110mph']);
			
			$rt3_110mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_110mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_110mph,$rt3_110mph));
		}
		else
		{
			$rt3_110mph = new Zend_Form_Element_Hidden('rt3_110mph');
			$rt3_110mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_110mph->setValue($form1_Values['rt3_110mph']);
			$this->addElement($rt3_110mph);
		}
		if(!empty($form1_Values['rt3_120mph']) && $form1_Values['rt3_120mph'] != $rt_results_level_3[0]['rt3_120mph'])
		{
			$rt3_120mph = new Zend_Form_Element_Text('rt3_120mph');
			$rt3_120mph->setValue($form1_Values['rt3_120mph']);
			
			$before_rt3_120mph = new Zend_Form_Element_Text('before_rt3_120mph',array("readonly" => "readonly"));
			$before_rt3_120mph->setLabel('0-120Accel');
			
			if($rt_results_level_3)
								 $before_rt3_120mph->setValue($rt_results_level_3[0]['rt3_120mph']);
			
			$rt3_120mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_120mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_120mph,$rt3_120mph));
		}
		else
		{
			$rt3_120mph = new Zend_Form_Element_Hidden('rt3_120mph');
			$rt3_120mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_120mph->setValue($form1_Values['rt3_120mph']);
			$this->addElement($rt3_120mph);
		}
		if(!empty($form1_Values['rt2_130_mph']) && $form1_Values['rt2_130_mph'] != $rt_results_level_2[0]['rt2_130_mph'])
		{
			$rt2_130mph = new Zend_Form_Element_Text('rt2_130_mph');
			$rt2_130mph->setValue($form1_Values['rt2_130_mph']);
			
			$before_rt2_130mph = new Zend_Form_Element_Text('before_rt2_130mph',array("readonly" => "readonly"));
			$before_rt2_130mph->setLabel('0-130 Accel');
			
			if($rt_results_level_2)
								 $before_rt2_130mph->setValue($rt_results_level_2[0]['rt2_130_mph']);
			
			$rt2_130mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_130mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_130mph,$rt2_130mph));
		}
		else
		{
			$rt2_130_mph = new Zend_Form_Element_Hidden('rt2_130_mph');
			$rt2_130_mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_130_mph->setValue($form1_Values['rt2_130_mph']);
			$this->addElement($rt2_130_mph);
		}
		if(!empty($form1_Values['rt3_140mph']) && $form1_Values['rt3_140mph'] != $rt_results_level_3[0]['rt3_140mph'])
		{
			$rt3_140mph = new Zend_Form_Element_Text('rt3_140mph');
			$rt3_140mph->setValue($form1_Values['rt3_140mph']);
			
			$before_rt3_140mph = new Zend_Form_Element_Text('before_rt3_140mph',array("readonly" => "readonly"));
			$before_rt3_140mph->setLabel('0-140 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_140mph->setValue($rt_results_level_3[0]['rt3_140mph']);
			
			$rt3_140mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_140mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_140mph,$rt3_140mph));
		}
		else
		{
			$rt3_140mph = new Zend_Form_Element_Hidden('rt3_140mph');
			$rt3_140mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_140mph->setValue($form1_Values['rt3_140mph']);
			$this->addElement($rt3_140mph);
		}
		if(!empty($form1_Values['rt3_150mph']) && $form1_Values['rt3_150mph'] != $rt_results_level_3[0]['rt3_150mph'])
		{
			$rt3_150mph = new Zend_Form_Element_Text('rt3_150mph');
			$rt3_150mph->setValue($form1_Values['rt3_150mph']);
			
			$before_rt3_150mph = new Zend_Form_Element_Text('before_rt3_150mph',array("readonly" => "readonly"));
			$before_rt3_150mph->setLabel('0-150 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_150mph->setValue($rt_results_level_3[0]['rt3_150mph']);
			
			$rt3_150mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_150mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_150mph,$rt3_150mph));
		}
		else
		{
			$rt3_150mph = new Zend_Form_Element_Hidden('rt3_150mph');
			$rt3_150mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_150mph->setValue($form1_Values['rt3_150mph']);
			$this->addElement($rt3_150mph);
		}
		if(!empty($form1_Values['rt3_160mph']) && $form1_Values['rt3_160mph'] != $rt_results_level_3[0]['rt3_160mph'])
		{
			$rt3_160mph = new Zend_Form_Element_Text('rt3_160mph');
			$rt3_160mph->setValue($form1_Values['rt3_160mph']);
			
			$before_rt3_160mph = new Zend_Form_Element_Text('before_rt3_160mph',array("readonly" => "readonly"));
			$before_rt3_160mph->setLabel('0-160 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_160mph->setValue($rt_results_level_3[0]['rt3_160mph']);
			
			$rt3_160mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_160mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_160mph,$rt3_160mph));
		}
		else
		{
			$rt3_160mph = new Zend_Form_Element_Hidden('rt3_160mph');
			$rt3_160mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_160mph->setValue($form1_Values['rt3_160mph']);
			$this->addElement($rt3_160mph);
		}
		if(!empty($form1_Values['rt3_170mph']) && $form1_Values['rt3_170mph'] != $rt_results_level_3[0]['rt3_170mph'])
		{
			$rt3_170mph = new Zend_Form_Element_Text('rt3_170mph');
			$rt3_170mph->setValue($form1_Values['rt3_170mph']);
			
			$before_rt3_170mph = new Zend_Form_Element_Text('before_rt3_170mph',array("readonly" => "readonly"));
			$before_rt3_170mph->setLabel('0-170 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_170mph->setValue($rt_results_level_3[0]['rt3_170mph']);
			
			$rt3_170mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_170mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_170mph,$rt3_170mph));
		}
		else
		{
			$rt3_170mph = new Zend_Form_Element_Hidden('rt3_170mph');
			$rt3_170mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_170mph->setValue($form1_Values['rt3_170mph']);
			$this->addElement($rt3_170mph);
		}
		
		if(!empty($form1_Values['rt3_180mph']) && $form1_Values['rt3_180mph'] != $rt_results_level_3[0]['rt3_180mph'])
		{
			$rt3_180mph = new Zend_Form_Element_Text('rt3_180mph');
			$rt3_180mph->setValue($form1_Values['rt3_180mph']);
			
			$before_rt3_180mph = new Zend_Form_Element_Text('before_rt3_180mph',array("readonly" => "readonly"));
			$before_rt3_180mph->setLabel('0-180 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_180mph->setValue($rt_results_level_3[0]['rt3_180mph']);
			
			$rt3_180mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_180mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_180mph,$rt3_180mph));
		}
		else
		{
			$rt3_180mph = new Zend_Form_Element_Hidden('rt3_180mph');
			$rt3_180mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_180mph->setValue($form1_Values['rt3_180mph']);
			$this->addElement($rt3_180mph);
		}

		if(!empty($form1_Values['rt3_190mph']) && $form1_Values['rt3_190mph'] != $rt_results_level_3[0]['rt3_190mph'])
		{
			$rt3_190mph = new Zend_Form_Element_Text('rt3_190mph');
			$rt3_190mph->setValue($form1_Values['rt3_190mph']);
			
			$before_rt3_190mph = new Zend_Form_Element_Text('before_rt3_190mph',array("readonly" => "readonly"));
			$before_rt3_190mph->setLabel('0-190 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_190mph->setValue($rt_results_level_3[0]['rt3_190mph']);
			
			$rt3_190mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_190mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_190mph,$rt3_190mph));
		}
		else
		{
			$rt3_190mph = new Zend_Form_Element_Hidden('rt3_190mph');
			$rt3_190mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_190mph->setValue($form1_Values['rt3_190mph']);
			$this->addElement($rt3_190mph);
		}
		if(!empty($form1_Values['rt3_200mph']) && $form1_Values['rt3_200mph'] != $rt_results_level_3[0]['rt3_200mph'])
		{
			$rt3_200mph = new Zend_Form_Element_Text('rt3_200mph');
			$rt3_200mph->setValue($form1_Values['rt3_200mph']);
			
			$before_rt3_200mph = new Zend_Form_Element_Text('before_rt3_200mph',array("readonly" => "readonly"));
			$before_rt3_200mph->setLabel('0-200 Accel');
			
			if($rt_results_level_3)
								 $before_rt3_200mph->setValue($rt_results_level_3[0]['rt3_200mph']);
			
			$rt3_200mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_200mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_200mph,$rt3_200mph));
		}
		else
		{
			$rt3_200mph = new Zend_Form_Element_Hidden('rt3_200mph');
			$rt3_200mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_200mph->setValue($form1_Values['rt3_200mph']);
			$this->addElement($rt3_200mph);
		}
		if(!empty($form1_Values['rt_ss60']) && $form1_Values['rt_ss60'] != $rt_results_main[0]['rt_ss60'])
		{
			$rt_ss60 = new Zend_Form_Element_Text('rt_ss60');
			$rt_ss60->setValue($form1_Values['rt_ss60']);
			
			$before_rt_ss60 = new Zend_Form_Element_Text('before_rt_ss60',array("readonly" => "readonly"));
			$before_rt_ss60->setLabel('5-60 ss Accel');
			
			if($rt_results_main)
									  $before_rt_ss60->setValue($rt_results_main[0]['rt_ss60']);
			
			$rt_ss60->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_ss60->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_ss60,$rt_ss60));
		}
		else
		{
			$rt_ss60 = new Zend_Form_Element_Hidden('rt_ss60');
			$rt_ss60 ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_ss60->setValue($form1_Values['rt_ss60']);
			$this->addElement($rt_ss60);
		}
		if(!empty($form1_Values['rt2_30_50TG']) && $form1_Values['rt2_30_50TG'] != $rt_results_level_2[0]['rt2_30_50TG'])
		{
			$rt2_30_50TG = new Zend_Form_Element_Text('rt2_30_50TG');
			$rt2_30_50TG->setValue($form1_Values['rt2_30_50TG']);
			
			$before_rt2_30_50TG = new Zend_Form_Element_Text('before_rt2_30_50TG',array("readonly" => "readonly"));
			$before_rt2_30_50TG->setLabel('Top-Gear Accel 30-50');
			
			if($rt_results_level_2)
										$before_rt2_30_50TG->setValue($rt_results_level_2[0]['rt2_30_50TG']);
			
			$rt2_30_50TG->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_30_50TG->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_30_50TG,$rt2_30_50TG));
		}
		else
		{
			$rt2_30_50TG = new Zend_Form_Element_Hidden('rt2_30_50TG');
			$rt2_30_50TG ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_30_50TG->setValue($form1_Values['rt2_30_50TG']);
			$this->addElement($rt2_30_50TG);
		}
		if(!empty($form1_Values['rt2_50_70TG']) && $form1_Values['rt2_50_70TG'] != $rt_results_level_2[0]['rt2_50_70TG'])
		{
			$rt2_50_70TG = new Zend_Form_Element_Text('rt2_50_70TG');
			$rt2_50_70TG->setValue($form1_Values['rt2_50_70TG']);
			
			$before_rt2_50_70TG = new Zend_Form_Element_Text('before_rt2_50_70TG',array("readonly" => "readonly"));
			$before_rt2_50_70TG->setLabel('Top-Gear Accel 50-70');
			
			if($rt_results_level_2)
										$before_rt2_50_70TG->setValue($rt_results_level_2[0]['rt2_50_70TG']);
			
			$rt2_50_70TG->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_50_70TG->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_50_70TG,$rt2_50_70TG));
		}
		else
		{
			$rt2_50_70TG = new Zend_Form_Element_Hidden('rt2_50_70TG');
			$rt2_50_70TG ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_50_70TG->setValue($form1_Values['rt2_50_70TG']);
			$this->addElement($rt2_50_70TG);
		}
		if(!empty($form1_Values['rt2_sum_of_tg_times']) && $form1_Values['rt2_sum_of_tg_times'] != $rt_results_level_2[0]['rt2_sum_of_tg_times'])
		{
			$rt2_sum_of_tg_times = new Zend_Form_Element_Text('rt2_sum_of_tg_times');
			$rt2_sum_of_tg_times->setValue($form1_Values['rt2_sum_of_tg_times']);
			
			$before_rt2_sum_of_tg_times = new Zend_Form_Element_Text('before_rt2_sum_of_tg_times',array("readonly" => "readonly"));
			$before_rt2_sum_of_tg_times->setLabel('Sum of the above 2');
			
			if($rt_results_level_2)
										$before_rt2_sum_of_tg_times->setValue($rt_results_level_2[0]['rt2_sum_of_tg_times']);
			
			$rt2_sum_of_tg_times->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_sum_of_tg_times->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_sum_of_tg_times,$rt2_sum_of_tg_times));
		}
		else
		{
			$rt2_sum_of_tg_times = new Zend_Form_Element_Hidden('rt2_sum_of_tg_times');
			$rt2_sum_of_tg_times ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_sum_of_tg_times->setValue($form1_Values['rt2_sum_of_tg_times']);
			$this->addElement($rt2_sum_of_tg_times);
		}
		if(!empty($form1_Values['rt_quarter_time']) && $form1_Values['rt_quarter_time'] != $rt_results_main[0]['rt_quarter_time'])
		{
			$rt_quarter_time = new Zend_Form_Element_Text('rt_quarter_time');
			$rt_quarter_time->setValue($form1_Values['rt_quarter_time']);
			
			$before_rt_quarter_time = new Zend_Form_Element_Text('before_rt_quarter_time',array("readonly" => "readonly"));
			$before_rt_quarter_time->setLabel('Quarter Mile Time');
			
			if($rt_results_main)
								$before_rt_quarter_time->setValue($rt_results_main[0]['rt_quarter_time']);
			
			$rt_quarter_time->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_quarter_time->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_quarter_time,$rt_quarter_time));
		}
		else
		{
			$rt_quarter_time = new Zend_Form_Element_Hidden('rt_quarter_time');
			$rt_quarter_time ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_quarter_time->setValue($form1_Values['rt_quarter_time']);
			$this->addElement($rt_quarter_time);
		}
		if(!empty($form1_Values['rt_speed_qtr_mile_speed_trap']) && $form1_Values['rt_speed_qtr_mile_speed_trap'] != $rt_results_main[0]['rt_speed_qtr_mile_speed_trap'])
		{
			$rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Text('rt_speed_qtr_mile_speed_trap');
			$rt_speed_qtr_mile_speed_trap->setValue($form1_Values['rt_speed_qtr_mile_speed_trap']);
			
			$before_rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Text('before_rt_speed_qtr_mile_speed_trap',array("readonly" => "readonly"));
			$before_rt_speed_qtr_mile_speed_trap->setLabel('Quarter Trap Speed');
			
			if($rt_results_main)
								$before_rt_speed_qtr_mile_speed_trap->setValue($rt_results_main[0]['rt_speed_qtr_mile_speed_trap']);
			
			$rt_speed_qtr_mile_speed_trap->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_speed_qtr_mile_speed_trap->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_speed_qtr_mile_speed_trap,$rt_speed_qtr_mile_speed_trap));
		}
		else
		{
			$rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Hidden('rt_speed_qtr_mile_speed_trap');
			$rt_speed_qtr_mile_speed_trap ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_speed_qtr_mile_speed_trap->setValue($form1_Values['rt_speed_qtr_mile_speed_trap']);
			$this->addElement($rt_speed_qtr_mile_speed_trap);
		}
		if(!empty($form1_Values['rt_top_speed']) && $form1_Values['rt_top_speed'] != $rt_results_main[0]['rt_top_speed'])
		{
			$rt_top_speed = new Zend_Form_Element_Text('rt_top_speed');
			$rt_top_speed->setValue($form1_Values['rt_top_speed']);
			
			$before_rt_top_speed = new Zend_Form_Element_Text('before_rt_top_speed',array("readonly" => "readonly"));
			$before_rt_top_speed->setLabel('Top Speed');
			
			if($rt_results_main)
								$before_rt_top_speed->setValue($rt_results_main[0]['rt_top_speed']);
			
			$rt_top_speed->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_top_speed->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_top_speed,$rt_top_speed));
			
		}
		else
		{
			$rt_top_speed = new Zend_Form_Element_Hidden('rt_top_speed');
			$rt_top_speed ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_top_speed->setValue($form1_Values['rt_top_speed']);
			$this->addElement($rt_top_speed);
		}
		if(!empty($form1_Values['rt_controlled_ts_limit']) && $form1_Values['rt_controlled_ts_limit'] != $rt_results_main[0]['rt_controlled_ts_limit'])
		{
			$rt_controlled_ts_limit_prepared = $this->gatMultioptions("TS limit");
		
			$rt_controlled_ts_limit = new Zend_Form_Element_Select('rt_controlled_ts_limit',array('style'=>'width:150px;'));
			$rt_controlled_ts_limit->addMultiOptions($rt_controlled_ts_limit_prepared)
						->setValue($form1_Values['rt_controlled_ts_limit']);
						
			$before_rt_controlled_ts_limit = new Zend_Form_Element_Text('before_rt_controlled_ts_limit',array("readonly" => "readonly"));
			$before_rt_controlled_ts_limit->setLabel('Top Speed Limit');
			
			if($rt_results_main)
								$before_rt_controlled_ts_limit->setValue($rt_results_main[0]['rt_controlled_ts_limit']);
			
			$rt_controlled_ts_limit->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_ts_limit->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_ts_limit,$rt_controlled_ts_limit));
		}
		else
		{
			$rt_controlled_ts_limit = new Zend_Form_Element_Hidden('rt_controlled_ts_limit');
			$rt_controlled_ts_limit ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_controlled_ts_limit->setValue($form1_Values['rt_controlled_ts_limit']);
			$this->addElement($rt_controlled_ts_limit);
		}
		if(!empty($form1_Values['rt_top_speed_notes']) && $form1_Values['rt_top_speed_notes'] != $rt_results_main[0]['rt_top_speed_notes'])
		{
			$rt_top_speed_notes = new Zend_Form_Element_Text('rt_top_speed_notes');
			$rt_top_speed_notes->setValue($form1_Values['rt_top_speed_notes']);
			
			$before_rt_top_speed_notes = new Zend_Form_Element_Text('before_rt_top_speed_notes',array("readonly" => "readonly"));
			$before_rt_top_speed_notes->setLabel('Top Speed Notes');
			
			if($rt_results_main)
								$before_rt_top_speed_notes->setValue($rt_results_main[0]['rt_top_speed_notes']);
			
			$rt_top_speed_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_top_speed_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_top_speed_notes,$rt_top_speed_notes));
		}
		else
		{
			$rt_top_speed_notes = new Zend_Form_Element_Hidden('rt_top_speed_notes');
			$rt_top_speed_notes ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_top_speed_notes->setValue($form1_Values['rt_top_speed_notes']);
			$this->addElement($rt_top_speed_notes);
		}
		if(!empty($form1_Values['rt_70_mph_braking']) && $form1_Values['rt_70_mph_braking'] != $rt_results_main[0]['rt_70_mph_braking'])
		{
			$rt_70_mph_braking = new Zend_Form_Element_Text('rt_70_mph_braking');
			$rt_70_mph_braking->setValue($form1_Values['rt_70_mph_braking']);
			
			$before_rt_70_mph_braking = new Zend_Form_Element_Text('before_rt_70_mph_braking',array("readonly" => "readonly"));
			$before_rt_70_mph_braking->setLabel('Braking from 70');
			
			if($rt_results_main)
								$before_rt_70_mph_braking->setValue($rt_results_main[0]['rt_70_mph_braking']);
			
			$rt_70_mph_braking->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_70_mph_braking->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_70_mph_braking,$rt_70_mph_braking));
		}
		else
		{
			$rt_70_mph_braking = new Zend_Form_Element_Hidden('rt_70_mph_braking');
			$rt_70_mph_braking ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_70_mph_braking->setValue($form1_Values['rt_70_mph_braking']);
			$this->addElement($rt_70_mph_braking);
		}
		if(!empty($form1_Values['rt2_skidpad']) && $form1_Values['rt2_skidpad'] != $rt_results_level_2[0]['rt2_skidpad'])
		{
			$rt2_skidpad = new Zend_Form_Element_Text('rt2_skidpad');
			$rt2_skidpad->setValue($form1_Values['rt2_skidpad']);
			
			$before_rt2_skidpad = new Zend_Form_Element_Text('before_rt2_skidpad',array("readonly" => "readonly"));
			$before_rt2_skidpad->setLabel('Skidpad');
			
			if($rt_results_level_2)
										$before_rt2_skidpad->setValue($rt_results_level_2[0]['rt2_skidpad']);
			
			$rt2_skidpad->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_skidpad->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_skidpad,$rt2_skidpad) );
		}
		else
		{
			$rt2_skidpad = new Zend_Form_Element_Hidden('rt2_skidpad');
			$rt2_skidpad ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_skidpad->setValue($form1_Values['rt2_skidpad']);
			$this->addElement($rt2_skidpad);
		}
		if(!empty($form1_Values['rt2_emergency_lane_change']) && $form1_Values['rt2_emergency_lane_change'] != $rt_results_level_2[0]['rt2_emergency_lane_change'])
		{
			$rt2_emergency_lane_change = new Zend_Form_Element_Text('rt2_emergency_lane_change');
			$rt2_emergency_lane_change->setValue($form1_Values['rt2_emergency_lane_change']);
			
			$before_rt2_emergency_lane_change = new Zend_Form_Element_Text('before_rt2_emergency_lane_change',array("readonly" => "readonly"));
			$before_rt2_emergency_lane_change->setLabel('MPH in Lane Change');
			
			if($rt_results_level_2)
										$before_rt2_emergency_lane_change->setValue($rt_results_level_2[0]['rt2_emergency_lane_change']);
			
			$rt2_emergency_lane_change->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_emergency_lane_change->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_emergency_lane_change,$rt2_emergency_lane_change));
		}
		else
		{
			$rt2_emergency_lane_change = new Zend_Form_Element_Hidden('rt2_emergency_lane_change');
			$rt2_emergency_lane_change ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_emergency_lane_change->setValue($form1_Values['rt2_emergency_lane_change']);
			$this->addElement($rt2_emergency_lane_change);
		}
		if(!empty($form1_Values['rt_slalom']) && $form1_Values['rt_slalom'] != $rt_results_main[0]['rt_slalom'])
		{
			$rt_slalom = new Zend_Form_Element_Text('rt_slalom');
			$rt_slalom->setValue($form1_Values['rt_slalom']);
			
			$before_rt_slalom = new Zend_Form_Element_Text('before_rt_slalom',array("readonly" => "readonly"));
			$before_rt_slalom->setLabel('Slalom Speed');
			
			if($rt_results_main)
									  $before_rt_slalom->setValue($rt_results_main[0]['rt_slalom']);
			
			$rt_slalom->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_slalom->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_slalom,$rt_slalom));
		}
		else
		{
			$rt_slalom = new Zend_Form_Element_Hidden('rt_slalom');
			$rt_slalom ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_slalom->setValue($form1_Values['rt_slalom']);
			$this->addElement($rt_slalom);
		}
		if(!empty($form1_Values['rt_controlled_fuel']) && $form1_Values['rt_controlled_fuel'] != $rt_results_main[0]['rt_controlled_fuel'])
		{
			$rt_controlled_fuel_prepared = $this->gatMultioptions("Fuel");
		
			$rt_controlled_fuel = new Zend_Form_Element_Select('rt_controlled_fuel',array('style'=>'width:150px;'));
			$rt_controlled_fuel->addMultiOptions($rt_controlled_fuel_prepared)
						->setValue($form1_Values['rt_controlled_fuel']);
			
			$before_rt_controlled_fuel = new Zend_Form_Element_Text('before_rt_controlled_fuel',array("readonly" => "readonly"));
			$before_rt_controlled_fuel->setLabel('Fuel Type');
			
			if($rt_results_main)
								$before_rt_controlled_fuel->setValue($rt_results_main[0]['rt_controlled_fuel']);
			
			$rt_controlled_fuel->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_controlled_fuel->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_controlled_fuel,$rt_controlled_fuel));
		}
		else
		{
			$rt_controlled_fuel = new Zend_Form_Element_Hidden('rt_controlled_fuel');
			$rt_controlled_fuel ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_controlled_fuel->setValue($form1_Values['rt_controlled_fuel']);
			$this->addElement($rt_controlled_fuel);
		}
		if(!empty($form1_Values['rt3_fuel_cap']) && $form1_Values['rt3_fuel_cap'] != $rt_results_level_3[0]['rt3_fuel_cap'])
		{
			$rt3_fuel_cap = new Zend_Form_Element_Text('rt3_fuel_cap');
			$rt3_fuel_cap->setValue($form1_Values['rt3_fuel_cap']);
			
			$before_rt3_fuel_cap = new Zend_Form_Element_Text('before_rt3_fuel_cap',array("readonly" => "readonly"));
			$before_rt3_fuel_cap->setLabel('Fuel Capacity');
			
			if($rt_results_level_3)
								 $before_rt3_fuel_cap->setValue($rt_results_level_3[0]['rt3_fuel_cap']);
			
			$rt3_fuel_cap->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_fuel_cap->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_fuel_cap,$rt3_fuel_cap));
		}
		else
		{
			$rt3_fuel_cap = new Zend_Form_Element_Hidden('rt3_fuel_cap');
			$rt3_fuel_cap ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_fuel_cap->setValue($form1_Values['rt3_fuel_cap']);
			$this->addElement($rt3_fuel_cap);
		}
		if(!empty($form1_Values['rt2_epa_city_fe']) && $form1_Values['rt2_epa_city_fe'] != $rt_results_level_2[0]['rt2_epa_city_fe'])
		{
			$rt2_epa_city_fe = new Zend_Form_Element_Text('rt2_epa_city_fe');
			$rt2_epa_city_fe->setValue($form1_Values['rt2_epa_city_fe']);
			
			$before_rt2_epa_city_fe = new Zend_Form_Element_Text('before_rt2_epa_city_fe',array("readonly" => "readonly"));
			$before_rt2_epa_city_fe->setLabel('EPA City');
			
			if($rt_results_level_2)
									$before_rt2_epa_city_fe->setValue($rt_results_level_2[0]['rt2_epa_city_fe']);
			
			$rt2_epa_city_fe->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_epa_city_fe->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_epa_city_fe,$rt2_epa_city_fe));
			
		}
		else
		{
			$rt2_epa_city_fe = new Zend_Form_Element_Hidden('rt2_epa_city_fe');
			$rt2_epa_city_fe ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_epa_city_fe->setValue($form1_Values['rt2_epa_city_fe']);
			$this->addElement($rt2_epa_city_fe);
		}
		if(!empty($form1_Values['rt2_epa_city_fe_notes']) && $form1_Values['rt2_epa_city_fe_notes'] != $rt_results_level_2[0]['rt2_epa_city_fe_notes'])
		{
			$rt2_epa_city_fe_notes = new Zend_Form_Element_Text('rt2_epa_city_fe_notes');
			$rt2_epa_city_fe_notes->setValue($form1_Values['rt2_epa_city_fe_notes']);
			
			$before_rt2_epa_city_fe_notes = new Zend_Form_Element_Text('before_rt2_epa_city_fe_notes',array("readonly" => "readonly"));
			$before_rt2_epa_city_fe_notes->setLabel('EPA City Notes');
			
			if($rt_results_level_2)
									  $before_rt2_epa_city_fe_notes->setValue($rt_results_level_2[0]['rt2_epa_city_fe_notes']);
			
			$rt2_epa_city_fe_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_epa_city_fe_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_epa_city_fe_notes,$rt2_epa_city_fe_notes));
		}
		else
		{
			$rt2_epa_city_fe_notes = new Zend_Form_Element_Hidden('rt2_epa_city_fe_notes');
			$rt2_epa_city_fe_notes ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_epa_city_fe_notes->setValue($form1_Values['rt2_epa_city_fe_notes']);
			$this->addElement($rt2_epa_city_fe_notes);
		}
		if(!empty($form1_Values['rt2_highway_fe']) && $form1_Values['rt2_highway_fe'] != $rt_results_level_2[0]['rt2_highway_fe'])
		{
			$rt2_highway_fe = new Zend_Form_Element_Text('rt2_highway_fe');
			$rt2_highway_fe->setValue($form1_Values['rt2_highway_fe']);
			
			$before_rt2_highway_fe = new Zend_Form_Element_Text('before_rt2_highway_fe',array("readonly" => "readonly"));
			$before_rt2_highway_fe->setLabel('EPA Highway');
			
			if($rt_results_level_2)
									 $before_rt2_highway_fe->setValue($rt_results_level_2[0]['rt2_highway_fe']);
			
			$rt2_highway_fe->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_highway_fe->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_highway_fe,$rt2_highway_fe));
		}
		else
		{
			$rt2_highway_fe = new Zend_Form_Element_Hidden('rt2_highway_fe');
			$rt2_highway_fe ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_highway_fe->setValue($form1_Values['rt2_highway_fe']);
			$this->addElement($rt2_highway_fe);
		}
		if(!empty($form1_Values['rt2_highway_fe_notes']) && $form1_Values['rt2_highway_fe_notes'] != $rt_results_level_2[0]['rt2_highway_fe_notes'])
		{
			$rt2_highway_fe_notes = new Zend_Form_Element_Text('rt2_highway_fe_notes');
			$rt2_highway_fe_notes->setValue($form1_Values['rt2_highway_fe_notes']);
			
			$before_rt2_highway_fe_notes = new Zend_Form_Element_Text('before_rt2_highway_fe_notes',array("readonly" => "readonly"));
			$before_rt2_highway_fe_notes->setLabel('EPA HIghway Notes');
			
			if($rt_results_level_2)
									  $before_rt2_highway_fe_notes->setValue($rt_results_level_2[0]['rt2_highway_fe_notes']);
			
			$rt2_highway_fe_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_highway_fe_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_highway_fe_notes,$rt2_highway_fe_notes));
		}
		else
		{
			$rt2_highway_fe_notes = new Zend_Form_Element_Hidden('rt2_highway_fe_notes');
			$rt2_highway_fe_notes ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_highway_fe_notes->setValue($form1_Values['rt2_highway_fe_notes']);
			$this->addElement($rt2_highway_fe_notes);
		}
		if(!empty($form1_Values['rt_cd_observed_fe']) && $form1_Values['rt_cd_observed_fe'] != $rt_results_main[0]['rt_cd_observed_fe'])
		{
			$rt_cd_observed_fe = new Zend_Form_Element_Text('rt_cd_observed_fe');
			$rt_cd_observed_fe->setValue($form1_Values['rt_cd_observed_fe']);
			
			$before_rt_cd_observed_fe = new Zend_Form_Element_Text('before_rt_cd_observed_fe',array("readonly" => "readonly"));
			$before_rt_cd_observed_fe->setLabel('C/D Observed Economy');
			
			if($rt_results_main)
								$before_rt_cd_observed_fe->setValue($rt_results_main[0]['rt_cd_observed_fe']);
			
			$rt_cd_observed_fe->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_cd_observed_fe->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_cd_observed_fe,$rt_cd_observed_fe));
			
		}
		else
		{
			$rt_cd_observed_fe = new Zend_Form_Element_Hidden('rt_cd_observed_fe');
			$rt_cd_observed_fe ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_cd_observed_fe->setValue($form1_Values['rt_cd_observed_fe']);
			$this->addElement($rt_cd_observed_fe);
		}
		if(!empty($form1_Values['rt2_sound_level_idle']) && $form1_Values['rt2_sound_level_idle'] != $rt_results_level_2[0]['rt2_sound_level_idle'])
		{
			$rt2_sound_level_idle = new Zend_Form_Element_Text('rt2_sound_level_idle');
			$rt2_sound_level_idle->setValue($form1_Values['rt2_sound_level_idle']);
			
			$before_rt2_sound_level_idle = new Zend_Form_Element_Text('before_rt2_sound_level_idle',array("readonly" => "readonly"));
			$before_rt2_sound_level_idle->setLabel('Sound Level Idle');
			
			if($rt_results_level_2)
									  $before_rt2_sound_level_idle->setValue($rt_results_level_2[0]['rt2_sound_level_idle']);
			
			$rt2_sound_level_idle->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_sound_level_idle->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_sound_level_idle,$rt2_sound_level_idle));
		}
		else
		{
			$rt2_sound_level_idle = new Zend_Form_Element_Hidden('rt2_sound_level_idle');
			$rt2_sound_level_idle ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_sound_level_idle->setValue($form1_Values['rt2_sound_level_idle']);
			$this->addElement($rt2_sound_level_idle);
		}
		if(!empty($form1_Values['rt2_wot']) && $form1_Values['rt2_wot'] != $rt_results_level_2[0]['rt2_wot'])
		{
			$rt2_wot = new Zend_Form_Element_Text('rt2_wot');
			$rt2_wot->setValue($form1_Values['rt2_wot']);
			
			$before_rt2_wot = new Zend_Form_Element_Text('before_rt2_wot',array("readonly" => "readonly"));
			$before_rt2_wot->setLabel('DB at Wot');
			
			if($rt_results_level_2)
										$before_rt2_wot->setValue($rt_results_level_2[0]['rt2_wot']);
			
			$rt2_wot->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_wot->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_wot,$rt2_wot));
		}
		else
		{
			$rt2_wot = new Zend_Form_Element_Hidden('rt2_wot');
			$rt2_wot ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_wot->setValue($form1_Values['rt2_wot']);
			$this->addElement($rt2_wot);
		}
		if(!empty($form1_Values['rt2_70cr']) && $form1_Values['rt2_70cr'] != $rt_results_level_2[0]['rt2_70cr'])
		{
			$rt2_70cr = new Zend_Form_Element_Text('rt2_70cr');
			$rt2_70cr->setValue($form1_Values['rt2_70cr']);
			
			$before_rt2_70cr = new Zend_Form_Element_Text('before_rt2_70cr',array("readonly" => "readonly"));
			$before_rt2_70cr->setLabel('DB at 70 MPH Cruise');
			
			if($rt_results_level_2)
										$before_rt2_70cr->setValue($rt_results_level_2[0]['rt2_70cr']);
			
			$rt2_70cr->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_70cr->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_70cr,$rt2_70cr));
		}
		else
		{
			$rt2_70cr = new Zend_Form_Element_Hidden('rt2_70cr');
			$rt2_70cr ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_70cr->setValue($form1_Values['rt2_70cr']);
			$this->addElement($rt2_70cr);
		}
		if(!empty($form1_Values['rt3_70co']) && $form1_Values['rt3_70co'] != $rt_results_level_3[0]['rt3_70co'])
		{
			$rt3_70co = new Zend_Form_Element_Text('rt3_70co');
			$rt3_70co->setValue($form1_Values['rt3_70co']);
			
			$before_rt3_70co = new Zend_Form_Element_Text('before_rt3_70co',array("readonly" => "readonly"));
			$before_rt3_70co->setLabel('BD at 70 Coast');
			
			if($rt_results_level_3)
								 $before_rt3_70co->setValue($rt_results_level_3[0]['rt3_70co']);
			
			$rt3_70co->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_70co->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_70co,$rt3_70co));
		}
		else
		{
			$rt3_70co = new Zend_Form_Element_Hidden('rt3_70co');
			$rt3_70co ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_70co->setValue($form1_Values['rt3_70co']);
			$this->addElement($rt3_70co);
		}
		if(!empty($form1_Values['rt3_lt_oil']) && $form1_Values['rt3_lt_oil'] != $rt_results_level_3[0]['rt3_lt_oil'])
		{
			$rt3_lt_oil = new Zend_Form_Element_Text('rt3_lt_oil');
			$rt3_lt_oil->setValue($form1_Values['rt3_lt_oil']);
			
			$before_rt3_lt_oil = new Zend_Form_Element_Text('before_rt3_lt_oil',array("readonly" => "readonly"));
			$before_rt3_lt_oil->setLabel('Long-term Oil Used');
			
			if($rt_results_level_3)
								 $before_rt3_lt_oil->setValue($rt_results_level_3[0]['rt3_lt_oil']);
			
			$rt3_lt_oil->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_lt_oil->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_lt_oil,$rt3_lt_oil));
		}
		else
		{
			$rt3_lt_oil = new Zend_Form_Element_Hidden('rt3_lt_oil');
			$rt3_lt_oil ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_lt_oil->setValue($form1_Values['rt3_lt_oil']);
			$this->addElement($rt3_lt_oil);
		}
		if(!empty($form1_Values['rt3_lt_stps_sched']) && $form1_Values['rt3_lt_stps_sched'] != $rt_results_level_3[0]['rt3_lt_stps_sched'])
		{
			$rt3_lt_stps_sched = new Zend_Form_Element_Text('rt3_lt_stps_sched');
			$rt3_lt_stps_sched->setValue($form1_Values['rt3_lt_stps_sched']);
			
			$before_rt3_lt_stps_sched = new Zend_Form_Element_Text('before_rt3_lt_stps_sched',array("readonly" => "readonly"));
			$before_rt3_lt_stps_sched->setLabel('LT Scheduled Stops');
			
			if($rt_results_level_3)
								 $before_rt3_lt_stps_sched->setValue($rt_results_level_3[0]['rt3_lt_stps_sched']);
			
			$rt3_lt_stps_sched->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_lt_stps_sched->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_lt_stps_sched,$rt3_lt_stps_sched));
		}
		else
		{
			$rt3_lt_stps_sched = new Zend_Form_Element_Hidden('rt3_lt_stps_sched');
			$rt3_lt_stps_sched ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_lt_stps_sched->setValue($form1_Values['rt3_lt_stps_sched']);
			$this->addElement($rt3_lt_stps_sched);
		}
		if(!empty($form1_Values['rt3_lt_stps_unsched']) && $form1_Values['rt3_lt_stps_unsched'] != $rt_results_level_3[0]['rt3_lt_stps_unsched'])
		{
			$rt3_lt_stps_unsched = new Zend_Form_Element_Text('rt3_lt_stps_unsched');
			$rt3_lt_stps_unsched->setValue($form1_Values['rt3_lt_stps_unsched']);
			
			$before_rt3_lt_stps_unsched = new Zend_Form_Element_Text('before_rt3_lt_stps_unsched',array("readonly" => "readonly"));
			$before_rt3_lt_stps_unsched->setLabel('LT Unscheduled Stops');
			
			if($rt_results_level_3)
								 $before_rt3_lt_stps_unsched->setValue($rt_results_level_3[0]['rt3_lt_stps_unsched']);
			
			$rt3_lt_stps_unsched->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_lt_stps_unsched->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_lt_stps_unsched,$rt3_lt_stps_unsched));
		}
		else
		{
			$rt3_lt_stps_unsched = new Zend_Form_Element_Hidden('rt3_lt_stps_unsched');
			$rt3_lt_stps_unsched ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_lt_stps_unsched->setValue($form1_Values['rt3_lt_stps_unsched']);
			$this->addElement($rt3_lt_stps_unsched);
		}
		if(!empty($form1_Values['rt3_lt_serv']) && $form1_Values['rt3_lt_serv'] != $rt_results_level_3[0]['rt3_lt_serv'])
		{
			$rt3_lt_serv = new Zend_Form_Element_Text('rt3_lt_serv');
			$rt3_lt_serv->setValue($form1_Values['rt3_lt_serv']);
			
			$before_rt3_lt_serv = new Zend_Form_Element_Text('before_rt3_lt_serv',array("readonly" => "readonly"));
			$before_rt3_lt_serv->setLabel('Costs for LT Service');
			
			if($rt_results_level_3)
								 $before_rt3_lt_serv->setValue($rt_results_level_3[0]['rt3_lt_serv']);
			
			$rt3_lt_serv->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_lt_serv->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_lt_serv,$rt3_lt_serv));
		}
		else
		{
			$rt3_lt_serv = new Zend_Form_Element_Hidden('rt3_lt_serv');
			$rt3_lt_serv ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_lt_serv->setValue($form1_Values['rt3_lt_serv']);
			$this->addElement($rt3_lt_serv);
		}
		if(!empty($form1_Values['rt3_lt_wear']) && $form1_Values['rt3_lt_wear'] != $rt_results_level_3[0]['rt3_lt_wear'])
		{
			$rt3_lt_wear = new Zend_Form_Element_Text('rt3_lt_wear');
			$rt3_lt_wear->setValue($form1_Values['rt3_lt_wear']);
			
			$before_rt3_lt_wear = new Zend_Form_Element_Text('before_rt3_lt_wear',array("readonly" => "readonly"));
			$before_rt3_lt_wear->setLabel('Costs for LT Wear');
			
			if($rt_results_level_3)
								 $before_rt3_lt_wear->setValue($rt_results_level_3[0]['rt3_lt_wear']);
			
			$rt3_lt_wear->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_lt_wear->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_lt_wear,$rt3_lt_wear));
		}
		else
		{
			$rt3_lt_wear = new Zend_Form_Element_Hidden('rt3_lt_wear');
			$rt3_lt_wear ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_lt_wear->setValue($form1_Values['rt3_lt_wear']);
			$this->addElement($rt3_lt_wear);
		}
		
		if(!empty($form1_Values['rt3_lt_repair']) && $form1_Values['rt3_lt_repair'] != $rt_results_level_3[0]['rt3_lt_repair'])
		{
			$rt3_lt_repiar = new Zend_Form_Element_Text('rt3_lt_repair');
			$rt3_lt_repiar->setValue($form1_Values['rt3_lt_repair']);
			
			$before_rt3_lt_repiar = new Zend_Form_Element_Text('before_rt3_lt_repair',array("readonly" => "readonly"));
			$before_rt3_lt_repiar->setLabel('Costs for LT Repair');
			
			if($rt_results_level_3)
								 $before_rt3_lt_repiar->setValue($rt_results_level_3[0]['rt3_lt_repair']);
			
			$rt3_lt_repiar->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_lt_repiar->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_lt_repiar,$rt3_lt_repiar));
		}
		else
		{
			$rt3_lt_repair = new Zend_Form_Element_Hidden('rt3_lt_repair');
			$rt3_lt_repair ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_lt_repair->setValue($form1_Values['rt3_lt_repair']);
			$this->addElement($rt3_lt_repair);
		}
		if(!empty($form1_Values['rt2_50_mph']) && $form1_Values['rt2_50_mph'] != $rt_results_level_2[0]['rt2_50_mph'])
		{
			$rt2_50_mph = new Zend_Form_Element_Text('rt2_50_mph');
			$rt2_50_mph->setValue($form1_Values['rt2_50_mph']);
			
			$before_rt2_50_mph = new Zend_Form_Element_Text('before_rt2_50_mph',array("readonly" => "readonly"));
			$before_rt2_50_mph->setLabel('rt2_50_mph');
			
			if($rt_results_level_2)
										$before_rt2_50_mph->setValue($rt_results_level_2[0]['rt2_50_mph']);
			
			$rt2_50_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_50_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_50_mph,$rt2_50_mph));
			
		}
		else
		{
			$rt2_50_mph = new Zend_Form_Element_Hidden('rt2_50_mph');
			$rt2_50_mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_50_mph->setValue($form1_Values['rt2_50_mph']);
			$this->addElement($rt2_50_mph);
		}
		
		
		if(!empty($form1_Values['rt2_70_mph']) && $form1_Values['rt2_70_mph'] != $rt_results_level_2[0]['rt2_70_mph'])
		{
			$rt2_70_mph = new Zend_Form_Element_Text('rt2_70_mph');
			$rt2_70_mph->setValue($form1_Values['rt2_70_mph']);
			
			$before_rt2_70_mph = new Zend_Form_Element_Text('before_rt2_70_mph',array("readonly" => "readonly"));
			$before_rt2_70_mph->setLabel('rt2_70_mph');
			
			if($rt_results_level_2)
										$before_rt2_70_mph->setValue($rt_results_level_2[0]['rt2_70_mph']);
			
			$rt2_70_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_70_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_70_mph,$rt2_70_mph));
		}
		else
		{
			$rt2_70_mph = new Zend_Form_Element_Hidden('rt2_70_mph');
			$rt2_70_mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt2_70_mph->setValue($form1_Values['rt2_70_mph']);
			$this->addElement($rt2_70_mph);
		}
		if(!empty($form1_Values['rt3_et_factor']) && $form1_Values['rt3_et_factor'] != $rt_results_level_3[0]['rt3_et_factor'])
		{
			$rt3_et_factor = new Zend_Form_Element_Text('rt3_et_factor');
			$rt3_et_factor->setValue($form1_Values['rt3_et_factor']);
			
			$before_rt3_et_factor = new Zend_Form_Element_Text('before_rt3_et_factor',array("readonly" => "readonly"));
			$before_rt3_et_factor->setLabel('rt3_et_factor');
			
			if($rt_results_level_3)
								 $before_rt3_et_factor->setValue($rt_results_level_3[0]['rt3_et_factor']);
			
			$rt3_et_factor->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_et_factor->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_et_factor,$rt3_et_factor));
		}
		else
		{
			$rt3_et_factor = new Zend_Form_Element_Hidden('rt3_et_factor');
			$rt3_et_factor ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_et_factor->setValue($form1_Values['rt3_et_factor']);
			$this->addElement($rt3_et_factor);
		}
		if(!empty($form1_Values['rt3_road_hp_30mph']) && $form1_Values['rt3_road_hp_30mph'] != $rt_results_level_3[0]['rt3_road_hp_30mph'])
		{
			$rt3_road_hp_30mph = new Zend_Form_Element_Text('rt3_road_hp_30mph');
			$rt3_road_hp_30mph->setValue($form1_Values['rt3_road_hp_30mph']);
			
			$before_rt3_road_hp_30mph = new Zend_Form_Element_Text('before_rt3_road_hp_30mph',array("readonly" => "readonly"));
			$before_rt3_road_hp_30mph->setLabel('rt3_road_hp_30mph');
			
			if($rt_results_level_3)
								 $before_rt3_road_hp_30mph->setValue($rt_results_level_3[0]['rt3_road_hp_30mph']);
			
			$rt3_road_hp_30mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_road_hp_30mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_road_hp_30mph,$rt3_road_hp_30mph));
		}
		else
		{
			$rt3_road_hp_30mph = new Zend_Form_Element_Hidden('rt3_road_hp_30mph');
			$rt3_road_hp_30mph ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_road_hp_30mph->setValue($form1_Values['rt3_road_hp_30mph']);
			$this->addElement($rt3_road_hp_30mph);
		}
		if(!empty($form1_Values['rt3_sp_factor']) && $form1_Values['rt3_sp_factor'] != $rt_results_level_3[0]['rt3_sp_factor'])
		{
			$rt3_sp_factor = new Zend_Form_Element_Text('rt3_sp_factor');
			$rt3_sp_factor->setValue($form1_Values['rt3_sp_factor']);
			
			$before_rt3_sp_factor = new Zend_Form_Element_Text('before_rt3_sp_factor',array("readonly" => "readonly"));
			$before_rt3_sp_factor->setLabel('rt3_sp_factor');
			
			if($rt_results_level_3)
								 $before_rt3_sp_factor->setValue($rt_results_level_3[0]['rt3_sp_factor']);
			
			$rt3_sp_factor->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_sp_factor->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_sp_factor,$rt3_sp_factor));
		}
		else
		{
			$rt3_sp_factor = new Zend_Form_Element_Hidden('rt3_sp_factor');
			$rt3_sp_factor ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_sp_factor->setValue($form1_Values['rt3_sp_factor']);
			$this->addElement($rt3_sp_factor);
		}
		if(!empty($form1_Values['rt3_peak_bmep']) && $form1_Values['rt3_peak_bmep'] != $rt_results_level_3[0]['rt3_peak_bmep'])
		{
			$rt3_peak_bmep = new Zend_Form_Element_Text('rt3_peak_bmep');
			$rt3_peak_bmep->setValue($form1_Values['rt3_peak_bmep']);
			
			$before_rt3_peak_bmep = new Zend_Form_Element_Text('before_rt3_peak_bmep',array("readonly" => "readonly"));
			$before_rt3_peak_bmep->setLabel('rt3_peak_bmep');
			
			if($rt_results_level_3)
								 $before_rt3_peak_bmep->setValue($rt_results_level_3[0]['rt3_peak_bmep']);
			
			$rt3_peak_bmep->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_peak_bmep->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_peak_bmep,$rt3_peak_bmep));
		}
		else
		{
			$rt3_peak_bmep = new Zend_Form_Element_Hidden('rt3_peak_bmep');
			$rt3_peak_bmep ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_peak_bmep->setValue($form1_Values['rt3_peak_bmep']);
			$this->addElement($rt3_peak_bmep);
		}
		if(!empty($form1_Values['rt3_peal_bmep']) && $form1_Values['rt3_peal_bmep'] != $rt_results_level_3[0]['rt3_peal_bmep'])
		{
			$rt3_peal_bmep = new Zend_Form_Element_Text('rt3_peal_bmep');
			$rt3_peal_bmep->setValue($form1_Values['rt3_peal_bmep']);
			
			$before_rt3_peal_bmep = new Zend_Form_Element_Text('before_rt3_peal_bmep',array("readonly" => "readonly"));
			$before_rt3_peal_bmep->setLabel('rt3_peal_bmep');
			
			if($rt_results_level_3)
								 $before_rt3_peal_bmep->setValue($rt_results_level_3[0]['rt3_peal_bmep']);
			
			$rt3_peal_bmep->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt3_peal_bmep->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt3_peal_bmep,$rt3_peal_bmep));
		}
		else
		{
			$rt3_peal_bmep = new Zend_Form_Element_Hidden('rt3_peal_bmep');
			$rt3_peal_bmep ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt3_peal_bmep->setValue($form1_Values['rt3_peal_bmep']);
			$this->addElement($rt3_peal_bmep);
		}
		if(!empty($form1_Values['bg_controlled_make_id']) && $form1_Values['bg_controlled_make_id'] != $rt_results_main[0]['bg_controlled_make_id'])
		{
			//$bg_controlled_make_ids_prepared[0]= "Select from list";
			$bg_controlled_make_id = new Zend_Form_Element_Text('bg_controlled_make_id',array('style'=>'width:150px;'));
			$bg_controlled_make_id->setValue($form1_Values['bg_controlled_make_id']);
			
			$before_bg_controlled_make_id = new Zend_Form_Element_Text('before_bg_controlled_make_id',array("readonly" => "readonly"));
			$before_bg_controlled_make_id->setLabel('bg_cont_make_id');
			
			if($rt_results_main)
				$before_bg_controlled_make_id->setValue($rt_results_main[0]['bg_controlled_make_id']);
			
			$bg_controlled_make_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_bg_controlled_make_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_bg_controlled_make_id,$bg_controlled_make_id));			
		}
		
		else
		{
			$bg_controlled_make_id = new Zend_Form_Element_Hidden('bg_controlled_make_id');
			$bg_controlled_make_id ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$bg_controlled_make_id->setValue($form1_Values['bg_controlled_make_id']);
			$this->addElement($bg_controlled_make_id);
		}
		if(!empty($form1_Values['bg_controlled_model_id']) && $form1_Values['bg_controlled_model_id'] != $rt_results_main[0]['bg_controlled_model_id'])
		{
			//$bg_controlled_model_ids_prepared[0]= "Select from list";
			$bg_controlled_model_id = new Zend_Form_Element_Text('bg_controlled_model_id',array('style'=>'width:150px;'));
			$bg_controlled_model_id->setValue($form1_Values['bg_controlled_model_id']);
						
			$before_bg_controlled_model_id = new Zend_Form_Element_Text('before_bg_controlled_model_id',array("readonly" => "readonly"));
			$before_bg_controlled_model_id->setLabel('bg_cont_model_id');
			
			if($rt_results_main)
								$before_bg_controlled_model_id->setValue($rt_results_main[0]['bg_controlled_model_id']);
			
			$bg_controlled_model_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_bg_controlled_model_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_bg_controlled_model_id,$bg_controlled_model_id));	
		}
		else
		{
			$bg_controlled_model_id = new Zend_Form_Element_Hidden('bg_controlled_model_id');
			$bg_controlled_model_id ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$bg_controlled_model_id->setValue($form1_Values['bg_controlled_model_id']);
			$this->addElement($bg_controlled_model_id);
		}
		if(!empty($form1_Values['rt_original_table_id']) && $form1_Values['rt_original_table_id'] != $rt_results_main[0]['rt_original_table_id'])
		{
			//$rt_original_table_ids_prepared[0]= "Select from list";
			$rt_original_table_id = new Zend_Form_Element_Text('rt_original_table_id',array('style'=>'width:150px;'));
			$rt_original_table_id->setValue($form1_Values['rt_original_table_id']);
						
			$before_rt_original_table_id = new Zend_Form_Element_Text('before_rt_original_table_id',array("readonly" => "readonly"));
			$before_rt_original_table_id->setLabel('Original Year');
			
			if($rt_results_main)
								$before_rt_original_table_id->setValue($rt_results_main[0]['rt_original_table_id']);
			
			$rt_original_table_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_original_table_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_original_table_id,$rt_original_table_id));
		}
		else
		{
			$rt_original_table_id = new Zend_Form_Element_Hidden('rt_original_table_id');
			$rt_original_table_id ->removeDecorator('label')
          	               ->removeDecorator('HtmlTag');
			$rt_original_table_id->setValue($form1_Values['rt_original_table_id']);
			$this->addElement($rt_original_table_id);
		}
		
		$save_changes = new Zend_Form_Element_Submit('save_changes');
		$save_changes->setLabel('Save');
		
		$save_changes->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'right','border' => '0', 'colspan' => '2')),
		));
		
		$cancel = new Zend_Form_Element_Submit('cancel');
		$cancel->setLabel('Cancel');
		
		$cancel->setDecorators(array(
		'ViewHelper',
		'Description',
		array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'left','border' => '0')),
		));
		
		$this->addElement($save_changes);
		$this->addElement($cancel);
		
		$this->setDecorators(array(
		'FormElements',
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '4','cellspacing' => '0', 'width' => '100%', 'class'=>'reviewTable')),
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