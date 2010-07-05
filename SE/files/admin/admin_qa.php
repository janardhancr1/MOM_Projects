<?php

$page = "admin_qa";
include "admin_header.php";

if(isset($_POST['task'])) { $task = $_POST['task']; } elseif(isset($_GET['task'])) { $task = $_GET['task']; } else { $task = "main"; }


// SET RESULT VARIABLE
$result = 0;



// SAVE CHANGES
if($task == "dosave") {
  $setting[setting_permission_qa] = $_POST['setting_permission_qa'];
  $setting[setting_qa_code] = $_POST['setting_qa_code'];
  $setting[setting_qa_html] = str_replace(" ", "", $_POST['setting_qa_html']);
  $setting[setting_qa_ad_ids] = str_replace(" ", "", $_POST['setting_qa_ad_ids']);
  $setting[setting_qa_max_rating] = $_POST['setting_qa_max_rating'];
  $setting[setting_qa_user_vote_time_enabled] = $_POST['setting_qa_user_vote_time_enabled']=='on'?1:0;
  $setting[setting_qa_vote_time_default] = $_POST['setting_qa_vote_time_default'] * 86400;
  $setting[setting_qa_select_time_min] = $_POST['setting_qa_select_time_min'] * 3600;
  $setting[setting_qa_voting_time] = $_POST['setting_qa_voting_time'] * 86400;

  // SAVE CHANGES
  $database->database_query("UPDATE se_settings SET 
			setting_permission_qa='$setting[setting_permission_qa]',
			setting_qa_code = '$setting[setting_qa_code]',
			setting_qa_html = '$setting[setting_qa_html]',
			setting_qa_ad_ids = '$setting[setting_qa_ad_ids]',
			setting_qa_max_rating = '$setting[setting_qa_max_rating]',
			setting_qa_user_vote_time_enabled = '$setting[setting_qa_user_vote_time_enabled]',
			setting_qa_vote_time_default = '$setting[setting_qa_vote_time_default]',
			setting_qa_select_time_min = '$setting[setting_qa_select_time_min]',
			setting_qa_voting_time = '$setting[setting_qa_voting_time]'");

  $result = 1;
}








// GET TABS AND FIELDS
$field = new se_field("vt_qa");
$field->cat_list();
$cat_array = $field->cats;





// ASSIGN VARIABLES AND SHOW GENERAL SETTINGS PAGE
$smarty->assign('result', $result);
$smarty->assign('cats', $cat_array);
include "admin_footer.php";
?>