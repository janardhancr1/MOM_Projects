<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: FormCalendarDateTime.php 7244 2010-09-01 01:49:53Z john $
 * @todo       documentation
 */

/**
 * @category   Engine
 * @package    Engine_View
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_View_Helper_FormCalendarDateTime extends Zend_View_Helper_FormElement {

  /**
   * Generates a set of radio button elements.
   *
   * @access public
   *
   * @param string|array $name If a string, the element name.  If an
   * array, all other parameters are ignored, and the array elements
   * are extracted in place of added parameters.
   *
   * @param mixed $value The radio value to mark as 'checked'.
   *
   * @param array $options An array of key-value pairs where the array
   * key is the radio value, and the array value is the radio text.
   *
   * @param array|string $attribs Attributes added to each radio.
   *
   * @return string The radio buttons XHTML.
   */
  public function formCalendarDateTime($name, $value = null, $attribs = null, $options = null, $listsep = "<br />\n") {
    if (is_string($value)) {
      //    $time = strptime($value, "%Y-%m-%d %H:%M");
      $timestamp = strtotime($value);
      $parsed_value['date'] = strftime("%b %d %Y", $timestamp);
      $parsed_value['minute'] = strftime("%M", $timestamp);
      if (!empty($options['ampm'])) {
        $parsed_value['hour'] = strftime("%I", $timestamp);
        $parsed_value['ampm'] = strftime("%p", $timestamp);
      } else {
        $parsed_value['hour'] = strftime("%H", $timestamp);
      }
      //Nix leading zero
      $parsed_value['hour'] = strval(intval($parsed_value['hour']));
      $value = $parsed_value;
    }

    if (!is_array($value)) {
      $value = null;
    }

    $info = $this->_getInfo($name, $value, $attribs, $options, $listsep);
    extract($info); // name, value, attribs, options, listsep, disable

    $return_html = '<div class="event_calendar_container" style="display:inline">';
    if (empty($value['date'])) {
      $value['date'] = "";
    }
    if (empty($value['hour'])) {
      $value['hour'] = '';
    }
    if (empty($value['minute'])) {
      $value['minute'] = '';
    }

    if (empty($value['ampm'])) {
      $value['ampm'] = '';
    } else {
      if (empty($value['hour'])) {
        $value['hour'] = 12;
      }
    }
    $return_html .= '<input class="calendar" type="hidden" name="' . $name . '[date]" id="' . $name . '[date]" value="' . $value['date'] . '" />';
    if (!empty($value['date'])) {
      $return_html .= "<span class='calendar_output_span' id='calendar_output_span_" . $name . "[date]'>" . $value['date'] . "</span>";
    } else {
      $return_html .= "<span class='calendar_output_span' id='calendar_output_span_" . $name . "[date]'>Select a date</span>";
    }
    $return_html .= "</div>";
    $hour_html = $this->view->formSelect($name . '[hour]', $value['hour'], $attribs, $options['hour']);
    $minute_html = $this->view->formSelect($name . '[minute]', $value['minute'], $attribs, $options['minute']);

    if (!empty($options['ampm'])) {
      $am_pm = $this->view->formSelect($name . '[ampm]', $value['ampm'], $attribs, $options['ampm']);
    } else {
      $am_pm = "";
    }
    $return_html .= $hour_html . $minute_html . $am_pm;
    return $return_html;
  }

}