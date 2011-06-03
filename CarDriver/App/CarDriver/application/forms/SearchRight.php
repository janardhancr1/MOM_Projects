<?php
class Application_Form_SearchRight extends Application_Form_MainForm
{
	public $makeid;
 
  	public function __construct($id) 
  	{ 
     	$this->makeid = $id;
     	parent::__construct();
     
  	} 
  	
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
		$row = $objDOM->getElementsByTagName("row"); 
		foreach( $row as $value )
		{
		    $names = $value->getElementsByTagName("name");
		    $name  = $names->item(0)->nodeValue;
			
			$ids = $value->getElementsByTagName("id");
		    $id  = $ids->item(0)->nodeValue;
			
		    $years_prepared[$id]= $name;
		 }
		
		$year = $this->createElement('select','year')
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
		
		$make = $this->createElement('select','make')
		->setLabel('Make')
		->addMultiOptions($makes_prepared)
		->setAttrib('onChange', 'this.form.submit();');
		$this->addElement($make);
	             
	    if($this->makeid != 0)
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
				
			    if($this->makeid == $make_id)
			    	$models_prepared[$id]= $name;
			 }
	    }
	    else
	     $models_prepared[0]= "Select or Leave blank";
		
		$model = $this->createElement('select','model')
		->setLabel('Model')
		->addMultiOptions($models_prepared);
		
		$this->addElement($model);
		
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