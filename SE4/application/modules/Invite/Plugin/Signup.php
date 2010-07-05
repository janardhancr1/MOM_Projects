<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Signup.php 6518 2010-06-23 01:22:43Z shaun $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Invite_Plugin_Signup
{
  public function onUserCreateAfter($payload)
  {
    $user    = $payload->getPayload();

    $session = new Zend_Session_Namespace('invite');
    if (!empty($session->invite_code)) {
      // find invited email, then convert all invites for that email address
      $table     = Engine_Api::_()->getDbtable('invites', 'invite');
      $subselect = $table->select()
                         ->from($table, 'recipient')
                         ->where('code = ?', $session->invite_code)
                         ->limit(1);
      $select    = $table->select()
                         ->from($table, array('id', 'user_id'))
                         ->where('recipient = (?)', new Zend_Db_Expr($subselect));

      $befriend_user_ids = array();
      $invite_ids        = array();
      foreach ($table->fetchAll($select) as $row) {
        $befriend_user_ids[] = $row->user_id;
        $invite_ids[]        = $row->id;
      }
      
      // set invite table entries to this user's user_id
      if (!empty($invite_ids))
        $table->update( array('new_user_id' => $user->user_id),
            /* where */ 'id IN ('.implode(',', $invite_ids).')' );

      // add friend request to this user from invited users
      if (!empty($befriend_user_ids)) {
        $activity = Engine_Api::_()->getDbtable('notifications', 'activity');
        foreach (Engine_Api::_()->user()->getUserMulti($befriend_user_ids) as $friend) {
          $user->membership()->addMember($friend);
          $user->membership()->setUserApproved($friend);
          $activity->addNotification($user, $friend, $user, 'friend_request');
        }
      }

      // unset session's invite_code
      unset($session->invite_code);
      
    } // end if (!empty($session->invite_code)) {
  } // end public function onUserCreateAfter($user) {
  
}
?>
