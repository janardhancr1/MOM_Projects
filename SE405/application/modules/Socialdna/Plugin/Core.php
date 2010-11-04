<?php

class Socialdna_Plugin_Core
{
  
  public function onUserDeleteBefore($event)
  {
  
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {

      $service = Engine_Api::_()->getApi('core', 'socialdna');

      // Links
      Engine_Api::_()->getDbtable('users', 'socialdna')->delete( array('openid_user_id = ?' => $payload->getIdentity() ) );

      // Settings
      Engine_Api::_()->getDbtable('usersettings', 'socialdna')->delete( array('openid_user_setting_user_id = ?' => $payload->getIdentity() ) );
      
    }
  }
  
}