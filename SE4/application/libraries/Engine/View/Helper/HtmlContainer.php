<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: HtmlContainer.php 4334 2010-03-12 10:40:39Z john $
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_View_Helper_HtmlContainer extends Zend_View_Helper_HtmlElement
{
  protected $_ignoreOnEmptyContent = true;
  
  public function htmlContainer($content, $attribs = array())
  {
    $tag = 'div';
    if( !empty($attribs['tag']) ) {
      if( is_string($attribs['tag']) ) {
        $tag = $attribs['tag'];
      }
      unset($attribs['tag']);
    }

    // Empty content
    if( empty($content) ) {
      if( $this->_ignoreOnEmptyContent ) {
        return '';
      } else {
        $closingBracket = $this->getClosingBracket();
        return '<' . $tag . $this->_htmlAttribs($attribs) . $closingBracket;
      }
    }

    return '<' . $tag
      . $this->_htmlAttribs($attribs)
      . '>'
      . $content
      . '</'
      . $tag
      . '>';
  }
}