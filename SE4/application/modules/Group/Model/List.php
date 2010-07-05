<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: List.php 6516 2010-06-23 01:15:53Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Group_Model_List extends Core_Model_List
{
  protected $_owner_type = 'group';

  protected $_child_type = 'user';

  public $ignorePermCheck = true;

  public function getListItemTable()
  {
    return Engine_Api::_()->getItemTable('group_list_item');
  }
}