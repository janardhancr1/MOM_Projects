<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: edit.tpl 6516 2010-06-23 01:15:53Z shaun $
 * @author	   John
 */
?>
<div class='search_box'>
	<div class='page_header'>
		<img src='./application/modules/Group/externals/images/group_edit48.gif' border='0' class='icon_big'><?php echo $this->translate('Edit Group: ');?><?php echo $this->subject()->__toString() ?>
		<div>
			<?php echo $this->translate('All of this groups details are displayed and can be changed below. ');?>
		</div>
	</div>
</div>
	<br>
<?php echo $this->form/*->setAttrib('class', 'global_form_popup')*/->render($this) ?>