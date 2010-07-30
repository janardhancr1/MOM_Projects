<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 5457 2010-05-07 00:56:12Z jung $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_Plugin_Core
{
  public function onStatistics($event)
  {
    $table   = Engine_Api::_()->getDbTable('recipes', 'recipe');
    $select  = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), array(
                        'COUNT(*) AS count'));
    $rows    = $table->fetchAll($select)->toArray();
    $event->addResponse($rows[0]['count'], 'recipe');

  }

  public function onUserDeleteBefore($event)
  {
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {
      // Delete recipes
      $recipeTable = Engine_Api::_()->getDbtable('recipes', 'recipe');
      $recipeSelect = $recipeTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $recipeTable->fetchAll($recipeSelect) as $recipe ) {
        Engine_Api::_()->getApi('core', 'recipe')->deleteRecipe($recipe->recipe_id);
      }
    }
  }
}