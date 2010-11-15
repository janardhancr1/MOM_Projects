<?php

class Lifestream_Api_Core extends Core_Api_Abstract
{
  
  protected $_cache_lifetime = 1800; // 30 min
  protected $_cache = null;


  public function getPosts($only_check_if_cached = true, $page = 1, $refresh = false)
  {

    $socialdna_service = Engine_Api::_()->getApi('core','socialdna');
    
    $permissions_required = false;
    $service_connected = false;
    $newsfeed = array();
    $posts = array();
    
    $cached = false;

    $user_id = Semods_Utils::getUserId();
    $user_id_viewer = $user_id;

    $services = $socialdna_service->getUserServices($user_id);
    foreach($services as $service_key => $service) {
      if($service['openidservice_can_stream'] == 0) {
        unset($services[$service_key]);
      }
    }

    $wait_for_data = false;

    // @todo - user setting
    $max_items = 10;
    
    $cache_period = 30; // 30 min

    $service = 'facebook';
    $service_connected = (count($services) > 0);

    // TBD: if not cached -> load via ajax. If cached - show right away
    
    if($service_connected) {

      $cache_key = 'socialstream_stream_' . Semods_Utils::getUserId();
      
      if($refresh) {
        $this->removeCache($cache_key);
      }

      //if (true) {
      if ($this->shouldUpdatePosts($cache_period) || !($newsfeed = $this->getCache($cache_key))) {
        
        if(!$only_check_if_cached) {
          
          $api = $socialdna_service->getPublisherapi(); 

          $services = '';
  
          $newsfeed = $api->get_newsfeed($user_id, $services);
          
          
          if(Semods_Utils::g($newsfeed,'err_code',0) == 200) {
            
            $permissions_required = true;
          
          } 

        } else {

          $newsfeed = array();
          $wait_for_data = true;
          
        }
        
        
      } else {
        
        $cached = true;
        
      }
      
    }

    if(!is_array($newsfeed)) {
      $newsfeed = array();
    }

    if(!$permissions_required && $service_connected && !$cached && !$only_check_if_cached) {
      $this->processPosts($newsfeed);
      $this->setCache($newsfeed, $cache_key);

      $socialdna_service->updateOpenidUserSettings($user_id, array('last_feeds_update' => time()) );

    }

    $posts = $newsfeed;
    $posts = array_slice($posts, ($page-1)*$max_items, $max_items);
    
    return array('posts'                => $posts,
                 'permissions_required' => $permissions_required,
                 'service_connected'    => $service_connected,
                 'wait_for_data'        => $wait_for_data
                );
  }




  function shouldUpdatePosts($cache_period = 30 /* in minutes */) {

    $cache_delta = $cache_period * 60;  // 1H
    
    // TBD: profile
    $user_id = Semods_Utils::getUserId();

    $service = Engine_Api::_()->getApi('core','socialdna');

    $last_feeds_update = $service->getOpenidUserSetting($user_id, 'last_feeds_update',0);
    
    if(time() - $last_feeds_update > $cache_delta) {
      return true;
    }
    
    return false;    
  }
  
  function processPosts(&$posts) {
    foreach($posts as &$post) {

      // js safe - raw message without links
      $post['message_jssafe'] = preg_replace("%(?<!\\\\)'%", "\\'", str_replace('"',"'",$post['message']));

      // links
      if(in_array($post['service_id'],array(10))) {
        $post['message'] = preg_replace( '/(https?\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?)/', "<a href='$1' target=_blank>$1</a>", $post['message']);
      }

      
    }
  }


  public function getCache($cache_key)
  {
    $cache = $this->_getCache();
    
    if($cache) {
      return $cache->load($cache_key);
    }
    
    return null;
      
  }


  public function setCache($data, $cache_key)
  {

    $cache = $this->_getCache();
    
    if($cache) {
      return $cache->save($data, $cache_key);
    }
    
    return false;
      
  }

  public function removeCache($cache_key)
  {

    $cache = $this->_getCache();
    
    if($cache) {
      return $cache->remove($cache_key);
    }
    
    return false;
      
  }


  protected function _getCache()
  {
    
    if(is_null($this->_cache)) {
    
      $file = APPLICATION_PATH . '/application/settings/cache.php';
      if( !file_exists($file) )
      {
        $this->_cache = 0;
        return null;
      }
  
      $options = include $file;
      
      // use file
      $options['default_backend'] = 'File';
      $options['core']['lifetime'] = $this->_cache_lifetime;
      
      Engine_Cache::setConfig($options);
      $cache = Engine_Cache::factory();
  
      //if( APPLICATION_ENV == 'development' )
      //{
        //$cache->setOption('caching', false);
      //}
      
      $this->_cache = $cache;
      
      // Save in registry
      //Zend_Registry::set('Zend_Cache', $cache);
      
    }
    
    // Save in bootstrap
    return $this->_cache;
  
  }

 
}