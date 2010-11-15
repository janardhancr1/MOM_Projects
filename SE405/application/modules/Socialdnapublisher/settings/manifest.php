<?php

return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'socialdnapublisher',
    'version' => '4.0.0',
    'path' => 'application/modules/Socialdnapublisher',
    'repository' => 'socialenginemods.net',
    'meta' => array(
      'title' => 'Social DNA Publisher',
      'description' => 'Social DNA',
      'author' => 'SocialEngineMods',
    ),
    'actions' => array(
       'install',
       'upgrade',
       'refresh',
       'enable',
       'disable',
     ),
    'callback' => array(
      'path' => 'application/modules/Socialdnapublisher/settings/install.php',
      'class' => 'Socialdnapublisher_Installer',
    ),
    'directories' => array(
      'application/modules/Socialdnapublisher',
    ),
    'files' => array(
      'application/languages/en/socialdnapublisher.csv',
    ),
  ),
  // Content -------------------------------------------------------------------
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onSemodsAddActivity',
      'resource' => 'Socialdnapublisher_Plugin_Core',
    ),
    array(
      'event' => 'onAlbumCreateAfter',
      'resource' => 'Socialdnapublisher_Plugin_Core',
    ),
    array(
      'event' => 'onForumTopicCreateAfter',
      'resource' => 'Socialdnapublisher_Plugin_Core',
    ),
    array(
      'event' => 'onForumPostCreateAfter',
      'resource' => 'Socialdnapublisher_Plugin_Core',
    ),
    array(
      'event' => 'onMusicSongCreateAfter',
      'resource' => 'Socialdnapublisher_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    //'socialdna'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    // Public
    // User
    //'socialdna' => array(
    //  'route' => 'socialdna',
    //  'defaults' => array(
    //    'module' => 'socialdna',
    //    'controller' => 'index',
    //    'action' => 'index'
    //  )
    //),

  ),
);