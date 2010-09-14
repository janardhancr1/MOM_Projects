<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminLevelController.php 7244 2010-09-01 01:49:53Z john $
 * @author     Sami
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_AdminLevelController extends Core_Controller_Action_Admin
{
  public function indexAction()
  {
    // Get level id
    if( null !== ($id = $this->_getParam('id')) ) {
      $level = Engine_Api::_()->getItem('authorization_level', $id);
    } else {
      $level = Engine_Api::_()->getItemTable('authorization_level')->getDefaultLevel();
    }
    $level_id = $level->level_id;

    // Make navigation
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('forum_admin_main', array(), 'forum_admin_main_level');

    // Make form
    $this->view->form = $form = new Forum_Form_Admin_Settings_Level(array(
      'public' => ( in_array($level->type, array('public')) ),
      'moderator' => ( in_array($level->type, array('admin', 'moderator')) ),
    ));
    $form->level_id->setValue($level_id);

    if( !$this->getRequest()->isPost() )
    {
      $permissionTable = $this->_helper->api()->getDbtable('permissions', 'authorization');
      $form->populate($permissionTable->getAllowed('forum', $level_id, array_keys($form->getValues())));
      $form->level_id->setValue($level_id);
      return;
    }

    // Process form
    if( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) )
    {
      $values = $form->getValues();
      $permissionTable = $this->_helper->api()->getDbtable('permissions', 'authorization');
      
      $db = $permissionTable->getAdapter();
      $db->beginTransaction();

      try
      {
        // Set permissions
        $permissionTable->setAllowed('forum', $level_id, $values);

        // Commit
        $db->commit();
      }

      catch( Exception $e )
      {
        $db->rollBack();
        throw $e;
      }
    }
  }
}