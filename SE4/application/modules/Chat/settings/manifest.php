<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'chat',
    'version' => '4.0.0',
    'path' => 'application/modules/Chat',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Chat',
      'description' => 'Chat',
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
      'path' => 'application/modules/Chat/settings/install.php',
      'class' => 'Chat_Installer',
    ),
    'directories' => array(
      'application/modules/Chat',
    ),
    'files' => array(
      'application/languages/en/chat.csv',
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onApplicationModeComet',
      'resource' => 'Chat_Plugin_Comet',
    ),
    array(
      'event' => 'onRenderLayoutDefault',
      'resource' => 'Chat_Plugin_Core',
    ),
    array(
      'event' => 'onRenderLayoutAdminDefault',
      'resource' => 'Chat_Plugin_Core',
    )
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(

  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(

  ),
); ?>