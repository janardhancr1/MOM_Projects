<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Birthdate.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_Form_Admin_Field_Birthdate extends Fields_Form_Admin_Field
{
  public function init()
  {
    parent::init();

    // Add minimum age
    $this->addElement('Integer', 'min_age', array(
      'label' => 'Minimum Age',
    ));
  }
}