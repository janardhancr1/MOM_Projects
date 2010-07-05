
{* $Id: profile_poll.tpl 12 2009-01-11 06:04:12Z john $ *}

{* BEGIN POLLS *}
{if $owner->level_info.level_recipe_allow != 0 && $total_recipes > 0}

  <table cellpadding='0' cellspacing='0' width='100%' style='margin-bottom: 10px;'>
    <tr>
      <td class='header'>
        {lang_print id=7000005} ({$total_recipes})
        {* IF MORE THAN 5 polls, SHOW VIEW MORE LINKS *}
        {if $total_recipes > 5}&nbsp;[ <a href='{$url->url_create("recipes", $owner->user_info.user_username)}'>{lang_print id=1021}</a> ]{/if}
      </td>
    </tr>
    <tr>
      <td class='profile'>
        {* LOOP THROUGH FIRST 5 recipe LISTINGS *}
        {section name=recipe_loop loop=$recipes}
        <table cellpadding='0' cellspacing='0' width='100%'>
          <tr>
            <td valign='top' width='1'><img src='./images/icons/recipe_recipe16.png' border='0' class='icon'></td>
            <td valign='top'>
              <div><a href='{$url->url_create("recipe", $owner->user_info.user_username, $recipes[recipe_loop].recipe_id)}'>{if $recipes[recipe_loop].recipe_name == ""}{lang_print id=589}{else}{$recipes[recipe_loop].recipe_name|truncate:30:"...":true|choptext:20:"<br>"}{/if}</a></div>
              <div style='color: #888888;'>{$recipes[recipe_loop].recipe_views} Views</div>
            </td>
          </tr>
        </table>
          {if $smarty.section.recipe_loop.last != true}<div style='font-size: 1pt; margin-top: 2px; margin-bottom: 2px;'>&nbsp;</div>{/if}
        {/section}
      </td>
    </tr>
  </table>

{/if}