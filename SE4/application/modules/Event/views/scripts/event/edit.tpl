<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Event
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: edit.tpl 4022 2010-03-01 23:24:23Z szerrade $
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
<div class='search_box'>
	<div class='page_header'>
		<img src='./application/modules/Event/externals/images/event_event48.gif' border='0' class='icon_big'><?php echo $this->translate('Edit Event: ');?><?php echo $this->subject()->__toString() ?>
		<div>
			<?php echo $this->translate('All of this events details are displayed and can be changed below.');?>
		</div>
	</div>
	<br>
</div>
<?php echo $this->form/*->setAttrib('class', 'global_form_popup')*/->render($this) ?>