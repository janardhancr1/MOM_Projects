<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: EventController.php 6512 2010-06-23 00:27:01Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Event_EventController extends Core_Controller_Action_Standard
{
  public function init()
  {
    $id = $this->_getParam('event_id', $this->_getParam('id', null));
    if( $id )
    {
      $event = Engine_Api::_()->getItem('event', $id);
      if( $event )
      {
        Engine_Api::_()->core()->setSubject($event);
      }
    }
    $this->getRightSideContent();
  }
  
  public function editAction()
  {

    $event_id = $this->getRequest()->getParam('event_id');
    $event = Engine_Api::_()->getItem('event', $event_id);
    $viewer = Engine_Api::_()->user()->getViewer();
    if( !($this->_helper->requireAuth()->setAuthParams(null, null, 'edit')->isValid() || $event->isOwner($viewer))) return;
    // Create form
    $event = Engine_Api::_()->core()->getSubject();
    $this->view->form = $form = new Event_Form_Edit(array('parent_type'=>$event->parent_type, 'parent_id'=>$event->parent_id));

    // Populate form options
    $categoryTable = Engine_Api::_()->getDbtable('categories', 'event');
    foreach( $categoryTable->fetchAll() as $category ) {
      $form->category_id->addMultiOption($category->category_id, $category->title);
    }

    if( !$this->getRequest()->isPost() )
    {
      // Populate auth
      $auth = Engine_Api::_()->authorization()->context;
      if ($event->parent_type == 'user') 
      {
        $roles = array('owner', 'member', 'parent_member', 'owner_network', 'owner_member', 'owner_member_member', 'registered', 'everyone');
      }
      else if (($event->parent_type == 'group') && (Engine_Api::_()->hasItemType('group')))
      {
        $roles = array('owner', 'parent_member', 'registered', 'everyone');
      }
      foreach ($roles as $role)
      {
	if ($auth->isAllowed($event, $role, 'view')) 
        {
          $form->auth_view->setValue($role);
	}
	if ($auth->isAllowed($event, $role, 'comment')) 
        {
          $form->auth_comment->setValue($role);
	}
	if ($auth->isAllowed($event, $role, 'photo')) 
        {
          $form->auth_photo->setValue($role);
	}
      }
      $form->auth_invite->setValue($auth->isAllowed($event, 'member', 'invite'));
      $form->populate($event->toArray());
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $db = Engine_Api::_()->getItemTable('event')->getAdapter();
    $db->beginTransaction();

    try
    {
      $values = $form->getValues();
      if (($event->parent_type == 'group') && (Engine_Api::_()->hasItemType('group')))
     {
       $group = Engine_Api::_()->getItem('group', $event->parent_id);
       $values['host']  = $group->getTitle();
     }
      // Set event info
      $event->setFromArray($values);
      $event->save();

      if( !empty($values['photo']) ) {
        $event->setPhoto($form->photo);
      }


      // Process privacy
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'member', 'parent_member', 'owner_network', 'owner_member', 'owner_member_member', 'registered', 'everyone');


      foreach( $roles as $i => $role )
      {
        $auth->setAllowed($event, $role, 'photo', 0);
        $auth->setAllowed($event, $role, 'view', 0);
        $auth->setAllowed($event, $role, 'comment', 0);
      }

      $auth->setAllowed($event, $values['auth_view'], 'view', 1 );
      $auth->setAllowed($event, $values['auth_comment'], 'comment', 1 );
      $auth->setAllowed($event, $values['auth_photo'], 'photo', 1 );
      $auth->setAllowed($event, 'member', 'invite', $values['auth_invite'] );
      $permissions = array('auth_view'=>'view', 'auth_comment'=>'comment', 'auth_photo'=>'photo');
      foreach ($permissions as $permission_field => $permission_name)
      {
        if ($values[$permission_field] == 'owner_member_network')
        {
          $auth->setAllowed($event, 'owner_member', $permission_name, 1);
	}
      }      
      $auth->setAllowed($event, 'member', 'invite', $values['auth_invite']);


      // Commit
      $db->commit();

      // Redirect
      if( $this->_getParam('ref') === 'profile' ) {
        $this->_redirectCustom($event);
      } else {
        $this->_redirectCustom(array('route' => 'event_general', 'action' => 'manage'));
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


  public function inviteAction()
  {

    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject('event')->isValid() ) return;
    // @todo auth

    // Prepare data
    $viewer = Engine_Api::_()->user()->getViewer();
    $this->view->event = $event = Engine_Api::_()->core()->getSubject();
    $this->view->friends = $friends = $viewer->membership()->getMembers();

    // Prepare form
    $this->view->form = $form = new Event_Form_Invite();

    $count = 0;
    foreach( $friends as $friend )
    {
      if( $event->membership()->isMember($friend, null) ) continue;
      $form->users->addMultiOption($friend->getIdentity(), $friend->getTitle());
      $count++;
    }
    $this->view->count = $count;
    // Not posting
    if( !$this->getRequest()->isPost() )
    {
      return;
    }
    if( !$form->isValid($this->getRequest()->getPost()) )
      {
      return;
    }

   // Process
    $table = $event->getTable();
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $usersIds = $form->getValue('users');
      
      $notifyApi = Engine_Api::_()->getDbtable('notifications', 'activity');
      foreach( $friends as $friend )
      {
        if( !in_array($friend->getIdentity(), $usersIds) )
        {
          continue;
        }

        $event->membership()->addMember($friend)
          ->setResourceApproved($friend);

        $notifyApi->addNotification($friend, $viewer, $event, 'event_invite');
      }


      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
    
    return $this->_forward('success', 'utility', 'core', array(
      'messages' => array(Zend_Registry::get('Zend_Translate')->_('Members invited')),
      'layout' => 'default-simple',
      'parentRefresh' => true,
    ));
  }

 public function styleAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams(null, null, 'edit')->isValid() ) return;
    
    $user = Engine_Api::_()->user()->getViewer();
    $event = Engine_Api::_()->core()->getSubject('event');

    // Make form
    $this->view->form = $form = new Event_Form_Style();

    // Get current row
    $table = Engine_Api::_()->getDbtable('styles', 'core');
    $select = $table->select()
      ->where('type = ?', 'event')
      ->where('id = ?', $event->getIdentity())
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
      $row->type = 'event';
      $row->id = $event->getIdentity();
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


  public function deleteAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams(null, null, 'edit')->isValid() ) return;

    // Make form
    $this->view->form = $form = new Event_Form_Delete();

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
    
    $this->_redirectCustom(array('route' => 'event_general', 'action' => 'manage'));
  }








}