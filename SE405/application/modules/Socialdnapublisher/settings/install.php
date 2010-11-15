<?php
class Socialdnapublisher_Installer extends Engine_Package_Installer_Module
{
  function _runCustomQueries()
  {

    $db     = $this->getDb();
    
    // Feed Stories

    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 1,
                      'feedstory_usermessage'   => 'Join my group!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'group_create',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:45:"{*actor*} created a new Group {*group-title*}";s:14:"feedstory_body";s:70:"Group Description: {*group-desc*} - Group Category: {*group-category*}";s:19:"feedstory_link_link";s:14:"{*group-link*}";s:19:"feedstory_link_text";s:21:"Join {*group-title*}!";s:14:"feedstory_href";s:14:"{*group-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => 'a:1:{i:0;a:4:{s:6:"module";s:5:"group";s:6:"action";s:4:"edit";s:10:"controller";s:5:"group";s:7:"publish";b:0;}}',
                      'feedstory_publishprompt' => 1,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*group-title*},{*group-desc*},{*group-link*},{*group-category*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_group',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Group/externals/images/types/group.png'
                      )
               );
    }
    catch(Exception $ex) {}
  
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 2,
                      'feedstory_usermessage'   => 'Join my event!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'event_create',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:45:"{*actor*} created a new Event {*event-title*}";s:14:"feedstory_body";s:31:"{*event-date*} - {*event-desc*}";s:19:"feedstory_link_link";s:14:"{*event-link*}";s:19:"feedstory_link_text";s:23:"RSVP to {*event-title*}";s:14:"feedstory_href";s:14:"{*event-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => 'a:1:{i:0;a:4:{s:6:"module";s:5:"event";s:6:"action";s:4:"edit";s:10:"controller";s:5:"event";s:7:"publish";b:0;}}',
                      'feedstory_publishprompt' => 1,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*event-title*},{*event-desc*},{*event-link*},{*event-location*},{*event-category*},{*event-date*},{*event-host*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_event',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Event/externals/images/types/event.png'
                      )
               );
    }
    catch(Exception $ex) {}
  
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 3,
                      'feedstory_usermessage'   => 'Check out my blog!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'blog_new',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:42:"{*actor*} posted a new Blog {*blog-title*}";s:14:"feedstory_body";s:13:"{*blog-body*}";s:19:"feedstory_link_link";s:13:"{*blog-link*}";s:19:"feedstory_link_text";s:19:"Read {*blog-title*}";s:14:"feedstory_href";s:13:"{*blog-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*blog-title*},{*blog-body*},{*blog-category*},{*blog-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_blog',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Blog/externals/images/types/blog.png'
                      )
               );
    }
    catch(Exception $ex) {}
  
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 4,
                      'feedstory_usermessage'   => '',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'status',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:0:"";s:14:"feedstory_body";s:0:"";s:19:"feedstory_link_link";s:0:"";s:19:"feedstory_link_text";s:0:"";s:14:"feedstory_href";s:0:"";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 0,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_user_status',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => ''
                      )
               );
    }
    catch(Exception $ex) {}
  
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 5,
                      'feedstory_usermessage'   => 'Check out my video!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'video_new',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:50:"{*actor*} uploaded a new Video {*uservideo-title*}";s:14:"feedstory_body";s:18:"{*uservideo-desc*}";s:19:"feedstory_link_link";s:18:"{*uservideo-link*}";s:19:"feedstory_link_text";s:25:"Watch {*uservideo-title*}";s:14:"feedstory_href";s:18:"{*uservideo-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*uservideo-title*},{*uservideo-desc*},{*uservideo-duration*},{*uservideo-category*},{*uservideo-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_video',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Video/externals/images/types/video.png'
                      )
               );
    }
    catch(Exception $ex) {}
  
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 6,
                      'feedstory_usermessage'   => 'Check out my photos!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'photo',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:29:"{*actor*} uploaded new photos";s:14:"feedstory_body";s:0:"";s:19:"feedstory_link_link";s:14:"{*album-link*}";s:19:"feedstory_link_text";s:10:"View photo";s:14:"feedstory_href";s:14:"{*album-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*alnum-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_photo',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Album/externals/images/types/album.png'
                      )
               );
    }
    catch(Exception $ex) {}
  
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 7,
                      'feedstory_usermessage'   => 'Check out my poll!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'poll_new',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:43:"{*actor*} created a new poll {*poll-title*}";s:14:"feedstory_body";s:0:"";s:19:"feedstory_link_link";s:13:"{*poll-link*}";s:19:"feedstory_link_text";s:9:"View Poll";s:14:"feedstory_href";s:13:"{*poll-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 1,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*poll-title*},{*poll-desc*},{*poll-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_poll',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Poll/externals/images/types/poll.png'
                      )
               );
    }
    catch(Exception $ex) {}
    
    //try {
    //$db->insert('engine4_openid_feedstories',
    //            array('feedstory_id'            => 9,
    //                  'feedstory_usermessage'   => 'Check out my song!',
    //                  'feedstory_userprompt'    => '',
    //                  'feedstory_service_id'    => 1,
    //                  'feedstory_type'          => 'newmusic',
    //                  'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:44:"{*actor*} uploaded a new song {*song-title*}";s:14:"feedstory_body";s:0:"";s:19:"feedstory_link_link";s:13:"{*song-link*}";s:19:"feedstory_link_text";s:9:"View Song";s:14:"feedstory_href";s:13:"{*song-link*}";s:18:"template_bundle_id";i:0;}',
    //                  'feedstory_enabled'       => 1,
    //                  'feedstory_pagecheck'     => '',
    //                  'feedstory_publishprompt' => 0,
    //                  'feedstory_compiler'      => '',
    //                  'feedstory_publishusing'  => 'stream',
    //                  'feedstory_vars'          => '{*actor*},{*song-title*},{*song-link*},{*site-name*},{*site-link*}',
    //                  'feedstory_display'       => 1,
    //                  'feedstory_display_user'  => 1,
    //                  'feedstory_desc'          => 'socialdna_feedstory_desc_music_song',
    //                  'feedstory_module'        => '',
    //                  'feedstory_icon'          => 'application/modules/Music/externals/images/types/music.png'
    //                  )
    //           );
    //}
    //catch(Exception $ex) {}
    
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 10,
                      'feedstory_usermessage'   => 'Check out my classified!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'classified_new',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:59:"{*actor*} posted a new Classified Listing {*listing-title*}";s:14:"feedstory_body";s:60:"{*listing-desc*} in {*listing-category*} ({*listing-price*})";s:19:"feedstory_link_link";s:16:"{*listing-link*}";s:19:"feedstory_link_text";s:18:"View my classified";s:14:"feedstory_href";s:16:"{*listing-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => 'a:2:{i:0;a:4:{s:6:"module";s:10:"classified";s:6:"action";s:6:"upload";s:10:"controller";s:5:"photo";s:7:"publish";b:0;}i:1;a:4:{s:6:"module";s:10:"classified";s:6:"action";s:4:"edit";s:10:"controller";s:5:"index";s:7:"publish";b:0;}}',
                      'feedstory_publishprompt' => 1,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*listing-title*},{*listing-desc*},{*listing-link*},{*listing-category*},{*listing-price*},{*listing-location*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_classified',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Classified/externals/images/types/classified.png'
                      )
               );
    }
    catch(Exception $ex) {}
    
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 11,
                      'feedstory_usermessage'   => '',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'signup',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:45:"{*actor*} has just signed up to {*site-name*}";s:14:"feedstory_body";s:30:"Find and join me on this site!";s:19:"feedstory_link_link";s:15:"{*signup-link*}";s:19:"feedstory_link_text";s:24:"Find me on {*site-name*}";s:14:"feedstory_href";s:15:"{*signup-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*signup-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 0,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_user_joined',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => ''
                      )
               );
    }
    catch(Exception $ex) {}
    
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 13,
                      'feedstory_usermessage'   => '',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'forum_topic',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:50:"{*actor*} created a new forum topic {*post-title*}";s:14:"feedstory_body";s:13:"{*post-body*}";s:19:"feedstory_link_link";s:13:"{*post-link*}";s:19:"feedstory_link_text";s:19:"Read {*post-title*}";s:14:"feedstory_href";s:13:"{*post-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*post-title*},{*post-body*},{*post-link*},{*forum-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_forum',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Forum/externals/images/post.png'
                      )
               );
    }
    catch(Exception $ex) {}
    
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 14,
                      'feedstory_usermessage'   => '',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'forum_post',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:51:"{*actor*} posted a new forum message {*post-title*}";s:14:"feedstory_body";s:13:"{*post-body*}";s:19:"feedstory_link_link";s:13:"{*post-link*}";s:19:"feedstory_link_text";s:19:"Read {*post-title*}";s:14:"feedstory_href";s:13:"{*post-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*post-title*},{*post-body*},{*post-link*},{*forum-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_forum_reply',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Forum/externals/images/post.png'
                      )
               );
    }
    catch(Exception $ex) {}
    
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 15,
                      'feedstory_usermessage'   => 'Check out my profile!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'profile_photo_update',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:48:"{*actor*} updated profile photo on {*site-name*}";s:14:"feedstory_body";s:30:"Find and join me on this site!";s:19:"feedstory_link_link";s:16:"{*profile-link*}";s:19:"feedstory_link_text";s:7:"Find me";s:14:"feedstory_href";s:16:"{*profile-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*profile-link*},{*signup-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_user_photo',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Album/externals/images/types/album.png'
                      )
               );
    }
    catch(Exception $ex) {}
    
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 16,
                      'feedstory_usermessage'   => 'Check out my photos!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'album_photo_new',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:47:"{*actor*} uploaded new photos to {*album-name*}";s:14:"feedstory_body";s:0:"";s:19:"feedstory_link_link";s:14:"{*album-link*}";s:19:"feedstory_link_text";s:11:"View photos";s:14:"feedstory_href";s:14:"{*album-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*album-name*},{*album-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_photo_album',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Album/externals/images/types/album.png'
                      )
               );
    }
    catch(Exception $ex) {}
    
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 18,
                      'feedstory_usermessage'   => 'Check out my playlist!',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'music_playlist_new',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:57:"{*actor*} created a new music playlist {*playlist-title*}";s:14:"feedstory_body";s:0:"";s:19:"feedstory_link_link";s:17:"{*playlist-link*}";s:19:"feedstory_link_text";s:19:"View Music Playlist";s:14:"feedstory_href";s:17:"{*playlist-link*}";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*playlist-title*},{*playlist-link*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_music_playlist',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Music/externals/images/types/music.png'
                      )
               );
    }
    catch(Exception $ex) {}
    
    try {
    $db->insert('engine4_openid_feedstories',
                array('feedstory_id'            => 19,
                      'feedstory_usermessage'   => '',
                      'feedstory_userprompt'    => '',
                      'feedstory_service_id'    => 1,
                      'feedstory_type'          => 'post_self',
                      'feedstory_metadata'      => 'a:6:{s:15:"feedstory_title";s:0:"";s:14:"feedstory_body";s:0:"";s:19:"feedstory_link_link";s:0:"";s:19:"feedstory_link_text";s:0:"";s:14:"feedstory_href";s:0:"";s:18:"template_bundle_id";i:0;}',
                      'feedstory_enabled'       => 1,
                      'feedstory_pagecheck'     => '',
                      'feedstory_publishprompt' => 0,
                      'feedstory_compiler'      => '',
                      'feedstory_publishusing'  => 'stream',
                      'feedstory_vars'          => '{*actor*},{*site-name*},{*site-link*}',
                      'feedstory_display'       => 1,
                      'feedstory_display_user'  => 1,
                      'feedstory_desc'          => 'socialdna_feedstory_desc_post_self',
                      'feedstory_module'        => '',
                      'feedstory_icon'          => 'application/modules/Activity/externals/images/activity/post.png'
                      )
               );
    }
    catch(Exception $ex) {}
  
  
    return 1;

  }
}
