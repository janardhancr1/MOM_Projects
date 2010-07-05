<?php /* Smarty version 2.6.14, created on 2010-05-26 13:51:36
         compiled from user_group_edit.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'user_group_edit.tpl', 19, false),array('modifier', 'replace', 'user_group_edit.tpl', 77, false),array('modifier', 'count', 'user_group_edit.tpl', 79, false),array('modifier', 'in_array', 'user_group_edit.tpl', 356, false),)), $this);
?><?php
SELanguage::_preload_multi(2000097,2000118,2000119,2000121,2000122,2000120,2000123,191,2000186,175,39,2000124,770,771,772,714,2000125,2000094,2000098,2000116,173,2000177);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table class='tabs' cellpadding='0' cellspacing='0'>
  <tr>
    <td class='tab0'>&nbsp;</td>
    <td class='tab1' NOWRAP><a href='user_group_edit.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><?php echo SELanguage::_get(2000097); ?></a></td><td class='tab'>&nbsp;</td>
    <td class='tab2' NOWRAP><a href='user_group_edit_members.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><?php echo SELanguage::_get(2000118); ?></a></td><td class='tab'>&nbsp;</td>
    <td class='tab2' NOWRAP><a href='user_group_edit_settings.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'><?php echo SELanguage::_get(2000119); ?></a></td><td class='tab'>&nbsp;</td>
    <td class='tab3'>&nbsp;</td>
  </tr>
</table>

<table cellpadding='0' cellspacing='0' width='100%'>
  <tr>
    <td valign='top'>
      <img src='./images/icons/group_edit48.gif' border='0' class='icon_big' />
      <?php ob_start(); ?><a href='<?php echo $this->_tpl_vars['url']->url_create('group',@NULL,$this->_tpl_vars['group']->group_info['group_id']); ?>
'><?php echo ((is_array($_tmp=$this->_tpl_vars['group']->group_info['group_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>
</a><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('linked_groupname', ob_get_contents());ob_end_clean(); ?>
      <div class='page_header'><?php echo sprintf(SELanguage::_get(2000121), $this->_tpl_vars['linked_groupname']); ?></div>
      <?php echo SELanguage::_get(2000122); ?>
    </td>
    <td valign='top' align='right'>
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td class='button'>
            <a href='user_group.php'>
              <img src='./images/icons/back16.gif' border='0' class='button' />
              <?php echo SELanguage::_get(2000120); ?>
            </a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br />


<?php if ($this->_tpl_vars['justadded'] == 1): ?>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'>
    <img src='./images/success.gif' border='0' class='icon' />
    <?php echo SELanguage::_get(2000123); ?>
  </td></tr></table>
  <br />
<?php endif; 
 if ($this->_tpl_vars['result'] != 0): ?>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'>
    <img src='./images/success.gif' border='0' class='icon' />
    <?php echo SELanguage::_get(191); ?>
  </td></tr></table>
  <br />
<?php endif; 
 if ($this->_tpl_vars['is_error'] != 0): ?>
  <table cellpadding='0' cellspacing='0'>
  <tr><td class='result'>
    <img src='./images/error.gif' class='icon' border='0' />
    <?php echo SELanguage::_get($this->_tpl_vars['is_error']); ?>
  </td></tr></table>
  <br>
<?php endif; 
 echo '
<script type=\'text/javascript\'>
<!--

  var cats = {0:{\'title\':\'\',\'subcats\':{}}'; 
 unset($this->_sections['cat_loop']);
$this->_sections['cat_loop']['name'] = 'cat_loop';
$this->_sections['cat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cat_loop']['show'] = true;
$this->_sections['cat_loop']['max'] = $this->_sections['cat_loop']['loop'];
$this->_sections['cat_loop']['step'] = 1;
$this->_sections['cat_loop']['start'] = $this->_sections['cat_loop']['step'] > 0 ? 0 : $this->_sections['cat_loop']['loop']-1;
if ($this->_sections['cat_loop']['show']) {
    $this->_sections['cat_loop']['total'] = $this->_sections['cat_loop']['loop'];
    if ($this->_sections['cat_loop']['total'] == 0)
        $this->_sections['cat_loop']['show'] = false;
} else
    $this->_sections['cat_loop']['total'] = 0;
if ($this->_sections['cat_loop']['show']):

            for ($this->_sections['cat_loop']['index'] = $this->_sections['cat_loop']['start'], $this->_sections['cat_loop']['iteration'] = 1;
                 $this->_sections['cat_loop']['iteration'] <= $this->_sections['cat_loop']['total'];
                 $this->_sections['cat_loop']['index'] += $this->_sections['cat_loop']['step'], $this->_sections['cat_loop']['iteration']++):
$this->_sections['cat_loop']['rownum'] = $this->_sections['cat_loop']['iteration'];
$this->_sections['cat_loop']['index_prev'] = $this->_sections['cat_loop']['index'] - $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['index_next'] = $this->_sections['cat_loop']['index'] + $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['first']      = ($this->_sections['cat_loop']['iteration'] == 1);
$this->_sections['cat_loop']['last']       = ($this->_sections['cat_loop']['iteration'] == $this->_sections['cat_loop']['total']);
?>, <?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; 
 echo ':{\'title\':\''; 
 ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_title']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('cat_title', ob_get_contents());ob_end_clean(); 
 echo ((is_array($_tmp=$this->_tpl_vars['cat_title'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&#039;", "\'") : smarty_modifier_replace($_tmp, "&#039;", "\'")); 
 echo '\', \'subcats\':{'; 
 unset($this->_sections['subcat_loop']);
$this->_sections['subcat_loop']['name'] = 'subcat_loop';
$this->_sections['subcat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['subcat_loop']['show'] = true;
$this->_sections['subcat_loop']['max'] = $this->_sections['subcat_loop']['loop'];
$this->_sections['subcat_loop']['step'] = 1;
$this->_sections['subcat_loop']['start'] = $this->_sections['subcat_loop']['step'] > 0 ? 0 : $this->_sections['subcat_loop']['loop']-1;
if ($this->_sections['subcat_loop']['show']) {
    $this->_sections['subcat_loop']['total'] = $this->_sections['subcat_loop']['loop'];
    if ($this->_sections['subcat_loop']['total'] == 0)
        $this->_sections['subcat_loop']['show'] = false;
} else
    $this->_sections['subcat_loop']['total'] = 0;
if ($this->_sections['subcat_loop']['show']):

            for ($this->_sections['subcat_loop']['index'] = $this->_sections['subcat_loop']['start'], $this->_sections['subcat_loop']['iteration'] = 1;
                 $this->_sections['subcat_loop']['iteration'] <= $this->_sections['subcat_loop']['total'];
                 $this->_sections['subcat_loop']['index'] += $this->_sections['subcat_loop']['step'], $this->_sections['subcat_loop']['iteration']++):
$this->_sections['subcat_loop']['rownum'] = $this->_sections['subcat_loop']['iteration'];
$this->_sections['subcat_loop']['index_prev'] = $this->_sections['subcat_loop']['index'] - $this->_sections['subcat_loop']['step'];
$this->_sections['subcat_loop']['index_next'] = $this->_sections['subcat_loop']['index'] + $this->_sections['subcat_loop']['step'];
$this->_sections['subcat_loop']['first']      = ($this->_sections['subcat_loop']['iteration'] == 1);
$this->_sections['subcat_loop']['last']       = ($this->_sections['subcat_loop']['iteration'] == $this->_sections['subcat_loop']['total']);

 if (! $this->_sections['subcat_loop']['first']): ?>, <?php endif; 
 echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'][$this->_sections['subcat_loop']['index']]['subcat_id']; ?>
:'<?php ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'][$this->_sections['subcat_loop']['index']]['subcat_title']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('subcat_title', ob_get_contents());ob_end_clean(); 
 echo ((is_array($_tmp=$this->_tpl_vars['subcat_title'])) ? $this->_run_mod_handler('replace', true, $_tmp, "&#039;", "\'") : smarty_modifier_replace($_tmp, "&#039;", "\'")); ?>
'<?php endfor; endif; 
 echo '}}'; 
 endfor; endif; 
 echo '};

  '; 
 if (count($this->_tpl_vars['cats']) > 0): 
 echo '
  window.addEvent(\'domready\', function(){
    for(c in cats) {
      var optn = document.createElement("option");
      optn.text = cats[c].title;
      optn.value = c;
      if(c == '; 
 echo $this->_tpl_vars['group']->group_info['group_groupcat_id']; 
 echo ') { optn.selected = true; }
      $(\'group_groupcat_id\').options.add(optn);
    }
    populateSubcats('; 
 echo $this->_tpl_vars['group']->group_info['group_groupcat_id']; 
 echo ');
  });
  '; 
 endif; 
 echo '

  function populateSubcats(group_groupcat_id) {
    var subcats = cats[group_groupcat_id].subcats;
    var subcatHash = new Hash(subcats);
    $$(\'tr[id^=all_fields_]\').each(function(el) { if(el.id == \'all_fields_\'+group_groupcat_id) { el.style.display = \'\'; } else { el.style.display = \'none\'; }});
    if(group_groupcat_id == 0 || subcatHash.getValues().length == 0) {
      $(\'group_groupsubcat_id\').options.length = 1;
      $(\'group_groupsubcat_id\').style.display = \'none\';
    } else {
      $(\'group_groupsubcat_id\').options.length = 1;
      $(\'group_groupsubcat_id\').style.display = \'\';
      for(s in subcats) {
        var optn = document.createElement("option");
        optn.text = subcats[s];
        optn.value = s;
        if(s == '; 
 echo $this->_tpl_vars['group']->group_info['group_groupsubcat_id']; 
 echo ') { optn.selected = true; }
        $(\'group_groupsubcat_id\').options.add(optn);
      }
    }
  }

  function ShowHideDeps(field_id, field_value, field_type) {
    if(field_type == 6) {
      if($(\'field_\'+field_id+\'_option\'+field_value)) {
        if($(\'field_\'+field_id+\'_option\'+field_value).style.display == "block") {
	  $(\'field_\'+field_id+\'_option\'+field_value).style.display = "none";
	} else {
	  $(\'field_\'+field_id+\'_option\'+field_value).style.display = "block";
	}
      }
    } else {
      var divIdStart = "field_"+field_id+"_option";
      for(var x=0;x<$(\'field_options_\'+field_id).childNodes.length;x++) {
        if($(\'field_options_\'+field_id).childNodes[x].nodeName == "DIV" && $(\'field_options_\'+field_id).childNodes[x].id.substr(0, divIdStart.length) == divIdStart) {
          if($(\'field_options_\'+field_id).childNodes[x].id == \'field_\'+field_id+\'_option\'+field_value) {
            $(\'field_options_\'+field_id).childNodes[x].style.display = "block";
          } else {
            $(\'field_options_\'+field_id).childNodes[x].style.display = "none";
          }
        }
      }
    }
  }
//-->
</script>
'; ?>



<div style='display: none;' id='confirmdelete'>
  <form action='user_group_edit.php' method='post' target='_parent'>
  <div style='margin-top: 10px;'><?php echo sprintf(SELanguage::_get(2000186), $this->_tpl_vars['group']->group_info['group_title']); ?></div>
  <br>
  <input type='submit' class='button' value='<?php echo SELanguage::_get(175); ?>'>
  <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove();'>
  <input type='hidden' name='task' value='delete_do'>
  <input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'>
  </form>
</div>


<div class='header'><?php echo SELanguage::_get(2000124); ?></div>
<div class='group_box'>
  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td class='editprofile_photoleft'>
    <div style='text-align: center;'>
      <?php echo SELanguage::_get(770); ?><br>
      <table cellpadding='0' cellspacing='0' width='202'>
      <tr><td class='editprofile_photo'><img src='<?php echo $this->_tpl_vars['group']->group_photo("./images/nophoto.gif"); ?>
' border='0'></td></tr>
      </table>
      <?php if ($this->_tpl_vars['group']->group_photo() != ""): ?>  <br>[ <a href='user_group_edit.php?group_id=<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
&task=remove'><?php echo SELanguage::_get(771); ?></a> ]<?php endif; ?>
    </div>
  </td>
  <td class='editprofile_photoright'>
    <form action='user_group_edit.php' method='post' enctype='multipart/form-data'>
    <?php echo SELanguage::_get(772); ?><br><input type='file' class='text' name='photo' size='30'>
    <input type='submit' class='button' value='<?php echo SELanguage::_get(714); ?>'>
    <input type='hidden' name='task' value='upload'>
    <input type='hidden' name='MAX_FILE_SIZE' value='5000000'>
    <input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'>
    </form>
    <br><?php echo sprintf(SELanguage::_get(2000125), $this->_tpl_vars['group']->groupowner_level_info['level_group_photo_exts']); ?>
  </td>
  </tr>
  </table>
</div>

<br>

<div class='header'><?php echo SELanguage::_get(2000097); ?></div>
<div class='group_box'>
<form action='user_group_edit.php' method='post'>
<table cellpadding='0' cellspacing='0'>
<td class='form1'><?php echo SELanguage::_get(2000094); ?>*</td>
<td class='form2'><input type='text' class='text' name='group_title' value='<?php echo $this->_tpl_vars['group']->group_info['group_title']; ?>
' maxlength='100' size='30'></td>
</tr>
<tr>
<td class='form1'><?php echo SELanguage::_get(2000098); ?></td>
<td class='form2'><textarea rows='6' cols='50' name='group_desc'><?php echo $this->_tpl_vars['group']->group_info['group_desc']; ?>
</textarea></td>
</tr>
<?php if (count($this->_tpl_vars['cats']) > 0): ?>
  <tr>
  <td class='form1'><?php echo SELanguage::_get(2000116); ?>*</td>
  <td class='form2' nowrap='nowrap'>
    <select name='group_groupcat_id' id='group_groupcat_id' onChange='populateSubcats(this.options[this.selectedIndex].value);'></select>
    <select name='group_groupsubcat_id' id='group_groupsubcat_id' style='display: none;'><option value='0'></option></select>
  </td>
  </tr>
  <?php unset($this->_sections['cat_loop']);
$this->_sections['cat_loop']['name'] = 'cat_loop';
$this->_sections['cat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cat_loop']['show'] = true;
$this->_sections['cat_loop']['max'] = $this->_sections['cat_loop']['loop'];
$this->_sections['cat_loop']['step'] = 1;
$this->_sections['cat_loop']['start'] = $this->_sections['cat_loop']['step'] > 0 ? 0 : $this->_sections['cat_loop']['loop']-1;
if ($this->_sections['cat_loop']['show']) {
    $this->_sections['cat_loop']['total'] = $this->_sections['cat_loop']['loop'];
    if ($this->_sections['cat_loop']['total'] == 0)
        $this->_sections['cat_loop']['show'] = false;
} else
    $this->_sections['cat_loop']['total'] = 0;
if ($this->_sections['cat_loop']['show']):

            for ($this->_sections['cat_loop']['index'] = $this->_sections['cat_loop']['start'], $this->_sections['cat_loop']['iteration'] = 1;
                 $this->_sections['cat_loop']['iteration'] <= $this->_sections['cat_loop']['total'];
                 $this->_sections['cat_loop']['index'] += $this->_sections['cat_loop']['step'], $this->_sections['cat_loop']['iteration']++):
$this->_sections['cat_loop']['rownum'] = $this->_sections['cat_loop']['iteration'];
$this->_sections['cat_loop']['index_prev'] = $this->_sections['cat_loop']['index'] - $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['index_next'] = $this->_sections['cat_loop']['index'] + $this->_sections['cat_loop']['step'];
$this->_sections['cat_loop']['first']      = ($this->_sections['cat_loop']['iteration'] == 1);
$this->_sections['cat_loop']['last']       = ($this->_sections['cat_loop']['iteration'] == $this->_sections['cat_loop']['total']);
?>
    <?php unset($this->_sections['field_loop']);
$this->_sections['field_loop']['name'] = 'field_loop';
$this->_sections['field_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['field_loop']['show'] = true;
$this->_sections['field_loop']['max'] = $this->_sections['field_loop']['loop'];
$this->_sections['field_loop']['step'] = 1;
$this->_sections['field_loop']['start'] = $this->_sections['field_loop']['step'] > 0 ? 0 : $this->_sections['field_loop']['loop']-1;
if ($this->_sections['field_loop']['show']) {
    $this->_sections['field_loop']['total'] = $this->_sections['field_loop']['loop'];
    if ($this->_sections['field_loop']['total'] == 0)
        $this->_sections['field_loop']['show'] = false;
} else
    $this->_sections['field_loop']['total'] = 0;
if ($this->_sections['field_loop']['show']):

            for ($this->_sections['field_loop']['index'] = $this->_sections['field_loop']['start'], $this->_sections['field_loop']['iteration'] = 1;
                 $this->_sections['field_loop']['iteration'] <= $this->_sections['field_loop']['total'];
                 $this->_sections['field_loop']['index'] += $this->_sections['field_loop']['step'], $this->_sections['field_loop']['iteration']++):
$this->_sections['field_loop']['rownum'] = $this->_sections['field_loop']['iteration'];
$this->_sections['field_loop']['index_prev'] = $this->_sections['field_loop']['index'] - $this->_sections['field_loop']['step'];
$this->_sections['field_loop']['index_next'] = $this->_sections['field_loop']['index'] + $this->_sections['field_loop']['step'];
$this->_sections['field_loop']['first']      = ($this->_sections['field_loop']['iteration'] == 1);
$this->_sections['field_loop']['last']       = ($this->_sections['field_loop']['iteration'] == $this->_sections['field_loop']['total']);
?>
      <tr id='all_fields_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
'>
      <td class='form1'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_title']); 
 if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_required'] != 0): ?>*<?php endif; ?></td>
      <td class='form2'>

            <?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_type'] == 1): ?>
        <div><input type='text' class='text' name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' id='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']; ?>
' style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
' maxlength='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_maxlength']; ?>
'></div>

                <?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'] != "" && count($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options']) != 0): ?>
        <?php echo '
        <script type="text/javascript">
        <!-- 
        window.addEvent(\'domready\', function(){
	  var options = {
		script:"misc_js.php?task=suggest_field&limit=5&'; 
 unset($this->_sections['option_loop']);
$this->_sections['option_loop']['name'] = 'option_loop';
$this->_sections['option_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option_loop']['show'] = true;
$this->_sections['option_loop']['max'] = $this->_sections['option_loop']['loop'];
$this->_sections['option_loop']['step'] = 1;
$this->_sections['option_loop']['start'] = $this->_sections['option_loop']['step'] > 0 ? 0 : $this->_sections['option_loop']['loop']-1;
if ($this->_sections['option_loop']['show']) {
    $this->_sections['option_loop']['total'] = $this->_sections['option_loop']['loop'];
    if ($this->_sections['option_loop']['total'] == 0)
        $this->_sections['option_loop']['show'] = false;
} else
    $this->_sections['option_loop']['total'] = 0;
if ($this->_sections['option_loop']['show']):

            for ($this->_sections['option_loop']['index'] = $this->_sections['option_loop']['start'], $this->_sections['option_loop']['iteration'] = 1;
                 $this->_sections['option_loop']['iteration'] <= $this->_sections['option_loop']['total'];
                 $this->_sections['option_loop']['index'] += $this->_sections['option_loop']['step'], $this->_sections['option_loop']['iteration']++):
$this->_sections['option_loop']['rownum'] = $this->_sections['option_loop']['iteration'];
$this->_sections['option_loop']['index_prev'] = $this->_sections['option_loop']['index'] - $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['index_next'] = $this->_sections['option_loop']['index'] + $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['first']      = ($this->_sections['option_loop']['iteration'] == 1);
$this->_sections['option_loop']['last']       = ($this->_sections['option_loop']['iteration'] == $this->_sections['option_loop']['total']);
?>options[]=<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['label']; ?>
&<?php endfor; endif; 
 echo '",
		varname:"input",
		json:true,
		shownoresults:false,
		maxresults:5,
		multisuggest:false,
		callback: function (obj) {  }
	  };
	  var as_json'; 
 echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; 
 echo ' = new bsn.AutoSuggest(\'field_'; 
 echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; 
 echo '\', options);
        });
        //-->
        </script>
        '; ?>

        <?php endif; ?>


            <?php elseif ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_type'] == 2): ?>
        <div><textarea rows='6' cols='50' name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
'><?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']; ?>
</textarea></div>



            <?php elseif ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_type'] == 3): ?>
        <div><select name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' id='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' onchange="ShowHideDeps('<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
', this.value);" style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
'>
        <option value='-1'></option>
                <?php unset($this->_sections['option_loop']);
$this->_sections['option_loop']['name'] = 'option_loop';
$this->_sections['option_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option_loop']['show'] = true;
$this->_sections['option_loop']['max'] = $this->_sections['option_loop']['loop'];
$this->_sections['option_loop']['step'] = 1;
$this->_sections['option_loop']['start'] = $this->_sections['option_loop']['step'] > 0 ? 0 : $this->_sections['option_loop']['loop']-1;
if ($this->_sections['option_loop']['show']) {
    $this->_sections['option_loop']['total'] = $this->_sections['option_loop']['loop'];
    if ($this->_sections['option_loop']['total'] == 0)
        $this->_sections['option_loop']['show'] = false;
} else
    $this->_sections['option_loop']['total'] = 0;
if ($this->_sections['option_loop']['show']):

            for ($this->_sections['option_loop']['index'] = $this->_sections['option_loop']['start'], $this->_sections['option_loop']['iteration'] = 1;
                 $this->_sections['option_loop']['iteration'] <= $this->_sections['option_loop']['total'];
                 $this->_sections['option_loop']['index'] += $this->_sections['option_loop']['step'], $this->_sections['option_loop']['iteration']++):
$this->_sections['option_loop']['rownum'] = $this->_sections['option_loop']['iteration'];
$this->_sections['option_loop']['index_prev'] = $this->_sections['option_loop']['index'] - $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['index_next'] = $this->_sections['option_loop']['index'] + $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['first']      = ($this->_sections['option_loop']['iteration'] == 1);
$this->_sections['option_loop']['last']       = ($this->_sections['option_loop']['iteration'] == $this->_sections['option_loop']['total']);
?>
          <option id='op' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] == $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['label']); ?></option>
        <?php endfor; endif; ?>
        </select>
        </div>
                <div id='field_options_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
'>
        <?php unset($this->_sections['option_loop']);
$this->_sections['option_loop']['name'] = 'option_loop';
$this->_sections['option_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option_loop']['show'] = true;
$this->_sections['option_loop']['max'] = $this->_sections['option_loop']['loop'];
$this->_sections['option_loop']['step'] = 1;
$this->_sections['option_loop']['start'] = $this->_sections['option_loop']['step'] > 0 ? 0 : $this->_sections['option_loop']['loop']-1;
if ($this->_sections['option_loop']['show']) {
    $this->_sections['option_loop']['total'] = $this->_sections['option_loop']['loop'];
    if ($this->_sections['option_loop']['total'] == 0)
        $this->_sections['option_loop']['show'] = false;
} else
    $this->_sections['option_loop']['total'] = 0;
if ($this->_sections['option_loop']['show']):

            for ($this->_sections['option_loop']['index'] = $this->_sections['option_loop']['start'], $this->_sections['option_loop']['iteration'] = 1;
                 $this->_sections['option_loop']['iteration'] <= $this->_sections['option_loop']['total'];
                 $this->_sections['option_loop']['index'] += $this->_sections['option_loop']['step'], $this->_sections['option_loop']['iteration']++):
$this->_sections['option_loop']['rownum'] = $this->_sections['option_loop']['iteration'];
$this->_sections['option_loop']['index_prev'] = $this->_sections['option_loop']['index'] - $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['index_next'] = $this->_sections['option_loop']['index'] + $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['first']      = ($this->_sections['option_loop']['iteration'] == 1);
$this->_sections['option_loop']['last']       = ($this->_sections['option_loop']['iteration'] == $this->_sections['option_loop']['total']);
?>
          <?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dependency'] == 1): ?>

	    	    <?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_type'] == 3): ?>
              <div id='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_option<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' style='margin: 5px 5px 10px 5px;<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] != $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> display: none;<?php endif; ?>'>
              <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_title']); 
 if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_required'] != 0): ?>*<?php endif; ?>
              <select name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_id']; ?>
'>
	        <option value='-1'></option>
	        	        <?php unset($this->_sections['option2_loop']);
$this->_sections['option2_loop']['name'] = 'option2_loop';
$this->_sections['option2_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option2_loop']['show'] = true;
$this->_sections['option2_loop']['max'] = $this->_sections['option2_loop']['loop'];
$this->_sections['option2_loop']['step'] = 1;
$this->_sections['option2_loop']['start'] = $this->_sections['option2_loop']['step'] > 0 ? 0 : $this->_sections['option2_loop']['loop']-1;
if ($this->_sections['option2_loop']['show']) {
    $this->_sections['option2_loop']['total'] = $this->_sections['option2_loop']['loop'];
    if ($this->_sections['option2_loop']['total'] == 0)
        $this->_sections['option2_loop']['show'] = false;
} else
    $this->_sections['option2_loop']['total'] = 0;
if ($this->_sections['option2_loop']['show']):

            for ($this->_sections['option2_loop']['index'] = $this->_sections['option2_loop']['start'], $this->_sections['option2_loop']['iteration'] = 1;
                 $this->_sections['option2_loop']['iteration'] <= $this->_sections['option2_loop']['total'];
                 $this->_sections['option2_loop']['index'] += $this->_sections['option2_loop']['step'], $this->_sections['option2_loop']['iteration']++):
$this->_sections['option2_loop']['rownum'] = $this->_sections['option2_loop']['iteration'];
$this->_sections['option2_loop']['index_prev'] = $this->_sections['option2_loop']['index'] - $this->_sections['option2_loop']['step'];
$this->_sections['option2_loop']['index_next'] = $this->_sections['option2_loop']['index'] + $this->_sections['option2_loop']['step'];
$this->_sections['option2_loop']['first']      = ($this->_sections['option2_loop']['iteration'] == 1);
$this->_sections['option2_loop']['last']       = ($this->_sections['option2_loop']['iteration'] == $this->_sections['option2_loop']['total']);
?>
	          <option id='op' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options'][$this->_sections['option2_loop']['index']]['value']; ?>
'<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options'][$this->_sections['option2_loop']['index']]['value'] == $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_value']): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options'][$this->_sections['option2_loop']['index']]['label']); ?></option>
	        <?php endfor; endif; ?>
	      </select>
              </div>	  

	    	    <?php else: ?>
              <div id='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_option<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' style='margin: 5px 5px 10px 5px;<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] != $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> display: none;<?php endif; ?>'>
              <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_title']); 
 if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_required'] != 0): ?>*<?php endif; ?>
             <input type='text' class='text' name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_id']; ?>
' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_value']; ?>
' style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_style']; ?>
' maxlength='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_maxlength']; ?>
'>
              </div>
	    <?php endif; ?>

          <?php endif; ?>
        <?php endfor; endif; ?>
        </div>
    


            <?php elseif ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_type'] == 4): ?>
    
                <div id='field_options_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
'>
        <?php unset($this->_sections['option_loop']);
$this->_sections['option_loop']['name'] = 'option_loop';
$this->_sections['option_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option_loop']['show'] = true;
$this->_sections['option_loop']['max'] = $this->_sections['option_loop']['loop'];
$this->_sections['option_loop']['step'] = 1;
$this->_sections['option_loop']['start'] = $this->_sections['option_loop']['step'] > 0 ? 0 : $this->_sections['option_loop']['loop']-1;
if ($this->_sections['option_loop']['show']) {
    $this->_sections['option_loop']['total'] = $this->_sections['option_loop']['loop'];
    if ($this->_sections['option_loop']['total'] == 0)
        $this->_sections['option_loop']['show'] = false;
} else
    $this->_sections['option_loop']['total'] = 0;
if ($this->_sections['option_loop']['show']):

            for ($this->_sections['option_loop']['index'] = $this->_sections['option_loop']['start'], $this->_sections['option_loop']['iteration'] = 1;
                 $this->_sections['option_loop']['iteration'] <= $this->_sections['option_loop']['total'];
                 $this->_sections['option_loop']['index'] += $this->_sections['option_loop']['step'], $this->_sections['option_loop']['iteration']++):
$this->_sections['option_loop']['rownum'] = $this->_sections['option_loop']['iteration'];
$this->_sections['option_loop']['index_prev'] = $this->_sections['option_loop']['index'] - $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['index_next'] = $this->_sections['option_loop']['index'] + $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['first']      = ($this->_sections['option_loop']['iteration'] == 1);
$this->_sections['option_loop']['last']       = ($this->_sections['option_loop']['iteration'] == $this->_sections['option_loop']['total']);
?>
          <div>
          <input type='radio' class='radio' onclick="ShowHideDeps('<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
', '<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
');" style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
' name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' id='label_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] == $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> CHECKED<?php endif; ?>>
          <label for='label_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['label']); ?></label>
          </div>

                    <?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dependency'] == 1): ?>

	    	    <?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_type'] == 3): ?>
              <div id='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_option<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' style='margin: 0px 5px 10px 23px;<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] != $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> display: none;<?php endif; ?>'>
              <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_title']); 
 if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_required'] != 0): ?>*<?php endif; ?>
              <select name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_id']; ?>
'>
	        <option value='-1'></option>
	        	        <?php unset($this->_sections['option2_loop']);
$this->_sections['option2_loop']['name'] = 'option2_loop';
$this->_sections['option2_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option2_loop']['show'] = true;
$this->_sections['option2_loop']['max'] = $this->_sections['option2_loop']['loop'];
$this->_sections['option2_loop']['step'] = 1;
$this->_sections['option2_loop']['start'] = $this->_sections['option2_loop']['step'] > 0 ? 0 : $this->_sections['option2_loop']['loop']-1;
if ($this->_sections['option2_loop']['show']) {
    $this->_sections['option2_loop']['total'] = $this->_sections['option2_loop']['loop'];
    if ($this->_sections['option2_loop']['total'] == 0)
        $this->_sections['option2_loop']['show'] = false;
} else
    $this->_sections['option2_loop']['total'] = 0;
if ($this->_sections['option2_loop']['show']):

            for ($this->_sections['option2_loop']['index'] = $this->_sections['option2_loop']['start'], $this->_sections['option2_loop']['iteration'] = 1;
                 $this->_sections['option2_loop']['iteration'] <= $this->_sections['option2_loop']['total'];
                 $this->_sections['option2_loop']['index'] += $this->_sections['option2_loop']['step'], $this->_sections['option2_loop']['iteration']++):
$this->_sections['option2_loop']['rownum'] = $this->_sections['option2_loop']['iteration'];
$this->_sections['option2_loop']['index_prev'] = $this->_sections['option2_loop']['index'] - $this->_sections['option2_loop']['step'];
$this->_sections['option2_loop']['index_next'] = $this->_sections['option2_loop']['index'] + $this->_sections['option2_loop']['step'];
$this->_sections['option2_loop']['first']      = ($this->_sections['option2_loop']['iteration'] == 1);
$this->_sections['option2_loop']['last']       = ($this->_sections['option2_loop']['iteration'] == $this->_sections['option2_loop']['total']);
?>
	          <option id='op' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options'][$this->_sections['option2_loop']['index']]['value']; ?>
'<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options'][$this->_sections['option2_loop']['index']]['value'] == $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_value']): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options'][$this->_sections['option2_loop']['index']]['label']); ?></option>
	        <?php endfor; endif; ?>
	      </select>
              </div>	  

	    	    <?php else: ?>
              <div id='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_option<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' style='margin: 0px 5px 10px 23px;<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] != $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> display: none;<?php endif; ?>'>
              <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_title']); 
 if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_required'] != 0): ?>*<?php endif; ?>
             <input type='text' class='text' name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_id']; ?>
' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_value']; ?>
' style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_style']; ?>
' maxlength='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_maxlength']; ?>
'>
              </div>
	    <?php endif; ?>

          <?php endif; ?>

        <?php endfor; endif; ?>
        </div>



            <?php elseif ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_type'] == 5): ?>
        <div>
        <select name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_1' style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
'>
        <?php unset($this->_sections['date1']);
$this->_sections['date1']['name'] = 'date1';
$this->_sections['date1']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array1']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['date1']['show'] = true;
$this->_sections['date1']['max'] = $this->_sections['date1']['loop'];
$this->_sections['date1']['step'] = 1;
$this->_sections['date1']['start'] = $this->_sections['date1']['step'] > 0 ? 0 : $this->_sections['date1']['loop']-1;
if ($this->_sections['date1']['show']) {
    $this->_sections['date1']['total'] = $this->_sections['date1']['loop'];
    if ($this->_sections['date1']['total'] == 0)
        $this->_sections['date1']['show'] = false;
} else
    $this->_sections['date1']['total'] = 0;
if ($this->_sections['date1']['show']):

            for ($this->_sections['date1']['index'] = $this->_sections['date1']['start'], $this->_sections['date1']['iteration'] = 1;
                 $this->_sections['date1']['iteration'] <= $this->_sections['date1']['total'];
                 $this->_sections['date1']['index'] += $this->_sections['date1']['step'], $this->_sections['date1']['iteration']++):
$this->_sections['date1']['rownum'] = $this->_sections['date1']['iteration'];
$this->_sections['date1']['index_prev'] = $this->_sections['date1']['index'] - $this->_sections['date1']['step'];
$this->_sections['date1']['index_next'] = $this->_sections['date1']['index'] + $this->_sections['date1']['step'];
$this->_sections['date1']['first']      = ($this->_sections['date1']['iteration'] == 1);
$this->_sections['date1']['last']       = ($this->_sections['date1']['iteration'] == $this->_sections['date1']['total']);
?>
          <option value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array1'][$this->_sections['date1']['index']]['value']; ?>
'<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array1'][$this->_sections['date1']['index']]['selected']; ?>
><?php if ($this->_sections['date1']['first']): ?>[ <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array1'][$this->_sections['date1']['index']]['name']); ?> ]<?php else: 
 echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array1'][$this->_sections['date1']['index']]['name']; 
 endif; ?></option>
        <?php endfor; endif; ?>
        </select>

        <select name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_2' style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
'>
        <?php unset($this->_sections['date2']);
$this->_sections['date2']['name'] = 'date2';
$this->_sections['date2']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['date2']['show'] = true;
$this->_sections['date2']['max'] = $this->_sections['date2']['loop'];
$this->_sections['date2']['step'] = 1;
$this->_sections['date2']['start'] = $this->_sections['date2']['step'] > 0 ? 0 : $this->_sections['date2']['loop']-1;
if ($this->_sections['date2']['show']) {
    $this->_sections['date2']['total'] = $this->_sections['date2']['loop'];
    if ($this->_sections['date2']['total'] == 0)
        $this->_sections['date2']['show'] = false;
} else
    $this->_sections['date2']['total'] = 0;
if ($this->_sections['date2']['show']):

            for ($this->_sections['date2']['index'] = $this->_sections['date2']['start'], $this->_sections['date2']['iteration'] = 1;
                 $this->_sections['date2']['iteration'] <= $this->_sections['date2']['total'];
                 $this->_sections['date2']['index'] += $this->_sections['date2']['step'], $this->_sections['date2']['iteration']++):
$this->_sections['date2']['rownum'] = $this->_sections['date2']['iteration'];
$this->_sections['date2']['index_prev'] = $this->_sections['date2']['index'] - $this->_sections['date2']['step'];
$this->_sections['date2']['index_next'] = $this->_sections['date2']['index'] + $this->_sections['date2']['step'];
$this->_sections['date2']['first']      = ($this->_sections['date2']['iteration'] == 1);
$this->_sections['date2']['last']       = ($this->_sections['date2']['iteration'] == $this->_sections['date2']['total']);
?>
          <option value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array2'][$this->_sections['date2']['index']]['value']; ?>
'<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array2'][$this->_sections['date2']['index']]['selected']; ?>
><?php if ($this->_sections['date2']['first']): ?>[ <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array2'][$this->_sections['date2']['index']]['name']); ?> ]<?php else: 
 echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array2'][$this->_sections['date2']['index']]['name']; 
 endif; ?></option>
        <?php endfor; endif; ?>
        </select>

        <select name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_3' style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
'>
        <?php unset($this->_sections['date3']);
$this->_sections['date3']['name'] = 'date3';
$this->_sections['date3']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array3']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['date3']['show'] = true;
$this->_sections['date3']['max'] = $this->_sections['date3']['loop'];
$this->_sections['date3']['step'] = 1;
$this->_sections['date3']['start'] = $this->_sections['date3']['step'] > 0 ? 0 : $this->_sections['date3']['loop']-1;
if ($this->_sections['date3']['show']) {
    $this->_sections['date3']['total'] = $this->_sections['date3']['loop'];
    if ($this->_sections['date3']['total'] == 0)
        $this->_sections['date3']['show'] = false;
} else
    $this->_sections['date3']['total'] = 0;
if ($this->_sections['date3']['show']):

            for ($this->_sections['date3']['index'] = $this->_sections['date3']['start'], $this->_sections['date3']['iteration'] = 1;
                 $this->_sections['date3']['iteration'] <= $this->_sections['date3']['total'];
                 $this->_sections['date3']['index'] += $this->_sections['date3']['step'], $this->_sections['date3']['iteration']++):
$this->_sections['date3']['rownum'] = $this->_sections['date3']['iteration'];
$this->_sections['date3']['index_prev'] = $this->_sections['date3']['index'] - $this->_sections['date3']['step'];
$this->_sections['date3']['index_next'] = $this->_sections['date3']['index'] + $this->_sections['date3']['step'];
$this->_sections['date3']['first']      = ($this->_sections['date3']['iteration'] == 1);
$this->_sections['date3']['last']       = ($this->_sections['date3']['iteration'] == $this->_sections['date3']['total']);
?>
          <option value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array3'][$this->_sections['date3']['index']]['value']; ?>
'<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array3'][$this->_sections['date3']['index']]['selected']; ?>
><?php if ($this->_sections['date3']['first']): ?>[ <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array3'][$this->_sections['date3']['index']]['name']); ?> ]<?php else: 
 echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['date_array3'][$this->_sections['date3']['index']]['name']; 
 endif; ?></option>
        <?php endfor; endif; ?>
        </select>
        </div>



            <?php elseif ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_type'] == 6): ?>
    
                <div id='field_options_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
'>
        <?php unset($this->_sections['option_loop']);
$this->_sections['option_loop']['name'] = 'option_loop';
$this->_sections['option_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option_loop']['show'] = true;
$this->_sections['option_loop']['max'] = $this->_sections['option_loop']['loop'];
$this->_sections['option_loop']['step'] = 1;
$this->_sections['option_loop']['start'] = $this->_sections['option_loop']['step'] > 0 ? 0 : $this->_sections['option_loop']['loop']-1;
if ($this->_sections['option_loop']['show']) {
    $this->_sections['option_loop']['total'] = $this->_sections['option_loop']['loop'];
    if ($this->_sections['option_loop']['total'] == 0)
        $this->_sections['option_loop']['show'] = false;
} else
    $this->_sections['option_loop']['total'] = 0;
if ($this->_sections['option_loop']['show']):

            for ($this->_sections['option_loop']['index'] = $this->_sections['option_loop']['start'], $this->_sections['option_loop']['iteration'] = 1;
                 $this->_sections['option_loop']['iteration'] <= $this->_sections['option_loop']['total'];
                 $this->_sections['option_loop']['index'] += $this->_sections['option_loop']['step'], $this->_sections['option_loop']['iteration']++):
$this->_sections['option_loop']['rownum'] = $this->_sections['option_loop']['iteration'];
$this->_sections['option_loop']['index_prev'] = $this->_sections['option_loop']['index'] - $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['index_next'] = $this->_sections['option_loop']['index'] + $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['first']      = ($this->_sections['option_loop']['iteration'] == 1);
$this->_sections['option_loop']['last']       = ($this->_sections['option_loop']['iteration'] == $this->_sections['option_loop']['total']);
?>
          <div>
          <input type='checkbox' onclick="ShowHideDeps('<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
', '<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
', '<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_type']; ?>
');" style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
' name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
[]' id='label_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'<?php if (((is_array($_tmp=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']) : in_array($_tmp, $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']))): ?> CHECKED<?php endif; ?>>
          <label for='label_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['label']); ?></label>
          </div>

                    <?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dependency'] == 1): ?>
	    	    <?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_type'] == 3): ?>
              <div id='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_option<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' style='margin: 0px 5px 10px 23px;<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] != $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> display: none;<?php endif; ?>'>
              <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_title']); 
 if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_required'] != 0): ?>*<?php endif; ?>
              <select name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_id']; ?>
'>
	        <option value='-1'></option>
	        	        <?php unset($this->_sections['option2_loop']);
$this->_sections['option2_loop']['name'] = 'option2_loop';
$this->_sections['option2_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option2_loop']['show'] = true;
$this->_sections['option2_loop']['max'] = $this->_sections['option2_loop']['loop'];
$this->_sections['option2_loop']['step'] = 1;
$this->_sections['option2_loop']['start'] = $this->_sections['option2_loop']['step'] > 0 ? 0 : $this->_sections['option2_loop']['loop']-1;
if ($this->_sections['option2_loop']['show']) {
    $this->_sections['option2_loop']['total'] = $this->_sections['option2_loop']['loop'];
    if ($this->_sections['option2_loop']['total'] == 0)
        $this->_sections['option2_loop']['show'] = false;
} else
    $this->_sections['option2_loop']['total'] = 0;
if ($this->_sections['option2_loop']['show']):

            for ($this->_sections['option2_loop']['index'] = $this->_sections['option2_loop']['start'], $this->_sections['option2_loop']['iteration'] = 1;
                 $this->_sections['option2_loop']['iteration'] <= $this->_sections['option2_loop']['total'];
                 $this->_sections['option2_loop']['index'] += $this->_sections['option2_loop']['step'], $this->_sections['option2_loop']['iteration']++):
$this->_sections['option2_loop']['rownum'] = $this->_sections['option2_loop']['iteration'];
$this->_sections['option2_loop']['index_prev'] = $this->_sections['option2_loop']['index'] - $this->_sections['option2_loop']['step'];
$this->_sections['option2_loop']['index_next'] = $this->_sections['option2_loop']['index'] + $this->_sections['option2_loop']['step'];
$this->_sections['option2_loop']['first']      = ($this->_sections['option2_loop']['iteration'] == 1);
$this->_sections['option2_loop']['last']       = ($this->_sections['option2_loop']['iteration'] == $this->_sections['option2_loop']['total']);
?>
	          <option id='op' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options'][$this->_sections['option2_loop']['index']]['value']; ?>
'<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options'][$this->_sections['option2_loop']['index']]['value'] == $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_value']): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_options'][$this->_sections['option2_loop']['index']]['label']); ?></option>
	        <?php endfor; endif; ?>
	      </select>
              </div>	  

	    	    <?php else: ?>
              <div id='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_option<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' style='margin: 0px 5px 10px 23px;<?php if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] != $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> display: none;<?php endif; ?>'>
              <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_title']); 
 if ($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_required'] != 0): ?>*<?php endif; ?>
             <input type='text' class='text' name='field_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_id']; ?>
' value='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_value']; ?>
' style='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_style']; ?>
' maxlength='<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['dep_field_maxlength']; ?>
'>
              </div>
	    <?php endif; ?>
          <?php endif; ?>

        <?php endfor; endif; ?>
        </div>

      <?php endif; ?>

      <div class='form_desc'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_desc']); ?></div>
      <?php ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_error']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('field_error', ob_get_contents());ob_end_clean(); ?>
      <?php if ($this->_tpl_vars['field_error'] != ""): ?><div class='form_error'><img src='./images/icons/error16.gif' border='0' class='icon'> <?php echo $this->_tpl_vars['field_error']; ?>
</div><?php endif; ?>
      </td>
      </tr>

    <?php endfor; endif; ?>
  <?php endfor; endif; 
 endif; ?>
</table>
</div>

<br>

<table cellpadding='0' cellspacing='0'>
<tr>
<td>
  <input type='submit' class='button' value='<?php echo SELanguage::_get(173); ?>'>&nbsp;
  <input type='hidden' name='task' value='dosave'>
  <input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'>
  </form>
</td>
<td>
  <form action='user_group.php' method='get'>
  <input type='submit' class='button' value='<?php echo SELanguage::_get(39); ?>'>&nbsp;
  </form>
</td>
<td style='padding-left: 10px;'>
  <?php if ($this->_tpl_vars['group']->user_rank == 2): ?>
    <a href="javascript:TB_show('<?php echo SELanguage::_get(2000177); ?>', '#TB_inline?height=100&width=300&inlineId=confirmdelete', '', './images/trans.gif');"><img src='./images/icons/group_delete16.gif' border='0' class='button'><?php echo SELanguage::_get(2000177); ?></a>
  <?php endif; ?>
</td>
</tr>
</table>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'rightside.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div style='clear: both; height: 10px;'></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>