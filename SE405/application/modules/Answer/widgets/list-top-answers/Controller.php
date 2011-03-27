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
  	
    $select = $table->select()
    ->where("$tmName.show_home_page = ?", 1)
     ->group("$rName.answer_cat_id")
      ->order( $rName.'.answer_id DESC' );
  	
      $select = $select
        ->setIntegrityCheck(false)
        ->from($rName)
        ->joinInner($tmName, "$rName.answer_cat_id = $tmName.category_id");

           $select1 = $tmTable->select()
    ->where("$tmName.show_home_page = ?", 1);
    
    $paginator = Zend_Paginator::factory($select);
 	$categories = Zend_Paginator::factory($select1);
 	
    if( ($paginator->getTotalItemCount() <= 0) || ($categories->getTotalItemCount() <= 0)) {
      return $this->setNoRender();
    }

    $this->view->categories = $categories;
    $this->view->paginator = $paginator;
  }
}