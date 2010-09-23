<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: PostController.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_PostController extends Core_Controller_Action_Standard
{
  public function init()
  {
    if( 0 !== ($post_id = (int) $this->_getParam('post_id')) &&
        null !== ($post = Engine_Api::_()->getItem('forum_post', $post_id)) )
    {
      Engine_Api::_()->core()->setSubject($post);
    }
    else if( 0 !== ($topic_id = (int) $this->_getParam('topic_id')) &&
        null !== ($topic = Engine_Api::_()->getItem('forum_topic', $topic_id)) )
    {
      Engine_Api::_()->core()->setSubject($topic);
    }
    $this->getRightSideContent();
  }

  public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject('forum_topic')->isValid() ) return;
    if (!$this->_helper->requireAuth()->setAuthParams('forum', null, 'create')->isValid()) return;

    $viewer = Engine_Api::_()->user()->getViewer();
    $this->view->topic = $topic = Engine_Api::_()->core()->getSubject();
    if ($topic->closed) return;

    $this->view->forum = $forum = $topic->getParent();
    $quote_id = $this->getRequest()->getParam('quote_id');
    $this->view->form = $form = new Forum_Form_Post_Create();
    if (!empty($quote_id)) 
    {
      $quote = Engine_Api::_()->getItem('forum_post', $quote_id);
      $form->body->setValue("<blockquote><strong>" . $quote->getOwner()->__toString() . " said:</strong><br />" . $quote->body . "</blockquote><br />");
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
    $table = Engine_Api::_()->getItemTable('forum_post');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $values = $form->getValues();
      $values['body'] = nl2br($values['body']);
      $values['user_id'] = $viewer->getIdentity();
      $values['topic_id'] = $topic->getIdentity();

      $post = $table->createRow();
      $post->setFromArray($values);
      $post->save();
      
      $topic->save();
      $forum->save();

      if ($values['photo'])
      {
        $post->setPhoto($form->photo);
      }

      $db->commit();

      return $this->_helper->redirector->gotoRoute(array('post_id'=>$post->getIdentity(), 'topic_id' => $topic->getIdentity()), 'forum_topic', true);
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
    if( !$this->_helper->requireSubject('forum_post')->isValid() ) return;

    $viewer = Engine_Api::_()->user()->getViewer();
    $post = Engine_Api::_()->core()->getSubject();
    $topic = $post->getParent();
    $this->view->form = $form = new Forum_Form_Post_Delete();
    
    if (!$this->_helper->requireAuth()->setAuthParams($post, null, 'delete')->isValid())
      return;

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $table = Engine_Api::_()->getItemTable('forum_post');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $post->delete();

      $db->commit();
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }

   $href = ( null === $topic ? $forum->getHref() : $topic->getHref() );
    return $this->_forward('success', 'utility', 'core', array(
      'closeSmoothbox' => true,
      'parentRedirect' => $href,
      'messages' => array(Zend_Registry::get('Zend_Translate')->_('Post deleted.')),
      'format' => 'smoothbox'
    ));

  }

  public function editAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    if( !$this->_helper->requireSubject('forum_post')->isValid() ) return;

    $viewer = Engine_Api::_()->user()->getViewer();
    $post = Engine_Api::_()->core()->getSubject();

    if (!$this->_helper->requireAuth()->setAuthParams($post, null, 'edit')->isValid())
      return;

    $this->view->form = $form = new Forum_Form_Post_Edit(array('post'=>$post));
    $form->body->setValue($post->body);
    $form->photo->setValue($post->file_id);   

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Process
    $table = Engine_Api::_()->getItemTable('forum_post');
    $db = $table->getAdapter();
    $db->beginTransaction();

    try
    {
      $values = $form->getValues();

      $post->body = $values['body'];
      $post->edit_id = $viewer->getIdentity();
      //DELETE photo here.
      if (!empty($values['photo_delete']) && $values['photo_delete'])
      {
        $post->deletePhoto();
      }
      if (!empty($values['photo'])) {
        $post->setPhoto($form->photo);
      }
      $post->save();

      $db->commit();

      return $this->_helper->redirector->gotoRoute(array('post_id'=>$post->getIdentity(), 'topic_id' => $post->getParent()->getIdentity()), 'forum_topic', true);
    }

    catch( Exception $e )
    {
      $db->rollBack();
      throw $e;
    }
  }
}