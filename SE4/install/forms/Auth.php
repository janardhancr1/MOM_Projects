<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Auth.php 6641 2010-06-30 01:22:51Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Install_Form_Auth extends Engine_Form
{
  public function init()
  {
    $this->addElement('Text', 'email', array(
      'label' => 'Email Address',
      'required' => true,
      'allowEmpty' => false,
    ));

    $this->addElement('Password', 'password', array(
      'label' => 'Password',
      'required' => true,
      'allowEmpty' => false,
    ));

    // Submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Continue',
      'type' => 'submit',
      'ignore' => true,
    ));
  }
}