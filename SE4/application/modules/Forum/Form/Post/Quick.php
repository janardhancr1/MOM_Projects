<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Quick.php 6535 2010-06-23 22:33:10Z shaun $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Forum_Form_Post_Quick extends Engine_Form
{
  public $_error = array();

  public function init()
  {
    $this
      ->setTitle('Quick Reply')
      ->setMethod("POST")
      ->setAttrib('name', 'forum_post_quick')
      ->setAction(Zend_Controller_Front::getInstance()->getRouter()->assemble(array('topic_id'=>$this->getAttrib('topic_id')), 'forum_topic')
    );
    $settings = Engine_Api::_()->getApi('settings', 'core');
    $viewer = Engine_Api::_()->user()->getViewer();

    $filter = new Engine_Filter_Html();
    $allowed_tags = explode(',', Engine_Api::_()->authorization()->getPermission($viewer->level_id, 'forum', 'commentHtml'));

    if ($settings->getSetting('forum_html', 0) == '0')
    {
      $filter->setForbiddenTags();
      $filter->setAllowedTags($allowed_tags);

    }
    $this->addElement('textarea', 'body', array(
      'allowEmpty' => false,
      'filters' => array(
        $filter,
        new Engine_Filter_Censor(),
      ),
    ));

    // Buttons
    $this->addElement('Button', 'submit', array(
      'label' => 'Post Reply',
      'type' => 'submit',
    ));
  }

}