{include file='header.tpl'}

{* $Id: user_recipe_new.tpl 12 2009-01-11 06:04:12Z john $ *}
<div style='float: left; width: 685px; padding: 0px 5px 5px 5px;'>
<div class='page_header'>Add Recipe Photo - <a href='recipe.php?user={$recipe_info.user_name}&recipe_id={$recipe_info.recipe_id}'>{$recipe_info.recipe_name}</a></div>

<table cellpadding='0' cellspacing='0' style="padding:0px 2px 0px 2px">
<tr>
<td width='100%'>
  <div>{lang_print id=1000088}</div>
</td>
<td align='right' valign='top'>

  <table cellpadding='0' cellspacing='0' width='130'>
  <tr><td class='button' nowrap='nowrap'><a href='recipe.php?user={$recipe_info.user_name}&recipe_id={$recipe_info.recipe_id}'><img src='./images/icons/back16.gif' border='0' class='button'>Back to Recipe</a></td></tr>
  </table>

</td>
</tr>
<tr>
	<td colspan="2">You may upload files of the following types: jpg, gif, jpeg, png, bmp
	<br>You may upload files with sizes up to 2000 KB.</td>	
</tr>
<tr>
	<td colspan="2">&nbsp;</td>	
</tr>
</table>
<form action="" method="post" enctype='multipart/form-data'>
<input type="hidden" name="task" value="doupload">
<table cellpadding='0' cellspacing='0' style="padding:0px 2px 0px 2px">
<tr>
	<td width="10%">&nbsp;</td>
	<td widht="90%"><input type="file" name="recipe_photo" size='60' class='text'></td>
</tr>
<tr>
	<td colspan="2">&nbsp;</td>	
</tr>
<tr>
	<td colspan="2" align="center"><input type='submit' class='button' name='submit' value='Upload' id='fallback_submit'></td>	
</tr>
</table>
</form>
</div>
{include file='rightside.tpl'}
<div style='clear: both; height: 10px;'></div>
{include file='footer.tpl'}