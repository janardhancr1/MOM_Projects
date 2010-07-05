<?php /* Smarty version 2.6.14, created on 2010-05-26 14:28:54
         compiled from user_group_subscribe.tpl */
?><?php
SELanguage::_preload_multi(2000236,2000237,39,2000234,2000235);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header_global.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 
 if ($this->_tpl_vars['result'] != 0): ?>

    <?php echo '
  <script type="text/javascript">
  <!-- 
  setTimeout("window.parent.TB_remove();", "1000");
  if(window.parent.subscribe_update) { setTimeout("window.parent.subscribe_update(\''; 
 echo $this->_tpl_vars['is_subscribed']; 
 echo '\');", "800"); }
  //-->
  </script>
  '; ?>


  <br><div><?php echo SELanguage::_get($this->_tpl_vars['result']); ?></div>


<?php elseif ($this->_tpl_vars['is_subscribed']): ?>

  <div style='text-align:left; padding-left: 10px; padding-top: 10px;'>
    <?php echo SELanguage::_get(2000236); ?>

    <br>

    <table cellpadding='0' cellspacing='0'>
    <tr><td colspan='2'>&nbsp;</td></tr>
    <tr>
    <td colspan='2'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td>
      <form action='user_group_subscribe.php' method='POST'>
      <input type='submit' class='button' value='<?php echo SELanguage::_get(2000237); ?>'>&nbsp;
      <input type='hidden' name='task' value='unsubscribe_do'>
      <input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'>
      </form>
      </td>
      <td>
      <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='window.parent.TB_remove();'>
      </td>
      </tr>
      </table>
    </td>
    </tr>
    </table>
  </div>


<?php elseif (! $this->_tpl_vars['is_subscribed']): ?>


  <div style='text-align:left; padding-left: 10px; padding-top: 10px;'>
    <?php echo SELanguage::_get(2000234); ?>

    <br>

    <table cellpadding='0' cellspacing='0'>
    <tr><td colspan='2'>&nbsp;</td></tr>
    <tr>
    <td colspan='2'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td>
      <form action='user_group_subscribe.php' method='POST'>
      <input type='submit' class='button' value='<?php echo SELanguage::_get(2000235); ?>'>&nbsp;
      <input type='hidden' name='task' value='subscribe_do'>
      <input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'>
      </form>
      </td>
      <td>
      <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='window.parent.TB_remove();'>
      </td>
      </tr>
      </table>
    </td>
    </tr>
    </table>
  </div>


<?php endif; ?>







</body>
</html>