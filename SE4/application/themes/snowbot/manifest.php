<?php
/**
 * SocialEngine
 *
 * @category   Application_Theme
 * @package    Bamboo
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     Bryan
 */

return array(
  'package' => array(
    'type' => 'theme',
    'name' => 'snowbot',
    'version' => '4.0.0',
    'path' => 'application/themes/snowbot',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Snowbot Theme',
      'thumb' => 'snowbot_theme.jpg',
      'author' => 'Webligo Developments'
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
      'application/themes/snowbot',
    ),
  ),
  'files' => array(
    'theme.css',
    'constants.css',
  )
) ?>