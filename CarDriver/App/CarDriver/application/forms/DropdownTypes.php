<?php
class Application_Form_DropdownTypes extends Application_Form_MainForm
{
	public function init()
  	{
    	$this
		->setAttribs(array(
        'id' => 'search_form',
        'class' => 'global_search_form',
		));
		
		
		$new_value = $this->createElement('Text','rt_types')
		->setLabel('Add a New value');
		$this->addElement($new_value);
		

		$summit = $this->createElement('submit','submit12',array('label'=>'Save'));
		$this->addElement($summit);
		
		$cancel = new Zend_Form_Element_Submit('submit13');
		$cancel->setLabel('Cancel');
		$this->addElement($cancel);
		
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