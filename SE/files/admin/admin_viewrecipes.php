<?php

/* $Id: admin_viewrecipes.php 12 2009-01-11 06:04:12Z john $ */

$page = "admin_viewrecipes";
include "admin_header.php";

if(isset($_POST['s'])) { $s = $_POST['s']; } elseif(isset($_GET['s'])) { $s = $_GET['s']; } else { $s = "id"; }
if(isset($_POST['p'])) { $p = $_POST['p']; } elseif(isset($_GET['p'])) { $p = $_GET['p']; } else { $p = 1; }
if(isset($_POST['f_title'])) { $f_title = $_POST['f_title']; } elseif(isset($_GET['f_title'])) { $f_title = $_GET['f_title']; } else { $f_title = ""; }
if(isset($_POST['f_owner'])) { $f_owner = $_POST['f_owner']; } elseif(isset($_GET['f_owner'])) { $f_owner = $_GET['f_owner']; } else { $f_owner = ""; }
if(isset($_POST['task'])) { $task = $_POST['task']; } elseif(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = "main"; }

if(isset($_POST['recipe_id'])) { $recipe_id = $_POST['recipe_id']; } elseif(isset($_GET['recipe_id'])) { $recipe_id = $_GET['recipe_id']; } else { $recipe_id = 0; }
if(isset($_POST['delete_recipes'])) { $delete_recipes = $_POST['delete_recipes']; } elseif(isset($_GET['delete_recipes'])) { $delete_recipes = $_GET['delete_recipes']; } else { $delete_recipes = NULL; }


// CREATE recipe OBJECT
$entries_per_page = 100;
$recipe = new se_recipe($owner->user_info['user_id']);

// DELETE SINGLE ENTRY
if( $task=="deleteentry" )
{
  $recipe->recipe_delete($recipe_id);
}

if( $task=="delete" && is_array($delete_recipes) && !empty($delete_recipes) )
{ 
  $recipe->recipe_delete($delete_recipes); 
}

// SET recipe ENTRY SORT-BY VARIABLES FOR HEADING LINKS
$i = "id";   // recipe_ID
$t = "t";    // recipe_name
$o = "o";    // OWNER OF ENTRY
$v = "v";    // TOTAL VOTES OF ENTRY
$d = "d";    // DATE OF ENTRY

// SET SORT VARIABLE FOR DATABASE QUERY
if($s == "i") {
  $sort = "se_recipes.recipe_id";
  $i = "id";
} elseif($s == "id") {
  $sort = "se_recipes.recipe_id DESC";
  $i = "i";
} elseif($s == "t") {
  $sort = "se_recipes.recipe_name";
  $t = "td";
} elseif($s == "td") {
  $sort = "se_recipes.recipe_name DESC";
  $t = "t";
} elseif($s == "o") {
  $sort = "se_users.user_username";
  $o = "od";
} elseif($s == "od") {
  $sort = "se_users.user_username DESC";
  $o = "o";
} elseif($s == "v") {
  $sort = "se_ratings.rating_value";
  $v = "vd";
} elseif($s == "vd") {
  $sort = "se_ratings.rating_value DESC";
  $v = "v";
} elseif($s == "d") {
  $sort = "se_recipes.recipe_datecreated";
  $d = "dd";
} elseif($s == "dd") {
  $sort = "se_recipes.recipe_datecreated DESC";
  $d = "d";
} else {
  $sort = "se_recipes.recipe_id DESC";
  $i = "i";
}

// ADD CRITERIA FOR FILTER
$where = "";
if($f_owner != "") { $where .= "se_users.user_username LIKE '%$f_owner%'"; }
if($f_owner != "" & $f_title != "") { $where .= " AND"; }
if($f_title != "") { $where .= " se_recipes.recipe_name LIKE '%$f_title%'"; }
if($where != "") { $where = "(".$where.")"; }

// DELETE NECESSARY ENTRIES
$start = ($p - 1) * $entries_per_page;


// GET TOTAL ENTRIES
$total_recipes = $recipe->recipe_total($where);

// MAKE ENTRY PAGES
$page_vars = make_page($total_recipes, $entries_per_page, $p);
$page_array = Array();
for($x=0;$x<=$page_vars[2]-1;$x++) {
  if($x+1 == $page_vars[1]) { $link = "1"; } else { $link = "0"; }
  $page_array[$x] = Array('page' => $x+1,
			  'link' => $link);
}

// GET ENTRY ARRAY
$recipes = $recipe->recipe_list($page_vars[0], $entries_per_page, $where, $sort, "rating");

// ASSIGN VARIABLES AND SHOW VIEW ENTRIES PAGE
$smarty->assign('total_recipes', $total_recipes);
$smarty->assign('pages', $page_array);
$smarty->assign('recipes', $recipes);
$smarty->assign('f_title', $f_title);
$smarty->assign('f_owner', $f_owner);
$smarty->assign('i', $i);
$smarty->assign('t', $t);
$smarty->assign('o', $o);
$smarty->assign('v', $v);
$smarty->assign('d', $d);
$smarty->assign('p', $page_vars[1]);
$smarty->assign('s', $s);
include "admin_footer.php";
?>