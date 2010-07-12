<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 5935 2010-05-21 01:35:38Z john $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_Form_Admin_Level extends Engine_Form
{
  public function init()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');

    $this
      ->setTitle('Member Level Settings')
      ->setDescription('RECIPE_FORM_ADMIN_LEVEL_DESCRIPTION');

    $this->loadDefaultDecorators();
    $this->getDecorator('Description')->setOptions(array('tag' => 'h4', 'placement' => 'PREPEND'));


    $levels = array();
    $table  = Engine_Api::_()->getDbtable('levels', 'authorization');
    foreach ($table->fetchAll($table->select()) as $row)
      $levels[$row['level_id']] = $row['title'];
    $this->addElement('Select', 'level_id', array(
      'label' => 'Member Level',
      'multiOptions' => $levels,
    ));

    $this->addElement('Radio', 'view', array(
      'label' => 'Allow Viewing of Recipes?',
      'description' => 'RECIPE_FORM_ADMIN_LEVEL_VIEW_DESCRIPTION',
      'multiOptions' => array(
        0 => 'No, do not allow recipes to be viewed.',
        1 => 'Yes, allow viewing of recipes.',
        2 => 'Yes, allow viewing of all recipes, even private ones.'
      ),
      'value' => 1,
    ));

    // @todo should the option to edit recipe privacy show up here?
    /*
    $this->addElement('Radio', 'edit', array(
      'label' => 'Allow Editing of Recipes?',
      'description' => 'Do you want to let members edit recipes? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow members to edit their recipes.',
        1 => 'Yes, allow members to edit their own recipes.',
        2 => 'Yes, allow members to edit all recipes.'
      ),
      'value' => 1,
    ));
    */
    
    $this->addElement('Radio', 'delete', array(
      'label' => 'Allow Deletion of Recipes?',
      'description' => 'RECIPE_FORM_ADMIN_LEVEL_DELETE_DESCRIPTION',
      'multiOptions' => array(
        0 => 'No, do not allow members to delete their recipes.',
        1 => 'Yes, allow members to delete their own recipes.',
        2 => 'Yes, allow members to delete all recipes.'
      ),
      'value' => 1,
    ));
    $this->addElement('Radio', 'create', array(
      'label' => 'Allow Recipes?',
      'description' => 'Do you want to allow members to create recipes?',
      'multiOptions' => array(
        1 => 'Yes, allow this member level to create recipes',
        0 => 'No, do not allow this member level to create recipes',
      ),
      'value' => 1,
    ));

    // PRIVACY ELEMENTS
    $this->addElement('MultiCheckbox', 'auth_view', array(
      'label' => 'Recipe Privacy',
      'description' => 'RECIPE_FORM_ADMIN_LEVEL_AUTHVIEW_DESCRIPTION',
      'multiOptions' => array(
        'everyone'       => 'Everyone',
        'owner_network' => 'Friends and Networks',
        'owner_member_member'  => 'Friends of Friends',
        'owner_member'         => 'Friends Only',
        'owner'          => 'Just Me'
      ),
      'value' => array('everyone', 'owner_network','owner_member_member', 'owner_member', 'owner')
    ));

    $this->addElement('MultiCheckbox', 'auth_comment', array(
      'label' => 'Recipe Comment Options',
      'description' => 'RECIPE_FORM_ADMIN_LEVEL_AUTHCOMMENT_DESCRIPTION',
      'multiOptions' => array(
        'everyone'       => 'Everyone',
        'owner_network' => 'Friends and Networks',
        'owner_member_member'  => 'Friends of Friends',
        'owner_member'         => 'Friends Only',
        'owner'          => 'Just Me'
      ),
      'value' => array('everyone', 'owner_network','owner_member_member', 'owner_member', 'owner')
    ));


    // Add submit button
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true
    ));
  }
  /*
  public function populate($settings)
  {
    foreach ($settings as $key => $value)
      $this->getElement($key)->setValue($value);
  }*/
}