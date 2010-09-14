<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: FormFancyUpload.php 7244 2010-09-01 01:49:53Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Decorator_FormFancyUpload extends Zend_Form_Decorator_Abstract
{
  public function render($content)
  {
    $data = $this->getElement()->getAttrib('data');
    if( $data ) {
      $this->getElement()->setAttrib('data', null);
    }
    $view = $this->getElement()->getView();
    return $view->action('upload', 'upload', 'storage', array(
      'name' => $this->getElement()->getName(),
      'data' => $data,
      'element' => $this->getElement()
    ));
  }
}
