
/**
 * SocialEngine - SocialEngineMods
 *
 */


INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('lifestream', 'Lifestream', 'Social DNA - Lifestream.', '4.0.0', 1, 'extra');



CREATE TABLE IF NOT EXISTS `engine4_lifestream` (
  `lifestream_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lifestream_service_id` int(20) unsigned NOT NULL,
  `lifestream_user_id` int(10) unsigned NOT NULL,
  `lifestream_timestamp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lifestream_id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

