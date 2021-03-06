<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AddForum.php 7244 2010-09-01 01:49:53Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Form_Admin_AddForum extends Engine_Form
{
  public function init()
  {
    $this->addElement('Text', 'title', array(
      'label' => 'Forum Title'
    ));
    $this->addElement('Text', 'description', array(
      'label' => 'Forum Description'
    ));


    $category_id = new Engine_Form_Element_Select('category_id', array(
    'label' => 'Category'
    ));

   $this->addElement($category_id);
   $categories =  Engine_Api::_()->getItemTable('forum_category')->fetchAll();
   foreach ($categories as $category) {
     $category_id->addMultiOption($category->getIdentity(), $category->title);
   }

  // Buttons
  $this->addElement('Button', 'submit', array(
    'label' => 'Save Changes',
    'type' => 'submit',
    'ignore' => true,
    'decorators' => array('ViewHelper')
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
}