<?php

$page = "user_questions";
include "header.php";


// ENSURE QUESTONS ARE ENABLED FOR THIS USER
if($user->level_info[level_qa_allow] == 0) { header("Location: user_home.php"); exit(); }

// PARSE GET/POST
if(isset($_POST['task'])) { $task = $_POST['task']; } elseif(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = "main"; }
if(isset($_POST['p_q'])) { $p_q = $_POST['p_q']; } elseif(isset($_GET['p_q'])) { $p_q = $_GET['p_q']; } else { $p_q = 1; }
if(isset($_POST['s_q'])) { $s_q = $_POST['s_q']; } elseif(isset($_GET['s_q'])) { $s_q = $_GET['s_q']; } else { $s_q = "question_time DESC"; }
if(isset($_POST['v_q'])) { $v_q = $_POST['v_q']; } elseif(isset($_GET['v_q'])) { $v_q = $_GET['v_q']; } else { $v_q = 0; }
if(isset($_POST['p_a'])) { $p_a = $_POST['p_a']; } elseif(isset($_GET['p_a'])) { $p_a = $_GET['p_a']; } else { $p_a = 1; }
if(isset($_POST['s_a'])) { $s_a = $_POST['s_a']; } elseif(isset($_GET['s_a'])) { $s_a = $_GET['s_a']; } else { $s_a = "question_time DESC"; }
if(isset($_POST['v_a'])) { $v_a = $_POST['v_a']; } elseif(isset($_GET['v_a'])) { $v_a = $_GET['v_a']; } else { $v_a = 0; }
if(isset($_POST['t'])) { $t = $_POST['t']; } elseif(isset($_GET['t'])) { $t = $_GET['t']; } else { $t = 0; }

// ENSURE SORT/VIEW ARE VALID
if($s_q != "question_time DESC" && $s_q != "question_num_answers DESC") { $s_q = "question_time DESC"; }
if($v_q != "0" && $v_q != "1") { $v_q = 0; }
if($s_a != "question_time DESC" && $s_a != "question_num_answers DESC") { $s_a = "question_time DESC"; }
if($v_a != "0" && $v_a != "1") { $v_a = 0; }

// BE SURE QUESTION BELONGS TO THIS USER, DELETE QUESTION
if($task == "delete_question") {
	// To do. 
}

// BE SURE ANSWER BELONGS TO THIS USER, DELETE ANSWER
if($task == "delete_answer") {
	// To do. 
}


// START QUESTION
$qa = new se_qa($user->user_info['user_id']);

// SET WHERE CLAUSE
$where_q = "TRUE";

// GET TOTAL QUESTIONS
$total_questions = $qa->question_total($where_q);

// MAKE ENTRY PAGES
$questions_per_page = 10; 
$page_vars_q = make_page($total_questions, $questions_per_page, $p_q);
 
// GET QUESTION ARRAY
$questions = $qa->question_list($page_vars_q[0], $questions_per_page, $s_q, $where_q);

// GET ANSWERS LIST
$answers_tmp = $qa->answer_list();

// GET QUESTION ID LIST FOR ANSWERS, AND CREATE ASSOC ANSWER ARRAY
for ($i=0;$i<sizeof($answers_tmp);$i++) {
	$answer_q_ids[] = $answers_tmp[$i]['answer_q_id'];
	$answers_assoc[$answers_tmp[$i]['answer_q_id']] = $answers_tmp[$i];
}

// GET TOTAL ANSWERS
$total_answers = sizeof($answer_q_ids);

// MAKE ENTRY PAGES
$answers_per_page = 10;
$page_vars_a = make_page($total_answers, $answers_per_page, $p_a);

// WHERE FOR GETTING ANSWERS
$where_a=' question_id IN ('.implode(',',$answer_q_ids).')';

// GET ANSWERS ARRAY
$answers = $qa->question_list($page_vars_a[0], $answers_per_page, $s_a, $where_a, TRUE);

// ATTACH ANSWERS TO QUESTIONS
for ($i=0;$i<sizeof($answers);$i++) {
	$answers[$i]['question_user_answer'] = $answers_assoc[$answers[$i]['question_id']];
}

// ASKING CATEGORIES 
$qacats_ask_array = array();
$qacats_ask_query=$database->database_query("SELECT vt_qacat_id, vt_qacat_title, vt_qacat_dependency FROM se_vt_qacats ORDER BY vt_qacat_title");
while( $qacat_ask = $database->database_fetch_assoc($qacats_ask_query) ) {
	if ($qacat_ask['vt_qacat_dependency'] == 0) {
		$qacats_ask_array[$qacat_ask['vt_qacat_id']] = array(
			'cat_id' => $qacat_ask['vt_qacat_id'],
			'cat_title' => $qacat_ask['vt_qacat_title']
			);
	} else {
		$qacats_ask_array[$qacat_ask['vt_qacat_dependency']]['subcats'][] = array(
			'cat_id' => $qacat_ask['vt_qacat_id'],
			'cat_title' => $qacat_ask['vt_qacat_title']
			);
	}
}

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

// ASSIGN QUESTIONS SMARTY VARIABLE
$smarty->assign('questions', $questions);
$smarty->assign('total_questions', $total_questions);
$smarty->assign('p_q', $page_vars_q[1]);
$smarty->assign('maxpage_q', $page_vars_q[2]);
$smarty->assign('p_start_q', $page_vars_q[0]+1);
$smarty->assign('p_end_q', $page_vars_q[0]+count($questions));
$smarty->assign('s_q', $s_q);
$smarty->assign('v_q', $v_q);
$smarty->assign('answers', $answers);
$smarty->assign('total_answers', $total_answers);
$smarty->assign('p_a', $page_vars_a[1]);
$smarty->assign('maxpage_a', $page_vars_a[2]);
$smarty->assign('p_start_a', $page_vars_a[0]+1);
$smarty->assign('p_end_a', $page_vars_a[0]+count($questions));
$smarty->assign('s_a', $s_a);
$smarty->assign('v_a', $v_a);
$smarty->assign('t', $t);
$smarty->assign('qacats_ask', $qacats_ask_array);
include "footer.php";
?>