<?php

// DEFINE SE PAGE CONSTANT
define('SE_PAGE', TRUE);

if (!function_exists('json_encode')) {
  function json_encode($a=false)
  {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_encode($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
      return '{' . join(',', $result) . '}';
    }
  }
}

include "header.php";

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

// RETRIEVE REQUIRED VARIABLES
if(isset($_GET['qa_id'])) { $qa_id = $_GET['qa_id']; } else { $qa_id = 0; }
if(isset($_GET['qa_type'])) { $qa_type = $_GET['qa_type']; } else { $qa_type = 0; }
if(isset($_GET['qa_rating'])) { $qa_rating = (int)$_GET['qa_rating']; } else { $qa_rating = 0; }
if(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = "main"; }

// EXIT IF USER IS NOT LOGGED IN
$qa_rating_allowed = 1;
$qa_has_rated = 0;
if($user->user_exists == 0) { $qa_rating_allowed = 0; }

// DO NOT ALLOW USER TO VOTE ON HIS OWN ITEM
//if($user->user_info[user_id] == $owner->user_info[user_id]) { $qa_rating_allowed = 0; }

// EXIT IF VARIABLES AREN'T VALID
switch($qa_type) {
case 'question':
	$qa_table = 'se_vt_questions';
	$qa_column_prefix = 'question';
	break;
case 'answer':
	$qa_table = 'se_vt_answers';
	$qa_column_prefix = 'answer';
	break;
default:
	echo json_encode(array('error' => 'Incorrect Parameters Specified')); 
	exit(); 
	break;
}

// RETRIEVE RATING ROW
if ($qa_type == 'answer') {
	$qa_rating_query = $database->database_query("SELECT se_vt_answers.*, se_vt_questions.question_state FROM se_vt_answers LEFT JOIN se_vt_questions ON se_vt_questions.question_id=se_vt_answers.answer_q_id WHERE se_vt_answers.answer_id='".$qa_id."' LIMIT 1");
} else {
	$qa_rating_query = $database->database_query("SELECT * FROM ".$qa_table." WHERE ".$qa_column_prefix."_id='".$qa_id."' LIMIT 1");
}
if($database->database_num_rows($qa_rating_query) != 1) {
	echo json_encode(array('error' => 'Incorrect Parameters Specified. Unknown question/answer ID.')); 
	exit(); 
} else {
  $qa_rating_info = $database->database_fetch_assoc($qa_rating_query);
}

// RETRIEVE RATERS ARRAY
$raters = explode(",", trim($qa_rating_info[$qa_column_prefix.'_rating_raters']));
if(in_array($user->user_info[user_id], $raters)) { 
	$qa_rating_allowed = 0; 
	$qa_has_rated = 1;
}

$reload = 0;

// IF RATING IS ALLOWED AND RATING IS WITHIN THE CORRECT PARAMETERS
if($task == "rate" && $qa_rating_allowed != 0 && $qa_rating <= $setting['setting_qa_max_rating'] && $qa_rating >= 0) {

  // UPDATE RATING INFO
    $new_total_qa_ratings = $qa_rating_info[$qa_column_prefix.'_rating_raters_num']+1;
    $new_qa_rating = round(($qa_rating_info[$qa_column_prefix.'_rating_value']*$qa_rating_info[$qa_column_prefix.'_rating_raters_num']+$qa_rating)/$new_total_qa_ratings, 2);
    $new_qa_raters = $qa_rating_info[$qa_column_prefix.'_rating_raters'].",".$user->user_info[user_id];
    $database->database_query("UPDATE ".$qa_table." SET ".$qa_column_prefix."_rating_value='$new_qa_rating', ".$qa_column_prefix."_rating_raters_num='$new_total_qa_ratings', ".$qa_column_prefix."_rating_raters='$new_qa_raters' WHERE ".$qa_column_prefix."_id='".$qa_id."'");

	// IF THE RATING IS FOR A TIE-BREAKER QUESTION, UPDATED STATE
	if ($qa_type == 'answer' && $qa_rating_info['question_state'] == QA_STATE_TIEBREAKER) {
		$question = new se_question($qa_rating_info['answer_q_id']);
		$question->check_state();
		$reload = 1;
	}

}
	
$arr= array('qa_rating_value' => $new_qa_rating, 
			'qa_rating_total' => $new_total_qa_ratings,
			'qa_rating_allowed' => $qa_rating_allowed,
			'qa_has_rated' => $qa_has_rated,
			'qa_reload' => $reload,
			'error' => ''			
		);


echo json_encode($arr);

?>
