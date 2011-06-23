<?php
require_once 'Zend/Form/Element/Xhtml.php';
class Zend_Form_Element_Anchor extends Zend_Form_Element_Xhtml 
{     
	public $helper = 'formAnchor';      
	
	public function loadDefaultDecorators ()     
	{        
		parent::loadDefaultDecorators ();         
		$this->removeDecorator ('Label');         
		$this->removeDecorator ('HtmlTag');          
		$this->addDecorator('HtmlTag', array(
			'tag'   => 'span',         
			'class' => 'myElement',         
		));     
	} 
} 

?>