/**
 * SocialEngine
 *
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: beta3-rc1.sql 6570 2010-06-24 00:50:18Z shaun $
 */

INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES
  ('core.facebook.enable','none');

ALTER TABLE  `engine4_authorization_levels`
  CHANGE  `flag`  `flag` ENUM(  'default',  'superadmin',  'public' ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL;
UPDATE  `engine4_authorization_levels` SET  `flag` =  'public' WHERE  `engine4_authorization_levels`.`level_id` = 5;

ALTER TABLE  `engine4_album_albums` ADD  `category_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT  '0'

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('album_admin_main_categories', 'album', 'Categories', '', '{"route":"admin_default","module":"album","controller":"settings", "action":"categories"}', 'album_admin_main', '', 4)
;

