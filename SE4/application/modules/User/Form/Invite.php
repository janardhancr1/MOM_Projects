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
class User_Form_Invite extends Engine_Form
{
	public function init()
	{
		$this->addElement('textarea', 'options', array(
        'label' => 'Email Address:',
        'style' => 'display:none;',
      ));
      
      $this->addElement('textarea', 'message', array(
        'label' => 'Message:',
        'filters' => array(
          'StripTags',
          new Engine_Filter_Censor(),
          new Engine_Filter_StringLength(array('max' => '400'))
        ),
      ));
      
      $this->addElement('button', 'submit', array(
        'label' => 'Send Invite',
        'type' => 'submit'
      ));
	}
}