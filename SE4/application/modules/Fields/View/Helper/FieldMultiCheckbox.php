<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FieldMultiCheckbox.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_View_Helper_FieldMultiCheckbox extends Zend_View_Helper_Abstract
{
  public function fieldMultiCheckbox($subject, $field, $value)
  {
    // Build values
    $vals = array();
    foreach( $value as $singleValue ) {
      if( is_string($singleValue) ) {
        $vals[] = $singleValue;
      } else if( is_object($singleValue) ) {
        $vals[] = $singleValue->value;
      }
    }

    $options = $field->getOptions();
    $first = true;
    $content = '';
    foreach( $options as $option ) {
      if( !in_array($option->option_id, $vals) ) continue;
      if( !$first ) $content .= ', ';
      $content .= $this->view->translate($option->label);
      $first = false;
    }

    return $content;
  }
}