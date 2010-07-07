<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Adphoto.php 6590 2010-06-25 19:40:21Z john $
 * @author     Jung
 */

/**
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Core_Model_Adphoto extends Core_Model_Item_Abstract
{
  protected function _delete()
  {
  }

  public function getPhotoUrl($type = null)
  {
    if( empty($this->file_id) )
    {
      return "no file id";
    }

    $file = $this->api()->getApi('storage', 'storage')->get($this->file_id, $type);
    if( !$file )
    {
      return "no file";
    }

    return $file->map();
  }
}