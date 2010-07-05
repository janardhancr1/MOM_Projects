<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: content.php 6531 2010-06-23 22:02:51Z shaun $
 * @author		 John
 */
return array(
  array(
    'title' => 'Profile Videos',
    'description' => 'Displays a member\'s videos on their profile.',
    'category' => 'Videos',
    'type' => 'widget',
    'name' => 'video.profile-videos',
  ),
  array(
    'title' => 'Recent Videos',
    'description' => 'Displays a list of recently uploaded videos.',
    'category' => 'Videos',
    'type' => 'widget',
    'name' => 'video.list-recent-videos',
    'defaultParams' => array(
      'title' => 'Recent Videos',
    ),
  ),
  array(
    'title' => 'Popular Videos',
    'description' => 'Displays a list of most viewed videos.',
    'category' => 'Videos',
    'type' => 'widget',
    'name' => 'video.list-popular-videos',
    'defaultParams' => array(
      'title' => 'Popular Videos',
    ),
  ),
) ?>