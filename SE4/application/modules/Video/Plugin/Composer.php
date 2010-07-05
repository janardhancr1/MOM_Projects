<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Composer.php 6343 2010-06-15 01:50:33Z jung $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Video_Plugin_Composer extends Core_Plugin_Abstract
{
  public function onAttachVideo($data)
  {
    if( !is_array($data) || empty($data['video_id']) ) {
      return;
    }

    $video = Engine_Api::_()->getItem('video', $data['video_id']);
    // update $video with new title and description
    $video->title = $data['title'];
    $video->description = $data['description'];
    $video->save();
    
    if( !($video instanceof Core_Model_Item_Abstract) || !$video->getIdentity() )
    {
      return;
    }

    return $video;
  }
}