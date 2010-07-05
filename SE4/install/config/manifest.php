<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */

return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'core',
    'name' => 'install',
    'version' => '4.0.0',
    'path' => '/',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Package Manager',
      'description' => 'Package Manager',
      'author' => 'Webligo Developments',
    ),
    'actions' => array(
      'install',
      'upgrade',
      'refresh',
    ),
    'directories' => array(
      'install',
    ),
  ),
); ?>