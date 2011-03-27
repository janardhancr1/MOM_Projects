<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Answer
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7319 2010-09-08 21:08:45Z jung $
 * @author     John
 */
?>
<?php foreach( $this->categories as $category ): ?>
<ul class="answers_browse">
 
      <li>
           <div class="answers_title">
          		<h4><?php echo  $category->category_name?></h4>
    		</div>
    	<?php foreach ($this->paginator as $answer): ?>
    	<?php if($answer->answer_cat_id == $category->category_id) {?>
        <div class="answers_browse_info">
          <h3>
            <?php echo $this->htmlLink($answer->getHref(), $answer->title) ?>
          </h3>
        </div>
      <?php } ?>
      <?php endforeach; ?>
       </li>
</ul>
<?php endforeach; ?>