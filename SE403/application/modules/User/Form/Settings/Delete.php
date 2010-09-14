<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Delete.php 7244 2010-09-01 01:49:53Z john $
 * @author     Steve
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_Form_Settings_Delete extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Delete Account')
      ->setDescription('Are you sure you want to delete your account? Any content '.
        'you\'ve uploaded in the past will be permanently deleted. You will be '.
        'immediately signed out and will no longer be able to sign in with this account.')
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array()))
      ;

    // Init hash
    $this->addElement('Hash', 'token');
    
    // Init delete + cancel
    $this->addElement('Button', 'submit', array(
      'label' => 'Yes, Delete My Account',
      'type' => 'submit',
      'style' => 'color:#D12F19;',
      'ignore' => true,
      'decorators' => array(array('ViewScript', array(
        'viewScript' => '_formButtonCancel.tpl',
        'class' => 'form element'
      ))),
      //'decorators' => array(
      //  'ViewHelper',
      //)
    ));

    // Init cancel
    /*
    $this->addElement('Button', 'cancel', array(
      'label' => 'Cancel',
      'ignore' => true,
      'onclick' => 'window.location.href="'.Zend_Controller_Front::getInstance()->getRouter()->assemble(array('controller' => 'settings', 'action' => 'general'), 'user_extended', true).'"',
      'suffix' => '<b>cancel</b>',
      //'decorators' => array(
      //  'ViewHelper',
      //)
    ));
    
    // Cancel v2
    $this->addElement('Button', 'cancel', array(
      'label' => false,
      'type' => 'submit',
      'onclick' => 'window.location.href="'.Zend_Controller_Front::getInstance()->getRouter()->assemble(array('controller' => 'settings', 'action' => 'general'), 'user_extended', true).'"',
      'decorators' => array(array('ViewScript', array(
        'viewScript' => '_formButtonCancel.tpl',
        'class' => 'form element'
      )))
    ));
    */

    // DG buttons
    $this->addDisplayGroup(array(
      'submit',
      'cancel',
    ), 'buttons');
    
    return $this;
  }
}