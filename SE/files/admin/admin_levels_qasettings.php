<?php

$page = "admin_levels_qasettings";
include "admin_header.php";

if(isset($_POST['task'])) { $task = $_POST['task']; } else { $task = "main"; }
if(isset($_POST['level_id'])) { $level_id = $_POST['level_id']; } elseif(isset($_GET['level_id'])) { $level_id = $_GET['level_id']; } else { $level_id = 0; }

// VALIDATE LEVEL ID
$level = $database->database_query("SELECT * FROM se_levels WHERE level_id='$level_id'");
if($database->database_num_rows($level) != 1) { header("Location: admin_levels.php"); exit(); }
$level_info = $database->database_fetch_assoc($level);

// SET RESULT VARIABLE
$result = 0;
$is_error = 0;


// SAVE CHANGES
if($task == "dosave")
{
  $level_info['level_qa_allow']    = $_POST['level_qa_allow'];


	$database->database_query("
	  UPDATE se_levels SET 
			level_qa_allow='$level_info[level_qa_allow]'
	  WHERE level_id='$level_info[level_id]' LIMIT 1
	");
		
	$result = 1;
} // END DOSAVE TASK



// ASSIGN VARIABLES AND SHOW ALBUM SETTINGS PAGE
$smarty->assign('result', $result);
$smarty->assign('is_error', $is_error);
$smarty->assign('level_info', $level_info);
include "admin_footer.php";
?>