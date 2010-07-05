<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Create.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Link_Create extends Engine_Form
{
  public function init()
  {
    $this->addElement('Text', 'uri', array(
      'required' => true,
      'allowEmpty' => false,
      'filters' => array(
        new Engine_Filter_HtmlSpecialChars(),
        new Engine_Filter_Censor(),
      ),
    ));

    $this->addElement('Text', 'title', array(
      'required' => true,
      'allowEmpty' => false,
      'filters' => array(
        new Engine_Filter_Censor(),
        new Engine_Filter_HtmlSpecialChars()
      ),
    ));

    $this->addElement('Text', 'description', array(
      'filters' => array(
        new Engine_Filter_Censor(),
        new Engine_Filter_HtmlSpecialChars()
      ),
    ));

    $this->addElement('Hidden', 'thumbnail');
  }
}