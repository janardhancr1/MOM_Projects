<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     Sami
 */
?>

<?php
$this->headScript()
  ->appendFile($this->baseUrl() . '/externals/calendar/calendar.compat.js');
$this->headLink()
  ->appendStylesheet($this->baseUrl() . '/externals/calendar/styles.css');
?>
<script type="text/javascript">
  var myCalStart = false;
  var myCalEnd = false;

  en4.core.runonce.add(function init() 
  {
    monthList = [];
    myCal = new Calendar({ 'starttime[date]': 'M d Y', 'endtime[date]' : 'M d Y' }, {
      classes: ['event_calendar'],
      pad: 0,
      direction: 0
    });
  });
</script>
<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Events');?>
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
    <?php echo $this->translate('Create New Event');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/events/manage'>Back to My Events</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Create a new event today and invite friends.');?></div>
</div>
<?php
echo $this->form->render();
?>
</div>