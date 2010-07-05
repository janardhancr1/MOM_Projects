<?php

/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminSettingsController.php 6657 2010-07-01 01:38:38Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Event_AdminSettingsController extends Core_Controller_Action_Admin {

  public function indexAction() {
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
                    ->getNavigation('event_admin_main', array(), 'event_admin_main_settings');

    $this->view->form = $form = new Event_Form_Admin_Global();

    if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
      $values = $form->getValues();

      foreach ($values as $key => $value) {
        Engine_Api::_()->getApi('settings', 'core')->setSetting($key, $value);
      }
    }
  }

  public function categoriesAction() {
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
                    ->getNavigation('event_admin_main', array(), 'event_admin_main_categories');

    $this->view->categories = Engine_Api::_()->event()->getCategories();
  }

  public function levelAction() {
    // Get level id
    //$level_id = $this->_getParam('level_id', null);
    // Make navigation
    $level_id = $this->_getParam('id', 1);

    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
                    ->getNavigation('event_admin_main', array(), 'event_admin_main_level');

    // Make form
    $this->view->form = $form = new Event_Form_Admin_Level(array('public' => $level_id == 5));

    $form->level_id->setValue($level_id);
    $permissionsTable = Engine_Api::_()->getDbtable('permissions', 'authorization');

    if (!$this->getRequest()->isPost()) {
      if (null !== $level_id) {
        //var_dump($permissionsTable->getAllowed('event', $level_id, array_keys($form->getValues())));die();
        $form->populate($permissionsTable->getAllowed('event', $level_id, array_keys($form->getValues())));
        return;

        //die($settings);
      }

      return;
    }

    // Check validitiy
    if (!$form->isValid($this->getRequest()->getPost())) {
      return;
    }

    // Process

    $values = $form->getValues();

    $db = $permissionsTable->getAdapter();
    $db->beginTransaction();

    try {
      if ($level_id != 5) {
        // Set permissions
        $values['auth_comment'] = (array) $values['auth_comment'];
        $values['auth_photo'] = (array) $values['auth_photo'];
        $values['auth_view'] = (array) $values['auth_view'];
      }
      $permissionsTable->setAllowed('group', $level_id, $values);

      // Commit
      $db->commit();
    } catch (Exception $e) {
      $db->rollBack();
      throw $e;
    }
  }

  public function addCategoryAction() {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');

    // Generate and assign form
    $form = $this->view->form = new Event_Form_Admin_Category();
    $form->setAction($this->getFrontController()->getRouter()->assemble(array()));
    // Check post
    if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
      // we will add the category
      $values = $form->getValues();

      $db = Engine_Db_Table::getDefaultAdapter();
      $db->beginTransaction();

      try {
        // add category to the database
        // Transaction
        $table = Engine_Api::_()->getDbtable('categories', 'event');

        // insert the category into the database
        $row = $table->createRow();
        $row->title = $values["label"];
        $row->save();

        $db->commit();
      } catch (Exception $e) {
        $db->rollBack();
        throw $e;
      }
      $this->_forward('success', 'utility', 'core', array(
          'smoothboxClose' => 10,
          'parentRefresh' => 10,
          'messages' => array('')
      ));
    }

    // Output
    $this->renderScript('admin-settings/form.tpl');
  }

  public function deleteCategoryAction() {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');
    $id = $this->_getParam('id');
    $this->view->event_id = $id;
    // Check post
    if ($this->getRequest()->isPost()) {
      $db = Engine_Db_Table::getDefaultAdapter();
      $db->beginTransaction();

      try {
        // go through logs and see which events used this category id and set it to ZERO
        $eventTable = $this->_helper->api()->getDbtable('events', 'event');
        $select = $eventTable->select()->where('category_id = ?', $id);
        $events = $eventTable->fetchAll($select);

        // create permissions
        foreach ($events as $event) {
          //this is not working
          $event->category_id = 0;
          $event->save();
        }
        $row = Engine_Api::_()->event()->getCategory($id);
        // delete the event category into the database
        $row->delete();

        $db->commit();
      } catch (Exception $e) {
        $db->rollBack();
        throw $e;
      }
      $this->_forward('success', 'utility', 'core', array(
          'smoothboxClose' => 10,
          'parentRefresh' => 10,
          'messages' => array('')
      ));
    }

    // Output
    $this->renderScript('admin-settings/delete.tpl');
  }

  public function editCategoryAction() {
    // In smoothbox
    $this->_helper->layout->setLayout('admin-simple');
    $form = $this->view->form = new Event_Form_Admin_Category();
    $form->setAction($this->getFrontController()->getRouter()->assemble(array()));

    // Check post
    if ($this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost())) {
      // Ok, we're good to add field
      $values = $form->getValues();

      $db = Engine_Db_Table::getDefaultAdapter();
      $db->beginTransaction();

      try {
        // edit category in the database
        // Transaction
        $row = Engine_Api::_()->event()->getCategory($values["id"]);

        $row->title = $values["label"];
        $row->save();
        $db->commit();
      } catch (Exception $e) {
        $db->rollBack();
        throw $e;
      }
      $this->_forward('success', 'utility', 'core', array(
          'smoothboxClose' => 10,
          'parentRefresh' => 10,
          'messages' => array('')
      ));
    }

    // Must have an id
    if (!($id = $this->_getParam('id'))) {
      die('No identifier specified');
    }

    // Generate and assign form
    $category = Engine_Api::_()->event()->getCategory($id);
    $form->setField($category);

    // Output
    $this->renderScript('admin-settings/form.tpl');
  }

}