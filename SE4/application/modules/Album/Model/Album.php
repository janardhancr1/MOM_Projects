<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Album.php 5935 2010-05-21 01:35:38Z john $
 * @author     Sami
 */

/**
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Album_Model_Album extends Core_Model_Item_Collection
{
  protected $_parent_type = 'user';

  protected $_owner_type = 'user';

  protected $_parent_is_owner = true;
  
  protected $_searchColumns = array('title', 'description', 'search');
  
  protected $_collectible_type = "album_photo";

  public function getHref($params = array())
  {
    $params = array_merge(array(
      'route' => 'album_specific',
      'reset' => true,
      'album_id' => $this->getIdentity(),
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
    if( empty($this->photo_id) )
    {
      // This should probaby be done on delete
      $photo = $this->getFirstCollectible();
      if( $photo ) {
        $this->photo_id = $photo->getIdentity();
        $this->save();
        $file_id = $this->photo_id;
      }
      else {
        return;
      }
    }
    else
    {
      $photo = Engine_Api::_()->getItem('photo', $this->photo_id);
      if( !$photo ){
        $this->photo_id = 0;
        $this->save();
        return;
      } else {
        $file_id = $photo->file_id;
      }
    }

    if( !$file_id ) {
      return;
    }

    $file = $this->api()->getApi('storage', 'storage')->get($file_id, $type);
    if( !$file ) {
      return;
    }

    return $file->map();
  }

  public function incrementViews() {
    $this->views++;
    $this->save();
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
  
protected function _delete()
  {
    if( $this->_disableHooks ) return;
    
    // Delete all child posts
    $postTable = Engine_Api::_()->getDbtable('alubms', 'alubm');
    $postSelect = $postTable->select()->where('user_id = ?', $this->getIdentity());
    foreach( $postTable->fetchAll($postSelect) as $groupPost ) {
      $groupPost->disableHooks()->delete();
    }
    
    parent::_delete();
  }
}
