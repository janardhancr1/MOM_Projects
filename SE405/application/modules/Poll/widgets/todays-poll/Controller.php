<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6302 2010-06-12 00:47:21Z jung $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Poll_Widget_TodaysPollController extends Engine_Content_Widget_Abstract
{
  protected $_childCount;
  
  public function indexAction()
  {
  	
    $this->view->paginator = $paginator = Engine_Api::_()->poll()->getPollsPaginator(array(
        'sort' => "creation_date",
        ));

    $this->view->paginator->setItemCountPerPage(1);
    $paginator->setCurrentPageNumber(1);
    
    // Do not render if nothing to show
    if( $paginator->getTotalItemCount() <= 0 ) {
      return $this->setNoRender();
    }
    
    //$answer = Engine_Api::_()->getItem('poll', $this->_getParam('answer_id'));
    foreach($paginator as $pol)
    	$this->view->poll = $poll = Engine_Api::_()->getItem('poll', $pol->poll_id);
    $this->view->owner = $owner = $poll->getOwner();
    $this->view->viewer = $viewer = Engine_Api::_()->user()->getViewer();
    $this->view->pollOptions = $poll->getOptions();
    $this->view->hasVoted = $poll->viewerVoted();
    $this->view->showPieChart = Engine_Api::_()->getApi('settings', 'core')->getSetting('poll.showPieChart', false);
    $this->view->canVote = $poll->authorization()->isAllowed(null, 'vote');
    $this->view->canChangeVote = Engine_Api::_()->getApi('settings', 'core')->getSetting('poll.canChangeVote', false);
    
  }

  public function getChildCount()
  {
    return $this->_childCount;
  }
}