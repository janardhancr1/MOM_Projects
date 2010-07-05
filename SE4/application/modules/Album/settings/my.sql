
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 6459 2010-06-18 03:17:35Z steve $
 * @author     Sami
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_album_albums`
--

DROP TABLE IF EXISTS `engine4_album_albums`;
CREATE TABLE `engine4_album_albums` (
  `album_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(128) NOT NULL,
  `description` mediumtext NOT NULL,
  `owner_type` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `owner_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL default '0',
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `photo_id` int(11) unsigned NOT NULL default '0',
  `view_count` int(11) unsigned NOT NULL default '0',
  `comment_count` int(11) unsigned NOT NULL default '0',
  `search` tinyint(1) NOT NULL default '1',
  `type` enum('wall','profile','message') NULL,
  PRIMARY KEY (`album_id`),
  KEY `owner_type` (`owner_type`, `owner_id`),
  KEY `search` (`search`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

-- --------------------------------------------------------

--
-- Table structure for table `engine4_album_categories`
--

DROP TABLE IF EXISTS `engine4_album_categories`;
CREATE TABLE `engine4_album_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_album_categories`
--

INSERT IGNORE INTO `engine4_album_categories` (`category_id`, `user_id`, `category_name`) VALUES
(1, 1, 'Arts & Culture'),
(2, 1, 'Business'),
(3, 1, 'Entertainment'),
(5, 1, 'Family & Home'),
(6, 1, 'Health'),
(7, 1, 'Recreation'),
(8, 1, 'Personal'),
(9, 1, 'Shopping'),
(10, 1, 'Society'),
(11, 1, 'Sports'),
(12, 1, 'Technology'),
(13, 1, 'Other');


-- --------------------------------------------------------

--
-- Table structure for table `engine4_album_photos`
--

DROP TABLE IF EXISTS `engine4_album_photos`;
CREATE TABLE `engine4_album_photos` (
  `photo_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(128) NOT NULL,
  `description` mediumtext NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `collection_id` int(11) unsigned NOT NULL,
  `owner_type` varchar(64) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `owner_id` int(11) unsigned NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `collection_id` (`collection_id`),
  KEY `owner_type` (`owner_type`, `owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_album', 'album', 'Albums', '', '{"route":"album_general","action":"browse"}', 'core_main', '', 3),

('core_sitemap_album', 'album', 'Albums', '', '{"route":"album_general","action":"browse"}', 'core_sitemap', '', 3),

('album_main_browse', 'album', 'Everyone''s Albums', '', '{"route":"album_general","action":"browse"}', 'album_main', '', 1),
('album_main_manage', 'album', 'My Albums', '', '{"route":"album_general","action":"manage"}', 'album_main', '', 2),
('album_main_upload', 'album', 'Add New Photos', '', '{"route":"album_general","action":"upload"}', 'album_main', '', 3),

('core_admin_main_plugins_album', 'album', 'Photo Albums', '', '{"route":"admin_default","module":"album","controller":"settings","action":"index"}', 'core_admin_main_plugins', '', 999),

('album_admin_main_manage', 'album', 'View Albums', '', '{"route":"admin_default","module":"album","controller":"manage"}', 'album_admin_main', '', 1),
('album_admin_main_settings', 'album', 'Global Settings', '', '{"route":"admin_default","module":"album","controller":"settings"}', 'album_admin_main', '', 2),
('album_admin_main_level', 'album', 'Member Level Settings', '', '{"route":"admin_default","module":"album","controller":"level"}', 'album_admin_main', '', 3),
('album_admin_main_categories', 'album', 'Categories', '', '{"route":"admin_default","module":"album","controller":"settings", "action":"categories"}', 'album_admin_main', '', 4)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('album', 'Photo Albums', 'This plugin gives your users their own personal photo albums. These albums can be configured to store photos, videos, or any other file types you choose to allow. Users can interact by commenting on each others photos and viewing their friends'' recent updates.', '4.0.0', 1, 'extra');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT INTO `engine4_activity_actiontypes` (`type`, `module`, `body`, `enabled`, `displayable`, `attachable`, `commentable`, `shareable`, `is_generated`) VALUES
('album_photo_new', 'album', '{item:$subject} added {var:$count} photo(s) to the album {item:$object}:', 1, 5, 1, 3, 1, 1),
('comment_album', 'album', '{item:$subject} commented on {item:$owner}''s {item:$object:album}: {body:$body}', 1, 1, 1, 1, 1, 0),
('comment_album_photo', 'album', '{item:$subject} commented on {item:$owner}''s {item:$object:photo}: {body:$body}', 1, 1, 1, 1, 1, 0);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'album', 'create', 2, NULL),
(1, 'album', 'view', 2, NULL),
(1, 'album', 'edit', 2, NULL),
(1, 'album', 'delete', 2, NULL),
(1, 'album', 'comment', 2, NULL),
(1, 'album', 'tag', 2, NULL),
(1, 'album', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(1, 'album', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(1, 'album', 'auth_tag', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(2, 'album', 'create', 2, NULL),
(2, 'album', 'view', 2, NULL),
(2, 'album', 'edit', 2, NULL),
(2, 'album', 'delete', 2, NULL),
(2, 'album', 'comment', 2, NULL),
(2, 'album', 'tag', 2, NULL),
(2, 'album', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(2, 'album', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(2, 'album', 'auth_tag', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(3, 'album', 'create', 2, NULL),
(3, 'album', 'view', 2, NULL),
(3, 'album', 'edit', 2, NULL),
(3, 'album', 'delete', 2, NULL),
(3, 'album', 'comment', 2, NULL),
(3, 'album', 'tag', 2, NULL),
(3, 'album', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(3, 'album', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(3, 'album', 'auth_tag', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(4, 'album', 'create', 1, NULL),
(4, 'album', 'view', 1, NULL),
(4, 'album', 'edit', 1, NULL),
(4, 'album', 'delete', 1, NULL),
(4, 'album', 'comment', 1, NULL),
(4, 'album', 'tag', 1, NULL),
(4, 'album', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(4, 'album', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(4, 'album', 'auth_tag', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(5, 'album', 'view', 1, NULL),
(5, 'album', 'tag', 0, NULL);