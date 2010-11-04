<?php

class openidapi {

  var $api_key;
  var $secret;

  var $session;
  var $user_details = array();
  var $user_id = null;
  
  var $server_addr = "http://www.openidgo.com/restserver.php";
  

  function openidapi($api_key, $secret, $session_key = '') {
    $this->api_key = $api_key;
    $this->secret = $secret;
    
    $this->session = $session_key;
  }



  /*** LOCAL FUNCTIONS ***/
  


  /*** REMOTE FUNCTIONS ***/
  
  /*
   * TODO: if no session - show "login via" form. now - just redirect to login
   *
   */
  function require_login($redirect = null) {
    if(($this->session == null) || !$this->get_user_details()){
      if(!empty($redirect)) {
        //redirect($redirect);
      } else {
        return false;
      }
    }
    
    return isset($this->user_details['user_id']) && !empty($this->user_details['user_id']);
  }


  function is_logged_in() {
    if(($this->session == null) || !$this->get_user_details()){
      return false;
    }
    
    return true;
  }

  function get_user_details() {


    $session = new Zend_Session_Namespace('Socialdna');

    $openid_imported_fields_cache = $session->openid_imported_fields;
    $session_key = 'api_' . $this->session;

    // try to load cached values
    if((!empty($openid_imported_fields_cache)) && isset($openid_imported_fields_cache[$session_key])) {
      
      $result = $openid_imported_fields_cache[$session_key];
      
    } else {
    
      $result = $this->call_method
            ('getUserDetails',
             array('session' => $this->session
                   )
             );
  
      // error occured
      if($result === null) {
          return false;
      }
      
      // cache
      $openid_imported_fields_cache[$session_key] = $result;
      $session->openid_imported_fields = $openid_imported_fields_cache;
    }
    

    $this->user_details = $result;

    return true;
  }


  function getFieldValue($field_key, $default = '') {
    return isset($this->user_details[$field_key]) ? $this->user_details[$field_key] : $default;
  }
  
  // prototype
  function hasPermission($permission) {
    return false;
  }

  // prototype
  function get_loggedin_user() {
    return 0;
  }
  
  // prototype
  function get_linked_friends($start = 0, $limit = 10, $orderby = "") {
    return array();
  }

  // prototype
  function get_unlinked_friends($max = 0) {
    return array();
  }

  // prototype
  function get_linked_friends_stats() {
    return array();
  }

  function get_signup_landing_page() {
    return '';
  }

  function get_session() {
      return array('session_key'      => '',
                   'session_secret'   => ''
                   );
  }
  
  function publish_status($text, $user_id = '', $services = '', $reference_id = '') {

    $result = $this->call_method
          ('updateStatus',
           array('status'   => $text,
                 'services' => $services,
                 'uid'      => $user_id,
                 'rid'      => $reference_id
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }

    return $result;

  }

  function update_session($openid_user_id, $session_key, $session_secret, $user_id = '', $service_id = '') {

    $result = $this->call_method
          ('updateSession',
           array('sessionkey'     => $session_key,
                 'sessionsecret'  => $session_secret,
                 'userkey'        => $openid_user_id,
                 'uid'            => $user_id,
                 'serviceid'      => $service_id
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }

    return $result;

  }

  function publish_feed_story($user_id, $feed_story, $services = '') {

    $feed_story = base64_encode(serialize($feed_story));
    
    $result = $this->call_method
          ('publishFeedStory',
           array('story'    => $feed_story,
                 'services' => $services,
                 'uid'      => $user_id,
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }

    return $result;

  }

  function link_user($user_id) {

    $result = $this->call_method
          ('linkUser',
           array('session' => $this->session,
                 'uid'     => $user_id
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }
    
    return $result;

  }


  function unlink_user($user_id, $services) {

    $result = $this->call_method
          ('unlinkUser',
           array('services' => $services,
                 'uid'      => $user_id
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }

    return $result;

  }

  /*
  $users = array(
                 array( 'u' => '<user_id>',
                        's' => '<service_id>'  or 'n' => '<network_id>' ?
                      )
                 );
  */

  function send_message($user_id, $users, $message, $subject = '' ) {
    
    if(is_array($users)) {
      foreach($users as $user_key => $user_value) {
        $users[$user_key] = implode(',',$user_value);  
      }
  
      $users = implode(',',$users);
    }
    
    $result = $this->call_method
          ('sendMessage',
           array(
                 'subject'  => $subject,
                 'message'  => $message,
                 'users'    => $users,
                 'uid'      => $user_id,
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }

    if(isset($result['err_msg'])) {
      //return $result;
      return array( 'err_msg' => $result['err_msg'], 'err_code' => Semods_Utils::g($result,'err_code') );
    }
    
    return $result;
  }

  function get_friends($user_id, $services = '') {

    $result = $this->call_method
          ('getFriends',
           array('services'   => $services,
                 'uid'        => $user_id,
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }
    
    if(isset($result['err_msg'])) {
      return array( 'err_msg' => $result['err_msg'], 'err_code' => Semods_Utils::g($result,'err_code') );
    }
    
    return $result['friends'];
  }


  function get_events($user_id, $services = '', $start_time = 0, $end_time = 0) {

    $result = $this->call_method
          ('getEvents',
           array('services'   => $services,
                 'uid'        => $user_id,
                 'start_time' => $start_time,
                 'end_time'   => $end_time
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }
    
    if(isset($result['err_msg'])) {
      return array( 'err_msg' => $result['err_msg'], 'err_code' => Semods_Utils::g($result,'err_code') );
    }
    
    return $result['events'];
  }


  function get_albums($user_id, $services = '') {

    $result = $this->call_method
          ('getAlbums',
           array('services'   => $services,
                 'uid'        => $user_id,
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }
    
    if(isset($result['err_msg'])) {
      return array( 'err_msg' => $result['err_msg'], 'err_code' => Semods_Utils::g($result,'err_code') );
    }
    
    return $result['albums'];
  }



  function get_photos($user_id, $services = '', $albums = '') {

    $result = $this->call_method
          ('getPhotos',
           array('services'   => $services,
                 'uid'        => $user_id,
                 'aid'        => $albums
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }
    
    if(isset($result['err_msg'])) {
      return array( 'err_msg' => $result['err_msg'], 'err_code' => Semods_Utils::g($result,'err_code') );
    }
    
    return $result['photos'];
  }



  function get_newsfeed($user_id, $services = '', $source = '') {

    $result = $this->call_method
          ('getNewsfeed',
           array('services'   => $services,
                 'uid'        => $user_id,
                 'source'     => $source,
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }
    
    if(isset($result['err_msg'])) {
      return array( 'err_msg' => $result['err_msg'], 'err_code' => Semods_Utils::g($result,'err_code') );
    }
    
    return isset($result['newsfeed']) ? $result['newsfeed'] : array();
  }


  function get_metadata($user_id, $services = '', $params = array()) {

    $params = base64_encode(serialize($params));

    $result = $this->call_method
          ('getMetadata',
           array('services'   => $services,
                 'uid'        => $user_id,
                 'params'     => $params,
                 )
           );

    // error occured
    if($result === null) {
        return false;
    }
    
    if(isset($result['err_msg'])) {
      return array( 'err_msg' => $result['err_msg'], 'err_code' => Semods_Utils::g($result,'err_code') );
    }
    
    return isset($result['metadata']) ? $result['metadata'] : array();
  }


  function set_application_settings($service, $key, $secret) {

    $params = array( 'service'  => $service,
                     'key'      => $key,
                     'secret'   => $secret,
                    );

    $data = $this->convert_array_to_params( $params );

    $c = $this->encrypt($data);

    $result = $this->call_method
          ('setApplicationSettings',
           array('b' => $data,
                 'c' => $c ));

    // error occured
    if($result === null) {
        return false;
    }
    
    return $result;
  }


  function call_api($method, $params = array()) {

    $result = $this->call_method($method, $params);

    // error occured
    if($result === null) {
        return false;
    }

    return $result;

  }


  /*** INTERNAL FUNCTIONS ***/

  function getErrorCode() {
    return $this->errID;
  }

  function getErrorMessage() {
    return $this->errMsg;
  }

  function clearError() {
    $this->errID = 0;
    $this->errMsg = '';
  }

  function call_method($method, $params) {
    $this->clearError();
    $xml = $this->post_request($method, $params);
    if(is_null($xml))
      return null;
    
    $result = $this->load_and_parse_xml( $xml );
    if (is_array($result) && isset($result['error_code'])) {
        $this->errMsg = $result['error_msg'];
        $this->errID = $result['error_code'];
        return null;
    }
    return $result;
  }

  function load_and_parse_xml($xml) {
    if(function_exists('simplexml_load_string')) {
      $sxml = @simplexml_load_string($xml);
      return $this->convert_simplexml_to_array( $sxml );
    } else {

      //include_once 'include/simplexml44-0_4_4/class/IsterXmlSimpleXMLImpl.php';

      $impl = new IsterXmlSimpleXMLImpl();
      $sxml = $impl->load_string($xml);
      $result = array();
      $children = $sxml->children();
      return $this->convert_simplexml44_to_array($children[0]);

    }


  }


  function post_request($method, $params) {
    $params['method'] = $method;
    $params['api_key'] = $this->api_key;
    if (!isset($params['v'])) {
      $params['v'] = '1.2';
    }

    $post_string = $this->convert_array_to_params( $params, true );

    // Use CURL if installed
    if (function_exists('curl_init'))
      return $this->post_request_with_curl( $post_string );
    else {
      $result = $this->post_request_without_curl( $post_string );

      // no url wrappers / allow_url_fopen is disabled
      if(($result == null) && ($this->errID == 1001)) {
        $this->errID = 0;
        $this->errMsg = '';
        $result = $this->post_request_without_curl_php4( $post_string );
      }
      
      return $result;
    }

  }

  function post_request_with_curl($data) {
      $ch = curl_init();

      curl_setopt( $ch, CURLOPT_URL, $this->server_addr );
      //curl_setopt( $ch, CURLOPT_TIMEOUT, 5 ); 
      curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5 ); // connect timeout
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch, CURLOPT_ENCODING, '' );
      curl_setopt( $ch, CURLOPT_FAILONERROR, 1 );
      curl_setopt( $ch, CURLOPT_USERAGENT, 'OpenidGO PHP REST Client 1.0 (curl) ' . phpversion() );

      // avoid '100 Continue response'
      curl_setopt( $ch, CURLOPT_HTTPHEADER, array("Expect:" ));

      $result = curl_exec($ch);
      if(curl_errno($ch)) {
        $this->errMsg = 'HTTP Error: ' . curl_error( $ch );
        $this->errID = $this->API_E_HTTP;
        return null;
      }
      curl_close($ch);
      return $result;
  }

  function post_request_without_curl($data) {
      $context_opts =
        array('http' =>
              array('method' => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded' . "\r\n" .
                                'User-Agent: OpenidGO PHP REST Client 1.0 (non-curl) '. phpversion() . "\r\n" .
                                'Content-Length: ' . strlen($data),
                    'content' => $data));
      $context = stream_context_create($context_opts);
      $fp = @fopen($this->server_addr, 'r', false, $context);
      if (!$fp) {
        $this->errMsg = 'HTTP Error';
        $this->errID = 1001;
        return null;
      }
      $result = @stream_get_contents($fp);
      if( $result === false ) {
        $this->errMsg = 'HTTP Error';
        $this->errID = $this->API_E_HTTP;
        return null;
      }
      return $result;
  }

  function post_request_without_curl_php4($data) {
    // url MUST have scheme
	$start = strpos( $this->server_addr, '//' ) + 2;
	$end = strpos( $this->server_addr, '/', $start );
	$host = substr( $this->server_addr, $start, $end - $start );
	$post_path = substr( $this->server_addr, $end );
    $fp = @fsockopen( $host, 80 );
    if (!$fp) {
      $this->errMsg = 'HTTP Error';
      $this->errID = $this->API_E_HTTP;
      return null;
    }
    fputs( $fp, "POST $post_path HTTP/1.0\n" .
                "Host: $host\n" .
                'User-Agent: OpenidGO PHP REST Client 1.0 (non-curl) '. phpversion() . "\n" .
                "Content-Type: application/x-www-form-urlencoded\n" .
                "Content-Length: " . strlen($data) . "\n\n" .
                "$data\n\n" );
	$response = '';
	while(!feof($fp)) {
		$response .= fgets($fp, 4096);
	}
	fclose ($fp);
    // get response code
    preg_match( '/^\S+\s(\S+)/', $response, $matches );
    if( $matches[1] != "200" ) {
      $this->errMsg = 'HTTP Error';
      $this->errID = $this->API_E_HTTP;
      return null;
    }
    // get response body
    preg_match( '/\r?\n\r?\n(.*?)$/sD', $response, $matches );
    $response = $matches[1];
	return $response;
  }

  function convert_array_to_params($params, $addSig = false) {
    $post_params = array();
    foreach ($params as $key => $val) {
      if (is_array($val)) $val = implode(',', $val);
      $post_params[] = $key.'='.urlencode($val);
    }
    if($addSig) {
        $secret = $this->secret;
        $post_params[] = 'sig='.$this->generate_sig($params, $secret);
    }

    return implode('&', $post_params);
  }

  function convert_simplexml_to_array($sxml) {
    $arr = array();
    if ($sxml) {
      foreach ($sxml as $k => $v) {
        if ($sxml['list']) {
          $arr[] = $this->convert_simplexml_to_array($v);
        } else {
          $arr[$k] = $this->convert_simplexml_to_array($v);
        }
      }
    }
    if (sizeof($arr) > 0) {
      return $arr;
    } else {
      return (string)$sxml;
    }
  }

  function convert_simplexml44_to_array($sxml) {
    if ($sxml) {
      $arr = array();
      $attrs = $sxml->attributes();
      foreach ($sxml->children() as $child) {
        if (!empty($attrs['list'])) {
          $arr[] = $this->convert_simplexml44_to_array($child);
        } else {
          $arr[$child->___n] = $this->convert_simplexml44_to_array($child);
        }
      }
      if (sizeof($arr) > 0) {
        return $arr;
      } else {
        return (string)$sxml->CDATA();
      }
    } else {
      return '';
    }
  }

  function generate_sig($params_array, $secret) {
    $str = '';
    ksort($params_array);
    foreach ($params_array as $k=>$v) {
      $str .= "$k=$v";
    }
    $str .= $secret;
    return md5($str);
  }

  function encrypt(&$data) {
    return $this->crypt_internal($data);

    if( extension_loaded('mcrypt') )
        return $this->crypt_mcrypt($data);
    else
        return $this->crypt_internal($data);
  }

  function crypt_mcrypt(&$data) {
    $data = bin2hex( mcrypt_ecb (MCRYPT_BLOWFISH, $this->secret, $data, MCRYPT_ENCRYPT) );
    return 1;
  }

  function crypt_internal(&$data) {

    $key = $this->secret;
    $s = array();
    $len= strlen($key);
    for ($i = 0; $i < 256; $i++) {
        $s[$i] = $i;
    }

    $j = 0;
    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $s[$i] + ord($key[$i % $len])) % 256;
        $t = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $t;
    }
    $i = $j = 0;

    $len= strlen($data);
    for ($c= 0; $c < $len; $c++) {
        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        $t = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $t;

        $t = ($s[$i] + $s[$j]) % 256;

        $data[$c] = chr(ord($data[$c]) ^ $s[$t]);
    }
    // required?
    $data = bin2hex($data);
    return 2;
  }

  function getErrorDescription($error_id) {
    if(is_empty($this->api_error_descriptions))
      $this->api_error_descriptions = array(
        $this->API_E_HTTP                      => 'HTTP Error',
        $this->API_E_HTTP_FOPEN                => 'HTTP Error',
        $this->API_E_SUCCESS                   => 'Success',
        $this->API_E_UNKNOWN                   => 'Unknown error occurred',
        $this->API_E_METHOD                    => 'Unknown method',
        $this->API_E_SIGNATURE                 => 'Signature verification failed',
        $this->API_E_PARAMS                    => 'Incomplete/Invalid parameters received',
        $this->API_E_API_KEY                   => 'Invalid API key',
        $this->API_E_TOO_MANY_CALLS            => 'Request limit reached',
        $this->API_E_BAD_IP                    => 'Unauthorized IP address',
        $this->API_E_NO_SERVICE                => 'Service temporarily unavailable',
        $this->API_E_NOT_SUBSCRIBED            => 'Not subscribed for this service',

        $this->API_E_INVALID_SESSION           => 'Invalid Session',
      );

      return $this->api_error_descriptions[$error_id];
  }


  /* Error codes and descriptions */


  var $API_E_SUCCESS = 0;

  var $API_E_HTTP = 1000;
  var $API_E_HTTP_FOPEN = 1001;

  /* Generic Errors */

  var $API_E_UNKNOWN = 1;
  var $API_E_METHOD = 2;
  var $API_E_SIGNATURE = 3;
  var $API_E_PARAMS = 4;
  var $API_E_API_KEY = 5;
  var $API_E_TOO_MANY_CALLS = 6;
  var $API_E_BAD_IP = 7;
  var $API_E_NO_SERVICE = 8;
  var $API_E_NOT_SUBSCRIBED = 9;

  /* Service Errors */

  var $API_E_INVALID_SESSION = 100;

  var $api_error_descriptions = array();
  
}



?>