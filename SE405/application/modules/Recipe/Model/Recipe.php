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
  public function getSingletonAlbum()
  {
    $table = Engine_Api::_()->getItemTable('recipe_album');
    $select = $table->select()
      ->where('recipe_id = ?', $this->getIdentity())
      ->order('album_id ASC')
      ->limit(1);

    $album = $table->fetchRow($select);

    if( null === $album )
   {
      $album = $table->createRow();
      $album->setFromArray(array(
        'title' => $this->getTitle(),
        'recipe_id' => $this->getIdentity()
      ));
      $album->save();
    }

    return $album;
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
 public function setPhoto($photo)
  {
    if( $photo instanceof Zend_Form_Element_File ) {
      $file = $photo->getFileName();
    } else if( is_array($photo) && !empty($photo['tmp_name']) ) {
      $file = $photo['tmp_name'];
    } else if( is_string($photo) && file_exists($photo) ) {
      $file = $photo;
    } else {
      throw new Recipe_Model_Exception('invalid argument passed to setPhoto');
    }

    $name = basename($file);
    $path = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temporary';
    $params = array(
      'parent_type' => 'recipe',
      'parent_id' => $this->getIdentity()
    );

    // Save
    $storage = Engine_Api::_()->storage();

    // Resize image (main)
    $image = Engine_Image::factory();
    $image->open($file)
      ->resize(720, 720)
      ->write($path.'/m_'.$name)
      ->destroy();

    // Resize image (profile)
    $image = Engine_Image::factory();
    $image->open($file)
      ->resize(600, 600)
      ->write($path.'/p_'.$name)
      ->destroy();

    // Resize image (normal)
    $image = Engine_Image::factory();
    $image->open($file)
      ->resize(140, 160)
      ->write($path.'/in_'.$name)
      ->destroy();

    // Resize image (icon)
    $image = Engine_Image::factory();
    $image->open($file);

    $size = min($image->height, $image->width);
    $x = ($image->width - $size) / 2;
    $y = ($image->height - $size) / 2;

    $image->resample($x, $y, $size, $size, 48, 48)
      ->write($path.'/is_'.$name)
      ->destroy();

    // Store
    $iMain = $storage->create($path.'/m_'.$name, $params);
    $iProfile = $storage->create($path.'/p_'.$name, $params);
    $iIconNormal = $storage->create($path.'/in_'.$name, $params);
    $iSquare = $storage->create($path.'/is_'.$name, $params);

    $iMain->bridge($iProfile, 'thumb.profile');
    $iMain->bridge($iIconNormal, 'thumb.normal');
    $iMain->bridge($iSquare, 'thumb.icon');

    // Remove temp files
    @unlink($path.'/p_'.$name);
    @unlink($path.'/m_'.$name);
    @unlink($path.'/in_'.$name);
    @unlink($path.'/is_'.$name);


    // Add to album
    $viewer = Engine_Api::_()->user()->getViewer();
    $photoTable = Engine_Api::_()->getItemTable('recipe_photo');
    $recipeAlbum = $this->getSingletonAlbum();
    $photoItem = $photoTable->createRow();
    $photoItem->setFromArray(array(
      'recipe_id' => $this->getIdentity(),
      'album_id' => $recipeAlbum->getIdentity(),
      'user_id' => $viewer->getIdentity(),
      'file_id' => $iMain->getIdentity(),
      'collection_id' => $recipeAlbum->getIdentity(),
    ));
    $photoItem->save();

    // Update row
    $this->modified_date = date('Y-m-d H:i:s');
    $this->photo_id = $photoItem->file_id;
    $this->save();

    return $this;
  }
}