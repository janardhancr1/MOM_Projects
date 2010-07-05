<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     Jung
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'classified',
    'version' => '4.0.0',
    'path' => 'application/modules/Classified',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Classifieds',
      'description' => 'Classifieds',
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
      'path' => 'application/modules/Classified/settings/install.php',
      'class' => 'Classified_Installer',
    ),
    'directories' => array(
      'application/modules/Classified',
    ),
    'files' => array(
      'application/languages/en/classified.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onStatistics',
      'resource' => 'Classified_Plugin_Core'
    ),
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Classified_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'classified',
    'classified_album',
    'classified_photo'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'classified_extended' => array(
      'route' => 'classifieds/:controller/:action/*',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'index',
      ),
      'reqs' => array(
        'controller' => '\D+',
        'action' => '\D+',
      )
    ),
    // Public
    'classified_browse' => array(
      'route' => 'classifieds/browse/:page/*',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'index',
        'page' => 1
      )
    ),
    'classified_view' => array(
      'route' => 'classifieds/:user_id/*',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'list'
      ),
      'reqs' => array(
        'user_id' => '\d+'
      )
    ),
    'classified_entry_view' => array(
      'route' => 'classifieds/:user_id/:classified_id',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'view'
      ),
      'reqs' => array(
        'user_id' => '\d+',
        'classified_id' => '\d+'
      )
    ),
    // User
    'classified_create' => array(
      'route' => 'classifieds/create',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'create'
      )
    ),
    'classified_delete' => array(
      'route' => 'classifieds/delete/:classified_id',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'delete'
      )
    ),
    'classified_close' => array(
      'route' => 'classifieds/close/:classified_id/:closed',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'close'
      )
    ),
    'classified_edit' => array(
      'route' => 'classifieds/edit/:classified_id',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'edit'
      )
    ),
    'classified_manage' => array(
      'route' => 'classifieds/manage/:page',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'manage',
        'page' => '1'
      )
    ),
    'classified_success' => array(
      'route' => 'classifieds/success/:classified_id',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'success'
      )
    ),
    'classified_style' => array(
      'route' => 'classifieds/classifiedstyle',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'classifiedstyle'
      )
    ),

    'classified_tag' => array(
      'route' => 'classifieds/tag',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'index',
        'action' => 'suggest'
      )
    ),
    // Admin
    /*
    'classified_admin' => array(
      'route' => 'admin/classified/:action',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'admin',
        'action' => 'index'
      ),
      'reqs' => array(
        //'action' => '[^(level)]'
      )
    ),
     * 
     */

    'classified_admin_manage_level' => array(
      'route' => 'admin/classified/level/:level_id',
      'defaults' => array(
        'module' => 'classified',
        'controller' => 'admin-level',
        'action' => 'index',
        'level_id' => 1
      )
    ),

  ),
);
