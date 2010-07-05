<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Topic.php 6515 2010-06-23 00:53:16Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Model_Topic extends Core_Model_Item_Abstract
{
  protected $_parent_type = 'forum_forum';
  
  protected $_owner_type = 'forum_forum';

  protected $_children_types = array('forum_post');


  // Generic content methods

  public function getDescription()
  {
    if( !isset($this->store()->firstPost) ) {
      $postTable = Engine_Api::_()->getDbtable('posts', 'forum');
      $postSelect = $postTable->select()
        ->where('topic_id = ?', $this->getIdentity())
        ->order('post_id ASC')
        ->limit(1);
      $this->store()->firstPost = $postTable->fetchRow($postSelect);
    }
    if( isset($this->store()->firstPost) ) {
      return strip_tags($this->store()->firstPost->body);
    }
    return '';
  }

  public function getHref($params = array())
  {
    $params = array_merge(array(
      'route' => 'forum_topic',
      'reset' => true,
      'action' => 'view',
      'topic_id' => $this->getIdentity(),
    ), $params);
    $route = $params['route'];
    $reset = $params['reset'];
    unset($params['route']);
    unset($params['reset']);
    return Zend_Controller_Front::getInstance()->getRouter()
      ->assemble($params, $route, $reset);
  }
  

  // hooks

  protected function _insert()
  {
    if( empty($this->forum_id) ) {
      throw new Forum_Model_Exception('Cannot have a topic without a forum');
    }

    if( empty($this->user_id) ) {
      throw new Forum_Model_Exception('Cannot have a topic without a user');
    }

    // Increment parent topic count
    $forum = $this->getParent();
    $forum->topic_count++;
    $forum->modified_date = date('Y-m-d H:i:s');
    $forum->save();

    parent::_insert();
  }

  protected function _update()
  {
    if( empty($this->forum_id) ) {
      throw new Forum_Model_Exception('Cannot have a topic without a forum');
    }

    if( empty($this->user_id) ) {
      throw new Forum_Model_Exception('Cannot have a topic without a user');
    }

    parent::_update();
  }

  protected function _delete()
  {
    // Decrement parent topic count
    $forum = $this->getParent();
    $forum->topic_count--;
    $forum->save();

    // Delete all child topics
    $table = Engine_Api::_()->getItemTable('forum_post');
    $select = $table->select()
      ->where('topic_id = ?', $this->getIdentity())
      ;

    foreach( $table->fetchAll($select) as $post )
    {
      $post->delete();
    }
    
   $table = Engine_Api::_()->getDbTable('topicviews', 'forum');
   $select = $table->select()
      ->where('topic_id = ?', $this->getIdentity())
      ;
   $rows = $table->fetchAll($select);
   foreach ($rows as $row)
   {
     $row->delete();
   }
    parent::_delete();
  }

  public function getLastCreatedPost()
  {
    return $this->getChildren('forum_post', array('limit'=>1, 'order'=>'creation_date DESC'))->current();
  }

  public function registerView($user)
  {
    $table = Engine_Api::_()->getDbTable('topicviews', 'forum');
    $table->delete(array('topic_id = ?'=>$this->getIdentity(), 'user_id = ?'=>$user->getIdentity()));
    $row = $table->createRow();
    $row->user_id = $user->user_id;
    $row->topic_id = $this->topic_id;
    $row->last_view_date = date('Y-m-d H:i:s');
    $row->save();
  }

  public function isViewed($user)
  {
    $table = Engine_Api::_()->getDbTable('topicviews', 'forum');
    $row = $table->fetchRow($table->select()->where('user_id = ?', $user->getIdentity())->where('last_view_date > ?', $this->modified_date)->where("topic_id = ?", $this->getIdentity()));
    return $row != null;
  }

  public function getLastPage($per_page)
  {
    return ceil($this->post_count / $per_page);
  }
}