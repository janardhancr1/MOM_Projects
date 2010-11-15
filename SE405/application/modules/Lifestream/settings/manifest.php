<?php

return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'lifestream',
    'version' => '4.0.1',
    'path' => 'application/modules/Lifestream',
    'repository' => 'socialenginemods.net',
    'meta' => array(
      'title' => 'Social DNA Socializer / Lifestream',
      'description' => 'Social DNA - Socializer / Lifestream',
      'author' => 'SocialEngineMods',
    ),
    'dependencies' => array(
      array (
        'type' => 'module',
        'name' => 'socialdna',
        'minVersion'  => '4.0.0',
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
      'path' => 'application/modules/Lifestream/settings/install.php',
      'class' => 'Lifestream_Installer',
    ),
    'directories' => array(
      'application/modules/Lifestream',
    ),
    'files' => array(
      'application/languages/en/lifestream.csv',
    ),
  ),
  // Content -------------------------------------------------------------------
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Lifestream_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'lifestream'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    // Public
    // User

    //'lifestream_link' => array(
    //  'route' => '/socialdna/lifestream/link/*',
    //  'defaults' => array(
    //    'module' => 'lifestream',
    //    'controller' => 'link',
    //    'action' => 'index'
    //  )
    //),

  // end routes
  ),
);