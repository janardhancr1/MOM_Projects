<?php
class Application_Form_User extends Application_Form_MainForm
{
	public  $elementDecoratorsTr = array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td')),
			array('Label', array('tag' => 'td', 'style' => 'float:right;')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			);
			
			
	public function init()
	{
		$this
		->setAttribs(array(
        'id' => 'search_form',
        'class' => 'global_search_form',
		));
		
		$this->addElement('Text', 'user_name',
		array(
		'decorators' => $this->elementDecoratorsTr,
		'label' => 'User Name:'
		));
		
		$this->addElement('Password', 'password',array(
		'decorators' => $this->elementDecoratorsTr,
		'label' => 'Password:'
		
		));
		
		$roles[0] = "Admin";
		$roles[1] = "Editor";
		$roles[2] = "Viewer";
		
		$rt_types = new Zend_Form_Element_Select('role');
		$rt_types->setLabel('Role')
					->addMultiOptions($roles);
		$rt_types->setDecorators($this->elementDecoratorsTr)
				->setAttrib("style", "width:153px");
		
		$this->addElement($rt_types);
		
		$submit = $this->createElement('submit','Save',array('label'=>'Save'));
		$this->addElement($submit);
		$submit->setDecorators( array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'colspan' => 2, 'align' => 'center')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
		
		$this->setDecorators(array(
		'FormElements',
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '3', 'width' => '50%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
		'Form'
		));
		
	}
}
?>