<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Blog_Widget_ListPopularBlogsController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
  	$table = Engine_Api::_()->getDbtable('blogs', 'blog');
    $rName = $table->info('name');

    $tmTable = Engine_Api::_()->getDbtable('users', 'user');
    $tmName = $tmTable->info('name');
    
    $select = $table->select()
      ->where("$rName.search = ?", 1)
      ->where("$tmName.level_id = ?", 3)
      ->order("$rName.view_count DESC")
      ;

     $select = $select
        ->setIntegrityCheck(false)
        ->from($rName)
        ->joinInner($tmName, "$tmName.user_id = $rName.owner_id");
        
      
    $paginator = Zend_Paginator::factory($select);

    if( $paginator->getTotalItemCount() <= 0 ) {
      return $this->setNoRender();
    }

    $this->view->paginator = $paginator;
  }
}