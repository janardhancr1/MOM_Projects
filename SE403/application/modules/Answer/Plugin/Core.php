<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 5457 2010-05-07 00:56:12Z jung $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Plugin_Core
{
  public function onStatistics($event)
  {
    $table   = Engine_Api::_()->getDbTable('answers', 'answer');
    $select  = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), array(
                        'COUNT(*) AS count'));
    $rows    = $table->fetchAll($select)->toArray();
    $event->addResponse($rows[0]['count'], 'answer');
  }

  public function onUserDeleteBefore($event)
  {
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {
      // Delete answers
      $answerTable = Engine_Api::_()->getDbtable('answers', 'answer');
      $answerSelect = $answerTable->select()->where('user_id = ?', $payload->getIdentity());
      foreach( $answerTable->fetchAll($answerSelect) as $answer ) {
        Engine_Api::_()->getApi('core', 'answer')->deleteAnswer($answer->answer_id);
      }
    }
  }
}