<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Item.php 6505 2010-06-22 23:27:39Z shaun $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Activity_Model_Helper_Item extends Activity_Model_Helper_Abstract
{
  /**
   * Generates text representing an item
   * 
   * @param mixed $item The item or item guid
   * @param string $text (OPTIONAL)
   * @param string $href (OPTIONAL)
   * @return string
   */
  public function direct($item, $text = null, $href = null)
  {
    $item = $this->_getItem($item, false);

    // Check to make sure we have an item
    if( !($item instanceof Core_Model_Item_Abstract) )
    {
      return false;
    }

    if( !isset($text) )
    {
      $text = $item->getTitle();
    }

    if( !isset($href) )
    {
      $href = $item->getHref();
    }
    
    return '<a class="feed_item_username" href="'.$href.'">'.$text.'</a>';
  }
}