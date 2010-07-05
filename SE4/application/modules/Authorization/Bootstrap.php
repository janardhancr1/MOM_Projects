<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Bootstrap.php 6507 2010-06-22 23:37:42Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Authorization
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Authorization_Bootstrap extends Engine_Application_Bootstrap_Abstract
{
  public function __construct($application)
  {
    parent::__construct($application);
    $this->initActionHelperPath();
  }
}
