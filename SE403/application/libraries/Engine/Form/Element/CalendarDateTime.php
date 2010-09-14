<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: CalendarDateTime.php 7244 2010-09-01 01:49:53Z john $
 * @todo       documentation
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Element_CalendarDateTime extends Zend_Form_Element_Xhtml {

  public $helper = 'formCalendarDateTime';
  public $ignoreValid;
  protected $_yearMin;
  protected $_yearMax;
  protected $_dayOptions;
  protected $_monthOptions;
  protected $_yearOptions;
  protected $_minuteOptions;
  protected $_hourOptions;

  public function setMultiOptions($options) {
    return $this;
  }

  public function getMultiOptions() {
    if (is_null($this->options)) {
      $this->options = array(
          'day' => $this->getDayOptions(),
          'month' => $this->getMonthOptions(),
          'year' => $this->getYearOptions(),
          'minute' => $this->getMinuteOptions(),
          'hour' => $this->getHourOptions(),
          'ampm' => $this->getAMPMOptions()
      );
    }
    return $this->options;
  }

  public function getMinuteOptions() {
    if (is_null($this->_minuteOptions)) {
      $this->_minuteOptions = Array('00' => '00', '10' => '10', '20' => '20', '30' => '30', '40' => '40', '50' => '50');
    }
    return $this->_minuteOptions;
  }

  public function getAMPMOptions() {
    if (!$this->useAMPMTime()) {
      return Array();
    } else {
      return array('AM' => 'AM', 'PM' => 'PM');
    }
  }

  public function useAMPMTime() {
    $translation = Zend_Locale::getTranslation('full', 'time');
    if (strstr($translation, "a")) {
      return True;
    }
    return False;
  }

  public function getHourOptions() {
    if (is_null($this->_hourOptions)) {
      if ($this->useAMPMTime()) {
        $max_hour = 12;
        for ($i = 1; $i <= $max_hour; $i++) {
          $this->_hourOptions[$i] = $i;
        }
      } else {
        $max_hour = 24;
        for ($i = 0; $i < $max_hour; $i++) {
          $this->_hourOptions[$i] = $i;
        }
      }
    }
    return $this->_hourOptions;
  }

  public function getDayOptions() {
    if (is_null($this->_dayOptions)) {
      if ($this->getAllowEmpty())
        $this->_dayOptions[0] = ' ';
      for ($i = 1; $i <= 31; $i++) {
        $this->_dayOptions[$i] = $i;
      }
    }
    return $this->_dayOptions;
  }

  public function getMonthOptions() {
    if (is_null($this->_monthOptions)) {
      if ($this->getAllowEmpty())
        $this->_monthOptions[0] = ' ';
      for ($i = 1; $i <= 12; $i++) {
        $this->_monthOptions[$i] = $i;
      }
    }
    return $this->_monthOptions;
  }

  public function getYearOptions() {
    if (is_null($this->_yearOptions)) {
      if ($this->getAllowEmpty())
        $this->_yearOptions[0] = ' ';
      for ($i = $this->getYearMax(), $m = $this->getYearMin(); $i > $m; $i--) {
        $this->_yearOptions[$i] = (string) $i;
      }
    }
    return $this->_yearOptions;
  }

  public function setYearMin($min) {
    $this->_yearMin = (int) $min;
    return $this;
  }

  public function getYearMin() {
    // Default is 100 years ago
    if (is_null($this->_yearMin)) {
      $date = new Zend_Date();
      $this->_yearMin = (int) $date->get(Zend_Date::YEAR) - 100;
    }
    return $this->_yearMin;
  }

  public function setYearMax($max) {
    $this->_yearMax = $max;
    return $this;
  }

  public function getYearMax() {
    // Default is this year
    if (is_null($this->_yearMax)) {
      $date = new Zend_Date();
      $this->_yearMax = (int) $date->get(Zend_Date::YEAR);
    }
    return $this->_yearMax;
  }

  public function setValue($value) {
    $months = Array("Jan" => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6, 'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12);

    if (is_array($value)) {
      $split_date = explode(" ", $value['date']);
      $month = $split_date[0];
      $date = $split_date[1];
      $year = $split_date[2];
      if (!empty($value['hour'])) {
        $hour = $value['hour'];
      }
      if (!empty($value['minute'])) {
        $minute = $value['minute'];
      }
      $sql_date_string = $year . "-" . $months[$month] . "-" . $date;
      if (!empty($value['ampm'])) {
        $hour %= 12;
      }
      if (!empty($value['ampm']) && ($value['ampm'] == "PM")) {
        $hour += 12;
      }
      if ($value == "0-0-0") {
        return parent::setValue(NULL);
      }
      $value_string = $sql_date_string;
      if (!empty($value['hour'])) {
        $value_string .= ' ' . $hour . ':' . $minute;
      }
      return parent::setValue($value_string);
    }
    return parent::setValue($value);
  }

  public function getValue() {
    return parent::getValue();
  }

  /**
   * Load default decorators
   *
   * @return void
   */
  public function loadDefaultDecorators() {
    if ($this->loadDefaultDecoratorsIsDisabled()) {
      return;
    }

    $decorators = $this->getDecorators();
    if (empty($decorators)) {
      $this->addDecorator('ViewHelper');
      Engine_Form::addDefaultDecorators($this);
    }
  }

  protected function countMinutes($value) {
    if ($value['hour'] == 12){
      $return_value = 720 + $value['minute'];
    }
    else $return_value = 720 + $value['hour'] * 60 + $value['minute'];
    if ($value['ampm'] == 'PM') {
      $return_value += 720;
    }
    return $return_value;
  }

  public function isValid($value, $context = null) {
    $empty_ampm = empty($value['ampm']);
    $empty_hour = empty($value['hour']);
    if (empty($value['date']) && !$this->ignoreValid) {
      $this->_messages[] = "Please select a date from the calendar.";
      return false;
    }
    if (empty($value['hour']) && $this->useAMPMTime()) {
      $this->_messages[] = "Please select a time from the dropdown.";
      return false;
    }
    if ($empty_ampm && (!$empty_hour) && $this->useAMPMTime()) {
      $this->_messages[] = "Please select AM or PM.";
      return false;
    }
    if ($empty_hour && (!$empty_ampm)) {
      $this->_messages[] = "AM/PM value selected without specifying a time.";
      return false;
    }
    if ($context) {
      if (!empty($context['starttime']) && (!empty($context['endtime']))) {
        if ($context['starttime']['date'] == $context['endtime']['date']) {
          $start_time = $this->countMinutes($context['starttime']);
          $end_time = $this->countMinutes($context['endtime']);
          if (($start_time > $end_time) && ($context['starttime']['date'] == $context['endtime']['date'])) {
            $this->_messages[] = "End time cannot be before start time.";
            return false;
          }
        }
      }
    }

    return parent::isValid($value, $context);
  }

}