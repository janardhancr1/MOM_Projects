
<h2><?php echo $this->translate("Social DNA Plugin") ?></h2>

<?php if( count($this->navigation) ): ?>
  <div class='tabs'>
    <?php
      // Render the menu
      //->setUlClass()
      echo $this->navigation()->menu()->setContainer($this->navigation)->render();
      
    ?>
  </div>
<?php endif; ?>

<script>
function openidconnect_facebook_focus_on_story(story) {
}
</script>


<div class='clear'>
  <div class='settings'>

      <div class="global_form" id="admin_settings_form">



        <form class="global_form" action='<?php echo $this->url(array('module'  => 'socialdna', 'controller' => 'feed'), 'admin_default') ?>' method='POST'>
        <div>
        <div>
        

        <h3><?php echo $this->translate("socialdna_admin_facebook_feed_stories") ?></h3>
        <p class="description">
          Feed story templates specify what and how will be published in the social networks activities stream.
          <br>
          For Help on Feed Stories, please see <a href="<?php echo $this->url(array('module'  => 'socialdna', 'controller' => 'help'), 'admin_default') ?>">Help Tab</a>
        </p>

        <div ZZclass="table">
        
          <div ZZstyle='padding: 5px'>
        
          <div id="feed_story_templates">
        
          <table cellpadding='3' cellspacing='0' width='100%'>
          <?php foreach($this->openidconnect_facebook_feed_actions as $feedstory): ?>
            <tr>
            <td id="feedstory_<?php echo $feedstory['feedstory_type'] ?>" colspan="2" Xclass='setting1' style='background-color: white; padding: 10px; border-bottom: 1px solid #DDD; border-top: 1px solid #DDD'>
              <br>
              <span style="font-size: 16px; font-weight: bold"><?php echo $this->translate($feedstory['feedstory_desc']) ?>  </span>
              <br><br>
            </td>
            </tr>
            <tr>
            <td valign='top' style='padding: 10px;'>
              <b>User Prompt - will be displayed in the publishing dialog</b>
              <input type='text' name='feedstory[<?php echo $feedstory['feedstory_id'] ?>][feedstory_userprompt]' style='width: 100%;' class='text' value='<?php echo $feedstory['feedstory_userprompt'] ?>'>
              <br>
              <br>
                
              <b>User Message - will be displayed as a suggestion in the publishing dialog</b>
              <textarea name='feedstory[<?php echo $feedstory['feedstory_id'] ?>][feedstory_usermessage]' rows='3' style='width: 100%;' class='text'><?php echo $feedstory['feedstory_usermessage'] ?></textarea>
              <br>
              <br>
              <br>
        
              <b>Feed Story Title</b>
              <textarea name='feedstory[<?php echo $feedstory['feedstory_id'] ?>][feedstory_title]' rows='3' style='width: 100%;' class='text'><?php echo $feedstory['feedstory_metadata']['feedstory_title'] ?></textarea>
              <br>
                Available Variables: <?php echo $feedstory['feedstory_vars'] ?><br />
              <br>
                
              <b>Feed Story Body</b>
              <textarea name='feedstory[<?php echo $feedstory['feedstory_id'] ?>][feedstory_body]' rows='4' style='width: 100%;' class='text'><?php echo $feedstory['feedstory_metadata']['feedstory_body'] ?></textarea>
              <br>
                Available Variables: <?php echo $feedstory['feedstory_vars'] ?><br />
              <br>
        
              <b>Feed Story Link</b>
              <input type='text' name='feedstory[<?php echo $feedstory['feedstory_id'] ?>][feedstory_href]' style='width: 100%;' class='text' value='<?php echo $feedstory['feedstory_metadata']['feedstory_href'] ?>'>
              <br>
                Available Variables: <?php echo $feedstory['feedstory_vars'] ?><br />
        
              <br><br>
        
              <b>Action Link - Link</b>
              <input type='text' name='feedstory[<?php echo $feedstory['feedstory_id'] ?>][feedstory_link_link]' style='width: 100%;' class='text' value='<?php echo $feedstory['feedstory_metadata']['feedstory_link_link'] ?>'>
              <br>
                Available Variables: <?php echo $feedstory['feedstory_vars'] ?><br />
              <br>
                
              <b>Action Link - Text</b>
              <textarea name='feedstory[<?php echo $feedstory['feedstory_id'] ?>][feedstory_link_text]' rows='3' style='width: 100%;' class='text'><?php echo $feedstory['feedstory_metadata']['feedstory_link_text'] ?></textarea>
              <br>
                Available Variables: <?php echo $feedstory['feedstory_vars'] ?><br />
              <br>
        
              <input type='hidden' name='feedstory[<?php echo $feedstory['feedstory_id'] ?>][feedstory_type]' value='<?php echo $feedstory['feedstory_type'] ?>'>
              
              <br>
              <br>
              <input name='feedstory[<?php echo $feedstory['feedstory_id'] ?>][feedstory_enabled]' id='feedstory_enabled_<?php echo $feedstory['feedstory_id'] ?>' type='checkbox' value='1' <?php if ($feedstory['feedstory_enabled'] == 1): ?> checked='checked'<?php endif; ?>> <label for='feedstory_enabled_<?php echo $feedstory['feedstory_id'] ?>'>Enabled</label><br>
        
            </td>
            <td valign='top' width='80' nowrap="nowrap" style='padding-left: 10px; padding-right: 10px'>
              <b>Story Type</b><br />
              <?php echo $feedstory['feedstory_type'] ?>
            </td>
            </tr>
            <tr>
            <td colspan='2' style='padding-bottom: 50px;'>
            </td>
            </tr>
          <?php endforeach; ?>
          </table>
        
        </div>
        
        </div>
        </div>
        
        
          
        
        <div class="form-wrapper">
          <!--<div class="form-label">&nbsp;</div>-->
          <div class="form-element">
          <button type="submit" id="submit" name="submit"><?php echo $this->translate("Save Changes") ?></button>
          </div>
        </div>

      
      
        </div>
        </div>
          
        </form>






      
      </div>

  </div>
</div>



