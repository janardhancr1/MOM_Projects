<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Messages
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'messages',
    'version' => '4.0.0',
    'path' => 'application/modules/Messages',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Messages',
      'description' => 'Messages',
      'author' => 'Webligo Developments',
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
