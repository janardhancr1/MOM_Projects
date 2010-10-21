<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: TopicController.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_TopicController extends Core_Controller_Action_Standard
{

  public function init()
  {
    if( 0 !== ($topic_id = (int) $this->_getParam('topic_id')) &&
        null !== ($topic = Engine_Api::_()->getItem('forum_topic', $topic_id)) )
    {
      Engine_Api::_()->core()->setSubject($topic);
    }

    else if( 0 !== ($forum_id = (int) $this->_getParam('forum_id')) &&
        null !== ($forum = Engine_Api::_()->getItem('forum_forum', $forum_id)) )
    {
      Engine_Api::_()->core()->setSubject($forum);
    }
    $this->getRightSideContent();
  }

  public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject('forum')->isValid() ) return;
    if (!$this->_helper->requireAuth()->setAuthParams('forum', null, 'create')->isValid()) return;

    $viewer = Engine_Api::_()->user()->getViewer();
    $forum = $this->view->forum = Engine_Api::_()->core()->getSubject();

    $this->view->form = $form = new Forum_Form_Topic_Create();
   
    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $table = Engine_Api::_()->getItemTable('forum_topic');
    $postTable = Engine_Api::_()->getItemTable('forum_post');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $values = $form->getValues();
      $values['user_id'] = $viewer->getIdentity();
      $values['forum_id'] = $forum->getIdentity();

      // Create topic
      $topic = $table->createRow();
      $topic->setFromArray($values);
      $topic->title = htmlspecialchars($values['title']);
      $topic->description = $values['body'];
      $topic->save();

      $values['topic_id'] = $topic->getIdentity();

      // Create post
      $post = $postTable->createRow();
      $post->setFromArray($values);
      $post->save();

      if( $values['photo'] )
      {
        $post->setPhoto($form->photo);
      }
      
      $auth = Engine_Api::_()->authorization()->context;
      $auth->setAllowed($topic, 'registered', 'create', true);

      $db->commit();

      return $this->_helper->redirector->gotoRoute(array('topic_id' => $topic->getIdentity()), 'forum_topic', true);
    }
    
    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }

  public function deleteAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams(Engine_Api::_()->core()->getSubject()->getParent(), null, 'moderate')->isValid() ) return;

    $viewer = Engine_Api::_()->user()->getViewer();
    $topic = Engine_Api::_()->core()->getSubject();
    $forum = $topic->getParent();
    $this->view->form = $form = new Forum_Form_Topic_Delete();

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $table = Engine_Api::_()->getItemTable('forum_topic');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $topic->delete();

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }

    return $this->_forward('success', 'utility', 'core', array(
      'messages' => array(Zend_Registry::get('Zend_Translate')->_('Topic deleted.')),
      'layout' => 'default-simple',
      'parentRedirect' => $forum->getHref(),
    ));
  }

  public function editAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject('forum_topic')->isValid() ) return;

    $viewer = Engine_Api::_()->user()->getViewer();
    $topic = Engine_Api::_()->core()->getSubject();

    $this->view->form = $form = new Forum_Form_Topic_Edit();

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $table = Engine_Api::_()->getItemTable('forum_topic');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $values = $form->getValues();

      $topic->setFromArray($values);
      $topic->save();

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }

  public function viewAction()
  {
    if (!$this->_helper->requireAuth()->setAuthParams('forum', null, 'view')->isValid()) return;
    if( !$this->_helper->requireSubject('forum_topic')->isValid() ) return;
    $settings = Engine_Api::_()->getApi('settings', 'core');

    $viewer = Engine_Api::_()->user()->getViewer();
    $this->view->post_id = $post_id = (int) $this->_getParam('post_id');

    $this->view->topic = $topic = Engine_Api::_()->core()->getSubject();
    $this->view->forum =  $forum = $topic->getParent();
    $this->view->decode_bbcode = $settings->getSetting('forum_bbcode');
    
    $this->view->can_moderate = $this->_helper->requireAuth->setAuthParams($forum, null, 'moderate')->checkRequire();
    $can_reply = $this->view->can_reply = $this->_helper->requireAuth->setAuthParams('forum', null, 'create')->checkRequire() && !$topic->closed;
    if($can_reply) {
      $form = $this->view->form = new Forum_Form_Post_Quick(array('topic_id'=>$topic->getIdentity()));
    }
    $table = Engine_Api::_()->getItemTable('forum_post');

    // Keep track of topic user views to show them which ones have new posts
    if( $viewer->getIdentity() )
    {
      $topic->registerView($viewer);
    }

    // Increment view count
    if( !$topic->getOwner()->isSelf($viewer) )
    {
      $topic->view_count++;
      $topic->save();
    }

    if (($this->getRequest()->getMethod() == "POST") && ($form->isValid($this->getRequest()->getPost())))
    {
      $db = $table->getAdapter();
      $db->beginTransaction();
      try
      {
        $values = $form->getValues();
        $values['body'] = nl2br($values['body']);
        $values['user_id'] = $viewer->getIdentity();
        $post = $table->createRow();
        $post->setFromArray($values);
        $post->topic_id = $topic->getIdentity();
        $post->save();
        $db->commit();
        $this->view->post_id = $post_id = $post->getIdentity();
        $form = $this->view->form = new Forum_Form_Post_Quick(array('topic_id'=>$topic->getIdentity()));
      }
      catch( Exception $e )
      {
        $db->rollBack();
        throw $e;
      }
    }
    
    $select = $topic->getChildrenSelect('forum_post', array('order'=>'post_id ASC'));
    $this->view->paginator = $paginator = Zend_Paginator::factory($select);
    $paginator->setItemCountPerPage($settings->getSetting('forum_topic_pagelength'));
    
    // Skip to page of specified post
    if( 0 !== $post_id &&
        null !== ($post = Engine_Api::_()->getItem('forum_post', $post_id)) )
    {
      $icpp = $paginator->getItemCountPerPage();
      $page = ceil(($post->getPostIndex() + 1) / $icpp);
      $paginator->setCurrentPageNumber($page);
    }
    // Use specified page
    else if( 0 !== ($page = (int) $this->_getParam('page')) )
    {      
      $paginator->setCurrentPageNumber($this->_getParam('page'));
    }
    $this->view->first_post = ($page < 2);

 }


 public function stickyAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams(Engine_Api::_()->core()->getSubject()->getParent(), null, 'moderate')->isValid() ) return;

    $topic = Engine_Api::_()->core()->getSubject();
    
    $table = $topic->getTable();
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $topic = Engine_Api::_()->core()->getSubject();
      $topic->sticky = ( null === $this->_getParam('sticky') ? !$topic->sticky : (bool) $this->_getParam('sticky') );
      $topic->save();

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }

    $this->_redirectCustom($topic);
  }

  public function closeAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams(Engine_Api::_()->core()->getSubject()->getParent(), null, 'moderate')->isValid() ) return;

    $topic = Engine_Api::_()->core()->getSubject();
    
    $table = $topic->getTable();
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $topic = Engine_Api::_()->core()->getSubject();
      $topic->closed = ( null === $this->_getParam('closed') ? !$topic->closed : (bool) $this->_getParam('closed') );
      $topic->save();

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }

    $this->_redirectCustom($topic);
  }

  public function renameAction()
  {
    if( !$this->_helper->requireAuth()->setAuthParams(Engine_Api::_()->core()->getSubject()->getParent(), null, 'moderate')->isValid() ) return;

    $topic = Engine_Api::_()->core()->getSubject();

    $this->view->form = $form = new Forum_Form_Topic_Rename();

    if( !$this->getRequest()->isPost() )
    {
      $form->title->setValue(htmlspecialchars_decode(($topic->title)));
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    $table = $topic->getTable();
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $title = htmlspecialchars($form->getValue('title'));
      $topic = Engine_Api::_()->core()->getSubject();
      $topic->title = $title;
      $topic->save();

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }

    return $this->_forward('success', 'utility', 'core', array(
      'messages' => array(Zend_Registry::get('Zend_Translate')->_('Topic renamed.')),
      'layout' => 'default-simple',
      'parentRefresh' => true,
    ));
  }


}