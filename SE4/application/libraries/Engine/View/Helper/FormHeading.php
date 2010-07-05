<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FormHeading.php 5553 2010-05-09 04:27:28Z john $
 * @todo       documentation
 */

/**
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_View_Helper_FormHeading extends Zend_View_Helper_FormElement
{
  public function formHeading($name, $value = null, $attribs = null)
  {
    $info = $this->_getInfo($name, $value, $attribs);
    extract($info); // name, value, attribs
    return '<span'
      . $this->_htmlAttribs($attribs)
      . '>'
      . $value
      . '</span>';
  }
}