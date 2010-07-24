<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    User
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: browse.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     Jung
 */
?>

<h2><?php echo $this->translate('Invite Moms');?></h2>

<div class='layout_left'>
  <?php echo $this->form->render($this) ?>
  <div class="quicklinks">
    <ul>
      <li>
        <a href='<?php echo $this->url(array(), 'invite_moms', true) ?>' class='buttonlink notification_type_message_new'><?php echo $this->translate('Invite Moms');?></a>
      </li>
    </ul>
  </div>
</div>

<div class='layout_middle'>
 <h3>
 	<?php echo $this->translate('Invite Moms that you Know to Join');?>
 </h3>
 <?php echo $this->inviteForm->render($this) ?>
 <a href="javascript: void(0);" onclick="return addAnotherOption();" id="addOptionLink"><?php echo $this->translate("Add another Email Address") ?></a>
 <script type="text/javascript">
  //<!--
  var maxOptions = <?php echo $this->maxOptions ?>;
  window.addEvent('domready', function() {
    addAnotherOption(true); // display five boxes
    addAnotherOption(true); // to start with
    addAnotherOption(true); // 
    addAnotherOption(true); // 
    addAnotherOption(true); // 
  });

  function addAnotherOption(dontFocus) {
    if (maxOptions && $$('input.pollOptionInput').length >= maxOptions) {
      return !alert(new String('<?php echo $this->string()->escapeJavascript($this->translate("A maximum of %s email address are permitted.")) ?>').replace(/%s/, maxOptions));
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