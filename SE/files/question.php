<?php

$page = "question";
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

// DISPLAY ERROR PAGE IF NO OWNER
if( !$owner->user_exists )
{
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 828);
  $smarty->assign('error_submit', 641);
  include "footer.php";
}

// ENSURE ALBUMS ARE ENABLED FOR THIS USER
if( !$owner->level_info['level_qa_allow'] )
{
  header("Location: ".$url->url_create('profile', $owner->user_info[user_username]));
  exit();
}


// PARSE GET/POST
if(isset($_POST['qid'])) { $qid = $_POST['qid']; } elseif(isset($_GET['qid'])) { $qid = $_GET['qid']; } else { $qid = 0; }
if(isset($_POST['task'])) { $task = $_POST['task']; } elseif(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = ""; }
if(isset($_POST['bestanswer'])) { $bestanswer = $_POST['bestanswer']; } elseif(isset($_GET['bestanswer'])) { $bestanswer = $_GET['bestanswer']; } else { $bestanswer = 0; }
if(isset($_POST['aid'])) { $aid = $_POST['aid']; } elseif(isset($_GET['aid'])) { $aid = $_GET['aid']; } else { $aid = 0; }

// CREATE QUESTION OBJECT
$question = new se_question($qid);

// CREATE QUESTION OWNER USER
$question_owner = new SEuser(array($question->user_id,NULL,NULL));

// BE SURE QUESTION BELONGS TO THIS USER
//if($question->user_id != $owner->user_info[user_id]) { header("Location: ".$url->url_create('questions', $owner->user_info[user_username])); exit(); }

// PERFORM TASK, IF REQUIRED
if($task == "submit_answer") {
	$question->add_answer(nl2br(preg_replace('/(?<=\x20)\x20|\x20(?=\x20)|^\x20/','&nbsp;',censor($_POST['answer_text']))));
}

if($task == "edit_answer") {
	$question->edit_answer($aid,nl2br(preg_replace('/(?<=\x20)\x20|\x20(?=\x20)|^\x20/','&nbsp;',censor($_POST['answer_text']))));
}

if($task == "submit_best_answer") {
	if ($question_owner->user_info['user_id'] == $user->user_info['user_id']) {
		$question->set_best_answer($_POST['aid'], 1, $_POST['rating'],censor($_POST['comment_text']));
		// Re-create question, to get updated state etc.
		$question = new se_question($qid);
	}
}

$answers = $question->answer_list();
if (array_key_exists($user->user_info['user_id'],$question->authors)) {
	$user_answer_id = $question->authors[$user->user_info['user_id']];     // '0' IF USER HASN'T ANSWERED QUESTION
} else {
	$user_answer_id = 0;
}

// IF QUESTION IS RESOLVED, FIND THE BEST ANSWER, AND SEPARATE FROM ANSWERS LIST
if ($question->state == QA_STATE_RESOLVED) {
	for($i=0;$i<sizeof($answers);$i++) {
		if ($answers[$i]['answer_id'] == $question->best_answer_id) {
			$best_answer = $answers[$i];
			$smarty->assign('best_answer', $best_answer);
			array_splice($answers,$i,1);
		}
	}
}

$error = 0;

// BREADCRUMB NAVIGATION
//$cats_query = $database->database_query("SELECT vt_qacat_id, vt_qacat_title, vt_qacat_dependency FROM se_vt_qacats WHERE vt_qacat_id='".$question->cat_id."' OR vt_qacat_id='".$question->subcat_id."' LIMIT 2");
//while ($cat = $database->database_fetch_assoc($cats_query)) {
//	if ($cat['vt_qacat_id'] == $question->cat_id) $cat_title = $cat['vt_qacat_title'];
//	if ($cat['vt_qacat_id'] == $question->subcat_id) $subcat_title = $cat['vt_qacat_title'];
//}

// UPDATE NOTIFICATIONS
if($user->user_info[user_id] == $owner->user_info[user_id]) {
  $database->database_query("DELETE FROM se_notifys USING se_notifys LEFT JOIN se_notifytypes ON se_notifys.notify_notifytype_id=se_notifytypes.notifytype_id WHERE se_notifys.notify_user_id='".$owner->user_info[user_id]."' AND se_notifytypes.notifytype_name='newanswer' AND notify_object_id='".$qid."'");
}
if($bestanswer==1) {
	$database->database_query("DELETE FROM se_notifys USING se_notifys LEFT JOIN se_notifytypes ON se_notifys.notify_notifytype_id=se_notifytypes.notifytype_id WHERE se_notifys.notify_user_id='".$user->user_info[user_id]."' AND se_notifytypes.notifytype_name='bestanswer' AND notify_object_id='".$qid."'");
}


// GET ALL TOP CATEGORIES, AND THE CURRENT CAT (EVEN IF SUB-CAT)
$qacat_id=$question->subcat_id;
$qatopcats_array = array();
$qacats_query=$database->database_query("SELECT vt_qacat_id, vt_qacat_title, vt_qacat_dependency FROM se_vt_qacats WHERE vt_qacat_dependency='0' OR vt_qacat_id='".$qacat_id."' ORDER BY vt_qacat_order ");
while( $qacat = $database->database_fetch_assoc($qacats_query) ) {
	if ($qacat['vt_qacat_id'] == $qacat_id) {
		$curr_cat = $qacat;
		if ($qacat['vt_qacat_dependency'] == 0) {
			$topcat = 1;		
		} else {
			$topcat = 0;
		}
	}
	if ($qacat['vt_qacat_dependency'] == 0) {
		$qatopcats_array[] = array(
			'cat_id' => $qacat['vt_qacat_id'],
			'cat_title' => $qacat['vt_qacat_title'],
			'cat_class' => 'top_cat'
			);
	}
}
	
// SPECIFIC Q&A CATEGORY
$qasubcats_array = array();
if ($qacat_id > 0) {
	if ($topcat == 0) {   // SUB-CATEGORY
		$where .= " AND se_vt_questions.question_subcat_id='{$qacat_id}'";
		$qasubcat_dependency = $curr_cat['vt_qacat_dependency'];
	} else {  // TOP CAT
        $where .= " AND se_vt_questions.question_cat_id='{$qacat_id}'";	
		$qasubcat_dependency = $qacat_id;
	}
//	$qacat = $database->database_fetch_assoc($database->database_query("SELECT vt_qacat_id, vt_qacat_title FROM se_vt_qacats WHERE vt_qacat_dependency='".$qasubcat_dependency."'  LIMIT 1"));
	$qasubcats_query=$database->database_query("SELECT vt_qacat_id, vt_qacat_title FROM se_vt_qacats WHERE vt_qacat_dependency='".$qasubcat_dependency."' ORDER BY vt_qacat_order");
	while( $qasubcat = $database->database_fetch_assoc($qasubcats_query) ) {
		$cat_class = 'sub_cat';
		if ($qasubcat['vt_qacat_id'] == $qacat_id) $cat_class = 'sub_cat_selected';	
		$qasubcats_array[] = array(
			'cat_id' => $qasubcat['vt_qacat_id'],
			'cat_title' => $qasubcat['vt_qacat_title'],
			'cat_class' => $cat_class
			);
	}
}

// PUT TOGETHER FINAL CATEGORY LIST
$qacats_array = array();
for ($i=0;$i<sizeof($qatopcats_array);$i++) {
	$qacats_array[] = $qatopcats_array[$i];
	if ($qatopcats_array[$i]['cat_id'] == $qasubcat_dependency) {
		// INSERT SUB-CATEGORIES
		for ($j=0;$j<sizeof($qasubcats_array);$j++) {
			$qacats_array[] = $qasubcats_array[$j];
		}
	}
}




// UPDATE VIEWS, IF NOT OWN QUESTION
if ($question_owner->user_info['user_id'] != $user->user_info['user_id']) {
	$database->database_query("UPDATE se_vt_questions SET question_views=question_views+1 WHERE question_id='".$question->q_id."' LIMIT 1");
}

// SELECT AN AD, IF ENABLED
if (!empty($setting['setting_qa_ad_ids'])) {
	$qa_tmp = explode(',',$setting['setting_qa_ad_ids']);
	$qa_ad_id=$qa_tmp[array_rand($qa_tmp)];
} else {
	$qa_ad_id = 0;
}

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

// SET GLOBAL PAGE TITLE 
$global_page_title[0] = 27003409; 
$global_page_title[1] = $question->title; 
$global_page_description[0] = 27003177;

// ASSIGN SMARTY VARIABLES AND DISPLAY GROUPS PAGE
$smarty->assign('question', $question);
$smarty->assign('answers', $answers); 
$smarty->assign('user_answer_id', $user_answer_id); 
$smarty->assign('question_owner', $question_owner); 
$smarty->assign('qa_ad_id', $qa_ad_id);
//$smarty->assign('cat_title', $cat_title);
//$smarty->assign('subcat_title', $subcat_title);
$smarty->assign('qacats', $qacats_array);
$smarty->assign('error', $error);
include "footer.php";
?>