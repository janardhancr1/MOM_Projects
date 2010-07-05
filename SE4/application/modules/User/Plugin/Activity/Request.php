<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Request.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class User_Plugin_Activity_Request
{
  public function render(Zend_View_Interface $view, Activity_Model_Request $request)
  {
    return $view->action('request', 'widget', 'user', array('request' => $request));
  }

  public function handle(Zend_View_Interface $view, Activity_Model_Request $request, Zend_Controller_Request_Abstract $data)
  {
    return $view->action('request-process', 'widget', 'user', array('request' => $request, 'data' => $data));
  }
}