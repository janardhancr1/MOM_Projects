<?php

class Socialdnapublisher_Plugin_Core
{

  public function onSemodsAddActivity($event)
  {

    $payload = $event->getPayload();

    $user = $payload['subject'];
    $actiontype_name = $payload['type'];

    $api = Engine_Api::_()->getApi('feed', 'socialdnapublisher');

    $api->add( $payload );
    
  }












  public function onAlbumCreateAfter($event)
  {

    $type = 'newalbum';

    $params = array( 'subject'  => Engine_Api::_()->user()->getViewer(),
                     'object'   => $event->getPayload(),
                     'type'     => $type
                     );

    Engine_Api::_()->getApi('feed', 'socialdnapublisher')->add( $params );
    
  }


  public function onForumTopicCreateAfter($event)
  {

    $type = 'forum_topic';

    $params = array( 'subject'  => Engine_Api::_()->user()->getViewer(),
                     'object'   => $event->getPayload(),
                     'type'     => $type
                     );

    Engine_Api::_()->getApi('feed', 'socialdnapublisher')->add( $params );
    
  }

  public function onForumPostCreateAfter($event)
  {

    $type = 'forum_post';

    $params = array( 'subject'  => Engine_Api::_()->user()->getViewer(),
                     'object'   => $event->getPayload(),
                     'type'     => $type
                     );

    Engine_Api::_()->getApi('feed', 'socialdnapublisher')->add( $params );
    
  }

  public function onMusicSongCreateAfter($event)
  {

    $type = 'newmusic';

    $params = array( 'subject'  => Engine_Api::_()->user()->getViewer(),
                     'object'   => $event->getPayload(),
                     'type'     => $type
                     );

    Engine_Api::_()->getApi('feed', 'socialdnapublisher')->add( $params );

  }
  
}