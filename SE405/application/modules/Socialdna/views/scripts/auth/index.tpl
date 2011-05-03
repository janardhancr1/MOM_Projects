<div class='layout_middle'>
<center>
<table cellpadding=0 cellpadding=0 width="50%" align="center">
<tr>
<td style="text-align:center;padding-bottom:10px">
	<h3>It's easy to be a part of the Momburbia Community.<br/>
If you have a login, type it in or login using your Facebook.</h3>
</td>
</tr>
<tr>
<td style="padding-left:50px">
<?php echo $this->form->render($this) ?>
</td>
</tr>
<tr>
<td style='vertical-align: top;padding-left:50px'>
<br>
  <?php
  // nasty
  global $socialdna_social_login_title_text;
  $socialdna_social_login_title_text = 'socialdna_login_using';

  echo $this->content()->renderWidget('socialdna.social-facebook');
  ?>
 <br />
</td>
</tr>
</table>
</center>
</div>