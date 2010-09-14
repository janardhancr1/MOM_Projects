/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_forum_categories`
--

DROP TABLE IF EXISTS `engine4_forum_categories`;
CREATE TABLE IF NOT EXISTS `engine4_forum_categories` (
  `category_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `order` smallint(6) NOT NULL default '0',
  `forum_count` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`category_id`),
  KEY `order` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

--
-- Dumping data for table `engine4_forum_categories`
--

INSERT IGNORE INTO `engine4_forum_categories` (`category_id`, `title`, `description`, `creation_date`, `modified_date`, `order`, `forum_count`) VALUES
(1, 'General', '', NOW(), NOW(), 1, 1),
(2, 'Off-Topic', '', NOW(), NOW(), 2, 1);


-- --------------------------------------------------------

--
-- Table structure for table `engine4_forum_forums`
--

DROP TABLE IF EXISTS `engine4_forum_forums`;
CREATE TABLE IF NOT EXISTS `engine4_forum_forums` (
  `forum_id` int(11) unsigned NOT NULL auto_increment,
  `category_id` int(11) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `order` smallint(6) NOT NULL default '999',
  `file_id` int(11) unsigned NOT NULL default '0',
  `view_count` int(11) unsigned NOT NULL default '0',
  `topic_count` int(11) unsigned NOT NULL default '0',
  `post_count` int(11) unsigned NOT NULL default '0',
  `lastpost_id` int(11) unsigned NOT NULL default '0',
  `lastposter_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`forum_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;

--
-- Dumping data for table `engine4_forum_forums`
--

INSERT INTO `engine4_forum_forums` (`forum_id`, `category_id`, `title`, `description`, `creation_date`, `modified_date`, `order`, `topic_count`, `post_count`, `lastpost_id`) VALUES
(1, 1, 'News and Announcements', '', '2010-02-01 14:59:01', '2010-02-01 14:59:01', 1, 0, 0, 0),
(2, 1, 'Support', '', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 2, 0, 0, 0),
(3, 1, 'Suggestions', '', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 3, 0, 0, 0),

(4, 2, 'Off-Topic Discussions', '', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 1, 0, 0, 0),
(5, 2, 'Introduce Yourself', '', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 2, 0, 0, 0);


-- --------------------------------------------------------

--
-- Table structure for table `engine4_forum_listitems`
--

DROP TABLE IF EXISTS `engine4_forum_listitems`;
CREATE TABLE IF NOT EXISTS `engine4_forum_listitems` (
  `listitem_id` int(11) unsigned NOT NULL auto_increment,
  `list_id` int(11) unsigned NOT NULL,
  `child_id` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`listitem_id`),
  KEY `list_id` (`list_id`),
  KEY `child_id` (`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_forum_listitems`
--

INSERT IGNORE INTO `engine4_forum_listitems` (`listitem_id`, `list_id`, `child_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1);


-- --------------------------------------------------------

--
-- Table structure for table `engine4_forum_lists`
--

DROP TABLE IF EXISTS `engine4_forum_lists`;
CREATE TABLE IF NOT EXISTS `engine4_forum_lists` (
  `list_id` int(11) unsigned NOT NULL auto_increment,
  `owner_id` int(11) unsigned NOT NULL,
  `child_count` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`list_id`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_forum_lists`
--

INSERT IGNORE INTO `engine4_forum_lists` (`list_id`, `owner_id`, `child_count`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1);


-- --------------------------------------------------------

--
-- Table structure for table `engine4_forum_membership`
--

DROP TABLE IF EXISTS `engine4_forum_membership`;
CREATE TABLE IF NOT EXISTS `engine4_forum_membership` (
  `resource_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL default '0',
  `resource_approved` tinyint(1) NOT NULL default '0',
  `moderator` tinyint(1) NOT NULL default '0',
  PRIMARY KEY(`resource_id`, `user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_forum_posts`
--

DROP TABLE IF EXISTS `engine4_forum_posts`;
CREATE TABLE IF NOT EXISTS `engine4_forum_posts` (
  `post_id` int(11) unsigned NOT NULL auto_increment,
  `topic_id` int(11) unsigned NOT NULL,
  `forum_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `body` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `file_id` int(11) unsigned NOT NULL default '0',
  `edit_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`post_id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_forum_signatures`
--

DROP TABLE IF EXISTS `engine4_forum_signatures`;
CREATE TABLE IF NOT EXISTS `engine4_forum_signatures` (
  `signature_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `body` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `post_count` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`signature_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_forum_topics`
--

DROP TABLE IF EXISTS `engine4_forum_topics`;
CREATE TABLE IF NOT EXISTS `engine4_forum_topics` (
  `topic_id` int(11) unsigned NOT NULL auto_increment,
  `forum_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `sticky` tinyint(4) NOT NULL default '0',
  `closed` tinyint(4) NOT NULL default '0',
  `post_count` int(11) unsigned NOT NULL default '0',
  `view_count` int(11) unsigned NOT NULL default '0',
  `lastpost_id` int(11) unsigned NOT NULL default '0',
  `lastposter_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_forum_topicviews`
--

CREATE TABLE IF NOT EXISTS `engine4_forum_topicviews` (
  `user_id` int(11) unsigned NOT NULL,
  `topic_id` int(11) unsigned NOT NULL,
  `last_view_date` datetime NOT NULL,
  PRIMARY KEY(`user_id`, `topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_forum', 'forum', 'Forum', '', '{"route":"default","module":"forum"}', 'core_main', '', 5),
('core_sitemap_forum', 'forum', 'Forum', '', '{"route":"default","module":"forum"}', 'core_sitemap', '', 5),

('core_admin_main_plugins_forum', 'forum', 'Forums', '', '{"route":"admin_default","module":"forum","controller":"settings"}', 'core_admin_main_plugins', '', 999),

('forum_admin_main_manage', 'forum', 'Manage Forums', '', '{"route":"admin_default","module":"forum","controller":"manage"}', 'forum_admin_main', '', 1),
('forum_admin_main_settings', 'forum', 'Global Settings', '', '{"route":"admin_default","module":"forum","controller":"settings"}', 'forum_admin_main', '', 2),
('forum_admin_main_level', 'forum', 'Member Level Settings', '', '{"route":"admin_default","module":"forum","controller":"level"}', 'forum_admin_main', '', 3)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('forum', 'Forums', 'Forums', '4.0.3', 1, 'extra');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_settings`
--

INSERT IGNORE INTO `engine4_core_settings` VALUES 
('forum.public', 1),
('forum.topic.pagelength', 25),
('forum.forum.pagelength', 25),
('forum.html', 1),
('forum.bbcode', 1);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_allow`
--

INSERT INTO `engine4_authorization_allow` (`resource_type`, `resource_id`, `action`, `role`, `role_id`, `value`, `params`) VALUES
('forum', 1, 'moderate', 'forum_list', 1, 1, NULL),
('forum', 2, 'moderate', 'forum_list', 1, 1, NULL),
('forum', 3, 'moderate', 'forum_list', 1, 1, NULL),
('forum', 4, 'moderate', 'forum_list', 1, 1, NULL),
('forum', 5, 'moderate', 'forum_list', 1, 1, NULL);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

-- ALL
-- commentHtml
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'commentHtml' as `name`,
    3 as `value`,
    'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr' as `params`
  FROM `engine4_authorization_levels` WHERE `type` NOT IN('public');

-- ADMIN
-- create, view, moderate
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'moderate' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');

-- USER, PUBLIC
-- view
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user', 'public');

-- ADMIN
-- edit, delete
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_post' as `type`,
    'edit' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_post' as `type`,
    'delete' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');

-- USER
-- edit, delete
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_post' as `type`,
    'edit' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_post' as `type`,
    'delete' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');

/*
INSERT IGNORE INTO `engine4_authorization_permissions` VALUES
(1, 'forum', 'view', 2, NULL),
(1, 'forum', 'commentHtml', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(1, 'forum', 'moderate', 2, NULL),
(1, 'forum', 'create', 2, NULL),

(2, 'forum', 'view', 2, NULL),
(2, 'forum', 'commentHtml', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(2, 'forum', 'moderate', 2, NULL),
(2, 'forum', 'create', 2, NULL),

(3, 'forum', 'view', 2, NULL),
(3, 'forum', 'commentHtml', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(3, 'forum', 'moderate', 1, NULL),
(3, 'forum', 'create', 2, NULL),

(4, 'forum', 'view', 1, NULL),
(4, 'forum', 'commentHtml', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(4, 'forum', 'moderate', 1, NULL),
(4, 'forum', 'create', 1, NULL),

(5, 'forum', 'view', 1, NULL),
(5, 'forum', 'commentHtml', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(5, 'forum', 'moderate', 0, NULL),
(5, 'forum', 'create', 0, NULL)
;
*/