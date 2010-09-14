<?php

class Install_Form_Migrate_Location extends Engine_Form
{
  public function init()
  {
    $this->addElement('Text', 'path', array(
      'label' => 'SocialEngine 3 Path',
      'required' => true,
      'allowEmpty' => false,
    ));
    
    // init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Continue...',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array(
        'ViewHelper',
        array('HtmlTag', array('tag' => 'div', 'class' => 'form-wrapper')),
      )
    ));
  }
}