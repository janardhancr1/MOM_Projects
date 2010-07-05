<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Controller.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Widget_AdminMenuMiniController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    // check for maintenance mode
    $g = include APPLICATION_PATH . '/application/settings/general.php';
    if ($g['maintenance']['enabled'] && $g['maintenance']['code']) {
      $this->view->code = $g['maintenance']['code'];
    }
  }
}