
/**
 * SocialEngine - SocialEngineMods
 *
 */

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('socialdna', 'Social DNA', 'Social DNA plugin.', '4.0.1', 1, 'extra');


INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `custom`, `order`) VALUES
('core_admin_main_plugins_socialdna', 'socialdna', 'Social DNA', '', '{"route":"admin_default","module":"socialdna","controller":"settings","action":"index"}', 'core_admin_main_plugins', '', 0, 999);


INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `custom`, `order`) VALUES
('socialdna_admin_main_settings', 'socialdna', 'General Settings', '', '{"route":"admin_default","module":"socialdna","controller":"settings"}', 'socialdna_admin_main', '', 0, 1),
('socialdna_admin_main_stats', 'socialdna', 'Statistics', '', '{"route":"admin_default","module":"socialdna","controller":"stats"}', 'socialdna_admin_main', '', 0, 7),
('socialdna_admin_main_help', 'socialdna', 'Help', '', '{"route":"admin_default","module":"socialdna","controller":"help"}', 'socialdna_admin_main', '', 0, 8),
('socialdna_admin_main_services', 'socialdna', 'Social Services', '', '{"route":"admin_default","module":"socialdna","controller":"services"}', 'socialdna_admin_main', '', 0, 3),
('socialdna_admin_main_signup', 'socialdna', 'Signup & Fields Mapping', '', '{"route":"admin_default","module":"socialdna","controller":"signup"}', 'socialdna_admin_main', '', 0, 4),
('socialdna_admin_main_users', 'socialdna', 'Connected Users', '', '{"route":"admin_default","module":"socialdna","controller":"users"}', 'socialdna_admin_main', '', 0, 2),
('socialdna_admin_main_facebook', 'socialdna', 'Facebook Settings', '', '{"route":"admin_default","module":"socialdna","controller":"facebook"}', 'socialdna_admin_main', '', 0, 5);


/* user menu */
INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `custom`, `order`) VALUES
('socialdna_main', 'socialdna', 'My Social DNA', '', '{"route":"socialdna","module":"socialdna","controller":"index","action":"index"}', 'socialdna_main', '', 0, 1),
('socialdna_settings', 'socialdna', 'Settings', '', '{"route":"socialdna_settings","module":"socialdna","controller":"index","action":"settings"}', 'socialdna_main', '', 0, 10),
('socialdna_facebook', 'socialdna', 'My Facebook', '', '{"route":"socialdna_facebook","module":"socialdna","controller":"facebook","action":"index"}', 'socialdna_main', '', 0, 2),
('socialdna_facebookfriends', 'socialdna', 'My Facebook Friends', '', '{"route":"socialdna_facebookfriends","module":"socialdna","controller":"facebook","action":"friends"}', 'socialdna_main', '', 0, 3),
('socialdna_facebookinvite', 'socialdna', 'Invite Facebook Friends', '', '{"route":"socialdna_facebookinvite","module":"socialdna","controller":"facebook","action":"invite"}', 'socialdna_main', '', 0, 4);


/* user home menu */
INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `custom`, `order`) VALUES
('user_home_socialdna', 'socialdna', 'My Social DNA', '', '{"route":"socialdna","icon":"application/modules/Socialdna/externals/images/icons/socialdna16.png"}', 'user_home', '', 0, 5);















CREATE TABLE IF NOT EXISTS `engine4_openid_clickstats` (
  `openidstat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openidstat_time` int(10) unsigned NOT NULL,
  `openidstat_service_1` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_2` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_4` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_6` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_10` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_12` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_35` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_37` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`openidstat_id`),
  UNIQUE KEY `openidclickstat_time` (`openidstat_time`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




CREATE TABLE IF NOT EXISTS `engine4_openid_feedstats` (
  `openidstat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openidstat_time` int(10) unsigned NOT NULL,
  `openidstat_service_1` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_2` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_4` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_6` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_10` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_12` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_35` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_37` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`openidstat_id`),
  UNIQUE KEY `openidfeedstat_time` (`openidstat_time`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




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



-- --------------------------------------------------------

--
-- Table structure for table `engine4_openid_fieldmap`
--


CREATE TABLE IF NOT EXISTS `engine4_openid_fieldmap` (
  `openidfieldmap_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openidfieldmap_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidfieldmap_field_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openidfieldmap_cat_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openidfieldmap_field_key` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`openidfieldmap_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `engine4_openid_fieldmap`
--

INSERT IGNORE INTO `engine4_openid_fieldmap` (`openidfieldmap_name`, `openidfieldmap_field_id`, `openidfieldmap_cat_id`, `openidfieldmap_field_key`) VALUES('first_name', 0, 0, '1_1_3');;;
INSERT IGNORE INTO `engine4_openid_fieldmap` (`openidfieldmap_name`, `openidfieldmap_field_id`, `openidfieldmap_cat_id`, `openidfieldmap_field_key`) VALUES('last_name', 0, 0, '1_1_4');;;
INSERT IGNORE INTO `engine4_openid_fieldmap` (`openidfieldmap_name`, `openidfieldmap_field_id`, `openidfieldmap_cat_id`, `openidfieldmap_field_key`) VALUES('sex', 0, 0, '1_1_5');;;
INSERT IGNORE INTO `engine4_openid_fieldmap` (`openidfieldmap_name`, `openidfieldmap_field_id`, `openidfieldmap_cat_id`, `openidfieldmap_field_key`) VALUES('birthday', 0, 0, '1_1_6');;;
INSERT IGNORE INTO `engine4_openid_fieldmap` (`openidfieldmap_name`, `openidfieldmap_field_id`, `openidfieldmap_cat_id`, `openidfieldmap_field_key`) VALUES('website', 0, 0, '1_1_8');;;
INSERT IGNORE INTO `engine4_openid_fieldmap` (`openidfieldmap_name`, `openidfieldmap_field_id`, `openidfieldmap_cat_id`, `openidfieldmap_field_key`) VALUES('nickname', 0, 0, '1_1_9');;;



-- --------------------------------------------------------

--
-- Table structure for table `engine4_openid_friends`
--

CREATE TABLE IF NOT EXISTS `engine4_openid_friends` (
  `openidfriend_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openidfriend_local_user_id` int(10) unsigned NOT NULL,
  `openidfriend_user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidfriend_service_id` int(10) unsigned NOT NULL DEFAULT '0',
  `openidfriend_nickname` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidfriend_first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidfriend_last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidfriend_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `openidfriend_thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidfriend_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidfriend_status_time` int(10) NOT NULL DEFAULT '0',
  `openidfriend_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidfriend_presence` VARCHAR( 10 ) default '',
  `openidfriend_presence_last` INT default 0,
  PRIMARY KEY (`openidfriend_id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_openid_linkstats`
--

CREATE TABLE IF NOT EXISTS `engine4_openid_linkstats` (
  `openidlinkstat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openidlinkstat_campaign_id` int(10) unsigned NOT NULL DEFAULT '0',
  `openidlinkstat_time` int(10) unsigned NOT NULL,
  `openidlinkstat_user_id` int(10) unsigned NOT NULL,
  `openidlinkstat_service_id` int(10) unsigned NOT NULL,
  `openidlinkstat_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `openidlinkstat_ref` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `openidlinkstat_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `openidlinkstat_ip` int(10) unsigned NOT NULL,
  PRIMARY KEY (`openidlinkstat_id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_openid_msgstats`
--

CREATE TABLE IF NOT EXISTS `engine4_openid_msgstats` (
  `openidstat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openidstat_time` int(10) unsigned NOT NULL,
  `openidstat_service_1` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_2` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_4` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_6` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_10` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_12` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_37` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`openidstat_id`),
  UNIQUE KEY `openidstat_time` (`openidstat_time`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- --------------------------------------------------------


CREATE TABLE IF NOT EXISTS `engine4_openid_services` (
  `openidservice_id` int(10) unsigned NOT NULL DEFAULT '0',
  `openidservice_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidservice_displayname` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidservice_enabled` tinyint(4) NOT NULL DEFAULT '1',
  `openidservice_logo_mini` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidservice_logo_small` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidservice_logo_large` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openidservice_logo_square` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `openidservice_import_profiledata` tinyint(4) NOT NULL DEFAULT '1',
  `openidservice_showorder` tinyint(4) NOT NULL DEFAULT '0',
  `openidservice_customlogo` tinyint(4) NOT NULL DEFAULT '0',
  `openidservice_publisher` tinyint(4) NOT NULL DEFAULT '0',
  `openidservice_signup` tinyint(4) NOT NULL DEFAULT '1',
  `openidservice_branding` tinyint(3) NOT NULL DEFAULT '0',
  `openidservice_can_status` tinyint(4) NOT NULL DEFAULT '0',
  `openidservice_can_newsfeed` tinyint(4) NOT NULL DEFAULT '0',
  `openidservice_can_friends` tinyint(4) NOT NULL DEFAULT '0',
  `openidservice_can_message` tinyint(4) NOT NULL DEFAULT '0',
  `openidservice_can_media` tinyint(4) NOT NULL DEFAULT '0',
  `openidservice_can_stream` tinyint(4) NOT NULL DEFAULT '0',
  `openidservice_branding_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `openidservice_branding_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`openidservice_id`),
  UNIQUE KEY `openidservice_name` (`openidservice_name`),
  KEY `openidservice_customlogo` (`openidservice_customlogo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `engine4_openid_services`
--

INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES
(1, 'facebook', 'Facebook', 1, 'logo_facebook_mini.png', 'logo_facebook_small.gif', 'logo_facebook_large.gif', 'facebook32.png', 1, 100, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '', ''),
(2, 'myspace', 'MySpace', 1, 'logo_myspace_mini.png', 'logo_myspace_small.png', 'logo_myspace_large.png', 'myspace32.png', 1, 85, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, '', ''),
(3, 'google', 'Google', 1, 'logo_google_mini.png', 'logo_google_small.gif', 'logo_google_large.gif', 'google32.png', 1, 65, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(4, 'yahoo', 'Yahoo!', 1, 'logo_yahoo_mini.png', 'logo_yahoo_small.png', 'logo_yahoo_large.png', 'yahoo32.png', 1, 75, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, '', ''),
(5, 'hyves', 'Hyves', 1, 'logo_hyves_mini.png', 'logo_hyves_small.gif', 'logo_hyves_large.gif', 'hyves32.png', 1, 70, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(6, 'friendster', 'Friendster', 1, 'logo_friendster_mini.gif', 'logo_friendster_small.gif', 'logo_friendster_large.png', 'friendster32.png', 1, 50, 0, 1, 1, 0, 1, 0, 1, 0, 0, 0, '', ''),
(7, 'bebo', 'Bebo', 1, 'logo_bebo_mini.png', 'logo_bebo_small.png', 'logo_bebo_large.png', 'bebo32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(8, 'yandex', 'Yandex', 1, 'logo_yandex_mini.png', 'logo_yandex_small.png', 'logo_yandex_large.png', 'yandex32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(9, 'live', 'Windows Live', 1, 'logo_live_mini.png', 'logo_live_small.gif', 'logo_live_large.gif', 'live32.png', 1, 80, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(10, 'twitter', 'Twitter', 1, 'logo_twitter_mini.png', 'logo_twitter_small.gif', 'logo_twitter_large.gif', 'twitter32.png', 1, 95, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, '', ''),
(11, 'aol', 'AOL', 1, 'logo_aol_mini.gif', 'logo_aol_small.png', 'logo_aol_large.png', 'aol32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(12, 'linkedin', 'LinkedIn', 1, 'logo_linkedin_mini.png', 'logo_linkedin_small.jpg', 'logo_linkedin_large.jpg', 'linkedin32.png', 1, 90, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, '', ''),
(13, 'verisign', 'Verisign', 1, 'logo_verisign_mini.png', 'logo_verisign_small.png', 'logo_verisign_large.gif', 'verisign32.gif', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(14, 'blogger', 'Blogger', 1, 'logo_blogger_mini.png', 'logo_blogger_small.png', 'logo_blogger_large.png', 'blogger32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(15, 'livejournal', 'LiveJournal', 1, 'logo_livejournal_mini.png', 'logo_livejournal_small.png', 'logo_livejournal_large.png', 'livejournal32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(16, 'wordpress', 'WordPress', 1, 'logo_wordpress_mini.png', 'logo_wordpress_small.png', 'logo_wordpress_large.png', 'wordpress32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(17, 'typepad', 'TypePad', 1, 'logo_typepad_mini.png', 'logo_typepad_small.png', 'logo_typepad_large.png', 'typepad32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(18, 'myopenid', 'myOpenID', 1, 'logo_myopenid_mini.png', 'logo_myopenid_small.png', 'logo_myopenid_large.png', 'myopenid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(19, 'vidoop', 'Vidoop', 1, 'logo_vidoop_mini.png', 'logo_vidoop_small.png', 'logo_vidoop_large.png', 'vidoop32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(20, 'claimid', 'ClaimID', 1, 'logo_claimid_mini.png', 'logo_claimid_small.png', 'logo_claimid_large.png', 'claimid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(21, 'vox', 'Vox', 1, 'logo_vox_mini.png', 'logo_vox_small.png', 'logo_vox_large.png', 'vox32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(22, 'chimp', 'Chimp', 1, 'logo_chimp_mini.png', 'logo_chimp_small.png', 'logo_chimp_large.png', 'chimp32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(23, 'myid', 'MyID', 1, 'logo_myid_mini.png', 'logo_myid_small.png', 'logo_myid_large.png', 'openid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(24, 'netlog', 'Netlog', 1, 'logo_netlog_mini.png', 'logo_netlog_small.png', 'logo_netlog_large.png', 'netlog32.png', 1, 20, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(25, 'hi5', 'Hi5', 1, 'logo_hi5_mini.png', 'logo_hi5_small.png', 'logo_hi5_large.png', 'hi532.png', 1, 45, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(26, 'lastfm', 'Last.fm', 1, 'logo_lastfm_mini.png', 'logo_lastfm_small.png', 'logo_lastfm_large.png', 'lastfm32.png', 1, 40, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, '', ''),
(27, 'identity', 'Identity.net', 1, 'logo_identity_mini.png', 'identity32.gif', 'identity32.gif', 'identity32.gif', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(28, 'signon', 'SignOn.com', 1, 'logo_signon_mini.png', 'signon32.gif', 'signon32.gif', 'signon32.gif', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(29, 'getopenid', 'GetOpenID', 1, 'logo_getopenid_mini.png', 'getopenid32.png', 'getopenid32.png', 'getopenid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(30, 'clickpass', 'Clickpass', 1, 'logo_clickpass_mini.png', 'clickpass32.gif', 'clickpass32.gif', 'clickpass32.gif', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(31, 'openidfrance', 'Openidfrance.fr', 1, 'openid16.png', 'openid16.png', 'openid32.png', 'openid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(32, 'alwaysknownas', 'AlwaysKnownAs.com', 1, 'logo_alwaysknownas_mini.png', 'alwaysknownas32.png', 'alwaysknownas32.png', 'alwaysknownas32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', ''),
(33, 'flickr', 'Flickr', 1, 'logo_flickr_mini.png', 'flickr32.png', 'flickr32.png', 'flickr32.png', 1, 35, 0, 0, 1, 0, 0, 0, 1, 0, 1, 1, '', ''),
(34, 'youtube', 'YouTube', 1, 'logo_youtube_mini.png', 'youtube32.png', 'youtube32.png', 'youtube32.png', 1, 30, 0, 0, 1, 0, 0, 0, 1, 0, 0, 1, '', ''),
(35, 'foursquare', 'Foursquare', 1, 'logo_foursquare_mini.png', 'foursquare32.png', 'foursquare32.png', 'foursquare32.png', 1, 60, 0, 0, 1, 0, 0, 0, 1, 0, 0, 1, '', ''),
(36, 'photobucket', 'Photobucket', 1, 'logo_photobucket_mini.png', 'photobucket32.png', 'photobucket32.png', 'photobucket32.png', 1, 25, 0, 0, 1, 0, 0, 0, 1, 0, 1, 1, '', '');

INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(52, 'gowalla', 'Gowalla', 1, 'logo_gowalla_mini.png', 'gowalla32.png', 'gowalla32.png', 'gowalla32.png', 1, 57, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(51, 'picasa', 'Picasa', 1, 'logo_picasa_mini.png', 'picasa32.png', 'picasa32.png', 'picasa32.png', 1, 33, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(50, 'blogses', 'Blogs.es', 1, 'logo_blogses_mini.png', 'blogses32.png', 'blogses32.png', 'blogses32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(49, 'openminds', 'Openminds.be', 1, 'openid16.png', 'openid32.png', 'openid32.png', 'openid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(48, 'meinguter', 'Mein Guter', 1, 'logo_meinguter_mini.png', 'meinguter32.png', 'meinguter32.png', 'meinguter32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(47, 'yiid', 'YIID', 1, 'logo_yiid_mini.png', 'yiid32.png', 'yiid32.png', 'yiid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(46, 'daum', 'Daum', 1, 'logo_daum_mini.png', 'daum32.png', 'daum32.png', 'daum32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(45, 'fupei', 'Fupei', 1, 'logo_fupei_mini.png', 'fupei32.png', 'fupei32.png', 'fupei32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(44, 'steam', 'Steam', 1, 'logo_steam_mini.png', 'steam32.png', 'steam32.png', 'steam32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(43, 'launchpad', 'Launchpad', 1, 'logo_launchpad_mini.png', 'launchpad32.png', 'launchpad32.png', 'launchpad32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(42, 'xlogon', 'Xlogon', 1, 'logo_xlogon_mini.png', 'xlogon32.png', 'xlogon32.png', 'xlogon32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(41, 'clavid', 'Clavid', 1, 'logo_clavid_mini.png', 'clavid32.png', 'clavid32.png', 'clavid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(40, 'betaid', 'Betaid', 1, 'logo_betaid_mini.gif', 'betaid32.png', 'betaid32.png', 'betaid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(39, 'onelogin', 'Onelogin', 1, 'logo_onelogin_mini.png', 'onelogin32.png', 'onelogin32.png', 'onelogin32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(38, 'liquidid', 'LiquidID', 1, 'logo_liquidid_mini.png', 'liquidid32.png', 'liquidid32.png', 'liquidid32.png', 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, '', '');
INSERT IGNORE INTO `engine4_openid_services` (`openidservice_id`, `openidservice_name`, `openidservice_displayname`, `openidservice_enabled`, `openidservice_logo_mini`, `openidservice_logo_small`, `openidservice_logo_large`, `openidservice_logo_square`, `openidservice_import_profiledata`, `openidservice_showorder`, `openidservice_customlogo`, `openidservice_publisher`, `openidservice_signup`, `openidservice_branding`, `openidservice_can_status`, `openidservice_can_newsfeed`, `openidservice_can_friends`, `openidservice_can_message`, `openidservice_can_media`, `openidservice_can_stream`, `openidservice_branding_key`, `openidservice_branding_secret`) VALUES(37, 'orkut', 'Orkut', 1, 'logo_orkut_mini.png', 'orkut32.png', 'orkut32.png', 'orkut32.png', 1, 55, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, '', '');



CREATE TABLE IF NOT EXISTS `engine4_openid_settings` (
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `engine4_openid_settings`
--


-- --------------------------------------------------------

--
-- Table structure for table `engine4_openid_signupstats`
--




-- --------------------------------------------------------

--
-- Table structure for table `engine4_openid_stats`
--

CREATE TABLE IF NOT EXISTS `engine4_openid_stats` (
  `openidstat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openidstat_time` int(10) unsigned NOT NULL,
  `openidstat_status` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_1` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_2` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_4` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_6` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_10` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_12` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`openidstat_id`),
  UNIQUE KEY `openidstat_time` (`openidstat_time`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `engine4_openid_stats`
--


-- --------------------------------------------------------

--
-- Table structure for table `engine4_openid_statusstats`
--

CREATE TABLE IF NOT EXISTS `engine4_openid_statusstats` (
  `openidstat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openidstat_time` int(10) unsigned NOT NULL,
  `openidstat_service_1` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_2` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_4` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_6` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_10` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_12` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_37` int(10) unsigned NOT NULL DEFAULT '0',
  `openidstat_service_39` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`openidstat_id`),
  UNIQUE KEY `openidstatusstat_time` (`openidstat_time`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_openid_users`
--

CREATE TABLE IF NOT EXISTS `engine4_openid_users` (
  `openid_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid_user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid_user_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openid_user_displayname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `openid_user_photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openid_service_id` int(10) unsigned NOT NULL DEFAULT '0',
  `openid_user_profile_url` VARCHAR( 255 ) NOT NULL DEFAULT '',
  PRIMARY KEY (`openid_id`),
  KEY `openid_service_id` (`openid_service_id`),
  KEY `openid_user_id` (`openid_user_id`),
  KEY `openid_user_key` (`openid_user_key`)
)DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_openid_user_settings`
--

CREATE TABLE IF NOT EXISTS `engine4_openid_user_settings` (
  `openid_user_setting_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openid_user_setting_user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `openid_user_setting_key` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `openid_user_setting_value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`openid_user_setting_id`),
  UNIQUE KEY `openid_user_setting_user_id_2` (`openid_user_setting_user_id`,`openid_user_setting_key`),
  KEY `openid_user_setting_user_id` (`openid_user_setting_user_id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



/* footer widget */


/* import existing facebook users */
INSERT IGNORE INTO engine4_openid_users(openid_user_id,openid_user_key,openid_service_id,openid_user_displayname) SELECT user_id, facebook_uid, 1, '' FROM engine4_user_facebook;


/* settings */

INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.autologin', '1');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.facebook.api.key', '');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.facebook.inviteactiontext', 'Invite your Facebook Friends');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.facebook.locale', 'en_US');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.facebook.secret', '');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.hook.logout', '1');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.login.page.hook', '1');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.openidconnect.api.key', '');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.openidconnect.iconstyle', '11');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.openidconnect.rpurl', '');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.openidconnect.secret', '');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.redirect.after.openid.signup', '1');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.signup.page.hook', '1');
INSERT IGNORE INTO `engine4_core_settings` (`name`, `value`) VALUES('socialdna.signup.profilecat.default', '1');
