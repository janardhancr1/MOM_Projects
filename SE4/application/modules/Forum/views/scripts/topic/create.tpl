<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 6515 2010-06-23 00:53:16Z shaun $
 * @author     John
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
<?php echo $this->htmlLink(array('route'=>'forum_general'), "Forums");?>
  &#187; <?php echo $this->htmlLink(array('route'=>'forum_forum', 'forum_id'=>$this->forum->getIdentity()), $this->forum->getTitle());?>  
  &#187 <?php echo $this->translate('Post Topic');?>
</h2>

<?php echo $this->form->render($this) ?>
</div>