<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FieldWebsite.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_View_Helper_FieldWebsite extends Zend_View_Helper_Abstract
{
  public function fieldWebsite($subject, $field, $value)
  {
    $str = $value->value;
    if( strpos($str, 'http://') === false ) {
      $str = 'http://' . $str;
    }

    return $this->view->htmlLink($str, $str);
  }
}