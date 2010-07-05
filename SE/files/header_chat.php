<?php

/* $Id: header_chat.php 14 2009-01-12 09:36:11Z john $ */

// ENSURE THIS IS BEING INCLUDED IN AN SE SCRIPT
defined('SE_PAGE') or exit();

// INCLUDE CHAT FUNCTION FILE
include "./include/functions_chat.php";

// SET MAIN MENU VARS
//$plugin_vars['menu_main'] = "";
$plugin_vars['menu_main'] = array('file' => 'chat.php', 'title' => 3500025);;

// SET USER MENU VARS
if( $setting['setting_chat_enabled'] && $user->user_exists && $user->level_info['level_chat_allow'] )
{
  SE_Language::_preload(3500025);
  $plugin_vars['menu_user'] = Array('file' => 'chat.php', 'icon' => 'chat_chat16.gif', 'title' => 3500025);
}

SE_Hook::register("se_site_statistics", 'site_statistics_chat');

?>