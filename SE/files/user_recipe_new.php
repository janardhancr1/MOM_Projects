<?php

/* $Id: user_poll_new.php 59 2009-02-13 03:25:54Z john $ */

$page = "user_recipe_new";
include "header.php";

if(isset($_POST['task'])) { $task = $_POST['task']; } elseif(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = "main"; }

$recipe_name		= ( !empty($_POST['recipe_name'])    	? $_POST['recipe_name']    		: NULL );
$recipe_desc		= ( !empty($_POST['recipe_desc'])		? $_POST['recipe_desc']     	: NULL );
$recipe_tags    	= ( !empty($_POST['recipe_tags'])   	? $_POST['recipe_tags']   		: NULL );
$recipe_prep_tm   	= ( !empty($_POST['recipe_prep_tm'])  	? $_POST['recipe_prep_tm']  	: NULL );
$recipe_cook_tm  	= ( !empty($_POST['recipe_cook_tm']) 	? $_POST['recipe_cook_tm'] 		: NULL );
$recipe_serve_to  	= ( !empty($_POST['recipe_serve_to']) 	? $_POST['recipe_serve_to'] 	: NULL );
$recipe_difficulty	= ( !empty($_POST['recipe_difficulty']) ? $_POST['recipe_difficulty'] 	: NULL );
$recipe_ingre		= ( !empty($_POST['recipe_ingre']) 		? $_POST['recipe_ingre'] 		: NULL );
$recipe_method  	= ( !empty($_POST['recipe_method']) 	? $_POST['recipe_method'] 		: NULL );
$recipe_vege  		= ( !empty($_POST['recipe_vege']) 		? $_POST['recipe_vege'] 		: NULL );
$recipe_vegan  		= ( !empty($_POST['recipe_vegan']) 		? $_POST['recipe_vegan'] 		: NULL );
$recipe_dairy  		= ( !empty($_POST['recipe_dairy']) 		? $_POST['recipe_dairy'] 		: NULL );
$recipe_gluten  	= ( !empty($_POST['recipe_gluten']) 	? $_POST['recipe_gluten'] 		: NULL );
$recipe_nut 		= ( !empty($_POST['recipe_nut']) 		? $_POST['recipe_nut'] 			: NULL );

$recipe_search    = ( !empty($_POST['recipe_search'])   ? $_POST['recipe_search']   : NULL );
$recipe_privacy   = ( !empty($_POST['recipe_privacy'])  ? $_POST['recipe_privacy']  : NULL );
$recipe_comments  = ( !empty($_POST['recipe_comments']) ? $_POST['recipe_comments'] : NULL );

// SET EMPTY VARS
$is_error = FALSE;

// ENSURE POLLS ARE ENABLED FOR THIS USER
if( 4 & ~(int)$user->level_info['level_recipe_allow'] )
{
	header("Location: user_home.php");
	exit();
}

// CREATE RECIPE OBJECT
$recipe = new se_recipe($user->user_info['user_id']);


// ADD A NEW POLL
if( $task=="doadd" )
{
	// HTML SUPPORT
	$recipe_name = censor(cleanHTML(htmlspecialchars_decode($recipe_name), $setting['setting_recipe_html']));
	$recipe_desc = censor(cleanHTML(htmlspecialchars_decode($recipe_desc), $setting['setting_recipe_html']));

	// MAKE SURE NAME IS PROVIDED
	if( !trim($recipe_name) )
	{
		$is_error = 7000123;
	}

	// MAKE SURE DESCRIPTION IS PROVIDED
	if(!$is_error && !trim($recipe_desc))
	{
		$is_error = 7000124;
	}

	// MAKE SURE Ingredients IS PROVIDED
	if(!$is_error && !trim($recipe_ingre))
	{
		$is_error = 7000125;
	}

	// MAKE SURE Method  IS PROVIDED
	if(!$is_error && !trim($recipe_method))
	{
		$is_error = 7000147;
	}

	$recipe_pref = array("vege" => $recipe_vege,
  						"vegan" => $recipe_vegan,
  						"dairy" => $recipe_dairy,
  						"gluten" => $recipe_gluten,
  						"nut" => $recipe_nut);

	// POST RECIPE
	if( !$is_error )
	{
		// ADD POLL TO DATABSE
		$recipe_id = $recipe->recipe_add($recipe_name, $recipe_desc, $recipe_tags, $recipe_prep_tm, 
		$recipe_cook_tm, $recipe_serve_to, $recipe_difficulty, $recipe_ingre, $recipe_method, $recipe_search, 
		$recipe_privacy, $recipe_comments, $recipe_pref);

		// INSERT ACTION
		$new_query = $database->database_query("SELECT recipe_id FROM se_recipes WHERE recipe_user_id='{$user->user_info['user_id']}' ORDER BY recipe_id DESC LIMIT 1");
		$new_info = $database->database_fetch_assoc($new_query);
		if(strlen($recipe_name) > 100) { $recipe_name = substr($recipe_name, 0, 97); $recipe_name .= "..."; }
		$actions->actions_add($user, "newrecipe", Array($user->user_info['user_username'], $user->user_displayname, $new_info['recipe_id'], $recipe_name));

		header("Location: user_recipe_upload.php?recipe_id=$recipe_id");
		exit();
	}
}

// GET PREVIOUS PRIVACY SETTINGS
$level_recipe_privacy = unserialize($user->level_info['level_recipe_privacy']);
rsort($level_recipe_privacy);
for($c=0;$c<count($level_recipe_privacy);$c++) {
  if(user_privacy_levels($level_recipe_privacy[$c]) != "") {
    SE_Language::_preload(user_privacy_levels($level_recipe_privacy[$c]));
    $privacy_options[$level_recipe_privacy[$c]] = user_privacy_levels($level_recipe_privacy[$c]);
  }
}

$level_recipe_comments = unserialize($user->level_info['level_recipe_comments']);
rsort($level_recipe_comments);
for($c=0;$c<count($level_recipe_comments);$c++) {
  if(user_privacy_levels($level_recipe_comments[$c]) != "") {
    SE_Language::_preload(user_privacy_levels($level_recipe_comments[$c]));
    $comment_options[$level_recipe_comments[$c]] = user_privacy_levels($level_recipe_comments[$c]);
  }
}

// SET SOME DEFAULTS
if( !isset($recipe_search)   ) { $recipe_search = 1; }
if( !isset($recipe_privacy)  ) { $recipe_privacy = $level_recipe_privacy[0];   }
if( !isset($recipe_comments) ) { $recipe_comments = $level_recipe_comments[0]; }

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

$smarty->assign('privacy_options', $privacy_options);
$smarty->assign('comment_options', $comment_options);

$smarty->assign('recipe_search', $recipe_search);
$smarty->assign('recipe_comments', $recipe_comments);
$smarty->assign('recipe_privacy', $recipe_privacy);

$smarty->assign('recipe_name', $recipe_name);
$smarty->assign('recipe_desc', $recipe_desc);
$smarty->assign('recipe_tags', $recipe_tags);
$smarty->assign('recipe_prep_tm', $recipe_prep_tm);
$smarty->assign('recipe_cook_tm', $recipe_cook_tm);
$smarty->assign('recipe_serve_to', $recipe_serve_to);
$smarty->assign('recipe_difficulty', $recipe_difficulty);
$smarty->assign('recipe_ingre', $recipe_ingre);
$smarty->assign('recipe_method', $recipe_method);
$smarty->assign('recipe_vege', $recipe_vege);
$smarty->assign('recipe_vegan', $recipe_vegan);
$smarty->assign('recipe_dairy', $recipe_dairy);
$smarty->assign('recipe_gluten', $recipe_gluten);
$smarty->assign('recipe_nut', $recipe_nut);

$smarty->assign('is_error', $is_error);
$smarty->assign('is_error_sprintf_1', $is_error);
include "footer.php";
?>