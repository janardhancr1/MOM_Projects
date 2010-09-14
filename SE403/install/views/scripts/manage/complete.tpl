<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Install
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: complete.tpl 7244 2010-09-01 01:49:53Z john $
 * @author     John
 */
?>

<h3>
  Install Packages
</h3>

<?php
  // Navigation
  echo $this->render('_installMenu.tpl')
?>

<br />

<p>
  Awesome! The installation has been completed successfully. You can now return to the package manager or your dashboard.
</p>

<br />
<br />

<div>
  <form method="get" action="<?php echo $this->url(array('action' => 'index')) ?>">
    <button type="submit">Back to Package Manager</button>
    or <a href="../../admin">back to dashboard</a>
</div>

<!--
<a href="<?php echo $this->url(array('action' => 'index')) ?>">Return to Manager</a>
-->