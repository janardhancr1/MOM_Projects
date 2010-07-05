<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6590 2010-06-25 19:40:21Z john $
 * @author     Sami
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Api_Core extends Core_Api_Abstract
{
 
  public function getMaxCategoryOrder()
  {
    $table = Engine_Api::_()->getItemTable('forum_category');
    $select = new Zend_Db_Select($table->getAdapter());
    $select = $select->from($table->info('name'), new Zend_Db_Expr('MAX(`order`) as max_order'));
    $data = $select->query()->fetch();
    $order = (int) @$data['max_order'];
    return $order;

  }
 
}