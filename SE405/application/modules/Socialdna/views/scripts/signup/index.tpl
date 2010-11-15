<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>
<div class='layout_middle'>
<h2><?php echo $this->title ?></h2>
<script type="text/javascript">
  function skipForm()
  {
    document.getElementById("skip").value = "skipForm";
    $('SignupForm').submit();
  }
  function finishForm()
  {
    document.getElementById("nextStep").value = "finish";
  }
</script>

<table cellpadding=0 cellpadding=0 width="100%">
<tr>
<td>
<?php echo $this->partial($this->script[0], $this->script[1], array(
  'form' => $this->form
)) ?>
</td>
<td style='vertical-align: top'>

  <?php
  echo $this->content()->renderWidget('socialdna.social-login')
  ?>
  
</td>
</tr>
</table>
</div>