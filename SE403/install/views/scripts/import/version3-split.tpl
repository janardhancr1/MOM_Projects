
<script type="text/javascript">
  var token = '<?php echo $this->token ?>';
  var url = '<?php echo $this->url(array('action' => 'version3-remote')) ?>';
  var runOnce = false;
  var sendImportRequest = function() {
    if( runOnce ) {
      return;
    }
    runOnce = true;

    $('import_retry').setStyle('display', 'none');

    (new Request.JSON({
      url : url,
      data : {
        token : token
      },
      onComplete : function(responseJSON, responseText) {
        runOnce = false;
        
        // An error occurred
        if( $type(responseJSON) != 'object' ) {
          $('import_fatal_error').set('html', 'ERROR: ' + responseText);
          $('import_retry').setStyle('display', '');
          return;
        }
        if( !$type(responseJSON.status) || !responseJSON.status ) {
          if( $type(responseJSON.error) ) {
            $('import_fatal_error').set('html', 'ERROR: ' + responseJSON.error);
          } else {
            $('import_fatal_error').set('html', 'ERROR: ' + responseText);
          }
          return;
        }

        // Normal

        // Progress
        var progressString = '';
        if( $type(responseJSON.migratorCurrent) ) {
          progressString += responseJSON.migratorCurrent + ' of ' + responseJSON.migratorTotal + ' steps. ';
        }
        if( $type(responseJSON.deltaTimeStr) ) {
          progressString += ' ' + responseJSON.deltaTimeStr
        }
        if( '' != progressString ) {
          $('import_progress').set('html', progressString);
        }

        // Done!
        if( $type(responseJSON.complete) ) {
          alert('Done!');
        }

        else {
          // Check for progress report
          var className = responseJSON.className;
          var elementIdentity = 'import_log_' + className;
          var element = $(elementIdentity);
          if( !element ) {
            var tmpEl = new Element('li');
            tmpEl.inject($('import_log_container').getElement('ul'), 'top');
            (new Element('h3', {
              'html' : className
            })).inject(tmpEl);
            element = new Element('ul', {
              'id' : elementIdentity,
              'class' : 'import_log'
            });
            element.inject(tmpEl);
          }
          element.empty();

          $A(responseJSON.messages).each(function(message) {
            (new Element('li', {
              'class' : ( message.toLowerCase().indexOf('error') != -1 ? 'error' : ( message.toLowerCase().indexOf('warning') != -1 ? 'warning' : 'notice' ) ),
              'html' : message
            })).inject(element);
          });

          sendImportRequest();
        }
      }
    })).send();
  }
  window.addEvent('load', function() {
    sendImportRequest();
  });

</script>

<div id="import_retry" style="display:none;">
  <a href="javascript:void(0);" onclick="sendImportRequest();">
    Restart from previous position
  </a>
</div>
<br />

<div id="import_fatal_error">

</div>
<br />

<div id="import_progress">
  
</div>
<br />

<div id="import_log_container">
  <ul class="import_log_section">
    
  </ul>
</div>