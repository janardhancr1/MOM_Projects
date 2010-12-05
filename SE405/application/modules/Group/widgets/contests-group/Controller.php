<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6516 2010-06-23 01:15:53Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Group_Widget_ContestsGroupController extends Engine_Content_Widget_Abstract
{
	public function indexAction()
	{
		 
		$values["ctitle"] = "Momburbia Contest Group";
		$this->view->paginator = $paginator = Engine_Api::_()->getApi('core', 'group')
            ->getGroupPaginator($values);
      
		$paginator->setCurrentPageNumber(1);

		// Do not render if nothing to show
		if( $paginator->getTotalItemCount() <= 0 ) {
			return $this->setNoRender();
		}
	}
}