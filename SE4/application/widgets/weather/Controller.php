<?php
/**
 * SocialEngine
 *
 * @category   Application_Widget
 * @package    Widget
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @author     John
 */

/**
 * @category   Application_Widget
 * @package    Widget
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Widget_WeatherController extends Engine_Content_Widget_Abstract
{
  public function indexAction()
  {
    $location = @$_COOKIE['en4_weather_loc'];

    if( !empty($location) ) {
      $this->view->location = $this->_lookupLocation($location);
      $this->view->forecast = $this->_lookupForecast($location);
    }
  }

  public function chooseAction()
  {
    $location = $this->_getParam('location');
    if( !$location ) {
      return;
    }
    $this->view->locationQuery = $location;

    $xml = $this->_lookupLocation($location);
    var_dump($xml);

    // Location not resolved
    if( isset($xml->location) ) {
      $this->view->locations = $xml->location;
    }

    // Location resolved
    else {
      setcookie('en4_weather_loc', $location, time() + (86400 * 90), '/');
      $this->view->resolved = true;
    }
  }
  
  protected function _lookupLocation($location)
  {
    $xml = simplexml_load_file('http://api.wunderground.com/auto/wui/geo/GeoLookupXML/index.xml?query=' . urlencode($location));
    //var_dump($xml);
    return $xml;
  }

  protected function _lookupForecast($location)
  {
    $xml = simplexml_load_file('http://api.wunderground.com/auto/wui/geo/ForecastXML/index.xml?query=' . urlencode($location));
    //var_dump($xml);
    return $xml;
  }
}