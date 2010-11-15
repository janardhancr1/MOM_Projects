<?php

class Lifestream_Plugin_Core
{
  
  public function onUserDeleteBefore($event)
  {
  
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {

      //Engine_Api::_()->getDbtable('lifestream', 'lifestream')->delete( array('lifestream_user_id = ?' => $payload->getIdentity() ) );
      
    }

  }
  
}