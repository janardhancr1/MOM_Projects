<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6605 2010-06-28 21:24:32Z jung $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Activity_Plugin_Core
{
  public function onItemDeleteBefore($event)
  {
    $item = $event->getPayload();

    Engine_Api::_()->getDbtable('actions', 'activity')->delete(array(
      'subject_type = ?' => $item->getType(),
      'subject_id = ?' => $item->getIdentity(),
    ));
    
    Engine_Api::_()->getDbtable('actions', 'activity')->delete(array(
      'object_type = ?' => $item->getType(),
      'object_id = ?' => $item->getIdentity(),
    ));

    if( $item instanceof User_Model_User ) {
      Engine_Api::_()->getDbtable('notifications', 'activity')->delete(array(
        'user_id = ?' => $item->getIdentity(),
      ));
    }
    
    Engine_Api::_()->getDbtable('notifications', 'activity')->delete(array(
      'subject_type = ?' => $item->getType(),
      'subject_id = ?' => $item->getIdentity(),
    ));

    Engine_Api::_()->getDbtable('notifications', 'activity')->delete(array(
      'object_type = ?' => $item->getType(),
      'object_id = ?' => $item->getIdentity(),
    ));

    Engine_Api::_()->getDbtable('stream', 'activity')->delete(array(
      'subject_type = ?' => $item->getType(),
      'subject_id = ?' => $item->getIdentity(),
    ));

    Engine_Api::_()->getDbtable('stream', 'activity')->delete(array(
      'object_type = ?' => $item->getType(),
      'object_id = ?' => $item->getIdentity(),
    ));

    // Delete all attachments and parent posts
    $attachmentTable = Engine_Api::_()->getDbtable('attachments', 'activity');
    $attachmentSelect = $attachmentTable->select()
      ->where('type = ?', $item->getType())
      ->where('id = ?', $item->getIdentity())
      ;

    $attachmentActionIds = array();
    foreach( $attachmentTable->fetchAll($attachmentSelect) as $attachmentRow )
    {
      $attachmentActionIds[] = $attachmentRow->action_id;
    }

    if( !empty($attachmentActionIds) ) {
      $attachmentTable->delete('action_id IN('.join(',', $attachmentActionIds).')');
      Engine_Api::_()->getDbtable('stream', 'activity')->delete('action_id IN('.join(',', $attachmentActionIds).')');
    }
    
  }
  
  public function getActivity($event)
  {
    $payload = $event->getPayload();
    $viewer = Engine_Api::_()->user()->getViewer();
    $content = Engine_Api::_()->getApi('settings', 'core')->getSetting('activity.content', 'everyone');
    // Owner

    if(Engine_Api::_()->core()->hasSubject()){
      $subject = Engine_Api::_()->core()->getSubject();
      if($subject != 'user') $content = 'everyone';
    }


    // @todo check if public type is disabled
    //$payload = $event->getPayload();

    if( $viewer instanceof User_Model_User && $viewer->getIdentity() )
    {
      $event->addResponse(array(
        'type' => 'owner',
        'data' => $viewer->getIdentity()
      ));
    }

    // Parent
    if( $viewer instanceof User_Model_User && $viewer->getIdentity() )
    {
      $event->addResponse(array(
        'type' => 'parent',
        'data' => $viewer->getIdentity()
      ));
    }

    // Members
    if( ($payload instanceof Core_Model_Item_Abstract) && $payload->getIdentity() && method_exists($payload, 'membership') )
    {
      $data = array();
      $members = $payload->membership()->getMembershipsOfInfo($payload, true); // Note this only works because user-user memberships
      foreach( $members as $member )
      {
        $event->addResponse(array(
          'type' => 'members',
          'data' => $member->resource_id
        ));
      }
    }

    if( $content == 'networks' || $content == 'everyone' ) {

      // Network
      if( $viewer instanceof User_Model_User && $viewer->getIdentity() )
      {
        $networkTable = Engine_Api::_()->getDbtable('membership', 'network');
        $ids = $networkTable->getMembershipsOfIds($viewer);

        foreach( $ids as $id )
        {
          $event->addResponse(array(
            'type' => 'network',
            'data' => $id
          ));
        }        
      }

    }

    
    if( $content == "everyone" )
    {
      // Registered
      $event->addResponse(array(
        'type' => 'registered',
        'data' => 0
      ));


      // Everyone
      $event->addResponse(array(
        'type' => 'everyone',
        'data' => 0
      ));
    }

  }

  public function addActivity($event)
  {
    $payload = $event->getPayload();
    $subject = $payload['subject'];
    $object = $payload['object'];
    $content = Engine_Api::_()->getApi('settings', 'core')->getSetting('activity.content', 'everyone');

    
    // Owner
    /*
    $event->addResponse(array(
      'type' => 'owner',
      'identity' => 0
    ));
     */
    $subjectOwner = $subject->getOwner('user');
    if( $subjectOwner instanceof User_Model_User )
    {
      $event->addResponse(array(
        'type' => 'owner',
        'identity' => $subjectOwner->getIdentity()
      ));
    }

    // Parent
    $objectParent = $object->getParent('user');
    if( $objectParent instanceof User_Model_User )
    {
      $event->addResponse(array(
        'type' => 'parent',
        'identity' => $objectParent->getIdentity()
      ));
    }


    // Network

    if( $object instanceof User_Model_User ) {
      $networkTable = Engine_Api::_()->getDbtable('membership', 'network');
      $ids = $networkTable->getMembershipsOfIds($object);
      $ids = array_unique($ids);
      foreach( $ids as $id ) {
        $event->addResponse(array(
          'type' => 'network',
          'identity' => $id,
        ));
      }
    }

    // Members

    // @todo check privacy
    // @todo check whether type is disabled
    if( method_exists($object, 'membership') )
    {
      if(  $content == "friends"  )
      {
        // @todo will cause problems in user/group conflict

        $event->addResponse(array(
          'type' => 'members',
          'identity' => $object->getIdentity()
        ));
      }
    }


    // Registered

    // @todo check privacy
    // @todo check whether type is disabled

    if( Engine_Api::_()->authorization()->isAllowed($object, 'registered', 'view') )
    {
      $event->addResponse(array(
        'type' => 'registered',
        'identity' => 0
      ));
    }

    
    // Everyone
    
    // @todo check whether type is disabled

    if( Engine_Api::_()->authorization()->isAllowed($object, 'everyone', 'view') )
    {
      $event->addResponse(array(
        'type' => 'everyone',
        'identity' => 0
      ));
    }
  }
}