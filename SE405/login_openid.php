<?php

define('_ENGINE_R_CONF', true);

include dirname(__FILE__).DIRECTORY_SEPARATOR.'application'.DIRECTORY_SEPARATOR.'index.php';

$base_url = '';
if(file_exists( APPLICATION_PATH_TMP . DIRECTORY_SEPARATOR . '__baseurl__.php')) {
  include_once APPLICATION_PATH_TMP . DIRECTORY_SEPARATOR . '__baseurl__.php';
}

$openidsession = $_GET['openidsession'];
$inpopup = isset($_GET['inpopup']) ? $_GET['inpopup'] : 0;

header('Location: http://'.$_SERVER['HTTP_HOST'].$base_url.'/socialdna/login/?openidsession='.$openidsession.'&inpopup='.$inpopup);
exit;


?>