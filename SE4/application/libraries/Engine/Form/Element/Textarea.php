<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: Textarea.php 4820 2010-04-06 22:20:59Z szerrade $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Element_Textarea extends Zend_Form_Element_Textarea
{
  public $cols = 45;

  public $rows = 6;
  
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
      $this->addDecorator('ViewHelper');
      Engine_Form::addDefaultDecorators($this);
    }
  }
}
