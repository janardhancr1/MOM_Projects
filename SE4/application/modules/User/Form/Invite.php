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
		$this->setTitle('Invite Moms that you Know to Join');
		
		$this->addElement('textarea', 'options', array(
        'label' => 'Email Address:',
        'style' => 'display:none;',
		));

		$this->addElement('textarea', 'message', array(
        'label' => 'Message:',
		'required' => true,
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

	public function validate()
	{
		// @todo find a better way to trick Zend_Form
		$options = array();
		foreach ($_POST['optionsArray'] as $option)
		if (strlen(trim($option)))
			$options[] = strip_tags(trim($option));
		//$max_options = Engine_Api::_()->getApi('settings', 'core')->getSetting('polls.maxOptions', 15);
		$max_options = 10;
		while (count($options) > $max_options)
		array_pop($options);

		if (count($options) < 1) {
			$this->setErrors(array('You must provide at least one Email Address.'));
			return false;
		}

		foreach($options as $key => $value)
		{
			$validator = new Zend_Validate_EmailAddress();
			if(!$validator->isValid($value)) {
				$this->setErrors(array('"'. $value .'" is not a valid Email Address.'));
				return false;
			}
		}
		
		return 1;
	}
}