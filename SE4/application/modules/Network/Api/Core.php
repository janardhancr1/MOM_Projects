<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6522 2010-06-23 01:52:35Z shaun $
 * @author     Sami
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Network_Api_Core extends Core_Api_Abstract
{
  public function recalculate(User_Model_User $member, $values = null)
  {
    return Engine_Api::_()->getDbtable('networks', 'network')->recalculate($member, $values);
  }
  
 public function recalculateNew(User_Model_User $member)
  {
    return Engine_Api::_()->getDbtable('networks', 'network')->recalculateNew($member);
  }
}