<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 4622 2010-03-25 02:09:30Z jung $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Blog_Plugin_Core
{
  public function onStatistics($event)
  {
    $table   = Engine_Api::_()->getDbTable('blogs', 'blog');
    $select  = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), array(
                        'COUNT(*) AS count'));
    $rows    = $table->fetchAll($select)->toArray();
    $event->addResponse($rows[0]['count'], 'blog');
  }

  public function onUserDeleteBefore($event)
  {
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {
      // Delete blogs
      $blogTable = Engine_Api::_()->getDbtable('blogs', 'blog');
      $blogSelect = $blogTable->select()->where('owner_id = ?', $payload->getIdentity());
      foreach( $blogTable->fetchAll($blogSelect) as $blog ) {
        $blog->delete();
      }
    }
  }
}