<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'user',
    'version' => '4.0.0',
    'path' => 'application/modules/User',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Members',
      'description' => 'Members',
      'author' => 'Webligo Developments',
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       //'enable',
       //'disable',
     ),
    'callback' => array(
      'class' => 'Engine_Package_Installer_Module',
      'priority' => 3000,
    ),
    'directories' => array(
      'application/modules/User',
    ),
    'files' => array(
      'application/languages/en/user.csv',
    ),
  ),
  // Compose -------------------------------------------------------------------
  'compose' => array(
    array('_composeFacebook.tpl', 'user'),
  ),
  'composer' => array(
    'user' => array(
      'script' => array('_composeFacebook.tpl', 'user'),
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'User_Plugin_Core',
    ),
    array(
      'event' => 'onUserCreateAfter',
      'resource' => 'User_Plugin_Core',
    ),
    array(
      'event' => 'getAdminNotifications',
      'resource' => 'User_Plugin_Core',
    )
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'user',
    'user_list',
    'user_list_item',
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    // User - General
    'user_extended' => array(
      'route' => 'members/:controller/:action/*',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'index',
        'action' => 'index'
      ),
      'reqs' => array(
        'controller' => '\D+',
        'action' => '\D+',
      )
    ),
    'user_general' => array(
      'route' => 'members/:action/*',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'index',
        'action' => 'browse'
      ),
      'reqs' => array(
        'action' => '(home|browse)',
      )
    ),

    // User - Specific
    'user_profile' => array(
      'route' => 'profile/:id/*',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'profile',
        'action' => 'index'
      )
    ),
    
    'user_login' => array(
      'type' => 'Zend_Controller_Router_Route_Static',
      'route' => '/login',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'auth',
        'action' => 'login'
      )
    ),
    'user_logout' => array(
      'type' => 'Zend_Controller_Router_Route_Static',
      'route' => '/logout',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'auth',
        'action' => 'logout'
      )
    ),
    'user_signup' => array(
      'route' => '/signup/:action/*',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'signup',
        'action' => 'index'
      )
    ),
    'facebook_signup' => array(
      'route' => '/facebooksignup/:action/*',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'facebook',
        'action' => 'facebook'
      )
    ),
    'invite_moms' => array(
      'route' => '/invite',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'index',
        'action' => 'invite'
      )
    ),
    /*
    'user_friends_add' => array(
      'type' => 'Zend_Controller_Router_Route_Static',
      'route' => '/addfriend',
      'defaults' => array(
        'module'=>'user',
        'controller' => 'friends',
        'action' => 'add'
      )
    ),
    'user_friends_list' => array(
      'type' => 'Zend_Controller_Router_Route_Static',
      'route'=>'/listfriend',
      'defaults' => array(
        'module'=>'user',
        'controller' => 'friends',
        'action' => 'list')
    ),

    'browse_members' => array(
      'route' => '/members/browse',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'index',
        'action' => 'browse'
      )
    ),

    'user_friends_assign' => array(
      'type' => 'Zend_Controller_Router_Route_Static',
      'route'=>'assignfriend',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'friends',
        'action' => 'assign')
    ),
     *
     */

    // Admin - General
    /*
    'user_admin_settings' => array(
      'route' => 'admin/users/settings/:action/*',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'admin-settings',
        'action' => 'index'
      ),
      'reqs' => array(
        'action' => '\D+'
      )
    ),
    'user_admin_general' => array(
      'route' => 'admin/users/:action/*',
      'defaults' => array(
        'module' => 'user',
        'controller' => 'admin-user',
        'action' => 'index'
      ),
      'reqs' => array(
        'action' => '(index|create|edit|delete|multi-delete)'
      )
    )
     * 
     */
  )
); ?>