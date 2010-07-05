<?php
/**
 * SocialEngine
 *
 * @category   Application_Core
 * @package    Core
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: async.tpl 6590 2010-06-25 19:40:21Z john $
 * @author     John
 */
?>
<html>
  <head>
    <script type="text/javascript">
      parent.en4.core.dloader.handleLoad(<?php echo Zend_Json::encode($this->layout()->content) ?>);
    </script>
  </head>
  <body>

  </body>
</html>
