<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: User.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_View_Helper_User extends Zend_View_Helper_Abstract
{
  public function user($identity)
  {
    $user = Engine_Api::_()->user()->getUser($identity);
    if( !$user )
    {
      throw new Zend_View_Exception('User does not exist');
    }
    return $user;
  }
}