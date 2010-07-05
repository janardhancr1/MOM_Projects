<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6506 2010-06-22 23:34:02Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Announcement_Api_Core extends Core_Api_Abstract
{
  public function getPaginator($params = array())
  {
    return Zend_Paginator::factory($this->getSelect($params));
  }

  public function getSelect($params = array())
  {
    $table = $this->api()->getDbtable('announcements', 'announcement');

    $select = $table->select()
      ->order( !empty($params['orderby']) ? $params['orderby'].' '.$params['orderby_direction'] : 'announcement_id DESC' );

    $select->limit(10);

    return $select;
  }
}