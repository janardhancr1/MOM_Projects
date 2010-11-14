<?php

require_once APPLICATION_PATH_COR . DS . 'libraries/Facebook/facebook.php';
 
class Socialdna_Api_Facebook extends Core_Api_Abstract
{

  function getLinkedFriendsStats() {

    return Engine_Api::_()->getApi('core', 'socialdna')->getOpenidapi('','facebook')->get_linked_friends_stats();
    
  }

  function getLinkedFriends($start = 0, $limit = 10, $orderby = "") {

    $service = Engine_Api::_()->getApi('core', 'socialdna');

    $users = array();
    
    $friends = $service->getOpenidapi('','facebook')->get_linked_friends($start, $limit, $orderby);

    if (is_array($friends) && count($friends)) {

      foreach ($friends as $friend) {
        $friends_ids[] = $friend['uid'];
        $friends_indexed[$friend['uid']] = $friend;
      }

      $friends_for_query = implode(',',$friends_ids);
      
      $facebook_service_id = $service->getServiceId('facebook');


	  $table_openid_users = Engine_Api::_()->getDbTable('users', 'socialdna');
	  $table_openid_users_name = $table_openid_users->info('name');
	  $table_users = Engine_Api::_()->getDbTable('users', 'user');
	  $table_users_name = $table_users->info('name');
	  
	  $select = $table_openid_users->select()
		->setIntegrityCheck(false)
		->from($table_openid_users_name,'*')
		->join($table_users_name, "`{$table_openid_users_name}`.`openid_user_id` = `{$table_users_name}`.`user_id`", '*' )
		->where("openid_user_key IN (?)",$friends_for_query)
		->where("openid_service_id = ?", $facebook_service_id)
		->where("enabled = 1")
		->limit($limit);
		
	  $rows = $table_users->fetchAll($select);
	  
	  $rows = $rows ? $rows->toArray() : array();
      
      foreach($rows as $row) {
        $row['user_openid_thumb'] = ($friends_indexed[$row['openid_user_key']]['pic_square_with_logo'] != '' ? $friends_indexed[$row['openid_user_key']]['pic_square_with_logo'] : OPENIDCONNECT_FACEBOOK_PIC_SQUARE_DEFAULT);
        $row['user_openid_uid'] = $friends_indexed[$row['openid_user_key']]['uid'];
        
        $users[] = $row;
      }
      
    }

    return $users;
  }

  function getUnlinkedFriends($max = 0) {
    return Engine_Api::_()->getApi('core', 'socialdna')->getOpenidapi('','facebook')->get_unlinked_friends($max);
  }

}
 
?>