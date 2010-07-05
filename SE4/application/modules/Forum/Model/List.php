<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: List.php 6072 2010-06-02 02:36:45Z john $
 * @author     Sami
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Model_List extends Core_Model_List
{
  protected $_owner_type = 'forum';

  protected $_child_type = 'user';

  public function getListItemTable()
  {
    return Engine_Api::_()->getItemTable('forum_list_item');
  }
}