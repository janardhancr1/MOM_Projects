<?php

$page = "browse_questions";
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
if(isset($_POST['p'])) { $p = $_POST['p']; } elseif(isset($_GET['p'])) { $p = $_GET['p']; } else { $p = 1; }
if(isset($_POST['s'])) { $s = $_POST['s']; } elseif(isset($_GET['s'])) { $s = $_GET['s']; } else { $s = "question_time DESC"; }
if(isset($_POST['v'])) { $v = $_POST['v']; } elseif(isset($_GET['v'])) { $v = $_GET['v']; } else { $v = 0; }
if(isset($_POST['qacat_id'])) { $qacat_id = $_POST['qacat_id']; } elseif(isset($_GET['qacat_id'])) { $qacat_id = $_GET['qacat_id']; } else { $qacat_id = 0; }
if(isset($_POST['qtype'])) { $qtype = $_POST['qtype']; } elseif(isset($_GET['qtype'])) { $qtype = $_GET['qtype']; } else { $qtype = 0; }
if(isset($_POST['qsearch'])) { $qsearch = $_POST['qsearch']; } elseif(isset($_GET['qsearch'])) { $qsearch = $_GET['qsearch']; } else { $qsearch = 0; }

// ENSURE SORT/VIEW ARE VALID
if($s != "question_time DESC" && $s != "question_num_answers DESC") { $s = "question_time DESC"; }
if($v != "0" && $v != "1") { $v = 0; }


// SET WHERE CLAUSE
$where = "TRUE";


// GET ALL TOP CATEGORIES, AND THE CURRENT CAT (EVEN IF SUB-CAT)
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

//GET ALL OPEN Questions

if(!empty($qtype))
{
	if($qtype == "solved")
		$where .= " AND question_state=".QA_STATE_RESOLVED;
	else
		$where .= " AND question_state!=".QA_STATE_RESOLVED;
}

if(!empty($qsearch))
{
	$where .= " AND (se_vt_questions.question_title LIKE '%$qsearch%' OR
	    se_vt_questions.question_text LIKE '%$qsearch%')";
}

// CREATE QUESTION OBJECT
$qa = new se_qa();

// GET TOTAL QUESTIONS
$total_questions = $qa->question_total($where); 

// MAKE ENTRY PAGES
$questions_per_page = 10;
$page_vars = make_page($total_questions, $questions_per_page, $p);

// GET QUESTION ARRAY
$question_array = $qa->question_list($page_vars[0], $questions_per_page, $s, $where);

// SET GLOBAL PAGE TITLE
$global_page_title[0] = 27003176; 
$global_page_description[0] = 27003177;

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

// ASSIGN SMARTY VARIABLES AND DISPLAY GROUPS PAGE
$smarty->assign('qacat_id', $qacat_id);
$smarty->assign('qacat', $qacat);
$smarty->assign('qasubcat', $qasubcat);
$smarty->assign('questions', $question_array);
$smarty->assign('total_questions', $total_questions);
$smarty->assign('qacats', $qacats_array);
$smarty->assign('p', $page_vars[1]);
$smarty->assign('maxpage', $page_vars[2]);
$smarty->assign('p_start', $page_vars[0]+1);
$smarty->assign('p_end', $page_vars[0]+count($question_array));
$smarty->assign('s', $s);
$smarty->assign('v', $v);
$smarty->assign('qacats_ask', $qacats_ask_array);
include "footer.php";
?>