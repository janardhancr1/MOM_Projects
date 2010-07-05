<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Messages
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminSettingsController.php 6519 2010-06-23 01:41:45Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Messages
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Messages_AdminSettingsController extends Core_Controller_Action_Admin
{
  public function levelAction()
  {
    // Get level id
    $id = $this->_getParam('id', null);

    // Make navigation
    $this->view->navigation = $navigation = $this->_helper->api()
      ->getApi('menus', 'core')
      ->getNavigation('core_admin_levels', array('params' => array('id' => $id)));

    // Make form
    $this->view->form = $form = new Messages_Form_Admin_Level();
    $form->level_id->setValue($id);

    // Process form
    if( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) )
    {

    }
  }
}