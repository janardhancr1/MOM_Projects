<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: SignupController.php 6518 2010-06-23 01:22:43Z shaun $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Invite
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Invite_SignupController extends Engine_Controller_Action
{
  public function __call($method, $args)
  {
    $session = new Zend_Session_Namespace('invite');
    $session->invite_code = substr($method, 0, -6);
    // @todo integrate invite-only functionality (reject if invite code is bad)
    $this->_redirect( 'signup' );
  }
}