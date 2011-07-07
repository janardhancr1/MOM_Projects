<?php
class Application_Form_Login extends Application_Form_MainForm
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
		
		$this->addElement('Text', 'user_name', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar;',
		'label' => 'User Name:',
		));
		
		$this->addElement('Password', 'password', array(
		'decorators' => $this->elementDecoratorsTr,
		'style' => 'class:inputbar;',
		'label' => 'Password:',
		));
		
		$submit = $this->createElement('submit','submit',array('label'=>'Submit'));
		$this->addElement($submit);
		$submit->setDecorators( array(
			'ViewHelper',
			'Description',
			array(array('data'=>'HtmlTag'), array('tag' => 'td', 'colspan' => 1, 'align' => 'right')),
			array(array('row'=>'HtmlTag'), array('tag'=>'tr', 'closeOnly' => true))
			));
			
		$this->setDecorators(array(
		'FormElements',
		array(array('data'=>'HtmlTag'),array('tag'=>'table ', 'align'=>'left', 'cellpadding' => '3', 'width' => '90%', 'class'=>'logintable', 'style' => 'font-weight:bold; font-family:arial; font-size:14px;')),
		'Form'
		));
	}

}