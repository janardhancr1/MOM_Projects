<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: Cancel.php 2856 2010-01-21 09:37:56Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Element_Cancel extends Engine_Form_Element_Button
{
  public $helper = 'formCancel';

  protected $_ignore = true;
}