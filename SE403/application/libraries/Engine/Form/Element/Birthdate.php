<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: Birthdate.php 7244 2010-09-01 01:49:53Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Element_Birthdate extends Engine_Form_Element_Date
{
  public function isValid($value, $context = null)
  {
    if ((empty($value['day']) || empty($value['month'])) && $this->isRequired())
    {
      $this->_messages[] = "Birthdays must include a month and a date.";
      return false;
    }
    return parent::isValid($value, $context);
  }
  
  public function getYearMax()
  {
    // Default is this year
    if( is_null($this->_yearMax) )
    {
      $date = new Zend_Date();
      $this->_yearMax = (int) $date->get(Zend_Date::YEAR) - 12;
    }
    return $this->_yearMax;
  }
}