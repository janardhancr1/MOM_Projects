<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 7424 2010-09-20 03:39:08Z john $
 * @author     John
 */
?>

<div class='red_bar' style='margin-bottom:2px'>
</div>
<div style='float:left;color:#BEB800;'>
 &copy;/&trade;/&reg;
<?php echo $this->translate('Momburbia Inc.') ?>
</div>
<?php foreach( $this->navigation as $item ): ?>
  &nbsp;&nbsp; <?php echo $this->htmlLink($item->getHref(), $this->translate($item->getLabel())) ?>
<?php endforeach; ?>

<?php if( 1 !== count($this->languageNameList) ): ?>
    <!--&nbsp;-&nbsp;-->
    <form method="post" action="<?php echo $this->url(array('controller' => 'utility', 'action' => 'locale'), 'default', true) ?>" style="display:inline-block">
      <?php $selectedLanguage = $this->translate()->getLocale() ?>
      <?php //echo $this->formSelect('language', $selectedLanguage, array('onchange' => '$(this).getParent(\'form\').submit();'), $this->languageNameList) ?>
      <?php echo $this->formHidden('return', $this->url()) ?>
    </form>
<?php endif; ?>
