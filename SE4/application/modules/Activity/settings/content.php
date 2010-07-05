<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: content.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
return array(
  array(
    'title' => 'Activity Feed',
    'description' => 'Displays the activity feed.',
    'category' => 'Core',
    'type' => 'widget',
    'name' => 'activity.feed',
    'defaultParams' => array(
      'title' => 'What\'s New',
    ),
  ),
  array(
    'title' => 'Requests',
    'description' => 'Displays the current logged-in member\'s requests (i.e. friend requests, group invites, etc).',
    'category' => 'Core',
    'type' => 'widget',
    'name' => 'activity.list-requests',
    'defaultParams' => array(
      'title' => 'Requests',
    ),
  ),
) ?>