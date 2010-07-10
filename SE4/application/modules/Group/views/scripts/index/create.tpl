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
</div>
<div class='search_box'>
	<div class='page_header'>
		<img src='./application/modules/Group/externals/images/group_add48.gif' border='0' class='icon_big'><?php echo $this->translate('Create New Group');?>
		<div>
			<?php echo $this->translate('Please give us some information about your new group. After you have created your group, you can begin inviting other users to become members. ');?>
		</div>
	</div>
	<br>
	<?php echo $this->form->render($this) ?>
</div>

