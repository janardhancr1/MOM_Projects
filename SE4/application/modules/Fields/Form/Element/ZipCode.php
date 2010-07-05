<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: ZipCode.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_Form_Element_ZipCode extends Engine_Form_Element_Text
{
  public function init()
  {
    $this->addValidator('Regex', true, array('/^(\d{5}-\d{4})|(\d{5})$/'));
    // Fix messages
    $this->getValidator('Regex')->setMessage("'%value%' is not a valid zip code.", 'regexNotMatch');
  }
}