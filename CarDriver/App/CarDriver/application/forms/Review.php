<?php
class Application_Form_Review extends Application_Form_MainForm
{
	public $id;
	
	public function __construct($id) 
  	{ 
     	$this->id = $id;
     	parent::__construct();
     
  	} 
	public function init()
	{
		$session1 = new Zend_Session_Namespace('form1');
		$session2 = new Zend_Session_Namespace('form2');
		$session3 = new Zend_Session_Namespace('form3');
		
		$form1_Values = $session1->form1;
		$form2_Values = $session2->form2;
		$form3_Values = $session3->form3;
		
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
			$before_rt_model_year->setLabel('Year')
								->setValue($rt_results_main[0]['rt_model_year']);
			
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
		
		if(!empty($form1_Values['bg_make_id']))
		{
			$bg_make_ids_prepared[0]= "Select from list";
			$objDOM = new DOMDocument(); 
			$objDOM->load("http://buyersguide.caranddriver.com/api/makes?mode=xml"); 
			$row = $objDOM->getElementsByTagName("row"); 
			foreach( $row as $value )
			{
			    $names = $value->getElementsByTagName("name");
			    $name  = $names->item(0)->nodeValue;
				
				$ids = $value->getElementsByTagName("id");
			    $id  = $ids->item(0)->nodeValue;
				
			    $bg_make_ids_prepared[$id]= $name;
			 }
		
			$bg_make_id = new Zend_Form_Element_Select('bg_make_id',array('style'=>'width:150px;'));
			$bg_make_id->addMultiOptions($bg_make_ids_prepared)
						->setValue($form1_Values['bg_make_id']);
			$bg_make_id->setAttrib('onchange','AutoFillModel(this.value)');		
				
			$before_bg_make_id = new Zend_Form_Element_Text('before_bg_make_id',array("readonly" => "readonly"));
			$before_bg_make_id->setLabel('Mapped BG Make ID')
								->setValue($rt_results_main[0]['bg_make_id']);
			
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
				//if(isset($_SESSION['makid']))
				//{
					//$makeid = $_SESSION['makid'];
					$bg_model_ids_prepared[0]= "Select from list";
					$objDOM = new DOMDocument(); 
					$objDOM->load("http://buyersguide.caranddriver.com/api/models?mode=xml"); 
					$row = $objDOM->getElementsByTagName("row"); 
					foreach( $row as $value )
					{
					    $names = $value->getElementsByTagName("name");
					    $name  = $names->item(0)->nodeValue;
						
					    $makeids = $value->getElementsByTagName("make_id");
					    $make_id  = $makeids->item(0)->nodeValue;
					    
						$ids = $value->getElementsByTagName("id");
					    $id  = $ids->item(0)->nodeValue;
						
					    if($form1_Values['bg_make_id'] == $make_id)
					    	$bg_model_ids_prepared[$id]= $name;
					 }
				//}
			
				$bg_model_id = new Zend_Form_Element_Select('bg_model_id',array('style'=>'width:150px;'));
				$bg_model_id->addMultiOptions($bg_model_ids_prepared)
							->setValue($form1_Values['bg_model_id']);
				$bg_model_id->setAttrib('onchange','AutoFillSubModel(this.value)');
							
				$before_bg_model_id = new Zend_Form_Element_Text('before_bg_model_id',array("readonly" => "readonly"));
				$before_bg_model_id->setLabel('Mapped BG Model ID')
									->setValue($rt_results_main[0]['bg_model_id']);
				
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
				//if(isset($_SESSION['modid']))
				//{
					//$modid = $_SESSION['modid'];
					$bg_submodel_ids_prepared[0]= "Select from list";
					$objDOM = new DOMDocument(); 
					$objDOM->load("http://buyersguide.caranddriver.com/api/submodels?mode=xml"); 
					$row = $objDOM->getElementsByTagName("row"); 
					foreach( $row as $value )
					{
					    $names = $value->getElementsByTagName("name");
					    $name  = $names->item(0)->nodeValue;
						
					    $modelids = $value->getElementsByTagName("model_id");
					    $model_id  = $modelids->item(0)->nodeValue;
					    
						$ids = $value->getElementsByTagName("id");
					    $id  = $ids->item(0)->nodeValue;
							
						    if($form1_Values['bg_model_id'] == $model_id)
						    	$bg_submodel_ids_prepared[$id]= $name;
					 }
				//}
				$bg_submodel_id = new Zend_Form_Element_Select('bg_submodel_id',array('style'=>'width:150px;'));
				$bg_submodel_id->addMultiOptions($bg_submodel_ids_prepared)
							->setValue($form1_Values['bg_submodel_id']);
							
				$before_bg_submodel_id = new Zend_Form_Element_Text('before_bg_submodel_id',array("readonly" => "readonly"));
				$before_bg_submodel_id->setLabel('Mapped BG Submodel ID')
									->setValue($rt_results_main[0]['bg_submodel_id']);
				
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
		
		if(!empty($form1_Values['rt_published']))
		{
			$rt_published = new Zend_Form_Element_Text('rt_published');
			$rt_published->setValue($form1_Values['rt_published']);
			
			
			$before_rt_published = new Zend_Form_Element_Text('before_rt_published',array("readonly" => "readonly"));
			$before_rt_published->setLabel('Publish Date')
								->setValue($rt_results_main[0]['rt_published']);
			
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
		
			/*if(!empty($form1_Values['bg_model_id']))
			{
				$bg_model_ids_prepared[0]= "Select from list";
				if(isset($_SESSION['makid']))
				{
					$makeid = $_SESSION['makid'];
					$bg_model_ids_prepared[0]= "Select from list";
					$objDOM = new DOMDocument(); 
					$objDOM->load("http://buyersguide.caranddriver.com/api/models?mode=xml"); 
					$row = $objDOM->getElementsByTagName("row"); 
					foreach( $row as $value )
					{
					    $names = $value->getElementsByTagName("name");
					    $name  = $names->item(0)->nodeValue;
						
					    $makeids = $value->getElementsByTagName("make_id");
					    $make_id  = $makeids->item(0)->nodeValue;
					    
						$ids = $value->getElementsByTagName("id");
					    $id  = $ids->item(0)->nodeValue;
						
					    if($makeid == $make_id)
					    	$bg_model_ids_prepared[$id]= $name;
					 }
				}
			
				$bg_model_id = new Zend_Form_Element_Select('bg_model_id',array('style'=>'width:150px;'));
				$bg_model_id->addMultiOptions($bg_model_ids_prepared)
							->setValue($form1_Values['bg_model_id']);
				$bg_model_id->setAttrib('onchange','AutoFillSubModel(this.value)');
							
				$before_bg_model_id = new Zend_Form_Element_Text('before_bg_model_id',array("readonly" => "readonly"));
				$before_bg_model_id->setLabel('Mapped BG Model ID')
									->setValue($rt_results_main[0]['bg_model_id']);
				
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
		}*/
		
		if(!empty($form1_Values['rt_issue']))
		{
			$rt_issue = new Zend_Form_Element_Text('rt_issue');
			$rt_issue->setValue($form1_Values['rt_issue']);
			
			$before_rt_issue = new Zend_Form_Element_Text('before_rt_issue',array("readonly" => "readonly"));
			$before_rt_issue->setLabel('Magazine Issue Month')
								->setValue($rt_results_main[0]['rt_issue']);
			
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
		
		/*if(!empty($form1_Values['bg_submodel_id']))
		{
			$bg_submodel_ids_prepared[0]= "Select from list";
			if(isset($_SESSION['modid']))
			{
				$modid = $_SESSION['modid'];
				$bg_submodel_ids_prepared[0]= "Select from list";
				$objDOM = new DOMDocument(); 
				$objDOM->load("http://buyersguide.caranddriver.com/api/submodels?mode=xml"); 
				$row = $objDOM->getElementsByTagName("row"); 
				foreach( $row as $value )
				{
				    $names = $value->getElementsByTagName("name");
				    $name  = $names->item(0)->nodeValue;
					
				    $modelids = $value->getElementsByTagName("model_id");
				    $model_id  = $modelids->item(0)->nodeValue;
				    
					$ids = $value->getElementsByTagName("id");
				    $id  = $ids->item(0)->nodeValue;
						
					    if($modid == $model_id)
					    	$bg_submodel_ids_prepared[$id]= $name;
				 }
			}
			$bg_submodel_id = new Zend_Form_Element_Select('bg_submodel_id',array('style'=>'width:150px;'));
			$bg_submodel_id->addMultiOptions($bg_submodel_ids_prepared)
						->setValue($form1_Values['bg_submodel_id']);
						
			$before_bg_submodel_id = new Zend_Form_Element_Text('before_bg_submodel_id',array("readonly" => "readonly"));
			$before_bg_submodel_id->setLabel('Mapped BG Submodel ID')
								->setValue($rt_results_main[0]['bg_submodel_id']);
			
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
		}*/
		if(!empty($form1_Values['rt_issue_year']))
		{
			$rt_issue_year = new Zend_Form_Element_Text('rt_issue_year');
			$rt_issue_year->setValue($form1_Values['rt_issue_year']);

			$before_rt_issue_year = new Zend_Form_Element_Text('before_rt_issue_year',array("readonly" => "readonly"));
			$before_rt_issue_year->setLabel('Magazine Issue Year')
								->setValue($rt_results_main[0]['rt_issue_year']);
			
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
		
		if(!empty($form1_Values['bg_year_id']))
		{
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
			$bg_year_id->addMultiOptions($bg_year_ids_prepared)
					->setValue($form1_Values['bg_year_id']);
		
			$before_bg_year_id = new Zend_Form_Element_Text('before_bg_year_id',array("readonly" => "readonly"));
			$before_bg_year_id->setLabel('Mapped BG Year')
								->setValue($rt_results_main[0]['bg_year_id']);
			
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
		if(!empty($form1_Values['rt_percent_on_rear']))
		{
			$rt_percent_on_rear = new Zend_Form_Element_Text('rt_percent_on_rear');
			$rt_percent_on_rear->setValue($form1_Values['rt_percent_on_rear']);

			$before_rt_percent_on_rear = new Zend_Form_Element_Text('before_rt_percent_on_rear',array("readonly" => "readonly"));
			$before_rt_percent_on_rear->setLabel('Percent of Weight on Back Axle')
								->setValue($rt_results_main[0]['rt_percent_on_rear']);
			
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
		if(!empty($form1_Values['bg_controlled_make_id']))
		{
			$bg_controlled_make_ids_prepared[0]= "Select from list";
			$bg_controlled_make_id = new Zend_Form_Element_Select('bg_controlled_make_id',array('style'=>'width:150px;'));
			$bg_controlled_make_id->addMultiOptions($bg_controlled_make_ids_prepared)
						->setValue($form1_Values['bg_controlled_make_id']);
			
			$before_bg_controlled_make_id = new Zend_Form_Element_Text('before_bg_controlled_make_id',array("readonly" => "readonly"));
			$before_bg_controlled_make_id->setLabel('Mapped BG Controlled Make')
								->setValue($rt_results_main[0]['bg_controlled_make_id']);
			
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
		
		if(!empty($form1_Values['rt_percent_on_front']))
		{
			$rt_percent_on_front = new Zend_Form_Element_Text('rt_percent_on_front');
			$rt_percent_on_front->setValue($form1_Values['rt_percent_on_front']);

			$before_rt_percent_on_front = new Zend_Form_Element_Text('before_rt_percent_on_front',array("readonly" => "readonly"));
			$before_rt_percent_on_front->setLabel('Percent of Weight on Front Axle')
								->setValue($rt_results_main[0]['rt_percent_on_front']);
			
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
		if(!empty($form1_Values['bg_controlled_model_id']))
		{
			$bg_controlled_model_ids_prepared[0]= "Select from list";
			$bg_controlled_model_id = new Zend_Form_Element_Select('bg_controlled_model_id',array('style'=>'width:150px;'));
			$bg_controlled_model_id->addMultiOptions($bg_controlled_model_ids_prepared)
						->setValue($form1_Values['bg_controlled_model_id']);
						
			$before_bg_controlled_model_id = new Zend_Form_Element_Text('before_bg_controlled_model_id',array("readonly" => "readonly"));
			$before_bg_controlled_model_id->setLabel('Mapped BG Controlled Model')
								->setValue($rt_results_main[0]['bg_controlled_model_id']);
			
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
		if(!empty($form1_Values['rt_60_mph']))
		{
			$rt_60_mph = new Zend_Form_Element_Text('rt_60_mph');
			$rt_60_mph->setValue($form1_Values['rt_60_mph']);
			
			$before_rt_60_mph = new Zend_Form_Element_Text('before_rt_60_mph',array("readonly" => "readonly"));
			$before_rt_60_mph->setLabel('Acceleration to 60 MPH')
								->setValue($rt_results_main[0]['rt_60_mph']);
			
			$rt_60_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt_60_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt_60_mph,$rt_60_mph));	
		}
		
		if(!empty($form1_Values['rt_original_table_id']))
		{
			$rt_original_table_ids_prepared[0]= "Select from list";
			$rt_original_table_id = new Zend_Form_Element_Select('rt_original_table_id',array('style'=>'width:150px;'));
			$rt_original_table_id->addMultiOptions($rt_original_table_ids_prepared)
						->setValue($form1_Values['rt_original_table_id']);
						
			$before_rt_original_table_id = new Zend_Form_Element_Text('before_rt_original_table_id',array("readonly" => "readonly"));
			$before_rt_original_table_id->setLabel('Original Year')
								->setValue($rt_results_main[0]['rt_original_table_id']);
			
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
		
		if(!empty($form1_Values['rt_70_mph_braking']))
		{
			$rt_70_mph_braking = new Zend_Form_Element_Text('rt_70_mph_braking');
			$rt_70_mph_braking->setValue($form1_Values['rt_70_mph_braking']);
			
			$before_rt_70_mph_braking = new Zend_Form_Element_Text('before_rt_70_mph_braking',array("readonly" => "readonly"));
			$before_rt_70_mph_braking->setLabel('Braking from 70 MPH')
								->setValue($rt_results_main[0]['rt_70_mph_braking']);
			
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
		if(!empty($form1_Values['rt_controlled_body']))
		{
			$rt_controlled_body_prepared = $this->gatMultioptions("Body");
		
			$rt_controlled_body = new Zend_Form_Element_Select('rt_controlled_body',array('style'=>'width:150px;'));
			$rt_controlled_body->addMultiOptions($rt_controlled_body_prepared)
						->setValue($form1_Values['rt_controlled_body']);
			
			$before_rt_controlled_body = new Zend_Form_Element_Text('before_rt_controlled_body',array("readonly" => "readonly"));
			$before_rt_controlled_body->setLabel('Body Style')
								->setValue($rt_results_main[0]['rt_controlled_body']);
			
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
		if(!empty($form1_Values['rt_top_speed']))
		{
			$rt_top_speed = new Zend_Form_Element_Text('rt_top_speed');
			$rt_top_speed->setValue($form1_Values['rt_top_speed']);
			
			$before_rt_top_speed = new Zend_Form_Element_Text('before_rt_top_speed',array("readonly" => "readonly"));
			$before_rt_top_speed->setLabel('Top Speed')
								->setValue($rt_results_main[0]['rt_top_speed']);
			
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
		if(!empty($form1_Values['rt_controlled_engine']))
		{
			$rt_controlled_engine_prepared = $this->gatMultioptions("Engine");
		
			$rt_controlled_engine = new Zend_Form_Element_Select('rt_controlled_engine',array('style'=>'width:150px;'));
			$rt_controlled_engine->addMultiOptions($rt_controlled_engine_prepared)
						->setValue($form1_Values['rt_controlled_engine']);
			
			$before_rt_controlled_engine = new Zend_Form_Element_Text('before_rt_controlled_engine',array("readonly" => "readonly"));
			$before_rt_controlled_engine->setLabel('Engine Placement')
								->setValue($rt_results_main[0]['rt_controlled_engine']);
			
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
		if(!empty($form1_Values['rt_top_speed_notes']))
		{
			$rt_top_speed_notes = new Zend_Form_Element_Text('rt_top_speed_notes');
			$rt_top_speed_notes->setValue($form1_Values['rt_top_speed_notes']);
			
			$before_rt_top_speed_notes = new Zend_Form_Element_Text('before_rt_top_speed_notes',array("readonly" => "readonly"));
			$before_rt_top_speed_notes->setLabel('Top Speed Notes')
								->setValue($rt_results_main[0]['rt_top_speed_notes']);
			
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
		if(!empty($form1_Values['rt_controlled_fuel']))
		{
			$rt_controlled_fuel_prepared = $this->gatMultioptions("Fuel");
		
			$rt_controlled_fuel = new Zend_Form_Element_Select('rt_controlled_fuel',array('style'=>'width:150px;'));
			$rt_controlled_fuel->addMultiOptions($rt_controlled_fuel_prepared)
						->setValue($form1_Values['rt_controlled_fuel']);
			
			$before_rt_controlled_fuel = new Zend_Form_Element_Text('before_rt_controlled_fuel',array("readonly" => "readonly"));
			$before_rt_controlled_fuel->setLabel('Fuel Type')
								->setValue($rt_results_main[0]['rt_controlled_fuel']);
			
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
		if(!empty($form1_Values['rt_base_price']))
		{
			$rt_base_price = new Zend_Form_Element_Text('rt_base_price');
			$rt_base_price->setValue($form1_Values['rt_base_price']);
			
			$before_rt_base_price = new Zend_Form_Element_Text('before_rt_base_price',array("readonly" => "readonly"));
			$before_rt_base_price->setLabel('Base Price')
								->setValue($rt_results_main[0]['rt_base_price']);
			
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
		if(!empty($form1_Values['rt_controlled_make']))
		{
			$rt_controlled_make_prepared = $this->gatMultioptions("Make");
		
			$rt_controlled_make = new Zend_Form_Element_Select('rt_controlled_make',array('style'=>'width:150px;'));
			$rt_controlled_make->addMultiOptions($rt_controlled_make_prepared)
						->setValue($form1_Values['rt_controlled_make']);
						
			$before_rt_controlled_make = new Zend_Form_Element_Text('before_rt_controlled_make',array("readonly" => "readonly"));
			$before_rt_controlled_make->setLabel('Make')
								->setValue($rt_results_main[0]['rt_controlled_make']);
			
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
		if(!empty($form1_Values['rt_base_price_notes']))
		{
			$rt_base_price_notes = new Zend_Form_Element_Text('rt_base_price_notes');
			$rt_base_price_notes->setValue($form1_Values['rt_base_price_notes']);
			
			$before_rt_base_price_notes = new Zend_Form_Element_Text('before_rt_base_price_notes',array("readonly" => "readonly"));
			$before_rt_base_price_notes->setLabel('Base Price Notes')
								->setValue($rt_results_main[0]['rt_base_price_notes']);
			
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
		if(!empty($form1_Values['rt_controlled_sort']))
		{
			$rt_controlled_sort_prepared = $this->gatMultioptions("Sort");
		
			$rt_controlled_sort = new Zend_Form_Element_Select('rt_controlled_sort',array('style'=>'width:150px;'));
			$rt_controlled_sort->addMultiOptions($rt_controlled_sort_prepared)
						->setValue($form1_Values['rt_controlled_sort']);
						
			$before_rt_controlled_sort = new Zend_Form_Element_Text('before_rt_controlled_sort',array("readonly" => "readonly"));
			$before_rt_controlled_sort->setLabel('Production Type (Limited)')
								->setValue($rt_results_main[0]['rt_controlled_sort']);
			
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
		if(!empty($form1_Values['rt_speed_qtr_mile_speed_trap']))
		{
			$rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Text('rt_speed_qtr_mile_speed_trap');
			$rt_speed_qtr_mile_speed_trap->setValue($form1_Values['rt_speed_qtr_mile_speed_trap']);
			
			$before_rt_speed_qtr_mile_speed_trap = new Zend_Form_Element_Text('before_rt_speed_qtr_mile_speed_trap',array("readonly" => "readonly"));
			$before_rt_speed_qtr_mile_speed_trap->setLabel('Speed At End of Quarter Mile')
								->setValue($rt_results_main[0]['rt_speed_qtr_mile_speed_trap']);
			
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
		if(!empty($form1_Values['rt_controlled_transmission']))
		{
			$rt_controlled_transmission_prepared= $this->gatMultioptions("Transmission");
		
			$rt_controlled_transmission = new Zend_Form_Element_Select('rt_controlled_transmission',array('style'=>'width:150px;'));
			$rt_controlled_transmission->addMultiOptions($rt_controlled_transmission_prepared)
						->setValue($form1_Values['rt_controlled_transmission']);
						
			$before_rt_controlled_transmission = new Zend_Form_Element_Text('before_rt_controlled_transmission',array("readonly" => "readonly"));
			$before_rt_controlled_transmission->setLabel('Transmission Type')
								->setValue($rt_results_main[0]['rt_controlled_transmission']);
			
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
		if(!empty($form1_Values['rt_quarter_time']))
		{
			$rt_quarter_time = new Zend_Form_Element_Text('rt_quarter_time');
			$rt_quarter_time->setValue($form1_Values['rt_quarter_time']);
			
			$before_rt_quarter_time = new Zend_Form_Element_Text('before_rt_quarter_time',array("readonly" => "readonly"));
			$before_rt_quarter_time->setLabel('Quarter Mile Time')
								->setValue($rt_results_main[0]['rt_quarter_time']);
			
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
		if(!empty($form1_Values['rt_controlled_drive']))
		{
			$rt_controlled_drive_prepared = $this->gatMultioptions("Drive");
		
			$rt_controlled_drive = new Zend_Form_Element_Select('rt_controlled_drive',array('style'=>'width:150px;'));
			$rt_controlled_drive->addMultiOptions($rt_controlled_drive_prepared)
						->setValue($form1_Values['rt_controlled_drive']);
						
			$before_rt_controlled_drive = new Zend_Form_Element_Text('before_rt_controlled_drive',array("readonly" => "readonly"));
			$before_rt_controlled_drive->setLabel('Drivetrain Type')
								->setValue($rt_results_main[0]['rt_controlled_drive']);
			
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
		if(!empty($form1_Values['rt_doors']))
		{
			$rt_doors = new Zend_Form_Element_Text('rt_doors');
			$rt_doors->setValue($form1_Values['rt_doors']);
			
			$before_rt_doors = new Zend_Form_Element_Text('before_rt_doors',array("readonly" => "readonly"));
			$before_rt_doors->setLabel('Number of Doors')
								->setValue($rt_results_main[0]['rt_doors']);
			
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
		if(!empty($form1_Values['rt_controlled_ts_limit']))
		{
			$rt_controlled_ts_limit_prepared = $this->gatMultioptions("TS limit");
		
			$rt_controlled_ts_limit = new Zend_Form_Element_Select('rt_controlled_ts_limit',array('style'=>'width:150px;'));
			$rt_controlled_ts_limit->addMultiOptions($rt_controlled_ts_limit_prepared)
						->setValue($form1_Values['rt_controlled_ts_limit']);
						
			$before_rt_controlled_ts_limit = new Zend_Form_Element_Text('before_rt_controlled_ts_limit',array("readonly" => "readonly"));
			$before_rt_controlled_ts_limit->setLabel('Top Speed Limiter')
								->setValue($rt_results_main[0]['rt_controlled_ts_limit']);
			
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
		if(!empty($form1_Values['rt_cd_observed_fe']))
		{
			$rt_cd_observed_fe = new Zend_Form_Element_Text('rt_cd_observed_fe');
			$rt_cd_observed_fe->setValue($form1_Values['rt_cd_observed_fe']);
			
			$before_rt_cd_observed_fe = new Zend_Form_Element_Text('before_rt_cd_observed_fe',array("readonly" => "readonly"));
			$before_rt_cd_observed_fe->setLabel('Observed Fuel Economy')
								->setValue($rt_results_main[0]['rt_cd_observed_fe']);
			
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
		if(!empty($form1_Values['rt_controlled_turbo_superchg']))
		{
			$rt_controlled_turbo_superchg_prepared = $this->gatMultioptions("Turbo/Superchg");
		
			$rt_controlled_turbo_superchg = new Zend_Form_Element_Select('rt_controlled_turbo_superchg',array('style'=>'width:150px;'));
			$rt_controlled_turbo_superchg->addMultiOptions($rt_controlled_turbo_superchg_prepared)
						->setValue($form1_Values['rt_controlled_turbo_superchg']);
						
			$before_rt_controlled_turbo_superchg = new Zend_Form_Element_Text('before_rt_controlled_turbo_superchg',array("readonly" => "readonly"));
			$before_rt_controlled_turbo_superchg->setLabel('Forced Induction Type')
								->setValue($rt_results_main[0]['rt_controlled_turbo_superchg']);
			
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
		if(!empty($form1_Values['rt_no_cyl']))
		{
			$rt_no_cyl = new Zend_Form_Element_Text('rt_no_cyl');
			$rt_no_cyl->setValue($form1_Values['rt_no_cyl']);
			
			$before_rt_no_cyl = new Zend_Form_Element_Text('before_rt_no_cyl',array("readonly" => "readonly"));
			$before_rt_no_cyl->setLabel('Number of Cylinders')
								->setValue($rt_results_main[0]['rt_no_cyl']);
			
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
		if(!empty($form1_Values['rt_controlled_type']))
		{
			$rt_controlled_type_prepared = $this->gatMultioptions("Type");
		
			$rt_controlled_type = new Zend_Form_Element_Select('rt_controlled_type',array('style'=>'width:150px;'));
			$rt_controlled_type->addMultiOptions($rt_controlled_type_prepared)
						->setValue($form1_Values['rt_controlled_type']);
						
			$before_rt_controlled_type = new Zend_Form_Element_Text('before_rt_controlled_type',array("readonly" => "readonly"));
			$before_rt_controlled_type->setLabel('Engine Cylinder Configuration')
								->setValue($rt_results_main[0]['rt_controlled_type']);
			
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
		if(!empty($form1_Values['rt_peak_hp']))
		{
			$rt_peak_hp = new Zend_Form_Element_Text('rt_peak_hp');
			$rt_peak_hp->setValue($form1_Values['rt_peak_hp']);
			
			$before_rt_peak_hp = new Zend_Form_Element_Text('before_rt_peak_hp',array("readonly" => "readonly"));
			$before_rt_peak_hp->setLabel('Peak Horsepower')
								->setValue($rt_results_main[0]['rt_peak_hp']);
			
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
		if(!empty($form1_Values['rt_model']))
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
			$before_rt_model->setLabel('Model')
								->setValue($rt_results_main[0]['rt_model']);
			
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
		if(!empty($form1_Values['rt_peak_hp_notes']))
		{
			$rt_peak_hp_notes = new Zend_Form_Element_Text('rt_peak_hp_notes');
			$rt_peak_hp_notes->setValue($form1_Values['rt_peak_hp_notes']);
			
			$before_rt_peak_hp_notes = new Zend_Form_Element_Text('before_rt_peak_hp_notes',array("readonly" => "readonly"));
			$before_rt_peak_hp_notes->setLabel('Peak Horsepower Notes')
								->setValue($rt_results_main[0]['rt_peak_hp_notes']);
			
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
		if(!empty($form2_Values['rt_peak_torque']))
		{
			$rt_peak_torque = new Zend_Form_Element_Text('rt_peak_torque');
			$rt_peak_torque->setValue($form2_Values['rt_peak_torque']);
			
			$before_rt_peak_torque = new Zend_Form_Element_Text('before_rt_peak_torque',array("readonly" => "readonly"));
			$before_rt_peak_torque->setLabel('Peak Torque')
								->setValue($rt_results_main[0]['rt_peak_torque']);
			
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
		if(!empty($form2_Values['rt2_anti_lock']))
		{
			$rt2_anti_lock = new Zend_Form_Element_Text('rt2_anti_lock');
			$rt2_anti_lock->setValue($form2_Values['rt2_anti_lock']);
			
			$before_rt2_anti_lock = new Zend_Form_Element_Text('before_rt2_anti_lock',array("readonly" => "readonly"));
			$before_rt2_anti_lock->setLabel('ABS')
								->setValue($rt_results_main[0]['rt2_anti_lock']);
			
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
		if(!empty($form2_Values['rt_peak_torque_notes']))
		{
			$rt_peak_torque_notes = new Zend_Form_Element_Text('rt_peak_torque_notes');
			$rt_peak_torque_notes->setValue($form2_Values['rt_peak_torque_notes']);
			
			$before_rt_peak_torque_notes = new Zend_Form_Element_Text('before_rt_peak_torque_notes',array("readonly" => "readonly"));
			$before_rt_peak_torque_notes->setLabel('Peak Torque Notes')
								->setValue($rt_results_main[0]['rt_peak_torque_notes']);
			
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
		if(!empty($form2_Values['rt2_epa_city_fe']))
		{
			$rt2_epa_city_fe = new Zend_Form_Element_Text('rt2_epa_city_fe');
			$rt2_epa_city_fe->setValue($form2_Values['rt2_epa_city_fe']);
			
			$before_rt2_epa_city_fe = new Zend_Form_Element_Text('before_rt2_epa_city_fe',array("readonly" => "readonly"));
			$before_rt2_epa_city_fe->setLabel('EPA City MPG')
									->setValue($rt_results_level_2[0]['rt2_epa_city_fe']);
			
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
		if(!empty($form2_Values['rt_power_to_weight']))
		{
			$rt_power_to_weight = new Zend_Form_Element_Text('rt_power_to_weight');
			$rt_power_to_weight->setValue($form2_Values['rt_power_to_weight']);
			
			$before_rt_power_to_weight = new Zend_Form_Element_Text('before_rt_power_to_weight',array("readonly" => "readonly"));
			$before_rt_power_to_weight->setLabel('Horsepower per Pound')
									  ->setValue($rt_results_main[0]['rt_power_to_weight']);
			
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
		if(!empty($form2_Values['rt2_epa_city_fe_notes']))
		{
			$rt2_epa_city_fe_notes = new Zend_Form_Element_Text('rt2_epa_city_fe_notes');
			$rt2_epa_city_fe_notes->setValue($form2_Values['rt2_epa_city_fe_notes']);
			
			$before_rt2_epa_city_fe_notes = new Zend_Form_Element_Text('before_rt2_epa_city_fe_notes',array("readonly" => "readonly"));
			$before_rt2_epa_city_fe_notes->setLabel('EPA City MPG Notes')
									  ->setValue($rt_results_level_2[0]['rt2_epa_city_fe_notes']);
			
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
		if(!empty($form2_Values['rt_price_as_tested']))
		{
			$rt_price_as_tested = new Zend_Form_Element_Text('rt_price_as_tested');
			$rt_price_as_tested->setValue($form2_Values['rt_price_as_tested']);
			
			$before_rt_price_as_tested = new Zend_Form_Element_Text('before_rt_price_as_tested',array("readonly" => "readonly"));
			$before_rt_price_as_tested->setLabel('Price as Tested')
									  ->setValue($rt_results_main[0]['rt_price_as_tested']);
			
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
		if(!empty($form2_Values['rt2_fuel_sys']))
		{
			$rt2_fuel_sys = new Zend_Form_Element_Text('rt2_fuel_sys');
			$rt2_fuel_sys->setValue($form2_Values['rt2_fuel_sys']);
			
			$before_rt2_fuel_sys = new Zend_Form_Element_Text('before_rt2_fuel_sys',array("readonly" => "readonly"));
			$before_rt2_fuel_sys->setLabel('Fuel System')
									  ->setValue($rt_results_level_2[0]['rt2_fuel_sys']);
			
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
		if(!empty($form2_Values['rt_price_as_tested_notes']))
		{
			$rt_price_as_tested_notes = new Zend_Form_Element_Text('rt_price_as_tested_notes');
			$rt_price_as_tested_notes->setValue($form2_Values['rt_price_as_tested_notes']);
			
			$before_rt_price_as_tested_notes = new Zend_Form_Element_Text('before_rt_price_as_tested_notes',array("readonly" => "readonly"));
			$before_rt_price_as_tested_notes->setLabel('Price as Tested Notes')
									  ->setValue($rt_results_main[0]['rt_price_as_tested_notes']);
			
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
		if(!empty($form2_Values['rt2_highway_fe']))
		{
			$rt2_highway_fe = new Zend_Form_Element_Text('rt2_highway_fe');
			$rt2_highway_fe->setValue($form2_Values['rt2_highway_fe']);
			
			$before_rt2_highway_fe = new Zend_Form_Element_Text('before_rt2_highway_fe',array("readonly" => "readonly"));
			$before_rt2_highway_fe->setLabel('EPA Highway MPG')
									  ->setValue($rt_results_level_2[0]['rt2_highway_fe']);
			
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
		if(!empty($form2_Values['rt_redline']))
		{
			$rt_redline = new Zend_Form_Element_Text('rt_redline');
			$rt_redline->setValue($form2_Values['rt_redline']);
			
			$before_rt_redline = new Zend_Form_Element_Text('before_rt_redline',array("readonly" => "readonly"));
			$before_rt_redline->setLabel('Redline')
									  ->setValue($rt_results_main[0]['rt_redline']);
			
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
		if(!empty($form2_Values['rt2_highway_fe_notes']))
		{
			$rt2_highway_fe_notes = new Zend_Form_Element_Text('rt2_highway_fe_notes');
			$rt2_highway_fe_notes->setValue($form2_Values['rt2_highway_fe_notes']);
			
			$before_rt2_highway_fe_notes = new Zend_Form_Element_Text('before_rt2_highway_fe_notes',array("readonly" => "readonly"));
			$before_rt2_highway_fe_notes->setLabel('EPA HIghway MPG Notes')
									  ->setValue($rt_results_level_2[0]['rt2_highway_fe_notes']);
			
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
		if(!empty($form2_Values['rt_disp_cc']))
		{
			$rt_disp_cc = new Zend_Form_Element_Text('rt_disp_cc');
			$rt_disp_cc->setValue($form2_Values['rt_disp_cc']);
			
			$before_rt_disp_cc = new Zend_Form_Element_Text('before_rt_disp_cc',array("readonly" => "readonly"));
			$before_rt_disp_cc->setLabel('Engine Displacement in cc')
									  ->setValue($rt_results_main[0]['rt_disp_cc']);
			
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
		if(!empty($form2_Values['rt2_int_vol_front']))
		{
			$rt2_int_vol_front = new Zend_Form_Element_Text('rt2_int_vol_front');
			$rt2_int_vol_front->setValue($form2_Values['rt2_int_vol_front']);
			
			$before_rt2_int_vol_front = new Zend_Form_Element_Text('before_rt2_int_vol_front',array("readonly" => "readonly"));
			$before_rt2_int_vol_front->setLabel('Interior Volume')
									  ->setValue($rt_results_level_2[0]['rt2_int_vol_front']);
			
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
		if(!empty($form2_Values['rt_rpm']))
		{
			$rt_rpm = new Zend_Form_Element_Text('rt_rpm');
			$rt_rpm->setValue($form2_Values['rt_rpm']);
			
			$before_rt_rpm = new Zend_Form_Element_Text('before_rt_rpm',array("readonly" => "readonly"));
			$before_rt_rpm->setLabel('Peak Horsepower RPM')
									  ->setValue($rt_results_main[0]['rt_rpm']);
			
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
		if(!empty($form2_Values['rt2_mid']))
		{
			$rt2_mid = new Zend_Form_Element_Text('rt2_mid');
			$rt2_mid->setValue($form2_Values['rt2_mid']);
			
			$before_rt2_mid = new Zend_Form_Element_Text('before_rt2_mid',array("readonly" => "readonly"));
			$before_rt2_mid->setLabel('Interior Volume Behind Middle Row Seats')
									  ->setValue($rt_results_level_2[0]['rt2_mid']);
			
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
		if(!empty($form2_Values['rt_rpmt']))
		{
			$rt_rpmt = new Zend_Form_Element_Text('rt_rpmt');
			$rt_rpmt->setValue($form2_Values['rt_rpmt']);
			
			$before_rt_rpmt = new Zend_Form_Element_Text('before_rt_rpmt',array("readonly" => "readonly"));
			$before_rt_rpmt->setLabel('Peak Torque RPM')
									  ->setValue($rt_results_main[0]['rt_rpmt']);
			
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
		if(!empty($form2_Values['rt2_passengers']))
		{
			$rt2_passengers = new Zend_Form_Element_Text('rt2_passengers');
			$rt2_passengers->setValue($form2_Values['rt2_passengers']);
			
			$before_rt2_passengers = new Zend_Form_Element_Text('before_rt2_passengers',array("readonly" => "readonly"));
			$before_rt2_passengers->setLabel('Number of Passengers')
									  ->setValue($rt_results_level_2[0]['rt2_passengers']);
			
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
		if(!empty($form2_Values['rt_slalom']))
		{
			$rt_slalom = new Zend_Form_Element_Text('rt_slalom');
			$rt_slalom->setValue($form2_Values['rt_slalom']);
			
			$before_rt_slalom = new Zend_Form_Element_Text('before_rt_slalom',array("readonly" => "readonly"));
			$before_rt_slalom->setLabel('Slalom Speed')
									  ->setValue($rt_results_main[0]['rt_slalom']);
			
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
		if(!empty($form2_Values['rt2_rear']))
		{
			$rt2_rear = new Zend_Form_Element_Text('rt2_rear');
			$rt2_rear->setValue($form2_Values['rt2_rear']);
			
			$before_rt2_rear = new Zend_Form_Element_Text('before_rt2_rear',array("readonly" => "readonly"));
			$before_rt2_rear->setLabel('Interior Volume Behind Rear Row Seats')
									  ->setValue($rt_results_level_2[0]['rt2_rear']);
			
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
		if(!empty($form2_Values['rt_ss60']))
		{
			$rt_ss60 = new Zend_Form_Element_Text('rt_ss60');
			$rt_ss60->setValue($form2_Values['rt_ss60']);
			
			$before_rt_ss60 = new Zend_Form_Element_Text('before_rt_ss60',array("readonly" => "readonly"));
			$before_rt_ss60->setLabel('Acceleration from 5 to 60 MPH')
									  ->setValue($rt_results_main[0]['rt_ss60']);
			
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
		if(!empty($form2_Values['rt2_sound_level_idle']))
		{
			$rt2_sound_level_idle = new Zend_Form_Element_Text('rt2_sound_level_idle');
			$rt2_sound_level_idle->setValue($form2_Values['rt2_sound_level_idle']);
			
			$before_rt2_sound_level_idle = new Zend_Form_Element_Text('before_rt2_sound_level_idle',array("readonly" => "readonly"));
			$before_rt2_sound_level_idle->setLabel('Sound Level At Idle')
									  ->setValue($rt_results_level_2[0]['rt2_sound_level_idle']);
			
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
		if(!empty($form2_Values['rt_weight']))
		{
			$rt_weight = new Zend_Form_Element_Text('rt_weight');
			$rt_weight->setValue($form2_Values['rt_weight']);
			
			$before_rt_weight = new Zend_Form_Element_Text('before_rt_weight',array("readonly" => "readonly"));
			$before_rt_weight->setLabel('Curb Weight')
			 ->setValue($rt_results_main[0]['rt_weight']);
			
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
		if(!empty($form2_Values['rt2_stab_defeatable']))
		{
			$rt2_stab_defeatable = new Zend_Form_Element_Text('rt2_stab_defeatable');
			$rt2_stab_defeatable->setValue($form2_Values['rt2_stab_defeatable']);
			
			$before_rt2_stab_defeatable = new Zend_Form_Element_Text('before_rt2_stab_defeatable',array("readonly" => "readonly"));
			$before_rt2_stab_defeatable->setLabel('Stability Control Fully Defeatable')
										->setValue($rt_results_level_2[0]['rt2_stab_defeatable']);
			
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
		if(!empty($form2_Values['rt2_emergency_lane_change']))
		{
			$rt2_emergency_lane_change = new Zend_Form_Element_Text('rt2_emergency_lane_change');
			$rt2_emergency_lane_change->setValue($form2_Values['rt2_emergency_lane_change']);
			
			$before_rt2_emergency_lane_change = new Zend_Form_Element_Text('before_rt2_emergency_lane_change',array("readonly" => "readonly"));
			$before_rt2_emergency_lane_change->setLabel('Speed In Emergency Lane Change')
										->setValue($rt_results_level_2[0]['rt2_emergency_lane_change']);
			
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
		if(!empty($form2_Values['rt2_stability_control']))
		{
			$rt2_stability_control = new Zend_Form_Element_Text('rt2_stability_control');
			$rt2_stability_control->setValue($form2_Values['rt2_stability_control']);
			
			$before_rt2_stability_control = new Zend_Form_Element_Text('before_rt2_stability_control',array("readonly" => "readonly"));
			$before_rt2_stability_control->setLabel('Stability Control')
										->setValue($rt_results_level_2[0]['rt2_stability_control']);
			
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
		if(!empty($form2_Values['rt2_skidpad']))
		{
			$rt2_skidpad = new Zend_Form_Element_Text('rt2_skidpad');
			$rt2_skidpad->setValue($form2_Values['rt2_skidpad']);
			
			$before_rt2_skidpad = new Zend_Form_Element_Text('before_rt2_skidpad',array("readonly" => "readonly"));
			$before_rt2_skidpad->setLabel('Skidpad')
										->setValue($rt_results_level_2[0]['rt2_skidpad']);
			
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
		if(!empty($form2_Values['rt2_sum_of_tg_times']))
		{
			$rt2_sum_of_tg_times = new Zend_Form_Element_Text('rt2_sum_of_tg_times');
			$rt2_sum_of_tg_times->setValue($form2_Values['rt2_sum_of_tg_times']);
			
			$before_rt2_sum_of_tg_times = new Zend_Form_Element_Text('before_rt2_sum_of_tg_times',array("readonly" => "readonly"));
			$before_rt2_sum_of_tg_times->setLabel('Sum of Top Gear Acceleration Times')
										->setValue($rt_results_level_2[0]['rt2_sum_of_tg_times']);
			
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
		if(!empty($form2_Values['rt2_100_mph']))
		{
			$rt2_100_mph = new Zend_Form_Element_Text('rt2_100_mph');
			$rt2_100_mph->setValue($form2_Values['rt2_100_mph']);
			
			$before_rt2_100_mph = new Zend_Form_Element_Text('before_rt2_100_mph',array("readonly" => "readonly"));
			$before_rt2_100_mph->setLabel('rt2_100_mph')
										->setValue($rt_results_level_2[0]['rt2_100_mph']);
			
			$rt2_100_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_100_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_100_mph,$rt2_100_mph));
		}
		if(!empty($form2_Values['rt2_trac_defeatable']))
		{
			$rt2_trac_defeatable = new Zend_Form_Element_Text('rt2_trac_defeatable');
			$rt2_trac_defeatable->setValue($form2_Values['rt2_trac_defeatable']);
			
			$before_rt2_trac_defeatable = new Zend_Form_Element_Text('before_rt2_trac_defeatable',array("readonly" => "readonly"));
			$before_rt2_trac_defeatable->setLabel('Traction Control Fully Defeatable')
										->setValue($rt_results_level_2[0]['rt2_trac_defeatable']);
			
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
		if(!empty($form2_Values['rt2_130_mph']))
		{
			$rt2_130_mph = new Zend_Form_Element_Text('rt2_130_mph');
			$rt2_130_mph->setValue($form2_Values['rt2_130_mph']);
			
			$before_rt2_130_mph = new Zend_Form_Element_Text('before_rt2_130_mph',array("readonly" => "readonly"));
			$before_rt2_130_mph->setLabel('Acceleration to 130 MPH')
										->setValue($rt_results_level_2[0]['rt2_130_mph']);
			
			$rt2_130_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_130_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_130_mph,$rt2_130_mph));
		}
		if(!empty($form2_Values['rt2_traction_control']))
		{
			$rt2_traction_control = new Zend_Form_Element_Text('rt2_traction_control');
			$rt2_traction_control->setValue($form2_Values['rt2_traction_control']);
			
			$before_rt2_traction_control = new Zend_Form_Element_Text('before_rt2_traction_control',array("readonly" => "readonly"));
			$before_rt2_traction_control->setLabel('Traction Control')
										->setValue($rt_results_level_2[0]['rt2_traction_control']);
			
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
		if(!empty($form2_Values['rt2_30_50TG']))
		{
			$rt2_30_50TG = new Zend_Form_Element_Text('rt2_30_50TG');
			$rt2_30_50TG->setValue($form2_Values['rt2_30_50TG']);
			
			$before_rt2_30_50TG = new Zend_Form_Element_Text('before_rt2_30_50TG',array("readonly" => "readonly"));
			$before_rt2_30_50TG->setLabel('Top Gear Acceleration from 30 to 50 MPH')
										->setValue($rt_results_level_2[0]['rt2_30_50TG']);
			
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
		if(!empty($form2_Values['rt2_turning_cir']))
		{
			$rt2_turning_cir = new Zend_Form_Element_Text('rt2_turning_cir');
			$rt2_turning_cir->setValue($form2_Values['rt2_turning_cir']);
			
			$before_rt2_turning_cir = new Zend_Form_Element_Text('before_rt2_turning_cir',array("readonly" => "readonly"));
			$before_rt2_turning_cir->setLabel('Turning Radius')
										->setValue($rt_results_level_2[0]['rt2_turning_cir']);
			
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
		if(!empty($form2_Values['rt2_30_mph']))
		{
			$rt2_30_mph = new Zend_Form_Element_Text('rt2_30_mph');
			$rt2_30_mph->setValue($form2_Values['rt2_30_mph']);
			
			$before_rt2_30_mph = new Zend_Form_Element_Text('before_rt2_30_mph',array("readonly" => "readonly"));
			$before_rt2_30_mph->setLabel('Acceleration to 30 MPH')
										->setValue($rt_results_level_2[0]['rt2_30_mph']);
			
			$rt2_30_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
			$before_rt2_30_mph->setDecorators(array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'align' => 'center')),
			array('Label', array('tag' => 'td','style' => 'float:right;')),
			));
			
			$this->addElements(array($before_rt2_30_mph,$rt2_30_mph));
		}
		if(!empty($form2_Values['rt2_wot']))
		{
			$rt2_wot = new Zend_Form_Element_Text('rt2_wot');
			$rt2_wot->setValue($form2_Values['rt2_wot']);
			
			$before_rt2_wot = new Zend_Form_Element_Text('before_rt2_wot',array("readonly" => "readonly"));
			$before_rt2_wot->setLabel('Sound Level At Wide Open Throttle')
										->setValue($rt_results_level_2[0]['rt2_wot']);
			
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
		if(!empty($form2_Values['rt2_50-70TG']))
		{
			$rt2_50_70TG = new Zend_Form_Element_Text('rt2_50-70TG');
			$rt2_50_70TG->setValue($form2_Values['rt2_50-70TG']);
			
			$before_rt2_50_70TG = new Zend_Form_Element_Text('before_rt2_50-70TG',array("readonly" => "readonly"));
			$before_rt2_50_70TG->setLabel('Top Gear Acceleration from 50 to 70 MPH')
										->setValue($rt_results_level_2[0]['rt2_50-70TG']);
			
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
		if(!empty($form2_Values['rt3_boost_psi']))
		{
			$rt3_boost_psi = new Zend_Form_Element_Text('rt3_boost_psi');
			$rt3_boost_psi->setValue($form2_Values['rt3_boost_psi']);
			
			$before_rt3_boost_psi = new Zend_Form_Element_Text('before_rt3_boost_psi',array("readonly" => "readonly"));
			$before_rt3_boost_psi->setLabel('Forced Induction Boost Pressure in psi')
										->setValue($rt_results_level_3[0]['rt3_boost_psi']);
			
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
		if(!empty($form2_Values['rt2_50_mph']))
		{
			$rt2_50_mph = new Zend_Form_Element_Text('rt2_50_mph');
			$rt2_50_mph->setValue($form2_Values['rt2_50_mph']);
			
			$before_rt2_50_mph = new Zend_Form_Element_Text('before_rt2_50_mph',array("readonly" => "readonly"));
			$before_rt2_50_mph->setLabel('rt2_50_mph')
										->setValue($rt_results_level_2[0]['rt2_50_mph']);
			
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
		if(!empty($form2_Values['rt3_bore_mm']))
		{
			$rt3_bore_mm = new Zend_Form_Element_Text('rt3_bore_mm');
			$rt3_bore_mm->setValue($form2_Values['rt3_bore_mm']);
			
			$before_rt3_bore_mm = new Zend_Form_Element_Text('before_rt3_bore_mm',array("readonly" => "readonly"));
			$before_rt3_bore_mm->setLabel('Cylinder Bore')
										->setValue($rt_results_level_3[0]['rt3_bore_mm']);
			
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
		if(!empty($form2_Values['rt2_70cr']))
		{
			$rt2_70cr = new Zend_Form_Element_Text('rt2_70cr');
			$rt2_70cr->setValue($form2_Values['rt2_70cr']);
			
			$before_rt2_70cr = new Zend_Form_Element_Text('before_rt2_70cr',array("readonly" => "readonly"));
			$before_rt2_70cr->setLabel('Sound Level At 70 MPH Crusing')
										->setValue($rt_results_level_2[0]['rt2_70cr']);
			
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
		if(!empty($form2_Values['rt3_cd']))
		{
			$rt3_cd = new Zend_Form_Element_Text('rt3_cd');
			$rt3_cd->setValue($form2_Values['rt3_cd']);
			
			$before_rt3_cd = new Zend_Form_Element_Text('before_rt3_cd',array("readonly" => "readonly"));
			$before_rt3_cd->setLabel('Coefficient of Drag')
										->setValue($rt_results_level_3[0]['rt3_cd']);
			
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
		if(!empty($form2_Values['rt2_70_mph']))
		{
			$rt2_70_mph = new Zend_Form_Element_Text('rt2_70_mph');
			$rt2_70_mph->setValue($form2_Values['rt2_70_mph']);
			
			$before_rt2_70_mph = new Zend_Form_Element_Text('before_rt2_70_mph',array("readonly" => "readonly"));
			$before_rt2_70_mph->setLabel('rt2_70_mph')
										->setValue($rt_results_level_2[0]['rt2_70_mph']);
			
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
		if(!empty($form2_Values['rt3_comp_ratio']))
		{
			$rt3_comp_ratio = new Zend_Form_Element_Text('rt3_comp_ratio');
			$rt3_comp_ratio->setValue($form2_Values['rt3_comp_ratio']);
			
			$before_rt3_comp_ratio = new Zend_Form_Element_Text('before_rt3_comp_ratio',array("readonly" => "readonly"));
			$before_rt3_comp_ratio->setLabel('Engine Compression Ratio')
										->setValue($rt_results_level_3[0]['rt3_comp_ratio']);
			
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
		if(!empty($form2_Values['rt2_controlled_airbags']))
		{
			$rt_controlled_airbags_prepared = $this->gatMultioptions("Airbags");
			
			$rt2_controlled_airbags = new Zend_Form_Element_Select('rt2_controlled_airbags',array('style'=>'width:150px;'));
			$rt2_controlled_airbags->addMultiOptions($rt_controlled_airbags_prepared)
						->setValue($form2_Values['rt2_controlled_airbags']);
						
			$before_rt2_controlled_airbags = new Zend_Form_Element_Text('before_rt2_controlled_airbags',array("readonly" => "readonly"));
			$before_rt2_controlled_airbags->setLabel('Listing of Airbag Positions')
										->setValue($rt_results_level_2[0]['rt2_controlled_airbags']);
			
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
		if(!empty($form2_Values['rt3_et_factor']))
		{
			$rt3_et_factor = new Zend_Form_Element_Text('rt3_et_factor');
			$rt3_et_factor->setValue($form2_Values['rt3_et_factor']);
			
			$before_rt3_et_factor = new Zend_Form_Element_Text('before_rt3_et_factor',array("readonly" => "readonly"));
			$before_rt3_et_factor->setLabel('rt3_et_factor')
								 ->setValue($rt_results_level_3[0]['rt3_et_factor']);
			
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
		if(!empty($form3_Values['rt3_final_drive_ratio']))
		{
			$rt3_final_drive_ratio = new Zend_Form_Element_Text('rt3_final_drive_ratio');
			$rt3_final_drive_ratio->setValue($form3_Values['rt3_final_drive_ratio']);
			
			$before_rt3_final_drive_ratio = new Zend_Form_Element_Text('before_rt3_final_drive_ratio',array("readonly" => "readonly"));
			$before_rt3_final_drive_ratio->setLabel('Final Drive Ratio')
										->setValue($rt_results_level_3[0]['rt3_final_drive_ratio']);
			
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
		if(!empty($form3_Values['rt3_width']))
		{
			$rt3_width = new Zend_Form_Element_Text('rt3_width');
			$rt3_width->setValue($form3_Values['rt3_width']);
			
			$before_rt3_width = new Zend_Form_Element_Text('before_rt3_width',array("readonly" => "readonly"));
			$before_rt3_width->setLabel('Vehicle Width')
								 ->setValue($rt_results_level_3[0]['rt3_width']);
			
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
		if(!empty($form3_Values['rt3_frontal_area']))
		{
			$rt3_frontal_area = new Zend_Form_Element_Text('rt3_frontal_area');
			$rt3_frontal_area->setValue($form3_Values['rt3_frontal_area']);
			
			$before_rt3_frontal_area = new Zend_Form_Element_Text('before_rt3_frontal_area',array("readonly" => "readonly"));
			$before_rt3_frontal_area->setLabel('Vehicle Frontal Area')
								 ->setValue($rt_results_level_3[0]['rt3_frontal_area']);
			
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
		if(!empty($form3_Values['rt3_valves_per_cyl']))
		{
			$rt3_valves_per_cyl = new Zend_Form_Element_Text('rt3_valves_per_cyl');
			$rt3_valves_per_cyl->setValue($form3_Values['rt3_valves_per_cyl']);
			
			$before_rt3_valves_per_cyl = new Zend_Form_Element_Text('before_rt3_valves_per_cyl',array("readonly" => "readonly"));
			$before_rt3_valves_per_cyl->setLabel('Valves Per Cylinder')
								 ->setValue($rt_results_level_3[0]['rt3_valves_per_cyl']);
			
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
		if(!empty($form3_Values['rt3_frontal_area_notes']))
		{
			$rt3_frontal_area_notes = new Zend_Form_Element_Text('rt3_frontal_area_notes');
			$rt3_frontal_area_notes->setValue($form3_Values['rt3_frontal_area_notes']);
			
			$before_rt3_frontal_area_notes = new Zend_Form_Element_Text('before_rt3_frontal_area_notes',array("readonly" => "readonly"));
			$before_rt3_frontal_area_notes->setLabel('Vehicle Frontal Area Notes')
								 ->setValue($rt_results_level_3[0]['rt3_frontal_area_notes']);
			
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
		if(!empty($form3_Values['rt3_wheelbase']))
		{
			$rt3_wheelbase = new Zend_Form_Element_Text('rt3_wheelbase');
			$rt3_wheelbase->setValue($form3_Values['rt3_wheelbase']);
			
			$before_rt3_wheelbase = new Zend_Form_Element_Text('before_rt3_wheelbase',array("readonly" => "readonly"));
			$before_rt3_wheelbase->setLabel('Wheelbase Length')
								 ->setValue($rt_results_level_3[0]['rt3_wheelbase']);
			
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
		if(!empty($form3_Values['rt3_fuel_cap']))
		{
			$rt3_fuel_cap = new Zend_Form_Element_Text('rt3_fuel_cap');
			$rt3_fuel_cap->setValue($form3_Values['rt3_fuel_cap']);
			
			$before_rt3_fuel_cap = new Zend_Form_Element_Text('before_rt3_fuel_cap',array("readonly" => "readonly"));
			$before_rt3_fuel_cap->setLabel('Fuel Capacity')
								 ->setValue($rt_results_level_3[0]['rt3_fuel_cap']);
			
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
		if(!empty($form3_Values['rt3_70co']))
		{
			$rt3_70co = new Zend_Form_Element_Text('rt3_70co');
			$rt3_70co->setValue($form3_Values['rt3_70co']);
			
			$before_rt3_70co = new Zend_Form_Element_Text('before_rt3_70co',array("readonly" => "readonly"));
			$before_rt3_70co->setLabel('Sound at 70 MPH Coasting')
								 ->setValue($rt_results_level_3[0]['rt3_70co']);
			
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
		if(!empty($form3_Values['rt3_height']))
		{
			$rt3_height = new Zend_Form_Element_Text('rt3_height');
			$rt3_height->setValue($form3_Values['rt3_height']);
			
			$before_rt3_height = new Zend_Form_Element_Text('before_rt3_height',array("readonly" => "readonly"));
			$before_rt3_height->setLabel('Vehicle Height')
								 ->setValue($rt_results_level_3[0]['rt3_height']);
			
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
		if(!empty($form3_Values['rt3_10mph']))
		{
			$rt3_10mph = new Zend_Form_Element_Text('rt3_10mph');
			$rt3_10mph->setValue($form3_Values['rt3_10mph']);
			
			$before_rt3_10mph = new Zend_Form_Element_Text('before_rt3_10mph',array("readonly" => "readonly"));
			$before_rt3_10mph->setLabel('rt3_10mph')
								 ->setValue($rt_results_level_3[0]['rt3_10mph']);
			
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
		if(!empty($form3_Values['rt3_length']))
		{
			$rt3_length = new Zend_Form_Element_Text('rt3_length');
			$rt3_length->setValue($form3_Values['rt3_length']);
			
			$before_rt3_length = new Zend_Form_Element_Text('before_rt3_length',array("readonly" => "readonly"));
			$before_rt3_length->setLabel('Vehicle Length')
								 ->setValue($rt_results_level_3[0]['rt3_length']);
			
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
		if(!empty($form3_Values['rt3_20mph']))
		{
			$rt3_20mph = new Zend_Form_Element_Text('rt3_20mph');
			$rt3_20mph->setValue($form3_Values['rt3_20mph']);
			
			$before_rt3_20mph = new Zend_Form_Element_Text('before_rt3_20mph',array("readonly" => "readonly"));
			$before_rt3_20mph->setLabel('rt3_20mph')
								 ->setValue($rt_results_level_3[0]['rt3_20mph']);
			
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
		if(!empty($form3_Values['rt3_lt_oil']))
		{
			$rt3_lt_oil = new Zend_Form_Element_Text('rt3_lt_oil');
			$rt3_lt_oil->setValue($form3_Values['rt3_lt_oil']);
			
			$before_rt3_lt_oil = new Zend_Form_Element_Text('before_rt3_lt_oil',array("readonly" => "readonly"));
			$before_rt3_lt_oil->setLabel('Long-term Oil Used')
								 ->setValue($rt_results_level_3[0]['rt3_lt_oil']);
			
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
		if(!empty($form3_Values['rt3_40mph']))
		{
			$rt3_40mph = new Zend_Form_Element_Text('rt3_40mph');
			$rt3_40mph->setValue($form3_Values['rt3_40mph']);
			
			$before_rt3_40mph = new Zend_Form_Element_Text('before_rt3_40mph',array("readonly" => "readonly"));
			$before_rt3_40mph->setLabel('rt3_40mph')
								 ->setValue($rt_results_level_3[0]['rt3_40mph']);
			
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
		if(!empty($form3_Values['rt3_lt_repair']))
		{
			$rt3_lt_repiar = new Zend_Form_Element_Text('rt3_lt_repair');
			$rt3_lt_repiar->setValue($form3_Values['rt3_lt_repair']);
			
			$before_rt3_lt_repiar = new Zend_Form_Element_Text('before_rt3_lt_repair',array("readonly" => "readonly"));
			$before_rt3_lt_repiar->setLabel('Long-term Costs for Repair')
								 ->setValue($rt_results_level_3[0]['rt3_lt_repair']);
			
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
		if(!empty($form3_Values['rt3_50mph']))
		{
			$rt3_50mph = new Zend_Form_Element_Text('rt3_50mph');
			$rt3_50mph->setValue($form3_Values['rt3_50mph']);
			
			$before_rt3_50mph = new Zend_Form_Element_Text('before_rt3_50mph',array("readonly" => "readonly"));
			$before_rt3_50mph->setLabel('rt3_50mph')
								 ->setValue($rt_results_level_3[0]['rt3_50mph']);
			
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
		if(!empty($form3_Values['rt3_lt_serv']))
		{
			$rt3_lt_serv = new Zend_Form_Element_Text('rt3_lt_serv');
			$rt3_lt_serv->setValue($form3_Values['rt3_lt_serv']);
			
			$before_rt3_lt_serv = new Zend_Form_Element_Text('before_rt3_lt_serv',array("readonly" => "readonly"));
			$before_rt3_lt_serv->setLabel('Long-term Costs for Service')
								 ->setValue($rt_results_level_3[0]['rt3_lt_serv']);
			
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
		if(!empty($form3_Values['rt3_70mph']))
		{
			$rt3_70mph = new Zend_Form_Element_Text('rt3_70mph');
			$rt3_70mph->setValue($form3_Values['rt3_70mph']);
			
			$before_rt3_70mph = new Zend_Form_Element_Text('before_rt3_70mph',array("readonly" => "readonly"));
			$before_rt3_70mph->setLabel('rt3_70mph')
								 ->setValue($rt_results_level_3[0]['rt3_70mph']);
			
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
		if(!empty($form3_Values['rt3_lt_stps_sched']))
		{
			$rt3_lt_stps_sched = new Zend_Form_Element_Text('rt3_lt_stps_sched');
			$rt3_lt_stps_sched->setValue($form3_Values['rt3_lt_stps_sched']);
			
			$before_rt3_lt_stps_sched = new Zend_Form_Element_Text('before_rt3_lt_stps_sched',array("readonly" => "readonly"));
			$before_rt3_lt_stps_sched->setLabel('Long-term Scheduled Stops')
								 ->setValue($rt_results_level_3[0]['rt3_lt_stps_sched']);
			
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
		if(!empty($form3_Values['rt3_80mph']))
		{
			$rt3_80mph = new Zend_Form_Element_Text('rt3_80mph');
			$rt3_80mph->setValue($form3_Values['rt3_80mph']);
			
			$before_rt3_80mph = new Zend_Form_Element_Text('before_rt3_80mph',array("readonly" => "readonly"));
			$before_rt3_80mph->setLabel('rt3_80mph')
								 ->setValue($rt_results_level_3[0]['rt3_80mph']);
			
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
		if(!empty($form3_Values['rt3_lt_stps_unsched']))
		{
			$rt3_lt_stps_unsched = new Zend_Form_Element_Text('rt3_lt_stps_unsched');
			$rt3_lt_stps_unsched->setValue($form3_Values['rt3_lt_stps_unsched']);
			
			$before_rt3_lt_stps_unsched = new Zend_Form_Element_Text('before_rt3_lt_stps_unsched',array("readonly" => "readonly"));
			$before_rt3_lt_stps_unsched->setLabel('Long-term Unscheduled Stops')
								 ->setValue($rt_results_level_3[0]['rt3_lt_stps_unsched']);
			
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
		if(!empty($form3_Values['rt3_90mph']))
		{
			$rt3_90mph = new Zend_Form_Element_Text('rt3_90mph');
			$rt3_90mph->setValue($form3_Values['rt3_90mph']);
			
			$before_rt3_90mph = new Zend_Form_Element_Text('before_rt3_90mph',array("readonly" => "readonly"));
			$before_rt3_90mph->setLabel('rt3_90mph')
								 ->setValue($rt_results_level_3[0]['rt3_90mph']);
			
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
		if(!empty($form3_Values['rt3_lt_wear']))
		{
			$rt3_lt_wear = new Zend_Form_Element_Text('rt3_lt_wear');
			$rt3_lt_wear->setValue($form3_Values['rt3_lt_wear']);
			
			$before_rt3_lt_wear = new Zend_Form_Element_Text('before_rt3_lt_wear',array("readonly" => "readonly"));
			$before_rt3_lt_wear->setLabel('Long-term Costs for Wear')
								 ->setValue($rt_results_level_3[0]['rt3_lt_wear']);
			
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
		if(!empty($form3_Values['rt3_110mph']))
		{
			$rt3_110mph = new Zend_Form_Element_Text('rt3_110mph');
			$rt3_110mph->setValue($form3_Values['rt3_110mph']);
			
			$before_rt3_110mph = new Zend_Form_Element_Text('before_rt3_110mph',array("readonly" => "readonly"));
			$before_rt3_110mph->setLabel('rt3_110mph')
								 ->setValue($rt_results_level_3[0]['rt3_110mph']);
			
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
		if(!empty($form3_Values['rt3_max_mph_1000_rpm']))
		{
			$rt3_max_mph_1000_rpm = new Zend_Form_Element_Text('rt3_max_mph_1000_rpm');
			$rt3_max_mph_1000_rpm->setValue($form3_Values['rt3_max_mph_1000_rpm']);
			
			$before_rt3_max_mph_1000_rpm = new Zend_Form_Element_Text('before_rt3_max_mph_1000_rpm',array("readonly" => "readonly"));
			$before_rt3_max_mph_1000_rpm->setLabel('Top Gear MPH per 1000 RPM')
								 ->setValue($rt_results_level_3[0]['rt3_max_mph_1000_rpm']);
			
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
		if(!empty($form3_Values['rt3_120mph']))
		{
			$rt3_120mph = new Zend_Form_Element_Text('rt3_120mph');
			$rt3_120mph->setValue($form3_Values['rt3_120mph']);
			
			$before_rt3_120mph = new Zend_Form_Element_Text('before_rt3_120mph',array("readonly" => "readonly"));
			$before_rt3_120mph->setLabel('rt3_120mph')
								 ->setValue($rt_results_level_3[0]['rt3_120mph']);
			
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
		if(!empty($form3_Values['rt3_peak_bmep']))
		{
			$rt3_peak_bmep = new Zend_Form_Element_Text('rt3_peak_bmep');
			$rt3_peak_bmep->setValue($form3_Values['rt3_peak_bmep']);
			
			$before_rt3_peak_bmep = new Zend_Form_Element_Text('before_rt3_peak_bmep',array("readonly" => "readonly"));
			$before_rt3_peak_bmep->setLabel('rt3_peak_bmep')
								 ->setValue($rt_results_level_3[0]['rt3_peak_bmep']);
			
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
		if(!empty($form3_Values['rt3_140mph']))
		{
			$rt3_140mph = new Zend_Form_Element_Text('rt3_140mph');
			$rt3_140mph->setValue($form3_Values['rt3_140mph']);
			
			$before_rt3_140mph = new Zend_Form_Element_Text('before_rt3_140mph',array("readonly" => "readonly"));
			$before_rt3_140mph->setLabel('rt3_140mph')
								 ->setValue($rt_results_level_3[0]['rt3_140mph']);
			
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
		if(!empty($form3_Values['rt3_peal_bmep']))
		{
			$rt3_peal_bmep = new Zend_Form_Element_Text('rt3_peal_bmep');
			$rt3_peal_bmep->setValue($form3_Values['rt3_peal_bmep']);
			
			$before_rt3_peal_bmep = new Zend_Form_Element_Text('before_rt3_peal_bmep',array("readonly" => "readonly"));
			$before_rt3_peal_bmep->setLabel('rt3_peal_bmep')
								 ->setValue($rt_results_level_3[0]['rt3_peal_bmep']);
			
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
		if(!empty($form3_Values['rt3_150mph']))
		{
			$rt3_150mph = new Zend_Form_Element_Text('rt3_150mph');
			$rt3_150mph->setValue($form3_Values['rt3_150mph']);
			
			$before_rt3_150mph = new Zend_Form_Element_Text('before_rt3_150mph',array("readonly" => "readonly"));
			$before_rt3_150mph->setLabel('rt3_150mph')
								 ->setValue($rt_results_level_3[0]['rt3_150mph']);
			
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
		if(!empty($form3_Values['rt3_road_hp_30mph']))
		{
			$rt3_road_hp_30mph = new Zend_Form_Element_Text('rt3_road_hp_30mph');
			$rt3_road_hp_30mph->setValue($form3_Values['rt3_road_hp_30mph']);
			
			$before_rt3_road_hp_30mph = new Zend_Form_Element_Text('before_rt3_road_hp_30mph',array("readonly" => "readonly"));
			$before_rt3_road_hp_30mph->setLabel('rt3_road_hp_30mph')
								 ->setValue($rt_results_level_3[0]['rt3_road_hp_30mph']);
			
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
		if(!empty($form3_Values['rt3_160mph']))
		{
			$rt3_160mph = new Zend_Form_Element_Text('rt3_160mph');
			$rt3_160mph->setValue($form3_Values['rt3_160mph']);
			
			$before_rt3_160mph = new Zend_Form_Element_Text('before_rt3_160mph',array("readonly" => "readonly"));
			$before_rt3_160mph->setLabel('rt3_160mph')
								 ->setValue($rt_results_level_3[0]['rt3_160mph']);
			
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
		if(!empty($form3_Values['rt3_sp_factor']))
		{
			$rt3_sp_factor = new Zend_Form_Element_Text('rt3_sp_factor');
			$rt3_sp_factor->setValue($form3_Values['rt3_sp_factor']);
			
			$before_rt3_sp_factor = new Zend_Form_Element_Text('before_rt3_sp_factor',array("readonly" => "readonly"));
			$before_rt3_sp_factor->setLabel('rt3_sp_factor')
								 ->setValue($rt_results_level_3[0]['rt3_sp_factor']);
			
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
		if(!empty($form3_Values['rt3_170mph']))
		{
			$rt3_170mph = new Zend_Form_Element_Text('rt3_170mph');
			$rt3_170mph->setValue($form3_Values['rt3_170mph']);
			
			$before_rt3_170mph = new Zend_Form_Element_Text('before_rt3_170mph',array("readonly" => "readonly"));
			$before_rt3_170mph->setLabel('rt3_170mph')
								 ->setValue($rt_results_level_3[0]['rt3_170mph']);
			
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
		if(!empty($form3_Values['rt3_specific_power']))
		{
			$rt3_specific_power = new Zend_Form_Element_Text('rt3_specific_power');
			$rt3_specific_power->setValue($form3_Values['rt3_specific_power']);
			
			$before_rt3_specific_power = new Zend_Form_Element_Text('before_rt3_specific_power',array("readonly" => "readonly"));
			$before_rt3_specific_power->setLabel('Horsepower per Liter')
								 ->setValue($rt_results_level_3[0]['rt3_specific_power']);
			
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
		if(!empty($form3_Values['rt3_180mph']))
		{
			$rt3_180mph = new Zend_Form_Element_Text('rt3_180mph');
			$rt3_180mph->setValue($form3_Values['rt3_180mph']);
			
			$before_rt3_180mph = new Zend_Form_Element_Text('before_rt3_180mph',array("readonly" => "readonly"));
			$before_rt3_180mph->setLabel('rt3_180mph')
								 ->setValue($rt_results_level_3[0]['rt3_180mph']);
			
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
		if(!empty($form3_Values['rt3_stroke_mm']))
		{
			$rt3_stroke_mm = new Zend_Form_Element_Text('rt3_stroke_mm');
			$rt3_stroke_mm->setValue($form3_Values['rt3_stroke_mm']);
			
			$before_rt3_stroke_mm = new Zend_Form_Element_Text('before_rt3_stroke_mm',array("readonly" => "readonly"));
			$before_rt3_stroke_mm->setLabel('Cylinder Stroke')
								 ->setValue($rt_results_level_3[0]['rt3_stroke_mm']);
			
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
		if(!empty($form3_Values['rt3_190mph']))
		{
			$rt3_190mph = new Zend_Form_Element_Text('rt3_190mph');
			$rt3_190mph->setValue($form3_Values['rt3_190mph']);
			
			$before_rt3_190mph = new Zend_Form_Element_Text('before_rt3_190mph',array("readonly" => "readonly"));
			$before_rt3_190mph->setLabel('rt3_190mph')
								 ->setValue($rt_results_level_3[0]['rt3_190mph']);
			
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
		if(!empty($form3_Values['rt3_trunk']))
		{
			$rt3_trunk = new Zend_Form_Element_Text('rt3_trunk');
			$rt3_trunk->setValue($form3_Values['rt3_trunk']);
			
			$before_rt3_trunk = new Zend_Form_Element_Text('before_rt3_trunk',array("readonly" => "readonly"));
			$before_rt3_trunk->setLabel('Trunk Volume')
								 ->setValue($rt_results_level_3[0]['rt3_trunk']);
			
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
		if(!empty($form3_Values['rt3_200mph']))
		{
			$rt3_200mph = new Zend_Form_Element_Text('rt3_200mph');
			$rt3_200mph->setValue($form3_Values['rt3_200mph']);
			
			$before_rt3_200mph = new Zend_Form_Element_Text('before_rt3_200mph',array("readonly" => "readonly"));
			$before_rt3_200mph->setLabel('rt3_200mph')
								 ->setValue($rt_results_level_3[0]['rt3_200mph']);
			
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
		if(!empty($form3_Values['rt3_valve_gear']))
		{
			$rt3_valve_gear = new Zend_Form_Element_Text('rt3_valve_gear');
			$rt3_valve_gear->setValue($form3_Values['rt3_valve_gear']);
			
			$before_rt3_valve_gear = new Zend_Form_Element_Text('before_rt3_valve_gear',array("readonly" => "readonly"));
			$before_rt3_valve_gear->setLabel('Valve Setup')
								 ->setValue($rt_results_level_3[0]['rt3_valve_gear']);
			
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