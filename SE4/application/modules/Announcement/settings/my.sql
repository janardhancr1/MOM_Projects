
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_announcement_announcements`
--

DROP TABLE IF EXISTS `engine4_announcement_announcements`;
CREATE TABLE IF NOT EXISTS `engine4_announcement_announcements` (
  `announcement_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NULL,
  PRIMARY KEY  (`announcement_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('announcement', 'Announcements', 'Announcements', '4.0.0', 1, 'standard');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'announcement', 'create', 1, NULL),
(1, 'announcement', 'view', 2, NULL),
(1, 'announcement', 'edit', 2, NULL),
(1, 'announcement', 'delete', 2, NULL),

(2, 'announcement', 'create', 1, NULL),
(2, 'announcement', 'view', 2, NULL),
(2, 'announcement', 'edit', 2, NULL),
(2, 'announcement', 'delete', 2, NULL),

(3, 'announcement', 'create', 0, NULL),
(3, 'announcement', 'view', 1, NULL),
(3, 'announcement', 'edit', 0, NULL),
(3, 'announcement', 'delete', 0, NULL),

(4, 'announcement', 'create', 0, NULL),
(4, 'announcement', 'view', 1, NULL),
(4, 'announcement', 'edit', 0, NULL),
(4, 'announcement', 'delete', 0, NULL),

(5, 'announcement', 'view', 1, NULL);