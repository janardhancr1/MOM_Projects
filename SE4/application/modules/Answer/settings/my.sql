/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: my.sql 6538 2010-06-23 22:55:51Z shaun $
 * @author     Jung
 */


-- --------------------------------------------------------

--
-- Table structure for table `engine4_questions_question`
--

DROP TABLE IF EXISTS `engine4_answer_answers`;
CREATE TABLE IF NOT EXISTS `engine4_answer_answers` (
  `answer_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `is_closed` tinyint(1) NOT NULL default '0',
  `answer_title` varchar(255) NOT NULL,
  `answer_text` text NOT NULL,
  `answer_tags` varchar(255) NOT NULL,
  `answer_cat_id` int(11) unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY  (`answer_id`),
  KEY `user_id` (`user_id`),
  KEY `is_closed` (`is_closed`),
  KEY `creation_date` (`creation_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


DROP TABLE IF EXISTS `engine4_answer_posts`;
CREATE TABLE IF NOT EXISTS `engine4_answer_posts` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `answer_id` int(11) unsigned NOT NULL,
  `is_closed` tinyint(1) NOT NULL default '0',
  `answer_description` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `is_closed` (`is_closed`),
  KEY `creation_date` (`creation_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

-- --------------------------------------------------------

--
-- Table structure for table `engine4_question_categories`
--

DROP TABLE IF EXISTS `engine4_answer_categories`;
CREATE TABLE `engine4_answer_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_question_categories`
--

INSERT IGNORE INTO `engine4_answer_categories` (`category_id`, `user_id`, `category_name`) VALUES
(1, 1, 'Trying To Conceive'),
(2, 1, 'Pregnancy'),
(3, 1, 'Parenting'),
(5, 1, 'Back To School'),
(6, 1, 'Beauty & Style'),
(7, 1, 'Comsumer Products'),
(8, 1, 'Diet & Fitness'),
(9, 1, 'Education'),
(10, 1, 'Entertainment & Music'),
(11, 1, 'Environment'),
(12, 1, 'Family & Relationships'),
(13, 1, 'Food & Drink'),
(14, 1, 'Health'),
(15, 1, 'HObbies & Crafts'),
(16, 1, 'Holidays'),
(17, 1, 'Home & Garden'),
(18, 1, 'Money & Work'),
(19, 1, 'News & Events'),
(20, 1, 'Pets'),
(21, 1, 'Politics & Government'),
(22, 1, 'Remdon Fun'),
(23, 1, 'Religion & Beliefs'),
(24, 1, 'Shopping'),
(25, 1, 'Sports'),
(26, 1, 'Travel');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_answer', 'answer', 'Answers', '', '{"route":"answer_browse"}', 'core_main', '', 4),
('core_sitemap_answer', 'answer', 'Answers', '', '{"route":"answer_browse"}', 'core_sitemap', '', 4),

('core_admin_main_plugins_answer', 'answer', 'Answers', '', '{"route":"admin_default","module":"answer","controller":"settings"}', 'core_admin_main_plugins', '', 999),

('answer_admin_main_manage', 'answer', 'View Answer', '', '{"route":"admin_default","module":"answer","controller":"manage"}', 'answer_admin_main', '', 1),
('answer_admin_main_settings', 'answer', 'Global Settings', '', '{"route":"admin_default","module":"answer","controller":"settings"}', 'answer_admin_main', '', 2),
('answer_admin_main_level', 'answer', 'Member Level Settings', '', '{"route":"admin_default","module":"answer","controller":"level"}', 'answer_admin_main', '', 3),
('answer_admin_main_categories', 'answer', 'Categories', '', '{"route":"admin_default","module":"answer","controller":"settings", "action":"categories"}', 'answer_admin_main', '', 4)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('answer', 'Answers', 'Answers', '4.0.0', 1, 'extra');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT IGNORE INTO `engine4_activity_actiontypes` (`type`, `module`, `body`, `enabled`, `displayable`, `attachable`, `commentable`, `shareable`, `is_generated`) VALUES
('answer_new', 'answer', '{item:$subject} wrote a new answer entry:', 1, 5, 1, 3, 1, 1),
('comment_answer', 'answer', '{item:$subject} commented on {item:$owner}''s {item:$object:answer entry}: {body:$body}', 1, 1, 1, 1, 1, 0);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT IGNORE INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'answer', 'create', 1, NULL),
(1, 'answer', 'delete', 1, NULL),
(1, 'answer', 'edit', 1, NULL),
(1, 'answer', 'view', 1, NULL),
(1, 'answer', 'comment', 1, NULL),
(1, 'answer', 'css', 1, NULL),
(1, 'answer', 'max', 3, '20'),
(1, 'answer', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(1, 'answer', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(1, 'answer', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(2, 'answer', 'create', 1, NULL),
(2, 'answer', 'delete', 1, NULL),
(2, 'answer', 'edit', 1, NULL),
(2, 'answer', 'view', 1, NULL),
(2, 'answer', 'comment', 2, NULL),
(2, 'answer', 'css', 1, NULL),
(2, 'answer', 'max', 3, '20'),
(2, 'answer', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(2, 'answer', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(2, 'answer', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(3, 'answer', 'create', 1, NULL),
(3, 'answer', 'delete', 1, NULL),
(3, 'answer', 'edit', 1, NULL),
(3, 'answer', 'view', 1, NULL),
(3, 'answer', 'comment', 1, NULL),
(3, 'answer', 'css', 1, NULL),
(3, 'answer', 'max', 3, '20'),
(3, 'answer', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(3, 'answer', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(3, 'answer', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(4, 'answer', 'create', 1, NULL),
(4, 'answer', 'delete', 1, NULL),
(4, 'answer', 'edit', 1, NULL),
(4, 'answer', 'view', 1, NULL),
(4, 'answer', 'comment', 1, NULL),
(4, 'answer', 'css', 1, NULL),
(4, 'answer', 'max', 3, '20'),
(4, 'answer', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(4, 'answer', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(4, 'answer', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(5, 'answer', 'view', 1, NULL),
(5, 'answer', 'css', 1, NULL),
(5, 'answer', 'max', 3, '20'),
(5, 'answer', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(5, 'answer', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(5, 'answer', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]');

-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT IGNORE INTO `engine4_activity_actiontypes` (`type`, `module`,  `body`,  `enabled`,  `displayable`,  `attachable`,  `commentable`,  `shareable`, `is_generated`) VALUES
('answer_new', 'answer', '{item:$subject} created a new answer:', '1', '5', '1', '3', '1', 1),
('comment_answer', 'answer', '{item:$subject} commented on {item:$owner}''s {item:$object:answer}.', 1, 1, 1, 1, 1, 1);

