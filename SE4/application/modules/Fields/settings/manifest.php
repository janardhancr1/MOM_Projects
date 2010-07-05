<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'fields',
    'version' => '4.0.0',
    'path' => 'application/modules/Fields',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Fields',
      'description' => 'Fields',
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
      'priority' => 3500,
    ),
    'directories' => array(
      'application/modules/Fields',
    ),
    'files' => array(
      'application/languages/en/fields.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  // Items ---------------------------------------------------------------------
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'fields_admin_settings_general' => array(
      'route' => 'admin/settings/fields/',
      'defaults' => array(
          'module' => 'fields',
          'controller' => 'admin',
          'action' => 'index'
      )
    )
  )
) ?>