<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6512 2010-06-23 00:27:01Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Event_Widget_HomeUpcomingController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    // Don't render this if not logged in
    $viewer = Engine_Api::_()->user()->getViewer();
    if( !$viewer->getIdentity() ) {
      return $this->setNoRender();
    }

    // Get paginator
    $eventMembership = Engine_Api::_()->getDbtable('membership', 'event');
    $eventTable = Engine_Api::_()->getItemTable('event');
    $eventTableName = $eventTable->info('name');
    $select = $eventMembership->getMembershipsOfSelect($viewer);
    $select
      ->where("`{$eventTableName}`.`starttime` > FROM_UNIXTIME(?)", time())
      ->where("`{$eventTableName}`.`starttime` < FROM_UNIXTIME(?)", time() + (86400 * 14))
      ->order("starttime ASC");

    $this->view->paginator = $paginator = Zend_Paginator::factory($select);
    $paginator->setCurrentPageNumber($this->_getParam('page'));

    // Do not render if nothing to show and not viewer
    if( $paginator->getTotalItemCount() <= 0 && !$viewer->getIdentity() ) {
      return $this->setNoRender();
    }
  }
}