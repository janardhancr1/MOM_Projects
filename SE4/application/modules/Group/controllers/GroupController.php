<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: GroupController.php 6516 2010-06-23 01:15:53Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Group_GroupController extends Core_Controller_Action_Standard
{
  public function init()
  {
    if( 0 !== ($group_id = (int) $this->_getParam('group_id')) &&
        null !== ($group = Engine_Api::_()->getItem('group', $group_id)) )
    {
      Engine_Api::_()->core()->setSubject($group);
    }

    $this->_helper->requireUser();
    $this->_helper->requireSubject('group');
    /*
    $this->_helper->requireAuth()->setAuthParams(
      null,
      null,
      null
      //'edit'
    );
     * 
     */
  }
  
  public function editAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams(null, null, 'edit')->isValid() ) return;

    $group = Engine_Api::_()->core()->getSubject();
    $this->view->form = $form = new Group_Form_Edit();

    // Populate with categories
    foreach( Engine_Api::_()->getDbtable('categories', 'group')->fetchAll() as $row )
    {
      $form->category_id->addMultiOption($row->category_id, $row->title);
    }

    if( count($form->category_id->getMultiOptions()) <= 1 )
    {
      $form->removeElement('category_id');
    }
    if( !$this->getRequest()->isPost() )
    {
      // Populate auth
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'officer', 'member', 'registered', 'everyone');
      foreach( $roles as $roleString )
      {
        $role = $roleString;

        if( $role === 'officer' ) $role = $group->getOfficerList();
        if( (1 === $auth->isAllowed($group, $role, 'view')) && !empty($form->auth_view))
        {
          $form->auth_view->setValue($roleString);
        }
        if( 1 === $auth->isAllowed($group, $role, 'comment')  && !empty($form->auth_comment))
        {
          $form->auth_comment->setValue($roleString);
        }
        if( 1 === $auth->isAllowed($group, $role, 'invite')  && !empty($form->auth_invite))
        {
          $form->auth_invite->setValue($roleString);
        }
        if( 1 === $auth->isAllowed($group, $role, 'photo')  && !empty($form->auth_photo))
        {
          $form->auth_photo->setValue($roleString);
        }
      }

      $form->populate($group->toArray());
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $db = Engine_Api::_()->getItemTable('group')->getAdapter();
    $db->beginTransaction();

    try
    {
      $values = $form->getValues();

      // Set group info
      $group->setFromArray($values);
      $group->save();

      if( !empty($values['photo']) ) {
        $group->setPhoto($form->photo);
      }

      // Process privacy
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'officer', 'member', 'registered', 'everyone');

      $viewMax = array_search($values['auth_view'], $roles);
      foreach( $roles as $i => $role )
      {
        if( $role === 'officer' ) $role = $group->getOfficerList();
        $auth->setAllowed($group, $role, 'view', ($i <= $viewMax) );
      }

      $commentMax = array_search($values['auth_comment'], $roles);
      foreach( $roles as $i => $role )
      {
        if( $role === 'officer' ) $role = $group->getOfficerList();
        $auth->setAllowed($group, $role, 'comment', ($i <= $commentMax) );
      }

      $inviteMax = array_search($values['auth_invite'], $roles);
      foreach( $roles as $i => $role )
      {
        if( $role === 'officer' ) $role = $group->getOfficerList();
        $auth->setAllowed($group, $role, 'invite', ($i <= $inviteMax) );
      }

      $photoMax = array_search($values['auth_photo'], $roles);
      foreach( $roles as $i => $role )
      {
        if( $role === 'officer' ) $role = $group->getOfficerList();
        $auth->setAllowed($group, $role, 'photo', ($i <= $photoMax) );
      }

      // Commit
      $db->commit();

      // Rollback
      if( $this->_getParam('ref') === 'profile' ) {
        $this->_redirectCustom($group);
      } else {
        $this->_redirectCustom(array('route' => 'group_general', 'action' => 'manage'));
      }
    }
    
    catch( Engine_Image_Exception $e )
    {
      $db->rollBack();
      $form->addError(Zend_Registry::get('Zend_Translate')->_('The image you selected was too large.'));
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }

  public function deleteAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams(null, null, 'delete')->isValid() ) return;

    // Make form
    $this->view->form = $form = new Group_Form_Delete();

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process form
    $subject = $this->_helper->api()->core()->getSubject();
    $db = $subject->getTable()->getAdapter();
    $db->beginTransaction();

    try
    {
      $subject->delete();
      
      $db->commit();
    }
    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
    
    $this->_redirectCustom(array('route' => 'group_general', 'action' => 'manage'));
  }

  public function styleAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams(null, null, 'edit')->isValid() ) return;
    
    $user = Engine_Api::_()->user()->getViewer();
    $group = Engine_Api::_()->core()->getSubject('group');

    // Make form
    $this->view->form = $form = new Group_Form_Style();

    // Get current row
    $table = Engine_Api::_()->getDbtable('styles', 'core');
    $select = $table->select()
      ->where('type = ?', 'group')
      ->where('id = ?', $group->getIdentity())
      ->limit(1);

    $row = $table->fetchRow($select);

    // Check post
    if( !$this->getRequest()->isPost() )
    {
      $form->populate(array(
        'style' => ( null === $row ? '' : $row->style )
      ));
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Cool! Process
    $style = $form->getValue('style');

    // Save
    if( null == $row )
    {
      $row = $table->createRow();
      $row->type = 'group';
      $row->id = $group->getIdentity();
    }

    $row->style = $style;
    $row->save();

    $this->view->draft = true;
    $this->view->message = Zend_Registry::get('Zend_Translate')->_('Your changes have been saved.');
    $this->_forward('success', 'utility', 'core', array(
        'smoothboxClose' => true,
        'parentRefresh' => false,
        'messages' => array(Zend_Registry::get('Zend_Translate')->_('Your changes have been saved.'))
    ));
  }
}