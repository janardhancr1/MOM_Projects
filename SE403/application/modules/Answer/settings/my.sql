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
  `answer_tags` varchar(255) NOT NULL,
  `answer_cat_id` int(11) unsigned NOT NULL,
  `answer_sub_cat_id` int(11) unsigned,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY  (`answer_id`),
  KEY `user_id` (`user_id`),
  KEY `is_closed` (`is_closed`),
  KEY `creation_date` (`creation_date`),
  KEY `answer_cat_id` (`answer_cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;


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
  `parent_cat_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_unicode_ci ;

--
-- Dumping data for table `engine4_question_categories`
--

INSERT IGNORE INTO `engine4_answer_categories` (`category_id`, `user_id`, `category_name`, `parent_cat_id`) VALUES
(1, 1, 'General Parenting', 0),
(2, 1, 'Arts & Humanities', 0),
(3, 1, 'Business & Finance', 0),
(4, 1, 'Cars & Transportation', 0),
(5, 1, 'Computers & Internet', 0),
(6, 1, 'Consumer Electronics', 0),
(7, 1, 'Dining Out', 0),
(8, 1, 'Education & Reference', 0),
(8, 1, 'Entertainment & Music', 0),
(10, 1, 'Environment', 0),
(11, 1, 'Family & Relationships', 0),
(12, 1, 'Food & Drink', 0),
(13, 1, 'Fashion, Beauty & Style', 0),
(14, 1, 'Games & Recreation', 0),
(15, 1, 'Health', 0),
(16, 1, 'Home & Garden', 0),
(17, 1, 'News & Events', 0),
(18, 1, 'Birds', 0),
(19, 1, 'Politics & Government', 0),
(20, 1, 'Science & Mathematics', 0),
(21, 1, 'Social Science', 0),
(22, 1, 'Society & Culture', 0),
(23, 1, 'Sports', 0),
(24, 1, 'Travel', 0),

(23, 1, 'Babies', 1),
(24, 1, 'Toddlers', 1),
(25, 1, 'Preschoolers', 1),
(26, 1, 'School-Age Kids', 1),
(27, 1, 'Tweens', 1),
(28, 1, 'Teens', 1),
(29, 1, 'Adult Kids', 1),
(30, 1, 'Trying to Conceive', 1),
(31, 1, 'Other – General Parenting', 1),
(32, 1, 'Pregnancy', 1),
(33, 1, 'Adoption', 1),
(34, 1, 'Baby Names', 1),
(35, 1, 'Back-to-School', 1),
(36, 1, 'Kid’s Health', 1),
(37, 1, 'Other – Parenting Questions', 1),
(38, 1, 'Books & Authors', 2),
(39, 1, 'Dancing ', 2),
(40, 1, 'Genealogy ', 2),
(41, 1, 'History ', 2),
(42, 1, 'Other - Arts & Humanities', 2),
(43, 1, 'Performing Arts', 2),
(44, 1, 'Philosophy ', 2),
(45, 1, 'Poetry', 2),
(46, 1, 'Theater & Acting', 2),
(47, 1, 'Visual Arts', 2),

(48, 1, 'Advertising & Marketing ', 3),
(49, 1, 'Careers & Employment ', 3),
(50, 1, 'Corporations', 3),
(51, 1, 'Credit', 3),
(52, 1, 'Insurance', 3),
(53, 1, 'Investing', 3),
(54, 1, 'Other - Business & Finance', 3),
(55, 1, 'Personal Finance', 3),
(56, 1, '•Renting & Real Estate', 3),
(57,1,'Small Business',3),
(58,1,'Taxes',3),

(59,1,'Aircraft',4),
(60,1,'Boats & Boating',4),
(61,1,'Buying & Selling',4),
(62,1,'Car Audio',4),
(63,1,'Car Makes',4),
(64,1,'Commuting',4),
(65,1,'Insurance & Registration',4),
(66,1,'Maintenance & Repairs',4),
(67,1,'Motorcycles',4),
(68,1,'Other - Cars & Transportation',4),
(69,1,'Rail',4),
(70,1,'Safety',4),

(71,1,'Computer Networking',5),
(72,1,'Hardware',5),
(73,1,'Internet',5),
(74,1,'Other - Computers',5),
(75,1,'Programming & Design',5),
(76,1,'Security',5),
(77,1,'Software',5),

(78,1,'Camcorders',6),
(79,1,'Cameras',6),
(80,1,'Cell Phones & Plans',6),
(81,1,'Games & Gear',6),
(82,1,'Home Theater',6),
(83,1,'Land Phones',6),
(84,1,'Music & Music Players',6),
(85,1,'Other - Electronics',6),
(86,1,'PDAs & Handhelds',6),
(87,1,'TiVO & DVRs',6),
(88,1,'TVs',6),

(88,1,'Argentina',7),
(89,1,'Australia',7),
(90,1,'Austria',7),
(91,1,'Brazil',7),
(92,1,'Canada',7),
(93,1,'Fast Food',7),
(94,1,'France',7),
(95,1,'Germany',7),
(96,1,'India',7),
(97,1,'Indonesia',7),
(98,1,'Ireland',7),
(99,1,'Italy',7),
(100,1,'Malaysia',7),
(101,1,'Mexico',7),
(102,1,'New Zealand',7),
(103,1,'Other - Dining Out',7),
(104,1,'Philippines',7),
(105,1,'Singapore',7),
(106,1,'Spain',7),
(107,1,'Switzerland',7),
(108,1,'Thailand',7),
(109,1,'United Kingdom',7),
(110,1,'United States',7),
(111,1,'Vietnam',7),

(112,1,'Financial Aid',8),
(113,1,'Higher Education (University +)',8),
(114,1,'Home Schooling',8),
(115,1,'Homework Help',8),
(116,1,'Other - Education',8),
(117,1,'Preschool',8),
(118,1,'Primary & Secondary Education',8),
(119,1,'Quotations',8),
(120,1,'Special Education',8),
(121,1,'Standards & Testing',8),
(122,1,'Studying Abroad',8),
(123,1,'Teaching',8),
(124,1,'Trivia',8),
(125,1,'Words & Wordplay',8),

(126,1,'Celebrities',9),
(127,1,'Comics & Animation',9),
(128,1,'Horoscopes',9),
(129,1,'Jokes & Riddles',9),
(130,1,'Magazines',9),
(131,1,'Movies',9),
(132,1,'Music',9),
(133,1,'Other - Entertainment',9),
(134,1,'Polls & Surveys',9),
(135,1,'Radio',9),
(136,1,'Television',9),

(137,1,'Alternative Fuel Vehicles',10),
(138,1,'Conservation',10),
(139,1,'Global Warming',10),
(140,1,'Green Living',10),
(141,1,'Other - Environment',10),

(141,1,'Family',11),
(142,1,'Friends',11),
(143,1,'Marriage & Divorce',11),
(144,1,'Other - Family & Relationships',11),
(145,1,'Singles & Dating',11),
(146,1,'Weddings',11),

(146,1,'Beer, Wine & Spirits',112),
(147,1,'Cooking & Recipes',12),
(148,1,'Entertaining',12),
(149,1,'Ethnic Cuisine',12),
(150,1,'Non-Alcoholic Drinks',12),
(151,1,'Other - Food & Drink',12),

(152,1,'Fashion & Accessories',13),
(153,1,'Hair',13),
(154,1,'Makeup',13),
(155,1,'Other - Beauty & Style',13),
(156,1,'Skin & Body',13),

(157,1,'Amusement Parks',14),
(158,1,'Board Games',14),
(159,1,'Card Games',14),
(160,1,'Gambling',14),
(161,1,'Hobbies & Crafts',14),
(162,1,'Other - Games & Recreation',14),
(163,1,'Toys',14),
(164,1,'Video & Online Games',14),

(165,1,'Alternative Medicine',15),
(166,1,'Dental',15),
(167,1,'Diet & Fitness',15),
(168,1,'Diseases & Conditions',15),
(169,1,'General Health Care',15),
(170,1,'Men`s Health',15),
(171,1,'Mental Health',15),
(172,1,'Optical',15),
(173,1,'Other - Health',15),
(174,1,'Women`s Health',15),

(175,1,'Cleaning & Laundry',16),
(176,1,'Decorating & Remodeling',16),
(177,1,'Do It Yourself (DIY)',16),
(178,1,'Garden & Landscape',16),
(179,1,'Maintenance & Repairs',16),
(180,1,'Other - Home & Garden',16),

(181,1,'Current Events',17),
(182,1,'Media & Journalism',17),
(183,1,'Other - News & Events',17),

(184,1,'Birds',18),
(185,1,'Cats',18),
(186,1,'Dogs',18),
(187,1,'Fish',18),
(188,1,'Horses',18),
(189,1,'Other - Pets',18),
(190,1,'Reptiles',18),
(191,1,'Rodents',18),

(192,1,'Civic Participation',19),
(193,1,'Elections',19),
(194,1,'Embassies & Consulates',19),
(195,1,'Government',19),
(196,1,'Immigration',19),
(197,1,'International Organizations',19),
(198,1,'Law & Ethics',19),
(199,1,'Law Enforcement & Police',19),
(200,1,'Military',19),
(201,1,'Other - Politics & Government',19),
(202,1,'Politics',19),

(203,1,'Agriculture',20),
(204,1,'Alternative',20),
(205,1,'Astronomy & Space',20),
(206,1,'Biology',20),
(207,1,'Botany',20),
(208,1,'Chemistry',20),
(209,1,'Earth Sciences & Geology',20),
(210,1,'Engineering',20),
(211,1,'Geography',20),
(212,1,'Mathematics',20),
(213,1,'Medicine',20),
(214,1,'Other - Science',20),
(215,1,'Physics',20),
(216,1,'Weather',20),
(217,1,'Zoology',20),

(218,1,'Anthropology',21),
(219,1,'Dream Interpretation',21),
(220,1,'Economics',21),
(221,1,'Gender Studies',21),
(222,1,'Other - Social Science',21),
(223,1,'Psychology',21),
(224,1,'Sociology',21),

(225,1,'Community Service',22),
(226,1,'Cultures & Groups',22),
(227,1,'Etiquette',22),
(228,1,'Holidays',22),
(229,1,'Languages',22),
(230,1,'Mythology & Folklore',22),
(231,1,'Other - Society & Culture',22),
(232,1,'Religion & Spirituality',22),
(233,1,'Royalty',22),

(234,1,'Auto Racing',23),
(235,1,'Baseball',23),
(236,1,'Basketball',23),
(237,1,'Boxing',23),
(238,1,'Cricket',23),
(239,1,'Cycling',23),
(240,1,'Fantasy Sports',23),
(241,1,'Football (American)',23),
(242,1,'Football (Australian)',23),
(243,1,'Football (Canadian)',23),
(244,1,'Football (Soccer)',23),
(245,1,'Golf',23),
(246,1,'Handball',23),
(247,1,'Hockey',23),
(248,1,'Horse Racing',23),
(249,1,'Martial Arts',23),
(250,1,'Motorcycle Racing',23),
(251,1,'Olympics',23),
(252,1,'Other - Sports',23),
(253,1,'Outdoor Recreation',23),
(254,1,'Rugby',23),
(255,1,'Running',23),
(256,1,'Snooker & Pool',23),
(257,1,'Surfing',23),
(258,1,'Swimming & Diving',23),
(259,1,'Tennis',23),
(260,1,'Volleyball',23),
(261,1,'Water Sports',23),
(262,1,'Winter Sports',23),
(263,1,'Wrestling',23),

(264,1,'Africa & Middle East',24),
(265,1,'Air Travel',24),
(266,1,'Argentina',24),
(267,1,'Asia Pacific',24),
(268,1,'Australia',24),
(269,1,'Austria',24),
(270,1,'Brazil',24),
(271,1,'Canada',24),
(272,1,'Caribbean',24),
(273,1,'Cruise Travel',24),
(274,1,'Europe (Continental)',24),
(275,1,'France',24),
(276,1,'Germany',24),
(277,1,'India',24),
(278,1,'Ireland',24),
(279,1,'Italy',24),
(280,1,'Latin America',24),
(281,1,'Mexico',24),
(282,1,'Nepal',24),
(283,1,'New Zealand',24),
(284,1,'Other - Destinations',24),
(285,1,'Spain',24),
(286,1,'Switzerland',24),
(287,1,'Travel (General)',24),
(288,1,'United Kingdom',24),
(289,1,'United States',24),
(290,1,'Vietnam',24);


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
('answer_admin_main_level', 'answer', 'Member Level Settings', '', '{"route":"admin_default","module":"answer","controller":"settings","action":"level"}', 'answer_admin_main', '', 3)
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

