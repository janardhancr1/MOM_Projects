<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Level.php 7244 2010-09-01 01:49:53Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Form_Admin_Settings_Level extends Authorization_Form_Admin_Level_Abstract
{

  public function init()
  {
    parent::init();

    // My stuff
    $this
        ->setTitle('Member Level Settings')
        ->setDescription('FORUM_FORM_ADMIN_LEVEL_DESCRIPTION');

    // Element: view
    $this->addElement('Radio', 'view', array(
      'label' => 'Allow Viewing of Forums?',
      'description' => 'FORUM_FORM_ADMIN_LEVEL_VIEW_DESCRIPTION',
      'value' => 1,
      'multiOptions' => array(
        //2 => 'Yes, allow viewing and subscription of forums, even private ones.',
        1 => 'Yes, allow viewing and subscription of forums.',
        0 => 'No, do not allow forum to be viewed or subscribed to.',
      ),
      'value' => 1,
    ));
    
    if( !$this->isPublic() ) {

      // Element: create
      $this->addElement('Radio', 'create', array(
        'label' => 'Allow Posting?',
        'description' => 'FORUM_FORM_ADMIN_LEVEL_CREATE_DESCRIPTION',
        'value' => 1,
        'multiOptions' => array(
          1 => 'Yes, allow posting to forums.',
          0 => 'No, do not allow forum posts.'
        ),
        'value' => 1,
      ));

      // Element: moderate
      $this->addElement('Radio', 'moderate', array(
        'label' => 'Allow Moderation?',
        'description' => 'FORUM_FORM_ADMIN_LEVEL_MODERATE_DESCRIPTION',
        'value' => 0,
        'multiOptions' => array(
          2 => 'Yes, allow moderation.',
          0 => 'No, do not allow moderation.'
        ),
        'value' => ( $this->isModerator() ? 2 : 0 ),
      ));

      // Element: commentHtml
      $this->addElement('Text', 'commentHtml', array(
        'label' => 'Allow HTML in posts?',
        'description' => 'FORUM_FORM_ADMIN_LEVEL_CONTENTHTML_DESCRIPTION',
      ));
    }
    
  }

}