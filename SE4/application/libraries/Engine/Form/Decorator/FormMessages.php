<?php
/**
 * SocialEngine
 *
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 * @version    $Id: FormMessages.php 1923 2009-12-16 09:19:41Z john $
 */

/**
 * @category   Engine
 * @package    Engine_Form
 * @copyright  %%copyright%%
 * @license    %%license%%
 */
class Engine_Form_Decorator_FormMessages extends Zend_Form_Decorator_Abstract
{
  protected $_placement = 'PREPEND';

  /**
   * HTML tag with which to surround label
   * @var string
   */
  protected $_tag;

  /**
   * Set HTML tag with which to surround label
   *
   * @param  string $tag
   * @return Zend_Form_Decorator_Label
   */
  public function setTag($tag)
  {
    if (empty($tag)) {
      $this->_tag = null;
    } else {
      $this->_tag = (string) $tag;
    }
    return $this;
  }

  /**
   * Get HTML tag, if any, with which to surround label
   *
   * @return void
   */
  public function getTag()
  {
    if (null === $this->_tag) {
      $tag = $this->getOption('tag');
      if (null !== $tag) {
        $this->removeOption('tag');
        $this->setTag($tag);
      }
      return $tag;
    }

    return $this->_tag;
  }

  public function getMessages()
  {
    $element = $this->getElement();
    if( !method_exists($element, 'getNotices') )
    {
      return false;
    }

    $messages = $element->getNotices();
    if( empty($messages) )
    {
      return false;
    }

    if( null !== ($translator = $element->getTranslator()) )
    {
      foreach( $messages as &$message )
      {
        $message = $translator->translate($message);
      }
    }

    return $messages;
  }

  public function render($content)
  {
    $messages = $this->getMessages();
    if( !$messages )
    {
      return $content;
    }
    
    $messageContent = '<ul class="form-notices">';

    foreach( $messages as $message )
    {
      $messageContent .= '<li>'
        . $message
        . '</li>';
    }

    $messageContent .= '</ul>';

    $separator = $this->getSeparator();
    $placement = $this->getPlacement();
    switch ($placement) {
        case self::APPEND:
            return $content . $separator . $messageContent;
        case self::PREPEND:
            return $messageContent . $separator . $content;
    }
  }
}