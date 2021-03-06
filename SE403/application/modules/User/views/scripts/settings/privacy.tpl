<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: privacy.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     Steve
 */
?>
<div class='layout_middle'>
<div class="headline">
  <h2>
    <?php echo $this->translate('My Settings');?>
  </h2>
  <div class="tabs">
    <?php
      // Render the menu
      echo $this->navigation()
        ->menu()
        ->setContainer($this->navigation)
        ->render();
    ?>
  </div>
</div>

<?php echo $this->form->render($this) ?>

<div id="blockedUserList" style="display:none;">
  <ul>
    <?php foreach ($this->blockedUsers as $user): ?>
      <li>[ <a class="smoothbox" href="../../member/block/remove/<?php echo $user->username ?>"><?php echo $this->translate('We now');?></a> ] <?php echo $user->username ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<script type="text/javascript">
<!--
window.addEvent('load', function(){
  $$('#blockedUserList ul')[0].inject($('blockList-element'));
});
// -->
</script>
</div>
