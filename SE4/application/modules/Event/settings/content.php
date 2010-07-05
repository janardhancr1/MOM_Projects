<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: content.php 6512 2010-06-23 00:27:01Z shaun $
 * @author     John
 * 
 */
return array(
  array(
    'title' => 'Upcoming Events',
    'description' => 'Displays the logged-in member\'s upcoming events.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.home-upcoming',
  ),
  array(
    'title' => 'Profile Events',
    'description' => 'Displays a member\'s events on their\'s profile.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.profile-events',
    'defaultParams' => array(
      'title' => 'Events',
      'titleCount' => true,
    ),
  ),
  array(
    'title' => 'Event Profile Discussions',
    'description' => 'Displays a event\'s discussions on it\'s profile.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.profile-discussions',
  ),
  array(
    'title' => 'Event Profile Info',
    'description' => 'Displays a event\'s info (creation date, member count, etc) on it\'s profile.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.profile-info',
  ),
  array(
    'title' => 'Event Profile Members',
    'description' => 'Displays a event\'s members on it\'s profile.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.profile-members',
  ),
  array(
    'title' => 'Event Profile Options',
    'description' => 'Displays a menu of actions (edit, report, join, invite, etc) that can be performed on a event on it\'s profile.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.profile-options',
  ),
  array(
    'title' => 'Event Profile Photo',
    'description' => 'Displays a event\'s photo on it\'s profile.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.profile-photo',
  ),
  array(
    'title' => 'Event Profile Photos',
    'description' => 'Displays a event\'s photos on it\'s profile.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.profile-photos',
  ),
  array(
    'title' => 'Event Profile RSVP',
    'description' => 'Displays options for RSVP\'ing to an event on it\'s profile.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.profile-rsvp',
  ),
  array(
    'title' => 'Event Profile Status',
    'description' => 'Displays a event\'s title on it\'s profile.',
    'category' => 'Event',
    'type' => 'widget',
    'name' => 'event.profile-status',
  ),
) ?>