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
    ->where("$tmName.show_home_page = ?", 1)
     ->limit( 10 )
     ->order( $rName.'.group_id DESC' );
  	
      $select = $select
        ->setIntegrityCheck(false)
        ->from($rName, array('groupname' => 'title'))
        ->joinInner($tmName, "$rName.category_id = $tmName.category_id");

    $paginator = Zend_Paginator::factory($select);

    if( $paginator->getTotalItemCount() <= 0 ) {
      return $this->setNoRender();
    }

    $this->view->paginator = $paginator;
  }
}
