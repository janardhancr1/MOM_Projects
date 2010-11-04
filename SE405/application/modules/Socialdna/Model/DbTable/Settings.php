<?php
class Socialdna_Model_DbTable_Settings extends Engine_Db_Table
{
  protected $_name = 'openid_settings';


  public function getSetting($key, $default = null)
  {
    
    $key = $this->_normalizeMagicProperty($key);

    $setting = $this->fetchRow(array("name = ?" => $key));
    if(!$setting) {
      return $default;
    }
    
    return $setting->value;

  }

  public function setSetting($key, $value) {
    $key = $this->_normalizeMagicProperty($key);
    
    $update = false;
    
    try {
      
      $this->insert(array('name'  => $key, 'value' => $value));
      
    } catch(Exception $ex) {
      
      $update = true;
      
    }
    
    if($update) {

      $this->update(array('value' => $value), array('name = ? ' => $key) );
      
    }
    
  }

  protected function _normalizeMagicProperty($key)
  {
    return strtolower(str_replace('_', '.', $key));
  }

}