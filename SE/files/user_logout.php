<?php

/* $Id: user_logout.php 239 2009-11-14 00:04:15Z john $ */

$page = "user_logout";
include "header.php";

if( @$_GET['token'] == $session->get('token') || strtoupper($_SERVER['REQUEST_METHOD']) === 'POST' )
{
  $user->user_logout();
}

// FORWARD TO USER LOGIN PAGE
cheader("index.php");
exit();
?>