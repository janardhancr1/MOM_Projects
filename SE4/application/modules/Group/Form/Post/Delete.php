<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Delete.php 6516 2010-06-23 01:15:53Z shaun $
 * @author     John
 */

/**
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Group_Form_Post_Delete extends Engine_Form
{
  public function init()
  {
    $this
      ->setTitle('Delete Post')
      ->setDescription('Are you sure you want to delete this post?')
      ;

    $this->addElement('Button', 'submit', array(
      'type' => 'submit',
      'label' => 'Delete Post',
    ));

    $this->addElement('Cancel', 'cancel', array(
      'label' => 'Cancel',
      'onclick' => 'parent.Smoothbox.close();',
    ));
  }
}