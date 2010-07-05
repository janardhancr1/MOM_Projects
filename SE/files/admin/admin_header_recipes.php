<?php

/* $Id: admin_header_recipe.php 12 2009-01-11 06:04:12Z john $ */

// ENSURE THIS IS BEING INCLUDED IN AN SE SCRIPT
defined('SE_PAGE') or exit();

// INCLUDE RECIPE CLASS FILE
include "../include/class_recipe.php";

// INCLUDE RECIPE FUNCTION FILE
include "../include/functions_recipe.php";


// SET HOOKS
SE_Hook::register("se_user_delete", "deleteuser_recipe");

SE_Hook::register("se_site_statistics", "site_statistics_recipe");

?>