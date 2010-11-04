
<fb:serverfbml style="width: 100%">
  <script type="text/fbml">
  <fb:fbml>
  <fb:request-form action="<?php echo $this->openid_invite_facebook_action ?>"
          method="POST"
          invite="true"
          type="<?php echo $this->openid_invite_facebook_type ?>"
          content="<?php echo $this->openid_invite_facebook_content ?>"
          <fb:multi-friend-selector
                  max="<?php echo $this->openid_invite_facebook_max ?>"
                  showborder="false"
                  import_external_friends="false"
                  actiontext="<?php echo $this->openid_invite_facebook_actiontext ?>" />
  </fb:request-form>
  </fb:fbml>
  </script>
</fb:serverfbml>
