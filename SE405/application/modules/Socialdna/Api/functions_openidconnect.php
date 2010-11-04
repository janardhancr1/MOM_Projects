<?php


function openidconnect_html2txt($document){
  
  $text = str_ireplace('<br>', "\r\n", $document);
  $text = str_ireplace('<br/>', "\r\n", $text);
  
  $search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
                 '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
                 '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
                 '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
  );
  $text = preg_replace($search, '', $text);
  return $text;
}


function openidconnect_get_simple_cookie_domain($host = null) {
  
  if( !$host )  {
    $host = $_SERVER["HTTP_HOST"];
  }
  
  $host = parse_url($host);
  $host = $host['path'];
  $parts = explode('.', $host);
  
  switch( TRUE )
  {
    // Do not use custom for these:
    // IP Address
    case ( preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/', $host) ):
    // Intranet host
    case ( count($parts) === 1 ):
      return null;
      break;
    
    // Second level ccld
    case ( strlen($parts[count($parts)-1]) == 2 && strlen($parts[count($parts)-2]) <= 3 ):
      array_splice($parts, 0, count($parts) - 3);
      return join('.', $parts);
      break;
    
    // tld or first-level ccld
    default:
      array_splice($parts, 0, count($parts) - 2);
      return join('.', $parts);
  }
  
  return null;
}


function openidconnect_get_base_url() {
  
  // @tbd better
  return  "http://{$_SERVER['HTTP_HOST']}";
  
}


function openidconnect_debuglog($message) {
  static $log = null;
  
  if($log == null) {
    $log = fopen('socialdnalog.txt',"a+");
  }
  
  fwrite($log, $message . "\n");
}

?>