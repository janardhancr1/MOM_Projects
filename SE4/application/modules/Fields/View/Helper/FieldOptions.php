<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FieldOptions.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_View_Helper_FieldOptions extends Zend_View_Helper_Abstract
{
  public function fieldOptions($subject, $field, $value)
  {
    $info = Engine_Api::_()->fields()->getFieldInfo($field->type, 'multiOptions');

    // Single
    if( is_object($value) )
    {
      if( isset($info[$value->value]) ) {
        return $info[$value->value];
      }
    }

    // Multi
    else if( is_array($value) )
    {
      $first = true;
      $content = '';
      foreach( $value as $sVal ) {
        if( !isset($info[$sVal->value]) ) continue;
        if( !$first ) $content .= ', ';
        $content .= $info[$sVal->value];
        $first = false;
      }
      return $content;
    }

    return '';
  }
}