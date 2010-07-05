<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: HelpController.php 6630 2010-06-29 20:14:54Z steve $
 * @author     Alex
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_HelpController extends Core_Controller_Action_Standard
{


  public function contactAction(){
    $translate        = Zend_Registry::get('Zend_Translate');
    $this->view->form = $form = new Core_Form_Contact();

    if( !$this->getRequest()->isPost() )
    {
      return;
    }

    if( !$form->isValid($this->getRequest()->getPost()) )
    {
      return;
    }

    // Success! Process

    // Mail gets logged into database, so perform try/catch in this Controller
    $db = Engine_Db_Table::getDefaultAdapter();
    $db->beginTransaction();
    try {
      // the contact form is emailed to the first SuperAdmin by default
      $users_table  = Engine_Api::_()->getDbtable('users', 'user');
      $users_select = $users_table->select()
        ->where('level_id = ?', 1)
        ->where('enabled >= ?', 1);
      $super_admin  = $users_table->fetchRow($users_select);

      $values        = $form->getValues();
      $mail_settings = array(
        'name'    => $values['name'],
        'email'   => $values['email'],
        'message' => $values['body'],
        );
      
      // send email
      Engine_Api::_()->getApi('mail', 'core')->sendSystem(
        $super_admin->email,
        'core_contact',
        $mail_settings);

      // if the above did not throw an exception, it succeeded
      $db->commit();
      $this->view->status  = true;
      $this->view->message = $translate->_('Thank you for contacting us!');
    } catch ( Zend_Mail_Transport_Exception $e) {
      $db->rollBack();
      throw $e;
    }
  }



  public function termsAction()
  {
    // to change, edit language variable "_CORE_TERMS_OF_SERVICE"
  }

  public function privacyAction()
  {
    // to change, edit language variable "_CORE_PRIVACY_STATEMENT"
  }
}