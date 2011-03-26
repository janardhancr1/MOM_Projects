<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: content.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
return array(
  array(
    'title' => 'Profile Answers',
    'description' => 'Displays a member\'s answers on their profile.',
    'category' => 'Answers',
    'type' => 'widget',
    'name' => 'answer.profile-answers',
    'defaultParams' => array(
      'title' => 'Answers',
      'titleCount' => true,
    ),
  ),
  array(
    'title' => 'Top Answers',
    'description' => 'Displays a list of top answers.',
    'category' => 'Answers',
    'type' => 'widget',
    'name' => 'answer.list-top-answers',
    'defaultParams' => array(
      'title' => 'Top Answers',
    ),
  ),
) ?>