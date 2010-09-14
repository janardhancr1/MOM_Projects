<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: DateTime.php 7244 2010-09-01 01:49:53Z john $
 */

/**
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_View_Helper_DateTime extends Zend_View_Helper_FormElement
{
  public function dateTime($unformatted_string)
  {
    $timestamp = strtotime($unformatted_string);
    $translation = Zend_Locale::getTranslation('full', 'time');
    
    if (count(explode(" ", $unformatted_string)) > 1) {
      if (strstr($translation, "a")) {
        return strftime("%b %d, %Y at %l:%M %p", $timestamp);
      }
      else {
        return strftime("%b %d, %Y at %H:%M", $timestamp);
      }
    }
    else {
      $return_string = strftime("%b %d, %Y", $timestamp);
    }
    return $return_string;
  }

}