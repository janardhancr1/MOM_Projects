<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Album.php 6511 2010-06-23 00:09:51Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_Model_Album extends Core_Model_Item_Collection
{
  protected $_parent_type = 'recipe';

  protected $_owner_type = 'recipe';

  protected $_children_types = array('recipe_photo');

  protected $_collectible_type = 'recipe_photo';

  public function getHref($params = array())
  {
    $params = array_merge(array(
      'route' => 'recipe_profile',
      'reset' => true,
      'id' => $this->getClassified()->getIdentity(),
      //'album_id' => $this->getIdentity(),
    ), $params);
    $route = $params['route'];
    $reset = $params['reset'];
    unset($params['route']);
    unset($params['reset']);
    return Zend_Controller_Front::getInstance()->getRouter()
      ->assemble($params, $route, $reset);
  }

  public function getClassified()
  {
    return $this->getOwner();
    //return Engine_Api::_()->getItem('group', $this->group_id);
  }

  public function getAuthorizationItem()
  {
    return $this->getParent('recipe');
  }

  protected function _delete()
  {
    // Delete all child posts
    $photoTable = Engine_Api::_()->getItemTable('recipe_photo');
    $photoSelect = $photoTable->select()->where('album_id = ?', $this->getIdentity());
    foreach( $photoTable->fetchAll($photoSelect) as $recipedPhoto ) {
      $recipePhoto->delete();
    }

    parent::_delete();
  }
}