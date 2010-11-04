<?php

return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'socialdna',
    'version' => '4.0.5',
    'path' => 'application/modules/Socialdna',
    'repository' => 'socialenginemods.net',
    'meta' => array(
      'title' => 'Social DNA',
      'description' => 'Social DNA',
      'author' => 'SocialEngineMods',
    ),
    'dependencies' => array(
      array (
        'type'  => 'module',
        'name'  => 'semods',
        'minVersion'  => '4.0.2',
        'required' => true
      ),
      array (
        'type'  => 'module',
        'name'  => 'core',
        'minVersion'  => '4.0.4',
        'required' => true
      ),
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       'enable',
       'disable',
     ),
    'callback' => array(
      'path' => 'application/modules/Socialdna/settings/install.php',
      'class' => 'Socialdna_Installer',
    ),
    'directories' => array(
      'application/modules/Socialdna',
    ),
    'files' => array(
      'application/languages/en/socialdna.csv',
      'application/libraries/Facebook/facebook.php',
      'application/libraries/Facebook/facebook_mobile.php',
      'application/libraries/Facebook/facebookapi_php5_restlib.php',      
      'application/libraries/Facebook/jsonwrapper/jsonwrapper.php',
      'application/libraries/Facebook/jsonwrapper/jsonwrapper_inner.php',
      'application/libraries/Facebook/jsonwrapper/JSON/JSON.php',
      'application/libraries/Facebook/jsonwrapper/JSON/LICENSE',
      'login_openid.php',
      'xd_receiver.php',
    ),
  ),
  // Content -------------------------------------------------------------------
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onUserCreateAfter',
      'resource' => 'Socialdna_Plugin_Signup',
    ),
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Socialdna_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'socialdna'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    // Public
    // User
    'socialdna' => array(
      'route' => 'socialdna',
      'defaults' => array(
        'module' => 'socialdna',
        'controller' => 'index',
        'action' => 'index'
      )
    ),

    'socialdna_quicksignup' => array(
      //'route' => '/quicksignup/:action/*',
      //'route' => '/socialdna/quicksignup/:action/*',
      'route' => '/socialdna/quicksignup/*',
      'defaults' => array(
        'module' => 'socialdna',
        'controller' => 'quicksignup',
        'action' => 'index'
      )
    ),

    'socialdna_login' => array(
      //'route' => '/quicksignup/:action/*',
      //'route' => '/socialdna/login/:action/*',
      'route' => '/socialdna/login/*',
      'defaults' => array(
        'module' => 'socialdna',
        'controller' => 'auth',
        'action' => 'loginsocial'
      )
    ),

    'socialdna_link' => array(
      //'route' => '/quicksignup/:action/*',
      //'route' => '/socialdna/login/:action/*',
      'route' => '/socialdna/link/*',
      'defaults' => array(
        'module' => 'socialdna',
        'controller' => 'link',
        'action' => 'index'
      )
    ),

    'socialdna_facebook' => array(
      //'route' => '/quicksignup/:action/*',
      //'route' => '/socialdna/login/:action/*',
      //'route' => '/socialdna/facebook/*', // ??
      'route' => '/socialdna/facebook',
      'defaults' => array(
        'module' => 'socialdna',
        'controller' => 'facebook',
        'action' => 'index'
      )
    ),

    'socialdna_facebookfriends' => array(
      'route' => 'socialdna/facebook/friends',
      'defaults' => array(
        'module' => 'socialdna',
        'controller' => 'facebook',
        'action' => 'friends'
      )
    ),

    'socialdna_facebookinvite' => array(
      'route' => 'socialdna/facebook/invite',
      'defaults' => array(
        'module' => 'socialdna',
        'controller' => 'facebook',
        'action' => 'invite'
      )
    ),

    'socialdna_facebooksettings' => array(
      'route' => 'socialdna/facebook/settings',
      'defaults' => array(
        'module' => 'socialdna',
        'controller' => 'facebook',
        'action' => 'settings'
      )
    ),


    //'socialdna_quicksignup' => array(
    //  'route' => 'socialdna/quicksignup',
    //  'defaults' => array(
    //    'module' => 'socialdna',
    //    'controller' => 'index',
    //    'action' => 'settings'
    //  )
    //),

    'socialdna_settings' => array(
      'route' => 'socialdna/settings/*',
      'defaults' => array(
        'module' => 'socialdna',
        'controller' => 'index',
        'action' => 'settings'
      )
    ),

    // Admin
    //'friendsinviter_admin_settings' => array(
    //  'route' => 'admin/settings/friendsinviter',
    //  'defaults' => array(
    //    'module' => 'friendsinviter',
    //    'controller' => 'admin',
    //    'action' => 'index'
    //  )
    //),
    //'friendsinviter_admin_settings' => array(
    //  'route' => 'admin/friendsinviter/settings',
    //  'defaults' => array(
    //    'module' => 'friendsinviter',
    //    'controller' => 'settings',
    //    'action' => 'index'
    //  )
    //),
    //'friendsinviter_admin_settings' => array(
    //  'route' => 'admin/friendsinviter/settings',
    //  'defaults' => array(
    //    'module' => 'friendsinviter',
    //    'controller' => 'admin',
    //    'action' => 'settings'
    //  )
    //),
    //'friendsinviter_admin_stats' => array(
    //  'route' => 'admin/friendsinviter/stats',
    //  'defaults' => array(
    //    'module' => 'friendsinviter',
    //    'controller' => 'admin',
    //    'action' => 'stats'
    //  )
    //),
  // end routes
  ),
);