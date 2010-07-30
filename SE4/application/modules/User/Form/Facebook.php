<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Login.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_Form_Facebook extends Engine_Form
{
  public function init()
  {
  		$this->setTitle('Choose and Confirm your details');
  		
  		// Init email
	    $this->addElement('Text', 'email', array(
	      'label' => 'Email Address',
	      'description' => 'You will use your email address to login.',
	      'required' => true,
	      'allowEmpty' => false,
	      'validators' => array(
	        array('NotEmpty', true),
	        array('EmailAddress', true),
	        array('Db_NoRecordExists', true, array(Engine_Db_Table::getTablePrefix().'users', 'email'))
	      )));
  }
}