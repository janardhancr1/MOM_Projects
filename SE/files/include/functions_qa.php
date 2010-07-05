<?php

defined('SE_PAGE') or exit();


//
//  THIS FILE CONTAINS Q&A-RELATED FUNCTIONS
//
//  FUNCTIONS IN THIS CLASS:
//
//    search_qa()
//    site_statistics_qa()
//    qa_truncate()
//    qa_br2nl()
//    qa_nbsp2space()
//    qa_state_name()
//    time_until()






// THIS FUNCTION IS RUN DURING THE SEARCH PROCESS TO SEARCH THROUGH QUESTIONS AND ANSWERS
// INPUT: 
// OUTPUT: 
function search_qa() {
	global $database, $url, $results_per_page, $p, $search_text, $t, $search_objects, $results, $total_results, $datetime;

	// MAKE QUESTION PAGES
	$start = ($p - 1) * $results_per_page;
	$limit = $results_per_page+1;

	// CONSTRUCT QUERY
	$qa_query_q = "SELECT SQL_CALC_FOUND_ROWS
	  se_vt_questions.question_id,
	  se_vt_questions.question_title,
	  se_vt_questions.question_text,
	  se_vt_questions.question_subcat_id,
	  se_vt_questions.question_time,
	  se_vt_questions.question_num_answers,
	  se_vt_questions.question_state, 
	  se_vt_qacats.vt_qacat_title, 	 
	  se_users.user_id,
	  se_users.user_username,
	  se_users.user_photo,
	  se_users.user_fname,
	  se_users.user_lname
	FROM
	  se_vt_questions
	LEFT JOIN
	  se_users
	ON
	  se_vt_questions.question_user_id=se_users.user_id 
	LEFT JOIN 
	  se_vt_qacats
	ON
	  se_vt_questions.question_subcat_id=se_vt_qacats.vt_qacat_id 	  
	WHERE
	    se_vt_questions.question_title LIKE '%$search_text%' OR
	    se_vt_questions.question_text LIKE '%$search_text%'
	ORDER BY question_id DESC LIMIT $start, $limit"; 

	// SEARCH QUESTIONS
	$questions = $database->database_query($qa_query_q);

	// GET TOTAL RESULTS
	$total_questions_assoc = $database->database_fetch_assoc($database->database_query("SELECT FOUND_ROWS() AS num_questions"));
	$total_questions = $total_questions_assoc['num_questions'];
	
	// IF NOT TOTAL ONLY
	if($t == "question") {

	  SE_Language::_preload_multi(27003118, 27003119, 27003120, 27003121);
	  SE_Language::load();
	  $qa_status_str = SE_Language::_get(27003120);

	  while($question_info = $database->database_fetch_assoc($questions)) {

		// CREATE AN OBJECT FOR USER
		$profile = new se_user();
		$profile->user_info[user_id] = $question_info[user_id];
		$profile->user_info[user_username] = $question_info[user_username];
		$profile->user_info[user_fname] = $question_info[user_fname];
		$profile->user_info[user_lname] = $question_info[user_lname];
		$profile->user_info[user_photo] = $question_info[user_photo];
		$profile->user_displayname();
		
		// RESULT IS A QUESTION
		//if($question_info[sub_type] == 1) {
		  $result_url = $url->url_create('question', '', $question_info[user_username], $question_info[question_id]);
		  $result_name = 27003119;
		  $result_desc = 27003121;
		
		//}
		
		SE_Language::_preload($question_info[vt_qacat_title]);
		SE_Language::load();
		$qa_cat_title = SE_Language::_get($question_info[vt_qacat_title]);

		$question_since_arr = $datetime->time_since($question_info[question_time]);
		$question_since = str_replace('%1$d', $question_since_arr[1], SE_Language::_get($question_since_arr[0]));
		
		$question_status = str_replace('%1$s', $url->url_create('question_cat',  '', $question_info[question_subcat_id],$qa_cat_title), $qa_status_str);
		$question_status = str_replace('%2$s', $qa_cat_title, $question_status);
		$question_status = str_replace('%3$s', $url->url_create('profile', $question_info[user_username]), $question_status);
		$question_status = str_replace('%4$s', $profile->user_displayname, $question_status);
		$question_status = str_replace('%5$s', $question_since, $question_status);
		$question_status = str_replace('%6$s', $question_info[question_num_answers], $question_status);
		$question_status = str_replace('%7$s', qa_state_name($question_info[question_state]), $question_status);

//				'result_desc_1' => $url->url_create('profile', $question_info[user_username]),
//				'result_desc_2' => $profile->user_displayname,
//				'result_desc_3' => $question_info[question_text]
		
		$results[] = Array('result_url' => $result_url,
				'result_icon' => $profile->user_photo('./images/nophoto.gif'),
				'result_name' => $result_name,
				'result_name_1' => $question_info[question_title],
				'result_desc' => $result_desc,
				'result_desc_1' => $question_info[question_text],
				'result_desc_2' => $question_status,
				'result_desc_3' => ''
				);
	  }

	  // SET TOTAL RESULTS
	  $total_results = $total_questions;

	}

	// SET ARRAY VALUES
	if($total_questions > 200) { $total_questions = "200+"; }
	$search_objects[] = Array('search_type' => 'question',
				'search_lang' => 27003118,
				'search_total' => $total_questions);

} // END search_qa() FUNCTION




// THIS FUNCTION IS RUN WHEN GENERATING SITE STATISTICS
// INPUT: 
// OUTPUT: 
function site_statistics_qa(&$args)
{
  global $database;
  
  $statistics =& $args['statistics'];
  
  // NOTE: CACHING WILL BE HANDLED BY THE FUNCTION THAT CALLS THIS
  
  $total = $database->database_fetch_assoc($database->database_query("SELECT COUNT(question_id) AS total FROM se_vt_questions"));
  $statistics['questions'] = array(
    'title' => 27003172,
    'stat'  => (int) ( isset($total['total']) ? $total['total'] : 0 )
  );
  
  $total = $database->database_fetch_assoc($database->database_query("SELECT COUNT(answer_id) AS total FROM se_vt_answers"));
  $statistics['answers'] = array(
    'title' => 27003174,
    'stat'  => (int) ( isset($total['total']) ? $total['total'] : 0 )
  );
  
}

// END site_statistics_qa() FUNCTION


function qa_truncate($string, $max = 20, $replacement = '')
{
    if (strlen($string) <= $max)
    {
        return $string;
    }
    $leave = $max - strlen ($replacement);
    return substr_replace($string, $replacement, $leave);
}

function qa_br2nl($str) {
  $str = preg_replace("/(\r\n|\n|\r)/", "", $str);
  return preg_replace("=<br */?>=i", "\n", $str);
}

function qa_nbsp2space($str) {
  return  preg_replace("/&nbsp;/", " ", $str);
}

function qa_state_name($state) {
	switch($state) {
		case (QA_STATE_NEW) :
			return SE_Language::_get(27003414);
		break;
		case (QA_STATE_SELECTING) :
			return SE_Language::_get(27003414);
		break;
		case (QA_STATE_UNDECIDED) :
			return SE_Language::_get(27003417);
		break;
		case (QA_STATE_TIEBREAKER) :
			return SE_Language::_get(27003418);
		break;
		case (QA_STATE_RESOLVED) :
			return SE_Language::_get(27003415);
		break;
		default:
			return '';
		break;
	}
}

// THIS METHOD RETURNS A STRING SPECIFYING THE TIME UNTIL THE SPECIFIED TIMESTAMP, BASED ON TIME_SINCE() FUNCTION
// INPUT: $time REPRESENTING A TIMESTAMP
// OUTPUT: A STRING SPECIFYING THE TIME UNTIL THE SPECIFIED TIMESTAMP
function time_until($time1,$time2=0) {
	$time = $time1+$time2;

  $now = time();
  $now_day = date("j", $now);
  $now_month = date("n", $now);
  $now_year = date("Y", $now);

  $time_day = date("j", $time);
  $time_month = date("n", $time);
  $time_year = date("Y", $time);
  $time_since = "";
  $lang_var = 0;

  switch(TRUE) {
  
	case ($time-$now < 60):
	  // RETURNS SECONDS
	  $seconds = $time-$now;
	  $time_since = $seconds;
	  $lang_var = 27003440;
	  break;
	case ($time-$now < 3600):
	  // RETURNS MINUTES
	  $minutes = round(($time-$now)/60);
	  $time_since = $minutes;
	  $lang_var = 27003441;
	  break;
	case ($time-$now < 86400):
	  // RETURNS HOURS
	  $hours = round(($time-$now)/3600);
	  $time_since = $hours;
	  $lang_var = 27003442;
	  break;
	case ($time-$now < 1209600):
	  // RETURNS DAYS
	  $days = round(($time-$now)/86400);
	  $time_since = $days;
	  $lang_var = 27003443;
	  break;
	case (mktime(0, 0, 0, $now_month-1, $now_day, $now_year) < mktime(0, 0, 0, $time_month, $time_day, $time_year)):
	  // RETURNS WEEKS
	  $weeks = round(($time-$now)/604800);
	  $time_since = $weeks;
	  $lang_var = 27003444;
	  break;
	case (mktime(0, 0, 0, $now_month, $now_day, $now_year-1) < mktime(0, 0, 0, $time_month, $time_day, $time_year)):
	  // RETURNS MONTHS
	  if($now_year == $time_year) { $subtract = 0; } else { $subtract = 12; }
	  $months = round($now_month-$time_month+$subtract);
	  $time_since = $months;
	  $lang_var = 27003445;
	  break;
	default:
	  // RETURNS YEARS
	  if($now_month < $time_month) { 
		$subtract = 1; 
	  } elseif($now_month == $time_month) {
		if($now_day < $time_day) { $subtract = 1; } else { $subtract = 0; }
	  } else { 
		$subtract = 0; 
	  }
	  $years = $now_year-$time_year-$subtract;
	  $time_since = $years;
	  $lang_var = 27003446;
	  if($years == 0) { $time_since = ""; $lang_var = 0; }
	  break;

  }

  return Array($lang_var, $time_since);

} // END time_since() METHOD


?>