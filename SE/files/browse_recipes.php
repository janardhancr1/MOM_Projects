<?php
/* $Id: browse_recipes.php 59 2010-03-20 03:25:54Z Janardhan $ */

$page = "browse_recipes";
include "header.php";

// DISPLAY ERROR PAGE IF USER IS NOT LOGGED IN AND ADMIN SETTING REQUIRES REGISTRATION
if( (!$user->user_exists && !$setting['setting_permission_poll']) || ($user->user_exists && (1 & ~(int)$user->level_info['level_poll_allow'])) )
{
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 656);
  $smarty->assign('error_submit', 641);
  include "footer.php";
}

// SET GLOBAL PAGE TITLE
$global_page_title[0] = 7000005; 

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

include "footer.php";

?>