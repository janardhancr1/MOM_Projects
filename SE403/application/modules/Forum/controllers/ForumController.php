<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: ForumController.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_ForumController extends Core_Controller_Action_Standard
{
  public function init()
  {
    if( 0 !== ($forum_id = (int) $this->_getParam('forum_id')) &&
        null !== ($forum = Engine_Api::_()->getItem('forum_forum', $forum_id)) )
    {
      Engine_Api::_()->core()->setSubject($forum);
    }

    else if( 0 !== ($category_id = (int) $this->_getParam('category_id')) &&
        null !== ($category = Engine_Api::_()->getItem('forum_category', $category_id)) )
    {
      Engine_Api::_()->core()->setSubject($category);
    }
  }
  
  public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject('forum_category')->isValid() ) return;
    if (!$this->_helper->requireAuth->setAuthParams('forum', null, 'create')->isValid()) return;
    
    $viewer = Engine_Api::_()->user()->getViewer();
    $category = Engine_Api::_()->core()->getSubject();

    $this->view->form = $form = new Forum_Form_Forum_Create();

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $table = Engine_Api::_()->getItemTable('forum_forum');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $values = $form->getValues();
      $values['user_id'] = $viewer->getIdentity();
      $values['category_id'] = $category->getIdentity();
      $forum = $table->createRow();
      $forum->setFromArray($values);
      $forum->save();
      
      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }

  public function deleteAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject('forum_forum')->isValid() ) return;

    $viewer = Engine_Api::_()->user()->getViewer();
    $forum = Engine_Api::_()->core()->getSubject();
    
    $this->view->form = $form = new Forum_Form_Forum_Delete();

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $table = Engine_Api::_()->getItemTable('forum_forum');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $forum->delete();
      
      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }

  public function editAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject('forum_forum')->isValid() ) return;

    $viewer = Engine_Api::_()->user()->getViewer();
    $forum = Engine_Api::_()->core()->getSubject();

    $this->view->form = $form = new Forum_Form_Forum_Edit();

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $table = Engine_Api::_()->getItemTable('forum_forum');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $values = $form->getValues();
      
      $forum->setFromArray($values);
      $forum->save();

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }

  public function viewAction()
  {
    if( !$this->_helper->requireAuth->setAuthParams('forum', null, 'view')->isValid() ) return;
    if( !$this->_helper->requireSubject('forum')->isValid() ) return;

    $settings = Engine_Api::_()->getApi('settings', 'core');
    $viewer = Engine_Api::_()->user()->getViewer();
    $this->view->forum = $forum = Engine_Api::_()->core()->getSubject();

    // Increment view count
    $forum->view_count = new Zend_Db_Expr('view_count + 1');
    $forum->save();

    $can_post = $this->view->can_post = $this->_helper->requireAuth->setAuthParams('forum', null, 'create')->checkRequire();

    $table = Engine_Api::_()->getItemTable('forum_topic');
    $select = $forum->getChildrenSelect('forum_topic', array('order'=>'modified_date DESC'))->where('sticky = ?', 0);
    $this->view->paginator = $paginator = Zend_Paginator::factory($select);
    $this->view->stickies = $table->fetchAll($forum->getChildrenSelect('forum_topic', array('order'=>'modified_date DESC'))->where('sticky = 1'));
    $paginator->setCurrentPageNumber($this->_getParam('page'));
    $paginator->setItemCountPerPage($settings->getSetting('forum_forum_pagelength'));
    $list = $forum->getModeratorList();
    $moderators = $this->view->moderators = $list->getAllChildren();
    $this->view->topics = $topics = $table->fetchAll($select);
  }
}