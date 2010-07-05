<?php

/* $Id: header_classified.php 152 2009-04-02 20:50:48Z john $ */

// ENSURE THIS IS BEING INCLUDED IN AN SE SCRIPT
defined('SE_PAGE') or exit();

// INCLUDE CLASSIFIEDS FILES
include "./include/class_classified.php";
include "./include/functions_classified.php";


// PRELOAD LANGUAGE
SE_Language::_preload(4500007);


// SET MENU VARS
//if( ($user->user_exists && ((int)$user->level_info['level_classified_allow'] & 1)) || (!$user->user_exists && $setting['setting_permission_classified']) )
  //$plugin_vars['menu_main'] = array('file' => 'browse_classifieds.php', 'title' => 4500007);
  $plugin_vars['menu_main'] = array('file' => 'classifieds_home.php', 'title' => 4500007);

if( $user->user_exists && ((int)$user->level_info['level_classified_allow'] & 2) )
  $plugin_vars['menu_user'] = array('file' => 'user_classified.php', 'icon' => 'classified_classified16.gif', 'title' => 4500007);


// SET PROFILE MENU VARS
if( ((int)$owner->level_info['level_classified_allow'] & 2) && $page=="profile" )
{
  // START CLASSIFIED
  $classified = new se_classified($owner->user_info['user_id']);
  $listings_per_page = 5;
  $sort = "classified_date DESC";

  // GET PRIVACY LEVEL AND SET WHERE
  $privacy_max = $owner->user_privacy_max($user);
  $where = "(classified_privacy & $privacy_max)";

  // GET TOTAL LISTINGS
  $total_classifieds = $classified->classified_total($where);

  // GET LISTING ARRAY
  $classifieds = $classified->classified_list(0, $listings_per_page, $sort, $where);

  // ASSIGN ENTRIES SMARY VARIABLE
  $smarty->assign_by_ref('classifieds', $classifieds);
  $smarty->assign('total_classifieds', $total_classifieds);
  
  // SET PROFILE MENU VARS
  if( $total_classifieds )
  {
    $plugin_vars['menu_profile_tab'] = array('file'=> 'profile_classified.tpl', 'title' => 4500007, 'name' => 'classified');
    $plugin_vars['menu_profile_side'] = "";
  }
}


// Use new template hooks
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
  
  if( !empty($plugin_vars['menu_userhome']) )
    $smarty->assign_hook('user_home', $plugin_vars['menu_userhome']);

  if( strpos($page, 'classified')!==FALSE || $page=="profile" )
    $smarty->assign_hook('styles', './templates/styles_classified.css');
}



// SET HOOKS
SE_Hook::register("se_search_do", 'search_classified');
SE_Hook::register("se_user_delete", 'deleteuser_classified');
SE_Hook::register("se_site_statistics", 'site_statistics_classified');

?>