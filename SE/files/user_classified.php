<?php

/* $Id: user_classified.php 53 2009-02-06 04:55:08Z john $ */

$page = "user_classified";
include "header.php";

if(isset($_POST['task'])) { $task = $_POST['task']; } elseif(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = "main"; }
if(isset($_POST['p'])) { $p = $_POST['p']; } elseif(isset($_GET['p'])) { $p = $_GET['p']; } else { $p = 1; }
if(isset($_POST['search'])) { $search = $_POST['search']; } elseif(isset($_GET['search'])) { $search = $_GET['search']; } else { $search = ""; }

// ENSURE CLASSIFIEDS ARE ENABLED FOR THIS USER
if( 2 & ~(int)$user->level_info['level_classified_allow'] )
{
  header("Location: user_home.php");
  exit();
}

// SET CLAUSES
$sort = "classified_date DESC";
if( trim($search) )
  $where = "(classified_title LIKE '%{$search}%' || classified_body LIKE '%{$search}%')";
else
  $where = NULL;

// CREATE CLASSIFIED OBJECT
$entries_per_page = 10;
$classified = new se_classified($user->user_info['user_id']);

// DELETE NECESSARY ENTRIES
//$start = ($p - 1) * $entries_per_page;
//if($task == "delete") { $classified->classified_delete($start, $entries_per_page, $sort, $where); }

// GET TOTAL ENTRIES
$total_classifieds = $classified->classified_total($where);

// MAKE ENTRY PAGES
$page_vars = make_page($total_classifieds, $entries_per_page, $p);

// GET ENTRY ARRAY
$classifieds = $classified->classified_list($page_vars[0], $entries_per_page, $sort, $where);

// GET RECENT SIGNUPS
$signup_array = recent_signups();
$smarty->assign_by_ref('signups', $signup_array);

// GET RECENT POPULAR USERS (MOST FRIENDS)
$friend_array = popular_users();
$smarty->assign_by_ref('friends', $friend_array);


// ASSIGN VARIABLES AND SHOW VIEW ENTRIES PAGE
$smarty->assign('search', $search);
$smarty->assign('classifieds', $classifieds);
$smarty->assign('total_classifieds', $total_classifieds);
$smarty->assign('p', $page_vars[1]);
$smarty->assign('maxpage', $page_vars[2]);
$smarty->assign('p_start', $page_vars[0]+1);
$smarty->assign('p_end', $page_vars[0]+count($classifieds));
include "footer.php";
?>