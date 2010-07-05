<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: User.php 6072 2010-06-02 02:36:45Z john $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Plugin_User
{
  public function onUserDeleteAfter($event)
  {
    $payload = $event->getPayload();
    $user_id = $payload['identity'];
    $table   = Engine_Api::_()->getDbTable('signatures', 'forum');
    //$table->delete(array('user_id = ?'=> $user_id));

    $table   = Engine_Api::_()->getDbTable('listItems', 'forum');
    $select = $table->select()->where('child_id = ?', $user_id);
    $rows = $table->fetchAll($select);
    foreach ($rows as $row)
    {
      //$row->delete();
    }

    $table   = Engine_Api::_()->getDbTable('topics', 'forum');
    $select = $table->select()->where('user_id = ?', $user_id);
    $rows = $table->fetchAll($select);
    foreach ($rows as $row)
    {
      //$row->delete();
    }

    $table   = Engine_Api::_()->getDbTable('posts', 'forum');
    $select = $table->select()->where('user_id = ?', $user_id);
    $rows = $table->fetchAll($select);
    foreach ($rows as $row)
    {
      //$row->delete();
    }

    $table   = Engine_Api::_()->getDbTable('topicviews', 'forum');
    $select = $table->select()->where('user_id = ?', $user_id);
    $rows = $table->fetchAll($select);
    foreach ($rows as $row)
    {
      $row->delete();
    }
  }
}
