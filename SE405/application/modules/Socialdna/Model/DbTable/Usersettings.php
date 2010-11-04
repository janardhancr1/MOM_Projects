<?php
class Socialdna_Model_DbTable_Usersettings extends Engine_Db_Table
{
  protected $_name = 'openid_user_settings';

  public function getSettings($user_id) {

    $select = $this->getTable()->select()
              ->where("openid_user_setting_user_id = ?", (int)$user_id);

    $rows = $this->getTable()->fetchAll($select);


    $settings = array();

    foreach($rows as $row) {
      $settings[$row['openid_user_setting_key']] = $row['openid_user_setting_value'];
    }
    
    return $settings;
    
    
  }

  public function getTable()
  {
    return $this;
  }

}