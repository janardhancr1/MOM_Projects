/**
 * SocialEngine
 *
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: beta2-beta3.sql 6570 2010-06-24 00:50:18Z shaun $
 */

INSERT IGNORE INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'general', 'style', 1, NULL),
(2, 'general', 'style', 1, NULL),
(3, 'general', 'style', 1, NULL),
(4, 'general', 'style', 1, NULL),

(1, 'general', 'activity', 1, NULL),
(2, 'general', 'activity', 1, NULL),
(3, 'general', 'activity', 1, NULL),
(4, 'general', 'activity', 0, NULL),
(1, 'event', 'invite', 2, NULL),
(2, 'event', 'invite', 2, NULL),
(3, 'event', 'invite', 2, NULL),
(4, 'event', 'invite', 1, NULL);

INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES
('core.spam.censor', ''),
('core.spam.comment', 0),
('core.spam.contact', 0),
('core.spam.invite', 0),
('core.spam.ipbans', ''),
('core.spam.login', 0),
('core.spam.signup', 0);




ALTER TABLE `engine4_authorization_levels` CHANGE `name` `title` varchar(255) NOT NULL ;


/* Fix albums table */

/* This select will cause failure if already run */

SELECT `name` FROM `engine4_albums` WHERE 1 LIMIT 1;

CREATE TABLE IF NOT EXISTS `engine4_album_albums` (
  `album_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(128) NOT NULL,
  `description` mediumtext NOT NULL,
  `owner_type` varchar(64) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `owner_id` int(11) unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `photo_id` int(11) unsigned NOT NULL default '0',
  `view_count` int(11) unsigned NOT NULL default '0',
  `comment_count` int(11) unsigned NOT NULL default '0',
  `search` tinyint(1) NOT NULL default '1',
  `type` enum('wall','profile','message') NULL,
  PRIMARY KEY (`album_id`),
  KEY `owner_type` (`owner_type`, `owner_id`),
  KEY `search` (`search`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

INSERT INTO engine4_album_albums
  SELECT engine4_albums.*, NULL as `type` FROM engine4_albums WHERE 1;

DROP TABLE IF EXISTS `engine4_albums`;

UPDATE `engine4_album_albums` SET `type` = 'wall' WHERE `title` LIKE 'Wall Photos' ;
UPDATE `engine4_album_albums` SET `type` = 'profile' WHERE `title` LIKE 'Profile Photos' ;
UPDATE `engine4_album_albums` SET `type` = 'message' WHERE `title` LIKE 'Message Photos' ;




/* Fix album photos table */

/* This select will cause failure if already run */

SELECT caption FROM `engine4_album_photos` WHERE 1 LIMIT 1;

RENAME TABLE `engine4_album_photos` TO `engine4_album_photos_bak`;

CREATE TABLE `engine4_album_photos` (
  `photo_id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(128) NOT NULL,
  `description` mediumtext NOT NULL,
  `creation_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `collection_id` int(11) unsigned NOT NULL,
  `owner_type` varchar(64) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `owner_id` int(11) unsigned NOT NULL,
  `file_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `collection_id` (`collection_id`),
  KEY `owner_type` (`owner_type`, `owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

INSERT INTO engine4_album_photos
  SELECT * FROM engine4_album_photos_bak WHERE 1;

DROP TABLE IF EXISTS `engine4_album_photos_bak`;



/* Fix blogs table */

ALTER TABLE `engine4_blog_blogs` CHANGE `views` `view_count` int(10) unsigned NOT NULL ;



/* Fix classifieds table */

ALTER TABLE `engine4_classified_classifieds` CHANGE `views` `view_count` int(11) unsigned NOT NULL default '0' ;
ALTER TABLE `engine4_classified_classifieds` ADD `comment_count` int(11) unsigned NOT NULL default '0' ;

ALTER TABLE `engine4_classified_photos` CHANGE `name` `title` varchar(128) NOT NULL ;
ALTER TABLE `engine4_classified_photos` CHANGE `caption` `description` varchar(128) NOT NULL ;



/* Fix forum menu items */

UPDATE engine4_core_menuitems SET `module`='forum' WHERE `menu`='forum_admin_main' ;


/* Fix polls table */

RENAME TABLE `engine4_polls` TO `engine4_poll_polls`;


/* Add Facebook Settings to admin menu */
INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_admin_main_facebook', 'user', 'Facebook Integration', '', '{"route":"admin_default", "action":"facebook", "controller":"settings", "module":"user"}', 'core_admin_main_settings', '', 4);



UPDATE `engine4_core_menuitems` SET `order` = '6' WHERE `name` = 'core_mini_admin' LIMIT 1 ;
UPDATE `engine4_core_menuitems` SET `order` = '5' WHERE `name` = 'core_mini_profile' LIMIT 1 ;
UPDATE `engine4_core_menuitems` SET `order` = '4' WHERE `name` = 'core_mini_messages' LIMIT 1 ;
UPDATE `engine4_core_menuitems` SET `order` = '3' WHERE `name` = 'core_mini_settings' LIMIT 1 ;
UPDATE `engine4_core_menuitems` SET `order` = '2' WHERE `name` = 'core_mini_auth' LIMIT 1 ;
UPDATE `engine4_core_menuitems` SET `order` = '1' WHERE `name` = 'core_mini_signup' LIMIT 1 ;

/* Add external auth table */
DROP TABLE IF EXISTS `engine4_core_auth`;
CREATE TABLE IF NOT EXISTS `engine4_core_auth` (
  `id` varchar(40) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `type` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NULL,
  `expires` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`, `user_id`),
  KEY (`expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;
