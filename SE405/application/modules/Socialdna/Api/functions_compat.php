<?php

/* COMPATIBILITY */

if(!function_exists('file_put_contents')) {
  function file_put_contents($filename, $data, $file_append = false) {
   $fp = @fopen($filename, (!$file_append ? 'w+' : 'a+'));
   if(!$fp) {
     trigger_error('file_put_contents - can not write to file.', E_USER_ERROR);
     return false;
   }
   $total_written = fwrite($fp, $data);
   fclose($fp);
   return $total_written;
  }
}

/*
if (!function_exists('json_encode')) {
  require_once APPLICATION_PATH_COR . DS . 'libraries' . DS . 'Facebook' . DS . 'jsonwrapper' . DS . 'JSON' . DS . 'JSON.php';

  function json_encode($arg) {
      global $services_json;
      if (!isset($services_json)) {
          $services_json = new Services_JSON();
      }
      return $services_json->encode($arg);
  }

  function json_decode($arg) {
      global $services_json;
      if (!isset($services_json)) {
          $services_json = new Services_JSON();
      }
      return $services_json->decode($arg);
  }
}
*/
?>