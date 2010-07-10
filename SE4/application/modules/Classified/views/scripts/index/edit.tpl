<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Classified
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: edit.tpl 5333 2010-05-01 03:23:01Z alex $
 * @author     Jung
 */
?>

<?php
  $this->headScript()
    ->appendFile($this->baseUrl().'/externals/autocompleter/Observer.js')
    ->appendFile($this->baseUrl().'/externals/autocompleter/Autocompleter.js')
    ->appendFile($this->baseUrl().'/externals/autocompleter/Autocompleter.Local.js')
    ->appendFile($this->baseUrl().'/externals/autocompleter/Autocompleter.Request.js');
?>

<script type="text/javascript">
  en4.core.runonce.add(function()
  {
    new Autocompleter.Request.JSON('tags', '<?php echo $this->url(array('controller' => 'tag', 'action' => 'suggest'), 'default', true) ?>', {
      'postVar' : 'text',

      'minLength': 1,
      'selectMode': 'pick',
      'autocompleteType': 'tag',
      'className': 'tag-autosuggest',
      'filterSubset' : true,
      'multiple' : true,
      'injectChoice': function(token){
        var choice = new Element('li', {'class': 'autocompleter-choices', 'value':token.label, 'id':token.id});
        new Element('div', {'html': this.markQueryValue(token.label),'class': 'autocompleter-choice'}).inject(choice);
        choice.inputValue = token;
        this.addChoiceclassifieds(choice).inject(this.choices);
        choice.store('autocompleteChoice', token);
      }
    });
  });
</script>

<div class="headline">
  <h2>
    <?php echo $this->translate('Classified Listings');?>
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
<div class='search_box'>
	<div class='page_header'>
		<img src='./application/modules/Classified/externals/images/classified_classified48.gif' border='0' class='icon_big'><?php echo $this->translate('Post Classified Listing');?>
		<div>
			<?php echo $this->translate('Write your new listing below, then click "Post Listing" to publish the listing on your classified.');?>
		</div>
	</div>

</div>
<form action="<?php echo $this->escape($this->form->getAction()) ?>" method="<?php echo $this->escape($this->form->getMethod()) ?>" class="global_form classifieds_browse_filters">
  <div>
    <div>
      <h3> <?php echo $this->form->getTitle(); ?>   </h3>
    
      <div class="form-elements">
        <?php echo $this->form->title; ?>
        <?php echo $this->form->tags; ?>
        <?php if($this->form->category_id) echo $this->form->category_id; ?>
        <?php echo $this->form->body; ?>
        <?php echo $this->form->getSubForm('customField'); ?>
        <?php if($this->form->auth_view)echo $this->form->auth_view; ?>
        <?php if($this->form->auth_comment)echo $this->form->auth_comment; ?>
        <?php //echo print_r($this->form->getSubForm('customField')->getErrors('0_0_2')->render());?>

      </div>

      <?php echo $this->form->classified_id; ?>
      <ul class='classifieds_editphotos'>        
        <?php foreach( $this->paginator as $photo ): ?>
          <li>
            <div class="classifieds_editphotos_photo">
              <?php echo $this->itemPhoto($photo, 'thumb.normal')  ?>
            </div>
            <div class="classifieds_editphotos_info">
              <?php
                $key = $photo->getGuid();
                echo $this->form->getSubForm($key)->render($this);
              ?>
              <div class="classifieds_editphotos_cover">
                <input type="radio" name="cover" value="<?php echo $photo->getIdentity() ?>" <?php if( $this->classified->photo_id == $photo->file_id ): ?> checked="checked"<?php endif; ?> />
              </div>
              <div class="classifieds_editphotos_label">
                <label><?php echo $this->translate('Main Photo');?></label>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php echo $this->form->submit->render(); ?>
      
    </div>
  </div>
</form>


<?php if( $this->paginator->count() > 0 ): ?>
  <br />
  <?php echo $this->paginationControl($this->paginator); ?>
<?php endif; ?>