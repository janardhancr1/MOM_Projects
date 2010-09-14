
<script type="text/javascript">
  window.addEvent('load', function() {
    var randomString = function() {
      var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
      var string_length = 16;
      var randomstring = '';
      for (var i=0; i<string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
      }
      return randomstring;
    };

    (new Element('a', {
      'html' : '(generate)',
      'href' : 'javascript:void(0);',
      'events' : {
        'click' : function(event) {
          $('key').set('value', randomString());
          event.stop();
          this.blur();
        }
      },
      'styles' : {
        'padding-left' : '10px'
      }
    })).inject($('key'), 'after');
  });
</script>

<div class='settings'>
  <?php echo $this->form->render($this) ?>
</div>