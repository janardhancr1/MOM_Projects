<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Forum
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: add-moderator.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Sami
 */
?>
<div class="global_form_popup">
  <h3><?php echo $this->translate("Add Moderator") ?></h3>
  <p>
    <?php echo $this->translate("Search for a member to add as a moderator for this forum.") ?>
  </p>
  <br />
  <?php echo $this->form->setAttrib('class', '')->render($this) ?>
  <form id='add_moderator_form' action="<?php echo $this->url();?>" method="POST">
  <input id="moderator_id" name="moderator_id" type=hidden />
  </form>
  <ul class="forum_admin_manage_users" id="user_list"></ul>
</div>


<script type="text/javascript">

function addModerator(user_id)
{
  $('moderator_id').value = user_id;
  $('add_moderator_form').submit();
}

function updateUsers(page_number)
{
  var request = new parent.Request.HTML({
    url : '<?php echo $this->url(array('module' => 'forum', 'controller' => 'manage', 'action' => 'user-search'), 'admin_default', true);?>',
    method: 'GET',
    data : {
      format : 'html',
      page : '1',
      forum_id : <?php echo $this->forum->getIdentity();?>,
      username : $('username').value
    },
    'onSuccess' : function(responseTree, responseElements, responseHTML, responseJavaScript)
    {
      if (responseHTML.length > 0) 
      {
        $('user_list').style.display = 'block';
      }
      else
      {
        $('user_list').style.display = 'none';
      }
      $('user_list').innerHTML = responseHTML;
      parent.Smoothbox.instance.doAutoResize();
      return false;
    }
  });
  en4.core.request.send(request);
  return false;
}
</script>