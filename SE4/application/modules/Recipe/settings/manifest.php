<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'recipe',
    'version' => '4.0.0',
    'path' => 'application/modules/Recipe',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Recipes',
      'description' => 'Recipes',
      'author' => 'Webligo Developments',
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       'enable',
       'disable',
     ),
    'callback' => array(
      'path' => 'application/modules/Recipe/settings/install.php',
      'class' => 'Recipe_Installer',
    ),
    'directories' => array(
      'application/modules/Recipe',
    ),
    'files' => array(
      'application/languages/en/recipe.csv',
    ),
  ),
  // Content -------------------------------------------------------------------
  'content'=> array(
    'recipe_profile_recipes' => array(
      'type' => 'action',
      'title' => 'Recipes Profile Tabs',
      'route' => array(
        'module' => 'recipe',
        'controller' => 'widget',
        'action' => 'profile-recipes',
      ),
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onStatistics',
      'resource' => 'Recipe_Plugin_Core'
    ),
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Recipe_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'recipe',
  'recipe_album',
  'recipe_photo'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
  'recipe_extended' => array(
      'route' => 'recipes/:controller/:action/*',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'index',
      ),
      'reqs' => array(
        'controller' => '\D+',
        'action' => '\D+',
      )
    ),
    // Public
    'recipe_browse' => array(
      'route' => 'recipes/:page/:sort/*',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'browse',
        'page' => 1,
        'sort' => 'recent',
      ),
      'reqs' => array(
        'page' => '\d+',
      )
    ),
    'recipe_list' => array(
      'route' => 'recipes/list/:user_id/:page/:sort/*',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'list',
        'page' => 1,
        'sort' => 'recent',
      ),
      'reqs' => array(
        'user_id' => '\d+',
        'recipe_id' => '\d+',
      )
    ),
    'recipe_search' => array(
      'route' => 'recipes/search/:page/:sort',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'search',
        'page' => 1,
        'sort' => 'recent',
      )
    ),
    'recipe_view' => array(
      'route' => 'recipes/view/:recipe_id/:slug',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'view',
        'slug' => '',
      ),
      'reqs' => array(
        'recipe_id' => '\d+'
      )
    ),
    'recipe_vote' => array(
      'route' => 'recipes/vote',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'vote'
      )
    ),
    // User
    'recipe_create' => array(
      'route' => 'recipes/create',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'create'
      )
    ),
    'recipe_delete' => array(
      'route' => 'recipes/delete/:recipe_id',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'delete'
      ),
      'reqs' => array(
        'recipe_id' => '\d+'
      )
    ),
    'recipe_edit' => array(
      'route' => 'recipes/edit/:recipe_id',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'edit'
      ),
      'reqs' => array(
        'recipe_id' => '\d+'
      )
    ),
    'recipe_manage' => array(
      'route' => 'recipes/manage',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'manage'
      )
    ),
        'recipe_success' => array(
      'route' => 'recipes/success/:recipe_id',
      'defaults' => array(
        'module' => 'recipe',
        'controller' => 'index',
        'action' => 'success'
      )
    ),
  ),
);
