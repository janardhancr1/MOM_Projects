<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Reset.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_Form_Auth_Reset extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Reset password?');

    // init password
    $this->addElement('Password', 'password', array(
      'label' => 'New Password',
      'required' => true,
      'allowEmpty' => false,
      'validators' => array(
        array('NotEmpty', true),
        array('StringLength', true, array(6, 32)),
      ),
      'tabindex' => 1,
    ));

    // init password_confirm
    $this->addElement('Password', 'password_confirm', array(
      'label' => 'Confirm New Password',
      'required' => true,
      'allowEmpty' => false,
      'tabindex' => 2,
    ));

    // Init submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Reset Password',
      'type' => 'submit',
      'ignore' => true,
      'tabindex' => 3,
    ));
  }
}