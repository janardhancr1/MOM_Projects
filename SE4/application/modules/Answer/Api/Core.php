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
  // Select


  /**
   * Gets a paginator for blogs
   *
   * @param Core_Model_Item_Abstract $user The user to get the messages for
   * @return Zend_Paginator
   */
  public function getAnswersPaginator($params = array())
  {
    $paginator = Zend_Paginator::factory($this->getAnswersSelect($params));
    if( !empty($params['page']) )
    {
      $paginator->setCurrentPageNumber($params['page']);
    }
    if( !empty($params['limit']) )
    {
      $paginator->setItemCountPerPage($params['limit']);
    }

    if( empty($params['limit']) )
    {
      $page = (int) Engine_Api::_()->getApi('settings', 'core')->getSetting('answer.page', 10);
      $paginator->setItemCountPerPage($page);
    }

    return $paginator;
  }

  /**
   * Gets a select object for the user's blog entries
   *
   * @param Core_Model_Item_Abstract $user The user to get the messages for
   * @return Zend_Db_Table_Select
   */
  public function getAnswersSelect($params = array())
  {
    $table = Engine_Api::_()->getDbtable('answers', 'answer');
    $rName = $table->info('name');

    $tmTable = Engine_Api::_()->getDbtable('TagMaps', 'core');
    $tmName = $tmTable->info('name');
    //$tmTable = Engine_Api::_()->getDbtable('tagmaps', 'blog');
    //$tmName = $tmTable->info('name');

    $select = $table->select()
      ->order( !empty($params['orderby']) ? $params['orderby'].' DESC' : 'creation_date DESC' );
    
    if( !empty($params['user_id']) && is_numeric($params['user_id']) )
    {
      $select->where($rName.'.owner_id = ?', $params['user_id']);
    }

    if( !empty($params['user']) && $params['user'] instanceof User_Model_User )
    {
      $select->where($rName.'.owner_id = ?', $params['user_id']->getIdentity());
    }

    if( !empty($params['users']) )
    {
      $str = (string) ( is_array($params['users']) ? "'" . join("', '", $params['users']) . "'" : $params['users'] );
      $select->where($rName.'.owner_id in (?)', new Zend_Db_Expr($str));
    }

    if( !empty($params['tag']) )
    {
      $select
        ->setIntegrityCheck(false)
        ->from($rName)
        ->joinLeft($tmName, "$tmName.resource_id = $rName.answer_id")
        ->where($tmName.'.resource_type = ?', 'answer')
        ->where($tmName.'.tag_id = ?', $params['tag']);
    }
    //else $select->group("$rName.blog_id");

    // Could we use the search indexer for this?
    if( !empty($params['search']) )
    {
      $select->where($rName.".answer_title LIKE ?", '%'.$params['search'].'%');
    }

    return $select;
  }

  /**
   * Adds a category to the blog plugin
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
   * Returns a collection of all the categories in the blog plugin
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
}