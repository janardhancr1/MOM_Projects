<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Poll
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: create.tpl 7244 2010-09-01 01:49:53Z john $
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
<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>
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
  var options = <?php echo Zend_Json::encode($this->options) ?>;
  
  window.addEvent('domready', function() {
    if( $type(options) == 'array' && options.length > 0 ) {
      options.each(function(label) {
        addAnotherOption(true, label);
      });
      if( options.length == 1 ) {
        addAnotherOption(true);
      }
    } else {
      // display two boxes to start with
      addAnotherOption(true);
      addAnotherOption(true);
    }
  });

  function addAnotherOption(dontFocus, label) {
    if (maxOptions && $$('input.pollOptionInput').length >= maxOptions) {
      return !alert(new String('<?php echo $this->string()->escapeJavascript($this->translate("A maximum of %s options are permitted.")) ?>').replace(/%s/, maxOptions));
      return false;
    }
    
    var optionElement = new Element('input', {
      'type': 'text',
      'name': 'optionsArray[]',
      'class': 'pollOptionInput',
      'value': label,
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