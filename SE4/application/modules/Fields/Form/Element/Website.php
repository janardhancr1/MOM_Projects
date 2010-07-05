<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Website.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_Form_Element_Website extends Engine_Form_Element_Text
{
  public function init()
  {
    $this->addFilter('PregReplace', array('/\s*[a-zA-Z0-9]{2,5}:\/\//', ''));
    //$this->addValidator('Hostname', true);
  }
}