<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6512 2010-06-23 00:27:01Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Event_Plugin_Core
{
  public function onStatistics($event)
  {
    $table = Engine_Api::_()->getItemTable('event');
    $select = new Zend_Db_Select($table->getAdapter());
    $select
      ->from($table->info('name'), new Zend_Db_Expr('COUNT(1) as count'))
      ;

    $data = $select->query()->fetch();
    $event->addResponse($data['count'], 'event');
  }

  public function onUserDeleteBefore($event)
  {
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {
      // Delete posts
      $postTable = Engine_Api::_()->getDbtable('posts', 'event');
      $postSelect = $postTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $postTable->fetchAll($postSelect) as $post ) {
        //$post->delete();
      }

      // Delete topics
      $topicTable = Engine_Api::_()->getDbtable('topics', 'event');
      $topicSelect = $topicTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $topicTable->fetchAll($topicSelect) as $topic ) {
        //$topic->delete();
      }

      // Delete photos
      $photoTable = Engine_Api::_()->getDbtable('photos', 'event');
      $photoSelect = $photoTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $photoTable->fetchAll($photoSelect) as $photo ) {
        $photo->delete();
      }
      
      // Delete memberships
      $membershipApi = Engine_Api::_()->getDbtable('membership', 'event');
      foreach( $membershipApi->getMembershipsOf($payload) as $event ) {
        $membershipApi->removeMember($event, $payload);
      }

      // Delete events
      $eventTable = Engine_Api::_()->getDbtable('groups', 'event');
      $eventSelect = $eventTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $eventTable->fetchAll($eventSelect) as $event ) {
        $event->delete();
      }
    }
  }
}