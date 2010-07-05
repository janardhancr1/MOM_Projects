<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Post.php 6515 2010-06-23 00:53:16Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Model_Post extends Core_Model_Item_Abstract
{
  protected $_parent_type = 'forum_topic';
  protected $_owner_type = 'user';

  public function getHref($params = array())
  {
    $params = array_merge(array(
      'route' => 'forum_topic',
      'reset' => true,
      'topic_id' => $this->topic_id,
      'post_id' => $this->getIdentity(),
    ), $params);
    $route = $params['route'];
    $reset = $params['reset'];
    unset($params['route']);
    unset($params['reset']);
    return Zend_Controller_Front::getInstance()->getRouter()
      ->assemble($params, $route, $reset);
  }


  // Hooks

  protected function _insert()
  {
    if( empty($this->topic_id) ) {
      throw new Forum_Model_Exception('Cannot have a post without a topic');
    }

    if( empty($this->user_id) ) {
      throw new Forum_Model_Exception('Cannot have a post without a user');
    }

    // Increment user post count
    $table = Engine_Api::_()->getItemTable('forum_signature');
    $select = $table->select()
      ->where('user_id = ?', $this->user_id)
      ->limit(1);

    $row = $table->fetchRow($select);
    if( null === $row ) {
      $row = $table->createRow();
      $row->user_id = $this->user_id;
      $row->post_count = 0;
    }
    $row->post_count++;
    $row->save();

    // Update topic post count
    $topic = $this->getParent();
    $topic->post_count++;
    $topic->modified_date = date('Y-m-d H:i:s');
    $topic->save();

    // Update forum post count
    $forum = $topic->getParent();
    $forum->post_count++;
    $topic->modified_date = date('Y-m-d H:i:s');
    $forum->save();

    // Initialize modified and creation date
    $this->modified_date = $this->creation_date = $forum->modified_date = $topic->modified_date = date('Y-m-d H:i:s');
  }

  protected function _update()
  {
    if( empty($this->topic_id) ) {
      throw new Forum_Model_Exception('Cannot have a post without a topic');
    }

    if( empty($this->user_id) ) {
      throw new Forum_Model_Exception('Cannot have a post without a user');
    }
    
    $this->modified_date = date('Y-m-d H:i:s');
  }

  protected function _delete()
  {
    $this->deletePhoto();
    
    // Decrement user post count
    $table = Engine_Api::_()->getItemTable('forum_signature');
    $select = $table->select()
      ->where('user_id = ?', $this->user_id)
      ->limit(1);

    $row = $table->fetchRow($select);
    if( null !== $row ) {
      $row->post_count--;
      $row->save();
    }

    // Update topic post count
    $topic = $this->getParent();
    $topic->post_count--;
    $topic->save();

    // Update forum post count
    $forum = $topic->getParent();
    $forum->post_count--;
    $forum->save();
  }

  public function getLastCreatedPost()
  {
    return $this->getChildren('forum_post', array('limit'=>1, 'order'=>'creation_date DESC'));
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
      throw new Event_Model_Exception('invalid argument passed to setPhoto');
    }

    $name = basename($file);
    $path = APPLICATION_PATH . DIRECTORY_SEPARATOR . 'temporary';
    $params = array(
     'parent_id' => $this->getIdentity(),
     'parent_type'=>'forum_post'
    );
    
    // Save
    $storage = Engine_Api::_()->storage();
    
    // Resize image (main)
    $image = Engine_Image::factory();
    $image->open($file)
      ->resize(2000, 2000)
      ->write($path.'/m_'.$name)
      ->destroy();

    // Store
    $iMain = $storage->create($path.'/m_'.$name, $params);

    // Update row
    $this->modified_date = date('Y-m-d H:i:s');
    $this->file_id = $iMain->getIdentity();
    $this->save();

    return $this;
  }

  public function getSignature()
  {
    $user_id = $this->user_id;
    $table = Engine_Api::_()->getItemTable('forum_signature');
    $select = $table->select()
      ->where("user_id = ?", $user_id)
      ->limit(1);
    return $table->fetchRow($select);
  }

  public function getPhotoUrl($type = null)

  {
   $photo_id = $this->file_id;
    if( !$photo_id )
    {
      return null;
    }

    $file = $this->api()->getApi('storage', 'storage')->get($photo_id, $type);
    if( !$file )
    {
      return null;
    }
    
    return $file->map();
  }

  public function getPostIndex()
  {
    $table = $this->getTable();

    
    $select = new Zend_Db_Select($table->getAdapter());
    $select
      ->from($table->info('name'), new Zend_Db_Expr('COUNT(post_id) as count'))
      ->where('topic_id = ?', $this->topic_id)
      ->where('post_id < ?', $this->getIdentity())
      ->order('post_id ASC')
      ;

    $data = $select->query()->fetch();
    return (int) $data['count'];
  }

  public function canEdit($user)
  {
    return $this->getParent()->getParent()->authorization()->isAllowed($user, 'moderate') || ($this->isOwner($user) && !$this->getParent()->closed);
  }

  public function canDelete($user)
  {
    return $this->getParent()->getParent()->authorization()->isAllowed($user, 'moderate');
  }


  public function deletePhoto()
  {
 
    if (empty($this->file_id)) {
      return;
    }
    // This is dangerous, what if something throws an exception in postDelete
    // after the files are deleted?
    try
    {
      $file = $this->api()->getApi('storage', 'storage')->get($this->file_id);
      $file->remove();
      $file = $this->api()->getApi('storage', 'storage')->get($this->file_id, '');
      $file->remove();
      $this->file_id = NULL;
    }
    catch( Exception $e )
    {
      // @todo completely silencing them probably isn't good enough
      throw $e;
    }
  }

}