<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminLevelController.php 6657 2010-07-01 01:38:38Z john $
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
    $level_id = $this->_getParam('level_id');

    // Make navigation
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('forum_admin_main', array(), 'forum_admin_main_level');

    // Make form
    $this->view->form = $form = new Forum_Form_Admin_Level(array('public'=>($level_id == 5)));

    if( !$this->getRequest()->isPost() )
    {
      if( null !== ($level_id = $this->_getParam('level_id')) )
      {
        $permissionTable = $this->_helper->api()->getDbtable('permissions', 'authorization');
        $form->populate($permissionTable->getAllowed('forum', $level_id, array_keys($form->getValues())));
      }

      return;
    }

    // Process form
    if( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) )
    {
      $level_id = $this->_getParam('level_id');
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