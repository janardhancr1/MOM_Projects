<?php /* Smarty version 2.6.14, created on 2010-06-02 16:45:39
         compiled from profile_music.tpl */
?><?php
SELanguage::_preload_multi(4000041);
SELanguage::load();
?>

<?php if ($this->_tpl_vars['music_allow']): ?>

  <table cellpadding='0' cellspacing='0' width='100%' style='margin-bottom: 10px;'>
    <tr>
      <td class='header'><?php echo sprintf(SELanguage::_get(4000041), $this->_tpl_vars['owner']->user_displayname); ?></td>
    </tr>
    <tr>
      <td class='profile'>
        <object width='<?php echo $this->_tpl_vars['skin_width']; ?>
' height='<?php echo $this->_tpl_vars['skin_height']; ?>
' id='main' align='middle'>
          <param name='movie' value='images/music_xspf_jukebox.swf?skin_url=include/music_skins/<?php echo $this->_tpl_vars['skin_title']; ?>
/&autoplay=<?php if (! $this->_tpl_vars['autoplay']): ?>false<?php else: ?>true<?php endif; ?>&playlist_url=music_ajax.php?user_id=<?php echo $this->_tpl_vars['owner']->user_info['user_id']; ?>
&alphabetize=false&autoload=true&autoresume=false&findImage=true&timedisplay=1&loaded=1' />
          <param name='wmode' value='transparent' />
          <embed src='images/music_xspf_jukebox.swf?skin_url=include/music_skins/<?php echo $this->_tpl_vars['skin_title']; ?>
/&autoplay=<?php if (! $this->_tpl_vars['autoplay']): ?>false<?php else: ?>true<?php endif; ?>&playlist_url=music_ajax.php?user_id=<?php echo $this->_tpl_vars['owner']->user_info['user_id']; ?>
&alphabetize=false&autoload=true&autoresume=false&findImage=true&timedisplay=1&loaded=1' wmode='transparent' width='<?php echo $this->_tpl_vars['skin_width']; ?>
' height='<?php echo $this->_tpl_vars['skin_height']; ?>
' name='main' align='middle' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer' />
        </object>
      </td>
    </tr>
  </table>
  
<?php endif; ?>