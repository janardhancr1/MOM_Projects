<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: AdminSettingsController.php 6657 2010-07-01 01:38:38Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Activity_AdminSettingsController extends Core_Controller_Action_Admin
{
  public function generalAction()
  {
    $settings = Engine_Api::_()->getApi('settings', 'core');
    $this->view->form = $form = new Activity_Form_Admin_Settings_General();
    $values = $settings->activity;
    $form->populate($values); 
    // Process form
    if( $this->getRequest()->isPost() && $form->isValid($this->getRequest()->getPost()) )
    {
      $values = $form->getValues();
      $settings->activity = $values;
    }
  }
}