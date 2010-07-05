<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'forum',
    'version' => '4.0.0',
    'path' => 'application/modules/Forum',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Forum',
      'description' => 'Forum',
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
      'path' => 'application/modules/Forum/settings/install.php',
      'class' => 'Forum_Installer',
    ),
    'directories' => array(
      'application/modules/Forum',
    ),
    'files' => array(
      'application/languages/en/forum.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array('event' => 'onStatistics',
      'resource' => 'Forum_Plugin_Core'),
    array('event' => 'onUserDeleteAfter',
      'resource' => 'Forum_Plugin_User')
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'forum_forum',
    'forum_category',
    'forum_container',
    'forum_post',
    'forum_signature',
    'forum_topic',
    'forum_list',
    'forum_list_item'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'forum_general'=> array(
      'route'=>'forums/*',
      'defaults' => array(
        'module' => 'forum',
        'controller' => 'index',
        'action' => 'index'
      )
    ),
    'forum_forum' => array(
      'route'=>'forums/:action/:forum_id/*',
      'defaults' =>  array(
        'module'=>'forum',
        'controller'=>'forum',
        'action'=>'view'
      )
    ),
    'forum_topic' => array(
      'route'=>'forums/topic/:action/:topic_id/*',
      'defaults' =>  array(
        'module'=>'forum',
        'controller'=>'topic',
        'action'=>'view'
      )
    ),
    'forum_post' => array(
      'route'=>'forums/post/:action/:post_id/*',
      'defaults' =>  array(
        'module'=>'forum',
        'controller'=>'post',
        'action'=>'view'
      )
    ),
    'forum_topic_create' => array(
      'route'=>'forums/topic/create/:forum_id/*',
      'defaults' =>  array(
        'module'=>'forum',
        'controller'=>'topic',
        'action'=>'create'
      )
    ),
    'forum_post_create' => array(
      'route'=>'forums/post/create/:topic_id/*',
      'defaults' =>  array(
        'module'=>'forum',
        'controller'=>'post',
        'action'=>'create'
      )
    ),
    
    // Admin
    /*
    'forum_admin' => array(
      'route' => 'admin/forum/:action',
      'defaults' => array(
        'module' => 'forum',
        'controller' => 'admin',
        'action' => 'index'
      ),
      'reqs' => array(
      //'action' => '[^(level)]'
      )
    ),
*/
    'forum_admin_manage_level' => array(
      'route' => 'admin/forum/level/:level_id',
      'defaults' => array(
        'module' => 'forum',
        'controller' => 'admin-level',
        'action' => 'index',
        'level_id' => 1
      )
    ),

    /*
    'forum_admin_manage' => array(
      'route' => 'admin/forum/manage/:action/*',
      'defaults' => array(
        'module' => 'forum',
        'controller' => 'admin-manage',
        'action' => 'index',
      ))
*/
));