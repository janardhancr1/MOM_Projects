<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Photo.php 5935 2010-05-21 01:35:38Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_Model_Photo extends Core_Model_Item_Collectible
{
  protected $_parent_type = 'recipe_album';

  protected $_owner_type = 'user';

  protected $_collection_type = 'recipe_album';

  public function getHref($params = array())
  {
    $params = array_merge(array(
      'route' => 'recipe_extended',
      'reset' => true,
      'controller' => 'photo',
      'action' => 'view',
      'recipe_id' => $this->getCollection()->getOwner()->getIdentity(),
      //'album_id' => $this->collection_id,
      'photo_id' => $this->getIdentity(),
    ), $params);
    $route = $params['route'];
    $reset = $params['reset'];
    unset($params['route']);
    unset($params['reset']);
    return Zend_Controller_Front::getInstance()->getRouter()
      ->assemble($params, $route, $reset);
  }

  public function getPhotoUrl($type = null)
  {
    if( empty($this->file_id) )
    {
      return null;
    }

    $file = $this->api()->getApi('storage', 'storage')->get($this->file_id, $type);
    if( !$file )
    {
      return null;
    }

    return $file->map();
  }

  public function getClassified()
  {
    return Engine_Api::_()->getItem('classified', $this->classified_id);
    //return $this->getCollection()->getGroup();
  }

  public function isSearchable()
  {
    $collection = $this->getCollection();
    if( !$collection instanceof Core_Model_Item_Abstract )
    {
      return false;
    }
    return $collection->isSearchable();
  }

  public function getAuthorizationItem()
  {
    return $this->getParent('classified');
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

  /**
   * Gets a proxy object for the tags handler
   *
   * @return Engine_ProxyObject
   **/
  public function tags()
  {
    return new Engine_ProxyObject($this, Engine_Api::_()->getDbtable('tags', 'core'));
  }

  protected function _postDelete()
  {
    if( $this->_disableHooks ) return;

    // This is dangerous, what if something throws an exception in postDelete
    // after the files are deleted?
    try
    {
      $file = $this->api()->getApi('storage', 'storage')->get($this->file_id);
      $file->remove();
      $file = $this->api()->getApi('storage', 'storage')->get($this->file_id, 'thumb.normal');
      $file->remove();

      $album = $this->getCollection();

      if( (int) $album->photo_id == (int) $this->getIdentity() )
      {
	$album->photo_id = $this->getNextCollectible()->getIdentity();
	$album->save();
      }
    }
    catch( Exception $e )
    {
      // @todo completely silencing them probably isn't good enough
      //throw $e;
    }
  }
}