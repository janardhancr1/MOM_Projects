<?php /* Smarty version 2.6.14, created on 2010-05-26 12:41:30
         compiled from user_upload.tpl */
?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'user_upload.tpl', 9, false),array('modifier', 'count', 'user_upload.tpl', 173, false),)), $this);
?><?php
SELanguage::_preload_multi(1190,1194,1229,1230,1231,1232,1191,1189,1192,1193,1195,1196,1183,1184,1185,1186,1187,1188);
SELanguage::load();
?>

<script type='text/javascript' src='./include/uploader/Swiff.Uploader.js'></script>
<script type='text/javascript' src='./include/uploader/Fx.ProgressBar.js'></script>
<script type='text/javascript' src='./include/uploader/FancyUpload2.js'></script>

<?php $this->assign('user_upload_field_name', ((is_array($_tmp=@$this->_tpl_vars['user_upload_field_name'])) ? $this->_run_mod_handler('default', true, $_tmp, 'file1') : smarty_modifier_default($_tmp, 'file1'))); 
 $this->assign('user_upload_max_files', ((is_array($_tmp=@$this->_tpl_vars['user_upload_max_files'])) ? $this->_run_mod_handler('default', true, $_tmp, 10) : smarty_modifier_default($_tmp, 10))); 
 $this->assign('user_upload_max_size', ((is_array($_tmp=@$this->_tpl_vars['user_upload_max_size'])) ? $this->_run_mod_handler('default', true, $_tmp, 'false') : smarty_modifier_default($_tmp, 'false'))); 
 $this->assign('user_upload_allowed_extensions', ((is_array($_tmp=@$this->_tpl_vars['user_upload_allowed_extensions'])) ? $this->_run_mod_handler('default', true, $_tmp, @NULL) : smarty_modifier_default($_tmp, @NULL))); 
 
$javascript_lang_import_list = SELanguage::_javascript_redundancy_filter(array(1190,1194,1229,1230,1231,1232));
$javascript_lang_import_first = TRUE;
if( is_array($javascript_lang_import_list) && !empty($javascript_lang_import_list) )
{
  echo "\n<script type='text/javascript'>\n<!--\n";
  echo "SocialEngine.Language.Import({\n";
  foreach( $javascript_lang_import_list as $javascript_import_id )
  {
    if( !$javascript_lang_import_first ) echo ",\n";
    echo "  ".$javascript_import_id." : '".addslashes(SE_Language::_get($javascript_import_id))."'";
    $javascript_lang_import_first = FALSE;
  }
  echo "\n});\n//-->\n</script>\n";
}
 
 echo '
<script type="text/javascript">
<!--
  '; 
 if ($this->_tpl_vars['show_uploader']): 
 echo '
  
  window.addEvent(\'domready\', function()
  {
    '; ?>

    <?php if (empty ( $this->_tpl_vars['user_upload_allowed_extensions'] )): ?>
    var allowed_extensions = false;
    var allowed_extensions_array = false;
    <?php else: ?>
    var allowed_extensions = '<?php echo $this->_tpl_vars['user_upload_allowed_extensions']; ?>
';
    var allowed_extensions_array = allowed_extensions.split(',');
    <?php endif; ?>
    <?php echo '
    
    var customValidationHandler = function(file, errors)
    {
      // No extensions are set, allow all
      if( !allowed_extensions || !allowed_extensions_array )
        return true;
      
      var fileParts = file.name.split(\'.\');
      var fileExtension = ( fileParts ? fileParts[fileParts.length-1] : false );
      
      // Could not get extension, should we return true or false?
      if( !fileExtension || $type(fileExtension)!="string" )
        return true;
      
      fileExtension = fileExtension.toLowerCase();
      
      // File extension not in the list of allowed extensions
      if( !allowed_extensions_array.contains(fileExtension) )
        return false;
      
      return true;
    }
    
    var invalidFileHandler = function(file, errors)
    {
      var msg;
      if( errors.contains(\'size\') )
      {
        msg = SocialEngine.Language.TranslateFormatted(1229, [swiffy.options.limitSize, file.name]);
      }
      else if( errors.contains(\'length\') )
      {
        msg = SocialEngine.Language.TranslateFormatted(1230, [swiffy.options.limitFiles]);
      }
      else if( errors.contains(\'custom\') )
      {
        msg = SocialEngine.Language.TranslateFormatted(1232, [allowed_extensions_array.join(\', \'), file.name]);
      }
      else
      {
        msg = SocialEngine.Language.Translate(1231);
      }
      alert(msg);
    }
    
    var postData = {\'isAjax\':1, \'upload_token\':\''; 
 echo $this->_tpl_vars['upload_token']; 
 echo '\'};
    $(\'uploadForm\').getElements(\'input[type=hidden]\').each(function(el) { postData[el.get(\'name\')] = el.get(\'value\');});

    var swiffy = new FancyUpload2($(\'uploader\'), $(\'fileList\'),
    {
      \'url\': \''; 
 echo $this->_tpl_vars['url']->url_base; 
 echo 'user_upload.php?session_id='; 
 echo $this->_tpl_vars['session_id']; 
 echo '\',
      \'fieldName\': \''; 
 echo $this->_tpl_vars['user_upload_field_name']; 
 echo '\',
      \'data\': postData,
      \'limitSize\': '; 
 echo $this->_tpl_vars['user_upload_max_size']; 
 echo ',
      \'limitFiles\': '; 
 echo $this->_tpl_vars['user_upload_max_files']; 
 echo ',
      \'path\': \'./include/uploader/Swiff.Uploader.swf\',
      \'onLoad\': function()
      {
        $(\'uploader\').style.display = \'block\';
        $(\'fallback_link\').style.display = \'block\';
        $(\'fallback\').style.display = \'none\';
      },
      \'target\': \'uploader_browse\',
      \'fileInvalid\' : invalidFileHandler,
      \'validateFile\' : customValidationHandler
    });
 
    $(\'uploader_browse\').addEvent(\'click\', function()
    {
      swiffy.browse();
      return false;
    });
 
    $(\'uploader_upload\').addEvent(\'click\', function()
    {
      if(swiffy.files.length == 0) {
        alert(SocialEngine.Language.Translate(1194));
      } else {
        swiffy.upload();
      }
      return false;
    });

    $(\'fallback_link\').addEvent(\'click\', function()
    {
      $(\'fallback\').style.display=\'block\';
      $(\'fallback_link\').style.display=\'none\';
      $(\'uploader\').style.display=\'none\';
      return false;
    });
  });
  '; 
 endif; 
 echo '

  function startStatus()
  {
    $(\'fallback_submit\').disabled = true;
    $(\'fallback_status\').value = SocialEngine.Language.Translate(1190);
    window.setTimeout("goStatus()", 400);
  }
  
  function goStatus()
  {
    $(\'fallback_status\').value = $(\'fallback_status\').value + \'.\';
    if($(\'fallback_status\').value == SocialEngine.Language.Translate(1190)+\'....\') { $(\'fallback_status\').value = SocialEngine.Language.Translate(1190); }
    window.setTimeout("goStatus()", 400);
  }
// -->
</script>
'; ?>



<div id='uploader' style='display: none;'>
  <div style='margin-bottom: 10px;'>
    <div style='float: left; font-weight: bold;'>
      <a href='javascript:void(0);' id='uploader_browse' onClick='this.blur()'><img src='./images/uploader_browse.gif' border='0' class='button'><?php echo SELanguage::_get(1191); ?></a>
    </div>
    <div style='float: left; padding-left: 20px; font-weight: bold;'>
      <a href='javascript:void(0);' id='uploader_upload' onClick='this.blur()'><img src='./images/uploader_upload.gif' border='0' class='button'><?php echo SELanguage::_get(1189); ?></a>
    </div>
    <div style='height: 0px; clear: both;'></div>
  </div>
  <div>
    <div><?php echo SELanguage::_get(1192); ?> <span class='overall-title'></span></div>
    <img src='./images/uploader_bar.gif' class='progress overall-progress' />
  </div>
  <div style='margin-top: 5px;'>
    <div><?php echo SELanguage::_get(1193); ?> <span class='current-title'></span></div>
    <img src='./images/uploader_bar.gif' class='progress current-progress' />
  </div>
  <div class='uploading-text' style='display: none;'><?php echo sprintf(SELanguage::_get(1195), "<span class='current-rate'></span>", "<span class='current-timeleft'></span>"); ?></div>
  <div class='uploaded-text' style='display: none;'><?php echo SELanguage::_get(1196); ?></div>
  <ul id='fileList'></ul>
</div>
 

<br />
<div id='fallback_link' class='fallback_link' style='display: none;'><a href='javascript:void(0)'><?php echo SELanguage::_get(1183); ?></a></div>

<div id='fallback'>

    <?php if (count($this->_tpl_vars['file_result']) != 0): ?>
    <br />
    <table cellpadding='0' cellspacing='0'>
      <tr>
        <td class='result'>
          <div class='success' style='text-align: left;'> 
            <?php $_from = $this->_tpl_vars['file_result']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['result_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['result_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['result_loop']['iteration']++;
?>
              <div><?php echo sprintf(SELanguage::_get($this->_tpl_vars['v']['message']), $this->_tpl_vars['v']['file_name']); ?></div>
            <?php endforeach; endif; unset($_from); ?>
          </div>
        </td>
      </tr>
    </table>
  <?php endif; ?>

  <form action='<?php echo $this->_tpl_vars['action']; ?>
' method='POST' enctype='multipart/form-data' id='uploadForm' onSubmit='startStatus()'>

    <div id='div1'>
      <table cellpadding='0' cellspacing='0' class='form'>
      <tr>
      <td class='form1' width='65'><?php echo SELanguage::_get(1184); ?></td>
      <td class='form2'><input type='file' name='file1' size='60' class='text' onchange="<?php if ($this->_tpl_vars['user_upload_max_files'] > 1): ?>$('div2').style.display = 'block';<?php endif; ?>$('div_submit').style.display = 'block';"></td>
      </tr>
      </table>
    </div>

    <div id='div2' style='display: none;'>
      <table cellpadding='0' cellspacing='0' class='form'>
      <tr>
      <td class='form1' width='65'><?php echo SELanguage::_get(1185); ?></td>
      <td class='form2'><input type='file' name='file2' size='60' class='text'<?php if ($this->_tpl_vars['user_upload_max_files'] > 2): ?> onchange="$('div3').style.display = 'block';"<?php endif; ?>></td>
      </tr>
      </table>
    </div>

    <div id='div3' style='display: none;'>
      <table cellpadding='0' cellspacing='0' class='form'>
      <tr>
      <td class='form1' width='65'><?php echo SELanguage::_get(1186); ?></td>
      <td class='form2'><input type='file' name='file3' size='60' class='text'<?php if ($this->_tpl_vars['user_upload_max_files'] > 3): ?> onchange="$('div4').style.display = 'block';"<?php endif; ?>></td>
      </tr>
      </table>
    </div>

    <div id='div4' style='display: none;'>
      <table cellpadding='0' cellspacing='0' class='form'>
      <tr>
      <td class='form1' width='65'><?php echo SELanguage::_get(1187); ?></td>
      <td class='form2'><input type='file' name='file4' size='60' class='text'<?php if ($this->_tpl_vars['user_upload_max_files'] > 4): ?> onchange="$('div5').style.display = 'block';"<?php endif; ?>></td>
      </tr>
      </table>
    </div>

    <div id='div5' style='display: none;'>
      <table cellpadding='0' cellspacing='0' class='form'>
      <tr>
      <td class='form1' width='65'><?php echo SELanguage::_get(1188); ?></td>
      <td class='form2'><input type='file' name='file5' size='60' class='text'></td>
      </tr>
      </table>
    </div>

    <div id='div_submit' style='display: none;'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td class='form1' width='65'>&nbsp;</td>
      <td class='form1'>
        <input type='submit' class='button' name='submit' value='<?php echo SELanguage::_get(1189); ?>' id='fallback_submit'>&nbsp;
        <input type='hidden' name='task' value='doupload'>
        <input type='hidden' name='MAX_FILE_SIZE' value='<?php echo ((is_array($_tmp=@$this->_tpl_vars['user_upload_max_size'])) ? $this->_run_mod_handler('default', true, $_tmp, 5000000) : smarty_modifier_default($_tmp, 5000000)); ?>
'>
	<?php $_from = $this->_tpl_vars['inputs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['input_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['input_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['input_loop']['iteration']++;
?>
	  <input type='hidden' name='<?php echo $this->_tpl_vars['k']; ?>
' value='<?php echo $this->_tpl_vars['v']; ?>
'>
        <?php endforeach; endif; unset($_from); ?>
      </td>
      <td class='form2'>
        &nbsp;<input type='text' class='fallback_status' name='status' id='fallback_status' readonly='readonly'>
      </td>
      </tr>
      </table>
    </div>

  </form>
</div>