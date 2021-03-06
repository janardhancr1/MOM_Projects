<?php

class Friendsinviter_Form_Admin_Signup_Invite extends Engine_Form
{
  public function init()
  {
    $this
      ->setAttrib('enctype', 'multipart/form-data');

    $step_table = Engine_Api::_()->getDbtable('signup', 'user');
    $step_row = $step_table->fetchRow($step_table->select()->where('class = ?', 'Friendsinviter_Plugin_Signup_Invite'));
    $count = $step_row->order + 1;
    $title = $this->getView()->translate('Step %d: Invite Your Friends', $count);
    $this->setTitle($title)->setDisableTranslator(true);


    $enable = new Engine_Form_Element_Radio('enable');
    $enable->setLabel("Invite Friends");
    $enable->setDescription("USER_FORM_ADMIN_SIGNUP_FIELDS_ENABLE_DESCRIPTION");
    $enable->addMultiOptions(
      array(
        1=>'Yes, include the "Invite Friends" step during signup.',
        0=>'No, do not include this step.'
    ));
    $enable->setValue($step_row->enable);

    $this->addElements(array($enable));


    // Init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));

  }
}