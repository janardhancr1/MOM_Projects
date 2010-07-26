<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Music
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Global.php 6588 2010-06-25 02:40:45Z steve $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Music
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Answer_Form_Admin_Global extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Global Settings')
      ->setDescription('These settings affect all members in your community.');


    $this->addElement('Radio', 'answer_public', array(
      'label' => 'Public Permissions',
      'description' => 'ANSWER_FORM_ADMIN_GLOBAL_ANSWERPUBLIC_DESCRIPTION',
      'multiOptions' => array(
        1 => 'Yes, the public can view questions unless they are made private.',
        0 => 'No, the public cannot view questions.'
      ),
      'value' => 1,
    ));

    $this->addElement('Text', 'perPage', array(
      'label' => 'answers Per Page',
      'description' => 'How many recipes will be shown per page? (Enter a number between 1 and 999)',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.perPage', 10),
    ));

    /*$this->addElement('Text', 'maxOptions', array(
      'label' => 'Maximum Options',
      'description' => 'How many possible answere answers do you want to permit?',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.maxOptions', 15),
    ));*/

    /*$this->addElement('Radio', 'canChangeVote', array(
      'label' => 'Change Vote?',
      'description' => 'Do you want to permit your members to change their vote?',
      'multiOptions' => array(
        1 => 'Yes, members can change their vote.',
        0 => 'No, members cannot change their vote.',
      ),
      'value' => (int) Engine_Api::_()->getApi('settings', 'core')->getSetting('recipe.canChangeVote', false),
    ));*/


    // Add submit button
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true
    ));
  }

  public function saveValues()
  {
    $values   = $this->getValues();
    $settings = Engine_Api::_()->getApi('settings', 'core');

   // $settings->recipe_canChangeVote = (bool) $values['canChangeVote'];

    if (!is_numeric($values['perPage'])
            || 0 >= $values['perPage']
            || 999 < $values['perPage'])
      $values['perPage'] = 10;
    $settings->recipe_perPage = $values['perPage'];

    /*if (!is_numeric($values['maxOptions'])
            || 0 >= $values['maxOptions']
            || 999 < $values['maxOptions'])
      $values['maxOptions'] = 15;
    $settings->recipe_maxOptions = $values['maxOptions'];*/
    
  }
}