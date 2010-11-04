
<table cellpadding=0 cellpadding=0 width="100%">
<tr>
<td style='min-width: 500px'>
<?php echo $this->form->render($this) ?>
</td>
<td style='vertical-align: top'>

  <?php
  // nasty
  global $socialdna_social_login_title_text;
  $socialdna_social_login_title_text = 'socialdna_login_using';

  echo $this->content()->renderWidget('socialdna.social-login');
  ?>
  
</td>
</tr>
</table>
