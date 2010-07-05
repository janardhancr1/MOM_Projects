<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminManageController.php 6679 2010-07-01 22:15:15Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_AdminManageController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {
    $this->view->formFilter = $formFilter = new User_Form_Admin_Manage_Filter();
    $page = $this->_getParam('page',1);

    $table = $this->_helper->api()->getDbtable('users', 'user');
    $select = $table->select();

    // Process form
    $values = array();
    if( $formFilter->isValid($this->_getAllParams()) ) {
      $values = $formFilter->getValues();
    }

    foreach( $values as $key => $value ) {
      if( null === $value ) {
        unset($values[$key]);
      }
    }

    $values = array_merge(array(
      'order' => 'user_id',
      'order_direction' => 'DESC',
    ), $values);
    
    $this->view->assign($values);

    // Set up select info
    $select->order(( !empty($values['order']) ? $values['order'] : 'user_id' ) . ' ' . ( !empty($values['order_direction']) ? $values['order_direction'] : 'DESC' ));

    if( !empty($values['username']) )
    {
      $select->where('username LIKE ?', '%' . $values['username'] . '%');
    }

    if( !empty($values['email']) )
    {
      $select->where('email LIKE ?', '%' . $values['email'] . '%');
    }

    if( !empty($values['level_id']) )
    {
      $select->where('level_id = ?', $values['level_id'] );
    }
    
    if( isset($values['enabled']) && $values['enabled'] != -1 )
    {
      $select->where('enabled = ?', $values['enabled'] );
    }
    
    // Make paginator
    $this->view->paginator = $paginator = Zend_Paginator::factory($select);
    $this->view->paginator = $paginator->setCurrentPageNumber( $page );


    $this->view->superAdminCount = count(Engine_Api::_()->user()->getSuperAdmins());
    $this->view->hideEmails = _ENGINE_ADMIN_NEUTER;
    //$this->view->formDelete = new User_Form_Admin_Manage_Delete();
  }

  public function multiModifyAction()
  {
    if ($this->getRequest()->isPost()) 
    {
      $values = $this->getRequest()->getPost();
      foreach ($values as $key=>$value) {
        if ($key == 'modify_' . $value)
        {
          $user = Engine_Api::_()->getItem('user', (int) $value);
          if ($values['submit_button'] == 'delete')
    {
            if ($user->level_id != 1) 
            {
              $user->delete();
            }
          }
          else if ($values['submit_button'] == 'approve')
          {
            $user->enabled = 1;
            $user->save();           
    }
        }
      }
    }
    return $this->_helper->redirector->gotoRoute(array('action' => 'index'));

    $this->_forward('index', 'admin-manage', 'user');
  }

  public function editAction()
  {
    //"route":"admin_default","module":"authorization","controller":"level","action":"edit"
    //return $this->_helper->redirector->gotoRoute(array('route'=>'admin_default','module'=>'authorization','controller'=>'level', 'action' => 'edit'));

    $id = $this->_getParam('id', null);
    $this->view->user = $user = $this->_helper->api()->user()->getUser($id);
    $this->view->form = $form = new User_Form_Admin_Manage_Edit();

    if ($user->level_id == 1 && count(Engine_Api::_()->user()->getSuperAdmins()) == 1){
      $form->removeElement('level_id');
    }

    // Posting form
    if( $this->getRequest()->isPost() )
    {
      if( $form->isValid($this->getRequest()->getPost()) )
      {
        $user->setFromArray($form->getValues());
        $user->save();
      }
      
      $this->_forward('success', 'utility', 'core', array(
      'smoothboxClose' => true,
      'parentRefresh' => true,
      'format'=> 'smoothbox',
      'messages' => array('Member Edited.')
      ));
    }

    // Initialize data
    else
    {
      foreach( $form->getElements() as $name => $element )
      {
        if( _ENGINE_ADMIN_NEUTER && $name == 'email' ) continue;
        if( isset($user->$name) )
        {
          $element->setValue($user->$name);
        }
      }
    }
  }

  public function deleteAction()
  {
    $id = $this->_getParam('id', null);
    $this->view->user = $user = $this->_helper->api()->user()->getUser($id);
    $this->view->form = $form = new User_Form_Admin_Manage_Delete();
    // deleting user
    //$form->user_id->setValue($id);

    if ($this->getRequest()->isPost()) 
    {
      $user = Engine_Api::_()->getItem('user', $id);
      $user->delete();

      $this->_forward('success', 'utility', 'core', array(
      'smoothboxClose' => true,
      'parentRefresh' => true,
      'format'=> 'smoothbox',
      'messages' => array('Member deleted.')
      ));
    }
  }
}