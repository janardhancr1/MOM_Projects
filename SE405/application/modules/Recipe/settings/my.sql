
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_recipe_recipes`
--

DROP TABLE IF EXISTS `engine4_recipe_recipes`;
CREATE TABLE IF NOT EXISTS `engine4_recipe_recipes` (
  `recipe_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `is_closed` tinyint(1) NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) unsigned NOT NULL default '0',
  `recipe_tags` varchar(255) NOT NULL,
  `recipe_prep_tm` varchar(255) NOT NULL,
  `recipe_cook_tm` varchar(255) NOT NULL,
  `recipe_serve_to` varchar(255) NOT NULL,
  `recipe_difficulty` varchar(255) NOT NULL,
  `recipe_ingredients` mediumtext NOT NULL,
  `recipe_method` mediumtext NOT NULL,
  `photo_id` int(10) unsigned NOT NULL default '0',
  `recipe_vege` char(1) NOT NULL default '0',
  `recipe_vegan` char(1) NOT NULL default '0',
  `recipe_dairy` char(1) NOT NULL default '0',
  `recipe_gluten` char(1) NOT NULL default '0',
  `recipe_nut` char(1) NOT NULL default '0',
  `views` int(11) unsigned NOT NULL default '0',
  `rating` float NOT NULL,
  `comments` int(11) unsigned NOT NULL default '0',
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY  (`recipe_id`),
  KEY `user_id` (`user_id`),
  KEY `is_closed` (`is_closed`),
  KEY `creation_date` (`creation_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


DROP TABLE IF EXISTS `engine4_recipe_categories`;
CREATE TABLE `engine4_recipe_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

INSERT IGNORE INTO `engine4_recipe_categories` (`category_id`, `user_id`, `category_name`) VALUES
(1, 1, 'Beverages'),
(2, 1, 'Dinner and Main Dishes'),
(3, 1, 'Appetizers'),
(4, 1, 'Snacks'),
(5, 1, 'Desserts'),
(6, 1, 'Breakfast and Brunch'),
(7, 1, 'Lunch');
-- --------------------------------------------------------

--
-- Table structure for table `engine4_recipe_votes`
--
DROP TABLE IF EXISTS `engine4_recipe_ratings`;
CREATE TABLE IF NOT EXISTS `engine4_recipe_ratings` (
  `recipe_id` int(10) unsigned NOT NULL,
  `user_id` int(9) unsigned NOT NULL,
  `rating` tinyint(1) unsigned default NULL,
  PRIMARY KEY  (`recipe_id`,`user_id`),
  KEY `INDEX` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;
 
DROP TABLE IF EXISTS `engine4_recipe_votes`;
CREATE TABLE IF NOT EXISTS `engine4_recipe_votes` (
  `recipe_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `recipe_option_id` int(11) unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`recipe_id`,`user_id`),
  KEY `recipe_option_id` (`recipe_option_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


DROP TABLE IF EXISTS `engine4_recipe_photos`;
CREATE TABLE `engine4_recipe_photos` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(11) unsigned NOT NULL,
  `recipe_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  `collection_id` int(11) unsigned NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `album_id` (`album_id`),
  KEY `recipe_id` (`recipe_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

DROP TABLE IF EXISTS `engine4_recipe_albums`;
CREATE TABLE `engine4_recipe_albums` (
  `album_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `recipe_id` int(11) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` mediumtext NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `search` tinyint(1) NOT NULL default '1',
  `photo_id` int(11) unsigned NOT NULL default '0',
  `view_count` int(11) unsigned NOT NULL default '0',
  `comment_count` int(11) unsigned NOT NULL default '0',
  `collectible_count` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY (`album_id`),
  KEY `recipe_id` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_recipe', 'recipe', 'Recipes', '', '{"route":"recipe_browse"}', 'core_main', '', 5),
('core_sitemap_recipe', 'recipe', 'Recipes', '', '{"route":"recipe_browse"}', 'core_sitemap', '', 5),
('core_admin_main_plugins_recipe', 'recipe', 'Recipes', '', '{"route":"admin_default","module":"recipe","controller":"settings"}', 'core_admin_main_plugins', '', 999),

('recipe_admin_main_manage', 'recipe', 'Manage Recipes', '', '{"route":"admin_default","module":"recipe","controller":"manage"}', 'recipe_admin_main', '', 1),
('recipe_admin_main_settings', 'recipe', 'Global Settings', '', '{"route":"admin_default","module":"recipe","controller":"settings"}', 'recipe_admin_main', '', 2),
('recipe_admin_main_level', 'recipe', 'Member Level Settings', '', '{"route":"admin_default","module":"recipe","controller":"settings","action":"level"}', 'recipe_admin_main', '', 3),
('recipe_admin_main_categories', 'recipe', 'Categories', '', '{"route":"admin_default","module":"recipe","controller":"settings","action":"categories"}', 'recipe_admin_main', '', 4)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('recipe', 'Recipes', 'Recipes', '4.0.0', 1, 'extra');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_settings`
--

INSERT IGNORE INTO `engine4_core_settings` (`name` , `value`) VALUES
('recipes.maxOptions', '15'),
('recipes.showPieChart', '0'),
('recipes.canChangeVote', '1');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'recipe', 'create', 1, NULL),
(1, 'recipe', 'delete', 1, NULL),
(1, 'recipe', 'edit', 1, NULL),
(1, 'recipe', 'view', 2, NULL),
(1, 'recipe', 'comment', 1, NULL),
(1, 'recipe', 'photo', 1, NULL),
(1, 'recipe', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(1, 'recipe', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(2, 'recipe', 'create', 1, NULL),
(2, 'recipe', 'delete', 1, NULL),
(2, 'recipe', 'edit', 1, NULL),
(2, 'recipe', 'view', 1, NULL),
(2, 'recipe', 'comment', 1, NULL),
(2, 'recipe', 'photo', 1, NULL),
(2, 'recipe', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(2, 'recipe', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(3, 'recipe', 'create', 1, NULL),
(3, 'recipe', 'delete', 1, NULL),
(3, 'recipe', 'edit', 1, NULL),
(3, 'recipe', 'view', 1, NULL),
(3, 'recipe', 'comment', 1, NULL),
(3, 'recipe', 'photo', 1, NULL),
(3, 'recipe', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(3, 'recipe', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(4, 'recipe', 'create', 1, NULL),
(4, 'recipe', 'delete', 1, NULL),
(4, 'recipe', 'edit', 1, NULL),
(4, 'recipe', 'view', 1, NULL),
(4, 'recipe', 'comment', 1, NULL),
(4, 'recipe', 'photo', 1, NULL),
(4, 'recipe', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(4, 'recipe', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(5, 'recipe', 'view', 1, NULL),
(5, 'recipe', 'photo', 1, NULL),
(5, 'recipe', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(5, 'recipe', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]');



-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT IGNORE INTO `engine4_activity_actiontypes` (`type`, `module`,  `body`,  `enabled`,  `displayable`,  `attachable`,  `commentable`,  `shareable`, `is_generated`) VALUES
('recipe_new', 'recipe', '{item:$subject} created a new recipe:', '1', '5', '1', '3', '1', 1),
('comment_recipe', 'recipe', '{item:$subject} commented on {item:$owner}''s {item:$object:recipe}.', 1, 1, 1, 1, 1, 1);


INSERT IGNORE INTO `engine4_activity_notificationtypes` (`type`, `module`, `body`, `is_request`, `handler`) VALUES
('commented_recipe', 'recipe', '{item:$subject} has commented on a {item:$object:recipe} you commented on.', 0, ''),
('comment_recipe', 'recipe', '{item:$subject} has commented on your {item:$object:recipe}.', 0, ''),
('like_recipe', 'recipe', '{item:$subject} has liked on a {item:$object:recipe} you liked.', 0, ''),
('liked_recipe', 'recipe', '{item:$subject} likes your {item:$object:recipe}.', 0, '');


-- --------------------------------------------------------

INSERT IGNORE INTO `engine4_core_mailtemplates` (`type`, `module`, `vars`) VALUES
('notify_comment_recipe', 'recipe', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]'),
('notify_commented_recipe', 'recipe', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]'),
('notify_like_recipe', 'recipe', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]'),
('notify_liked_recipe', 'recipe', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]');
