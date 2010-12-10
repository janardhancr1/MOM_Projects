<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . '/application/modules/Semods/externals/scripts/semods.js')
    ->appendFile($this->baseUrl() . '/application/modules/Friendsinviter/externals/scripts/friendsinviter.js')
?>


<div id="friendsinviter_teaser">

  <form class="global_form" method="post" action="<?php echo $this->url(array('module' => 'core', 'controller' => 'invite'), 'default', true);?>">
  <input type="hidden" name="task" value="doinvitefriendsemail">
  <div>
    <div>
      <div class="form-elements">

        <div class="form-wrapper-heading" id="1_1_2-wrapper">
        <span class="field_container field_2 option_1 parent_1"><?php echo $this->translate("Find Your Friends") ?></span></div>


        <div class="form-wrapper" id="1_1_3-wrapper">
          <div class="form-label" id="1_1_3-label">
            <label class="required" for="1_1_3">&nbsp;</label>
          </div>
          <div class="form-element" id="1_1_3-element">

           <div class="friendsinviter_logo"><img src="application/modules/Friendsinviter/externals/images/brands/gmail_logo.gif"></div>
           <div class="friendsinviter_logo" Xstyle="padding-top: 7px"><img src="application/modules/Friendsinviter/externals/images/brands/yahoo_logo.gif"></div>
           <div class="friendsinviter_logo"><img src="application/modules/Friendsinviter/externals/images/brands/hotmail_logo.gif"></div>

          </div>
        </div>        

        <div class="form-wrapper" id="1_1_3-wrapper">
          <div class="form-label" id="1_1_3-label">
            <label class="required" for="1_1_3"><?php echo $this->translate('Your Email') ?></label>
          </div>
          <div class="form-element" id="1_1_3-element">
          <input type="text" class="field_container field_3 option_1 parent_1" value="" id="1_1_3" name="email">
          </div>
        </div>        

        <div class="form-wrapper" id="1_1_3-wrapper">
          <div class="form-label" id="1_1_3-label">
            <label class="required" for="1_1_3"><?php echo $this->translate('Email password') ?></label>
          </div>
        <div class="form-element" id="1_1_3-element">
        <input type="password" class="field_container field_3 option_1 parent_1" value="" id="1_1_3" name="pass"></div></div>        

        <div class="form-wrapper" id="submit-wrapper"><div class="form-label" id="submit-label">&nbsp;</div>
          <div class="form-element" id="submit-element">
            <button type="submit" id="submit" name="submit"><?php echo $this->translate('Find Friends') ?></button>
            <?php echo $this->translate('or') ?> <a href="javascript:void(0)" onclick="friendsinviter_hide_teaser()"><?php echo $this->translate('hide me') ?></a>
          </div>
          <div class="form-element" id="submit-element">
          </div>
        </div>


      </div>        
    </div>
  </div>
  </form>
  
</div>
