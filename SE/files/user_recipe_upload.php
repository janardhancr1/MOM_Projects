<?php
/* $Id: user_poll_new.php 59 2009-02-13 03:25:54Z john $ */

$page = "user_recipe_upload";
include "header.php";

// DISPLAY ERROR PAGE IF USER IS NOT LOGGED IN AND ADMIN SETTING REQUIRES REGISTRATION
if( !$user->user_exists && !$setting['setting_permission_portal'] )
{
	$page = "error";
	$smarty->assign('error_header', 639);
	$smarty->assign('error_message', 656);
	$smarty->assign('error_submit', 641);
	include "footer.php";
}

if(isset($_POST['task'])) { $task = $_POST['task']; } else { $task = NULL; }
if(isset($_POST['recipe_id'])) { $recipe_id = $_POST['recipe_id']; } elseif(isset($_GET['recipe_id'])) { $recipe_id = $_GET['recipe_id']; } else { $recipe_id = NULL; }

// CREATE RECIPE OBJECT
$recipe = new se_recipe($user->user_info['user_id'], $recipe_id);

if($task == "doupload")
{
	$recipe->recipe_photo_add($_FILES["recipe_photo"], $recipe_id);
	header("Location: recipe.php?user=". $user->user_info['user_username'] ."&recipe_id=$recipe_id");
	exit();
}

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

$smarty->assign('recipe_info', $recipe->recipe_info);

include "footer.php";
?>