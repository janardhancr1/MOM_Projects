<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Activity
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: deleted-comment.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Steve
 */
?>

<script type="text/javascript">
  parent.$('comment-<?php echo $this->comment_id ?>').destroy();
  setTimeout(function()
  {
    parent.Smoothbox.close();
  }, 1000 );
</script>

  <div class="global_form_popup_message">
    <?php echo $this->message ?>
  </div>