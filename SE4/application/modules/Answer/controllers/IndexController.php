<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 5935 2010-05-21 01:35:38Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_IndexController extends Core_Controller_Action_Standard
{
  public function init()
  {
  	if( !$this->_helper->requireUser()->isValid() ) return;
    $this->view->viewer_id   = $qviewer = Engine_Api::_()->user()->getViewer()->getIdentity();
    
    $ajaxContext = $this->_helper->getHelper('AjaxContext');
    $ajaxContext->addActionContext('delete', 'json');
    $this->getRightSideContent();
  }
  
public function searchAction()
{
    // deal with searches in sessions
    $post      = new Zend_Controller_Request_Http();
    if (null === $post->getPost('answer_search'))
      $search  = $this->getSession()->search;
    else
      $search  = $this->getSession()->search = $post->getPost('answer_search');
    $this->view->search = $this->getSession()->search = $search;
    $this->browseAction();
    $this->render('browse');
}
public function browseAction()
{
    $this->view->search_form = $search_form = new Answer_Form_Index_Search();
    if ($this->getRequest()->isPost() && $search_form->isValid($this->getRequest()->getPost())) {
      // redirect to GET route to prevent POST-back-button fo-paw
      $this->_helper->redirector->gotoRouteAndExit(array(
        'page' => 1,
        'sort'   => $this->getRequest()->getPost('browse_answers_by'),
        'search' => $this->getRequest()->getPost('answer_search'),
      	'category' => $this->getRequest()->getPost('category_id'),
      ));
    }  else {
      	$search_form->getElement('browse_answers_by')->setValue($this->_getParam('sort'));
      	$search_form->getElement('category_id')->setValue($this->_getParam('category'));
    } 

    $this->view->paginator  = Engine_Api::_()->answer()->getAnswersPaginator(array(
      'user_id' => 0,
      'sort'    => $this->_getParam('sort'),
      'search'  => $this->_getParam('search'),
      'category'  => $this->_getParam('category'),
    ));
    $this->view->paginator->setItemCountPerPage( Engine_Api::_()->getApi('settings', 'core')->getSetting('answer.perPage', 10) );
    $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );

    $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('answer', null, 'create')->checkRequire();
}

 public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireAuth()->setAuthParams('answer', null, 'create')->isValid()) return;

    
    $this->view->form = new Answer_Form_Index_Create();
   if ( $this->getRequest()->isPost() && $this->view->form->isValid($this->getRequest()->getPost()) ) {
      $db = Engine_Api::_()->getDbTable('answers', 'answer')->getAdapter();
      $db->beginTransaction();
      try {
        $answer_id    = $this->view->form->save();
        if (empty($answer_id))
          return;
        $values = $this->view->form->getValues();

        $row        = Engine_Api::_()->getItem('answer', $answer_id);
        $attachment = Engine_Api::_()->getItem($row->getType(), $answer_id);
        
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


        $action     = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity(Engine_Api::_()->user()->getViewer(), $row, 'answer_new');
        if (null !== $action)
          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $attachment);
        $db->commit();
      }
     catch (Exception $e) {
        $db->rollback();
        throw $e;
      }
            if ($answer_id)
        $this->_redirect("answers/manage");
     }
  }

public function viewAction()
  {
 	$answer_id = $this->getRequest()->getParam('answer_id');
    $answer = $this->view->answer = Engine_Api::_()->getItem('answer', $answer_id);
    $cat = $this->view->cat = Engine_Api::_()->answer()->getCategory($answer->answer_cat_id);
   
    if (!empty($answer)) {
      Engine_Api::_()->core()->setSubject($answer);
    }
    if (!$this->_helper->requireSubject()->isValid())
      return;

    if( !$this->_helper->requireAuth()->setAuthParams($answer, null, 'view')->isValid()) return;

    $this->view->owner    = $owner   = $answer->getOwner();
    $this->view->answer->save();
    $this->view->form = new Answer_Form_Index_Answer();
    $this->view->acceptform = new Answer_Form_Index_Accept();
    
        $this->view->paginator  = Engine_Api::_()->answer()->getPostAnswersPaginator(array(
      'user_id' => 0,
      'answer_id' => $answer_id
    ));
    $this->view->paginator->setItemCountPerPage( Engine_Api::_()->getApi('settings', 'core')->getSetting('answer.perPage', 10) );
    $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );
    
  	if($this->getRequest()->isPost() && $this->view->acceptform->isValid($this->getRequest()->getPost()))
    {
    	$post      = new Zend_Controller_Request_Http();
    	if(null !== $post->getPost('submit1'))
    	{
			$db = $answer->getTable()->getAdapter();
			$db->beginTransaction();
			try
			{
				$answer->is_closed = 1;
				$answer->save();
				
				$db->commit();
	
				return $this->_redirect("answers/manage");
	
			}
			catch( Exception $e )
			{
				$db->rollBack();
				throw $e;
			}
    	}
				
    }
   if ( $this->getRequest()->isPost() && $this->view->form->isValid($this->getRequest()->getPost()) ) {
   
      $db = Engine_Api::_()->getDbTable('posts', 'answer')->getAdapter();
      $db->beginTransaction();
      try {
        $post_id    = $this->view->form->save($answer_id);
        if (empty($post_id))
          return;
        $values = $this->view->form->getValues();

        $row        = Engine_Api::_()->getItem('answer', $post_id);
        //$attachment = Engine_Api::_()->getItem($row->getType(), $post_id);
        
        $db->commit();
      }
     catch (Exception $e) {
        $db->rollback();
        throw $e;
      }
            if ($post_id)
        $this->_redirect("answers/manage");
     }
  }
  public function manageAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('answer', null, 'create')->checkRequire();

    $this->view->users     = array($this->view->viewer_id => Engine_Api::_()->user()->getViewer());
    $this->view->owner     = Engine_Api::_()->user()->getViewer();
    $this->view->user_id   = $this->view->viewer_id;

    $this->view->paginator = Engine_Api::_()->answer()->getAnswersPaginator(array(
      'user_id' => $this->view->viewer_id
    ));
    $this->view->paginator->setItemCountPerPage( Engine_Api::_()->getApi('settings', 'core')->getSetting('answer.perpage', 10) );
    $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );
    
    $this->view->categories = Engine_Api::_()->answer()->getCategories();


    $answer_ids  = array();
    foreach ($this->view->paginator as $answer) {
      $answer_ids[] = $answer->answer_id;
    }
   
  }
  
  public function deleteAction()
  {
  if( !$this->_helper->requireUser()->isValid() ) return;

    //$this->view->navigation = $this->getNavigation();

    $viewer = $this->_helper->api()->user()->getViewer();
    $this->view->answer = $answer = Engine_Api::_()->getItem('answer', $this->_getParam('answer_id'));

    //if( $viewer->getIdentity() != $answer->owner_id && !$this->_helper->requireAuth()->setAuthParams($answer, null, 'delete')->isValid())
    //{
     //return $this->_forward('requireauth', 'error', 'core');
      //die('You do not have permission to delete this blog');
    //}

    if( $this->getRequest()->isPost() && $this->getRequest()->getPost('confirm') == true )
    {
      // do delete. in model or just right here? I think I can get the row and just call a delete function
      $this->view->answer->delete();
      return $this->_redirect("answers/manage");
    }
  }
}

