<?php /* Smarty version 2.6.14, created on 2010-06-24 16:26:52
         compiled from user_classified.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'user_classified.tpl', 107, false),array('function', 'cycle', 'user_classified.tpl', 128, false),array('modifier', 'truncate', 'user_classified.tpl', 149, false),array('modifier', 'choptext', 'user_classified.tpl', 149, false),array('modifier', 'strip_tags', 'user_classified.tpl', 182, false),)), $this);
?><?php
SELanguage::_preload_multi(4500068,4500065,4500066,4500067,1500049,646,861,4500121,4500123,4500122,175,39,4500070,4500071,182,184,185,183,589,4500058,4500072,507,4500135,4500136,4500073,4500074,4500075,4500076);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table cellpadding='0' cellspacing='0' width='100%'>
<tr>
<td valign='top'>
<img src='./images/icons/classified_classified48.gif' border='0' class='icon_big' style="margin-bottom: 15px;">
<div class='page_header'><?php echo SELanguage::_get(4500068); ?></div>
<div class='mom_div_small'>
Post your listing and check back regularly for responses
</div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='150'>
  <tr><td class='button' nowrap='nowrap'><a href='classifieds_home.php'><img src='./images/icons/back16.gif' border='0' class='button'>Back to Classifieds</a></td></tr>
  </table>

</td>
</tr>
</table>

<div style='margin-top: 20px;'>
  <div class='button' style='float: left;'>
    <a href='user_classified_listing.php'><img src='./images/icons/classified_post16.gif' border='0' class='button' /><?php echo SELanguage::_get(4500065); ?></a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <a href='user_classified_settings.php'><img src='./images/icons/classified_settings16.gif' border='0' class='button' /><?php echo SELanguage::_get(4500066); ?></a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <a href="javascript:void(0);" onclick="$('classified_search').style.display = ( $('classified_search').style.display=='block' ? 'none' : 'block');this.blur();"><img src='./images/icons/search16.gif' border='0' class='button' /><?php echo SELanguage::_get(4500067); ?></a>
  </div>
  <div style='clear: both; height: 0px;'></div>
</div>


<div id='classified_search' class="seClassifiedSearch" style='margin-top: 10px;<?php if (empty ( $this->_tpl_vars['search'] )): ?> display: none;<?php endif; ?>'>
  <div style='padding: 10px;'>
    <form action='user_classified.php' name='searchform' method='post'>
    <table cellpadding='0' cellspacing='0' align='center'>
    <tr>
    <td><b><?php echo SELanguage::_get(1500049); ?></b>&nbsp;&nbsp;</td>
    <td><input type='text' name='search' maxlength='100' size='30' value='<?php echo $this->_tpl_vars['search']; ?>
' />&nbsp;</td>
    <td><?php $this->assign('langBlockTemp', SE_Language::_get(646));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?></td>
    </tr>
    </table>
    <input type='hidden' name='s' value='<?php echo $this->_tpl_vars['s']; ?>
' />
    <input type='hidden' name='p' value='<?php echo $this->_tpl_vars['p']; ?>
' />
    </form>
  </div>
</div>


<?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(861,4500121,4500123));
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
<script type="text/javascript" src="./include/js/class_classified.js"></script>
<script type="text/javascript">
  
  SocialEngine.Classified = new SocialEngineAPI.Classified();
  SocialEngine.RegisterModule(SocialEngine.Classified);
  
</script>


<div style='display: none;' id='confirmclassifieddelete'>
  <div style='margin-top: 10px;'>
    <?php echo SELanguage::_get(4500122); ?>
  </div>
  <br />
  <?php $this->assign('langBlockTemp', SE_Language::_get(175));


  ?><input type='button' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' onClick='parent.TB_remove();parent.SocialEngine.Classified.deleteClassifiedConfirm();' /><?php 

  ?>
  <?php $this->assign('langBlockTemp', SE_Language::_get(39));


  ?><input type='button' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' onClick='parent.TB_remove();' /><?php 

  ?>
</div>


<div id="seClassifiedNullMessage"<?php if ($this->_tpl_vars['total_classifieds']): ?> style="display: none;"<?php endif; ?>>
  <table cellpadding='0' cellspacing='0' align='center'>
    <tr>
      <td class='result'>
        <?php if (! empty ( $this->_tpl_vars['search'] )): ?>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          <?php echo SELanguage::_get(4500070); ?>
        <?php else: ?>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          <?php echo sprintf(SELanguage::_get(4500071), 'user_classified_listing.php'); ?>
        <?php endif; ?>
      </td>
    </tr>
  </table>
</div>


<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='user_classified.php?search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a>
    <?php else: ?>
      <font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
      &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_classifieds']); ?> &nbsp;|&nbsp; 
    <?php else: ?>
      &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_classifieds']); ?> &nbsp;|&nbsp; 
    <?php endif; ?>
    <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
      <a href='user_classified.php?search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php else: ?>
      <font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font>
    <?php endif; ?>
  </div>
  <br />
<?php endif; 
 unset($this->_sections['classified_loop']);
$this->_sections['classified_loop']['name'] = 'classified_loop';
$this->_sections['classified_loop']['loop'] = is_array($_loop=$this->_tpl_vars['classifieds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['classified_loop']['show'] = true;
$this->_sections['classified_loop']['max'] = $this->_sections['classified_loop']['loop'];
$this->_sections['classified_loop']['step'] = 1;
$this->_sections['classified_loop']['start'] = $this->_sections['classified_loop']['step'] > 0 ? 0 : $this->_sections['classified_loop']['loop']-1;
if ($this->_sections['classified_loop']['show']) {
    $this->_sections['classified_loop']['total'] = $this->_sections['classified_loop']['loop'];
    if ($this->_sections['classified_loop']['total'] == 0)
        $this->_sections['classified_loop']['show'] = false;
} else
    $this->_sections['classified_loop']['total'] = 0;
if ($this->_sections['classified_loop']['show']):

            for ($this->_sections['classified_loop']['index'] = $this->_sections['classified_loop']['start'], $this->_sections['classified_loop']['iteration'] = 1;
                 $this->_sections['classified_loop']['iteration'] <= $this->_sections['classified_loop']['total'];
                 $this->_sections['classified_loop']['index'] += $this->_sections['classified_loop']['step'], $this->_sections['classified_loop']['iteration']++):
$this->_sections['classified_loop']['rownum'] = $this->_sections['classified_loop']['iteration'];
$this->_sections['classified_loop']['index_prev'] = $this->_sections['classified_loop']['index'] - $this->_sections['classified_loop']['step'];
$this->_sections['classified_loop']['index_next'] = $this->_sections['classified_loop']['index'] + $this->_sections['classified_loop']['step'];
$this->_sections['classified_loop']['first']      = ($this->_sections['classified_loop']['iteration'] == 1);
$this->_sections['classified_loop']['last']       = ($this->_sections['classified_loop']['iteration'] == $this->_sections['classified_loop']['total']);
?>
<div id='seClassified_<?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']; ?>
' class="seClassified <?php echo smarty_function_cycle(array('values' => 'seClassified1,seClassified2'), $this);?>
">

  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td class='seClassifiedLeft' width='1'>
        <div class='seClassifiedPhoto' style='width: 140px;'>
          <table cellpadding='0' cellspacing='0' width='140'>
            <tr>
              <td>
                <a href='<?php echo $this->_tpl_vars['url']->url_create('classified',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']); ?>
'>
                  <img src='<?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_photo("./images/nophoto.gif"); ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_photo("./images/nophoto.gif"),'140','140','w'); ?>
' />
                </a>
              </td>
            </tr>
          </table>
        </div>
      </td>
      <td class='seClassifiedRight' width='100%'>
      
                <div class='seClassifiedTitle'>
          <?php if (! $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_title']): ?><i><?php echo SELanguage::_get(589); ?></i><?php else: 
 echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 70, "...", false) : smarty_modifier_truncate($_tmp, 70, "...", false)))) ? $this->_run_mod_handler('choptext', true, $_tmp, 40, "<br>") : smarty_modifier_choptext($_tmp, 40, "<br>")); 
 endif; ?>
        </div>
        
                <?php if (! empty ( $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['main_category_title'] )): ?>
        <div class='seClassifiedCategory'>
          <?php echo SELanguage::_get(4500058); ?>
                    <?php if (! empty ( $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['parent_category_title'] )): ?>
            <a href="browse_classifieds.php?classifiedcat_id=<?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['parent_category_id']; ?>
"><?php echo SELanguage::_get($this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['parent_category_title']); ?></a>
            -
          <?php endif; ?>
          <a href="browse_classifieds.php?classifiedcat_id=<?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['main_category_id']; ?>
"><?php echo SELanguage::_get($this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['main_category_title']); ?></a>
        </div>
        <?php endif; ?>
        
                <div class='seClassifiedStats'>
          <?php $this->assign('classified_datecreated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_date'])); ?>
          <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['classified_datecreated'][0]), $this->_tpl_vars['classified_datecreated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('created', ob_get_contents());ob_end_clean(); ?>
          <?php $this->assign('classified_dateupdated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_dateupdated'])); ?>
          <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['classified_dateupdated'][0]), $this->_tpl_vars['classified_dateupdated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('updated', ob_get_contents());ob_end_clean(); ?>
          
          <?php echo sprintf(SELanguage::_get(4500072), $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_views']); ?>
          - <?php echo sprintf(SELanguage::_get(507), $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['total_comments']); ?>
          - <?php echo sprintf(SELanguage::_get(4500135), $this->_tpl_vars['created']); ?>
          <?php if ($this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_dateupdated'] && $this->_tpl_vars['created'] != $this->_tpl_vars['updated']): ?>
            - <?php echo sprintf(SELanguage::_get(4500136), $this->_tpl_vars['updated']); ?>
          <?php endif; ?>
        </div>
        
                <div class='seClassifiedBody' style='margin-top: 8px; margin-bottom: 8px;'>
          <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_body'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 197, "...", true) : smarty_modifier_truncate($_tmp, 197, "...", true)); ?>

        </div>
        
                <div class='seClassifiedOptions'>
                    <div class="seClassifiedOption1">
            <a href='<?php echo $this->_tpl_vars['url']->url_create('classified',$this->_tpl_vars['user']->user_info['user_username'],$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']); ?>
'>
              <img src='./images/icons/classified_classified16.gif' border='0' class='button' />
              <?php echo SELanguage::_get(4500073); ?>
            </a>
          </div>
          
                    <div class="seClassifiedOption2">
            <a href='user_classified_listing.php?classified_id=<?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']; ?>
'>
              <img src='./images/icons/classified_edit16.gif' border='0' class='button' />
              <?php echo SELanguage::_get(4500074); ?>
            </a>
          </div>
          
                    <div class="seClassifiedOption2">
            <a href='user_classified_media.php?classified_id=<?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']; ?>
'>
              <img src='./images/icons/classified_editmedia16.gif' border='0' class='button' />
              <?php echo SELanguage::_get(4500075); ?>
            </a>
          </div>
          
                    <div class="seClassifiedOption2">
            <a href='javascript:void(0);' onclick="SocialEngine.Classified.deleteClassified(<?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']; ?>
);">
              <img src='./images/icons/classified_delete16.gif' border='0' class='button' />
              <?php echo SELanguage::_get(4500076); ?>
            </a>
          </div>
        </div>
      </td>
    </tr>
  </table>
  
</div>
<?php endfor; endif; ?>

<div style='clear: both; height: 0px;'></div>



<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div class='center'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='user_classified.php?search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
'>&#171; <?php echo SELanguage::_get(182); ?></a>
    <?php else: ?>
      <font class='disabled'>&#171; <?php echo SELanguage::_get(182); ?></font>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
      &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_classifieds']); ?> &nbsp;|&nbsp; 
    <?php else: ?>
      &nbsp;|&nbsp; <?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_classifieds']); ?> &nbsp;|&nbsp; 
    <?php endif; ?>
    <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
      <a href='user_classified.php?search=<?php echo $this->_tpl_vars['search']; ?>
&p=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php else: ?>
      <font class='disabled'><?php echo SELanguage::_get(183); ?> &#187;</font>
    <?php endif; ?>
  </div>
  <br />
<?php endif; ?>
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