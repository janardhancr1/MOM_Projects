<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: WidgetController.php 6505 2010-06-22 23:27:39Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Activity_WidgetController extends Core_Controller_Action_Standard
{
  public function notificationsAction()
  {
    $page = $this->_getParam('page');
    $viewer = Engine_Api::_()->user()->getViewer();
    $this->view->notifications = $notifications = Engine_Api::_()->getDbtable('notifications', 'activity')->getNotificationsPaginator($viewer);
    $notifications->setCurrentPageNumber($page);

    if( $notifications->getCurrentItemCount() <= 0 || $page > $notifications->getCurrentPageNumber() ) {
      $this->_helper->viewRenderer->setNoRender(true);
      return;
    }

    // Force rendering now
    $this->_helper->viewRenderer->postDispatch();
    $this->_helper->viewRenderer->setNoRender(true);

    // Now mark them all as read
    /*
    $ids = array();
    foreach( $notifications as $notification ) {
      $ids[] = $notification->notification_id;
    }
    Engine_Api::_()->getDbtable('notifications', 'activity')->markNotificationsAsRead($viewer, $ids);     
    */
    
  }
}
