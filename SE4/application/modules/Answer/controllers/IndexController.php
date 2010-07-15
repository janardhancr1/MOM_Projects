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
  protected $_navigation;

  // NONE USER SPECIFIC METHODS
  public function indexAction()
  {
    /*$viewer = $this->_helper->api()->user()->getViewer();
    if( !$this->_helper->requireAuth()->setAuthParams('answer', null, 'view')->isValid()) return;*/
    
    $this->view->navigation = $this->getNavigation();
    $this->view->form = $form = new Answer_Form_Search();
     $this->view->form1 = $form1 = new Answer_Form_Create();
    //$this->view->question = $question = new Question_Form_Create();
    
   $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('answer', null, 'create')->checkRequire();

    /*$form->removeElement('draft');
    if( !$viewer->getIdentity() )
    {
      $form->removeElement('show');
    }

    // Populate form
    $this->view->categories = $categories = Engine_Api::_()->answer()->getCategories();
    foreach( $categories as $category )
    {
      $form->category->addMultiOption($category->category_id, $category->category_name);
    }

    // Process form
    $form->isValid($this->getRequest()->getPost());
    $values = $form->getValues();

    // Do the show thingy
    if( @$values['show'] == 2 )
    {
      // Get an array of friend ids to pass to getBlogsPaginator
      $table = $this->_helper->api()->getItemTable('user');
      $select = $viewer->membership()->getMembersSelect('user_id');
      $friends = $table->fetchAll($select);
      // Get stuff
      $ids = array();
      foreach( $friends as $friend )
      {
        $ids[] = $friend->user_id;
      }
      //unset($values['show']);
      $values['users'] = $ids;
    }
    $values['draft'] = "0";
    $values['visible'] = "1";

    //die($this->_getParam('page',1)."");
    $this->view->assign($values);

    $paginator = Engine_Api::_()->blog()->getBlogsPaginator($values);

    $items_per_page = Engine_Api::_()->getApi('settings', 'core')->blog_page;
    $paginator->setItemCountPerPage($items_per_page);

    $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );

    if( !empty($values['category']) ) $this->view->categoryObject = Engine_Api::_()->blog()->getCategory($values['category']);*/
  }
  
  public function viewAction()
  {
    $viewer = $this->_helper->api()->user()->getViewer();
    $blog = Engine_Api::_()->getItem('blog', $this->_getParam('blog_id'));
    //$blog->authorization()->isAllowed(null, 'moderator');
    $can_edit = $this->view->can_edit = $this->_helper->requireAuth()->setAuthParams($blog, null, 'edit')->checkRequire();
 
    if( !$this->_helper->requireAuth()->setAuthParams($blog, null, 'view')->isValid()) return;

    if( $blog->getIdentity() )
    {
      $archiveList = Engine_Api::_()->blog()->getArchiveList($blog->owner_id);

      $this->view->archive_list = $this->handleArchiveList($archiveList);
      $this->view->viewer = $viewer;
      $blog->view_count++;
      $blog->save();
      $this->view->blog = $blog;

      $this->view->blogTags = $blog->tags()->getTagMaps();
      $this->view->userTags = $blog->tags()->getTagsByTagger($blog->getOwner());
      //$this->view->blogTags = Engine_Api::_()->blog()->getBlogTags($blog_id);
      //$this->view->userTags = Engine_Api::_()->blog()->getUserTags($blog->owner_id);

      if($blog->category_id !=0) $this->view->category = Engine_Api::_()->blog()->getCategory($blog->category_id);
      $this->view->userCategories = Engine_Api::_()->blog()->getUserCategories($this->view->blog->owner_id);
    }

    // Get styles
    $this->view->owner = $user = $blog->getOwner();
    $table = Engine_Api::_()->getDbtable('styles', 'core');
    $select = $table->select()
      ->where('type = ?', 'user_blog')
      ->where('id = ?', $user->getIdentity())
      ->limit();

    $row = $table->fetchRow($select);

    if( null !== $row && !empty($row->style) )
    {
      $this->view->headStyle()->appendStyle($row->style);
    }
  }

  // USER SPECIFIC METHODS
  public function manageAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $viewer = $this->_helper->api()->user()->getViewer();
    $this->view->navigation = $this->getNavigation();
    $this->view->form = $form = new Blog_Form_Search();
    $this->view->can_style = Engine_Api::_()->authorization()->getPermission(1, 'blog', 'css');
    $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('blog', null, 'create')->checkRequire();

    $form->removeElement('show');
    
    // Populate form
    $this->view->categories = $categories = Engine_Api::_()->blog()->getCategories();
    foreach( $categories as $category )
    {
      $form->category->addMultiOption($category->category_id, $category->category_name);
    }

    // Process form
    $form->isValid($this->getRequest()->getPost());
    $values = $form->getValues();
    $values['user_id'] = $viewer->getIdentity();

    // Get paginator
    $this->view->paginator = $paginator = Engine_Api::_()->blog()->getBlogsPaginator($values);
    $items_per_page = Engine_Api::_()->getApi('settings', 'core')->blog_page;
    $paginator->setItemCountPerPage($items_per_page);
    $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );
  }

  public function listAction()
  {
    // Preload info
    $viewer = $this->_helper->api()->user()->getViewer();
    $this->view->owner = $owner = Engine_Api::_()->getItem('user', $this->_getParam('user_id'));
    $this->view->archive_list = $archiveList = Engine_Api::_()->blog()->getArchiveList($owner);

    $this->view->navigation = $this->getNavigation();

    // Make form
    $this->view->form = $form = new Blog_Form_Search();
    $form->removeElement('show');

    // Populate form
    $this->view->categories = $categories = Engine_Api::_()->blog()->getCategories();
    foreach( $categories as $category )
    {
      $form->category->addMultiOption($category->category_id, $category->category_name);
    }

    // Process form
    $form->isValid($this->getRequest()->getPost());
    $values = $form->getValues();
    $values['user_id'] = $owner->getIdentity();
    $values['draft'] = "0";
    $values['visible'] = "1";


    $this->view->assign($values);

    // Get paginator
    $this->view->paginator = $paginator = Engine_Api::_()->blog()->getBlogsPaginator($values);
    $items_per_page = Engine_Api::_()->getApi('settings', 'core')->blog_page;
    $paginator->setItemCountPerPage($items_per_page);
    $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );

    $this->view->userTags = Engine_Api::_()->getDbtable('tags', 'core')->getTagsByTagger('blog', $owner);
    $this->view->userCategories = Engine_Api::_()->blog()->getUserCategories($owner->getIdentity());
  }

  public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    
    $this->view->navigation = $this->getNavigation();
    $this->view->form = $form = new Answer_Form_Create();
            
  if ( $this->getRequest()->isPost() && $this->view->form->isValid($this->getRequest()->getPost()) ) {
      $db = Engine_Api::_()->getDbTable('questions', 'question')->getAdapter();
      $db->beginTransaction();
      try {
        $question_id    = $this->view->form->save();
        if (empty($question_id))
          return;
        $values = $this->view->form->getValues();

        $row        = Engine_Api::_()->getItem('question', $question_id);
        $attachment = Engine_Api::_()->getItem($row->getType(), $question_id);

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


        $action     = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity(Engine_Api::_()->user()->getViewer(), $row, 'recipe_new');
        if (null !== $action)
          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $attachment);

        $db->commit();
      } catch (Exception $e) {
        $db->rollback();
        throw $e;
      }

      if ($question_id)
        $this->_redirect("anwers/view/$question_id");
    }
  }

  public function editAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $viewer = $this->_helper->api()->user()->getViewer();
    $blog = Engine_Api::_()->getItem('blog', $this->_getParam('blog_id'));
    if( !Engine_Api::_()->core()->hasSubject('blog') )
    {
      Engine_Api::_()->core()->setSubject($blog);
    }

    if( !$this->_helper->requireSubject()->isValid() ) return;
    //if( !$this->_helper->requireAuth()->setAuthParams($blog, $viewer, 'edit')->isValid() ) return;

    // Backup
    if( $viewer->getIdentity() != $blog->owner_id && !$this->_helper->requireAuth()->setAuthParams($blog, null, 'edit')->isValid())
    {
      return $this->_forward('requireauth', 'error', 'core');
      //die('are you trying to edit someone elses blog?');
    }

    $navigation = $this->getNavigation(true);
    $this->view->navigation = $navigation;
    $this->view->form = $form = new Blog_Form_Edit();
    
    // Save blog entry
    $saved = $this->_getParam('saved');
    if( !$this->getRequest()->isPost() || $saved )
    {
      if( $saved )
      {
        $url = $this->_helper->url->url(array('user_id' => $blog->owner_id, 'blog_id' => $blog->getIdentity()), 'blog_entry_view');
        $form->addNotice(Zend_Registry::get('Zend_Translate')->_('Your changes were saved. Click <a href=\'%1$s\'>here</a> to view your blog.', $url));
      }

      // prepare tags
      $blogTags = $blog->tags()->getTagMaps();

      $tagString = '';
      foreach( $blogTags as $tagmap )
      {
        if( $tagString !== '' ) $tagString .= ', ';
        $tagString .= $tagmap->getTag()->getTitle();
      }

      $this->view->tagNamePrepared = $tagString;
      $form->tags->setValue($tagString);

      // etc
      $form->populate($blog->toArray());

      $auth = Engine_Api::_()->authorization()->context;
      $user_level = $viewer->level_id;
      
      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      foreach( $roles as $role )
      {
        if( 1 === $auth->isAllowed($blog, $role, 'view'))
        {
          $form->auth_view->setValue($role);
        }
        if( 1 === $auth->isAllowed($blog, $role, 'comment'))
        {
          $form->auth_comment->setValue($role);
        }
      }
      // hide status change if it has been already published
      if ($blog->draft == "0") $form->removeElement('draft');

      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }


    // Process

    // handle save for tags
    $values = $form->getValues();
    $tags = preg_split('/[,]+/', $values['tags']);

    $db = Engine_Db_Table::getDefaultAdapter();
    $db->beginTransaction();
    try
    {
      $blog->setFromArray($values);
      $blog->modified_date = date('Y-m-d H:i:s');
      $blog->save();

      // CREATE AUTH STUFF HERE
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      if($values['auth_view']) $auth_view =$values['auth_view'];
      else $auth_view = "everyone";
      $viewMax = array_search($auth_view, $roles);
      foreach( $roles as $i=>$role )
      {
        $auth->setAllowed($blog, $role, 'view', ($i <= $viewMax));
      }

      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      if($values['auth_comment']) $auth_comment =$values['auth_comment'];
      else $auth_comment = "everyone";
      $commentMax = array_search($auth_comment, $roles);

      foreach ($roles as $i=>$role)
      {
        $auth->setAllowed($blog, $role, 'comment', ($i <= $commentMax));
      }

      // handle tags
      $blog->tags()->setTagMaps($viewer, $tags);

      // insert new activity if blog is just getting published
      $action = Engine_Api::_()->getDbtable('actions', 'activity')->getActionsByObject($blog);
      if (count($action->toArray())<=0 && $values['draft']=='0'){
        $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $blog, 'blog_new');
          // make sure action exists before attaching the blog to the activity
        if($action!=null){
          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $blog);
        }
      }

      // Rebuild privacy
      $actionTable = Engine_Api::_()->getDbtable('actions', 'activity');
      foreach( $actionTable->getActionsByObject($blog) as $action ) {
        $actionTable->resetActivityBindings($action);
      }

      $db->commit();

      return $this->_redirect("blogs/manage");

    }
    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }

    /*
    if ($form->_error) {
      $failed_tags = implode(", ", $form->_error);
      $form->getDecorator("FormErrors")->setOption("escape", false);
      $form->addErrors(array('The following tags were not stored because it exceeded the 20 character limit:<br/>'.$failed_tags));
    }
    */
  }

  public function deleteAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $this->view->navigation = $this->getNavigation();

    $viewer = $this->_helper->api()->user()->getViewer();
    $this->view->blog = $blog = Engine_Api::_()->getItem('blog', $this->_getParam('blog_id'));

    if( $viewer->getIdentity() != $blog->owner_id && !$this->_helper->requireAuth()->setAuthParams($blog, null, 'delete')->isValid())
    {
      return $this->_forward('requireauth', 'error', 'core');
      //die('You do not have permission to delete this blog');
    }

    if( $this->getRequest()->isPost() && $this->getRequest()->getPost('confirm') == true )
    {
      // do delete. in model or just right here? I think I can get the row and just call a delete function
      $this->view->blog->delete();
      return $this->_redirect("blogs/manage");
    }
  }

  public function styleAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams('blog', null, 'css')->isValid()) return;

    // In smoothbox
    $this->_helper->layout->setLayout('default-simple');

    // Require user
    if( !$this->_helper->requireUser()->isValid() ) return;
    $user = Engine_Api::_()->user()->getViewer();

    // Make form
    $this->view->form = $form = new Blog_Form_Style();

    // Get current row
    $table = Engine_Api::_()->getDbtable('styles', 'core');
    $select = $table->select()
      ->where('type = ?', 'user_blog') // @todo this is not a real type
      ->where('id = ?', $user->getIdentity())
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
      $row->type = 'user_blog'; // @todo this is not a real type
      $row->id = $user->getIdentity();
    }

    $row->style = $style;
    $row->save();

    $this->view->draft = true;
    $this->view->message = Zend_Registry::get('Zend_Translate')->_("Your changes have been saved.");
    $this->_forward('success', 'utility', 'core', array(
        'smoothboxClose' => true,
        'parentRefresh' => false,
        'messages' => array(Zend_Registry::get('Zend_Translate')->_('Your changes have been saved.'))
    ));
  }




  // Utility
  
  public function getNavigation($active = false)
  {
    if( is_null($this->_navigation) )
    {
      $navigation = $this->_navigation = new Zend_Navigation();
      
      if( $this->_helper->api()->user()->getViewer()->getIdentity() )
      {
      
          $navigation->addPage(array(
            'label' => 'Ask Question',
            'route' => 'answer_create',
            'module' => 'answer',
            'controller' => 'index',
            'action' => 'create'
          ));
      }
    }
    return $this->_navigation;
  }


  /**
   * Returns an array of dates where a given user created a blog entry
   *
   * @param Zend_Db_Table_Select collection of dates
   * @return Array Dates
   */
  public function handleArchiveList($results)
  {
    $blog_dates = array();
    foreach ($results as $result)
      $blog_dates[] = strtotime($result->creation_date);

    // GEN ARCHIVE LIST
    $time = time();
    $archive_list = array();

    foreach( $blog_dates as $blog_date )
    {
      $ltime = localtime($blog_date, TRUE);
      $ltime["tm_mon"] = $ltime["tm_mon"] + 1;
      $ltime["tm_year"] = $ltime["tm_year"] + 1900;

      // LESS THAN A YEAR AGO - MONTHS
      if( $blog_date+31536000>$time )
      {
        $date_start = mktime(0, 0, 0, $ltime["tm_mon"], 1, $ltime["tm_year"]);
        $date_end = mktime(0, 0, 0, $ltime["tm_mon"]+1, 1, $ltime["tm_year"]);
        $label = date('F Y', $blog_date);
        $type = 'month';
      }

      // MORE THAN A YEAR AGO - YEARS
      else
      {
        $date_start = mktime(0, 0, 0, 1, 1, $ltime["tm_year"]);
        $date_end = mktime(0, 0, 0, 1, 1, $ltime["tm_year"]+1);
        $label = date('Y', $blog_date);
        $type = 'year';
      }

      if( !isset($archive_list[$date_start]) )
      {
        $archive_list[$date_start] = array(
          'type' => $type,
          'label' => $label,
          'date_start' => $date_start,
          'date_end' => $date_end,
          'count' => 1
        );
      }
      else
      {
        $archive_list[$date_start]['count']++;
      }
    }

    //krsort($archive_list);
    return $archive_list;
  }
}

