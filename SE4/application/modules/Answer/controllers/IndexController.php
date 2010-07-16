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
     $this->view->form = $form = new Answer_Form_Search();
     $this->view->form1 = $form1 = new Answer_Form_Create();

     if ( $this->getRequest()->isPost() && $this->view->form1->isValid($this->getRequest()->getPost()) ) {
      $db = Engine_Api::_()->getDbTable('answers', 'answer')->getAdapter();
      $db->beginTransaction();
      try {
        $answer_id    = $this->view->form1->save();
        if (empty($answer_id))
          return;
        $values = $this->view->form1->getValues();

        $row        = Engine_Api::_()->getItem('recipe', $answer_id);
        //$attachment = Engine_Api::_()->getItem($row->getType(), $answer_id);
        $db->commit();
      }
     catch (Exception $e) {
        $db->rollback();
        throw $e;
      }
     }
  }
 

  public function createAction()
  {
    if( !$this->_helper->requireUser()->isValid() ) return;
    
   
    $this->view->form = $form = new Answer_Form_Create();
            
 	 if ( $this->getRequest()->isPost() && $this->view->form->isValid($this->getRequest()->getPost()) ) {
      $db = Engine_Api::_()->getDbTable('answers', 'answer')->getAdapter();
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


}

