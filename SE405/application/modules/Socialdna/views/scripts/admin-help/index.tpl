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

<script type="text/javascript">
  function socialdna_faq_show(id,focus) {
    if(typeof focus == 'undefined') {
      focus = 0;
    }
    
    if($(id).style.display == 'block') {
      $(id).style.display = 'none';
    } else {
      $(id).style.display = 'block';
      if(focus) {
        socialdna_faq_focus(id);
      }
    }
  }
  function socialdna_faq_focus(id) {
    var myFx = new Fx.Scroll($(document.body));
    myFx.toElement(id); 
  }
</script>


<p>
  <?php echo $this->translate("Find some quick answers and information that will guide you on using the Social DNA / OpenID Connect plugin") ?>
</p>

<br />


<div class="admin_statistics">

  <h3> General </h3>
  <br>

  <div class='socialdna_faq_q' onclick="socialdna_faq_show('socialdna_faq_0')">
    <?php echo $this->translate('Getting Started') ?>
  </div>
  <div class='socialdna_faq_a' style='display: none;' id='socialdna_faq_0'>

    <table cellpadding='0' cellspacing='0' style='margin-top: 5px;'>
    <tr>
    <td class='step'>1</td>
    <td><b> <a href="<?php echo $this->url(array('controller' => 'settings'),'admin_default') ?>">Enter</a> </b> Social DNA API Key and other settings. These can be obtained from the client area, under license information.</a></b></td>
    </tr>
    <tr>
    <td class='step'>2</td>
    <td>
      <b><a href='javascript:void(0)' onclick="socialdna_faq_show('socialdna_faq_20',1)">Create Facebook Application</a></b>, and enter Facebook api key / secret (<a href="<?php echo $this->url(array('controller' => 'facebook'),'admin_default') ?>">here</a>) which you have received after creating the application. <br>This will establish your brand on Facebook. You can upload your logo and allow your users to clearly associate your brand with your site. <br>Create other applications for your website (optional) - LinkedIn, Twitter. This will better promote your brand and bring more traffic to your website via backlinks.
      <br>
        <b><u>Important</u></b>: Make sure to disable the native SocialEngine Facebook Integration (<a href="<?php echo $this->url(array('module' => 'user', 'controller' => 'settings', 'action' => 'facebook'),'admin_default') ?>">here</a>)
    </td>
    </tr>
    <tr>
    <td class='step'>3</td>
    <td><a href='javascript:void(0)' onclick="socialdna_faq_show('socialdna_faq_1',1)">Place the Social Login icons on your site homepage</a></td>
    </tr>
    <tr>
    <td class='step'>4</td>
    <td>
      <div style='margin-bottom: 2px; margin-top: 2px'>
        <a href='javascript:void(0)' onclick="socialdna_faq_show('socialdna_faq_40',1)">Perform a small template change to make Internet Explorer happy</a>
      </div>
        This change will correctly display the Facebook Controls, such as Invitation Control, which would not be rendered correctly otherwise
    </td>
    </tr>
    <?php if(Engine_Api::_()->getDbTable('modules','core')->hasModule('socialdnapublisher')) : ?>
    <tr>
    <td class='step'>5</td>
    <td><b><a href='<?php echo $this->url(array('controller' => 'feed'),'admin_default') ?>'>Customize your Newsfeed stories</a></b><br>You can easily customize the story text from your Social Engine Recent Activity Feed.</td>
    </tr>
    <?php endif; ?>
    </table>
    
  </div>

  <div class='socialdna_faq_q' onclick="socialdna_faq_show('socialdna_faq_1')">
    <?php echo $this->translate('Showing Social Signup widget on global site homepage') ?>
  </div>
  <div class='socialdna_faq_a' style='display: none;' id='socialdna_faq_1'>
    <img src="application/modules/Socialdna/externals/images/help/1.png">
  </div>

  <div class='socialdna_faq_q' onclick="socialdna_faq_show('socialdna_faq_2')">
    <?php echo $this->translate('How can I create Applications for my website (Twitter, LinkedIn, ...) ?') ?>
  </div>
  <div class='socialdna_faq_a' style='display: none;' id='socialdna_faq_2'>
    Please visit the <a target=_blank href="http://www.socialenginemods.net/plugins/openid-connect/docs/apps.html"> following link </a> for instructions.
  </div>

  


  <br>
  <br>
  <h3> Facebook </h3>
  <br>

  <div class='socialdna_faq_q' onclick="socialdna_faq_show('socialdna_faq_20')">
    <?php echo $this->translate('How can I create a Facebook Application?') ?>
  </div>
  <div class='socialdna_faq_a' style='display: none;' id='socialdna_faq_20'>

    To create a facebook application and receive api_key and secret pair: <br><br>
    
    Navigate to the Facebook page <a href="http://www.facebook.com/developers">http://www.facebook.com/developers</a> 
    
    and follow the steps  - you only need api_key and secret. <br><br>
    
    You only need to modify your app logo / icon. Leave the rest as is, it is configured automatically from SocialEngine admin panel.
    
    <br><br>
      
      <strong>If you prefer us to setup the application for you, please purchase Facebook Application setup service <a target="_blank" href="http://www.socialenginemods.net/shop"> here </a> </strong>

  </div>

  <div class='socialdna_faq_q' onclick="socialdna_faq_show('socialdna_faq_21')">
    <?php echo $this->translate('Inviting Friends via Facebook (or why I can only invite 2 friends?)') ?>
  </div>
  <div class='socialdna_faq_a' style='display: none;' id='socialdna_faq_21'>
    After signing up user can invite his Facebook Friends using Facebook invitation dialog. The invitations will appear as a notification in Facebook (The invitation will <u>not</u> reach user email or inbox). The amount of invitations is limited to a small number that will increase depending on user's friends' acceptance of the invitation requests. The maximum cap can be around 20 friends at once.
    
    <br><br>
      For professional invitation solution which does not have these limitations, please see our <a target="_blank" href="http://www.socialenginemods.net/social-engine/plugins/1/friends-inviter-contacts-importer">Friends Inviter plugin with Social Networks</a>, which allows inviting unlimited number of friends, in controlled manner, without spamming or being marked as a spammer.
  </div>

<!--
  <div class='socialdna_faq_q' onclick="socialdna_faq_show('socialdna_faq_22')">
    <?php echo $this->translate('Importing existing Facebook users') ?>
  </div>
  <div class='socialdna_faq_a' style='display: none;' id='socialdna_faq_22'>
  </div>
-->


<?php if(Engine_Api::_()->getDbTable('modules','core')->hasModule('socialdnapublisher')) : ?>
  <br>
  <br>
  <h3> Newsfeed stories publishing </h3>
  <br>

  <div class='socialdna_faq_q' onclick="socialdna_faq_show('socialdna_faq_30')">
    What is a news feed story and how is it created from my website?
  </div>
  <div class='socialdna_faq_a' style='display: none;' id='socialdna_faq_30'>

    Newsfeed story is created on user's social network stream (such as on Facebook Wall, Twitter stream, Myspace, etc) and is very similar to the Social Engine Recent Activity Feed. Every story can have various tags / variables parameters the are replaced when the story is published. For example, the standard {*actor*} variable is replaced by the current User Name; For "New Group", the {*group-title*}, {*group-desc*}, etc will be substituted with the actual group information.
    <br>
      The following variables can be used everywhere:
      <br>
        <ul>
          <li> {*site-name*} - Your public site name (<?php echo Semods_Utils::getSetting('core.general.site.title') ?>)
          <li> {*site-link*} - Link to your site root, this is the link: <?php echo "http://{$_SERVER['HTTP_HOST']}" . Zend_Controller_Front::getInstance()->getRouter()->assemble(array(), 'default'); ?>
        </ul>
    <br>
    When user on your website performs an activity that is registered in <a href="<?php echo $this->url(array('controller' => 'feed'),'admin_default') ?>">Publisher Feed Stories</a>, he will have an option to publish this activity to connected social network (Facebook, Twitter, etc) where his friends can react, comment and use the links to find your website, thus increasing interactivity and social participation.

  </div>
<?php endif; ?>


  <br>
  <br>
  <h3> Integration </h3>
  <br>

  <div class='socialdna_faq_q' onclick="socialdna_faq_show('socialdna_faq_40')">
    Applying xmlns template edit - mandatory 
  </div>
  <div class='socialdna_faq_a' style='display: none;' id='socialdna_faq_40'>

    The following change is required for Internet Explorer browser to correctly show various Facebook controls, such as invitation dialog.
    <br>
    Note: You will have to reapply this edit every time your SE platform is updated. 
    
    <br><br>
    Open application/modules/Core/layouts/scripts/default.tpl
    <br>
    <br>
      
    FIND
    
    <br>
    <br>
      
    <div class='code'>
      &lt;html xmlns="http://www.w3.org/1999/xhtml"
    </div>

    <br>
    <br>
    
    REPLACE WITH

    <br>
    <br>
      
    <div class='code'>
      &lt;html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml"
    </div>

    <br>
    <br>

  </div>



  <br>
  <br>
  <h3> Troubleshooting </h3>
  <br>

  <div class='socialdna_faq_q' onclick="socialdna_faq_show('socialdna_faq_100')">
    I have some other problem...
  </div>
  <div class='socialdna_faq_a' style='display: none;' id='socialdna_faq_100'>

    Please visit our <a target="_blank" href="http://www.socialenginemods.net/clients">client area</a> and open a support ticket.
    <br><br>
    You can also visit our <a href="http://community.socialenginemods.net">community support forums</a>.

  </div>



</div>

<?php if($this->show !== ''): ?>
<script type="text/javascript">
<?php $faq_focus = ($this->show > 10) ? 1 : 0; ?>

en4.core.runonce.add(function() {
  socialdna_faq_show('socialdna_faq_<?php echo $this->show ?>',<?php echo $faq_focus ?>);
});
</script>
<?php endif; ?>