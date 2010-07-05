<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: NotificationTypes.php 6505 2010-06-22 23:27:39Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Activity_Model_DbTable_NotificationTypes extends Engine_Db_Table
{
  /**
   * All notification types
   *
   * @var Engine_Db_Table_Rowset
   */
  protected $_notificationTypes;



  // Types

  /**
   * Gets action type meta info
   *
   * @param string $type
   * @return Engine_Db_Row
   */
  public function getNotificationType($type)
  {
    return $this->getNotificationTypes()->getRowMatching('type', $type);
  }

  /**
   * Gets all action type meta info
   *
   * @param string|null $type
   * @return Engine_Db_Rowset
   */
  public function getNotificationTypes()
  {
    if( null === $this->_notificationTypes )
    {
      // Only get enabled types
      //$this->_notificationTypes = $this->fetchAll();
      $enabledModuleNames = Engine_Api::_()->getDbtable('modules', 'core')->getEnabledModuleNames();
      $select = $this->select()
        ->where('module IN(?)', $enabledModuleNames)
        ;
      $this->_notificationTypes = $this->fetchAll($select);
    }

    return $this->_notificationTypes;
  }

  /**
   * Get an assoc types type=>label
   *
   * @return array
   */
  public function getNotificationTypesAssoc()
  {
    $arr = array();
    $translate = Zend_Registry::get('Zend_Translate');

    // depending on friendship settings don't show some options.
    $friend_verfication = (bool) Engine_Api::_()->getApi('settings', 'core')->getSetting('user.friends.verification', true);
    $friend_direction = (bool) Engine_Api::_()->getApi('settings', 'core')->getSetting('user.friends.direction', true);

    foreach( $this->getNotificationTypes() as $type )
    {

      // check if we are dealing with friendship notifications
      if (preg_match('/^friend_/', $type->type)) {

        //* ACTIVITY_TYPE_FRIEND_FOLLOW
        //* ACTIVITY_TYPE_FRIEND_FOLLOW_ACCEPTED
        //* ACTIVITY_TYPE_FRIEND_FOLLOW_REQUEST
        
        //* ACTIVITY_TYPE_FRIEND_ACCEPTED
        //* ACTIVITY_TYPE_FRIEND_REQUEST

        if (preg_match('/follow/', $type->type) && !$friend_direction && !(preg_match('/request/', $type->type) && !$friend_verfication)){
          $arr[$type->type] = $translate->_('ACTIVITY_TYPE_'.strtoupper($type->type));
        }

        else if (!preg_match('/follow/', $type->type) && $friend_direction && !(preg_match('/request/', $type->type) && !$friend_verfication)){
          $arr[$type->type] = $translate->_('ACTIVITY_TYPE_'.strtoupper($type->type));
        }


        // see if friendship is one way
        // if true show "follow" notifications
        // Engine_Api::_()->getApi('settings', 'core')->getSetting('user.friends.direction', true);
      }

      else if ($type->module == 'user' || $type->module == 'activity' || $type->module == 'messages'){
        $arr[$type->type] = $translate->_('ACTIVITY_TYPE_'.strtoupper($type->type));
      }
    }
    return $arr;
  }
}