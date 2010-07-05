<?php
/**
 * SocialEngine
 *
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6669 2010-07-01 05:30:45Z steve $
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'core',
    'name' => 'base',
    'version' => '4.0.0',
    'path' => '/',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Base',
      'description' => 'Base',
      'author' => 'Webligo Developments',
    ),
    'actions' => array(
      'install',
      'upgrade',
      'refresh',
    ),
    'files' => array(
      '.htaccess',
      'README.html',
      'comet.php',
      'index.php',
      'robots.txt',
      'xd_receiver.htm',
      'application/.htaccess',
      'application/config.php',
      'application/css.php',
      'application/index.php',
      'application/lite.php',
      'application/maintenance.html',
      'application/mobile.php',
      'application/offline.html',
      'application/languages/index.html',
      'application/libraries/index.html',
      'application/modules/index.html',
      'application/packages/index.html',
      'application/plugins/index.html',
      'application/themes/index.html',
      'application/widgets/index.html',
      'externals/index.html',
      'externals/.htaccess',
    ),
    'directories' => array(
      'application/settings',
      'public',
      'temporary/cache',
      'temporary/log',
      'temporary/scaffold',
      'temporary/session',
      'temporary/package',
    ),
  ),
); ?>