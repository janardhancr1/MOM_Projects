<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_Widget_ProfileOptionsController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    // Don't render this if not authorized
    $viewer = Engine_Api::_()->user()->getViewer();
    if( !Engine_Api::_()->core()->hasSubject() ) {
      return $this->setNoRender();
    }

    // Get subject and check auth
    $this->view->member = $subject = Engine_Api::_()->core()->getSubject('user');
    //if( !$subject->authorization()->isAllowed($viewer, 'view') ) {
    //  return $this->setNoRender();
    //}

    $this->view->navigation = Engine_Api::_()
      ->getApi('menus', 'core')
      ->getNavigation('user_profile');
  }
}