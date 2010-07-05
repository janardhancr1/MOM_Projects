<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 6515 2010-06-23 00:53:16Z shaun $
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
  public function indexAction()
  {
    if ( !$this->_helper->requireAuth()->setAuthParams('forum', null, 'view')->isValid() ) return;

    $table = Engine_Api::_()->getItemTable('forum_category');
    $this->view->categories = $table->fetchAll($table->select()->order('order ASC'));
    $this->view->forums = $forums = Engine_Api::_()->getItemTable('forum_forum')->fetchAll();
  }
}