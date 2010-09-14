<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 7250 2010-09-01 07:42:35Z john $
 * @author     Jung
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'classified',
    'version' => '4.0.3',
    'revision' => '$Revision: 7250 $',
    'path' => 'application/modules/Classified',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Classifieds',
      'description' => 'Classifieds',
      'author' => 'Webligo Developments',
      'changeLog' => array(
        '4.0.3' => array(
          'Api/Core.php' => 'Fixed bug in filtering by fields',
          'controllers/AdminFieldsController.php' => 'Fixed missing elements in edit field form',
          'controllers/IndexController.php' => 'Fixed bug in filtering by fields; fixed activity privacy bug; added correct locale date format to archive list',
          'Form/Create.php' => 'Fixed handling on auth elements',
          'Model/Classified.php' => 'Fixed bug where classifieds would not show up in search',
          'settings/my-upgrade-4.0.2-4.0.3.sql' => 'Added',
          'settings/my.sql' => 'Permissions tweaks; incremented version',
          'views/scripts/admin-manage/index.tpl' => 'Added missing translation; added correct date format',
          'views/scripts/index/create.tpl' => 'Fix for unlimited quotas',
          'views/scripts/index/edit.tpl' => 'Fixed bug in fields; added missing translation',
          'views/scripts/index/manage.tpl' => 'Fix for unlimited quotas',
          '/application/languages/en/classified.csv' => 'Added phrases',
        ),
        '4.0.2' => array(
          'controllers/AdminLevelController.php' => 'Various level settings fixes and enhancements',
          'controllers/IndexController.php' => 'Fixed problem preventing saving of fields',
          'Form/Create.php' => 'Fixed problem preventing saving of fields',
          'Form/Admin/Level.php' => 'Moved',
          'Form/Admin/Settings/Level.php' => 'Various level settings fixes and enhancements',
          'Form/Custom/Fields.php' => 'Fixed problem preventing saving of fields',
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.1-4.0.2.sql' => 'Added',
          'settings/my.sql' => 'Various level settings fixes and enhancements',
          'views/scripts/index/view.tpl' => 'Added nl2br on body',
        ),
        '4.0.1' => array(
          'Api/Core.php' => 'Better cleanup of temporary files; adjustment for trial',
          'controllers/AdminLevelController.php' => 'Fixed problem in level select',
          'controllers/IndexController.php' => 'Fixed bug with public viewing classifieds',
          'Form/Custom/Fields.php' => 'Adjustment for trial',
          'Model/Classified.php' => 'Better cleanup of temporary files',
          'Plugin/Core.php' => 'Query optimization',
          'settings/manifest.php' => 'Incremented version',
          'views/scripts/admin-level/index.tpl' => 'Fixed problem in level select',
          'views/scripts/admin-settings/delete.tpl' => 'Fixed typo',
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
