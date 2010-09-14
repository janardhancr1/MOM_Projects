<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminManageController.php 7244 2010-09-01 01:49:53Z john $
 * @author     Sami
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_AdminManageController extends Core_Controller_Action_Admin
{
  // @todo add in stricter settings for admin level checking
  public function indexAction()
  {
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('forum_admin_main', array(), 'forum_admin_main_manage');

    $table = Engine_Api::_()->getItemTable('forum_category');
    $this->view->categories = $table->fetchAll($table->select()->order('order ASC'));

  }

  public function moveForumAction()
  {
    if( $this->getRequest()->isPost() ) {
      $forum_id = $this->_getParam('forum_id');
      $forum = Engine_Api::_()->getItem('forum_forum', $forum_id);
      $forum->moveUp();
    }
  }

  public function moveCategoryAction()
  {
    if( $this->getRequest()->isPost() ) {
      $category_id = $this->_getParam('category_id');
      $category = Engine_Api::_()->getItem('forum_category', $category_id);
      $category->moveUp();
    }
  }

  public function editForumAction()
  {
    $forum_id = $this->getRequest()->getParam('forum_id');
    $forum = Engine_Api::_()->getItem('forum_forum', $forum_id);
    $form = $this->view->form = new Forum_Form_Admin_EditForum();
    $form->title->setValue(htmlspecialchars_decode($forum->title));
    $form->description->setValue(htmlspecialchars_decode($forum->description));
    $form->category_id->setValue($forum->category_id);

    if (!$this->getRequest()->isPost())
    {
      return;
    }

    if (!$form->isValid($this->getRequest()->getPost()))
    {
      return;
    }
    $forum->title = htmlspecialchars($form->getValue('title'));
    $forum->description = htmlspecialchars($form->getValue('description'));
    $changed_category = false;
    if ($forum->category_id != $form->getValue('category_id'))
    {
      $changed_category = true;
    }
    $category_id = $forum->category_id = $form->getValue('category_id');
    if ($changed_category)
    {
      $forum->order = Engine_Api::_()->getItem('forum_category', $category_id)->getHighestOrder() + 1;
    }
    $forum->save();

    return $this->_forward('success', 'utility', 'core', array(
            'messages' => array(Zend_Registry::get('Zend_Translate')->_('Forum renamed.')),
            'layout' => 'default-simple',
            'parentRefresh' => true,
    ));
  }

  public function editCategoryAction()
  {
    $category_id = $this->getRequest()->getParam('category_id');
    $category = Engine_Api::_()->getItem('forum_category', $category_id);
    $form = $this->view->form = new Forum_Form_Admin_EditCategory();
    $form->title->setValue(htmlspecialchars_decode($category->title));

    if (!$this->getRequest()->isPost())
    {
      return;
    }

    if (!$form->isValid($this->getRequest()->getPost()))
    {
      return;
    }
    $category->title = htmlspecialchars($form->getValue('title'));
    $category->save();

    return $this->_forward('success', 'utility', 'core', array(
            'messages' => array(Zend_Registry::get('Zend_Translate')->_('Category renamed.')),
            'layout' => 'default-simple',
            'parentRefresh' => true,
    ));
  }

  public function addCategoryAction()
  {
    $form = $this->view->form = new Forum_Form_Admin_AddCategory();
    if (!$this->getRequest()->isPost())
    {
      return;
    }

    if (!$form->isValid($this->getRequest()->getPost()))
    {
      return;
    }
    $table = Engine_Api::_()->getItemTable('forum_category');
    $db = $table->getAdapter();
    $db->beginTransaction();
    try
    {
      $values = $form->getValues();
      $category = $table->createRow();
      $category->title = htmlspecialchars($values['title']);
      $category->order = Engine_Api::_()->forum()->getMaxCategoryOrder() + 1;
      $category->save();
      $db->commit();
    }
    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }

    return $this->_forward('success', 'utility', 'core', array(
            'messages' => array(Zend_Registry::get('Zend_Translate')->_('Category added.')),
            'layout' => 'default-simple',
            'parentRefresh' => true,
    ));
  }

  public function addForumAction()
  {
    $form = $this->view->form = new Forum_Form_Admin_AddForum();
    if (!$this->getRequest()->isPost())
    {
      return;
    }

    if (!$form->isValid($this->getRequest()->getPost()))
    {
      return;
    }
    $table = Engine_Api::_()->getItemTable('forum_forum');
    $db = $table->getAdapter();
    $db->beginTransaction();
    try
    {
      $values = $form->getValues();
      $forum = $table->createRow();
      $forum->setFromArray($values);
      $forum->title = htmlspecialchars($values['title']);
      $forum->description = htmlspecialchars($values['description']);
      $forum->order = $forum->getCollection()->getHighestOrder() + 1;
      $forum->save();
      $db->commit();
    }
    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }

    return $this->_forward('success', 'utility', 'core', array(
            'messages' => array(Zend_Registry::get('Zend_Translate')->_('Forum added.')),
            'layout' => 'default-simple',
            'parentRefresh' => true,
    ));

  }

  public function addModeratorAction()
  {
    $form = $this->view->form = new Forum_Form_Admin_AddModerator();
    $forum_id = $this->getRequest()->getParam('forum_id');
    $forum = $this->view->forum = Engine_Api::_()->getItem('forum_forum', $forum_id);
    if ($this->getRequest()->isPost())
    {
      $moderator_id = $this->getRequest()->getParam('moderator_id');
      $moderator = Engine_Api::_()->getItem('user', $moderator_id);
      $list = $forum->getModeratorList();
      $list->add($moderator);
      return $this->_forward('success', 'utility', 'core', array(
              'messages' => array(Zend_Registry::get('Zend_Translate')->_('Moderator Added')),
              'layout' => 'default-simple',
              'parentRefresh' => true,
      ));
    }
  }

  public function userSearchAction()
  {
    $page = $this->getRequest()->getParam('page', 1);
    $username = $this->getRequest()->getParam('username');
    $table = $this->_helper->api()->getDbtable('users', 'user');
    $select = $table->select();
    if( !empty($username) )
    {
      $select = $select->where('username LIKE ?', '%' . $username . '%');
    }
    $forum_id = $this->getRequest()->getParam('forum_id');
    $this->view->forum = $forum = Engine_Api::_()->getItem('forum_forum', $forum_id);
    $this->view->paginator = $paginator = Zend_Paginator::factory($select);
    $this->view->paginator = $paginator->setCurrentPageNumber( $page );
    $this->view->paginator->setItemCountPerPage(20);
  }

  public function removeModeratorAction()
  {
    $form = $this->view->form = new Forum_Form_Admin_RemoveModerator();
    if (!$this->getRequest()->isPost())
    {
      return;
    }
    $user_id = $this->getRequest()->getParam('user_id');
    $user = Engine_Api::_()->getItem('user', $user_id);

    $forum_id = $this->getRequest()->getParam('forum_id');
    $forum = Engine_Api::_()->getItem('forum_forum', $forum_id);
    $list = $forum->getModeratorList();
    $list->remove($user);
    return $this->_forward('success', 'utility', 'core', array(
            'messages' => array(Zend_Registry::get('Zend_Translate')->_('Moderator Removed')),
            'layout' => 'default-simple',
            'parentRefresh' => true,
    ));
  }

  public function deleteCategoryAction()
  {
    $form = $this->view->form = new Forum_Form_Admin_DeleteCategory();
    if (!$this->getRequest()->isPost())
    {
      return;
    }
    $table = Engine_Api::_()->getItemTable('forum_category');
    $db = $table->getAdapter();
    $db->beginTransaction();
    $category_id = $this->getRequest()->getParam('category_id');
    try
    {
      $category = Engine_Api::_()->getItem('forum_category', $category_id);
      $category->delete();
      $db->commit();
    }
    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
    return $this->_forward('success', 'utility', 'core', array(
            'messages' => array(Zend_Registry::get('Zend_Translate')->_('Category deleted.')),
            'layout' => 'default-simple',
            'parentRefresh' => true
    ));
  }

  public function deleteForumAction()
  {
    $form = $this->view->form = new Forum_Form_Admin_DeleteForum();
    if (!$this->getRequest()->isPost())
    {
      return;
    }

    $table = Engine_Api::_()->getItemTable('forum_forum');
    $db = $table->getAdapter();
    $db->beginTransaction();
    $forum_id = $this->getRequest()->getParam('forum_id');
    try
    {
      $forum = Engine_Api::_()->getItem('forum_forum', $forum_id);
      $forum->delete();
      $db->commit();
    }
    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
    return $this->_forward('success', 'utility', 'core', array(
            'messages' => array(Zend_Registry::get('Zend_Translate')->_('Forum deleted.')),
            'layout' => 'default-simple',
            'parentRefresh' => true
    ));
  }
}