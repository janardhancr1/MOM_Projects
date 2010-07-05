<?php
/**
 * SocialEngine
 *
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: cache.php 6570 2010-06-24 00:50:18Z shaun $
 */
defined('_ENGINE') or die('Access Denied');
return array (
  'default_backend' => 'File',
  'frontend' => 
  array (
    'core' => 
    array (
      'automatic_serialization' => true,
      'cache_id_prefix' => 'Engine4_',
      'lifetime' => '300',
      'caching' => true,
    ),
  ),
  'backend' => array(
    'File' => array(
      'cache_dir' => APPLICATION_PATH . '/temporary/cache'
    )
  )
);
?>
