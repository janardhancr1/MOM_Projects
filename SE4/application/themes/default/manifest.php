<?php
/**
 * SocialEngine
 *
 * @category   Application_Theme
 * @package    Default
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     Alex
 */

return array(
  'package' => array(
    'type' => 'theme',
    'name' => 'default',
    'version' => '4.0.0',
    'path' => 'application/themes/default',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Default Theme',
      'thumb' => 'default_theme.jpg',
      'author' => 'Webligo Developments',
    ),
    'actions' => array(
      'install',
      'upgrade',
      'refresh',
      'remove',
    ),
    'callback' => array(
      'class' => 'Engine_Package_Installer_Theme',
    ),
    'directories' => array(
      'application/themes/default',
    ),
  ),
  'files' => array(
    'theme.css',
    'constants.css',
  ),
) ?>