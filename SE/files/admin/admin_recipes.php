<?php

/* $Id: admin_recipe.php 12 2009-01-11 06:04:12Z john $ */

$page = "admin_recipe";
include "admin_header.php";

if(isset($_POST['task'])) { $task = $_POST['task']; } elseif(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = "main"; }

// SET RESULT VARIABLE
$result = 0;

if($task == "dosave")
{
  $setting_permission_recipe  = ( !empty($_POST['setting_permission_recipe']) ? $_POST['setting_permission_recipe'] : NULL );
  $setting_recipe_html        = ( !empty($_POST['setting_recipe_html'])       ? $_POST['setting_recipe_html']       : NULL );
  
  $setting_recipe_html  = str_replace(" ", "", $setting_recipe_html);
  
  $sql = "
    UPDATE
      se_settings
    SET
      setting_permission_recipe='$setting_permission_recipe',
      setting_recipe_html='$setting_recipe_html'
  ";
  
  $database->database_query($sql) or die($database->database_error()." SQL: ".$sql);
  
  $setting['setting_permission_recipe'] = $setting_permission_recipe;
  $setting['setting_recipe_html'] = $setting_recipe_html;
  $result = 1;
}

// ASSIGN VARIABLES AND SHOW GENERAL SETTINGS PAGE
$smarty->assign('result', $result);
include "admin_footer.php";
?>