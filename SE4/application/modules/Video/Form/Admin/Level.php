<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 5935 2010-05-21 01:35:38Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Video_Form_Admin_Level extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Member Level Settings')
      ->setDescription('These settings are applied on a per member level basis. Start by selecting the member level you want to modify, then adjust the settings for that level below.');

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
      'label' => 'Allow Viewing of Videos?',
      'description' => 'Do you want to let members view videos? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow videos to be viewed.',
        1 => 'Yes, allow viewing of videos.',
        2 => 'Yes, allow viewing of all videos, even private ones.'
      ),
      'value' => 1,
    ));

    $this->addElement('Radio', 'edit', array(
      'label' => 'Allow Editing of Videos?',
      'description' => 'Do you want to let members edit videos? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow members to edit their videos.',
        1 => 'Yes, allow members to edit their own videos.',
        2 => 'Yes, allow members to edit all videos.'
      ),
      'value' => 1,
    ));

    $this->addElement('Radio', 'delete', array(
      'label' => 'Allow Deletion of Videos?',
      'description' => 'Do you want to let members delete videos? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow members to delete their videos.',
        1 => 'Yes, allow members to delete their own videos.',
        2 => 'Yes, allow members to delete all videos.'
      ),
      'value' => 1,
    ));
    
    $this->addElement('Radio', 'create', array(
      'label' => 'Allow Creation of Videos?',
      'description' => 'Do you want to let members create videos? If set to no, some other settings on this page may not apply. This is useful if you want members to be able to view videos, but only want certain levels to be able to create videos.',
      'multiOptions' => array(
        1 => 'Yes, allow creation of videos.',
        0 => ' 	No, do not allow video to be created.'
      ),
      'value' => 1,
    ));

    $this->addElement('Radio', 'upload', array(
      'label' => 'Allow Video Upload?',
      'description' => 'Do you want to let members to upload their own videos? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        1 => 'Yes, allow video uploads.',
        0 => ' 	No, do not allow video uploads.'
      ),
      'value' => 1,
    ));

    // PRIVACY ELEMENTS
    $this->addElement('MultiCheckbox', 'auth_view', array(
      'label' => 'Video Privacy',
      'description' => 'Your members can choose from any of the options checked below when they decide who can see their video. If you do not check any options, everyone will be allowed to view videos.',
      'multiOptions' => array(
        'everyone'       => 'Everyone',
        'owner_network' => 'Friends and Networks',
        'owner_member_member'  => 'Friends of Friends',
        'owner_member'         => 'Friends Only',
        'owner'          => 'Just Me'
      ),
      'value' => array('everyone', 'owner_network','owner_member_member', 'owner_member', 'owner')
    ));

    $this->addElement('MultiCheckbox', 'auth_comment', array(
      'label' => 'Video Comment Options',
      'description' => 'Your members can choose from any of the options checked below when they decide who can post comments on their video. If you do not check any options, everyone will be allowed to post comments on media. ',
      'multiOptions' => array(
        'everyone'       => 'Everyone',
        'owner_network' => 'Friends and Networks',
        'owner_member_member'  => 'Friends of Friends',
        'owner_member'         => 'Friends Only',
        'owner'          => 'Just Me'
      ),
      'value' => array('everyone', 'owner_network','owner_member_member', 'owner_member', 'owner')
    ));

   
    $this->addElement('Text', 'max', array(
      'label' => 'Maximum Allowed Videos',
      'description' => 'Enter the maximum number of allowed videos. The field must contain an integer between 1 and 999.'
    ));

    $this->addElement('Button', 'submit', array(
      'label' => 'Save Settings',
      'type' => 'submit',
      'ignore' => true
    ));

  }
}