<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>

<?php echo $this->translate('Copyright &copy;%s', date('Y')) ?>
<?php foreach( $this->navigation as $item ): ?>
  &nbsp;-&nbsp; <?php echo $this->htmlLink($item->getHref(), $this->translate($item->getLabel())) ?>
<?php endforeach; ?>

<?php if( 1 !== count($this->languageNameList) ): ?>
    &nbsp;-&nbsp;
    <form method="post" action="<?php echo $this->url(array('controller' => 'utility', 'action' => 'locale'), 'default', true) ?>" style="display:inline-block">
      <?php $selectedLanguage = $this->translate()->getLocale() ?>
      <?php echo $this->formSelect('language', $selectedLanguage, array('onchange' => '$(this).getParent(\'form\').submit();'), $this->languageNameList) ?>
      <?php echo $this->formHidden('return', $this->url()) ?>
    </form>
<?php endif; ?>