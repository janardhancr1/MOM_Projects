<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Forums.php 6515 2010-06-23 00:53:16Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Model_DbTable_Forums extends Engine_Db_Table
{
  protected $_rowClass = 'Forum_Model_Forum';

  public function getChildrenSelectOfForumCategory($category)
  {
    return $this->select()->where('category_id = ?', $category->category_id);
  }
}