<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: delete.tpl 5332 2010-05-01 03:19:08Z alex $
 * @author     Jung
 */
?>
<!--
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
-->

<?php include './application/modules/Contests/views/scripts/index/rightside.tpl' ?>

<div class="layout_middle">
<div class="headline_header">
	<img src='./application/modules/Blog/externals/images/blog_blog48.gif' border='0' class='icon_big'>
	<div class="mainheadline">
    <?php echo $this->translate('Delete Blog Entry?');?>
    <div class="button"><img src='./application/modules/Core/externals/images/back16.gif' border='0' class='button'> <a href='/index.php/blogs/manage'>Back to My Blogs</a></div>
    </div>
    <div class="smallheadline"></div>
</div>
<div class='global_form'>
  <form method="post" class="global_form">
    <div>
      <div>
      <p>
        <?php echo $this->translate('Are you sure that you want to delete the blog entry with the title "%1$s" last modified %2$s? It will not be recoverable after being deleted.', $this->blog->title,$this->timestamp($this->blog->modified_date)); ?>
      </p>
      <br />
      <p>
        <input type="hidden" name="confirm" value="true"/>
        <button type='submit'><?php echo $this->translate('Delete');?></button>
        <?php echo $this->translate('or');?> <a href='<?php echo $this->url(array(), 'blog_manage', true) ?>'><?php echo $this->translate('cancel');?></a>
      </p>
    </div>
    </div>
  </form>
</div>
</div>