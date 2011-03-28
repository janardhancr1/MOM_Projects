<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Answewr
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Widget_ListTopAnswersController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
  	$table = Engine_Api::_()->getDbtable('answers', 'answer');
    $rName = $table->info('name');

    $tmTable = Engine_Api::_()->getDbtable('categories', 'answer');
    $tmName = $tmTable->info('name');
        
    $select1 = $tmTable->select()
    ->where("$tmName.show_home_page = ?", 1);
   
    $CategoriesArray = array();
  	
   	foreach ($tmTable->fetchAll($select1) as $row)
	 {
	 		$AnswersArray = array();
	 		 $select = $table->select()
	    	->where("$rName.category_id = ?", $row->category_id)
	    	->order("$rName.creation_date DESC")
	    	->limit(1);
	    	foreach ($table->fetchAll($select) as $row1)
	    	{
	    		$AnswersArray[$row1->answer_id] = $row1->title;
	    		
	    	}
	    	$temp = $row->category_name."||".$row->category_id;
	    	$CategoriesArray[$temp] = $AnswersArray;
	    	
	 }
    //$this->view->categories = $categories;
    $this->view->paginator = $CategoriesArray;
  }
}