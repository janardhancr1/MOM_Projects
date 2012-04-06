<?php
class Application_Form_Review extends Application_Form_MainForm
{
	
	public function init()
	{
		$session_formvalues = new Zend_Session_Namespace('FormValues');
		
		$form1_Values = $session_formvalues->FormValues;
		
		$db = Zend_Db_Table::getDefaultAdapter(); 
		$db_remote = $this->getDbConnection();
	
		if(!empty($form1_Values['bg_year_id']))
		{	
			$bg_year_ids_prepared[0]= "Select from list";
			/*$objDOM = new DOMDocument(); 
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
		    arsort($bg_year_ids_prepared);*/
			$select = $db_remote->select()
	             ->from('bg_year')
	             ->order('name DESC');
	        $bg_year_ids = $db_remote->query($select)->fetchAll();
		       
			if (count($bg_year_ids)!=0){
					//$bg_year_ids_prepared[]= "Select from list";
					foreach ($bg_year_ids as $Yea){
							$bg_year_ids_prepared[$Yea['id']]= $Yea['name'];
					}
			} 
			
			$bg_year_id = new Zend_Form_Element_Select('bg_year_id',array('style'=>'width:150px;'));
			$bg_year_id->addMultiOptions($bg_year_ids_prepared)
					->setValue($form1_Values['bg_year_id']);
					
		
			$before_bg_year_id = new Zend_Form_Element_Text('before_bg_year_id',array("readonly" => "readonly"));
			$before_bg_year_id->setLabel('Year(BG)');
			
			
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
		
		if(!empty($form1_Values['bg_make_id']))
		{
			$bg_make_ids_prepared[0]= "Select from list";
			/*$objDOM = new DOMDocument(); 
			$objDOM->load("http://buyersguide.caranddriver.com/api/makes?mode=xml"); 
			$xpath = new DOMXPath($objDOM);
			$query = '//response/data/row/name';
			$entries = $xpath->query($query);
			foreach( $entries as $entry )
			{
			    $name  = $entry->nodeValue;
			    $id  = $entry->previousSibling->nodeValue;
			    $bg_make_ids_prepared[$id]= $name;
			 }*/
			
			$select = $db_remote->select()
	             ->from('bg_make')
	             ->order('name ASC');
	        $bg_make_ids = $db_remote->query($select)->fetchAll();
		       
			if (count($bg_make_ids)!=0){
					//$bg_make_ids_prepared[]= "Select from list";
					foreach ($bg_make_ids as $Mak){
							$bg_make_ids_prepared[$Mak['id']]= $Mak['name'];
					}
			} 
		
			$bg_make_id = new Zend_Form_Element_Select('bg_make_id',array('style'=>'width:150px;'));
			$bg_make_id->addMultiOptions($bg_make_ids_prepared)
						->setValue($form1_Values['bg_make_id']);
			$bg_make_id->setAttrib('onchange','AutoFillModel(this.value)');		
				
			$before_bg_make_id = new Zend_Form_Element_Text('before_bg_make_id',array("readonly" => "readonly"));
			$before_bg_make_id->setLabel('Make(BG)');
			
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
			
			$bg_model_ids_prepared[0]= "Select from list";
			
			if(!empty($form1_Values['bg_make_id']))
			{
				    $session_makeid = new Zend_Session_Namespace('makeid');
					if(isset($session_makeid->make_id))
					{
						$makeid = $session_makeid->make_id;
						$bg_model_ids_prepared[0]= "Select from list";
						/*$objDOM = new DOMDocument(); 
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
						 }*/
						
						 $select = $db_remote->select()
			             ->from('bg_model')
			             ->where('make_id = ?', $makeid)
			             ->order('name ASC');
				        $bg_model_ids = $db_remote->query($select)->fetchAll();
					       
						if (count($bg_model_ids)!=0){
								foreach ($bg_model_ids as $Mod){
										$bg_model_ids_prepared[$Mod['id']]= $Mod['name'];
								}
						}
					}
			}
			
			
				$bg_model_id = new Zend_Form_Element_Select('bg_model_id',array('style'=>'width:150px;'));
				$bg_model_id->addMultiOptions($bg_model_ids_prepared)
							->setValue($form1_Values['bg_model_id']);
				$bg_model_id->setAttrib('onchange','AutoFillSubModel(this.value)');
				
							
				$before_bg_model_id = new Zend_Form_Element_Text('before_bg_model_id',array("readonly" => "readonly"));
				$before_bg_model_id->setLabel('Model(BG)');
				
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
				
				$bg_submodel_ids_prepared[0]= "Select from list";
			if(!empty($form1_Values['bg_year_id']))
			{
				$session_yearid = new Zend_Session_Namespace('yearid');
				if(isset($session_yearid->year_id) && isset($session_yearid->model_id))
				{
					$yearid = $session_yearid->year_id;
					$modelid = $session_yearid->model_id;
					$bg_submodel_ids_prepared[0]= "Select from list";
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
					    	$bg_submodel_ids_prepared[$id]= $name;
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
						    	$bg_submodel_ids_prepared[$id]= $name;
						    }
					 } 
				}*/
					
				$select = $db_remote->select()
		             ->from('bg_submodel')
		             ->where('model_id = ?', $modelid)
		             ->where('year_id = ?', $yearid)
		             ->order('name ASC');
	        $bg_submodel_ids = $db_remote->query($select)->fetchAll();
	        
		if (count($bg_submodel_ids)!=0){
					foreach ($bg_submodel_ids as $Mod){
							$bg_submodel_ids_prepared[$Mod['id']]= $Mod['name'];
					}
			}
				
			}
				
			$bg_submodel_id = new Zend_Form_Element_Select('bg_submodel_id',array('style'=>'width:150px;'));
			$bg_submodel_id->addMultiOptions($bg_submodel_ids_prepared)
						->setValue($form1_Values['bg_submodel_id']);
						
			$before_bg_submodel_id = new Zend_Form_Element_Text('before_bg_submodel_id',array("readonly" => "readonly"));
			$before_bg_submodel_id->setLabel('Sub-model(BG)');
			
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
		}
		
		if(!empty($form1_Values['rt_model_year']))
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
		if(!empty($form1_Values['rt_controlled_make']))
		{
			$rt_controlled_make_prepared = $this->gatMultioptions("Make");
		
			$rt_controlled_make = new Zend_Form_Element_Select('rt_controlled_make',array('style'=>'width:150px;'));
			$rt_controlled_make->addMultiOptions($rt_controlled_make_prepared)
						->setValue($form1_Values['rt_controlled_make']);
						
			$before_rt_controlled_make = new Zend_Form_Element_Text('before_rt_controlled_make',array("readonly" => "readonly"));
			$before_rt_controlled_make->setLabel('Make');
			
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
		
		if(!empty($form1_Values['rt_model']))
		{ 
		
			$rt_model = new Zend_Form_Element_Text('rt_model',array('style'=>'width:150px;'));
			$rt_model->setValue($form1_Values['rt_model']);
						
			$before_rt_model = new Zend_Form_Element_Text('before_rt_model',array("readonly" => "readonly"));
			$before_rt_model->setLabel('Model');
			
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
		
		if(!empty($form1_Values['rt_issue_year']))
		{
			$rt_issue_year = new Zend_Form_Element_Text('rt_issue_year');
			$rt_issue_year->setValue($form1_Values['rt_issue_year'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');

			$before_rt_issue_year = new Zend_Form_Element_Text('before_rt_issue_year',array("readonly" => "readonly"));
			$before_rt_issue_year->setLabel('Mag Issue Year');
			
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
		
		if(!empty($form1_Values['rt_issue']))
		{
			$rt_issue = new Zend_Form_Element_Select('rt_issue',array('style'=>'width:150px;'));
			$rt_issue->addMultioptions(array('0'=>'Select from list','01'=>'January', '02' => 'February',
								'03'=>'March','4'=>'April','05'=>'May','06'=>'June','07'=>'July',
								'08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December'));
			$rt_issue->setValue($form1_Values['rt_issue']);
			
			$before_rt_issue = new Zend_Form_Element_Text('before_rt_issue',array("readonly" => "readonly"));
			$before_rt_issue->setLabel('Mag Issue Month');
			
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
		
		if(!empty($form1_Values['rt_published']))
		{
			$rt_published = new Zend_Form_Element_Select('rt_published',array('style'=>'width:150px;'));
			$rt_published->addMultioptions(array('Web'=>'Web','Print'=>'Print'))
			->setValue($form1_Values['rt_published']);
			
			
			$before_rt_published = new Zend_Form_Element_Text('before_rt_published',array("readonly" => "readonly"));
			$before_rt_published->setLabel('Web or print');
			
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
		if(!empty($form1_Values['rt_controlled_sort']))
		{
			$rt_controlled_sort_prepared = $this->gatMultioptions("Sort");
		
			$rt_controlled_sort = new Zend_Form_Element_Select('rt_controlled_sort',array('style'=>'width:150px;'));
			$rt_controlled_sort->addMultiOptions($rt_controlled_sort_prepared)
						->setValue($form1_Values['rt_controlled_sort']);
						
			$before_rt_controlled_sort = new Zend_Form_Element_Text('before_rt_controlled_sort',array("readonly" => "readonly"));
			$before_rt_controlled_sort->setLabel('Production Type');
			
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
		if(!empty($form1_Values['rt_controlled_engine']))
		{
			$rt_controlled_engine_prepared = $this->gatMultioptions("Engine");
		
			$rt_controlled_engine = new Zend_Form_Element_Select('rt_controlled_engine',array('style'=>'width:150px;'));
			$rt_controlled_engine->addMultiOptions($rt_controlled_engine_prepared)
						->setValue($form1_Values['rt_controlled_engine']);
			
			$before_rt_controlled_engine = new Zend_Form_Element_Text('before_rt_controlled_engine',array("readonly" => "readonly"));
			$before_rt_controlled_engine->setLabel('Engine Location');
			
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
		if(!empty($form1_Values['rt_controlled_drive']))
		{
			$rt_controlled_drive_prepared = $this->gatMultioptions("Drive");
		
			$rt_controlled_drive = new Zend_Form_Element_Select('rt_controlled_drive',array('style'=>'width:150px;'));
			$rt_controlled_drive->addMultiOptions($rt_controlled_drive_prepared)
						->setValue($form1_Values['rt_controlled_drive']);
						
			$before_rt_controlled_drive = new Zend_Form_Element_Text('before_rt_controlled_drive',array("readonly" => "readonly"));
			$before_rt_controlled_drive->setLabel('Driven Wheels');
			
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
		if(!empty($form1_Values['rt2_passengers']))
		{
			$rt2_passengers = new Zend_Form_Element_Text('rt2_passengers');
			$rt2_passengers->setValue($form1_Values['rt2_passengers'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt2_passengers = new Zend_Form_Element_Text('before_rt2_passengers',array("readonly" => "readonly"));
			$before_rt2_passengers->setLabel('Number of Passengers');
		
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
		
		if(!empty($form1_Values['rt_doors']))
		{
			$rt_doors = new Zend_Form_Element_Text('rt_doors');
			$rt_doors->setValue($form1_Values['rt_doors'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_doors = new Zend_Form_Element_Text('before_rt_doors',array("readonly" => "readonly"));
			$before_rt_doors->setLabel('Number of Doors');
			
		
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
		if(!empty($form1_Values['rt_controlled_body']))
		{
			$rt_controlled_body_prepared = $this->gatMultioptions("Body");
		
			$rt_controlled_body = new Zend_Form_Element_Select('rt_controlled_body',array('style'=>'width:150px;'));
			$rt_controlled_body->addMultiOptions($rt_controlled_body_prepared)
						->setValue($form1_Values['rt_controlled_body']);
			
			$before_rt_controlled_body = new Zend_Form_Element_Text('before_rt_controlled_body',array("readonly" => "readonly"));
			$before_rt_controlled_body->setLabel('Body Style');
		
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
		if(!empty($form1_Values['rt_base_price']))
		{
			$rt_base_price = new Zend_Form_Element_Text('rt_base_price');
			$rt_base_price->setValue($form1_Values['rt_base_price'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_base_price = new Zend_Form_Element_Text('before_rt_base_price',array("readonly" => "readonly"));
			$before_rt_base_price->setLabel('Base Price');
			
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
		
		if(!empty($form1_Values['rt_base_price_notes']))
		{
			$rt_base_price_notes = new Zend_Form_Element_Text('rt_base_price_notes');
			$rt_base_price_notes->setValue($form1_Values['rt_base_price_notes']);
			
			$before_rt_base_price_notes = new Zend_Form_Element_Text('before_rt_base_price_notes',array("readonly" => "readonly"));
			$before_rt_base_price_notes->setLabel('Base Price Notes');
		
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
		if(!empty($form1_Values['rt_price_as_tested']))
		{
			$rt_price_as_tested = new Zend_Form_Element_Text('rt_price_as_tested');
			$rt_price_as_tested->setValue($form1_Values['rt_price_as_tested'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_price_as_tested = new Zend_Form_Element_Text('before_rt_price_as_tested',array("readonly" => "readonly"));
			$before_rt_price_as_tested->setLabel('Price as Tested');
			
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
		
		if(!empty($form1_Values['rt_price_as_tested_notes']))
		{
			$rt_price_as_tested_notes = new Zend_Form_Element_Text('rt_price_as_tested_notes');
			$rt_price_as_tested_notes->setValue($form1_Values['rt_price_as_tested_notes']);
			
			$before_rt_price_as_tested_notes = new Zend_Form_Element_Text('before_rt_price_as_tested_notes',array("readonly" => "readonly"));
			$before_rt_price_as_tested_notes->setLabel('Price as Tested Notes');
			
			
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
		
		if(!empty($form1_Values['rt_controlled_type']))
		{
			$rt_controlled_type_prepared = $this->gatMultioptions("Type");
		
			$rt_controlled_type = new Zend_Form_Element_Select('rt_controlled_type',array('style'=>'width:150px;'));
			$rt_controlled_type->addMultiOptions($rt_controlled_type_prepared)
						->setValue($form1_Values['rt_controlled_type']);
						
			$before_rt_controlled_type = new Zend_Form_Element_Text('before_rt_controlled_type',array("readonly" => "readonly"));
			$before_rt_controlled_type->setLabel('Engine Type');
			
			
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
		
		if(!empty($form1_Values['rt_no_cyl']))
		{
			$rt_no_cyl = new Zend_Form_Element_Text('rt_no_cyl');
			$rt_no_cyl->setValue($form1_Values['rt_no_cyl']);
			
			$before_rt_no_cyl = new Zend_Form_Element_Text('before_rt_no_cyl',array("readonly" => "readonly"));
			$before_rt_no_cyl->setLabel('Number of Cylinders');
			
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
		if(!empty($form1_Values['rt3_bore_mm']))
		{
			$rt3_bore_mm = new Zend_Form_Element_Text('rt3_bore_mm');
			$rt3_bore_mm->setValue($form1_Values['rt3_bore_mm'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_bore_mm = new Zend_Form_Element_Text('before_rt3_bore_mm',array("readonly" => "readonly"));
			$before_rt3_bore_mm->setLabel('Cylinder Bore');
			
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
		
		if(!empty($form1_Values['rt3_stroke_mm']))
		{
			$rt3_stroke_mm = new Zend_Form_Element_Text('rt3_stroke_mm');
			$rt3_stroke_mm->setValue($form1_Values['rt3_stroke_mm'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt3_stroke_mm = new Zend_Form_Element_Text('before_rt3_stroke_mm',array("readonly" => "readonly"));
			$before_rt3_stroke_mm->setLabel('Cylinder Stroke');
			
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
		if(!empty($form1_Values['rt_disp_cc']))
		{
			$rt_disp_cc = new Zend_Form_Element_Text('rt_disp_cc');
			$rt_disp_cc->setValue($form1_Values['rt_disp_cc']);
			
			$before_rt_disp_cc = new Zend_Form_Element_Text('before_rt_disp_cc',array("readonly" => "readonly"));
			$before_rt_disp_cc->setLabel('Engine Disp')
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
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
		if(!empty($form1_Values['rt3_comp_ratio']))
		{
			$rt3_comp_ratio = new Zend_Form_Element_Text('rt3_comp_ratio');
			$rt3_comp_ratio->setValue($form1_Values['rt3_comp_ratio'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_comp_ratio = new Zend_Form_Element_Text('before_rt3_comp_ratio',array("readonly" => "readonly"));
			$before_rt3_comp_ratio->setLabel('Compression Ratio');
		
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
		
		if(!empty($form1_Values['rt2_fuel_sys']))
		{
			$rt2_fuel_sys = new Zend_Form_Element_Text('rt2_fuel_sys');
			$rt2_fuel_sys->setValue($form1_Values['rt2_fuel_sys']);
			
			$before_rt2_fuel_sys = new Zend_Form_Element_Text('before_rt2_fuel_sys',array("readonly" => "readonly"));
			$before_rt2_fuel_sys->setLabel('Fuel System');
			
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
		if(!empty($form1_Values['rt3_valve_gear']))
		{
			$rt3_valve_gear = new Zend_Form_Element_Text('rt3_valve_gear');
			$rt3_valve_gear->setValue($form1_Values['rt3_valve_gear']);
			
			$before_rt3_valve_gear = new Zend_Form_Element_Text('before_rt3_valve_gear',array("readonly" => "readonly"));
			$before_rt3_valve_gear->setLabel('Valve Setup');
			
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
		if(!empty($form1_Values['rt3_valves_per_cyl']))
		{
			$rt3_valves_per_cyl = new Zend_Form_Element_Text('rt3_valves_per_cyl');
			$rt3_valves_per_cyl->setValue($form1_Values['rt3_valves_per_cyl'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt3_valves_per_cyl = new Zend_Form_Element_Text('before_rt3_valves_per_cyl',array("readonly" => "readonly"));
			$before_rt3_valves_per_cyl->setLabel('Valves Per Cylinder');
			
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
		if(!empty($form1_Values['rt_controlled_turbo_superchg']))
		{
			$rt_controlled_turbo_superchg_prepared = $this->gatMultioptions("Turbo/Superchg");
		
			$rt_controlled_turbo_superchg = new Zend_Form_Element_Select('rt_controlled_turbo_superchg',array('style'=>'width:150px;'));
			$rt_controlled_turbo_superchg->addMultiOptions($rt_controlled_turbo_superchg_prepared)
						->setValue($form1_Values['rt_controlled_turbo_superchg']);
						
			$before_rt_controlled_turbo_superchg = new Zend_Form_Element_Text('before_rt_controlled_turbo_superchg',array("readonly" => "readonly"));
			$before_rt_controlled_turbo_superchg->setLabel('Forced Induction');
			
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
		
		if(!empty($form1_Values['rt3_boost_psi']))
		{
			$rt3_boost_psi = new Zend_Form_Element_Text('rt3_boost_psi');
			$rt3_boost_psi->setValue($form1_Values['rt3_boost_psi'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_boost_psi = new Zend_Form_Element_Text('before_rt3_boost_psi',array("readonly" => "readonly"));
			$before_rt3_boost_psi->setLabel('Boost in psi');
			
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
		if(!empty($form1_Values['rt_peak_hp']))
		{
			$rt_peak_hp = new Zend_Form_Element_Text('rt_peak_hp');
			$rt_peak_hp->setValue($form1_Values['rt_peak_hp'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_peak_hp = new Zend_Form_Element_Text('before_rt_peak_hp',array("readonly" => "readonly"));
			$before_rt_peak_hp->setLabel('Peak Horsepower');
			
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
		if(!empty($form1_Values['rt_rpm']))
		{
			$rt_rpm = new Zend_Form_Element_Text('rt_rpm');
			$rt_rpm->setValue($form1_Values['rt_rpm'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_rpm = new Zend_Form_Element_Text('before_rt_rpm',array("readonly" => "readonly"));
			$before_rt_rpm->setLabel('Peak Horsepower RPM');
			
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
		if(!empty($form1_Values['rt_peak_hp_notes']))
		{
			$rt_peak_hp_notes = new Zend_Form_Element_Text('rt_peak_hp_notes');
			$rt_peak_hp_notes->setValue($form1_Values['rt_peak_hp_notes']);
			
			$before_rt_peak_hp_notes = new Zend_Form_Element_Text('before_rt_peak_hp_notes',array("readonly" => "readonly"));
			$before_rt_peak_hp_notes->setLabel('Peak Horsepower Notes');
			
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
		if(!empty($form1_Values['rt_peak_torque']))
		{
			$rt_peak_torque = new Zend_Form_Element_Text('rt_peak_torque');
			$rt_peak_torque->setValue($form1_Values['rt_peak_torque'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_peak_torque = new Zend_Form_Element_Text('before_rt_peak_torque',array("readonly" => "readonly"));
			$before_rt_peak_torque->setLabel('Peak Torque');
			
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
		
		if(!empty($form1_Values['rt_rpmt']))
		{
			$rt_rpmt = new Zend_Form_Element_Text('rt_rpmt');
			$rt_rpmt->setValue($form1_Values['rt_rpmt']);
			
			$before_rt_rpmt = new Zend_Form_Element_Text('before_rt_rpmt',array("readonly" => "readonly"));
			$before_rt_rpmt->setLabel('Peak Torque RPM');
			
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
		if(!empty($form1_Values['rt_peak_torque_notes']))
		{
			$rt_peak_torque_notes = new Zend_Form_Element_Text('rt_peak_torque_notes');
			$rt_peak_torque_notes->setValue($form1_Values['rt_peak_torque_notes']);
			
			$before_rt_peak_torque_notes = new Zend_Form_Element_Text('before_rt_peak_torque_notes',array("readonly" => "readonly"));
			$before_rt_peak_torque_notes->setLabel('Peak Torque Notes');
			
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
		if(!empty($form1_Values['rt_redline']))
		{
			$rt_redline = new Zend_Form_Element_Text('rt_redline');
			$rt_redline->setValue($form1_Values['rt_redline']);
			
			$before_rt_redline = new Zend_Form_Element_Text('before_rt_redline',array("readonly" => "readonly"));
			$before_rt_redline->setLabel('Redline');
			
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
		if(!empty($form1_Values['rt3_specific_power']))
		{
			$rt3_specific_power = new Zend_Form_Element_Text('rt3_specific_power');
			$rt3_specific_power->setValue($form1_Values['rt3_specific_power'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_specific_power = new Zend_Form_Element_Text('before_rt3_specific_power',array("readonly" => "readonly"));
			$before_rt3_specific_power->setLabel('Spec pow (hp/liter)');
			
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
		if(!empty($form1_Values['rt_power_to_weight']))
		{
			$rt_power_to_weight = new Zend_Form_Element_Text('rt_power_to_weight');
			$rt_power_to_weight->setValue($form1_Values['rt_power_to_weight'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt_power_to_weight = new Zend_Form_Element_Text('before_rt_power_to_weight',array("readonly" => "readonly"));
			$before_rt_power_to_weight->setLabel('Power/Weight (hp/lb)');
			
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
		if(!empty($form1_Values['rt_controlled_transmission']))
		{
			$rt_controlled_transmission_prepared= $this->gatMultioptions("Transmission");
		
			$rt_controlled_transmission = new Zend_Form_Element_Select('rt_controlled_transmission',array('style'=>'width:150px;'));
			$rt_controlled_transmission->addMultiOptions($rt_controlled_transmission_prepared)
						->setValue($form1_Values['rt_controlled_transmission']);
						
			$before_rt_controlled_transmission = new Zend_Form_Element_Text('before_rt_controlled_transmission',array("readonly" => "readonly"));
			$before_rt_controlled_transmission->setLabel('Transmission Type');
		
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
		if(!empty($form1_Values['rt3_final_drive_ratio']))
		{
			$rt3_final_drive_ratio = new Zend_Form_Element_Text('rt3_final_drive_ratio');
			$rt3_final_drive_ratio->setValue($form1_Values['rt3_final_drive_ratio']);
			
			$before_rt3_final_drive_ratio = new Zend_Form_Element_Text('before_rt3_final_drive_ratio',array("readonly" => "readonly"));
			$before_rt3_final_drive_ratio->setLabel('Final Drive');
			
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
		if(!empty($form1_Values['rt3_max_mph_1000_rpm']))
		{
			$rt3_max_mph_1000_rpm = new Zend_Form_Element_Text('rt3_max_mph_1000_rpm');
			$rt3_max_mph_1000_rpm->setValue($form1_Values['rt3_max_mph_1000_rpm'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_max_mph_1000_rpm = new Zend_Form_Element_Text('before_rt3_max_mph_1000_rpm',array("readonly" => "readonly"));
			$before_rt3_max_mph_1000_rpm->setLabel('Top Gear mph/1000rpm');
			
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
		if(!empty($form1_Values['rt3_wheelbase']))
		{
			$rt3_wheelbase = new Zend_Form_Element_Text('rt3_wheelbase');
			$rt3_wheelbase->setValue($form1_Values['rt3_wheelbase'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_wheelbase = new Zend_Form_Element_Text('before_rt3_wheelbase',array("readonly" => "readonly"));
			$before_rt3_wheelbase->setLabel('Wheelbase');
			
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
		
		if(!empty($form1_Values['rt3_length']))
		{
			$rt3_length = new Zend_Form_Element_Text('rt3_length');
			$rt3_length->setValue($form1_Values['rt3_length'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_length = new Zend_Form_Element_Text('before_rt3_length',array("readonly" => "readonly"));
			$before_rt3_length->setLabel('Length');
			
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
		if(!empty($form1_Values['rt3_width']))
		{
			$rt3_width = new Zend_Form_Element_Text('rt3_width');
			$rt3_width->setValue($form1_Values['rt3_width'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_width = new Zend_Form_Element_Text('before_rt3_width',array("readonly" => "readonly"));
			$before_rt3_width->setLabel('Width');
			
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
		if(!empty($form1_Values['rt3_height']))
		{
			$rt3_height = new Zend_Form_Element_Text('rt3_height');
			$rt3_height->setValue($form1_Values['rt3_height']);
			
			$before_rt3_height = new Zend_Form_Element_Text('before_rt3_height',array("readonly" => "readonly"));
			$before_rt3_height->setLabel('Height');
			
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
		if(!empty($form1_Values['rt3_frontal_area']))
		{
			$rt3_frontal_area = new Zend_Form_Element_Text('rt3_frontal_area');
			$rt3_frontal_area->setValue($form1_Values['rt3_frontal_area']);
			
			$before_rt3_frontal_area = new Zend_Form_Element_Text('before_rt3_frontal_area',array("readonly" => "readonly"));
			$before_rt3_frontal_area->setLabel('Frontal Area');
			
		
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
		
		if(!empty($form1_Values['rt3_frontal_area_notes']))
		{
			$rt3_frontal_area_notes = new Zend_Form_Element_Text('rt3_frontal_area_notes');
			$rt3_frontal_area_notes->setValue($form1_Values['rt3_frontal_area_notes']);
			
			$before_rt3_frontal_area_notes = new Zend_Form_Element_Text('before_rt3_frontal_area_notes',array("readonly" => "readonly"));
			$before_rt3_frontal_area_notes->setLabel('Frontal Area Notes');
			
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
		if(!empty($form1_Values['rt3_cd']))
		{
			$rt3_cd = new Zend_Form_Element_Text('rt3_cd');
			$rt3_cd->setValue($form1_Values['rt3_cd']);
			
			$before_rt3_cd = new Zend_Form_Element_Text('before_rt3_cd',array("readonly" => "readonly"));
			$before_rt3_cd->setLabel('Coefficient of Drag');
			
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
		if(!empty($form1_Values['rt_weight']))
		{
			$rt_weight = new Zend_Form_Element_Text('rt_weight');
			$rt_weight->setValue($form1_Values['rt_weight'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_weight = new Zend_Form_Element_Text('before_rt_weight',array("readonly" => "readonly"));
			$before_rt_weight->setLabel('Curb Weight');
			
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
		if(!empty($form1_Values['rt_percent_on_front']))
		{
			$rt_percent_on_front = new Zend_Form_Element_Text('rt_percent_on_front');
			$rt_percent_on_front->setValue($form1_Values['rt_percent_on_front'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');

			$before_rt_percent_on_front = new Zend_Form_Element_Text('before_rt_percent_on_front',array("readonly" => "readonly"));
			$before_rt_percent_on_front->setLabel('Pct. Weight on Front');
			
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
		if(!empty($form1_Values['rt_percent_on_rear']))
		{
			$rt_percent_on_rear = new Zend_Form_Element_Text('rt_percent_on_rear');
			$rt_percent_on_rear->setValue($form1_Values['rt_percent_on_rear'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');

			$before_rt_percent_on_rear = new Zend_Form_Element_Text('before_rt_percent_on_rear',array("readonly" => "readonly"));
			$before_rt_percent_on_rear->setLabel('Pct. Weight on Rear');
			
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
		if(!empty($form1_Values['rt2_controlled_airbags']))
		{
			$rt_controlled_airbags_prepared = $this->gatMultioptions("Airbags");
			
			$rt2_controlled_airbags = new Zend_Form_Element_Select('rt2_controlled_airbags',array('style'=>'width:150px;'));
			$rt2_controlled_airbags->addMultiOptions($rt_controlled_airbags_prepared)
						->setValue($form1_Values['rt2_controlled_airbags']);
						
			$before_rt2_controlled_airbags = new Zend_Form_Element_Text('before_rt2_controlled_airbags',array("readonly" => "readonly"));
			$before_rt2_controlled_airbags->setLabel('Listing of Airbag Positions');
			
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
		if(!empty($form1_Values['rt2_int_vol_front']))
		{
			$rt2_int_vol_front = new Zend_Form_Element_Text('rt2_int_vol_front');
			$rt2_int_vol_front->setValue($form1_Values['rt2_int_vol_front']);
			
			$before_rt2_int_vol_front = new Zend_Form_Element_Text('before_rt2_int_vol_front',array("readonly" => "readonly"));
			$before_rt2_int_vol_front->setLabel('Interior Volume Front');
			
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
		if(!empty($form1_Values['rt2_mid']))
		{
			$rt2_mid = new Zend_Form_Element_Text('rt2_mid');
			$rt2_mid->setValue($form1_Values['rt2_mid'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt2_mid = new Zend_Form_Element_Text('before_rt2_mid',array("readonly" => "readonly"));
			$before_rt2_mid->setLabel('Vol Behind Mid Row');
			
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
		if(!empty($form1_Values['rt2_rear']))
		{
			$rt2_rear = new Zend_Form_Element_Text('rt2_rear');
			$rt2_rear->setValue($form1_Values['rt2_rear']);
			
			$before_rt2_rear = new Zend_Form_Element_Text('before_rt2_rear',array("readonly" => "readonly"));
			$before_rt2_rear->setLabel('Vol Behind Rear Row');
			
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
		if(!empty($form1_Values['rt3_trunk']))
		{
			$rt3_trunk = new Zend_Form_Element_Text('rt3_trunk');
			$rt3_trunk->setValue($form1_Values['rt3_trunk']);
			
			$before_rt3_trunk = new Zend_Form_Element_Text('before_rt3_trunk',array("readonly" => "readonly"));
			$before_rt3_trunk->setLabel('Trunk Volume');
		
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
		if(!empty($form1_Values['rt2_turning_cir']))
		{
			$rt2_turning_cir = new Zend_Form_Element_Text('rt2_turning_cir');
			$rt2_turning_cir->setValue($form1_Values['rt2_turning_cir'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt2_turning_cir = new Zend_Form_Element_Text('before_rt2_turning_cir',array("readonly" => "readonly"));
			$before_rt2_turning_cir->setLabel('Turning Radius');
			
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
		if(!empty($form1_Values['rt2_anti_lock']))
		{
			$rt2_anti_lock = new Zend_Form_Element_Select('rt2_anti_lock',array('style'=>'width:150px;'));
			$rt2_anti_lock->addMultioptions(array('0'=>'No','1'=>'Yes'));
			$rt2_anti_lock->setValue($form1_Values['rt2_anti_lock']);
			
			$before_rt2_anti_lock = new Zend_Form_Element_Text('before_rt2_anti_lock',array("readonly" => "readonly"));
			$before_rt2_anti_lock->setLabel('Anti-Lock Brakes?');
			
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
		if(!empty($form1_Values['rt2_traction_control']))
		{
			$rt2_traction_control = new Zend_Form_Element_Select('rt2_traction_control',array('style'=>'width:150px;'));
			$rt2_traction_control->addMultioptions(array('0'=>'No','1'=>'Yes'));
			$rt2_traction_control->setValue($form1_Values['rt2_traction_control']);
			
			$before_rt2_traction_control = new Zend_Form_Element_Text('before_rt2_traction_control',array("readonly" => "readonly"));
			$before_rt2_traction_control->setLabel('Traction Control');
			
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
		if(!empty($form1_Values['rt2_trac_defeatable']))
		{
			$rt2_trac_defeatable = new Zend_Form_Element_Select('rt2_trac_defeatable',array('style'=>'width:150px;'));
			$rt2_trac_defeatable->addMultioptions(array('0'=>'No','1'=>'Yes'));
			$rt2_trac_defeatable->setValue($form1_Values['rt2_trac_defeatable']);
			
			$before_rt2_trac_defeatable = new Zend_Form_Element_Text('before_rt2_trac_defeatable',array("readonly" => "readonly"));
			$before_rt2_trac_defeatable->setLabel('Tc Defeatable?');
		
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
		if(!empty($form1_Values['rt2_stability_control']))
		{
			$rt2_stability_control = new Zend_Form_Element_Select('rt2_stability_control',array('style'=>'width:150px;'));
			$rt2_stability_control->addMultioptions(array('0'=>'No','1'=>'Yes'));
			$rt2_stability_control->setValue($form1_Values['rt2_stability_control']);
			
			$before_rt2_stability_control = new Zend_Form_Element_Text('before_rt2_stability_control',array("readonly" => "readonly"));
			$before_rt2_stability_control->setLabel('Stability Control');
			
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
		if(!empty($form1_Values['rt2_stab_defeatable']))
		{
			$rt2_stab_defeatable = new Zend_Form_Element_Text('rt2_stab_defeatable');
			$rt2_stab_defeatable->setValue($form1_Values['rt2_stab_defeatable']);
			
			$before_rt2_stab_defeatable = new Zend_Form_Element_Text('before_rt2_stab_defeatable',array("readonly" => "readonly"));
			$before_rt2_stab_defeatable->setLabel('Esc Defeatable?');
		
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
		
		if(!empty($form1_Values['rt3_10mph']))
		{
			$rt3_10mph = new Zend_Form_Element_Text('rt3_10mph');
			$rt3_10mph->setValue($form1_Values['rt3_10mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_10mph = new Zend_Form_Element_Text('before_rt3_10mph',array("readonly" => "readonly"));
			$before_rt3_10mph->setLabel('0-10 Accel');
		
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
		
		if(!empty($form1_Values['rt3_20mph']))
		{
			$rt3_20mph = new Zend_Form_Element_Text('rt3_20mph');
			$rt3_20mph->setValue($form1_Values['rt3_20mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_20mph = new Zend_Form_Element_Text('before_rt3_20mph',array("readonly" => "readonly"));
			$before_rt3_20mph->setLabel('0-20 Accel');
			
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
		if(!empty($form1_Values['rt2_30_mph']))
		{
			$rt2_30mph = new Zend_Form_Element_Text('rt2_30_mph');
			$rt2_30mph->setValue($form1_Values['rt2_30_mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
		
			$before_rt2_30mph = new Zend_Form_Element_Text('before_rt2_30mph',array("readonly" => "readonly"));
			$before_rt2_30mph->setLabel('0-30 Accel');
			
			
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
		if(!empty($form1_Values['rt3_40mph']))
		{
			$rt3_40mph = new Zend_Form_Element_Text('rt3_40mph');
			$rt3_40mph->setValue($form1_Values['rt3_40mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_40mph = new Zend_Form_Element_Text('before_rt3_40mph',array("readonly" => "readonly"));
			$before_rt3_40mph->setLabel('0-40 Accel');
			
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
		if(!empty($form1_Values['rt3_50mph']))
		{
			$rt3_50mph = new Zend_Form_Element_Text('rt3_50mph');
			$rt3_50mph->setValue($form1_Values['rt3_50mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_50mph = new Zend_Form_Element_Text('before_rt3_50mph',array("readonly" => "readonly"));
			$before_rt3_50mph->setLabel('0-50 Accel');
			
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
		if(!empty($form1_Values['rt_60_mph']))
		{
			$rt_60mph = new Zend_Form_Element_Text('rt_60_mph');
			$rt_60mph->setValue($form1_Values['rt_60_mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt_60mph = new Zend_Form_Element_Text('before_rt_60mph',array("readonly" => "readonly"));
			$before_rt_60mph->setLabel('0-50 Accel');
			
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
		if(!empty($form1_Values['rt3_70mph']))
		{
			$rt3_70mph = new Zend_Form_Element_Text('rt3_70mph');
			$rt3_70mph->setValue($form1_Values['rt3_70mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_70mph = new Zend_Form_Element_Text('before_rt3_70mph',array("readonly" => "readonly"));
			$before_rt3_70mph->setLabel('0-70 Accel');
			
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
		if(!empty($form1_Values['rt3_80mph']))
		{
			$rt3_80mph = new Zend_Form_Element_Text('rt3_80mph');
			$rt3_80mph->setValue($form1_Values['rt3_80mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_80mph = new Zend_Form_Element_Text('before_rt3_80mph',array("readonly" => "readonly"));
			$before_rt3_80mph->setLabel('0-80 Accel');
		
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
		if(!empty($form1_Values['rt3_90mph']))
		{
			$rt3_90mph = new Zend_Form_Element_Text('rt3_90mph');
			$rt3_90mph->setValue($form1_Values['rt3_90mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_90mph = new Zend_Form_Element_Text('before_rt3_90mph',array("readonly" => "readonly"));
			$before_rt3_90mph->setLabel('0-90Accel');
			
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
		if(!empty($form1_Values['rt2_100_mph']))
		{
			$rt2_100mph = new Zend_Form_Element_Text('rt2_100_mph');
			$rt2_100mph->setValue($form1_Values['rt2_100_mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt2_100mph = new Zend_Form_Element_Text('before_rt2_100mph',array("readonly" => "readonly"));
			$before_rt2_100mph->setLabel('0-100Accel');
			
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
		if(!empty($form1_Values['rt3_110mph']))
		{
			$rt3_110mph = new Zend_Form_Element_Text('rt3_110mph');
			$rt3_110mph->setValue($form1_Values['rt3_110mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_110mph = new Zend_Form_Element_Text('before_rt3_110mph',array("readonly" => "readonly"));
			$before_rt3_110mph->setLabel('0-110Accel');
			
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
		if(!empty($form1_Values['rt3_120mph']))
		{
			$rt3_120mph = new Zend_Form_Element_Text('rt3_120mph');
			$rt3_120mph->setValue($form1_Values['rt3_120mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_120mph = new Zend_Form_Element_Text('before_rt3_120mph',array("readonly" => "readonly"));
			$before_rt3_120mph->setLabel('0-120Accel');
			
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
		if(!empty($form1_Values['rt2_130_mph']))
		{
			$rt2_130mph = new Zend_Form_Element_Text('rt2_130_mph');
			$rt2_130mph->setValue($form1_Values['rt2_130_mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt2_130mph = new Zend_Form_Element_Text('before_rt2_130mph',array("readonly" => "readonly"));
			$before_rt2_130mph->setLabel('0-130 Accel');
			
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
		if(!empty($form1_Values['rt3_140mph']))
		{
			$rt3_140mph = new Zend_Form_Element_Text('rt3_140mph');
			$rt3_140mph->setValue($form1_Values['rt3_140mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_140mph = new Zend_Form_Element_Text('before_rt3_140mph',array("readonly" => "readonly"));
			$before_rt3_140mph->setLabel('0-140 Accel');
			
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
		if(!empty($form1_Values['rt3_150mph']))
		{
			$rt3_150mph = new Zend_Form_Element_Text('rt3_150mph');
			$rt3_150mph->setValue($form1_Values['rt3_150mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_150mph = new Zend_Form_Element_Text('before_rt3_150mph',array("readonly" => "readonly"));
			$before_rt3_150mph->setLabel('0-150 Accel');
			
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
		if(!empty($form1_Values['rt3_160mph']))
		{
			$rt3_160mph = new Zend_Form_Element_Text('rt3_160mph');
			$rt3_160mph->setValue($form1_Values['rt3_160mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_160mph = new Zend_Form_Element_Text('before_rt3_160mph',array("readonly" => "readonly"));
			$before_rt3_160mph->setLabel('0-160 Accel');
		
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
		if(!empty($form1_Values['rt3_170mph']))
		{
			$rt3_170mph = new Zend_Form_Element_Text('rt3_170mph');
			$rt3_170mph->setValue($form1_Values['rt3_170mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_170mph = new Zend_Form_Element_Text('before_rt3_170mph',array("readonly" => "readonly"));
			$before_rt3_170mph->setLabel('0-170 Accel');
			
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
		
		if(!empty($form1_Values['rt3_180mph']))
		{
			$rt3_180mph = new Zend_Form_Element_Text('rt3_180mph');
			$rt3_180mph->setValue($form1_Values['rt3_180mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_180mph = new Zend_Form_Element_Text('before_rt3_180mph',array("readonly" => "readonly"));
			$before_rt3_180mph->setLabel('0-180 Accel');
			
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

		if(!empty($form1_Values['rt3_190mph']))
		{
			$rt3_190mph = new Zend_Form_Element_Text('rt3_190mph');
			$rt3_190mph->setValue($form1_Values['rt3_190mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_190mph = new Zend_Form_Element_Text('before_rt3_190mph',array("readonly" => "readonly"));
			$before_rt3_190mph->setLabel('0-190 Accel');
			
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
		
		if(!empty($form1_Values['rt3_200mph']))
		{
			$rt3_200mph = new Zend_Form_Element_Text('rt3_200mph');
			$rt3_200mph->setValue($form1_Values['rt3_200mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_200mph = new Zend_Form_Element_Text('before_rt3_200mph',array("readonly" => "readonly"));
			$before_rt3_200mph->setLabel('0-200 Accel');
			
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
		if(!empty($form1_Values['rt_ss60']))
		{
			$rt_ss60 = new Zend_Form_Element_Text('rt_ss60');
			$rt_ss60->setValue($form1_Values['rt_ss60'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt_ss60 = new Zend_Form_Element_Text('before_rt_ss60',array("readonly" => "readonly"));
			$before_rt_ss60->setLabel('5-60 ss Accel');
			
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
		
		if(!empty($form1_Values['rt2_30_50TG']))
		{
			$rt2_30_50TG = new Zend_Form_Element_Text('rt2_30_50TG');
			$rt2_30_50TG->setValue($form1_Values['rt2_30_50TG'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt2_30_50TG = new Zend_Form_Element_Text('before_rt2_30_50TG',array("readonly" => "readonly"));
			$before_rt2_30_50TG->setLabel('Top-Gear Accel 30-50');
			
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
		if(!empty($form1_Values['rt2_50_70TG']))
		{
			$rt2_50_70TG = new Zend_Form_Element_Text('rt2_50_70TG');
			$rt2_50_70TG->setValue($form1_Values['rt2_50_70TG'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt2_50_70TG = new Zend_Form_Element_Text('before_rt2_50_70TG',array("readonly" => "readonly"));
			$before_rt2_50_70TG->setLabel('Top-Gear Accel 50-70');
		
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
		if(!empty($form1_Values['rt2_sum_of_tg_times']))
		{
			$rt2_sum_of_tg_times = new Zend_Form_Element_Text('rt2_sum_of_tg_times');
			$rt2_sum_of_tg_times->setValue($form1_Values['rt2_sum_of_tg_times'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt2_sum_of_tg_times = new Zend_Form_Element_Text('before_rt2_sum_of_tg_times',array("readonly" => "readonly"));
			$before_rt2_sum_of_tg_times->setLabel('Sum of the above 2');
			
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
		if(!empty($form1_Values['rt_quarter_time']))
		{
			$rt_quarter_time = new Zend_Form_Element_Text('rt_quarter_time');
			$rt_quarter_time->setValue($form1_Values['rt_quarter_time'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt_quarter_time = new Zend_Form_Element_Text('before_rt_quarter_time',array("readonly" => "readonly"));
			$before_rt_quarter_time->setLabel('Quarter Mile Time');
		
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
		if(!empty($form1_Values['rt_speed_qtr_mile_speed_trap']))
		{
			$rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Text('rt_speed_qtr_mile_speed_trap');
			$rt_speed_qtr_mile_speed_trap->setValue($form1_Values['rt_speed_qtr_mile_speed_trap'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Text('before_rt_speed_qtr_mile_speed_trap',array("readonly" => "readonly"));
			$before_rt_speed_qtr_mile_speed_trap->setLabel('Quarter Trap Speed');
			
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
		if(!empty($form1_Values['rt_top_speed']))
		{
			$rt_top_speed = new Zend_Form_Element_Text('rt_top_speed');
			$rt_top_speed->setValue($form1_Values['rt_top_speed'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_top_speed = new Zend_Form_Element_Text('before_rt_top_speed',array("readonly" => "readonly"));
			$before_rt_top_speed->setLabel('Top Speed');
		
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
		
		if(!empty($form1_Values['rt_controlled_ts_limit']))
		{
			$rt_controlled_ts_limit_prepared = $this->gatMultioptions("TS limit");
		
			$rt_controlled_ts_limit = new Zend_Form_Element_Select('rt_controlled_ts_limit',array('style'=>'width:150px;'));
			$rt_controlled_ts_limit->addMultiOptions($rt_controlled_ts_limit_prepared)
						->setValue($form1_Values['rt_controlled_ts_limit']);
						
			$before_rt_controlled_ts_limit = new Zend_Form_Element_Text('before_rt_controlled_ts_limit',array("readonly" => "readonly"));
			$before_rt_controlled_ts_limit->setLabel('Top Speed Limit');
			
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
		
		if(!empty($form1_Values['rt_top_speed_notes']))
		{
			$rt_top_speed_notes = new Zend_Form_Element_Text('rt_top_speed_notes');
			$rt_top_speed_notes->setValue($form1_Values['rt_top_speed_notes']);
			
			$before_rt_top_speed_notes = new Zend_Form_Element_Text('before_rt_top_speed_notes',array("readonly" => "readonly"));
			$before_rt_top_speed_notes->setLabel('Top Speed Notes');
			
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
		if(!empty($form1_Values['rt_70_mph_braking']))
		{
			$rt_70_mph_braking = new Zend_Form_Element_Text('rt_70_mph_braking');
			$rt_70_mph_braking->setValue($form1_Values['rt_70_mph_braking'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_70_mph_braking = new Zend_Form_Element_Text('before_rt_70_mph_braking',array("readonly" => "readonly"));
			$before_rt_70_mph_braking->setLabel('Braking from 70');
			
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
		if(!empty($form1_Values['rt2_skidpad']))
		{
			$rt2_skidpad = new Zend_Form_Element_Text('rt2_skidpad');
			$rt2_skidpad->setValue($form1_Values['rt2_skidpad']);
			
			$before_rt2_skidpad = new Zend_Form_Element_Text('before_rt2_skidpad',array("readonly" => "readonly"));
			$before_rt2_skidpad->setLabel('Skidpad');
		
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
			
			$this->addElements(array($before_rt2_skidpad,$rt2_skidpad));
		}
		if(!empty($form1_Values['rt2_emergency_lane_change']))
		{
			$rt2_emergency_lane_change = new Zend_Form_Element_Text('rt2_emergency_lane_change');
			$rt2_emergency_lane_change->setValue($form1_Values['rt2_emergency_lane_change'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt2_emergency_lane_change = new Zend_Form_Element_Text('before_rt2_emergency_lane_change',array("readonly" => "readonly"));
			$before_rt2_emergency_lane_change->setLabel('MPH in Lane Change');
		
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
		if(!empty($form1_Values['rt_slalom']))
		{
			$rt_slalom = new Zend_Form_Element_Text('rt_slalom');
			$rt_slalom->setValue($form1_Values['rt_slalom'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt_slalom = new Zend_Form_Element_Text('before_rt_slalom',array("readonly" => "readonly"));
			$before_rt_slalom->setLabel('Slalom Speed');
		
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
		if(!empty($form1_Values['rt_controlled_fuel']))
		{
			$rt_controlled_fuel_prepared = $this->gatMultioptions("Fuel");
		
			$rt_controlled_fuel = new Zend_Form_Element_Select('rt_controlled_fuel',array('style'=>'width:150px;'));
			$rt_controlled_fuel->addMultiOptions($rt_controlled_fuel_prepared)
						->setValue($form1_Values['rt_controlled_fuel']);
			
			$before_rt_controlled_fuel = new Zend_Form_Element_Text('before_rt_controlled_fuel',array("readonly" => "readonly"));
			$before_rt_controlled_fuel->setLabel('Fuel Type');
			
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
		if(!empty($form1_Values['rt3_fuel_cap']))
		{
			$rt3_fuel_cap = new Zend_Form_Element_Text('rt3_fuel_cap');
			$rt3_fuel_cap->setValue($form1_Values['rt3_fuel_cap'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_fuel_cap = new Zend_Form_Element_Text('before_rt3_fuel_cap',array("readonly" => "readonly"));
			$before_rt3_fuel_cap->setLabel('Fuel Capacity');
		
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
		if(!empty($form1_Values['rt2_epa_city_fe']))
		{
			$rt2_epa_city_fe = new Zend_Form_Element_Text('rt2_epa_city_fe');
			$rt2_epa_city_fe->setValue($form1_Values['rt2_epa_city_fe'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt2_epa_city_fe = new Zend_Form_Element_Text('before_rt2_epa_city_fe',array("readonly" => "readonly"));
			$before_rt2_epa_city_fe->setLabel('EPA City');
			
		
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
		
		if(!empty($form1_Values['rt2_epa_city_fe_notes']))
		{
			$rt2_epa_city_fe_notes = new Zend_Form_Element_Text('rt2_epa_city_fe_notes');
			$rt2_epa_city_fe_notes->setValue($form1_Values['rt2_epa_city_fe_notes']);
			
			$before_rt2_epa_city_fe_notes = new Zend_Form_Element_Text('before_rt2_epa_city_fe_notes',array("readonly" => "readonly"));
			$before_rt2_epa_city_fe_notes->setLabel('EPA City Notes');
		
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
		if(!empty($form1_Values['rt2_highway_fe']))
		{
			$rt2_highway_fe = new Zend_Form_Element_Text('rt2_highway_fe');
			$rt2_highway_fe->setValue($form1_Values['rt2_highway_fe'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt2_highway_fe = new Zend_Form_Element_Text('before_rt2_highway_fe',array("readonly" => "readonly"));
			$before_rt2_highway_fe->setLabel('EPA Highway');
		
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
		
		if(!empty($form1_Values['rt2_highway_fe_notes']))
		{
			$rt2_highway_fe_notes = new Zend_Form_Element_Text('rt2_highway_fe_notes');
			$rt2_highway_fe_notes->setValue($form1_Values['rt2_highway_fe_notes']);
			
			$before_rt2_highway_fe_notes = new Zend_Form_Element_Text('before_rt2_highway_fe_notes',array("readonly" => "readonly"));
			$before_rt2_highway_fe_notes->setLabel('EPA HIghway Notes');
			
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
		if(!empty($form1_Values['rt_cd_observed_fe']))
		{
			$rt_cd_observed_fe = new Zend_Form_Element_Text('rt_cd_observed_fe');
			$rt_cd_observed_fe->setValue($form1_Values['rt_cd_observed_fe'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt_cd_observed_fe = new Zend_Form_Element_Text('before_rt_cd_observed_fe',array("readonly" => "readonly"));
			$before_rt_cd_observed_fe->setLabel('C/D Observed Economy');
		
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
		
		if(!empty($form1_Values['rt2_sound_level_idle']))
		{
			$rt2_sound_level_idle = new Zend_Form_Element_Text('rt2_sound_level_idle');
			$rt2_sound_level_idle->setValue($form1_Values['rt2_sound_level_idle'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt2_sound_level_idle = new Zend_Form_Element_Text('before_rt2_sound_level_idle',array("readonly" => "readonly"));
			$before_rt2_sound_level_idle->setLabel('Sound Level Idle');
		
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
		if(!empty($form1_Values['rt2_wot']))
		{
			$rt2_wot = new Zend_Form_Element_Text('rt2_wot');
			$rt2_wot->setValue($form1_Values['rt2_wot'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt2_wot = new Zend_Form_Element_Text('before_rt2_wot',array("readonly" => "readonly"));
			$before_rt2_wot->setLabel('DB at Wot');
			
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
		if(!empty($form1_Values['rt2_70cr']))
		{
			$rt2_70cr = new Zend_Form_Element_Text('rt2_70cr');
			$rt2_70cr->setValue($form1_Values['rt2_70cr'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt2_70cr = new Zend_Form_Element_Text('before_rt2_70cr',array("readonly" => "readonly"));
			$before_rt2_70cr->setLabel('DB at 70 MPH Cruise');
			
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
		
		if(!empty($form1_Values['rt3_70co']))
		{
			$rt3_70co = new Zend_Form_Element_Text('rt3_70co');
			$rt3_70co->setValue($form1_Values['rt3_70co'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt3_70co = new Zend_Form_Element_Text('before_rt3_70co',array("readonly" => "readonly"));
			$before_rt3_70co->setLabel('BD at 70 Coast');
		
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
		if(!empty($form1_Values['rt3_lt_oil']))
		{
			$rt3_lt_oil = new Zend_Form_Element_Text('rt3_lt_oil');
			$rt3_lt_oil->setValue($form1_Values['rt3_lt_oil'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt3_lt_oil = new Zend_Form_Element_Text('before_rt3_lt_oil',array("readonly" => "readonly"));
			$before_rt3_lt_oil->setLabel('Long-term Oil Used');
		
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
		if(!empty($form1_Values['rt3_lt_stps_sched']))
		{
			$rt3_lt_stps_sched = new Zend_Form_Element_Text('rt3_lt_stps_sched');
			$rt3_lt_stps_sched->setValue($form1_Values['rt3_lt_stps_sched'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt3_lt_stps_sched = new Zend_Form_Element_Text('before_rt3_lt_stps_sched',array("readonly" => "readonly"));
			$before_rt3_lt_stps_sched->setLabel('LT Scheduled Stops');
			
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
		
		if(!empty($form1_Values['rt3_lt_stps_unsched']))
		{
			$rt3_lt_stps_unsched = new Zend_Form_Element_Text('rt3_lt_stps_unsched');
			$rt3_lt_stps_unsched->setValue($form1_Values['rt3_lt_stps_unsched'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt3_lt_stps_unsched = new Zend_Form_Element_Text('before_rt3_lt_stps_unsched',array("readonly" => "readonly"));
			$before_rt3_lt_stps_unsched->setLabel('LT Unscheduled Stops');
		
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
		if(!empty($form1_Values['rt3_lt_serv']))
		{
			$rt3_lt_serv = new Zend_Form_Element_Text('rt3_lt_serv');
			$rt3_lt_serv->setValue($form1_Values['rt3_lt_serv'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt3_lt_serv = new Zend_Form_Element_Text('before_rt3_lt_serv',array("readonly" => "readonly"));
			$before_rt3_lt_serv->setLabel('Costs for LT Service');
			
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
		
		if(!empty($form1_Values['rt3_lt_wear']))
		{
			$rt3_lt_wear = new Zend_Form_Element_Text('rt3_lt_wear');
			$rt3_lt_wear->setValue($form1_Values['rt3_lt_wear'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt3_lt_wear = new Zend_Form_Element_Text('before_rt3_lt_wear',array("readonly" => "readonly"));
			$before_rt3_lt_wear->setLabel('Costs for LT Wear');
		
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
		if(!empty($form1_Values['rt3_lt_repair']))
		{
			$rt3_lt_repiar = new Zend_Form_Element_Text('rt3_lt_repair');
			$rt3_lt_repiar->setValue($form1_Values['rt3_lt_repair'])
			->setAttrib('onkeydown' ,'return onlyDigits(event);');
			
			$before_rt3_lt_repiar = new Zend_Form_Element_Text('before_rt3_lt_repair',array("readonly" => "readonly"));
			$before_rt3_lt_repiar->setLabel('Costs for LT Repair');
			
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
	if(!empty($form1_Values['rt2_50_mph']))
		{
			$rt2_50_mph = new Zend_Form_Element_Text('rt2_50_mph');
			$rt2_50_mph->setValue($form1_Values['rt2_50_mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt2_50_mph = new Zend_Form_Element_Text('before_rt2_50_mph',array("readonly" => "readonly"));
			$before_rt2_50_mph->setLabel('rt2_50_mph');
			
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
		
		
		
		if(!empty($form1_Values['rt2_70_mph']))
		{
			$rt2_70_mph = new Zend_Form_Element_Text('rt2_70_mph');
			$rt2_70_mph->setValue($form1_Values['rt2_70_mph'])
			->setAttrib('onkeydown' ,'return onlyFloat(event, this.value);');
			
			$before_rt2_70_mph = new Zend_Form_Element_Text('before_rt2_70_mph',array("readonly" => "readonly"));
			$before_rt2_70_mph->setLabel('rt2_70_mph');
			
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
		if(!empty($form1_Values['rt3_et_factor']))
		{
			$rt3_et_factor = new Zend_Form_Element_Text('rt3_et_factor');
			$rt3_et_factor->setValue($form1_Values['rt3_et_factor']);
			
			$before_rt3_et_factor = new Zend_Form_Element_Text('before_rt3_et_factor',array("readonly" => "readonly"));
			$before_rt3_et_factor->setLabel('rt3_et_factor');
		
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
		
		if(!empty($form1_Values['rt3_road_hp_30mph']))
		{
			$rt3_road_hp_30mph = new Zend_Form_Element_Text('rt3_road_hp_30mph');
			$rt3_road_hp_30mph->setValue($form1_Values['rt3_road_hp_30mph']);
			
			$before_rt3_road_hp_30mph = new Zend_Form_Element_Text('before_rt3_road_hp_30mph',array("readonly" => "readonly"));
			$before_rt3_road_hp_30mph->setLabel('rt3_road_hp_30mph');
			
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
		
		if(!empty($form1_Values['rt3_sp_factor']))
		{
			$rt3_sp_factor = new Zend_Form_Element_Text('rt3_sp_factor');
			$rt3_sp_factor->setValue($form1_Values['rt3_sp_factor']);
			
			$before_rt3_sp_factor = new Zend_Form_Element_Text('before_rt3_sp_factor',array("readonly" => "readonly"));
			$before_rt3_sp_factor->setLabel('rt3_sp_factor');
			
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
		
		if(!empty($form1_Values['rt3_peak_bmep']))
		{
			$rt3_peak_bmep = new Zend_Form_Element_Text('rt3_peak_bmep');
			$rt3_peak_bmep->setValue($form1_Values['rt3_peak_bmep']);
			
			$before_rt3_peak_bmep = new Zend_Form_Element_Text('before_rt3_peak_bmep',array("readonly" => "readonly"));
			$before_rt3_peak_bmep->setLabel('rt3_peak_bmep');
			
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
		
		if(!empty($form1_Values['rt3_peal_bmep']))
		{
			$rt3_peal_bmep = new Zend_Form_Element_Text('rt3_peal_bmep');
			$rt3_peal_bmep->setValue($form1_Values['rt3_peal_bmep']);
			
			$before_rt3_peal_bmep = new Zend_Form_Element_Text('before_rt3_peal_bmep',array("readonly" => "readonly"));
			$before_rt3_peal_bmep->setLabel('rt3_peal_bmep');
		
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
		if(!empty($form1_Values['bg_controlled_make_id']))
		{
			//$bg_controlled_make_ids_prepared[0]= "Select from list";
			$bg_controlled_make_id = new Zend_Form_Element_Text('bg_controlled_make_id',array('style'=>'width:150px;'));
			$bg_controlled_make_id->setValue($form1_Values['bg_controlled_make_id']);
			
			$before_bg_controlled_make_id = new Zend_Form_Element_Text('before_bg_controlled_make_id',array("readonly" => "readonly"));
			$before_bg_controlled_make_id->setLabel('bg_cont_make_id');
			
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
		
		
		if(!empty($form1_Values['bg_controlled_model_id']))
		{
			//$bg_controlled_model_ids_prepared[0]= "Select from list";
			$bg_controlled_model_id = new Zend_Form_Element_Text('bg_controlled_model_id',array('style'=>'width:150px;'));
			$bg_controlled_model_id->setValue($form1_Values['bg_controlled_model_id']);
						
			$before_bg_controlled_model_id = new Zend_Form_Element_Text('before_bg_controlled_model_id',array("readonly" => "readonly"));
			$before_bg_controlled_model_id->setLabel('bg_cont_model_id');
			
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
		
		if(!empty($form1_Values['rt_original_table_id']))
		{
			//$rt_original_table_ids_prepared[0]= "Select from list";
			$rt_original_table_id = new Zend_Form_Element_Text('rt_original_table_id',array('style'=>'width:150px;'));
			$rt_original_table_id->setValue($form1_Values['rt_original_table_id']);
						
			$before_rt_original_table_id = new Zend_Form_Element_Text('before_rt_original_table_id',array("readonly" => "readonly"));
			$before_rt_original_table_id->setLabel('Original Year');
		
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
		
		if(!empty($form1_Values['first_stop_70']))
		{
			$first_stop_70 = new Zend_Form_Element_Text('first_stop_70');
			$first_stop_70->setValue($form1_Values['first_stop_70'])
			->setAttrib('onkeydown' ,'return onlyFloat(event);');
			
			$before_first_stop_70 = new Zend_Form_Element_Text('before_first_stop_70',array("readonly" => "readonly"));
			$before_first_stop_70->setLabel('First stop 70');
			
			$first_stop_70->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_first_stop_70->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_first_stop_70,$first_stop_70));
		}
		
		if(!empty($form1_Values['longest_stop_70']))
		{
			$longest_stop_70 = new Zend_Form_Element_Text('longest_stop_70');
			$longest_stop_70->setValue($form1_Values['longest_stop_70'])
			->setAttrib('onkeydown' ,'return onlyFloat(event);');
			
			$before_longest_stop_70 = new Zend_Form_Element_Text('before_longest_stop_70',array("readonly" => "readonly"));
			$before_longest_stop_70->setLabel('Longest stop 70');
			
			$longest_stop_70->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_longest_stop_70->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_longest_stop_70,$longest_stop_70));
		}
		
		if(!empty($form1_Values['shortest_stop_70']))
		{
			$shortest_stop_70 = new Zend_Form_Element_Text('shortest_stop_70');
			$shortest_stop_70->setValue($form1_Values['shortest_stop_70'])
			->setAttrib('onkeydown' ,'return onlyFloat(event);');
			
			$before_shortest_stop_70 = new Zend_Form_Element_Text('before_shortest_stop_70',array("readonly" => "readonly"));
			$before_shortest_stop_70->setLabel('Shortest stop 70');
			
			$shortest_stop_70->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_shortest_stop_70->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_shortest_stop_70,$shortest_stop_70));
		}
		
		if(!empty($form1_Values['transaction_off']))
		{
			$transaction_off = new Zend_Form_Element_Text('transaction_off');
			$transaction_off->setValue($form1_Values['transaction_off']);
			
			$before_transaction_off = new Zend_Form_Element_Text('before_transaction_off',array("readonly" => "readonly"));
			$before_transaction_off->setLabel('Transaction off');
		
			$transaction_off->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_transaction_off->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_transaction_off,$transaction_off));
		}
		
		if(!empty($form1_Values['partially_defeatable']))
		{
			$partially_defeatable = new Zend_Form_Element_Text('partially_defeatable');
			$partially_defeatable->setValue($form1_Values['partially_defeatable']);
			
			$before_partially_defeatable = new Zend_Form_Element_Text('before_partially_defeatable',array("readonly" => "readonly"));
			$before_partially_defeatable->setLabel('Partially defeatable');
		
			$partially_defeatable->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_partially_defeatable->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_partially_defeatable,$partially_defeatable));
		}
		
		if(!empty($form1_Values['fully_defeatable']))
		{
			$fully_defeatable = new Zend_Form_Element_Text('fully_defeatable');
			$fully_defeatable->setValue($form1_Values['fully_defeatable']);
			
			$before_fully_defeatable = new Zend_Form_Element_Text('before_fully_defeatable',array("readonly" => "readonly"));
			$before_fully_defeatable->setLabel('Fully defeatable');
		
			$fully_defeatable->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_fully_defeatable->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_fully_defeatable,$fully_defeatable));
		}
		
		if(!empty($form1_Values['competition_mode']))
		{
			$competition_mode = new Zend_Form_Element_Text('competition_mode');
			$competition_mode->setValue($form1_Values['competition_mode']);
			
			$before_competition_mode = new Zend_Form_Element_Text('before_competition_mode',array("readonly" => "readonly"));
			$before_competition_mode->setLabel('Competition mode');
		
			$competition_mode->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_competition_mode->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_competition_mode,$competition_mode));
		}
		
	    if(!empty($form1_Values['launch_control']))
		{
			$launch_control = new Zend_Form_Element_Text('launch_control');
			$launch_control->setValue($form1_Values['launch_control']);
			
			$before_launch_control = new Zend_Form_Element_Text('before_launch_control',array("readonly" => "readonly"));
			$before_launch_control->setLabel('Launch control');
		
			$launch_control->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_launch_control->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_launch_control,$launch_control));
		}
		
	    if(!empty($form1_Values['permanent']))
		{
			$permanent = new Zend_Form_Element_Text('permanent');
			$permanent->setValue($form1_Values['permanent']);
			
			$before_permanent = new Zend_Form_Element_Text('before_permanent',array("readonly" => "readonly"));
			$before_permanent->setLabel('Permanent');
		
			$permanent->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_permanent->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_permanent,$permanent));
		}
		
		if(!empty($form1_Values['center_of_gravity_height']))
		{
			$center_of_gravity_height = new Zend_Form_Element_Text('center_of_gravity_height');
			$center_of_gravity_height->setValue($form1_Values['center_of_gravity_height'])
			->setAttrib('onkeydown' ,'return onlyFloat(event);');
			
			$before_center_of_gravity_height = new Zend_Form_Element_Text('before_center_of_gravity_height',array("readonly" => "readonly"));
			$before_center_of_gravity_height->setLabel('Center of Gravity Height');
			
			$center_of_gravity_height->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_center_of_gravity_height->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_center_of_gravity_height,$center_of_gravity_height));
		}
		
		if(!empty($form1_Values['skidpad_diameter']))
		{
			$skidpad_diameter = new Zend_Form_Element_Text('skidpad_diameter');
			$skidpad_diameter->setValue($form1_Values['skidpad_diameter'])
			->setAttrib('onkeydown' ,'return onlyFloat(event);');
			
			$before_skidpad_diameter = new Zend_Form_Element_Text('before_skidpad_diameter',array("readonly" => "readonly"));
			$before_skidpad_diameter->setLabel('Skidpad diameter');
			
			$skidpad_diameter->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_skidpad_diameter->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_skidpad_diameter,$skidpad_diameter));
		}
		
		if(!empty($form1_Values['test_notes']))
		{
			$test_notes = new Zend_Form_Element_Text('test_notes');
			$test_notes->setValue($form1_Values['test_notes']);
			
			$before_test_notes = new Zend_Form_Element_Text('before_test_notes',array("readonly" => "readonly"));
			$before_test_notes->setLabel('Test notes');
		
			$test_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_test_notes->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_test_notes,$test_notes));
		}
		if(!empty($form1_Values['test_location']))
		{
			$test_location = new Zend_Form_Element_Select('test_location',array('style'=>'width:150px;'));
			$test_location->addMultioptions(array(''=>'','willow'=>'willow','Milan'=>'Milan','Chelsea'=>'Chelsea'));
			$test_location->setValue($form1_Values['test_location']);
			
			$before_test_location = new Zend_Form_Element_Text('before_test_location',array("readonly" => "readonly"));
			$before_test_location->setLabel('Test location');
			
			$test_location->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_test_location->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_test_location,$test_location));
		}
		
		if(!empty($form1_Values['test_location_detail']))
		{
			$test_location_detail = new Zend_Form_Element_Text('test_location_detail');
			$test_location_detail->setValue($form1_Values['test_location_detail']);
			
			$before_test_location_detail = new Zend_Form_Element_Text('before_test_location_detail',array("readonly" => "readonly"));
			$before_test_location_detail->setLabel('Test location detail');
		
			$test_location_detail->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_test_location_detail->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_test_location_detail,$test_location_detail));
		}
		
		if(!empty($form1_Values['tester']))
		{
			$tester = new Zend_Form_Element_Text('tester');
			$tester->setValue($form1_Values['tester']);
			
			$before_tester = new Zend_Form_Element_Text('before_tester',array("readonly" => "readonly"));
			$before_tester->setLabel('Tester');
		
			$tester->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_tester->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_tester,$tester));
		}
		
		if(!empty($form1_Values['image']))
		{
			$image = new Zend_Form_Element_File('image');
			$image->setValue($form1_Values['image'])
			->addValidator('Count', false, 1);    
		
			$image->setDecorators(array(
			 'File',
			 'Description',
			 'Errors',
			 array(array('data'=>'HtmlTag'), array('tag' => 'td','align' => 'center')),
			 array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			 ));
			
			$before_image = new Zend_Form_Element_Image('beforeimage');
			$before_image->setImage("/images/" . $form1_Values['image'])
						->setLabel("Image")
						->setAttrib("width", "200px")
						->setAttrib("height", "100px");
			
			$before_image->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_image,$image));
			
			
		}
		
		if(!empty($form1_Values['url_for_story_relationship']))
		{
			$url_for_story_relationship = new Zend_Form_Element_Text('url_for_story_relationship');
			$url_for_story_relationship->setValue($form1_Values['url_for_story_relationship']);
			
			$before_url_for_story_relationship = new Zend_Form_Element_Text('before_url_for_story_relationship',array("readonly" => "readonly"));
			$before_url_for_story_relationship->setLabel('URL for story relationship');
		
			$url_for_story_relationship->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_url_for_story_relationship->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_url_for_story_relationship,$url_for_story_relationship));
		}
		
		if(!empty($form1_Values['ez_id']))
		{
			$ez_id = new Zend_Form_Element_Text('ez_id');
			$ez_id->setValue($form1_Values['ez_id']);
			
			$before_ez_id = new Zend_Form_Element_Text('before_ez_id',array("readonly" => "readonly"));
			$before_ez_id->setLabel('EZ ID');
		
			$ez_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_ez_id->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_ez_id,$ez_id));
		}
		
		if(!empty($form1_Values['suppress_public_display']))
		{
			$suppress_public_display = new Zend_Form_Element_Text('suppress_public_display');
			$suppress_public_display->setValue($form1_Values['suppress_public_display']);
			
			$before_suppress_public_display = new Zend_Form_Element_Text('before_suppress_public_display',array("readonly" => "readonly"));
			$before_suppress_public_display->setLabel('Suppress public display');
		
			$suppress_public_display->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_suppress_public_display->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_suppress_public_display,$suppress_public_display));
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
	             ->from(array('rtd'=>'rt_dropdown_descriptions'),array('rtl.id As dropdownid', 'rtd.description As description'))
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
