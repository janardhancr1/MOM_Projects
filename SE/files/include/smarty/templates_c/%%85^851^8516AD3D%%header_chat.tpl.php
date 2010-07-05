<?php /* Smarty version 2.6.14, created on 2010-05-26 07:16:05
         compiled from header_chat.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'array', 'header_chat.tpl', 16, false),)), $this);
?><?php
SELanguage::_preload_multi(3500025);
SELanguage::load();
?>

<?php if (! $this->_tpl_vars['global_smoothbox'] && $this->_tpl_vars['user']->user_exists): ?>

  <?php echo '
  <script type="text/javascript">
    var use_seIM = '; 
 if ($this->_tpl_vars['user']->level_info['level_im_allow'] && $this->_tpl_vars['user']->level_info['level_im_allow']): ?>1<?php else: ?>0<?php endif; 
 echo ';
    var use_seChat = '; 
 if ($this->_tpl_vars['global_page'] == 'chat' && $this->_tpl_vars['setting']['setting_chat_allow'] && $this->_tpl_vars['user']->level_info['level_chat_allow']): ?>1<?php else: ?>0<?php endif; 
 echo ';
  </script>
  '; ?>

  
    <?php if ($this->_tpl_vars['setting']['setting_chat_enabled']): ?>
    <?php ob_start(); 
 echo SELanguage::_get(3500025); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('chat_menu_title', ob_get_contents());ob_end_clean(); ?>
    <?php echo smarty_function_array(array('var' => 'chat_menu','value' => "chat.php"), $this);?>

    <?php echo smarty_function_array(array('var' => 'chat_menu','value' => "chat_chat16.gif"), $this);?>

    <?php echo smarty_function_array(array('var' => 'chat_menu','value' => $this->_tpl_vars['chat_menu_title']), $this);?>

    <?php echo smarty_function_array(array('var' => 'global_plugin_menu','value' => $this->_tpl_vars['chat_menu']), $this);?>
 
  <?php endif; ?>
  
    <?php if ($this->_tpl_vars['user']->level_info['level_im_allow']): ?>
    <link rel="stylesheet" href="./templates/styles_im.css" title="stylesheet" type="text/css" />
    <script type="text/javascript" src="./include/js/seIM/InstantMessengerUtilities.js"></script>
    <script type="text/javascript" src="./include/js/seIM/InstantMessengerConversations.js"></script>
    <script type="text/javascript" src="./include/js/seIM/InstantMessengerGUI.js"></script>
    <script type="text/javascript" src="./include/js/seIM/InstantMessengerCore.js"></script>
  <?php endif; ?>
  
<?php endif; ?>