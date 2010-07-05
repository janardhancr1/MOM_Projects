<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Edit.php 6626 2010-06-29 02:19:32Z jung $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Authorization_Form_Admin_Level_Edit extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Member Level Settings')
      ->setDescription("AUTHORIZATION_FORM_ADMIN_LEVEL_EDIT_DESCRIPTION");

    $this->loadDefaultDecorators();
    $this->getDecorator('Description')->setOptions(array('tag' => 'h4', 'placement' => 'PREPEND'));
    
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
    
    $this->addElement('Text', 'title', array(
      'label' => 'Title',
      'allowEmpty' => false,
      'required' => true,
    ));
    /*
    $this->addElement('Textarea', 'description', array(
      'label' => 'Description',
      'allowEmpty' => true,
      'required' => false,
    ));
    */
    $this->addElement('Radio', 'style', array(
      'label' => 'Allow Profile Style',
      'required' => true,
      'multiOptions' => array(
        1 => 'Yes, allow custom profile styles.',
        0 => 'No, do not allow custom profile styles.'
      ),
      'value' => 1
    ));

    $this->addElement('Radio', 'edit', array(
      'label' => 'Allow Profile Moderation',
      'required' => true,
      'multiOptions' => array(
        2 => 'Yes, allow members in this level to edit other profiles and settings.',
        1 => 'No, do not allow moderation.'
      ),
      'value' => 0
    ));
    
    $this->addElement('Radio', 'activity', array(
      'label' => 'Allow Activity Feed Moderation',
      'required' => true,
      'multiOptions' => array(
        1 => 'Yes, allow members in this level to delete any feed item.',
        0 => 'No, do not allow moderation.'
      ),
      'value' => 0
    ));

    $this->addElement('Text', 'commenthtml', array(
      'label' => 'Allow HTML in Comments?',
      'description' => 'CORE_FORM_ADMIN_SETTINGS_GENERAL_COMMENTHTML_DESCRIPTION'
    ));


    // Add block
    $this->addElement('Radio', 'block', array(
      'label' => 'Allow Blocking?',
      'description' => 'USER_FORM_ADMIN_SETTINGS_LEVEL_BLOCK_DESCRIPTION',
      'multiOptions' => array(
        1 => 'Yes',
        0 => 'No'
      )
    ));
    $this->block->getDecorator('Description')->setOption('placement', 'PREPEND');

    // Add search
    $this->addElement('Radio', 'search', array(
      'label' => 'Search Privacy Options',
      'description' => 'USER_FORM_ADMIN_SETTINGS_LEVEL_SEARCH_DESCRIPTION',
      'multiOptions' => array(
        1 => 'Yes',
        0 => 'No'
      ),
    ));
    $this->search->getDecorator('Description')->setOption('placement', 'PREPEND');

    // Add view
    $this->addElement('MultiCheckbox', 'auth_view', array(
      'label' => 'Profile Viewing Options',
      'description' => 'USER_FORM_ADMIN_SETTINGS_LEVEL_AUTHVIEW_DESCRIPTION',
      'multiOptions' => array(
        'everyone' => 'Everyone',
        'registered' => 'All Registered Members',
        'network' => 'My Network',
        'member' => 'My Friends',
        'owner' => 'Only Me',
      ),
    ));
    $this->auth_view->getDecorator('Description')->setOption('placement', 'PREPEND');


    // Add comment
    $this->addElement('MultiCheckbox', 'auth_comment', array(
      'label' => 'Profile Commenting Options',
      'description' => 'USER_FORM_ADMIN_SETTINGS_LEVEL_AUTHCOMMENT_DESCRIPTION',
      'multiOptions' => array(
        'everyone' => 'Everyone',
        'registered' => 'All Registered Members',
        'network' => 'My Network',
        'member' => 'My Friends',
        'owner' => 'Only Me',
      )
    ));
    $this->auth_comment->getDecorator('Description')->setOption('placement', 'PREPEND');


    // Add status
    $this->addElement('Radio', 'status', array(
      'label' => 'Allow status messages?',
      'description' => 'USER_FORM_ADMIN_SETTINGS_LEVEL_STATUS_DESCRIPTION',
      'multiOptions' => array(
        1 => 'Yes',
        0 => 'No'
      )
    ));

    // Add username
    $this->addElement('Radio', 'username', array(
      'label' => 'Allow username changes?',
      'description' => 'USER_FORM_ADMIN_SETTINGS_LEVEL_USERNAME_DESCRIPTION',
      'multiOptions' => array(
        1 => 'Yes',
        0 => 'No'
      )
    ));
    $this->username->getDecorator('Description')->setOption('placement', 'PREPEND');


    // Add delete
    $this->addElement('Radio', 'delete', array(
      'label' => 'Allow account deletion?',
      'description' => 'If set to "yes", members will have the option of deleting their accounts.',
      'multiOptions' => array(
        1 => 'Yes',
        0 => 'No'
      )
    ));
    $this->delete->getDecorator('Description')->setOption('placement', 'PREPEND');


    // Add submit
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true,
    ));

    }
}