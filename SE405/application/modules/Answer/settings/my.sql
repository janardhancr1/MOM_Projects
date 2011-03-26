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
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `sub_cat_id` int(11) unsigned,
  `anonymous` bool default FALSE,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY  (`answer_id`),
  KEY `user_id` (`user_id`),
  KEY `is_closed` (`is_closed`),
  KEY `creation_date` (`creation_date`),
  KEY `answer_cat_id` (`answer_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


ALTER TABLE engine4_answer_answers ADD FULLTEXT(title, description);

DROP TABLE IF EXISTS `engine4_answer_posts`;
CREATE TABLE IF NOT EXISTS `engine4_answer_posts` (
  `post_id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `answer_id` int(11) unsigned NOT NULL,
  `is_closed` tinyint(1) NOT NULL default '0',
  `answer_description` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY  (`post_id`),
  KEY `user_id` (`user_id`),
  KEY `is_closed` (`is_closed`),
  KEY `creation_date` (`creation_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

-- --------------------------------------------------------

--
-- Table structure for table `engine4_question_categories`
--

DROP TABLE IF EXISTS `engine4_answer_categories`;
CREATE TABLE `engine4_answer_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) unsigned NOT NULL,
  `category_name` varchar(128) NOT NULL,
  `parent_cat_id` int(11) NOT NULL DEFAULT '0',
  `show_home_page` bool default false,
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_question_categories`
--

INSERT IGNORE INTO `engine4_answer_categories` (`category_id`, `user_id`, `category_name`, `parent_cat_id`) VALUES
(1, 1, 'General Parenting', 0),
(2,1, 'Arts & Humanities', 0),
(3,1, 'Business & Finance', 0),
(4,1, 'Cars & Transportation', 0),
(5,1, 'Computers & Internet', 0),
(6,1, 'Consumer Electronics', 0),
(7,1, 'Dining Out', 0),
(8,1, 'Education & Reference', 0),
(9,1, 'Entertainment & Music', 0),
(10,1, 'Environment', 0),
(11,1, 'Family & Relationships', 0),
(12,1, 'Food & Drink', 0),
(13,1, 'Fashion  Beauty & Style', 0),
(14,1, 'Games & Recreation', 0),
(15,1, 'Health', 0),
(16,1, 'Home & Garden', 0),
(17,1, 'News & Events', 0),
(18,1, 'Birds', 0),
(19,1, 'Politics & Government', 0),
(20,1, 'Science & Mathematics', 0),
(21,1, 'Social Science', 0),
(22,1, 'Society & Culture', 0),
(23,1, 'Sports', 0),
(24,1, 'Travel', 0),

(25,1, 'Babies', 1),
(26,1, 'Toddlers', 1),
(27,1, 'Preschoolers', 1),
(28,1, 'School-Age Kids', 1),
(29,1, 'Tweens', 1),
(30,1, 'Teens', 1),
(31,1, 'Adult Kids', 1),
(32,1, 'Trying to Conceive', 1),
(33,1, 'Other – General Parenting', 1),
(34,1, 'Pregnancy', 1),
(35,1, 'Adoption', 1),
(36,1, 'Baby Names', 1),
(37,1, 'Back-to-School', 1),
(38,1, 'Kid’s Health', 1),
(39,1, 'Other – Parenting Questions', 1),

(40,1, 'Books & Authors', 2),
(41,1, 'Dancing ', 2),
(42,1, 'Genealogy ', 2),
(43,1, 'History ', 2),
(44,1, 'Other - Arts & Humanities', 2),
(45,1, 'Performing Arts', 2),
(46,1, 'Philosophy ', 2),
(47,1, 'Poetry', 2),
(48,1, 'Theater & Acting', 2),
(49,1, 'Visual Arts', 2),

(50,1, 'Advertising & Marketing ', 3),
(51,1, 'Careers & Employment ', 3),
(52,1, 'Corporations', 3),
(53,1, 'Credit', 3),
(54,1, 'Insurance', 3),
(55,1, 'Investing', 3),
(56,1, 'Other - Business & Finance', 3),
(57,1, 'Personal Finance', 3),
(58,1, 'Renting & Real Estate', 3),
(59,1,'Small Business',3),
(60,1,'Taxes',3),

(61,1,'Aircraft',4),
(62,1,'Boats & Boating',4),
(63,1,'Buying & Selling',4),
(64,1,'Car Audio',4),
(65,1,'Car Makes',4),
(66,1,'Commuting',4),
(67,1,'Insurance & Registration',4),
(68,1,'Maintenance & Repairs',4),
(69,1,'Motorcycles',4),
(70,1,'Other - Cars & Transportation',4),
(71,1,'Rail',4),
(72,1,'Safety',4),

(73,1,'Computer Networking',5),
(74,1,'Hardware',5),
(75,1,'Internet',5),
(76,1,'Other - Computers',5),
(77,1,'Programming & Design',5),
(78,1,'Security',5),
(79,1,'Software',5),

(80,1,'Camcorders',6),
(81,1,'Cameras',6),
(82,1,'Cell Phones & Plans',6),
(83,1,'Games & Gear',6),
(84,1,'Home Theater',6),
(85,1,'Land Phones',6),
(86,1,'Music & Music Players',6),
(87,1,'Other - Electronics',6),
(88,1,'PDAs & Handhelds',6),
(89,1,'TiVO & DVRs',6),
(90,1,'TVs',6),

(91,1,'Argentina',7),
(92,1,'Australia',7),
(93,1,'Austria',7),
(94,1,'Brazil',7),
(95,1,'Canada',7),
(96,1,'Fast Food',7),
(97,1,'France',7),
(98,1,'Germany',7),
(99,1,'India',7),
(100,1,'Indonesia',7),
(101,1,'Ireland',7),
(102,1,'Italy',7),
(103,1,'Malaysia',7),
(104,1,'Mexico',7),
(105,1,'New Zealand',7),
(106,1,'Other - Dining Out',7),
(107,1,'Philippines',7),
(108,1,'Singapore',7),
(109,1,'Spain',7),
(110,1,'Switzerland',7),
(111,1,'Thailand',7),
(112,1,'United Kingdom',7),
(113,1,'United States',7),
(114,1,'Vietnam',7),

(115,1,'Financial Aid',8),
(116,1,'Higher Education (University +)',8),
(117,1,'Home Schooling',8),
(118,1,'Homework Help',8),
(119,1,'Other - Education',8),
(120,1,'Preschool',8),
(121,1,'Primary & Secondary Education',8),
(122,1,'Quotations',8),
(123,1,'Special Education',8),
(124,1,'Standards & Testing',8),
(125,1,'Studying Abroad',8),
(126,1,'Teaching',8),
(127,1,'Trivia',8),
(128,1,'Words & Wordplay',8),

(129,1,'Celebrities',9),
(130,1,'Comics & Animation',9),
(131,1,'Horoscopes',9),
(132,1,'Jokes & Riddles',9),
(133,1,'Magazines',9),
(134,1,'Movies',9),
(135,1,'Music',9),
(136,1,'Other - Entertainment',9),
(137,1,'Polls & Surveys',9),
(138,1,'Radio',9),
(139,1,'Television',9),

(140,1,'Alternative Fuel Vehicles',10),
(141,1,'Conservation',10),
(142,1,'Global Warming',10),
(143,1,'Green Living',10),
(144,1,'Other - Environment',10),

(145,1,'Family',11),
(146,1,'Friends',11),
(147,1,'Marriage & Divorce',11),
(148,1,'Other - Family & Relationships',11),
(149,1,'Singles & Dating',11),
(150,1,'Weddings',11),

(151,1, 'Beer  Wine & Spirits',12),
(152,1,'Cooking & Recipes',12),
(153,1,'Entertaining',12),
(154,1,'Ethnic Cuisine',12),
(155,1,'Non-Alcoholic Drinks',12),
(156,1,'Other - Food & Drink',12),

(157,1,'Fashion & Accessories',13),
(158,1,'Hair',13),
(159,1,'Makeup',13),
(160,1,'Other - Beauty & Style',13),
(161,1,'Skin & Body',13),

(162,1,'Amusement Parks',14),
(163,1,'Board Games',14),
(164,1,'Card Games',14),
(165,1,'Gambling',14),
(166,1,'Hobbies & Crafts',14),
(167,1,'Other - Games & Recreation',14),
(168,1,'Toys',14),
(169,1,'Video & Online Games',14),

(170,1,'Alternative Medicine',15),
(171,1,'Dental',15),
(172,1,'Diet & Fitness',15),
(173,1,'Diseases & Conditions',15),
(174,1,'General Health Care',15),
(175,1,'Men`s Health',15),
(176,1,'Mental Health',15),
(177,1,'Optical',15),
(178,1,'Other - Health',15),
(179,1,'Women`s Health',15),

(180,1,'Cleaning & Laundry',16),
(181,1,'Decorating & Remodeling',16),
(182,1,'Do It Yourself (DIY)',16),
(183,1,'Garden & Landscape',16),
(184,1,'Maintenance & Repairs',16),
(185,1,'Other - Home & Garden',16),

(186,1,'Current Events',17),
(187,1,'Media & Journalism',17),
(188,1,'Other - News & Events',17),

(189,1,'Birds',18),
(190,1,'Cats',18),
(191,1,'Dogs',18),
(192,1,'Fish',18),
(193,1,'Horses',18),
(194,1,'Other - Pets',18),
(195,1,'Reptiles',18),
(196,1,'Rodents',18),

(197,1,'Civic Participation',19),
(198,1,'Elections',19),
(199,1,'Embassies & Consulates',19),
(200,1,'Government',19),
(201,1,'Immigration',19),
(202,1,'International Organizations',19),
(203,1,'Law & Ethics',19),
(204,1,'Law Enforcement & Police',19),
(205,1,'Military',19),
(206,1,'Other - Politics & Government',19),
(207,1,'Politics',19),

(208,1,'Agriculture',20),
(209,1,'Alternative',20),
(210,1,'Astronomy & Space',20),
(211,1,'Biology',20),
(212,1,'Botany',20),
(213,1,'Chemistry',20),
(214,1,'Earth Sciences & Geology',20),
(215,1,'Engineering',20),
(216,1,'Geography',20),
(217,1,'Mathematics',20),
(218,1,'Medicine',20),
(219,1,'Other - Science',20),
(220,1,'Physics',20),
(221,1,'Weather',20),
(222,1,'Zoology',20),

(223,1,'Anthropology',21),
(224,1,'Dream Interpretation',21),
(225,1,'Economics',21),
(226,1,'Gender Studies',21),
(227,1,'Other - Social Science',21),
(228,1,'Psychology',21),
(229,1,'Sociology',21),

(230,1,'Community Service',22),
(231,1,'Cultures & Groups',22),
(232,1,'Etiquette',22),
(233,1,'Holidays',22),
(234,1,'Languages',22),
(235,1,'Mythology & Folklore',22),
(236,1,'Other - Society & Culture',22),
(237,1,'Religion & Spirituality',22),
(238,1,'Royalty',22),

(239,1,'Auto Racing',23),
(240,1,'Baseball',23),
(241,1,'Basketball',23),
(242,1,'Boxing',23),
(243,1,'Cricket',23),
(244,1,'Cycling',23),
(245,1,'Fantasy Sports',23),
(246,1,'Football (American)',23),
(247,1,'Football (Australian)',23),
(248,1,'Football (Canadian)',23),
(249,1,'Football (Soccer)',23),
(250,1,'Golf',23),
(251,1,'Handball',23),
(252,1,'Hockey',23),
(253,1,'Horse Racing',23),
(254,1,'Martial Arts',23),
(255,1,'Motorcycle Racing',23),
(256,1,'Olympics',23),
(257,1,'Other - Sports',23),
(258,1,'Outdoor Recreation',23),
(259,1,'Rugby',23),
(260,1,'Running',23),
(261,1,'Snooker & Pool',23),
(262,1,'Surfing',23),
(263,1,'Swimming & Diving',23),
(264,1,'Tennis',23),
(265,1,'Volleyball',23),
(266,1,'Water Sports',23),
(267,1,'Winter Sports',23),
(268,1,'Wrestling',23),

(269,1,'Africa & Middle East',24),
(270,1,'Air Travel',24),
(271,1,'Argentina',24),
(272,1,'Asia Pacific',24),
(273,1,'Australia',24),
(274,1,'Austria',24),
(275,1,'Brazil',24),
(276,1,'Canada',24),
(277,1,'Caribbean',24),
(278,1,'Cruise Travel',24),
(279,1,'Europe (Continental)',24),
(280,1,'France',24),
(281,1,'Germany',24),
(282,1,'India',24),
(283,1,'Ireland',24),
(284,1,'Italy',24),
(285,1,'Latin America',24),
(286,1,'Mexico',24),
(287,1,'Nepal',24),
(288,1,'New Zealand',24),
(289,1,'Other - Destinations',24),
(290,1,'Spain',24),
(291,1,'Switzerland',24),
(292,1,'Travel (General)',24),
(293,1,'United Kingdom',24),
(294,1,'United States',24),
(295,1,'Vietnam',24);


-- --------------------------------------------------------

--
-- Dumping data for table `engine4_core_menuitems`
--

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_answerl', 'answer', 'Answers', '', '{"route":"answer_browse"}', 'core_main', '', 5),
('core_sitemap_answer', 'answer', 'Answers', '', '{"route":"answer_browse"}', 'core_sitemap', '', 5),
('core_admin_main_plugins_answer', 'answer', 'Answers', '', '{"route":"admin_default","module":"answer","controller":"settings"}', 'core_admin_main_plugins', '', 999),

('answer_admin_main_manage', 'answer', 'Manage Answers', '', '{"route":"admin_default","module":"answer","controller":"manage"}', 'answer_admin_main', '', 1),
('answer_admin_main_settings', 'answer', 'Global Settings', '', '{"route":"admin_default","module":"answer","controller":"settings"}', 'answer_admin_main', '', 2),
('answer_admin_main_level', 'answer', 'Member Level Settings', '', '{"route":"admin_default","module":"answer","controller":"settings","action":"level"}', 'answer_admin_main', '', 3),
('answer_admin_main_categories', 'answer', 'Categories', '', '{"route":"admin_default","module":"answer","controller":"settings","action":"categories"}', 'answer_admin_main', '', 4);


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

--
-- Dumping data for table `engine4_activity_notificationtypes`
--

INSERT IGNORE INTO `engine4_activity_notificationtypes` (`type`, `module`, `body`, `is_request`, `handler`) VALUES
('answer_answer', 'answer', '{item:$subject} has answered a question you asked.', 0, '');


-- --------------------------------------------------------

INSERT IGNORE INTO `engine4_core_mailtemplates` (`type`, `module`, `vars`) VALUES
('notify_answer_answer', 'answer', '[host],[email],[recipient_title],[recipient_link],[recipient_photo],[sender_title],[sender_link],[sender_photo],[object_title],[object_link],[object_photo],[object_description]');

