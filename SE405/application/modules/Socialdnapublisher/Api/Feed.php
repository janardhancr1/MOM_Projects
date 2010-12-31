<?php

require_once APPLICATION_PATH_COR . DS . 'modules' . DS . 'Socialdnapublisher' . DS . 'Api' . DS . 'functions_openidconnect.php';
 
class Socialdnapublisher_Api_Feed extends Core_Api_Abstract
{
  
  var $err_code = 0;
  var $err_msg = '';
  

  public function add($params)
  {
	
	// or by user_id -> seems will take current user if exists
	$user = $params['subject'];
	$user_id = $user->getIdentity();

    $api = Engine_Api::_()->getApi('core', 'socialdna');
	
	$actiontype_name = $params['type'];

	$feed_story_params = false;

	$action_media = array();
  
	// see if user opted out of this story
	$publishfeeds = $api->getOpenidUserSetting($user_id, 'publishfeeds', '');
	$user_feedstories_keys = !empty($publishfeeds) ? explode(',', $publishfeeds) : array();
	if(in_array($actiontype_name, $user_feedstories_keys)) {
	  return ;
	}

	// see if user selected to autopublish
	
	// status
	if($actiontype_name == 'status') {
	  
	  $autopublishfeed = $api->getOpenidUserSetting($user_id, 'autostatus', Semods_Utils::getSetting('socialdna.openidconnect_autostatus',0) );

	} else {
	  
	  // by default, all require confirmation
	  $autopublishfeeds = $api->getOpenidUserSetting($user_id, 'autopublishfeeds', '');
	  $autopublishfeeds = !empty($autopublishfeeds) ? explode(',', $autopublishfeeds) : array();
	  $autopublishfeed = in_array($actiontype_name, $autopublishfeeds);

	}

	
	$openidconnect_facebook_feed_actions = $this->loadFeedActions();
  
	// for all networks, find primary and see if connected
	$primary_network = 'facebook';
	
	$feed_story_template = Semods_Utils::g($openidconnect_facebook_feed_actions, $actiontype_name);
	
	if( !is_null($feed_story_template) ) {
  
	  $function_name = Semods_Utils::g($feed_story_template,'feedstory_compiler','');
  
	  if($function_name == '') {
		$function_name = 'openidconnect_feedstory_'.$actiontype_name;
	  }
  
	  if(function_exists($function_name)) {

		$feed_story_params = call_user_func($function_name, $user, $params, $action_media, $actiontype_name);
		
	  } else {
		
		// try event hook
		// event -> call -> $function_name
		
	  }
	  

	  
	  // can't publish
	  if($feed_story_params === false) {
		return false;
	  }
	  
	  $require_permission = 1;
	  
	  $feed_story = Semods_Utils::g($feed_story_params,'feed_story',array());
	  
	  $this->compileFeedStory($feed_story, $feed_story_template, $user);
	  $story_preview = $feed_story['story_preview'];
	  $story_params = Semods_Utils::g($feed_story_params,'story_params',array()); 
	  
	  unset($feed_story['vars']);
	  
	  // function can override ?
	  //$autopublishfeed = (int)Semods_Utils::g($feed_story_params,'auto_publish', $autopublishfeed);          
	  
	  $openidconnect_feed_story = array(
										'page_check'          => $feed_story_template['feedstory_pagecheck'],
										'publish_prompt'      => $feed_story_template['feedstory_publishprompt'],
  
										'user_message'        => Semods_Utils::g($feed_story_params,'user_message', Semods_Utils::g($feed_story_template,'feedstory_usermessage','') ),
										'user_prompt'         => Semods_Utils::g($feed_story_params,'user_prompt', Semods_Utils::g($feed_story_template,'feedstory_userprompt','') ),
										
										// Network specific
										'template_bundle_id'  => $feed_story_template['feedstory_metadata']['template_bundle_id'],
  
										'publish_using'       => Semods_Utils::g($feed_story_params,'publish_using', Semods_Utils::g($feed_story_template,'feedstory_publishusing','feed') ),
  
										// @tbd use js service
										'data'                => Zend_Json::encode($feed_story),
										'story_params'        => Zend_Json::encode($story_params),
										'story_params_'       => $story_params,
										'feed_params'         => $feed_story,
										'story_type'          => $actiontype_name,
										'require_permission'  => $require_permission,
										'story_preview'       => $story_preview,
										//'story_preview_image' => $story_preview_image
  
										);

	  if(!$feed_story_template['feedstory_publishprompt'] && $autopublishfeed) {
	   
		$result = $this->publishFeedStory($openidconnect_feed_story);
		
		if($result === false) {
		  
		  // need permissions    
		  if(($this->err_code == 200) || ($this->err_code == 204)) {
			$this->queueSessionFeedStory($openidconnect_feed_story, 'all', $user_id);
		  }

		}
	  
	  } else {

		$this->queueSessionFeedStory($openidconnect_feed_story, 'all', $user_id);
		
	  }
	  
	}

	
  }

  function prepareFeedStory($actiontype_name, $story_params, $forpublish = false) {
	
	$openidconnect_feed_story = false;
	
	// take stored story
	if(empty($story_params) || (Semods_Utils::g($story_params,'norecompile',0) == 1)) {
	  return $this->getSessionFeedStory();
	}
	
	$openidconnect_facebook_feed_actions = $this->loadFeedActions();
	
	// current user
	$user = Engine_Api::_()->user()->getViewer();;
  
	$openidconnect_feed_story = array();
	
	$status = 1;
	
	$feed_story = false;

	if(array_key_exists($actiontype_name,$openidconnect_facebook_feed_actions)) {
	
	  $function_name = Semods_Utils::g($feed_story_template,'feedstory_compiler','');
  
	  if($function_name == '') {
		$function_name = 'openidconnect_feedstory_compose_'.$actiontype_name;
	  }
  
	  $feed_story_template = $openidconnect_facebook_feed_actions[$actiontype_name];
	  
	  if(function_exists($function_name)) {

		$feed_story = call_user_func_array($function_name, $story_params);
		
	  } else {
		
		// try event hook 
		
	  }
  
	  if($feed_story !== false) {

		$require_permission = 1;

		$this->compileFeedStory($feed_story, $feed_story_template, $user);

		$story_preview = $feed_story['story_preview'];
		//$story_params = Semods_Utils::g($feed_story_params,'story_params',array()); 
		
		unset($feed_story['vars']);
		
		if($forpublish) {

		  $openidconnect_feed_story = array(

											'user_message'        => Semods_Utils::g($feed_story,'user_message', Semods_Utils::g($feed_story_template,'feedstory_usermessage','') ),
											'user_prompt'         => Semods_Utils::g($feed_story,'user_prompt', Semods_Utils::g($feed_story_template,'feedstory_userprompt','') ),
	
											'data'                => $feed_story,
											'feed_params'         => $feed_story,
											'publish_using'       => Semods_Utils::g($feed_story,'publish_using', Semods_Utils::g($feed_story_template,'feedstory_publishusing','feed') ),
	
											'story_type'          => $actiontype_name,
											
											);
		  
		} else {

		  $openidconnect_feed_story = array(
											'page_check'          => $feed_story_template['feedstory_pagecheck'],
											'publish_prompt'      => $feed_story_template['feedstory_publishprompt'],
	  
											'user_message'        => Semods_Utils::g($feed_story_params,'user_message', Semods_Utils::g($feed_story_template,'feedstory_usermessage','') ),
											'user_prompt'         => Semods_Utils::g($feed_story_params,'user_prompt', Semods_Utils::g($feed_story_template,'feedstory_userprompt','') ),
											
											// Network specific
											'template_bundle_id'  => $feed_story_template['feedstory_metadata']['template_bundle_id'],
	  
											'publish_using'       => Semods_Utils::g($feed_story_params,'publish_using', Semods_Utils::g($feed_story_template,'feedstory_publishusing','feed') ),
	  
											'data'                => Zend_Json::encode($feed_story),
											'story_params'        => Zend_Json::encode($story_params),
											'story_params_'       => $story_params,
											'feed_params'         => $feed_story,
											'story_type'          => $actiontype_name,
											'require_permission'  => $require_permission,
											'story_preview'       => $story_preview,
	  
											);
		  
		}
		
	  }
			  
	}
	
	
	return $openidconnect_feed_story;      
	
  }
  

  function compileFeedStory(&$feed_story, $feed_story_template, $user) {
	
	$feed_story['vars']['site-name'] = Semods_Utils::getSetting('core.general.site.title');
	
	// @tbd better way to get base url?
	$base_url = "http://{$_SERVER['HTTP_HOST']}";

	$feed_story['vars']['site-link'] = $base_url . Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'default', true);

	$feedstory = Semods_Utils::g($feed_story_template,'feedstory_metadata',array());
	
	$feedstory_title = Semods_Utils::g($feedstory,'feedstory_title','');
	$feedstory_body = Semods_Utils::g($feedstory,'feedstory_body','');
	
	$feedstory_href = Semods_Utils::g($feedstory,'feedstory_href','');
	
	$feedstory_link_link = Semods_Utils::g($feedstory,'feedstory_link_link','');
	$feedstory_link_text = Semods_Utils::g($feedstory,'feedstory_link_text','');

	$story_search = array_keys($feed_story['vars']);
	$story_replace = array_values($feed_story['vars']);

	foreach($story_search as $key => $value) {
	  $story_search[$key] = '{*' . $value . '*}';
	}
	
	$story_search[] = '{*actor*}';
	$story_replace[] = $user->getTitle(); // $user['full_name'];
	
	$feedstory_title = str_ireplace( $story_search, $story_replace, $feedstory_title );
	$feedstory_body = str_ireplace( $story_search, $story_replace, $feedstory_body );
	$feedstory_href = str_ireplace( $story_search, $story_replace, $feedstory_href );
	$feedstory_link_link = str_ireplace( $story_search, $story_replace, $feedstory_link_link );
	$feedstory_link_text = str_ireplace( $story_search, $story_replace, $feedstory_link_text );
	
	$story_preview = $feedstory_title;
	
	
	$feed_story['story_preview'] = $story_preview;
	

	// all values can be overridden with code or admin UI - who wins -> seems admin UI should be winner
	// attachment -> name
	// attachment -> description
	// links -> text
	// links -> href
	
	$attachment = Semods_Utils::g($feed_story,'attachment',array());
	$link = Semods_Utils::g($feed_story,'link',array());

	if($feedstory_title != '') {

	  // admin -> override
	  $attachment['name'] = $feedstory_title;

	} elseif (isset($attachment['name'])) {
	  
	  // compile
	  $attachment['name'] = str_replace( $story_search, $story_replace, $attachment['name'] );

	} else {
	  
	  $attachment['name'] = '';
	  
	}

	if($feedstory_body != '') {

	  // admin -> override
	  $attachment['description'] = $feedstory_body;

	} elseif (isset($attachment['description'])) {
	  
	  // compile
	  $attachment['description'] = str_replace( $story_search, $story_replace, $attachment['description'] );

	} else {
	  
	  $attachment['description'] = '';
	  
	}

	if($feedstory_href != '') {

	  // admin -> override
	  $attachment['href'] = $feedstory_href;

	} elseif (isset($attachment['href'])) {
	  
	  // compile
	  $attachment['href'] = str_replace( $story_search, $story_replace, $attachment['href'] );

	}
	


	if($feedstory_link_link != '') {

	  // admin -> override
	  $link['href'] = $feedstory_link_link;

	} elseif (isset($link['href'])) {
	  
	  // compile
	  $link['href'] = str_replace( $story_search, $story_replace, $link['href'] );

	}
	

	if($feedstory_link_text != '') {

	  // admin -> override
	  $link['text'] = $feedstory_link_text;

	} elseif (isset($link['text'])) {
	  
	  // compile
	  $link['text'] = str_replace( $story_search, $story_replace, $link['text'] );

	}
	
	
	$feed_story['attachment'] = $attachment;
	
	if(!empty($link)) {
	  $feed_story['links'] = array( $link );
	}
	

	// Story preview image

	$story_preview_image = '';
	if(isset($attachment['media'])) {
	  //$item = reset($attachment);
	  $item = $attachment['media'][0];

	  if(is_array($item)) {
		$type = Semods_Utils::g($item, 'type','');
		switch($type) {

		  case 'image':
			$story_preview_image = Semods_Utils::g($item,'src','');
			break;

		  case 'flash':
			$story_preview_image = Semods_Utils::g($item,'imgsrc','');
			break;
		  
		  //case 'mp3':
		  
		}
	  }
	}

	//if($story_preview_image != '') {
	  $feed_story['story_preview_image'] = $story_preview_image;
	//}
	

	
	
  }
  

  // @tbd cache  
  function loadFeedActions($service_name = 1, /* default - facebook */
						   $for_user_display = false,
						   $for_admin = false
														 )
  {
  
	// CACHING
	$cache_key = 'openidconnect_feed_actions_' . $service_name . '_' . (int)$for_user_display;

	$_openidconnect_facebook_feed_actions = Semods_Utils::getCache($cache_key);
	
	if(!$_openidconnect_facebook_feed_actions) {
	//if(true) {

	  $api = Engine_Api::_()->getApi('core', 'socialdna');
	
	  $service_id = $api->getServiceId($service_name);
	  
	  $table = Engine_Api::_()->getDbTable('feedstories', 'socialdnapublisher');
	  $select = $table->select()
				->where("feedstory_service_id = ?", $service_id);
				//->where("feedstory_enabled = 1");

	  if(!$for_admin) {
		$select->where("feedstory_enabled = 1");
	  }
  
	  if($for_user_display) {
		$select->where("feedstory_display_user = 1");
	  }
	  
	  $openidconnect_facebook_feed_actions = $table->fetchAll($select);
	  
	  if($openidconnect_facebook_feed_actions) {
		$openidconnect_facebook_feed_actions = $openidconnect_facebook_feed_actions->toArray();
	  }
  
	  $_openidconnect_facebook_feed_actions = array();
	  
	  foreach($openidconnect_facebook_feed_actions as $openidconnect_facebook_feed_action) {
		$feedstory_metadata = !empty($openidconnect_facebook_feed_action['feedstory_metadata']) ? unserialize($openidconnect_facebook_feed_action['feedstory_metadata']) : array();
  
		// set default vars to avoid warnings
		$feedstory_metadata['feedstory_href'] = Semods_Utils::g($feedstory_metadata,'feedstory_href','');
		
		$openidconnect_facebook_feed_action['feedstory_metadata'] = $feedstory_metadata;
		
		
		$_openidconnect_facebook_feed_actions[ $openidconnect_facebook_feed_action['feedstory_type'] ] = $openidconnect_facebook_feed_action;
	  }
	  
	  Semods_Utils::setCache($_openidconnect_facebook_feed_actions, $cache_key);
	  
	}
	
	return $_openidconnect_facebook_feed_actions;
  }



  function queueSessionFeedStory($openidconnect_feed_story, $type = 'all', $user_id = 0) {
	
	if($user_id == 0) {
	  $user_id = Semods_Utils::getUserId();
	}
	
	$cache_key = 'openidconnect_feed_story_' . $user_id;

    if( APPLICATION_ENV != 'development' ) {
	
	  Semods_Utils::setCache($openidconnect_feed_story, $cache_key);
	  
	} else {
	  
	  $session = new Zend_Session_Namespace('Socialdna_feedstory');
	  $session->openidconnect_feed_story = $openidconnect_feed_story;
	  
	}
	
  }


  function getSessionFeedStory($type = 'all') {

	$cache_key = 'openidconnect_feed_story_' . Semods_Utils::getUserId();

	// @tbd - where cache period - create new cacher?
	$cache_period = 60; // 1H

    if( APPLICATION_ENV != 'development' ) {
	
	  $openidconnect_feed_story = Semods_Utils::getCache($cache_key);
	  
	} else {
	  
	  $session = new Zend_Session_Namespace('Socialdna_feedstory');
	  $openidconnect_feed_story = isset($session->openidconnect_feed_story) && !empty($session->openidconnect_feed_story) ? $session->openidconnect_feed_story : null;
	  
	}
	
	if(!$openidconnect_feed_story) {
	  return null;
	}
	
	return $openidconnect_feed_story;
  }


  function destroySessionFeedStory($type = 'all') {

	$cache_key = 'openidconnect_feed_story_' . Semods_Utils::getUserId();

    if( APPLICATION_ENV != 'development' ) {
	
	  Semods_Utils::removeCache($cache_key);
	  
	} else {
	  
	  $session = new Zend_Session_Namespace('Socialdna_feedstory');
	  $session->openidconnect_feed_story = null;
	  
	}

  }
  

  function updateFeedStory($feedstory, $feedstory_id = 0) {
	
	$table = Engine_Api::_()->getDbTable('feedstories', 'socialdnapublisher');
	
	$table->update( $feedstory, ($feedstory_id != 0 ? array("feedstory_id = ?" => $feedstory_id) : array() ) );
	
  }
  
  
  function publishStatus($text, $openid_service = 'facebook') {
	
	// called from openidconnect_feedstory_user_status()
	// TODO: if facebook - user local
	//       others - user remote "all connected"
	
	// publish status for all "connected" services
	// TODO: user selects which services to autopublish to

	$openid_service = 'twitter';
	
    $service = Engine_Api::_()->getApi('core', 'socialdna');
			  
	$api = $service->getPublisherapi($openid_service); 
	
	$user_id = Semods_Utils::getUserId();
	
	// @tbd: If user only specified specific service to publish (i.e. exclude from some)
	
	$result = $api->publish_status($text, $user_id);
	
	// Update stats      
	$insert =  array( 'openidstat_campaign_id'  => 0,
					  'openidstat_user_id'      => $user_id,
					  'openidstat_service_id'   => 0, // TBD
					  'openidstat_link'         => '',
					  'openidstat_time'         => time(),
					  'openidstat_type'         => 2,   // status
					 );
	

	Engine_Api::_()->getDbTable('stats', 'socialdnapublisher')->insert( $insert );
	
	return $result;
	
  }
  
  
  function tagFeedStoryLinks(&$openidconnect_feed_story) {

	$user_id = Semods_Utils::getUserId();
	$campaign_id = 1;

	$feed_params = $openidconnect_feed_story['feed_params'];

	$base_url = "http://{$_SERVER['HTTP_HOST']}";
	
	$url = $base_url . Zend_Controller_Front::getInstance()->getRouter()->assemble(array('module' => 'socialdna', 'controller' => 'r', 'action' => 'index', 'c'  => $campaign_id, 'u' => $user_id, 's' => '[service]', 't' => $openidconnect_feed_story['story_type'], 'r' => '[url]'), 'default', true, false);
	
	if(isset($feed_params['attachment'])) {
	  
	  $attachment = $feed_params['attachment'];

	  if(isset($attachment['href'])) {
		//echo $attachment['href'];
		$attachment['href'] = str_replace( '[url]', strtr(base64_encode($attachment['href']), '+/=', '-~,'), $url );
		$feed_params['attachment'] = $attachment;
	  }
	  
	}

	if(isset($feed_params['links']) && count($feed_params['links']) > 0) {
	  
	  $links = $feed_params['links'];
	  $link = $links[0];
	  
	  if(isset($link['href'])) {
		$link['href'] = str_replace( '[url]', strtr(base64_encode($link['href']), '+/=', '-~,'), $url );
		$links[0] = $link;
		$feed_params['links'] = $links;        
	  }        
	  
	}

	$openidconnect_feed_story['feed_params'] = $feed_params;
	
  }
  
  function publishFeedStory($openidconnect_feed_story, $services = '') {

	//$tag_links = Semods_Utils::getSetting('socialdna.tag_links');
	$tag_links = true;
	
	if($tag_links) {
	  $this->tagFeedStoryLinks($openidconnect_feed_story);
	}
  
    $service = Engine_Api::_()->getApi('core', 'socialdna');
			  
	$api = $service->getPublisherapi(); 
	
	$user_id = Semods_Utils::getUserId();
	
	if($openidconnect_feed_story['story_type'] == 'status') {
			  
	  $result = $api->publish_status($openidconnect_feed_story['user_message'], $user_id);
	  $stats_type = 'status';
	  
	} else {
	  
	  $feed_params = $openidconnect_feed_story['feed_params'];

	  $feed_story = array();

	  $feed_story['attachment'] = $feed_params['attachment'];

	  if(isset($feed_params['links'])) {
		$feed_story['links'] = $feed_params['links'];
	  }

	  $feed_story['user_message'] = $openidconnect_feed_story['user_message'];

	  $result = $api->publish_feed_story($user_id, $feed_story, $services);
	  $stats_type = 'feed';
	  
	  // result should contain which networks successfully published, -> openidstat_service_id
	  
	}

	
	$success = (int)Semods_Utils::g($result,'success',0);
	
	if($success == 0) {
	  $this->err_code = Semods_Utils::g($result,'err_code',0);
	  $this->err_msg = Semods_Utils::g($result,'err_msg','');
	  
	  return false;
	}
	
	// stats
	$published = Semods_Utils::g($result,'published','');
	$published = explode(',',$published);
	
	if(!empty($published)) {
	  
	  foreach($published as $published_service) {
		$service->update_stats($stats_type, $published_service);
	  }
	  
	}
	
	
	return true;
	
  }


}
 
?>