<?php

defined('SE_PAGE') or exit();

//
//  THIS CLASS CONTAINS Q&A RELATED METHODS 
//
//  METHODS IN THIS CLASS:
//
//    se_qa()
//    question_total()
//    question_list()
//    answer_list()
//    add_question()
//    find_question_at_state_limit()


class se_qa
{
	// INITIALIZE VARIABLES
	var $is_error;			// INDICATES IF THERE IS AN ERROR OR NOT

	var $user_id;            // IF ONLY QUESTIONS FROM SINGLE USER TO BE CONSIDERED
	
	// THIS METHOD SETS INITIAL VARS
	// INPUT: $q_id (OPTIONAL) REPRESENTING THE ID OF THE QURESTION WE ARE CONCERNED WITH
	// OUTPUT: 
  
	function se_qa($user_id) {
		$this->user_id = $user_id;
		
		SE_Language::_preload_multi(27003414, 27003415, 27003417, 27003418);
		SE_Language::load();
		
		$this->find_question_at_state_limit();
	}
  
  // END se_qa() METHOD


	// THIS METHOD RETURNS THE TOTAL NUMBER OF QUESTIONS
	// INPUT: $where (OPTIONAL) REPRESENTING ADDITIONAL THINGS TO INCLUDE IN THE WHERE CLAUSE
	// OUTPUT: AN INTEGER REPRESENTING THE NUMBER OF QUESTIONS
	function question_total($where = "") {
	  global $database;
    
	  // BEGIN Q&A QUERY
	  $sql = "
      SELECT
        NULL
      FROM
        se_vt_questions
    ";
    
	  // IF NO USER ID SPECIFIED, JOIN TO USER TABLE
	  if( !$this->user_id ) $sql .= "
      LEFT JOIN
        se_users
      ON
        se_vt_questions.question_user_id=se_users.user_id
    ";
    
	  // ADD WHERE IF NECESSARY
	  if( !empty($where) || $this->user_id ) $sql .= "
      WHERE
    ";
    
	  // ENSURE USER ID IS NOT EMPTY
	  if( $this->user_id ) $sql .= "
        question_user_id='{$this->user_id}'
    ";
    
	  // INSERT AND IF NECESSARY
	  if( $this->user_id && !empty($where) ) $sql .= " AND";
    
	  // ADD WHERE CLAUSE, IF NECESSARY
	  if( !empty($where) ) $sql .= "
        {$where}
    ";

	  // GET AND RETURN TOTAL QUESTIONS
	  $question_total = $database->database_num_rows($database->database_query($sql));
    
	  return (int) $question_total;
	}
  
  // END question_total() METHOD



	// THIS METHOD RETURNS AN ARRAY OF QUESTIONS
	// INPUT: $start REPRESENTING THE QUESTION TO START WITH
	//	  $limit REPRESENTING THE NUMBER OF QUESTIONS TO RETURN
	//	  $sort_by (OPTIONAL) REPRESENTING THE ORDER BY CLAUSE
	//	  $where (OPTIONAL) REPRESENTING ADDITIONAL THINGS TO INCLUDE IN THE WHERE CLAUSE
	//	  $all_users (OPTIONAL) SWITCH INDICATING IF QUESTIONS FROM ALL USERS SHOULD BE INCLUDED
	// OUTPUT: AN ARRAY OF QUESTIONS
	function question_list($start, $limit, $sort_by = "question_id DESC", $where = "", $all_users = FALSE ) {
	  global $database, $user, $owner;
    
	  // BEGIN QUERY
	  $sql = "
      SELECT
        se_vt_questions.*,
		se_vt_qacats.vt_qacat_id AS subcat_id,
		se_vt_qacats.vt_qacat_title AS subcat_name_langid
    ";
    
	  // IF NO USER ID SPECIFIED, RETRIEVE USER INFORMATION
	  if( !$this->user_id || $all_users) $sql .= ",
        se_users.user_id,
        se_users.user_username,
        se_users.user_photo,
        se_users.user_fname,
        se_users.user_lname
    ";
    
	  // CONTINUE QUERY
	  $sql .= "
      FROM
        se_vt_questions
    ";
    
	// JOIN SUB-CATEGORY
	  $sql .= "
      LEFT JOIN
        se_vt_qacats
        ON se_vt_questions.question_subcat_id=se_vt_qacats.vt_qacat_id
    ";
	
	
	  // IF NO USER ID SPECIFIED, JOIN TO USER TABLE
	  if( !$this->user_id || $all_users) $sql .= "
      LEFT JOIN
        se_users
        ON se_vt_questions.question_user_id=se_users.user_id
    ";
    
	  // ADD WHERE IF NECESSARY
	  if( !empty($where) || $this->user_id ) $sql .= "
      WHERE
    ";
    
	  // ENSURE USER ID IS NOT EMPTY, AND NOT ALL USERS INCLUDED
	  if( $this->user_id && !$all_users) $sql .= "
        question_user_id='{$this->user_id}'
    ";
    
	  // INSERT AND IF NECESSARY
	  if( $this->user_id && !empty($where) && !$all_users) $sql .= " AND";

	  // ADD WHERE CLAUSE, IF NECESSARY
	  if( !empty($where) ) $sql .= "
        {$where}
    ";
    
	  // ADD ORDER, AND LIMIT CLAUSE
	  $sql .= "
      ORDER BY
        {$sort_by}
      LIMIT
        {$start}, {$limit}
    ";
    
	  // RUN QUERY
	  $resource = $database->database_query($sql);
    
	  // GET QUESTIONS INTO AN ARRAY
	  $question_array = Array();
	  while( $question_info = $database->database_fetch_assoc($resource) ) {
	    // IF NO USER ID SPECIFIED, CREATE OBJECT FOR AUTHOR
	    if( !$this->user_id || $all_users) {
	      $author = new se_user();
	      $author->user_exists = TRUE;
	      $author->user_info['user_id']       = $question_info['user_id'];
	      $author->user_info['user_username'] = $question_info['user_username'];
	      $author->user_info['user_fname']    = $question_info['user_fname'];
	      $author->user_info['user_lname']    = $question_info['user_lname'];
	      $author->user_info['user_photo']    = $question_info['user_photo'];
	      $author->user_displayname();
      }
      
	    // OTHERWISE, SET AUTHOR TO OWNER/LOGGED-IN USER
	    elseif( $owner->user_exists && $owner->user_info['user_id']==$question_info['question_user_id'] )
      {
	      $author =& $owner;
	    }
      elseif( $user->user_exists && $user->user_info['user_id'] == $question_info['question_user_id'] )
      {
	      $author =& $user;
	    }
      
      
	    // CREATE ARRAY OF QUESTION DATA
//	    SE_Language::_preload(user_privacy_levels($album_info['album_privacy']));
      
      // SET OTHER INFO
      $question_info['question_author'] =& $author;
      
	  $question_array[] = $question_info;
      
      unset($author, $question_info);
	  }
    
	  // RETURN ARRAY
	  return $question_array;
	}
  
  // END question_list() METHOD


	// THIS FUNCTION RETRIEVES A LIST OF QUESTIONS ANSWERED BY THE USER WITH THE GIVEN USER-ID
	// INPUT: $user_id - USER ID OF USER TO RETRIEVE LIST OF ANSWERS FOR
	// OUTPUT: ARRAY OF QUESTIONS
	function answer_list() {
		global $database;
		$sql = "SELECT * FROM se_vt_answers WHERE answer_user_id='".$this->user_id."'";
		$resource = $database->database_query($sql);
		$answers = array();
		while ($answer = $database->database_fetch_assoc($resource)) {
			$answers[] = $answer;
		};
		return $answers;
	}

	// THIS FUNCTION INSERTS A NEW QUESTION INTO THE DATABASE
	// INPUT: $q_title - TITLE OF QUESTION
	//        $q_text - DETAILS TEXT OF QUESTION
	//        $cat_id - CATEGORY ID
	//        $subcat_id - SUB-CATEGORY ID
	// OUTPUT: QUESTION ID OF NEWLY POSTED QUESTION
  
  function add_question($q_title, $q_text, $q_tags, $q_catid, $q_subcatid) {
  	global $database, $user, $actions;
	$q_title = censor($q_title);
	$q_text = censor($q_text);
	$q_text = censor($q_tags);
	if($q_subcatid <= 0)
		$q_subcatid = $q_catid;
	$sql = "INSERT INTO se_vt_questions SET question_user_id='".$user->user_info['user_id']."', question_title='".$q_title."', question_text='".$q_text."', question_tags='".$q_tags."', question_time='".time()."', question_cat_id='".$q_catid."', question_subcat_id='".$q_subcatid."'";
	$resource = $database->database_query($sql);
	$q_id = $database->database_insert_id();
	$actions->actions_add($user, "newquestion", Array($user->user_info['user_username'], $user->user_displayname, $q_id, $q_title), Array(), 0, false, "user", $user->user_info['user_id'], $user->user_info['user_privacy']);
	return $q_id;
  }
  
  function find_question_at_state_limit() {
  	global $database, $setting;
  	$now = time();
	// Find question ready to change from QA_STATE_NEW to QA_STATE_SELECTING
	$sql = "SELECT question_id FROM se_vt_questions WHERE question_state='".QA_STATE_NEW."' AND question_time + '".$setting['setting_qa_select_time_min']."' < '".$now."'";
	$resource = $database->database_query($sql);
	while ($q_id_assoc = $database->database_fetch_assoc($resource)) {
		$q = new se_question($q_id_assoc['question_id']);
		$q->check_state();
	}
	
	// Find question ready to change from QA_STATE_SELECTING to QA_STATE_UNDECIDED
	$sql = "SELECT question_id FROM se_vt_questions WHERE question_state='".QA_STATE_SELECTING."' AND question_time + question_ttl < '".$now."'";
	$resource = $database->database_query($sql);
	while ($q_id_assoc = $database->database_fetch_assoc($resource)) {
		$q = new se_question($q_id_assoc['question_id']);
		$q->check_state();
	}

	// Find question ready to change from QA_STATE_UNDECIDED to QA_STATE_TIEBREAKER or QA_STATE_RESOLVED 
	$sql = "SELECT question_id FROM se_vt_questions WHERE question_state='".QA_STATE_UNDECIDED."' AND question_time + question_ttl + '".$setting['setting_qa_voting_time']."' < '".$now."'";
	$resource = $database->database_query($sql);
	while ($q_id_assoc = $database->database_fetch_assoc($resource)) {
		$q = new se_question($q_id_assoc['question_id']);
		$q->check_state();
	}
  }
  

}

?>