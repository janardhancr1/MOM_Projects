<?php

/* COMPATIBILITY */
include_once APPLICATION_PATH_COR . DS . 'modules' . DS . 'Socialdna' . DS . 'Api' . DS . 'functions_compat.php';





/***** FEED STORIES *****/







/*
 * New Group
 *
 */
function openidconnect_feedstory_group_create($user, $action_params) {
  
  $object = $action_params['object'];
  $group_id = $object->getIdentity();
  
  $feed_story = openidconnect_feedstory_compose_group_create($group_id);

  return array('feed_story'  => $feed_story,
               'story_params' => array('group_id' => $group_id),
               'publish_using'=> 'stream'
              );
}


function openidconnect_feedstory_compose_group_create($group_id) {

  $group_id = (int)$group_id;

  $group = Engine_Api::_()->getItem('group', $group_id);
  
  if(!$group) {
    return false;
  }

  $base_url = openidconnect_get_base_url();

  $type = 'thumb.profile';
  $group_photo = $group->getPhotoUrl($type);
  
  if(!$group_photo) {

    $helper = new Core_View_Helper_ItemPhoto();
    $safeName = ( $type ? str_replace('.', '_', $type) : 'main' );
    $group_photo = $helper->getNoPhoto($group, $safeName) ;
    
  }
  
  if(!empty($group_photo)) {
    $group_photo = $base_url . '/' . $group_photo;
  }
  
  $group_title = html_entity_decode($group->getTitle(), ENT_QUOTES, 'UTF-8');

  
  $group_url = $base_url . $group->getHref();
  
  // other possible vars
  // total_comment ? 
  // member_count group->member_count
  // views group->view_count
  // last_updated group->modified_date
  
  $group_category = '';
  if( !empty($group->category_id)) {
    $group_category = $group->getCategory()->title;
  }



  $feed_params = array('vars' => array( 'group-title'       => $group_title,
                                        'group-id'          => $group_id,
                                        'group-desc'        => html_entity_decode($group->description, ENT_QUOTES, 'UTF-8'),
                                        'group-link'        => $group_url,
                                        'group-category'    => $group_category,
                                        
                                      ),
                       
                       'images'      => array(
                                              array('src'  => $group_photo,
                                                    'href' => $group_url
                                                   )
                                              ),
                       
                       'attachment'  => array( 'media'  => array(
                                                                 array('type' => 'image',
                                                                       'src'  => $group_photo,
                                                                       'href' => $group_url
                                                                       )
                                                                 ),
                                             ),
                       
                       'auto_publish'   => false
                        
                       
                       );
  
  return $feed_params;
}



/*
 * New Event
 *
 */
function openidconnect_feedstory_event_create($user, $action_params) {

  $object = $action_params['object'];
  $item_id = $object->getIdentity();
  
  $feed_story = openidconnect_feedstory_compose_event_create($item_id);

  return array('feed_story'  => $feed_story,
               'story_params' => array('event_id' => $item_id),
              );

}



function openidconnect_feedstory_compose_event_create($event_id) {
  
  $event_id = (int)$event_id;

  $event = Engine_Api::_()->getItem('event', $event_id);
  
  if(!$event) {
    return false;
  }
  
  $base_url = openidconnect_get_base_url();


  $type = 'thumb.profile';
  $event_photo = $event->getPhotoUrl($type);
  
  if(!$event_photo) {

    $helper = new Core_View_Helper_ItemPhoto();
    $safeName = ( $type ? str_replace('.', '_', $type) : 'main' );
    $event_photo = $helper->getNoPhoto($event, $safeName) ;
    
  }
  
  if(!empty($event_photo)) {
    $event_photo = $base_url . '/' . $event_photo;
  }
  
  $event_title = html_entity_decode($event->getTitle(), ENT_QUOTES, 'UTF-8');

  
  $event_url = $base_url . $event->getHref();
  
  $event_category = '';
  if( !empty($event->category)) {
    $event_category = $event->categoryName();
  }

  $event_location = !empty($event->location) ? $event->location : '';;
  $event_host = !empty($event->location) ? $event->location : '';;

  if($event->starttime == $event->endtime) {
    $event_date = strftime("%b %d, %Y",strtotime($event->starttime));
  } else {
    $event_date = strftime("%b %d, %Y",strtotime($event->starttime)) . ' - ' . strftime("%b %d, %Y",strtotime($event->endtime));
  }

  
  $feed_params = array('vars' => array( 'event-title'       => $event_title,
                                        'event-id'          => $event_id,
                                        'event-desc'        => html_entity_decode(openidconnect_html2txt($event->description), ENT_QUOTES, 'UTF-8'),
                                        'event-link'        => $event_url,
                                        'event-location'    => $event->location,
                                        'event-category'    => $event_category,
                                        'event-date'        => $event_date,
                                        'event-start-time'  => strftime("%b %d, %Y",strtotime($event->starttime)),
                                        'event-end-time'  => strftime("%b %d, %Y",strtotime($event->endtime)),
                                        'event-host'        => html_entity_decode($event->host, ENT_QUOTES, 'UTF-8'),
                                        
                                      ),
                       
                       'attachment'  => array( 'media'  => array(
                                                                 array('type' => 'image',
                                                                       'src'  => $event_photo,
                                                                       'href' => $event_url
                                                                       )
                                                                 ),
                                               ),
                       
                       'auto_publish'   => false

                       );                       
  
  return $feed_params;
}



/*
 * New Blog
 *
 */
function openidconnect_feedstory_blog_new($user, $action_params) {

  $object = $action_params['object'];
  $item_id = $object->getIdentity();
  
  $feed_story = openidconnect_feedstory_compose_blog_new($item_id);

  return array('feed_story'  => $feed_story,
               'story_params' => array('item_id' => $item_id, 'blog_id' => $item_id, 'norecompile' => 1),
              );

}



function openidconnect_feedstory_compose_blog_new($blog_id) {

  $blog_id = (int)$blog_id;

  $blog = Engine_Api::_()->getItem('blog', $blog_id);
  
  if(!$blog) {
    return false;
  }
  

  $base_url = openidconnect_get_base_url();

  $blog_title = html_entity_decode($blog->getTitle(), ENT_QUOTES, 'UTF-8');

  
  $blog_url = $base_url . $blog->getHref();
  
  $blog_category = '';
  if( !empty($blog->category_id)) {
    $blog_category = Engine_Api::_()->blog()->getCategory($blog->category_id)->category_name;
  }
  
  $blog_body = html_entity_decode($blog->body, ENT_QUOTES, 'UTF-8');
  $blog_body = openidconnect_html2txt($blog_body);

  $feed_params = array('vars' => array( 'blog-title'       => $blog_title,
                                        'blog-id'          => $blog_id,
                                        'blog-body'        => $blog_body,
                                        'blog-category'    => $blog_category,
                                        'blog-link'        => $blog_url,
                                        
                                      ),
                       
                       'auto_publish'   => false

                       );                       
  
  return $feed_params;
}






/*
 * Update Status
 *
 */
function openidconnect_feedstory_status($user, $action_params, $action_media) {

  $status = $action_params['body'];

  // strip junk
  $status = html_entity_decode($status, ENT_QUOTES, 'UTF-8');
  $status = openidconnect_html2txt($status);

  $feed_story =  array(
                //'auto_publish'   => false
              );


  return array('feed_story'  => $feed_story,
               'user_message' => $status,
              );
  
}





function openidconnect_feedstory_post_self($user, $action_params, $action_media) {

  $status = $action_params['body'];

  // need to snatch attachments
  $request = Zend_Controller_Front::getInstance()->getRequest();
  
  // "Share" action
  if(($request->getControllerName() == 'index') && ($request->getActionName() == 'share') && ($request->getModuleName() == 'activity')) {
    
    $type = $request->get('type');
    $id = $request->get('id');
    $attachment = Engine_Api::_()->getItem($type, $id);

    if(!$attachment){
      return false;      
    }
    
  } else {
    
    // Just post
    $attachment = null;
    $attachmentData = $request->getParam('attachment');
    if( !empty($attachmentData) && !empty($attachmentData['type']) ) {
      $type = $attachmentData['type'];
      $config = null;
      foreach( Zend_Registry::get('Engine_Manifest') as $data )
      {
        if( !empty($data['composer'][$type]) )
        {
          $config = $data['composer'][$type];
        }
      }
      if( $config ) {
        $plugin = Engine_Api::_()->loadClass($config['plugin']);
        $method = 'onAttach'.ucfirst($type);
        $attachment = $plugin->$method($attachmentData);
      }
    }
    
  }


  $feed_attachment = array();


  $base_url = openidconnect_get_base_url();

  
  switch($type) {
    
    default:
    if($attachment->getPhotoUrl()) {
      $feed_attachment['media']  = array(
                                        array('type' => 'image',
                                              'src'  => $base_url . $attachment->getPhotoUrl(),
                                              'href' => $base_url . $attachment->getHref()
                                              )
                                        );
                        
    }
    
    $feed_attachment['description'] = $attachment->getDescription();

    $name = $attachment->getTitle();
    if (empty($name)) {
      $name = ucwords($attachment->getShortType());
    }

    $feed_attachment['name'] = $name;
    $feed_attachment['href'] = $base_url . Zend_Controller_Front::getInstance()->getBaseUrl();  // site root
    
  }

  
  // strip junk
  $status = html_entity_decode($status, ENT_QUOTES, 'UTF-8');
  $status = openidconnect_html2txt($status);



  $feed_story = array(
                      'vars' => array( //'user-status'       => $status,
                                        
                                      ),
                       
                       'auto_publish'   => true,
                       //'user_message' => $status
                        
                       
                       );
  
  if(!empty($feed_attachment)) {
    $feed_story['attachment'] = $feed_attachment;
  }

  // backlink - can be overridden in admin panel
  $feed_story['link'] = array('href' => '{*site-link*}',
                              'text' => Semods_Utils::getSetting('core.general.site.title')
                             );


  return array('feed_story'  => $feed_story,
               'user_message' => $status,
              );
  
}



/*
 * New Video
 *
 * 
 *
 */
function openidconnect_feedstory_video_new($user, $action_params) {

  $object = $action_params['object'];
  $item_id = $object->getIdentity();
  
  $feed_story = openidconnect_feedstory_compose_video_new($item_id);

  return array('feed_story'  => $feed_story,
               'story_params' => array('video_id' => $item_id, 'norecompile' => 0),
              );

}

function openidconnect_feedstory_compose_video_new($video_id) {

  $video_id = (int)$video_id;

  $video = Engine_Api::_()->getItem('video', $video_id);
  
  if(!$video) {
    return false;
  }
  
  $base_url = openidconnect_get_base_url();

  $type = 'thumb.normal';
  $video_photo = $video->getPhotoUrl($type);
  
  if(!$video_photo) {

    $helper = new Core_View_Helper_ItemPhoto();
    $safeName = ( $type ? str_replace('.', '_', $type) : 'main' );
    $video_photo = $helper->getNoPhoto($video, $safeName) ;
    
  }
  
  if(!empty($video_photo)) {
    $video_photo = $base_url . '/' . $video_photo;
  }
  
  $video_title = html_entity_decode($video->getTitle(), ENT_QUOTES, 'UTF-8');

  $video_url = $base_url . $video->getHref();
  
  $video_category = '';
  if( !empty($video->category_id)) {
    $video_category = Engine_Api::_()->video()->getCategory($video->category_id)->category_name;
  }

  
  switch($video->type) {

    // if video type is youtube
    case 1:
      $video_url_swf = 'http://www.youtube.com/v/'.$video->code.'&hl=en_US&feature=player_embedded&fs=1';
      break;

    // if video type is vimeo
    case 2:
      $video_url_swf = 'http://vimeo.com/moogaloop.swf?clip_id='.$video->code.'&server=vimeo.com&show_title=1&show_byline=1&show_portrait=0&color=&fullscreen=1';
      break;

    // if video type is uploaded
    case 3:
      // video is processed, no publishing
      $video_url_swf = '';
      break;
    
  }
  
  // extract from embed
  //if(!preg_match('/<embed.*src="([^"]+)"/',$video->getRichContent(),$matches)) {
  //  
  //  // try from embed
  //  $embed_code = htmlspecialchars_decode($video->getRichContent());
  //  if(!preg_match('/<embed.*src="([^"]+)"/',$embed_code,$matches)) {
  //    return false;
  //  }
  //
  //}

  //$video_url_swf = $matches[1];
  
  if($video_url_swf == '') {
    return false;
  }


  $feed_params = array('vars' => array( 'uservideo-title'       => $video_title,
                                        'uservideo-id'          => $video_id,
                                        'uservideo-desc'        => html_entity_decode($video->description, ENT_QUOTES, 'UTF-8'),
                                        'uservideo-duration'    => $video->duration,
                                        'uservideo-link'        => $video_url,
                                        'uservideo-category'    => $video_category,
                                        
                                      ),
                       
                       'attachment'  => array( 'media'  => array(
                                                                 array('type'   => 'flash',
                                                                       'imgsrc' => $video_photo,
                                                                       'swfsrc' => $video_url_swf,
                                                                       'href'   => $video_url,
                                                                       'width'  => '100',
                                                                       'height' => '80',
                                                                       'expanded_width' => '320',
                                                                       'expanded_height' => '240'
                                                                       )
                                                                 ),
                                               ),
                       
                       'auto_publish'   => false

                       );                       

  return $feed_params;

}










/*
 * New Photos
 *
 * 
 *
 */
function openidconnect_feedstory_album_photo_new($user, $action_params) {

  $object = $action_params['object'];
  $item_id = $object->getIdentity();

  $count = $action_params['params']['count'];
  
  // need to recompile to actually get content
  //$feed_story = openidconnect_feedstory_compose_album_photo_new($item_id, $count);
  $feed_story = array();

  return array('feed_story'  => $feed_story,
               'story_params' => array('album_id' => $item_id, 'count' => $count),
              );

}


function openidconnect_feedstory_compose_album_photo_new($album_id, $count) {

  $album = Engine_Api::_()->getItem('album', $album_id);
  
  if(!$album) {
    return false;
  }


  $base_url = openidconnect_get_base_url();

  
  $album_name = html_entity_decode($album->getTitle(), ENT_QUOTES, 'UTF-8');
  
  $album_link = $base_url . $album->getHref();

  $images = array();

  $table = Engine_Api::_()->getDbTable('photos','album');
  

  // add up to 4 images  

  $max_items = max(4, $count);

  $select = $table->select()
    ->where("collection_id = ?", $album->getIdentity())
    ->limit($max_items)
    ->order('photo_id DESC');
  
  $rows = $table->fetchAll($select);
  
  if($rows) {
    foreach($rows as $row) {
      
      if(null == $row->getPhotoUrl()) {
        continue;
      }
      
      $images[] = array('type'  => 'image',
                        'src'   => $base_url . $row->getPhotoUrl(),
                        'href'  => $base_url . $row->getHref()
                        );
      
    }
  }

  if(empty($images)) {
    return false;
  }

  $album_category = '';
  if( !empty($album->category_id)) {
    $album_category = Engine_Api::_()->album()->getCategory($album->category_id)->category_name;
  }
  
  $feed_params = array('vars' => array( 'album-id'              => $album_id,
                                        'album-link'            => $album_link,
                                        'album-name'            => $album_name,
                                        'album-category'        => $album_category
                                      ),
                       
                       'attachment'  => array( 'media'  => $images
                                               ),
                       
                       'auto_publish'   => false

                       );                       
  
  return $feed_params;

}


/*
 * New Poll
 *
 */
function openidconnect_feedstory_poll_new($user, $action_params) {
  
  $object = $action_params['object'];
  $item_id = $object->getIdentity();
  
  $feed_story = openidconnect_feedstory_compose_poll_new($item_id);

  return array('feed_story'  => $feed_story,
               'story_params' => array('poll_id' => $item_id),
              );

}



function openidconnect_feedstory_compose_poll_new($poll_id) {

  $poll_id = (int)$poll_id;

  $poll = Engine_Api::_()->getItem('poll', $poll_id);
  
  if(!$poll) {
    return false;
  }
  

  $base_url = openidconnect_get_base_url();
  
  $poll_title = html_entity_decode($poll->getTitle(), ENT_QUOTES, 'UTF-8');

  $poll_url = $base_url . $poll->getHref();
  

  $feed_params = array('vars' => array( 'poll-title'       => $poll_title,
                                        'poll-id'          => $poll_id,
                                        'poll-link'        => $poll_url,
                                        'poll-desc'        => html_entity_decode(openidconnect_html2txt($poll->description), ENT_QUOTES, 'UTF-8'),
                                        //'poll-category'    => $poll_category,
                                        
                                      ),
                       
                       'auto_publish'   => false

                       );                       
  
  
  return $feed_params;
}





/*
 * New Music Playlist
 *
 */ 
function openidconnect_feedstory_music_playlist_new($user, $action_params) {
  
  $object = $action_params['object'];
  $item_id = $object->getIdentity();
  
  $feed_story = openidconnect_feedstory_compose_music_playlist_new($item_id);

  return array('feed_story'  => $feed_story,
               'story_params' => array('playlist_id' => $item_id),
              );

}



/*
 * New Music Files
 * Unfortunately only one file is supported
 *
 * "mp3":{"src":"http://Sample.mp3","album":"My Album", "title":"My Title", "artist":"My Artist" }
 *
 */
function openidconnect_feedstory_compose_music_playlist_new($playlist_id) {

  $playlist_id = (int)$playlist_id;

  $playlist = Engine_Api::_()->getItem('music_playlist', $playlist_id);
  
  if(!$playlist) {
    return false;
  }


  $base_url = openidconnect_get_base_url();

  $playlist_title = html_entity_decode($playlist->getTitle(), ENT_QUOTES, 'UTF-8');

  
  $playlist_url = $base_url . $playlist->getHref();


  // only mp3

  //$media_path = '';
  //$song_url = '';

  $feed_params = array('vars' => array( 'playlist-title'       => $playlist_title,
                                        'playlist-id'          => $playlist_id,
                                        'playlist-link'        => $playlist_url,
                                      ),
                       
                       //'attachment'  => array( 'media'  => array(
                       //                                          array('type'   => 'mp3',
                       //                                                'src'    => $media_path,
                       //                                                'title'  => $song_title,
                       //                                                )
                       //                                          ),
                       //                        ),
                       
                       'auto_publish'   => false

                       );                       


  return $feed_params;
  
}









/*
 * New Classified listing
 *
 */
function openidconnect_feedstory_classified_new($user, $action_params) {

  $object = $action_params['object'];
  $item_id = $object->getIdentity();

  $feed_params = openidconnect_feedstory_compose_classified_new($item_id);

  return array('feed_story'  => $feed_params,
               'story_params' => array('classified_id' => $item_id)
              );
}


function openidconnect_feedstory_compose_classified_new($classified_id) {
  
  
  $classified_id = (int)$classified_id;

  $classified = Engine_Api::_()->getItem('classified', $classified_id);
  
  if(!$classified) {
    return false;
  }


  $base_url = openidconnect_get_base_url();


  $type = 'thumb.normal';
  $classified_photo = $classified->getPhotoUrl($type);
  
  if(!$classified_photo) {

    $helper = new Core_View_Helper_ItemPhoto();
    $safeName = ( $type ? str_replace('.', '_', $type) : 'main' );
    $classified_photo = $helper->getNoPhoto($classified, $safeName) ;
    
  }
  
  if(!empty($classified_photo)) {
    $classified_photo = $base_url . '/' . $classified_photo;
  }
  
  $classified_title = html_entity_decode($classified->getTitle(), ENT_QUOTES, 'UTF-8');

  
  $classified_url = $base_url . $classified->getHref();
  
  $classified_category = '';

  if( !empty($classified->category_id)) {
    $classified_category = Engine_Api::_()->classified()->getCategory($classified->category_id)->category_name;
  }


  $images = array(
              array('type' => 'image',
                    'src'  => $classified_photo,
                    'href' => $classified_url
                    )
              );


  // add up to 3 + 1 images total
  $table = Engine_Api::_()->getDbTable('photos','classified');

  $max_items = 3;

  $select = $table->select()
    ->where("classified_id = ?", $classified->getIdentity())
    ->limit($max_items)
    ->order('photo_id DESC');
  
  $rows = $table->fetchAll($select);
  
  if($rows) {
    foreach($rows as $row) {
      
      if(null == $row->getPhotoUrl()) {
        continue;
      }
      
      $images[] = array('type'  => 'image',
                        'src'   => $base_url . $row->getPhotoUrl(),
                        'href'  => $base_url . $row->getHref()
                        );
      
    }
  }
  

  $classified_price = '';
  $classified_location = '';

  // get from custom field
  
  // problem (not) - activity is created before fields are actually saved.
  $request = Zend_Controller_Front::getInstance()->getRequest();
  
  $fieldStructure = Engine_Api::_()->fields()->getFieldsStructurePartial($classified);

  if( !empty($fieldStructure) ) {

    foreach( $fieldStructure as $map ) {

      $field = $map->getChild();
      $value = $field->getValue($classified);
      
      // try to get from post
      //if(empty($value)) {
      //  $value = $request->get($map->getKey());
      //}
      
      
      if( !$field || ($field->type == 'profile_type') || !$field->display || empty($value->value) ) continue;
      
      if(( $field->type == 'currency' )  ) {
        
        $helper = new Engine_View_Helper_Locale();
        $classified_price = $helper->toCurrency($value->value, $field->config['unit']);

      }

      if( $field->type == 'location' ) {
        
        $classified_location = $value->value;

      }

    }

  }
  

  $feed_params = array('vars' => array( 'listing-title'       => $classified_title,
                                        'listing-id'          => $classified_id,
                                        'listing-desc'        => openidconnect_html2txt(html_entity_decode($classified->body, ENT_QUOTES, 'UTF-8')), 
                                        'listing-link'        => $classified_url,
                                        'listing-category'    => $classified_category,
                                        'listing-price'       => $classified_price,
                                        'listing-location'    => $classified_location,
                                        
                                      ),
                       
                       'auto_publish'   => false

                       );                       

  if(!empty($images)) {
    $feed_params['attachment'] = array('media'  => $images
                                       );
  }
  
  return $feed_params;
  
}








/*
 * Signup
 *
 */
function openidconnect_feedstory_signup($user, $action_params) {


  $subject = $action_params['subject'];
  $user_id = $subject->getIdentity();

  $invite_url     = "http://{$_SERVER['HTTP_HOST']}"
                  . Zend_Controller_Front::getInstance()->getRouter()->assemble(array(
                        'module'     => 'core',
                        'controller' => 'signup',
                        ), 'default') . '?ref=' . $user_id;
  
  $feed_params = array('vars' => array( 'signup-link'       => $invite_url,
                                      ),
                       'auto_publish'   => false
                       );                       
  
  return array('feed_story'   => $feed_params,
               'story_params' => array('signup_user_id' => $user_id, 'norecompile' => 1),
              );
  
}



/*
 * User Photo
 *
 */
function openidconnect_feedstory_profile_photo_update($user, $action_params) {

  $user = $action_params['subject'];
  $user_id = $user->getIdentity();



  $base_url = openidconnect_get_base_url();


  $type = 'thumb.profile';
  $user_photo = $user->getPhotoUrl($type);
  
  if(!$user_photo) {

    $helper = new Core_View_Helper_ItemPhoto();
    $safeName = ( $type ? str_replace('.', '_', $type) : 'main' );
    $user_photo = $helper->getNoPhoto($user, $safeName) ;
    
  }
  
  if(!empty($user_photo)) {
    $user_photo = $base_url . '/' . $user_photo;
  }
  
  $user_title = html_entity_decode($user->getTitle(), ENT_QUOTES, 'UTF-8');

  
  $profile_url = $base_url . $user->getHref() . '?ref=' . $user_id;

  $invite_url     = "http://{$_SERVER['HTTP_HOST']}"
                  . Zend_Controller_Front::getInstance()->getRouter()->assemble(array(
                        'module'     => 'core',
                        'controller' => 'signup',
                        ), 'default') . '?ref=' . $user_id;

  
  $feed_params = array('vars' => array( 'signup-link'   => $invite_url,
                                        'profile-link'  => $profile_url
                                      ),
                       'auto_publish'   => false
                       );                       

  if (!preg_match('/nophoto/', $user_photo))
  {
      $feed_params['attachment'] = array( 'media' => array(
                                                          array('type' => 'image',
                                                                'src'  => $user_photo,
                                                                'href' => $profile_url
                                                                )
                                                          )
                                         );
  }			
  
  return array('feed_story'   => $feed_params,
               //'story_params' => array('user_id' => $user_id),
              );
  
}



/*
 * New Forum Topic
 *
 */
function openidconnect_feedstory_forum_topic($user, $action_params) {

  $object = $action_params['object'];
  $item_id = $object->getIdentity();
  
  $feed_story = openidconnect_feedstory_compose_forum_topic($item_id);

  return array('feed_story'  => $feed_story,
               'story_params' => array('topic_id' => $item_id),
              );

}



function openidconnect_feedstory_compose_forum_topic($topic_id) {

  $topic_id = (int)$topic_id;

  $topic = Engine_Api::_()->getItem('forum_topic', $topic_id);
  
  if(!$topic) {
    return false;
  }

  $base_url = openidconnect_get_base_url();


  $topic_title = html_entity_decode($topic->getTitle(), ENT_QUOTES, 'UTF-8');

  
  $topic_url = $base_url . $topic->getHref();

  $forum = $topic->getParent();
  $forum_url = $forum->getHref();
  
  $post_body = $topic->getDescription(); // get first post
  
  if(Semods_Utils::getSetting('forum_bbcode')) {

    $helper = new Engine_View_Helper_BBCode();

    //$post_body =  nl2br($helper->BBCode($post_body));
    $post_body =  $helper->BBCode($post_body);
    
  }
  
  $post_body =  html_entity_decode( openidconnect_html2txt($post_body), ENT_QUOTES, 'UTF-8');

  
  $feed_params = array('vars' => array( 'post-title'       => $topic_title,
                                        'post-id'          => $topic_id,
                                        'post-link'        => $topic_url,
                                        'forum-link'       => $forum_url,

                                        'post-body'        => $post_body,

                                      ),
                       
                       'auto_publish'   => false

                       );                       
  
  return $feed_params;
  
}





/*
 * New Forum Post
 *
 *
 */
function openidconnect_feedstory_forum_post($user, $action_params) {

  $object = $action_params['object'];
  $item_id = $object->getIdentity();
  
  $feed_story = openidconnect_feedstory_compose_forum_post($item_id);

  return array('feed_story'  => $feed_story,
               'story_params' => array('post_id' => $item_id),
              );

}




function openidconnect_feedstory_compose_forum_post($post_id) {

  $post_id = (int)$post_id;

  $post = Engine_Api::_()->getItem('forum_post', $post_id);
  
  if(!$post) {
    return false;
  }


  $base_url = openidconnect_get_base_url();


  $post_title = html_entity_decode($post->getTitle(), ENT_QUOTES, 'UTF-8');

  
  $post_url = $base_url . $post->getHref();

  $forum = $post->getParent();
  $forum_url = $post->getHref();
  
  $post_body = $post->body;
  
  if(Semods_Utils::getSetting('forum_bbcode')) {

    $helper = new Engine_View_Helper_BBCode();

    //$post_body =  nl2br($helper->BBCode($post_body));
    $post_body = $helper->BBCode($post_body);
    
  }
  
  $post_body =  html_entity_decode( openidconnect_html2txt($post_body), ENT_QUOTES, 'UTF-8');


  $feed_params = array('vars' => array( 'post-title'       => $post_title,
                                        'post-id'          => $post_id,
                                        'post-body'        => $post_body,
                                        'post-link'        => $post_url,
                                        'forum-link'      => $forum_url, // topic link
                                      ),
                       
                       'auto_publish'   => false

                       );                       
  
  return $feed_params;
}







?>