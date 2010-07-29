<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manifest.php 6662 2010-07-01 03:41:18Z steve $
 * @author     John
 */
return array(
  // Package -------------------------------------------------------------------
  'package' => array(
    'type' => 'module',
    'name' => 'poll',
    'version' => '4.0.0',
    'path' => 'application/modules/Poll',
    'repository' => 'socialengine.net',
    'meta' => array(
      'title' => 'Polls',
      'description' => 'Polls',
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
      'path' => 'application/modules/Poll/settings/install.php',
      'class' => 'Poll_Installer',
    ),
    'directories' => array(
      'application/modules/Poll',
    ),
    'files' => array(
      'application/languages/en/poll.csv',
    ),
  ),
  // Content -------------------------------------------------------------------
  'content'=> array(
    'poll_profile_polls' => array(
      'type' => 'action',
      'title' => 'Polls Profile Tabs',
      'route' => array(
        'module' => 'poll',
        'controller' => 'widget',
        'action' => 'profile-polls',
      ),
    ),
     'poll_recent_polls' => array(
      'type' => 'action',
      'title' => 'Polls Recent Tabs',
      'route' => array(
        'module' => 'poll',
        'controller' => 'widget',
        'action' => 'recent-polls',
      ),
    ),
  ),
  // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onStatistics',
      'resource' => 'Poll_Plugin_Core'
    ),
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Poll_Plugin_Core',
    ),
  ),
  // Items ---------------------------------------------------------------------
  'items' => array(
    'poll'
  ),
  // Routes --------------------------------------------------------------------
  'routes' => array(
    // Public
    'poll_browse' => array(
      'route' => 'polls/:page/:sort/*',
      'defaults' => array(
        'module' => 'poll',
        'controller' => 'index',
        'action' => 'browse',
        'page' => 1,
        'sort' => 'recent',
      ),
      'reqs' => array(
        'page' => '\d+',
      )
    ),
    'poll_list' => array(
      'route' => 'polls/list/:user_id/:page/:sort/*',
      'defaults' => array(
        'module' => 'poll',
        'controller' => 'index',
        'action' => 'list',
        'page' => 1,
        'sort' => 'recent',
      ),
      'reqs' => array(
        'user_id' => '\d+',
        'poll_id' => '\d+',
      )
    ),
    'poll_search' => array(
      'route' => 'polls/search/:page/:sort',
      'defaults' => array(
        'module' => 'poll',
        'controller' => 'index',
        'action' => 'search',
        'page' => 1,
        'sort' => 'recent',
      )
    ),
    'poll_view' => array(
      'route' => 'polls/view/:poll_id/:slug',
      'defaults' => array(
        'module' => 'poll',
        'controller' => 'index',
        'action' => 'view',
        'slug' => '',
      ),
      'reqs' => array(
        'poll_id' => '\d+'
      )
    ),
    'poll_vote' => array(
      'route' => 'polls/vote',
      'defaults' => array(
        'module' => 'poll',
        'controller' => 'index',
        'action' => 'vote'
      )
    ),
    // User
    'poll_create' => array(
      'route' => 'polls/create',
      'defaults' => array(
        'module' => 'poll',
        'controller' => 'index',
        'action' => 'create'
      )
    ),
    'poll_delete' => array(
      'route' => 'polls/delete/:poll_id',
      'defaults' => array(
        'module' => 'poll',
        'controller' => 'index',
        'action' => 'delete'
      ),
      'reqs' => array(
        'poll_id' => '\d+'
      )
    ),
    'poll_edit' => array(
      'route' => 'polls/edit/:poll_id',
      'defaults' => array(
        'module' => 'poll',
        'controller' => 'index',
        'action' => 'edit'
      ),
      'reqs' => array(
        'poll_id' => '\d+'
      )
    ),
    'poll_manage' => array(
      'route' => 'polls/manage',
      'defaults' => array(
        'module' => 'poll',
        'controller' => 'index',
        'action' => 'manage'
      )
    ),
  ),
);
