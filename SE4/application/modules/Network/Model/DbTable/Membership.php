<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Membership.php 6522 2010-06-23 01:52:35Z shaun $
 * @author     Sami
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Network_Model_DbTable_Membership extends Core_Model_DbTable_Membership
{
  protected $_type = 'network';

  public function isUserApprovalRequired()
  {
    return false;
  }

  public function isResourceApprovalRequired()
  {
    return false;
  }

  protected function _delete(){

  }
}
