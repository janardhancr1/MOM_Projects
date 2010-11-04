<?php

class Socialdna_Form_Admin_Users_Filter extends Engine_Form
{
  public function init()
  {
    $this->clearDecorators()
      ->addDecorator('FormElements')
      ->addDecorator('Form')
      ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'search'))
      ->addDecorator('HtmlTag2', array('tag' => 'div', 'class' => 'clear'));

    $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_form_box',
      ));

    $username = new Zend_Form_Element_Text('username');
    $username
      ->setLabel('Username')
      ->clearDecorators()
      ->addDecorator('ViewHelper')
      ->addDecorator('Label', array('tag' => null, 'placement' => 'PREPEND'))
      ->addDecorator('HtmlTag', array('tag' => 'div'));

    $email = new Zend_Form_Element_Text('email');
    $email
      ->setLabel('Email')
      ->clearDecorators()
      ->addDecorator('ViewHelper')
      ->addDecorator('Label', array('tag' => null, 'placement' => 'PREPEND'))
      ->addDecorator('HtmlTag', array('tag' => 'div'));
      

    $networkMultiOptions = array( 0 => ' ');
    $networks = Engine_Api::_()->getDbTable('services','socialdna')->fetchAll();
    foreach($networks as $row) {
      $networkMultiOptions[$row->openidservice_id] = $row->openidservice_displayname;
    }
    
    $network_id = new Zend_Form_Element_Select('network_id');
    $network_id
      ->setLabel('Social Network')
      ->clearDecorators()
      ->addDecorator('ViewHelper')
      ->addDecorator('Label', array('tag' => null, 'placement' => 'PREPEND'))
      ->addDecorator('HtmlTag', array('tag' => 'div'))
      ->setMultiOptions($networkMultiOptions);
      

    $levelMultiOptions = array(0 => ' ');

    $levels = Engine_Api::_()->getDbtable('levels', 'authorization')->fetchAll();
    foreach( $levels as $row )
    {
      $levelMultiOptions[$row->level_id] = $row->getTitle();
    }

    $level_id = new Zend_Form_Element_Select('level_id');
    $level_id
      ->setLabel('Level')
      ->clearDecorators()
      ->addDecorator('ViewHelper')
      ->addDecorator('Label', array('tag' => null, 'placement' => 'PREPEND'))
      ->addDecorator('HtmlTag', array('tag' => 'div'))
      ->setMultiOptions($levelMultiOptions);


    $submit = new Zend_Form_Element_Button('search', array('type' => 'submit'));
    $submit
      ->setLabel('Search')
      ->clearDecorators()
      ->addDecorator('ViewHelper')
      ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'buttons'))
      ->addDecorator('HtmlTag2', array('tag' => 'div'));

    $this->addElement('Hidden', 'order', array(
      'order' => 10001,
    ));

    $this->addElement('Hidden', 'order_direction', array(
      'order' => 10002,
    ));

    
    $this->addElements(array(
      $username,
      $email,
      $network_id,
      $level_id,
      $submit,
    ));

    // Set default action
    $this->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()));
  }
}