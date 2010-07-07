<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: MailTemplate.php 6590 2010-06-25 19:40:21Z john $
 * @author     Jung
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Model_MailTemplate extends Core_Model_Item_Abstract
{
  protected $_parent_is_owner = true;

  protected $_ordered = false;

  protected $_allowDuplicates = false;

  protected $_searchColumns = false;


  // Complex
  public function getAll()
  {
    $listItemTable = $this->getListItemTable();
    return $listItemTable->fetchAll($this->getSelect());
  }

  public function getSelect()
  {
    return $this->getListItemTable()->select()
      ->where('mailtemplate_id = ?', $this->getIdentity());
  }
  
  public function getPaginator()
  {
    return Zend_Paginator::factory($this->getSelect());
  }

  // Internal hooks

  protected function _delete()
  {
    foreach( $this->getAll() as $listitem ) {
      $listitem->delete();
    }
    parent::_delete();
  }
}