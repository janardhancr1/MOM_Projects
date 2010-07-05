<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: _installMenu.tpl 6641 2010-06-30 01:22:51Z john $
 * @author     John
 */
?>

<div class="admin_packages_steps_wrapper">
  <div class="admin_packages_steps">
    <?php
      $c = count($this->installNavigation);
      $i = 0;
    ?>
    <?php foreach( $this->installNavigation as $page ): $i++; ?>
      <a href="<?php echo $page->getUri() ?>"<?php if( $page->isActive() ): ?> class="active"<?php endif; ?>>
        <?php echo $page->getLabel() ?>
      </a>
      <?php if( $i != $c ) echo "&nbsp;»&nbsp;" ?>
    <?php endforeach; ?>
  </div>
</div>