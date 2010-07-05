<?php /* Smarty version 2.6.14, created on 2010-05-26 08:17:25
         compiled from admin_ads_modify.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'admin_ads_modify.tpl', 92, false),array('modifier', 'mktime', 'admin_ads_modify.tpl', 284, false),array('modifier', 'count', 'admin_ads_modify.tpl', 454, false),array('modifier', 'in_array', 'admin_ads_modify.tpl', 479, false),array('modifier', 'truncate', 'admin_ads_modify.tpl', 479, false),)), $this);
?><?php
SELanguage::_preload_multi(408,409,344,345,362,363,353,346,347,348,349,350,358,359,360,361,39,354,355,351,352,356,357,364,365,366,367,368,369,370,371,372,373,374,375,376,377,379,380,8,9,382,383,384,385,173);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 
 if ($this->_tpl_vars['ad_exists'] == 1): ?>
  <h2><?php echo SELanguage::_get(408); ?></h2>
  <?php echo SELanguage::_get(409); 
 else: ?>
  <h2><?php echo SELanguage::_get(344); ?></h2>
  <?php echo SELanguage::_get(345); 
 endif; ?>

<br><br>

<?php if ($this->_tpl_vars['is_error'] != 0): ?>
  <div class='error'><img src='../images/error.gif' border='0' class='icon'> <?php echo SELanguage::_get($this->_tpl_vars['is_error']); ?></div><br>
<?php endif; 
 echo '
<script type="text/javascript">
<!--

  Ads = new Array()
  Ads[\'top1\'] = new Image(213,37);
  Ads[\'top1\'].src = "../images/admin_ads_top.gif";
  Ads[\'top2\'] = new Image(213,37);
  Ads[\'top2\'].src = "../images/admin_ads_top2.gif";
  Ads[\'top3\'] = new Image(213,37);
  Ads[\'top3\'].src = "../images/admin_ads_top3.gif";
  Ads[\'belowmenu1\'] = new Image(213,30);
  Ads[\'belowmenu1\'].src = "../images/admin_ads_belowmenu.gif";
  Ads[\'belowmenu2\'] = new Image(213,30);
  Ads[\'belowmenu2\'].src = "../images/admin_ads_belowmenu2.gif";
  Ads[\'belowmenu3\'] = new Image(213,30);
  Ads[\'belowmenu3\'].src = "../images/admin_ads_belowmenu3.gif";
  Ads[\'left1\'] = new Image(37,113);
  Ads[\'left1\'].src = "../images/admin_ads_left.gif";
  Ads[\'left2\'] = new Image(37,113);
  Ads[\'left2\'].src = "../images/admin_ads_left2.gif";
  Ads[\'left3\'] = new Image(37,113);
  Ads[\'left3\'].src = "../images/admin_ads_left3.gif";
  Ads[\'right1\'] = new Image(37,113);
  Ads[\'right1\'].src = "../images/admin_ads_right.gif";
  Ads[\'right2\'] = new Image(37,113);
  Ads[\'right2\'].src = "../images/admin_ads_right2.gif";
  Ads[\'right3\'] = new Image(37,113);
  Ads[\'right3\'].src = "../images/admin_ads_right3.gif";
  Ads[\'bottom1\'] = new Image(213,37);
  Ads[\'bottom1\'].src = "../images/admin_ads_bottom.gif";
  Ads[\'bottom2\'] = new Image(213,37);
  Ads[\'bottom2\'].src = "../images/admin_ads_bottom2.gif";
  Ads[\'bottom3\'] = new Image(213,37);
  Ads[\'bottom3\'].src = "../images/admin_ads_bottom3.gif";
  Ads[\'feed1\'] = new Image(213,37);
  Ads[\'feed1\'].src = "../images/admin_ads_feed.gif";
  Ads[\'feed2\'] = new Image(213,37);
  Ads[\'feed2\'].src = "../images/admin_ads_feed2.gif";
  Ads[\'feed3\'] = new Image(213,37);
  Ads[\'feed3\'].src = "../images/admin_ads_feed3.gif";
  
  function highlight_over(id1) {
    if($(id1).src != Ads[id1+\'3\'].src) {
      $(id1).src=Ads[id1+\'2\'].src;
    }
  }
  function highlight_out(id1) {
    if($(id1).src != Ads[id1+\'3\'].src) {
      $(id1).src=Ads[id1+\'1\'].src;
    }
  }
  function highlight_click(id1) {
    var position3 = id1+"3";
    var position2 = id1+"2";
    if($(id1).src != Ads[id1+\'3\'].src) {
      $(\'top\').src=Ads[\'top1\'].src;
      $(\'belowmenu\').src=Ads[\'belowmenu1\'].src;
      $(\'left\').src=Ads[\'left1\'].src;
      $(\'right\').src=Ads[\'right1\'].src;
      $(\'bottom\').src=Ads[\'bottom1\'].src;
      $(\'feed\').src=Ads[\'feed1\'].src;
      $(id1).src=Ads[id1+\'3\'].src;
      $(\'banner_position\').value=id1;
    } else {
      $(id1).src=Ads[position2].src;
      $("banner_position").value="";
    }
  }

  function uploadbanner() {
    var bannersrc = $(\'bannersrc\').value;
    if(bannersrc == "") {
      alert(\''; 
 ob_start(); 
 echo SELanguage::_get(362); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('error_message', ob_get_contents());ob_end_clean(); 
 echo ((is_array($_tmp=$this->_tpl_vars['error_message'])) ? $this->_run_mod_handler('replace', true, $_tmp, "'", "&#039;") : smarty_modifier_replace($_tmp, "'", "&#039;")); 
 echo '\');
    } else {
      $(\'uploadform\').submit();
      $(\'banner_upload_submit\').setStyles({display:\'none\'});
      $(\'banner_upload_status\').setStyles({display:\'block\'});
    }
  }
  function uploadbanner_result(imagename, iserror) {
    if(iserror == 1) {
      $(\'banner_upload_status\').setStyles({display:\'none\'});
      $(\'banner_upload_submit\').setStyles({display:\'block\'});
      alert(\''; 
 ob_start(); 
 echo SELanguage::_get(363); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('error_message', ob_get_contents());ob_end_clean(); 
 echo ((is_array($_tmp=$this->_tpl_vars['error_message'])) ? $this->_run_mod_handler('replace', true, $_tmp, "'", "&#039;") : smarty_modifier_replace($_tmp, "'", "&#039;")); 
 echo '\');
    } else {
      $(\'banner_upload\').setStyles({display:\'none\'});
      $(\'banner_preview_upload\').setStyles({display:\'block\'});
      var bannersrc = "./uploads_admin/ads/"+imagename;
      var bannerlink = $(\'bannerlink\').value;
      var bannerhtml = "<a href=\'"+bannerlink+"\' target=\'_blank\'><img src=\'"+bannersrc+"\' border=\'0\'></a>";
      set_preview($(\'banner_upload_content\'), bannerhtml);
      $(\'ad_html\').value=bannerhtml;
      $(\'banner_filename_delete\').value=imagename;
      $(\'banner_filename\').value=imagename;
    }
  }
  function uploadbanner2() {
    $(\'banner_preview_upload\').setStyles({display:\'none\'});
    $(\'banner_final_div\').setStyles({display:\'block\'});
    $(\'banner_upload_status\').setStyles({display:\'none\'});
    $(\'banner_upload_submit\').setStyles({display:\'block\'});
    var bannerhtml = $(\'ad_html\').value;
    set_preview($(\'banner_final\'), bannerhtml);
  }
  function uploadbanner_cancel() {
    $(\'banner_preview_upload\').setStyles({display:\'none\'});
    $(\'banner_upload_status\').setStyles({display:\'none\'});
    $(\'banner_upload\').setStyles({display:\'block\'});
    $(\'banner_upload_submit\').setStyles({display:\'block\'});
    $(\'cancelform\').submit();
  }
  function savebanner() {
    var bannerhtml = $(\'bannerhtml\').value;
    if(bannerhtml == "") {
      alert(\''; 
 ob_start(); 
 echo SELanguage::_get(353); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('error_message', ob_get_contents());ob_end_clean(); 
 echo ((is_array($_tmp=$this->_tpl_vars['error_message'])) ? $this->_run_mod_handler('replace', true, $_tmp, "'", "&#039;") : smarty_modifier_replace($_tmp, "'", "&#039;")); 
 echo '\');
    } else {
      $(\'banner_html\').setStyles({display:\'none\'});
      $(\'banner_preview_html\').setStyles({display:\'block\'});
      set_preview($(\'banner_html_content\'), bannerhtml);
    }
  }
  function savebanner2() {
    $(\'banner_preview_html\').setStyles({display:\'none\'});
    $(\'banner_final_div\').setStyles({display:\'block\'});
    var bannerhtml = $(\'bannerhtml\').value;
    set_preview($(\'banner_final\'), bannerhtml); 
    $(\'ad_html\').value=bannerhtml;
  }
  function set_preview(preview_object, banner_html) {
    var banner_html_string = banner_html;
    banner_html_string = banner_html_string.replace(/(.)\\.\\/uploads\\_admin/gi, "$1../uploads_admin");
    preview_object.innerHTML = banner_html_string;
  }
  function startover() {
    $(\'banner_final_div\').setStyles({display:\'none\'});
    $(\'banner_options\').setStyles({display:\'block\'});
    $(\'cancelform\').submit();
  }
  function backtohtml() {
    $(\'banner_final_div\').setStyles({display:\'none\'});
    $(\'banner_html\').setStyles({display:\'block\'});
    $(\'bannerhtml\').value=$(\'ad_html\').value;
  }

  '; 
 if ($this->_tpl_vars['ad_html'] != ""): 
 echo '
  window.addEvent(\'domready\', function(){
    $(\'banner_options\').setStyles({display:\'none\'});
    $(\'banner_final_div\').setStyles({display:\'block\'});
    var bannerhtml = $(\'banner_final\').innerHTML;
    set_preview($(\'banner_final\'), bannerhtml);
  });
  '; 
 endif; 
 echo '
//-->
</script>
'; ?>


<table cellpadding='0' cellspacing='0' width='100%'>
<tr><td class='header'><?php echo SELanguage::_get(346); ?></td></tr>
<tr><td class='setting1'>
<?php echo SELanguage::_get(347); ?>
</td></tr>
<tr><td class='setting2'>

  <table cellspacing='0' cellpadding='0' width='100%'>
  <tr><td class='bannerborder'>

    <div id='banner_options'>
      <h3><b><a onClick="<?php echo '$(\'banner_upload\').setStyles({display:\'block\'});$(\'banner_options\').setStyles({display:\'none\'});'; ?>
" href="#"><?php echo SELanguage::_get(348); ?></a> &nbsp;&nbsp;<?php echo SELanguage::_get(349); ?>&nbsp;&nbsp; <a href="#" onClick="<?php echo '$(\'banner_html\').setStyles({display:\'block\'});$(\'banner_options\').setStyles({display:\'none\'});'; ?>
"><?php echo SELanguage::_get(350); ?></a></b></h3>
    </div>

    <div id='banner_upload' style='display: none;'>
      <b><?php echo SELanguage::_get(358); ?></b>
      <form action='admin_ads_modify.php' enctype='multipart/form-data' method='post' id='uploadform' name='uploadform' target='ajaxframe'>
      <table cellpadding='0' cellspacing='0' align='center'>
      <tr>
      <td class='form1'><?php echo SELanguage::_get(359); ?></td>
      <td class='form2'><input type='file' name='file1' size='40' id='bannersrc' class='text'></td>
      </tr>
      <tr>
      <td class='form1'><?php echo SELanguage::_get(360); ?></td>
      <td class='form2'><input type='text' name='link' size='52' id='bannerlink' value='http://' class='text'></td>
      </tr>
      <tr>
      <td class='form1'>&nbsp;</td>
      <td class='form2'>
	<div id='banner_upload_submit'>
          [ <a href="javascript:uploadbanner()"><?php echo SELanguage::_get(361); ?></a> ] &nbsp;
          [ <a href="#" onClick="<?php echo '$(\'banner_options\').setStyles({display:\'block\'});$(\'banner_upload\').setStyles({display:\'none\'});'; ?>
"><?php echo SELanguage::_get(39); ?></a> ]
	</div>
	<div id='banner_upload_status' style='display: none;'><img src='../images/admin_uploading.gif' border='0'></div>
      </td>
      </tr>
      </table>
      <input type='hidden' name='task' value='doupload'>
      </form>
    </div>

    <div id='banner_preview_upload' style='display: none;'>
      <div style='margin-bottom: 5px;'><b><?php echo SELanguage::_get(354); ?></b></div>
      <div id='banner_upload_content'></div>
      <div style='margin-top: 5px;'>
        [ <a href="javascript:uploadbanner2();"><?php echo SELanguage::_get(355); ?></a> ] &nbsp;
        [ <a href="javascript:uploadbanner_cancel();"><?php echo SELanguage::_get(39); ?></a> ]
      </div>
      <form action='admin_ads_modify.php' method='post' id='cancelform' name='cancelform' target='ajaxframe'>
      <input type='hidden' name='banner_filename_delete' id='banner_filename_delete' value='<?php echo $this->_tpl_vars['ad_filename']; ?>
'>
      <input type='hidden' name='task' value='cancelbanner'>
      </form>
    </div>

    <div id='banner_html' style='display: none;'>
      <b><?php echo SELanguage::_get(351); ?></b><br>
      <textarea rows='4' cols='90' class='text' id='bannerhtml'></textarea>
      <div style='margin-top: 5px;'>
        [ <a href="javascript:savebanner();"><?php echo SELanguage::_get(352); ?></a> ] &nbsp;
        [ <a href="#" onClick="<?php echo '$(\'banner_options\').setStyles({display:\'block\'});$(\'banner_html\').setStyles({display:\'none\'});'; ?>
"><?php echo SELanguage::_get(39); ?></a> ]
      </div>
    </div>

    <div id='banner_preview_html' style='display: none;'>
      <div style='margin-bottom: 5px;'><b><?php echo SELanguage::_get(354); ?></b></div>
      <div id='banner_html_content'></div>
      <div style='margin-top: 5px;'>
        [ <a href="javascript:savebanner2();"><?php echo SELanguage::_get(355); ?></a> ] &nbsp;
        [ <a href="#" onClick="<?php echo '$(\'banner_html\').setStyles({display:\'block\'});$(\'banner_preview_html\').setStyles({display:\'none\'});'; ?>
"><?php echo SELanguage::_get(39); ?></a> ]
      </div>
    </div>

    <div id='banner_final_div' style='display: none;'>
      <div id='banner_final_title'><b><?php echo SELanguage::_get(354); ?></b></div>
      <div id='banner_final' style='padding-top: 3px; padding-bottom: 3px;'><?php echo $this->_tpl_vars['ad_html']; ?>
</div>
      <div id='banner_final_startover'><a href="javascript:startover()"><?php echo SELanguage::_get(356); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:backtohtml()"><?php echo SELanguage::_get(357); ?></a></div>
    </div>

  </td></tr>
  </table>

</td></tr>
</table>

<br>

<form action='admin_ads_modify.php' method='post'>
<input type='hidden' name='ad_html' id='ad_html' value='<?php echo $this->_tpl_vars['ad_html_encoded']; ?>
'>
<input type='hidden' name='banner_filename' id='banner_filename' value='<?php echo $this->_tpl_vars['ad_filename']; ?>
'>
<table cellpadding='0' cellspacing='0' width='100%'>
<tr><td class='header'><?php echo SELanguage::_get(364); ?></td></tr>
<tr><td class='setting1'>
<?php echo SELanguage::_get(365); ?>
<br><br>
<b><?php echo sprintf(SELanguage::_get(366), $this->_tpl_vars['nowdate']); ?></b>
</td></tr>
<tr><td class='setting2'>
  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td class='form1'><?php echo SELanguage::_get(367); ?></td>
  <td class='form2'><input type='text' class='text' name='ad_name' size='64' maxlength='250' value='<?php echo $this->_tpl_vars['ad_name']; ?>
'></td>
  </tr>
  <tr>
  <td class='form1'><?php echo SELanguage::_get(368); ?></td>
  <td class='form2'>
    <select class='text' name='ad_date_start_month'>
    <option></option>
    <?php unset($this->_sections['start_month']);
$this->_sections['start_month']['name'] = 'start_month';
$this->_sections['start_month']['start'] = (int)1;
$this->_sections['start_month']['loop'] = is_array($_loop=13) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['start_month']['show'] = true;
$this->_sections['start_month']['max'] = $this->_sections['start_month']['loop'];
$this->_sections['start_month']['step'] = 1;
if ($this->_sections['start_month']['start'] < 0)
    $this->_sections['start_month']['start'] = max($this->_sections['start_month']['step'] > 0 ? 0 : -1, $this->_sections['start_month']['loop'] + $this->_sections['start_month']['start']);
else
    $this->_sections['start_month']['start'] = min($this->_sections['start_month']['start'], $this->_sections['start_month']['step'] > 0 ? $this->_sections['start_month']['loop'] : $this->_sections['start_month']['loop']-1);
if ($this->_sections['start_month']['show']) {
    $this->_sections['start_month']['total'] = min(ceil(($this->_sections['start_month']['step'] > 0 ? $this->_sections['start_month']['loop'] - $this->_sections['start_month']['start'] : $this->_sections['start_month']['start']+1)/abs($this->_sections['start_month']['step'])), $this->_sections['start_month']['max']);
    if ($this->_sections['start_month']['total'] == 0)
        $this->_sections['start_month']['show'] = false;
} else
    $this->_sections['start_month']['total'] = 0;
if ($this->_sections['start_month']['show']):

            for ($this->_sections['start_month']['index'] = $this->_sections['start_month']['start'], $this->_sections['start_month']['iteration'] = 1;
                 $this->_sections['start_month']['iteration'] <= $this->_sections['start_month']['total'];
                 $this->_sections['start_month']['index'] += $this->_sections['start_month']['step'], $this->_sections['start_month']['iteration']++):
$this->_sections['start_month']['rownum'] = $this->_sections['start_month']['iteration'];
$this->_sections['start_month']['index_prev'] = $this->_sections['start_month']['index'] - $this->_sections['start_month']['step'];
$this->_sections['start_month']['index_next'] = $this->_sections['start_month']['index'] + $this->_sections['start_month']['step'];
$this->_sections['start_month']['first']      = ($this->_sections['start_month']['iteration'] == 1);
$this->_sections['start_month']['last']       = ($this->_sections['start_month']['iteration'] == $this->_sections['start_month']['total']);
?>
      <?php ob_start(); 
 echo ((is_array($_tmp=0)) ? $this->_run_mod_handler('mktime', true, $_tmp, 0, 0, $this->_sections['start_month']['index'], 1, 1990) : mktime($_tmp, 0, 0, $this->_sections['start_month']['index'], 1, 1990)); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('month', ob_get_contents());ob_end_clean(); ?>
      <option value='<?php echo $this->_sections['start_month']['index']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('n',$this->_tpl_vars['ad_date_start']) == $this->_sections['start_month']['index']): ?> selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['datetime']->cdate('M',$this->_tpl_vars['month']); ?>
</option>
    <?php endfor; endif; ?>
    </select>
    <select class='text' name='ad_date_start_day'>
    <option></option>
    <?php unset($this->_sections['start_day']);
$this->_sections['start_day']['name'] = 'start_day';
$this->_sections['start_day']['start'] = (int)1;
$this->_sections['start_day']['loop'] = is_array($_loop=32) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['start_day']['show'] = true;
$this->_sections['start_day']['max'] = $this->_sections['start_day']['loop'];
$this->_sections['start_day']['step'] = 1;
if ($this->_sections['start_day']['start'] < 0)
    $this->_sections['start_day']['start'] = max($this->_sections['start_day']['step'] > 0 ? 0 : -1, $this->_sections['start_day']['loop'] + $this->_sections['start_day']['start']);
else
    $this->_sections['start_day']['start'] = min($this->_sections['start_day']['start'], $this->_sections['start_day']['step'] > 0 ? $this->_sections['start_day']['loop'] : $this->_sections['start_day']['loop']-1);
if ($this->_sections['start_day']['show']) {
    $this->_sections['start_day']['total'] = min(ceil(($this->_sections['start_day']['step'] > 0 ? $this->_sections['start_day']['loop'] - $this->_sections['start_day']['start'] : $this->_sections['start_day']['start']+1)/abs($this->_sections['start_day']['step'])), $this->_sections['start_day']['max']);
    if ($this->_sections['start_day']['total'] == 0)
        $this->_sections['start_day']['show'] = false;
} else
    $this->_sections['start_day']['total'] = 0;
if ($this->_sections['start_day']['show']):

            for ($this->_sections['start_day']['index'] = $this->_sections['start_day']['start'], $this->_sections['start_day']['iteration'] = 1;
                 $this->_sections['start_day']['iteration'] <= $this->_sections['start_day']['total'];
                 $this->_sections['start_day']['index'] += $this->_sections['start_day']['step'], $this->_sections['start_day']['iteration']++):
$this->_sections['start_day']['rownum'] = $this->_sections['start_day']['iteration'];
$this->_sections['start_day']['index_prev'] = $this->_sections['start_day']['index'] - $this->_sections['start_day']['step'];
$this->_sections['start_day']['index_next'] = $this->_sections['start_day']['index'] + $this->_sections['start_day']['step'];
$this->_sections['start_day']['first']      = ($this->_sections['start_day']['iteration'] == 1);
$this->_sections['start_day']['last']       = ($this->_sections['start_day']['iteration'] == $this->_sections['start_day']['total']);
?>
      <option value='<?php echo $this->_sections['start_day']['index']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('j',$this->_tpl_vars['ad_date_start']) == $this->_sections['start_day']['index']): ?> selected='selected'<?php endif; ?>><?php echo $this->_sections['start_day']['index']; ?>
</option>
    <?php endfor; endif; ?>
    </select>
    <select class='text' name='ad_date_start_year'>
    <option></option>
    <?php unset($this->_sections['start_year']);
$this->_sections['start_year']['name'] = 'start_year';
$this->_sections['start_year']['start'] = (int)2008;
$this->_sections['start_year']['loop'] = is_array($_loop=2019) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['start_year']['show'] = true;
$this->_sections['start_year']['max'] = $this->_sections['start_year']['loop'];
$this->_sections['start_year']['step'] = 1;
if ($this->_sections['start_year']['start'] < 0)
    $this->_sections['start_year']['start'] = max($this->_sections['start_year']['step'] > 0 ? 0 : -1, $this->_sections['start_year']['loop'] + $this->_sections['start_year']['start']);
else
    $this->_sections['start_year']['start'] = min($this->_sections['start_year']['start'], $this->_sections['start_year']['step'] > 0 ? $this->_sections['start_year']['loop'] : $this->_sections['start_year']['loop']-1);
if ($this->_sections['start_year']['show']) {
    $this->_sections['start_year']['total'] = min(ceil(($this->_sections['start_year']['step'] > 0 ? $this->_sections['start_year']['loop'] - $this->_sections['start_year']['start'] : $this->_sections['start_year']['start']+1)/abs($this->_sections['start_year']['step'])), $this->_sections['start_year']['max']);
    if ($this->_sections['start_year']['total'] == 0)
        $this->_sections['start_year']['show'] = false;
} else
    $this->_sections['start_year']['total'] = 0;
if ($this->_sections['start_year']['show']):

            for ($this->_sections['start_year']['index'] = $this->_sections['start_year']['start'], $this->_sections['start_year']['iteration'] = 1;
                 $this->_sections['start_year']['iteration'] <= $this->_sections['start_year']['total'];
                 $this->_sections['start_year']['index'] += $this->_sections['start_year']['step'], $this->_sections['start_year']['iteration']++):
$this->_sections['start_year']['rownum'] = $this->_sections['start_year']['iteration'];
$this->_sections['start_year']['index_prev'] = $this->_sections['start_year']['index'] - $this->_sections['start_year']['step'];
$this->_sections['start_year']['index_next'] = $this->_sections['start_year']['index'] + $this->_sections['start_year']['step'];
$this->_sections['start_year']['first']      = ($this->_sections['start_year']['iteration'] == 1);
$this->_sections['start_year']['last']       = ($this->_sections['start_year']['iteration'] == $this->_sections['start_year']['total']);
?>
      <option value='<?php echo $this->_sections['start_year']['index']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('Y',$this->_tpl_vars['ad_date_start']) == $this->_sections['start_year']['index']): ?> selected='selected'<?php endif; ?>><?php echo $this->_sections['start_year']['index']; ?>
</option>
    <?php endfor; endif; ?>
    </select>
    <select class='text' name='ad_date_start_hour'>
    <option></option>
    <?php unset($this->_sections['start_hour']);
$this->_sections['start_hour']['name'] = 'start_hour';
$this->_sections['start_hour']['start'] = (int)1;
$this->_sections['start_hour']['loop'] = is_array($_loop=13) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['start_hour']['show'] = true;
$this->_sections['start_hour']['max'] = $this->_sections['start_hour']['loop'];
$this->_sections['start_hour']['step'] = 1;
if ($this->_sections['start_hour']['start'] < 0)
    $this->_sections['start_hour']['start'] = max($this->_sections['start_hour']['step'] > 0 ? 0 : -1, $this->_sections['start_hour']['loop'] + $this->_sections['start_hour']['start']);
else
    $this->_sections['start_hour']['start'] = min($this->_sections['start_hour']['start'], $this->_sections['start_hour']['step'] > 0 ? $this->_sections['start_hour']['loop'] : $this->_sections['start_hour']['loop']-1);
if ($this->_sections['start_hour']['show']) {
    $this->_sections['start_hour']['total'] = min(ceil(($this->_sections['start_hour']['step'] > 0 ? $this->_sections['start_hour']['loop'] - $this->_sections['start_hour']['start'] : $this->_sections['start_hour']['start']+1)/abs($this->_sections['start_hour']['step'])), $this->_sections['start_hour']['max']);
    if ($this->_sections['start_hour']['total'] == 0)
        $this->_sections['start_hour']['show'] = false;
} else
    $this->_sections['start_hour']['total'] = 0;
if ($this->_sections['start_hour']['show']):

            for ($this->_sections['start_hour']['index'] = $this->_sections['start_hour']['start'], $this->_sections['start_hour']['iteration'] = 1;
                 $this->_sections['start_hour']['iteration'] <= $this->_sections['start_hour']['total'];
                 $this->_sections['start_hour']['index'] += $this->_sections['start_hour']['step'], $this->_sections['start_hour']['iteration']++):
$this->_sections['start_hour']['rownum'] = $this->_sections['start_hour']['iteration'];
$this->_sections['start_hour']['index_prev'] = $this->_sections['start_hour']['index'] - $this->_sections['start_hour']['step'];
$this->_sections['start_hour']['index_next'] = $this->_sections['start_hour']['index'] + $this->_sections['start_hour']['step'];
$this->_sections['start_hour']['first']      = ($this->_sections['start_hour']['iteration'] == 1);
$this->_sections['start_hour']['last']       = ($this->_sections['start_hour']['iteration'] == $this->_sections['start_hour']['total']);
?>
      <option value='<?php echo $this->_sections['start_hour']['index']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('g',$this->_tpl_vars['ad_date_start']) == $this->_sections['start_hour']['index']): ?> selected='selected'<?php endif; ?>><?php echo $this->_sections['start_hour']['index']; ?>
</option>
    <?php endfor; endif; ?>
    </select>&nbsp;<b>:</b>&nbsp;
    <select class='text' name='ad_date_start_minute'>
    <option></option>
    <?php unset($this->_sections['start_minute']);
$this->_sections['start_minute']['name'] = 'start_minute';
$this->_sections['start_minute']['start'] = (int)0;
$this->_sections['start_minute']['loop'] = is_array($_loop=60) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['start_minute']['show'] = true;
$this->_sections['start_minute']['max'] = $this->_sections['start_minute']['loop'];
$this->_sections['start_minute']['step'] = 1;
if ($this->_sections['start_minute']['start'] < 0)
    $this->_sections['start_minute']['start'] = max($this->_sections['start_minute']['step'] > 0 ? 0 : -1, $this->_sections['start_minute']['loop'] + $this->_sections['start_minute']['start']);
else
    $this->_sections['start_minute']['start'] = min($this->_sections['start_minute']['start'], $this->_sections['start_minute']['step'] > 0 ? $this->_sections['start_minute']['loop'] : $this->_sections['start_minute']['loop']-1);
if ($this->_sections['start_minute']['show']) {
    $this->_sections['start_minute']['total'] = min(ceil(($this->_sections['start_minute']['step'] > 0 ? $this->_sections['start_minute']['loop'] - $this->_sections['start_minute']['start'] : $this->_sections['start_minute']['start']+1)/abs($this->_sections['start_minute']['step'])), $this->_sections['start_minute']['max']);
    if ($this->_sections['start_minute']['total'] == 0)
        $this->_sections['start_minute']['show'] = false;
} else
    $this->_sections['start_minute']['total'] = 0;
if ($this->_sections['start_minute']['show']):

            for ($this->_sections['start_minute']['index'] = $this->_sections['start_minute']['start'], $this->_sections['start_minute']['iteration'] = 1;
                 $this->_sections['start_minute']['iteration'] <= $this->_sections['start_minute']['total'];
                 $this->_sections['start_minute']['index'] += $this->_sections['start_minute']['step'], $this->_sections['start_minute']['iteration']++):
$this->_sections['start_minute']['rownum'] = $this->_sections['start_minute']['iteration'];
$this->_sections['start_minute']['index_prev'] = $this->_sections['start_minute']['index'] - $this->_sections['start_minute']['step'];
$this->_sections['start_minute']['index_next'] = $this->_sections['start_minute']['index'] + $this->_sections['start_minute']['step'];
$this->_sections['start_minute']['first']      = ($this->_sections['start_minute']['iteration'] == 1);
$this->_sections['start_minute']['last']       = ($this->_sections['start_minute']['iteration'] == $this->_sections['start_minute']['total']);
?>
      <?php if ($this->_sections['start_minute']['index'] < 10): 
 $this->assign('minute', "0".($this->_sections['start_minute']['index'])); 
 else: 
 $this->assign('minute', $this->_sections['start_minute']['index']); 
 endif; ?>
      <option value='<?php echo $this->_tpl_vars['minute']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('i',$this->_tpl_vars['ad_date_start']) == $this->_tpl_vars['minute']): ?> selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['minute']; ?>
</option>
    <?php endfor; endif; ?>
    </select>
    <select class='text' name='ad_date_start_ampm'>
    <option></option>
    <option value='0'<?php if ($this->_tpl_vars['datetime']->cdate('A',$this->_tpl_vars['ad_date_start']) == 'AM'): ?> selected='selected'<?php endif; ?>>AM</option>
    <option value='1'<?php if ($this->_tpl_vars['datetime']->cdate('A',$this->_tpl_vars['ad_date_start']) == 'PM'): ?> selected='selected'<?php endif; ?>>PM</option>
    </select>
  </td>
  </tr>
  <tr>
  <td class='form1'><?php echo SELanguage::_get(369); ?></td>
  <td class='form2'>

    <table cellpadding='0' cellspacing='0'>
    <tr>
    <td><input type='radio' name='ad_date_end_options' id='timelimit0' value='0' onClick="<?php echo '$(\'enddate\').setStyles({display:\'none\'});'; ?>
"<?php if ($this->_tpl_vars['ad_date_end_options'] == 0): ?> checked='checked'<?php endif; ?>></td>
    <td><label for='timelimit0'><?php echo SELanguage::_get(370); ?></label></td>
    </tr>
    <tr>
    <td><input type='radio' name='ad_date_end_options' id='timelimit1' value='1' onClick="<?php echo '$(\'enddate\').setStyles({display:\'block\'});'; ?>
"<?php if ($this->_tpl_vars['ad_date_end_options'] == 1): ?> checked='checked'<?php endif; ?>></td>
    <td><label for='timelimit1'><?php echo SELanguage::_get(371); ?></label></td>
    </tr>
    </table>

    <div style='margin-top: 7px; margin-bottom: 2px;<?php if ($this->_tpl_vars['ad_date_end_options'] == 0): ?> display: none;<?php endif; ?>' id='enddate'>
      <select class='text' name='ad_date_end_month'>
      <option></option>
      <?php unset($this->_sections['end_month']);
$this->_sections['end_month']['name'] = 'end_month';
$this->_sections['end_month']['start'] = (int)1;
$this->_sections['end_month']['loop'] = is_array($_loop=13) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['end_month']['show'] = true;
$this->_sections['end_month']['max'] = $this->_sections['end_month']['loop'];
$this->_sections['end_month']['step'] = 1;
if ($this->_sections['end_month']['start'] < 0)
    $this->_sections['end_month']['start'] = max($this->_sections['end_month']['step'] > 0 ? 0 : -1, $this->_sections['end_month']['loop'] + $this->_sections['end_month']['start']);
else
    $this->_sections['end_month']['start'] = min($this->_sections['end_month']['start'], $this->_sections['end_month']['step'] > 0 ? $this->_sections['end_month']['loop'] : $this->_sections['end_month']['loop']-1);
if ($this->_sections['end_month']['show']) {
    $this->_sections['end_month']['total'] = min(ceil(($this->_sections['end_month']['step'] > 0 ? $this->_sections['end_month']['loop'] - $this->_sections['end_month']['start'] : $this->_sections['end_month']['start']+1)/abs($this->_sections['end_month']['step'])), $this->_sections['end_month']['max']);
    if ($this->_sections['end_month']['total'] == 0)
        $this->_sections['end_month']['show'] = false;
} else
    $this->_sections['end_month']['total'] = 0;
if ($this->_sections['end_month']['show']):

            for ($this->_sections['end_month']['index'] = $this->_sections['end_month']['start'], $this->_sections['end_month']['iteration'] = 1;
                 $this->_sections['end_month']['iteration'] <= $this->_sections['end_month']['total'];
                 $this->_sections['end_month']['index'] += $this->_sections['end_month']['step'], $this->_sections['end_month']['iteration']++):
$this->_sections['end_month']['rownum'] = $this->_sections['end_month']['iteration'];
$this->_sections['end_month']['index_prev'] = $this->_sections['end_month']['index'] - $this->_sections['end_month']['step'];
$this->_sections['end_month']['index_next'] = $this->_sections['end_month']['index'] + $this->_sections['end_month']['step'];
$this->_sections['end_month']['first']      = ($this->_sections['end_month']['iteration'] == 1);
$this->_sections['end_month']['last']       = ($this->_sections['end_month']['iteration'] == $this->_sections['end_month']['total']);
?>
        <?php ob_start(); 
 echo ((is_array($_tmp=0)) ? $this->_run_mod_handler('mktime', true, $_tmp, 0, 0, $this->_sections['end_month']['index'], 1, 1990) : mktime($_tmp, 0, 0, $this->_sections['end_month']['index'], 1, 1990)); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('month', ob_get_contents());ob_end_clean(); ?>
        <option  value='<?php echo $this->_sections['end_month']['index']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('n',$this->_tpl_vars['ad_date_end']) == $this->_sections['end_month']['index']): ?> selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['datetime']->cdate('M',$this->_tpl_vars['month']); ?>
</option>
      <?php endfor; endif; ?>
      </select>
      <select class='text' name='ad_date_end_day'>
      <option></option>
      <?php unset($this->_sections['end_day']);
$this->_sections['end_day']['name'] = 'end_day';
$this->_sections['end_day']['start'] = (int)1;
$this->_sections['end_day']['loop'] = is_array($_loop=32) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['end_day']['show'] = true;
$this->_sections['end_day']['max'] = $this->_sections['end_day']['loop'];
$this->_sections['end_day']['step'] = 1;
if ($this->_sections['end_day']['start'] < 0)
    $this->_sections['end_day']['start'] = max($this->_sections['end_day']['step'] > 0 ? 0 : -1, $this->_sections['end_day']['loop'] + $this->_sections['end_day']['start']);
else
    $this->_sections['end_day']['start'] = min($this->_sections['end_day']['start'], $this->_sections['end_day']['step'] > 0 ? $this->_sections['end_day']['loop'] : $this->_sections['end_day']['loop']-1);
if ($this->_sections['end_day']['show']) {
    $this->_sections['end_day']['total'] = min(ceil(($this->_sections['end_day']['step'] > 0 ? $this->_sections['end_day']['loop'] - $this->_sections['end_day']['start'] : $this->_sections['end_day']['start']+1)/abs($this->_sections['end_day']['step'])), $this->_sections['end_day']['max']);
    if ($this->_sections['end_day']['total'] == 0)
        $this->_sections['end_day']['show'] = false;
} else
    $this->_sections['end_day']['total'] = 0;
if ($this->_sections['end_day']['show']):

            for ($this->_sections['end_day']['index'] = $this->_sections['end_day']['start'], $this->_sections['end_day']['iteration'] = 1;
                 $this->_sections['end_day']['iteration'] <= $this->_sections['end_day']['total'];
                 $this->_sections['end_day']['index'] += $this->_sections['end_day']['step'], $this->_sections['end_day']['iteration']++):
$this->_sections['end_day']['rownum'] = $this->_sections['end_day']['iteration'];
$this->_sections['end_day']['index_prev'] = $this->_sections['end_day']['index'] - $this->_sections['end_day']['step'];
$this->_sections['end_day']['index_next'] = $this->_sections['end_day']['index'] + $this->_sections['end_day']['step'];
$this->_sections['end_day']['first']      = ($this->_sections['end_day']['iteration'] == 1);
$this->_sections['end_day']['last']       = ($this->_sections['end_day']['iteration'] == $this->_sections['end_day']['total']);
?>
        <option value='<?php echo $this->_sections['end_day']['index']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('j',$this->_tpl_vars['ad_date_end']) == $this->_sections['end_day']['index']): ?> selected='selected'<?php endif; ?>><?php echo $this->_sections['end_day']['index']; ?>
</option>
      <?php endfor; endif; ?>
      </select>
      <select class='text' name='ad_date_end_year'>
      <option></option>
      <?php unset($this->_sections['end_year']);
$this->_sections['end_year']['name'] = 'end_year';
$this->_sections['end_year']['start'] = (int)2008;
$this->_sections['end_year']['loop'] = is_array($_loop=2019) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['end_year']['show'] = true;
$this->_sections['end_year']['max'] = $this->_sections['end_year']['loop'];
$this->_sections['end_year']['step'] = 1;
if ($this->_sections['end_year']['start'] < 0)
    $this->_sections['end_year']['start'] = max($this->_sections['end_year']['step'] > 0 ? 0 : -1, $this->_sections['end_year']['loop'] + $this->_sections['end_year']['start']);
else
    $this->_sections['end_year']['start'] = min($this->_sections['end_year']['start'], $this->_sections['end_year']['step'] > 0 ? $this->_sections['end_year']['loop'] : $this->_sections['end_year']['loop']-1);
if ($this->_sections['end_year']['show']) {
    $this->_sections['end_year']['total'] = min(ceil(($this->_sections['end_year']['step'] > 0 ? $this->_sections['end_year']['loop'] - $this->_sections['end_year']['start'] : $this->_sections['end_year']['start']+1)/abs($this->_sections['end_year']['step'])), $this->_sections['end_year']['max']);
    if ($this->_sections['end_year']['total'] == 0)
        $this->_sections['end_year']['show'] = false;
} else
    $this->_sections['end_year']['total'] = 0;
if ($this->_sections['end_year']['show']):

            for ($this->_sections['end_year']['index'] = $this->_sections['end_year']['start'], $this->_sections['end_year']['iteration'] = 1;
                 $this->_sections['end_year']['iteration'] <= $this->_sections['end_year']['total'];
                 $this->_sections['end_year']['index'] += $this->_sections['end_year']['step'], $this->_sections['end_year']['iteration']++):
$this->_sections['end_year']['rownum'] = $this->_sections['end_year']['iteration'];
$this->_sections['end_year']['index_prev'] = $this->_sections['end_year']['index'] - $this->_sections['end_year']['step'];
$this->_sections['end_year']['index_next'] = $this->_sections['end_year']['index'] + $this->_sections['end_year']['step'];
$this->_sections['end_year']['first']      = ($this->_sections['end_year']['iteration'] == 1);
$this->_sections['end_year']['last']       = ($this->_sections['end_year']['iteration'] == $this->_sections['end_year']['total']);
?>
        <option value='<?php echo $this->_sections['end_year']['index']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('Y',$this->_tpl_vars['ad_date_end']) == $this->_sections['end_year']['index']): ?> selected='selected'<?php endif; ?>><?php echo $this->_sections['end_year']['index']; ?>
</option>
      <?php endfor; endif; ?>
      </select>
      <select class='text' name='ad_date_end_hour'>
      <option></option>
      <?php unset($this->_sections['end_hour']);
$this->_sections['end_hour']['name'] = 'end_hour';
$this->_sections['end_hour']['start'] = (int)1;
$this->_sections['end_hour']['loop'] = is_array($_loop=13) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['end_hour']['show'] = true;
$this->_sections['end_hour']['max'] = $this->_sections['end_hour']['loop'];
$this->_sections['end_hour']['step'] = 1;
if ($this->_sections['end_hour']['start'] < 0)
    $this->_sections['end_hour']['start'] = max($this->_sections['end_hour']['step'] > 0 ? 0 : -1, $this->_sections['end_hour']['loop'] + $this->_sections['end_hour']['start']);
else
    $this->_sections['end_hour']['start'] = min($this->_sections['end_hour']['start'], $this->_sections['end_hour']['step'] > 0 ? $this->_sections['end_hour']['loop'] : $this->_sections['end_hour']['loop']-1);
if ($this->_sections['end_hour']['show']) {
    $this->_sections['end_hour']['total'] = min(ceil(($this->_sections['end_hour']['step'] > 0 ? $this->_sections['end_hour']['loop'] - $this->_sections['end_hour']['start'] : $this->_sections['end_hour']['start']+1)/abs($this->_sections['end_hour']['step'])), $this->_sections['end_hour']['max']);
    if ($this->_sections['end_hour']['total'] == 0)
        $this->_sections['end_hour']['show'] = false;
} else
    $this->_sections['end_hour']['total'] = 0;
if ($this->_sections['end_hour']['show']):

            for ($this->_sections['end_hour']['index'] = $this->_sections['end_hour']['start'], $this->_sections['end_hour']['iteration'] = 1;
                 $this->_sections['end_hour']['iteration'] <= $this->_sections['end_hour']['total'];
                 $this->_sections['end_hour']['index'] += $this->_sections['end_hour']['step'], $this->_sections['end_hour']['iteration']++):
$this->_sections['end_hour']['rownum'] = $this->_sections['end_hour']['iteration'];
$this->_sections['end_hour']['index_prev'] = $this->_sections['end_hour']['index'] - $this->_sections['end_hour']['step'];
$this->_sections['end_hour']['index_next'] = $this->_sections['end_hour']['index'] + $this->_sections['end_hour']['step'];
$this->_sections['end_hour']['first']      = ($this->_sections['end_hour']['iteration'] == 1);
$this->_sections['end_hour']['last']       = ($this->_sections['end_hour']['iteration'] == $this->_sections['end_hour']['total']);
?>
        <option value='<?php echo $this->_sections['end_hour']['index']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('g',$this->_tpl_vars['ad_date_end']) == $this->_sections['end_hour']['index']): ?> selected='selected'<?php endif; ?>><?php echo $this->_sections['end_hour']['index']; ?>
</option>
      <?php endfor; endif; ?>
      </select>&nbsp;<b>:</b>&nbsp;
      <select class='text' name='ad_date_end_minute'>
      <option></option>
      <?php unset($this->_sections['end_minute']);
$this->_sections['end_minute']['name'] = 'end_minute';
$this->_sections['end_minute']['start'] = (int)0;
$this->_sections['end_minute']['loop'] = is_array($_loop=60) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['end_minute']['show'] = true;
$this->_sections['end_minute']['max'] = $this->_sections['end_minute']['loop'];
$this->_sections['end_minute']['step'] = 1;
if ($this->_sections['end_minute']['start'] < 0)
    $this->_sections['end_minute']['start'] = max($this->_sections['end_minute']['step'] > 0 ? 0 : -1, $this->_sections['end_minute']['loop'] + $this->_sections['end_minute']['start']);
else
    $this->_sections['end_minute']['start'] = min($this->_sections['end_minute']['start'], $this->_sections['end_minute']['step'] > 0 ? $this->_sections['end_minute']['loop'] : $this->_sections['end_minute']['loop']-1);
if ($this->_sections['end_minute']['show']) {
    $this->_sections['end_minute']['total'] = min(ceil(($this->_sections['end_minute']['step'] > 0 ? $this->_sections['end_minute']['loop'] - $this->_sections['end_minute']['start'] : $this->_sections['end_minute']['start']+1)/abs($this->_sections['end_minute']['step'])), $this->_sections['end_minute']['max']);
    if ($this->_sections['end_minute']['total'] == 0)
        $this->_sections['end_minute']['show'] = false;
} else
    $this->_sections['end_minute']['total'] = 0;
if ($this->_sections['end_minute']['show']):

            for ($this->_sections['end_minute']['index'] = $this->_sections['end_minute']['start'], $this->_sections['end_minute']['iteration'] = 1;
                 $this->_sections['end_minute']['iteration'] <= $this->_sections['end_minute']['total'];
                 $this->_sections['end_minute']['index'] += $this->_sections['end_minute']['step'], $this->_sections['end_minute']['iteration']++):
$this->_sections['end_minute']['rownum'] = $this->_sections['end_minute']['iteration'];
$this->_sections['end_minute']['index_prev'] = $this->_sections['end_minute']['index'] - $this->_sections['end_minute']['step'];
$this->_sections['end_minute']['index_next'] = $this->_sections['end_minute']['index'] + $this->_sections['end_minute']['step'];
$this->_sections['end_minute']['first']      = ($this->_sections['end_minute']['iteration'] == 1);
$this->_sections['end_minute']['last']       = ($this->_sections['end_minute']['iteration'] == $this->_sections['end_minute']['total']);
?>
        <?php if ($this->_sections['end_minute']['index'] < 10): 
 $this->assign('minute', "0".($this->_sections['end_minute']['index'])); 
 else: 
 $this->assign('minute', $this->_sections['end_minute']['index']); 
 endif; ?>
        <option value='<?php echo $this->_tpl_vars['minute']; ?>
'<?php if ($this->_tpl_vars['datetime']->cdate('i',$this->_tpl_vars['ad_date_end']) == $this->_tpl_vars['minute']): ?> selected='selected'<?php endif; ?>><?php echo $this->_tpl_vars['minute']; ?>
</option>
      <?php endfor; endif; ?>
      </select>
      <select class='text' name='ad_date_end_ampm'>
      <option></option>
      <option value='0'<?php if ($this->_tpl_vars['datetime']->cdate('A',$this->_tpl_vars['ad_date_end']) == 'AM'): ?> selected='selected'<?php endif; ?>>AM</option>
      <option value='1'<?php if ($this->_tpl_vars['datetime']->cdate('A',$this->_tpl_vars['ad_date_end']) == 'PM'): ?> selected='selected'<?php endif; ?>>PM</option>
      </select>
    </div>
  </td>
  </tr>
  <tr>
  <td class='form1'><?php echo SELanguage::_get(372); ?></td>
  <td class='form2'>
    <table cellpadding='0' cellspacing='0'>
    <tr>
    <td><input type='text' id='ad_limit_views' name='ad_limit_views' class='text' size='7' maxlength='10'<?php if ($this->_tpl_vars['ad_limit_views'] == 0): ?> disabled='disabled' style='background: #DDDDDD;'<?php endif; ?> value='<?php if ($this->_tpl_vars['ad_limit_views'] != 0): 
 echo $this->_tpl_vars['ad_limit_views']; 
 endif; ?>'>&nbsp;&nbsp;&nbsp;</td>
    <td><input type='checkbox' id='ad_limit_views_unlimited' name='ad_limit_views_unlimited' value='1' class='checkbox'<?php if ($this->_tpl_vars['ad_limit_views'] == 0): ?> checked='checked'<?php endif; ?> onClick="<?php echo 'if(this.checked == true){ $(\'ad_limit_views\').value = \'\'; $(\'ad_limit_views\').disabled=true; $(\'ad_limit_views\').style.backgroundColor=\'#DDDDDD\'; } else { $(\'ad_limit_views\').disabled=false; $(\'ad_limit_views\').style.backgroundColor=\'#FFFFFF\'; }'; ?>
"> <label for='ad_limit_views_unlimited'><?php echo SELanguage::_get(373); ?></label></td>
    </tr>
    </table>
  </td>
  </tr>
  <tr>
  <td class='form1'><?php echo SELanguage::_get(374); ?></td>
  <td class='form2'>
    <table cellpadding='0' cellspacing='0'>
    <tr>
    <td><input type='text' id='ad_limit_clicks' name='ad_limit_clicks' class='text' size='7' maxlength='10'<?php if ($this->_tpl_vars['ad_limit_clicks'] == 0): ?> disabled='disabled' style='background: #DDDDDD;'<?php endif; ?> value='<?php if ($this->_tpl_vars['ad_limit_clicks'] != 0): 
 echo $this->_tpl_vars['ad_limit_clicks']; 
 endif; ?>'>&nbsp;&nbsp;&nbsp;</td>
    <td><input type='checkbox' id='ad_limit_clicks_unlimited' name='ad_limit_clicks_unlimited' value='1' class='checkbox'<?php if ($this->_tpl_vars['ad_limit_clicks'] == 0): ?> checked='checked'<?php endif; ?> onClick="<?php echo 'if(this.checked == true){ $(\'ad_limit_clicks\').value = \'\'; $(\'ad_limit_clicks\').disabled=true; $(\'ad_limit_clicks\').style.backgroundColor=\'#DDDDDD\'; } else { $(\'ad_limit_clicks\').disabled=false; $(\'ad_limit_clicks\').style.backgroundColor=\'#FFFFFF\'; }'; ?>
"> <label for='ad_limit_clicks_unlimited'><?php echo SELanguage::_get(373); ?></label></td>
    </tr>
    </table>
  </td>
  </tr>
  <tr>
  <td class='form1'><?php echo SELanguage::_get(375); ?></td>
  <td class='form2'>
    <table cellpadding='0' cellspacing='0'>
    <tr>
    <td><input type='text' id='ad_limit_ctr' name='ad_limit_ctr' class='text' size='7' maxlength='7'<?php if ($this->_tpl_vars['ad_limit_ctr'] == 0): ?> disabled='disabled' style='background: #DDDDDD;'<?php endif; ?> value='<?php if ($this->_tpl_vars['ad_limit_ctr'] != 0): 
 echo $this->_tpl_vars['ad_limit_ctr']; 
 endif; ?>'>&nbsp;&nbsp;&nbsp;</td>
    <td><input type='checkbox' id='ad_limit_ctr_unlimited' name='ad_limit_ctr_unlimited' value='1' class='checkbox'<?php if ($this->_tpl_vars['ad_limit_ctr'] == 0): ?> checked='checked'<?php endif; ?> onClick="<?php echo 'if(this.checked == true){ $(\'ad_limit_ctr\').value = \'\'; $(\'ad_limit_ctr\').disabled=true; $(\'ad_limit_ctr\').style.backgroundColor=\'#DDDDDD\'; } else { $(\'ad_limit_ctr\').disabled=false; $(\'ad_limit_ctr\').style.backgroundColor=\'#FFFFFF\'; }'; ?>
"> <label for='ad_limit_ctr_unlimited'><?php echo SELanguage::_get(373); ?></label></td>
    </tr>
    </table>
  </td>
  </tr>
  </table>
</td></tr>
</table>

<br>


<table cellpadding='0' cellspacing='0' width='100%'>
<tr><td class='header'><?php echo SELanguage::_get(376); ?></td></tr>
<tr><td class='setting1'>
  <?php echo SELanguage::_get(377); ?>
</td></tr>
<tr><td class='setting2'>
  <table cellpadding='0' cellspacing='0' align='center'>
  <tr>
  <td colspan='3'><img src='../images/admin_ads_top<?php if ($this->_tpl_vars['ad_position'] == 'top'): ?>3<?php endif; ?>.gif' style='cursor: pointer;' border='0' id='top' onMouseOver="highlight_over('top')" onMouseOut="highlight_out('top')" onClick="highlight_click('top')"></td>
  </tr>
  <tr>
  <td colspan='3'><img src='../images/admin_ads_menu.gif' border='0'></td>
  </tr>
  <tr>
  <td colspan='3'><img src='../images/admin_ads_belowmenu<?php if ($this->_tpl_vars['ad_position'] == 'belowmenu'): ?>3<?php endif; ?>.gif' style='cursor: pointer;' border='0' id='belowmenu' onMouseOver="highlight_over('belowmenu')" onMouseOut="highlight_out('belowmenu')" onClick="highlight_click('belowmenu')"></td>
  </tr>
  <tr>
  <td><img src='../images/admin_ads_left<?php if ($this->_tpl_vars['ad_position'] == 'left'): ?>3<?php endif; ?>.gif' style='cursor: pointer;' border='0' id='left' onMouseOver="highlight_over('left')" onMouseOut="highlight_out('left')" onClick="highlight_click('left')"></td>
  <td><img src='../images/admin_ads_feed<?php if ($this->_tpl_vars['ad_position'] == 'feed'): ?>3<?php endif; ?>.gif' style='cursor: pointer;' border='0' id='feed' onMouseOver="highlight_over('feed')" onMouseOut="highlight_out('feed')" onClick="highlight_click('feed')"><div style='padding-top: 3px;'><img src='../images/admin_ads_content.gif' border='0'></div></td>
  <td><img src='../images/admin_ads_right<?php if ($this->_tpl_vars['ad_position'] == 'right'): ?>3<?php endif; ?>.gif' style='cursor: pointer;' border='0' id='right' onMouseOver="highlight_over('right')" onMouseOut="highlight_out('right')" onClick="highlight_click('right')"></td>
  </tr>
  <tr>
  <td colspan='3'><img src='../images/admin_ads_bottom<?php if ($this->_tpl_vars['ad_position'] == 'bottom'): ?>3<?php endif; ?>.gif' style='cursor: pointer;' border='0' id='bottom' onMouseOver="highlight_over('bottom')" onMouseOut="highlight_out('bottom')" onClick="highlight_click('bottom')"></td>
  </tr>
  </table>
  <input type='hidden' name='banner_position' id='banner_position' value='<?php echo $this->_tpl_vars['ad_position']; ?>
'>
</td></tr>
<tr><td class='setting1'>
  <?php echo $this->_tpl_vars['admin_ads_add57']; ?>

  <div style='text-align: center;'>
    <h3><b><?php echo '{$ads->ads_display(\''; 
 echo $this->_tpl_vars['ad_id']; 
 echo '\')}'; ?>
</b></h3>
  </div>
</td></tr>
</table>

<br>

<?php if (count($this->_tpl_vars['levels']) > 10 || count($this->_tpl_vars['subnets']) + 1 > 10): ?>
  <?php $this->assign('options_to_show', '10'); 
 elseif (count($this->_tpl_vars['levels']) > count($this->_tpl_vars['subnets']) + 1): ?>
  <?php $this->assign('options_to_show', count($this->_tpl_vars['levels'])); 
 elseif (count($this->_tpl_vars['levels']) < count($this->_tpl_vars['subnets']) + 1): ?>
  <?php $this->assign('options_to_show', ($this->_tpl_vars['subnets'])."|@count+1"); 
 elseif (count($this->_tpl_vars['levels']) == count($this->_tpl_vars['subnets']) + 1): ?>
  <?php $this->assign('options_to_show', count($this->_tpl_vars['levels'])); 
 endif; ?>

<table cellpadding='0' cellspacing='0' width='100%'>
<tr><td class='header'><?php echo SELanguage::_get(379); ?></td></tr>
<tr><td class='setting1'>
  <?php echo SELanguage::_get(380); ?>
</td></tr>
<tr><td class='setting2'>
  <table cellpadding='0' cellspacing='0' align='center'>
  <tr>
  <td><b><?php echo SELanguage::_get(8); ?></b></td>
  <td style='padding-left: 10px;'><b><?php echo SELanguage::_get(9); ?></b></td>
  </tr>
  <tr>
  <td>
    <select size='<?php echo $this->_tpl_vars['options_to_show']; ?>
' class='text' name='ad_levels[]' multiple='multiple' style='width: 335px;'>
    <?php unset($this->_sections['level_loop']);
$this->_sections['level_loop']['name'] = 'level_loop';
$this->_sections['level_loop']['loop'] = is_array($_loop=$this->_tpl_vars['levels']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['level_loop']['show'] = true;
$this->_sections['level_loop']['max'] = $this->_sections['level_loop']['loop'];
$this->_sections['level_loop']['step'] = 1;
$this->_sections['level_loop']['start'] = $this->_sections['level_loop']['step'] > 0 ? 0 : $this->_sections['level_loop']['loop']-1;
if ($this->_sections['level_loop']['show']) {
    $this->_sections['level_loop']['total'] = $this->_sections['level_loop']['loop'];
    if ($this->_sections['level_loop']['total'] == 0)
        $this->_sections['level_loop']['show'] = false;
} else
    $this->_sections['level_loop']['total'] = 0;
if ($this->_sections['level_loop']['show']):

            for ($this->_sections['level_loop']['index'] = $this->_sections['level_loop']['start'], $this->_sections['level_loop']['iteration'] = 1;
                 $this->_sections['level_loop']['iteration'] <= $this->_sections['level_loop']['total'];
                 $this->_sections['level_loop']['index'] += $this->_sections['level_loop']['step'], $this->_sections['level_loop']['iteration']++):
$this->_sections['level_loop']['rownum'] = $this->_sections['level_loop']['iteration'];
$this->_sections['level_loop']['index_prev'] = $this->_sections['level_loop']['index'] - $this->_sections['level_loop']['step'];
$this->_sections['level_loop']['index_next'] = $this->_sections['level_loop']['index'] + $this->_sections['level_loop']['step'];
$this->_sections['level_loop']['first']      = ($this->_sections['level_loop']['iteration'] == 1);
$this->_sections['level_loop']['last']       = ($this->_sections['level_loop']['iteration'] == $this->_sections['level_loop']['total']);
?>
      <option value='<?php echo $this->_tpl_vars['levels'][$this->_sections['level_loop']['index']]['level_id']; ?>
'<?php if (((is_array($_tmp=$this->_tpl_vars['levels'][$this->_sections['level_loop']['index']]['level_id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['ad_levels_array']) : in_array($_tmp, $this->_tpl_vars['ad_levels_array']))): ?> selected='selected'<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['levels'][$this->_sections['level_loop']['index']]['level_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 75, "...", true) : smarty_modifier_truncate($_tmp, 75, "...", true)); 
 if ($this->_tpl_vars['levels'][$this->_sections['level_loop']['index']]['level_default'] == 1): ?> <?php echo SELanguage::_get(382); 
 endif; ?></option>
    <?php endfor; endif; ?>
    </select>
  </td>
  <td style='padding-left: 10px;'>
    <select size='<?php echo $this->_tpl_vars['options_to_show']; ?>
' class='text' name='ad_subnets[]' multiple='multiple' style='width: 335px;'>
    <option value='0'<?php if (((is_array($_tmp='0')) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['ad_subnets_array']) : in_array($_tmp, $this->_tpl_vars['ad_subnets_array'])) === TRUE): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get(383); ?></option>
    <?php unset($this->_sections['subnet_loop']);
$this->_sections['subnet_loop']['name'] = 'subnet_loop';
$this->_sections['subnet_loop']['loop'] = is_array($_loop=$this->_tpl_vars['subnets']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['subnet_loop']['show'] = true;
$this->_sections['subnet_loop']['max'] = $this->_sections['subnet_loop']['loop'];
$this->_sections['subnet_loop']['step'] = 1;
$this->_sections['subnet_loop']['start'] = $this->_sections['subnet_loop']['step'] > 0 ? 0 : $this->_sections['subnet_loop']['loop']-1;
if ($this->_sections['subnet_loop']['show']) {
    $this->_sections['subnet_loop']['total'] = $this->_sections['subnet_loop']['loop'];
    if ($this->_sections['subnet_loop']['total'] == 0)
        $this->_sections['subnet_loop']['show'] = false;
} else
    $this->_sections['subnet_loop']['total'] = 0;
if ($this->_sections['subnet_loop']['show']):

            for ($this->_sections['subnet_loop']['index'] = $this->_sections['subnet_loop']['start'], $this->_sections['subnet_loop']['iteration'] = 1;
                 $this->_sections['subnet_loop']['iteration'] <= $this->_sections['subnet_loop']['total'];
                 $this->_sections['subnet_loop']['index'] += $this->_sections['subnet_loop']['step'], $this->_sections['subnet_loop']['iteration']++):
$this->_sections['subnet_loop']['rownum'] = $this->_sections['subnet_loop']['iteration'];
$this->_sections['subnet_loop']['index_prev'] = $this->_sections['subnet_loop']['index'] - $this->_sections['subnet_loop']['step'];
$this->_sections['subnet_loop']['index_next'] = $this->_sections['subnet_loop']['index'] + $this->_sections['subnet_loop']['step'];
$this->_sections['subnet_loop']['first']      = ($this->_sections['subnet_loop']['iteration'] == 1);
$this->_sections['subnet_loop']['last']       = ($this->_sections['subnet_loop']['iteration'] == $this->_sections['subnet_loop']['total']);
?>
      <option value='<?php echo $this->_tpl_vars['subnets'][$this->_sections['subnet_loop']['index']]['subnet_id']; ?>
'<?php if (((is_array($_tmp=$this->_tpl_vars['subnets'][$this->_sections['subnet_loop']['index']]['subnet_id'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['ad_subnets_array']) : in_array($_tmp, $this->_tpl_vars['ad_subnets_array']))): ?> selected='selected'<?php endif; ?>><?php echo SELanguage::_get($this->_tpl_vars['subnets'][$this->_sections['subnet_loop']['index']]['subnet_name']); ?></option>
    <?php endfor; endif; ?>
    </select>
  </td>
  </tr>
  </table>
</td></tr>
<tr><td class='setting2'>
  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td><input type='checkbox' name='ad_public' id='ad_public' value='1'<?php if ($this->_tpl_vars['ad_public'] == 1): ?> checked='checked'<?php endif; ?>></td>
  <td><label for='ad_public'><?php echo SELanguage::_get(384); ?></label></td>
  </tr>
  </table>
</td></tr>
</table>

<br>

<table cellpadding='0' cellspacing='0'>
<tr>
<td>
  <input type='submit' class='button' value='<?php if ($this->_tpl_vars['ad_exists'] == 0): 
 echo SELanguage::_get(385); 
 else: 
 echo SELanguage::_get(173); 
 endif; ?>'>&nbsp;
  <input type='hidden' name='task' value='dosave'>
  <input type='hidden' name='ad_id' value='<?php echo $this->_tpl_vars['ad_id']; ?>
'>
  </form>
</td>
<td>
  <form action='admin_ads.php' method='post'>
  <input type='submit' class='button' value='<?php echo SELanguage::_get(39); ?>'>
  </form>
</td>
</tr>
</table>

<br>

</td>
</tr>
</table>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'admin_footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>