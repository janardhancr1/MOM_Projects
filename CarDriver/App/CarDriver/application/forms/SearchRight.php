<?php
class Application_Form_SearchRight extends Application_Form_MainForm
{
  	
	public function init()
	{
		$this
		->setAttribs(array(
        'id' => 'search_form',
        'class' => 'global_search_form',
		));
		
		$db = Zend_Db_Table::getDefaultAdapter(); 
		
		$years_prepared[0]= "Select or Leave blank";
		$objDOM = new DOMDocument(); 
		$objDOM->load("http://buyersguide.caranddriver.com/api/years?mode=xml"); 
		$xpath = new DOMXPath($objDOM);
		$query = '//response/data/row/name';
        
        $entries = $xpath->query($query);
        
		foreach( $entries as $entry)
		{
			$name  = $entry->nodeValue;
			$id  = $entry->previousSibling->nodeValue;
			$years_prepared[$id]= $name;
		
		}
		
		arsort($years_prepared);
		
		$year = $this->createElement('select','year',array('style'=>'width:130px;'))
		->setLabel('Year')
		->addMultiOptions($years_prepared);
		
		
		$this->addElement($year);
        
		$makes_prepared[0]= "Select or Leave blank";
		$objDOM = new DOMDocument(); 
		$objDOM->load("http://buyersguide.caranddriver.com/api/makes?mode=xml"); 
		$row = $objDOM->getElementsByTagName("row"); 
		foreach( $row as $value )
		{
		    $names = $value->getElementsByTagName("name");
		    $name  = $names->item(0)->nodeValue;
			
			$ids = $value->getElementsByTagName("id");
		    $id  = $ids->item(0)->nodeValue;
			
		    $makes_prepared[$id]= $name;
		 }
		
		$make = $this->createElement('select','make',array('style'=>'width:130px;'))
		->setLabel('Make')
		->addMultiOptions($makes_prepared);
		$make->setAttrib('onchange','AutoFillModelSearch(this.value)');
		
		$this->addElement($make);

		$session_makeid = new Zend_Session_Namespace('makeid');
	    if(isset($session_makeid->make_id))
	    {		
		    $models_prepared[0]= "Select or Leave blank";
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
				
			    if($session_makeid->make_id == $make_id)
			    	$models_prepared[$id]= $name;
			 }
	    }
	    else
	     $models_prepared[0]= "Select or Leave blank";
		
		$model = $this->createElement('select','model',array('style'=>'width:130px;'))
		->setLabel('Model')
		->addMultiOptions($models_prepared);
		$model->setAttrib('onchange','AutoFillSubModelSearch(this.value)');
		
		$this->addElement($model);
		
		$bg_submodel_ids_prepared[0]= "Select or Leave blank";
		$session_yearid = new Zend_Session_Namespace('yearid');
		
    	//$modelid = $session_modelid->modelid;
		if(isset($session_yearid->year_id) && isset($session_yearid->model_id))
		{
			$yearid =$session_yearid->year_id;
			$modelid = $session_yearid->model_id;
			$bg_submodel_ids_prepared[0]= "Select or Leave blank";
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
		
		$subModel = $this->createElement('select','submodel',array('style'=>'width:130px;'))
		->setLabel('Sub Model')
		->addMultiOptions($bg_submodel_ids_prepared);
		
		$this->addElement($subModel);
		
		$submit1 = $this->createElement('submit','submit1',array('label'=>'GO'));
		$this->addElement($submit1);
		
		$this->setElementDecorators(array(
			'ViewHelper',
			'Errors',
			array(array('data'=>'HtmlTag'),array('tag'=>'div', 'class'=>'form_element')),
			array('Label',array('tag'=>'div')),
			array(array('row'=>'HtmlTag'),array('tag'=>'div', 'class'=>'form_wrapper'))
		));
		
		$this->setDecorators(array(
			'FormElements',
			array(array('data'=>'HtmlTag'),array('tag'=>'div')),
			'Form'
		));

	}
	
	
}
?>