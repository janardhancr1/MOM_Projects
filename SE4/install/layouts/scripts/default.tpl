<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: default.tpl 6683 2010-07-02 00:09:27Z john $
 */
?>
<?php echo $this->doctype()->__toString() ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <base href="<?php echo rtrim('http://' . $_SERVER['HTTP_HOST'] . $this->baseUrl(), '/'). '/' ?>" />

    <?php // TITLE/META ?>
    <?php
      $this->headTitle()
        ->setSeparator(' - ');
      $this->headMeta()
        ->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')
        ->appendHttpEquiv('Content-Language', 'en-US');
    ?>
    <?php echo $this->headTitle()->toString()."\n" ?>
    <?php echo $this->headMeta()->toString()."\n" ?>

    <?php // LINK/STYLES ?>
    <?php
      $this->headLink()
        ->prependStylesheet($this->baseUrl() . '/externals/styles/styles.css')
        ->prependStylesheet($this->baseUrl() . '/externals/styles/compat.css')
        ;
    ?>
    <?php echo $this->headLink()->toString()."\n" ?>
    <?php echo $this->headStyle()->toString()."\n" ?>

    <?php // SCRIPTS ?>
    <?php
      $appBaseHref = str_replace('install/', '', $this->url(array(), 'default', true));
      $appBaseUrl = rtrim(str_replace('\\', '/', dirname($this->baseUrl())), '/');
      $this->headScript()
        ->prependFile($appBaseUrl . '/externals/smoothbox/smoothbox4.js')
        ->prependFile($appBaseUrl . '/externals/chootools/chootools.js')
        ->prependFile($appBaseUrl . '/externals/mootools/mootools-1.2.4.2-more-nc.js')
        ->prependFile($appBaseUrl . '/externals/mootools/mootools-1.2.4-core-nc.js')
        ;
    ?>
    <?php echo $this->headScript()->toString()."\n" ?>
  </head>
  <body>

    <?php if( empty($this->layout()->hideIdentifiers) ): ?>
      <div class='topbar_wrapper'>
        <div class="topbar">
          <div class='topmenu'>
            You are currently signed-in to the package manager, a tool used for
            adding plugins, mods, themes, languages, and other extensions to
            your community.
            <br />
            <br />
            <a href="<?php echo $this->url(array(), 'logout') ?>?return=<?php echo urlencode($appBaseHref . 'admin/') ?>" class="buttonlink packages_return">Return to Admin Panel</a>
            <a href="<?php echo $this->url(array(), 'logout') ?>?return=<?php echo urlencode($appBaseHref) ?>" class="buttonlink packages_return" style="float:right;">Logout</a>
          </div>
          <div class='logo'>
            <img src="externals/images/admin_logo.png" alt="" />
          </div>
        </div>
      </div>
    <?php endif; ?>
    
    <div class='content'>
      <?php echo $this->layout()->content ?>
    </div>

  </body>
</html>