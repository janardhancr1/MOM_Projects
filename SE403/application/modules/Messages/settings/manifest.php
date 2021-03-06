<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Messages
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 7243 2010-09-01 01:41:06Z john $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'messages',
    'version' => '4.0.3',
    'revision' => '$Revision: 7243 $',
    'path' => 'application/modules/Messages',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Messages',
      'description' => 'Messages',
      'author' => 'Webligo Developments',
      'changeLog' => array(
        '4.0.3' => array(
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.2-4.0.3.sql' => 'Added',
          'settings/my.sql' => 'Incremented version; added email notification template for new message',
          '/application/languages/en/messages.csv' => 'Added phrases',
        ),
        '4.0.2' => array(
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.1-4.0.2.sql' => 'Added',
          'settings/my.sql' => 'Various level settings fixes and enhancements',
          'views/scripts/messages/inbox.tpl' => 'Delete Selected is now translated',
        ),
        '4.0.1' => array(
          'controllers/AdminSettingsController.php' => 'Fixed problem in level select',
          'controllers/MessagesController.php' => 'Changed json_encode to Zend_Json::encode',
          'settings/manifest.php' => 'Incremented version',
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
      'application/modules/Messages',
    ),
    'files' => array(
      'application/languages/en/messages.csv',
    ),
  ),
  // Content -------------------------------------------------------------------
  // Hooks ---------------------------------------------------------------------
  // Items ---------------------------------------------------------------------
  'items' => array(
    'messages_message',
    'messages_conversation',
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'messages_general' => array(
      'route' => 'messages/:action/*',
      'defaults' => array(
        'module' => 'messages',
        'controller' => 'messages',
        'action' => '(inbox|outbox)',
      ),
      'reqs' => array(
        'action' => '\D+',
      )
    ),
    'messages_delete' => array(
      'route' => 'messages/delete/:message_ids',
      'defaults' => array(
        'module' => 'messages',
        'controller' => 'messages',
        'action' => 'delete',
        'message_ids' => '',
      )
    ),
    
    // Admin
    'messages_admin_settings' => array(
      'route' => 'admin/messages/settings/:action/*',
      'defaults' => array(
        'module' => 'messages',
        'controller' => 'admin-settings',
        'action' => 'level'
      ),
      'reqs' => array(
        'action' => '\D+'
      )
    ),
  )
) ?>
