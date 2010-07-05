<?php

/* $Id: admin_levels_recipesettings.php 59 2009-02-13 03:25:54Z john $ */

$page = "admin_levels_recipesettings";
include "admin_header.php";

if(isset($_POST['task'])) { $task = $_POST['task']; } else { $task = "main"; }
if(isset($_POST['level_id'])) { $level_id = $_POST['level_id']; } elseif(isset($_GET['level_id'])) { $level_id = $_GET['level_id']; } else { $level_id = 0; }

// VALIDATE LEVEL ID
$level = $database->database_query("SELECT * FROM se_levels WHERE level_id='$level_id'");

if($database->database_num_rows($level) != 1)
{ 
  header("Location: admin_levels.php");
  exit();
}

$level_info = $database->database_fetch_assoc($level);



// SET RESULT AND ERROR VARS
$result = 0;
$is_error = 0;

// SAVE CHANGES
if($task == "dosave")
{
  $level_recipe_allow     = ( !empty($_POST['level_recipe_allow'])      ? $_POST['level_recipe_allow']    : NULL    );
  $level_recipe_entries   = ( !empty($_POST['level_recipe_entries'])    ? $_POST['level_recipe_entries']  : NULL    );
  $level_recipe_search    = ( !empty($_POST['level_recipe_search'])     ? $_POST['level_recipe_search']   : NULL    );
  $level_recipe_privacy   = ( is_array($_POST['level_recipe_privacy'])  ? $_POST['level_recipe_privacy']  : array() );
  $level_recipe_comments  = ( is_array($_POST['level_recipe_comments']) ? $_POST['level_recipe_comments'] : array() );
  
  
  // CHECK THAT A NUMBER BETWEEN 1 AND 999 WAS ENTERED FOR recipe ENTRIES
  if( !is_numeric($level_recipe_entries) || $level_recipe_entries < 1 || $level_recipe_entries > 999 )
    $is_error = 7000089;
  
  if( !$is_error )
  {
    // GET PRIVACY AND PRIVACY DIFFERENCES
    if( empty($level_recipe_privacy) || !is_array($level_recipe_privacy) ) $level_recipe_privacy = array(63);
    rsort($level_recipe_privacy);
    $new_privacy_options = $level_recipe_privacy;
    $level_recipe_privacy = serialize($level_recipe_privacy);
    
    // GET COMMENT AND COMMENT DIFFERENCES
    if( empty($level_recipe_comments) || !is_array($level_recipe_comments) ) $level_recipe_comments = array(63);
    rsort($level_recipe_comments);
    $new_comments_options = $level_recipe_comments;
    $level_recipe_comments = serialize($level_recipe_comments);
    
    
    // SAVE SETTINGS
    $level_recipe_album_maxsize = $level_recipe_album_maxsize * 1024;
    
    $sql = "
      UPDATE
        se_levels
      SET 
        level_recipe_search='$level_recipe_search',
        level_recipe_privacy='$level_recipe_privacy',
        level_recipe_comments='$level_recipe_comments',
        level_recipe_allow='$level_recipe_allow',
        level_recipe_entries='$level_recipe_entries'
      WHERE
        level_id='{$level_info['level_id']}'
      LIMIT
        1
    ";
    
    $database->database_query($sql) or die($database->database_error()." SQL: ".$sql);
    
    if( !$level_recipe_search )
    {
      $database->database_query("UPDATE se_recipes INNER JOIN se_users ON se_users.user_id=se_recipes.recipe_user_id SET se_recipes.recipe_search='1' WHERE se_users.user_level_id='{$level_info['level_id']}'") or die("<b>Error: </b>".$database->database_error()."<br /><b>File: </b>".__FILE__."<br /><b>Line: </b>".__LINE__."<br /><b>Query: </b>".$sql);
    }
    
    $database->database_query("UPDATE se_recipes INNER JOIN se_users ON se_users.user_id=se_recipes.recipe_user_id SET recipe_privacy='{$new_privacy_options[0]}' WHERE se_users.user_level_id='{$level_info['level_id']}' && se_recipes.recipe_privacy NOT IN('".join("','", $new_privacy_options)."')") or die("<b>Error: </b>".$database->database_error()."<br /><b>File: </b>".__FILE__."<br /><b>Line: </b>".__LINE__."<br /><b>Query: </b>".$sql);
    $database->database_query("UPDATE se_recipes INNER JOIN se_users ON se_users.user_id=se_recipes.recipe_user_id SET recipe_comments='{$new_comments_options[0]}' WHERE se_users.user_level_id='{$level_info['level_id']}' && se_recipes.recipe_comments NOT IN('".join("','", $new_comments_options)."')") or die("<b>Error: </b>".$database->database_error()."<br /><b>File: </b>".__FILE__."<br /><b>Line: </b>".__LINE__."<br /><b>Query: </b>".$sql);
    $level_info = $database->database_fetch_assoc($database->database_query("SELECT * FROM se_levels WHERE level_id='{$level_info['level_id']}'"));
    $result = 1;
  }

}

// GET PREVIOUS PRIVACY SETTINGS
for($c=7;$c>=1;$c--)
{
  $priv = pow(2, $c)-1;
  if(user_privacy_levels($priv) != "") {
    SE_Language::_preload(user_privacy_levels($priv));
    $privacy_options[$priv] = user_privacy_levels($priv);
  }
}

for($c=7;$c>=0;$c--)
{
  $priv = pow(2, $c)-1;
  if(user_privacy_levels($priv) != "") {
    SE_Language::_preload(user_privacy_levels($priv));
    $comment_options[$priv] = user_privacy_levels($priv);
  }
}


// ASSIGN VARIABLES AND SHOW recipe SETTINGS PAGE
$smarty->assign_by_ref('level_info', $level_info);

$smarty->assign('result', $result);
$smarty->assign('is_error', $is_error);
$smarty->assign('level_id', $level_info['level_id']);
$smarty->assign('level_name', $level_info['level_name']);
$smarty->assign('entries_value', $level_info['level_recipe_entries']);
$smarty->assign('recipe_search', $level_info['level_recipe_search']);
$smarty->assign('recipe_privacy', unserialize($level_info['level_recipe_privacy']));
$smarty->assign('recipe_comments', unserialize($level_info['level_recipe_comments']));
$smarty->assign('privacy_options', $privacy_options);
$smarty->assign('comment_options', $comment_options);
include "admin_footer.php";
?>