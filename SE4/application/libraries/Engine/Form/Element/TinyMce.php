<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: TinyMce.php 4982 2010-04-13 23:06:08Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Element_TinyMce extends Engine_Form_Element_Textarea
{
    /**
     * Use formTextarea view helper by default
     * @var string
     */
    public $helper = 'formTinyMce';

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

