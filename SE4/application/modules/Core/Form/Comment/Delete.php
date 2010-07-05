<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Delete.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Comment_Delete extends Engine_Form
{
  public function init()
  {
    $this->addElement('Button', 'submit', array(
      'type' => 'submit',
      'ignore' => true,
      'label' => 'Post Comment',
      'decorators' => array(
        'ViewHelper',
      )
    ));

    $this->addElement('Hidden', 'type', array(
      'order' => 990,
      'validators' => array(
        'Alnum'
      ),
    ));

    $this->addElement('Hidden', 'identity', array(
      'order' => 991,
      'validators' => array(
        'Int'
      ),
    ));

    $this->addElement('Hidden', 'comment_id', array(
      'order' => 992,
      'validators' => array(
        'Int'
      ),
    ));
  }
}