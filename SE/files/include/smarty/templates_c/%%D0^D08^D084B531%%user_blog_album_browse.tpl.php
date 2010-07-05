<?php /* Smarty version 2.6.14, created on 2010-05-26 13:09:25
         compiled from user_blog_album_browse.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'user_blog_album_browse.tpl', 16, false),array('modifier', 'replace', 'user_blog_album_browse.tpl', 17, false),array('modifier', 'truncate', 'user_blog_album_browse.tpl', 101, false),)), $this);
?><?php
SELanguage::load();
?><html>
<head>


<script type="text/javascript" src="./include/js/mootools12.js"></script>
<script type="text/javascript" src="./include/js/mootools12-more.js"></script>

<link rel="stylesheet" href="./templates/styles.css" title="stylesheet" type="text/css" />
<link rel="stylesheet" href="./templates/styles_global.css" title="stylesheet" type="text/css" />
<link rel="stylesheet" href="./templates/styles_blog_album.css" title="stylesheet" type="text/css" />

<?php echo '
<script type="text/javascript">

  var base_path = \''; 
 echo ((is_array($_tmp=$this->_tpl_vars['url']->url_base)) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); 
 echo '\';
  var user_path = \''; 
 echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['url']->url_userdir($this->_tpl_vars['user']->user_info['user_id']))) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')))) ? $this->_run_mod_handler('replace', true, $_tmp, "./", "") : smarty_modifier_replace($_tmp, "./", "")); 
 echo '\';
  
  // Not working at all
  //user_path.replace(/^\\.\\//, \'\');
  
  
  function album_show(album_id)
  {
    var currentElement = $(\'seBlogAlbum_album_\' + album_id);
    var currentMode = ( currentElement.style.display=="none" ? \'block\' : \'none\' );
    
    $$(\'.seBlogAlbum_album\').each(function(eachElement)
    {
      if( eachElement.id==currentElement.id )
        eachElement.style.display = currentMode;
      else
        eachElement.style.display = \'none\';
    });
  }
  
  function show_image(media_id)
  {
    var currentElement = $(\'seBlogAlbum_albumMedia_image_\' + media_id);
    var currentMode = ( currentElement.style.display=="none" ? \'block\' : \'none\' );
    
    $$(\'.seBlogAlbum_albumMedia_image\').each(function(eachElement)
    {
      if( eachElement.id==currentElement.id )
        eachElement.style.display = currentMode;
      else
        eachElement.style.display = \'none\';
    });
  }
  
  function add_image(file)
  {
    window.parent.OnDialogTabChange(\'divInfo\');
    window.parent.sActualBrowser = \'\' ;
    window.parent.SetUrl( base_path + user_path + file ) ;
  }

</script>
'; ?>


</head>
<body style="background: transparent;">

<div class="seBlogAlbum">


  <?php ob_start(); 
 echo $this->_tpl_vars['url']->url_base; 
 echo $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['user']->user_info['user_id']); 
 $this->_smarty_vars['capture']['user_dir'] = ob_get_contents(); ob_end_clean(); ?>


    <?php if (empty ( $this->_tpl_vars['album_id'] )): ?>

    <div class="seBlogAlbumHeadline"><a href="user_blog_album_browse.php">My Albums</a></div>
    <br />
    
    <table>
    <?php unset($this->_sections['album_loop']);
$this->_sections['album_loop']['name'] = 'album_loop';
$this->_sections['album_loop']['loop'] = is_array($_loop=$this->_tpl_vars['albums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['album_loop']['show'] = true;
$this->_sections['album_loop']['max'] = $this->_sections['album_loop']['loop'];
$this->_sections['album_loop']['step'] = 1;
$this->_sections['album_loop']['start'] = $this->_sections['album_loop']['step'] > 0 ? 0 : $this->_sections['album_loop']['loop']-1;
if ($this->_sections['album_loop']['show']) {
    $this->_sections['album_loop']['total'] = $this->_sections['album_loop']['loop'];
    if ($this->_sections['album_loop']['total'] == 0)
        $this->_sections['album_loop']['show'] = false;
} else
    $this->_sections['album_loop']['total'] = 0;
if ($this->_sections['album_loop']['show']):

            for ($this->_sections['album_loop']['index'] = $this->_sections['album_loop']['start'], $this->_sections['album_loop']['iteration'] = 1;
                 $this->_sections['album_loop']['iteration'] <= $this->_sections['album_loop']['total'];
                 $this->_sections['album_loop']['index'] += $this->_sections['album_loop']['step'], $this->_sections['album_loop']['iteration']++):
$this->_sections['album_loop']['rownum'] = $this->_sections['album_loop']['iteration'];
$this->_sections['album_loop']['index_prev'] = $this->_sections['album_loop']['index'] - $this->_sections['album_loop']['step'];
$this->_sections['album_loop']['index_next'] = $this->_sections['album_loop']['index'] + $this->_sections['album_loop']['step'];
$this->_sections['album_loop']['first']      = ($this->_sections['album_loop']['iteration'] == 1);
$this->_sections['album_loop']['last']       = ($this->_sections['album_loop']['iteration'] == $this->_sections['album_loop']['total']);
?>
    
            <?php if ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_id'] == 0): ?>
        <?php $this->assign('album_cover_src', './images/icons/folder_big.gif'); ?>
      <?php else: ?>
                <?php if ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'jpeg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'jpg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'gif' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'png' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'bmp'): ?>
          <?php $this->assign('album_cover_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['user']->user_info['user_id'])); ?>
          <?php $this->assign('album_cover_src', ($this->_tpl_vars['album_cover_dir']).($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_id'])."_thumb.jpg"); ?>
                <?php elseif ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mp3' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mp4' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'wav'): ?>
          <?php $this->assign('album_cover_src', './images/icons/album_audio_big.gif'); ?>
                <?php elseif ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpeg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpg' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mpa' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'avi' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'swf' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'mov' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'ram' || $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_cover_ext'] == 'rm'): ?>
          <?php $this->assign('album_cover_src', './images/icons/album_video_big.gif'); ?>
                <?php else: ?>
          <?php $this->assign('album_cover_src', './images/icons/album_file_big.gif'); ?>
        <?php endif; ?>
      <?php endif; ?>

            <?php if ($this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_title'] != ""): ?>
        <?php $this->assign('album_title', ((is_array($_tmp=$this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true))); ?>
      <?php else: ?>
        <?php $this->assign('album_title', $this->_tpl_vars['user_album11']); ?>
      <?php endif; ?>
      
      
      <tr>
        <td>
          <a href="user_blog_album_browse.php?album_id=<?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']; ?>
">
            <img src='<?php echo $this->_tpl_vars['album_cover_src']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['album_cover_src'],'75','75','w'); ?>
'>
          </a>
        </td>
        <td style="vertical-align: top; padding-top: 2px; padding-left: 5px;">
          <a href="user_blog_album_browse.php?album_id=<?php echo $this->_tpl_vars['albums'][$this->_sections['album_loop']['index']]['album_id']; ?>
" valign="top" style="padding-top: 2px;">
            <?php echo $this->_tpl_vars['album_title']; ?>

          </a>
        </td>
      </tr>
      
    <?php endfor; endif; ?>
    </table>



    <?php elseif (! empty ( $this->_tpl_vars['album_id'] ) && $this->_tpl_vars['media_total'] > 0): ?>

    <div class="seBlogAlbumHeadline"><a href="user_blog_album_browse.php">My Albums</a> &gt;&gt;&gt; <?php echo $this->_tpl_vars['album_info']['album_title']; ?>
</div>
    <br />
    
    <table>
    <?php unset($this->_sections['media_loop']);
$this->_sections['media_loop']['name'] = 'media_loop';
$this->_sections['media_loop']['loop'] = is_array($_loop=$this->_tpl_vars['media']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['media_loop']['show'] = true;
$this->_sections['media_loop']['max'] = $this->_sections['media_loop']['loop'];
$this->_sections['media_loop']['step'] = 1;
$this->_sections['media_loop']['start'] = $this->_sections['media_loop']['step'] > 0 ? 0 : $this->_sections['media_loop']['loop']-1;
if ($this->_sections['media_loop']['show']) {
    $this->_sections['media_loop']['total'] = $this->_sections['media_loop']['loop'];
    if ($this->_sections['media_loop']['total'] == 0)
        $this->_sections['media_loop']['show'] = false;
} else
    $this->_sections['media_loop']['total'] = 0;
if ($this->_sections['media_loop']['show']):

            for ($this->_sections['media_loop']['index'] = $this->_sections['media_loop']['start'], $this->_sections['media_loop']['iteration'] = 1;
                 $this->_sections['media_loop']['iteration'] <= $this->_sections['media_loop']['total'];
                 $this->_sections['media_loop']['index'] += $this->_sections['media_loop']['step'], $this->_sections['media_loop']['iteration']++):
$this->_sections['media_loop']['rownum'] = $this->_sections['media_loop']['iteration'];
$this->_sections['media_loop']['index_prev'] = $this->_sections['media_loop']['index'] - $this->_sections['media_loop']['step'];
$this->_sections['media_loop']['index_next'] = $this->_sections['media_loop']['index'] + $this->_sections['media_loop']['step'];
$this->_sections['media_loop']['first']      = ($this->_sections['media_loop']['iteration'] == 1);
$this->_sections['media_loop']['last']       = ($this->_sections['media_loop']['iteration'] == $this->_sections['media_loop']['total']);
?>
      
            <?php if ($this->_tpl_vars['media'][$this->_sections['media_loop']['index']]['media_ext'] == 'jpeg' || $this->_tpl_vars['media'][$this->_sections['media_loop']['index']]['media_ext'] == 'jpg' || $this->_tpl_vars['media'][$this->_sections['media_loop']['index']]['media_ext'] == 'gif' || $this->_tpl_vars['media'][$this->_sections['media_loop']['index']]['media_ext'] == 'png' || $this->_tpl_vars['media'][$this->_sections['media_loop']['index']]['media_ext'] == 'bmp'): ?>
        <?php $this->assign('file_dir', $this->_tpl_vars['url']->url_userdir($this->_tpl_vars['user']->user_info['user_id'])); ?>
        <?php $this->assign('file_thumb_src', ($this->_tpl_vars['file_dir']).($this->_tpl_vars['media'][$this->_sections['media_loop']['index']]['media_id'])."_thumb.jpg"); ?>
        <?php $this->assign('file_name_full', ($this->_tpl_vars['media'][$this->_sections['media_loop']['index']]['media_id']).".jpg"); ?>
        
        <tr>
          <td>
            <a href="javascript:void(0);" onclick="add_image('<?php echo ((is_array($_tmp=$this->_tpl_vars['file_name_full'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
');">
              <img src='<?php echo $this->_tpl_vars['file_thumb_src']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['file_thumb_src'],'75','75','w'); ?>
'>
            </a>
          </td>
          <td>
            <a href="javascript:void(0);" onclick="add_image('<?php echo ((is_array($_tmp=$this->_tpl_vars['file_name_full'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')); ?>
');" valign="top" style="padding-top: 2px;">
              <?php echo $this->_tpl_vars['files'][$this->_sections['files_loop']['index']]['media_title']; ?>

            </a>
          </td>
        </tr>
      <?php endif; ?>
      
    <?php endfor; endif; ?>
    </table>

  <?php else: ?>

    No media

  <?php endif; ?>

</div>

</body>
</html>