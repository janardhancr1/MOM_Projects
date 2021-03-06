<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Group_Widget_ListPopularGroupsController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    $table = Engine_Api::_()->getDbtable('groups', 'group');
    $rName = $table->info('name');

    $tmTable = Engine_Api::_()->getDbtable('categories', 'group');
    $tmName = $tmTable->info('name');
  	
    $select = $table->select()
     ->from($rName);
     
     
    /*->where("$tmName.show_home_page = ?", 1)
     ->limit( 10 )
     ->group("$rName.group_id")
      ->order( $rName.'.group_id DESC' );
  	
      $select = $select
        ->setIntegrityCheck(false)
        ->from($rName)
        ->joinInner($tmName, "$rName.category_id = $tmName.category_id");*/
    
    $select1 = $tmTable->select()
    ->where("$tmName.show_home_page = ?", 1);
  
    /*$CategoriesArray = array();
	 foreach ($tmTable->fetchAll($select1) as $row)
	 {
	 	$GroupsArray = array();
	 		 $select = $table->select()
	    	->where("$rName.category_id = ?", $row->category_id);
	    	foreach ($table->fetchAll($select) as $row1)
	    	{
	    		$GroupsArray[$row1->group_id] = $row1->title;
	    		
	    	}
	    	$CategoriesArray[$row->title] = $GroupsArray;
	 }	*/
 		
 		
    $paginator = Zend_Paginator::factory($select);
    $categories = Zend_Paginator::factory($select1);

    if( ($paginator->getTotalItemCount() <= 0) ||  ($categories->getTotalItemCount() <= 0)) {
      return $this->setNoRender();
    }

    $this->view->categories = $categories;
    $this->view->paginator = $paginator;
  }
}
