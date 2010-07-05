<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 6491 2010-06-22 22:06:57Z jung $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Form_Admin_Level extends Engine_Form
{

  protected $_public;

  public function setPublic($public)
  {
    $this->_public = $public;
  }

  public function init()
  {
    $this
      ->setTitle('Member Level Settings')
      ->setDescription('FORUM_FORM_ADMIN_LEVEL_DESCRIPTION');

    $this->loadDefaultDecorators();
    $this->getDecorator('Description')->setOptions(array('tag' => 'h4', 'placement' => 'PREPEND'));

    // prepare user levels
    $table = Engine_Api::_()->getDbtable('levels', 'authorization');
    $select = $table->select();
    $user_levels = $table->fetchAll($select);
    
    foreach ($user_levels as $user_level){
      $levels_prepared[$user_level->level_id]= $user_level->getTitle();
    }

    
    // category field
    $this->addElement('Select', 'level_id', array(
          'label' => 'Member Level',
          'multiOptions' => $levels_prepared,
          'onchange' => 'javascript:fetchLevelSettings(this.value);',
          'ignore' => true
        ));

    $this->addElement('Radio', 'view', array(
      'label' => 'Allow Viewing of Forums?',
      'description' => 'FORUM_FORM_ADMIN_LEVEL_VIEW_DESCRIPTION',
      'value' => 1,
      'multiOptions' => array(
        1 => 'Yes, allow viewing and subscription of forums.',
        0 => 'No, do not allow forum to be viewed or subscribed to.'
      )
    ));
    if (!$this->_public) {
    
    $this->addElement('Radio', 'create', array(
      'label' => 'Allow Posting?',
      'description' => 'FORUM_FORM_ADMIN_LEVEL_CREATE_DESCRIPTION',
      'value' => 1,
      'multiOptions' => array(
        1 => 'Yes, allow posting to forums.',
        0 => 'No, do not allow forum posts.'
      )
    ));

    $this->addElement('Radio', 'moderate', array(
      'label' => 'Allow Moderation?',
      'description' => 'FORUM_FORM_ADMIN_LEVEL_MODERATE_DESCRIPTION',
      'value' => 0,
      'multiOptions' => array(
        2 => 'Yes, allow moderation.',
        0 => 'No, do not allow moderation.'
      )
    ));

    $this->addElement('Text', 'commentHtml', array(
      'label' => 'Allow HTML in posts?',
      'description' => 'FORUM_FORM_ADMIN_LEVEL_CONTENTHTML_DESCRIPTION'
    ));

    }
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Settings',
      'type' => 'submit',
    ));

  }
}