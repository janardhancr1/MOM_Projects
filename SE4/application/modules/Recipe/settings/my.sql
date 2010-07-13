
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_poll_polls`
--

DROP TABLE IF EXISTS `engine4_poll_polls`;
CREATE TABLE IF NOT EXISTS `engine4_poll_polls` (
  `poll_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `is_closed` tinyint(1) NOT NULL default '0',
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `views` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`poll_id`),
  KEY `user_id` (`user_id`),
  KEY `is_closed` (`is_closed`),
  KEY `creation_date` (`creation_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_poll_options`
--

DROP TABLE IF EXISTS `engine4_poll_options`;
CREATE TABLE IF NOT EXISTS `engine4_poll_options` (
  `poll_option_id` int(11) unsigned NOT NULL auto_increment,
  `poll_id` int(11) unsigned NOT NULL,
  `poll_option` text NOT NULL,
  `votes` smallint(4) unsigned NOT NULL,
  PRIMARY KEY  (`poll_option_id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_poll_votes`
--

DROP TABLE IF EXISTS `engine4_poll_votes`;
CREATE TABLE IF NOT EXISTS `engine4_poll_votes` (
  `poll_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `poll_option_id` int(11) unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`poll_id`,`user_id`),
  KEY `poll_option_id` (`poll_option_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_poll', 'poll', 'Polls', '', '{"route":"poll_browse"}', 'core_main', '', 5),
('core_sitemap_poll', 'poll', 'Polls', '', '{"route":"poll_browse"}', 'core_sitemap', '', 5),
('core_admin_main_plugins_poll', 'poll', 'Polls', '', '{"route":"admin_default","module":"poll","controller":"settings"}', 'core_admin_main_plugins', '', 999),

('poll_admin_main_manage', 'poll', 'Manage Polls', '', '{"route":"admin_default","module":"poll","controller":"manage"}', 'poll_admin_main', '', 1),
('poll_admin_main_settings', 'poll', 'Global Settings', '', '{"route":"admin_default","module":"poll","controller":"settings"}', 'poll_admin_main', '', 2),
('poll_admin_main_level', 'poll', 'Member Level Settings', '', '{"route":"admin_default","module":"poll","controller":"settings","action":"level"}', 'poll_admin_main', '', 3)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('poll', 'Polls', 'Polls', '4.0.0', 1, 'extra');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_settings`
--

INSERT IGNORE INTO `engine4_core_settings` (`name` , `value`) VALUES
('polls.maxOptions', '15'),
('polls.showPieChart', '0'),
('polls.canChangeVote', '1');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'poll', 'create', 1, NULL),
(1, 'poll', 'delete', 1, NULL),
(1, 'poll', 'edit', 1, NULL),
(1, 'poll', 'view', 2, NULL),
(1, 'poll', 'comment', 1, NULL),
(1, 'poll', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(1, 'poll', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(2, 'poll', 'create', 1, NULL),
(2, 'poll', 'delete', 1, NULL),
(2, 'poll', 'edit', 1, NULL),
(2, 'poll', 'view', 1, NULL),
(2, 'poll', 'comment', 1, NULL),
(2, 'poll', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(2, 'poll', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(3, 'poll', 'create', 1, NULL),
(3, 'poll', 'delete', 1, NULL),
(3, 'poll', 'edit', 1, NULL),
(3, 'poll', 'view', 1, NULL),
(3, 'poll', 'comment', 1, NULL),
(3, 'poll', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(3, 'poll', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(4, 'poll', 'create', 1, NULL),
(4, 'poll', 'delete', 1, NULL),
(4, 'poll', 'edit', 1, NULL),
(4, 'poll', 'view', 1, NULL),
(4, 'poll', 'comment', 1, NULL),
(4, 'poll', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(4, 'poll', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(5, 'poll', 'view', 1, NULL),
(5, 'poll', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(5, 'poll', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]');



-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT IGNORE INTO `engine4_activity_actiontypes` (`type`, `module`,  `body`,  `enabled`,  `displayable`,  `attachable`,  `commentable`,  `shareable`, `is_generated`) VALUES
('poll_new', 'poll', '{item:$subject} created a new poll:', '1', '5', '1', '3', '1', 1),
('comment_poll', 'poll', '{item:$subject} commented on {item:$owner}''s {item:$object:poll}.', 1, 1, 1, 1, 1, 1);
