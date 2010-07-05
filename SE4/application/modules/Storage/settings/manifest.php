<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Storage
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'storage',
    'version' => '4.0.0',
    'path' => 'application/modules/Storage',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Storage',
      'description' => 'Storage',
      'author' => 'Webligo Developments',
    ),
    'tests' => array(
      array(
        'type' => 'MysqlEngine',
        'name' => 'MySQL MyISAM Storage Engine',
        'engine' => 'myisam',
      ),
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
      'priority' => 5000,
    ),
    'directories' => array(
      'application/modules/Storage',
    ),
    'files' => array(
      'application/languages/en/storage.csv',
    ),
  ),
  // Content -------------------------------------------------------------------
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onItemDeleteBefore',
      'resource' => 'Storage_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'storage_file',
  )
  // Routes --------------------------------------------------------------------
) ?>