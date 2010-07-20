<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 5712 2010-05-12 18:20:05Z jung $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Api_Core extends Core_Api_Abstract
{
  public function getAnswerSelect( $params = array() )
  {
    $params  = array_merge(array(
      'user_id' => null,
      'sort'    => 'recent',
      'search'  => '',
    ), $params);

    $p_table = Engine_Api::_()->getDbTable('answers', 'answer');
    $p_name  = $p_table->info('name');
    //$o_table = Engine_Api::_()->getDbTable('options', 'recipe');
    //$o_name  = $o_table->info('name');

    $select  = $p_table->select()->from($p_name);

    if (!empty($params['user_id']))
      $select->where('user_id = ?', $params['user_id']);


    switch ($params['sort']) {
        case 'open':
          	$select->where('is_closed = 0');
          break;
        case 'resolved':
        $select->where('is_closed = 1');
          break;
          
        case 'recent':
        default:
          $select->order('creation_date DESC');
          break;
    }

    if (!empty($params['search'])) {
      $search = "%{$params['search']}%";
      // if we do not need to search the Options table, we could just do this:
      // ->where("`title` LIKE ? OR `description` LIKE ?", $search);
      // but since we do, we must do the following join:
      if ('popular' != $search) {
        $select
               ->where("`answer_title` LIKE ? ", $search)
               ->group("$p_name.answer_id");
      } else
        $select->where("`answer_title` LIKE ? ", $search);
    }
    return $select;
  }
  
  /**
   * Adds a category to the answers plugin
   *
   * @param String name of category
   * @return Zend_Paginator
   */  
  public function addCategory($value)
  {
    $this->api()->getDbtable('categories', 'answer')
      ->delete(array(
        'user_id = ?' => $this->getIdentity(),
        'blocked_user_id = ?' => $user->getIdentity()
      ));
    return $this;
  }

  /**
   * Returns a collection of all the categories in the answers plugin
   *
   * @return Zend_Db_Table_Select
   */
  public function getCategories()
  {
    return $this->api()->getDbtable('categories', 'answer')->fetchAll();
  }

  /**
   * Returns a category item
   *
   * @param Int category_id
   * @return Zend_Db_Table_Select
   */
  public function getCategory($category_id)
  {
    $category = new Answer_Model_Category($category_id);
    return $category;
  }

  /**
   * Returns a categories created by a given user
   *
   * @param Int user_id
   * @return Zend_Db_Table_Select
   */
  public function getUserCategories($user_id)
  {
    $table  = Engine_Api::_()->getDbtable('categories', 'answer');
    $uName = Engine_Api::_()->getDbtable('answers', 'answer')->info('name');
    $iName = $table->info('name');

    $select = $table->select()
      ->setIntegrityCheck(false)
      ->from($iName, array('category_name'))
      ->joinLeft($uName, "$uName.category_id = $iName.category_id")
      ->group("$iName.category_id")
      ->where($uName.'.owner_id = ?', $user_id)
      ->where($uName.'.draft = ?', "0");

    return $table->fetchAll($select);
  }

  /**
   * Returns a collection of dates where a given user created a blog entry
   *
   * @param Int user_id
   * @return Zend_Db_Table_Select
   */
  function getArchiveList($user_id)
  {
    $table = Engine_Api::_()->getDbtable('answers', 'answer');
    $rName = $table->info('name');

    $select = $table->select()
      //->setIntegrityCheck(false)
      ->from($rName)
      ->where($rName.'.owner_id = ?', $user_id)
      ->where($rName.'.draft = ?', "0");

    return $table->fetchAll($select);
  }
  
	public function getAnswersPaginator($params = array()) {
    return Zend_Paginator::factory($this->getAnswerSelect($params));
  }

}