<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Recipe.php 6585 2010-06-25 02:17:06Z steve $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_Model_Recipe extends Core_Model_Item_Abstract
{
  protected $_parent_type = 'user';

  //protected $_owner_type = 'user';
  protected $_parent_is_owner = true;
  // needed for core_model_item

  // Interfaces
  /**
   * Gets an absolute URL to the page to view this item
   *
   * @return string
   */
  public function getHref($params = array())
  {
    $slug = trim(preg_replace('/-+/', '-', preg_replace('/[^a-z0-9-]+/i', '-', strtolower($this->getTitle()))), '-');

    $params = array_merge(array(
      'route' => 'recipe_view',
      'reset' => true,
      'user_id' => $this->user_id,
      'recipe_id' => $this->recipe_id,
      'slug' => $slug,
    ), $params);
    $route = $params['route'];
    $reset = $params['reset'];
    unset($params['route']);
    unset($params['reset']);
    return Zend_Controller_Front::getInstance()->getRouter()
      ->assemble($params, $route, $reset);
  }
  
  /**
   * Gets a proxy object for the comment handler
   *
   * @return Engine_ProxyObject
   **/
  public function comments()
  {
    return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('comments', 'core'));
  }

  /**
   * Gets a proxy object for the like handler
   *
   * @return Engine_ProxyObject
   **/
  public function likes()
  {
    return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('likes', 'core'));
  }

  public function getOptions()
  {
    return Engine_Api::_()->getDbtable('options', 'recipe')->fetchAll(array(
      'recipe_id = ?' => $this->getIdentity(),
    ));
  }

  public function viewerVoted()
  {
    $user_id = Engine_Api::_()->user()->getViewer()->getIdentity();
    $row     = Engine_Api::_()->getDbtable('votes', 'recipe')->fetchRow(array(
      'recipe_id = ?' => $this->getIdentity(),
      'user_id = ?' => $user_id,
    ));
    return $row
           ? $row->recipe_option_id
           : false;
  }

  public function voteCount()
  {
    $table  = Engine_Api::_()->getDbtable('votes', 'recipe');
    $select = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), 'COUNT(*) AS count')
                    ->where('recipe_id = ?', $this->getIdentity());
    return $table->fetchRow($select)->count;
  }

  public function vote($option_id)
  {
    $user_id = Engine_Api::_()->user()->getViewer()->getIdentity();
    $table   = Engine_Api::_()->getDbTable('votes', 'recipe');
    $row     = $table->fetchRow(array(
      'recipe_id = ?' => $this->getIdentity(),
      'user_id = ?' => $user_id,
    ));
    if (!$row) {
      $row   = $table->createRow(array(
        'recipe_id' => $this->getIdentity(),
        'user_id' => $user_id,
        'creation_date' => date("Y-m-d H:i:s"),
      ));
    }
    $row->recipe_option_id = $option_id;
    $row->modified_date  = date("Y-m-d H:i:s");
    $row->save();

    // We also have to update the recipe_options table
    // To avoid recipe values getting out of sync, update all recipe option counts
    foreach ($this->getOptions() as $option) {
      // $table is still set to recipe_votes
      $select = $table->select()
                      ->setIntegrityCheck(false)
                      ->from($table->info('name'), 'COUNT(*) AS count')
                      ->where('recipe_id = ?', $this->getIdentity())
                      ->where('recipe_option_id = ?', $option->recipe_option_id)
                      ->limit(1);
      $option->votes = $table->fetchRow($select)->count;
      $option->save();
    }
  }
  protected function _delete()
  {
    if( $this->_disableHooks ) return;
    
    // Delete all child posts
    $postTable = Engine_Api::_()->getDbtable('recipes', 'recipe');
    $postSelect = $postTable->select()->where('user_id = ?', $this->getIdentity());
    foreach( $postTable->fetchAll($postSelect) as $groupPost ) {
      $groupPost->disableHooks()->delete();
    }
    
    parent::_delete();
  }
}