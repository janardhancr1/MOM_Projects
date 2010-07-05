<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: DateTime.php 6072 2010-06-02 02:36:45Z john $
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