<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */
?>

<ul style='padding:0px; margin:0px; float:left; background-color:#ffffff; border:0px;'>
  <?php foreach( $this->paginator as $item ): ?>
    <li style='display:inline; padding:0px; margin:0px;'>
    <div style='width:160px; float:left;'>
      <?php echo $this->htmlLink($item->getHref(), $this->itemPhoto($item, 'normal.icon'), array('class' => 'recentvideos_thumb')) ?>
      <div class='recentvideos_info' style='width:150px; padding:0px;'>
        <div class='recentvideos_title'>
          <?php echo $this->htmlLink($item->getHref(), $item->getTitle()) ?>
        </div>

        <div class='recentvideos_owner'>
          <?php
            $owner = $item->getOwner();
            echo $this->translate('By %1$s', $this->htmlLink($owner->getHref(), $owner->getTitle()));
           ?>
            <div class="video_stats">
           <span class="video_views"><?php echo $item->view_count;?> <?php echo $this->translate('views');?></span>
            <?php if($item->rating>0):?>
            <?php for($x=1; $x<=$item->rating; $x++): ?><span class="rating_star_generic rating_star"></span><?php endfor; ?><?php if((round($item->rating)-$item->rating)>0):?><span class="rating_star_generic rating_star_half"></span><?php endif; ?>
          <?php endif; ?>
          </div>
         
        </div>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
