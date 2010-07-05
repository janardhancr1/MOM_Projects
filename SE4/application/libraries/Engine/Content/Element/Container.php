<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Content
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Container.php 4334 2010-03-12 10:40:39Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Content
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_Content_Element_Container extends Engine_Content_Element_Abstract
{
  public function loadDefaultDecorators()
  {
    if( !empty($this->_decorators) ) {
      return;
    }
    
    // Add decorators
    $this
      ->addDecorator('Children')
      ->addDecorator('Container');
  }
  
  protected function _render()
  {
    return '';
  }
}