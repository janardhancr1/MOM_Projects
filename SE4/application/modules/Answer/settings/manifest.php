<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'answer',
    'version' => '4.0.0',
    'path' => 'application/modules/answer',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Answers',
      'description' => 'Answers',
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
      'application/modules/Answer',
    ),
    
  ),
 
  // Items ---------------------------------------------------------------------
  'items' => array(
    'answer'
  ),
  
  // Routes --------------------------------------------------------------------
  'routes' => array(
    // Public
    'answer_browse' => array(
      'route' => 'answers/:page/*',
      'defaults' => array(
        'module' => 'answer',
        'controller' => 'index',
        'action' => 'index',
        'page' => 1
      )
    ),
     'answer_search' => array(
      'route' => 'answers/search/:page/:sort',
      'defaults' => array(
        'module' => 'answer',
        'controller' => 'index',
        'action' => 'search',
        'page' => 1,
        'sort' => 'recent',
      )
    ),
        'answer_view' => array(
      'route' => 'answers/view/:answer_id/:slug',
      'defaults' => array(
        'module' => 'answer',
        'controller' => 'index',
        'action' => 'view',
        'slug' => '',
      ),
      'reqs' => array(
        'answer_id' => '\d+'
      )
    ),
     'answer_manage' => array(
      'route' => 'answers/manage',
      'defaults' => array(
        'module' => 'answer',
        'controller' => 'index',
        'action' => 'manage'
      )
    ),    

  ),
);