<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: delete.tpl 6516 2010-06-23 01:15:53Z shaun $
 * @author		 John
 */
?>

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class="layout_middle">
<div class="headline_header">
	<img src='./application/modules/Group/externals/images/group_delete48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Delete Group:')?> <?php echo $this->subject()->__toString() ?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/groups/manage'>Back to My Groups</a></div>
    </div>
    <div class="smallheadline"></div>
</div>
<?php echo $this->form->render($this) ?>
</div>