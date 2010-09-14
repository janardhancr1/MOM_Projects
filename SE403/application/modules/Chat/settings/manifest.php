<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 7129 2010-08-19 04:20:11Z john $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'chat',
    'version' => '4.0.2',
    'revision' => '$Revision: 7129 $',
    'path' => 'application/modules/Chat',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Chat',
      'description' => 'Chat',
      'author' => 'Webligo Developments',
      'changeLog' => array(
        '4.0.2' => array(
          'controllers/AdminSettingsController.php' => 'Various level settings fixes and enhancements',
          'Form/Admin/Settings/Level.php' => 'Various level settings fixes and enhancements',
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.1-4.0.2.sql' => 'Added',
          'settings/my.sql' => 'Various level settings fixes and enhancements',
        ),
        '4.0.1' => array(
          'controllers/AdminSettingsController.php' => 'Fixed typo',
          'settings/manifest.php' => 'Incremented version',
        ),
      ),
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       'enable',
       'disable',
     ),
    'callback' => array(
      'path' => 'application/modules/Chat/settings/install.php',
      'class' => 'Chat_Installer',
    ),
    'directories' => array(
      'application/modules/Chat',
    ),
    'files' => array(
      'application/languages/en/chat.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onRenderLayoutDefault',
      'resource' => 'Chat_Plugin_Core',
    ),
    array(
      'event' => 'onRenderLayoutAdminDefault',
      'resource' => 'Chat_Plugin_Core',
    )
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(

  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(

  ),
); ?>