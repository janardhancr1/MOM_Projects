<?php
class Application_Form_Search extends Zend_Form
{
	public function init()
	{
		$enterid = $this->createElement('text','id');
		$enterid->setLabel('Enter ID: ');
		$enterid->setRequired(true);
		$enterid->setAttrib('size','20');
		$this->addElement($enterid);
		
		
		$submit = $this->createElement('submit','submit',array('label'=>'GO'));
		$this->addElement($submit);
		
		/*$select = $db->select()
             ->from('bg_year');
             
        $result = $db->query($select);
        
        $year = $result->fetchAll();*/
             
		$year = $this->createElement('select','year')
		->setLabel('Year: ')
		->addMultiOptions(array(
		'0' => 'Select or Leave blank',
		));
		
		$this->addElement($year);
		
		$make = $this->createElement('select','make')
		->setLabel('Make: ')
		->addMultiOptions(array(
		'0' => 'Select or Leave blank',
		));
		
		$this->addElement($make);
		
		$model = $this->createElement('select','model')
		->setLabel('Model: ')
		->addMultiOptions(array(
		'0' => 'Select or Leave blank',
		));
		
		$this->addElement($model);
		
		$submit1 = $this->createElement('submit','submit1',array('label'=>'GO'));
		$this->addElement($submit1);
		
		// Code for Custom Decorators here ...
		$enterid->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag' =>'td','class' =>'element')),
		array('Label',array('tag'=>'td', 'style' => 'font-family:arial; font-weight:bold; font-size:14px')),
		
		));
		
		$year->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag'=>'td', 'class'=>'element')),
		array('Label', array('tag'=>'td', 'style' => 'font-family:arial; font-weight:bold; font-size:14px')),
		
		));
		
		$make->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag'=>'td', 'class'=>'element')),
		array('Label', array('tag'=>'td', 'style' => 'font-family:arial; font-weight:bold; font-size:14px')),
		
		));
		
		$model->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag'=>'td', 'class'=>'element')),
		array('Label', array('tag'=>'td', 'style' => 'font-family:arial; font-weight:bold; font-size:14px')),
		
		));
		
		$submit->setDecorators(array(
		'ViewHelper',
		array(array('data'=>'HtmlTag'),array('tag'=>'td','class'=>'element')),
		));
		
		$submit1->setDecorators(array(
		'ViewHelper',
		array(array('data'=>'HtmlTag'),array('tag'=>'td','class'=>'element')),
		));
		
		$this->setDecorators(array(
		'FormElements',
		array('HtmlTag',array('tag'=>'tr')),
		'Form',
		));
		
		$this->setDecorators(array(
		'FormElements',
		array('HtmlTag',array('tag'=>'table')),
		'Form',
		));
		
	}
	    
}
?>