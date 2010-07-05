<?php

/* $Id: recipes.php 59 2009-02-13 03:25:54Z john $ */

$page = "recipes";
include "header.php";

if(isset($_POST['p'])) { $p = $_POST['p']; } elseif(isset($_GET['p'])) { $p = $_GET['p']; } else { $p = 1; }
if(isset($_POST['s'])) { $s = $_POST['s']; } elseif(isset($_GET['s'])) { $s = $_GET['s']; } else { $s = "dd"; }

// DISPLAY ERROR PAGE IF USER IS NOT LOGGED IN AND ADMIN SETTING REQUIRES REGISTRATION
if( (!$user->user_exists && !$setting['setting_permission_recipe']) || ($user->user_exists && (1 & ~(int)$user->level_info['level_recipe_allow'])) )
{
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 656);
  $smarty->assign('error_submit', 641);
  include "footer.php";
}

// DISPLAY ERROR PAGE IF NO OWNER
if( !$owner->user_exists )
{
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 828);
  $smarty->assign('error_submit', 641);
  include "footer.php";
}

// ENSURE RECIPES ARE ENABLED FOR THIS USER
if( 4 & ~(int)$owner->level_info['level_recipe_allow'] )
{
  header("Location: ".$url->url_create('profile', $owner->user_info['user_username']));
  exit();
}

// SET PRIVACY LEVEL AND WHERE CLAUSE
$privacy_max = $owner->user_privacy_max($user);
$where = "(recipe_privacy & $privacy_max)";

// CREATE POLL OBJECT
$entries_per_page = $owner->level_info['level_recipe_entries'];
$recipe = new se_recipe($owner->user_info['user_id']);

// GET TOTAL ENTRIES
$total_recipes = $recipe->recipe_total($where);

// MAKE ENTRY PAGES
$page_vars = make_page($total_recipes, $entries_per_page, $p);

// GET ENTRY ARRAY
$recipes = $recipe->recipe_list($page_vars[0], $entries_per_page, $where, "recipe_id DESC");

$smarty->assign('recipes', $recipes);
$smarty->assign('s', $s);
$smarty->assign('d', $d);
$smarty->assign('t', $t);
$smarty->assign('c', $c);
$smarty->assign('search', $search);
$smarty->assign('total_recipes', $total_recipes);
$smarty->assign('p', $page_vars[1]);
$smarty->assign('maxpage', $page_vars[2]);
$smarty->assign('p_start', $page_vars[0]+1);
$smarty->assign('p_end', $page_vars[0]+count($recipes));
include "footer.php";
?>