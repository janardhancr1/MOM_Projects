<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'group',
    'version' => '4.0.0',
    'path' => 'application/modules/Group',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Groups',
      'description' => 'Groups',
      'author' => 'Webligo Developments',
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       'enable',
       'disable',
     ),
    'callback' => array(
      'path' => 'application/modules/Group/settings/install.php',
      'class' => 'Group_Installer',
    ),
    'directories' => array(
      'application/modules/Group',
    ),
    'files' => array(
      'application/languages/en/group.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onStatistics',
      'resource' => 'Group_Plugin_Core'
    ),
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Group_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'group',
    'group_album',
    'group_list',
    'group_list_item',
    'group_photo',
    'group_post',
    'group_topic',
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'group_extended' => array(
      'route' => 'groups/:controller/:action/*',
      'defaults' => array(
        'module' => 'group',
        'controller' => 'index',
        'action' => 'index',
      ),
      'reqs' => array(
        'controller' => '\D+',
        'action' => '\D+',
      )
    ),
    'group_general' => array(
      'route' => 'groups/:action/*',
      'defaults' => array(
        'module' => 'group',
        'controller' => 'index',
        'action' => 'browse',
      ),
      'reqs' => array(
        'action' => '(browse|create|list|manage)',
      )
    ),
    'group_specific' => array(
      'route' => 'groups/:action/:group_id/*',
      'defaults' => array(
        'module' => 'group',
        'controller' => 'group',
        'action' => 'index',
      ),
      'reqs' => array(
        'action' => '(edit|delete|join|leave|cancel|accept|invite|style)',
        'group_id' => '\d+',
      )
    ),
    'group_profile' => array(
      'route' => 'group/:id/*',
      'defaults' => array(
        'module' => 'group',
        'controller' => 'profile',
        'action' => 'index',
      ),
      'reqs' => array(
        'id' => '\d+',
      )
    ),
    'group_browse' => array(
      'route' => 'group/browse',
      'defaults' => array(
        'module' => 'group',
        'controller' => 'index',
        'action' => 'browse'
      )
    ),
    'group_admin_manage_level' => array(
      'route' => 'admin/group/level/:level_id',
      'defaults' => array(
        'module' => 'group',
        'controller' => 'admin-settings',
        'action' => 'level',
        'level_id' => 1
      )
    )    
  )
) ?>