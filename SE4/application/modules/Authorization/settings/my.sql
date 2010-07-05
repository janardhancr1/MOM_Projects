
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 6626 2010-06-29 02:19:32Z jung $
 * @author     Steve
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_authorization_allow`
--

DROP TABLE IF EXISTS `engine4_authorization_allow`;
CREATE TABLE IF NOT EXISTS `engine4_authorization_allow` (
  `resource_type` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `resource_id` int(11) unsigned NOT NULL,
  `action` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `role` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `role_id` int(11) unsigned NOT NULL default '0',
  `value` tinyint(1) NOT NULL default '0',
  `params` text,
  PRIMARY KEY  (`resource_type`,`resource_id`,`action`,`role`, `role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_authorization_allow`
--

INSERT INTO `engine4_authorization_allow` (`resource_type`, `resource_id`, `action`, `role`, `value`, `params`) VALUES
('user', 1, 'view', 'everyone', 1, NULL),
('user', 1, 'view', 'member', 1, NULL),
('user', 1, 'view', 'registered', 1, NULL),
('user', 1, 'comment', 'everyone', 1, NULL),
('user', 1, 'comment', 'member', 1, NULL),
('user', 1, 'comment', 'registered', 1, NULL);


-- --------------------------------------------------------

--
-- Table structure for table `engine4_authorization_levels`
--

DROP TABLE IF EXISTS `engine4_authorization_levels`;
CREATE TABLE IF NOT EXISTS `engine4_authorization_levels` (
  `level_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('public','user','moderator','admin') NOT NULL default 'user',
  `flag` enum('default','superadmin','public') NULL,
  PRIMARY KEY  (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_authorization_levels`
--

INSERT IGNORE INTO `engine4_authorization_levels` (`level_id`, `title`, `description`, `type`, `flag`) VALUES
(1, 'Superadmins', 'Users of this level can modify all of your settings and data.  This level cannot be modified or deleted.', 'admin', 'superadmin'),
(2, 'Admins', 'Users of this level have full access to all of your network settings and data.', 'admin', ''),
(3, 'Moderators', 'Users of this level may edit user-side content.', 'moderator', ''),
(4, 'Default Level', 'This is the default user level.  New users are assigned to it automatically.', 'user', 'default'),
(5, 'Public', 'Settings for this level apply to users who have not logged in.', 'public', 'public');


-- --------------------------------------------------------

--
-- Table structure for table `engine4_authorization_permissions`
--

DROP TABLE IF EXISTS `engine4_authorization_permissions`;
CREATE TABLE `engine4_authorization_permissions` (
  `level_id` int(11) unsigned NOT NULL,
  `type` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` tinyint(3) NOT NULL default '0',
  `params` varchar(255) NULL,
  PRIMARY KEY  (`level_id`,`type`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT IGNORE INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'admin', 'view', 1, NULL),

(2, 'admin', 'view', 1, NULL),


(1, 'core_link', 'create', 1, NULL),
(1, 'core_link', 'view', 2, NULL),

(2, 'core_link', 'create', 1, NULL),
(2, 'core_link', 'view', 2, NULL),

(3, 'core_link', 'create', 1, NULL),
(3, 'core_link', 'view', 2, NULL),

(4, 'core_link', 'create', 1, NULL),
(4, 'core_link', 'view', 1, NULL),

(4, 'core_link', 'create', 0, NULL),
(5, 'core_link', 'view', 1, NULL),

(1, 'general', 'style', 1, NULL),
(2, 'general', 'style', 1, NULL),
(3, 'general', 'style', 1, NULL),
(4, 'general', 'style', 1, NULL),

(1, 'general', 'activity', 1, NULL),
(2, 'general', 'activity', 1, NULL),
(3, 'general', 'activity', 1, NULL),
(4, 'general', 'activity', 0, NULL);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('authorization', 'Authorization', 'Authorization', '4.0.0', 1, 'core');


INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('authorization_admin_main_manage', 'authorization', 'View Member Levels', '', '{"route":"admin_default","module":"authorization","controller":"level"}', 'authorization_admin_main', '', 1),
('authorization_admin_main_level', 'authorization', 'Member Level Settings', '', '{"route":"admin_default","module":"authorization","controller":"level","action":"edit"}', 'authorization_admin_main', '', 3)
;