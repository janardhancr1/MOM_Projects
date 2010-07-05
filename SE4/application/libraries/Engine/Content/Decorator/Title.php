<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Content
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Title.php 6072 2010-06-02 02:36:45Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Content
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_Content_Decorator_Title extends Engine_Content_Decorator_Abstract
{
  public $helper = 'contentContainer';

  protected $_placement = 'PREPEND';

  protected $_tag = 'h3';

  public function setTag($tag)
  {
    $this->_tag = $tag;
    return $this;
  }

  public function getTag()
  {
    return $this->_tag;
  }
  
  public function render($content)
  {
    $element = $this->getElement();
    $separator = $this->getSeparator();
    $placement = $this->getPlacement();

    $title = $element->getTitle();
    $tag = $this->getTag();

    $translator = Engine_Content::getInstance()->getTranslator();
    if( !$this->getParam('disableTranslate') ) {
      $title = $translator->_($title);
    }
    
    if( !empty($title) ) {
      if( null !== $tag ) {
        $title = '<' . $tag . '>'
          . $title
          . '</' . $tag . '>';
      }
      
      switch( $placement ) {
        default:
        case self::APPEND:
          $content .= $separator . $title;
          break;
        case self::PREPEND;
          $content = $title . $separator . $content;
          break;
      }
    }
    
    return $content;
  }
}
