<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Currency.php 6514 2010-06-23 00:40:24Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Fields
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */
class Fields_Form_Element_Currency extends Engine_Form_Element_Float
{
  protected $_fieldMeta;

  public function setFieldMeta($field)
  {
    $this->_fieldMeta = $field;
    return $this;
  }

  public function init()
  {
    parent::init();

    $this->addFilter('Callback', array(array($this, 'filterRound')));
  }

  public function render(Zend_View_Interface $view = null)
  {
    if( $this->_fieldMeta instanceof Fields_Model_Meta && !empty($this->_fieldMeta->config['unit']) ) {
      $currency = new Zend_Currency($this->_fieldMeta->config['unit']);
      $this->loadDefaultDecorators();
      $this->getDecorator('Label')
        ->setOption('optionalSuffix', ' (' . $currency->getShortName() . ') ')
        ->setOption('requiredSuffix', ' (' . $currency->getShortName() . ') ')
        ;
    }
    
    return parent::render($view);
  }

  public function filterRound($value)
  {
    if( empty($value) ) {
      return '0';
    }
    return round($value, 2);
  }
}