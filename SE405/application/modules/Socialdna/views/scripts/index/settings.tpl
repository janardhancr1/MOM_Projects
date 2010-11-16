<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . '/application/modules/Semods/externals/scripts/semods.js')
    ->appendFile($this->baseUrl() . '/application/modules/Socialdna/externals/scripts/socialdna.js')
?>
<div class='layout_middle'>
<?php if( count($this->navigation) ): ?>
<div class="headline">
  <h2>
	<?php echo $this->translate('Social DNA');?>
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
<?php endif; ?>


<form class='global_form' action="<?php echo $this->url(array(), 'socialdna_settings')?>" method='post' name='info'>
<input type="hidden" name="task" value="dosave">
<div><div>

<?php if($this->success == 1) : ?>
<ul class="form-notices"><li><?php echo $this->translate('Settings were successfully saved.') ?></li></ul>
<?php endif; ?>

<?php if(Engine_Api::_()->getDbTable('modules','core')->hasModule('socialdnapublisher')) : ?>

<h3><?php echo $this->translate('socialdna_social_settings_status'); ?></h3>
<p class="form-description">
  <?php echo $this->translate('socialdna_social_settings_status_help'); ?>
</p>


<div class="form-elements">


<div class="form-wrapper">

  <div class="form-label">
	<label class="optional"><?php echo $this->translate('socialdna_social_settings_status_update'); ?></label>
  </div>

  <div class="form-element">
	<ul class="form-options-wrapper">
	  <li><input type='radio' name='openidconnect_autostatus' id='openidconnect_autostatus_0' value='0'<?php if ($this->openidconnect_autostatus == 0): ?> checked='checked'<?php endif; ?>><label for='openidconnect_autostatus_0'><?php echo $this->translate('socialdna_facebook_status_update_ask'); ?></label></li>
	  <li><input type='radio' name='openidconnect_autostatus' id='openidconnect_autostatus_1' value='1'<?php if ($this->openidconnect_autostatus == 1): ?> checked='checked'<?php endif; ?>><label for='openidconnect_autostatus_1'><?php echo $this->translate('socialdna_facebook_status_update_auto'); ?></label></li>
	  <li><input type='radio' name='openidconnect_autostatus' id='openidconnect_autostatus_2' value='2'<?php if ($this->openidconnect_autostatus == 2): ?> checked='checked'<?php endif; ?>><label for='openidconnect_autostatus_2'><?php echo $this->translate('socialdna_social_settings_status_noupdate'); ?></label></li>
	</ul>
  </div>
  
</div>


</div>

<br><br>

<h3><?php echo $this->translate('socialdna_social_settings_newsfeedstories') ?></h3>
<p class="form-description">
  <?php echo $this->translate('socialdna_social_settings_newsfeedstories_help') ?>
</p>

<br>
  
<div class="form-elements">
  
<table cellspacing=0 cellpadding=0 style='margin-left: 62px'>
<thead>
  <th style="padding: 7px 10px 7px 10px; border-bottom: 1px solid #CCC"> Story </th>
  <th style="padding: 7px 10px 7px 10px; border-bottom: 1px solid #CCC"> <?php echo $this->translate('socialdna_social_settings_newsfeedstories_publish') ?> </th>
  <th style="padding: 7px 10px 7px 10px; border-bottom: 1px solid #CCC"> <?php echo $this->translate('socialdna_social_settings_newsfeedstories_publish_prompt') ?> </th>
</thead>
<?php foreach($this->openidconnect_facebook_feed_stories as $feedstory): ?>
<tr>
  <td style="padding: 7px 20px 7px 10px;">

  <?php if($feedstory['feedstory_icon'] != ''): ?> <img style='float: left; border: 0px; padding-right: 5px; width: 16px; height: 16px' src="<?php echo $feedstory['feedstory_icon'] ?>"> <?php else: ?><div style='float: left; width: 21px'>&nbsp;</div><?php endif; ?> <?php echo $this->translate($feedstory['feedstory_desc']) ?>
    
  </td>
  <td style="padding: 7px 20px 7px 10px;text-align: center">
    <input style='display:inline; float: none' type=checkbox value="1" name="feedstory[<?php echo $feedstory['feedstory_id'] ?>]" class="checkbox" <?php if ($feedstory['feedstory_selected'] == 1): ?> checked="checked"<?php endif; ?> />
  </td>
  <td style='text-align: center'>

    <?php if (!$feedstory['feedstory_publishprompt']): ?>
      <input style='display:inline; float: none' type=checkbox value="1" name="feedstoryauto[<?php echo $feedstory['feedstory_id'] ?>]" class="checkbox" <?php if ($feedstory['feedstory_auto'] == 1): ?> checked="checked"<?php endif; ?> />
    <?php else : ?>
	  &nbsp;
    <?php endif; ?>
	
  </td>
</tr>
<?php endforeach; ?>
</table>

<br>

</div>

<br>

<?php endif; ?>

<h3><?php echo $this->translate('socialdna_facebook_instant_login') ?></h3>
<p class="form-description"><?php echo $this->translate('socialdna_facebook_instant_login_help') ?></p>


<div class="form-elements">
  
  <div id="openidconnect_autologin-wrapper" class="form-wrapper">
	<div id="openidconnect_autologin-label" class="form-label">
	  <label for="openidconnect_autologin" class="optional"><?php echo $this->translate('socialdna_facebook_enable_instant_login_question') ?></label>
	</div>
	<div id="openidconnect_autologin-element" class="form-element">
	  <ul class="form-options-wrapper">
		<li><input name="openidconnect_autologin" id="openidconnect_autologin-0" value="0" <?php if($this->openidconnect_autologin == 0): ?>checked="checked"<?php endif;?> type="radio"><label for="openidconnect_autologin-0"><?php echo $this->translate('socialdna_facebook_enable_instant_login_ask') ?></label></li>
		<li><input name="openidconnect_autologin" id="openidconnect_autologin-1" value="1" <?php if($this->openidconnect_autologin == 1): ?>checked="checked"<?php endif;?> type="radio"><label for="openidconnect_autologin-1"><?php echo $this->translate('socialdna_facebook_enable_instant_login_yes') ?></label></li>
		<li><input name="openidconnect_autologin" id="openidconnect_autologin-2" value="2" <?php if($this->openidconnect_autologin == 2): ?>checked="checked"<?php endif;?> type="radio"><label for="openidconnect_autologin-2"><?php echo $this->translate('socialdna_facebook_enable_instant_login_no') ?></label></li>
	  </ul>
	</div>
  </div>

<br>

<div class="form-wrapper">
  <div class="form-label">&nbsp;</div>
  <div class="form-element">
	<button type="submit" id="submit" name="submit"><?php echo $this->translate("Save Changes"); ?></button>
  </div>
</div>
  
</div>  
  
</div></div>
</form>
</div>


  