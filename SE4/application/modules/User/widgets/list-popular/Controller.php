<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_Widget_ListPopularController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    $table = Engine_Api::_()->getDbtable('users', 'user');
    $select = $table->select()
      ->where('search = ?', 1)
      ->where('member_count > ?', -1) //0)
      ->order('member_count DESC')
      ->limit(4);

    $users = $table->fetchAll($select);
    
    if( count($users) < 1 )
    {
      return $this->setNoRender();
    }

    $this->view->users = $users;
  }

  public function getCacheKey()
  {
    return true;
  }
}