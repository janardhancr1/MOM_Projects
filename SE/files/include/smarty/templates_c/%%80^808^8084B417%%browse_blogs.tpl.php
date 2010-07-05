<?php /* Smarty version 2.6.14, created on 2010-06-04 02:17:12
         compiled from browse_blogs.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'browse_blogs.tpl', 10, false),array('modifier', 'truncate', 'browse_blogs.tpl', 44, false),array('modifier', 'strip_tags', 'browse_blogs.tpl', 122, false),array('function', 'math', 'browse_blogs.tpl', 71, false),array('function', 'cycle', 'browse_blogs.tpl', 129, false),)), $this);
?><?php
SELanguage::_preload_multi(1500007,643,646,1500032,1500116,1500117,1500034,1500035,1500033,1500036,1500037,1500038,182,184,185,183,1500039,1500041,1500042);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'><img src='./images/icons/blog_blog48.gif' border='0' class='icon_big'><?php echo SELanguage::_get(1500007); ?>
<div class="page_header_small">Share your thoughts every day with moms</div>
</div>

<form method="get" name="seBrowseBlogs" action="browse_blogs.php">
<input type="hidden" name="p" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['p'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
" />

<div style='padding: 7px 10px 7px 10px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 10px 0px 10px 0px; font-weight: bold;'>
  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td style='padding-right: 3px;'>
        <?php echo SELanguage::_get(643); ?> &nbsp;
        <input type="text" name="blog_search" value="<?php echo $this->_tpl_vars['blog_search']; ?>
" class="text" onblur="document.seBrowseBlogs.submit();"style="width:120px;" />
        &nbsp;
        <input type='submit' class='button' value='<?php echo SELanguage::_get(646); ?>' />
      </td>
      <td> &nbsp; </td>
      <td>
      	<div class='mom_div_small'><a href='user_blog.php' class='mom_div_small'><img src='./images/icons/plus16.gif' border='0' class='button'>Go to My Blog Page</a></div>
      </td>
    </tr>
    <tr>
    	<td colspan='3'>&nbsp;</td>
    </tr>
    <tr>
      <td style='padding-left: 10px; padding-right: 3px;'>
        <?php echo SELanguage::_get(1500032); ?>
        <select class='small' name='v' onchange="document.seBrowseBlogs.submit();">
        <option value='0'<?php if ($this->_tpl_vars['v'] == '0'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1500116); ?></option>
        <?php if ($this->_tpl_vars['user']->user_exists): ?><option value='1'<?php if ($this->_tpl_vars['v'] == '1'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1500117); ?></option><?php endif; ?>
        </select>
      </td>
      
      <td style='padding-left: 10px; padding-right: 3px;'>
        <?php echo SELanguage::_get(1500034); ?>
        <select class='small' name='c' onchange="document.seBrowseBlogs.submit();">
          <option value='-1'> </option>
          <?php unset($this->_sections['blogentrycat_loop']);
$this->_sections['blogentrycat_loop']['name'] = 'blogentrycat_loop';
$this->_sections['blogentrycat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['blogentrycats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['blogentrycat_loop']['show'] = true;
$this->_sections['blogentrycat_loop']['max'] = $this->_sections['blogentrycat_loop']['loop'];
$this->_sections['blogentrycat_loop']['step'] = 1;
$this->_sections['blogentrycat_loop']['start'] = $this->_sections['blogentrycat_loop']['step'] > 0 ? 0 : $this->_sections['blogentrycat_loop']['loop']-1;
if ($this->_sections['blogentrycat_loop']['show']) {
    $this->_sections['blogentrycat_loop']['total'] = $this->_sections['blogentrycat_loop']['loop'];
    if ($this->_sections['blogentrycat_loop']['total'] == 0)
        $this->_sections['blogentrycat_loop']['show'] = false;
} else
    $this->_sections['blogentrycat_loop']['total'] = 0;
if ($this->_sections['blogentrycat_loop']['show']):

            for ($this->_sections['blogentrycat_loop']['index'] = $this->_sections['blogentrycat_loop']['start'], $this->_sections['blogentrycat_loop']['iteration'] = 1;
                 $this->_sections['blogentrycat_loop']['iteration'] <= $this->_sections['blogentrycat_loop']['total'];
                 $this->_sections['blogentrycat_loop']['index'] += $this->_sections['blogentrycat_loop']['step'], $this->_sections['blogentrycat_loop']['iteration']++):
$this->_sections['blogentrycat_loop']['rownum'] = $this->_sections['blogentrycat_loop']['iteration'];
$this->_sections['blogentrycat_loop']['index_prev'] = $this->_sections['blogentrycat_loop']['index'] - $this->_sections['blogentrycat_loop']['step'];
$this->_sections['blogentrycat_loop']['index_next'] = $this->_sections['blogentrycat_loop']['index'] + $this->_sections['blogentrycat_loop']['step'];
$this->_sections['blogentrycat_loop']['first']      = ($this->_sections['blogentrycat_loop']['iteration'] == 1);
$this->_sections['blogentrycat_loop']['last']       = ($this->_sections['blogentrycat_loop']['iteration'] == $this->_sections['blogentrycat_loop']['total']);
?>
          <option value='<?php echo $this->_tpl_vars['blogentrycats'][$this->_sections['blogentrycat_loop']['index']]['blogentrycat_id']; ?>
'<?php if ($this->_tpl_vars['c'] == $this->_tpl_vars['blogentrycats'][$this->_sections['blogentrycat_loop']['index']]['blogentrycat_id']): ?> SELECTED<?php endif; ?>>
            <?php echo ((is_array($_tmp=$this->_tpl_vars['blogentrycats'][$this->_sections['blogentrycat_loop']['index']]['blogentrycat_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 24) : smarty_modifier_truncate($_tmp, 24)); ?>

          </option>
          <?php endfor; endif; ?>
          <option value='0'<?php if (isset ( $this->_tpl_vars['c'] ) && $this->_tpl_vars['c'] == 0): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1500035); ?></option>
        </select>
      </td>
      
      <td style='padding-left: 10px; padding-right: 3px;'>
        <?php echo SELanguage::_get(1500033); ?>
        <select class='small' name='s' onchange="document.seBrowseBlogs.submit();">
        <option value='blogentry_date DESC'<?php if ($this->_tpl_vars['s'] == 'blogentry_date DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1500036); ?></option>
        <option value='blogentry_views DESC'<?php if ($this->_tpl_vars['s'] == 'blogentry_views DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1500037); ?></option>
        <option value='blogentry_totalcomments DESC'<?php if ($this->_tpl_vars['s'] == 'blogentry_totalcomments DESC'): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get(1500038); ?></option>
        </select>
      </td>
      
    </tr>
  </table>
</div>

</form>


<?php if ($this->_tpl_vars['maxpage'] > 1): ?>
  <div style='text-align: center; padding-bottom: 10px;'>
    <?php if ($this->_tpl_vars['p'] != 1): ?>
      <a href='javascript:void(0);' onclick='document.seBrowseBlogs.p.value=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seBrowseBlogs.submit();'>&#171; <?php echo SELanguage::_get(182); ?></a>
    <?php else: ?>
      &#171; <?php echo SELanguage::_get(182); ?>
    <?php endif; ?>
    &nbsp;|&nbsp;&nbsp;
    <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
      <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_blogentries']); ?></b>
    <?php else: ?>
      <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_blogentries']); ?></b>
    <?php endif; ?>
    &nbsp;&nbsp;|&nbsp;
    <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
      <a href='javascript:void(0);' onclick='document.seBrowseBlogs.p.value=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seBrowseBlogs.submit();'><?php echo SELanguage::_get(183); ?> &#187;</a>
    <?php endif; ?>
  </div>
<?php endif; ?>



<div>

  <?php unset($this->_sections['blogentry_loop']);
$this->_sections['blogentry_loop']['name'] = 'blogentry_loop';
$this->_sections['blogentry_loop']['loop'] = is_array($_loop=$this->_tpl_vars['blogentries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['blogentry_loop']['show'] = true;
$this->_sections['blogentry_loop']['max'] = $this->_sections['blogentry_loop']['loop'];
$this->_sections['blogentry_loop']['step'] = 1;
$this->_sections['blogentry_loop']['start'] = $this->_sections['blogentry_loop']['step'] > 0 ? 0 : $this->_sections['blogentry_loop']['loop']-1;
if ($this->_sections['blogentry_loop']['show']) {
    $this->_sections['blogentry_loop']['total'] = $this->_sections['blogentry_loop']['loop'];
    if ($this->_sections['blogentry_loop']['total'] == 0)
        $this->_sections['blogentry_loop']['show'] = false;
} else
    $this->_sections['blogentry_loop']['total'] = 0;
if ($this->_sections['blogentry_loop']['show']):

            for ($this->_sections['blogentry_loop']['index'] = $this->_sections['blogentry_loop']['start'], $this->_sections['blogentry_loop']['iteration'] = 1;
                 $this->_sections['blogentry_loop']['iteration'] <= $this->_sections['blogentry_loop']['total'];
                 $this->_sections['blogentry_loop']['index'] += $this->_sections['blogentry_loop']['step'], $this->_sections['blogentry_loop']['iteration']++):
$this->_sections['blogentry_loop']['rownum'] = $this->_sections['blogentry_loop']['iteration'];
$this->_sections['blogentry_loop']['index_prev'] = $this->_sections['blogentry_loop']['index'] - $this->_sections['blogentry_loop']['step'];
$this->_sections['blogentry_loop']['index_next'] = $this->_sections['blogentry_loop']['index'] + $this->_sections['blogentry_loop']['step'];
$this->_sections['blogentry_loop']['first']      = ($this->_sections['blogentry_loop']['iteration'] == 1);
$this->_sections['blogentry_loop']['last']       = ($this->_sections['blogentry_loop']['iteration'] == $this->_sections['blogentry_loop']['total']);
?>
    
    <div class='blogs_browse_item blogs_browse_item_left blogs_browse2' style='width: 500px; height:115px; float: left;'>
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td style='vertical-align: top; padding: 10px;'>
            <div style='font-weight: bold; font-size: 13px;'>
              <img src="./images/icons/blog_blog16.gif" class='button' style='float: left;'>
              <a href='<?php echo $this->_tpl_vars['url']->url_create('blog_entry',$this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_author']->user_info['user_username'],$this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_id']); ?>
'>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, "...", true) : smarty_modifier_truncate($_tmp, 30, "...", true)); ?>

              </a>
            </div>
            <div class='blogs_browse_date'>
              <?php $this->assign('blogentry_date', $this->_tpl_vars['datetime']->time_since($this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_date'])); 
 ob_start(); 
 echo sprintf(SELanguage::_get($this->_tpl_vars['blogentry_date'][0]), $this->_tpl_vars['blogentry_date'][1]); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('created', ob_get_contents());ob_end_clean(); ?>
              <?php echo sprintf(SELanguage::_get(1500039), $this->_tpl_vars['created'], $this->_tpl_vars['url']->url_create('profile',$this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_author']->user_info['user_username']), $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_author']->user_displayname); ?>
            </div>
            <?php if (! empty ( $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentrycat_languagevar_id'] ) || ! empty ( $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentrycat_title'] )): ?>
            <div class='blogs_browse_date'>
              <?php if (! empty ( $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentrycat_languagevar_id'] )): 
 ob_start(); 
 echo SELanguage::_get($this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentrycat_languagevar_id']); 
 $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('blogentrycat_title', ob_get_contents());ob_end_clean(); 
 else: 
 $this->assign('blogentrycat_title', $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentrycat_title']); 
 endif; ?>
              Category:
              <?php if (! $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentrycat_user_id']): ?><a href='browse_blogs.php?c=<?php echo $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_blogentrycat_id']; ?>
'><?php endif; ?>
                <?php echo ((is_array($_tmp=$this->_tpl_vars['blogentrycat_title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 48) : smarty_modifier_truncate($_tmp, 48)); ?>

              <?php if (! $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentrycat_user_id']): ?></a><?php endif; ?>
            </div>
            <?php endif; ?>
            <div style='margin-top: 5px;'>
              <?php echo sprintf(SELanguage::_get(1500041), $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_views']); ?>,
              <?php echo sprintf(SELanguage::_get(1500042), $this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_totalcomments']); ?>
            </div>
            <div style='margin-top: 8px; font-size: 9px;'>
              <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['blogentries'][$this->_sections['blogentry_loop']['index']]['blogentry_body'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 140, "...", true) : smarty_modifier_truncate($_tmp, 140, "...", true)); ?>

            </div>
          </td>
        </tr>
      </table>
    </div>
    
    <?php echo smarty_function_cycle(array('name' => 'blogret','values' => "<div style='clear: both; height: 10px;'></div>"), $this);?>

  <?php endfor; endif; ?>
  
  <div style='clear: both;'></div>
  
</div>
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