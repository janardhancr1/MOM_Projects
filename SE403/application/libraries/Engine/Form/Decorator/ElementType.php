<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: ElementType.php 7244 2010-09-01 01:49:53Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Decorator_ElementType extends Zend_Form_Decorator_Abstract
{
  public function render($content)
  {
    $element = $this->getElement();
    $type = array_pop(explode('_', $element->getType()));
    $class = 'element_type_'.strtolower($type);

    if( isset($element->class) )
    {
      $class = $element->class.' '.$class;
    }
    $element->class = $class;
    
    return $content;
  }
}