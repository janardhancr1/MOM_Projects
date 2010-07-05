{include file='admin_header.tpl'}

{* $Id: admin_levels_classifiedsettings.tpl 53 2009-02-06 04:55:08Z john $ *}

<h2>{lang_sprintf id=288 1=$level_info.level_name}</h2>
{lang_print id=282}

<table cellspacing='0' cellpadding='0' width='100%' style='margin-top: 20px;'>
<tr>
<td class='vert_tab0'>&nbsp;</td>
<td valign='top' class='pagecell' rowspan='{math equation="x+5" x=$level_menu|@count}'>

  <h2>{lang_print id=4500001}</h2>
  {lang_print id=4500012}
  <br />
  <br />
  
  
  {* SHOW SUCCESS MESSAGE *}
  {if $result != 0}
    <div class='success'><img src='../images/success.gif' class='icon' border='0'> {lang_print id=191}</div>
  {/if}
  
  {* SHOW ERROR MESSAGE *}
  {if $is_error != 0}
    <div class='error'><img src='../images/error.gif' class='icon' border='0'> {lang_print id=$is_error}</div>
  {/if}
  
  
  <form action='admin_levels_classifiedsettings.php' name='info' method='POST'>
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'>{lang_print id=4500013}</td>
    </tr>
    <tr>
      <td class='setting1'>{lang_print id=4500014}</td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><input type='radio' name='level_classified_allow' id='level_classified_allow_3' value='3'{if $level_info.level_classified_allow==3} checked{/if} />&nbsp;</td>
            <td><label for='level_classified_allow_3'>{lang_print id=4500156}</label></td>
          </tr>
          <tr>
            <td><input type='radio' name='level_classified_allow' id='level_classified_allow_1' value='1'{if $level_info.level_classified_allow==1} checked{/if} />&nbsp;</td>
            <td><label for='level_classified_allow_1'>{lang_print id=4500157}</label></td>
          </tr>
          <tr>
            <td><input type='radio' name='level_classified_allow' id='level_classified_allow_0' value='0'{if $level_info.level_classified_allow==0} checked{/if} />&nbsp;</td>
            <td><label for='level_classified_allow_0'>{lang_print id=4500158}</label></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'>{lang_print id=4500017}</td>
    </tr>
    
    <tr>
      <td class='setting1'>{lang_print id=4500018}</td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><input type='radio' name='level_classified_photo' id='level_classified_photo_1' value='1'{if  $level_info.level_classified_photo} checked{/if} />&nbsp;</td>
            <td><label for='level_classified_photo_1'>{lang_print id=4500019}</label></td>
          </tr>
          <tr>
            <td><input type='radio' name='level_classified_photo' id='level_classified_photo_0' value='0'{if !$level_info.level_classified_photo} checked{/if} />&nbsp;</td>
            <td><label for='level_classified_photo_0'>{lang_print id=4500020}</label></td>
          </tr>
        </table>
      </td>
    </tr>
    
    <tr>
      <td class='setting1'>{lang_print id=4500021}</td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td>{lang_print id=4500022} &nbsp;</td>
            <td><input type='text' class='text' name='level_classified_photo_width' value='{$level_info.level_classified_photo_width}' maxlength='3' size='3' /> &nbsp;</td>
            <td>{lang_print id=4500024}</td>
          </tr>
          <tr>
            <td>{lang_print id=4500023} &nbsp;</td>
            <td><input type='text' class='text' name='level_classified_photo_height' value='{$level_info.level_classified_photo_height}' maxlength='3' size='3' /> &nbsp;</td>
            <td>{lang_print id=4500024}</td>
          </tr>
        </table>
      </td>
    </tr>
    
    <tr>
      <td class='setting1'>{lang_print id=4500025}</td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td>{lang_print id=4500026} &nbsp;</td>
            <td><input type='text' class='text' name='level_classified_photo_exts' value='{$level_classified_photo_exts}' size='40' maxlength='50' /></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'>{lang_print id=4500027}</td>
    </tr>
    
    <tr>
      <td class='setting1'>{lang_print id=4500028}</td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
            <td><input type='text' class='text' size='2' name='level_classified_entries' maxlength='3' value='{$level_info.level_classified_entries}' /></td>
            <td>&nbsp; {lang_print id=4500029}</td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'>{lang_print id=4500030}</td>
    </tr>
    
    <tr>
      <td class='setting1'>{lang_print id=4500031}</td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
          <tr>
          <td><input type='radio' name='level_classified_search' id='classified_search_1' value='1'{if  $level_info.level_classified_search} checked{/if} /></td>
          <td><label for='classified_search_1'>{lang_print id=4500032}</label>&nbsp;&nbsp;</td>
          </tr>
          <tr>
          <td><input type='radio' name='level_classified_search' id='classified_search_0' value='0'{if !$level_info.level_classified_search} checked{/if} /></td>
          <td><label for='classified_search_0'>{lang_print id=4500033}</label>&nbsp;&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
    
    <tr>
      <td class='setting1'>{lang_print id=4500034}</td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
        {foreach from=$privacy_options key=k item=v}
          <tr>
            <td><input type='checkbox' name='level_classified_privacy[]' id='privacy_{$k}' value='{$k}'{if $k|in_array:$classified_privacy} checked{/if} /></td>
            <td><label for='privacy_{$k}'>{lang_print id=$v}</label>&nbsp;&nbsp;</td>
          </tr>
        {/foreach}
        </table>
      </td>
    </tr>
    
    <tr>
      <td class='setting1'>{lang_print id=4500035}</td>
    </tr>
    <tr>
      <td class='setting2'>
        <table cellpadding='0' cellspacing='0'>
        {foreach from=$comment_options key=k item=v}
          <tr>
            <td><input type='checkbox' name='level_classified_comments[]' id='comments_{$k}' value='{$k}'{if $k|in_array:$classified_comments} checked{/if} /></td>
            <td><label for='comments_{$k}'>{lang_print id=$v}</label>&nbsp;&nbsp;</td>
          </tr>
        {/foreach}
        </table>
      </td>
    </tr>
  </table>
  <br />
  

  <table cellpadding='0' cellspacing='0' width='600'>
  <tr>
    <td class='header'>{lang_print id=4500036}</td>
  </tr>
  
  <tr>
    <td class='setting1'>{lang_print id=4500037}</td>
  </tr>
  <tr>
    <td class='setting2'>
      <textarea name='level_classified_album_exts' rows='2' cols='40' class='text' style='width: 100%;'>{$level_classified_album_exts}</textarea>
    </td>
  </tr>
  
  <tr>
    <td class='setting1'>{lang_print id=4500038}</td>
  </tr>
  <tr>
    <td class='setting2'>
      <textarea name='level_classified_album_mimes' rows='2' cols='40' class='text' style='width: 100%;'>{$level_classified_album_mimes}</textarea>
    </td>
  </tr>
  
  <tr>
    <td class='setting1'>{lang_print id=4500039}</td>
  </tr>
  <tr>
    <td class='setting2'>
      <select name='level_classified_album_storage' class='text'>
        <option value='102400'{if $level_info.level_classified_album_storage == 102400} SELECTED{/if}>{lang_sprintf id=4500041 1=100}</option>
        <option value='204800'{if $level_info.level_classified_album_storage == 204800} SELECTED{/if}>{lang_sprintf id=4500041 1=200}</option>
        <option value='512000'{if $level_info.level_classified_album_storage == 512000} SELECTED{/if}>{lang_sprintf id=4500041 1=500}</option>
        <option value='1048576'{if $level_info.level_classified_album_storage == 1048576} SELECTED{/if}>{lang_sprintf id=4500042 1=1}</option>
        <option value='2097152'{if $level_info.level_classified_album_storage == 2097152} SELECTED{/if}>{lang_sprintf id=4500042 1=2}</option>
        <option value='3145728'{if $level_info.level_classified_album_storage == 3145728} SELECTED{/if}>{lang_sprintf id=4500042 1=3}</option>
        <option value='4194304'{if $level_info.level_classified_album_storage == 4194304} SELECTED{/if}>{lang_sprintf id=4500042 1=4}</option>
        <option value='5242880'{if $level_info.level_classified_album_storage == 5242880} SELECTED{/if}>{lang_sprintf id=4500042 1=5}</option>
        <option value='6291456'{if $level_info.level_classified_album_storage == 6291456} SELECTED{/if}>{lang_sprintf id=4500042 1=6}</option>
        <option value='7340032'{if $level_info.level_classified_album_storage == 7340032} SELECTED{/if}>{lang_sprintf id=4500042 1=7}</option>
        <option value='8388608'{if $level_info.level_classified_album_storage == 8388608} SELECTED{/if}>{lang_sprintf id=4500042 1=8}</option>
        <option value='9437184'{if $level_info.level_classified_album_storage == 9437184} SELECTED{/if}>{lang_sprintf id=4500042 1=9}</option>
        <option value='10485760'{if $level_info.level_classified_album_storage == 10485760} SELECTED{/if}>{lang_sprintf id=4500042 1=10}</option>
        <option value='15728640'{if $level_info.level_classified_album_storage == 15728640} SELECTED{/if}>{lang_sprintf id=4500042 1=15}</option>
        <option value='20971520'{if $level_info.level_classified_album_storage == 20971520} SELECTED{/if}>{lang_sprintf id=4500042 1=20}</option>
        <option value='26214400'{if $level_info.level_classified_album_storage == 26214400} SELECTED{/if}>{lang_sprintf id=4500042 1=25}</option>
        <option value='52428800'{if $level_info.level_classified_album_storage == 52428800} SELECTED{/if}>{lang_sprintf id=4500042 1=50}</option>
        <option value='78643200'{if $level_info.level_classified_album_storage == 78643200} SELECTED{/if}>{lang_sprintf id=4500042 1=75}</option>
        <option value='104857600'{if $level_info.level_classified_album_storage == 104857600} SELECTED{/if}>{lang_sprintf id=4500042 1=100}</option>
        <option value='209715200'{if $level_info.level_classified_album_storage == 209715200} SELECTED{/if}>{lang_sprintf id=4500042 1=200}</option>
        <option value='314572800'{if $level_info.level_classified_album_storage == 314572800} SELECTED{/if}>{lang_sprintf id=4500042 1=300}</option>
        <option value='419430400'{if $level_info.level_classified_album_storage == 419430400} SELECTED{/if}>{lang_sprintf id=4500042 1=400}</option>
        <option value='524288000'{if $level_info.level_classified_album_storage == 524288000} SELECTED{/if}>{lang_sprintf id=4500042 1=500}</option>
        <option value='629145600'{if $level_info.level_classified_album_storage == 629145600} SELECTED{/if}>{lang_sprintf id=4500042 1=600}</option>
        <option value='734003200'{if $level_info.level_classified_album_storage == 734003200} SELECTED{/if}>{lang_sprintf id=4500042 1=700}</option>
        <option value='838860800'{if $level_info.level_classified_album_storage == 838860800} SELECTED{/if}>{lang_sprintf id=4500042 1=800}</option>
        <option value='943718400'{if $level_info.level_classified_album_storage == 943718400} SELECTED{/if}>{lang_sprintf id=4500042 1=900}</option>
        <option value='1073741824'{if $level_info.level_classified_album_storage == 1073741824} SELECTED{/if}>{lang_sprintf id=4500043 1=1}</option>
        <option value='2147483648'{if $level_info.level_classified_album_storage == 2147483648} SELECTED{/if}>{lang_sprintf id=4500043 1=2}</option>
        <option value='5368709120'{if $level_info.level_classified_album_storage == 5368709120} SELECTED{/if}>{lang_sprintf id=4500043 1=5}</option>
        <option value='10737418240'{if $level_info.level_classified_album_storage == 10737418240} SELECTED{/if}>{lang_sprintf id=4500043 1=10}</option>
        <option value='0'{if $level_info.level_classified_album_storage == 0} SELECTED{/if}>{lang_print id=4500040}</option>
      </select>
    </td>
  </tr>
  
  <tr>
    <td class='setting1'>{lang_print id=4500044}</td>
  </tr>
  <tr>
    <td class='setting2'>
      <input type='text' class='text' size='5' name='level_classified_album_maxsize' maxlength='6' value='{$level_classified_album_maxsize}'> {lang_sprintf id=4500041 1=''}
    </td>
  </tr>
  
  <tr>
    <td class='setting1'>{lang_print id=4500045}</td>
  </tr>
  <tr>
    <td class='setting2'>
      <table cellpadding='0' cellspacing='0'>
        <tr>
          <td>{lang_print id=4500046} &nbsp;</td>
          <td><input type='text' class='text' name='level_classified_album_width' value='{$level_info.level_classified_album_width}' maxlength='4' size='3'> &nbsp;</td>
          <td>{lang_print id=4500048}</td>
        </tr>
        <tr>
          <td>{lang_print id=4500047} &nbsp;</td>
          <td><input type='text' class='text' name='level_classified_album_height' value='{$level_info.level_classified_album_height}' maxlength='4' size='3'> &nbsp;</td>
          <td>{lang_print id=4500048}</td>
        </tr>
      </table>
    </td>
  </tr>
  </table>
  <br />
  
  
  <table cellpadding='0' cellspacing='0' width='600'>
    <tr>
      <td class='header'>{lang_print id=4500140}</td>
    </tr>
    <tr>
      <td class='setting1'>{lang_print id=4500141}</td>
    </tr>
    <tr>
      <td class='setting2'>
        <input type='text' class='text' name='level_classified_html' value='{$level_classified_html}' size='60' />
      </td>
    </tr>
  </table>
  <br />
  
  
  {lang_block id=173 var=langBlockTemp}<input type='submit' class='button' value='{$langBlockTemp}' />{/lang_block}
  <input type='hidden' name='task' value='dosave' />
  <input type='hidden' name='level_id' value='{$level_info.level_id}' />
  </form>
  
</td>
</tr>

{* DISPLAY MENU *}
<tr><td width='100' nowrap='nowrap' class='vert_tab'><div style='width: 100px;'><a href='admin_levels_edit.php?level_id={$level_id}'>{lang_print id=285}</a></div></td></tr>
<tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;'><div style='width: 100px;'><a href='admin_levels_usersettings.php?level_id={$level_id}'>{lang_print id=286}</a></div></td></tr>
<tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;'><div style='width: 100px;'><a href='admin_levels_messagesettings.php?level_id={$level_id}'>{lang_print id=287}</a></div></td></tr>
{foreach from=$global_plugins key=plugin_k item=plugin_v}
{section name=level_page_loop loop=$plugin_v.plugin_pages_level}
  <tr><td width='100' nowrap='nowrap' class='vert_tab' style='border-top: none;{if $plugin_v.plugin_pages_level[level_page_loop].page == $page} border-right: none;{/if}'><div style='width: 100px;'><a href='{$plugin_v.plugin_pages_level[level_page_loop].link}?level_id={$level_info.level_id}'>{lang_print id=$plugin_v.plugin_pages_level[level_page_loop].title}</a></div></td></tr>
{/section}
{/foreach}

<tr>
<td class='vert_tab0'>
  <div style='height: 2500px;'>&nbsp;</div>
</td>
</tr>
</table>


{include file='admin_footer.tpl'}