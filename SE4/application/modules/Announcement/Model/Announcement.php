<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Announcement.php 6506 2010-06-22 23:34:02Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Announcement_Model_Announcement extends Core_Model_Item_Abstract
{
  protected $_parent_type = 'user';

  protected $_owner_type = 'user';

  public function getHref($params = array())
  {
    return 'bleh';
  }

  protected function _update()
  {
    if( !empty($this->_modifiedFields['title']) || !empty($this->_modifiedFields['body']) ) {
      $this->modified_date = date('Y-m-d H:i:s');
    }
    parent::_update();
  }
}