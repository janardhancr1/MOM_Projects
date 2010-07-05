<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 4622 2010-03-25 02:09:30Z jung $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Classified_Plugin_Core
{
  public function onStatistics($event)
  {
    $table   = Engine_Api::_()->getDbTable('classifieds', 'classified');
    $select  = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), array(
                        'COUNT(*) AS count'));
    $rows    = $table->fetchAll($select)->toArray();
    $event->addResponse($rows[0]['count'], 'classified');
  }


  public function onUserDeleteBefore($event)
  {
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {
      // Delete classifieds
      $classifiedTable = Engine_Api::_()->getDbtable('classifieds', 'classified');
      $classifiedSelect = $classifiedTable->select()->where('owner_id = ?', $payload->getIdentity());
      foreach( $classifiedTable->fetchAll($classifiedSelect) as $classified ) {
        $classified->delete();
      }
      // delete images and albums as well
    }
  }
}