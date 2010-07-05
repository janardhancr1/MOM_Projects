<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6518 2010-06-23 01:22:43Z shaun $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Invite_Api_Core extends Core_Api_Abstract
{
  protected $_name = 'users';

   /**
   *
   * @param array $emails Array of email addresses to check if members exist
   * @return array Associative array with the email address as the key, and user_id as the value
   */
  public function findIdsByEmail($emails)
  {
    $table  = Engine_Api::_()->getDbTable('users', 'invite');
    $select = $table->select()
                    ->where('email IN (?)', $emails);
    $results = array();
    foreach ($table->fetchAll($select) as $row)
    {
      $results[ $row->email ] = $row->user_id;
    }
    return $results;
  }
}