<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 6072 2010-06-02 02:36:45Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Event_Form_Admin_Level extends Engine_Form
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
      ->setDescription('EVENT_FORM_ADMIN_LEVEL_DESCRIPTION');

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
      'label' => 'Allow Viewing of Events?',
      'description' => 'EVENT_FORM_ADMIN_LEVEL_VIEW_DESCRIPTION',
      'multiOptions' => array(
        0 => 'No, do not allow photo events to be viewed.',
        1 => 'Yes, allow viewing and subscription of photo events.',
        2 => 'Yes, allow members to view all events, even private ones.',
      ),
      'value' => 1,
    ));
    
    if (!$this->_public) 
    {
      $this->addElement('Radio', 'create', array(
        'label' => 'Allow Creation of Events?',
        'description' => 'EVENT_FORM_ADMIN_LEVEL_CREATE_DESCRIPTION',
        'multiOptions' => array(
          0 => 'No, do not allow events to be created.',
          1 => 'Yes, allow creation of events.'
        ),
        'value' => 1,
      ));

      $this->addElement('Radio', 'edit', array(
        'label' => 'Allow Editing of Events?',
        'description' => 'Do you want to let members edit and delete events?',
        'multiOptions' => array(
        0 => "No, do not allow events to be edited.",
        1 => "Yes, allow  members to edit their own events.",
        2 => "Yes, allow members to edit everyone's events.",

        ),
        'value' => 1,
      ));

      // PRIVACY ELEMENTS
      $this->addElement('MultiCheckbox', 'auth_view', array(
        'label' => 'Event Privacy',
        'description' => 'EVENT_FORM_ADMIN_LEVEL_AUTHVIEW_DESCRIPTION',
        'multiOptions' => array(
          'everyone' => 'Everyone',
          'registered' => 'Registered Members',
          'member' => "Event Members",
          'owner_member_member' => 'Friends of Friends',
          'owner_member' => 'Friends Only',
          'owner' => 'Just Me'
        )
      ));

      $this->addElement('MultiCheckbox', 'auth_comment', array(
        'label' => 'Event Posting Options',
        'description' => 'EVENT_FORM_ADMIN_LEVEL_AUTHCOMMENT_DESCRIPTION',
        'multiOptions' => array(
          'registered' => 'Registered Members',
          'member' => "Event Members",
          'owner_member_member' => 'Friends of Friends',
          'owner_member' => 'Friends Only',
          'owner' => 'Just Me'
        )
      ));

      $this->addElement('MultiCheckbox', 'auth_photo', array(
        'label' => 'Photo Upload Options',
        'description' => 'EVENT_FORM_ADMIN_LEVEL_AUTHUPHOTO_DESCRIPTION',
        'multiOptions' => array(
          'member' => 'All Members',
          'owner' => 'Just Me'
        )
      ));
    }
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Settings',
      'type' => 'submit',
      'ignore' => true
    ));

  }
}