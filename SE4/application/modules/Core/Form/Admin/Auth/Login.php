<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Login.php 6680 2010-07-01 22:28:47Z steve $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Admin_Auth_Login extends Engine_Form
{
  public function init()
  {
    $this->setTitle('Admin Sign In');
    switch (Engine_Api::_()->getApi('settings', 'core')->core_admin_mode) {
      case 'global':
        $this->setDescription('Please enter the admin password.');
        break;
      case 'user':
        $this->setDescription('Please enter your password again.');
        break;
      case 'none':
      default;
        // form should not be shown
    }

    $this->addElement('Password', 'password', array(
      'label' => 'Password',
      'required' => true,
      'allowEmpty' => false,
    ));

    $this->addElement('Button', 'execute', array(
      'type' => 'submit',
      'label' => 'Sign In',
    ));
  }
}