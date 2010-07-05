<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 6509 2010-06-22 23:49:13Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Chat_Form_Admin_Settings_Level extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Member Level Settings')
      ->setDescription('CHAT_FORM_ADMIN_SETTINGS_LEVEL_DESCRIPTION')
      ;

    // prepare user levels
    $table = Engine_Api::_()->getDbtable('levels', 'authorization');
    $select = $table->select();
    $user_levels = $table->fetchAll($select);

    foreach ($user_levels as $user_level) {
      $levels_prepared[$user_level->level_id] = $user_level->getTitle();
    }

    // category field
    $this->addElement('Select', 'level_id', array(
      'label' => 'Member Level',
      'multiOptions' => $levels_prepared,
      'onchange' => 'javascript:fetchLevelSettings(this.value);',
      'ignore' => true,
    ));
    
    $this->addElement('Radio', 'chat', array(
      'label' => 'Enable chat?',
      'description' => 'Do you want to let users chat in the chat room?',
      'multiOptions' => array(
        '1' => 'Yes, enable chat.',
        '0' => 'No, do not enable chat.',
      ),
    ));
    
    $this->addElement('Radio', 'im', array(
      'label' => 'Enable IM?',
      'description' => 'Do you want to let users have private conversations (IM)?',
      'multiOptions' => array(
        '1' => 'Yes, enable IM.',
        '0' => 'No, do not enable IM.',
      ),
    ));
    
    // Add submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));
  }
}