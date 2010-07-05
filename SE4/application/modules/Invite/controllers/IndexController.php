<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: IndexController.php 6518 2010-06-23 01:22:43Z shaun $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @todo SignupController.php: integrate invite-only functionality (reject if invite code is bad)
 * @todo AdminController.php: add in stricter settings for admin level checking
 */
class Invite_IndexController extends Core_Controller_Action_Standard
{
  public function indexAction()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    if ($settings->getSetting('user.signup.inviteonly') == 1)
    {
      $this->_helper->requireAdmin();
    }

    // Make form
    $form = new Invite_Form_Invite();
    
    // Handling for users not logged in
    $this->_helper->requireUser()->isValid();
    
    if ( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) ) {
      $this->view->emails_sent = $form->sendInvites();
      $this->view->form = $form;
      return $this->render('sent');
    }
    $this->view->form = $form;
  }
}
