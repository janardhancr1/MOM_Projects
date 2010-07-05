<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 6585 2010-06-25 02:17:06Z steve $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Poll_IndexController extends Core_Controller_Action_Standard
{
  public function init()
  {
    $this->view->viewer_id   = Engine_Api::_()->user()->getViewer()->getIdentity();
    $this->view->navigation  = $this->getNavigation();
    
    $ajaxContext = $this->_helper->getHelper('AjaxContext');
    $ajaxContext->addActionContext('delete', 'json');
  }

  public function searchAction()
  {
    // deal with searches in sessions
    $post      = new Zend_Controller_Request_Http();
    if (null === $post->getPost('poll_search'))
      $search  = $this->getSession()->search;
    else
      $search  = $this->getSession()->search = $post->getPost('poll_search');
    $this->view->search = $this->getSession()->search = $search;
    $this->browseAction();
    $this->render('browse');
  }
  public function browseAction()
  {
    $this->view->search_form = $search_form = new Poll_Form_Index_Search();
    if ($this->getRequest()->isPost() && $search_form->isValid($this->getRequest()->getPost())) {
      // redirect to GET route to prevent POST-back-button fo-paw
      $this->_helper->redirector->gotoRouteAndExit(array(
        'page' => 1,
        'sort'   => $this->getRequest()->getPost('browse_polls_by'),
        'search' => $this->getRequest()->getPost('poll_search'),
      ));
    } else {
      $search_form->getElement('poll_search')->setValue($this->_getParam('search'));
      $search_form->getElement('browse_polls_by')->setValue($this->_getParam('sort'));
    }

    $this->view->paginator  = Engine_Api::_()->poll()->getPollsPaginator(array(
      'user_id' => 0,
      'sort'    => $this->_getParam('sort'),
      'search'  => $this->_getParam('search'),
    ));
    $this->view->paginator->setItemCountPerPage( Engine_Api::_()->getApi('settings', 'core')->getSetting('poll.perPage', 10) );
    $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );

    $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('poll', null, 'create')->checkRequire();
  }
    public function viewAction()
  {
    $poll_id = $this->getRequest()->getParam('poll_id');
    $poll = $this->view->poll = Engine_Api::_()->getItem('poll', $poll_id);
    if (!empty($poll)) {
      Engine_Api::_()->core()->setSubject($poll);
    }
    if (!$this->_helper->requireSubject()->isValid())
      return;

    if( !$this->_helper->requireAuth()->setAuthParams($poll, null, 'view')->isValid()) return;
    // Don't render this if not authorized
    #if (!$this->_helper->requireAuth()->setAuthParams($poll, null, 'view')->isValid()) return;

    $this->view->owner         = $poll->getOwner();
    $this->view->pollOptions   = $poll->getOptions();
    $this->view->hasVoted      = $poll->viewerVoted();
    $this->view->votes = 0;
    if (!empty($this->view->pollOptions))
      foreach ($this->view->pollOptions as $i => $pollOption)
        $this->view->votes += $pollOption->votes;
    $this->view->poll->views++;
    $this->view->poll->save();
    $this->view->showPieChart  = Engine_Api::_()->getApi('settings', 'core')->getSetting('poll.showPieChart', false);
    $this->view->canChangeVote = Engine_Api::_()->getApi('settings', 'core')->getSetting('poll.canChangeVote', false);
  }
  public function voteAction()
  {
    // only members can vote
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->getRequest()->isPost() ) return;

    $poll_id       = $this->getRequest()->getParam('poll_id');
    $option_id     = $this->getRequest()->getParam('option_id');
    $canChangeVote = Engine_Api::_()->getApi('settings', 'core')->getSetting('poll.canChangeVote', false);

    $poll = Engine_Api::_()->getItem('poll', $this->_getParam('poll_id'));
    if (!$poll) {
      $this->view->success = false;
      $this->view->error   = Zend_Registry::get('Zend_Translate')->_('This poll does not seem to exist anymore.');
      return;
    }

    if ($poll->viewerVoted() && !$canChangeVote) {
      $this->view->success = false;
      $this->view->error   = Zend_Registry::get('Zend_Translate')->_('You have already voted on this poll, and are not permitted to change your vote.');
      return;
    }

    $db = Engine_Api::_()->getDbtable('polls', 'poll')->getAdapter();
    $db->beginTransaction();
    try {
      $poll->vote($this->_getParam('option_id'));
      $db->commit();
      $this->view->success   = true;
    } catch (Exception $e) {
      $db->rollback();
      $this->view->success   = false;
      throw $e;
    }
    $pollOptions = array();
    foreach ($poll->getOptions()->toArray() as $option) {
      $option['votesTranslated'] = $this->view->translate(array('%s vote', '%s votes', $option['votes']), $this->view->locale()->toNumber($option['votes']));
      $pollOptions[] = $option;
    }
    $this->view->pollOptions = $pollOptions;
    $this->view->votes_total = $poll->voteCount();

  }

  /* Owner */
  public function manageAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('poll', null, 'create')->checkRequire();

    $this->view->users     = array($this->view->viewer_id => Engine_Api::_()->user()->getViewer());
    $this->view->owner     = Engine_Api::_()->user()->getViewer();
    $this->view->user_id   = $this->view->viewer_id;

    $this->view->paginator = Engine_Api::_()->poll()->getPollsPaginator(array(
      'user_id' => $this->view->viewer_id
    ));
    $this->view->paginator->setItemCountPerPage( Engine_Api::_()->getApi('settings', 'core')->getSetting('poll.perpage', 10) );
    $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );

    $poll_ids  = array();
    foreach ($this->view->paginator as $poll) {
      $poll_ids[] = $poll->poll_id;
    }
    $this->view->pollVotes  = Engine_Api::_()->poll()->getPollVotes($poll_ids);
  }
  public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireAuth()->setAuthParams('poll', null, 'create')->isValid()) return;

    $this->view->maxOptions = Engine_Api::_()->getApi('settings', 'core')->getSetting('poll.maxoptions', 15);
    $this->view->form = new Poll_Form_Index_Create();
    if ( $this->getRequest()->isPost() && $this->view->form->isValid($this->getRequest()->getPost()) ) {
      $db = Engine_Api::_()->getDbTable('polls', 'poll')->getAdapter();
      $db->beginTransaction();
      try {
        $poll_id    = $this->view->form->save();
        if (empty($poll_id))
          return;
        $values = $this->view->form->getValues();

        $row        = Engine_Api::_()->getItem('poll', $poll_id);
        $attachment = Engine_Api::_()->getItem($row->getType(), $poll_id);

        // CREATE AUTH STUFF HERE
        $auth = Engine_Api::_()->authorization()->context;
        $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
        if($values['auth_view']) $auth_view =$values['auth_view'];
        else $auth_view = "everyone";
        $viewMax = array_search($auth_view, $roles);
        foreach( $roles as $i=>$role )
        {
          $auth->setAllowed($attachment, $role, 'view', ($i <= $viewMax));
        }

        $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
        if($values['auth_comment']) $auth_comment =$values['auth_comment'];
        else $auth_comment = "everyone";
        $commentMax = array_search($values['auth_comment'], $roles);

        foreach ($roles as $i=>$role)
        {
          $auth->setAllowed($attachment, $role, 'comment', ($i <= $commentMax));
        }


        $action     = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity(Engine_Api::_()->user()->getViewer(), $row, 'poll_new');
        if (null !== $action)
          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $attachment);

        $db->commit();
      } catch (Exception $e) {
        $db->rollback();
        throw $e;
      }

      if ($poll_id)
        $this->_redirect("polls/view/$poll_id");
    }
  }

  public function editAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $viewer = $this->_helper->api()->user()->getViewer();
    $poll = Engine_Api::_()->getItem('poll', $this->_getParam('poll_id'));
    if( !Engine_Api::_()->core()->hasSubject('poll') )
    {
      Engine_Api::_()->core()->setSubject($poll);
    }

    if( !$this->_helper->requireSubject()->isValid() ) return;
    //if( !$this->_helper->requireAuth()->setAuthParams($blog, $viewer, 'edit')->isValid() ) return;

    // Backup
    if( $viewer->getIdentity() != $poll->user_id && !$this->_helper->requireAuth()->setAuthParams($poll, null, 'edit')->isValid())
    {
      return $this->_forward('requireauth', 'error', 'core');
      //die('are you trying to edit someone elses blog?');
    }

    $navigation = $this->getNavigation(true);
    $this->view->navigation = $navigation;
    $this->view->form = $form = new Poll_Form_Index_Edit();
    $form->removeElement('title');
    $form->removeElement('description');
    $form->removeElement('options');

    // Populate form with current settings
    if( !$this->getRequest()->isPost() )
    {
      /*
      $user_level = $viewer->level_id;
      $allowed_view = Engine_Api::_()->authorization()->getPermission($user_level, 'poll', 'auth_view');
      $allowed_view = unserialize($allowed_view);
      $allowed_comment = Engine_Api::_()->authorization()->getPermission($user_level, 'poll', 'auth_comment');
      $allowed_comment = unserialize($allowed_comment);
      */
      $auth = Engine_Api::_()->authorization()->context;

      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      foreach( $roles as $role )
      {
        if( 1 === $auth->isAllowed($poll, $role, 'view'))
        {
          $form->auth_view->setValue($role);
        }
        if( 1 === $auth->isAllowed($poll, $role, 'comment'))
        {
          $form->auth_comment->setValue($role);
        }
      }
      
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }


    // Process

    $db = Engine_Db_Table::getDefaultAdapter();
    $db->beginTransaction();
    try
    {
      $values = $form->getValues();
      // CREATE AUTH STUFF HERE
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      if($values['auth_view']) $auth_view =$values['auth_view'];
      else $auth_view = "everyone";
      $viewMax = array_search($auth_view, $roles);
      foreach( $roles as $i=>$role )
      {
        $auth->setAllowed($poll, $role, 'view', ($i <= $viewMax));
      }
      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      if($values['auth_comment']) $auth_comment =$values['auth_comment'];
      else $auth_comment = "everyone";
      $commentMax = array_search($auth_comment, $roles);

      foreach ($roles as $i=>$role)
      {
        $auth->setAllowed($poll, $role, 'comment', ($i <= $commentMax));
      }

      // insert new activity if blog is just getting published
      $action = Engine_Api::_()->getDbtable('actions', 'activity')->getActionsByObject($poll);
      if (count($action->toArray())<=0 && $values['draft']=='0'){
        $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $poll, 'poll_new');
          // make sure action exists before attaching the blog to the activity
        if($action!=null){
          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $poll);
        }
      }

      // Rebuild privacy
      $actionTable = Engine_Api::_()->getDbtable('actions', 'activity');
      foreach( $actionTable->getActionsByObject($poll) as $action ) {
        $actionTable->resetActivityBindings($action);
      }

      $db->commit();

      return $this->_redirect("polls/manage");

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

    // This is a smoothbox by default
    if( null === $this->_helper->ajaxContext->getCurrentContext() )
      $this->_helper->layout->setLayout('default-simple');
    else // Otherwise no layout
      $this->_helper->layout->disableLayout(true);

    $poll_id = $this->view->poll_id = $this->getRequest()->getParam('poll_id');
    if (!$this->getRequest()->isPost())
      return;

    $poll_id = $this->getRequest()->getPost('poll_id');
    $poll    = Engine_Api::_()->getItem('poll', $poll_id);
    
    if ($this->view->viewer_id == $poll->user_id) {
      $this->view->permission = true;
      $this->view->success    = false;
      $db = Engine_Api::_()->getDbtable('polls', 'poll')->getAdapter();
      $db->beginTransaction();
      try {
        Engine_Api::_()->getApi('core', 'poll')->deletePoll($poll_id);
        $db->commit();
        $this->view->success = true;
      } catch (Exception $e) {
        $db->rollback();
        throw $e;
      }
    } else {
      $this->view->permission = false;
    }
  }

  public function dlistAction()
  {
    $user_id = $this->getRequest()->getParam('user_id');
    if ($user_id == $this->view->viewer_id)
      $this->_helper->redirector->gotoRoute(array(), 'poll_manage');

    $this->view->paginator = Engine_Api::_()->poll()->getPollsPaginator(
            //getPollsPaginator($user_id = null, $sort = null, $search = '', $closed = 0)
            $user_id,
            $this->_getParam('sort'),
            $this->view->search);
    $this->view->paginator->setItemCountPerPage( Engine_Api::_()->getApi('settings', 'core')->getSetting('poll.perPage', 10) );
    $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );
    $this->view->user_id   = $user_id;

    $users     = array();
    $poll_ids  = array();
    foreach ($this->view->paginator as $poll) {
      if (!isset($user[ $poll->user_id ]))
        $users[ $poll->user_id ] = Engine_Api::_()->user()->getUser($poll->user_id);
      $poll_ids[] = $poll->poll_id;
    }
    $this->view->pollVotes  = Engine_Api::_()->poll()->getPollVotes($poll_ids);
    $this->view->users      = $users;
    $this->render('browse');
  }

  
  /* Utility */
  protected $_navigation;
  public function getNavigation()
  {
    $tabs   = array();
    $tabs[] = array(
          'label'      => 'Browse Polls',
          'route'      => 'poll_browse',
          'action'     => 'browse',
          'controller' => 'index',
          'module'     => 'poll'
        );
    $tabs[] = array(
          'label'      => 'My Polls',
          'route'      => 'poll_manage',
          'action'     => 'manage',
          'controller' => 'index',
          'module'     => 'poll'
        );
    $tabs[] = array(
          'label'      => 'Create New Poll',
          'route'      => 'poll_create',
          'action'     => 'create',
          'controller' => 'index',
          'module'     => 'poll'
        );
    if( is_null($this->_navigation) ) {
      $this->_navigation = new Zend_Navigation();
      $this->_navigation->addPages($tabs);
    }
    return $this->_navigation;
  }
}