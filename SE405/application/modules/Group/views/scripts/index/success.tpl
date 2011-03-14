<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Group
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: success.tpl 6537 2010-06-23 22:51:46Z shaun $
 * @author     Jung
 */
?>

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>  

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Group/externals/images/group_add48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Group Created');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/group/manage'>Back to My Groups</a></div>
	</div>
    <div class="smallheadline"></div>
</div>
<div style='padding-top:20px;padding-right:10px;width:690px'>
<div class='global_form'>
  <form method="post" class="global_form">
    <div>
      <div>
      <p>
        <?php echo $this->translate('Your Group was successfully created. Would you like to invite your friends to join this group?');?>
      </p>
      <br />
      <p>
        <input type="hidden" name="confirm" value="true"/>
        <button type='submit'><?php echo $this->translate('Invite your friends');?></button>
        <?php echo $this->translate('or');?> <a href='<?php echo $this->url(array(), 'group_general', true) ?>'><?php echo $this->translate('continue to My Groups');?></a>
      </p>
    </div>
    </div>
  </form>
</div>
</div>