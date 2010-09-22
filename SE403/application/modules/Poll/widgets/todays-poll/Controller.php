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
  }

  public function getChildCount()
  {
    return $this->_childCount;
  }
}