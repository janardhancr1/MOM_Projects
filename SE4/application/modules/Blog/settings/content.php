<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: content.php 6504 2010-06-22 23:10:10Z shaun $
 * @author     John
 */
return array(
  array(
    'title' => 'Profile Blogs',
    'description' => 'Displays a member\'s blog entries on their profile.',
    'category' => 'Blogs',
    'type' => 'widget',
    'name' => 'blog.profile-blogs',
    'defaultParams' => array(
      'title' => 'Blogs',
      'titleCount' => true,
    ),
  ),
  array(
    'title' => 'Recent Blog Entries',
    'description' => 'Displays a list of recently posted blog entries.',
    'category' => 'Blogs',
    'type' => 'widget',
    'name' => 'blog.list-recent-blogs',
    'defaultParams' => array(
      'title' => 'Recent Blog Entries',
    ),
  ),
  array(
    'title' => 'Popular Blog Entries',
    'description' => 'Displays a list of most viewed blog entries.',
    'category' => 'Blogs',
    'type' => 'widget',
    'name' => 'blogs.list-popular-blogs',
    'defaultParams' => array(
      'title' => 'Popular Blog Entries',
    ),
  ),
) ?>