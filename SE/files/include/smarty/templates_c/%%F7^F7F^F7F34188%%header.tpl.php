<?php /* Smarty version 2.6.14, created on 2010-06-24 16:17:48
         compiled from header.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'header.tpl', 101, false),array('block', 'hook_foreach', 'header.tpl', 190, false),)), $this);
?><?php
SELanguage::_preload_multi(660,675,1019,26,655,89,29,30,975,691,654,653,652,645,647,1316,1198,1199);
SELanguage::load();
?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_global.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 
 if (@SE_DEBUG && $this->_tpl_vars['admin']->admin_exists): 
 $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_debug.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 
 endif; ?>

<div id="smoothbox_container"></div>



<table cellpadding='0' cellspacing='0' class='body' align='center' bgcolor='White'>
<tr>
<td width='100%'>



<div style='width:100%;'>
<table cellpadding='0' cellspacing='0' style='width: 100%; padding-top:5px; align='center'>
<tr>
	<td>
		  		<?php if (! $this->_tpl_vars['user']->user_exists): ?>
		<table cellpadding='0' cellspacing='0' align='right' style='padding-right: 4px;' width="100%">
			<tr>
				<td width="75%" align='Right'>
					<input type='checkbox' class='checkbox' name='persistent' value='1' id='rememberme' />
					<label for='rememberme' style='color:#D60077'><?php echo SELanguage::_get(660); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td style='padding-left: 6px;' width="15%" align='Right'>
					<a class="momlink" href='lostpass.php'><?php echo SELanguage::_get(675); ?></a>
				</td>
				<td style='padding-left: 6px;' width="10%">
					&nbsp;
				</td>
			</tr>
		</table>
		  		<?php else: ?>
  		<table cellpadding='0' cellspacing='0' align='right' style='padding: 0px 2px 2px 2px;' width="100%">
			<tr>
				<td width="45%" align='left' style='padding-left: 5px;'>
					<a class="momlink" href='invite.php'>Invite Moms you Know</a>
					<div class='newupdates' id='newupdates' style='display: none;'>
			        <div class='newupdates_content'>
			            <a href='javascript:void(0);' class='newupdates' onClick="SocialEngine.Viewer.userNotifyPopup(); return false;">
			            <?php $this->assign('notify_total', $this->_tpl_vars['notifys']['total_grouped']); ?>
			            <?php echo sprintf(SELanguage::_get(1019), "<span id='notify_total'>".($this->_tpl_vars['notify_total'])."</span>"); ?>
			            </a>
			            &nbsp;&nbsp; 
			            <a href='javascript:void(0);' class='newupdates' onClick="SocialEngine.Viewer.userNotifyHide(); return false;">X</a>
			          </div>
			      </div>
				</td>
				<td width="55%" align='Right' style='padding-right: 5px;'>
					<form method="POST" id="user_logout" action="user_logout.php" style="display:inline;margin:0;"><a class="momlink" href='user_logout.php?token=<?php echo $this->_tpl_vars['token']; ?>
' onclick="$('user_logout').submit(); return false;"><?php echo SELanguage::_get(26); ?></a></form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a class="momlink" href='user_account.php'><?php echo SELanguage::_get(655); ?></a>
				</td>
			</tr>
		</table>
		<?php endif; ?>
	</td>
</tr>
</table>

<div class='red_bar' style='padding:1px'>
 <?php if (! $this->_tpl_vars['user']->user_exists): ?>
<form action='login.php' method='post'>
<table cellpadding='0' cellspacing='0' align='Right' width="100%">
	<tr>
		<td width="75%" align='Right'>
			<input type='text' name='email' size='25' maxlength='100' value='<?php echo SELanguage::_get(89); ?>' onfocus="if(this.value == 'Email') this.value='';" onblur="if(this.value.length == 0) this.value='Email';" />
		</td>
		<td style='padding-left: 6px;' width="15%" align='Right'>
			<input type='password' name='password' id='passid1' size='25' maxlength='100' value='' style='display:none;' onblur="showText();" />
			<input type='text' name='password_text' id='passid2' size='25' maxlength='100' value='<?php echo SELanguage::_get(29); ?>' onfocus="showPass();"  />
		</td>
		<td style='padding-left: 6px;' width="10%" align='left'>
			<input type='submit' class='button' value='<?php echo SELanguage::_get(30); ?>' />
		</td>
	</tr>
	<?php if (! empty ( $this->_tpl_vars['setting']['setting_login_code'] )): ?>
	<tr>
		<td style='padding-top: 6px;'>
			<table cellpadding='0' cellspacing='0'>
				<tr>
					<td>
						<input type='text' name='login_secure' class='text' size='6' maxlength='10' />&nbsp;
					</td>
					<td>
						<table cellpadding='0' cellspacing='0'>
							<tr>
								<td align='center'>
									<img src='./images/secure.php' id='secure_image' border='0' height='20' width='67' class='signup_code' alt='' /><br />
									<a href="javascript:void(0);" onClick="$('secure_image').src = './images/secure.php?' + (new Date()).getTime();"><?php echo SELanguage::_get(975); ?></a>
								</td>
								<td><?php ob_start(); 
 echo SELanguage::_get(691); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('tip', ob_get_contents());ob_end_clean(); ?><img src='./images/icons/tip.gif' border='0' class='Tips1' title='<?php echo ((is_array($_tmp=$this->_tpl_vars['tip'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
' alt='' /></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php endif; ?>
</table>
<noscript><input type='hidden' name='javascript_disabled' value='1' /></noscript>
<input type='hidden' name='task' value='dologin' />
<input type='hidden' name='ip' value='<?php echo $this->_tpl_vars['ip']; ?>
' />
</form>
 <?php else: ?>
 <table cellpadding='0' cellspacing='0' style='padding: 2px;' width="100%">
	<tr>
		<td valign="bottom" align="left" style='padding-left: 5px;'>
			<div style='font-size:14px'>
			<a class="top_menu_item" href='user_messages.php'><?php echo SELanguage::_get(654); ?></a> &nbsp; &nbsp; &nbsp;
			<a class="top_menu_item" href='user_friends.php'><?php echo SELanguage::_get(653); ?></a> &nbsp; &nbsp; &nbsp;
			<a class="top_menu_item" href='profile.php?user=<?php echo $this->_tpl_vars['user']->user_info['user_username']; ?>
'><?php echo SELanguage::_get(652); ?></a>
			</div> 
		</td>
	</tr>
</table>
 <?php endif; ?>
</div>

    <table cellpadding='0' cellspacing='0' style='width: 100%; align='center'>
  <tr>
  <td align='left' valign='middle' style='padding-left:5px'>
    <a href='./home.php'><img src='./images/logo_new.gif' border='0' alt='' /></a>
  </td>
  <td align='right' valign='top'>
  	<span class='leader_text'>Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</span>
  		  <?php if ($this->_tpl_vars['ads']->ad_top != ""): ?>
	    <div class='ad_top' style='display: block; visibility: visible;'><?php echo $this->_tpl_vars['ads']->ad_top; ?>
</div>
	  <?php endif; ?>
  </td>
  </tr>
  </table>

</div>






<table cellpadding='0' cellspacing='0' style='width: 100%;' align='center'>
<tr>
<td nowrap='nowrap' class='top_menu'>
  <div class='top_menu_link_container'>
  	<div class='top_menu_link_start'></div>
    <div class='top_menu_link'>
      <a href='home.php' class='top_menu_item'>
        <?php echo SELanguage::_get(645); ?>
      </a>
    </div>
    <div class='top_menu_link_end'></div>
  </div>
  
  <div class='top_menu_link_container'>
  	<div class='top_menu_link_start'></div>
    <div class='top_menu_link'>
      <a href='invite.php' class='top_menu_item'>
        <?php echo SELanguage::_get(647); ?>
      </a>
    </div>
    <div class='top_menu_link_end'></div>
  </div>
  
  <div class='top_menu_link_container'>
  	<div class='top_menu_link_start'></div>
    <div class='top_menu_link'>
      <a href='browse_contests.php' class='top_menu_item'>
        Contests
      </a>
    </div>
    <div class='top_menu_link_end'></div>
  </div>

    <?php $this->_tag_stack[] = array('hook_foreach', array('name' => 'menu_main','var' => 'menu_main_args','complete' => 'menu_main_complete','max' => 9)); $_block_repeat=true;smarty_block_hook_foreach($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <div class='top_menu_link_container'>
      <div class='top_menu_link_start'></div>	
      <div class='top_menu_link'>
        <a href='<?php echo $this->_tpl_vars['menu_main_args']['file']; ?>
' class='top_menu_item'>
          <?php echo SELanguage::_get($this->_tpl_vars['menu_main_args']['title']); ?>
        </a>
      </div>
      <div class='top_menu_link_end'></div>
    </div>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook_foreach($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  
  <?php if (! $this->_tpl_vars['menu_main_complete']): ?>
    <div class='top_menu_link_container top_menu_main_link_container'>
      <div class='top_menu_link_start'></div>
      <div class='top_menu_link top_menu_main_link'>
        <a href="javascript:void(0);" onclick="$('menu_main_dropdown').style.display = ( $('menu_main_dropdown').style.display=='none' ? 'inline' : 'none' ); this.blur(); return false;" class='top_menu_item'>
          <?php echo SELanguage::_get(1316); ?>
        </a>
      </div>
      <div class='top_menu_link_end'></div>
      <div class='menu_main_dropdown' id='menu_main_dropdown' style='display: none;'>
        
                    <?php $this->_tag_stack[] = array('hook_foreach', array('name' => 'menu_main','var' => 'menu_main_args','start' => 9)); $_block_repeat=true;smarty_block_hook_foreach($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <div class='menu_main_item_dropdown'>
            <a href='<?php echo $this->_tpl_vars['menu_main_args']['file']; ?>
' class='menu_main_item' style="text-align: left;">
              <?php echo SELanguage::_get($this->_tpl_vars['menu_main_args']['title']); ?>
            </a>
          </div>
          <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_hook_foreach($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        
      </div>
    </div>
  <?php endif; ?>

</td>
</tr>
</table>



<?php if ($this->_tpl_vars['user']->user_exists): 
 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(1198,1199));
$javascript_lang_import_first = TRUE;
if( is_array($javascript_lang_import_list) && !empty($javascript_lang_import_list) )
{
  echo "\n<script type='text/javascript'>\n<!--\n";
  echo "SocialEngine.Language.Import({\n";
  foreach( $javascript_lang_import_list as $javascript_import_id )
  {
    if( !$javascript_lang_import_first ) echo ",\n";
    echo "  ".$javascript_import_id." : '".addslashes(SE_Language::_get($javascript_import_id))."'";
    $javascript_lang_import_first = FALSE;
  }
  echo "\n});\n//-->\n</script>\n";
}
 ?>
<script type='text/javascript'>
<!--
var notify_update_interval;
window.addEvent('domready', function() {
  SocialEngine.Viewer.userNotifyGenerate(<?php echo $this->_tpl_vars['se_javascript']->generateNotifys($this->_tpl_vars['notifys']); ?>
);
  SocialEngine.Viewer.userNotifyShow();
  notify_update_interval = (function() {
    if( notify_update_interval ) SocialEngine.Viewer.userNotifyUpdate();
  }).periodical(60 * 1000);
});
//-->
</script>
<div style='display: none;' id='newupdates_popup'></div>
<?php endif; ?>
 



<table cellpadding='0' cellspacing='0' align='center' style='width: 100%;'>
<tr>

<?php if ($this->_tpl_vars['ads']->ad_left != ""): ?>
  <td valign='top'><div class='ad_left' style='display: block; visibility: visible;'><?php echo $this->_tpl_vars['ads']->ad_left; ?>
</div></td>
<?php endif; ?>

<td valign='top'>

<div class='content'>

    <?php if ($this->_tpl_vars['ads']->ad_belowmenu != ""): ?><div class='ad_belowmenu' style='display: block; visibility: visible;'><?php echo $this->_tpl_vars['ads']->ad_belowmenu; ?>
</div><?php endif; ?>