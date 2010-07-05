<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6685 2010-07-02 01:00:10Z john $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'authorization',
    'version' => '4.0.0',
    'path' => 'application/modules/Authorization',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Authorization',
      'description' => 'Authorization',
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
      'path' => 'application/modules/Authorization/settings/install.php',
      'class' => 'Authorization_Install',
      'priority' => 5000,
    ),
    'directories' => array(
      'application/modules/Authorization',
    ),
    'files' => array(
      'application/languages/en/authorization.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onItemDeleteBefore',
      'resource' => 'Authorization_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'authorization_level'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'authorization_admin_levels' => array(
      'route' => '/admin/levels/:action/*',
      'defaults' => array(
        'module' => 'authorization',
        'controller' => 'admin-level',
        'action' => 'index',
        //'id' => 0
      )
    )
  )
) ?>