<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Chat
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: index.tpl 6509 2010-06-22 23:49:13Z shaun $
 * @author     John
 */
?>

<?php
  $this->headScript()
    ->appendFile('chat/index/language')
    ->appendFile('application/modules/Chat/externals/scripts/core.js')
?>
<?php if( Engine_Api::_()->getApi('settings', 'core')->getSetting('chat.chat.enabled', false) ): ?>
  <script type="text/javascript">
    
    en4.core.runonce.add(function() {
      //try {
        if( !$type(window._chatHandler) ) {
          chatHandler = new ChatHandler({
            'baseUrl' : en4.core.baseUrl,
            'basePath' : en4.core.basePath,
            //'identity' : <?php echo sprintf('%d', $this->viewer()->getIdentity()) ?>,
            'enableIM' : <?php echo Engine_Api::_()->getApi('settings', 'core')->getSetting('chat.im.enabled', false) ? 'true' : 'false' ?>,
            'enableChat' : false,
            'delay' : <?php echo sprintf('%d', Engine_Api::_()->getApi('settings', 'core')->getSetting('chat.general.delay', '5000')); ?>
          });
          chatHandler.start();
          window._chatHandler = chatHandler;
        }
        if( $type(window._chatHandler) ) {
          window._chatHandler.startChat({
            operator : <?php echo sprintf('%d', (int) $this->isOperator) ?>,
            roomList : <?php echo Zend_Json::encode($this->rooms) ?>
          });
        }
      //} catch( e ) {

      //}
    });

  </script>

<?php else: ?>

  <div><?php echo $this->translate('The chat room has been disabled by the site admin.')?></div>
  
<?php endif; ?>


<?php /*
  <span class="pulldown" onClick="if(this.className=='pulldown'){this.className='pulldown_active';}else{this.className='pulldown';}">
    <div class="pulldown_contents_wrapper">
      <div class="pulldown_contents">
        <ul>
          <li>Main Chatroom (3 people)</li>
          <li>Visual Kei (21 people)</li>
        </ul>
      </div>
    </div>
    <a href="javascript:void(0);">Open Page</a>
  </span>


  <br />
  <br />
  <br />

*/ ?>