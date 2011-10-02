<?php
class Application_Form_Search2 extends Application_Form_MainForm
{
	public function init()
	{
		$this
		->setAttribs(array(
        'id' => 'search_form',
        'class' => 'global_search_form',
		));
		//$db = Zend_Db_Table::getDefaultAdapter(); 
		$enter = $this->createElement('text','name');
		$enter->setLabel('Search');
		$enter->setAttrib('size','20');
		
		
		$this->addElement($enter);
		
		
		$submit2 = $this->createElement('submit','submit2',array('label'=>'GO'));
		$this->addElement($submit2);

		$enter->setDecorators(array(
		'ViewHelper',
		'Errors',
		array(array('data'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left; width:150px; padding-top:5px;')),
		array('Label',array('tag'=>'div', 'style' => 'font-family:arial; font-weight:bold; font-size:14px;')),
		array(array('row'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left;')),
		
		));
		
		$submit2->setDecorators(array(
		'ViewHelper',
		array(array('data'=>'HtmlTag'),array('tag'=>'div','class'=>'element' , 'style' => 'float:left;padding-top: 20px; padding-left:8px;')),
		
		array(array('row'=>'HtmlTag'), array('tag' =>'div','class' =>'element', 'style' => 'float:left;')),
		));
		
		
	}
	    
}
?>