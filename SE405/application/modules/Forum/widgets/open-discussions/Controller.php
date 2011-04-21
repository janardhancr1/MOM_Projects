<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Widget_OpenDiscussionsController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
       $categoryTable = Engine_Api::_()->getItemTable('forum_category');
    $this->view->categories = $categoryTable->fetchAll($categoryTable->select()->where("show_homepage = 1")->order('order ASC'));
    
    $forumTable = Engine_Api::_()->getItemTable('forum_forum');
    $forumSelect = $forumTable->select()
    ->where("show_homepage = 1")
      ->order('order ASC')
      ;

    $forums = array();
    foreach( $forumTable->fetchAll($forumTable->select()
    ->where("show_homepage = 1")) as $forum ) {
      //if( Engine_Api::_()->authorization()->isAllowed($forum, null, 'view') ) {
        $order = $forum->order;
        while( isset($forums[$forum->category_id][$order]) ) {
          $order++;
        }
        $forums[$forum->category_id][$order] = $forum;
        ksort($forums[$forum->category_id]);
      //}
    }
    $this->view->forums = $forums;
  }
}