<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Sami
 */
?>
<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>

<div class='layout_middle'>
<script type="text/javascript">
function showUploader()
{
  $('photo').style.display = 'block';
  $('photo-label').style.display = 'none';
}
</script>
<h2>
<?php echo $this->htmlLink(array('route'=>'forum_general'), $this->translate("Forums"));?>
  &#187; <?php echo $this->htmlLink(array('route'=>'forum_forum', 'forum_id'=>$this->forum->getIdentity()), $this->forum->getTitle());?>
  &#187; <?php echo $this->htmlLink(array('route'=>'forum_topic', 'topic_id'=>$this->topic->getIdentity()), $this->topic->getTitle());?>
  &#187 <?php echo $this->translate('Post Reply');?>
</h2>
<?php echo $this->form->render($this) ?>
</div>
