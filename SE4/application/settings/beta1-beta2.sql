/**
 * SocialEngine
 *
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: beta1-beta2.sql 6570 2010-06-24 00:50:18Z shaun $
 */

ALTER TABLE `engine4_core_ads` CHANGE `html_code` `html_code` text CHARSET utf8 NOT NULL;
ALTER TABLE `engine4_core_ads` CHANGE `photo_id` `photo_id` int(11) NOT NULL default '0';
ALTER TABLE `engine4_core_ads` CHANGE `views` `views` int(11) NOT NULL default '0';
ALTER TABLE `engine4_core_ads` CHANGE `clicks` `clicks` int(11) NOT NULL default '0';
ALTER TABLE `engine4_core_ads` ENGINE=InnoDB  DEFAULT CHARSET=utf8;
ALTER TABLE `engine4_core_adcampaigns` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES
('activity.liveupdate',120000),
('core.general.notificationupdate', 120000);

INSERT IGNORE INTO `engine4_activity_notificationtypes` (`type`, `module`, `body`, `is_request`, `handler`) VALUES
('group_approve', 'group', '{item:$object} has requested to join the group {item:$subject}.', 0, '')
;

