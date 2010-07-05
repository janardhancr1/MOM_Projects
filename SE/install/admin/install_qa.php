<?php

$plugin_name = "Q&amp;A Plugin";
$plugin_version = "1.1.1";
$plugin_type = "qa";
$plugin_desc = "This plugin integrates a complete Questions and Answers system into your Social Engine powered site.";
$plugin_icon = "qa_qa16.gif";
$plugin_menu_title = "27003003";	
//$plugin_pages_main = "27003004<!>qa_qa16.gif<!>admin_viewqa.php<~!~>27003005<!>qa_settings16.gif<!>admin_qa.php<~!~>";
$plugin_pages_main = "27003005<!>qa_settings16.gif<!>admin_qa.php<~!~>";
$plugin_pages_level = "27003006<!>admin_levels_qasettings.php<~!~>";
$plugin_url_htaccess = "RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^([^/]+)/question/([0-9]+)/?$ \$server_info/question.php?user=\$1&qid=\$2 [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^[^/]+/questions/([0-9]+)/?$ \$server_info/browse_questions.php?qacat_id=\$1 [L]";
$plugin_db_charset = 'utf8';
$plugin_db_collation = 'utf8_unicode_ci';
$plugin_reindex_totals = TRUE;




if($install == "qa")
{
  //######### INSERT ROW INTO se_plugins
  if($database->database_num_rows($database->database_query("SELECT plugin_id FROM se_plugins WHERE plugin_type='$plugin_type'")) == 0) {
    $database->database_query("INSERT INTO se_plugins (plugin_name,
					plugin_version,
					plugin_type,
					plugin_desc,
					plugin_icon,
					plugin_menu_title,
					plugin_pages_main,
					plugin_pages_level,
					plugin_url_htaccess
					) VALUES (
					'$plugin_name',
					'$plugin_version',
					'$plugin_type',
					'".str_replace("'", "\'", $plugin_desc)."',
					'$plugin_icon',
					'$plugin_menu_title',
					'$plugin_pages_main',
					'$plugin_pages_level',
					'$plugin_url_htaccess')");
  }
  
  //######### UPDATE PLUGIN VERSION IN se_plugins
  else
  {
    $database->database_query("UPDATE se_plugins SET plugin_name='$plugin_name',
					plugin_version='$plugin_version',
					plugin_desc='".str_replace("'", "\'", $plugin_desc)."',
					plugin_icon='$plugin_icon',
					plugin_menu_title='$plugin_menu_title',
					plugin_pages_main='$plugin_pages_main',
					plugin_pages_level='$plugin_pages_level',
					plugin_url_htaccess='$plugin_url_htaccess' WHERE plugin_type='$plugin_type'");
  }



  
  
  
  //######### CREATE se_vt_answers
  if($database->database_num_rows($database->database_query("SHOW TABLES FROM `$database_name` LIKE 'se_vt_answers'")) == 0) {
    $database->database_query("CREATE TABLE `se_vt_answers` (
	  `answer_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `answer_q_id` int(10) unsigned NOT NULL,
	  `answer_user_id` int(11) NOT NULL,
	  `answer_text` text NOT NULL,
	  `answer_time` int(14) NOT NULL,
	  `answer_rating_value` float NOT NULL,
	  `answer_rating_raters` text NOT NULL,
	  `answer_rating_raters_num` int(10) unsigned NOT NULL,
	  PRIMARY KEY (`answer_id`)
	) ENGINE=MyISAM  CHARACTER SET {$plugin_db_charset} COLLATE {$plugin_db_collation}");
  }

  //######### CREATE se_vt_questions
  if($database->database_num_rows($database->database_query("SHOW TABLES FROM `$database_name` LIKE 'se_vt_questions'")) == 0) {
    $database->database_query("CREATE TABLE `se_vt_questions` (
	  `question_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	  `question_cat_id` int(10) unsigned NOT NULL,
	  `question_subcat_id` smallint(5) unsigned NOT NULL,
	  `question_user_id` int(9) NOT NULL,
	  `question_title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
	  `question_text` text COLLATE utf8_unicode_ci NOT NULL,
	  `question_time` int(14) NOT NULL,
	  `question_ttl` int(10) unsigned NOT NULL DEFAULT '345600',
	  `question_views` int(10) unsigned NOT NULL,
	  `question_state` tinyint(3) unsigned NOT NULL DEFAULT '1',
	  `question_num_answers` smallint(5) unsigned NOT NULL,
	  `question_best_answer_id` int(10) unsigned NOT NULL,
	  `question_best_answer_rating` tinyint(4) NOT NULL DEFAULT '-1',
	  `question_best_answer_comment` tinytext COLLATE utf8_unicode_ci NOT NULL,
	  `question_best_answer_selected` tinyint(3) unsigned NOT NULL DEFAULT '0',
	  `question_rating_value` float NOT NULL,
	  `question_rating_raters` text COLLATE utf8_unicode_ci NOT NULL,
	  `question_rating_raters_num` int(10) unsigned NOT NULL,
	  PRIMARY KEY (`question_id`),
	  KEY `INDEX` (`question_user_id`)
	) ENGINE=MyISAM  CHARACTER SET {$plugin_db_charset} COLLATE {$plugin_db_collation}");
  }
  
  //######### CREATE se_vt_qacats
  if($database->database_num_rows($database->database_query("SHOW TABLES FROM `$database_name` LIKE 'se_vt_qacats'")) == 0) {
    $database->database_query("CREATE TABLE `se_vt_qacats` (
	  `vt_qacat_id` int(9) NOT NULL AUTO_INCREMENT,
	  `vt_qacat_dependency` int(9) NOT NULL DEFAULT '0',
	  `vt_qacat_title` int(10) unsigned NOT NULL DEFAULT '0',
	  `vt_qacat_order` smallint(5) unsigned NOT NULL DEFAULT '0',
	  `vt_qacat_signup` tinyint(3) unsigned NOT NULL DEFAULT '0',
	  PRIMARY KEY (`vt_qacat_id`)
	) ENGINE=MyISAM  CHARACTER SET {$plugin_db_charset} COLLATE {$plugin_db_collation}");
  }
	  
  
  //######### INSERT se_urls
  if($database->database_num_rows($database->database_query("SELECT url_id FROM se_urls WHERE url_file='question'")) == 0) {
    $database->database_query("INSERT INTO se_urls (url_title, url_file, url_regular, url_subdirectory) VALUES ('Question URL', 'question', 'question.php?user=\$id1&qid=\$id2', '\$id1/question/\$id2')");
  } else {
    $database->database_query("UPDATE se_urls SET url_regular = 'question.php?user=\$id1&qid=\$id2', url_subdirectory = '\$id1/question/\$id2' WHERE url_file='question' LIMIT 1");  
  }
  if($database->database_num_rows($database->database_query("SELECT url_id FROM se_urls WHERE url_file='question_cat'")) == 0) {
    $database->database_query("INSERT INTO se_urls (url_title, url_file, url_regular, url_subdirectory) VALUES ('Question Category URL', 'question_cat', 'browse_questions.php?qacat_id=\$id1', '\$id2/questions/\$id1')");
  } else {
    $database->database_query("UPDATE se_urls SET url_regular = 'browse_questions.php?qacat_id=\$id1', url_subdirectory = '\$id2/questions/\$id1' WHERE url_file='question_cat' LIMIT 1");  
  }
  
  //######### INSERT se_actiontypes
  $actiontypes = array();
  if( !$database->database_num_rows($database->database_query("SELECT actiontype_id FROM se_actiontypes WHERE actiontype_name='newquestion'")) )
  {
    $database->database_query("
      INSERT INTO se_actiontypes
        (actiontype_name, actiontype_icon, actiontype_setting, actiontype_enabled, actiontype_desc, actiontype_text, actiontype_vars, actiontype_media)
      VALUES
        ('newquestion', 'qa_action_newquestion.gif', '1', '1', '27003178', '27003179', '[username],[displayname],[id],[title]', '0')
    ");
    $actiontypes[] = $database->database_insert_id();
  }

  if( !$database->database_num_rows($database->database_query("SELECT actiontype_id FROM se_actiontypes WHERE actiontype_name='newanswer'")) )
  {
    $database->database_query("
      INSERT INTO se_actiontypes
        (actiontype_name, actiontype_icon, actiontype_setting, actiontype_enabled, actiontype_desc, actiontype_text, actiontype_vars, actiontype_media)
      VALUES
        ('newanswer', 'qa_action_newanswer.gif', '1', '1', '27003182', '27003183', '[username],[displayname],[id],[title]', '0')
    ");
    $actiontypes[] = $database->database_insert_id();
  }
  
  $actiontypes = array_filter($actiontypes);
  
  if( !empty($actiontypes) )
  {
    $database->database_query("UPDATE se_usersettings SET usersetting_actions_display = CONCAT(usersetting_actions_display, ',', '".implode(",", $actiontypes)."')");
  }
  
  
  
  //######### INSERT se_notifytypes
  if( !$database->database_num_rows($database->database_query("SELECT notifytype_id FROM se_notifytypes WHERE notifytype_name='newanswer'")) )
  {
    $database->database_query("
      INSERT INTO se_notifytypes
        (notifytype_name, notifytype_desc, notifytype_icon, notifytype_url, notifytype_title)
      VALUES
        ('newanswer', '27003186', 'qa_action_newanswer.gif', 'question.php?user=%1\$s&qid=%2\$s#a_%3\$s', '27003187')
    ");
  }

  if( !$database->database_num_rows($database->database_query("SELECT notifytype_id FROM se_notifytypes WHERE notifytype_name='bestanswer'")) )
  {
    $database->database_query("
      INSERT INTO se_notifytypes
        (notifytype_name, notifytype_desc, notifytype_icon, notifytype_url, notifytype_title)
      VALUES
        ('bestanswer', '27003188', 'qa_action_newanswer.gif', 'question.php?user=%1\$s&bestanswer=1&qid=%2\$s#a_%3\$s', '27003189')
    ");
  }
    
  

  
  
  //######### ADD COLUMNS/VALUES TO SETTINGS TABLE
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_permission_qa'")) == 0) {
    $database->database_query("ALTER TABLE se_settings 
					ADD COLUMN `setting_permission_qa` int(1) NOT NULL default '1'");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_qa_code'")) == 0) {
    $database->database_query("ALTER TABLE se_settings ADD COLUMN `setting_qa_code` int(1) NOT NULL default '1'");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_qa_html'")) == 0) {
    $database->database_query("ALTER TABLE se_settings ADD COLUMN `setting_qa_html` varchar(250) NOT NULL default ''");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_qa_ad_ids'")) == 0) {
    $database->database_query("ALTER TABLE se_settings ADD COLUMN `setting_qa_ad_ids` varchar(250) NOT NULL default ''");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_qa_max_rating'")) == 0) {
    $database->database_query("ALTER TABLE se_settings ADD COLUMN `setting_qa_max_rating` tinyint unsigned NOT NULL default 5");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_qa_user_vote_time_enabled'")) == 0) {
    $database->database_query("ALTER TABLE se_settings ADD COLUMN `setting_qa_user_vote_time_enabled` tinyint unsigned NOT NULL default 1");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_qa_vote_time_default'")) == 0) {
    $database->database_query("ALTER TABLE se_settings ADD COLUMN `setting_qa_vote_time_default` int unsigned NOT NULL default 345600");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_qa_select_time_min'")) == 0) {
    $database->database_query("ALTER TABLE se_settings ADD COLUMN `setting_qa_select_time_min` int unsigned NOT NULL default 14400");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_settings` LIKE 'setting_qa_voting_time'")) == 0) {
    $database->database_query("ALTER TABLE se_settings ADD COLUMN `setting_qa_voting_time` int unsigned NOT NULL default 604800");
  }
  
  
  
  //######### ADD COLUMNS/VALUES TO SYSTEM EMAILS TABLE
  if( !$database->database_num_rows($database->database_query("SELECT systememail_id FROM se_systememails WHERE systememail_name='newanswer'")) )
  {
    $database->database_query("
      INSERT INTO se_systememails
        (systememail_name, systememail_title, systememail_desc, systememail_subject, systememail_body, systememail_vars)
      VALUES
        ('newanswer', '27003001', '27003002', '27003192', '27003193', '[displayname],[answerer],[link]')
    ");
  }
  if( !$database->database_num_rows($database->database_query("SELECT systememail_id FROM se_systememails WHERE systememail_name='bestanswer'")) )
  {
    $database->database_query("
      INSERT INTO se_systememails
        (systememail_name, systememail_title, systememail_desc, systememail_subject, systememail_body, systememail_vars)
      VALUES
        ('bestanswer', '27003012', '27003013', '27003194', '27003195', '[displayname],[link]')
    ");
  }
  
  
  //######### ADD COLUMNS/VALUES TO USER TABLE
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_users` LIKE 'users_qa_num_questions'")) == 0) {
    $database->database_query("ALTER TABLE se_users 
					ADD COLUMN `users_qa_num_questions` int(9) NOT NULL default '0'");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_users` LIKE 'users_qa_num_answers'")) == 0) {
    $database->database_query("ALTER TABLE se_users 
					ADD COLUMN `users_qa_num_answers` int(9) NOT NULL default '0'");
  }
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_users` LIKE 'users_qa_num_best_answers'")) == 0) {
    $database->database_query("ALTER TABLE se_users 
					ADD COLUMN `users_qa_num_best_answers` int(9) NOT NULL default '0'");
  }

  //######### ADD COLUMNS/VALUES TO USER SETTINGS TABLE
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_usersettings` LIKE 'usersetting_notify_newanswer'")) == 0) {
    $database->database_query("ALTER TABLE se_usersettings 
					ADD COLUMN `usersetting_notify_newanswer` int(1) NOT NULL default '1'");
  }

  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_usersettings` LIKE 'usersetting_notify_bestanswer'")) == 0) {
    $database->database_query("ALTER TABLE se_usersettings 
					ADD COLUMN `usersetting_notify_bestanswer` int(1) NOT NULL default '1'");
  }

  //######### ADD COLUMNS/VALUES TO LEVELS TABLE IF Q&A HAS NEVER BEEN INSTALLED
  if($database->database_num_rows($database->database_query("SHOW COLUMNS FROM `$database_name`.`se_levels` LIKE 'level_qa_allow'")) == 0) {
    $database->database_query("ALTER TABLE se_levels 
					ADD COLUMN `level_qa_allow` int(1) NOT NULL default '1'");
  }
  
    
  
  
  //######### INSERT LANGUAGE VARS 
  if( !$database->database_num_rows($database->database_query("SELECT languagevar_id FROM se_languagevars WHERE languagevar_language_id=1 && languagevar_id=27003013 LIMIT 1")) )
  {
    $database->database_query("
      INSERT INTO `se_languagevars`
        (`languagevar_id`, `languagevar_language_id`, `languagevar_value`, `languagevar_default`)
      VALUES 
        (27003001, 1, 'New Answer Email', ''),
        (27003002, 1, 'This is the email that gets sent to a user when a answer is posted on one of their questions.', ''),
        (27003003, 1, 'Q&amp;A Plugin Settings', 'admin_viewusers_edit, admin_viewusers, admin_viewreports, admin_viewplugins, admin_viewadmins, admin_url, admin_templates, admin_subnetworks, admin_stats, admin_signup, admin_profile, admin_lostpass_reset, admin_lostpass, admin_login, admin_log, admin_levels_usersettings, admin_levels_messagesettings, admin_levels_edit, admin_levels_albumsettings, admin_levels, admin_language_edit, admin_language, admin_invite, admin_home, admin_general, admin_fields, admin_faq, admin_emails, admin_connections, admin_banning, admin_announcements, admin_ads_modify, admin_ads, admin_activity, '),
        (27003004, 1, 'View Q&amp;A', 'admin_viewusers_edit, admin_viewusers, admin_viewreports, admin_viewplugins, admin_viewadmins, admin_url, admin_templates, admin_subnetworks, admin_stats, admin_signup, admin_profile, admin_lostpass_reset, admin_lostpass, admin_login, admin_log, admin_levels_usersettings, admin_levels_messagesettings, admin_levels_edit, admin_levels_albumsettings, admin_levels, admin_language_edit, admin_language, admin_invite, admin_home, admin_general, admin_fields, admin_faq, admin_emails, admin_connections, admin_banning, admin_announcements, admin_ads_modify, admin_ads, admin_activity, '),
        (27003005, 1, 'Global Q&amp;A Settings', 'admin_viewusers_edit, admin_viewusers, admin_viewreports, admin_viewplugins, admin_viewadmins, admin_url, admin_templates, admin_subnetworks, admin_stats, admin_signup, admin_profile, admin_lostpass_reset, admin_lostpass, admin_login, admin_log, admin_levels_usersettings, admin_levels_messagesettings, admin_levels_edit, admin_levels_albumsettings, admin_levels, admin_language_edit, admin_language, admin_invite, admin_home, admin_general, admin_fields, admin_faq, admin_emails, admin_connections, admin_banning, admin_announcements, admin_ads_modify, admin_ads, admin_activity, '),
        (27003006, 1, 'Q&amp;A Settings', 'admin_viewusers_edit, admin_viewusers, admin_viewreports, admin_viewplugins, admin_viewadmins, admin_url, admin_templates, admin_subnetworks, admin_stats, admin_signup, admin_profile, admin_lostpass_reset, admin_lostpass, admin_login, admin_log, admin_levels_usersettings, admin_levels_messagesettings, admin_levels_edit, admin_levels_albumsettings, admin_levels, admin_language_edit, admin_language, admin_invite, admin_home, admin_general, admin_fields, admin_faq, admin_emails, admin_connections, admin_banning, admin_announcements, admin_ads_modify, admin_ads, admin_activity, '),
        (27003007, 1, 'Q&amp;A', 'header, '),
        (27003012, 1, 'Best Answer Email', ''),
        (27003013, 1, 'This is the email that gets sent to a user when their answer is selected as Best Answer.', '')
		ON DUPLICATE KEY UPDATE `languagevar_default`=`languagevar_default`
    ") or die("Insert Into se_languagevars: ".mysql_error());
  }

  //######### INSERT LANGUAGE VARS 
  if( !$database->database_num_rows($database->database_query("SELECT languagevar_id FROM se_languagevars WHERE languagevar_language_id=1 && languagevar_id=27003177 LIMIT 1")) )
  {
    $database->database_query("
      INSERT INTO `se_languagevars`
        (`languagevar_id`, `languagevar_language_id`, `languagevar_value`, `languagevar_default`)
      VALUES 
        (27003008, 1, 'This page contains general Q&amp;A settings that affect your entire social network.', ''),
        (27003009, 1, 'Select whether or not you want to let the public (visitors that are not logged-in) to view the following sections of your social network. In some cases (such as Profiles, Blogs, and Albums), if you have given them the option, your users will be able to make their pages private even though you have made them publically viewable here. For more permissions settings, please visit the <a href=\'admin_general.php\'>General Settings</a> page.', ''),
        (27003010, 1, 'Yes, the public can view questions unless they are made private.', ''),
        (27003011, 1, 'No, the public cannot view questions.', ''),
        (27003016, 1, 'Allow Questions?', ''),
        (27003017, 1, 'Do you want to let users at this user level ask questions?', ''),
        (27003018, 1, 'Yes, allow questions.', ''),
        (27003019, 1, 'No, do not allow questions.', ''),
        (27003020, 1, 'Question Privacy Options', ''),
        (27003021, 1, 'If you enable this feature, users will be able to exclude their questions from search results. Otherwise, all questions will be included in search results.', ''),
        (27003022, 1, 'Yes, allow users to exclude their questions from search results.', ''),
        (27003023, 1, 'No, force all questions to be included in search results.', ''),
        (27003024, 1, 'Questions Privacy Options', ''),
        (27003025, 1, 'Your users can choose from any of the options checked below when they decide who can see their questions. If you do not check any options, everyone will be allowed to view questions.', ''),
        (27003045, 1, 'This page lists all of the questions that users have created on your social network. You can use this page to monitor these questions and delete offensive material if necessary. Entering criteria into the filter fields will help you find specific questions. Leaving the filter fields blank will show all the questions on your social network.', ''),
        (27003046, 1, 'Title', ''),
        (27003047, 1, 'Owner', ''),
        (27003048, 1, 'No questions were found matching your criteria.', ''),
        (27003049, 1, '%1\$d Questions Found', ''),
        (27003052, 1, 'view', ''),
        (27003053, 1, 'Are you sure you want to delete this questions? ', ''),
        (27003054, 1, 'Delete Question?', ''),
        (27003055, 1, 'My Questions', ''),
        (27003056, 1, 'Q&amp;A Settings', ''),
        (27003057, 1, 'You have %1\$d questions.', ''),
        (27003059, 1, 'Ask New Question', 'user_questions, browse_questions'),
        (27003060, 1, 'My Questions Link:', ''),
        (27003061, 1, 'Asked:', ''),
        (27003062, 1, 'Last Update:', ''),
        (27003065, 1, 'Views:', ''),
        (27003066, 1, '%1\$d views', ''),
        (27003067, 1, 'Viewable By:', ''),
        (27003068, 1, 'View Question', ''),
        (27003069, 1, 'Edit Question', ''),
        (27003070, 1, 'Delete Question', ''),
        (27003071, 1, 'You do not have any questions.', ''),
        (27003076, 1, 'Return to My Questions', ''),
        (27003082, 1, 'Who can see this album?', ''),
        (27003083, 1, 'Who can answer this question?', ''),
        (27003084, 1, 'Ask Question', ''),
        (27003118, 1, '%1\$d questions', ''),
        (27003119, 1, 'Question: %1\$s', ''),
        (27003120, 1, 'In <a href=\'%1\$s\'>%2\$s</a> - Asked by <a href=\'%3\$s\'>%4\$s</a> - %5\$s<br/>&nbsp;&nbsp;%6\$s answers - %7\$s', ''),
        (27003121, 1, '%1\$s<br/><br/>%2\$s', ''),
        (27003123, 1, 'Q&amp;A', ''),
        (27003140, 1, 'Posted %1\$s', ''),
        (27003148, 1, 'Report Inappropriate Content', ''),
        (27003150, 1, 'Browse Questions', 'browse_questions,'),
        (27003171, 1, 'Questions', ''),
        (27003172, 1, 'Questions: %1\$d questions', ''),
        (27003173, 1, 'Answers', ''),
        (27003174, 1, 'Answers: %1\$d answers', ''),
		(27003175, 1, 'In %1\$s', ''),
        (27003176, 1, 'Browse Questions', ''),
        (27003177, 1, 'Browse the questions on our social network.', '')
		ON DUPLICATE KEY UPDATE `languagevar_default`=`languagevar_default`
    ") or die("Insert Into se_languagevars: ".mysql_error());
  }

  if( !$database->database_num_rows($database->database_query("SELECT languagevar_id FROM se_languagevars WHERE languagevar_language_id=1 && languagevar_id=27003195 LIMIT 1")) )
  {
    $database->database_query("
      INSERT INTO `se_languagevars`
        (`languagevar_id`, `languagevar_language_id`, `languagevar_value`, `languagevar_default`)
      VALUES 
        (27003178, 1, 'Asking a Question', 'actiontypes'),
        (27003179, 1, '<a href=\"profile.php?user=%1\$s\">%2\$s</a> asked a new question: <a href=\"question.php?user=%1\$s\&qid=%3\$s\">%4\$s</a>', 'actiontypes'),
        (27003182, 1, 'Posting an Answer', 'actiontypes'),
        (27003183, 1, '<a href=\"profile.php?user=%1\$s\">%2\$s</a> posted an <a href=\"question.php?user=%3\$s&qid=%6\$s#a_%8\$s\">answer</a> on <a href=\"profile.php?user=%3\$s\">%4\$s</a>&acute;s <a href=\"question.php?user=%3\$s&qid=%6\$s\">question</a>:<div class=\"recentaction_div\"><div class=\"action_q\">%5\$s</div><div class=\"action_a\">%7\$s</div></div>', 'actiontypes'),
        (27003186, 1, '%1\$d New Answer(s): %2\$s', 'notifytypes'),
        (27003187, 1, 'When I receive a new answer.', 'notifytypes'),
        (27003188, 1, '%1\$d Best Answer selections(s): %2\$s', 'notifytypes'),
        (27003189, 1, 'When my answer is selected as best answer.', 'notifytypes'),
        (27003192, 1, 'New Answers', 'systememails'),
        (27003193, 1, 'Hello %1\$s,\n\nA new answer has been posted on one of your questions by %2\$s. Please click the following link to view it:\n\n%3\$s\n\nBest Regards,\nSocial Network Administration', 'systememails'),
        (27003194, 1, 'Best Answer', 'systememails'),
        (27003195, 1, 'Hello %1\$s,\n\nYour answer has been selected as the best answer. Please click the following link to view the question it:\n\n%2\$s\n\nBest Regards,\nSocial Network Administration', 'systememails')
 		ON DUPLICATE KEY UPDATE `languagevar_default`=`languagevar_default`
   ") or die("Insert Into se_languagevars: ".mysql_error());
  }

  if( !$database->database_num_rows($database->database_query("SELECT languagevar_id FROM se_languagevars WHERE languagevar_language_id=1 && languagevar_id=27003342 LIMIT 1")) )
  {
    $database->database_query("
      INSERT INTO `se_languagevars`
        (`languagevar_id`, `languagevar_language_id`, `languagevar_value`, `languagevar_default`)
      VALUES 
        (27003274, 1, 'Select whether or not you want to let the public should be able to see the questions and answer on your network.', ''),
        (27003275, 1, 'Yes, the public can view questions and answers.', ''),
        (27003276, 1, 'No, the public cannot view questions and answers.', ''),
        (27003277, 1, 'Require users to enter validation code when posting a question or answer?', ''),
        (27003278, 1, 'If you have selected Yes, an image containing a random sequence of 6 numbers will be shown to users on the \"post a question\" and \"post an answer\" page. Users will be required to enter these numbers into the Verification Code field in order to post their question/answer. This feature helps prevent users from trying to create spam. For this feature to work properly, your server must have the GD Libraries (2.0 or higher) installed and configured to work with PHP. If you are seeing errors, try turning this off.', ''),
        (27003279, 1, 'Yes, enable validation code for questions and answers.', ''),
        (27003280, 1, 'No, disable validation code for questions and answers.', ''),
        (27003281, 1, 'Question Categories', ''),
        (27003282, 1, 'You may want to allow your users to categorize their questions by subject, location, etc. Categorized questions make it easier for users to find questions and answers that interest them. If you want to enable question categories, you can create them (along with subcategories) below.<br><br>Drag the icons next to the categories to reorder them.', ''),
        (27003283, 1, 'Question Categories', ''),
        (27003330, 1, 'HTML in Questions and Answers', ''),
        (27003331, 1, 'By default, the user may not enter any HTML tags into questions and answers. If you want to allow specific tags, you can enter them below (separated by commas). Example: <i>b, img, a, embed, font<i>', ''),
        (27003332, 1, 'Ads', ''),
        (27003333, 1, 'The Q&A plug-in contains a custom ad position. To place ads in this ad postion, please enter the ad campaign IDs below (separated by commas).', ''),
        (27003334, 1, 'Ratings', ''),
        (27003335, 1, 'Select the number of stars to use in the Q&A ratings system.', ''),
        (27003336, 1, 'Time limits', ''),
        (27003337, 1, 'Select the default number of days an answer is open for asker to select best answer before question goes to community vote.', ''),
        (27003338, 1, 'Enable user (asker) to select how long answer is open for asker to select best answer before question goes to community vote.', ''),
        (27003339, 1, 'Select the number of hours after posting a question before asker can select best answer.', ''),
        (27003340, 1, 'Days', ''),
        (27003341, 1, 'Hours', ''),
        (27003342, 1, 'Select the number of days a question remains in community voting phase (if applicable).', '')
		ON DUPLICATE KEY UPDATE `languagevar_default`=`languagevar_default`
    ") or die("Insert Into se_languagevars: ".mysql_error());
  }

  if( !$database->database_num_rows($database->database_query("SELECT languagevar_id FROM se_languagevars WHERE languagevar_language_id=1 && languagevar_id=27003477 LIMIT 1")) )
  {
    $database->database_query("
      INSERT INTO `se_languagevars`
        (`languagevar_id`, `languagevar_language_id`, `languagevar_value`, `languagevar_default`)
      VALUES 
        (27003400, 1, 'In %1\$s ', 'browse_questions'),
        (27003401, 1, 'Asked by %1\$s ', 'browse_questions'),
        (27003402, 1, '%1\$s answer', 'browse_questions'),
        (27003403, 1, '%1\$s answers', 'browse_questions'),
        (27003404, 1, '%1\$s', 'browse_questions'),
        (27003405, 1, 'Categories', 'browse_questions, question'),
        (27003406, 1, 'Question not found', 'question'),
        (27003407, 1, 'Answers', 'question'),
        (27003408, 1, 'Be the first member to answer this question.', 'question'),
        (27003409, 1, '%1\$s', 'question'),
        (27003410, 1, 'Your Answer', 'question'),
        (27003411, 1, 'Answer Question', 'question'),
        (27003412, 1, 'Submit Answer', 'question'),
        (27003413, 1, 'Cancel', 'question'),
        (27003414, 1, 'Open Question', ''),
        (27003415, 1, 'Resolved Question', ''),
        (27003416, 1, 'Report Inappropriate Content', ''),
        (27003417, 1, 'Undecided Question', ''),
        (27003418, 1, 'Undecided Question (Tiebreaker)', ''),
        (27003419, 1, 'Please login/register to vote', 'question'),
        (27003420, 1, 'You can\'t rate your own answer', 'question'),
        (27003421, 1, 'You have rated this answer', 'question'),
        (27003422, 1, '(%1\$s of %2\$s) %3\$s votes', 'question'),
        (27003423, 1, 'Best Answer', 'question'),
        (27003424, 1, 'As the owner of this question, you can now choose a best answer, or you can let the community decide the best answer through ratings. You have %1\$s remaining to select a best answer, otherwise the best answer will be decided automatically based on the ratings.', 'question'),
        (27003425, 1, 'Question is resolved', 'question'),
        (27003426, 1, 'Please rate the answer', 'question'),
        (27003427, 1, 'Comment (optional)', 'question'),
        (27003428, 1, 'Submit', 'question'),
        (27003430, 1, 'Ask Question', 'question_ask'),
        (27003431, 1, 'Submit Question', 'question_ask'),
        (27003432, 1, 'Your Question', 'question_ask'),
        (27003433, 1, 'Additional Details (Optional)', 'question_ask'),
        (27003434, 1, 'Characters left:', 'question_ask'),
        (27003435, 1, 'Category:', 'question_ask'),
        (27003436, 1, 'Sub-category:', 'question_ask'),
        (27003437, 1, '--Select--', 'question_ask'),
        (27003440, 1, '%1\$s seconds(s)', 'question'),
        (27003441, 1, '%1\$s minutes(s)', 'question'),
        (27003442, 1, '%1\$s hours(s)', 'question'),
        (27003443, 1, '%1\$s day(s)', 'question'),
        (27003444, 1, '%1\$s weeks(s)', 'question'),
        (27003445, 1, '%1\$s month(s)', 'question'),
        (27003446, 1, '%1\$s years(s)', 'question'),
        (27003447, 1, 'Other Answers', 'question'),
        (27003450, 1, 'My Questions', 'user_questions'),
        (27003451, 1, 'Below are all the questions and answers that you have posted.', 'user_questions'),
        (27003460, 1, 'Title is required.', 'question_ask'),
        (27003461, 1, 'At least %0 characters.', 'question_ask'),
        (27003462, 1, 'Please select.', 'question_ask'),
        (27003470, 1, 'Best Answer', 'question'),
        (27003471, 1, 'Chosen by Community Voters', 'question'),
        (27003472, 1, 'Chosen by Asking User', 'question'),
        (27003473, 1, 'Asking User\'s rating: ', 'question'),
        (27003474, 1, 'Average rating: ', 'question'),
        (27003475, 1, 'Asking User\'s comment: ', 'question'),
        (27003476, 1, 'Edit Answer', 'question'),
        (27003477, 1, 'Update Answer', 'question')
		ON DUPLICATE KEY UPDATE `languagevar_default`=`languagevar_default`
    ") or die("Insert Into se_languagevars: ".mysql_error());
  }

  if( !$database->database_num_rows($database->database_query("SELECT languagevar_id FROM se_languagevars WHERE languagevar_language_id=1 && languagevar_id=27003501 LIMIT 1")) )
  {
    $database->database_query("
      INSERT INTO `se_languagevars`
        (`languagevar_id`, `languagevar_language_id`, `languagevar_value`, `languagevar_default`)
      VALUES 
        (27003500, 1, 'Selected as Best Answer, Rating: ', 'profile'),
        (27003501, 1, 'Voted Best Answer, Rating: ', 'profile')
		ON DUPLICATE KEY UPDATE `languagevar_default`=`languagevar_default`
    ") or die("Insert Into se_languagevars: ".mysql_error());
  }
}  

?>