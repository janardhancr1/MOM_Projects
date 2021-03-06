<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Contests
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Bootstrap.php 2048 2009-12-21 03:32:29Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Contests
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Contests_IndexController extends Core_Controller_Action_Standard
{
	public function browseAction()
	{
		if( !$this->_helper->requireUser()->isValid() ) return;
		$this->getRightSideContent();
		
		$values["title"] = "Momburbia Contest Group";
		$this->view->paginator = $paginator = Engine_Api::_()->getApi('core', 'group')
            ->getGroupPaginator($values);
      
		$paginator->setCurrentPageNumber(1);
	}

	
}