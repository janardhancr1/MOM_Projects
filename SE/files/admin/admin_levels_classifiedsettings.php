<?php

/* $Id: admin_levels_classifiedsettings.php 7 2009-01-11 06:01:49Z john $ */

$page = "admin_levels_classifiedsettings";
include "admin_header.php";

if(isset($_POST['task'])) { $task = $_POST['task']; } else { $task = "main"; }
if(isset($_POST['level_id'])) { $level_id = $_POST['level_id']; } elseif(isset($_GET['level_id'])) { $level_id = $_GET['level_id']; } else { $level_id = 0; }


// VALIDATE LEVEL ID
$sql = "SELECT * FROM se_levels WHERE level_id='{$level_id}' LIMIT 1";
$resource = $database->database_query($sql) or die($database->database_error()." <b>SQL was: </b>$sql");

if( !$database->database_num_rows($resource) )
{ 
  header("Location: admin_levels.php");
  exit();
}

$level_info = $database->database_fetch_assoc($resource);


// SET RESULT AND ERROR VARS
$result = FALSE;
$is_error = FALSE;



// SAVE CHANGES
if($task == "dosave")
{
  $level_classified_allow = $_POST['level_classified_allow'];
  $level_classified_entries = $_POST['level_classified_entries'];
  $level_classified_search = $_POST['level_classified_search'];
  $level_classified_photo = $_POST['level_classified_photo'];
  $level_classified_photo_width = $_POST['level_classified_photo_width'];
  $level_classified_photo_height = $_POST['level_classified_photo_height'];
  $level_classified_photo_exts = str_replace(", ", ",", $_POST['level_classified_photo_exts']);
  $level_classified_album_exts = str_replace(", ", ",", $_POST['level_classified_album_exts']);
  $level_classified_album_mimes = str_replace(", ", ",", $_POST['level_classified_album_mimes']);
  $level_classified_album_storage = $_POST['level_classified_album_storage'];
  $level_classified_album_maxsize = $_POST['level_classified_album_maxsize'];
  $level_classified_album_width = $_POST['level_classified_album_width'];
  $level_classified_album_height = $_POST['level_classified_album_height'];
  $level_classified_privacy = is_array($_POST['level_classified_privacy']) ? $_POST['level_classified_privacy'] : Array();
  $level_classified_comments = is_array($_POST['level_classified_comments']) ? $_POST['level_classified_comments'] : Array();
  $level_classified_html = $_POST['level_classified_html'];

  // FORMAT HTML CORRECTLY
  $level_classified_html = preg_replace('/[,\s]+/', ',', $level_classified_html);
  
  // CHECK THAT A NUMBER BETWEEN 1 AND 999 WAS ENTERED FOR classified ENTRIES
  if( !is_numeric($level_classified_entries) || $level_classified_entries<1 || $level_classified_entries>999)
    $is_error = 4500008;

  // CHECK THAT A NUMBER BETWEEN 1 AND 999 WAS ENTERED FOR WIDTH AND HEIGHT
  if( !is_numeric($level_classified_photo_width) || !is_numeric($level_classified_photo_height) || $level_classified_photo_width<1 || $level_classified_photo_height<1 || $level_classified_photo_width>999 || $level_classified_photo_height>999)
    $is_error = 4500009;

  // CHECK THAT A NUMBER BETWEEN 1 AND 204800 (200MB) WAS ENTERED FOR MAXSIZE
  if( !is_numeric($level_classified_album_maxsize) || $level_classified_album_maxsize<1 || $level_classified_album_maxsize>204800 )
    $is_error = 4500010;

  // CHECK THAT WIDTH AND HEIGHT ARE NUMBERS
  if( !is_numeric($level_classified_album_width) || !is_numeric($level_classified_album_height) )
    $is_error = 4500011;


  if( !$is_error )
  {
    // GET PRIVACY AND PRIVACY DIFFERENCES
    if( empty($level_classified_privacy) || !is_array($level_classified_privacy) ) $level_classified_privacy = array(63);
    rsort($level_classified_privacy);
    $new_privacy_options = $level_classified_privacy;
    $level_classified_privacy = serialize($level_classified_privacy);
    
    // GET COMMENT AND COMMENT DIFFERENCES
    if( empty($level_classified_comments) || !is_array($level_classified_comments) ) $level_classified_comments = array(63);
    rsort($level_classified_comments);
    $new_comments_options = $level_classified_comments;
    $level_classified_comments = serialize($level_classified_comments);
    
    // FIX MAXSIZE
    $level_classified_album_maxsize = $level_classified_album_maxsize * 1024;
    
    // SAVE SETTINGS
    $sql = "
      UPDATE
        se_levels
      SET 
        level_classified_search='$level_classified_search',
        level_classified_privacy='$level_classified_privacy',
        level_classified_comments='$level_classified_comments',
        level_classified_allow='$level_classified_allow',
        level_classified_entries='$level_classified_entries',
        level_classified_photo='$level_classified_photo',
        level_classified_photo_width='$level_classified_photo_width',
        level_classified_photo_height='$level_classified_photo_height',
        level_classified_photo_exts='$level_classified_photo_exts',
        level_classified_album_exts='$level_classified_album_exts',
        level_classified_album_mimes='$level_classified_album_mimes',
        level_classified_album_storage='$level_classified_album_storage',
        level_classified_album_maxsize='$level_classified_album_maxsize',
        level_classified_album_width='$level_classified_album_width',
        level_classified_album_height='$level_classified_album_height',
        level_classified_html='$level_classified_html'
      WHERE
        level_id='{$level_info['level_id']}'
      LIMIT
        1
    ";
    
    $database->database_query($sql) or die($database->database_error()." <b>SQL was: </b>$sql");
    
    if( !$level_classified_search )
    {
      $database->database_query("UPDATE se_classifieds INNER JOIN se_users ON se_users.user_id=se_classifieds.classified_user_id SET se_classifieds.classified_search='1' WHERE se_users.user_level_id='{$level_info['level_id']}'") or die("<b>Error: </b>".$database->database_error()."<br /><b>File: </b>".__FILE__."<br /><b>Line: </b>".__LINE__."<br /><b>Query: </b>".$sql);
    }
    
    $database->database_query("UPDATE se_classifieds INNER JOIN se_users ON se_users.user_id=se_classifieds.classified_user_id SET se_classifieds.classified_privacy='{$new_privacy_options[0]}' WHERE se_users.user_level_id='{$level_info['level_id']}' && se_classifieds.classified_privacy NOT IN('".join("','", $new_privacy_options)."')") or die("<b>Error: </b>".$database->database_error()."<br /><b>File: </b>".__FILE__."<br /><b>Line: </b>".__LINE__."<br /><b>Query: </b>".$sql);
    $database->database_query("UPDATE se_classifieds INNER JOIN se_users ON se_users.user_id=se_classifieds.classified_user_id SET se_classifieds.classified_comments='{$new_comments_options[0]}' WHERE se_users.user_level_id='{$level_info['level_id']}' && se_classifieds.classified_comments NOT IN('".join("','", $new_comments_options)."')") or die("<b>Error: </b>".$database->database_error()."<br /><b>File: </b>".__FILE__."<br /><b>Line: </b>".__LINE__."<br /><b>Query: </b>".$sql);
    
    $level_info = $database->database_fetch_assoc($database->database_query("SELECT * FROM se_levels WHERE level_id='$level_id'"));
    $result = TRUE;
  }

}

// GET PREVIOUS PRIVACY SETTINGS
for($c=6;$c>0;$c--)
{
  $priv = pow(2, $c)-1;
  $plv = user_privacy_levels($priv);
  if( !$plv ) continue;
  SE_Language::_preload($plv);
  $privacy_options[$priv] = $plv;
}

for($c=6;$c>=0;$c--)
{
  $priv = pow(2, $c)-1;
  $plv = user_privacy_levels($priv);
  if( !$plv ) continue;
  SE_Language::_preload($plv);
  $comment_options[$priv] = $plv;
}


// ADD SPACES BACK AFTER COMMAS
$level_classified_photo_exts = str_replace(",", ", ", $level_info['level_classified_photo_exts']);
$level_classified_album_exts = str_replace(",", ", ", $level_info['level_classified_album_exts']);
$level_classified_album_mimes = str_replace(",", ", ", $level_info['level_classified_album_mimes']);
$level_classified_album_maxsize = $level_info['level_classified_album_maxsize'] / 1024;


$level_classified_html = str_replace(',', ', ', $level_info['level_classified_html']);



// ASSIGN VARIABLES AND SHOW classified SETTINGS PAGE
$smarty->assign('result', $result);
$smarty->assign('is_error', $is_error);

$smarty->assign('level_id', $level_info['level_id']);
$smarty->assign_by_ref('level_info', $level_info);

$smarty->assign('level_classified_photo_exts', $level_classified_photo_exts);
$smarty->assign('level_classified_album_exts', $level_classified_album_exts);
$smarty->assign('level_classified_album_mimes', $level_classified_album_mimes);
$smarty->assign('level_classified_album_maxsize', $level_classified_album_maxsize);
$smarty->assign('level_classified_html', $level_classified_html);

$smarty->assign('classified_privacy', unserialize($level_info['level_classified_privacy']));
$smarty->assign('classified_comments', unserialize($level_info['level_classified_comments']));
$smarty->assign('privacy_options', $privacy_options);
$smarty->assign('comment_options', $comment_options);

include "admin_footer.php";
?>