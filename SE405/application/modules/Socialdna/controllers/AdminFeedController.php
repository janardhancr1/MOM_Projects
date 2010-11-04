<?php

class Socialdna_AdminFeedController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {
    
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_admin_main', array(), 'socialdna_admin_main_feed');

    $storyfocus = $this->getRequest()->get('storyfocus');

    $service_name = 'facebook';
  
    $feedService = Engine_Api::_()->getApi('feed', 'socialdnapublisher');  // socialdnapublisher ?

    if($this->getRequest()->isPost()) {
      
      $feedstories = $this->getRequest()->get('feedstory');

      foreach($feedstories as $feedstory_id => $feedstory) {

        $feedstory['feedstory_title'] = htmlspecialchars_decode( $feedstory['feedstory_title'], ENT_QUOTES );
        $feedstory['feedstory_body'] = htmlspecialchars_decode( $feedstory['feedstory_body'], ENT_QUOTES);
        $feedstory['feedstory_link_link'] = htmlspecialchars_decode( $feedstory['feedstory_link_link'], ENT_QUOTES);
        $feedstory['feedstory_link_text'] = htmlspecialchars_decode( $feedstory['feedstory_link_text'], ENT_QUOTES);
        $feedstory['feedstory_href'] = htmlspecialchars_decode( $feedstory['feedstory_href'], ENT_QUOTES);

        $feedstory['feedstory_enabled'] = (int)Semods_Utils::g($feedstory['feedstory_enabled'],0);

        $metadata = array('feedstory_title' => $feedstory['feedstory_title'],
                          'feedstory_body' => $feedstory['feedstory_body'],
                          'feedstory_link_link' => $feedstory['feedstory_link_link'],
                          'feedstory_link_text' => $feedstory['feedstory_link_text'],
                          'feedstory_href' => $feedstory['feedstory_href'],
                          'template_bundle_id' => 0,
                          );

        $metadata_serialized = serialize($metadata);
        $feedstory['feedstory_metadata'] = $metadata_serialized;

        unset($feedstory['feedstory_title']);
        unset($feedstory['feedstory_body']);
        unset($feedstory['feedstory_href']);
        unset($feedstory['feedstory_link_link']);
        unset($feedstory['feedstory_link_text']);


        $feedService->updateFeedStory($feedstory, $feedstory_id);

      }

      // CACHING

      $cache_key = 'openidconnect_feed_actions_' . $service_name . '_0' ;
      Semods_Utils::removeCache($cache_key);

      $cache_key = 'openidconnect_feed_actions_' . $service_name . '_1' ;
      Semods_Utils::removeCache($cache_key);

      $result = 1;

    }



    $openidconnect_facebook_feed_actions = $feedService->loadFeedActions(1, false, true);
    
    $this->view->openidconnect_facebook_feed_actions = $openidconnect_facebook_feed_actions;
    $this->view->storyfocus = $storyfocus;

  }


}