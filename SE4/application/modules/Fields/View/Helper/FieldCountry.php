<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FieldCountry.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_View_Helper_FieldCountry extends Zend_View_Helper_Abstract
{
  public function fieldCountry($subject, $field, $value)
  {
    $territories = Zend_Locale::getTranslationList('territory', null, 2);

    if( isset($territories[$value->value]) ) {
      return $territories[$value->value];
    }
    return '';
  }
}