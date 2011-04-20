<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7481 2010-09-27 08:41:01Z john $
 * @author     John
 */
?>
<ul class="forum_categories">

<?php foreach( $this->categories as $category ):
  if( empty($this->forums[$category->category_id]) || $category->getTitle() != 'Open Discussions') {
    continue;
  }
  ?>
  <li>
    <div>
      <h3 style='border:0px;'><?php echo $this->translate($category->getTitle()) ?></h3>
    </div>
    <ul style='padding: 0px; margin: 0px; float: left;'>
      <?php foreach( $this->forums[$category->category_id] as $forum ):
      
	        $last_topic = $forum->getLastUpdatedTopic();
	        $last_post = null;
	        $last_user = null;
	        if( $last_topic ) {
	          $last_post = $last_topic->getLastCreatedPost();
	          $last_user = $this->user($last_post->user_id);
	        }
	        ?>
	        <?php 
	        	$title = $forum->getTitle(); 
	        	if( $title == 'Health & Wellness' || $title == 'Parenting' || $title == 'Relationships' || $title == 'Shopping' || $title == 'Entertainment & Pop Culture'): ?>
		        <li>
		          <div class="forum_icon">
		            <?php echo $this->htmlLink($forum->getHref(), $this->htmlImage('application/modules/Forum/externals/images/forum.png')) ?>
		          </div>
		         
		          <div class="forum_title" style='width:225px; float:left; padding-top:5px;'>
		            <h3 style='border:0px;'>
		              <?php echo $this->htmlLink($forum->getHref(), $this->translate($forum->getTitle())) ?>
		            </h3>
		            <span>
		              <?php echo $forum->getDescription() ?>
		            </span>
		          </div>
		          <div class="forum_topics" style='width:75px; float:left;'>
		            <span><?php echo $forum->topic_count;?></span>
		            <span>
		              <?php echo $this->translate(array('topic', 'topics', $forum->topic_count),$this->locale()->toNumber($forum->topic_count)) ?>
		            </span>
		          </div>
		          <div class="forum_posts" style='width:50px; float:left;'>
		            <span><?php echo $forum->post_count;?></span>
		            <span>
		              <?php echo $this->translate(array('post', 'posts', $forum->post_count),$this->locale()->toNumber($forum->post_count)) ?>
		            </span>
		          </div>
		          
		          
		        </li>
        	<?php endif;?>
      <?php endforeach;?>
      </ul>
  </li>

<?php endforeach;?>
</ul>