<?php

class Lifestream_Widget_ProfileIdentityController extends Engine_Content_Widget_Abstract
{
  
  
  public function indexAction()
  {

    // Don't render this if not authorized
    $viewer = Engine_Api::_()->user()->getViewer();
    if( !Engine_Api::_()->core()->hasSubject() ) {
      return $this->setNoRender();
    }

    $subject = Engine_Api::_()->core()->getSubject('user');

    $socialdna_service = Engine_Api::_()->getApi('core','socialdna');
    
    $links = array();
    
    $services = $socialdna_service->getUserServices($subject->getIdentity());
    foreach($services as $service_key => $service) {
      
      $profile_link = '';

      if($service['openid_user_profile_url'] != '') {

        $profile_link = Semods_Utils::g($service,'openid_user_profile_url','');

      } else {

        switch($service['openidservice_name']) {
          
          case 'facebook':
            $profile_link = 'http://www.facebook.com/profile.php?id=' . $service['openid_user_key'];
            break;

          case 'myspace':
            $profile_link = 'http://www.myspace.com/' . $service['openid_user_key'];
            break;
          
        }
        
      }
      
      if($profile_link != '') {
        $links[] = array('label'  => $service['openidservice_displayname'],
                         'link'   => $profile_link,
                         'icon'   => $service['openidservice_logo_mini']
                         );
      }
        
    }
    
    if(empty($links)) {
      return $this->setNoRender();
    }
    
    $this->view->links = $links;

  }


  public function getCacheKey()
  {
    return true;
  }
  
}