<?php

/* $Id: browse_music.php 42 2009-01-29 04:55:14Z john $ */

$page = "browse_music";
include "header.php";

// DISPLAY ERROR PAGE IF USER IS NOT LOGGED IN AND ADMIN SETTING REQUIRES REGISTRATION
if(!$user->user_exists )
{
  $page = "error";
  $smarty->assign('error_header', 639);
  $smarty->assign('error_message', 656);
  $smarty->assign('error_submit', 641);
  include "footer.php";
}

if(isset($_POST['p'])) { $p = $_POST['p']; } elseif(isset($_GET['p'])) { $p = $_GET['p']; } else { $p = 1; }
if(isset($_POST['s'])) { $s = $_POST['s']; } elseif(isset($_GET['s'])) { $s = $_GET['s']; } else { $s = "music_date DESC"; }
if(isset($_POST['v'])) { $v = $_POST['v']; } elseif(isset($_GET['v'])) { $v = $_GET['v']; } else { $v = 0; }

// ENSURE SORT/VIEW ARE VALID
if($s != "music_date DESC" && $s != "music_track_num ASC") { $s = "music_date DESC"; }
if($v != "0" && $v != "1") { $v = 0; }


// ONLY MY FRIENDS' MUSIC
if( $v=="1" && $user->user_exists )
{
  // SET WHERE CLAUSE
  $where = "(
    SELECT
      TRUE
    FROM
      se_friends
    WHERE
      friend_user_id1='{$user->user_info['user_id']}' &&
      friend_user_id2=se_music.music_user_id &&
      friend_status=1
    ) 
  ";
}

// SET GLOBAL PAGE TITLE
$global_page_title[0] = 4000004; 

// CREATE ALBUM OBJECT
$music_object = new se_music();

// GET TOTAL ALBUMS
$browse_music_total = $music_object->music_list_total(NULL, NULL, $where);

// MAKE ENTRY PAGES
$music_per_page = 20;
$page_vars = make_page($browse_music_total, $music_per_page, $p);

// GET ALBUM ARRAY
$browse_music_list = $music_object->music_list($page_vars[0], $music_per_page, $s, $where);

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);

// ASSIGN SMARTY VARIABLES AND DISPLAY MUSIC PAGE
$smarty->assign('browse_music_list', $browse_music_list);
$smarty->assign('browse_music_total', $browse_music_total);
$smarty->assign('p', $page_vars[1]);
$smarty->assign('maxpage', $page_vars[2]);
$smarty->assign('p_start', $page_vars[0]+1);
$smarty->assign('p_end', $page_vars[0]+count($browse_music_list));
$smarty->assign('s', $s);
$smarty->assign('v', $v);
include "footer.php";
?>