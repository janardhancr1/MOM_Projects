<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6684 2010-07-02 00:57:13Z john $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'core',
    'version' => '4.0.0',
    'path' => 'application/modules/Core',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Core',
      'description' => 'Core',
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
      'path' => 'application/modules/Core/settings/install.php',
      'class' => 'Core_Install',
      'priority' => 9001,
    ),
    'directories' => array(
      'application/modules/Core',
    ),
    'files' => array(
      'application/languages/en/core.csv',
    ),
  ),
  // Composer -------------------------------------------------------------------
  'composer' => array(
    'link' => array(
      'script' => array('_composeLink.tpl', 'core'),
      'plugin' => 'Core_Plugin_Composer',
    ),
    'tag' => array(
      'script' => array('_composeTag.tpl', 'core'),
      'plugin' => 'Core_Plugin_Composer',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onItemDeleteBefore',
      'resource' => 'Core_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'core_ad',
    'core_adcampaign',
    'core_adphoto',
    'core_comment',
    'core_geotag',
    'core_link',
    'core_like',
    'core_list',
    'core_list_item',
    'core_page',
    'core_report',
    'core_mail_template',
    'core_tag',
    'core_tag_map',
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'home' => array(
      'route' => '/',
      'defaults' => array(
        'module' => 'core',
        'controller' => 'index',
        'action' => 'index'
      )
    ),
    'core_home' => array(
      'route' => '/',
      'defaults' => array(
        'module' => 'core',
        'controller' => 'index',
        'action' => 'index'
      )
    ),
    'confirm' => array(
      'route'=>'/confirm',
      'defaults' => array(
        'module'=>'core',
        'controller'=>'confirm',
        'action'=>'confirm'
      )
    ),
    // Admin - General

    // Admin - Manage
    /*
    'core_admin_manage_report' => array(
      'route' => "admin/manage/report/:action/*",
      'defaults' => array(
        'module' => 'core',
        'controller' => 'admin-report',
        'action' => 'index'
      )
    ),
    */

    // Admin - General
    'core_admin_settings' => array(
      'route' => "admin/core/settings/:action/*",
      'defaults' => array(
        'module' => 'core',
        'controller' => 'admin-settings',
        'action' => 'index'
      ),
      'reqs' => array(
        'action' => '\D+',
      )
    ),

    'core_admin_emails' => array(
      'route' => 'admin/email/:language_id/:template_id',
      'defaults' => array(
        'module' => 'core',
        'controller' => 'admin-settings',
        'action' => 'email',
        'level_id' => 1,
        'template_id' => 1
      )
    ),
  )
) ?>