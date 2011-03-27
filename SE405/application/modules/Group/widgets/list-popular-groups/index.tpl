<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7319 2010-09-08 21:08:45Z jung $
 * @author     John
 */
?>


   <?php foreach( $this->categories as $category ): ?>
   <ul class="groups_browse">
   <li>
   <div class="groups_title">
          <h4><?php echo  $category->title?></h4>
        </div>
     <?php foreach( $this->paginator as $group ): ?>
	
		<?php if($group->category_id == $category->category_id) {?>
				<div class="groups_photo">
		            <?php echo $this->htmlLink($group->getHref(), $this->itemPhoto($group, 'thumb.normal')) ?>
		         </div>
			      <div class="groups_info">
			        <div class="groups_title">
		              <h3><?php echo $this->htmlLink($group->getHref(), $group->getTitle()) ?></h3>
		            </div>
			      </div>
         <?php } ?>
      
     <?php endforeach; ?>
     </li>
   </ul>
      <?php endforeach; ?>
