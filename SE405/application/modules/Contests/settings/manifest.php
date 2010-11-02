<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Contests
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'contests',
    'version' => '4.0.0',
    'path' => 'application/modules/Contests',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Contests',
      'description' => 'Contests',
      'author' => 'Webligo Developments',
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       'enable',
       'disable',
     ),
    
    'directories' => array(
      'application/modules/Contests',
    ),
    
  ),
 
  // Items ---------------------------------------------------------------------
  'items' => array(
    'contests'
  ),
  
  // Routes --------------------------------------------------------------------
  'routes' => array(
    // Public
    'contests_browse' => array(
      'route' => 'contests/:page/:sort/*',
      'defaults' => array(
        'module' => 'contests',
        'controller' => 'index',
        'action' => 'browse',
        'page' => 1,
  		'sort' => 'recent',
      ),
      'reqs' => array(
        'page' => '\d+',
      )
    ),
  ),
);
