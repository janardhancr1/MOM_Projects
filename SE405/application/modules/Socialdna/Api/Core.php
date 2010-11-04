<?php

if(!function_exists('simplexml_load_string')) {
  //require_once APPLICATION_PATH . 'include/library/simplexml44-0_4_4/class/IsterXmlSimpleXMLImpl.php';  
  require_once 'simplexml44-0_4_4/class/IsterXmlSimpleXMLImpl.php';  
}


require_once APPLICATION_PATH_COR . DS . 'modules' . DS . 'Socialdna' . DS . 'Api' . DS . 'class_openidconnect.php';
require_once APPLICATION_PATH_COR . DS . 'modules' . DS . 'Socialdna' . DS . 'Api' . DS . 'class_openidconnect_facebook.php';
require_once APPLICATION_PATH_COR . DS . 'modules' . DS . 'Socialdna' . DS . 'Api' . DS . 'functions_openidconnect.php';

// Facebook
require_once 'Facebook.php';


class Socialdna_Api_Core extends Core_Api_Abstract
{

  var $openidapi = null;
  var $publisherapi = array();
  var $openid_user_id = 0;
  var $openid_service_id = 0;
  var $fields_remap = null;
  
  var $signup_via_openid = false;

  var $valid_services = array('api','facebook','myspace','live','linkedin','hyves','yahoo','twitter');

  
  
  public function getServices($exclude_custom_logo = false, $only_enabled = false)
  {

      $cache_key = 'openidconnect_services_' . intval($exclude_custom_logo) . '_' . intval($only_enabled);
      
      
      
      $rows = Semods_Utils::getCache($cache_key);
      
      if($rows) {
        return $rows;
      }

      $table  = Engine_Api::_()->getDbTable('services', 'socialdna');

      $select = $table->select()
                      ->order('openidservice_showorder DESC');


      if($exclude_custom_logo) {
        $select->where("openidservice_customlogo = 0");
      }

      if($only_enabled) {
        $select->where("openidservice_enabled = 1");
      }
      
      
      $rows =  $table->fetchAll($select);
      
      if($rows) {
        $rows = $rows->toArray();
      }

      Semods_Utils::setCache($rows, $cache_key);
      
      return $rows;

  }

  public function getOpenidServiceMap()
  {

    $cache_key = 'openidconnect_services_map';

    if (!($openid_service_map = Semods_Utils::getCache($cache_key))) {
      
      $openid_service_map = array();
      
      $openid_services = $this->getServices(false, true);
      
      foreach($openid_services as $openid_service) {
        $openid_service_map[$openid_service['openidservice_name']] = $openid_service['openidservice_id'];
      }
      
      Semods_Utils::setCache($openid_service_map,$cache_key);
      
    }
    
    return $openid_service_map;

  }

  public function getService($service_id)
  {
      $service_id = (int)$this->getServiceId($service_id);
      
      $cache_key = 'openidconnect_service_' . $service_id;
      $service = Semods_Utils::getCache($cache_key);
      
      if($service) {
        return $service;
      }

      $table  = Engine_Api::_()->getDbTable('services', 'socialdna');

      $select = $table->select()
                      ->where("openidservice_id = ?", $service_id);
      
      $service =  $table->fetchRow($select);                   

      Semods_Utils::setCache($service, $cache_key);
      
      return $service;
                                

  }

  public function getServiceId($service_name)
  {
      
      // TBD: check if enabled
      if(is_numeric($service_name)) {
        return $service_name;
      }
      $openid_service_map = $this->getOpenidServiceMap();
      return isset($openid_service_map[$service_name]) ? $openid_service_map[$service_name] : 0;
  }

  // @tbd join on custom fields
  public function getFieldMap()
  {

    if(is_null($this->fields_remap)) {

      $cache_key = 'openidconnect_fields_map';
      $this->fields_remap = Semods_Utils::getCache($cache_key);
      
      //if(is_null($this->fields_remap)) {
      //if(TRUE) {
      if(!$this->fields_remap) {

        $table  = Engine_Api::_()->getDbTable('fieldmap', 'socialdna');

        $rows =  $table->fetchAll();
        
        $this->fields_remap = array();
        
        foreach($rows as $row) {
          $this->fields_remap[] = array('openidfieldmap_name'       => $row->openidfieldmap_name,
                                        'openidfieldmap_field_key'  => $row->openidfieldmap_field_key
                                        );
        }
  
        Semods_Utils::setCache($this->fields_remap, $cache_key);

      }

    }
    
    return $this->fields_remap;

  }
  
  
  function getUserIdFromService($openid_user_id, $openid_service_id) {

    $openid_service_id = $this->getServiceId($openid_service_id);

    $user = Engine_Api::_()->getDbTable('users', 'socialdna')->getUserByKey($openid_user_id,$openid_service_id);
    
    if($user) {
      return $user->openid_user_id;
    }
    
    return 0;
    
  }
  
  
  function login_openid($openid_session, $openid_service, $full_login = true)
  {

    // check service is enabled
    //$this->getService($openid_service);
    
    //$oDb = $this->database();
    
    $this->getOpenidapi($openid_session, $openid_service);

    //// something bad happened - session expired, etc
    //if(!$this->openidapi->get_user_details() ) {
    //  
    //  // failed - expired session, or else
    //  return false;
    //}

    // TBD: log admin errors
    if(empty($this->openid_user_id) || empty($this->openid_service_id) ) {
      return array(false,array());
    }
    
    $user = Engine_Api::_()->getDbTable('users', 'socialdna')->getUserByKey($this->openid_user_id,$this->openid_service_id);
    
    // if found - try to login
    if(!$user) {
      return array(false,array());
    }
    
    $se_user = Engine_Api::_()->getDbTable('users', 'user')->fetchRow(array("user_id = ?" => $user['openid_user_id']));
    
    if(!$se_user) {
      return array(false,array());
    }
    
    if(!$se_user->verified || !$se_user->enabled) {
      return array(false,array());
    }
    
    if(!$full_login) {
      return array(true,$user);
    }

    $this->updateSession($openid_session, $openid_service, $user->openid_user_id);      
    
    return $this->loginAsUser($user->openid_user_id);
    
  }


  function signup($openid_session, $openid_service)
  {

    $this->getOpenidapi($openid_session, $openid_service);
    
  }


  function getOpenidFieldValue($field) {
    
    return $this->openidapi->getFieldValue($field);
  
  }
  

  function &getOpenidapi($openid_session, $openid_service = 'api') {

    if(is_null($this->openidapi)) {
      
      include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "class_openidconnect.php";
      include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "class_openidconnect_facebook.php";      
      
      $this->openid_session = $openid_session;
  
      $class_name = 'openid' . $openid_service;
      
      if(!in_array($openid_service, $this->valid_services) || !class_exists($class_name) ) {
        $openid_service = 'api';
      }

      $this->openid_service = $openid_service;
  
      $class_name = 'openid' . $openid_service;

      if($openid_service == 'facebook') {        
        $api_key = Semods_Utils::getSetting('socialdna.facebook_api_key','');
        $secret = Semods_Utils::getSetting('socialdna.facebook_secret','');
      } else {
        $api_key = Semods_Utils::getSetting('socialdna.openidconnect_api_key','');
        $secret = Semods_Utils::getSetting('socialdna.openidconnect_secret','');
      }
      
      $this->openidapi = new $class_name($api_key, $secret, $this->openid_session);
    
      // something bad happened - session expired, etc
      if($this->openidapi->get_user_details() ) {

        // @tbd
        $this->openid_user_id = str_replace( "'", "", $this->openidapi->getFieldValue('user_id') );
        $this->openid_service_id = (int) $this->openidapi->getFieldValue('openid_service_id');
        
      } else {

        // failed - expired session, or else
        //$this->error_mesage = $this->openidapi->error_message;          
        
      }
      
    }
    
    return $this->openidapi;
    
  }
    





  function &getPublisherapi($openid_service = 'api') {

    $class_name = 'openid' . $openid_service;
    if(!in_array($openid_service, $this->valid_services) || !class_exists($class_name) ) {
      $openid_service = 'api';
    }
    $class_name = 'openid' . $openid_service;
    
    $publisherapi = Semods_Utils::g($this->publisherapi,$openid_service);
    
    if(is_null($publisherapi)) {
      
      if($openid_service == 'facebook') {        
        $api_key = Semods_Utils::getSetting('socialdna.facebook_api_key','');
        $secret = Semods_Utils::getSetting('socialdna.facebook_secret','');
      } else {
        $api_key = Semods_Utils::getSetting('socialdna.openidconnect_api_key','');
        $secret = Semods_Utils::getSetting('socialdna.openidconnect_secret','');
      }
     
      $publisherapi = new $class_name($api_key, $secret);
      
      $this->publisherapi[$openid_service] = $publisherapi;
      
    }
    
    return $publisherapi;
    
  }
  
  
  
  
  function updateSession($openid_session, $openid_service, $user_id) {

    $openid_service_id = $this->getServiceId($openid_service);

    if($openid_service_id == 1) {
      $openidapi = $this->getOpenidapi($openid_session, $openid_service);
      if(!empty($this->openid_user_id)) {
        $session = $openidapi->get_session();
        $publisherapi = $this->getPublisherapi();
        $publisherapi->update_session($this->openid_user_id, $session['session_key'], $session['session_secret'], $user_id);
      }
    }
  
  }




  public function loginAsUser($user_id, $remember = false, $ignore_errors = false)
  {

    $user_table = Engine_Api::_()->getDbtable('users', 'user');
    $user_select = $user_table->select()
      ->where('user_id = ?', $user_id);
    $user = $user_table->fetchRow($user_select);
    
    if(empty($user)) {
      return array(false, false);
    }

    // @tbd verified, enabled
    if (!empty($user) && (!$user->verified || !$user->enabled))
    {

      return array(false, false);

      //$this->view->status = false;
      //
      //$error = 'This account still requires either email verification or admin approval.';
      //if (!$user->verified) $error .= ' Click <a href="%s">here</a> to resend the email.';
      //
      //$error = Zend_Registry::get('Zend_Translate')->_($error);
      //
      //if (!$user->verified) {
      //  $resend_url = $this->_helper->url->url(array('action' => 'resend', 'email'=>$email), 'user_signup', true);
      //  $error= sprintf($error, $resend_url);
      //}
      //
      //$form->getDecorator('errors')->setOption('escape', false);
      //$form->addError($error);
      //return;
    }

    // Login user
    Engine_Api::_()->user()->getAuth()->getStorage()->write($user_id);

    // -- Success! --
    
    // Remember
    if( $remember )
    {
      $lifetime = 1209600; // Two weeks
      Zend_Session::getSaveHandler()->setLifetime($lifetime, true);
      Zend_Session::rememberMe($lifetime);
    }

    // Increment sign-in count
    Engine_Api::_()->getDbtable('statistics', 'core')->increment('user.logins');

    // Test activity @todo remove
    $viewer = Engine_Api::_()->user()->getViewer();
    if( $viewer->getIdentity() )
    {
      $viewer->lastlogin_date = date("Y-m-d H:i:s");
      $viewer->lastlogin_ip   = $_SERVER['REMOTE_ADDR'];
      $viewer->save();
      Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $viewer, 'login');
    }

    return array(true, $viewer);

  }







  function mapOpenidFields(&$standard_fields, &$custom_fields) {
    $this->mapStandardOpenidFields($standard_fields);
    $this->mapCustomOpenidFields($custom_fields);
  }

  function getOpenidSignupLandingPage() {
    return $this->openidapi->get_signup_landing_page();
  }


  function mapStandardOpenidFields(&$values) {


    /*** STANDARD FIELDS ***/
    
    
    
    $standard_fields = array(
                             array( 'openidfieldmap_name'      => 'nickname',
                                    'openidfieldmap_field_id'  => 'username'
                                   ),
                             array( 'openidfieldmap_name'      => 'email',
                                    'openidfieldmap_field_id'  => 'email'
                                   ),
                             array( 'openidfieldmap_name'      => 'timezone',
                                    'openidfieldmap_field_id'  => 'timezone'
                                   ),
                             );
    

    foreach($standard_fields as $field_remap) {
      $field_key = $field_remap['openidfieldmap_field_id'];
      $field_value = isset( $this->openidapi->user_details[$field_remap['openidfieldmap_name']] ) ? $this->openidapi->user_details[$field_remap['openidfieldmap_name']] : '';

      // if field value is already filled -> skip
      if(isset($values[$field_key])) {
        continue;
      }

      // handle special fields
      switch($field_remap['openidfieldmap_name']) {

        case 'nickname':
          
          // generate nickname
          // now: fullname less spaces
          if(empty($field_value)) {
            $field_value = isset( $this->openidapi->user_details['nickname'] ) ? $this->openidapi->user_details['nickname'] : '';
            if($field_value == '') {
              $field_value = isset( $this->openidapi->user_details['name'] ) ? $this->openidapi->user_details['name'] : '';
            }
            $field_value = str_replace(' ','', $field_value);
          }
          $values[$field_key] = $field_value;

          break;


        // @tbd
        case 'timezone':
        //  if(!empty($field_value)) {
        //    $values['timezone'] = $field_value;
        //  }
          break;
        
        default:
          $values[$field_key] = $field_value;
        
      }
    }

    return true;
    
  }
  



  function mapCustomOpenidFields(&$values, $map_submitted_fields = false, $map_complex_fields = false) {


    /*** CUSTOM FIELDS ***/
    
    // remapped using admin panel

    $fields_remap = $this->getFieldMap();

    foreach($this->fields_remap as $field_remap) {
      
      $field_key = $field_remap['openidfieldmap_field_key'];
      
      $field_value = isset( $this->openidapi->user_details[$field_remap['openidfieldmap_name']] ) ? $this->openidapi->user_details[$field_remap['openidfieldmap_name']] : '';

      if ( isset($values[$field_key]) ) {
        continue;
      }
      
      switch($field_remap['openidfieldmap_name']) {

        case 'birthday':
          // ex: 'January 1, 1900'
          if($field_value != '') {
            $field_value = strtotime( $field_value );
            $month = date('n', $field_value);
            $day = date('j', $field_value);
            $year = date('Y', $field_value);
            
            //$values[$field_key.'[month]'] = $month;
            //$values[$field_key.'[day]'] = $day;
            //$values[$field_key.'[year]'] = $year;
            
            //if($map_complex_fields) {
              $values[$field_key] = array('month' => $month,
                                          'day' => $day,
                                          'year'  => $year
                                          );
            //}
            
          }
          break;
        
        
        case 'sex':
          // must be!
          // male ==> 2
          // female ==> 3
          if(!empty($field_value)) {
            $field_value = (strtolower($field_value) == 'male') ? 2 : 3;
            $values[$field_key] = $field_value;
          }
          break;

        
        default:
          //if($map_submitted_fields) {
            $values[$field_key] = $field_value;
          //} else {
            //$values[$field_key]['value'] = $field_value;
          //}
        
      }
    }

    return true;
    
  }
  
  
  
  
  function isUserConnected($user_id, $service) {

    if(is_null($user_id)) {

      $user_id = Semods_Utils::getUserId();
      
    }
    
    return ($this->getOpenidUserId($user_id, $service) !== 0);
    
  }

  // @todo: by feature, e.g. "can publish newsfeed"
  public function getUserServices($iUser, $features = array() )
  {

    $table_users = Engine_Api::_()->getDbTable('users', 'socialdna');
    $table_users_name = $table_users->info('name');
    $table_services = Engine_Api::_()->getDbTable('services', 'socialdna');
    $table_services_name = $table_services->info('name');
    
    $select = $table_users->select()
      ->setIntegrityCheck(false)
      ->from($table_users_name)
      ->join($table_services_name, "`{$table_users_name}`.`openid_service_id` = `{$table_services_name}`.`openidservice_id`", '*' )
      ->where("`{$table_services_name}`.openidservice_enabled = 1")
      ->where("`{$table_users_name}`.openid_user_id = ?", $iUser)
      ->order("openidservice_showorder DESC");
      
      
    $rows = $table_users->fetchAll($select);
                              
    $services = array();
    
    foreach($rows as $row) {
      $services[$row['openidservice_name']] = $row;
    }
    
    return $services;

  }
  
  
  function linkUserToOpenid($user_id, $openid_user_key = null, $openid_service_id = null) {
    
    is_null($openid_service_id) ? $openid_service_id = $this->openid_service_id:0;
    is_null($openid_user_key)   ? $openid_user_key = $this->openidapi->user_details['user_id']:0;
    
    // session expired?
    if(($openid_service_id == 0) || empty($openid_user_key)) {
      return false;
    }
    
    // display name
    $openid_user_displayname = $this->openidapi->getFieldValue('name');
    // or create name
    if($openid_user_displayname == '') {
      $openid_user_displayname = $this->openidapi->getFieldValue('first_name') . ' ' . $openid_user_displayname = $this->openidapi->getFieldValue('last_name');
      $openid_user_displayname = trim($openid_user_displayname);
    }
    // or nickname
    if($openid_user_displayname == '') {
      $openid_user_displayname = $this->openidapi->getFieldValue('nickname');
    }
    
    $picture = '';
    if($this->openidapi->getFieldValue('pic_square') != '') {
      $picture = $this->openidapi->getFieldValue('pic_square');
    } else if($this->openidapi->getFieldValue('pic_small') != '') {
      $picture = $this->openidapi->getFieldValue('pic_small');
    } else if($this->openidapi->getFieldValue('pic_big') != '') {
      $picture = $this->openidapi->getFieldValue('pic_big');
    } else if($this->openidapi->getFieldValue('pic') != '') {
      $picture = $this->openidapi->getFieldValue('pic');
    }
    
    $profile_url = $this->openidapi->getFieldValue('profile_url');
    
    
    $table  = Engine_Api::_()->getDbTable('users', 'socialdna');
    
    $insert = array( 'openid_user_id'          => $user_id,
                     'openid_service_id'       => $openid_service_id,
                     'openid_user_key'         => $openid_user_key,
                     'openid_user_displayname' => $openid_user_displayname,
                     'openid_user_photo'       => $picture,
                     'openid_user_profile_url' => $profile_url
                    );
    
    $table->insert($insert);
    
    $this->updateSession('', $openid_service_id, $user_id);      
       
    // Link to Service
    $this->openidapi->link_user($user_id);
    
    // @tbd hook
    
    // Refresh 
    $this->updateOpenidUserSettings($user_id, array('last_friends_update' => 0, 'last_albums_update' => 0, 'last_feeds_update'  => 0, 'last_events_update'  => 0) );
    
    // stats
    $this->update_stats('signup', $openid_service_id);

    $session = new Zend_Session_Namespace('Socialdna');
    $session->openidconnect_user_id = null;

  }


  function unlinkUserFromOpenid($user_id, $openid_service_id) {

    $openid_service_id = $this->getServiceId($openid_service_id);
    if($openid_service_id == 0) {
      return;
    }

    $table  = Engine_Api::_()->getDbTable('users', 'socialdna');
    

    $table->delete(array(
      'openid_user_id = ?' => (int) $user_id,
      'openid_service_id = ?' => (int) $openid_service_id
    ));
  
    // Unlink from Service
    $this->getPublisherapi()->unlink_user($user_id, $openid_service_id);

    // @tbd hook
    // Refresh 
    $this->updateOpenidUserSettings($user_id, array('last_friends_update' => 0, 'last_albums_update' => 0, 'last_feeds_update'  => 0, 'last_events_update'  => 0) );
       
    $session = new Zend_Session_Namespace('Socialdna');
    $session->openidconnect_user_id = null;
    
  }




  protected function _resizeImages($file)
  {
    $name = basename($file);
    $path = dirname($file);

    // Resize image (main)
    $image = Engine_Image::factory();
    $image->open($file)
      ->resize(720, 720)
      ->write($path.'/m_'.$name)
      ->destroy();

    // Resize image (profile)
    $image = Engine_Image::factory();
    $image->open($file)
      ->resize(200, 400)
      ->write($path.'/p_'.$name)
      ->destroy();

    // Resize image (icon.normal)
    $image = Engine_Image::factory();
    $image->open($file)
      ->resize(48, 120)
      ->write($path.'/in_'.$name)
      ->destroy();

    // Resize image (icon.square)
    $image = Engine_Image::factory();
    $image->open($file);

    $size = min($image->height, $image->width);
    $x = ($image->width - $size) / 2;
    $y = ($image->height - $size) / 2;

    $image->resample($x, $y, $size, $size, 48, 48)
      ->write($path.'/is_'.$name)
      ->destroy();
   }



  function downloadProfilePhoto($viewer) {
    
    $photo_url = $this->openidapi->getFieldValue( 'pic_big', '' );

    if($photo_url == '') {
      return false;
    }

    if(!$this->_downloadProfilePhoto($viewer, $photo_url)) {
      return false;
    }
    


    $params = array(
      'parent_type' => 'viewer',
      'parent_id' => $viewer->user_id
    );

    // Save
    $storage = Engine_Api::_()->storage();
    $file = $this->file_dest;
    $name = basename($file);
    $path = dirname($file);

    // Store
    $iMain = $storage->create($path.'/m_'.$name, $params);
    $iProfile = $storage->create($path.'/p_'.$name, $params);
    $iIconNormal = $storage->create($path.'/in_'.$name, $params);
    $iSquare = $storage->create($path.'/is_'.$name, $params);

    $iMain->bridge($iProfile, 'thumb.profile');
    $iMain->bridge($iIconNormal, 'thumb.normal');
    $iMain->bridge($iSquare, 'thumb.icon');

    // Update row
    $viewer->photo_id = $iMain->file_id;
    $viewer->save();
       
  }
  
  
  function _downloadProfilePhoto($viewer, $photo_url ) {

    $photo_file_name = basename($photo_url);
    if(strrpos($photo_file_name, '.') === false) {
      $extension = 'jpg';
    } else {
      $extension = substr($photo_file_name, strrpos($photo_file_name, '.'));
    }

    $this->file_dest = $file_dest = APPLICATION_PATH.'/public/temporary/'. md5( uniqid( microtime() ) ) . '.' . $extension;
    
    // download remote file
    if(function_exists('curl_init')) {

      $result = $this->download_profile_photo_curl($photo_url, $file_dest);

    } else {

      $result = $this->download_profile_photo_fopen($photo_url, $file_dest);
      
      if(!$result) {
        $result = $this->download_profile_photo_sockets($photo_url, $file_dest);
      }
      
    }

    if(!$result) {
      return false;
    }
    

    $this->_resizeImages($file_dest);

    return true;    
  }
  
  
  
  function download_profile_photo_curl($photo_url, $file_dest) {

    $ch = curl_init( $photo_url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    //curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );

    $response = curl_exec($ch);
    if(curl_errno($ch) != 0) {
      return false;
    }

    @file_put_contents( $file_dest, $response );
    return true;
    
  }


  function download_profile_photo_fopen($photo_url, $file_dest) {

    $fp = @fopen( $photo_url, 'r' );
    if (!$fp) {
      return false;
    }
    
    $response = @stream_get_contents($fp);
    if( $response === false ) {
      return false;
    }

    @file_put_contents( $file_dest, $response );
    fclose( $fp );
    return true;

  }



  function download_profile_photo_sockets($photo_url, $file_dest) {

    // url MUST have scheme
    $start = strpos( $photo_url, '//' ) + 2;
    $end = strpos( $photo_url, '/', $start );
    $host = substr( $photo_url, $start, $end - $start );
    $post_path = substr( $photo_url, $end );
    $fp = @fsockopen( $host, 80 );
    if (!$fp) {
      return false;
    }
    fputs( $fp, "GET $post_path HTTP/1.0\n" .
                "Host: $host\n" .
                'User-Agent: HTTP Client 1.0 (non-curl) '. phpversion() . "\n\n"
                );
    $response = '';
    while(!feof($fp)) {
        $response .= fgets($fp, 4096);
    }
    fclose ($fp);
    // get response code
    preg_match( '/^\S+\s(\S+)/', $response, $matches );
    if( $matches[1] != "200" ) {
      return false;
    }
    // get response body
    preg_match( '/\r?\n\r?\n(.*?)$/sD', $response, $matches );
    $response = $matches[1];

    @file_put_contents( $file_dest, $response );
    return true;

  }
  
  
  function deleteUser($user_id) {

    Engine_Api::_()->getDbTable('users', 'socialdna')
      ->delete(array(
        'openid_user_id = ?' => (int) $user_id
      ));

    Engine_Api::_()->getDbTable('Usersettings', 'socialdna')
      ->delete(array(
        'openid_user_setting_user_id = ?' => (int) $user_id
      ));

  }
  
  
  // 1: user checked "autologin me"
  // 0: prompt
  // other: nothing
  function setAutoLogin($iUserID, $iVal) {
    
    return $this->updateOpenidUserSettings($iUserID, array('autologin'  => $iVal) );
    
  }


  function getAutoLogin($iUserID) {
    
    return $this->getOpenidUserSetting($iUserID, 'autologin',0);
  
  }
  
  
  function destroySession() {
    
    if(Engine_Api::_()->getDbTable('modules','core')->hasModule('socialdnapublisher')) {
      Engine_Api::_()->getApi('feed', 'socialdnapublisher')->destroySessionFeedStory();
    }

    Zend_Session::namespaceUnset('Socialdna');
    
  }
  
  // current user openid ID
  function getCurrentOpenidUserId($service) {

    $viewer = Engine_Api::_()->user()->getViewer();
    $user_id = $viewer->getIdentity();

    if( !$user_id ) {
      return 0;
    }
    
    $key = $user_id . '_' . $service;
    $openidconnect_user_id = array();
    
    // @tbd something is wrong with session cache
    $session = new Zend_Session_Namespace('Socialdna');

    //$openidconnect_user_id = !empty($session->openidconnect_user_id) ? $session->openidconnect_user_id : array();
    
    //if(isset($openidconnect_user_id[$key])) {
    //  return $openidconnect_user_id[$key];
    //}
    
    $openid_user_id = $this->getOpenidUserId($user_id, $service);

    $openidconnect_user_id[$key] = $openid_user_id;
    $session->openidconnect_user_id = $openidconnect_user_id;
    
    return $openid_user_id;
    
  }

  function getOpenidUserId($user_id, $service) {
    
    $user_id = (int) $user_id;

    $openid_service_id = $this->getServiceId($service);

    if($openid_service_id == 0) {
      return 0;
    }

    $user = Engine_Api::_()->getDbTable('users', 'socialdna')->getUser($user_id,$openid_service_id);

    if(!$user) {
      return 0;
    }
    
    return $user->openid_user_key;
    
  }
  
  
  // @todo: cache
  function getOpenidUserSettings($user_id) {
    return Engine_Api::_()->getDbTable('usersettings', 'socialdna')->getSettings($user_id);
  }


  function getOpenidUserSetting($user_id, $setting, $default = null) {
    $settings = $this->getOpenidUserSettings($user_id);
    return Semods_Utils::g($settings,$setting, $default);
  }


  function updateOpenidUserSettings($user_id, $settings) {

    $table = Engine_Api::_()->getDbTable('usersettings', 'socialdna');

    foreach($settings as $setting_key => $setting_value) {
      $insert = array( 'openid_user_setting_user_id' => $user_id,
                       'openid_user_setting_key'     => $setting_key,
                       'openid_user_setting_value'   => $setting_value
                      );

      // ON DUPLICATE KEY option is missing. sham! sham!! sham!!!

      // Not atomic
      $select = $table->select()
        ->setIntegrityCheck(false)
        ->from($table->info('name'), array('COUNT(*) as total'))
        ->where("openid_user_setting_user_id = ?", $user_id)
        ->where("openid_user_setting_key = ?", $setting_key);
  
      $setting_present = (int)$table->fetchRow($select)->total;
      
      if($setting_present == 0) {
        
        $table->insert($insert);
        
      } else {
                
        $table->update(array('openid_user_setting_value' => $setting_value),
                         array('openid_user_setting_user_id = ?'  => $user_id,
                               "openid_user_setting_key = ?"    => $setting_key
                               )
                        );
        
      }
    }

  }







  function updateSocialFriends() {
     
     $api = $this->getPublisherapi(); 
 
     $user_id = Semods_Utils::getUserId();
     
     //$response = $api->get_friends($user_id, $openid_service);
     $response = $api->get_friends($user_id);
 
     // no connection
     if($response === false) {
       return;
     }
     
     // not ready, should retry
     if(Semods_Utils::g($response,'err_code',0) == 300) {
       return;
     }
 
     //if(!empty($response)) {
 
      Engine_Api::_()->getDbTable('friends','socialdna')->delete(array("openidfriend_local_user_id = ?" => $user_id));
      
       //$this->database()->delete(Phpfox::getT('openid_friends'), "openidfriend_local_user_id = $user_id");
       $now = time();
        
       foreach($response as $friend) {
 
        $insert =  array( 'openidfriend_local_user_id' => $user_id,
                          'openidfriend_user_id'      => $friend['uid'],
                          'openidfriend_service_id'   => $friend['service_id'],
                          'openidfriend_nickname'     => $friend['nickname'],
                          'openidfriend_name'         => $friend['name'],
                          'openidfriend_thumb'        => $friend['thumb'],
                          'openidfriend_status'       => $friend['status'],
                          'openidfriend_status_time'  => $friend['status_time'],
                          'openidfriend_link'         => Semods_Utils::g($friend,'link',''),
                          'openidfriend_presence'     => Semods_Utils::g($friend,'presence',''),
                          'openidfriend_presence_last'=> $now,
                         );
 
        Engine_Api::_()->getDbTable('friends','socialdna')->insert($insert);
                 
       }
 
      $this->updateOpenidUserSettings($user_id, array('last_friends_update' => time()) );
       
     //}
     
   }
   
   
   // once in 24H or after new service connected
   //function getSocialFriends($openid_service, $start = 0, $limit = 25) {
   function getSocialFriends($openid_service, $page, $suggest = '') {
     
     $page = (int)$page;
     
     $friends_cache_delta = 86400; // 60*60*24 - 24H
 
     $user_id = Semods_Utils::getUserId();
     
     //$last_friends_update = Phpfox::getParam('openidsocial.openidsocial_last_friends_update','');
     $last_friends_update = $this->getOpenidUserSetting($user_id, 'last_friends_update',0);
     //$last_friends_update = time();
     
     if(time() - $last_friends_update > $friends_cache_delta) {
       $this->updateSocialFriends();
     }
 
     
     //$start = $page * $max_friends;
     //$limit = $max_friends;
    $table = Engine_Api::_()->getDbTable('friends','socialdna');
    
    $select = $table->select()
              ->from($table->info('name'),'COUNT(*) as total')
              ->where("openidfriend_local_user_id = ?", $user_id);
     
    $openid_service = $this->getServiceId($openid_service);
    if($openid_service != 0) {
      $select->where("openidfriend_service_id = ?", $openid_service);
    }
    if($suggest != '') {

      $db = $table->getAdapter();
      $select->where( $db->quoteInto('openidfriend_name LIKE ?', $suggest . '%') . ' OR ' . $db->quoteInto('openidfriend_name LIKE ?', '% ' . $suggest . '%')  . ' OR ' . $db->quoteInto('openidfriend_nickname LIKE ?', $suggest . '%') );
      
    }
     
     
    $rows = $table->fetchRow($select);    
    $total_friends = $rows->total;
    
    // make paging
    $friends_per_page = 12;
    $pages = $this->make_page($total_friends, $friends_per_page, $page);
    $start = $pages[0];
    $limit = $friends_per_page;
     
    $select->reset(Zend_Db_Select::FROM);
    $select->reset(Zend_Db_Select::COLUMNS);
    
    $select->limit($limit, $start);
    
    
    $select->from($table->info('name'),'*');
    
    $rows = $table->fetchAll($select);
    
    $rows = $rows ? $rows->toArray() : array();
                               
                               
                               
     return array( 'friends'       => $rows,
                   'total_friends' => $total_friends,
                   'page'          => $pages[1],
                   'page_from'     => $pages[0]+1,
                   'page_to'       => $pages[0] + count($rows),
                   );
            
     //$friends = array();
     //
     //foreach($aRows as $row) {
     //  
     //  $friends[] = array('n'  => wordwrap($row['openidfriend_name'], 15, "\n", true),
     //                     's'  => $row['openidfriend_service_id'],
     //                     't'  => $row['openidfriend_thumb'],
     //                     'u'  => $row['openidfriend_user_id'],
     //                     'st' => wordwrap($row['openidfriend_status'], 15, "\n", true)
     //                     );
     //  
     //}
     //
     //return $friends;
     
   }
   



  

  function make_page($total_items, $items_per_page, $page) {
    
      $page_end = ceil($total_items / $items_per_page);        
      $page_end = $page_end > 0 ? $page_end : 1;

      $page = ( ($page > $page_end) ? $page_end : ( ($page < 1) ? 1 : $page ) );
      $page_start = ($page - 1) * $items_per_page;
      
      return array($page_start, $page, $page_end);
  }


  function update_stats($type, $service, $amount = 1) {
  
    $var = 'openidstat_service_' . $service;
    $table = Engine_Api::_()->getDbTable($type . 'stats','socialdna');

    $updateCount = $table->update(  array( $var => new Zend_Db_Expr("$var + $amount"),
                                         ),
                                    array('openidstat_time = ?'  => new Zend_Db_Expr('UNIX_TIMESTAMP(CURDATE())')
                                         )
                                          
                                 );

    if($updateCount < 1) {    
      try {

        $table->insert( array( 'openidstat_time'  => new Zend_Db_Expr('UNIX_TIMESTAMP(CURDATE())'),
                               $var => $amount
                              )
                      );
        
        
      } catch (Exception $ex) {
        
        echo $ex->getMessage();

      }
    }

  }

  // @tbd -> admin help -> check
  function importFBConnectUsers() {
  

    //$facebook_users_table = Engine_Api::_()->getDbTable('facebook','user');
    //
    //$users = $facebook_users_table->fetchAll();

    //$facebook_users_table = Engine_Api::_()->getDbTable('facebook','user');
    
    $users = Engine_Api::_()->getDbTable('facebook','user')->fetchAll();
    
    $openid_users_table = Engine_Api::_()->getDbTable('users','socialdna');
    
    foreach($users as $fbUser) {


      // check if we know this user
      $select = $openid_users_table->select()
        ->setIntegrityCheck(false)
        ->from($openid_users_table->info('name'), array('COUNT(*) as total'))
        ->where("openid_user_key = ?", $fbUser['fb_user_id'])
        ->where("openid_service_id = 1");
  
      $present = (int)$openid_users_table->fetchRow($select)->total;

            
      if($present == 0) {

        try {
          $openid_users_table->insert( array( 'openid_user_id'      => $fbUser['user_id'],
                                              'openid_user_key'     => $fbUser['facebook_uid'],
                                              'openid_service_id'   => 1
                                              )
                                     );
        } catch( Exception $ex) {
          
        }

      }
      
    }
    
  }

 
}