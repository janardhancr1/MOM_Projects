<?php

class Core_AdminTasksController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {
    $tasksTable = Engine_Api::_()->getDbtable('tasks', 'core');
    $this->view->tasks = $tasks = Zend_Paginator::factory($tasksTable->select());
  }

  public function settingsAction()
  {
    $this->view->form = $form = new Core_Form_Admin_Settings_Tasks();

    if( !$this->getRequest()->isPost() ) {
      $form->populate(Engine_Api::_()->getApi('settings', 'core')->core_tasks);
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) ) {
      return;
    }

    $values = $form->getValues();
    Engine_Api::_()->getApi('settings', 'core')->core_tasks = $values;
  }

  public function runAction()
  {
    $task_id = $this->_getParam('task_id');
    $tasksTable = Engine_Api::_()->getDbtable('tasks', 'core');
    $task = $tasksTable->find($task_id)->current();

    if( $task && $this->getRequest()->isPost() ) {
      $tasksTable->executeTask($task);
    }
    
    die();
  }
}