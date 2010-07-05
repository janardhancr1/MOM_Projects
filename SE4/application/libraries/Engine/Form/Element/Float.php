<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: Float.php 4824 2010-04-06 23:14:12Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Element_Float extends Engine_Form_Element_Text
{
  public function init()
  {
    $this->addValidator('Float', true);
  }
}