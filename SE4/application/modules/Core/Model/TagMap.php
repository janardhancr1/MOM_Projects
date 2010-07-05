<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: TagMap.php 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Model_TagMap extends Core_Model_Item_Abstract
{
  public function getTitle()
  {
    return $this->getTag()->getTitle();
  }

  public function getDescription()
  {
    return $this->getTag()->getDescription();
  }

  public function getHref($params = array())
  {
    return $this->getTag()->getHref($params);
  }

  public function getTag()
  {
    return Engine_Api::_()->getItem($this->tag_type, $this->tag_id);
  }

  public function getTagger()
  {
    return Engine_Api::_()->getItem($this->tagger_type, $this->tagger_id);
  }

  public function getResource()
  {
    return Engine_Api::_()->getItem($this->resource_type, $this->resource_id);
  }
}