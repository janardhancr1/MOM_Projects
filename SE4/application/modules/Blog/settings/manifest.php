<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'blog',
    'version' => '4.0.0',
    'path' => 'application/modules/Blog',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Blogs',
      'description' => 'Blogs',
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
      'path' => 'application/modules/Blog/settings/install.php',
      'class' => 'Blog_Installer',
    ),
    'directories' => array(
      'application/modules/Blog',
    ),
    'files' => array(
      'application/languages/en/blog.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onStatistics',
      'resource' => 'Blog_Plugin_Core'
    ),
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Blog_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'blog'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    // Public
    'blog_browse' => array(
      'route' => 'blogs/:page/*',
      'defaults' => array(
        'module' => 'blog',
        'controller' => 'index',
        'action' => 'index',
        'page' => 1
      )
    ),
    'blog_view' => array(
      'route' => 'blogs/:user_id/*',
      'defaults' => array(
        'module' => 'blog',
        'controller' => 'index',
        'action' => 'list',
      ),
      'reqs' => array(
        'user_id' => '\d+'
      )
    ),
    'blog_entry_view' => array(
      'route' => 'blogs/:user_id/:blog_id/:slug',
      'defaults' => array(
        'module' => 'blog',
        'controller' => 'index',
        'action' => 'view',
        'slug' => '',
      ),
      'reqs' => array(
        'user_id' => '\d+',
        'blog_id' => '\d+'
      )
    ),
    // User
    'blog_create' => array(
      'route' => 'blogs/create',
      'defaults' => array(
        'module' => 'blog',
        'controller' => 'index',
        'action' => 'create'
      )
    ),
    'blog_delete' => array(
      'route' => 'blogs/delete/:blog_id',
      'defaults' => array(
        'module' => 'blog',
        'controller' => 'index',
        'action' => 'delete'
      )
    ),
    'blog_edit' => array(
      'route' => 'blogs/edit/:blog_id',
      'defaults' => array(
        'module' => 'blog',
        'controller' => 'index',
        'action' => 'edit'
      )
    ),
    'blog_manage' => array(
      'route' => 'blogs/manage/:page',
      'defaults' => array(
        'module' => 'blog',
        'controller' => 'index',
        'action' => 'manage',
        'page' => '1'
      )
    ),

    'blog_style' => array(
      'route' => 'blogs/blogstyle',
      'defaults' => array(
        'module' => 'blog',
        'controller' => 'index',
        'action' => 'blogstyle'
      )
    ),

    'blog_tag' => array(
      'route' => 'blogs/tag',
      'defaults' => array(
        'module' => 'blog',
        'controller' => 'index',
        'action' => 'suggest'
      )
    ),
  ),
);
