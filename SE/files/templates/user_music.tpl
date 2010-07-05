{include file='header.tpl'}

{* $Id: user_music.tpl 11 2009-01-11 06:03:58Z john $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<img src='./images/icons/music_music48.gif' border='0' class='icon_big' style="margin-bottom: 15px;">
<div class='page_header'>{lang_print id=4000042}</div>
<div>
  {lang_print id=4000044}<br />
  {lang_sprintf id=4000088 1=$music_total}<br />
  {lang_sprintf id=4000072 1=$space_left}
</div>


{* SHOW BUTTONS *}
<div style='margin-top: 20px;'>
  <div class='button' style='float: left;'>
    <a href='user_music_upload.php'><img src='./images/icons/plus16.gif' border='0' class='button'>{lang_print id=4000047}</a>
  </div>
  <div class='button' style='float: left; padding-left: 20px;'>
    <a href='user_music_settings.php'><img src='./images/icons/music_settings16.gif' border='0' class='button'>{lang_print id=4000001}</a>
  </div>
  <div style='clear: both; height: 0px;'></div>
</div>
<br />


{* SHOW SONGS IF ANY EXIST *}
{if $musiclist}
  
  <div id="seMusicListContainer">
  
    {lang_javascript id=4000038}
    
    {literal}
    <script type="text/javascript" src="./include/js/class_music.js"></script>
    <script type="text/javascript">
      
      SocialEngine.Music = new SocialEngineAPI.Music();
      SocialEngine.RegisterModule(SocialEngine.Music);
      
    </script>
    {/literal}
    
    
    <form action='user_music.php' method='post'>
    {* HEADER *}
    <ul class="seMusicHeader" style='width: 550px;'>
      <li>
        <table cellpadding='0' cellspacing='0' class="seMusicRowInnerTable"><tr>
          <td class="seMusicMove">
          </td>
          <td class="seMusicDeleteCheckbox">
          </td>
          <td class="seMusicRowButton">
          </td>
          <td class='seMusicRowTitle'>
            {lang_print id=4000046}
          </td>
          <td class="seMusicRowFilesize" align='center'>
            {lang_print id=4000048}
          </td>
          <td class="seMusicRowActions" align='right'>
            {lang_print id=153}
          </td>
        </tr></table>
      </li>
    </ul>
    
    
    <ul class="userMusicList" style='width: 550px;'>
    
      {* SONGS *}
      {assign var='media_dir' value=$url->url_userdir($user->user_info.user_id)}
      {section name=music_loop loop=$musiclist}
      {assign var='media_path' value="`$media_dir``$musiclist[music_loop].music_id`.`$musiclist[music_loop].music_ext`"}
      
      <li id="seMusic_{$musiclist[music_loop].music_id}" class="seMusicRow">
        <table cellpadding='0' cellspacing='0' class="seMusicRowInnerTable"><tr>
          <td class="seMusicMove">
            <img src="./images/music_move.png" class="seMusicMoveHandle" />
          </td>
          
          <td class="seMusicDeleteCheckbox">
            <input type='checkbox' name='delete_music_{$musiclist[music_loop].music_id}' value='1' />
          </td>
          
          <td class="seMusicRowButton">
            <object width="17" height="17" data="./images/music_button.swf?song_url={$media_path}" type="application/x-shockwave-flash">
              <param value="./images/music_button.swf?song_url={$media_path}" name="movie" />
              <img width="17" height="17" alt="" src="noflash.gif" />
            </object>
          </td>
          
          <td class='seMusicRowTitle music_title' id="seMusicTitle_{$musiclist[music_loop].music_id}">
            <span class="seMusicID" style="display:none;">{$musiclist[music_loop].music_id}</span>
            <span class="seMusicTitle">{$musiclist[music_loop].music_title}</span>
            <span class="seMusicTitleEditor" style="display:none;"><input type="text" class="text" style="width: 250px;"/></span>
            <span class="seMusicTitleEdit">&nbsp;(<a href="javascript:void(0);" onclick="SocialEngine.Music.editMusicTitle({$musiclist[music_loop].music_id});">{lang_print id=187}</a>)</span>
            <span class="seMusicTitleSave" style="display:none;">&nbsp;(<a href="javascript:void(0);" onclick="SocialEngine.Music.saveMusicTitle({$musiclist[music_loop].music_id});">{lang_print id=746}</a>)</span>
            <span class="seMusicTitleCancel" style="display:none;">&nbsp;(<a href="javascript:void(0);" onclick="SocialEngine.Music.cancelMusicTitle({$musiclist[music_loop].music_id});">{lang_print id=747}</a>)</span>
          </td>
        
          <td class="seMusicRowFilesize" align='center'>
            {lang_sprintf id=4000049 1=$musiclist[music_loop].music_filesize}
          </td>
        
          <td class="seMusicRowActions" align='right' nowrap='nowrap'>
            {* MUSIC DELETE *}
            <span class="seMusicDelete"><a href="javascript:void(0);" onclick="SocialEngine.Music.deleteMusic({$musiclist[music_loop].music_id});">{lang_print id=155}</a>&nbsp;</span>
          </td>
        
        </tr></table>
      </li>
      {/section}
      
    </ul>
    <br />
    
    
    {* HIDDEN DIV TO DISPLAY DELETE CONFIRMATION MESSAGE *}
    <div style='display: none;' id='confirmmusicdelete'>
      <div style='margin-top: 10px;'>
        {lang_print id=4000039}
      </div>
      <br />
      {lang_block id=175 var=langBlockTemp}<input type='button' class='button' value='{$langBlockTemp}' onClick='parent.TB_remove();parent.SocialEngine.Music.deleteMusicConfirm(parent.SocialEngine.Music.currentConfirmDeleteID);' />{/lang_block}
      {lang_block id=39 var=langBlockTemp}<input type='button' class='button' value='{$langBlockTemp}' onClick='parent.TB_remove();' />{/lang_block}
    </div>
    
    
    {lang_block id=4000051 var=langBlockTemp}<input type='submit' class='button' value='{$langBlockTemp}' />{/lang_block}
    <input type='hidden' name='task' value='dodelete' />
    </form>
  
  </div>
  
{/if}


{* SHOW NO SONGS MESSAGE *}
<div id="musicnullmessage"{if $musiclist} style="display: none;"{/if}>
  <table cellpadding='0' cellspacing='0'><tr>
    <td class='result'><img src='./images/icons/bulb16.gif' border='0' class='icon'>{lang_print id=4000052}</td>
  </tr></table>
</div>

</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>

{include file='footer.tpl'}