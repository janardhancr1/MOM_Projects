<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 6072 2010-06-02 02:36:45Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Album
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Album_Form_Admin_Level extends Engine_Form
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
      ->setDescription('ALBUM_FORM_ADMIN_LEVEL_DESCRIPTION');

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
          'label' => 'Select Member Level',
          'multiOptions' => $levels_prepared,
          'onchange' => 'javascript:fetchLevelSettings(this.value);'
        ));

    $this->addElement('Radio', 'view', array(
      'label' => 'Allow Viewing of Photo Albums?',
      'description' => 'ALBUM_FORM_ADMIN_LEVEL_VIEW_DESCRIPTION',
      'multiOptions' => array(
        2 => 'Yes, allow members to view all albums, even private ones.',
        1 => 'Yes, allow viewing and subscription of photo albums.',
        0 => 'No, do not allow photo albums to be viewed.'
      )
    ));

    if (!$this->_public) 
    {
      $this->addElement('Radio', 'create', array(
        'label' => 'Allow Creation of Photo Albums?',
        'description' => 'ALBUM_FORM_ADMIN_LEVEL_CREATE_DESCRIPTION',
        'value' => 1,
        'multiOptions' => array(
          2 => 'Yes, allow creation of photo albums.',
          0 => 'No, do not allow photo album to be created.'
        )
      ));

      $this->addElement('Radio', 'edit', array(
        'label' => 'Allow Editing of Photo Albums?',
        'description' => 'Do you want to let members of this level edit photo albums?',
        'multiOptions' => array(
          0 => 'No, do not allow photo album to be edited.',
          1 => 'Yes, allow members to edit their own albums.',
          2 => 'Yes, allow members to edit all albums.'
        )
      ));


    // PRIVACY ELEMENTS
    $this->addElement('MultiCheckbox', 'auth_view', array(
      'label' => 'Album Privacy',
      'description' => 'ALBUM_FORM_ADMIN_LEVEL_AUTHVIEW_DESCRIPTION',
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
      'label' => 'Album Comment Options',
      'description' => 'ALBUM_FORM_ADMIN_LEVEL_AUTHCOMMENT_DESCRIPTION',
      'multiOptions' => array(
        'everyone'       => 'Everyone',
        'owner_network' => 'Friends and Networks',
        'owner_member_member'  => 'Friends of Friends',
        'owner_member'         => 'Friends Only',
        'owner'          => 'Just Me'
      ),
      'value' => array('everyone', 'owner_network','owner_member_member', 'owner_member', 'owner')
    ));

    $this->addElement('MultiCheckbox', 'auth_tag', array(
      'label' => 'Album Tag Options',
      'description' => 'ALBUM_FORM_ADMIN_LEVEL_AUTHTAG_DESCRIPTION',
      'multiOptions' => array(
        'everyone'       => 'Everyone',
        'owner_network' => 'Friends and Networks',
        'owner_member_member'  => 'Friends of Friends',
        'owner_member'         => 'Friends Only',
        'owner'          => 'Just Me'
      ),
      'value' => array('everyone', 'owner_network','owner_member_member', 'owner_member', 'owner')
    ));


      $this->addElement('Button', 'submit', array(
        'label' => 'Save Changes',
        'type' => 'submit',
      ));
    }
  }
}