<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FieldAim.php 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_View_Helper_FieldAim extends Zend_View_Helper_Abstract
{
  public function fieldAim($subject, $field, $value)
  {
    return $this->view->htmlLink('aim:goim?screenname=' . $value->value, $value->value, array(
      //'target' => '_blank',
      'ref' => 'nofollow',
    ));
  }
}