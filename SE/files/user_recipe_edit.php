<?php

/* $Id: user_recipe_edit.php 59 2009-02-13 03:25:54Z john $ */

$page = "user_recipe_edit";
include "header.php";

if(isset($_POST['task'])) { $task = $_POST['task']; } elseif(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = "main"; }
if(isset($_POST['recipe_id'])) { $recipe_id = $_POST['recipe_id']; } elseif(isset($_GET['recipe_id'])) { $recipe_id = $_GET['recipe_id']; } else { $recipe_id = 0; }

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

// CREATE POLL OBJECT
$recipe = new se_recipe($user->user_info['user_id'], $recipe_id);

// VERIFY POLLS EXISTS AND OWNER
if( !$recipe->recipe_exists || $recipe->recipe_info['recipe_user_id']!=$user->user_info['user_id'] )
{
  header("Location: user_recipe.php");
  exit();
}


// EDIT THIS POLL
if($task == "doedit")
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

	// EDIT POLL
	if( !$is_error )
	{
		// Edit Recipe
		$recipe->recipe_edit($recipe->recipe_info['recipe_id'], $recipe_name, $recipe_desc, $recipe_tags, $recipe_prep_tm, 
		$recipe_cook_tm, $recipe_serve_to, $recipe_difficulty, $recipe_ingre, $recipe_method, $recipe_search, 
		$recipe_privacy, $recipe_comments, $recipe_pref);

		header("Location: user_recipe.php");
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

$smarty->assign('recipe_search', $recipe->recipe_info['recipe_search']);
$smarty->assign('recipe_comments', $recipe->recipe_info['recipe_comments']);
$smarty->assign('recipe_privacy', $recipe->recipe_info['recipe_privacy']);

$smarty->assign('recipe_id', $recipe->recipe_info['recipe_id']);
$smarty->assign('recipe_name', $recipe->recipe_info['recipe_name']);
$smarty->assign('recipe_desc', $recipe->recipe_info['recipe_description']);
$smarty->assign('recipe_tags', $recipe->recipe_info['recipe_tags']);
$smarty->assign('recipe_prep_tm', $recipe->recipe_info['recipe_prep_tm']);
$smarty->assign('recipe_cook_tm', $recipe->recipe_info['recipe_cook_tm']);
$smarty->assign('recipe_serve_to', $recipe->recipe_info['recipe_serve_to']);
$smarty->assign('recipe_difficulty', $recipe->recipe_info['recipe_difficulty']);
$smarty->assign('recipe_ingre', $recipe->recipe_info['recipe_ingredients']);
$smarty->assign('recipe_method', $recipe->recipe_info['recipe_method']);
$smarty->assign('recipe_vege', $recipe->recipe_info['recipe_vege']);
$smarty->assign('recipe_vegan', $recipe->recipe_info['recipe_vegan']);
$smarty->assign('recipe_dairy', $recipe->recipe_info['recipe_dairy']);
$smarty->assign('recipe_gluten', $recipe->recipe_info['recipe_gluten']);
$smarty->assign('recipe_nut', $recipe->recipe_info['recipe_nut']);

$smarty->assign('is_error', $is_error);
$smarty->assign('is_error_sprintf_1', $is_error);
include "footer.php";
?>