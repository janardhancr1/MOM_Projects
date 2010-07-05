<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 5457 2010-05-07 00:56:12Z jung $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Poll_Plugin_Core
{
  public function onStatistics($event)
  {
    $table   = Engine_Api::_()->getDbTable('polls', 'poll');
    $select  = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), array(
                        'COUNT(*) AS count'));
    $rows    = $table->fetchAll($select)->toArray();
    $event->addResponse($rows[0]['count'], 'poll');
    
    $table   = Engine_Api::_()->getDbTable('votes', 'poll');
    $select  = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), array(
                        'COUNT(*) AS count'));
    $rows    = $table->fetchAll($select)->toArray();
    $event->addResponse($rows[0]['count'], 'poll vote');
  }

  public function onUserDeleteBefore($event)
  {
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {
      // Delete polls
      $pollTable = Engine_Api::_()->getDbtable('polls', 'poll');
      $pollSelect = $pollTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $pollTable->fetchAll($pollSelect) as $poll ) {
        Engine_Api::_()->getApi('core', 'poll')->deletePoll($poll->poll_id);
      }
    }
  }
}