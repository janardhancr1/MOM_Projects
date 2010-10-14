<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7250 2010-09-01 07:42:35Z john $
 * @author     John
 */
?>

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Forum/externals/images/forum_forum16_1.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Mom Forums');?></div>
    <div class="smallheadline"><?php echo $this->translate('Share your opinion on products and services moms use daily');?></div>
</div>
<div style='padding-top:20px;padding-right:10px;width:680px'>

<ul class="forum_categories">

<?php foreach( $this->categories as $category ): ?>
  <li>
    <div>
      <h3><?php echo $this->translate($category->getTitle()) ?></h3>
    </div>
    <ul>

      <?php foreach ($category->getChildren('forum_forum', array('order'=>'order')) as $forum):?>
      <?php
         $last_topic = $forum->getLastUpdatedTopic();
         if ($last_topic) {
           $last_post = $last_topic->getLastCreatedPost();
           $last_user = $this->user($last_post->user_id);
         }
       ?>
        <li>
          <div class="forum_icon">
            <a href="<?php echo $forum->getHref();?>"><img src='application/modules/Forum/externals/images/forum.png' alt='' /></a>
          </div>
          <div class="forum_lastpost">
          <?php if( $last_topic ): ?>
            <a href="<?php echo $last_post->getHref();?>"><?php echo $this->itemPhoto($last_user, 'thumb.icon');?></a>
            <span class="forum_lastpost_info">
              <?php echo $this->translate(
                'Last reply by %1$s in %2$s',
                $last_user->__toString(),
                $this->htmlLink($last_post->getHref(), $last_topic->getTitle())
              ) ?>
              <?php echo $this->timestamp($last_post->creation_date, array('class' => 'forum_lastpost_date')) ?>
            </span>
          <?php endif;?>
          </div>
          <div class="forum_posts">
            <span><?php echo $forum->post_count;?></span>
            <span>
              <?php echo $this->translate(array('post', 'posts', $forum->post_count),$this->locale()->toNumber($forum->post_count)) ?>
            </span>
          </div>
          <div class="forum_topics">
            <span><?php echo $forum->topic_count;?></span>
            <span>
              <?php echo $this->translate(array('topic', 'topics', $forum->topic_count),$this->locale()->toNumber($forum->topic_count)) ?>
            </span>
          </div>
          <div class="forum_title">
            <h3><?php echo $this->htmlLink(array('route'=>'forum_forum', 'forum_id'=>$forum->getIdentity()), $this->translate($forum->getTitle()));?></h3>
            <span><?php echo $forum->getDescription();?></span>
          </div>
        </li>
      <?php endforeach;?>
      </ul>
  </li>

<?php endforeach;?>
</ul>
</div>
</div>

