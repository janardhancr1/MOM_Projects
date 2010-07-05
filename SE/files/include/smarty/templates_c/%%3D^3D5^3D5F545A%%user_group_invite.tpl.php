<?php /* Smarty version 2.6.14, created on 2010-05-26 14:28:50
         compiled from user_group_invite.tpl */
?><?php
SELanguage::_preload_multi(2000196,2000198,2000199,2000201,39,2000202,2000200);
SELanguage::load();
?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header_global.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 
 if ($this->_tpl_vars['result'] != 0): ?>

    <?php echo '
  <script type="text/javascript">
  <!-- 
  setTimeout("parent.TB_remove();", "1000");
  //-->
  </script>
  '; ?>


  <br><div><?php echo SELanguage::_get($this->_tpl_vars['result']); ?></div>

<?php else: ?>


  <div style='text-align:left;padding:10px;' id='inviteForm'>
    <div><?php echo SELanguage::_get(2000196); ?></div>

    <br>

    <form action='user_group_invite.php' method='post' onSubmit="if(totalInvited == 0) { alert('<?php echo SELanguage::_get(2000198); ?>'); return false; } else { return true; }">
    <div><a href='javascript:void(0);' onClick="doCheckAll()" id='select_all'><?php echo SELanguage::_get(2000199); ?></a></div>
    <div id='invite_friendlist' class='invite_friendlist'></div>
    <div style='margin-top: 20px;'>
      <table cellpadding='0' cellspacing='0'>
      <tr>
      <td>
        <input type='submit' class='button' id='inviteSubmit' value='<?php echo SELanguage::_get(2000201); ?>'>&nbsp;</td>
        <input type='hidden' name='group_id' value='<?php echo $this->_tpl_vars['group']->group_info['group_id']; ?>
'>
        <input type='hidden' name='task' value='invite_do'>
      </td>
      <td>
        <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove()'>
      </td>
      </tr>
      </table>
    </div>
    </form>
  </div>

  <div style='display:none;text-align:center;margin:10px;font-weight:bold;border: 1px dashed #CCCCCC;background: #FFFFFF;padding: 7px 8px 7px 7px;' id='noFriends'>
    <img src='./images/icons/bulb16.gif' class='icon'>
    <?php echo SELanguage::_get(2000202); ?><br><br>
    <input type='button' class='button' value='<?php echo SELanguage::_get(39); ?>' onClick='parent.TB_remove()'>
  </div>

    <?php echo '
  <script type="text/javascript">
  <!-- 
    window.addEvent(\'load\', function()
    {
      var request = new Request.JSON({
        secure: false,
        url: \'user_group_invite.php?task=friends_all&group_id='; 
 echo $this->_tpl_vars['group']->group_info['group_id']; 
 echo '\',
        onComplete: function(jsonObj)
        { 
          createFriendList(jsonObj.friends);
        }
      }).send();
    });

    function createFriendList(friends)
    {
      friends.each(function(friend)
      {
        for(var x in friend)
        {
          var newDiv = new Element("div", {\'id\' : \'friend_div_\'+x});
          
          var newCheckbox = new Element("input", {
            \'type\' : \'checkbox\', 
            \'id\' : \'friend_link_\'+x,
            \'name\' : \'invites[]\',
            \'value\' : x,
            \'class\' : \'checkbox\'
          }).inject(newDiv);
          
          var newLabel = new Element("label", {\'for\' : \'friend_link_\'+x,
            \'html\' : friend[x]
          }).inject(newDiv);

          newDiv.inject($(\'invite_friendlist\'));

          $(\'friend_link_\'+x).addEvent(\'change\', function()
          {
            if($(\'friend_link_\'+x).checked == true) { totalInvited++; } else { totalInvited--; }
          });
        }
      });

      if(friends.length == 0) { $(\'inviteForm\').style.display = \'none\'; $(\'noFriends\').style.display = \'block\'; }
    }

    var totalInvited = 0;
    var select = true;
    function doCheckAll()
    {
      $(\'invite_friendlist\').getElements(\'input[type=checkbox]\').each(function(el) {
        if(select == true && el.checked == false) {
          el.checked = true;
          totalInvited++;
        } else if(select == false && el.checked == true) {
          el.checked = false;
        }
      });
      if(select == false) { 
        select = true; 
        $(\'select_all\').setProperty(\'html\', \''; 
 echo SELanguage::_get(2000199); 
 echo '\');
      } else { 
        select = false; 
        $(\'select_all\').setProperty(\'html\', \''; 
 echo SELanguage::_get(2000200); 
 echo '\');
      }
    }

  //-->
  </script>
  '; 
 endif; ?>

</body>
</html>