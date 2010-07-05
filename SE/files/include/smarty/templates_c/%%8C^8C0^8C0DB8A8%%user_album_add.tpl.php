<?php /* Smarty version 2.6.14, created on 2010-06-02 17:09:56
         compiled from user_album_add.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'user_album_add.tpl', 68, false),)), $this);
?><?php
SELanguage::_preload_multi(1000059,1000074,1000097,1000075,1000076,1000077,1000078,1000079,1000080,1000081,1000082,1000083,1000136,1000084,39);
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

  <img src='./images/icons/album_image48.gif' border='0' class='icon_big'>
  <div class='page_header'><?php echo SELanguage::_get(1000059); ?></div>
  <div><?php echo SELanguage::_get(1000074); ?></div>

</td>
<td valign='top' align='right'>

  <table cellpadding='0' cellspacing='0' width='150'>
  <tr><td class='button' nowrap='nowrap'><a href='user_album.php'><img src='./images/icons/back16.gif' border='0' class='button'><?php echo SELanguage::_get(1000097); ?></a></td></tr>
  </table>

</td>
</tr>
</table>

<br>

<?php if ($this->_tpl_vars['is_error'] != 0): ?>
  <div class='error'><img src='./images/error.gif' class='icon' border='0'> <?php echo SELanguage::_get($this->_tpl_vars['is_error']); ?></div><br>
<?php endif; 
 if ($this->_tpl_vars['total_albums'] >= $this->_tpl_vars['user']->level_info['level_album_maxnum']): ?>
  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td class='result'>
    <img src='./images/error.gif' class='icon' border='0'> <?php echo sprintf(SELanguage::_get(1000075), $this->_tpl_vars['user']->level_info['level_album_maxnum']); ?>
  </td></tr></table>
  <br>
  <form action='user_album.php' method='get'>
  <input type='submit' class='button' value='<?php echo SELanguage::_get(1000076); ?>'>
  </form>

<?php else: ?>

  <form action='user_album_add.php' method='POST'>
  <b><?php echo SELanguage::_get(1000077); ?></b><br>
  <input name='album_title' type='text' class='text' maxlength='50' size='30' value='<?php echo $this->_tpl_vars['album_title']; ?>
'>

  <br><br>

  <b><?php echo SELanguage::_get(1000078); ?></b><br>
  <textarea name='album_desc' rows='6' cols='50'><?php echo $this->_tpl_vars['album_desc']; ?>
</textarea>

  <br>

    <?php if ($this->_tpl_vars['user']->level_info['level_album_search'] == 1): ?>
    <br>
    <b><?php echo SELanguage::_get(1000079); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
      <tr><td><input type='radio' name='album_search' id='album_search_1' value='1'<?php if ($this->_tpl_vars['album_search'] == 1): ?> checked='checked'<?php endif; ?>></td><td><label for='album_search_1'><?php echo SELanguage::_get(1000080); ?></label></td></tr>
      <tr><td><input type='radio' name='album_search' id='album_search_0' value='0'<?php if ($this->_tpl_vars['album_search'] == 0): ?> checked='checked'<?php endif; ?>></td><td><label for='album_search_0'><?php echo SELanguage::_get(1000081); ?></label></td></tr>
    </table>
  <?php endif; ?>

    <?php if (count($this->_tpl_vars['privacy_options']) > 1): ?>
    <br>
    <b><?php echo SELanguage::_get(1000082); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
    <?php $_from = $this->_tpl_vars['privacy_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['privacy_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['privacy_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['privacy_loop']['iteration']++;
?>
      <tr>
      <td><input type='radio' name='album_privacy' id='privacy_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['album_privacy'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
      <td><label for='privacy_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php endif; ?>

    <?php if (count($this->_tpl_vars['comment_options']) > 1): ?>
    <br>
    <b><?php echo SELanguage::_get(1000083); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
    <?php $_from = $this->_tpl_vars['comment_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['comment_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['comment_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['comment_loop']['iteration']++;
?>
      <tr>
      <td><input type='radio' name='album_comments' id='comments_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['album_comments'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
      <td><label for='comments_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php endif; ?>

    <?php if (count($this->_tpl_vars['tag_options']) > 1): ?>
    <br>
    <b><?php echo SELanguage::_get(1000136); ?></b><br>
    <table cellpadding='0' cellspacing='0'>
    <?php $_from = $this->_tpl_vars['tag_options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tag_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tag_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['tag_loop']['iteration']++;
?>
      <tr>
      <td><input type='radio' name='album_tag' id='tag_<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['k']; ?>
'<?php if ($this->_tpl_vars['album_tag'] == $this->_tpl_vars['k']): ?> checked='checked'<?php endif; ?>></td>
      <td><label for='tag_<?php echo $this->_tpl_vars['k']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['v']); ?></label></td>
      </tr>
    <?php endforeach; endif; unset($_from); ?>
    </table>
  <?php endif; ?>

  <br>
  <table cellpadding='0' cellspacing='0'>
  <tr>
  <td>
    <input type='submit' class='button' value='<?php echo SELanguage::_get(1000084); ?>'>&nbsp;
    <input type='hidden' name='task' value='doadd'>
    </form>
  </td>
  <td>
    <form action='user_album.php' method='GET'>
    <input type='submit' class='button' value='<?php echo SELanguage::_get(39); ?>'>
    </form>
  </td>
  </tr>
  </table>
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