<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: EventController.php 6516 2010-06-23 01:15:53Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Group_EventController extends Core_Controller_Action_Standard
{
  public function init()
  {
    if( !Engine_Api::_()->core()->hasSubject() )
    {
      if( 0 !== ($event_id = (int) $this->_getParam('event_id')) &&
          null !== ($event = Engine_Api::_()->getItem('group_event', $event_id)) )
      {
        Engine_Api::_()->core()->setSubject($event);
      }

      else if( 0 !== ($group_id = (int) $this->_getParam('group_id')) &&
          null !== ($group = Engine_Api::_()->getItem('group', $group_id)) )
      {
        Engine_Api::_()->core()->setSubject($group);
      }
    }
    
    $this->_helper->requireUser->addActionRequires(array(
      'add',
      'add-event', // Not sure if this is the right
      'edit',
    ));

    $this->_helper->requireSubject->setActionRequireTypes(array(
      'list' => 'group',
      'upload' => 'group',
      'view' => 'group_event',
      'edit' => 'group_event',
    ));
  }

  public function listAction()
  {
    die("QQQQQQ");
  }
  
  public function viewAction()
  {
    die("NNNNNNNN");
  }

  public function addAction()
  {
    $this->view->form = $form = new Group_Form_Event_Add();
    // Populate form options
    $categoryTable = Engine_Api::_()->getDbtable('categories', 'event');
    foreach( $categoryTable->fetchAll() as $category ) {
      $form->category_id->addMultiOption($category->category_id, $category->title);
    }

  if( !$this->getRequest()->isPost() )      
    {
      return;
    }
    
    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $values = $form->getValues();
    $viewer = $this->_helper->api()->user()->getViewer();
    $values['user_id'] = $viewer->getIdentity();
    $values['parent_type'] = 'group';
    $values['parent_id'] = Engine_Api::_()->core()->getSubject()->getIdentity();
    $db = Engine_Api::_()->getDbtable('events', 'event')->getAdapter();
    $db->beginTransaction();

    try
    {
      // Create event
      $table = $this->_helper->api()->getDbtable('events', 'event');
      $event = $table->createRow();

      $event->setFromArray($values);
      $event->save();

      // Add owner as member
      $event->membership()->addMember($viewer)
        ->setUserApproved($viewer)
        ->setResourceApproved($viewer);

      $event->membership()->getMemberInfo($viewer)->setFromArray(array('rsvp' => 2))->save();

      // Add photo
      if( !empty($values['photo']) ) {
        $event->setPhoto($form->photo);
      }
      
      // Process privacy
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'member', 'registered', 'everyone');

      $viewMax = array_search($values['auth_view'], $roles);
      foreach( $roles as $i => $role )
      {
        $auth->setAllowed($event, $role, 'view', ($i <= $viewMax) );
      }
      
      $commentMax = array_search($values['auth_comment'], $roles);
      foreach( $roles as $i => $role )
      {
        $auth->setAllowed($event, $role, 'comment', ($i <= $commentMax) );
      }
      
      $photoMax = array_search($values['auth_photo'], $roles);
      foreach( $roles as $i => $role )
      {
        $auth->setAllowed($event, $role, 'photo', ($i <= $photoMax) );
      }
      
      $inviteMax = array_search($values['auth_invite'], $roles);
      $auth->setAllowed($event, 'member', 'invite', $values['auth_invite'] );
      
      // Add action
      $activityApi = Engine_Api::_()->getDbtable('actions', 'activity');

      $action = $activityApi->addActivity($viewer, $event, 'event_create');
      $activityApi->attachActivity($action, $event);

      // Commit
      $db->commit();

      // Redirect
      return $this->_helper->redirector->gotoRoute(array('id' => $event->getIdentity()), 'event_profile', true);
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

  public function editAction()
  {
    die("NLLLN");
  }
}