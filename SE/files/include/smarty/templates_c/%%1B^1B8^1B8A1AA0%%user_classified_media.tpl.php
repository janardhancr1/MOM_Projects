<?php /* Smarty version 2.6.14, created on 2010-06-03 04:55:48
         compiled from user_classified_media.tpl */
?><?php
SELanguage::_preload_multi(4500103,4500104,4500102,4500105,4500106,4500107,4500108,4500109,4500113,4500110,4500114,4500111,4500112);
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
      
      <img src='./images/icons/classified_classified48.gif' border='0' class='icon_big'>
      <div class='page_header'><?php echo SELanguage::_get(4500103); ?></div>
      <div><?php echo SELanguage::_get(4500104); ?></div>
      
    </td>
    <td valign='top' align='right'>
      
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td class='button' nowrap='nowrap'>
            <a href='user_classified.php'><img src='./images/icons/back16.gif' border='0' class='button' /><?php echo SELanguage::_get(4500102); ?></a>
          </td>
        </tr>
      </table>
      
    </td>
  </tr>
</table>
<br />


<?php if ($this->_tpl_vars['justadded'] == 1): ?>
  <div id='classified_result'>
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td class='success'><img src='./images/success.gif' border='0' class='icon' /><?php echo SELanguage::_get(4500105); ?></td>
      </tr>
    </table>
    <br />
    
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td>
          <?php $this->assign('langBlockTemp', SE_Language::_get(4500106));


  ?>
          <input type='button' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' onClick="$('classified_result').style.display='none';$('classified_pagecontent').style.display='block';" />
          &nbsp;
          <?php 

  ?>
        </td>
        <td>
          <?php $this->assign('langBlockTemp', SE_Language::_get(4500107));


  ?>
          <form action='user_classified.php' method='get'>
          <input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' />
          </form>
          <?php 

  ?>
        </td>
      </tr>
    </table>
  </div>
<?php endif; ?>


<div id='classified_pagecontent' style='<?php if ($this->_tpl_vars['justadded'] == 1): ?>display: none;<?php endif; ?>'>

  <?php if ($this->_tpl_vars['user']->level_info['level_classified_photo']): ?>
  <form action='user_classified_media.php' method='post' enctype='multipart/form-data'>
  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(4500108); ?></td>
    </tr>
    <tr>
      <td class='classified_box'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td valign='top'>
              <img src='<?php echo $this->_tpl_vars['classified']->classified_photo("./images/nophoto.gif",'TRUE'); ?>
' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['classified']->classified_photo("./images/nophoto.gif"),'140','140','w'); ?>
' />
            </td>
            <td style='padding-left: 10px;' valign='top'>
              <div><?php echo SELanguage::_get(4500109); ?></div>
              <input type='file' name='photo' class='text' size='40' />
              <?php $this->assign('langBlockTemp', SE_Language::_get(4500113));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
              <input type='hidden' name='task' value='upload' />
              <input type='hidden' name='MAX_FILE_SIZE' value='5000000' />
              <input type='hidden' name='classified_id' value='<?php echo $this->_tpl_vars['classified_id']; ?>
' />
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  </form>
  <br />
  <?php endif; ?>
  
  
  <?php echo '
  <script type=\'text/javascript\'>
  <!--
  function doUpload(spot)
  {
    $(\'uploadform\'+spot).style.display=\'none\';
    $(\'uploadform_uploading\'+spot).style.display=\'block\';
  }

  function uploadComplete(result_code, response, spot, classifiedmedia_id)
  {
    if(result_code == 1)
    {
      alert(response);
      $(\'uploadform\'+spot).style.display=\'block\';
      $(\'uploadform_uploading\'+spot).style.display=\'none\';
    }
    else
    {
      $(\'uploadform_uploading\'+spot).style.display=\'none\';
      $(\'uploadform_uploaded\'+spot).style.display=\'block\';
      uploadform_newmedia = document.getElementById(\'uploadform_newmedia\'+spot);
      uploadform_newmedia.src = response;
      var nextspot = parseInt(spot);
      nextspot = nextspot + 1;
      $(\'uploadbox\'+nextspot).style.display=\'block\';
      var deletelink = document.getElementById(\'deletelink\'+spot);
      deletelink.innerHTML = "[ <a href=\'javascript:void(0)\' onClick=\\"deletePhoto2(\'"+classifiedmedia_id+"\', \'"+spot+"\')\\">'; 
 echo SELanguage::_get(4500110); 
 echo '</a> ]";
    }
  }

  function deletePhoto(classifiedmedia_id, spot)
  {
    document.getElementById(\'photo\'+spot).style.display = "none";
    document.getElementById(\'photo\'+spot+\'_deleting\').style.display = "block";
    var divname = \'photo\' + spot + \'_deleting\';
    var uploadframe = document.getElementById(\'uploadframe\'+spot);
    uploadframe.src = \'user_classified_media.php?task=deletemedia&classified_id='; 
 echo $this->_tpl_vars['classified_id']; 
 echo '&classifiedmedia_id=\'+classifiedmedia_id;
    setTimeout("$(\'"+divname+"\').style.display=\'none\';", 1500);
  }

  function deletePhoto2(classifiedmedia_id, spot)
  {
    document.getElementById(\'uploadbox\'+spot).style.display = "none";
    document.getElementById(\'photo\'+spot+\'_deleting\').style.display = "block";
    var divname = \'photo\' + spot + \'_deleting\';
    var uploadframe = document.getElementById(\'uploadframe\'+spot);
    uploadframe.src = \'user_classified_media.php?task=deletemedia&classified_id='; 
 echo $this->_tpl_vars['classified_id']; 
 echo '&classifiedmedia_id=\'+classifiedmedia_id;
    setTimeout("$(\'"+divname+"\').style.display=\'none\';", 1500);
  }

  //-->
  </script>
  '; ?>



  <table cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td class='header'><?php echo SELanguage::_get(4500114); ?></td>
    </tr>
    <tr>
      <td class='classified_box'>
        
                <?php unset($this->_sections['file_loop']);
$this->_sections['file_loop']['name'] = 'file_loop';
$this->_sections['file_loop']['loop'] = is_array($_loop=$this->_tpl_vars['files']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['file_loop']['show'] = true;
$this->_sections['file_loop']['max'] = $this->_sections['file_loop']['loop'];
$this->_sections['file_loop']['step'] = 1;
$this->_sections['file_loop']['start'] = $this->_sections['file_loop']['step'] > 0 ? 0 : $this->_sections['file_loop']['loop']-1;
if ($this->_sections['file_loop']['show']) {
    $this->_sections['file_loop']['total'] = $this->_sections['file_loop']['loop'];
    if ($this->_sections['file_loop']['total'] == 0)
        $this->_sections['file_loop']['show'] = false;
} else
    $this->_sections['file_loop']['total'] = 0;
if ($this->_sections['file_loop']['show']):

            for ($this->_sections['file_loop']['index'] = $this->_sections['file_loop']['start'], $this->_sections['file_loop']['iteration'] = 1;
                 $this->_sections['file_loop']['iteration'] <= $this->_sections['file_loop']['total'];
                 $this->_sections['file_loop']['index'] += $this->_sections['file_loop']['step'], $this->_sections['file_loop']['iteration']++):
$this->_sections['file_loop']['rownum'] = $this->_sections['file_loop']['iteration'];
$this->_sections['file_loop']['index_prev'] = $this->_sections['file_loop']['index'] - $this->_sections['file_loop']['step'];
$this->_sections['file_loop']['index_next'] = $this->_sections['file_loop']['index'] + $this->_sections['file_loop']['step'];
$this->_sections['file_loop']['first']      = ($this->_sections['file_loop']['iteration'] == 1);
$this->_sections['file_loop']['last']       = ($this->_sections['file_loop']['iteration'] == $this->_sections['file_loop']['total']);
?>
          
                    <?php if ($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'jpeg' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'jpg' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'gif' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'png' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'bmp'): ?>
            <?php $this->assign('file_dir', $this->_tpl_vars['classified']->classified_dir($this->_tpl_vars['classified']->classified_info['classified_id'])); ?>
            <?php $this->assign('file_src', ($this->_tpl_vars['file_dir']).($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_id']).".jpg"); ?>
                    <?php elseif ($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mp3' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mp4' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'wav'): ?>
            <?php $this->assign('file_src', './images/icons/audio_big.gif'); ?>
                    <?php elseif ($this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mpeg' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mpg' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mpa' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'avi' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'swf' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'mov' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'ram' || $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_ext'] == 'rm'): ?>
            <?php $this->assign('file_src', './images/icons/video_big.gif'); ?>
                    <?php else: ?>
            <?php $this->assign('file_src', './images/icons/file_big.gif'); ?>
          <?php endif; ?>
          
                    <div id='photo<?php echo $this->_sections['file_loop']['iteration']; ?>
' style='margin: 30px; text-align: left;'>
            <div class='album_thumb2' style='width: 300px;'>
              <img src='<?php echo $this->_tpl_vars['file_src']; ?>
' border='0' width='<?php echo $this->_tpl_vars['misc']->photo_size($this->_tpl_vars['file_src'],'300','250','w'); ?>
' class='photo' />
            </div>
            <div style='margin-top: 5px; font-weight: bold;'>
              [ <a href='javascript:void(0)' onClick="deletePhoto('<?php echo $this->_tpl_vars['files'][$this->_sections['file_loop']['index']]['classifiedmedia_id']; ?>
', '<?php echo $this->_sections['file_loop']['iteration']; ?>
')"><?php echo SELanguage::_get(4500110); ?></a> ]
            </div>
          </div>
          <div id='photo<?php echo $this->_sections['file_loop']['iteration']; ?>
_deleting' style='margin: 30px; width: 300px; min-height: 260px; display: none; text-align: left;'>
            <div class='album_thumb2' style='border: 1px solid #DDDDDD;'>
              <div style='margin-top: 90px; font-weight: bold; text-align: center;'>
                <?php echo SELanguage::_get(4500111); ?>
                <br />
                <img src='./images/icons/classified_working.gif' border='0' />
              </div>
            </div>
          </div>
          <iframe id='uploadframe<?php echo $this->_sections['file_loop']['iteration']; ?>
' name='uploadframe<?php echo $this->_tpl_vars['spot']; ?>
' style='display: none;' frameborder='no' src='about:blank'></iframe>
          
        <?php endfor; endif; ?>
        
        <?php $this->assign('totalspots', 11); ?>
        <?php $this->assign('formstoshow', $this->_tpl_vars['totalspots']-$this->_sections['file_loop']['iteration']); ?>
        <?php if ($this->_sections['file_loop']['iteration'] > 0): ?>
          <?php $this->assign('media_shown_already', $this->_sections['file_loop']['iteration']-1); ?>
        <?php else: ?>
          <?php $this->assign('media_shown_already', 0); ?>
        <?php endif; ?>
        
                <?php unset($this->_sections['form_loop']);
$this->_sections['form_loop']['name'] = 'form_loop';
$this->_sections['form_loop']['loop'] = is_array($_loop=$this->_tpl_vars['formstoshow']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['form_loop']['show'] = true;
$this->_sections['form_loop']['max'] = $this->_sections['form_loop']['loop'];
$this->_sections['form_loop']['step'] = 1;
$this->_sections['form_loop']['start'] = $this->_sections['form_loop']['step'] > 0 ? 0 : $this->_sections['form_loop']['loop']-1;
if ($this->_sections['form_loop']['show']) {
    $this->_sections['form_loop']['total'] = $this->_sections['form_loop']['loop'];
    if ($this->_sections['form_loop']['total'] == 0)
        $this->_sections['form_loop']['show'] = false;
} else
    $this->_sections['form_loop']['total'] = 0;
if ($this->_sections['form_loop']['show']):

            for ($this->_sections['form_loop']['index'] = $this->_sections['form_loop']['start'], $this->_sections['form_loop']['iteration'] = 1;
                 $this->_sections['form_loop']['iteration'] <= $this->_sections['form_loop']['total'];
                 $this->_sections['form_loop']['index'] += $this->_sections['form_loop']['step'], $this->_sections['form_loop']['iteration']++):
$this->_sections['form_loop']['rownum'] = $this->_sections['form_loop']['iteration'];
$this->_sections['form_loop']['index_prev'] = $this->_sections['form_loop']['index'] - $this->_sections['form_loop']['step'];
$this->_sections['form_loop']['index_next'] = $this->_sections['form_loop']['index'] + $this->_sections['form_loop']['step'];
$this->_sections['form_loop']['first']      = ($this->_sections['form_loop']['iteration'] == 1);
$this->_sections['form_loop']['last']       = ($this->_sections['form_loop']['iteration'] == $this->_sections['form_loop']['total']);
?>
          
          <?php $this->assign('spot', $this->_sections['form_loop']['iteration']+$this->_tpl_vars['media_shown_already']); ?>
          <div id='uploadbox<?php echo $this->_tpl_vars['spot']; ?>
' style='margin: 30px; text-align: left; <?php if ($this->_sections['form_loop']['first'] != true): ?> display: none;<?php endif; ?>'>
            <div id='uploadform<?php echo $this->_tpl_vars['spot']; ?>
' class='classified_uploadform' style='width: 300px; min-height: 260px;'>
              <form action='user_classified_media.php' method='post' target='uploadframe<?php echo $this->_tpl_vars['spot']; ?>
' enctype='multipart/form-data' onSubmit="doUpload('<?php echo $this->_tpl_vars['spot']; ?>
')">
              <div style='margin-top: 50px;'><?php echo SELanguage::_get(4500112); ?></div>
              <br />
              
              <input type='file' name='file' name='photo' class='text' />
              <br />
              <br />
              
              <?php $this->assign('langBlockTemp', SE_Language::_get(4500113));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
              <input type='hidden' name='task' value='uploadmedia' />
              <input type='hidden' name='MAX_FILE_SIZE' value='5000000' />
              <input type='hidden' name='classified_id' value='<?php echo $this->_tpl_vars['classified_id']; ?>
' />
              <input type='hidden' name='spot' value='<?php echo $this->_tpl_vars['spot']; ?>
' />
              </form>
            </div>
            <div id='uploadform_uploading<?php echo $this->_tpl_vars['spot']; ?>
' class='classified_uploadform_uploading' style='width: 300px; height: 260px; display: none;'>
              <img src='./images/icons/classified_working.gif' border='0' style='margin-top: 90px;' />
            </div>
            <div id='uploadform_uploaded<?php echo $this->_tpl_vars['spot']; ?>
' style='display: none;'>
              <div>
                <img src='./trans.gif' id='uploadform_newmedia<?php echo $this->_tpl_vars['spot']; ?>
' border='0' class='photo' width='300' />
              </div>
              <div style='margin-top: 5px; font-weight: bold;'>
                <span id='deletelink<?php echo $this->_tpl_vars['spot']; ?>
'></span>&nbsp;
              </div>
            </div>
          </div>
          <div id='photo<?php echo $this->_tpl_vars['spot']; ?>
_deleting' style='display: none; margin: 30px; text-align: left;'>
            <div class='album_thumb2' style='width: 300px; min-height: 260px; border: 1px solid #DDDDDD;'>
              <div style='margin-top: 90px; font-weight: bold; text-align: center;'>
                <?php echo SELanguage::_get(4500111); ?>
                <br />
                <img src='./images/icons/classified_working.gif' border='0' />
              </div>
            </div>
          </div>
          <iframe id='uploadframe<?php echo $this->_tpl_vars['spot']; ?>
' name='uploadframe<?php echo $this->_tpl_vars['spot']; ?>
' style='display: none;' frameborder='no' src='about:blank'></iframe>
          
        <?php endfor; endif; ?>
        
      </td>
    </tr>
  </table>
  <br />
  
  
  <form action='user_classified.php' method='get'>
    <?php $this->assign('langBlockTemp', SE_Language::_get(4500102));


  ?><input type='submit' class='button' value='<?php echo $this->_tpl_vars['langBlockTemp']; ?>
' /><?php 

  ?>
  </form>

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