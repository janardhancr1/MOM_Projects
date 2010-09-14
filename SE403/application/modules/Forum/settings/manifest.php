<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 7250 2010-09-01 07:42:35Z john $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'forum',
    'version' => '4.0.3',
    'revision' => '$Revision: 7250 $',
    'path' => 'application/modules/Forum',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Forum',
      'description' => 'Forum',
      'author' => 'Webligo Developments',
      'changeLog' => array(
        '4.0.3' => array(
          'controllers/AdminLevelController.php' => 'Fixed bug preventing changing of level',
          'settings/manifest.php' => 'Incremented version',
          'settings/my.sql' => 'Incremented version',
          'views/scripts/admin-level/index.tpl' => 'Fixed bug preventing changing of level',
          'views/scripts/forum/view.tpl' => 'Added missing translation',
          'views/scripts/index/index.tpl' => 'Added missing translation',
          '/application/languages/en/forum.csv' => 'Added phrases',
        ),
        '4.0.2' => array(
          'controllers/AdminLevelController.php' => 'Form adjustments',
          'controllers/PostController.php' => 'Adding permission checking to editing/deleting posts',
          'Form/Admin/Level.php' => 'Moved',
          'Form/Admin/Settings/Level.php' => 'Various level settings fixes and enhancements',
          'Model/Topic.php' => 'Fixes bug when the last post is deleted in a topic',
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.1-4.0.2.sql' => 'Added',
          'settings/my.sql' => 'Various level settings fixes and enhancements; fixed problem that would prevent post editing and deleting',
          'views/scripts/index/index.tpl' => 'Last post optimization',
          'views/scripts/topic/view.tpl' => 'Fixes edit auth problem; fixed missing signature problem',
        ),
        '4.0.1' => array(
          'controllers/AdminLevelController.php' => 'Fixed problem in level select',
          'controllers/ForumController.php' => 'Added view count support',
          'controllers/TopicController.php' => 'Added missing level permission check for quick reply',
          'Form/Post/Quick.php' => 'Added label to quick reply form',
          'Model/Forum.php' => 'Added lastpost_id support',
          'Model/Post.php' => 'Better cleanup of temporary files; added forum lastpost_id support',
          'Model/Topic.php' => 'Added lastpost_id support',
          'Plugin/Core.php' => 'Query optimization',
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.0-4.0.1.sql' => 'Added',
          'settings/my.sql' => 'Added lastposter_id and view_count columns to the engine4_forum_forums table; fixed incorrect primary key on the engine4_forum_listitems table; added lastpost_id and lastposter_id columns to the engine4_forum_topics table',
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
));