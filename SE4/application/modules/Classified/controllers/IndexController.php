<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 6578 2010-06-24 02:27:46Z jung $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Classified_IndexController extends Core_Controller_Action_Standard
{
  protected $_navigation;

  public function init()
  {
  	if( !$this->_helper->requireUser()->isValid() ) return;
	$this->getRightSideContent();
  }
  // NONE USER SPECIFIC METHODS
  public function indexAction()
  {
    $viewer = $this->_helper->api()->user()->getViewer();

    if( !$this->_helper->requireAuth()->setAuthParams('classified', null, 'view')->isValid() ) return;

    $this->view->navigation = $this->getNavigation();
    $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('classified', null, 'create')->checkRequire();

    $this->view->form = $form = new Classified_Form_Search();

    if( !$viewer->getIdentity() )
    {
      $form->removeElement('show');
    }

    // Populate form
    $this->view->categories = $categories = Engine_Api::_()->classified()->getCategories();
    foreach( $categories as $category )
    {
      $form->category->addMultiOption($category->category_id, $category->category_name);
    }

    // Process form
    if( $form->isValid($this->getRequest()->getPost()) ) {
      $values = $form->getValues();
    } else {
      $values = array();
    }
    
    $customFieldValues = array_intersect_key($values, $form->getFieldElements());
    //var_dump($customFieldValues);die();

    // Do the show thingy
    if( @$values['show'] == 2 )
    {
      // Get an array of friend ids to pass to getClassifiedsPaginator
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

    // check to see if request is for specific user's listings
    $user_id = $this->_getParam('user');
    if ($user_id) $values['user_id'] = $user_id;

    //die($this->_getParam('page',1)."");
    $this->view->assign($values);
    
    // items needed to show what is being filtered in browse page
    if (!empty($values['tag'])) $this->view->tag_text = Engine_Api::_()->getItem('core_tag', $values['tag'])->text;
    $archiveList = Engine_Api::_()->classified()->getArchiveList();
    $this->view->archive_list = $this->handleArchiveList($archiveList);

    $view = $this->view;
    $view->addHelperPath(APPLICATION_PATH . '/application/modules/Fields/View/Helper', 'Fields_View_Helper');

    $paginator = Engine_Api::_()->classified()->getClassifiedsPaginator($values, $customFieldValues);
    $items_count = (int) Engine_Api::_()->getApi('settings', 'core')->getSetting('classified.page', 10);
    $paginator->setItemCountPerPage($items_count);
    $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );

    if( !empty($values['category']) ) $this->view->categoryObject = Engine_Api::_()->classified()->getCategory($values['category']);
  }

  public function viewAction()
  {
    $viewer = $this->_helper->api()->user()->getViewer();
    $classified = Engine_Api::_()->getItem('classified', $this->_getParam('classified_id'));

    $can_edit = $this->view->can_edit = $this->_helper->requireAuth()->setAuthParams($classified, null, 'edit')->checkRequire();
    $this->view->allowed_upload = Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'classified', 'photo');

    if( !$this->_helper->requireAuth()->setAuthParams($classified, null, 'view')->isValid()) return;
    
    if( $classified )
    {
      $archiveList = Engine_Api::_()->classified()->getArchiveList($classified->owner_id);

      $this->view->owner = $owner = Engine_Api::_()->getItem('user', $classified->owner_id);
      $this->view->viewer = $viewer;

      $classified->view_count++;
      $classified->save();

      $this->view->classified = $classified;
      if ($classified->photo_id){
        $this->view->main_photo = $classified->getPhoto($classified->photo_id);
      }
      // get tags
      $this->view->classifiedTags = $classified->tags()->getTagMaps();
      $this->view->userTags = $classified->tags()->getTagsByTagger($classified->getOwner());

      // get archive list
      $this->view->archive_list = $this->handleArchiveList($archiveList);


      // get custom field values
      //$this->view->fieldsByAlias = Engine_Api::_()->fields()->getFieldsValuesByAlias($classified);
      // Load fields view helpers
      $view = $this->view;
      $view->addHelperPath(APPLICATION_PATH . '/application/modules/Fields/View/Helper', 'Fields_View_Helper');
      $this->view->fieldStructure = $fieldStructure = Engine_Api::_()->fields()->getFieldsStructurePartial($classified);

      // album material
      $this->view->album = $album = $classified->getSingletonAlbum();
      $this->view->paginator = $paginator = $album->getCollectiblesPaginator();
      $paginator->setCurrentPageNumber($this->_getParam('page', 1));
      $paginator->setItemCountPerPage(100);

      if($classified->category_id !=0) $this->view->category = Engine_Api::_()->classified()->getCategory($classified->category_id);
      $this->view->userCategories = Engine_Api::_()->classified()->getUserCategories($this->view->classified->owner_id);
    }
  }

  // USER SPECIFIC METHODS
  public function manageAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
 
    $viewer = $this->_helper->api()->user()->getViewer();

    $this->view->can_create = $this->_helper->requireAuth()->setAuthParams('classified', null, 'create')->checkRequire();
    $this->view->allowed_upload = Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'classified', 'photo');

    $this->view->navigation = $this->getNavigation();
    $this->view->form = $form = new Classified_Form_Search();
    $form->removeElement('show');

    // Populate form
    $this->view->categories = $categories = Engine_Api::_()->classified()->getCategories();
    foreach( $categories as $category )
    {
      $form->category->addMultiOption($category->category_id, $category->category_name);
    }

    // Process form
    $request = $this->getRequest()->getPost();

    // Process form
    if( $form->isValid($this->getRequest()->getPost()) ) {
      $values = $form->getValues();
    } else {
      $values = array();
    }
    
    //$customFieldValues = $form->getSubForm('custom')->getValues();
    $values['user_id'] = $viewer->getIdentity();

    // Get paginator
    $this->view->paginator = $paginator = Engine_Api::_()->classified()->getClassifiedsPaginator($values);
    $items_count = (int) Engine_Api::_()->getApi('settings', 'core')->getSetting('classified.page', 10);
    $paginator->setItemCountPerPage($items_count);
    $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );

    $view = $this->view;
    $view->addHelperPath(APPLICATION_PATH . '/application/modules/Fields/View/Helper', 'Fields_View_Helper');

    // maximum allowed classifieds
    $this->view->quota = $quota = Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'classified', 'max');
    $this->view->current_count = $paginator->getTotalItemCount();
  }

  public function listAction()
  {
    // Preload info
    $viewer = $this->_helper->api()->user()->getViewer();
    $this->view->owner = $owner = Engine_Api::_()->getItem('user', $this->_getParam('user_id'));
    $archiveList = Engine_Api::_()->classified()->getArchiveList($owner->getIdentity());
    $this->view->archive_list = $this->handleArchiveList($archiveList);

    $this->view->navigation = $this->getNavigation();

    // Make form
    $this->view->form = $form = new Classified_Form_Search();
    $form->removeElement('show');

    // Populate form
    $this->view->categories = $categories = Engine_Api::_()->classified()->getCategories();
    foreach( $categories as $category )
    {
      $form->category->addMultiOption($category->category_id, $category->category_name);
    }

    // Process form
    $form->isValid($this->getRequest()->getPost());
    $values = $form->getValues();
    $values['user_id'] = $owner->getIdentity();
    $this->view->assign($values);

    // Get paginator
    $this->view->paginator = $paginator = Engine_Api::_()->classified()->getClassifiedsPaginator($values);
    $paginator->setItemCountPerPage(10);
    $this->view->paginator = $paginator->setCurrentPageNumber( $values['page'] );

    $this->view->userTags = Engine_Api::_()->getDbtable('tags', 'core')->getTagsByTagger('classified', $owner);
    $this->view->userCategories = Engine_Api::_()->classified()->getUserCategories($owner->getIdentity());
  }

  public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireAuth()->setAuthParams('classified', null, 'create')->isValid()) return;
    $viewer = Engine_Api::_()->user()->getViewer();

    $this->view->navigation = $this->getNavigation();
    $this->view->form = $form = new Classified_Form_Create();
    // set up data needed to check quota
    $values['user_id'] = $viewer->getIdentity();
    $paginator = $this->_helper->api()->getApi('core', 'classified')->getClassifiedsPaginator($values);


    $this->view->quota = $quota = Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'classified', 'max');
    $this->view->current_count = $paginator->getTotalItemCount();


    // If not post or form not valid, return
    if( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) )
    {
      $table = Engine_Api::_()->getItemTable('classified');
      $db = $table->getAdapter();
      $db->beginTransaction();

      try
      {
        // Create classified
        $values = array_merge($form->getValues(), array(
          'owner_type' => $viewer->getType(),
          'owner_id' => $viewer->getIdentity(),
        ));

        $classified = $table->createRow();
        $classified->setFromArray($values);
        $classified->save();

        // Set photo
        if( !empty($values['photo']) ) {
          $classified->setPhoto($form->photo);
        }

        // Add tags
        $tags = preg_split('/[,]+/', $values['tags']);
        $tags = array_filter(array_map("trim", $tags));
        $classified->tags()->addTagMaps($viewer, $tags);


        $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($viewer, $classified, 'classified_new');
        if($action!=null){
          Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $classified);
        }
        
        $customfieldform = $form->getSubForm('customField');
        $customfieldform->setItem($classified);
        $customfieldform->saveValues();

        // CREATE AUTH STUFF HERE
        $auth = Engine_Api::_()->authorization()->context;
        $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');

        if($values['auth_view']) $auth_view =$values['auth_view'];
        else $auth_view = "everyone";
        $viewMax = array_search($auth_view, $roles);

        foreach( $roles as $i=>$role )
        {
          $auth->setAllowed($classified, $role, 'view', ($i <= $viewMax));
        }

        $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
        if($values['auth_comment']) $auth_comment =$values['auth_comment'];
        else $auth_comment = "everyone";
        $commentMax = array_search($values['auth_comment'], $roles);
        
        foreach ($roles as $i=>$role)
        {
          $auth->setAllowed($classified, $role, 'comment', ($i <= $commentMax));
        }

        // Commit
        $db->commit();
        

        // Redirect
        $allowed_upload = Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'classified', 'photo');

        if($allowed_upload){
          return $this->_helper->redirector->gotoRoute(array('classified_id'=>$classified->classified_id), 'classified_success', true);
        }
        else return $this->_redirect("classifieds/manage");
      }

      catch( Exception $e )
      {
        $db->rollBack();
        throw $e;
      }
    }
  }

  public function editAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $viewer = $this->_helper->api()->user()->getViewer();
    $this->view->classified = $classified = Engine_Api::_()->getItem('classified', $this->_getParam('classified_id'));
    if( !Engine_Api::_()->core()->hasSubject('classified') )
    {
      Engine_Api::_()->core()->setSubject($classified);
    }

    if( !$this->_helper->requireSubject()->isValid() ) return;

    // Backup
    if( $viewer->getIdentity() != $classified->owner_id && !$this->_helper->requireAuth()->setAuthParams($classified, null, 'edit')->isValid())
    {
      return $this->_forward('requireauth', 'error', 'core');
    }

    // Get navigation
    $navigation = $this->getNavigation(true);
    $this->view->navigation = $navigation;
    
    $this->view->form = $form = new Classified_Form_Edit(array(
      'item' => $classified
    ));
    
    $form->removeElement('photo');

    //die("<pre>".print_r($aliasValues->toArray(),true)."</pre>");
    //$customfieldform->getFieldsValuesByAlias($classified);
    
    $this->view->album = $album = $classified->getSingletonAlbum();
    $this->view->paginator = $paginator = $album->getCollectiblesPaginator();
    
    $paginator->setCurrentPageNumber($this->_getParam('page'));
    $paginator->setItemCountPerPage(100);
    
    foreach( $paginator as $photo )
    {
      $subform = new Classified_Form_Photo_Edit(array('elementsBelongTo' => $photo->getGuid()));
      $subform->removeElement('title');

      $subform->populate($photo->toArray());
      $form->addSubForm($subform, $photo->getGuid());
      $form->cover->addMultiOption($photo->getIdentity(), $photo->getIdentity());
    }
    // Save classified entry
    $saved = $this->_getParam('saved');
    if( !$this->getRequest()->isPost() || $saved )
    {

      if( $saved )
      {
        $url = $this->_helper->url->url(array('user_id' => $viewer->getIdentity(), 'classified_id' => $classified->getIdentity()), 'classified_entry_view');
        $savedChangesNotice = Zend_Registry::get('Zend_Translate')->_("Your changes were saved. Click %s to view your listing.",'<a href="'.$url.'">here</a>');
        $form->addNotice($savedChangesNotice);
      }

      // prepare tags
      $classifiedTags = $classified->tags()->getTagMaps();
      //$form->getSubForm('custom')->saveValues();
      
      $tagString = '';
      foreach( $classifiedTags as $tagmap )
      {
        if( $tagString !== '' ) $tagString .= ', ';
        $tagString .= $tagmap->getTag()->getTitle();
      }

      $this->view->tagNamePrepared = $tagString;
      $form->tags->setValue($tagString);

      // etc
      $form->populate($classified->toArray());
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      foreach( $roles as $role )
      {
        if( 1 === $auth->isAllowed($classified, $role, 'view') )
        {
          $form->auth_view->setValue($role);
        }
        if( 1 === $auth->isAllowed($classified, $role, 'comment') )
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

    // handle save for tags
    $values = $form->getValues();
    $tags = preg_split('/[,]+/', $values['tags']);
    $tags = array_filter(array_map("trim", $tags));

    $db = Engine_Db_Table::getDefaultAdapter();
    $db->beginTransaction();
    try
    {
      $classified->setFromArray($values);
      $classified->modified_date = date('Y-m-d H:i:s');

      $classified->tags()->setTagMaps($viewer, $tags);
      $classified->save();

      $cover = $values['cover'];

      // Process
      foreach( $paginator as $photo )
      {
        $subform = $form->getSubForm($photo->getGuid());
        $values = $subform->getValues();
        $values = $values[$photo->getGuid()];
        unset($values['photo_id']);

        if( isset($cover) && $cover == $photo->photo_id) {
          $classified->photo_id = $photo->file_id;
          $classified->save();
        }

        if( isset($values['delete']) && $values['delete'] == '1' )
        {
          if( $classified->photo_id == $photo->file_id ){
            $classified->photo_id = 0;
            $classified->save();
          }
          $photo->delete();
        }
        else
        {
          $photo->setFromArray($values);
          $photo->save();
        }
      }

      // Save custom fields
      $customfieldform = $form->getSubForm('customField');
      $customfieldform->setItem($classified);
      $customfieldform->saveValues();

      // CREATE AUTH STUFF HERE
      $auth = Engine_Api::_()->authorization()->context;
      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      if($values['auth_view']) $auth_view =$values['auth_view'];
      else $auth_view = "everyone";
      $viewMax = array_search($auth_view, $roles);
      foreach( $roles as $i=>$role )
      {
        $auth->setAllowed($classified, $role, 'view', ($i <= $viewMax));
      }

      $roles = array('owner', 'owner_member', 'owner_member_member', 'owner_network', 'everyone');
      if($values['auth_comment']) $auth_comment =$values['auth_comment'];
      else $auth_comment = "everyone";
      $commentMax = array_search($auth_comment, $roles);
      
      foreach ($roles as $i=>$role)
      {
        $auth->setAllowed($classified, $role, 'comment', ($i <= $commentMax));
      }
      // Rebuild privacy
      $actionTable = Engine_Api::_()->getDbtable('actions', 'activity');
      foreach( $actionTable->getActionsByObject($classified) as $action ) {
        $actionTable->resetActivityBindings($action);
      }
      $db->commit();

      return $this->_redirect("classifieds/manage");
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

    $this->view->navigation = $this->getNavigation();

    $viewer = $this->_helper->api()->user()->getViewer();
    $this->view->classified = $classified = Engine_Api::_()->getItem('classified', $this->_getParam('classified_id'));

    if( $viewer->getIdentity() != $classified->owner_id && !$this->_helper->requireAuth()->setAuthParams($classified, null, 'delete')->isValid())
    {
      return $this->_forward('requireauth', 'error', 'core');
    }

    if( $this->getRequest()->isPost() && $this->getRequest()->getPost('confirm') == true )
    {
      $this->view->classified->delete();
      return $this->_redirect("classifieds/manage");
    }
  }
  
  public function closeAction()
  {
    //if( !$this->_helper->requireSubject('group_topic')->isValid() ) return;
    if( !$this->_helper->requireUser()->isValid() ) return;

    $viewer = $this->_helper->api()->user()->getViewer();
    $classified = Engine_Api::_()->getItem('classified', $this->_getParam('classified_id'));

    if( $viewer->getIdentity() != $classified->owner_id && !$this->_helper->requireAuth()->setAuthParams($classified, null, 'edit')->isValid())
    {
      return $this->_forward('requireauth', 'error', 'core');
    }

    $table = $classified->getTable();
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $classified->closed = $this->_getParam('closed');
      $classified->save();

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }

    return $this->_redirect("classifieds/manage");
  }
  
  public function successAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;

    $this->view->navigation = $this->getNavigation();

    $viewer = $this->_helper->api()->user()->getViewer();
    $this->view->classified = $classified = Engine_Api::_()->getItem('classified', $this->_getParam('classified_id'));

    if( $viewer->getIdentity() != $classified->owner_id )
    {
      return $this->_forward('requireauth', 'error', 'core');
    }

    if( $this->getRequest()->isPost() && $this->getRequest()->getPost('confirm') == true )
    {
      return $this->_redirect("classifieds/photo/upload/subject/classified_".$this->_getParam('classified_id'));
    }
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
          'label' => Zend_Registry::get('Zend_Translate')->_('Browse Listings'),
          'route' => 'classified_browse',
          'module' => 'classified',
          'controller' => 'index',
          'action' => 'index'
        ));

        $navigation->addPage(array(
          'label' => Zend_Registry::get('Zend_Translate')->_('My Listings'),
          'route' => 'classified_manage',
          'module' => 'classified',
          'controller' => 'index',
          'action' => 'manage',
          'active' => $active
        ));
        if( $this->_helper->requireAuth()->setAuthParams('classified', null, 'create')->checkRequire()){
          $navigation->addPage(array(
            'label' => Zend_Registry::get('Zend_Translate')->_('Post a New Listing'),
            'route' => 'classified_create',
            'module' => 'classified',
            'controller' => 'index',
            'action' => 'create'
          ));
        }
      }
    }
    return $this->_navigation;
  }

  public function handleArchiveList($results)
  {
    $classified_dates = array();
    foreach ($results as $result)
      $classified_dates[] = strtotime($result->creation_date);

    // GEN ARCHIVE LIST
    $time = time();
    $archive_list = array();

    foreach( $classified_dates as $classified_date )
    {
      $ltime = localtime($classified_date, TRUE);
      $ltime["tm_mon"] = $ltime["tm_mon"] + 1;
      $ltime["tm_year"] = $ltime["tm_year"] + 1900;

      // LESS THAN A YEAR AGO - MONTHS
      if( $classified_date+31536000>$time )
      {
        $date_start = mktime(0, 0, 0, $ltime["tm_mon"], 1, $ltime["tm_year"]);
        $date_end = mktime(0, 0, 0, $ltime["tm_mon"]+1, 1, $ltime["tm_year"]);
        $label = date('F Y', $classified_date);
        $type = 'month';
      }

      // MORE THAN A YEAR AGO - YEARS
      else
      {
        $date_start = mktime(0, 0, 0, 1, 1, $ltime["tm_year"]);
        $date_end = mktime(0, 0, 0, 1, 1, $ltime["tm_year"]+1);
        $label = date('Y', $classified_date);
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

