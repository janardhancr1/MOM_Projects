<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 7255 2010-09-01 21:07:55Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'core',
    'version' => '4.0.3p1',
    'revision' => '$Revision: 7255 $',
    'path' => 'application/modules/Core',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Core',
      'description' => 'Core',
      'author' => 'Webligo Developments',
      'changeLog' => array(
        '4.0.3p1' => array(
          '/.htaccess' => 'Remove [R=404] due to some Apache incompatibilities',
          'Form/Admin/Mail/Templates.php' => 'Added submit button',
        ),
        '4.0.3' => array(
          'Api/Core.php' => 'hasSubject() accepts an argument to filter by',
          'Api/Links.php' => 'Fixes bad extensions in link thumbnails',
          'Api/Mail.php' => 'Added statistics; minor tweaks',
          'Api/Menus.php' => 'Added support for disabling menu items; added support for overriding plugin class methods',
          'Api/Search.php' => 'Added search filtering by item type',
          'Bootstrap.php' => 'Added missing translation',
          'controllers/AdminAdsController.php' => 'Fixed typo that caused problems in populating level and network selection',
          'controllers/AdminContentController.php' => 'Tweaks for improved widget form',
          'controllers/AdminIndexController.php' => 'Better handling of missing configuration files',
          'controllers/AdminLanguageController.php' => 'Added missing translation',
          'controllers/AdminMailController.php' => 'Added; split settings and templates into two actions; fixed template editing',
          'controllers/AdminMenusController.php' => 'Added support for disabling menu items; added missing translation',
          'controllers/AdminSettingsController.php' => 'Moved email settings, Cache setting failover',
          'controllers/AdminStatsController.php' => 'Added correct locale date format',
          'controllers/CommentController.php' => 'Comment can now be deleted by poster',
          'controllers/ErrorController.php' => 'Raw headers now use server protocol',
          'controllers/SearchController.php' => 'Added filtering of search results by content type; added search highlighting',
          'externals/scripts/core.js' => 'Fixed comment count updating during comment deletion',
          'externals/styles/admin/main.css' => 'Style tweaks',
          'Form/Search.php' => 'Added filtering of search results by content type',
          'Form/Admin/Mail/*' => 'Added',
          'Form/Admin/Menu/ItemCreate.php' => 'Added support for disabling menu items',
          'Form/Admin/Language/Create.php' => 'Added missing translation',
          'Form/Admin/Message/Mail.php' => 'Added missing translation',
          'Form/Admin/Settings/Locale.php' => 'Added missing translation',
          'Form/Admin/Settings/Performance.php' => 'Added missing translation',
          'Form/Admin/Widget/Ads.php' => 'Cleanup',
          'Form/Admin/Widget/Logo.php' => 'Cleanup',
          'Form/Admin/Widget/MenuGeneric.php' => 'Added generic menu widget',
          'Form/Admin/Widget/Standard.php' => 'Abstract widget admin edit form',
          'layouts/scripts/admin.tpl' => 'Fixed typo in timestamp language',
          'layouts/scripts/default.tpl' => 'Fixed typo in timestamp language',
          'settings/content.php' => 'Added generic menu widget',
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.2-4.0.3.sql' => 'Added',
          'settings/my.sql' => 'Increased plugin column length; added support for disabling menu items; renamed some settings; split email settings into two items',
          'views/scripts/admin-content/index.tpl' => 'Added missing translation',
          'views/scripts/admin-files/index.tpl' => 'Added missing translation',
          'views/scripts/admin-language/index.tpl' => 'Added missing translation',
          'views/scripts/admin-mail/*' => 'Split email settings into two items',
          'views/scripts/admin-menus/index.tpl' => 'Added support for disabling menu items; added missing translation',
          'views/scripts/admin-system/php.tpl' => 'Added missing translation',
          'views/scripts/admin-themes/index.tpl' => 'Added missing translation',
          'views/scripts/comment/list.tpl' => 'Fixed bug in comment deletion',
          'views/scripts/search/index.tpl' => 'Added text highlighting',
          'widgets/menu-generic/*' => 'Added generic menu widget',
          'widgets/admin-menu-mini/Controller.php' => 'Better handling for missing configuration files',
          'widgets/admin-statistics/Controller.php' => 'Added email statistics',
          'widgets/container-tabs/index.tpl' => 'Fixed bug with more item when two are shown on a page',
          'widgets/content/index.tpl' => 'Fixes for embedding pages in content system',
          '/application/languages/en/core.csv' => 'Added phrases',
        ),
        '4.0.2' => array(
          'Api/Mail.php' => 'Added HTML support to system emails',
          'Api/Menus.php' => 'Added automatic class names to menu items',
          'Api/Ad.php' => 'Fixed bug in deleting ads without images',
          'controllers/AdminAdsController.php' => 'Added missing check for empty levels or networks; added delete selected',
          'controllers/AdminSettingsController.php' => 'Fix bug populating SMTP info into form',
          'controllers/AdminLanguageController.php' => 'Fix undefined offset bug',
          'controllers/CommentController.php' => 'Added missing delete comment option for object owner',
          'externals/scripts/core.js' => 'Added missing delete comment option for object owner',
          'externals/styles/admin/main.css' => 'Style tweak for nested dependent fields',
          'Form/Admin/Language/Upload.php' => 'Fix undefined offset bug',
          'Form/Admin/Widget/Logo.php' => 'Fixed problem that prevent uploading images with uppercase extensions',
          'settings/manifest.php' => 'Incremented version',
          'views/scripts/admin-ads/deleteselected.tpl' => 'Added delete selected',
          'views/scripts/admin-report/index.tpl' => 'Compatibility for reports imported from version 3',
          'views/scripts/comment/list.tpl' => 'Added missing delete comment option for object owner',
          'views/scripts/search/index.tpl' => 'Fix untranslated text',
          'wigets/admin-statistics/Controller.php' => 'Added statistic for online users',
        ),
        '4.0.1' => array(
          'Bootstrap.php' => 'Session cookie defaults to not httponly to solve FancyUpload problems',
          'Api/Ad.php' => 'Better cleanup of temporary files',
          'Api/Mail.php' => 'Enhanced queueing functionality',
          'controllers/AdminAuthController.php' => 'Added return url',
          'controllers/AdminFilesController.php' => 'Disallowed uploading of php files',
          'controllers/AdminMessageController.php' => 'Added email of all users',
          'controllers/AdminReportController.php' => 'Consistency',
          'controllers/AdminSettingsController.php' => 'Added configuration of mail transport',
          'controllers/ErrorController.php' => 'Added case in requireuser for facebook login',
          'Form/Report.php' => 'Added new report categories',
          'Form/Admin/Auth/Login.php' => 'Added return url',
          'Form/Admin/Language/Create.php' => 'Fix notice messages in creating language vars',
          'Form/Admin/Message/Mail.php' => 'Added email of all users',
          'Form/Admin/Settings/Email.php' => 'Added setting to enable/disable queueing',
          'Model/Adcampaign.php' => 'Adds checking for campaign start time',
          'Model/DbTable/Tasks.php' => 'Fixed possible bug in acquiring trigger lock',
          'Model/Item/Abstract.php' => 'Adjustments for trial and in cases of orphan items system handles missing owner more gracefully',
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.0-4.0.1.sql' => 'Added',
          'settings/my.sql' => 'Removed comet settings; enhanced mail queue functionality; added menu item for email all members',
          'views/scripts/admin-content/index.tpl' => 'Fixed bug that prevented editing settings for widgets in a tabbed content block',
          'views/scripts/admin-language/edit.tpl' => 'Fixed problem with pagination',
          'views/scripts/admin-message/mail.tpl' => 'Added email of all users',
          'views/scripts/admin-settings/email.tpl' => 'Added configuration of mail transport',
          'views/scripts/admin-stats/referrers.tpl' => 'GET -> POST',
          'widgets/ad-campaign/Controller.php' => 'Adds checking for campaign start time',
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
