<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: CategoryController.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_CategoryController extends Core_Controller_Action_Standard
{
  public function init()
  {
    if( 0 !== ($category_id = (int) $this->_getParam('category_id')) &&
        null !== ($category = Engine_Api::_()->getItem('forum_category', $category_id)) )
    {
      Engine_Api::_()->core()->setSubject($category);
    }
  }

  public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    //if( !$this->_helper->requireSubject('forum_category')->isValid() ) return;

    $viewer = Engine_Api::_()->user()->getViewer();

    $this->view->form = $form = new Forum_Form_Category_Create();

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $table = Engine_Api::_()->getItemTable('forum_category');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $values = $form->getValues();
      $values['user_id'] = $viewer->getIdentity();

      $category = $table->createRow();
      $category->setFromArray($values);
      $category->save();

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

  }

  public function editAction()
  {

  }

  public function viewAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject('forum_category')->isValid() ) return;

    $this->view->category = $category = Engine_Api::_()->core()->getSubject();

    $table = Engine_Api::_()->getItemTable('forum');
    $select = $table->select()
      ->where('category_id = ?', $category->getIdentity())
      ;
    
    $this->view->forums = $forums = $table->fetchAll($select);
  }
}