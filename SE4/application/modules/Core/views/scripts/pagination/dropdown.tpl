<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: dropdown.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<?php if ($this->pageCount): ?>
<select id="paginationControl" size="1">
<?php foreach ($this->pagesInRange as $page): ?>
  <?php $selected = ($page == $this->current) ? ' selected="selected"' : ''; ?>
  <option value="<?php echo $this->url(array('page' => $page));?>"<?php echo $selected ?>>
    <?php echo $page; ?>
  </option>
<?php endforeach; ?>
</select>
<?php endif; ?>

<script type="text/javascript">
$('paginationControl').addEvent('change', function() {
    window.location = this.options[this.selectedIndex].value;
});
</script>