<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Vote.php 5849 2010-05-17 23:46:00Z steve $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_Form_Index_Vote extends Engine_Form
{
  public function init()
  {
    $this->addElement('text', 'title', array(
        'label' => 'Recipe Title',
        'required' => true,
        'filters' => array(
          new Engine_Filter_Censor(),
        ),
      ));
    $this->addElement('textarea', 'description', array(
        'label' => 'Description',
        'filters' => array(
          new Engine_Filter_Censor(),
        ),
      ));
    $this->addElement('text', 'options', array(
        'label' => 'Possible Answers',
        'isArray' => TRUE,
        'id' => 'firstOptionElement',
        'filters' => array(
          new Engine_Filter_Censor(),
        ),
      ));
    $this->addElement('submit', 'Create Recipe', array(
        'value' => 'Create Recipe',
      ));
  }

  public function save()
  {
    $db_recipes       = Engine_Api::_()->recipe()->api()->getDbtable('recipes', 'recipe');
    $db_recipeOptions = Engine_Api::_()->recipe()->api()->getDbtable('recipeOptions', 'recipe');
    $db_recipeVotes   = Engine_Api::_()->recipe()->api()->getDbtable('recipeVotes', 'recipe');

    $db_recipes->getAdapter()->beginTransaction();
    $db_recipeOptions->getAdapter()->beginTransaction();

    try {
      $recipe = $db_recipes->createRow();
      $recipe->user_id       = Engine_Api::_()->user()->getViewer()->getIdentity();
      $recipe->is_closed     = 0;
      $recipe->title         = $this->getElement('title')->getValue();
      $recipe->description   = $this->getElement('description')->getValue();
      $recipe->creation_date = date('Y-m-d H:i:s');
      $recipe->save();

      foreach ($this->getElement('options')->getValue() as $option) {
        if (trim($option) != '') {
          $row = $db_recipeOptions->createRow();
          $row->recipe_id      = $recipe->recipe_id;
          $row->recipe_option  = $option;
          $row->save();
        }
      }

      $db_recipes->getAdapter()->rollBack();
      $db_recipeOptions->getAdapter()->rollBack();
      #$db->commit();
    } catch (Zend_Mail_Transport_Exception $e) {
      $db_recipes->getAdapter()->rollBack();
      $db_recipeOptions->getAdapter()->rollBack();
      throw $e;
    }
  }
}