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

DROP TABLE IF EXISTS `engine4_question_questions`;
CREATE TABLE IF NOT EXISTS `engine4_question_questions` (
  `question_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `is_closed` tinyint(1) NOT NULL default '0',
  `question_title` varchar(255) NOT NULL,
  `question_text` text NOT NULL,
  `question_tags` varchar(255) NOT NULL,
  `question_cat_id` int(11) unsigned NOT NULL,
  `question_subcat_id` int(11) unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY  (`question_id`),
  KEY `user_id` (`user_id`),
  KEY `is_closed` (`is_closed`),
  KEY `creation_date` (`creation_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


-- --------------------------------------------------------

--
-- Table structure for table `engine4_question_categories`
--

DROP TABLE IF EXISTS `engine4_question_categories`;
CREATE TABLE `engine4_question_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_question_categories`
--

INSERT IGNORE INTO `engine4_question_categories` (`category_id`, `user_id`, `category_name`) VALUES
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
('core_main_blog', 'blog', 'Blogs', '', '{"route":"blog_browse"}', 'core_main', '', 4),
('core_sitemap_blog', 'blog', 'Blogs', '', '{"route":"blog_browse"}', 'core_sitemap', '', 4),

('core_admin_main_plugins_blog', 'blog', 'Blogs', '', '{"route":"admin_default","module":"blog","controller":"settings"}', 'core_admin_main_plugins', '', 999),

('blog_admin_main_manage', 'blog', 'View Blogs', '', '{"route":"admin_default","module":"blog","controller":"manage"}', 'blog_admin_main', '', 1),
('blog_admin_main_settings', 'blog', 'Global Settings', '', '{"route":"admin_default","module":"blog","controller":"settings"}', 'blog_admin_main', '', 2),
('blog_admin_main_level', 'blog', 'Member Level Settings', '', '{"route":"admin_default","module":"blog","controller":"level"}', 'blog_admin_main', '', 3),
('blog_admin_main_categories', 'blog', 'Categories', '', '{"route":"admin_default","module":"blog","controller":"settings", "action":"categories"}', 'blog_admin_main', '', 4)
;


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_modules`
--

INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES
('blog', 'Blogs', 'Blogs', '4.0.0', 1, 'extra');


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_activity_actiontypes`
--

INSERT IGNORE INTO `engine4_activity_actiontypes` (`type`, `module`, `body`, `enabled`, `displayable`, `attachable`, `commentable`, `shareable`, `is_generated`) VALUES
('blog_new', 'blog', '{item:$subject} wrote a new blog entry:', 1, 5, 1, 3, 1, 1),
('comment_blog', 'blog', '{item:$subject} commented on {item:$owner}''s {item:$object:blog entry}: {body:$body}', 1, 1, 1, 1, 1, 0);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_authorization_permissions`
--

INSERT IGNORE INTO `engine4_authorization_permissions` (`level_id`, `type`, `name`, `value`, `params`) VALUES
(1, 'blog', 'create', 1, NULL),
(1, 'blog', 'delete', 1, NULL),
(1, 'blog', 'edit', 1, NULL),
(1, 'blog', 'view', 1, NULL),
(1, 'blog', 'comment', 1, NULL),
(1, 'blog', 'css', 1, NULL),
(1, 'blog', 'max', 3, '20'),
(1, 'blog', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(1, 'blog', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(1, 'blog', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(2, 'blog', 'create', 1, NULL),
(2, 'blog', 'delete', 1, NULL),
(2, 'blog', 'edit', 1, NULL),
(2, 'blog', 'view', 1, NULL),
(2, 'blog', 'comment', 2, NULL),
(2, 'blog', 'css', 1, NULL),
(2, 'blog', 'max', 3, '20'),
(2, 'blog', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(2, 'blog', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(2, 'blog', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(3, 'blog', 'create', 1, NULL),
(3, 'blog', 'delete', 1, NULL),
(3, 'blog', 'edit', 1, NULL),
(3, 'blog', 'view', 1, NULL),
(3, 'blog', 'comment', 1, NULL),
(3, 'blog', 'css', 1, NULL),
(3, 'blog', 'max', 3, '20'),
(3, 'blog', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(3, 'blog', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(3, 'blog', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(4, 'blog', 'create', 1, NULL),
(4, 'blog', 'delete', 1, NULL),
(4, 'blog', 'edit', 1, NULL),
(4, 'blog', 'view', 1, NULL),
(4, 'blog', 'comment', 1, NULL),
(4, 'blog', 'css', 1, NULL),
(4, 'blog', 'max', 3, '20'),
(4, 'blog', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(4, 'blog', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(4, 'blog', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),

(5, 'blog', 'view', 1, NULL),
(5, 'blog', 'css', 1, NULL),
(5, 'blog', 'max', 3, '20'),
(5, 'blog', 'auth_comment', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]'),
(5, 'blog', 'auth_html', 3, 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'),
(5, 'blog', 'auth_view', 5, '["everyone","owner_network","owner_member_member","owner_member","owner"]');
