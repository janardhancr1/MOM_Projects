<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'activity',
    'version' => '4.0.0',
    'path' => 'application/modules/Activity',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Activity',
      'description' => 'Activity',
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
      'priority' => 4000,
    ),
    'directories' => array(
      'application/modules/Activity',
    ),
    'files' => array(
      'application/languages/en/activity.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onApplicationModeComet',
      'resource' => 'Activity_Plugin_Comet'
    ),
    array(
      'event' => 'getActivity',
      'resource' => 'Activity_Plugin_Core',
    ),
    array(
      'event' => 'addActivity',
      'resource' => 'Activity_Plugin_Core',
    ),
    array(
      'event' => 'onItemDeleteBefore',
      'resource' => 'Activity_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'activity_action',
    'activity_notification',
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'activity_admin_settings_general' => array(
      'route' => 'admin/settings/activity/',
      'defaults' => array(
        'module' => 'activity',
        'controller' => 'admin-settings',
        'action' => 'general'
      )
    ),
    'recent_activity' => array(
      'route' => 'activity/notifications/',
      'defaults' => array(
        'module' => 'activity',
        'controller' => 'notifications',
      )
    )
  )
) ?>