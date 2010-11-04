<?php
class Socialdna_Model_DbTable_Users extends Engine_Db_Table
{
  protected $_name = 'openid_users';
  
  public function getUser($user_id,$openid_service_id) {

    $select = $this->getTable()->select()
              ->where("openid_user_id = ?", $user_id)
              ->where("openid_service_id = ?", $openid_service_id);
              
    return $this->getTable()->fetchRow($select);
    
  }

  public function getUserByKey($user_key,$openid_service_id) {

    $select = $this->getTable()->select()
              ->where("openid_user_key = ?", $user_key)
              ->where("openid_service_id = ?", $openid_service_id);
              
    return $this->getTable()->fetchRow($select);
    
  }

  public function getTable()
  {
    return $this;
  }

}