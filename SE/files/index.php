<?php

/* $Id: index.php 8 2009-01-11 06:02:53Z john $ */

$page = "index";
include "header.php";

// DISPLAY ERROR PAGE IF USER IS NOT LOGGED IN AND ADMIN SETTING REQUIRES REGISTRATION
if( $user->user_exists)
{
  cheader("home.php");
}

include "footer.php";
?>