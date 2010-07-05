/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 5999 2010-05-27 00:01:27Z szerrade $
 * @author     Sami
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_event_albums`
--

DROP TABLE IF EXISTS `engine4_event_albums` ;
CREATE TABLE `engine4_event_albums` (
  `album_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) unsigned NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `search` tinyint(1) NOT NULL default '1',
  `photo_id` int(11) unsigned NOT NULL default '0',
  `view_count` int(11) unsigned NOT NULL default '0',
  `comment_count` int(11) unsigned NOT NULL default '0',
  `collectible_count` int(11) unsigned NOT NULL default '0',
   PRIMARY KEY (`album_id`),
   KEY (`event_id`),
   KEY (`search`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_event_categories`
--

DROP TABLE IF EXISTS `engine4_event_categories` ;
CREATE TABLE IF NOT EXISTS `engine4_event_categories` (
  `category_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_event_categories`
--

INSERT IGNORE INTO `engine4_event_categories` (`title`) VALUES
('Arts'),
('Business'),
('Conferences'),
('Festivals'),
('Food'),
('Fundraisers'),
('Galleries'),
('Health'),
('Just For Fun'),
('Kids'),
('Learning'),
('Literary'),
('Movies'),
('Museums'),
('Neighborhood'),
('Networking'),
('Nightlife'),
('On Campus'),
('Organizations'),
('Outdoors'),
('Pets'),
('Politics'),
('Sales'),
('Science'),
('Spirituality'),
('Sports'),
('Technology'),
('Theatre'),
('Other');


-- --------------------------------------------------------

--
-- Table structure for table `engine4_event_events`
--

DROP TABLE IF EXISTS `engine4_event_events` ;
CREATE TABLE `engine4_event_events` (
  `event_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `parent_type` varchar(64) NOT NULL,
  `parent_id` int(11) unsigned NOT NULL,
  `search` tinyint(1) NOT NULL default '1',
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `host` varchar(115) NOT NULL,
  `location` varchar(115) NOT NULL,
  `view_count` int(11) unsigned NOT NULL default '0',
  `member_count` int(11) unsigned NOT NULL default '0',
  `approval` tinyint(1) NOT NULL default '0',
  `invite` tinyint(1) NOT NULL default '0',
  `photo_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY (`event_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_type` (`parent_type`, `parent_id`),
  KEY `starttime` (`starttime`),
  KEY `search` (`search`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_event_membership`
--

DROP TABLE IF EXISTS `engine4_event_membership`;
CREATE TABLE IF NOT EXISTS `engine4_event_membership` (
  `resource_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL default '0',
  `resource_approved` tinyint(1) NOT NULL default '0',
  `user_approved` tinyint(1) NOT NULL default '0',
  `message` text NULL,
  `rsvp` tinyint(3) NOT NULL default '1',
  `title` text NULL,
  PRIMARY KEY  (`resource_id`, `user_id`),
  KEY `REVERSE` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_event_photos`
--

DROP TABLE IF EXISTS `engine4_event_photos`;
CREATE TABLE `engine4_event_photos` (
  `photo_id` int(11) unsigned NOT NULL auto_increment,
  `album_id` int(11) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,

  `title` varchar(128) NOT NULL,
  `description` varchar(255) NOT NULL,
  `collection_id` int(11) unsigned NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY (`album_id`),
  KEY (`event_id`),
  KEY (`collection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_event_posts`
--

DROP TABLE IF EXISTS `engine4_event_posts`;
CREATE TABLE IF NOT EXISTS `engine4_event_posts` (
  `post_id` int(11) unsigned NOT NULL auto_increment,
  `topic_id` int(11) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `body` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY  (`post_id`),
  KEY `topic_id` (`topic_id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_event_topics`
--

DROP TABLE IF EXISTS `engine4_event_topics`;
CREATE TABLE IF NOT EXISTS `engine4_event_topics` (
  `topic_id` int(11) unsigned NOT NULL auto_increment,
  `event_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(64) NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `sticky` tinyint(1) NOT NULL default '0',
  `closed` tinyint(1) NOT NULL default '0',
  `post_count` int(11) unsigned NOT NULL default '0',
  `lastpost_id` int(11) unsigned NOT NULL,
  `lastposter_id` int(11) unsigned NOT NULL,
  PRIMARY KEY  (`topic_id`),
  KEY `event_id` (`event_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_event', 'event', 'Events', '', '{"route":"event_general"}', 'core_main', '', 6),

('core_sitemap_event', 'event', 'Events', '', '{"route":"event_general"}', 'core_sitemap', '', 6),

('event_main_upcoming', 'event', 'Upcoming Events', '', '{"route":"event_upcoming"}', 'event_main', '', 1),
('event_main_past', 'event', 'Past Events', '', '{"route":"event_past"}', 'event_main', '', 2),
('event_main_manage', 'event', 'My Events', 'Event_Plugin_Menus', '{"route":"event_general","action":"manage"}', 'event_main', '', 3),
('event_main_create', 'event', 'Create New Event', 'Event_Plugin_Menus', '{"route":"event_general","action":"create"}', 'event_main', '', 4),

('event_profile_edit', 'event', 'Edit Profile', 'Event_Plugin_Menus', '', 'event_profile', '', 1),
('event_profile_style', 'event', 'Edit Styles', 'Event_Plugin_Menus', '', 'event_profile', '', 2),

('event_profile_member', 'event', 'Member', 'Event_Plugin_Menus', '', 'event_profile', '', 3),
('event_profile_report', 'event', 'Report Event', 'Event_Plugin_Menus', '', 'event_profile', '', 4),
('event_profile_share', 'event', 'Share', 'Event_Plugin_Menus', '', 'event_profile', '', 5),
('event_profile_invite', 'event', 'Invite', 'Event_Plugin_Menus', '', 'event_profile', '', 6),
('event_profile_message', 'event', 'Message Members', 'Event_Plugin_Menus', '', 'event_profile', '', 7),

('core_admin_main_plugins_event', 'event', 'Events', '', '{"route":"admin_default","module":"event","controller":"manage"}', 'core_admin_main_plugins', '', 999),
('event_admin_main_manage', 'event', 'Manage Events', '', '{"route":"admin_default","module":"event","controller":"manage"}', 'event_admin_main', '', 1),
('event_admin_main_level', 'event', 'Member Level Settings', '', '{"route":"admin_default","module":"event","controller":"settings","action":"level"}', 'event_admin_main', '', 2),
('event_admin_main_categories', 'event', 'Categories', '', '{"route":"admin_default","module":"event","controller":"settings","action":"categories"}', 'event_admin_main', '', 3)

;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('event', 'Events', 'Events', '4.0.0', 1, 'extra');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT IGNORE INTO `engine4_activity_actiontypes` (`type`, `module`, `body`, `enabled`, `displayable`, `attachable`, `commentable`, `shareable`, `is_generated`) VALUES
('event_create', 'event', '{item:$subject} created a new event:', 1, 5, 1, 1, 1, 1),
('event_join', 'event', '{item:$subject} joined the event {item:$object}', 1, 3, 1, 1, 1, 1),
('event_topic_create', 'event', '{item:$subject} posted a {item:$object:topic} in the event {itemParent:$object:event}: {body:$body}', 1, 3, 1, 1, 1, 1),
('event_topic_reply', 'event', '{item:$subject} replied to a {item:$object:topic} in the event {itemParent:$object:event}: {body:$body}', 1, 3, 1, 1, 1, 1),
('event_photo_upload', 'event', '{item:$subject} added {var:$count} photo(s).', 1, 3, 2, 1, 1, 1)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_notificationtypes`
--

INSERT IGNORE INTO `engine4_activity_notificationtypes` (`type`, `module`, `body`, `is_request`, `handler`) VALUES
('event_discussion_response', 'event', '{item:$subject} has {item:$object:posted} on a {itemParent:$object::event topic} you created.', 0, ''),
('event_discussion_reply', 'event', '{item:$subject} has {item:$object:posted} on a {itemParent:$object::event topic} you posted on.', 0, ''),

('event_invite', 'event', '{item:$subject} has invited you to the event {item:$object}.', 0, ''),
('event_accepted', 'event', 'Your request to join the event {item:$subject} has been approved.', 0, '')
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT IGNORE INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'event', 'create', 1, NULL),
(1, 'event', 'delete', 2, NULL),
(1, 'event', 'edit', 2, NULL),
(1, 'event', 'invite', 2, NULL),
(1, 'event', 'auth_view', 5,'["everyone", "registered", "member", "owner_network","owner_member_member","owner_member","owner"]'),
(1, 'event', 'auth_comment', 5,'["registered", "member", "owner_network","owner_member_member","owner_member","owner"]'),
(1, 'event', 'auth_photo', 5,'["member","owner"]'),

(1, 'event', 'view', 2, NULL),
(1, 'event', 'comment', 2, NULL),
(1, 'event', 'photo', 2, NULL),

(2, 'event', 'create', 1, NULL),
(2, 'event', 'delete', 2, NULL),
(2, 'event', 'edit', 2, NULL),
(2, 'event', 'invite', 2, NULL),
(2, 'event', 'view', 2, NULL),
(2, 'event', 'comment', 2, NULL),
(2, 'event', 'photo', 2, NULL),
(2, 'event', 'auth_view', 5,'["everyone","registered", member", "owner_network","owner_member_member","owner_member","owner"]'),
(2, 'event', 'auth_comment', 5,'["registered","member", "owner_network","owner_member_member","owner_member","owner"]'),
(2, 'event', 'auth_photo', 5,'["member","owner"]'),


(3, 'event', 'create', 1, NULL),
(3, 'event', 'delete', 2, NULL),
(3, 'event', 'edit', 2, NULL),
(3, 'event', 'invite', 2, NULL),
(3, 'event', 'view', 2, NULL),
(3, 'event', 'comment', 2, NULL),
(3, 'event', 'photo', 2, NULL),

(3, 'event', 'auth_view', 5,'["everyone","registered", "member", "owner_network","owner_member_member","owner_member","owner"]'),
(3, 'event', 'auth_comment', 5,'["registered","member", "owner_network","owner_member_member","owner_member","owner"]'),
(3, 'event', 'auth_photo', 5,'["member","owner"]'),

(4, 'event', 'create', 1, NULL),
(4, 'event', 'delete', 1, NULL),
(4, 'event', 'edit', 1, NULL),
(4, 'event', 'invite', 1, NULL),
(4, 'event', 'view', 1, NULL),
(4, 'event', 'comment', 1, NULL),
(4, 'event', 'photo', 1, NULL),

(4, 'event', 'auth_view', 5,'["everyone", "registered", "member", "owner_network","owner_member_member","owner_member","owner"]'),
(4, 'event', 'auth_comment', 5,'["registered","member", "owner_network","owner_member_member","owner_member","owner"]'),
(4, 'event', 'auth_photo', 5,'["member","owner"]'),
(5, 'event', 'view', 1, NULL);

