<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: delete.tpl 6512 2010-06-23 00:27:01Z shaun $
 * @access	   Sami
 */
?>

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Event/externals/images/event_event48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Delete Event:');?> <?php echo $this->subject()->__toString() ?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/events/manage'>Back to My Events</a></div>
    </div>
    <div class="smallheadline"></div>
</div>

<?php echo $this->form->render($this) ?>

</div>