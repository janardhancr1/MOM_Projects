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