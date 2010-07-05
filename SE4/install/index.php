<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

// Sanity check
if( version_compare(PHP_VERSION, '5.1.2', '<') ) {
  echo 'SocialEngine requires at least PHP 5.1.2';
  exit();
}

// Redirect to index.php if rewrite not enabled
if( empty($_GET['rewrite']) && $_SERVER['PHP_SELF'] != parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ) {
  // Calculate base url
  header('Location: '.$_SERVER['PHP_SELF']);
  exit();
}

error_reporting(E_ALL);
define('_ENGINE', TRUE);
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(dirname(__FILE__))));

// development mode
//$generalConfig   = @include APPLICATION_PATH . DS . 'application' . DS . 'settings' . DS . 'general.php';
//$application_env = @$generalConfig['environment_mode'];
//defined('APPLICATION_ENV') || define('APPLICATION_ENV', ($application_env ? $application_env : 'production'));
defined('APPLICATION_ENV') || define('APPLICATION_ENV', 'production');

set_include_path(
  APPLICATION_PATH . DS . 'application' . DS . 'libraries' . PS .
  APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'PEAR' . PS .
  '.' // get_include_path()
);

require_once "Zend/Loader.php";
require_once "Zend/Loader/Autoloader.php";
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('Engine');

$application = new Zend_Application(APPLICATION_ENV, array(
  'bootstrap' => array(
    'class' => 'Install_Bootstrap',
    'path' => APPLICATION_PATH . '/install/Bootstrap.php',
  ),
));

$application->bootstrap();
$application->run();