<?php
class Application_Form_Add extends Application_Form_MainForm
{
	public function init()
	{
		$db = $this->getDbConnection();
		$enterid = $this->createElement('text','id');
		$enterid->setLabel('id');
		$enterid->setAttrib('size','20');
		
		$this->addElement($enterid);
		
		$enterid->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag' =>'td','class' =>'element','style' => 'width:45%')),
		array('Label',array('tag'=>'td', 'style' => 'font-family:arial; font-weight:bold; font-size:14px; width:50%')),
		
		));
		
		
		$select = $db->select()
	             ->from('bg_year')
	             ->where('state = ?', 'published')
	             ->order('name DESC');
        $years = $db->query($select)->fetchAll();
	       
		if (count($years)!=0){
				$years_prepared[0]= "Select or Leave blank";
				foreach ($years as $Yea){
						$years_prepared[$Yea['id']]= $Yea['name'];
				}
		}
		
		$year = $this->createElement('select','year')
		->setLabel('Year')
		->addMultiOptions($years_prepared);
		$this->addElement($year);
		
		$year->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag' =>'td','class' =>'element','style' => 'width:45%')),
		array('Label',array('tag'=>'td', 'style' => 'font-family:arial; font-weight:bold; font-size:14px; width:5%')),
		
		));
		
		$this->setDecorators(array(
    	'FormElements',
    	array('HtmlTag', array('tag' => 'tr', 'style' => 'width:100%')),
    	'Form',
    	));
		
		$this->setDecorators(array(
    	'FormElements',
    	array('HtmlTag', array('tag' => 'table', 'style' => 'width:100%; aligh:center;')),
    	'Form',
		));
		
	}
}
?>