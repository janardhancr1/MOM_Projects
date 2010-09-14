<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 7243 2010-09-01 01:41:06Z john $
 * @author     Sami
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'network',
    'version' => '4.0.3',
    'revision' => '$Revision: 7243 $',
    'path' => 'application/modules/Network',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Networks',
      'description' => 'Networks',
      'author' => 'Webligo Developments',
      'changeLog' => array(
        '4.0.3' => array(
          'Model/Network.php' => 'Fixed multi checkbox and multi select field support',
          'settings/manifest.php' => 'Incremented version',
          'settings/my.sql' => 'Incremented version',
          '/application/languages/en/network.csv' => 'Added phrases',
        ),
        '4.0.2' => array(
          'controllers/NetworkController.php' => 'Fixed missing check for invisible networks',
          'settings/manifest.php' => 'Incremented version',
        ),
        '4.0.1' => array(
          'controllers/AdminManageController.php' => 'Added missing pagination',
          'settings/manifest.php' => 'Incremented version',
          'views/scripts/admin-manage/index.tpl' => 'Added missing pagination',
          'network.csv' => 'Repair to invalid language string.'
        ),
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
      'priority' => 4000,
    ),
    'directories' => array(
      'application/modules/Network',
    ),
    'files' => array(
      'application/languages/en/network.csv',
    ),
  ),
  // Content -------------------------------------------------------------------
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onFieldsValuesSave',
      'resource' => 'Network_Plugin_User',
    ),
    array(
      'event' => 'onUserCreateAfter',
      'resource' => 'Network_Plugin_User',
    ),
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Network_Plugin_User',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'network'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'network_suggest' => array(
      'route' => 'networks/suggest',
      'defaults' => Array(
      'module' => 'network',
      'controller' => 'network',
      'action'=> 'suggest'
      )
    )
  )
);