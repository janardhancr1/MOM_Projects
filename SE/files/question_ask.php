<?php

$page = "question_ask";
include "header.php";

// DISPLAY ERROR PAGE IF USER IS NOT LOGGED IN AND ADMIN SETTING REQUIRES REGISTRATION
if( (!$user->user_exists && !$setting['setting_permission_qa']) || ($user->user_exists && (~(int)$user->level_info['level_qa_allow'] & 1)) )
{
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 656);
  $smarty->assign('error_submit', 641);
  include "footer.php";
}


// PARSE GET/POST
if(isset($_POST['task'])) { $task = $_POST['task']; } elseif(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = ""; }

// CREATE QUESTION OBJECT
$qa = new se_qa();

// PERFORM TASK, IF REQUIRED
$cat_id = $_POST['question_catid'];
$subcat_id = $_POST['question_subcatid'];
if($task == "submit_question" && $cat_id > 0 ) {
	$qid = $qa->add_question($_POST['question_title'], $_POST['question_text'], $_POST['question_tags'], $cat_id, $subcat_id);
	header('location: question.php?user='.$user->user_info['user_username'].'&qid='.$qid);
} else {
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 828);
  $smarty->assign('error_submit', 641);
  include "footer.php";	
}

$error = 0;

// CATEGORIES 
$qacats_array = array();
$qasubcats_array = array();
$qacats_query=$database->database_query("SELECT vt_qacat_id, vt_qacat_title, vt_qacat_dependency FROM se_vt_qacats ORDER BY vt_qacat_title");
while( $qacat = $database->database_fetch_assoc($qacats_query) ) {
	if ($qacat['vt_qacat_dependency'] == 0) {
		$qacats_array[$qacat['vt_qacat_id']] = array(
			'cat_id' => $qacat['vt_qacat_id'],
			'cat_title' => $qacat['vt_qacat_title']
			);
	} else {
		$qacats_array[$qacat['vt_qacat_dependency']]['subcats'][] = array(
			'cat_id' => $qacat['vt_qacat_id'],
			'cat_title' => $qacat['vt_qacat_title']
			);
	}
}


// SET GLOBAL PAGE TITLE 
$global_page_title[0] = 27003430; 
$global_page_description[0] = 27003177;

// ASSIGN SMARTY VARIABLES AND DISPLAY PAGE
$smarty->assign('question', $question);
$smarty->assign('answers', $answers); 
$smarty->assign('user_answer_id', $user_answer_id); 
//$smarty->assign('cat_title', $cat_title);
//$smarty->assign('subcat_title', $subcat_title);
$smarty->assign('qacats', $qacats_array);
//$smarty->assign('qasubcats', $qasubcats_array);
$smarty->assign('error', $error);
include "footer.php";
?>