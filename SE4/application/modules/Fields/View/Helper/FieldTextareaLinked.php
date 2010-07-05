<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FieldTextareaLinked.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_View_Helper_FieldTextareaLinked extends Zend_View_Helper_Abstract
{
  public function fieldTextareaLinked($subject, $field, $value)
  {
    $vals = preg_split('/\s*[,]+\s*/', $value->value);

    $content = '';
    $first = true;
    $urlBase = $this->view->url(array('controller' => 'search'), 'default', true);
    foreach( $vals as $val ) {
      if( !$first ) $content .= ', ';
      $content .= $this->view->htmlLink($urlBase . '?query='.$val, $val);
      $first = false;
    }

    return $content;
  }
}