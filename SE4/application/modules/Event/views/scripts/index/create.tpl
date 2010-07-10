<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 5334 2010-05-01 03:27:01Z alex $
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
<div class='search_box'>
	<div class='page_header'>
		<img src='./application/modules/Event/externals/images/event_event48.gif' border='0' class='icon_big'><?php echo $this->translate('Create New Event');?>
		<div>
			<?php echo $this->translate('Please give us some information about your new event. After you have created your event, you can begin inviting other users to attend.');?>
		</div>
	</div>
	
</div>
<?php
echo $this->form->render();