<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6072 2010-06-02 02:36:45Z john $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Plugin_Core
{
  public function onStatistics($event)
  {
    $table   = Engine_Api::_()->getDbTable('forums', 'forum');
    $select  = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), array(
                        'SUM(topic_count) AS count'));
    $rows    = $table->fetchAll($select)->toArray();
    $event->addResponse($rows[0]['count'], 'forum topic');
  }
}
