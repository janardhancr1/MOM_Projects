<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6599 2010-06-26 02:45:22Z steve $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Widget_MenuLogoController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    $this->view->logo = $this->_getParam('logo');
  }

  public function getCacheKey()
  {
    //return true;
  }
}