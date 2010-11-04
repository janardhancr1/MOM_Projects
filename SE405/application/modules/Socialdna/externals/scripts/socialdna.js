
var openidconnect_api_endpoint = en4.core.baseUrl;
var openidconnect_faceboxex_close_nocancel = false;
var openidconnect_autologin_skipcheck = false;


function openidconnect_autologin(openid_user_id) {
  // get user pref and :
  // if autologin is on - refresh page
  // if autologin is off - do nothing
  // if autologin is not set - show dialog
  if(openidconnect_autologin_skipcheck) {
	return;
  }

  var ajax = new SEMods.Ajax(openidconnect_autologin_onSuccess);

  var params = 'format=json&openidservice='+openidconnect_primary_network;

  ajax.post(en4.core.baseUrl + 'socialdna/index/'   + 'autologin', params)
  
}


function openidconnect_autologin_onSuccess (obj, responseText) {
  var r = [];
  try {
	r = eval('(' + responseText + ')')
  } catch(e) {
	r.status = 1
  };
  
  if (r.status == 0) {
	
	if(r.autologin == 0) {
	  
	  // show dialog
	  openidconnect_autologin_prompt();
	  
	} else if(r.autologin == 1) {

	  // autologin
	  openidconnect_autologin_complete();
	  
	}
	// otherwise autologin is off by user
	
  } else {

  }
  
}


function openidconnect_autologin_prompt() {

  mooFaceboxExShow("", "#openidconnect_autologin_prompt", 570)  
  
  // reattach events
  _mooFaceboxEx.faceboxEl.getElement('.openidconnect_autologin_prompt_confirmed').addEvent('click', function(e) { openidconnect_autologin_confirmed() });
  _mooFaceboxEx.faceboxEl.getElement('.openidconnect_autologin_prompt_cancel').addEvent('click', function(e) { openidconnect_autologin_cancel() });
  
}

function openidconnect_autologin_confirmed() {
  
  var checkbox = _mooFaceboxEx.faceboxEl.getElement('.openidconnect_autologin_remember');
  var checked = checkbox.checked;
  
  mooFaceboxExClose();
  
  var complete_login = function() { openidconnect_autologin_complete(); };
  
  if(checked) {

	var ajax = new SEMods.Ajax(complete_login, complete_login);
	var params = 'format=json&openidservice='+openidconnect_primary_network;
  
	ajax.post(en4.core.baseUrl + 'socialdna/index/'   + 'autologinnexttime', params)
	
  } else {
	
	complete_login();
	
  }

}

function openidconnect_autologin_complete() {
  window.location = openidconnect_autologin_url + '/openidservice/' + openidconnect_primary_network;
}

function openidconnect_autologin_cancel() { 
  
  mooFaceboxExClose();
  
  _openidconnect_autologin_cancel();

}

function _openidconnect_autologin_cancel() {

  if(openidconnect_faceboxex_close_nocancel) {
	return;
  }

  var checkbox = _mooFaceboxEx.faceboxEl.getElement('.openidconnect_autologin_remember');
  var checked = checkbox.checked;
  
  var ajax = new SEMods.Ajax();
  var params = 'format=json&openidservice='+openidconnect_primary_network + '&autologinremember=' + (checked ? 1 : 0);

  ajax.post(en4.core.baseUrl + 'socialdna/index/'   + 'autologinsuppress', params)
  
}


function openidconnect_facebook_require_login() {
  SEMods.B.register_onload( function() { openidconnect_facebook_require_login_onload(); } );
}

var openidconnect_facebook_require_login_current_state = 1;

function openidconnect_facebook_require_login_onload() {

  FB_RequireFeatures(["Connect"], function () {
	FB.Facebook.init(openidconnect_facebook_api_key, en4.core.basePath + 'xd_receiver.php', {
	  ifUserConnected: function (facebook_user_id) {
		if(openidconnect_facebook_require_login_current_state != 0) {
		  if (facebook_user_id == openidconnect_facebook_user_id) {
			openidconnect_facebook_require_login_loaded(true);
		  } else {
			openidconnect_facebook_require_login_loaded(false);
		  }
		}
	  },
	  ifUserNotConnected: function () {
		openidconnect_facebook_require_login_current_state = 0;
		openidconnect_facebook_require_login_loaded(false);
	  },
	  doNotUseCachedConnectState: true
	});
  });
  
  /*
  FB_RequireFeatures(["Connect"], function () { 
	FB.ensureInit(function() {
	  FB.Connect.ifUserConnected(
		function(facebook_user_id) {
		  if(openidconnect_facebook_require_login_current_state != 0) {
			if (facebook_user_id == openidconnect_facebook_user_id) {
			  openidconnect_facebook_require_login_loaded(true);
			} else {
			  openidconnect_facebook_require_login_loaded(false);
			}
		  }
		},
		function() {
		  openidconnect_facebook_require_login_current_state = 0;
		  openidconnect_facebook_require_login_loaded(false);
		});
	})
  });
  */

}

function openidconnect_facebook_require_login_loaded(loggedin) {
  if($('openidconnect_facebook_require_login_loading')) {
	SEMods.B.hide('openidconnect_facebook_require_login_loading');
  }
  if (loggedin) {
	SEMods.B.show('openidconnect_facebook_loggedin');
  } else {
	SEMods.B.hide('openidconnect_facebook_loggedin');
	SEMods.B.show('openidconnect_facebook_notloggedin');
  }
}

function openidconnect_register_invite_form() {

  SEMods.B.register_onload( function() { openidconnect_invite_form_onload() } );

}





function openidconnect_invite_form_invitable(facebook_user_id) {

  if (!facebook_user_id || (openidconnect_facebook_user_id != facebook_user_id)) {
	SEMods.B.hide('openidconnect_facebook_invite_dialog');
	SEMods.B.show('openidconnect_facebook_connect');
  }

}

function openidconnect_invite_form_onload() {
  
  FB_RequireFeatures(["XFBML","Connect"], function () {
	FB.Facebook.init(openidconnect_facebook_api_key, en4.core.basePath + 'xd_receiver.php', {
	  ifUserConnected: function (facebook_user_id) {
		openidconnect_invite_form_invitable(facebook_user_id)
	  },
	  ifUserNotConnected: function () {
		openidconnect_invite_form_invitable()
	  },
	  doNotUseCachedConnectState: true
	});
  });
 
}


function openidconnect_register_facebook_login_button(redirect_url) {
  SEMods.B.register_onload( function() { openidconnect_facebook_login_button_onload(redirect_url); } );
  
  //en4.core.runonce.add( function() { openidconnect_facebook_login_button_onload(redirect_url); } );

}

function openidconnect_facebook_login_button_onload(redirect_url) {
  
  FB_RequireFeatures(["Connect"], function () {
	openidconnect_facebook_login_button_clickable(redirect_url);
  });
  
}

function openidconnect_facebook_login_button_clickable(redirect_url) {

  $$('.openidconnect_facebook_login_button').each( function(elem) {
	elem.addEvent('click', function() {

	  var permissions = "user_about_me,user_activities,user_birthday,user_hometown,user_interests,user_location,user_religion_politics,user_status,user_website,offline_access";
	  if(parseInt(openidconnect_fbe) == 1) {
		permissions += ",email";
	  }		  


	  FB_RequireFeatures(["Connect"], function () {
		FB.Facebook.appSettings['permsToRequestOnConnect'] = permissions;
		FB.Facebook.init(openidconnect_facebook_api_key, en4.core.basePath + 'xd_receiver.php', {doNotUseCachedConnectState: true, permsToRequestOnConnect : permissions});

		FB.Connect.requireSession( function() {window.location = redirect_url;});

		//FB.Connect.requireSession( function() {window.location = redirect_url;}, function() {window.location = redirect_url;});
		
		/*
		FB.Connect.requireSession( function());
		FB.Facebook.get_sessionState().waitUntilReady(function (session_object) {
		  //openidconnect_facebook_prompt_permission("offline_access,publish_stream,email", function() {
		  //openidconnect_facebook_prompt_permission(permissions, function() {
		  //openidconnect_facebook_prompt_multiple_permissions(permissions, function() {		  
			window.location = redirect_url;
		  //} );		  		  
		})
		*/
	  })
	  return false;
	})
  });

}  

function openidconnect_facebook_disconnect(redirect) {
  
  if(typeof redirect == 'undefined') {
	redirect = openidconnect_logout_url;
  }
  
  FB.ensureInit(function() {
	FB.Connect.get_status().waitUntilReady( function( status ) {
	   switch ( status ) {
		case FB.ConnectState.connected:
		  FB.Connect.logoutAndRedirect( redirect );
		   break;
 
		case FB.ConnectState.appNotAuthorized:
		case FB.ConnectState.userNotLoggedIn:
		  window.location = redirect;
	   }
	}) 
  });
  
}

function openidconnect_facebook_authorize_status_update() {
  openidconnect_facebook_prompt_permission('status_update', openidconnect_facebook_authorize_status_update_authorized);
}

function openidconnect_facebook_authorize_status_update_check() {
  openidconnect_require_connected( function() { _openidconnect_facebook_authorize_status_update_check(); } );
}

function _openidconnect_facebook_authorize_status_update_check() {
  
  FB.ensureInit( function() {
	FB.Connect.requireSession( function() {
	  FB.Facebook.apiClient.users_hasAppPermission("status_update",openidconnect_facebook_authorize_status_update_authorized);
	});    
  });
	
}

function openidconnect_facebook_authorize_status_update_authorized(granted) {
}

function openidconnect_facebook_status_update_check_switch(status) {
  status ? $('#openidconnect_facebook_status_update_authorization').show() : $('#openidconnect_facebook_status_update_authorization').hide() ;
}

function openidconnect_facebook_logout() {

  FB_RequireFeatures(["Connect"], function () {
	FB.Facebook.init(openidconnect_facebook_api_key, en4.core.basePath + 'xd_receiver.php', null);
	FB.Connect.logoutAndRedirect( openidconnect_logout_url );
  });

  return false;

}

function openidconnect_facebook_logout_network() {
  window.location = openidconnect_logout_url + '/user/logout';
  window.location = openidconnect_logout_url;
}

function openidconnect_facebook_hook_logout_link() {

  $$("A").each( function(el) {
	if(/logout/.test(el.href)) {

	  el.href = 'javascript:void(0)';
	  el.innerHTML = "<img border='0' id='fb_logout_image' src='http://static.ak.fbcdn.net/images/fbconnect/logout-buttons/logout_small.gif' alt='Connect'/>";

	  if (typeof el.addEventListener != 'undefined') {
		el.addEventListener("click", openidconnect_facebook_logout, false);
	  } else if (typeof el.attachEvent != 'undefined') {
		el.attachEvent('onclick', openidconnect_facebook_logout);
	  }

	}
  });

}

function openidconnect_compose_feed_story(story_type,story_params) {

  var ajax = new SEMods.Ajax(openidconnect_compose_feed_story_onSuccess, openidconnect_compose_feed_story_onFail);
  var params = 'format=json&story_type=' + story_type + '&story_params=' + story_params;

  ajax.post(en4.core.baseUrl + 'socialdna/index/'   + 'composefeedstory', params)

}


function openidconnect_publish_feed_story_do(story_type,story_params) {

  SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_action') )
  SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_progress') )
  SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_action') )
  
  var checkboxes = _mooFaceboxEx.faceboxEl.getElements('.openidconnect_publish_feed_story_service');
  
  
  var services = [];
  for(var checkbox in checkboxes) {
	if(checkboxes[checkbox].checked) {
	  services.push(checkboxes[checkbox].value);
	}
  }
  
  services.join(',');

  var user_message = _mooFaceboxEx.faceboxEl.getElement('.openidconnect_user_message');
  user_message = user_message ? user_message.value : '';
  
  var update_session = _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_update_session').value;  
  

  var ajax = new SEMods.Ajax(openidconnect_publish_feed_story_do_onSuccess, openidconnect_publish_feed_story_do_onFail);
  var params = 'format=json&story_type=' + story_type + '&story_params=' + story_params + '&services=' + services + '&user_message=' + user_message + '&update_session=' + update_session;

  ajax.post(en4.core.baseUrl + 'socialdna/index/'   + 'publishfeedstory', params)


}

var openidconnect_publish_feed_story_rounds = 0;
var openidconnect_publish_feed_story_rounds_max = 2;

function openidconnect_publish_feed_story_do_onSuccess(obj, responseText) {

  var r = obj.toResponse();
  
  if (r.status == 0) {

  SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.form_div') );
  SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_success') );

  setTimeout( function() { openidconnect_faceboxex_close_nocancel = true; mooFaceboxExClose(); }, 2000);
  

  openidconnect_publish_feed_story_completed(openidconnect_facebook_feed_story_type);
  
  } else if ((r.status == 200) || (r.status == 204)) {


	SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_action') );
	SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_progress') );

	
	_mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_prompt_confirmed').disabled = 0;

	_mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_update_session').value = 1;
	
	openidconnect_publish_feed_story_rounds++;
	
	// permissions or session expired
	//openidconnect_facebook_prompt_multiple_permissions("offline_access,publish_stream", function() { openidconnect_publish_feed_story_prompt_confirmed();  } );
	openidconnect_facebook_prompt_permission("offline_access,publish_stream", function(perms) {
	  if((perms != '') && (openidconnect_publish_feed_story_rounds < openidconnect_publish_feed_story_rounds_max)) {
		openidconnect_publish_feed_story_prompt_confirmed();
	  }
	});

  } else {

	// some unclear error, ignore.

	SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.form_div') );
	SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_success') );
	
	setTimeout( function() { openidconnect_faceboxex_close_nocancel = true; mooFaceboxExClose(); }, 2000);
  
	openidconnect_publish_feed_story_completed(openidconnect_facebook_feed_story_type);
	
  }

  
}

function openidconnect_publish_feed_story_do_onFail(obj, responseText) {

  SEMods.B.hide( _mooFaceboxEx.faceboxEl.getElement('.form_div') );
  SEMods.B.show( _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_fail') );

  setTimeout( function() { openidconnect_faceboxex_close_nocancel = true; mooFaceboxExClose(); }, 2000);
  

  openidconnect_publish_feed_story_completed(openidconnect_facebook_feed_story_type);

}


function openidconnect_compose_feed_story_onSuccess (obj, responseText) {
  var r = [];
  try {
	r = eval('(' + responseText + ')')
  } catch(e) {
	r.status = 1
  };
  
  if (r.status == 0) {
	  
	if(r.openidconnect_feed_story.publish_using == 'stream') {
	  openidconnect_facebook_publish_stream( r.openidconnect_feed_story.story_type,
											 r.openidconnect_feed_story.data,
											 r.openidconnect_feed_story.user_prompt,
											 r.openidconnect_feed_story.user_message
											);
	} else {
	  openidconnect_facebook_publish_feed_story( r.openidconnect_feed_story.story_type,
												 r.openidconnect_feed_story.data,
												 r.openidconnect_feed_story.template_bundle_id,
												 r.openidconnect_feed_story.user_prompt,
												 r.openidconnect_feed_story.user_message
												 );
	}
	
  } else {

  }
  
}

function openidconnect_compose_feed_story_onFail (obj, responseText) {
}

function openidconnect_publish_feed_story_prompt() {
  _openidconnect_publish_feed_story_prompt();
}

function _openidconnect_publish_feed_story_prompt() {

  mooFaceboxExShow("", "#openidconnect_publish_feed_story_prompt", 600, true, {'footer' : false} );

  // causes double fire
  //_mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_prompt_confirmed').addEvent('click', function(e) { openidconnect_publish_feed_story_prompt_confirmed() });
  //_mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_prompt_wait').addEvent('click', function(e) { openidconnect_publish_feed_story_prompt_wait() });
  _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_prompt_cancel').addEvent('click', function(e) { openidconnect_publish_feed_story_prompt_cancel() });
  
  // focuse on message
  setTimeout( function() { _mooFaceboxEx.faceboxEl.getElement('.openidconnect_user_message').focus(); }, 1000) ;
  
}


function openidconnect_publish_feed_story_prompt_confirmed() { 

  var checkbox = _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_auto');
  var checked = checkbox.checked;
  
  openidconnect_publish_feed_story_do(openidconnect_facebook_feed_story_type,openidconnect_facebook_feed_story_params);

  if(checked) {

	var ajax = new SEMods.Ajax();
	var params = 'format=json&story_type=' + openidconnect_facebook_feed_story_type;
  
	ajax.post(en4.core.baseUrl + 'socialdna/index/'   + 'storyautopublish', params)
	
  }
  
 
}

function openidconnect_publish_feed_story_prompt_wait() { 

  mooFaceboxExClose();

}

function openidconnect_publish_feed_story_prompt_cancel(story_type) {

  mooFaceboxExClose();

  _openidconnect_publish_feed_story_prompt_cancel(story_type);
  
}

function _openidconnect_publish_feed_story_prompt_cancel(story_type) {

  if(openidconnect_faceboxex_close_nocancel) {
	return;
  }

  var checkbox = _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_neveragain');
  var checked = checkbox.checked;

  mooFaceboxExClose();

  openidconnect_publish_feed_story_completed(openidconnect_facebook_feed_story_type);

  if(checked) {

	var ajax = new SEMods.Ajax();
	var params = 'format=json&story_type=' + openidconnect_facebook_feed_story_type;
  
	ajax.post(en4.core.baseUrl + 'socialdna/index/'   + 'storynopublish', params)
	
  }
  
}

function openidconnect_publish_feed_story_completed(story_type, callback) {

  var ajax = new SEMods.Ajax();
  var params = 'format=json&story_type=' + story_type;

  ajax.post(en4.core.baseUrl + 'socialdna/index/'   + 'clearstory', params)

  
  if((typeof callback != 'undefined') && !callback) {
	callback();
  }
}




var openidconnect_connected = false;
var openidconnect_onconnect = null;

function openidconnect_onconnected(hook_logout) {

  FB.Facebook.get_sessionState().waitUntilReady(function (facebook_user_obj) {
	if (facebook_user_obj && (facebook_user_obj.uid == openidconnect_facebook_user_id)) {

	  openidconnect_connected = true;
	  if(openidconnect_onconnect) {
		openidconnect_onconnect();
	  }
	  if(hook_logout == 1) {
		openidconnect_facebook_hook_logout_link();
	  }
	  
	};
  });
  
}


function openidconnect_register_onconnect(handler) {

  if (openidconnect_onconnect) {
	var original_handler = openidconnect_onconnect;
	openidconnect_onconnect = function() { original_handler(); handler(); };
  } else {
	openidconnect_onconnect = handler;
  }
  
}


function openidconnect_facebook_onload(params) {

  var options = {'request_connect' : false,
				 'callback'		  : null,
				 'hook_logout'	  : true,
				 'user_exists' 	 : false,
				 'autologin'	: true
				};
				
  if(typeof params != 'undefined') {
    for (var param in params) {
	  options[param] = params[param];
	}
  }

  FB_RequireFeatures(["XFBML", "Connect"], function(){
	FB.Facebook.init( openidconnect_facebook_api_key, en4.core.basePath + 'xd_receiver.php', {
	  ifUserConnected: function (facebook_user_id) {

		// if user not logged in - auto login
		// if user logged in to website, but with another user - try autologin
		if(options.autologin == 1) {
		  // TBD: switch to another account?
		  //if((options.user_exists == 0) || ((openidconnect_facebook_user_id != 0) && (facebook_user_id != openidconnect_facebook_user_id)) ) {
		  if(options.user_exists == 0) {
			openidconnect_autologin(facebook_user_id);
		  }
		}
	  },
	  ifUserNotConnected: function () {
	  },
	  doNotUseCachedConnectState: true
    });
	
	if(options.user_exists == 1) {
	  FB.Connect.get_status().waitUntilReady( function( status ) {
		 switch ( status ) {
		  case FB.ConnectState.connected:
			  
			  if(options.callback) {
				options.callback();
			  }

			  openidconnect_onconnected(options.hook_logout);
			  
			 break;
   
		  //case FB.ConnectState.appNotAuthorized:
			 
		  case FB.ConnectState.userNotLoggedIn:
			 // some funcs queued
			if(openidconnect_onconnect && (options.request_connect == 1)) {
			  openidconnect_facebook_request_connect();
			}
		 }
	  }) 
	} else {
	  FB.Connect.get_status().waitUntilReady( function( status ) {
		 switch ( status ) {
		  case FB.ConnectState.connected:
			 break;
   
		  case FB.ConnectState.appNotAuthorized:
		  case FB.ConnectState.userNotLoggedIn:
			 openidconnect_autologin_skipcheck = true;
			 break;
		 }
	  }) 
	}
  });

}




function openidconnect_facebook_request_connect() {

  mooFaceboxExShow("", "#openidconnect_connect_prompt", 570)  

  _mooFaceboxEx.onclose = function() { _openidconnect_facebook_request_connect_cancel(); };
  
}

function openidconnect_facebook_request_connect_confirmed() {
  
  mooFaceboxExClose();

  FB.Connect.requireSession( function() {
	// got some hooks
	if(openidconnect_onconnect) {
	  openidconnect_onconnected();
	} else {
	  openidconnect_refresh_page();
	}
  });  
  
}

function openidconnect_facebook_request_connect_cancel() { 
  
  mooFaceboxExClose()

  _openidconnect_facebook_request_connect_cancel();
}


function _openidconnect_facebook_request_connect_cancel() { 

  if(openidconnect_faceboxex_close_nocancel) {
	return;
  }


  var ajax = new SEMods.Ajax();
  var params = 'format=json';

  ajax.post(en4.core.baseUrl + 'socialdna/index/'   + 'suppressconnect', params)

  
  openidconnect_publish_feed_story_completed('all');
  
}



function openidconnect_facebook_onlogin_ready() {
  openidconnect_refresh_page();
}


function openidconnect_refresh_page() {
  document.location = document.location;
}


function openidconnect_facebook_prompt_permission(permission, callback) {
  if(typeof callback == 'undefined'){
	callback = null;
  }
  FB.ensureInit(function() {
    FB.Connect.showPermissionDialog(permission,callback);
  });
}

function openidconnect_facebook_prompt_multiple_permissions(permissions, callback) {
  if(typeof callback == 'undefined'){
	callback = function() {};
  }
  permissions = permissions.split(",");
  FB.ensureInit(function() {
    _openidconnect_facebook_prompt_multiple_permissions(permissions,callback);
  });
}

function _openidconnect_facebook_prompt_multiple_permissions(permissions, callback) {

  if(permissions.length == 0) {
	callback();
	return;
  }

  FB.Facebook.apiClient.users_hasAppPermission(permissions[0],function(has){
	if (has == 0) {
	  permissions = permissions.join(',');
	  FB.Connect.showPermissionDialog(permissions, callback);
	} else {
	  permissions.splice(0,1);
	  _openidconnect_facebook_prompt_multiple_permissions(permissions, callback);
	}
  });
  
}


function openidconnect_require_connected( callback ) {
  if(openidconnect_connected) {
	callback();
  } else {
	openidconnect_register_onconnect( function() { callback(); } );
  }
}

function openidconnect_facebook_publish_feed_story(story_type, template_data, form_bundle_id, userprompt, usermessage, callback) {
  openidconnect_require_connected( function() { _openidconnect_facebook_publish_feed_story(story_type, template_data, form_bundle_id, userprompt, usermessage, callback); } );
}

var openidconnect_facebook_load_form_bundle_id_callback;

function openidconnect_facebook_load_form_bundle_id(story_type,callback) {
  
  openidconnect_facebook_load_form_bundle_id_callback = callback;

}


function openidconnect_facebook_load_form_bundle_id_onSuccess (obj, responseText) {
  var r = [];
  try {
	r = eval('(' + responseText + ')')
  } catch(e) {
	r.status = 1
  };
  
  if (r.status == 0) {
	
	openidconnect_facebook_load_form_bundle_id_callback( r.template_bundle_id ); 
	
  } else {

  }
  
}

function openidconnect_facebook_load_form_bundle_id_onFail (obj, responseText) {
  
}

function _openidconnect_facebook_publish_feed_story(story_type, template_data, form_bundle_id, userprompt, usermessage, callback) {

  if(form_bundle_id == "auto") {
	openidconnect_facebook_load_form_bundle_id( story_type, function(_form_bundle_id) { _openidconnect_facebook_publish_feed_story(story_type, template_data, _form_bundle_id, userprompt, usermessage, callback); } );
	return;
  }
  
  if(typeof userprompt == 'undefined') {
	userprompt = null;
  }

  if(typeof usermessage == 'undefined') {
	usermessage = null;
  } else {
	usermessage = {value: usermessage};
  }
		
  // Load the feed form
  FB.ensureInit(function() {
	feed_callback = function() { openidconnect_publish_feed_story_completed(story_type, callback); };
	FB.Connect.showFeedDialog(form_bundle_id, template_data, null, null, null, FB.RequireConnect.promptConnect, feed_callback, userprompt, usermessage);
  });

}


function openidconnect_facebook_publish_stream(story_type, data, userprompt, usermessage, callback) {
  openidconnect_require_connected( function() { _openidconnect_facebook_publish_stream(story_type, data, userprompt, usermessage, callback); } );
}


function _openidconnect_facebook_publish_stream(story_type, data, userprompt, usermessage, callback) {

	feed_callback = function() { openidconnect_publish_feed_story_completed(story_type, callback); };

    var UserRequestsNoPrompting = 1;
    
    FB.ensureInit(function(){
	  FB.Connect.requireSession(function(){
		  if (UserRequestsNoPrompting) {
			FB.Facebook.apiClient.users_hasAppPermission("publish_stream",function(has){
			  if (has == 0) {
				FB.Connect.showPermissionDialog("publish_stream", function(granted){
				openidconnect_facebook_publish_stream2(data,true,userprompt,usermessage,feed_callback);
			   });
			  }
			  else {
				openidconnect_facebook_publish_stream2(data,true,userprompt,usermessage,feed_callback);
			  }
			});    
		  } else {
			openidconnect_facebook_publish_stream2(data,false,userprompt,usermessage,feed_callback);
		  }
	  });
    });

}

function openidconnect_facebook_publish_stream2(data,auto_publish,userprompt,usermessage,callback) {

  if(typeof callback == 'undefined') {
	callback = null;
  }

  if(typeof userprompt == 'undefined') {
	userprompt = null;
  }

  if(typeof usermessage == 'undefined') {
	usermessage = null;
  }
    
  var attachment = typeof data.attachment != 'undefined' ? data.attachment : null; 
  var links = typeof data.links != 'undefined' ? data.links : null;
  var target_id = typeof data.target_id != 'undefined' ? data.target_id : '';
  
  // backend overwrites
  auto_publish = typeof data.auto_publish != 'undefined' ? data.auto_publish : auto_publish;

  FB.Connect.streamPublish(usermessage,attachment,links,target_id,userprompt,callback,auto_publish);
	
}


var openidconnect_notify_connected_cb = null;

function openidconnect_onNotifyConnected(service) {

  if(_mooFaceboxEx) {

	var checkbox = _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_' + service);
	if(checkbox) {
	  checkbox.checked = true;
	}
	
  }

}

function openidconnect_onNotifyConnectedSocial(service) {
  document.location = document.location;  
}

var openidconnect_opener_window = null;
var openidconnect_connected_services = [];

function openidconnect_connect_service(service, callback) {

  for(var i = 0, l = openidconnect_connected_services.length; i < l; i++) {
	if(openidconnect_connected_services[i] == service) {
	  return;
	}
  }

  if(_mooFaceboxEx) {
	var checkbox = _mooFaceboxEx.faceboxEl.getElement('.openidconnect_publish_feed_story_service_' + service);
	if(checkbox) {
	  checkbox.checked = false;
	}
  }
  
  if(typeof callback != 'undefined') {
	openidconnect_notify_connected_cb = callback;
  } else {
	openidconnect_notify_connected_cb = openidconnect_onNotifyConnected;
  }
  if(service == 'facebook') {

	  FB_RequireFeatures(["Connect"], function () {
		FB.Facebook.init(openidconnect_facebook_api_key, en4.core.basePath + 'xd_receiver.php', {doNotUseCachedConnectState: true, permsToRequestOnConnect : "offline_access,publish_stream"});
		FB.Connect.requireSession();
		FB.Facebook.get_sessionState().waitUntilReady(function (session_object) {

			//FB.Facebook.apiClient.users_hasAppPermission("publish_stream",function(has){
			//  if (has == 0) {
			//	FB.Connect.showPermissionDialog("publish_stream", function(granted){
			//	  
			//	  
			//	  
			//   });
			//  }
			//});    
		  
		  openidconnect_facebook_prompt_permission("offline_access,publish_stream", function() {openidconnect_onlogincomplete('','facebook');} );		  
		  //window.location = redirect_url;
		})
	  })
	
  } else {
	openidconnect_opener_window = openidconnect_newwindow( openidconnect_relay_url + '/login/' + service + '?inpopup=1' );
  }
  
}

function openidconnect_newwindow(url, title, options, retry) {

  options = 'menubar=0,toolbar=0,resizable=1,width=960,height=680';

  try {
    width = options.split('width=')[1].split(',')[0];
    height = options.split('height=')[1].split(',')[0];
    var window_left = (screen.width - width) / 2;
    var window_top = (screen.height - height) / 2;
    if (window_left < 0) {
      width = screen.width;
      window_left = 0;
    }
    if (window_top < 0) {
      height = screen.height;
      window_top = 0;
    }
    options += ',top=' + window_top + ',left=' + window_left;
  } catch(e) {}

  var newwin = window.open(url, title, options);
  if (!newwin) {
    newwin = window.open('', title, options);
    if (newwin && newwin.location) {
      newwin.location.href = url;
    }
  }
  if (!newwin && !retry) {
    window.setTimeout(function() { openidconnect_newwindow(url, title, options, 1) }, 10);
    return;
  }
  if (newwin && newwin.focus) {
    newwin.focus();
  }
  
  return newwin;

}



function openidconnect_onlogincomplete(session,service) {
  
  if(openidconnect_opener_window) {
	openidconnect_opener_window.close();
  }
  
  var ajax = new SEMods.Ajax(openidconnect_connect_onSuccess,openidconnect_connect_onFail);

  var params = 'format=json&openidsession=' + session + '&openidservice=' + service;
  ajax.post(en4.core.baseUrl + 'socialdna/index/' + 'connect', params)

}

function openidconnect_connect_onSuccess(obj, responseText) {
  var r = [];
  try {
	r = eval('(' + responseText + ')')
  } catch(e) {
	r.status = 1;
	r.err_msg = 'Woops.. HTTP Error!';
  };
  
  if (r.status == 0) {
	
	openidconnect_connected_services.push(r.service);
	
	if(openidconnect_notify_connected_cb) {
	 openidconnect_notify_connected_cb(r.service);
	}
	
  } else {
	
	// err_msg
	alert(r.err_msg);  

  }
  
}

function openidconnect_connect_onFail(obj, responseText) {

}


if(typeof OpenidConnect == 'undefined') {
  OpenidConnect = function() {};
}


 
function openidconnect_show_send_message(user_id, service_id) {
  
}


//function semods_wall_show(tab_id) {
//  
//  $('wall_updates').hide();
//  $('facebookwall_content').hide();
//  
//  $(tab_id).show();
//}

  