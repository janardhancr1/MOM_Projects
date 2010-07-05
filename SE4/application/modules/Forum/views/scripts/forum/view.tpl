<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: view.tpl 6515 2010-06-23 00:53:16Z shaun $
 * @author     John
 */
?>

<h2>
<?php echo $this->htmlLink(array('route'=>'forum_general'), $this->translate("Forums"));?>
  &#187; <?php echo $this->forum->getTitle();?>
</h2>

<div class="forum_header">
  <div class="forum_header_options">
    <?php 
      if ($this->can_post) 
      {
        echo $this->htmlLink(array('route' => 'forum_topic_create', 'forum_id' => $this->forum->getIdentity()), $this->translate('Post New Topic'), array(
          'class' => 'buttonlink icon_forum_post_new'
        ));
    }
  ?>
  </div>
  <div class="forum_header_pages">
    <?php echo $this->paginationControl($this->paginator);?>
  </div>
  <div class="forum_header_moderators">
    <?php echo $this->translate('Moderators:');?>
    <?php
      $i = 0;
      foreach ($this->moderators as $moderator)
      {
        if ($i > 0)
        {
          echo ', ';
        }
        $i++;

        echo $moderator->__toString();
      }
    ?>
  </div>
</div>

<?php if (count($this->stickies) + count($this->paginator) > 0):?>
  <ul class="forum_topics">
    <?php foreach (array($this->stickies, $this->paginator) as $topic_list):?>
      <?php foreach ($topic_list as $topic):?>
        <?php
          $last_post = $topic->getLastCreatedPost();
          if ($last_post) {
            $last_user = $this->user($last_post->user_id);
          }
          else
          {
            $last_user = $this->user($topic->user_id);
          }
      ?>
      <li>
        <div class="forum_topics_icon">
          <?php if ($topic->isViewed($this->viewer())):?>
            <?php echo $this->HtmlLink(array('route'=>'forum_topic', 'topic_id'=>$topic->getIdentity()), "<img src='application/modules/Forum/externals/images/topic.png' alt='' />");?>
          <?php else:?>
            <?php echo $this->HtmlLink(array('route'=>'forum_topic', 'topic_id'=>$topic->getIdentity()), "<img src='application/modules/Forum/externals/images/topic_unread.png' alt='' />");?>
          <?php endif;?>
          </div>
            <div class="forum_topics_lastpost">
              <a href="<?php echo $last_post->getHref();?>"><?php echo $this->itemPhoto($last_user, 'thumb.icon');?></a>
              <span class="forum_topics_lastpost_info">
              <?php if ($last_post):?>
                <?php echo $this->htmlLink($last_post->getHref(), $this->translate("Last post"));?> <?php echo $this->translate('by');?> <?php echo $last_user->__toString();?>
                <?php echo $this->timestamp($topic->modified_date, array('class' => 'forum_topics_lastpost_date')) ?>
              <?php endif;?>
            </span>
          </div>
        <div class="forum_topics_views">
          <span>
            <?php echo $this->translate(array('%1$s %2$s view', '%1$s %2$s views', $topic->view_count), $this->locale()->toNumber($topic->view_count), '</span><span>') ?>
          </span>
        </div>
      <div class="forum_topics_replies">
        <span>
          <?php echo $this->translate(array('%1$s %2$s reply', '%1$s %2$s replies', $topic->post_count-1), $this->locale()->toNumber($topic->post_count-1), '</span><span>') ?>
        </span>
      </div>
      <div class="forum_topics_title">
        <h3<?php if ($topic->closed):?> class="closed"<?php endif;?><?php if ($topic->sticky):?> class="sticky"<?php endif;?>>
          <?php echo $this->HtmlLink(array('route'=>'forum_topic', 'topic_id'=>$topic->getIdentity()), $topic->getTitle());?>
        </h3>
        <?php echo $this->pageLinks($topic);?>
      </div>
    </li>
    <?php endforeach;?>
  <?php endforeach;?>
</ul>
<?php endif;?>
<div class="forum_pages">
  <?php echo $this->paginationControl($this->paginator);?>
</div>