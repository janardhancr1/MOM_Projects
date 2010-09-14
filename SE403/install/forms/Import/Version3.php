<?php

class Install_Form_Import_Version3 extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('SocialEngine 3 Import')
      ->setDescription('We will now import your users from SocialEngine 3.')
      ->setAttrib('style', 'width: 650px');

    $this->addElement('Text', 'path', array(
      'label' => 'SocialEngine 3 Path',
      'description' => 'This is the local folder where SocialEngine 3 is
        currently installed. It must be properly installed in order to import
        correctly.',
      'value' => realpath($_SERVER['DOCUMENT_ROOT']),
      'required' => true,
      'allowEmpty' => false,
    ));

    $this->addElement('Radio', 'mode', array(
      'label' => 'Execution Mode',
      'multiOptions' => array(
        'split' => 'Separate requests for each type of data',
        'all' => 'All-at-once',
      ),
      'value' => 'split',
    ));

    $this->addElement('Radio', 'resizePhotos', array(
      'label' => 'Resize Photos?',
      'description' => 'Note: This will make the import process take much longer.',
      'multiOptions' => array(
        1 => 'Yes',
        0 => 'No',
      ),
      'value' => 1,
    ));

    $this->addElement('Multiselect', 'disabledSteps', array(
      'label' => 'Disable Steps (advanced)',
      'description' => 'Select to disable.',
      'style' => 'height: 120px; width: 300px;',
    ));

    $this->addElement('Button', 'execute', array(
      'label' => 'Import',
      'type' => 'submit',
    ));
  }
}