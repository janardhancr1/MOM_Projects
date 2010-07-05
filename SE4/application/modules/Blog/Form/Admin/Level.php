<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 5935 2010-05-21 01:35:38Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Blog_Form_Admin_Level extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Member Level Settings')
      ->setDescription("BLOG_FORM_ADMIN_LEVEL_DESCRIPTION");

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
      'label' => 'Allow Viewing of Blogs?',
      'description' => 'Do you want to let members view blogs? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow blogs to be viewed.',
        1 => 'Yes, allow viewing of blogs.',
        2 => 'Yes, allow viewing of all blogs, even private ones.'
      ),
      'value' => 1,
    ));

    $this->addElement('Radio', 'edit', array(
      'label' => 'Allow Editing of Blogs?',
      'description' => 'Do you want to let members edit blogs? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow members to edit their blogs.',
        1 => 'Yes, allow members to edit their own blogs.',
        2 => 'Yes, allow members to edit all blogs.'
      ),
      'value' => 1,
    ));

    $this->addElement('Radio', 'delete', array(
      'label' => 'Allow Deletion of Blogs?',
      'description' => 'Do you want to let members delete blogs? If set to no, some other settings on this page may not apply.',
      'multiOptions' => array(
        0 => 'No, do not allow members to delete their blogs.',
        1 => 'Yes, allow members to delete their own blogs.',
        2 => 'Yes, allow members to delete all blogs.'
      ),
      'value' => 1,
    ));
    
    $this->addElement('Radio', 'create', array(
      'label' => 'Allow Creation of Blogs?',
      'description' => 'Do you want to let members create blogs? If set to no, some other settings on this page may not apply. This is useful if you want members to be able to view blogs, but only want certain levels to be able to create blogs.',
      'multiOptions' => array(
        1 => 'Yes, allow creation of blogs.',
        0 => 'No, do not allow blogs to be created.'
      ),
      'value' => 1,
    ));

    // PRIVACY ELEMENTS
    $this->addElement('MultiCheckbox', 'auth_view', array(
      'label' => 'Blog Entry Privacy',
      'description' => 'Your members can choose from any of the options checked below when they decide who can see their blog entries. These options appear on your members\' "Add Entry" and "Edit Entry" pages. If you do not check any options, everyone will be allowed to view blogs.',
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
      'label' => 'Blog Comment Options',
      'description' => 'Your members can choose from any of the options checked below when they decide who can post comments on their entries. If you do not check any options, everyone will be allowed to post comments on entries.',
      'multiOptions' => array(
        'everyone'       => 'Everyone',
        'owner_network' => 'Friends and Networks',
        'owner_member_member'  => 'Friends of Friends',
        'owner_member'         => 'Friends Only',
        'owner'          => 'Just Me'
      ),
      'value' => array('everyone', 'owner_network','owner_member_member', 'owner_member', 'owner')
    ));

    $this->addElement('Radio', 'css', array(
      'label' => 'Allow Custom CSS Styles?',
      'description' => 'If you enable this feature, your members will be able to customize the colors and fonts of their blogs by altering their CSS styles.',
      'multiOptions' => array(
        1 => 'Yes, enable custom CSS styles.',
        0 => 'No, disable custom CSS styles.'
      ),
      'value'=>1
    ));
   
    $this->addElement('Text', 'auth_html', array(
      'label' => 'HTML in Blog Entries?',
      'description' => 'If you want to allow specific HTML tags, you can enter them below (separated by commas). Example: b, img, a, embed, font',
      'value'=> 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'
    ));


    $this->addElement('Button', 'submit', array(
      'label' => 'Save Settings',
      'type' => 'submit',
      'ignore' => true
    ));

  }
}