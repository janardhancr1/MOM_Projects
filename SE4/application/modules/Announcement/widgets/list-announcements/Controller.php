<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6506 2010-06-22 23:34:02Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Announcement
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Announcement_Widget_ListAnnouncementsController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    $announcements = Engine_Api::_()->getDbtable('announcements', 'announcement')->fetchAll();
    if( count($announcements) <= 0 ) {
      return $this->setNoRender();
    }
    $this->view->announcements = $announcements;
  }
}