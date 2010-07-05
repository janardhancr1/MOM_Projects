<?php

/* $Id: recipe.php 59 2009-02-13 03:25:54Z john $ */

$page = "recipe";
include "header.php";


$recipe_id = ( !empty($_POST['recipe_id']) ? $_POST['recipe_id'] : ( !empty($_GET['recipe_id']) ? $_GET['recipe_id'] : NULL ) );


// DISPLAY ERROR PAGE IF USER IS NOT LOGGED IN AND ADMIN SETTING REQUIRES REGISTRATION
if( (!$user->user_exists && !$setting['setting_permission_recipe']) || ($user->user_exists && (1 & ~(int)$user->level_info['level_recipe_allow'])) )
{
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 656);
  $smarty->assign('error_submit', 641);
  include "footer.php";
}


// INIT POLL OBJECT
$recipe_object = new se_recipe($owner->user_info['user_id'], $recipe_id);
//$recipe_object->recipe_info['poll_voted_array'] = explode(",", $recipe_object->recipe_info['poll_voted']);


// DISPLAY ERROR PAGE IF NO OWNER
if( !$owner->user_exists || !$recipe_object->recipe_exists )
{
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 828);
  $smarty->assign('error_submit', 641);
  include "footer.php";
}


// ENSURE POLLS ARE ENABLED FOR THIS USER
if( (4 & ~(int)$owner->level_info['level_recipe_allow']) || $recipe_object->recipe_info['recipe_user_id']!=$owner->user_info['user_id'] )
{
  header("Location: ".$url->url_create('profile', $owner->user_info['user_username']));
  exit();
}


// GET PRIVACY LEVELS
$privacy_max = $owner->user_privacy_max($user);
$allowed_to_view = ($privacy_max & $recipe_object->recipe_info['recipe_privacy']);
$allowed_to_comment = ($privacy_max & $recipe_object->recipe_info['recipe_comments']);

if( !$allowed_to_view )
{
  header("Location: ".$url->url_create('profile', $owner->user_info['user_username']));
  exit();
}


// GET POLL COMMENTS
$comment = new se_comment('recipe', 'recipe_id', $recipe_object->recipe_info['recipe_id']);
$total_comments = $comment->comment_total();


// UPDATE POLL VIEWS
$recipe_object->recipe_view();


// UPDATE NOTIFICATIONS
if( $user->user_info['user_id']==$owner->user_info['user_id'])
{
  $database->database_query("
    DELETE FROM
      se_notifys
    USING
      se_notifys
    LEFT JOIN
      se_notifytypes
      ON se_notifys.notify_notifytype_id=se_notifytypes.notifytype_id
    WHERE
      se_notifys.notify_user_id='{$owner->user_info['user_id']}' AND
      se_notifytypes.notifytype_name='recipecomment' AND
      notify_object_id='{$recipe_object->recipe_info['recipe_id']}'
  ");
}

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

$myRecipe = NULL;
if($user->user_info['user_id'] != $recipe_object->recipe_info['recipe_user_id']) {
	$myRecipe = 1;
}
// SMARTY
$smarty->assign('total_comments', $total_comments);
$smarty->assign('allowed_to_view', $allowed_to_view);
$smarty->assign('allowed_to_comment', $allowed_to_comment);
$smarty->assign('recipe_object', $recipe_object);
$smarty->assign('recipe_id', $recipe_id);
$smarty->assign('myRecipe', $myRecipe);
include "footer.php";
?>