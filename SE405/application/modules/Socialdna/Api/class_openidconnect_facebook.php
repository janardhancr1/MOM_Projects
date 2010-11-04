<?php

define('OPENIDCONNECT_FACEBOOK_PIC_SQUARE_DEFAULT','http://static.ak.fbcdn.net/pics/q_silhouette.gif');


class openidfacebook extends openidapi {

  var $facebook_api_key;
  var $facebook_secret;

  var $user_details = array();
  
  var $api_client = null;
  

  function openidfacebook($api_key, $secret) {

    parent::openidapi($api_key, $secret, 'fbsession');
    
    $this->facebook_api_key = $api_key;
    $this->facebook_secret = $secret;
    
  }
  
  
  function verify_api_keys() {

	$facebook = $this->api_client();

    // no need for session key
    $session_key = $facebook->api_client->session_key;
	$facebook->api_client->session_key = null;

    try {

      $result = $facebook->api_client->admin_getAppProperties( array('app_id') );

    } catch (Exception $ex) {
      
      $this->error_message = $ex->getMessage();
      
      // TBD: watch for API_EC_UNKNOWN, API_EC_SERVICE, etc
      return false;
      
    }
    
	$facebook->api_client->session_key = $session_key;
    
    return true;
      
  }
  
  function &api_client() {
    if($this->api_client == null) {
      $this->api_client = new Facebook($this->facebook_api_key, $this->facebook_secret);
    }
    
    return $this->api_client;
  }



  /*** LOCAL FUNCTIONS ***/
  
  function get_session() {

      $facebook = $this->api_client();
      return array('session_key'      => $facebook->api_client->session_key,
                   'session_secret'   => '',
                   'user'             => $facebook->user
                   //'session_secret'   => $facebook->api_client->session_key,
                   );
  }

  /*** REMOTE FUNCTIONS ***/
  

  function get_user_details() {

    $facebook = $this->api_client();

    $session = new Zend_Session_Namespace('Socialdna');
    $openid_imported_fields_cache = $session->openid_imported_fields;

    $this->user_id = $facebook->get_loggedin_user();

    // no user
    if(is_null($this->user_id)) {
      return false;
    }

    $session_key = 'facebook_' . $this->user_id;
    
    // try to load cached values
    if(($openid_imported_fields_cache !== false) && isset($openid_imported_fields_cache[$session_key])) {
      
      $user_details = $openid_imported_fields_cache[$session_key];
      
    } else {

      //$this->user_id = $facebook->get_loggedin_user();

      // no user
      //if(is_null($this->user_id)) {
        //return false;
      //}
    
      /*** IMPORT FB USER DETAILS ***/
      
      $fields = array('first_name', 'last_name', 'name', 'birthday', 'birthday_date', 'sex',
                      'about_me', 'activities', 'interests', 'movies', 'music', 'quotes',
                      'books', 'hometown_location', 'pic_big', 'political', 'timezone', 'tv', 'profile_url',
                      'status','current_location', 'meeting_for','meeting_sex','relationship_status','religion',
                      'pic','pic_square', 'pic_square_with_logo', 'proxied_email', 'email'
                      );

      try {    

        $fb_user_details = $facebook->api_client->users_getInfo($this->user_id, $fields);
        
      } catch (Exception $ex) {
        
        // session expired
        if($ex->getCode() == 102) {
  
          // clear all FB session cookies
          $cookies = array('user', 'session_key', 'expires', 'ss');
          foreach ($cookies as $name) {
            setcookie($this->facebook_api_key . '_' . $name, false, time() - 3600);
            unset($_COOKIE[$this->facebook_api_key . '_' . $name]);
          }
          setcookie($this->facebook_api_key, false, time() - 3600);
          unset($_COOKIE[$this->facebook_api_key]);
          
        }
        
        return false;

      }
  

      /*** REFACTOR FIELDS ***/
      
      $user_details = $fb_user_details[0];  
     
      $user_details['meeting_for'] = is_array($user_details['meeting_for']) ? implode(',',$user_details['meeting_for']) : '';
      $user_details['meeting_sex'] = is_array($user_details['meeting_sex']) ? implode(',',$user_details['meeting_sex']) : '';
      $user_details['birthday'] = $user_details['birthday_date'];
      
      // hometown_location
      if(Semods_Utils::g($user_details,'hometown_location','') != '') {
        $hometown_location = $user_details['hometown_location'];
        $user_details['hometown_location_city'] = Semods_Utils::g($hometown_location,'city','');
        $user_details['hometown_location_state'] = Semods_Utils::g($hometown_location,'state','');
        $user_details['hometown_location_country'] = Semods_Utils::g($hometown_location,'country','');
        $user_details['hometown_location_zip'] = Semods_Utils::g($hometown_location,'zip','');
      }
      unset($user_details['hometown_location']);
  
      // current_location
      if(Semods_Utils::g($user_details,'current_location','') != '') {
        $current_location = $user_details['current_location'];
        $user_details['current_location_city'] = Semods_Utils::g($current_location,'city','');
        $user_details['current_location_state'] = Semods_Utils::g($current_location,'state','');
        $user_details['current_location_country'] = Semods_Utils::g($current_location,'country','');
        $user_details['current_location_zip'] = Semods_Utils::g($current_location,'zip','');
      }
      unset($user_details['current_location']);
      
      $user_details['user_id'] = $this->user_id;
      
      $user_details['openid_service_id'] = 1;
      
      // auto generate username from first / last
      $user_details['nickname'] = $user_details['first_name'] . $user_details['last_name'];
      
      // email
      //$user_details['email'] = $user_details['proxied_email'];
      if(Semods_Utils::getSetting('socialdna.openidconnect_facebookemail',0) == 0) {
        
        // if the email is proxied email, don't import it
        if($user_details['email'] == $user_details['proxied_email']) {
          $user_details['email'] = '';
        }
        
      }
      
      // cache
      $openid_imported_fields_cache[$session_key] = $user_details;
      $session->openid_imported_fields = $openid_imported_fields_cache;
    }

    $this->user_details = $user_details;

    return true;
  }



  function get_loggedin_user() {
    $facebook = $this->api_client();

    $user_id = null;
    
    try {    
      
      $user_id = $facebook->get_loggedin_user();
      
    } catch (Exception $ex) {

      
    }
    
    return is_null($user_id) ? 0 : $user_id;
    
  }
  
  // mutual friends ?
  // http://wiki.developers.facebook.com/index.php/Friends.getMutualFriends
  function get_linked_friends($start = 0, $limit = 10, $orderby = "", $mutual_facebook_user_id = 0) {

    $facebook = $this->api_client();
    
    $fb_current_user = $facebook->get_loggedin_user();
  
    $fql = "SELECT uid, pic_square, pic_square_with_logo FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = {$fb_current_user}) AND has_added_app = 1";
    //$fql = "SELECT uid, name, pic_square, pic_square_with_logo, has_added_app FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = {$fb_current_user})";

    $friends = array();
    $users = array();
    
    try {    

      $result = $facebook->api_client->fql_query($fql);
      
      if (is_array($result) && count($result)) {
        $friends = $result;
      }
      
    } catch (Exception $ex) {
      
      // session expired or else
      
    }
    
    return $friends;
    
  }
  

  function get_unlinked_friends($max = 0) {

    $facebook = $this->api_client();
    
    $fb_current_user = $facebook->get_loggedin_user();
    
    $fql = "SELECT uid, name, pic_square, pic_square_with_logo FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = {$fb_current_user}) AND has_added_app = 0";

    $users = array();
    
    try {    

      $result = $facebook->api_client->fql_query($fql);

      if (is_array($result) && count($result)) {
        $users = $result;
      }
      
    } catch (Exception $ex) {
      
      // session expired or else

      
    }
	
	shuffle($users);
      
    if($max != 0) {
      $users = array_slice($users, 0, $max);
    }
    
    // fill empty pics
    foreach($users as $key => $fb_user) {
      if($fb_user['pic_square'] == '') {
        $fb_user['pic_square'] = $fb_user['pic_square_with_logo'] = OPENIDCONNECT_FACEBOOK_PIC_SQUARE_DEFAULT;
        $users[$key] = $fb_user;
      }
    }
    
    return $users;
    
  }
  

  function get_linked_friends_stats() {

    $facebook = $this->api_client();
    
    $fb_current_user = $facebook->get_loggedin_user();

    $fql = "SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = {$fb_current_user}) AND has_added_app = 1";

    $connected_friends = 0;
    $unconnected_friends = 0;

    try {    

      $result = $facebook->api_client->fql_query($fql);
      
      $connected_friends = count($result);

      $friends = $facebook->api_client->friends_get();
      $friends_count = count($friends);
      
      $unconnected_friends = $friends_count - $connected_friends;
      
    } catch (Exception $ex) {

      return false;

    }
  
    
    
    return array('connected_friends'  => $connected_friends,
                 'unconnected_friends' => $unconnected_friends
                );
    
  }
  
  function hasPermission($permission) {

    $facebook = $this->api_client();

    try {    

      $result = $facebook->api_client->users_hasAppPermission($permission);
      
    } catch (Exception $ex) {
      
      $result = false;

    }
    
    return $result;
    
  }

  function publish_status($text, $user_id = '', $services = '', $reference_id = '') {

    $facebook = $this->api_client();

    try {    

      $result = $facebook->api_client->users_setStatus($text);
      
    } catch (Exception $ex) {
      
      $result = false;

    }
    
    return $result;
  }
  
  function get_signup_landing_page() {
    return 'socialdna_facebookinvite';
  }
  
  
  
  function link_user($user_id) {
    
    // not implemented
  
    return true;
  
  }
  
  

  
}




?>