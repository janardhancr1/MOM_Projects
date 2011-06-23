<?php
require_once 'Zend/View/Helper/FormElement.php';
class Zend_View_Helper_FormAnchor extends Zend_View_Helper_FormElement 
{     
	public function formAnchor ($name, $value, $attribs = null)     
	{  
		$disp = substr($name, strpos($name, '_')+1);
		$info = $this->_getInfo($name, $value, $attribs);          
		$xHtml = '<a'                 
		. $this->_htmlAttribs ($attribs)                 
		. ' >'.$disp.'</a>';          
		return $xHtml;     
	} 
} 
?>