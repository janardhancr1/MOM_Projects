<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 7260 2010-09-01 23:42:02Z jung $
 * @author		 Jung
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'video',
    'version' => '4.0.3',
    'revision' => '$Revision: 7260 $',
    'path' => 'application/modules/Video',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Videos',
      'description' => 'Videos',
      'author' => 'Webligo Developments',
      'changeLog' => array(
        '4.0.3' => array(
          'controllers/IndexController.php' => 'Fixed activity privacy bug; fixed quote handling bug',
          'controllers/AdminSettingsController.php' => 'Show error message if FFMPEG path is invalid',
          'Form/Video.php' => 'Hides the privacy setting if there are no privacy set',
          'Plugin/Task/Encode.php' => 'Fixed activity privacy bug; Passes owner_id to storage system; Sets video to processing only after FFMPEG check passes',
          'settings/manifest.php' => 'Incremented version',
          'settings/my.sql' => 'Incremented version',
          'views/scripts/_composeVideo.tpl' => 'Added missing translation',
          'views/scripts/admin-manage/index.tpl' => 'Added correct locale date format',
          'views/scripts/index/create.tpl' => 'Fixed unlimited quota bug',
          'views/scripts/index/manage.tpl' => 'Fixed unlimited quota bug',
          'views/scripts/index/view.tpl' => 'Added missing translation',
          'widgets/list-recent-videos/Controller.php' => 'No longer shows videos that failed or have not finished encoding',
          '/application/languages/en/user.csv' => 'Added phrases',
        ),
        '4.0.2' => array(
          'Api/Core.php' => 'Categories ordered by name',
          'controllers/AdminSettingsController.php' => 'Various level settings fixes and enhancements',
          'controllers/IndexController.php' => 'Filter form now accepts GET requests',
          'Form/Admin/Level.php' => 'Moved',
          'Form/Admin/Settings/Level.php' => 'Various level settings fixes and enhancements',
          'Plugin/Task/Encode.php' => 'Added Ffmpeg validation prior to running encode task.',
          'settings/install.php' => 'Checks for ffmpeg binary on install/upgrade',
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.1-4.0.2.sql' => 'Added',
          'settings/my.sql' => 'Various level settings fixes and enhancements',
          'views/scripts/admin-manage/index.tpl' => 'Uses displayname instead of username',
          'views/scripts/index/browse.tpl' => 'Pagination control keeps filter form params',
        ),
        '4.0.1' => array(
          'Api/Core.php' => 'Adjustments for trial',
          'controllers/AdminSettingsController.php' => 'Fixed problem in level select',
          'controllers/IndexController.php' => 'Better cleanup of temporary files and fixed public permissions',
          'controllers/UploadController.php' => 'Fixed missing level permission check',
          'Plugin/Core.php' => 'Query optimization',
          'Plugin/Task/Encode.php' => 'Better cleanup of temporary files',
          'settings/manifest.php' => 'Incremented version',
          'settings/my-upgrade-4.0.0-4.0.1.sql' => 'Added',
          'settings/my.sql' => 'Added comment_count column to engine4_video_videos table',
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
      'path' => 'application/modules/Video/settings/install.php',
      'class' => 'Video_Installer',
    ),
    'directories' => array(
      'application/modules/Video',
    ),
    'files' => array(
      'application/languages/en/video.csv',
    ),
  ),
  // Compose
  'compose' => array(
    array('_composeVideo.tpl', 'video'),
  ),
  'composer' => array(
    'video' => array(
      'script' => array('_composeVideo.tpl', 'video'),
      'plugin' => 'Video_Plugin_Composer',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  // Items ---------------------------------------------------------------------
  'items' => array(
    'video',
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onStatistics',
      'resource' => 'Video_Plugin_Core'
    ),
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Video_Plugin_Core',
    ),
  ),
  // Content -------------------------------------------------------------------
  'content'=> array(
    'video_profile_videos' => array(
      'type' => 'action',
      'title' => 'Video Profile Tab',
      'route' => array(
        'module' => 'video',
        'controller' => 'widget',
        'action' => 'profile-video',
      ),
    )
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    'video_general' => array(
      'route' => 'videos/:action/*',
      'defaults' => array(
        'module' => 'video',
        'controller' => 'index',
        'action' => 'browse',
      ),
      'reqs' => array(
        'action' => '(index|browse|create|list|manage)',
      )
    ),
    'video_profile' => array(
      'route' => 'video/:id/*',
      'defaults' => array(
        'module' => 'video',
        'controller' => 'profile',
        'action' => 'index',
      ),
      'reqs' => array(
        'id' => '\d+',
      )
    ),
    'video_view' => array(
      'route' => 'videos/:user_id/:video_id/:slug/*',
      'defaults' => array(
        'module' => 'video',
        'controller' => 'index',
        'action' => 'view',
        'slug' => '',
      ),
      'reqs' => array(
        'user_id' => '\d+'
      )
    ),
    'video_delete' => array(
      'route' => 'video/delete/:video_id',
      'defaults' => array(
        'module' => 'video',
        'controller' => 'index',
        'action' => 'delete'
      )
    ),
    'video_edit' => array(
      'route' => 'video/edit/:video_id',
      'defaults' => array(
        'module' => 'video',
        'controller' => 'index',
        'action' => 'edit'
      )
    ),
    'video_retry' => array(
      'route' => 'video/retry/:retry',
      'defaults' => array(
        'module' => 'video',
        'controller' => 'index',
        'action' => 'create'
      )
    ),
  )
) ?>