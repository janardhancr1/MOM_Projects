<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: content.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
return array(
  array(
    'title' => 'Profile Polls',
    'description' => 'Displays a member\'s polls on their profile.',
    'category' => 'Polls',
    'type' => 'widget',
    'name' => 'poll.profile-polls',
    'defaultParams' => array(
      'title' => 'Polls',
      'titleCount' => true,
    ),
  ),
  
  array(
    'title' => 'Recent Polls',
    'description' => 'Displays recent polls',
    'category' => 'Polls',
    'type' => 'widget',
    'name' => 'poll.recent-polls',
    'defaultParams' => array(
      'title' => 'Polls',
      'titleCount' => true,
    ),
  ),
) ?>