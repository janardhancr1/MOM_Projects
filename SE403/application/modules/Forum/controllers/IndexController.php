<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_IndexController extends Core_Controller_Action_Standard
{
  public function init()
  {
	if( !$this->_helper->requireUser()->isValid() ) return;
	$this->getRightSideContent();
  }
  
  public function indexAction()
  {
    if ( !$this->_helper->requireAuth()->setAuthParams('forum', null, 'view')->isValid() ) return;

    $table = Engine_Api::_()->getItemTable('forum_category');
    $this->view->categories = $table->fetchAll($table->select()->order('order ASC'));
    $this->view->forums = $forums = Engine_Api::_()->getItemTable('forum_forum')->fetchAll();
  }
}