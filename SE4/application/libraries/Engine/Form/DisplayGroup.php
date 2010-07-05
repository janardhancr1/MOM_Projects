<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: DisplayGroup.php 1923 2009-12-16 09:19:41Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_DisplayGroup extends Zend_Form_DisplayGroup
{
    /**
     * Load default decorators
     * 
     * @return void
     */
    public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('Fieldset')
                 ->addDecorator('HtmlTag', array('tag' => 'div', 'class' => 'form-wrapper', 'id' => $this->getName() . '-wrapper'));
        }
    }
}
