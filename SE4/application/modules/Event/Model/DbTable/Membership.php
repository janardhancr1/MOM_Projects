<?php 
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Membership.php 6512 2010-06-23 00:27:01Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Event_Model_DbTable_Membership extends Core_Model_DbTable_Membership
{
  protected $_type = 'event';


  // Configuration

  /**
   * Does membership require approval of the resource?
   *
   * @param Core_Model_Item_Abstract $resource
   * @return bool
   */
  public function isResourceApprovalRequired(Core_Model_Item_Abstract $resource)
  {
    return $resource->approval;
  }
}