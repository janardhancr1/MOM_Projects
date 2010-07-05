<?php

/* $Id: header_poll.php 59 2009-02-13 03:25:54Z john $ */

// ENSURE THIS IS BEING INCLUDED IN AN SE SCRIPT
defined('SE_PAGE') or exit();

// INCLUDE POLL FILES
include "./include/class_recipe.php";
include "./include/functions_recipe.php";

SE_Language::_preload(7000005);


// SET MAIN MENU VARS
//if( (!$user->user_exists && $setting['setting_permission_poll']) || ($user->user_exists && (1 & (int)$user->level_info['level_poll_allow'])) )
  $plugin_vars['menu_main'] = array('file' => 'browse_recipes.php', 'title' => 7000005);

if( $user->user_exists && (4 & (int)$user->level_info['level_poll_allow']) )
  $plugin_vars['menu_user'] = array('file' => 'user_recipe.php', 'icon' => 'recipe_recipe16.png', 'title' => 7000005);

 // SET PROFILE MENU VARS
if( (4 & (int)$owner->level_info['level_recipe_allow']) && $page=="profile" )
{
  // START recipe
  $recipe = new se_recipe($owner->user_info['user_id']);
  $entries_per_page = 5;
  $sort = "recipe_datecreated DESC";

  // GET PRIVACY LEVEL AND SET WHERE
  $privacy_max = $owner->user_privacy_max($user);
  $where = "(recipe_privacy & $privacy_max)";

  // GET TOTAL ENTRIES
  $total_recipes = $recipe->recipe_total($where, TRUE);

  // GET ENTRY ARRAY
  $recipes = $recipe->recipe_list(0, $entries_per_page, $where, $sort);
  
  // ASSIGN ENTRIES SMARY VARIABLE
  $smarty->assign('recipes', $recipes);
  $smarty->assign('total_recipes', $total_recipes);
  
  // SET PROFILE MENU VARS
  $plugin_vars['menu_profile_side'] = NULL;
  if( $total_recipes )
  {
    $plugin_vars['menu_profile_tab'] = array('file'=> 'profile_recipe.tpl', 'title' => 7000005, 'name' => 'recipe');
  }
}
  
// Use template hooks
if( is_a($smarty, 'SESmarty') )
{
  $plugin_vars['uses_tpl_hooks'] = TRUE;
  
  if( !empty($plugin_vars['menu_main']) )
    $smarty->assign_hook('menu_main', $plugin_vars['menu_main']);
  
  if( !empty($plugin_vars['menu_user']) )
    $smarty->assign_hook('menu_user_apps', $plugin_vars['menu_user']);
  
  if( !empty($plugin_vars['menu_profile_side']) )
    $smarty->assign_hook('profile_side', $plugin_vars['menu_profile_side']);
  
  if( !empty($plugin_vars['menu_profile_tab']) )
    $smarty->assign_hook('profile_tab', $plugin_vars['menu_profile_tab']);

  if( strpos($page, 'recipe')!==FALSE || $page=="profile" )
  {
    $smarty->assign_hook('styles', './templates/styles_recipes.css');
  }
}

  
?>