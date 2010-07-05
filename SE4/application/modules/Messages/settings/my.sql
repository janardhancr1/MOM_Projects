
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Messages
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 6519 2010-06-23 01:41:45Z shaun $
 * @author     John
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_messages_conversations`
--

DROP TABLE IF EXISTS `engine4_messages_conversations`;
CREATE TABLE `engine4_messages_conversations` (
  `conversation_id` int(11) unsigned NOT NULL auto_increment,
  `recipients` int(11) unsigned NOT NULL,
  `modified` datetime NOT NULL,
  `locked` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`conversation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_messages_messages`
--

DROP TABLE IF EXISTS `engine4_messages_messages`;
CREATE TABLE `engine4_messages_messages` (
  `message_id` int(11) unsigned NOT NULL auto_increment,
  `conversation_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `attachment_type` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_ci default '',
  `attachment_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`message_id`),
  UNIQUE KEY `CONVERSATIONS` (`conversation_id`,`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_messages_recipients`
--

DROP TABLE IF EXISTS `engine4_messages_recipients`;
CREATE TABLE `engine4_messages_recipients` (
  `user_id` int(11) unsigned NOT NULL,
  `conversation_id` int(11) unsigned NOT NULL,
  `inbox_message_id` int(11) unsigned default NULL,
  `inbox_updated` datetime default NULL,
  `inbox_read` tinyint(1) default NULL,
  `inbox_deleted` tinyint(1) default NULL,
  `outbox_message_id` int(11) unsigned default NULL,
  `outbox_updated` datetime default NULL,
  `outbox_deleted` tinyint(1) default NULL,
  PRIMARY KEY  (`user_id`,`conversation_id`),
  KEY `INBOX_UPDATED` (`user_id`,`conversation_id`,`inbox_updated`),
  KEY `OUTBOX_UPDATED` (`user_id`,`conversation_id`,`outbox_updated`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_mini_messages', 'messages', 'Messages', 'Messages_Plugin_Menus', '', 'core_mini', '', 4),
('user_profile_message', 'messages', 'Send Message', 'Messages_Plugin_Menus', '', 'user_profile', '', 3),
('core_admin_levels_messages', 'messages', 'Messages', '', '{"route":"admin_default","module":"messages","controller":"admin-settings","action":"level"}', 'core_admin_levels', '', 3)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('messages', 'Messages', 'Messages', '4.0.0', 1, 'standard');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_notificationtypes`
--

INSERT IGNORE INTO `engine4_activity_notificationtypes` (`type`, `module`, `body`, `is_request`, `handler`) VALUES
('message_new', 'messages', '{item:$subject} has sent you a {item:$object:message}.', 0, '')
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'messages', 'create', 1, NULL),

(2, 'messages', 'create', 1, NULL),

(3, 'messages', 'create', 1, NULL),

(4, 'messages', 'create', 1, NULL),

(5, 'messages', 'create', 0, NULL);