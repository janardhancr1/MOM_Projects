<?php
/**
 * @package     Engine_Core
 * @version     $Id: index.php 6657 2010-07-01 01:38:38Z john $
 * @copyright   Copyright (c) 2008 Webligo Developments
 * @license     See license.html
 */

// Redirect to index if rewrite not enabled
if( !defined('_ENGINE_R_REWRITE') ) {
  if( empty($_GET['rewrite']) && $_SERVER['PHP_SELF'] != parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ) {
    // Calculate base url
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
  } else if( isset($_GET['rewrite']) && $_GET['rewrite'] == 2 ) {
    header('Location: ' . dirname($_SERVER['PHP_SELF']));
    exit();
  }
}

// Config
if( !defined('_ENGINE_R_CONF') || _ENGINE_R_CONF ) {

  // Error reporting
  error_reporting(E_ALL);

  // Constants
  define('_ENGINE', TRUE);
  define('DS', DIRECTORY_SEPARATOR);
  define('PS', PATH_SEPARATOR);

  // Define full application path, environment, and name
  defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(dirname(__FILE__))));
  defined('APPLICATION_PATH_COR') || define('APPLICATION_PATH_COR', realpath(dirname(__FILE__)));
  defined('APPLICATION_PATH_TMP') || define('APPLICATION_PATH_TMP', APPLICATION_PATH . DS . 'temporary');
  defined('APPLICATION_PATH_EXT') || define('APPLICATION_PATH_EXT', APPLICATION_PATH . DS . 'externals');
  defined('APPLICATION_PATH_PUB') || define('APPLICATION_PATH_PUB', APPLICATION_PATH . DS . 'public');
  defined('APPLICATION_PATH_SET') || define('APPLICATION_PATH_SET', APPLICATION_PATH_COR . DS . 'settings');
  defined('APPLICATION_NAME') || define('APPLICATION_NAME', 'Core');

  define('_ENGINE_ADMIN_NEUTER', false);

  // Setup required include paths; optimized for Zend usage. Most other includes
  // will use an absolute path
  set_include_path(
    APPLICATION_PATH . DS . 'application' . DS . 'libraries' . PS .
    APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'PEAR' . PS .
    '.' // get_include_path()
  );
}

// get general config
$generalConfig = include APPLICATION_PATH_SET . DS . 'general.php';

// maintenance mode
if( !empty($generalConfig['maintenance']['enabled']) && !empty($generalConfig['maintenance']['code']) ) {
  $code = $generalConfig['maintenance']['code'];
  if( @$_GET['en4_maint_code'] == $code || @$_COOKIE['en4_maint_code'] == $code ) {
    if( @$_COOKIE['en4_maint_code'] !== $code ) {
      setcookie('en4_maint_code', $code, time() + (86400 * 7), '/');
    }
  } else {
    echo file_get_contents(dirname(__FILE__) . DS . 'maintenance.html');
    exit();
  }
}

// development mode
$application_env = @$generalConfig['environment_mode'];
defined('APPLICATION_ENV') || define('APPLICATION_ENV', ($application_env ? $application_env : 'production'));

// Check for uninstalled state
if( !file_exists(APPLICATION_PATH_SET . DS . 'database.php') ) {
  header('Location: ' . rtrim((string)constant('_ENGINE_R_BASE'), '/') . '/install/index.php');
  exit();
}

// Check tasks
if( !empty($_REQUEST['notrigger']) ) {
  define('ENGINE_TASK_NOTRIGGER', true);
}

// Sub apps
if( !defined('_ENGINE_R_MAIN') && !defined('_ENGINE_R_INIT') ) {
  if( @$_GET['m'] == 'css' ) {
    define('_ENGINE_R_MAIN', 'css.php');
    define('_ENGINE_R_INIT', false);
  } else if( @$_GET['m'] == 'lite' ) {
    define('_ENGINE_R_MAIN', 'lite.php');
    define('_ENGINE_R_INIT', false);
  } else if( @$_GET['m'] == 'mobile' ) {
    define('_ENGINE_R_MAIN', 'mobile.php');
    define('_ENGINE_R_INIT', true);
  } else {
    define('_ENGINE_R_MAIN', false);
    define('_ENGINE_R_INIT', true);
  }
}

// Boot
if( _ENGINE_R_INIT ) {
  
  // Application
  require_once 'Engine/Loader.php';
  require_once 'Engine/Application.php';

  Engine_Loader::getInstance()
    // Libraries
    ->register('Zend',      APPLICATION_PATH_COR . DS . 'libraries' . DS . 'Zend')
    ->register('Engine',    APPLICATION_PATH_COR . DS . 'libraries' . DS . 'Engine')
    ->register('Facebook',  APPLICATION_PATH_COR . DS . 'libraries' . DS . 'Facebook')
    //->register('Zym',       APPLICATION_PATH_COR . DS . 'libraries' . DS . 'Zym')
    // Plugins
    ->register('Plugin',    APPLICATION_PATH_COR . DS . 'plugins')
    // Widgets
    ->register('Widget',    APPLICATION_PATH_COR . DS . 'widgets')
  ;
  
  // Create application, bootstrap, and run
  $application = new Engine_Application(
    APPLICATION_ENV,
    array(
      'bootstrap' => array(
        'path' => APPLICATION_PATH_COR . DS . 'modules' . DS . APPLICATION_NAME . DS . 'Bootstrap.php',
        'class' => ucfirst(APPLICATION_NAME) . '_Bootstrap',
      )
    )
  );
  Engine_Api::getInstance()->setApplication($application);
}

// config mode
if( defined('_ENGINE_R_CONF') && _ENGINE_R_CONF ) {
  return;
}

// Sub apps
else if( _ENGINE_R_MAIN ) {
  require dirname(__FILE__) . DS . _ENGINE_R_MAIN;
  exit();
}

// Main app
else if( APPLICATION_ENV !== 'development' ) {
  try {
    $application->bootstrap();
    $application->run();
  } catch( Exception $e ) {
    echo file_get_contents(dirname(__FILE__) . DS . 'offline.html');
    exit();
  }
}

// Main app (dev mode)
else {
  $application->bootstrap();
  $application->run();
}