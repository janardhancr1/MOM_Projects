<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Search.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Form_Search extends Engine_Form
{
  public function init()
  {
    $this
      ->setMethod('get')
      ->setDecorators(array('FormElements', 'Form'));
      ;
    
    $this->addElement('Text', 'query', array(
      'decorators' => array(
        'ViewHelper',
      ),
    ));

    $this->addElement('Button', 'submit', array(
      'label' => 'Search',
      'type' => 'submit',
      'ignore' => true,
      'decorators' => array(
        'ViewHelper',
      ),
    ));
  }
}