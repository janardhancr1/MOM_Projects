<?php
class Application_Form_DropdownDescriptions extends Application_Form_MainForm
{
	public function init()
  	{
  		$db = Zend_Db_Table::getDefaultAdapter(); 
  		
    	$this
		->setAttribs(array(
        'id' => 'search_form',
        'class' => 'global_search_form',
		));
		
		$select = $db->select()
			->from('rt_dropdown_types');
			
		$result = $db->query($select)->fetchAll();
		
		
  		if (count($result)!=0){
				$rt_types_prepared[0]= "Select from list";
				foreach ($result as $res){
						$rt_types_prepared[$res['id_types']]= $res['rt_types'];
				}
		}
		
		$rt_types = new Zend_Form_Element_Select('rt_types');
		$rt_types->setLabel('List Name')
					->addMultiOptions($rt_types_prepared);
		$rt_types->setAttrib('onchange','this.form.submit();');
		$this->addElement($rt_types);
		
		$rt_types->setDecorators(array(
			'ViewHelper',
			'Errors',
			array(array('data'=>'HtmlTag'),array('tag'=>'td')),
			array('Label',array('tag'=>'td')),
			array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));
		
		$new_value = $this->createElement('Text','description')
		->setLabel('Add a New value');
		$this->addElement($new_value);
		
		$new_value->setDecorators(array(
			'ViewHelper',
			'Errors',
			array(array('data'=>'HtmlTag'),array('tag'=>'td')),
			array('Label',array('tag'=>'td')),
			array(array('row'=>'HtmlTag'),array('tag'=>'tr'))
		));
		$summit = $this->createElement('submit','submit12',array('label'=>'Save'));
		$this->addElement($summit);
		
		$summit->setDecorators(array(
			'ViewHelper',
			'Errors',
			array(array('data'=>'HtmlTag'),array('tag'=>'td')),
			array('Label',array('tag'=>'td')),
		));
		
		
		
		$this->setDecorators(array(
		'FormElements',
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '3', 'width' => '50%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
		'Form'
		));
  	}
}