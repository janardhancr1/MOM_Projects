<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Rating.php 6531 2010-06-23 22:02:51Z shaun $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Video_Model_Rating extends Core_Model_Item_Abstract
{
  public function getTable()
  {
    if( is_null($this->_table) )
    {
      $this->_table = Engine_Api::_()->getDbtable('ratings', 'video');
    }

    return $this->_table;
  }

  public function getOwner()
  {
    return parent::getOwner();
    // ?
    //return $this;
  }
}