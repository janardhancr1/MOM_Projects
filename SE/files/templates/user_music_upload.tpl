{include file='header.tpl'}

{* $Id: user_music_upload.tpl 59 2009-02-13 03:25:54Z john $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<table cellpadding='0' cellspacing='0' width='100%'>
  <tr>
    <td valign='top'>
      
      <img src='./images/icons/music_music48.gif' border='0' class='icon_big'>
      <div class='page_header'>{lang_print id=4000067}</div>
      <div>{lang_print id=4000068}</div>
      
    </td>
    <td valign='top' align='right'>
      
      <table cellpadding='0' cellspacing='0' width='150'>
      <tr><td class='button' nowrap='nowrap'><a href='user_music.php'><img src='./images/icons/back16.gif' border='0' class='button'>{lang_print id=4000069}</a></td></tr>
      </table>
      
    </td>
  </tr>
</table>
<br />


{if $files_left>0}

  <div style='float:left;'><img src='./images/icons/bulb16.gif' border='0' class='icon'></div><div style='float:left;'><b>{lang_print id=4000073}</b></div><br><br>


  <div>
    {lang_sprintf id=4000072 1=$space_left}<br />
    {lang_sprintf id=4000070 1=$max_filesize}<br />
    {lang_sprintf id=4000071 1=$allowed_exts}
  </div>
  <br />
  <br />


  {include file='user_upload.tpl' action='user_music_upload.php' session_id=$session_id upload_token=$upload_token show_uploader=$show_uploader inputs=$inputs file_result=$file_result}
{/if}

</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{include file='footer.tpl'}