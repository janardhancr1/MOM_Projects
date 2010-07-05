<?php

defined('SE_PAGE') or exit();

//
//  THIS CLASS CONTAINS QUESTION RELATED METHODS 
//
//  METHODS IN THIS CLASS:
//
//    se_question()
//    set_user_id()
//    delete_question()
//    answer_list()
//    add_answer()
//    check_state()
//    change_state()

class se_question
{
	// INITIALIZE VARIABLES
	var $is_error;			// DETERMINES WHETHER THERE IS AN ERROR OR NOT

	var $cat_id;
	var $subcat_id;
	var $user_id;			// CONTAINS THE USER ID OF THE USER WHICH ASKED THE QUESTION
	var $user_username;		// CONTAINS THE USERNAME OF THE USER WHICH ASKED THE QUESTION
	var $title;
	var $text;
	var $time;
	var $ttl;
	var $views;
	var $state;
	var $state_lang_id;
	var $num_answers;
	var $best_answer_id;
	var $best_answer_rating;
	var $best_answer_comment;
	var $best_answer_selected;

	var $q_id;              // ID OF SPECIFIC QUESTION

	var $authors;           // ARRAY LINKING USER_IDS (FOR USERS THAT HAVE ANSWERED THIS QUESTION) WITH ANSWER IDS

	// THIS METHOD SETS INITIAL VARS
	// INPUT: $q_id (OPTIONAL) REPRESENTING THE ID OF THE QURESTION WE ARE CONCERNED WITH
	// OUTPUT: 
  
	function se_question($q_id = 0) {
	  $this->q_id = $q_id;
	  if ($q_id > 0) {		// RETRIEVE QUESTION INFO
	  	global $database;
		$sql = "SELECT se_vt_questions.*, se_users.user_username FROM se_vt_questions LEFT JOIN se_users ON se_vt_questions.question_user_id=se_users.user_id WHERE question_id='".$q_id."' LIMIT 1";
		$resource = $database->database_query($sql);
		$question_info = $database->database_fetch_assoc($resource);
		$this->cat_id = $question_info['question_cat_id'];
		$this->subcat_id = $question_info['question_subcat_id'];
		$this->user_id = $question_info['question_user_id'];
		$this->user_username = $question_info['user_username'];
		$this->title = $question_info['question_title'];
		$this->text = $question_info['question_text'];
		$this->time = $question_info['question_time'];
		$this->ttl = $question_info['question_ttl'];
		$this->views = $question_info['question_views'];
		$this->state = $question_info['question_state'];
		switch($question_info['question_state']) {
		case QA_STATE_NEW:
			$this->state_lang_id = 27003414;
			break;
		case QA_STATE_SELECTING:
			$this->state_lang_id = 27003414;
			break;
		case QA_STATE_UNDECIDED:
			$this->state_lang_id = 27003417;
			break;
		case QA_STATE_TIEBREAKER:
			$this->state_lang_id = 27003418;
			break;
		case QA_STATE_RESOLVED:
			$this->state_lang_id = 27003415;
			break;
		default:
			$this->state_lang_id = 27003414;
			break;
		}
		$this->num_answers = $question_info['question_num_answers'];
		$this->best_answer_id = $question_info['question_best_answer_id'];
		$this->best_answer_rating = $question_info['question_best_answer_rating'];
		$this->best_answer_comment = $question_info['question_best_answer_comment'];		
		$this->best_answer_selected = $question_info['question_best_answer_selected'];		
	  }
	}
  
  // END se_question() METHOD



	// SETTER FOR USER ID
	// INPUT: $user_id REPRESENTING THE USER ID OF THE USER WHOSE QUESTION WE ARE CONCERNED WITH
	function set_user_id($user_id) {
	  $this->user_id = $user_id;	
	}


	// DELETE THIS QUESTION
	function delete_question() {
		global $database;
		$sql = "DELETE FROM se_vt_questions WHERE question_id='".$this->q_id."' LIMIT 1";
		$resource = $database->database_query($sql);						
		$sql = "DELETE FROM se_vt_answers WHERE answer_q_id='".$this->q_id."' LIMIT 1";
		$resource = $database->database_query($sql);							
	}

  // GET LIST OF ANSWERS FOR A SPECIFIC QUESTION
  function answer_list($where = '', $order = '') {
  	global $database, $user;
	$sql = "SELECT se_vt_answers.*, se_users.user_username, se_users.user_fname, se_users.user_lname, se_users.user_displayname, se_users.user_photo FROM se_vt_answers LEFT JOIN se_users ON se_users.user_id=se_vt_answers.answer_user_id WHERE se_vt_answers.answer_q_id='".$this->q_id."' ";
	if ($where != '') {
		$sql .= ' AND '.$where;
	}
	if ($order != '') {
		$sql .= ' '.$order;
	}
	$resource = $database->database_query($sql);
	$answers = array();
	$authors = array();
	while( $answer_info = $database->database_fetch_assoc($resource) ) {
		$author = new se_user();
		$author->user_info['user_id'] = $answer_info['answer_user_id'];
		$author->user_info['user_username'] = $answer_info['user_username'];
		$author->user_info['user_fname'] = $answer_info['user_fname'];
		$author->user_info['user_lname'] = $answer_info['user_lname'];
		$author->user_info['user_photo'] = $answer_info['user_photo'];
		$author->user_displayname();
		$answer_info['author'] = $author;
		$answer_info['answer_id'] = $answer_info['answer_id'];
		$answer_info['has_rated'] = in_array($user->user_info['user_id'] , explode(",", trim($answer_info['answer_rating_raters']))) && $user->user_exists == 1 ? 1 : 0 ;
		$answer_info['rating_allowed'] = in_array($user->user_info['user_id'] , explode(",", trim($answer_info['answer_rating_raters']))) || $user->user_info['user_id'] == $answer_info['answer_user_id'] ? 0 : 1 ;
		$answers[] = $answer_info;
		$this->authors[$answer_info['answer_user_id']] = $answer_info['answer_id'];
	}
	return $answers;
	var_dump($answers);
  }
  
  // ADD AN ANSWER TO THIS QUESTION 
  function add_answer($answer_text) {
  	global $database, $user, $owner, $actions, $notify, $url;

    // PROCEED IF USER EXISTS
	if( $user->user_exists ) {

		// CHECK IF USER HAS ALREADY ANSWERED (DOUBLE POSITNG, E.G. PAGE RELOAD)
		$sql = "SELECT answer_id FROM se_vt_answers WHERE answer_q_id='".$this->q_id."' AND answer_user_id='".$user->user_info['user_id']."' LIMIT 1";
		$resource = $database->database_query($sql);
		if ($database->database_num_rows($resource) == 0) {

			// INSERT ANSWER
			$sql = "INSERT INTO se_vt_answers SET answer_q_id='".$this->q_id."', answer_user_id='".$user->user_info['user_id']."', answer_text='".$answer_text."', answer_time='".time()."'";
			$resource = $database->database_query($sql);
			$answer_id = $database->database_insert_id();
			$sql = "UPDATE se_vt_questions SET question_num_answers=question_num_answers+1 WHERE question_id='".$this->q_id."'";
			$resource = $database->database_query($sql);
			$sql = "SELECT user_username, user_fname, user_lname, user_displayname, user_photo FROM se_users WHERE user_id='".$this->user_id."' LIMIT 1";
			$resource = $database->database_query($sql);
			$q_author_info = $database->database_fetch_assoc($resource);
			$q_author = new se_user();
			$q_author->user_info['user_id'] = $q_author_info['answer_user_id'];
			$q_author->user_info['user_username'] = $q_author_info['user_username'];
			$q_author->user_info['user_fname'] = $q_author_info['user_fname'];
			$q_author->user_info['user_lname'] = $q_author_info['user_lname'];
			$q_author->user_info['user_photo'] = $q_author_info['user_photo'];
			$q_author->user_displayname();
			$actions->actions_add($user, "newanswer", Array($user->user_info['user_username'], $user->user_displayname, $q_author->user_info['user_username'], $q_author->user_displayname, $this->title, $this->q_id, qa_truncate($answer_text,200,'...'), $answer_id), Array(), 0, false, "user", $user->user_info['user_id'], $user->user_info['user_privacy']);
			
			// ADD NOTIFICATION
			$notifytype = $notify->notify_add(
				$owner->user_info['user_id'],
				"newanswer",
				$this->q_id,
				Array(
					$owner->user_info['user_username'],
					$this->q_id,
					$answer_id
				),
				Array(
					$this->title
				)
			);
			$question_url = $url->url_base.vsprintf($notifytype['notifytype_url'], Array($this->user_username, $this->q_id, $answer_id));
			$owner->user_settings();
			if( $owner->usersetting_info['usersetting_notify_newanswer'] ) {
				send_systememail("newanswer", $owner->user_info['user_email'], Array($owner->user_displayname, $user->user_displayname, "<a href=\"$question_url\">$question_url</a>"));
			}
		}		
	}	
  }
  
   // EDIT AN ANSWER FOR THIS QUESTION 
  function edit_answer($answer_id, $answer_text) {
  	global $database, $user, $owner, $actions, $notify, $url;

    // PROCEED IF USER EXISTS
	if( $user->user_exists ) {

		// CHECK THAT ANSWER IS USERS
		$sql = "SELECT answer_id FROM se_vt_answers WHERE answer_id='".$answer_id."' AND answer_user_id='".$user->user_info['user_id']."' LIMIT 1";
		$resource = $database->database_query($sql);
		if ($database->database_num_rows($resource) == 1) {

			// UPDATE ANSWER
			$sql = "UPDATE se_vt_answers SET answer_text='".$answer_text."' WHERE answer_id='".$answer_id."' LIMIT 1";
			$resource = $database->database_query($sql);
		}		
	}	
  }

  function set_best_answer($answer_id, $answer_selected, $rating, $comment = '') {
  	global $database, $notify, $url;

	// Set best answer values, change state to QA_STATE_RESOLVED
	$sql = "UPDATE se_vt_questions SET question_best_answer_id='".$answer_id."', question_best_answer_rating='".$rating."' , question_best_answer_comment='".$comment."', question_best_answer_selected='".$answer_selected."', question_state='".QA_STATE_RESOLVED."' WHERE question_id='".$this->q_id."' LIMIT 1";
	$database->database_query($sql);		  				

  	// Get answer info
	$sql = "SELECT * FROM se_vt_answers WHERE answer_id='".$answer_id."' LIMIT 1";
	$resource = $database->database_query($sql);		  
	$resource_assoc = $database->database_fetch_assoc($resource);
	$answer_user_id = $resource_assoc['answer_user_id'];
	
	// Give credit to user for best answer
	$sql = "UPDATE se_users SET users_qa_num_best_answers=users_qa_num_best_answers+1 WHERE user_id='".$answer_user_id."' LIMIT 1";
	$resource = $database->database_query($sql);  

	// Create notification
	$sql = "SELECT user_username, user_fname, user_lname, user_displayname, user_photo FROM se_users WHERE user_id='".$answer_user_id."' LIMIT 1";
	$resource = $database->database_query($sql);
	$a_author_info = $database->database_fetch_assoc($resource);
	$a_author = new se_user();
	$a_author->user_info['user_id'] = $a_author_info['answer_user_id'];
	$a_author->user_info['user_username'] = $a_author_info['user_username'];
	$a_author->user_info['user_fname'] = $a_author_info['user_fname'];
	$a_author->user_info['user_lname'] = $a_author_info['user_lname'];
	$a_author->user_info['user_photo'] = $a_author_info['user_photo'];
	$a_author->user_displayname();
	$notifytype = $notify->notify_add(
		$answer_user_id,
		"bestanswer",
		$this->q_id,
		Array(
			$a_author->user_info['user_username'],
			$this->q_id,
			$answer_id
		),
		Array(
			$this->title
		)
	);
	$question_url = $url->url_base.vsprintf($notifytype['notifytype_url'], Array($this->user_username, $this->q_id, $answer_id));
	$a_author->user_settings();
	if( $a_author->usersetting_info['usersetting_notify_bestanswer'] ) {
		send_systememail("bestanswer", $a_author->user_info['user_email'], Array($a_author->user_displayname, "<a href=\"$question_url\">$question_url</a>"));
	}
  }
  
  function check_state() {
  	global $database, $setting;
  	switch ($this->state) {
		case (QA_STATE_NEW) :
			// Move to SELECTING state if more than specified hours has passed since posting
			if (time() >= $this->time + $setting['setting_qa_select_time_min']) {
				$this->change_state(QA_STATE_SELECTING);		
			}
		break;
		case (QA_STATE_SELECTING) :
			// If more than specified days has passed since posting, with no best answer selected, move to UNDECIDED state or delete (if no answers)
			if (time() >= $this->time + $this->ttl) {		
				if ($this->num_answers == 0) {
					$this->delete_question();
				} else {
					$this->change_state(QA_STATE_UNDECIDED);		
				}
			}	
		break;
		case (QA_STATE_UNDECIDED) :
			// If more than specified days has passed since being put up for vote, determine if answer is decided or tiebreaker is needed
			if (time() >= $this->time + $this->ttl + $setting['setting_qa_voting_time']) {	
				$sql = "SELECT answer_rating_value, answer_id, answer_user_id, COUNT(*) AS num_top_raters FROM se_vt_answers WHERE se_vt_answers.answer_q_id='".$this->q_id."'  GROUP BY answer_rating_value ORDER BY answer_rating_value DESC LIMIT 1";
				$resource = $database->database_query($sql);		  
				$resource_assoc = $database->database_fetch_assoc($resource);
				$answer_max_rating = $resource_assoc['answer_rating_value'];
				if ($resource_assoc['num_top_raters'] > 1) {
					// Enter tie-breaker
					$new_state = QA_STATE_TIEBREAKER;
					// Set best answer rating value, but not best answer
					$sql = "UPDATE se_vt_questions SET question_best_answer_rating='".$answer_max_rating."' WHERE question_id='".$this->q_id."' LIMIT 1";
					$database->database_query($sql);		  				
					$this->change_state($new_state);		
				} else {
					// Question resolved, only one top-rated answser. Set best answer values and change state
					$this->set_best_answer($resource_assoc['answer_id'], 0,$answer_max_rating, '');
				}
			}		
		break;
		case (QA_STATE_TIEBREAKER) :
			// If question is in TIEBREAKER state, next rating among top answers decides the outcome, unless it matches current rating
			// Very similar to QA_STATE_UNDECIDED check
			$sql = "SELECT answer_rating_value, answer_id, answer_user_id, COUNT(*) AS num_top_raters FROM se_vt_answers WHERE se_vt_answers.answer_q_id='".$this->q_id."'  GROUP BY answer_rating_value ORDER BY answer_rating_value DESC LIMIT 1";
			$resource = $database->database_query($sql);		  
			$resource_assoc = $database->database_fetch_assoc($resource);
			$answer_max_rating = $resource_assoc['answer_rating_value'];
			if ($resource_assoc['num_top_raters'] == 1) {
				// Question resolved, only one top-rated answser
				$new_state = QA_STATE_RESOLVED;
				// Set best answer values
				$sql = "UPDATE se_vt_questions SET question_best_answer_id='".$resource_assoc['answer_id']."', question_best_answer_rating='".$answer_max_rating."' WHERE question_id='".$this->q_id."' LIMIT 1";
				$database->database_query($sql);
				$this->set_best_answer($resource_assoc['answer_id'], 0,$answer_max_rating, '');		
			}
		break;
		case (QA_STATE_RESOLVED) :
			// Already resolved, do nothing
		break;
		default :
		
		break;
	}
  }
  
  function change_state($new_state) {
	global $database; 
	$sql = "UPDATE se_vt_questions SET question_state='".$new_state."' WHERE question_id='".$this->q_id."' LIMIT 1";
	$resource = $database->database_query($sql);		  
  }
  
}

?>