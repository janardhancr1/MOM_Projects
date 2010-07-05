<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Search.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Api_Search extends Core_Api_Abstract
{
  public function index(Core_Model_Item_Abstract $item)
  {
    // Check if not search allowed
    if( isset($item->search) && !$item->search )
    {
      return false;
    }

    // Get info
    $type = $item->getType();
    $id = $item->getIdentity();
    $title = substr(trim($item->getTitle()), 0, 255);
    $description = substr(trim($item->getDescription()), 0, 255);
    $keywords = substr(trim($item->getKeywords()), 0, 255);
    $hiddenText = substr(trim($item->getHiddenSearchData()), 0, 255);
    
    // Ignore if no title and no description
    if( !$title && !$description )
    {
      return false;
    }

    // Check if already indexed
    $table = Engine_Api::_()->getDbtable('search', 'core');
    $select = $table->select()
      ->where('type = ?', $type)
      ->where('id = ?', $id)
      ->limit(1);

    $row = $table->fetchRow($select);

    if( null === $row )
    {
      $row = $table->createRow();
      $row->type = $type;
      $row->id = $id;
    }

    $row->title = $title;
    $row->description = $description;
    $row->keywords = $keywords;
    $row->hidden = $hiddenText;
    $row->save();
  }

  public function unindex(Core_Model_Item_Abstract $item)
  {
    $table = Engine_Api::_()->getDbtable('search', 'core');

    $table->delete(array(
      'type = ?' => $item->getType(),
      'id = ?' => $item->getIdentity(),
    ));

    return $this;
  }

  public function getPaginator($text)
  {
    $table = Engine_Api::_()->getDbtable('search', 'core');
    $db = $table->getAdapter();
    $select = $table->select()
      ->where(new Zend_Db_Expr($db->quoteInto('MATCH(`title`, `description`, `keywords`, `hidden`) AGAINST (? IN BOOLEAN MODE)', $text)))
      ->order(new Zend_Db_Expr($db->quoteInto('MATCH(`title`, `description`, `keywords`, `hidden`) AGAINST (?) DESC', $text)));

    return Zend_Paginator::factory($select);
  }
}