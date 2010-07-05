<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FieldFacebook.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_View_Helper_FieldFacebook extends Zend_View_Helper_Abstract
{
  public function fieldFacebook($subject, $field, $value)
  {
    return $this->view->htmlLink('http://www.facebook.com/search/?q=' . $value->value, $value->value, array(
      'target' => '_blank',
      'ref' => 'nofollow',
    ));
  }
}