<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 7298 2010-09-06 05:52:07Z john $
 * @author     Sami
 */
?>

<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Meetups');?>
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
	<img src='./application/modules/Event/externals/images/event_event48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <a href='/index.php/events/create'><?php echo $this->translate('Create New Meetup');?></a>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/meetups/manage'>Back to My Meetups</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Create a new Meetup today and invite friends.');?></div>
</div>
<?php
echo $this->form->render();
?>
</div>