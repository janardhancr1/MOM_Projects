<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: content.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
return array(
  array(
    'title' => 'Profile Recipes',
    'description' => 'Displays a member\'s recipes on their profile.',
    'category' => 'Recipes',
    'type' => 'widget',
    'name' => 'recipe.profile-recipes',
    'defaultParams' => array(
      'title' => 'Recipes',
      'titleCount' => true,
    ),
  ),
   array(
    'title' => 'Todays Recipe',
    'description' => 'Displays Today\'s Recipe on home page.',
    'category' => 'Recipes',
    'type' => 'widget',
    'name' => 'recipe.todays-recipe',
    'defaultParams' => array(
      'title' => 'Today\'s Recipe',
    ),
    'adminForm' => 'Recipe_Form_Admin_Widget_Today',
  ),
) ?>