
/* $Id: composer_facebook.js 6072 2010-06-02 02:36:45Z john $ */


Composer.Plugin.Facebook = new Class({

  Extends : Composer.Plugin.Interface,

  name : 'facebook',

  options : {
    title : 'Publish this on Facebook',
    lang : {
        'Publish this on Facebook': 'Publish this on Facebook'
    },
    requestOptions : false,
    fancyUploadEnabled : false,
    fancyUploadOptions : {}
  },

  initialize : function(options) {
    this.elements = new Hash(this.elements);
    this.params = new Hash(this.params);
    this.parent(options);
  },

  attach : function() {
    this.elements.spanToggle = new Element('span', {
      'class' : 'composer_facebook_toggle',
      'href'  : 'javascript:void(0);',
      'onclick' : "$('compose-facebook-form-input').set('checked', !$('compose-facebook-form-input').get('checked'));"+
                    "$(this).toggleClass('composer_facebook_toggle_active');"+
                    "composeInstance.plugins['facebook'].active=true;setTimeout(\"composeInstance.plugins['facebook'].active=false;\",300);"
    });

    this.elements.formCheckbox = new Element('input', {
      'id'    : 'compose-facebook-form-input',
      'class' : 'compose-form-input',
      'type'  : 'checkbox',
      'name'  : 'post_to_facebook',
      'style' : 'display:none;'
    });
    
    this.elements.spanTooltip = new Element('span', {
      'for' : 'compose-facebook-form-input',
      'class' : 'composer_facebook_tooltip',
      'html' : this.options.lang['Publish this on Facebook']
    });

    this.elements.formCheckbox.inject(this.elements.spanToggle);
    this.elements.spanTooltip.inject(this.elements.spanToggle);
    this.elements.spanToggle.inject($('compose-menu'));

    //this.parent();
    //this.makeActivator();
    return this;
  },

  detach : function() {
    this.parent();
    return this;
  },
/*
  activate : function() {
    if( this.active ) return;
    this.parent();

    this.makeMenu();
    this.makeBody();

    // Generate form
    var fullUrl = this.options.requestOptions.url;
    this.elements.form = new Element('form', {
      'id' : 'compose-facebook-form',
      'class' : 'compose-form',
      'method' : 'post',
      'action' : fullUrl,
      'enctype' : 'multipart/form-data'
    }).inject(this.elements.body);

    this.elements.formInput = new Element('input', {
      'id' : 'compose-music-form-input',
      'class' : 'compose-form-input',
      'type' : 'checkbox',
      'name' : 'post_to_facebook'
    }).inject(this.elements.form);

    this.elements.formSubmit = new Element('button', {
      'id' : 'compose-facebook-form-submit',
      'class' : 'compose-form-submit',
      'html' : 'Attach',
      'events' : {
        'click' : function(e) {
          e.stop();
          this.doAttach();
        }.bind(this)
      }
    }).inject(this.elements.body);
    
  },

  deactivate : function() {
    if (this.params.song_id)
      new Request.JSON({
        url: en4.core.basePath + '/music/index/remove-song',
        data: {
          format: 'json',
          song_id: this.params.song_id
        }
      });
    if( !this.active ) return;
    this.parent();
  },

  doRequest : function() {
    this.elements.iframe = new IFrame({
      'name' : 'composeMusicFrame',
      'src' : 'javascript:false;',
      'styles' : {
        'display' : 'none'
      },
      'events' : {
        'load' : function() {
          this.doProcessResponse(window._composeMusicResponse);
          window._composeMusicResponse = false;
        }.bind(this)
      }
    }).inject(this.elements.body);

    window._composeMusicResponse = false;
    this.elements.form.set('target', 'composeMusicFrame');

    // Submit and then destroy form
    this.elements.form.submit();
    this.elements.form.destroy();

    // Start loading screen
    this.makeLoading();
  },

  makeLoading : function(action) {
    if( !this.elements.loading ) {
      if( action == 'empty' ) {
        this.elements.body.empty();
      } else if( action == 'hide' ) {
        this.elements.body.getChildren().each(function(element){ element.setStyle('display', 'none')});
      } else if( action == 'invisible' ) {
        this.elements.body.getChildren().each(function(element){ element.setStyle('height', '0px').setStyle('visibility', 'hidden')});
      }

      this.elements.loading = new Element('div', {
        'id' : 'compose-' + this.getName() + '-loading',
        'class' : 'compose-loading'
      }).inject(this.elements.body);

      var image = this.elements.loadingImage || (new Element('img', {
        'id' : 'compose-' + this.getName() + '-loading-image',
        'class' : 'compose-loading-image'
      }));

      image.inject(this.elements.loading);

      new Element('span', {
        'html' : this._lang('Loading song, please wait...')
      }).inject(this.elements.loading);
    }
  },

  doProcessResponse : function(responseJSON) {
    // An error occurred
    if ( ($type(responseJSON) != 'object' && $type(responseJSON) != 'hash' )) {
      if( this.elements.loading )
          this.elements.loading.destroy();
      this.makeError(this._lang('Unable to upload music. Please click cancel and try again'), 'empty');
      return;
    }

    if (  $type(parseInt(responseJSON.song_id)) != 'number' ) {
      if( this.elements.loading )
          this.elements.loading.destroy();
      //if ($type(console))
      //  console.log('responseJSON: %o', responseJSON);
      this.makeError(this._lang('Song got lost in the mail. Please click cancel and try again'), 'empty');
      return;
    }
    // Success
    this.params.set('rawParams',  responseJSON);
    this.params.set('song_id',    responseJSON.song_id);
    this.params.set('song_title', responseJSON.song_title);
    this.params.set('song_url',   responseJSON.song_url);
    this.elements.preview = new Element('a', {
      'href': responseJSON.song_url,
      'text': responseJSON.song_title,
      'class': 'compose-music-link',
      'onclick': "$(this).toggleClass('compose-music-link-playing');$(this).toggleClass('compose-music-link');var song = (responseJSON.song_url.match(/\.mp3$/) ? soundManager.createSound({id:'s'+"+responseJSON.song_id+",url:'"+responseJSON.song_url+"'}) : soundManager.createVideo({id:'s'+"+responseJSON.song_id+",url:'"+responseJSON.song_url+"'}));song.togglePause();return false;"
    });
    this.elements.preview.set('text', responseJSON.song_title);
    this.doSongLoaded();
  },

  doSongLoaded : function() {
    if( this.elements.loading )
        this.elements.loading.destroy();
    if( this.elements.formFancyContainer )
        this.elements.formFancyContainer.destroy();
    this.elements.preview.inject(this.elements.body);
    this.makeFormInputs();
  },

  makeFormInputs : function() {
    this.ready();
    this.parent({
      'song_id' : this.params.song_id
    });
  }
*/
})