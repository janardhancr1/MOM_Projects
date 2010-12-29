
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 7562 2010-10-05 22:17:24Z john $
 * @author	   John
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_classified_classifieds`
--

DROP TABLE IF EXISTS `engine4_classified_classifieds`;
CREATE TABLE `engine4_classified_classifieds` (
  `classified_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `body` longtext NOT NULL,
  `owner_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `sub_category_id` int(11) unsigned,
  `photo_id` int(10) unsigned NOT NULL default '0',
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `view_count` int(11) unsigned NOT NULL default '0',
  `comment_count` int(11) unsigned NOT NULL default '0',
  `search` tinyint(1) NOT NULL default '1',
  `closed` tinyint(4) NOT NULL default '0',
  PRIMARY KEY (`classified_id`),
  KEY `owner_id` (`owner_id`),
  KEY `search` (`search`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

-- --------------------------------------------------------

--
-- Table structure for table `engine4_classified_albums`
--

DROP TABLE IF EXISTS `engine4_classified_albums`;
CREATE TABLE `engine4_classified_albums` (
  `album_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `classified_id` int(11) unsigned NOT NULL,
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
  KEY `classified_id` (`classified_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_classified_photos`
--

DROP TABLE IF EXISTS `engine4_classified_photos`;
CREATE TABLE `engine4_classified_photos` (
  `photo_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `album_id` int(11) unsigned NOT NULL,
  `classified_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  `collection_id` int(11) unsigned NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `album_id` (`album_id`),
  KEY `classified_id` (`classified_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_classified_categories`
--

DROP TABLE IF EXISTS `engine4_classified_categories`;
CREATE TABLE `engine4_classified_categories` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `parent_cat_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_classified_categories`
--

INSERT IGNORE INTO `engine4_classified_categories` (`category_id`, `user_id`, `category_name`, `parent_cat_id`) VALUES
(1,1,'buy and sell',0),
(2,1,'art, collectibles',1),
(3,1,'baby items',1),
(4,1,'books',1),
(5,1,'business, industrial',1),
(6,1,'cameras, camcorders',1),
(7,1,'cds, dvds, blu-ray',1),
(8,1,'clothing',1),
(9,1,'computers',1),
(10,1,'computer accessories',1),
(11,1,'electronics',1),
(12,1,'furniture',1),
(13,1,'health, special needs',1),
(14,1,'hobbies, crafts',1),
(15,1,'home appliances',1),
(16,1,'home & graden',1),
(17,1,'jewellery, watches',1),
(18,1,'musical instruments',1),
(19,1,'phones, PDAs, ipods',1),
(20,1,'sports, bikes',1),
(21,1,'tickets',1),
(22,1,'tools, equipment',1),
(23,1,'toys, games',1),
(24,1,'video games, consoles',1),
(25,1,'other',1),
(26,1,'housing',0),
(27,1,'apartments for rent',26),
(28,1,'commercial',26),
(29,1,'house rental',26),
(30,1,'housing for sale',26),
(31,1,'real estate services',26),
(32,1,'room rental, roommates',26),
(33,1,'short term rentals',26),
(34,1,'storage, parking',26),
(35,1,'other',26),
(36,1,'services',0),
(37,1,'childcare, nanny',36),
(38,1,'cleaners, cleaning',36),
(39,1,'computer',36),
(40,1,'entertainment',36),
(41,1,'financial, legal',36),
(42,1,'fitness, personal trainer',36),
(43,1,'helath, beauty',36),
(44,1,'moving, storage',36),
(45,1,'music lessons',36),
(46,1,'painters, painting',36),
(47,1,'photography, video',36),
(48,1,'skilled trades',36),
(49,1,'tutors, languages',36),
(50,1,'wedding',36),
(51,1,'travel, vacations',36),
(52,1,'other',36),
(53,1,'car & vehicles',0),
(54,1,'cars',53),
(55,1,'SUVs, trucks, vans',53),
(56,1,'classic cars',53),
(57,1,'auto parts, tires',53),
(58,1,'automotive services',53),
(59,1,'motorcycles',53),
(60,1,'ATVs, snowmobiles',53),
(61,1,'boats, watercraft',53),
(62,1,'RVs, campers, trailers',53),
(63,1,'heavy equipment',53),
(64,1,'other',53),
(65,1,'pets',0),
(66,1,'accessories',65),
(67,1,'animal, pet services',65),
(68,1,'birds for sale',65),
(69,1,'cats, kittens for sale',65),
(70,1,'dogs, puppies for sale',65),
(71,1,'livestock for sale',65),
(72,1,'other pets for sale',65),
(73,1,'to give or donate',65),
(74,1,'other',65),
(75,1,'jobs',0),
(76,1,'accounting, mgmt',75),
(77,1,'child care',75),
(78,1,'bar, food, hospitality',75),
(79,1,'cleaning, housekeeper',75),
(80,1,'construction, trades',75),
(81,1,'customer service',75),
(82,1,'driver, security',75),
(83,1,'general labour',75),
(84,1,'graphic, web design',75),
(85,1,'hair stylist, salon',75),
(86,1,'office mgr, receptionist',75),
(87,1,'part time, students',75),
(88,1,'programmers, computer',75),
(89,1,'sales, retail sales',75),
(90,1,'tv, media, fashion',75),
(91,1,'other',75),
(92,1,'vacation rentals',0),
(93,1,'Canada',92),
(94,1,'United States',92),
(95,1,'Others',92),
(96,1,'Others ',0);


-- --------------------------------------------------------

--
-- Table structure for table `engine4_classified_fields_maps`
--

DROP TABLE IF EXISTS `engine4_classified_fields_maps`;
CREATE TABLE `engine4_classified_fields_maps` (
  `field_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `order` smallint(6) NOT NULL,
  PRIMARY KEY  (`field_id`,`option_id`,`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

--
-- Dumping data for table `engine4_classified_fields_maps`
--

INSERT IGNORE INTO `engine4_classified_fields_maps` (`field_id`, `option_id`, `child_id`, `order`) VALUES
(0, 0, 2, 2),
(0, 0, 3, 3)
;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_classified_fields_meta`
--

DROP TABLE IF EXISTS `engine4_classified_fields_meta`;
CREATE TABLE `engine4_classified_fields_meta` (
  `field_id` int(11) NOT NULL auto_increment,

  `type` varchar(24) collate latin1_general_ci NOT NULL,
  `label` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL default '',
  `alias` varchar(32) NOT NULL default '',
  `required` tinyint(1) NOT NULL default '0',
  `display` tinyint(1) unsigned NOT NULL,
  `search` tinyint(1) unsigned NOT NULL default '0',
  `show` tinyint(1) unsigned NOT NULL default '1',
  `order` smallint(3) unsigned NOT NULL default '999',

  `config` text NOT NULL,
  `validators` text NULL,
  `filters` text NULL,

  `style` text NULL,
  `error` text NULL,
  /*`unit` varchar(32) COLLATE utf8_unicode_ci NOT NULL,*/

  PRIMARY KEY  (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_classified_fields_fields`
--

INSERT IGNORE INTO `engine4_classified_fields_meta` (`field_id`, `type`, `label`, `description`, `alias`, `required`, `config`, `validators`, `filters`, `display`, `search`) VALUES
(2, 'currency', 'Price', '(ie. $10.00 CDN / $10.00 U.S.)', 'price', 0, '{"unit":""}', NULL, NULL, 1, 0),
(3, 'location', 'Location', '(ie. Address, City, ZIP/Postal Code)', 'location', 0, '', NULL, NULL, 1, 0);


-- --------------------------------------------------------

--
-- Table structure for table `engine4_classified_fields_options`
--

DROP TABLE IF EXISTS `engine4_classified_fields_options`;
CREATE TABLE `engine4_classified_fields_options` (
  `option_id` int(11) NOT NULL auto_increment,
  `field_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `order` smallint(6) NOT NULL default '999',
  PRIMARY KEY  (`option_id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_classified_fields_values`
--

DROP TABLE IF EXISTS `engine4_classified_fields_values`;
CREATE TABLE `engine4_classified_fields_values` (
  `item_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `index` smallint(3) NOT NULL default '0',
  `value` text NOT NULL,
  PRIMARY KEY  (`item_id`,`field_id`,`index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_classified_fields_search`
--

DROP TABLE IF EXISTS `engine4_classified_fields_search`;
CREATE TABLE IF NOT EXISTS `engine4_classified_fields_search` (
  `item_id` int(11) NOT NULL,
  `price` double NULL,
  `location` varchar(255) NULL,
  PRIMARY KEY  (`item_id`),
  KEY `price` (`price`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;





-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menus`
--

INSERT IGNORE INTO `engine4_core_menus` (`name`, `type`, `title`) VALUES
('classified_main', 'standard', 'Classified Main Navigation Menu'),
('classified_quick', 'standard', 'Classified Quick Navigation Menu'),
('classified_gutter', 'standard', 'Classified Gutter Navigation Menu')
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_classified', 'classified', 'Classifieds', '', '{"route":"classified_general"}', 'core_main', '', 4),
('core_sitemap_classified', 'classified', 'Classifieds', '', '{"route":"classified_general"}', 'core_sitemap', '', 4),

('classified_main_browse', 'classified', 'Browse Listings', 'Classified_Plugin_Menus::canViewClassifieds', '{"route":"classified_general"}', 'classified_main', '', 1),
('classified_main_manage', 'classified', 'My Listings', 'Classified_Plugin_Menus::canCreateClassifieds', '{"route":"classified_general","action":"manage"}', 'classified_main', '', 2),
('classified_main_create', 'classified', 'Post a New Listing', 'Classified_Plugin_Menus::canCreateClassifieds', '{"route":"classified_general","action":"create"}', 'classified_main', '', 3),

('classified_quick_create', 'classified', 'Post a New Listing', 'Classified_Plugin_Menus::canCreateClassifieds', '{"route":"classified_general","action":"create","class":"buttonlink icon_classified_new"}', 'classified_quick', '', 1),

('classified_gutter_list', 'classified', 'View All Listings', 'Classified_Plugin_Menus', '{"route":"classified_view","class":"buttonlink icon_classified_viewall"}', 'classified_gutter', '', 1),
('classified_gutter_create', 'classified', 'Post a New Listing', 'Classified_Plugin_Menus', '{"route":"classified_general","action":"create","class":"buttonlink icon_classified_new"}', 'classified_gutter', '', 2),
('classified_gutter_edit', 'classified', 'Edit This Listing', 'Classified_Plugin_Menus', '{"route":"classified_specific","action":"edit","class":"buttonlink icon_classified_edit"}', 'classified_gutter', '', 3),
('classified_gutter_delete', 'classified', 'Delete This Listing', 'Classified_Plugin_Menus', '{"route":"classified_specific","action":"delete","class":"buttonlink icon_classified_delete"}', 'classified_gutter', '', 4),

('core_admin_main_plugins_classified', 'classified', 'Classifieds', '', '{"route":"admin_default","module":"classified","controller":"settings"}', 'core_admin_main_plugins', '', 999),

('classified_admin_main_manage', 'classified', 'View Classifieds', '', '{"route":"admin_default","module":"classified","controller":"manage"}', 'classified_admin_main', '', 1),
('classified_admin_main_settings', 'classified', 'Global Settings', '', '{"route":"admin_default","module":"classified","controller":"settings"}', 'classified_admin_main', '', 2),
('classified_admin_main_level', 'classified', 'Member Level Settings', '', '{"route":"admin_default","module":"classified","controller":"level"}', 'classified_admin_main', '', 3),
('classified_admin_main_fields', 'classified', 'Classified Questions', '', '{"route":"admin_default","module":"classified","controller":"fields"}', 'classified_admin_main', '', 4),
('classified_admin_main_categories', 'classified', 'Categories', '', '{"route":"admin_default","module":"classified","controller":"settings","action":"categories"}', 'classified_admin_main', '', 5),

('authorization_admin_level_classified', 'classified', 'Classifieds', '', '{"route":"admin_default","module":"classified","controller":"level","action":"index"}', 'authorization_admin_level', '', 999)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('classified', 'Classifieds', 'Classifieds', '4.0.5', 1, 'extra');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_settings`
--

INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES
('classified.currency', '$');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_tasks`
--

INSERT IGNORE INTO `engine4_core_tasks` (`title`, `category`, `module`, `plugin`, `timeout`, `type`, `priority`) VALUES
('Rebuild Classified Privacy', 'rebuild_privacy', 'classified', 'Classified_Plugin_Task_Maintenance_RebuildPrivacy', 0, 'semi-automatic', 20);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT IGNORE INTO `engine4_activity_actiontypes` (`type`, `module`, `body`, `enabled`, `displayable`, `attachable`, `commentable`, `shareable`, `is_generated`) VALUES
('classified_new', 'classified', '{item:$subject} posted a new classified listing:', 1, 5, 1, 3, 1, 1),
('comment_classified', 'classified', '{item:$subject} commented on {item:$owner}''s {item:$object:classified listing}: {body:$body}', 1, 1, 1, 1, 1, 0);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

-- ALL
-- auth_view, auth_comment, auth_html
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'auth_view' as `name`,
    5 as `value`,
    '["everyone","owner_network","owner_member_member","owner_member","owner"]' as `params`
  FROM `engine4_authorization_levels` WHERE `type` NOT IN('public');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'auth_comment' as `name`,
    5 as `value`,
    '["everyone","owner_network","owner_member_member","owner_member","owner"]' as `params`
  FROM `engine4_authorization_levels` WHERE `type` NOT IN('public');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'auth_html' as `name`,
    3 as `value`,
    'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr' as `params`
  FROM `engine4_authorization_levels` WHERE `type` NOT IN('public');

-- ADMIN, MODERATOR
-- create, delete, edit, view, comment, css, style, max, photo
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'delete' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'edit' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'view' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'comment' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'css' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'style' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'max' as `name`,
    3 as `value`,
    1000 as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'photo' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');

-- USER
-- create, delete, edit, view, comment, css, style, max
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'delete' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'edit' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'comment' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'css' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'style' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'max' as `name`,
    3 as `value`,
    50 as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'photo' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');

-- PUBLIC
-- view
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'classified' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('public');
  
--
-- Dumping data for table `engine4_activity_notificationtypes`
--

INSERT IGNORE INTO `engine4_activity_notificationtypes` (`type`, `module`, `body`, `is_request`, `handler`) VALUES
('commented_classified', 'classified', '{item:$subject} has commented on a {item:$object:classified} you commented on.', 0, ''),
('comment_classified', 'classified', '{item:$subject} has commented on your {item:$object:classified}.', 0, ''),
('like_classified', 'classified', '{item:$subject} has liked on a {item:$object:classified} you liked.', 0, ''),
('liked_classified', 'classified', '{item:$subject} likes your {item:$object:classified}.', 0, '');


-- --------------------------------------------------------

INSERT IGNORE INTO `engine4_core_mailtemplates` (`type`, `module`, `vars`) VALUES
('notify_comment_classified', 'classified', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]'),
('notify_commented_classified', 'classified', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]'),
('notify_like_classified', 'classified', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]'),
('notify_liked_classified', 'classified', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]');

