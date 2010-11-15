
/**
 * SocialEngine - SocialEngineMods
 *
 */


INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('socialdnapublisher', 'Social DNA Publisher', 'Social DNA Publisher', '4.0.0', 1, 'extra');


INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `custom`, `order`) VALUES
('socialdna_admin_main_feed', 'socialdna', 'Feed Stories', '', '{"route":"admin_default","module":"socialdna","controller":"feed"}', 'socialdna_admin_main', '', 0, 6);


CREATE TABLE IF NOT EXISTS `engine4_openid_feedstories` (
  `feedstory_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `feedstory_usermessage` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `feedstory_userprompt` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `feedstory_service_id` int(10) unsigned NOT NULL DEFAULT '0',
  `feedstory_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `feedstory_metadata` text COLLATE utf8_unicode_ci NOT NULL,
  `feedstory_enabled` tinyint(4) NOT NULL DEFAULT '1',
  `feedstory_pagecheck` text COLLATE utf8_unicode_ci NOT NULL,
  `feedstory_publishprompt` tinyint(4) NOT NULL DEFAULT '0',
  `feedstory_compiler` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `feedstory_publishusing` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `feedstory_vars` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `feedstory_display` tinyint(4) NOT NULL DEFAULT '1',
  `feedstory_display_user` tinyint(4) NOT NULL DEFAULT '1',
  `feedstory_desc` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `feedstory_module` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `feedstory_icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`feedstory_id`),
  UNIQUE KEY `feedstory_type` (`feedstory_type`),
  KEY `feedstory_service_id` (`feedstory_service_id`),
  KEY `feedstory_enabled` (`feedstory_enabled`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
