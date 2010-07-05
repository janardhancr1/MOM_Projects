<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Invite.php 6512 2010-06-23 00:27:01Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Event_Form_Invite extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Invite Members')
      ->setDescription('Choose the people you want to invite to this event.')
      ->setAttrib('id', 'event_form_invite')
      ;

    $this->addElement('Checkbox', 'all', array(
      'id' => 'selectall',
      'label' => 'Choose All Friends',
      'ignore' => true
    ));

    $this->addElement('MultiCheckbox', 'users', array(
      'label' => 'Members',
      'required' => true,
      'allowEmpty' => 'false',
    ));

    $this->addElement('Button', 'submit', array(
      'label' => 'Send Invites',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array(
        'ViewHelper',
      ),
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'cancel',
      'link' => true,
      'prependText' => ' or ',
      'onclick' => 'parent.Smoothbox.close();',
      'decorators' => array(
        'ViewHelper',
      ),
    ));

    $this->addDisplayGroup(array('submit', 'cancel'), 'buttons');
  }
}