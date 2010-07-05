<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: feed.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<?php if( !empty($this->feedOnly) || $this->activityCount >= 15 ): ?>
  <script type="text/javascript">
    (function(){
      var activity_count = <?php echo sprintf('%d', $this->activityCount) ?>;
      var next_id = <?php echo sprintf('%d', $this->nextid) ?>;
      var subject_guid = '<?php echo $this->subjectGuid ?>';
      en4.core.runonce.add(function(){
        if( next_id > 0 && activity_count >= 15 ){
          $('feed_viewmore').style.display = '';
          $('feed_loading').style.display = 'none';
          $('feed_viewmore_link').removeEvents('click').addEvent('click', function(){
            en4.activity.load(next_id, subject_guid);
          });
        } else {
          $('feed_viewmore').style.display = 'none';
          $('feed_loading').style.display = 'none';
        }
      });
    })();
  </script>
<?php endif; ?>

<?php if( !empty($this->feedOnly) ): // Simple feed only for AJAX
  echo $this->activityLoop($this->activity, array(
    'action_id' => $this->action_id,
    'viewAllComments' => $this->viewAllComments,
    'viewAllLikes' => $this->viewAllLikes,
  ));
  return; // Do not render the rest of the script in this mode
endif; ?>


<?php if( $this->showTitle ):  ?>
  <h3>
    <?php echo $this->translate("What's New?") ?>
  </h3>
<?php endif; ?>


<?php if( $this->enableComposer ): ?>
  <div class="activity-post-container">

    <form method="post" action="<?php echo $this->url(array('module' => 'activity', 'controller' => 'index', 'action' => 'post'), 'default', true) ?>" class="activity" enctype="application/x-www-form-urlencoded" id="activity-form">
      <textarea id="activity_body" cols="1" rows="1" name="body"></textarea>
      <input type="hidden" name="return_url" value="<?php echo $this->url() ?>" />
      <?php if( $this->viewer() && $this->subject() && !$this->viewer()->isSelf($this->subject())): ?>
        <input type="hidden" name="subject" value="<?php echo $this->subject()->getGuid() ?>" />
      <?php endif; ?>
      <div id="compose-menu" class="compose-menu">
        <button id="compose-submit" type="submit"><?php echo $this->translate("Share") ?></button>
      </div>
    </form>

    <?php
      $this->headScript()
        ->appendFile('application/modules/Core/externals/scripts/composer.js')
        ->appendFile('application/modules/Core/externals/scripts/composer_link.js')
        ->appendFile('application/modules/Album/externals/scripts/composer_photo.js')
        ->appendFile('application/modules/Video/externals/scripts/composer_video.js')
        ->appendFile($this->baseUrl() . '/externals/fancyupload/Swiff.Uploader.js')
        ->appendFile($this->baseUrl() . '/externals/fancyupload/Fx.ProgressBar.js')
        ->appendFile($this->baseUrl() . '/externals/fancyupload/FancyUpload2.js');
    ?>

    <script type="text/javascript">
      var composeInstance;
      en4.core.runonce.add(function() {
        composeInstance = new Composer('activity_body', {
          menuElement : 'compose-menu',
          baseHref : '<?php echo $this->baseUrl() ?>'
        });
      });
    </script>
    <?php foreach( $this->composePartials as $partial ): ?>
      <?php echo $this->partial($partial[0], $partial[1]) ?>
    <?php endforeach; ?>

  </div>
<?php endif; ?>

<?php // If requesting a single action and it doesn't exist, show error ?>
<?php if( !$this->activity ): ?>
  <?php if( $this->action_id ): ?>
    <h2><?php echo $this->translate("Activity Item Not Found"); ?></h2>
    <p>
      <?php echo $this->translate("The page you have attempted to access could not be found.") ?>
    </p>
  <?php return; else: ?>
    <div class="tip">
      <span>
        <?php echo $this->translate("Nothing has been posted here yet - be the first!") ?>
      </span>
    </div>
  <?php return; endif; ?>
<?php endif; ?>


<ul class='feed' id="activity-feed">
  <?php echo $this->activityLoop($this->activity, array(
    'action_id' => $this->action_id,
    'viewAllComments' => $this->viewAllComments,
    'viewAllLikes' => $this->viewAllLikes,
  )) ?>
</ul>

<div class="feed_viewmore" id="feed_viewmore" style="display: none;">
  <?php echo $this->htmlLink('javascript:void(0);', $this->translate('View More'), array(
    'id' => 'feed_viewmore_link',
    'class' => 'buttonlink icon_viewmore'
  )) ?>
</div>

<div class="feed_viewmore" id="feed_loading" style="display: none;">
  <img src='application/modules/Core/externals/images/loading.gif' style='float:left;margin-right: 5px;' />
  <?php echo $this->translate("Loading ...") ?>
</div>
