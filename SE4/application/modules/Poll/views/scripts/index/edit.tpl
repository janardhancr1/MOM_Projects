<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: edit.tpl 5333 2010-05-01 03:23:01Z alex $
 * @author     Steve
 */
?>

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
<div class='search_box'>
	<div class='page_header'>
		<img src='./application/modules/Poll/externals/images/poll_poll48.gif' border='0' class='icon_big'><?php echo $this->translate('Edit Poll');?>
		<div>
			<?php echo $this->translate('Edit the details of this poll below.');?>
		</div>
	</div>
</div>
<?php echo $this->form->render($this) ?>
