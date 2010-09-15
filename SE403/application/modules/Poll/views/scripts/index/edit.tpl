<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: edit.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     Steve
 */
?>

<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Polls');?>
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
-->

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>
<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Poll/externals/images/poll_poll48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Edit Poll Privacy');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/polls/manage'>Back to My Polls</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Edit your poll privacy below, then apply the new privacy settings for the poll.');?></div>
</div>
<?php echo $this->form->render($this) ?>
</div>
