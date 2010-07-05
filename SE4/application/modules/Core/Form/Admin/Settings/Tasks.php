<?php

class Core_Form_Admin_Settings_Tasks extends Engine_Form
{
  public function init()
  {
    // Set form attributes
    $this->setTitle('Task Scheduler Settings');
    $this->setDescription('CORE_FORM_ADMIN_SETTINGS_TASKS_DESCRIPTION');
    
    // Init mode
    $this->addElement('Select', 'mode', array(
      'label' => 'Trigger Method',
      'multiOptions' => array(
        'cron' => 'Cron-job (Requires setup of cronjob in crontab)',
        'curl' => 'cURL',
        'socket' => 'Socket',
      )
    ));

    // Init key
    $this->addElement('Text', 'key', array(
      'label' => 'Trigger Access Key',
    ));
    
    // init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
  }
}