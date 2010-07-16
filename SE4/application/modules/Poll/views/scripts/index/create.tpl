<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 6336 2010-06-15 00:56:20Z steve $
 * @author     Steve
 */
?>
<!--
<div class="headline">
  <h2>
    <?php echo $this->translate('Polls');?>
  </h2>
  <div class="tabs">
    <?php
      // Render the menu
      echo $this->navigation()
        ->menu()
        ->setContainer($this->navigation)
        ->render();
    ?>
  </div>
</div>
-->
<div class='layout_right'>
<div class="generic_layout_container layout_core_ad_campaign">
<script type="text/javascript">

 function processClick(adcampaign_id, ad_id) {
    (new Request.JSON({
      'format': 'json',
      'url' : '/utility/advertisement',
      'data' : {
        'format' : 'json',
        'adcampaign_id' : adcampaign_id,
        'ad_id' : ad_id
      },
      'onRequest' : function(){
      },
      'onSuccess' : function(responseJSON, responseText)
      {
      }
    })).send();

  }
</script>
<div style="float:right;color:#B2BCC0;font-family:Georgia;font-size:10px;">Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="clear:both;"></div>
<div style="vertical-align: middle;" onclick="javascript:processClick(2, 2)">
  <a href='' target='_blank'><img src='/public/user/1000000/1000/1/3.gif'/></a></div></div>

<div class="generic_layout_container layout_core_ad_campaign">
<script type="text/javascript">

 function processClick(adcampaign_id, ad_id) {
    (new Request.JSON({
      'format': 'json',
      'url' : '/utility/advertisement',
      'data' : {
        'format' : 'json',
        'adcampaign_id' : adcampaign_id,
        'ad_id' : ad_id
      },
      'onRequest' : function(){
      },
      'onSuccess' : function(responseJSON, responseText)
      {
      }
    })).send();

  }

</script>
<div style="float:right;color:#B2BCC0;font-family:Georgia;font-size:10px;">Advertisement&nbsp;&nbsp;&nbsp;&nbsp;</div>
<div style="clear:both;"></div>
<div style="vertical-align: middle;" onclick="javascript:processClick(3, 3)">
  <a href='' target='_blank' style='border-bottom: 1px solid #DDDDDD'><img src='/public/user/1000000/1000/1/5.gif'/></a></div></div>
</div>

<div class='layout_middle'>
<div class="headline_header">
	<img src='./application/modules/Poll/externals/images/poll_poll48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Create Poll');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/polls/manage'>Back to My Polls</a></div>
    </div>
    <div class="smallheadline"><?php echo $this->translate('Create your poll below, then click "Create Poll" to start your poll.');?></div>
</div>

<div class='global_form'>
  <?php echo $this->form->render($this) ?>
  <a href="javascript: void(0);" onclick="return addAnotherOption();" id="addOptionLink"><?php echo $this->translate("Add another option") ?></a>
  <script type="text/javascript">
  //<!--
  var maxOptions = <?php echo $this->maxOptions ?>;
  window.addEvent('domready', function() {
    addAnotherOption(true); // display two boxes
    addAnotherOption(true); // to start with
  });

  function addAnotherOption(dontFocus) {
    if (maxOptions && $$('input.pollOptionInput').length >= maxOptions) {
      return !alert(new String('<?php echo $this->string()->escapeJavascript($this->translate("A maximum of %s options are permitted.")) ?>').replace(/%s/, maxOptions));
      return false;
    }
    
    var optionElement = new Element('input', {
      'type': 'text',
      'name': 'optionsArray[]',
      'class': 'pollOptionInput',
      'value': '',
      'events': {
        'keydown': function(event){
          if (event.key == 'enter') {
            if (this.get('value').trim().length > 0) {
              addAnotherOption();
              return false;
            } else
              return true;
          } else
            return true;
        } // end keypress event
      } // end events
    });
    var optionParent  = $('options').getParent();
    if (dontFocus)
      optionElement.inject(optionParent);
    else
      optionElement.inject(optionParent).focus();
    
    $('addOptionLink').inject(optionParent);

    if (maxOptions && $$('input.pollOptionInput').length >= maxOptions)
      $('addOptionLink').destroy();

    return false;
  }
  // -->
  </script>
</div>
</div>