<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Filter.php 6590 2010-06-25 19:40:21Z john $
 * @author     Jung
 */

/**
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Authorization_Form_Admin_Level_Filter extends Engine_Form
{
  public function init()
  {
    $this
      ->setAttribs(array(
        'id' => 'filter_form',
        'class' => 'global_form_box',
      ));

    $this->addElement('Hidden', 'orderby', array(
      'order' => 1
    ));

    $this->addElement('Hidden', 'orderby_direction', array(
      'order' => 2
    ));
  }
}