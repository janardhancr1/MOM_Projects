<?php
class Socialdna_Plugin_Signup
{
  public function onUserCreateAfter($payload)
  {
    
    $viewer = $payload->getPayload();
    

    // add custom fields
    $service = Engine_Api::_()->getApi('core', 'socialdna');
  
    if($service->signup_via_openid) {
      
      // Link Openid <--> new user id
      $service->linkUserToOpenid($viewer->getIdentity());

      // @todo - TBD - done in the account form
      // send email with random password
  
    }
    
  }
  
}
?>
