<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Locale.php 5906 2010-05-20 01:31:29Z jung $
 * @todo       documentation
 */

/**
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_View_Helper_Locale extends Zend_View_Helper_Abstract
{
  /**
   * The current locale
   * 
   * @var Zend_Locale
   */
  protected $_locale;

  /**
   * Accessor
   * 
   * @return Engine_View_Helper_Locale
   */
  public function locale()
  {
    return $this;
  }
  
  /**
   * Magic caller
   * 
   * @param string $method
   * @param array $args
   * @return mixed
   */
  public function __call($method, array $args)
  {
    $locale = $this->getLocale();
    $r = new ReflectionMethod($locale, $method);
    return $r->invokeArgs($locale, $args);
  }

  /**
   * Set the current locale
   * 
   * @param string|Zend_Locale $locale
   * @return Engine_View_Helper_Locale
   */
  public function setLocale($locale)
  {
    if( is_string($locale) )
    {
      $locale = new Zend_Locale($locale);
    }

    if( !$locale instanceof Zend_Locale )
    {
      throw new Zend_View_Exception('Not passed locale object or valid locale string');
    }

    $this->_locale = $locale;
    return $this;
  }

  /**
   * Get the current locale. Defaults to locale in registry
   * 
   * @return Zend_Locale
   */
  public function getLocale()
  {
    if( null === $this->_locale )
    {
      $this->_locale = Zend_Registry::get('Locale');
    }

    return $this->_locale;
  }

  /**
   * Format a number according to locale and currency
   * @param  integer|float  $number
   * @return string
   * @see Zend_Currency::toCurrency()
   */
  public function toCurrency($value, $currency, $options = array())
  {
    $options = array_merge(array(
      'locale' => $this->getLocale(),
      'display' => 2,
      'precision' => 2,
    ), $options);

    // Doesn't like locales w/o regions
    $locale = null;
    if( strlen($options['locale']->__toString()) > 4 ) {
      $locale = $options['locale'];
    }
    unset($options['locale']); // boo

    $currency = new Zend_Currency($currency, $locale);
    return $currency->toCurrency($value, $options);
  }
  
  /**
   * Format a number according to locale
   * @param mixed $number
   * @see Zend_Locale_Format::toNumber()
   */
  public function toNumber($number, $options = array())
  {
    $options = array_merge(array(
      'locale' => $this->getLocale()
    ), $options);
    
    return Zend_Locale_Format::toNumber($number, $options);
  }

  public function toTime($time, $options = array())
  {
    $options = array_merge(array(
      'locale' => $this->getLocale()
    ), $options);
    $format = Zend_Locale_Format::getTimeFormat($this->getLocale());
    return date($format, $time);
  }

  public function toDate($date, $options = array())
  {
    if( is_numeric($date) ) {
      $date = new Zend_Date($date);
    } else if( is_string($date) ) {
      $date = new Zend_Date(strtotime($date));
    }

    $date->setTimezone( Zend_Registry::get('timezone') );

    $options = array_merge(array(
      'locale' => $this->getLocale(),
      'size' => 'short',
    ), $options);

    if( !($date instanceof Zend_Date) ) {
      throw new Exception('Not a valid date');
    }

    $format = Zend_Locale_Data::getContent($options['locale'], 'date', $options['size']);
    return $date->toString($format);
  }

  public function toDateTime($datetime, $options = array())
  {
    if( is_numeric($datetime) ) {
      $datetime = new Zend_Date($datetime);
    } else if( is_string($datetime) ) {
      $datetime = new Zend_Date(strtotime($datetime));
    }

    $datetime->setTimezone( Zend_Registry::get('timezone') );

    $options = array_merge(array(
      'locale' => $this->getLocale(),
      'size' => 'long',
    ), $options);
    
    if( !($datetime instanceof Zend_Date) ) {
      throw new Exception('Not a valid date');
    }

    $format = Zend_Locale_Data::getContent($options['locale'], 'datetime', $options['size']);
    return $datetime->toString($format);
  }
}