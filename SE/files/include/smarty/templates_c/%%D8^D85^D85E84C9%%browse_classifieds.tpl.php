<?php /* Smarty version 2.6.14, created on 2010-06-03 04:18:58
         compiled from browse_classifieds.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'browse_classifieds.tpl', 54, false),array('modifier', 'in_array', 'browse_classifieds.tpl', 162, false),array('modifier', 'truncate', 'browse_classifieds.tpl', 250, false),array('function', 'math', 'browse_classifieds.tpl', 202, false),)), $this);
?><?php
SELanguage::_preload_multi(4500007,4500133,1089,1090,4500134,182,184,185,183,4500072,507,4500135,4500136);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'>
  <?php if (empty ( $this->_tpl_vars['classifiedcat'] )): ?>
    <?php echo SELanguage::_get(4500007); ?>
  <?php else: ?>
    <a href='browse_classifieds.php'><?php echo SELanguage::_get(4500007); ?></a> >
    <?php if (empty ( $this->_tpl_vars['classifiedsubcat'] )): ?>
      <?php echo SELanguage::_get($this->_tpl_vars['classifiedcat']['classifiedcat_title']); ?>
    <?php else: ?>
      <a href='browse_classifieds.php?v=<?php echo $this->_tpl_vars['v']; ?>
&s=<?php echo $this->_tpl_vars['s']; ?>
&classifiedcat_id=<?php echo $this->_tpl_vars['classifiedcat']['classifiedcat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['classifiedcat']['classifiedcat_title']); ?></a> >
      <?php echo SELanguage::_get($this->_tpl_vars['classifiedsubcat']['classifiedcat_title']); ?>
    <?php endif; ?>
  <?php endif; ?>
</div>



<table cellpadding='0' cellspacing='0' width='100%' style='margin-top: 10px;'>
<tr>
<td style='width: 200px; vertical-align: top;'>
 
    <?php echo '
  <script type="text/javascript">
  <!-- 

  // ADD ABILITY TO MINIMIZE/MAXIMIZE CATS
  var cat_minimized = new Hash.Cookie(\'cat_cookie\', {duration: 3600});
  var cat_list = new Hash();
  //-->
  </script>
  '; ?>

  
  
  <div style='margin-top: 10px; padding: 5px; background: #F2F2F2; border: 1px solid #BBBBBB; margin: 10px 0px 10px 0px; font-weight: bold;'>
    
    <div style='padding: 5px 8px 5px 8px; border: 1px solid #DDDDDD; background: #FFFFFF;'>
      <a href='browse_classifieds.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
'><?php echo SELanguage::_get(4500133); ?></a>
    </div>
    
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
      
            <script type="text/javascript">
        <!-- 
        cat_list.set(<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
, {});
        //-->
      </script>
      
      <div style='padding: 5px 8px 5px 5px; border: 1px solid #DDDDDD; border-top: none; background: #FFFFFF;'>
        <img id='icon_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
' src='./images/icons/<?php if (count($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats']) > 0 && $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'] != ""): ?>plus16<?php else: ?>minus16_disabled<?php endif; ?>.gif' <?php if (count($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats']) > 0 && $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'] != ""): ?>style='cursor: pointer;' onClick="if($('subcats_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
').style.display == 'none') <?php echo '{'; ?>
 $('subcats_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
').style.display = ''; this.src='./images/icons/minus16.gif'; cat_minimized.set(<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
, 1); <?php echo '} else {'; ?>
 $('subcats_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
').style.display = 'none'; this.src='./images/icons/plus16.gif'; cat_minimized.set(<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
, 0); <?php echo '}'; ?>
"<?php endif; ?> border='0' class='icon' /><a href='browse_classifieds.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&classifiedcat_id=<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_title']); ?></a>
        <div id='subcats_<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['cat_id']; ?>
' style='display: none;'>
          <?php unset($this->_sections['subcat_loop']);
$this->_sections['subcat_loop']['name'] = 'subcat_loop';
$this->_sections['subcat_loop']['loop'] = is_array($_loop=$this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['subcat_loop']['show'] = true;
$this->_sections['subcat_loop']['max'] = $this->_sections['subcat_loop']['loop'];
$this->_sections['subcat_loop']['step'] = 1;
$this->_sections['subcat_loop']['start'] = $this->_sections['subcat_loop']['step'] > 0 ? 0 : $this->_sections['subcat_loop']['loop']-1;
if ($this->_sections['subcat_loop']['show']) {
    $this->_sections['subcat_loop']['total'] = $this->_sections['subcat_loop']['loop'];
    if ($this->_sections['subcat_loop']['total'] == 0)
        $this->_sections['subcat_loop']['show'] = false;
} else
    $this->_sections['subcat_loop']['total'] = 0;
if ($this->_sections['subcat_loop']['show']):

            for ($this->_sections['subcat_loop']['index'] = $this->_sections['subcat_loop']['start'], $this->_sections['subcat_loop']['iteration'] = 1;
                 $this->_sections['subcat_loop']['iteration'] <= $this->_sections['subcat_loop']['total'];
                 $this->_sections['subcat_loop']['index'] += $this->_sections['subcat_loop']['step'], $this->_sections['subcat_loop']['iteration']++):
$this->_sections['subcat_loop']['rownum'] = $this->_sections['subcat_loop']['iteration'];
$this->_sections['subcat_loop']['index_prev'] = $this->_sections['subcat_loop']['index'] - $this->_sections['subcat_loop']['step'];
$this->_sections['subcat_loop']['index_next'] = $this->_sections['subcat_loop']['index'] + $this->_sections['subcat_loop']['step'];
$this->_sections['subcat_loop']['first']      = ($this->_sections['subcat_loop']['iteration'] == 1);
$this->_sections['subcat_loop']['last']       = ($this->_sections['subcat_loop']['iteration'] == $this->_sections['subcat_loop']['total']);
?>
            <div style='font-weight: normal;'><img src='./images/trans.gif' border='0' class='icon' style='width: 16px;'><a href='browse_classifieds.php?s=<?php echo $this->_tpl_vars['s']; ?>
&v=<?php echo $this->_tpl_vars['v']; ?>
&classifiedcat_id=<?php echo $this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'][$this->_sections['subcat_loop']['index']]['subcat_id']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['cats'][$this->_sections['cat_loop']['index']]['subcats'][$this->_sections['subcat_loop']['index']]['subcat_title']); ?></a></div>
          <?php endfor; endif; ?>
        </div>
      </div>
    <?php endfor; endif; ?>
    
    <?php echo '
    <script type="text/javascript">
    <!-- 
      window.addEvent(\'domready\', function()
      {
        cat_list.each(function(catObject, catID)
        {
          if( !cat_minimized.get(catID) ) return;
          $(\'subcats_\'+catID).style.display = \'\';
          $(\'icon_\'+catID).src = \'./images/icons/minus16.gif\';
        });
      });
    //-->
    </script>
    '; ?>

  </div>
  
  <?php if (! empty ( $this->_tpl_vars['fields'] )): ?>
  
  <div class='header'><?php echo SELanguage::_get(1089); ?></div>
  <div class='browse_fields'>
    
    <?php unset($this->_sections['field_loop']);
$this->_sections['field_loop']['name'] = 'field_loop';
$this->_sections['field_loop']['loop'] = is_array($_loop=$this->_tpl_vars['fields']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    
    <div style='font-weight: bold; margin-top: 5px;'><?php echo SELanguage::_get($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_title']); ?></div>
    
            <?php if ($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_type'] == 1 || $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_type'] == 2): ?>
        
                <?php if ($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_search'] == 2): ?>
          <input type='text' class='text' size='5' name='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_min' value='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_value_min']; ?>
' maxlength='64' />
          - 
          <input type='text' class='text' size='5' name='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_max' value='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_value_max']; ?>
' maxlength='64' />	  
        
                <?php else: ?>
          <input type='text' class='text' size='15' name='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' value='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_value']; ?>
' maxlength='64' />
        <?php endif; ?>
        
        
            <?php elseif ($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_type'] == 3): ?>
        <div>
          <select name='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' id='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' onchange="ShowHideDeps('<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
', this.value);" style='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
'>
            <option value='-1'></option>
                        <?php unset($this->_sections['option_loop']);
$this->_sections['option_loop']['name'] = 'option_loop';
$this->_sections['option_loop']['loop'] = is_array($_loop=$this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option_loop']['show'] = true;
$this->_sections['option_loop']['max'] = $this->_sections['option_loop']['loop'];
$this->_sections['option_loop']['step'] = 1;
$this->_sections['option_loop']['start'] = $this->_sections['option_loop']['step'] > 0 ? 0 : $this->_sections['option_loop']['loop']-1;
if ($this->_sections['option_loop']['show']) {
    $this->_sections['option_loop']['total'] = $this->_sections['option_loop']['loop'];
    if ($this->_sections['option_loop']['total'] == 0)
        $this->_sections['option_loop']['show'] = false;
} else
    $this->_sections['option_loop']['total'] = 0;
if ($this->_sections['option_loop']['show']):

            for ($this->_sections['option_loop']['index'] = $this->_sections['option_loop']['start'], $this->_sections['option_loop']['iteration'] = 1;
                 $this->_sections['option_loop']['iteration'] <= $this->_sections['option_loop']['total'];
                 $this->_sections['option_loop']['index'] += $this->_sections['option_loop']['step'], $this->_sections['option_loop']['iteration']++):
$this->_sections['option_loop']['rownum'] = $this->_sections['option_loop']['iteration'];
$this->_sections['option_loop']['index_prev'] = $this->_sections['option_loop']['index'] - $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['index_next'] = $this->_sections['option_loop']['index'] + $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['first']      = ($this->_sections['option_loop']['iteration'] == 1);
$this->_sections['option_loop']['last']       = ($this->_sections['option_loop']['iteration'] == $this->_sections['option_loop']['total']);
?>
              <option id='op' value='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'<?php if ($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] == $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> SELECTED<?php endif; ?>><?php echo SELanguage::_get($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['label']); ?></option>
            <?php endfor; endif; ?>
          </select>
        </div>
        
        
            <?php elseif ($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_type'] == 4): ?>
        
                <div id='field_options_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
'>
        <?php unset($this->_sections['option_loop']);
$this->_sections['option_loop']['name'] = 'option_loop';
$this->_sections['option_loop']['loop'] = is_array($_loop=$this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option_loop']['show'] = true;
$this->_sections['option_loop']['max'] = $this->_sections['option_loop']['loop'];
$this->_sections['option_loop']['step'] = 1;
$this->_sections['option_loop']['start'] = $this->_sections['option_loop']['step'] > 0 ? 0 : $this->_sections['option_loop']['loop']-1;
if ($this->_sections['option_loop']['show']) {
    $this->_sections['option_loop']['total'] = $this->_sections['option_loop']['loop'];
    if ($this->_sections['option_loop']['total'] == 0)
        $this->_sections['option_loop']['show'] = false;
} else
    $this->_sections['option_loop']['total'] = 0;
if ($this->_sections['option_loop']['show']):

            for ($this->_sections['option_loop']['index'] = $this->_sections['option_loop']['start'], $this->_sections['option_loop']['iteration'] = 1;
                 $this->_sections['option_loop']['iteration'] <= $this->_sections['option_loop']['total'];
                 $this->_sections['option_loop']['index'] += $this->_sections['option_loop']['step'], $this->_sections['option_loop']['iteration']++):
$this->_sections['option_loop']['rownum'] = $this->_sections['option_loop']['iteration'];
$this->_sections['option_loop']['index_prev'] = $this->_sections['option_loop']['index'] - $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['index_next'] = $this->_sections['option_loop']['index'] + $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['first']      = ($this->_sections['option_loop']['iteration'] == 1);
$this->_sections['option_loop']['last']       = ($this->_sections['option_loop']['iteration'] == $this->_sections['option_loop']['total']);
?>
          <div>
            <input type='radio' class='radio' onclick="ShowHideDeps('<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
', '<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
');" style='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
' name='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
' id='label_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' value='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'<?php if ($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'] == $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_value']): ?> CHECKED<?php endif; ?>>
            <label for='label_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['label']); ?></label>
          </div>
          
        <?php endfor; endif; ?>
        </div>
        
        
            <?php elseif ($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_type'] == 5): ?>
        <div>
          <select name='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_1' style='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
'>
          <?php unset($this->_sections['date1']);
$this->_sections['date1']['name'] = 'date1';
$this->_sections['date1']['loop'] = is_array($_loop=$this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array1']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['date1']['show'] = true;
$this->_sections['date1']['max'] = $this->_sections['date1']['loop'];
$this->_sections['date1']['step'] = 1;
$this->_sections['date1']['start'] = $this->_sections['date1']['step'] > 0 ? 0 : $this->_sections['date1']['loop']-1;
if ($this->_sections['date1']['show']) {
    $this->_sections['date1']['total'] = $this->_sections['date1']['loop'];
    if ($this->_sections['date1']['total'] == 0)
        $this->_sections['date1']['show'] = false;
} else
    $this->_sections['date1']['total'] = 0;
if ($this->_sections['date1']['show']):

            for ($this->_sections['date1']['index'] = $this->_sections['date1']['start'], $this->_sections['date1']['iteration'] = 1;
                 $this->_sections['date1']['iteration'] <= $this->_sections['date1']['total'];
                 $this->_sections['date1']['index'] += $this->_sections['date1']['step'], $this->_sections['date1']['iteration']++):
$this->_sections['date1']['rownum'] = $this->_sections['date1']['iteration'];
$this->_sections['date1']['index_prev'] = $this->_sections['date1']['index'] - $this->_sections['date1']['step'];
$this->_sections['date1']['index_next'] = $this->_sections['date1']['index'] + $this->_sections['date1']['step'];
$this->_sections['date1']['first']      = ($this->_sections['date1']['iteration'] == 1);
$this->_sections['date1']['last']       = ($this->_sections['date1']['iteration'] == $this->_sections['date1']['total']);
?>
            <option value='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array1'][$this->_sections['date1']['index']]['value']; ?>
'<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array1'][$this->_sections['date1']['index']]['selected']; ?>
><?php if ($this->_sections['date1']['first']): ?>[ <?php echo SELanguage::_get($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array1'][$this->_sections['date1']['index']]['name']); ?> ]<?php else: 
 echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array1'][$this->_sections['date1']['index']]['name']; 
 endif; ?></option>
          <?php endfor; endif; ?>
          </select>
          
          <select name='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_2' style='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
'>
          <?php unset($this->_sections['date2']);
$this->_sections['date2']['name'] = 'date2';
$this->_sections['date2']['loop'] = is_array($_loop=$this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array2']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['date2']['show'] = true;
$this->_sections['date2']['max'] = $this->_sections['date2']['loop'];
$this->_sections['date2']['step'] = 1;
$this->_sections['date2']['start'] = $this->_sections['date2']['step'] > 0 ? 0 : $this->_sections['date2']['loop']-1;
if ($this->_sections['date2']['show']) {
    $this->_sections['date2']['total'] = $this->_sections['date2']['loop'];
    if ($this->_sections['date2']['total'] == 0)
        $this->_sections['date2']['show'] = false;
} else
    $this->_sections['date2']['total'] = 0;
if ($this->_sections['date2']['show']):

            for ($this->_sections['date2']['index'] = $this->_sections['date2']['start'], $this->_sections['date2']['iteration'] = 1;
                 $this->_sections['date2']['iteration'] <= $this->_sections['date2']['total'];
                 $this->_sections['date2']['index'] += $this->_sections['date2']['step'], $this->_sections['date2']['iteration']++):
$this->_sections['date2']['rownum'] = $this->_sections['date2']['iteration'];
$this->_sections['date2']['index_prev'] = $this->_sections['date2']['index'] - $this->_sections['date2']['step'];
$this->_sections['date2']['index_next'] = $this->_sections['date2']['index'] + $this->_sections['date2']['step'];
$this->_sections['date2']['first']      = ($this->_sections['date2']['iteration'] == 1);
$this->_sections['date2']['last']       = ($this->_sections['date2']['iteration'] == $this->_sections['date2']['total']);
?>
            <option value='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array2'][$this->_sections['date2']['index']]['value']; ?>
'<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array2'][$this->_sections['date2']['index']]['selected']; ?>
><?php if ($this->_sections['date2']['first']): ?>[ <?php echo SELanguage::_get($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array2'][$this->_sections['date2']['index']]['name']); ?> ]<?php else: 
 echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array2'][$this->_sections['date2']['index']]['name']; 
 endif; ?></option>
          <?php endfor; endif; ?>
          </select>
          
          <select name='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_3' style='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
'>
          <?php unset($this->_sections['date3']);
$this->_sections['date3']['name'] = 'date3';
$this->_sections['date3']['loop'] = is_array($_loop=$this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array3']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['date3']['show'] = true;
$this->_sections['date3']['max'] = $this->_sections['date3']['loop'];
$this->_sections['date3']['step'] = 1;
$this->_sections['date3']['start'] = $this->_sections['date3']['step'] > 0 ? 0 : $this->_sections['date3']['loop']-1;
if ($this->_sections['date3']['show']) {
    $this->_sections['date3']['total'] = $this->_sections['date3']['loop'];
    if ($this->_sections['date3']['total'] == 0)
        $this->_sections['date3']['show'] = false;
} else
    $this->_sections['date3']['total'] = 0;
if ($this->_sections['date3']['show']):

            for ($this->_sections['date3']['index'] = $this->_sections['date3']['start'], $this->_sections['date3']['iteration'] = 1;
                 $this->_sections['date3']['iteration'] <= $this->_sections['date3']['total'];
                 $this->_sections['date3']['index'] += $this->_sections['date3']['step'], $this->_sections['date3']['iteration']++):
$this->_sections['date3']['rownum'] = $this->_sections['date3']['iteration'];
$this->_sections['date3']['index_prev'] = $this->_sections['date3']['index'] - $this->_sections['date3']['step'];
$this->_sections['date3']['index_next'] = $this->_sections['date3']['index'] + $this->_sections['date3']['step'];
$this->_sections['date3']['first']      = ($this->_sections['date3']['iteration'] == 1);
$this->_sections['date3']['last']       = ($this->_sections['date3']['iteration'] == $this->_sections['date3']['total']);
?>
            <option value='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array3'][$this->_sections['date3']['index']]['value']; ?>
'<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array3'][$this->_sections['date3']['index']]['selected']; ?>
><?php if ($this->_sections['date3']['first']): ?>[ <?php echo SELanguage::_get($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array3'][$this->_sections['date3']['index']]['name']); ?> ]<?php else: 
 echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['date_array3'][$this->_sections['date3']['index']]['name']; 
 endif; ?></option>
          <?php endfor; endif; ?>
          </select>
        </div>
        
        
            <?php elseif ($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_type'] == 6): ?>
        
                <div id='field_options_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
'>
        <?php unset($this->_sections['option_loop']);
$this->_sections['option_loop']['name'] = 'option_loop';
$this->_sections['option_loop']['loop'] = is_array($_loop=$this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['option_loop']['show'] = true;
$this->_sections['option_loop']['max'] = $this->_sections['option_loop']['loop'];
$this->_sections['option_loop']['step'] = 1;
$this->_sections['option_loop']['start'] = $this->_sections['option_loop']['step'] > 0 ? 0 : $this->_sections['option_loop']['loop']-1;
if ($this->_sections['option_loop']['show']) {
    $this->_sections['option_loop']['total'] = $this->_sections['option_loop']['loop'];
    if ($this->_sections['option_loop']['total'] == 0)
        $this->_sections['option_loop']['show'] = false;
} else
    $this->_sections['option_loop']['total'] = 0;
if ($this->_sections['option_loop']['show']):

            for ($this->_sections['option_loop']['index'] = $this->_sections['option_loop']['start'], $this->_sections['option_loop']['iteration'] = 1;
                 $this->_sections['option_loop']['iteration'] <= $this->_sections['option_loop']['total'];
                 $this->_sections['option_loop']['index'] += $this->_sections['option_loop']['step'], $this->_sections['option_loop']['iteration']++):
$this->_sections['option_loop']['rownum'] = $this->_sections['option_loop']['iteration'];
$this->_sections['option_loop']['index_prev'] = $this->_sections['option_loop']['index'] - $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['index_next'] = $this->_sections['option_loop']['index'] + $this->_sections['option_loop']['step'];
$this->_sections['option_loop']['first']      = ($this->_sections['option_loop']['iteration'] == 1);
$this->_sections['option_loop']['last']       = ($this->_sections['option_loop']['iteration'] == $this->_sections['option_loop']['total']);
?>
          <div>
            <input type='checkbox' onclick="ShowHideDeps('<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
', '<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
', '<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_type']; ?>
');" style='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_style']; ?>
' name='field_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
[]' id='label_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
' value='<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'<?php if (((is_array($_tmp=$this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value'])) ? $this->_run_mod_handler('in_array', true, $_tmp, $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_value']) : in_array($_tmp, $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_value']))): ?> CHECKED<?php endif; ?>>
            <label for='label_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_id']; ?>
_<?php echo $this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['value']; ?>
'><?php echo SELanguage::_get($this->_tpl_vars['fields'][$this->_sections['field_loop']['index']]['field_options'][$this->_sections['option_loop']['index']]['label']); ?></label>
          </div>
          
        <?php endfor; endif; ?>
        </div>
        
      <?php endif; ?>
    
    <?php endfor; endif; ?>
    
        <div>
      <div style='padding-top: 10px; padding-bottom: 5px;'>
        <input type='submit' class='button' value='<?php echo SELanguage::_get(1090); ?>' />&nbsp;&nbsp;
      </div>
    </div>
  <?php endif; ?>


</td>
<td style='vertical-align: top; padding-left: 10px;'>

    <?php if (! count($this->_tpl_vars['classifieds'])): ?>
    <br />
    <table cellpadding='0' cellspacing='0' align='center'>
      <tr>
        <td class='result'>
          <img src='./images/icons/bulb16.gif' border='0' class='icon' />
          <?php echo SELanguage::_get(4500134); ?>
        </td>
      </tr>
    </table>
  <?php endif; ?>

    <?php if ($this->_tpl_vars['maxpage'] > 1): ?>
    <div class='classified_pages_top'>
      <?php if ($this->_tpl_vars['p'] != 1): ?>
        <a href='javascript:void(0);' onclick='document.seBrowseClassifieds.p.value=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seBrowseClassifieds.submit();'>&#171; <?php echo SELanguage::_get(182); ?></a>
      <?php else: ?>
        &#171; <?php echo SELanguage::_get(182); ?>
      <?php endif; ?>
      &nbsp;|&nbsp;&nbsp;
      <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
        <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_classifieds']); ?></b>
      <?php else: ?>
        <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_classifieds']); ?></b>
      <?php endif; ?>
      &nbsp;&nbsp;|&nbsp;
      <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
        <a href='javascript:void(0);' onclick='document.seBrowseClassifieds.p.value=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seBrowseClassifieds.submit();'><?php echo SELanguage::_get(183); ?> &#187;</a>
      <?php else: ?>
        <?php echo SELanguage::_get(183); ?> &#187;
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php unset($this->_sections['classified_loop']);
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
    <div style='padding: 10px; border: 1px solid #CCCCCC; margin-bottom: 10px;'>
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td>
            <a href='<?php echo $this->_tpl_vars['url']->url_create('classified',$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified_author']->user_info['user_username'],$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']); ?>
'>
              <img src='<?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_photo("./images/nophoto.gif",'TRUE'); ?>
' border='0' width='60' height='60' />
            </a>
          </td>
          <td style='vertical-align: top; padding-left: 10px;'>
            <div style='font-weight: bold; font-size: 13px;'>
              <a href='<?php echo $this->_tpl_vars['url']->url_create('classified',$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified_author']->user_info['user_username'],$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_id']); ?>
'>
                <?php echo $this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_title']; ?>

              </a>
            </div>
            <div style='color: #777777; font-size: 9px; margin-bottom: 5px;'>
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
            <div>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['classifieds'][$this->_sections['classified_loop']['index']]['classified']->classified_info['classified_desc'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 300, "...", true) : smarty_modifier_truncate($_tmp, 300, "...", true)); ?>

            </div>
          </td>
        </tr>
      </table>
    </div>
  <?php endfor; endif; ?>

    <?php if ($this->_tpl_vars['maxpage'] > 1): ?>
    <div class='classified_pages_bottom'>
      <?php if ($this->_tpl_vars['p'] != 1): ?>
        <a href='javascript:void(0);' onclick='document.seBrowseClassifieds.p.value=<?php echo smarty_function_math(array('equation' => "p-1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seBrowseClassifieds.submit();'>&#171; <?php echo SELanguage::_get(182); ?></a>
      <?php else: ?>
        &#171; <?php echo SELanguage::_get(182); ?>
      <?php endif; ?>
      &nbsp;|&nbsp;&nbsp;
      <?php if ($this->_tpl_vars['p_start'] == $this->_tpl_vars['p_end']): ?>
        <b><?php echo sprintf(SELanguage::_get(184), $this->_tpl_vars['p_start'], $this->_tpl_vars['total_classifieds']); ?></b>
      <?php else: ?>
        <b><?php echo sprintf(SELanguage::_get(185), $this->_tpl_vars['p_start'], $this->_tpl_vars['p_end'], $this->_tpl_vars['total_classifieds']); ?></b>
      <?php endif; ?>
      &nbsp;&nbsp;|&nbsp;
      <?php if ($this->_tpl_vars['p'] != $this->_tpl_vars['maxpage']): ?>
        <a href='javascript:void(0);' onclick='document.seBrowseClassifieds.p.value=<?php echo smarty_function_math(array('equation' => "p+1",'p' => $this->_tpl_vars['p']), $this);?>
;document.seBrowseClassifieds.submit();'><?php echo SELanguage::_get(183); ?> &#187;</a>
      <?php else: ?>
        <?php echo SELanguage::_get(183); ?> &#187;
      <?php endif; ?>
    </div>
  <?php endif; ?>

</td>
</tr>
</table>

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