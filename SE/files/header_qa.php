<?php

// ENSURE THIS IS BEING INCLUDED IN AN SE SCRIPT
defined('SE_PAGE') or exit();

// DEFINE Q&A CONSTANTS
define('QA_STATE_NEW', 1);
define('QA_STATE_SELECTING', 2);
define('QA_STATE_UNDECIDED', 4);
define('QA_STATE_TIEBREAKER', 8);
define('QA_STATE_RESOLVED', 16);

// INCLUDE QUESTION CLASS FILE
include "./include/class_question.php";
include "./include/class_qa.php";

// INCLUDE QUESTION FUNCTION FILE
include "./include/functions_qa.php";


// PRELOAD LANGUAGE
SE_Language::_preload_multi(27003007, 27003123);

// SET MAIN MENU VARS
if( ($user->user_exists && $user->level_info['level_qa_allow']) || (!$user->user_exists && $setting['setting_permission_qa']))
{
  $plugin_vars['menu_main'] = Array('file' => 'browse_answers.php', 'title' => 27003123);
}

// SET USER MENU VARS
if( $user->user_exists && $user->level_info['level_qa_allow'] )
{
  $plugin_vars['menu_user'] = Array('file' => 'user_questions.php', 'icon' => 'qa_qa16.gif', 'title' => 27003123);
}

// START QUESTION
$qa = new se_qa($owner->user_info['user_id']);

// SET PROFILE MENU VARS
if($owner->level_info['level_qa_allow'] == 1 && $page == "profile" ) {

  
  $q_sort = "question_id DESC";

  // PLACE-HOLDER
  $q_where='';

  // GET TOTAL QUESTIONS
  $total_questions = $qa->question_total($q_where);
  
  // GET QUESTION ARRAY
  $questions = $qa->question_list(0, $total_questions, $q_sort, $q_where);

  // ASSIGN QUESTIONS SMARTY VARIABLE
  $smarty->assign('questions', $questions);
  $smarty->assign('total_questions', $total_questions);
  
  // GET ANSWERS LIST
  $answers_tmp = $qa->answer_list();
  
  // GET QUESTION ID LIST FOR ANSWERS, AND CREATE ASSOC ANSWER ARRAY
  for ($i=0;$i<sizeof($answers_tmp);$i++) {
  	$answer_q_ids[] = $answers_tmp[$i]['answer_q_id'];
	$answers_assoc[$answers_tmp[$i]['answer_q_id']] = $answers_tmp[$i];
  }
  
  // SET SORT ORDER
  $a_sort = "question_id DESC";

  // WHERE FOR GETTING ANSWERS
  $a_where=' question_id IN ('.implode(',',$answer_q_ids).')';

  // GET TOTAL QUESTIONS
  $total_answers = sizeof($answer_q_ids);
  
  // GET QUESTION ARRAY
  $answers = $qa->question_list(0, $total_answers, $a_sort, $a_where, TRUE);

  // ATTACH ANSWERS TO QUESTIONS
  for ($i=0;$i<sizeof($answers);$i++) {
  	$answers[$i]['question_user_answer'] = $answers_assoc[$answers[$i]['question_id']];
  }

  // ASSIGN QUESTIONS SMARTY VARIABLE
  $smarty->assign('answers', $answers);
  $smarty->assign('total_answers', $total_answers);

  // SET PROFILE MENU VARS
  if($total_questions != 0 || $total_answers != 0 ) {
      $plugin_vars['menu_profile_tab'] = Array('file'=> 'profile_qa_tab.tpl', 'title' => 27003007);
  }
}

// SELECT AN AD, IF ENABLED
if (!empty($setting['setting_qa_ad_ids'])) {
	$qa_tmp = explode(',',$setting['setting_qa_ad_ids']);
	$qa_ad_id=$qa_tmp[array_rand($qa_tmp)];
} else {
	$qa_ad_id = 0;
}
$smarty->assign('qa_ad_id', $qa_ad_id);

// SET SEARCH HOOK
if($page == "search")
  SE_Hook::register("se_search_do", 'search_qa');

// SET USER DELETION HOOK
//SE_Hook::register("se_user_delete", 'deleteuser_qa');


// SET SITE STATISTICS HOOK
SE_Hook::register("se_site_statistics", 'site_statistics_qa');


?>