<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Network.php 6605 2010-06-28 21:24:32Z jung $
 * @author     Sami
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Network
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Network_Model_Network extends Core_Model_Item_Abstract 
{
  public function getHref()
  {
    return null;
  }
  
  public function setFromArray($values)
  {
    if( !empty($values['assignment']) && $values['assignment'] == 1 && !empty($values['field_id']) ) {
      $table = $this->getTable();
      $cols = $table->info('cols');
      $params = array_intersect_key($values, array_combine($cols, $cols));

      // Pattern
      if( $params['assignment'] == 1 && !empty($params['field_id']) ) {
        $field_id = $params['field_id'];
        $pattern = $values['field_pattern_' . $params['field_id']];
        $types = Zend_Json::decode($values['types']);
        $type = $types[$field_id];
        $params['pattern'] = array(
          'type' => $type,
          'value' => $pattern,
        );
      }

      $values = $params;
    }
    
    return parent::setFromArray($values);
  }

  public function toFormArray()
  {
    $params = $this->toArray();
    if( $params['assignment'] == 1 && !empty($params['field_id']) ) {
      $field_id = $params['field_id'];
      $params['field_pattern_' . $field_id] = $params['pattern']['value'];
    }
    return $params;
  }

  public function membership()
  {
    return new Engine_ProxyObject($this, $this->api()->getDbtable('membership', 'network'));
  }
  
  public function recalculateAll()
  {
    if( $this->assignment != 1 || empty($this->pattern) || empty($this->field_id) ) {
      return $this;
    }

    $this->membership()->removeAllMembers();

    // Get pattern thingy
    $pattern = $this->pattern;
    if( $pattern['type'] == 'text' ) {
      $pattern['value'] = '%' . trim($pattern['value'], '%') . '%';
    }
    
    $users = Engine_Api::_()->fields()->getMatchingItems("user", $this->field_id, $pattern['value']);
    foreach( $users as $user )
    {
      $this->membership()
        ->addMember($user)
        ->setUserApproved($user)
        ->setResourceApproved($user);
    }
    
    return $this;
  }

  public function recalculate(User_Model_User $user, $values = null)
  {
    if( $this->assignment != 1 || empty($this->pattern) || empty($this->field_id) ) {
      return $this;
    }
    
    if( null === $values ) {
      $values = Engine_Api::_()->fields()->getFieldsValues($user);
    }

    // Missing field or user didn't fill field in
    $value = $values->getRowMatching('field_id', $this->field_id);
    if( !is_object($value) || empty($value->value) )
    {
      return $this;
    }
    
    $value = $value->value;

    // Try to match value
    $found = false;
    $pattern = $this->pattern['value'];
    switch( $this->pattern['type'] ) {
      case 'text':
        if( stripos($value, $pattern) !== false ) {
          $found = true;
        }
        break;

      case 'exact':
      case 'select':
        if( $value == $pattern ) {
          $found = true;
        }
        break;

      case 'list':
        if( in_array($value, (array) $pattern) ) {
          $found = true;
        }
        break;

      case 'range':
        $unfound = true;
        if( !empty($pattern['min']) ) {
          if( $value < $pattern['min'] ) {
            $unfound = false;
          }
        }
        if( !empty($pattern['max']) ) {
          if( $value > $pattern['max'] ) {
            $unfound = false;
          }
        }
        $found = !$unfound;
        break;

      case 'date':
        $unfound = true;
        if( !empty($pattern['min']) ) {
          if( strtotime($value) < strtotime($pattern['min']) ) {
            $unfound = false;
          }
        }
        if( !empty($pattern['max']) ) {
          if( strtotime($value) > strtotime($pattern['max']) ) {
            $unfound = false;
          }
        }
        $found = !$unfound;
        break;
    }


    if( $found ) {
      if( !$this->membership()->isMember($user) ) {
        $this->membership()->addMember($user)
          ->setUserApproved($user, true)
          ->setResourceApproved($user, true);
      }
    } else {
      if( $this->membership()->isMember($user) ) {
        $this->membership()->removeMember($user);
      }
    }
    
    return $this;
  }

  public function isOwner()
  {
    return false;
  }

  public function getMemberCount()
  {
    return $this->member_count;
  }

  protected function _readData($spec)
  {
    if (!is_numeric($spec))
    {
      $spec = $this->getTable()->fetchRow($this->getTable()->select()->where("name = ?", $spec));
    }
    return parent::_readData($spec);
  }

  protected function _delete(){
    
  }

}