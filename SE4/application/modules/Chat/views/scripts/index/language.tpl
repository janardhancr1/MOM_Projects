<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: language.tpl 6509 2010-06-22 23:49:13Z shaun $
 * @author     Steve
 */
?>

if (!$type(translate_chat))
    var translate_chat = {};
    translate_chat['Friends Online'] = '<?php echo $this->string()->escapeJavascript($this->translate('Friends Online'));?>';
    translate_chat['The chat room has been disabled by the site admin'] = '<?php echo $this->string()->escapeJavascript($this->translate('The chat room has been disabled by the site admin.'))?>';
    translate_chat['Browse Chatrooms'] = '<?php echo $this->string()->escapeJavascript($this->translate('Browse Chatrooms')) ?>';
    translate_chat['You are sending messages too quickly - please wait a few seconds and try again.'] = '<?php echo $this->string()->escapeJavascript($this->translate('You are sending messages too quickly - please wait a few seconds and try again.')) ?>';
    translate_chat[' has joined the room.'] = '<?php echo $this->string()->escapeJavascript($this->translate(' has joined the room.')) ?>';
    translate_chat[' has left the room.'] = '<?php echo $this->string()->escapeJavascript($this->translate(' has left the room.')) ?>';
    translate_chat['None of your friends are online.'] = '<?php echo $this->string()->escapeJavascript($this->translate('None of your friends are online.')) ?>';
