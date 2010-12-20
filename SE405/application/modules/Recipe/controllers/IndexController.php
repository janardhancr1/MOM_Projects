<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 6585 2010-06-25 02:17:06Z steve $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Recipe
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Recipe_IndexController extends Core_Controller_Action_Standard
{
  public function init()
  {
  	if( !$this->_helper->requireUser()->isValid() ) return;
    $this->view->viewer_id   = Engine_Api::_()->user()->getViewer()->getIdentity();
    $this->view->navigation  = $this->getNavigation();
    
    $ajaxContext = $this->_helper->getHelper('AjaxContext');
    $ajaxContext->addActionContext('delete', 'json');
    $this->getRightSideContent();
  }

  public function searchAction()
  {
    // deal with searches in sessions
    $post      = new Zend_Controller_Request_Http();
    if (null === $post->getPost('recipe_search'))
      $search  = $this->getSession()->search;
    else
      $search  = $this->getSession()->search = $post->getPost('recipe_search');
    $this->view->search = $this->getSession()->search = $search;
    $this->browseAction();
    $this->render('browse');
  }
  public function browseAction()
  {
    $this->view->search_form = $search_form = new Recipe_Form_Index_Search();
    if ($this->getRequest()->isPost() && $search_form->isValid($this->getRequest()->getPost())) {
      // redirect to GET route to prevent POST-back-button fo-paw
      $this->_helper->redirector->gotoRouteAndExit(array(
        'page' => 1,
        'sort'   => $this->getRequest()->getPost('browse_recipes_by'),
        'search' => $this->getRequest()->getPost('recipe_search'),
      	'category' => $this->getRequest()->getPost('category_id'),
      ));
    } else {
      $search_form->getElement('recipe_search')->setValue($this->_getParam('search'));
      $search_form->getElement('browse_recipes_by')->setValue($this->_getParam('sort'));
      $search_form->getElement('category_id')->setValue($this->_getParam('category'));
    }

    $this->view->paginator  = Engine_Api::_()->recipe()->getRecipesPaginator(array(
      'user_id' => 0,
      'sort'    => $this->_getParam('sort'),
      'search'  => $this->_getParam('search'),
      'category'  => $this->_getParam('category'),
    ));
    $this->view->paginator->setItemCountPerPage( Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.perPage', 10) );
    $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );

    $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('recipe', null, 'create')->checkRequire();
  }
    public function viewAction()
  {
    $recipe_id = $this->getRequest()->getParam('recipe_id');
    $recipe = $this->view->recipe = Engine_Api::_()->getItem('recipe', $recipe_id);
    $viewer = $this->_helper->api()->user()->getViewer();
    if (!empty($recipe)) {
      Engine_Api::_()->core()->setSubject($recipe);
    }
    if (!$this->_helper->requireSubject()->isValid())
      return;

    if( !$this->_helper->requireAuth()->setAuthParams($recipe, null, 'view')->isValid()) return;
    // Don't render this if not authorized
    #if (!$this->_helper->requireAuth()->setAuthParams($recipe, null, 'view')->isValid()) return;
    
          // album material
      $this->view->album = $album = $recipe->getSingletonAlbum();
      $this->view->paginator = $paginator = $album->getCollectiblesPaginator();
      $paginator->setCurrentPageNumber($this->_getParam('page', 1));
      $paginator->setItemCountPerPage(100);

    $this->view->owner         = $recipe->getOwner();
    //$this->view->recipeOptions   = $recipe->getOptions();
    $this->view->hasVoted      = $recipe->viewerVoted();
    $this->view->votes = 0;
    if (!empty($this->view->recipeOptions))
      foreach ($this->view->recipeOptions as $i => $recipeOption)
        $this->view->votes += $recipeOption->votes;
    $this->view->recipe->views++;
    $this->view->recipe->save();
    $this->view->showPieChart  = Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.showPieChart', false);
    $this->view->canChangeVote = Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.canChangeVote', false);
     $this->view->rating_count = Engine_Api::_()->recipe()->ratingCount($recipe->getIdentity());
     $this->view->rated = Engine_Api::_()->recipe()->checkRated($recipe->getIdentity(), $viewer->getIdentity());
  }
  public function rateAction()
  {
    $viewer = Engine_Api::_()->user()->getViewer();
    $user_id = $viewer->getIdentity();
    
    $rating = $this->_getParam('rating');
    $recipe_id =  $this->_getParam('recipe_id');

    
    $table = Engine_Api::_()->getDbtable('ratings', 'recipe');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      Engine_Api::_()->recipe()->setRating($recipe_id, $user_id, $rating);
      
      $total = Engine_Api::_()->recipe()->ratingCount($recipe_id);

      $recipe = Engine_Api::_()->getItem('recipe', $recipe_id);
      $rating = ($recipe->rating + $rating)/$total;
      $recipe->rating = $rating;
      $recipe->save();

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
    
    $data = array();
    $data[] = array(
      'total' => $total,
      'rating' => $rating,
    );
    return $this->_helper->json($data);
    $data = Zend_Json::encode($data);
    $this->getResponse()->setBody($data);
  }
  public function voteAction()
  {
    // only members can vote
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->getRequest()->isPost() ) return;

    $recipe_id       = $this->getRequest()->getParam('recipe_id');
    $option_id     = $this->getRequest()->getParam('recipe_id');
    $canChangeVote = Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.canChangeVote', false);

    $recipe = Engine_Api::_()->getItem('recipe', $this->_getParam('recipe_id'));
    if (!$recipe) {
      $this->view->success = false;
      $this->view->error   = Zend_Registry::get('Zend_Translate')->_('This recipe does not seem to exist anymore.');
      return;
    }

    if ($recipe->viewerVoted() && !$canChangeVote) {
      $this->view->success = false;
      $this->view->error   = Zend_Registry::get('Zend_Translate')->_('You have already voted on this recipe, and are not permitted to change your vote.');
      return;
    }

    $db = Engine_Api::_()->getDbtable('recipes', 'recipe')->getAdapter();
    $db->beginTransaction();
    try {
      $recipe->vote($this->_getParam('option_id'));
      $db->commit();
      $this->view->success   = true;
    } catch (Exception $e) {
      $db->rollback();
      $this->view->success   = false;
      throw $e;
    }
    $recipeOptions = array();
    foreach ($recipe->getOptions()->toArray() as $option) {
      $option['votesTranslated'] = $this->view->translate(array('%s vote', '%s votes', $option['votes']), $this->view->locale()->toNumber($option['votes']));
      $recipeOptions[] = $option;
    }
    $this->view->recipeOptions = $recipeOptions;
    $this->view->votes_total = $recipe->voteCount();

  }

  /* Owner */
  public function manageAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $viewer = $this->_helper->api()->user()->getViewer();
    
    $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('recipe', null, 'create')->checkRequire();
    $this->view->allowed_upload = Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'recipe', 'photo');
    $this->view->users     = array($this->view->viewer_id => Engine_Api::_()->user()->getViewer());
    $this->view->owner     = Engine_Api::_()->user()->getViewer();
    $this->view->user_id   = $this->view->viewer_id;

    $this->view->paginator = Engine_Api::_()->recipe()->getRecipesPaginator(array(
      'user_id' => $this->view->viewer_id
    ));
    $this->view->paginator->setItemCountPerPage( Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.perpage', 10) );
    $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );

    $recipe_ids  = array();
    foreach ($this->view->paginator as $recipe) {
      $recipe_ids[] = $recipe->recipe_id;
    }
    $this->view->recipeVotes  = Engine_Api::_()->recipe()->getRecipeVotes($recipe_ids);
  }
  public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireAuth()->setAuthParams('recipe', null, 'create')->isValid()) return;

    $this->view->maxOptions = Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.maxoptions', 15);
    $this->view->form = $form = new Recipe_Form_Index_Create();
     $viewer = Engine_Api::_()->user()->getViewer();
    if ( $this->getRequest()->isPost() && $this->view->form->isValid($this->getRequest()->getPost()) ) {
      $db = Engine_Api::_()->getDbTable('recipes', 'recipe')->getAdapter();
      $db->beginTransaction();
      try {
        $recipe_id    = $this->view->form->save();
        if (empty($recipe_id))
          return;
        $values = $from = $this->view->form->getValues();
		
        
        // Set photo
        
        
        $row        = Engine_Api::_()->getItem('recipe', $recipe_id);
        $attachment = Engine_Api::_()->getItem($row->getType(), $recipe_id);
        
      if( !empty($values['photo']) ) {
          $row->setPhoto($form->photo);
        }

        // CREATE AUTH STUFF HERE
        $auth = Engine_Api::_()->authorization()->context;
        $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
        if($values['views']) $auth_view =$values['views'];
        else $auth_view = "everyone";
        $viewMax = array_search($auth_view, $roles);
        foreach( $roles as $i=>$role )
        {
          $auth->setAllowed($attachment, $role, 'view', ($i <= $viewMax));
        }

        $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
        if($values['comments']) $auth_comment =$values['comments'];
        else $auth_comment = "everyone";
        $commentMax = array_search($values['comments'], $roles);

        foreach ($roles as $i=>$role)
        {
          $auth->setAllowed($attachment, $role, 'comment', ($i <= $commentMax));
        }


        $action     = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity(Engine_Api::_()->user()->getViewer(), $row, 'recipe_new');
        if (null !== $action)
          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $attachment);

        $db->commit();
        
        // Redirect
        //$allowed_upload = Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'recipe', 'photo');
        
        
          return $this->_helper->redirector->gotoRoute(array('recipe_id'=>$recipe_id), 'recipe_success', true);
        
         return $this->_redirect("recipes/manage");
      } 
      catch (Exception $e) {
        $db->rollback();
        throw $e;
      }

      if ($recipe_id)
        $this->_redirect("recipes/view/$recipe_id");
    }
  }
  
 public function successAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $this->view->navigation = $this->getNavigation();

    $viewer = $this->_helper->api()->user()->getViewer();
    $this->view->recipe = $recipe = Engine_Api::_()->getItem('recipe', $this->_getParam('recipe_id'));

    //if( $viewer->getIdentity() != $recipe->owner_id )
    //{
      //return $this->_forward('requireauth', 'error', 'core');
    //}

    if( $this->getRequest()->isPost() && $this->getRequest()->getPost('confirm') == true )
    {
      return $this->_redirect("recipes/photo/upload/subject/recipe_".$this->_getParam('recipe_id'));
    }
  }

  public function editAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $viewer = $this->_helper->api()->user()->getViewer();
    $recipe = Engine_Api::_()->getItem('recipe', $this->_getParam('recipe_id'));

    if( !Engine_Api::_()->core()->hasSubject('recipe') )
    {
      Engine_Api::_()->core()->setSubject($recipe);
    }

    if( !$this->_helper->requireSubject()->isValid() ) return;
    //if( !$this->_helper->requireAuth()->setAuthParams($blog, $viewer, 'edit')->isValid() ) return;

    // Backup
    if( $viewer->getIdentity() != $recipe->user_id && !$this->_helper->requireAuth()->setAuthParams($recipe, null, 'edit')->isValid())
    {
      return $this->_forward('requireauth', 'error', 'core');
      //die('are you trying to edit someone elses blog?');
    }

    $navigation = $this->getNavigation(true);
    $this->view->navigation = $navigation;
    $this->view->form = $form = new Recipe_Form_Index_Edit();
    $saved = $this->_getParam('saved');

    // Populate form with current settings
   
    if( !$this->getRequest()->isPost() || $saved)
    {
      /*
      $user_level = $viewer->level_id;
      $allowed_view = Engine_Api::_()->authorization()->getPermission($user_level, 'recipe', 'auth_view');
      $allowed_view = unserialize($allowed_view);
      $allowed_comment = Engine_Api::_()->authorization()->getPermission($user_level, 'recipe', 'auth_comment');
      $allowed_comment = unserialize($allowed_comment);
      */
    	
       if( $saved )
      {
        $url = $this->_helper->url->url(array('user_id' => $viewer->getIdentity(), 'recipe_id' => $classified->getIdentity()), 'classified_entry_view');
        $savedChangesNotice = Zend_Registry::get('Zend_Translate')->_("Your changes were saved. Click %s to view your listing.",'<a href="'.$url.'">here</a>');
        $form->addNotice($savedChangesNotice);
      }
       // prepare tags
      /*$classifiedTags = $recipe->tags()->getTagMaps();
      //$form->getSubForm('custom')->saveValues();
      
      $tagString = '';
      foreach( $classifiedTags as $tagmap )
      {
        if( $tagString !== '' ) $tagString .= ', ';
        $tagString .= $tagmap->getTag()->getTitle();
      }

      $this->view->tagNamePrepared = $tagString;
      $form->tags->setValue($tagString);*/

      // etc
      $form->populate($recipe->toArray());
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      foreach( $roles as $role )
      {
        if( 1 === $auth->isAllowed($recipe, $role, 'view'))
        {
          $form->views->setValue($role);
        }
        if( 1 === $auth->isAllowed($recipe, $role, 'comment'))
        {
          $form->comments->setValue($role);
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
    	//$recipe_id    = $this->view->form->save();
      $values = $form->getValues();
      
      $recipe->setFromArray($values);
	  $recipe->modified_date = date('Y-m-d H:i:s');
	  $recipe->save();
      // CREATE AUTH STUFF HERE
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      if($values['views']) $auth_view =$values['views'];
      else $auth_view = "everyone";
      $viewMax = array_search($auth_view, $roles);
      foreach( $roles as $i=>$role )
      {
        $auth->setAllowed($recipe, $role, 'view', ($i <= $viewMax));
      }
      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      if($values['comments']) $auth_comment =$values['comments'];
      else $auth_comment = "everyone";
      $commentMax = array_search($auth_comment, $roles);

      foreach ($roles as $i=>$role)
      {
        $auth->setAllowed($recipe, $role, 'comment', ($i <= $commentMax));
      }

      // insert new activity if blog is just getting published
      $action = Engine_Api::_()->getDbtable('actions', 'activity')->getActionsByObject($recipe);
      if (count($action->toArray())<=0 && $values['draft']=='0'){
        $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $recipe, 'recipe_new');
          // make sure action exists before attaching the blog to the activity
        if($action!=null){
          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $recipe);
        }
      }

      // Rebuild privacy
      $actionTable = Engine_Api::_()->getDbtable('actions', 'activity');
      foreach( $actionTable->getActionsByObject($recipe) as $action ) {
        $actionTable->resetActivityBindings($action);
      }

      $db->commit();

      return $this->_redirect("recipes/manage");

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

    $recipe_id = $this->view->recipe_id = $this->getRequest()->getParam('recipe_id');
    if (!$this->getRequest()->isPost())
      return;

    $recipe_id = $this->getRequest()->getPost('recipe_id');
    $recipe    = Engine_Api::_()->getItem('recipe', $recipe_id);
    
    if ($this->view->viewer_id == $recipe->user_id) {
      $this->view->permission = true;
      $this->view->success    = false;
      $db = Engine_Api::_()->getDbtable('recipes', 'recipe')->getAdapter();
      $db->beginTransaction();
      try {
        Engine_Api::_()->getApi('core', 'recipe')->deleteRecipe($recipe_id);
        $db->commit();
        $this->view->success = true;
      } catch (Exception $e) {
        $db->rollback();
        throw $e;
      }
    } else {
      $this->view->permission = false;
    }
    $this->view->status = true;
    $this->view->message = Zend_Registry::get('Zend_Translate')->_('Recipe has been deleted.');
    return $this->_forward('success' ,'utility', 'core', array(
      'parentRedirect' => Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action' => 'manage'), 'recipe_manage', true),
      'smoothboxClose' => true,
      'parentRefresh' => true,
      'messages' => Array($this->view->message)
    ));
  }

  public function dlistAction()
  {
    $user_id = $this->getRequest()->getParam('user_id');
    if ($user_id == $this->view->viewer_id)
      $this->_helper->redirector->gotoRoute(array(), 'recipe_manage');

    $this->view->paginator = Engine_Api::_()->recipe()->getRecipesPaginator(
            //getRecipesPaginator($user_id = null, $sort = null, $search = '', $closed = 0)
            $user_id,
            $this->_getParam('sort'),
            $this->view->search);
    $this->view->paginator->setItemCountPerPage( Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.perPage', 10) );
    $this->view->paginator->setCurrentPageNumber( $this->_getParam('page',1) );
    $this->view->user_id   = $user_id;

    $users     = array();
    $recipe_ids  = array();
    foreach ($this->view->paginator as $recipe) {
      if (!isset($user[ $recipe->user_id ]))
        $users[ $recipe->user_id ] = Engine_Api::_()->user()->getUser($recipe->user_id);
      $recipe_ids[] = $recipe->recipe_id;
    }
    $this->view->recipeVotes  = Engine_Api::_()->recipe()->getRecipeVotes($recipe_ids);
    $this->view->users      = $users;
    $this->render('browse');
  }

  
  /* Utility */
  protected $_navigation;
  public function getNavigation()
  {
    $tabs   = array();
    $tabs[] = array(
          'label'      => 'Browse recipes',
          'route'      => 'recipe_browse',
          'action'     => 'browse',
          'controller' => 'index',
          'module'     => 'recipe'
        );
    $tabs[] = array(
          'label'      => 'My recipes',
          'route'      => 'recipe_manage',
          'action'     => 'manage',
          'controller' => 'index',
          'module'     => 'recipe'
        );
    $tabs[] = array(
          'label'      => 'Create New Recipe',
          'route'      => 'recipe_create',
          'action'     => 'create',
          'controller' => 'index',
          'module'     => 'recipe'
        );
    if( is_null($this->_navigation) ) {
      $this->_navigation = new Zend_Navigation();
      $this->_navigation->addPages($tabs);
    }
    return $this->_navigation;
  }
}