<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Create.php 6507 2010-06-22 23:37:42Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Authorization_Form_Admin_Level_Create extends Engine_Form
{
  public function init()
  {

    // Set form attributes
    $this->setTitle('Create Member Level');
    $this->setDescription("AUTHORIZATION_FORM_ADMIN_LEVEL_EDIT_DESCRIPTION");

    $this->addElement('Text', 'title', array(
      'label' => 'Member Level Name',
      'allowEmpty' => false,
      'required' => true,
    ));

    $this->addElement('Textarea', 'description', array(
      'label' => 'Description',
      'allowEmpty' => true,
      'required' => false,
    ));


    $parentMultiOptions = array();
    $levels = Engine_Api::_()->getDbtable('levels', 'authorization')->fetchAll();
    foreach( $levels as $row )
    {
      $parentMultiOptions[$row->level_id] = $row->getTitle();
    }
    $this->addElement('Select', 'parent', array(
      'label' => 'Copy Values From:',
      'multiOptions' => $parentMultiOptions,
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('authorization.defaultlevel', 3),
    ));


    // Buttons
    $this->addElement('Button', 'submit', array(
      'label' => 'Create Level',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array('ViewHelper')
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'cancel',
      'link' => true,
      'prependText' => ' or ',
      'href' => 'admin/levels',
      'decorators' => array(
        'ViewHelper'
      )
    ));
    $this->addDisplayGroup(array('submit', 'cancel'), 'buttons');
    $button_group = $this->getDisplayGroup('buttons');
  }
}