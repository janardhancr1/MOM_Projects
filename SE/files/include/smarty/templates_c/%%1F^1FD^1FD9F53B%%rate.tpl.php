<?php /* Smarty version 2.6.14, created on 2010-05-29 15:57:59
         compiled from rate.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'rate.tpl', 30, false),)), $this);
?><?php
SELanguage::load();
?><html>
<head>
<link rel="stylesheet" href="./templates/styles.css" title="stylesheet" type="text/css"> 
<?php echo '
<script type=\'text/javascript\'>
<!--

preload_full = new Image();
preload_full.src = "./images/icons/rating_star2.gif";
preload_partial = new Image();
preload_partial.src = "./images/icons/rating_star2_half.gif";
preload_empty = new Image();
preload_empty.src = "./images/icons/rating_star1.gif";

function roll_over(rating) {
  for(var x=1; x<='; 
 echo $this->_tpl_vars['max_rating']; 
 echo '; x++) {
    if(x <= rating) {
      document.images["rate"+x].src = preload_full.src;
    } else {
      document.images["rate"+x].src = preload_empty.src;
    }
  }
}

function roll_out() {
  for(var x=1; x<='; 
 echo $this->_tpl_vars['max_rating']; 
 echo '; x++) {
    if(x <= '; 
 echo $this->_tpl_vars['rating_full']; 
 echo ') {

      document.images["rate"+x].src = preload_full.src;
    } else if('; 
 echo $this->_tpl_vars['rating_partial']; 
 echo ' != 0 && x == '; 
 echo smarty_function_math(array('equation' => 'x+1','x' => $this->_tpl_vars['rating_full']), $this);
 echo ') {
      document.images["rate"+x].src = preload_partial.src;
    } else {
      document.images["rate"+x].src = preload_empty.src;
    }
  }

}


//-->
</script>
'; ?>

</head>
<body style="background-image: url(../images/admin_menu_bg1.gif);">
<div style="width:200px;height:25px">
<div style="float:left;width:100px">
<table cellspacing='0' cellpadding='0' onmouseout='roll_out()' align='center'>
<tr>

<?php unset($this->_sections['full_stars']);
$this->_sections['full_stars']['name'] = 'full_stars';
$this->_sections['full_stars']['start'] = (int)0;
$this->_sections['full_stars']['loop'] = is_array($_loop=$this->_tpl_vars['rating_full']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['full_stars']['show'] = true;
$this->_sections['full_stars']['max'] = $this->_sections['full_stars']['loop'];
$this->_sections['full_stars']['step'] = 1;
if ($this->_sections['full_stars']['start'] < 0)
    $this->_sections['full_stars']['start'] = max($this->_sections['full_stars']['step'] > 0 ? 0 : -1, $this->_sections['full_stars']['loop'] + $this->_sections['full_stars']['start']);
else
    $this->_sections['full_stars']['start'] = min($this->_sections['full_stars']['start'], $this->_sections['full_stars']['step'] > 0 ? $this->_sections['full_stars']['loop'] : $this->_sections['full_stars']['loop']-1);
if ($this->_sections['full_stars']['show']) {
    $this->_sections['full_stars']['total'] = min(ceil(($this->_sections['full_stars']['step'] > 0 ? $this->_sections['full_stars']['loop'] - $this->_sections['full_stars']['start'] : $this->_sections['full_stars']['start']+1)/abs($this->_sections['full_stars']['step'])), $this->_sections['full_stars']['max']);
    if ($this->_sections['full_stars']['total'] == 0)
        $this->_sections['full_stars']['show'] = false;
} else
    $this->_sections['full_stars']['total'] = 0;
if ($this->_sections['full_stars']['show']):

            for ($this->_sections['full_stars']['index'] = $this->_sections['full_stars']['start'], $this->_sections['full_stars']['iteration'] = 1;
                 $this->_sections['full_stars']['iteration'] <= $this->_sections['full_stars']['total'];
                 $this->_sections['full_stars']['index'] += $this->_sections['full_stars']['step'], $this->_sections['full_stars']['iteration']++):
$this->_sections['full_stars']['rownum'] = $this->_sections['full_stars']['iteration'];
$this->_sections['full_stars']['index_prev'] = $this->_sections['full_stars']['index'] - $this->_sections['full_stars']['step'];
$this->_sections['full_stars']['index_next'] = $this->_sections['full_stars']['index'] + $this->_sections['full_stars']['step'];
$this->_sections['full_stars']['first']      = ($this->_sections['full_stars']['iteration'] == 1);
$this->_sections['full_stars']['last']       = ($this->_sections['full_stars']['iteration'] == $this->_sections['full_stars']['total']);
?>
  <td>
  <?php echo smarty_function_math(array('assign' => 'rating','equation' => 'x+1','x' => $this->_sections['full_stars']['index']), $this);?>

  <?php if ($this->_tpl_vars['rating_allowed'] != 0): ?>
    <a href='./rate.php?task=rate&object_table=<?php echo $this->_tpl_vars['object_table']; ?>
&object_primary=<?php echo $this->_tpl_vars['object_primary']; ?>
&object_id=<?php echo $this->_tpl_vars['object_id']; ?>
&rating=<?php echo $this->_tpl_vars['rating']; ?>
' onmouseover='roll_over(<?php echo $this->_tpl_vars['rating']; ?>
)'><img name='rate<?php echo $this->_tpl_vars['rating']; ?>
' src='./images/icons/rating_star2.gif' border='0' style='margin: 1px;'></a>
  <?php else: ?>
    <img name='rate<?php echo $this->_tpl_vars['rating']; ?>
' src='./images/icons/rating_star2.gif' border='0' style='margin: 1px;'>
  <?php endif; ?>
  </td>
<?php endfor; endif; 
 unset($this->_sections['partial_stars']);
$this->_sections['partial_stars']['name'] = 'partial_stars';
$this->_sections['partial_stars']['start'] = (int)0;
$this->_sections['partial_stars']['loop'] = is_array($_loop=$this->_tpl_vars['rating_partial']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['partial_stars']['show'] = true;
$this->_sections['partial_stars']['max'] = $this->_sections['partial_stars']['loop'];
$this->_sections['partial_stars']['step'] = 1;
if ($this->_sections['partial_stars']['start'] < 0)
    $this->_sections['partial_stars']['start'] = max($this->_sections['partial_stars']['step'] > 0 ? 0 : -1, $this->_sections['partial_stars']['loop'] + $this->_sections['partial_stars']['start']);
else
    $this->_sections['partial_stars']['start'] = min($this->_sections['partial_stars']['start'], $this->_sections['partial_stars']['step'] > 0 ? $this->_sections['partial_stars']['loop'] : $this->_sections['partial_stars']['loop']-1);
if ($this->_sections['partial_stars']['show']) {
    $this->_sections['partial_stars']['total'] = min(ceil(($this->_sections['partial_stars']['step'] > 0 ? $this->_sections['partial_stars']['loop'] - $this->_sections['partial_stars']['start'] : $this->_sections['partial_stars']['start']+1)/abs($this->_sections['partial_stars']['step'])), $this->_sections['partial_stars']['max']);
    if ($this->_sections['partial_stars']['total'] == 0)
        $this->_sections['partial_stars']['show'] = false;
} else
    $this->_sections['partial_stars']['total'] = 0;
if ($this->_sections['partial_stars']['show']):

            for ($this->_sections['partial_stars']['index'] = $this->_sections['partial_stars']['start'], $this->_sections['partial_stars']['iteration'] = 1;
                 $this->_sections['partial_stars']['iteration'] <= $this->_sections['partial_stars']['total'];
                 $this->_sections['partial_stars']['index'] += $this->_sections['partial_stars']['step'], $this->_sections['partial_stars']['iteration']++):
$this->_sections['partial_stars']['rownum'] = $this->_sections['partial_stars']['iteration'];
$this->_sections['partial_stars']['index_prev'] = $this->_sections['partial_stars']['index'] - $this->_sections['partial_stars']['step'];
$this->_sections['partial_stars']['index_next'] = $this->_sections['partial_stars']['index'] + $this->_sections['partial_stars']['step'];
$this->_sections['partial_stars']['first']      = ($this->_sections['partial_stars']['iteration'] == 1);
$this->_sections['partial_stars']['last']       = ($this->_sections['partial_stars']['iteration'] == $this->_sections['partial_stars']['total']);
?>
  <td>
  <?php echo smarty_function_math(array('assign' => 'rating','equation' => 'x+y+1','x' => $this->_sections['partial_stars']['index'],'y' => $this->_tpl_vars['rating_full']), $this);?>

  <?php if ($this->_tpl_vars['rating_allowed'] != 0): ?>
    <a href='rate.php?task=rate&object_table=<?php echo $this->_tpl_vars['object_table']; ?>
&object_primary=<?php echo $this->_tpl_vars['object_primary']; ?>
&object_id=<?php echo $this->_tpl_vars['object_id']; ?>
&rating=<?php echo $this->_tpl_vars['rating']; ?>
' onmouseover='roll_over(<?php echo $this->_tpl_vars['rating']; ?>
)'><img name='rate<?php echo $this->_tpl_vars['rating']; ?>
' src='./images/icons/rating_star2_half.gif' border='0' style='margin: 1px;'></a>
  <?php else: ?>
    <img name='rate<?php echo $this->_tpl_vars['rating']; ?>
' src='./images/icons/rating_star2_half.gif' border='0' style='margin: 1px;'>
  <?php endif; ?>
  </td>
<?php endfor; endif; 
 unset($this->_sections['empty_stars']);
$this->_sections['empty_stars']['name'] = 'empty_stars';
$this->_sections['empty_stars']['start'] = (int)0;
$this->_sections['empty_stars']['loop'] = is_array($_loop=$this->_tpl_vars['rating_empty']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['empty_stars']['show'] = true;
$this->_sections['empty_stars']['max'] = $this->_sections['empty_stars']['loop'];
$this->_sections['empty_stars']['step'] = 1;
if ($this->_sections['empty_stars']['start'] < 0)
    $this->_sections['empty_stars']['start'] = max($this->_sections['empty_stars']['step'] > 0 ? 0 : -1, $this->_sections['empty_stars']['loop'] + $this->_sections['empty_stars']['start']);
else
    $this->_sections['empty_stars']['start'] = min($this->_sections['empty_stars']['start'], $this->_sections['empty_stars']['step'] > 0 ? $this->_sections['empty_stars']['loop'] : $this->_sections['empty_stars']['loop']-1);
if ($this->_sections['empty_stars']['show']) {
    $this->_sections['empty_stars']['total'] = min(ceil(($this->_sections['empty_stars']['step'] > 0 ? $this->_sections['empty_stars']['loop'] - $this->_sections['empty_stars']['start'] : $this->_sections['empty_stars']['start']+1)/abs($this->_sections['empty_stars']['step'])), $this->_sections['empty_stars']['max']);
    if ($this->_sections['empty_stars']['total'] == 0)
        $this->_sections['empty_stars']['show'] = false;
} else
    $this->_sections['empty_stars']['total'] = 0;
if ($this->_sections['empty_stars']['show']):

            for ($this->_sections['empty_stars']['index'] = $this->_sections['empty_stars']['start'], $this->_sections['empty_stars']['iteration'] = 1;
                 $this->_sections['empty_stars']['iteration'] <= $this->_sections['empty_stars']['total'];
                 $this->_sections['empty_stars']['index'] += $this->_sections['empty_stars']['step'], $this->_sections['empty_stars']['iteration']++):
$this->_sections['empty_stars']['rownum'] = $this->_sections['empty_stars']['iteration'];
$this->_sections['empty_stars']['index_prev'] = $this->_sections['empty_stars']['index'] - $this->_sections['empty_stars']['step'];
$this->_sections['empty_stars']['index_next'] = $this->_sections['empty_stars']['index'] + $this->_sections['empty_stars']['step'];
$this->_sections['empty_stars']['first']      = ($this->_sections['empty_stars']['iteration'] == 1);
$this->_sections['empty_stars']['last']       = ($this->_sections['empty_stars']['iteration'] == $this->_sections['empty_stars']['total']);
?>
  <td>
  <?php echo smarty_function_math(array('assign' => 'rating','equation' => 'x+y+z+1','x' => $this->_sections['empty_stars']['index'],'y' => $this->_tpl_vars['rating_full'],'z' => $this->_tpl_vars['rating_partial']), $this);?>

  <?php if ($this->_tpl_vars['rating_allowed'] != 0): ?>
    <a href='rate.php?task=rate&object_table=<?php echo $this->_tpl_vars['object_table']; ?>
&object_primary=<?php echo $this->_tpl_vars['object_primary']; ?>
&object_id=<?php echo $this->_tpl_vars['object_id']; ?>
&rating=<?php echo $this->_tpl_vars['rating']; ?>
' onmouseover='roll_over(<?php echo $this->_tpl_vars['rating']; ?>
)'><img name='rate<?php echo $this->_tpl_vars['rating']; ?>
' src='./images/icons/rating_star1.gif' border='0' style='margin: 1px;'></a>
  <?php else: ?>
    <img name='rate<?php echo $this->_tpl_vars['rating']; ?>
' src='./images/icons/rating_star1.gif' border='0' style='margin: 1px;'>
  <?php endif; ?>
  </td>
<?php endfor; endif; ?>

</tr>
</table>
</div>
<div style="width:50px;float:left;">&nbsp;(<?php echo $this->_tpl_vars['rating_value']; ?>
 of <?php echo $this->_tpl_vars['max_rating']; ?>
)</div>
<div style="width:50px;float:left;">&nbsp;<?php echo $this->_tpl_vars['rating_total']; ?>
 votes</div>
</div>
</body>
</html>