/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Contests
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 6538 2010-06-23 22:55:51Z shaun $
 * @author     Jung
 */


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_contests', 'contests', 'Contests', '', '{"route":"contests_browse"}', 'core_main', '', 4),
('core_sitemap_contests', 'contests', 'Contests', '', '{"route":"contests_browse"}', 'core_sitemap', '', 4),

('core_admin_main_plugins_contests', 'contests', 'Contests', '', '{"route":"admin_default","module":"contests","controller":"settings"}', 'core_admin_main_plugins', '', 999),

('contests_admin_main_manage', 'contests', 'View Contests', '', '{"route":"admin_default","module":"contests","controller":"manage"}', 'answer_admin_main', '', 1),
('contests_admin_main_settings', 'contests', 'Global Settings', '', '{"route":"admin_default","module":"contests","controller":"settings"}', 'answer_admin_main', '', 2),
('contests_admin_main_level', 'contests', 'Member Level Settings', '', '{"route":"admin_default","module":"contests","controller":"level"}', 'answer_admin_main', '', 3),
('contests_admin_main_categories', 'contests', 'Categories', '', '{"route":"admin_default","module":"contests","controller":"settings", "action":"categories"}', 'answer_admin_main', '', 4)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('contests', 'Contests', 'Contests', '4.0.0', 1, 'extra');




