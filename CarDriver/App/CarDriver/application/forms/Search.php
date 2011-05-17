<?php
class Application_Form_Search extends Application_Form_MainForm
{
	public function init()
	{
		$this
		->setAttribs(array(
        'id' => 'search_form',
        'class' => 'global_search_form',
		));
		$db = Zend_Db_Table::getDefaultAdapter(); 
		$enterid = $this->createElement('text','id');
		$enterid->setLabel('Enter ID');
		$enterid->setAttrib('size','20');
		
		
		$this->addElement($enterid);
		
		
		$submit = $this->createElement('submit','submit',array('label'=>'GO'));
		$this->addElement($submit);

		$enterid->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left; width:150px; padding-top:5px;')),
		array('Label',array('tag'=>'div', 'style' => 'font-family:arial; font-weight:bold; font-size:14px;')),
		array(array('row'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left;')),
		
		));
		
		$submit->setDecorators(array(
		'ViewHelper',
		array(array('data'=>'HtmlTag'),array('tag'=>'div','class'=>'element' , 'style' => 'float:left;padding-top: 20px; padding-left:8px;')),
		
		array(array('row'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left;')),
		));
		
		
	}
	    
}
?>