<?php

class Socialdna_Form_Admin_Services_Edit extends Engine_Form
{
  public $saved_successfully = FALSE;
  
  public function init()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    
    $this
      ->setTitle('socialdna_admin_service_settings_title')
      ->setDescription('socialdna_admin_enter_service_parameters');


    $this->addElement('Text', 'api_key', array(
      'label' => 'API / Consumer Key',
      'description' => '',
      'value' => '',
    ));
    $this->api_key->getDecorator('Description')->setOption('placement', 'append');
    $this->api_key->setAttrib('style', 'width:250px');

    $this->addElement('Text', 'secret', array(
      'label' => 'API / Consumer Secret',
      'description' => '',
      'value' => ''
    ));
    $this->secret->getDecorator('Description')->setOption('placement', 'append');
    $this->secret->setAttrib('style', 'width:250px');

    $this->addElement('hidden', 'service_id', array(
      'value' => '0',
    ));


    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array(
        'ViewHelper',
      ),
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'cancel',
      'link' => true,
      'prependText' => ' or ',
      'decorators' => array(
        'ViewHelper',
      ),
    ));

    $this->addDisplayGroup(array('submit', 'cancel'), 'buttons');

    
  }
  
  
  public function saveAdminSettings()
  {



  }
 
  
}