<?php /* Smarty version 2.6.14, created on 2010-06-03 05:04:14
         compiled from classified.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'classified.tpl', 33, false),array('modifier', 'truncate', 'classified.tpl', 43, false),array('modifier', 'choptext', 'classified.tpl', 85, false),array('modifier', 'escape', 'classified.tpl', 141, false),array('function', 'cycle', 'classified.tpl', 110, false),)), $this);
?><?php
SELanguage::_preload_multi(4500056,861,4500121,4500123,4500142,589,4500057,4500058,4500059,39,155,175,182,183,184,185,187,784,787,829,830,831,832,833,834,835,854,856,891,1025,1026,1032,1034,1071);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div class='page_header'>
  <?php echo sprintf(SELanguage::_get(4500056), $this->_tpl_vars['owner']->user_displayname, $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['owner']->user_info['user_username']), $this->_tpl_vars['url']->url_create('classifieds',$this->_tpl_vars['owner']->user_info['user_username'])); ?>
</div>


<?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(861,4500121,4500123,4500142));
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


<?php if (isset ( $this->_tpl_vars['page_is_preview'] )): ?><table cellspacing='0' cellpadding='0' id='classifiedpreview' style='width:100%'><tr><td>&nbsp;</td><td class='content' style='width:100%'><?php endif; ?>


<div class='seClassifiedListing'>
  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <?php $this->assign('classified_photo', $this->_tpl_vars['classified']->classified_photo("./images/nophoto.gif")); ?>
      <?php $this->assign('classified_thumb', $this->_tpl_vars['classified']->classified_photo("./images/nophoto.gif",'TRUE')); ?>
      <td class='seClassifiedLeft' width='1'>
        <div class="seClassifiedPhoto" style="width: 140px;">
        <?php if ($this->_tpl_vars['classified_photo'] != "./images/nophoto.gif" && $this->_tpl_vars['classified_photo'] != $this->_tpl_vars['classified_thumb']): ?>
          <a href="javascript:void(0);" class="seClassifiedPhotoLink" onclick="SocialEngine.Classified.imagePreviewClassified('<?php echo $this->_tpl_vars['classified_photo']; ?>
', <?php echo ((is_array($_tmp=@$this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_width'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
, <?php echo ((is_array($_tmp=@$this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_height'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
);">
            <img src='<?php echo $this->_tpl_vars['classified_thumb']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['classified_thumb'],'140','140','w'); ?>
' />
          </a>
        <?php else: ?>
          <img src='<?php echo $this->_tpl_vars['classified_photo']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['classified_photo'],'140','140','w'); ?>
' />
        <?php endif; ?>
        </div>
      </td>
      <td class='seClassifiedRight' width='100%' valign="top">
        <div class='seClassifiedTitle'>
          <?php if (! $this->_tpl_vars['classified']->classified_info['classified_title']): ?><i><?php echo SELanguage::_get(589); ?></i><?php else: 
 echo ((is_array($_tmp=$this->_tpl_vars['classified']->classified_info['classified_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 75, "...", true) : smarty_modifier_truncate($_tmp, 75, "...", true)); 
 endif; ?>
        </div>
        
        <div class='seClassifiedStats'>
          <?php $this->assign('classified_datecreated', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['classified']->classified_info['classified_date'])); ?>
          <?php ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['classified_datecreated'][0]), $this->_tpl_vars['classified_datecreated'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('datecreated', ob_get_contents());ob_end_clean(); ?>
          <?php echo sprintf(SELanguage::_get(4500057), $this->_tpl_vars['datecreated']); ?>
        </div>
        
                <?php if ($this->_tpl_vars['cat_info']['classifiedcat_title'] != ""): ?>
          <div class='seClassifiedCategory'>
            <?php echo sprintf(SELanguage::_get(4500058), $this->_tpl_vars['cat_info']['classifiedcat_title'], "browse_classifieds.php?classifiedcat_id=".($this->_tpl_vars['classified']->classified_info['classified_classifiedcat_id'])); ?>
          </div>
        <?php endif; ?>
        
                <div class='seClassifiedFields'>
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
          
          <table cellpadding='0' cellspacing='0'>
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
            <tr>
              <td valign='top' style='padding-right: 10px;' nowrap='nowrap'>
                <?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_title']); ?>:
              </td>
              <td>
              <div class='profile_field_value'><?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['fields'][$this->_sections['field_loop']['index']]['field_value_formatted']; ?>
</div>
                            </td>
            </tr>
          
          <?php endfor; endif; ?>
          </table>
          
          <?php endfor; endif; ?>
        </div>
        
        <div class='seClassifiedBody'>
          <?php echo ((is_array($_tmp=$this->_tpl_vars['classified']->classified_info['classified_body'])) ? $this->_run_mod_handler('choptext', true, $_tmp, 75, "<br />") : smarty_modifier_choptext($_tmp, 75, "<br />")); ?>

        </div>
        
        <?php if ($this->_tpl_vars['total_files'] > 0): ?><br /><?php endif; ?>
        
                <?php unset($this->_sections['file_loop']);
$this->_sections['file_loop']['name'] = 'file_loop';
$this->_sections['file_loop']['loop'] = is_array($_loop=$this->_tpl_vars['files']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['file_loop']['show'] = true;
$this->_sections['file_loop']['max'] = $this->_sections['file_loop']['loop'];
$this->_sections['file_loop']['step'] = 1;
$this->_sections['file_loop']['start'] = $this->_sections['file_loop']['step'] > 0 ? 0 : $this->_sections['file_loop']['loop']-1;
if ($this->_sections['file_loop']['show']) {
    $this->_sections['file_loop']['total'] = $this->_sections['file_loop']['loop'];
    if ($this->_sections['file_loop']['total'] == 0)
        $this->_sections['file_loop']['show'] = false;
} else
    $this->_sections['file_loop']['total'] = 0;
if ($this->_sections['file_loop']['show']):

            for ($this->_sections['file_loop']['index'] = $this->_sections['file_loop']['start'], $this->_sections['file_loop']['iteration'] = 1;
                 $this->_sections['file_loop']['iteration'] <= $this->_sections['file_loop']['total'];
                 $this->_sections['file_loop']['index'] += $this->_sections['file_loop']['step'], $this->_sections['file_loop']['iteration']++):
$this->_sections['file_loop']['rownum'] = $this->_sections['file_loop']['iteration'];
$this->_sections['file_loop']['index_prev'] = $this->_sections['file_loop']['index'] - $this->_sections['file_loop']['step'];
$this->_sections['file_loop']['index_next'] = $this->_sections['file_loop']['index'] + $this->_sections['file_loop']['step'];
$this->_sections['file_loop']['first']      = ($this->_sections['file_loop']['iteration'] == 1);
$this->_sections['file_loop']['last']       = ($this->_sections['file_loop']['iteration'] == $this->_sections['file_loop']['total']);
?>

                    <?php if ($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'jpeg' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'jpg' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'gif' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'png' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'bmp'): ?>
            <?php $this->assign('file_dir', $this->_tpl_vars['classified']->classified_dir($this->_tpl_vars['classified']->classified_info['classified_id'])); ?>
            <?php $this->assign('file_src_full', ($this->_tpl_vars['file_dir']).($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_id']).".".($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'])); ?>
            <?php $this->assign('file_src', ($this->_tpl_vars['file_dir']).($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_id'])."_thumb.jpg"); ?>
                    <?php elseif ($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mp3' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mp4' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'wav'): ?>
            <?php $this->assign('file_src', './images/icons/audio_big.gif'); ?>
                    <?php elseif ($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mpeg' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mpg' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mpa' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'avi' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'swf' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mov' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'ram' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'rm'): ?>
            <?php $this->assign('file_src', './images/icons/video_big.gif'); ?>
                    <?php else: ?>
            <?php $this->assign('file_src', './images/icons/file_big.gif'); ?>
          <?php endif; ?>

                    <?php echo smarty_function_cycle(array('name' => 'startrow','values' => "<table cellpadding='0' cellspacing='0'><tr>,"), $this);?>

                    <td style='padding: 5px 10px 5px 0px; text-align: center; vertical-align: middle;'>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...", true) : smarty_modifier_truncate($_tmp, 20, "...", true)); ?>

            <div class='album_thumb2' style='text-align: center; vertical-align: middle;'>
              <a href="javascript:void(0);" class="seClassifiedPhotoLink" onclick="SocialEngine.Classified.imagePreviewClassified('<?php echo $this->_tpl_vars['file_src_full']; ?>
', <?php echo ((is_array($_tmp=@$this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_width'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
, <?php echo ((is_array($_tmp=@$this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_height'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
);">
                <img src='<?php echo $this->_tpl_vars['file_src']; ?>
' border='0'  width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['file_src'],'300','240','w'); ?>
' class='photo' />
              </a>
            </div>
          </td>
                    <?php if ($this->_sections['file_loop']['last'] == true): ?>
            </tr></table>
          <?php else: ?>
            <?php echo smarty_function_cycle(array('name' => 'endrow','values' => ",</tr></table>"), $this);?>

          <?php endif; ?>
          
        <?php endfor; endif; ?>
        
      </td>
    </tr>
  </table>
</div>
<br />


<div style='margin-bottom: 20px;'>
  <div class='button' style='float: left;'>
    <a href='<?php echo $this->_tpl_vars['url']->url_create('classifieds',$this->_tpl_vars['owner']->user_info['user_username']); ?>
'><img src='./images/icons/back16.gif' border='0' class='button' /><?php echo sprintf(SELanguage::_get(4500059), $this->_tpl_vars['owner']->user_displayname); ?></a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <a href="javascript:TB_show(SocialEngine.Language.Translate(861), 'user_report.php?return_url=<?php echo ((is_array($_tmp=$this->_tpl_vars['url']->url_current())) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><img src='./images/icons/report16.gif' border='0' class='button'><?php echo SELanguage::_get(861); ?></a>
  </div>
  <div style='clear: both; height: 0px;'></div>
</div>
<br />


<div id="classified_<?php echo $this->_tpl_vars['classified']->classified_info['classified_id']; ?>
_postcomment"></div>
<div id="classified_<?php echo $this->_tpl_vars['classified']->classified_info['classified_id']; ?>
_comments" style='margin-left: auto; margin-right: auto;'></div>

<?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(39,155,175,182,183,184,185,187,784,787,829,830,831,832,833,834,835,854,856,891,1025,1026,1032,1034,1071));
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

<script type="text/javascript">
  
  SocialEngine.ClassifiedComments = new SocialEngineAPI.Comments({
    'canComment' : <?php if ($this->_tpl_vars['allowed_to_comment']): ?>true<?php else: ?>false<?php endif; ?>,
    'commentHTML' : '<?php echo $this->_tpl_vars['setting']['setting_comment_html']; ?>
',
    'commentCode' : <?php if ($this->_tpl_vars['setting']['setting_comment_code']): ?>true<?php else: ?>false<?php endif; ?>,
    
    'type' : 'classified',
    'typeIdentifier' : 'classified_id',
    'typeID' : <?php echo $this->_tpl_vars['classified']->classified_info['classified_id']; ?>
,
    'typeTab' : 'classifieds',
    'typeCol' : 'classified',
    
    'initialTotal' : <?php echo ((is_array($_tmp=@$this->_tpl_vars['total_comments'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
,
    'paginate' : true,
    'cpp' : 5
  });
  
  SocialEngine.RegisterModule(SocialEngine.ClassifiedComments);
  
  // Backwards
  function addComment(is_error, comment_body, comment_date)
  {
    SocialEngine.ClassifiedComments.addComment(is_error, comment_body, comment_date);
  }
  
  function getComments(direction)
  {
    SocialEngine.ClassifiedComments.getComments(direction);
  }
  
</script>


<div style="width:1px; height:1px; visibility: hidden; overflow:hidden;" id="seClassifiedImagePreview">
  <table cellpadding='0' cellspacing='0'  style="width: 100%; height: 100%; padding-top: 5px;"><tr>
    <td valign="middle" align="center"><img id="seClassifiedImageFull" src="./images/icons/file_big.gif" style="vertical-align: middle;" valign="middle" align="center" /></td>
  </tr></table>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>