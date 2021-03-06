<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 6476 2010-06-20 08:38:18Z john $
 * @author     Sami
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     Sami
 */
class Event_IndexController extends Core_Controller_Action_Standard
{

  protected $_navigation;


  public function init() 
  {
	if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireAuth()->setAuthParams('event', null, 'view')->isValid() ) return;

    $this->getNavigation();
    
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

  public function browseAction()
  {
    $filter = $this->_getParam('filter', 'future');
    if( $filter != 'past' && $filter != 'future' ) $filter = 'future';
    $this->view->filter = $filter;

    $navigation = $this->getNavigation();
    foreach ($navigation->getPages() as $page)
    {
      if( ($page->label == "Upcoming Events" && $filter == "future") || ($page->route == "event_past" && $filter == "past")) {
	$page->active = true;
      }
    }
    // Create form
    $this->view->formFilter = $formFilter = new Event_Form_Filter_Browse();
    $defaultValues = $formFilter->getValues();

    $viewer = Engine_Api::_()->user()->getViewer();
    if( !$viewer || !$viewer->getIdentity() ) {
      $formFilter->removeElement('view');
    }

    // Populate form options
    $categoryTable = Engine_Api::_()->getDbtable('categories', 'event');
    foreach( $categoryTable->fetchAll() as $category ) {
      $formFilter->category_id->addMultiOption($category->category_id, $category->title);
    }

    // Populate form data
    if( $formFilter->isValid($this->_getAllParams()) ) {
      $this->view->formValues = $values = $formFilter->getValues();
    } else {
      $formFilter->populate($defaultValues);
      $this->view->formValues = $values = array();
    }
    // Prepare data
    $table = Engine_Api::_()->getItemTable('event');
    $select = $table->select()->where("search = 1");

    // Do friends only
    if( $viewer->getIdentity() && @$values['view'] == 'friends' ) {
      $user_list = array();
      foreach( $viewer->membership()->getMembersInfo(true) as $memberinfo )
      {
        $user_list[] = $memberinfo->user_id;
      }
      $select->where('user_id IN(\''.join("', '", $user_list).'\')');
    }
    
    // Do query stuff
    if( !empty($values['category_id']) ) {
      $select->where('category_id = ?', $values['category_id']);
    }

    if( !empty($values['order']) ) {
      $select->order($values['order']);
    } else {
      $select->order('starttime ASC');
    }

    if( $filter == "past" )
    {
      $select->where("endtime < FROM_UNIXTIME(?)", time());
    }
    //if ($filter == "future")
    else
    {
      $select->where("endtime > FROM_UNIXTIME(?)", time());
    }
    
    // check to see if request is for specific user's listings
    $user_id = $this->_getParam('user');
    if ($user_id) $params = array('user' => $user_id);

    // Other stuff
    $this->view->page = $page = $this->_getParam('page', 1);

    $paginator = $this->view->paginator = Zend_Paginator::factory($select);
    $paginator->setItemCountPerPage(20);
    $paginator->setCurrentPageNumber($page);
  }

  public function manageAction()
  {
    // Create form
    if( !$this->_helper->requireAuth()->setAuthParams(null, null, 'edit')->isValid() ) return;

    $this->view->formFilter = $formFilter = new Event_Form_Filter_Manage();
    $defaultValues = $formFilter->getValues();

    // Populate form data
    if( $formFilter->isValid($this->_getAllParams()) ) {
      $this->view->formValues = $values = $formFilter->getValues();
    } else {
      $formFilter->populate($defaultValues);
      $this->view->formValues = $values = array();
    }

    $viewer = $this->_helper->api()->user()->getViewer();
    $table = $this->_helper->api()->getDbtable('events', 'event');
    $tableName = $table->info('name');
    
    // Only mine
    if( @$values['view'] == 2 ) {
      $select = $table->select()
        ->where('user_id = ?', $viewer->getIdentity());
    }
    // All membership
    else {
      $membership = Engine_Api::_()->getDbtable('membership', 'event');
      $select = $membership->getMembershipsOfSelect($viewer);
    }

    if( !empty($values['text']) ) {
      $select->where("`{$tableName}`.title LIKE ?", '%'.$values['text'].'%');
    }

    $this->view->paginator = $paginator = Zend_Paginator::factory($select);
    $this->view->text = $values['text'];
    $this->view->view = $values['view'];
    $paginator->setItemCountPerPage(20);
    $paginator->setCurrentPageNumber($this->_getParam('page'));
  }

  public function createAction()
  {
    if( !$this->_helper->requireUser->isValid() ) return;
    if( !$this->_helper->requireAuth()->setAuthParams('event', null, 'create')->isValid() ) return;

    $parent_type = $this->getRequest()->getParam('parent_type', 'user');
    $subject_id = $this->getRequest()->getParam('subject_id', Engine_Api::_()->user()->getViewer()->getIdentity());

    if (($parent_type == 'group' ) && (Engine_Api::_()->hasItemType('group')))
    {
      $group = Engine_Api::_()->getItem('group', $subject_id);
      if (!$this->_helper->requireAuth()->setAuthParams($group, null, 'edit')->isValid()) return;
    }
    // Create form

    $this->view->form = $form = new Event_Form_Create(array('parent_type'=>$parent_type, 'parent_id'=>$subject_id));

    // Populate form options
    $categoryTable = Engine_Api::_()->getDbtable('categories', 'event');
    foreach( $categoryTable->fetchAll() as $category ) {
      $form->category_id->addMultiOption($category->category_id, $category->title);
    }

    // Not post/invalid
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
    $values['parent_type'] = $this->getRequest()->getParam('parent_type', 'user');
    $values['parent_id'] =  $this->getRequest()->getParam('subject_id', $viewer->getIdentity());
    $db = Engine_Api::_()->getDbtable('events', 'event')->getAdapter();
    $db->beginTransaction();

    if (($values['parent_type'] == 'group' ) && (Engine_Api::_()->hasItemType('group')))
    {
      $values['host']  = $group->getTitle();
    }

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
    if( !$this->_helper->requireUser->isValid() ) return;  

    // Create form
    if( !($this->_helper->requireAuth()->setAuthParams(null, null, 'edit')->isValid() || $event->isOwner($viewer))) return;


    $this->view->form = $form = new Event_Form_Create(Array('event_id'=>$event_id));

    $form->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action'=>'edit'), 'event_general'));
    if ($this->getRequest()->isPost())
      {
	$form->isValid($this->getRequest()->getParams());
	$values = $form->getValues();
	$event->setFromArray($values);
	$event->save();
	if( !empty($values['photo']) ) {
          $event->setPhoto($form->photo);
	}
	return $this->_helper->redirector->gotoRoute(array('id' => $event_id), 'event_profile', true);

      }
    
  }
  public function viewAction()
  {
    $this->view->event = $event = Engine_Api::_()->core()->getSubject();
    if( !$this->_helper->requireAuth()->setAuthParams($event, null, 'view')->isValid() ) return;


    $event_id = $this->view->event_id = $this->getRequest()->getParam('id');
  }

  public function leaveAction()
  {
    // Check auth
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject()->isValid() ) return;

    // Make form
    $this->view->form = $form = new Event_Form_Leave();

    // Process form
    if( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) )
    {
      $viewer = $this->_helper->api()->user()->getViewer();
      $subject = $this->_helper->api()->core()->getSubject();
      $db = $subject->membership()->getReceiver()->getTable()->getAdapter();
      $db->beginTransaction();

      try
      {
        $subject->membership()->removeMember($viewer);
        $db->commit();
      }
      catch( Exception $e )
      {
        $db->rollBack();
        throw $e;
      }

      return $this->_forward('success', 'utility', 'core', array(
        'messages' => array(Zend_Registry::get('Zend_Translate')->_('Event left')),
        'layout' => 'default-simple',
        'parentRefresh' => true,
      ));
    }
  }

  public function getNavigation($filter = false)
  {
    $this->view->navigation = $navigation = new Zend_Navigation();
    $navigation->addPages(array(
      array(
        'label' => "Upcoming Events",
        'route' => 'event_general',
      ),
      array(
        'label' => "Past Events",
        'route' => 'event_past'
	    )));
  

    $viewer = Engine_Api::_()->user()->getViewer();
    if ($viewer->getIdentity()) {
      $navigation->addPages(array(
        array(
          'label' => 'My Events',
          'route'=> 'event_general',
          'action' => 'manage',
          'controller' => 'index',
          'module' => 'event'
        ),
	array(
          'label' => 'Create New Event',
          'route'=>'event_general',
          'action' => 'create',
          'controller' => 'index',
          'module' => 'event'
	      )));
    }
    return $navigation;     
  }


}