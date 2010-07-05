<?php

/* $Id: user_music_upload.php 59 2009-02-13 03:25:54Z john $ */

$page = "user_music_upload";
include "header.php";

$task   = ( !empty($_POST['task'])    ? $_POST['task']    : ( !empty($_GET['task'])   ? $_GET['task']   : NULL  ) );
$isAjax = ( !empty($_POST['isAjax'])  ? $_POST['isAjax']  : ( !empty($_GET['isAjax']) ? $_GET['isAjax'] : FALSE ) );


// ENSURE MUSIC IS ENABLED FOR THIS USER
if( !$user->level_info['level_music_allow'] )
{
  header("Location: user_home.php");
  exit();
}


// SET RESULT AND ERROR VARS
$result = "";
$is_error = FALSE;
$show_uploader = TRUE;
$file_result = array();


// SET MUSIC
$music = new se_music($user->user_info['user_id']);
$music_numleft = ( $user->level_info['level_music_maxnum'] - $music->music_total() );


// USER HAS REACHED MAX SONGS
if( $music_numleft<=0 )
{
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 4000110);
  $smarty->assign('error_submit', 641);
  include "footer.php";
}


// UPLOAD FRAME
if( $task=="doupload" )
{
  $isAjax = $_POST['isAjax'];
  $file_result = array();

  // WORKAROUND FOR FLASH UPLOADER
  if( $_FILES['file1']['type']=="application/octet-stream" && $isAjax )
  { 
    $file_types = explode(",", str_replace(" ", "", strtolower($user->level_info['level_music_mimes'])));
    $_FILES['file1']['type'] = $file_types[0];
  }
  
  // GET TOTAL SPACE USED
  $space_used = $music->music_space();
  if($user->level_info['level_music_storage'])
  {
    $space_left = $user->level_info['level_music_storage'] - $space_used;
  }
  else
  {
    $space_left = ( $dfs=disk_free_space("/") ? $dfs : pow(2, 32) );
  }
  
  // RUN FILE UPLOAD FUNCTION FOR EACH SUBMITTED FILE
  $action_music = array();
  for( $file_index=1; $file_index<6; $file_index++ )
  {
    $file_param = "file{$file_index}";
    if( empty($_FILES[$file_param]['name']) ) continue;
    
    $file_result[$file_param] = $music->music_upload($file_param, $space_left);
    
    if( !$file_result[$file_param]['is_error'] )
    {
      $file_result[$file_param]['message'] = 4000085;
      
      // INSERT ACTION
      $actions->actions_add($user, "newmusic", array($user->user_info['user_username'], $user->user_displayname));
      
      // UPDATE LAST UPDATE DATE (SAY THAT 10 TIMES FAST)
      $user->user_lastupdate();
    }
    else
    {
      $file_result[$file_param]['message'] = $file_result[$file_param]['is_error'];
    }
    SE_Language::_preload($file_result[$file_param]['message']);
  }
  
  // OUTPUT JSON RESULT
  if( $isAjax )
  {
    SE_Language::load();
    if( !$file_result['file1']['is_error'] )
    {
      $result = "success"; 
      $size = sprintf(SE_Language::_get($file_result['file1']['message']), $file_result['file1']['file_name']);
      $error = null; 
    }
    else
    {
      $result = "failure";
      $error = sprintf(SE_Language::_get($file_result['file1']['message']), $file_result['file1']['file_name']);
      $size = null;
    }
    if( !headers_sent() ) { header('Content-type: application/json'); }
    $json_response = json_encode(array('result'=>$result,'error'=>$error,'size'=>$size));
    echo $json_response;
    exit();
  }

  // SHOW PAGE WITH RESULTS
  else
  {
    $show_uploader = 0;
  }
}




// GET TOTAL SPACE USED
$space_used = $music->music_space();
if($user->level_info['level_music_storage'])
{
  $space_left = $user->level_info['level_music_storage'] - $space_used;
}
else
{
  $space_left = ( $dfs=disk_free_space("/") ? $dfs : pow(2, 32) );
}


// GET MAX FILESIZE ALLOWED
$max_filesize_kb = ($user->level_info['level_music_maxsize'] / 1024) / 1024;
$max_filesize_kb = round($max_filesize_kb, 0);


// CONVERT UPDATED SPACE LEFT TO MB
$space_left_mb = ($space_left / 1024) / 1024;
$space_left_mb = round($space_left_mb, 2);


// START NEW SESSION AND SET SESSION VARS FOR UPLOADER

// Backwards compatibility with <SE3.10
if( !session_id() ) session_start();
if( !empty($_COOKIE['user_id']) )
{
  $_SESSION['ul_user_id'] = $_COOKIE['user_id'];
  $_SESSION['ul_user_email'] = $_COOKIE['user_email'];
  $_SESSION['ul_user_password'] = $_COOKIE['se_user_pass'];
}

// Keep with 3.10+
$_SESSION['upload_token'] = md5(uniqid(rand(), true));
$_SESSION['action'] = "user_music_upload.php";

// SET INPUTS
$inputs = array();

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

// ASSIGN VARIABLES AND SHOW UPLOAD FILES PAGE
$smarty->assign('music_title', $music->music_title);
$smarty->assign('allowed_exts', str_replace(",", ", ", $user->level_info['level_music_exts']));

$smarty->assign('files_left', $music_numleft);
$smarty->assign('space_left', $space_left_mb);
$smarty->assign('max_filesize', $max_filesize_kb);

$smarty->assign('show_uploader', $show_uploader);
$smarty->assign('inputs', $inputs);
$smarty->assign('file_result', $file_result);
$smarty->assign('session_id', session_id());
$smarty->assign('upload_token', $_SESSION['upload_token']);

// SET UPLOADER PARAMS
$smarty->assign('user_upload_max_size', $user->level_info['level_music_maxsize']);
$smarty->assign('user_upload_max_files', $music_numleft);
$smarty->assign('user_upload_allowed_extensions', $user->level_info['level_music_exts']);

include "footer.php";
?>