/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 7562 2010-10-05 22:17:24Z john $
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
(1, 'Momburbia.com', '', NOW(), NOW(), 1, 1),
(2, 'Open Discussions', '', NOW(), NOW(), 2, 1);


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
(2, 1, 'Welcome', '', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 2, 0, 0, 0),
(3, 1, 'Suggestions & Feedback', '', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 3, 0, 0, 0),

(4, 2, 'Contests', 'Chat about the great contests online and get moms involved', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 1, 0, 0, 0),
(5, 2, 'Cooking, Baking & Food', 'Discuss and share on how to be the best mom chef', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 2, 0, 0, 0),
(6, 2, 'Culture and Heritage', ' Learn, ask and share about your culture or others', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 3, 0, 0, 0),
(7, 2, 'Current Events & Politics', 'If it’s in the news, chat about it here', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 4, 0, 0, 0),
(8, 2, 'Entertainment & Pop Culture', 'Chat about your TV shows and celebrity buzz', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 5, 0, 0, 0),
(9, 2, 'Family & Work Life', 'Everything about your family and work', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 6, 0, 0, 0),
(10, 2, 'Fashion, Beauty & Style', 'Share and get tips on everything', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 7, 0, 0, 0),
(11, 2, 'Gardening', 'Your green thumb gets greener here', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 8, 0, 0, 0),
(12, 2, 'Health & Wellness', 'Bring out the best by sharing and learning from other moms', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 9, 0, 0, 0),
(13, 2, 'Hobbies & Crafts', 'So many things to share and ask, get started today', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 10, 0, 0, 0),
(14, 2, 'Home Improvement & Décor', 'Big Flip or small project – chat about it here', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 11, 0, 0, 0),
(15, 2, 'Money & Finance', 'Moms can support one another in this key area of life', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 12, 0, 0, 0),
(16, 2, 'Parenting', 'Talk about everything that relates to raising children', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 13, 0, 0, 0),
(17, 2, 'Pets & Animals', 'Love your pet? Share about them or ask questions', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 14, 0, 0, 0),
(18, 2, 'Pregnancy and Trying to Conceive', 'So many moms to get great support from…ask away', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 15, 0, 0, 0),
(19, 2, 'Relationships', 'Discussion on anything that relates to love, friendships, family', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 16, 0, 0, 0),
(20, 2, 'Religion and Spirituality', 'Get support from moms who are there to listen', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 17, 0, 0, 0),
(21, 2, 'Schools & Education', 'Your child’s education is key, discuss it here', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 18, 0, 0, 0),
(22, 2, 'Shopping', 'Need a deal or know where to get one?  Share here', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 19, 0, 0, 0),
(23, 2, 'Sports & Recreation', '', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 20, 0, 0, 0),
(24, 2, 'Other', '', '2010-02-01 15:09:01', '2010-02-01 17:59:01', 21, 0, 0, 0);


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
-- Table structure for table `engine4_forum_topicwatches`
--

DROP TABLE IF EXISTS `engine4_forum_topicwatches`;
CREATE TABLE IF NOT EXISTS `engine4_forum_topicwatches` (
  `resource_id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `watch` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`resource_id`,`topic_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


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
-- Dumping data for table `engine4_core_mailtemplates`
--

INSERT IGNORE INTO `engine4_core_mailtemplates` (`type`, `module`, `vars`) VALUES
('notify_forum_topic_reply', 'forum', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]'),
('notify_forum_topic_response', 'forum', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]'),
('notify_forum_promote', 'forum', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_forum', 'forum', 'Forum', '', '{"route":"forum_general"}', 'core_main', '', 5),
('core_sitemap_forum', 'forum', 'Forum', '', '{"route":"forum_general"}', 'core_sitemap', '', 5),

('core_admin_main_plugins_forum', 'forum', 'Forums', '', '{"route":"admin_default","module":"forum","controller":"settings"}', 'core_admin_main_plugins', '', 999),

('forum_admin_main_manage', 'forum', 'Manage Forums', '', '{"route":"admin_default","module":"forum","controller":"manage"}', 'forum_admin_main', '', 1),
('forum_admin_main_settings', 'forum', 'Global Settings', '', '{"route":"admin_default","module":"forum","controller":"settings"}', 'forum_admin_main', '', 2),
('forum_admin_main_level', 'forum', 'Member Level Settings', '', '{"route":"admin_default","module":"forum","controller":"level"}', 'forum_admin_main', '', 3),

('authorization_admin_level_forum', 'forum', 'Forums', '', '{"route":"admin_default","module":"forum","controller":"level","action":"index"}', 'authorization_admin_level', '', 999)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('forum', 'Forums', 'Forums', '4.0.5', 1, 'extra');


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
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT IGNORE INTO `engine4_activity_actiontypes` (`type`, `module`, `body`, `enabled`, `displayable`, `attachable`, `commentable`, `shareable`, `is_generated`) VALUES
('forum_promote', 'forum', '{item:$subject} has been made a moderator for the forum {item:$object}', 1, 3, 1, 1, 1, 1),
('forum_topic_create', 'forum', '{item:$subject} posted a {item:$object:topic} in the forum {itemParent:$object:forum}: {body:$body}', 1, 3, 1, 1, 1, 1),
('forum_topic_reply', 'forum', '{item:$subject} replied to a {item:$object:topic} in the forum {itemParent:$object:forum}: {body:$body}', 1, 3, 1, 1, 1, 1)
;

-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_notificationtypes`
--

INSERT IGNORE INTO `engine4_activity_notificationtypes` (`type`, `module`, `body`, `is_request`, `handler`) VALUES
('forum_promote', 'forum', 'You were promoted to moderator in the forum {item:$object}.', 0, ''),
('forum_topic_response', 'forum', '{item:$subject} has {item:$object:posted} on a {itemParent:$object::forum topic} you created.', 0, ''),
('forum_topic_reply', 'forum', '{item:$subject} has {item:$object:posted} on a {itemParent:$object::forum topic} you posted on.', 0, '')
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_allow`
--

INSERT IGNORE INTO `engine4_authorization_allow` (`resource_type`, `resource_id`, `action`, `role`, `role_id`, `value`, `params`) VALUES
('forum', 1, 'view', 'everyone', 0, 1, NULL),
('forum', 1, 'topic.create', 'registered', 0, 1, NULL),
('forum', 1, 'post.create', 'registered', 0, 1, NULL),
('forum', 1, 'topic.edit', 'forum_list', 1, 1, NULL),
('forum', 1, 'topic.delete', 'forum_list', 1, 1, NULL),

('forum', 2, 'view', 'everyone', 0, 1, NULL),
('forum', 2, 'topic.create', 'registered', 0, 1, NULL),
('forum', 2, 'post.create', 'registered', 0, 1, NULL),
('forum', 2, 'topic.edit', 'forum_list', 2, 1, NULL),
('forum', 2, 'topic.delete', 'forum_list', 2, 1, NULL),

('forum', 3, 'view', 'everyone', 0, 1, NULL),
('forum', 3, 'topic.create', 'registered', 0, 1, NULL),
('forum', 3, 'post.create', 'registered', 0, 1, NULL),
('forum', 3, 'topic.edit', 'forum_list', 3, 1, NULL),
('forum', 3, 'topic.delete', 'forum_list', 3, 1, NULL),

('forum', 4, 'view', 'everyone', 0, 1, NULL),
('forum', 4, 'topic.create', 'registered', 0, 1, NULL),
('forum', 4, 'post.create', 'registered', 0, 1, NULL),
('forum', 4, 'topic.edit', 'forum_list', 4, 1, NULL),
('forum', 4, 'topic.delete', 'forum_list', 4, 1, NULL),

('forum', 5, 'view', 'everyone', 0, 1, NULL),
('forum', 5, 'topic.create', 'registered', 0, 1, NULL),
('forum', 5, 'post.create', 'registered', 0, 1, NULL),
('forum', 5, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 5, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 6, 'view', 'everyone', 0, 1, NULL),
('forum', 6, 'topic.create', 'registered', 0, 1, NULL),
('forum', 6, 'post.create', 'registered', 0, 1, NULL),
('forum', 6, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 6, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 7, 'view', 'everyone', 0, 1, NULL),
('forum', 7, 'topic.create', 'registered', 0, 1, NULL),
('forum', 7, 'post.create', 'registered', 0, 1, NULL),
('forum', 7, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 7, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 8, 'view', 'everyone', 0, 1, NULL),
('forum', 8, 'topic.create', 'registered', 0, 1, NULL),
('forum', 8, 'post.create', 'registered', 0, 1, NULL),
('forum', 8, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 8, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 9, 'view', 'everyone', 0, 1, NULL),
('forum', 9, 'topic.create', 'registered', 0, 1, NULL),
('forum', 9, 'post.create', 'registered', 0, 1, NULL),
('forum', 9, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 9, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 10, 'view', 'everyone', 0, 1, NULL),
('forum', 10, 'topic.create', 'registered', 0, 1, NULL),
('forum', 10, 'post.create', 'registered', 0, 1, NULL),
('forum', 10, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 10, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 11, 'view', 'everyone', 0, 1, NULL),
('forum', 11, 'topic.create', 'registered', 0, 1, NULL),
('forum', 11, 'post.create', 'registered', 0, 1, NULL),
('forum', 11, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 11, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 12, 'view', 'everyone', 0, 1, NULL),
('forum', 12, 'topic.create', 'registered', 0, 1, NULL),
('forum', 12, 'post.create', 'registered', 0, 1, NULL),
('forum', 12, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 12, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 13, 'view', 'everyone', 0, 1, NULL),
('forum', 13, 'topic.create', 'registered', 0, 1, NULL),
('forum', 13, 'post.create', 'registered', 0, 1, NULL),
('forum', 13, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 13, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 14, 'view', 'everyone', 0, 1, NULL),
('forum', 14, 'topic.create', 'registered', 0, 1, NULL),
('forum', 14, 'post.create', 'registered', 0, 1, NULL),
('forum', 14, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 14, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 15, 'view', 'everyone', 0, 1, NULL),
('forum', 15, 'topic.create', 'registered', 0, 1, NULL),
('forum', 15, 'post.create', 'registered', 0, 1, NULL),
('forum', 15, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 15, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 16, 'view', 'everyone', 0, 1, NULL),
('forum', 16, 'topic.create', 'registered', 0, 1, NULL),
('forum', 16, 'post.create', 'registered', 0, 1, NULL),
('forum', 16, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 16, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 17, 'view', 'everyone', 0, 1, NULL),
('forum', 17, 'topic.create', 'registered', 0, 1, NULL),
('forum', 17, 'post.create', 'registered', 0, 1, NULL),
('forum', 17, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 17, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 18, 'view', 'everyone', 0, 1, NULL),
('forum', 18, 'topic.create', 'registered', 0, 1, NULL),
('forum', 18, 'post.create', 'registered', 0, 1, NULL),
('forum', 18, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 18, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 19, 'view', 'everyone', 0, 1, NULL),
('forum', 19, 'topic.create', 'registered', 0, 1, NULL),
('forum', 19, 'post.create', 'registered', 0, 1, NULL),
('forum', 19, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 19, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 20, 'view', 'everyone', 0, 1, NULL),
('forum', 20, 'topic.create', 'registered', 0, 1, NULL),
('forum', 20, 'post.create', 'registered', 0, 1, NULL),
('forum', 20, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 20, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 21, 'view', 'everyone', 0, 1, NULL),
('forum', 21, 'topic.create', 'registered', 0, 1, NULL),
('forum', 21, 'post.create', 'registered', 0, 1, NULL),
('forum', 21, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 21, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 22, 'view', 'everyone', 0, 1, NULL),
('forum', 22, 'topic.create', 'registered', 0, 1, NULL),
('forum', 22, 'post.create', 'registered', 0, 1, NULL),
('forum', 22, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 22, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 23, 'view', 'everyone', 0, 1, NULL),
('forum', 23, 'topic.create', 'registered', 0, 1, NULL),
('forum', 23, 'post.create', 'registered', 0, 1, NULL),
('forum', 23, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 23, 'topic.delete', 'forum_list', 5, 1, NULL),

('forum', 24, 'view', 'everyone', 0, 1, NULL),
('forum', 24, 'topic.create', 'registered', 0, 1, NULL),
('forum', 24, 'post.create', 'registered', 0, 1, NULL),
('forum', 24, 'topic.edit', 'forum_list', 5, 1, NULL),
('forum', 24, 'topic.delete', 'forum_list', 5, 1, NULL)

;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

-- ADMIN
-- forum
-- create, view, edit, delete, topic.create
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'create' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'edit' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'delete' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'view' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'topic.create' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'topic.edit' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'topic.delete' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'post.create' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');

-- ADMIN
-- forum_topic
-- create, edit, delete, move, post.create
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_topic' as `type`,
    'create' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_topic' as `type`,
    'edit' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_topic' as `type`,
    'delete' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_topic' as `type`,
    'move' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');

-- ADMIN
-- forum_post
-- create, edit, delete
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_post' as `type`,
    'create' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('moderator', 'admin');
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
-- forum
-- view, topic.create
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'topic.create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'topic.edit' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'topic.delete' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'post.create' as `name`,
    2 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');

-- USER
-- forum_topic
-- create, edit, delete, post.create
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_topic' as `type`,
    'create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_topic' as `type`,
    'edit' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_topic' as `type`,
    'delete' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');

-- USER
-- forum_post
-- create, edit, delete
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum_post' as `type`,
    'create' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('user');
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

-- PUBLIC
-- view
INSERT IGNORE INTO `engine4_authorization_permissions`
  SELECT
    level_id as `level_id`,
    'forum' as `type`,
    'view' as `name`,
    1 as `value`,
    NULL as `params`
  FROM `engine4_authorization_levels` WHERE `type` IN('public');

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
