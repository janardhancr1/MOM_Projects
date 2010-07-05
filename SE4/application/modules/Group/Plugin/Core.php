<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6516 2010-06-23 01:15:53Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Group_Plugin_Core
{
  public function onStatistics($group)
  {
    $table = Engine_Api::_()->getItemTable('group');
    $select = new Zend_Db_Select($table->getAdapter());
    $select
      ->from($table->info('name'), new Zend_Db_Expr('COUNT(1) as count'))
      ;

    $data = $select->query()->fetch();
    $group->addResponse($data['count'], 'group');
  }

  public function onUserDeleteBefore($group)
  {
    $payload = $group->getPayload();
    if( $payload instanceof User_Model_User ) {
      // Delete posts
      $postTable = Engine_Api::_()->getDbtable('posts', 'group');
      $postSelect = $postTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $postTable->fetchAll($postSelect) as $post ) {
        //$post->delete();
      }

      // Delete topics
      $topicTable = Engine_Api::_()->getDbtable('topics', 'group');
      $topicSelect = $topicTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $topicTable->fetchAll($topicSelect) as $topic ) {
        //$topic->delete();
      }

      // Delete photos
      $photoTable = Engine_Api::_()->getDbtable('photos', 'group');
      $photoSelect = $photoTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $photoTable->fetchAll($photoSelect) as $photo ) {
        $photo->delete();
      }

      // Delete officers
      $listItemTable = Engine_Api::_()->getDbtable('ListItems', 'group');
      $listItemSelect = $listItemTable->select()->where('child_id = ?', $payload->getIdentity());
      foreach( $listItemTable->fetchAll($listItemSelect) as $listitem ) {
        $list = Engine_Api::_()->getItem('group_list', $listitem->list_id);
        if( !$list ) {
          $listitem->delete();
          continue;
        }
        if( $list->has($payload) ) {
          $list->remove($payload);
        }
      }

      // Delete memberships
      $membershipApi = Engine_Api::_()->getDbtable('membership', 'group');
      foreach( $membershipApi->getMembershipsOf($payload) as $group ) {
        $membershipApi->removeMember($group, $payload);
      }

      // Delete groups
      $groupTable = Engine_Api::_()->getDbtable('groups', 'group');
      $groupSelect = $groupTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $groupTable->fetchAll($groupSelect) as $group ) {
        $group->delete();
      }
    }
  }
}