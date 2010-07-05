<?php /* Smarty version 2.6.14, created on 2010-05-30 16:45:11
         compiled from profile_recipe.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'profile_recipe.tpl', 23, false),array('modifier', 'choptext', 'profile_recipe.tpl', 23, false),)), $this);
?><?php
SELanguage::_preload_multi(7000005,1021,589);
SELanguage::load();
?>

<?php if ($this->_tpl_vars['owner']->level_info['level_recipe_allow'] != 0 && $this->_tpl_vars['total_recipes'] > 0): ?>

  <table cellpadding='0' cellspacing='0' width='100%' style='margin-bottom: 10px;'>
    <tr>
      <td class='header'>
        <?php echo SELanguage::_get(7000005); ?> (<?php echo $this->_tpl_vars['total_recipes']; ?>
)
                <?php if ($this->_tpl_vars['total_recipes'] > 5): ?>&nbsp;[ <a href='<?php echo $this->_tpl_vars['url']->url_create('recipes',$this->_tpl_vars['owner']->user_info['user_username']); ?>
'><?php echo SELanguage::_get(1021); ?></a> ]<?php endif; ?>
      </td>
    </tr>
    <tr>
      <td class='profile'>
                <?php unset($this->_sections['recipe_loop']);
$this->_sections['recipe_loop']['name'] = 'recipe_loop';
$this->_sections['recipe_loop']['loop'] = is_array($_loop=$this->_tpl_vars['recipes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['recipe_loop']['show'] = true;
$this->_sections['recipe_loop']['max'] = $this->_sections['recipe_loop']['loop'];
$this->_sections['recipe_loop']['step'] = 1;
$this->_sections['recipe_loop']['start'] = $this->_sections['recipe_loop']['step'] > 0 ? 0 : $this->_sections['recipe_loop']['loop']-1;
if ($this->_sections['recipe_loop']['show']) {
    $this->_sections['recipe_loop']['total'] = $this->_sections['recipe_loop']['loop'];
    if ($this->_sections['recipe_loop']['total'] == 0)
        $this->_sections['recipe_loop']['show'] = false;
} else
    $this->_sections['recipe_loop']['total'] = 0;
if ($this->_sections['recipe_loop']['show']):

            for ($this->_sections['recipe_loop']['index'] = $this->_sections['recipe_loop']['start'], $this->_sections['recipe_loop']['iteration'] = 1;
                 $this->_sections['recipe_loop']['iteration'] <= $this->_sections['recipe_loop']['total'];
                 $this->_sections['recipe_loop']['index'] += $this->_sections['recipe_loop']['step'], $this->_sections['recipe_loop']['iteration']++):
$this->_sections['recipe_loop']['rownum'] = $this->_sections['recipe_loop']['iteration'];
$this->_sections['recipe_loop']['index_prev'] = $this->_sections['recipe_loop']['index'] - $this->_sections['recipe_loop']['step'];
$this->_sections['recipe_loop']['index_next'] = $this->_sections['recipe_loop']['index'] + $this->_sections['recipe_loop']['step'];
$this->_sections['recipe_loop']['first']      = ($this->_sections['recipe_loop']['iteration'] == 1);
$this->_sections['recipe_loop']['last']       = ($this->_sections['recipe_loop']['iteration'] == $this->_sections['recipe_loop']['total']);
?>
        <table cellpadding='0' cellspacing='0' width='100%'>
          <tr>
            <td valign='top' width='1'><img src='./images/icons/recipe_recipe16.png' border='0' class='icon'></td>
            <td valign='top'>
              <div><a href='<?php echo $this->_tpl_vars['url']->url_create('recipe',$this->_tpl_vars['owner']->user_info['user_username'],$this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_id']); ?>
'><?php if ($this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_name'] == ""): 
 echo SELanguage::_get(589); 
 else: 
 echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)))) ? $this->_run_mod_handler('choptext', true, $_tmp, 20, "<br>") : smarty_modifier_choptext($_tmp, 20, "<br>")); 
 endif; ?></a></div>
              <div style='color: #888888;'><?php echo $this->_tpl_vars['recipes'][$this->_sections['recipe_loop']['index']]['recipe_views']; ?>
 Views</div>
            </td>
          </tr>
        </table>
          <?php if ($this->_sections['recipe_loop']['last'] != true): ?><div style='font-size: 1pt; margin-top: 2px; margin-bottom: 2px;'>&nbsp;</div><?php endif; ?>
        <?php endfor; endif; ?>
      </td>
    </tr>
  </table>

<?php endif; ?>