<?
include "./include/database_config.php";
include "./include/functions_general.php";
include "./include/class_database.php";

// INITIATE DATABASE CONNECTION
$database = new se_database($database_host, $database_username, $database_password, $database_name);

//######### CREATE se_ratings
if($database->database_num_rows($database->database_query("SHOW TABLES FROM `$database_name` LIKE 'se_ratings'")) == 0) {
  $database->database_query("CREATE TABLE `se_ratings` (
  `rating_id` int(9) NOT NULL auto_increment,
  `rating_object_table` varchar(35) NOT NULL default '0',
  `rating_object_primary` varchar(30) NOT NULL default '0',
  `rating_object_id` int(9) NOT NULL default '0',
  `rating_value` float NOT NULL default '0',
  `rating_raters` text NULL,
  `rating_raters_num` int(9) NOT NULL default '0',
  PRIMARY KEY  (`rating_id`)
  )");
}



if($database->database_num_rows($database->database_query("SHOW TABLES FROM `$database_name` LIKE 'se_ratings'")) == 1) {
  echo "
  <html>
  <head>
  <title>Rating System Installation</title>
  <style type='text/css'>
  body, td, div {
	font-family: \"Trebuchet MS\", tahoma, verdana, arial, serif;
	font-size: 10pt;
	color: #333333;
	line-height: 16pt;
  }
  h1 {
	font-size: 16pt;
	margin-bottom: 4px;
  }
  h2 {
	font-size: 12pt;
	margin-bottom: 4px;
  }
  .box {
	padding: 10px 13px 10px 13px; 
	border: 1px dashed #BBBBBB;
  }
  ul {
	margin-top: 2px;
	margin-bottom: 2px;
  }
  input.text {
	font-family: \"Trebuchet MS\", tahoma, verdana, arial, serif;
  }
  input.button {
	background: #EEEEEE;
	font-weight: bold;
	padding: 2px;
	font-family: \"Trebuchet MS\", tahoma, verdana, arial, serif;
  }
  form {
	margin: 0px;
  }
  a:link { color: #2078C8; text-decoration: none; }
  a:visited { color: #2078C8; text-decoration: none; }
  a:hover { color: #3FA4FF; text-decoration: underline; }
  </style>
  </head>
  <body>
  <h1>Rating System Installation</h1>
  Installation of the rating system tables is complete. Please be sure to delete this file (install_rating.php)
  as it may pose a security risk.  
  

  <br /><br />
  ©2007 Webligo Developments
  </body>
  </html>
  ";
}


?>