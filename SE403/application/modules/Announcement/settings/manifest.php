<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 7261 2010-09-02 00:05:34Z john $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'announcement',
    'version' => '4.0.2',
    'revision' => '$Revision: 7261 $',
    'path' => 'application/modules/Announcement',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Announcements',
      'description' => 'Announcements',
      'author' => 'Webligo Developments',
      'changeLog' => array(
        '4.0.2' => array(
          'settings/manifest.php' => 'Incremented version',
          'settings/my.sql' => 'Incremented version',
          '/application/languages/en/announcement.csv' => 'Added phrases',
        ),
        '4.0.1' => array(
          'settings/manifest.php' => 'Incremented version',
          'widgets/list-announcements/index.tpl' => 'Switched array to paginator',
        ),
      ),
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       //'enable',
       //'disable',
     ),
    'callback' => array(
      'class' => 'Engine_Package_Installer_Module',
    ),
    'directories' => array(
      'application/modules/Announcement',
    ),
    'files' => array(
      'application/languages/en/announcement.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onItemDeleteBefore',
      'resource' => 'Announcement_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'announcement'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    
  )
) ?>
