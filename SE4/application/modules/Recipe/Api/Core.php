<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Core.php 6175 2010-06-08 00:57:06Z steve $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_Api_Core extends Core_Api_Abstract
{
  const IMAGE_WIDTH = 720;
  const IMAGE_HEIGHT = 720;

  const THUMB_WIDTH = 140;
  const THUMB_HEIGHT = 160;
  
  public function getRecipeSelect( $params = array() )
  {
    $params  = array_merge(array(
      'user_id' => null,
      'sort'    => 'recent',
      'search'  => '',
      'closed'  => 0,
    ), $params);

    $p_table = Engine_Api::_()->getDbTable('recipes', 'recipe');
    $p_name  = $p_table->info('name');
    //$o_table = Engine_Api::_()->getDbTable('options', 'recipe');
    //$o_name  = $o_table->info('name');

    $select  = $p_table->select()->from($p_name)->where('is_closed = ?', $params['closed']);

    if (!empty($params['user_id']))
      $select->where('user_id = ?', $params['user_id']);


    switch ($params['sort']) {
        case 'popular':
          $select->setIntegrityCheck(false)
                 ->from($o_name, "SUM($o_name.votes) AS total_votes")
                 ->where("$p_name.recipe_id = $o_name.recipe_id")
                 ->group("$p_name.recipe_id");
          $select->order('total_votes DESC')
                 ->order('views DESC');
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
        $table_options = Engine_Api::_()->getDbTable('options', 'recipe')->info('name');
        $select->joinLeft($o_name, "$p_name.recipe_id = $o_name.recipe_id", '')
               ->where("`recipe_name` LIKE ? OR `recipe_description` LIKE ? ", $search)
               ->group("$p_name.recipe_id");
      } else
        $select->where("`recipe_name` LIKE ? OR `recipe_description` LIKE ? ", $search);
        
    }
      if (!empty($params['category']))
	{
		$select->where("`category_id` = ?", $params['category']);
	}
    return $select;
  }

  /**
   * Returns a collection of all the categories in the recipe plugin
   *
   * @return Zend_Db_Table_Select
   */
  public function getCategories()
  {
    return $this->api()->getDbtable('categories', 'recipe')->fetchAll();
  }
  
  public function getCategory($category_id)
  {
    $category = new Recipe_Model_Category($category_id);
    return $category;
  }
  
  public function getRecipeVotes($recipe_ids)
  {
    /*if (is_string($recipe_ids))
      $recipe_ids = array($recipe_ids);

    $recipe_votes = array();
    $table  = Engine_Api::_()->recipe()->api()->getDbtable('options', 'recipe');
    $select = $table->select()
                    ->from($table->info('name'), array(
                        'recipe_id',
                        new Zend_Db_Expr('SUM(votes) AS votes'),
                      ))
                    ->group('recipe_id')
                    ->order('recipe_id');
    if (!empty($recipe_ids))
      $select->where('recipe_id IN (?)', $recipe_ids);

    foreach ($table->fetchAll($select) as $row)
      if (!empty($row))
        $recipe_votes[$row->recipe_id] = $row->votes;

    return $recipe_votes;*/
  }

  public function setVote($recipe_id, $option_id, $user_id=0)
  {
    if (empty($user_id))
      $user_id = Engine_Api::_()->user()->getViewer()->getIdentity();
    
    $table  = Engine_Api::_()->getDbTable('votes', 'recipe');
    $select = $table->select()
                    ->where('recipe_id = ?', $recipe_id)
                    ->where('user_id = ?', $user_id);
    $row = $table->fetchRow($select);
    if (!empty($row)) {
      $row->recipe_option_id = $option_id;
      $row->modified_date  = date('Y-m-d H:i:s');
      $row->save();
    } else {
      Engine_Api::_()->getDbTable('votes', 'recipe')->insert(array(
        'recipe_id' => $recipe_id,
        'user_id' => $user_id,
        'recipe_option_id' => $option_id,
        'creation_date' => date('Y-m-d H:i:s'),
      ));
    }

    // we also have to update the recipe_options table
    $table  = Engine_Api::_()->getDbTable('votes', 'recipe');
    $select = $table->select()
                    ->setIntegrityCheck(false)
                    ->from($table->info('name'), array(
                      'recipe_option_id',
                      new Zend_Db_Expr('COUNT(*) AS votes'),
                    ))
                    ->where('recipe_id = ?', $recipe_id)
                    ->group('recipe_option_id');
    $options = array();
    foreach ($table->fetchAll($select) as $row)
      $options[$row->recipe_option_id] = $row->votes;
    
    $table = Engine_Api::_()->getDbTable('options', 'recipe');
    $select = $table->select()
                    ->where('recipe_id = ?', $recipe_id);
    foreach ($table->fetchAll($select) as $row) {
      $votes = isset($options[$row->recipe_option_id]) && !empty($options[$row->recipe_option_id])
               ? $options[$row->recipe_option_id]
               : 0;
      $row->votes = $votes;
      $row->save();
    }
  }

  public function viewerHasVoted($recipe_id)
  {
    $user_id = Engine_Api::_()->user()->getViewer()->getIdentity();
    $table   = Engine_Api::_()->recipe()->api()->getDbtable('votes', 'recipe');
    $select  = $table->select()
                     ->from($table->info('name'), array(
                         'recipe_option_id',
                       ))
                     ->where('recipe_id = ?', $recipe_id)
                     ->where('user_id = ?', $user_id)
                     ->limit(1);
    $row = $table->fetchRow($select);
    if (!empty($row) && isset($row['recipe_option_id']))
      return $row['recipe_option_id'];
  }
  public function deleteRecipe($recipe_id)
  {
    // first, delete activity feed and its comments/likes
    Engine_Api::_()->getItem('recipe', $recipe_id)->delete();

  }

  /**
   * Gets a paginator for recipes
   *
   * @param Core_Model_Item_Abstract $user The user to get the messages for
   * @return Zend_Paginator
   */
  public function getRecipesPaginator($params = array()) {
    return Zend_Paginator::factory($this->getRecipeSelect($params));
  }
 public function createPhoto($params, $file)
  {
    if( $file instanceof Storage_Model_File )
    {
      $params['file_id'] = $file->getIdentity();
    }

    else
    {
      // Get image info and resize
      $name = basename($file['tmp_name']);
      $path = dirname($file['tmp_name']);
      $extension = ltrim(strrchr($file['name'], '.'), '.');

      $mainName = $path.'/m_'.$name . '.' . $extension;
      $thumbName = $path.'/t_'.$name . '.' . $extension;

      $image = Engine_Image::factory();
      $image->open($file['tmp_name'])
          ->resize(self::IMAGE_WIDTH, self::IMAGE_HEIGHT)
          ->write($mainName)
          ->destroy();

      $image = Engine_Image::factory();
      $image->open($file['tmp_name'])
          ->resize(self::THUMB_WIDTH, self::THUMB_HEIGHT)
          ->write($thumbName)
          ->destroy();

      // Store photos
      $photo_params = array(
        'parent_id' => $params['recipe_id'],
        'parent_type' => 'recipe',
      );

      $photoFile = Engine_Api::_()->storage()->create($mainName, $photo_params);
      $thumbFile = Engine_Api::_()->storage()->create($thumbName, $photo_params);
      $photoFile->bridge($thumbFile, 'thumb.normal');

      $params['file_id'] = $photoFile->file_id; // This might be wrong
      $params['photo_id'] = $photoFile->file_id;
      /*
      $param['owner_type'] = $params['parent_type'];
      $param['owner_id'] = $params['parent_id'];
      unset($params['parent_type']);
      unset($params['parent_id']);
      */
    }

    $row = Engine_Api::_()->getDbtable('photos', 'recipe')->createRow();
    $row->setFromArray($params);
    $row->save();
    return $row;
  }
}