<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FieldLocation.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_View_Helper_FieldLocation extends Zend_View_Helper_Abstract
{
  public function fieldLocation($subject, $field, $value)
  {
    return $value->value
      . ' ['
      . $this->view->htmlLink('http://maps.google.com/?q=' . urlencode($value->value), $this->view->translate('map'), array('target' => '_blank'))
      . ']';
  }
}