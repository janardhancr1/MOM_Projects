<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: Checkbox.php 5839 2010-05-15 01:36:27Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Element_Checkbox extends Zend_Form_Element_Checkbox
{
  protected $_title;

  public function setTitle($title)
  {
    $this->_title = $title;
  }

  public function getTitle()
  {
    return $this->_title;
  }

  public function getDescription()
  {
    if( empty($this->_description) ) {
      $this->getDecorator('Description')->setOption('escape', false);
      return '&nbsp;';
    }
    return $this->_description;
  }
  
  /**
   * Load default decorators
   *
   * @return void
   */
  public function loadDefaultDecorators()
  {
    if( $this->loadDefaultDecoratorsIsDisabled() )
    {
      return;
    }

    $decorators = $this->getDecorators();
    if( empty($decorators) )
    {
      //$this->addDecorator('ViewHelper')
      //  ->addDecorator('Label', array('placement' => Zend_Form_Decorator_Abstract::APPEND))
      //  ->addDecorator('DivDivDivWrapper');
      $fqName = $this->getName();
      $this->addDecorator('ViewHelper')
        ->addDecorator('Label', array('placement' => Zend_Form_Decorator_Abstract::APPEND))
        ->addDecorator('HtmlTag', array('tag' => 'div', 'id'  => $fqName . '-element', 'class' => 'form-element'))
        ->addDecorator('Description', array('tag' => 'div', 'class' => 'form-label', 'id' => $fqName . '-label', 'placement' => Zend_Form_Decorator_Abstract::PREPEND))
        ->addDecorator('HtmlTag2', array('tag' => 'div', 'id'  => $fqName . '-wrapper', 'class' => 'form-wrapper'));
    }
  }
}