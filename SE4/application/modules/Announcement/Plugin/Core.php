<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6506 2010-06-22 23:34:02Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Announcement_Plugin_Core
{
  public function onItemDeleteBefore($event)
  {
    $payload = $event->getPayload();
    if( $payload instanceof Core_Model_Item_Abstract && $payload->getType() === 'user' )
    {
      $table = Engine_Api::_()->getDbtable('announcements', 'announcement');
      foreach( $table->fetchAll($table->select()->where('user_id = ?', $payload->getIdentity())) as $announcement )
      {
        $announcement->delete();
      }
    }
  }
}