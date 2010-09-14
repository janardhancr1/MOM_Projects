<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FieldCountry.php 7244 2010-09-01 01:49:53Z john $
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