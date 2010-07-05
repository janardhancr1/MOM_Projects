<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 4622 2010-03-25 02:09:30Z jung $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Video_Plugin_Core
{
  public function onStatistics($event)
  {
    $table   = Engine_Api::_()->getDbTable('videos', 'video');
    $select  = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), array(
                        'COUNT(*) AS count'));
    $rows    = $table->fetchAll($select)->toArray();
    $event->addResponse($rows[0]['count'], 'video');
  }

  public function onUserDeleteBefore($event)
  {
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {
      // Delete videos
      $videoTable = Engine_Api::_()->getDbtable('videos', 'video');
      $videoSelect = $videoTable->select()->where('owner_id = ?', $payload->getIdentity());
      foreach( $videoTable->fetchAll($videoSelect) as $video ) {
        Engine_Api::_()->getApi('core', 'video')->deleteVideo($video);
      }
    }
  }
}