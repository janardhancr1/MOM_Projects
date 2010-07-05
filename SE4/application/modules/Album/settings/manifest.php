<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     Jung
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'album',
    'version' => '4.0.0',
    'path' => 'application/modules/Album',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Albums',
      'description' => 'Albums',
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
      'path' => 'application/modules/Album/settings/install.php',
      'class' => 'Album_Installer',
    ),
    'directories' => array(
      'application/modules/Album',
    ),
    'files' => array(
      'application/languages/en/album.csv',
    ),
  ),
  // Compose -------------------------------------------------------------------
  'compose' => array(
    array('_composePhoto.tpl', 'album'),
  ),
  'composer' => array(
    'photo' => array(
      'script' => array('_composePhoto.tpl', 'album'),
      'plugin' => 'Album_Plugin_Composer',
    ),
  ),
  // Content -------------------------------------------------------------------
  'content'=> array(
    'album_profile_albums' => array(
      'type' => 'action',
      'title' => 'Album Profile Tab',
      'route' => array(
        'module' => 'album',
        'controller' => 'widget',
        'action' => 'profile-albums',
      ),
    )
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'album',
    'album_photo',
    'photo'
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onStatistics',
      'resource' => 'Album_Plugin_Core'
    ),
    array(
      'event' => 'onUserProfilePhotoUpload',
      'resource' => 'Album_Plugin_Core'
    ),
    array(
      'event' => 'onUserDeleteAfter',
      'resource' => 'Album_Plugin_Core'
    )
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
     'album_extended' => array(
      'route' => 'albums/:controller/:action/*',
      'defaults' => array(
        'module' => 'album',
        'controller' => 'index',
        'action' => 'index'
      ),
      ),
    'album_specific' => array(
      'route' => 'albums/:action/:album_id/*',
      'defaults' => array(
        'module' => 'album',
        'controller' => 'album',
        'action' => 'view'
      ),
      'reqs' => array(
        'action' => '(compose-upload|delete|edit|editphotos|upload|view)',
      ),
    ),
    'album_general' => array(
      'route' => 'albums/:action/*',
      'defaults' => array(
        'module' => 'album',
        'controller' => 'index',
        'action' => 'browse'
      ),
      'reqs' => array(
        'action' => '(browse|create|list|manage|upload|upload-photo)',
      ),
    ),

    'album_photo_specific' => array(
      'route' => 'albums/photos/:action/:album_id/:photo_id/*',
      'defaults' => array(
        'module' => 'album',
        'controller' => 'photo',
        'action' => 'view'
      ),
      'reqs' => array(
        'action' => '(view)',
      ),
    ),
    // Admin
    /*
    'album_admin_manage_level' => array(
      'route' => 'admin/album/admin-level/:level_id',
      'defaults' => array(
        'module' => 'album',
        'controller' => 'admin-level',
        'action' => 'index',
        'level_id' => 1
      )
    ),
    'album_admin' => array(
      'route' => 'admin/settings/albums',
      'defaults' => array(
        'module' => 'album',
        'controller' => 'admin',
        'action' => 'index'
      )
    ),
    'album_admin_view' => array(
      'route' => 'admin/view/albums/:page',
      'defaults' => array(
        'module' => 'album',
        'controller' => 'admin',
        'action' => 'view',
        'page' => 1
      )
    )
    'album_admin' => array(
      'route' => 'admin/album/:action',
      'defaults' => array(
        'module' => 'album',
        'controller' => 'admin',
        'action' => 'index'
      ),
      'reqs' => array(
        //'action' => '[^(level)]'
      )
    ),
*/
    'album_admin_manage_level' => array(
      'route' => 'admin/album/level/:level_id',
      'defaults' => array(
        'module' => 'album',
        'controller' => 'admin-level',
        'action' => 'index',
        'level_id' => 1
      )
    ),
  ),
);
