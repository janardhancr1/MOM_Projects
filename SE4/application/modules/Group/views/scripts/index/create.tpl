<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 6516 2010-06-23 01:15:53Z shaun $
 * @author	   John
 */
?>
<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Groups');?>
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
</div>-->

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class="layout_middle">
<div class="headline_header">
	<img src='./application/modules/Group/externals/images/group_add48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Create New Group');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/groups/manage'>Back to My Groups</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Create a new group today and invite friends to join.');?></div>
</div>
<?php echo $this->form->render($this) ?>
</div>