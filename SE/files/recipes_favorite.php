<?php

/* $Id: user_poll_new.php 59 2009-02-13 03:25:54Z john $ */

$page = "recipes_favorite";
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

if(isset($_POST['recipe_id'])) { $recipe_id = $_POST['recipe_id']; } elseif(isset($_GET['recipe_id'])) { $recipe_id = $_GET['recipe_id']; } else { $recipe_id = NULL; }
if(isset($_POST['p'])) { $p = $_POST['p']; } elseif(isset($_GET['p'])) { $p = $_GET['p']; } else { $p = 1; }

$recipe_array = Array();
$total_recipes = -1;

// CREATE CLASSIFIED OBJECT, GET TOTAL CLASSIFIEDS, MAKE ENTRY PAGES, GET CLASSIFIED ARRAY
$recipe = new se_recipe($owner->user_info['user_id']);

if(!empty($recipe_id))
{
	$recipe->add_to_favorite($recipe_id);
}

$total_recipes = $recipe->recipe_fav_total($where, FALSE);
$recipes_per_page = 10;
$page_vars = make_page($total_recipes, $recipes_per_page, $p);

$recipe_array = $recipe->recipe_list_favorite($page_vars[0], $recipes_per_page);

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

$smarty->assign('recipes', $recipe_array);
$smarty->assign('total_recipes', $total_recipes);
$smarty->assign('p', $page_vars[1]);
$smarty->assign('maxpage', $page_vars[2]);
$smarty->assign('p_start', $page_vars[0]+1);
$smarty->assign('p_end', $page_vars[0]+count($recipe_array));

include "footer.php";
?>