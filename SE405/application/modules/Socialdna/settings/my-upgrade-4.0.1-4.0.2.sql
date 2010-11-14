

/*ALTER TABLE `engine4_openid_users` ADD `openid_user_profile_url` VARCHAR( 255 ) NOT NULL DEFAULT '';

ALTER TABLE `engine4_openid_friends` ADD `openidfriend_presence` VARCHAR( 10 ) default '';
ALTER TABLE `engine4_openid_friends` ADD `openidfriend_presence_last` INT default 0;

UPDATE `engine4_openid_services` SET `openidservice_publisher` = '0', `openidservice_can_newsfeed` = '0', `openidservice_can_status` = '0', `openidservice_can_media` = '0',  `openidservice_can_stream` = '0' WHERE `engine4_openid_services`.`openidservice_id` = 37;
*/