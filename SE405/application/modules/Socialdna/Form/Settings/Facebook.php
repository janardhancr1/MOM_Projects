<?php

class Socialdna_Form_Settings_Facebook extends Engine_Form
{

  public function init()
  {
    $this->setTitle('socialdna_facebook_instant_login')
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ->setDescription('socialdna_facebook_instant_login_help')
      ;

    $options = array (
                  0 => 'socialdna_facebook_enable_instant_login_ask',
                  1 => 'socialdna_facebook_enable_instant_login_yes',
                  2 => 'socialdna_facebook_enable_instant_login_no',
                );
    
    $this->addElement('Radio', 'openidconnect_autologin', array(
      'label' => 'socialdna_facebook_enable_instant_login_question',
      'description' => '',
      'multiOptions' => $options,
    ));


    // Init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true
    ));
    
    return $this;
  }

} 