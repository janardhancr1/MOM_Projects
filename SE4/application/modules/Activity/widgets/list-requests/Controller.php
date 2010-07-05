<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6505 2010-06-22 23:27:39Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Activity_Widget_ListRequestsController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    // Must be logged in
    $viewer = Engine_Api::_()->user()->getViewer();
    if( !$viewer->getIdentity() ) {
      return $this->setNoRender();
    }

    // Get requests
    $this->view->requests = Engine_Api::_()->getDbtable('notifications', 'activity')->getRequestCountsByType($viewer);

    // If no requests, just skip rendering
    if( empty($this->view->requests) ) {
      return $this->setNoRender();
    }
  }
}