<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: view.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */
?>

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>
<div class='layout_middle'>
<h2>
<?php echo $this->htmlLink(array('route'=>'forum_general'), $this->translate("Forums"));?>
  &#187; <?php echo $this->htmlLink(array('route'=>'forum_forum', 'forum_id'=>$this->forum->getIdentity()), $this->forum->getTitle());?>
</h2>
<div style='padding-top:10px;padding-right:10px;width:680px'>

<div class="forum_topic_title_wrapper">
  <div class="forum_topic_title_options">
    <?php echo $this->htmlLink(array('route' => 'forum_forum', 'forum_id' => $this->forum->getIdentity()), $this->translate('Back To Topics'), array(
      'class' => 'buttonlink icon_back'
    )) ?>
    <?php if ($this->can_reply):?>
      <?php echo $this->htmlLink(array('route' => 'forum_post', 'action'=>'create', 'post_id' => $this->topic->getIdentity()), $this->translate('Post Reply'), array(
        'class' => 'buttonlink icon_forum_post_reply'
      )) ?>
    <?php endif;?>
  </div>
  <div class="forum_topic_title">
    <h3><?php echo $this->topic->title;?></h3>
  </div>
</div>

<?php if( $this->can_moderate || $this->forum->isOwner($this->viewer())): ?>
  <div class="forum_topic_options">

    <?php if( $this->can_moderate ): ?>
      <?php if( !$this->topic->sticky ): ?>
        <?php echo $this->htmlLink(array('action' => 'sticky', 'sticky' => '1', 'reset' => false), $this->translate('Make Sticky'), array(
          'class' => 'buttonlink icon_forum_post_stick'
        )) ?>
      <?php else: ?>
        <?php echo $this->htmlLink(array('action' => 'sticky', 'sticky' => '0', 'reset' => false), $this->translate('Remove Sticky'), array(
          'class' => 'buttonlink icon_forum_post_unstick'
        )) ?>
      <?php endif; ?>
      <?php if( !$this->topic->closed ): ?>
        <?php echo $this->htmlLink(array('action' => 'close', 'close' => '1', 'reset' => false), $this->translate('Close'), array(
          'class' => 'buttonlink icon_forum_post_close'
        )) ?>
      <?php else: ?>
        <?php echo $this->htmlLink(array('action' => 'close', 'close' => '0', 'reset' => false), $this->translate('Open'), array(
          'class' => 'buttonlink icon_forum_post_unclose'
        )) ?>
      <?php endif; ?>
      <?php echo $this->htmlLink(array('action' => 'rename', 'reset' => false), $this->translate('Rename'), array(
        'class' => 'buttonlink smoothbox icon_forum_post_rename'
      )) ?>
      <?php echo $this->htmlLink(array('action' => 'delete', 'reset' => false), $this->translate('Delete'), array(
        'class' => 'buttonlink smoothbox icon_forum_post_delete'
      )) ?>
    <?php elseif( $this->forum->isOwner($this->viewer()) == false): ?>
      <?php if( $this->topic->closed ): ?>
        <div class="forum_discussions_thread_options_closed">
          <?php echo $this->translate('This topic has been closed.');?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>
<?php endif; ?>

<div class="forum_topic_pages">
  <?php echo $this->paginationControl($this->paginator); ?>
</div>

<ul class="forum_topic_posts">
  <?php foreach ($this->paginator as $post): ?>
    <?php $user = $this->user($post->user_id); ?>
    <?php $signature = $post->getSignature(); ?>
    <li>
      <div class="forum_topic_posts_author">
        <div class="forum_topic_posts_author_name">
        <?php echo $user->__toString(); ?>
        </div>
        <div class="forum_topic_posts_author_photo">
        <?php echo $this->itemPhoto($user); ?>
        </div>
        <ul class="forum_topic_posts_author_info">
          <?php if ($post->getOwner()):?>
            <?php if ($this->forum->isModerator($post->getOwner())):?>
              <li class="forum_topic_posts_author_info_title"><?php echo $this->translate('Moderator');?></li>
            <?php endif;?>
          <?php endif;?>

          <?php if( $signature ): ?>
            <li>
              <?php echo $signature->post_count; ?>
              <?php echo $this->translate('posts');?>
            </li>
          <?php endif; ?>
        </ul>
      </div>
      <div class="forum_topic_posts_info">
        <div class="forum_topic_posts_info_top">
          <div class="forum_topic_posts_info_top_date">
            <?php echo $this->locale()->toDateTime(strtotime($post->creation_date));?>
          </div>
          <div class="forum_topic_posts_info_top_options">
            <?php if ($this->can_reply):?>
              <a href="<?php echo $this->url(array('quote_id'=>$post->getIdentity(), 'topic_id'=>$this->subject()->getIdentity()), 'forum_post_create');?>" class="buttonlink icon_forum_post_quote"><?php echo $this->translate('Quote');?></a>
            <?php endif;?>
            <?php if ($post->canEdit($this->viewer())):?>
              <a href="<?php echo $this->url(array('post_id'=>$post->getIdentity(), 'action'=>'edit'), 'forum_post'); ?>" class="buttonlink icon_forum_post_edit"><?php echo $this->translate('Edit');?></a>
            <?php endif;?>
            <?php if (!$this->first_post && $post->canDelete($this->viewer())):?>
              <a href="<?php echo $this->url(array('post_id'=>$post->getIdentity(), 'action'=>'delete'), 'forum_post');?>" class="buttonlink smoothbox icon_forum_post_delete"><?php echo $this->translate('Delete');?></a>
            <?php endif;?>
            <?php $this->first_post = false;?>

          </div>
        </div>
        <div class="forum_topic_posts_info_body">
          <?php if ($this->decode_bbcode) 
          {
            echo nl2br($this->BBCode($post->body));
    }
    else
          {
            echo $post->body;  
          }?>
    <?php if ($post->edit_id):?>
            <i>
              <?php echo $this->translate('This post was edited by %1$s at %2$s', $this->user($post->edit_id)->__toString(), $this->locale()->toDateTime(strtotime($post->creation_date))); ?>
            </i>
          <?php endif;?>
        </div>
        <?php if ($post->file_id):?>
          <div class="forum_topic_posts_info_photo">
            <?php echo $this->itemPhoto($post, null, '', array('class'=>'forum_post_photo'));?>
          </div>
        <?php endif;?>
      </div>
    </li>
  <?php endforeach;?>
</ul>

<div class="forum_topic_pages">
  <?php echo $this->paginationControl($this->paginator); ?>
</div>

<?php if ($this->can_reply) { echo $this->form->render(); } ?>
</div>
</div>