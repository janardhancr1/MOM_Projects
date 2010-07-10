<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: manage.tpl 6159 2010-06-05 02:12:43Z alex $
 * @author     Jung
 */
?>

<script type="text/javascript">
  var pageAction =function(page){
    $('page').value = page;
    $('filter_form').submit();
  }
</script>

<div class="headline">
  <h2>
    <?php echo $this->translate('Blogs');?>
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
		<img src='./application/modules/Blog/externals/images/blog_blog48.gif' border='0' class='icon_big'><?php echo $this->translate('My Blog Entries');?>
		<div class="mom_div_small">
			<?php echo $this->translate('Write your daily blog and read ones you have subscribed too ');?>
		</div>
	</div>
  <?php echo $this->form->render($this) ?>
  
  
</div>

<div>
    
  <?php if( $this->paginator->getTotalItemCount() > 0 ): ?>
    <ul class="blogs_browse">
      <?php foreach( $this->paginator as $item ): ?>
        <li>
          <div class='blogs_browse_photo'>
            <?php echo $this->htmlLink($item->getOwner()->getHref(), $this->itemPhoto($item->getOwner(), 'thumb.icon')) ?>
          </div>
          <div class='blogs_browse_options'>
            <a href='<?php echo $this->url(array('blog_id' => $item->blog_id), 'blog_edit', true) ?>' class='buttonlink icon_blog_edit'><?php echo $this->translate('Edit Entry');?></a>
            <a href='<?php echo $this->url(array('blog_id' => $item->blog_id), 'blog_delete', true) ?>' class='buttonlink icon_blog_delete'><?php echo $this->translate('Delete Entry');?></a>
          </div>
          <div class='blogs_browse_info'>
            <p class='blogs_browse_info_title'>
              <?php echo $this->htmlLink($item->getHref(), $item->getTitle()) ?>
            </p>
            <p class='blogs_browse_info_date'>
              <?php echo $this->translate('Posted by');?>
              <?php echo $this->htmlLink($item->getOwner()->getHref(), $item->getOwner()->getTitle()) ?>
              <?php echo $this->translate('about');?>
              <?php echo $this->timestamp(strtotime($item->creation_date)) ?>
            </p>
            <p class='blogs_browse_info_blurb'>
              <?php
                // Not mbstring compat
                echo substr(strip_tags($item->body), 0, 350); if (strlen($item->body)>349) echo "...";
              ?>
            </p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

  <?php elseif($this->search): ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('You do not have any blog entries that match your search criteria.');?>
      </span>
    </div>
  <?php else: ?>
    <div class="tip">
      <span>
        <?php echo $this->translate('You do not have any blog entries.');?>
        <?php if ($this->can_create): ?>
          <?php echo $this->translate('Get started by %1$swriting%2$s a new entry.', '<a href="'.$this->url(array(), 'blog_create').'">', '</a>'); ?>
        <?php endif; ?>
      </span>
    </div>
  <?php endif; ?>
  <?php echo $this->paginationControl($this->paginator, null, array("pagination/blogpagination.tpl","blog"), array("orderby"=>$this->orderby)); ?>

</div>
