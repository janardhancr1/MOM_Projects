<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: error.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<div>

  <h2><?php echo $this->translate('Whoops!') ?></h2>

  <?php echo $this->translate('An error has occurred.') ?>

  <?php if( isset($this->error) ): ?>
    <br />
    <br />
    <pre><?php echo $this->error; ?></pre>
  <?php endif; ?>

</div>