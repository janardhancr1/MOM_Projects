<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Timestamp.php 7251 2010-09-01 20:15:01Z steve $
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Engine_View_Helper_Timestamp extends Zend_View_Helper_HtmlElement
{
  const MINUTE = 60;
  const HOUR = 3600;
  const DAY = 86400;
  const WEEK = 604800;
  const MONTH = 2419200; // 4 weeks approximation
  const YEAR = 31536000; // 365 days approximation
  
  protected $_tag = 'span';

  protected $_extraClass;

  public function timestamp($time = null, $attribs = array())
  {
    if( null === $time )
    {
      $time = time();
    }

    else if( is_string($time) && !is_numeric($time) )
    {
      $time = strtotime($time);
    }
    
    else if( $time instanceof Zend_Date )
    {
      $time = $time->toValue();
    }

    if( !is_numeric($time) ) {
      Engine_Exception::getLog()->log(sprintf('Unknown timestamp format: %s (%s) ', $time, gettype($time)), Zend_Log::WARN);
      return $this->view->translate('Invalid date');
      //throw new Zend_View_Exception(sprintf('Unknown timestamp format: %s (%s) ', $time, gettype($time)));
    }

    // Prepare content
    $this->_extraClass = null;
    $content = $this->calculateDefaultTimestamp($time);
    
    // Prepare attributes
    // Format: 'Tue, 08 Dec 2009 19:59:52 -0800'
    $tag = $this->_tag;
    if( isset($attribs['tag']) ) {
      $tag = $attribs['tag'];
      unset($attribs['tag']);
    }

    $attribs['title'] = date("D, j M Y G:i:s O", $time);

    if( empty($attribs['class']) ) {
      $attribs['class'] = '';
    } else {
      $attribs['class'] .= ' ';
    }
    $attribs['class'] .= 'timestamp';
    if( $this->_extraClass ) {
      $attribs['class'] .= ' ' . $this->_extraClass;
    }

    return '<'
      . $tag
      . $this->_htmlAttribs($attribs)
      . '>'
      . $content
      . '</'
      . $tag
      . '>'
      ;
  }

  public function setTag($tag)
  {
    $this->_tag = $tag;
    return $this;
  }

  public function calculateDefaultTimestamp($time)
  {
    $now = time();
    $deltaNormal = $time - $now;
    //$deltaNormal = $now - $time;
    $delta = abs($deltaNormal);
    $isPlus = ($deltaNormal > 0);

    // Right now
    if( $delta < 1 )
    {
      $val = null;
      if( $isPlus ) {
        $key = 'now';
      } else {
        $key = 'now';
      }
    }

    // less than a minute
    else if( $delta < 60 )
    {
      $val = null;
      if( $isPlus ) {
        $key = 'in a few seconds';
      } else {
        $key = 'a few seconds ago';
      }
    }

    // less than an hour ago
    else if( $delta < self::HOUR )
    {
      $val = floor($delta / 60);
      if( $isPlus ) {
        $key = array('in %s minute', 'in %s minutes', $val);
      } else {
        $key = array('%s minute ago', '%s minutes ago', $val);
      }
    }

    // less than 12 hours ago, or less than a day ago and same day
    else if( $delta < self::HOUR * 12 || ($delta < self::DAY && date('d', $time) == date('d', $now)) )
    {
      $val = floor($delta / (60 * 60));
      if( $isPlus ) {
        $key = array('in %s hour', 'in %s hours', $val);
      } else {
        $key = array('%s hour ago', '%s hours ago', $val);
      }
    }

    // less than a week ago and same week
    else if( $delta < self::WEEK && date('W', $time) == date('W', $now) )
    {
      // Get day of week
      $dayOfWeek = Zend_Locale_Data::getContent(Zend_Registry::get('Locale'), 'day', array('gregorian', 'format', 'abbreviated', strtolower(date('D', $time))));

      return $this->view->translate(
        '%s at %s',
        $dayOfWeek,
        $this->view->locale()->toTime($time, array('size' => 'short'))
      );
    }

    // less than a year and same year
    else if( $delta < self::YEAR && date('Y', $time) == date('Y', $now) )
    {
      return $this->view->locale()->toTime($time, array('type' => 'dateitem', 'size' => 'MMMMd'));
    }

    // Otherwise use the full date
    else
    {
      return $this->view->locale()->toDate($time, array('size' => 'long'));
    }

    $this->_extraClass = 'timestamp-update';
    
    $translator = $this->view->getHelper('translate');
    if( $translator ) {
      return $translator->translate($key, $val);
    } else {
      $key = is_array($string) ? $string[0] : $key;
      return sprintf($string, $val);
    }
  }
}