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
class Group_Widget_ProfileMembersController extends Engine_Content_Widget_Abstract
{
  protected $_childCount;
  
  public function indexAction()
  {
    // Just remove the title decorator
    $this->getElement()->removeDecorator('Title');

    // Don't render this if not authorized
    $viewer = Engine_Api::_()->user()->getViewer();
    if( !Engine_Api::_()->core()->hasSubject() ) {
      return $this->setNoRender();
    }

    // Get subject and check auth
    $subject = Engine_Api::_()->core()->getSubject('group');
    if( !$subject->authorization()->isAllowed($viewer, 'view') ) {
      return $this->setNoRender();
    }

    // Get params
    $this->view->page = $page = $this->_getParam('page', 1);
    $this->view->search = $search = $this->_getParam('search');
    $this->view->waiting = $waiting = $this->_getParam('waiting');

    // Prepare data
    $this->view->group = $group = Engine_Api::_()->core()->getSubject();
    $this->view->list = $list = $group->getOfficerList();

    $members = null;
    $viewer = Engine_Api::_()->user()->getViewer();
    if( $viewer->getIdentity() && ( $group->isOwner($viewer) || $list->has($viewer) ) ) {
      $this->view->waitingMembers = Zend_Paginator::factory($group->membership()->getMembersSelect(false));
      if( $waiting ) {
        $this->view->members = $members = $this->view->waitingMembers;
      }
    }

    if( !$members ) {
      $select = $group->membership()->getMembersObjectSelect();
      if( $search ) {
        $select->where('displayname LIKE ?', '%' . $search . '%');
      }
      $this->view->members = $members = Zend_Paginator::factory($select);
    }

    $paginator = $members;
    $members->setCurrentPageNumber($page);

    // Do not render if nothing to show and no search
    if( $paginator->getTotalItemCount() <= 0 && '' == $search ) {
      return $this->setNoRender();
    }

    // Add count to title if configured
    if( $this->_getParam('titleCount', false) && $paginator->getTotalItemCount() > 0 ) {
      $this->_childCount = $paginator->getTotalItemCount();
    }
  }

  public function getChildCount()
  {
    return $this->_childCount;
  }
}