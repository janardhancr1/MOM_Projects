<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 6072 2010-06-02 02:36:45Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Classified_Form_Admin_Level extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Member Level Settings')
      ->setDescription("CLASSIFIED_FORM_ADMIN_LEVEL_DESCRIPTION");

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
      'onchange' => 'javascript:fetchLevelSettings(this.value);'
    ));

    $this->addElement('Radio', 'view', array(
      'label' => 'Allow Viewing of Classifieds?',
      'description' => 'Do you want to let members view classifieds? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow classifieds to be viewed.',
        1 => 'Yes, allow viewing of classifieds.',
        2 => 'Yes, allow viewing of all classifieds, even private ones.'
      ),
      'value' => 1,
    ));

    $this->addElement('Radio', 'edit', array(
      'label' => 'Allow Editing of Classifieds?',
      'description' => 'Do you want to let members edit classifieds? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow members to edit their classifieds.',
        1 => 'Yes, allow members to edit their own classifieds.',
        2 => 'Yes, allow members to edit all classifieds.'
      ),
      'value' => 1,
    ));

    $this->addElement('Radio', 'delete', array(
      'label' => 'Allow Deletion of Classifieds?',
      'description' => 'Do you want to let members delete classifieds? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow members to delete their classifieds.',
        1 => 'Yes, allow members to delete their own classifieds.',
        2 => 'Yes, allow members to delete all classifieds.'
      ),
      'value' => 1,
    ));

    $this->addElement('Radio', 'create', array(
      'label' => 'Allow Creation of Classifieds?',
      'description' => 'CLASSIFIED_FORM_ADMIN_LEVEL_CREATE_DESCRIPTION',
      'multiOptions' => array(
        1 => 'Yes, allow creation of classifieds.',
        0 => 'No, do not allow classifieds to be created.'
      ),
      'value' => 1,
    ));

    $this->addElement('Radio', 'photo', array(
      'label' => 'Allow Uploading of Photos?',
      'description' => 'Do you want to let members upload photos to a classified listing? If set to no, the option to upload photos will not appear.',
      'multiOptions' => array(
        1 => 'Yes, allow photo uploading to classifieds.',
        0 => 'No, do not allow photo uploading.'
      ),
      'value' => 1,
    ));
    
    // PRIVACY ELEMENTS
    $this->addElement('MultiCheckbox', 'auth_view', array(
      'label' => 'Classifieds Listing Privacy',
      'description' => 'CLASSIFIED_FORM_ADMIN_LEVEL_AUTHVIEW_DESCRIPTION',
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
      'label' => 'Classified Comment Options',
      'description' => 'CLASSIFIED_FORM_ADMIN_LEVEL_AUTHCOMMENT_DESCRIPTION',
      'description' => '',
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
      'label' => 'Maximum Allowed Classifieds',
      'description' => 'Enter the maximum number of allowed classifieds. The field must contain an integer between 1 and 999.'
    ));

    $this->addElement('Button', 'submit', array(
      'label' => 'Save Settings',
      'type' => 'submit',
    ));

  }
}