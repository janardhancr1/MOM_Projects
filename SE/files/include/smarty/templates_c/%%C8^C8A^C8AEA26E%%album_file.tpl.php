<?php /* Smarty version 2.6.14, created on 2010-04-23 14:08:39
         compiled from album_file.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'array_search', 'album_file.tpl', 95, false),array('modifier', 'count', 'album_file.tpl', 96, false),array('modifier', 'escape', 'album_file.tpl', 151, false),array('modifier', 'replace', 'album_file.tpl', 163, false),array('modifier', 'default', 'album_file.tpl', 324, false),array('function', 'math', 'album_file.tpl', 96, false),)), $this);
?><?php
SELanguage::_preload_multi(1000141,1000142,1000143,1000144,1000145,1000146,1000147,1000162,1000163,1000126,1000164,1000148,1000165,1000166,1000167,1000168,589,1000169,1000170,39,1212,1213,1214,1215,1228,155,175,182,183,184,185,187,784,787,829,830,831,832,833,834,835,854,856,891,1025,1026,1032,1034,1071);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 
 $this->assign('page_width', $this->_tpl_vars['owner']->level_info['level_album_width']); 
 $this->assign('menu_width', $this->_tpl_vars['page_width']+32); ?>

<div style='width: <?php echo $this->_tpl_vars['menu_width']; ?>
px; margin-left: auto; margin-right: auto;'>

<div class='page_header'>
  <?php echo sprintf(SELanguage::_get(1000141), $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['owner']->user_info['user_username']), $this->_tpl_vars['owner']->user_displayname, $this->_tpl_vars['url']->url_create('albums',$this->_tpl_vars['owner']->user_info['user_username'])); ?>
  &#187; <a href='<?php echo $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id']); ?>
'><?php echo $this->_tpl_vars['album_info']['album_title']; ?>
</a>
</div>


<?php $this->assign('media_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['owner']->user_info['user_id'])); 
 $this->assign('media_path', ($this->_tpl_vars['media_dir']).($this->_tpl_vars['media_info']['media_id']).".".($this->_tpl_vars['media_info']['media_ext'])); 
 if ($this->_tpl_vars['media_info']['media_ext'] == 'jpg' || $this->_tpl_vars['media_info']['media_ext'] == 'jpeg' || $this->_tpl_vars['media_info']['media_ext'] == 'gif' || $this->_tpl_vars['media_info']['media_ext'] == 'png' || $this->_tpl_vars['media_info']['media_ext'] == 'bmp'): ?>
  <?php $this->assign('file_src', "<img src='".($this->_tpl_vars['media_path'])."' id='media_photo' border='0'>"); ?>
  <?php $this->assign('is_image', true); 
 elseif ($this->_tpl_vars['media_info']['media_ext'] == 'mp3' || $this->_tpl_vars['media_info']['media_ext'] == 'mp4' || $this->_tpl_vars['media_info']['media_ext'] == 'wav'): ?>
  <?php ob_start(); ?>[ <a href='<?php echo $this->_tpl_vars['media_path']; ?>
'><?php echo SELanguage::_get(1000142); ?></a> ]<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('media_download', ob_get_contents());ob_end_clean(); ?>
  <?php $this->assign('file_src', "<a href='".($this->_tpl_vars['media_path'])."'><img src='./images/icons/album_audio_big.gif' border='0'></a>"); ?>
  <?php $this->assign('is_image', false); 
 elseif ($this->_tpl_vars['media_info']['media_ext'] == 'mpeg' || $this->_tpl_vars['media_info']['media_ext'] == 'mpg' || $this->_tpl_vars['media_info']['media_ext'] == 'mpa' || $this->_tpl_vars['media_info']['media_ext'] == 'avi' || $this->_tpl_vars['media_info']['media_ext'] == 'ram' || $this->_tpl_vars['media_info']['media_ext'] == 'rm'): ?>
  <?php ob_start(); ?>[ <a href='<?php echo $this->_tpl_vars['media_path']; ?>
'><?php echo SELanguage::_get(1000143); ?></a> ]<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('media_download', ob_get_contents());ob_end_clean(); ?>
  <?php $this->assign('file_src', "
    <object id='video'
      classid='CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6'
      type='application/x-oleobject'>
      <param name='url' value='".($this->_tpl_vars['media_path'])."'>
      <param name='sendplaystatechangeevents' value='True'>
      <param name='autostart' value='true'>
      <param name='autosize' value='true'>
      <param name='uimode' value='mini'>
      <param name='playcount' value='9999'>
    </OBJECT>
  "); ?>
  <?php $this->assign('is_image', false); 
 elseif ($this->_tpl_vars['media_info']['media_ext'] == 'mov' || $this->_tpl_vars['media_info']['media_ext'] == 'moov' || $this->_tpl_vars['media_info']['media_ext'] == 'movie' || $this->_tpl_vars['media_info']['media_ext'] == 'qtm' || $this->_tpl_vars['media_info']['media_ext'] == 'qt'): ?>
  <?php ob_start(); ?>[ <a href='<?php echo $this->_tpl_vars['media_path']; ?>
'><?php echo SELanguage::_get(1000143); ?></a> ]<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('media_download', ob_get_contents());ob_end_clean(); ?>
  <?php $this->assign('file_src', "
    <embed src='".($this->_tpl_vars['media_path'])."' controller='true' autosize='1' scale='1' width='550' height='350'>
  "); ?>
  <?php $this->assign('is_image', false); 
 elseif ($this->_tpl_vars['media_info']['media_ext'] == 'swf'): ?>
  <?php $this->assign('file_src', "
	<object width='350' height='250' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0' id='myMovieName'>
	  <param name=movie value=".($this->_tpl_vars['media_path']).">
	  <param name=quality value=high>
	  <param name=bgcolor value=#FFFFFF>
	  <embed src=".($this->_tpl_vars['media_path'])." quality=high bgcolor=#FFFFFF width='350' height='250' name='myMovieName' align='' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer'>
	  </embed>
	</object>
  "); ?>
  <?php $this->assign('is_image', false); 
 else: ?>
  <?php ob_start(); ?>[ <a href='<?php echo $this->_tpl_vars['media_path']; ?>
'><?php echo SELanguage::_get(1000144); ?></a> ]<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('media_download', ob_get_contents());ob_end_clean(); ?>
  <?php $this->assign('file_src', "<a href='".($this->_tpl_vars['media_path'])."'><img src='./images/icons/file_big.gif' border='0'></a>"); ?>
  <?php $this->assign('is_image', false); 
 endif; 
 $this->assign('current_index', ((is_array($_tmp=$this->_tpl_vars['media_info']['media_id'])) ? $this->_run_mod_handler('array_search', true, $_tmp, $this->_tpl_vars['media_keys']) : array_search($_tmp, $this->_tpl_vars['media_keys']))); 
 ob_start(); 
 if ($this->_tpl_vars['current_index'] == 0): 
 echo smarty_function_math(array('equation' => "x-1",'x' => count($this->_tpl_vars['media'])), $this);
 else: 
 echo smarty_function_math(array('equation' => "x-1",'x' => $this->_tpl_vars['current_index']), $this);
 endif; 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('previous_index', ob_get_contents());ob_end_clean(); 
 ob_start(); 
 if ($this->_tpl_vars['current_index']+1 == count($this->_tpl_vars['media'])): ?>0<?php else: 
 echo smarty_function_math(array('equation' => "x+1",'x' => $this->_tpl_vars['current_index']), $this);
 endif; 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('next_index', ob_get_contents());ob_end_clean(); 
 ob_start(); 
 echo smarty_function_math(array('equation' => "x+1",'x' => $this->_tpl_vars['current_index']), $this);
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('current_num', ob_get_contents());ob_end_clean(); ?>


<br>

<div style='margin-bottom: 6px;'>
  <table cellpadding='0' cellspacing='0' width='100%'>
  <tr>
  <td>
    <?php echo sprintf(SELanguage::_get(1000145), $this->_tpl_vars['current_num'], count($this->_tpl_vars['media']), $this->_tpl_vars['url']->url_create('album',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id']), $this->_tpl_vars['album_info']['album_title']); ?>
  </td>
  <td style='text-align: right;'>
    <a href='<?php echo $this->_tpl_vars['url']->url_create('album_file',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id'],$this->_tpl_vars['media_keys'][$this->_tpl_vars['previous_index']]); ?>
'><?php echo SELanguage::_get(1000146); ?></a>
    &nbsp;&nbsp;&nbsp;
    <a href='<?php echo $this->_tpl_vars['url']->url_create('album_file',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id'],$this->_tpl_vars['media_keys'][$this->_tpl_vars['next_index']]); ?>
'><?php echo SELanguage::_get(1000147); ?></a>
  </td>
  </tr>
  </table>
</div>

<div class='media'>
  <table cellpadding='0' cellspacing='0' align='center'>
  <tr>
  <td style='text-align: center;'>

        <div id='media_photo_div' class='media_photo_div' style='<?php if ($this->_tpl_vars['is_image']): ?>width:<?php echo $this->_tpl_vars['media_info']['media_width']; ?>
px;height:<?php echo $this->_tpl_vars['media_info']['media_height']; ?>
px;<?php endif; ?>'>

            <?php echo $this->_tpl_vars['file_src']; ?>


    </div>

        <?php if ($this->_tpl_vars['media_download'] != ""): ?>
      <div style='font-weight: bold; margin-left: auto; margin-right: auto;'><?php echo $this->_tpl_vars['media_download']; ?>
</div>
    <?php endif; ?>

        <div class='album_media_caption' style='width: <?php if ($this->_tpl_vars['media_info']['media_width'] > 300): 
 echo $this->_tpl_vars['media_info']['media_width']; 
 else: ?>300<?php endif; ?>px;'>
      <?php if ($this->_tpl_vars['media_info']['media_title'] != ""): ?><div class='album_media_title'><?php echo $this->_tpl_vars['media_info']['media_title']; ?>
</div><?php endif; ?>
      <?php if ($this->_tpl_vars['media_info']['media_desc'] != ""): ?><div><?php echo $this->_tpl_vars['media_info']['media_desc']; ?>
</div><?php endif; ?>
      <div id='media_tags' style='display: none; margin-top: 10px;'><?php echo SELanguage::_get(1000162); ?></div>
      <?php if ($this->_tpl_vars['is_image'] && $this->_tpl_vars['allowed_to_tag']): ?>
        <a href='javascript:void(0);' onClick="SocialEngine.MediaTag.addTag();"><?php echo SELanguage::_get(1000163); ?></a>
      <?php endif; ?>
      <div class='album_media_date'>
        <?php echo SELanguage::_get(1000126); ?> <?php $this->assign('uploaddate', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['media_info']['media_date'])); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['uploaddate'][0]), $this->_tpl_vars['uploaddate'][1]); ?>
        -
        <a href="javascript:TB_show('<?php echo SELanguage::_get(1000164); ?>', '#TB_inline?height=400&width=400&inlineId=sharethis', '', '../images/trans.gif');"><?php echo SELanguage::_get(1000164); ?></a>
        -
        <a href="javascript:TB_show('<?php echo SELanguage::_get(1000148); ?>', 'user_report.php?return_url=<?php echo ((is_array($_tmp=$this->_tpl_vars['url']->url_current())) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&TB_iframe=true&height=300&width=450', '', './images/trans.gif');"><?php echo SELanguage::_get(1000148); ?></a>
      </div>
    </div>
  </td>
  </tr>
  </table>
</div>

<div style='display: none;' id='sharethis'>
  <div style='margin: 10px 0px 10px 0px;'><?php echo SELanguage::_get(1000165); ?></div>
  <div style='margin: 10px 0px 10px 0px; font-weight: bold;'><?php echo SELanguage::_get(1000166); ?></div>
  <textarea readonly='readonly' onClick='this.select()' class='text' rows='2' cols='30' style='width: 95%; font-size: 9px;'><?php echo $this->_tpl_vars['url']->url_base; 
 echo ((is_array($_tmp=$this->_tpl_vars['media_path'])) ? $this->_run_mod_handler('replace', true, $_tmp, "./", "") : smarty_modifier_replace($_tmp, "./", "")); ?>
</textarea>
  <div style='margin: 10px 0px 10px 0px; font-weight: bold;'><?php echo SELanguage::_get(1000167); ?></div>
  <textarea readonly='readonly' onClick='this.select()' class='text' rows='2' cols='30' style='width: 95%; font-size: 9px;'><a href='<?php echo $this->_tpl_vars['url']->url_base; 
 echo ((is_array($_tmp=$this->_tpl_vars['media_path'])) ? $this->_run_mod_handler('replace', true, $_tmp, "./", "") : smarty_modifier_replace($_tmp, "./", "")); ?>
'><img src='<?php echo $this->_tpl_vars['url']->url_base; 
 echo ((is_array($_tmp=$this->_tpl_vars['media_path'])) ? $this->_run_mod_handler('replace', true, $_tmp, "./", "") : smarty_modifier_replace($_tmp, "./", "")); ?>
' border='0'></a></textarea>
  <div style='margin: 10px 0px 10px 0px; font-weight: bold;'><?php echo SELanguage::_get(1000168); ?></div>
  <textarea readonly='readonly' onClick='this.select()' class='text' rows='2' cols='30' style='width: 95%; font-size: 9px;'><a href='<?php echo $this->_tpl_vars['url']->url_base; 
 echo ((is_array($_tmp=$this->_tpl_vars['media_path'])) ? $this->_run_mod_handler('replace', true, $_tmp, "./", "") : smarty_modifier_replace($_tmp, "./", "")); ?>
'><?php if ($this->_tpl_vars['media_info']['media_title'] != ""): 
 echo $this->_tpl_vars['media_info']['media_title']; 
 else: 
 echo SELanguage::_get(589); 
 endif; ?></a></textarea>
  <div style='margin: 10px 0px 10px 0px; font-weight: bold;'><?php echo SELanguage::_get(1000169); ?></div>
  <textarea readonly='readonly' onClick='this.select()' class='text' rows='2' cols='30' style='width: 95%; font-size: 9px;'>[url=<?php echo $this->_tpl_vars['url']->url_base; 
 echo ((is_array($_tmp=$this->_tpl_vars['media_path'])) ? $this->_run_mod_handler('replace', true, $_tmp, "./", "") : smarty_modifier_replace($_tmp, "./", "")); ?>
][img]<?php echo $this->_tpl_vars['url']->url_base; 
 echo ((is_array($_tmp=$this->_tpl_vars['media_path'])) ? $this->_run_mod_handler('replace', true, $_tmp, "./", "") : smarty_modifier_replace($_tmp, "./", "")); ?>
[/img][/url]</textarea>
  <div style='margin-top: 10px;'>
    <input type='button' class='button' value='<?php echo SELanguage::_get(1000170); ?>' onClick='parent.TB_remove();'>
  </div>
</div>

<?php 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(39,1212,1213,1214,1215,1228));
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
        
  SocialEngine.MediaTag = new SocialEngineAPI.Tags({
      'canTag' : <?php if ($this->_tpl_vars['allowed_to_tag']): ?>true<?php else: ?>false<?php endif; ?>,

      'type' : '',
      'media_id' : <?php echo $this->_tpl_vars['media_info']['media_id']; ?>
,
      'media_dir' : '<?php echo $this->_tpl_vars['media_dir']; ?>
'

    });
        
    SocialEngine.RegisterModule(SocialEngine.MediaTag);
       
    <?php unset($this->_sections['tag_loop']);
$this->_sections['tag_loop']['name'] = 'tag_loop';
$this->_sections['tag_loop']['loop'] = is_array($_loop=$this->_tpl_vars['tags']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tag_loop']['show'] = true;
$this->_sections['tag_loop']['max'] = $this->_sections['tag_loop']['loop'];
$this->_sections['tag_loop']['step'] = 1;
$this->_sections['tag_loop']['start'] = $this->_sections['tag_loop']['step'] > 0 ? 0 : $this->_sections['tag_loop']['loop']-1;
if ($this->_sections['tag_loop']['show']) {
    $this->_sections['tag_loop']['total'] = $this->_sections['tag_loop']['loop'];
    if ($this->_sections['tag_loop']['total'] == 0)
        $this->_sections['tag_loop']['show'] = false;
} else
    $this->_sections['tag_loop']['total'] = 0;
if ($this->_sections['tag_loop']['show']):

            for ($this->_sections['tag_loop']['index'] = $this->_sections['tag_loop']['start'], $this->_sections['tag_loop']['iteration'] = 1;
                 $this->_sections['tag_loop']['iteration'] <= $this->_sections['tag_loop']['total'];
                 $this->_sections['tag_loop']['index'] += $this->_sections['tag_loop']['step'], $this->_sections['tag_loop']['iteration']++):
$this->_sections['tag_loop']['rownum'] = $this->_sections['tag_loop']['iteration'];
$this->_sections['tag_loop']['index_prev'] = $this->_sections['tag_loop']['index'] - $this->_sections['tag_loop']['step'];
$this->_sections['tag_loop']['index_next'] = $this->_sections['tag_loop']['index'] + $this->_sections['tag_loop']['step'];
$this->_sections['tag_loop']['first']      = ($this->_sections['tag_loop']['iteration'] == 1);
$this->_sections['tag_loop']['last']       = ($this->_sections['tag_loop']['iteration'] == $this->_sections['tag_loop']['total']);
?>
      insertTag('<?php echo $this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['mediatag_id']; ?>
', '<?php if ($this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['tagged_user']->user_exists): 
 echo $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['tagged_user']->user_info['user_username']); 
 endif; ?>', '<?php if ($this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['tag_user']->user_exists): 
 echo $this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['tagged_user']->user_displayname; 
 else: 
 echo $this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['mediatag_text']; 
 endif; ?>', '<?php echo $this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['mediatag_x']; ?>
', '<?php echo $this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['mediatag_y']; ?>
', '<?php echo $this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['mediatag_width']; ?>
', '<?php echo $this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['mediatag_height']; ?>
', '<?php echo $this->_tpl_vars['tags'][$this->_sections['tag_loop']['index']]['tagged_user']->user_info['user_username']; ?>
')
    <?php endfor; endif; ?>

    // Backwards
    function insertTag(tag_id, tag_link, tag_text, tag_x, tag_y, tag_width, tag_height, tagged_user)
    {
      SocialEngine.MediaTag.insertTag(tag_id, tag_link, tag_text, tag_x, tag_y, tag_width, tag_height, tagged_user);
    }

  </script>


</div>


<table cellpadding='0' cellspacing='0' align='center' style='margin-top: 20px;'>
<tr>
<td><a href='javascript:void(0);' onClick='moveLeft();this.blur()'><img src='./images/icons/media_moveleft.gif' border='0' onMouseOver="this.src='./images/icons/media_moveleft2.gif';" onMouseOut="this.src='./images/icons/media_moveleft.gif';"></a></td>
<td>

  <div id='album_carousel' style='width: 562px; margin: 0px 5px 0px 5px; text-align: center; overflow: hidden;'>

    <table cellpadding='0' cellspacing='0'>
    <tr>
    <td id='thumb-2' style='padding: 0px 5px 0px 5px;'><img src='./images/media_placeholder.gif' border='0' width='70'></td>
    <td id='thumb-1' style='padding: 0px 5px 0px 5px;'><img src='./images/media_placeholder.gif' border='0' width='70'></td>
    <td id='thumb0' style='padding: 0px 5px 0px 5px;'><img src='./images/media_placeholder.gif' border='0' width='70'></td>
    <?php $_from = $this->_tpl_vars['media']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['media_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['media_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['media_loop']['iteration']++;
?>

            <?php if ($this->_tpl_vars['v']['media_ext'] == 'jpeg' || $this->_tpl_vars['v']['media_ext'] == 'jpg' || $this->_tpl_vars['v']['media_ext'] == 'gif' || $this->_tpl_vars['v']['media_ext'] == 'png' || $this->_tpl_vars['v']['media_ext'] == 'bmp'): ?>
        <?php $this->assign('file_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['v']['album_user_id'])); ?>
        <?php $this->assign('file_src', ($this->_tpl_vars['file_dir']).($this->_tpl_vars['v']['media_id'])."_thumb.jpg"); ?>
            <?php elseif ($this->_tpl_vars['v']['media_ext'] == 'mp3' || $this->_tpl_vars['v']['media_ext'] == 'mp4' || $this->_tpl_vars['v']['media_ext'] == 'wav'): ?>
        <?php $this->assign('file_src', './images/icons/audio_big.gif'); ?>
            <?php elseif ($this->_tpl_vars['v']['media_ext'] == 'mpeg' || $this->_tpl_vars['v']['media_ext'] == 'mpg' || $this->_tpl_vars['v']['media_ext'] == 'mpa' || $this->_tpl_vars['v']['media_ext'] == 'avi' || $this->_tpl_vars['v']['media_ext'] == 'swf' || $this->_tpl_vars['v']['media_ext'] == 'mov' || $this->_tpl_vars['v']['media_ext'] == 'ram' || $this->_tpl_vars['v']['media_ext'] == 'rm'): ?>
        <?php $this->assign('file_src', './images/icons/video_big.gif'); ?>
            <?php else: ?>
        <?php $this->assign('file_src', './images/icons/file_big.gif'); ?>
      <?php endif; ?>

            <td id='thumb<?php echo $this->_foreach['media_loop']['iteration']; ?>
' class='carousel_item<?php if ($this->_tpl_vars['v']['media_id'] == $this->_tpl_vars['media_info']['media_id']): ?>_active<?php endif; ?>'><a href='<?php echo $this->_tpl_vars['url']->url_create('album_file',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['album_info']['album_id'],$this->_tpl_vars['v']['media_id']); ?>
'><img src='<?php echo $this->_tpl_vars['file_src']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['file_src'],'70','70','w'); ?>
' onClick='this.blur()'></a></td>

    <?php endforeach; endif; unset($_from); ?>
    <td id='thumb<?php echo smarty_function_math(array('equation' => "x+1",'x' => count($this->_tpl_vars['media'])), $this);?>
' class='carousel_item'><img src='./images/media_placeholder.gif' border='0' width='70'></td>
    <td id='thumb<?php echo smarty_function_math(array('equation' => "x+2",'x' => count($this->_tpl_vars['media'])), $this);?>
' class='carousel_item'><img src='./images/media_placeholder.gif' border='0' width='70'></td>
    <td id='thumb<?php echo smarty_function_math(array('equation' => "x+3",'x' => count($this->_tpl_vars['media'])), $this);?>
' class='carousel_item'><img src='./images/media_placeholder.gif' border='0' width='70'></td>
    </tr>
    </table>

  </div>

</td>
<td><a href='javascript:void(0);' onClick='moveRight();this.blur()'><img src='./images/icons/media_moveright.gif' border='0' onMouseOver="this.src='./images/icons/media_moveright2.gif';" onMouseOut="this.src='./images/icons/media_moveright.gif';"></a></td>
</tr>
</table>


<div style='width: <?php echo $this->_tpl_vars['menu_width']; ?>
px; margin-left: auto; margin-right: auto;'>


<?php echo '
<script type=\'text/javascript\'>
<!--

  var visiblePhotos = 7;
  var current_id = 0;
  var myFx;

  window.addEvent(\'domready\', function() {
    myFx = new Fx.Scroll(\'album_carousel\');
    current_id = parseInt('; 
 echo smarty_function_math(array('equation' => "x-2",'x' => $this->_tpl_vars['current_index']), $this);
 echo ');
    var position = $(\'thumb\'+current_id).getPosition($(\'album_carousel\'));
    myFx.set(position.x, position.y);
  });


  function moveLeft() {
    if($(\'thumb\'+(current_id-1))) {
      myFx.toElement(\'thumb\'+(current_id-1));
      myFx.toLeft();
      current_id = parseInt(current_id-1);
    }
  }

  function moveRight() {
    if($(\'thumb\'+(current_id+visiblePhotos))) {
      myFx.toElement(\'thumb\'+(current_id+1));
      myFx.toRight();
      current_id = parseInt(current_id+1);
    }
  }

//-->
</script>
'; ?>


<br>


<div style='margin-left: auto; margin-right: auto;'>

    <div id="media_<?php echo $this->_tpl_vars['media_info']['media_id']; ?>
_postcomment"></div>
  <div id="media_<?php echo $this->_tpl_vars['media_info']['media_id']; ?>
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
        
    SocialEngine.MediaComments = new SocialEngineAPI.Comments({
      'canComment' : <?php if ($this->_tpl_vars['allowed_to_comment']): ?>true<?php else: ?>false<?php endif; ?>,
      'commentHTML' : '<?php echo ((is_array($_tmp=$this->_tpl_vars['setting']['setting_comment_html'])) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>
',
      'commentCode' : <?php if ($this->_tpl_vars['setting']['setting_comment_code']): ?>true<?php else: ?>false<?php endif; ?>,

      'type' : 'media',
      'typeIdentifier' : 'media_id',
      'typeID' : <?php echo $this->_tpl_vars['media_info']['media_id']; ?>
,
          
      'typeTab' : 'media',
      'typeCol' : 'media',
      'typeTabParent' : 'albums',
      'typeColParent' : 'album',
      'typeChild' : true,
          
      'initialTotal' : <?php echo ((is_array($_tmp=@$this->_tpl_vars['total_comments'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>

    });
        
    SocialEngine.RegisterModule(SocialEngine.MediaComments);
       
    // Backwards
    function addComment(is_error, comment_body, comment_date)
    {
      SocialEngine.MediaComments.addComment(is_error, comment_body, comment_date);
    }
        
    function getComments(direction)
    {
      SocialEngine.MediaComments.getComments(direction);
    }

  </script>

</div>




</div>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>