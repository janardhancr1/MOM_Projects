<?php

/* $Id: user_poll_new.php 59 2009-02-13 03:25:54Z john $ */

$page = "search_recipes";
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

if(isset($_POST['p'])) { $p = $_POST['p']; } elseif(isset($_GET['p'])) { $p = $_GET['p']; } else { $p = 1; }

$recipe_search		= ( !empty($_POST['recipe_search']) 	? $_POST['recipe_search'] 		: NULL );
$recipe_difficulty	= ( !empty($_POST['recipe_difficulty']) ? $_POST['recipe_difficulty'] 	: NULL );
$recipe_ingre		= ( !empty($_POST['recipe_ingre']) 		? $_POST['recipe_ingre'] 		: NULL );
$recipe_vege  		= ( !empty($_POST['recipe_vege']) 		? $_POST['recipe_vege'] 		: NULL );
$recipe_vegan  		= ( !empty($_POST['recipe_vegan']) 		? $_POST['recipe_vegan'] 		: NULL );
$recipe_dairy  		= ( !empty($_POST['recipe_dairy']) 		? $_POST['recipe_dairy'] 		: NULL );
$recipe_gluten  	= ( !empty($_POST['recipe_gluten']) 	? $_POST['recipe_gluten'] 		: NULL );
$recipe_nut 		= ( !empty($_POST['recipe_nut']) 		? $_POST['recipe_nut'] 			: NULL );
$recipe_photo		= ( !empty($_POST['recipe_photo'])  	? $_POST['recipe_photo']  		: NULL );
$recipe_binder		= ( !empty($_POST['recipe_binder'])  	? $_POST['recipe_binder']  		: NULL );

$task    = ( !empty($_POST['task'])   ? $_POST['task']   : NULL );

$where = " se_recipes.recipe_search = 1 ";
if( !empty($recipe_search) ){
	$where = generate_where($where, "(recipe_name LIKE '$recipe_search%')");
}

if( !empty($recipe_difficulty) ){
	echo "IN where";
	$where = generate_where($where, "(recipe_difficulty = '$recipe_difficulty')");
	echo "after where";
}

if( !empty($recipe_ingre) ){
	$where = generate_where($where, "(recipe_ingredients LIKE '$recipe_search%')");
}

if( !empty($recipe_vege) ){
	$where = generate_where($where, "(recipe_vege = $recipe_vege)");
}

if( !empty($recipe_vegan) ){
	$where = generate_where($where, "(recipe_vegan = $recipe_vegan)");
}

if( !empty($recipe_dairy) ){
	$where = generate_where($where, "(recipe_dairy = '$recipe_dairy')");
}

if( !empty($recipe_gluten) ){
	$where = generate_where($where, "(recipe_gluten = $recipe_gluten)");
}

if( !empty($recipe_nut) ){
	$where = generate_where($where, "(recipe_nut = $recipe_nut)");
}

if( !empty($recipe_photo) ){
	$where = generate_where($where, "(recipe_photo IS NOT NULL)");
}

if( !empty($recipe_binder) ){
	$where = generate_where($where, "(recipe_user_id = ".$user->user_info['user_id'] .")");
}
$recipe_array = Array();
$total_recipes = -1;

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

if(!empty($task) && $task=="dosearch")
{
	// CREATE CLASSIFIED OBJECT, GET TOTAL CLASSIFIEDS, MAKE ENTRY PAGES, GET CLASSIFIED ARRAY
	$recipe = new se_recipe();

	$total_recipes = $recipe->recipe_total($where);
	$recipes_per_page = 10;
	$page_vars = make_page($total_recipes, $recipes_per_page, $p);

	$recipe_array = $recipe->recipe_list($page_vars[0], $recipes_per_page, $where);
	
	$smarty->assign('p', $page_vars[1]);
	$smarty->assign('maxpage', $page_vars[2]);
	$smarty->assign('p_start', $page_vars[0]+1);
	$smarty->assign('p_end', $page_vars[0]+count($recipe_array));
}
$smarty->assign('recipes', $recipe_array);
$smarty->assign('total_recipes', $total_recipes);

$smarty->assign('recipe_search', $recipe_name);
$smarty->assign('recipe_difficulty', $recipe_difficulty);
$smarty->assign('recipe_ingre', $recipe_ingre);
$smarty->assign('recipe_photo', $recipe_photo);
$smarty->assign('recipe_vege', $recipe_vege);
$smarty->assign('recipe_vegan', $recipe_vegan);
$smarty->assign('recipe_dairy', $recipe_dairy);
$smarty->assign('recipe_gluten', $recipe_gluten);
$smarty->assign('recipe_nut', $recipe_nut);

include "footer.php";
?>