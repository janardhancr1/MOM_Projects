<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FormSingleRadio.php 6072 2010-06-02 02:36:45Z john $
 */

/**
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_View_Helper_FormSingleRadio extends Zend_View_Helper_FormElement
{
  public function formSingleRadio($name, $value = null, $attribs = null)
  {
    $info = $this->_getInfo($name, $value, $attribs);
    extract($info); // name, value, attribs, options, listsep, disable
    
    // XHTML or HTML end tag?
    $endTag = ' />';
    if (($this->view instanceof Zend_View_Abstract) && !$this->view->doctype()->isXhtml()) {
        $endTag= '>';
    }
    
    // is it checked?
    $checked = ( !empty($attribs['checked']) ? ' checked="checked"' : '' );
    unset($attribs['checked']);

    return '<input type="radio"'
      . ' id="' . $id . '"'
      . ' name="' . $name . '"'
      . ' value="' . $this->view->escape($value) . '"'
      . $checked
      . $this->_htmlAttribs($attribs)
      . $endTag;
  }
}