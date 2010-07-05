<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: _navIcons.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<ul>
  <?php foreach( $this->container as $link ): ?>
    <li>
      <?php echo $this->htmlLink($link->getHref(), $this->translate($link->getLabel()), array(
        'class' => 'buttonlink' . ( $link->getClass() ? ' ' . $link->getClass() : '' ),
        'style' => 'background-image: url('.$link->get('icon').');'
      )) ?>
    </li>
      <?php /*
    <li>
      <a href="<?php echo $link->getHref().$link->smoothbox ?>" class="<?php echo $link->getClass() ?>">
        <?php if( $link->get('icon') ): ?>
          <?php echo $this->htmlImage($link->get('icon')); ?>
        <?php endif; ?>
        <?php echo $link->getLabel() ?>
      </a>
    </li>
       */ ?>
  <?php endforeach; ?>
</ul>