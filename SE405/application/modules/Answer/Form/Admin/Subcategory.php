<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Category.php 4997 2010-04-14 01:09:44Z jung $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Form_Admin_Subcategory extends Engine_Form
{
  protected $_field;

  public function init()
  {
    $this
      ->setMethod('post')
      ->setAttrib('class', 'global_form_box')
      ;

    /*
    $type = new Zend_Form_Element_Hidden('type');
    $type->setValue('heading');
    */

    $label = new Zend_Form_Element_Text('label');
    $label->setLabel('Category Name')
      ->addValidator('NotEmpty')
      ->setRequired(true)
      ->setAttrib('class', 'text');


    $id = new Zend_Form_Element_Hidden('id');


    $this->addElements(array(
      //$type,
      $label,
      $id
    ));
    
    // Buttons
    $this->addElement('Button', 'submit', array(
      'label' => 'Add Category',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array('ViewHelper')
    ));
    $this->addElement('Text', 'category_name',array(
      'label'=>'Sub Category',
      'class' => 'text',
      'maxlength' => '100',
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'cancel',
      'link' => true,
      'prependText' => ' or ',
      'href' => '',
      'onClick'=> 'javascript:parent.Smoothbox.close();',
      'decorators' => array(
        'ViewHelper'
      )
    ));
    $this->addDisplayGroup(array('submit', 'cancel'), 'buttons');
    $button_group = $this->getDisplayGroup('buttons');


  }

  public function setField($category)
  {
    $this->_field = $category;

    // Set up elements
    //$this->removeElement('type');
    $this->label->setValue($category->category_name);
    $this->id->setValue($category->category_id);
    $this->submit->setLabel('Add Subcategory');

    // @todo add the rest of the parameters
  }
}