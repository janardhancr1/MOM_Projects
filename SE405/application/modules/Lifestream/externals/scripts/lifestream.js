
if(typeof OpenidConnect == 'undefined') {
  OpenidConnect = function() {};
}

OpenidConnect.FacebookWall = function() {
};
 
 
OpenidConnect.FacebookWall  = {

  page : 1,
  paging : false,
  
  item_id : '',
  
  action : 'sendMessage',
  reference_id : '',
  services : '',


  reload : function() {
	this.page = 1;
	this.paging = false;
	$('facebookwall_content').innerHTML = '';
	SEMods.B.hide('facebookwall_servicelogos');
	SEMods.B.show('facebookwall_loading');

	this.load(1);
  },

  
  load : function (refresh) {

	if(typeof refresh == 'undefined') {
	  refresh = 0;
	}
  	
	var ajax = new SEMods.Ajax(this.load_onSuccess.bind(this),this.load_onFail.bind(this));
  
	var params = { 'format' : 'html', 'page' : this.page, 'ajax' : 1, 'container' : 0, 'refresh' : refresh };
	

	ajax.post(lifestream_url, params)
  
  },
  
  load_onSuccess : function(obj, responseText) {
	//var r = obj.toResponse();
	
	//if (r.status == 0) {
	  
	  var holder;
	  if(!this.paging)  {
		holder = $('facebookwall_content');
	  } else {
		//holder = $("<div>");
		holder = document.createElement('DIV');
		//$('facebookwall_stories').append(holder);
		$('facebookwall_stories').appendChild(holder);
	  }
	  
	  holder.innerHTML = responseText;
	  
	//} else {
	  
	  // err_msg
	  //alert(r.err_msg);  
  
	//}
	
	SEMods.B.show('facebookwall_content');
	SEMods.B.show('facebookwall_servicelogos');
	
	SEMods.B.hide('facebookwall_loading');

	SEMods.B.hide('facebookwall_feed_view_more_loading');
	
	// layman's check for no more items
	//if(r.html.replace(/[\s\n\r\t]/g,'') != '' ) {
	if(responseText.replace(/[\s\n\r\t]/g,'') != '' ) {
	  SEMods.B.show('facebookwall_feed_view_more');
	}
	
  },
  
  load_onFail : function (obj, responseText) {
	
	SEMods.B.hide('facebookwall_loading');
	SEMods.B.hide('facebookwall_feed_view_more_loading');
	SEMods.B.show('facebookwall_feed_view_more');
  
  },
  
  load_more : function() {
	
	this.paging = true;
	
	$('facebookwall_feed_view_more_loading').innerHtml = 'Loading';
	
	SEMods.B.show('facebookwall_feed_view_more_loading');
	SEMods.B.hide('facebookwall_feed_view_more');
	
	this.page++;
	this.load();
  },
  
  



  send_message_start : function (id,action,text,reference_id,services) {

	if(typeof reference_id == 'undefined') {
	  reference_id = '';
	}
	
	if(typeof action == 'undefined') {
	  action = 'sendMessage';
	}
	
	if(typeof text == 'undefined') {
	  text = '';
	}

	if(typeof services == 'undefined') {
	  services = '';
	}
	
	this.reference_id = reference_id;
	this.action = action;
	this.services = services;
	
	this.item_id = id;
	//$('socialstream_messagebox_'+id).slideDown('slow', function() { $('socialstream_messageboxtext_'+id).focus(); });
	openidconnect_facebookwall_slidedown('socialstream_messagebox_'+id);
	$('socialstream_messageboxtext_'+id).focus();

	var el = $('socialstream_messagebox_'+this.item_id);

	el.getElement('.socialstream_msg_body').disabled = 0;

	el.getElement('.socialstream_msg_body').disabled = 0;
	el.getElement('.socialstream_msg_body').readonly = 0;
	el.getElement('.socialstream_msg_body').value = text;
	
	SEMods.B.show( el.getElement('.socialstream_msg_actions') );
	SEMods.B.hide( el.getElement('.socialstream_msg_sent') );
	
  },

  send_message_cancel : function() {

	openidconnect_facebookwall_slideup('socialstream_messagebox_'+this.item_id);
	
  },
  
  send_message : function () {
	
	var el = $('socialstream_messagebox_'+this.item_id);
	
	SEMods.B.show( el.getElement('.socialstream_msg_progress') );
	SEMods.B.hide( el.getElement('.socialstream_msg_actions') );

	el.getElement('.socialstream_msg_body').disabled = 1;
	el.getElement('.socialstream_msg_body').readonly = 1;

	var message = el.getElement('.socialstream_msg_body').value;
  
	var to = el.getElement('.socialstream_message_to').value;
	
	var ajax = new SEMods.Ajax(this.send_message_onSuccess.bind(this),this.send_message_onFail.bind(this));
  
	var subject = '';
	
	var params = { 'format' : 'json', 'subject' : subject, 'message' : message, 'to' : to, 'reference_id' : this.reference_id, 'services' : this.services };

	ajax.post(en4.core.baseUrl + 'socialdna/index/' + this.action, params)
	
  },
  
  send_message_onSuccess : function(obj, responseText) {
	var r = obj.toResponse();

	var el = $('socialstream_messagebox_'+this.item_id);

	SEMods.B.hide( el.getElement('.socialstream_msg_progress') );
	SEMods.B.show( el.getElement('.socialstream_msg_sent') );
	
	if (r.status == 0) {
	  
	  
	} else {
	  
	  // err_msg
	  //alert(r.err_msg);  
  
	}
	
	setTimeout( this.send_message_cancel.bind(this), 1000) ;
	
  },
    
  send_message_onFail : function(obj, responseText) {

	var el = $('socialstream_messagebox_'+this.item_id);

	SEMods.B.hide( el.getElement('.socialstream_msg_progress') );
	setTimeout( this.send_message_cancel.bind(this), 1000) ;
  
  }
  
}  

function openidconnect_facebookwall_slideup(elem) {

  var slide = new Fx.Slide(elem);
  
  slide.slideOut();

  //$('elem').set('html', 'content');
  
}

function openidconnect_facebookwall_slidedown(elem) {

  $(elem).style.display = 'block';

  var slide = new Fx.Slide(elem);
  
  slide.slideIn();
  
}

function openidconnect_facebookwall_reload() {
  SEMods.B.hide('facebookwall_content');
  SEMods.B.hide('facebookwall_servicelogos');
  SEMods.B.show('facebookwall_loading');
  OpenidConnect.FacebookWall.load();
}


LFM = function() {};
LFM.Flash = function() {};
LFM.Flash.Player = function() {};

LFM.Flash.Player = {  

  player_id : '',
  
  onLoad:function(){
    //setTimeout(function() {LFM.Flash.Player.play(LFM.Flash.Player.player_id);},250);    
  },
  play: function(player_id) {
    LFM.Flash.Player.flashExternalAPICall(player_id, "handleJSSkip");
  },
  stop: function(player_id) {
    LFM.Flash.Player.flashExternalAPICall(player_id, "handleJSStopPlayback");
  },
  getEmbed: function(player_id) {
    return $(player_id).get(0);
  },
  flashExternalAPICall: function(player_id, _e, _f) {
    var _10 = LFM.Flash.Player.getEmbed(player_id);
    if (_10) {
      //for (var i in _f) {
      //  _10.SetVariable(i, _f[i]);
      //}
      try {
        _10.TCallLabel("/", _e);
      } catch(e) {
      }
    } else {
    }
  },
  onMouseDownViewport: function() {
    
  }
  
}











OpenidConnect.Friends = function() {
};
 
 
OpenidConnect.Friends  = {

  friends_loaded : [],
  friends_checked : [],
  friends_checked_total : 0,
  total_friends : 0,
  
  service_id : 0,
  page : 0,
  page_from : 0,
  page_to : 0,
  
  max_recipients : 10,  

  //can_message : [10,12],

  can_message : [1,10,12],	// with facebook

  check_caps : true,
  
  lang_cap1 : '',

  suggest : '',

  perms_rounds : 0,
  perms_rounds_max : 2,


  get_selected_friends : function () {
	var friends = [];
	for (var i in this.friends_checked) {
	  if(typeof this.friends_checked[i] == 'undefined') {
		continue;
	  }
	  if(typeof this.friends_checked[i].u == 'undefined') {
		continue;
	  }
	  friends.push(this.friends_checked[i].u);
	  friends.push(this.friends_checked[i].s);
	}
	return friends.join(',');
  },

  toggle_friend_row : function (e, elem) {

    var e = e ? e: window.event;
    var src = (e.srcElement) ? e.srcElement: e.target;
	if((src.tagName == "A") && (src.className == "openidconnect_friend_link")) {
	  return;
	}


	var inputs = elem.getElementsByTagName('input');
	var input = inputs[0];
	
	if(this.check_caps) {
	  if(!input.checked) {
  
		if( !this.can_message.contains(parseInt(this.friends_loaded[input.value].s)) ) {
		  alert(this.lang_cap1);
		  return;
		}

	  }
	}

	this.toggle_current_div(e, elem);
	
	this.manage_friend_element(input, elem);
	
	this.update_checked_friends();
	
  },
  
  update_checked_friends : function() {
	$('openidconnect_friends_selector_selected_count').set('html',this.friends_checked_total + '');
  },
  
  update_total_friends : function() {
	$('openidconnect_friends_selector_all_count').set('html',this.total_friends + '');
  },

  manage_friend_element : function(input, elem) {

	if(!input.checked) {

	  // update currently displayed friends
	  if(this.friends_loaded[input.value]) {
		//this.friends_loaded[input.value].e.checked = false;
		if(elem.parentNode.id != 'openidconnect_friends') {
		  this.toggle_current_div({srcElement:'div',tagName:'div',type:''},this.friends_loaded[input.value].e);
		}
	  }

	  // remove from checked
	  var el = this.friends_checked[input.value].e;
	  el.parentNode.removeChild(el);
	  delete this.friends_checked[input.value];
	  //this.friends_checked[input.value] = null;
	  
	  this.friends_checked_total--;
	  
	} else {
	  // add to checked

	  var holder = $('openidconnect_friends_checked');
	  
	  var el = elem.cloneNode(true);
	  $(el).id = '';

	  $(el).getElement('.openidconnect_friend_id').checked = true;

	  el.inject(holder, 'top');
	  
	  this.friends_checked[input.value] = { 'e' : el, 'u' : input.value, 's' : this.friends_loaded[input.value].s };
	  this.friends_checked_total++;

	}
	
  },

  toggle_current_div : function (e, elem) {

    var e = e ? e: window.event;
    var src = (e.srcElement) ? e.srcElement: e.target;
	if((src.tagName == "INPUT") && (src.type == "checkbox")) {
	  return;
	}

	var inputs = elem.getElementsByTagName('input');
	inputs[0].checked = !inputs[0].checked ;

	while (elem && !/openidconnect_friendrow/i.test(elem.className)) {
	  elem = elem.parentNode;
	}
	
	elem.className = inputs[0].checked ? 'openidconnect_friendrow openidconnect_friendrow_selected' : 'openidconnect_friendrow';

  },


  get_friends : function () {
	
	this.friends_loaded = [];



	var ajax = new SEMods.Ajax(this.get_friends_onSuccess.bind(this),this.get_friends_onFail.bind(this));
  
	var subject = '';
	
	var params = { 'format' : 'json', 'openidservice' : this.service_id, 'page' : this.page, 'suggest' : this.suggest };

	ajax.post(en4.core.baseUrl + 'socialdna/index/' + 'getfriends', params)
  
  },
  
  get_friends_onSuccess : function(obj, responseText) {
	var r = obj.toResponse();
	
	if (r.status == 0) {
	  
	  var holder = $('openidconnect_friends');
	  holder.set('html','<div style="clear:both"></div>');
	  
	  for(var i=0;i<r.friends.length;i++) {
		var el = $('openidconnect_friendrow').clone(true);
		el.id = '';
  
		var control_elem = el.getElement('.openidconnect_friend_id');
		control_elem.value = r.friends[i].u;
		
		//el.getElement('.openidconnect_service_id').value = r.friends[i].s;
		
		el.getElement('.openidconnect_friend_photo').src = r.friends[i].t;
		if(r.friends[i].l != '') {
		  el.getElement('.openidconnect_friend_name').set('html','<a class="openidconnect_friend_link" target=_blank href="' + r.friends[i].l + '">' + r.friends[i].n + '</a>');
		} else {
		el.getElement('.openidconnect_friend_name').set('html',r.friends[i].n);
		}
		if(r.friends[i].st != '') {
		  el.getElement('.openidconnect_friend_status').set('html',r.friends[i].st);
		}
		
		el.getElement('.openidconnect_friend_service').className = 'openidconnect_friend_service openidconnect_friend_service_'+r.friends[i].s;
		
		this.friends_loaded[r.friends[i].u] = { 'e' : el, 'u' : r.friends[i].u, 's' : r.friends[i].s };
  
		if(this.friends_checked[r.friends[i].u]) {
		  this.toggle_current_div({srcElement:'div',tagName:'div',type:''},el.get(0));
		}
		
		el.inject(holder, 'top');
		
	  }
	  
	  var clearDiv = new Element('div');
	  clearDiv.style.clear = 'both';
	  
	  clearDiv.inject(holder);
	  
	  this.page = r.page;
	  this.page_from = r.page_from;
	  this.page_to = r.page_to;
	  this.total_friends = r.total_friends;

	  if(r.friends.length == 0) {
		this.page_from = 0;
		holder.set('html',$('openidconnect_nofriends').innerHTML);
	  }
	  
	  
	  $('openidconnect_friends_pager_from').set('html',this.page_from+"");
	  $('openidconnect_friends_pager_to').set('html',this.page_to+"");
	  $('openidconnect_friends_pager_total').set('html',this.total_friends+"");
	  
	  
	} else {
	  
	  // err_msg
	  //alert(r.err_msg);  
  
	}
	
	$('openidconnect_friends_service').disabled = 0;
	
	SEMods.B.show('openidconnect_friends_control');
	
	SEMods.B.hide('openidconnect_friends_loading');
	
  },
  
  get_friends_onFail : function (obj, responseText) {
	
  
  },

  send_message : function () {

	SEMods.B.show('openidconnect_msg_progress');
	SEMods.B.hide('openidconnect_msg_actions');
	
	$('openidconnect_msg_subject').disabled = 1;
	$('openidconnect_msg_body').disabled = 1;

	$('openidconnect_msg_subject').readonly = 1;
	$('openidconnect_msg_body').readonly = 1;
  
	var subject = $('openidconnect_msg_subject').value;
	var message = $('openidconnect_msg_body').value;
  
	var to = this.get_selected_friends();
  


	var ajax = new SEMods.Ajax(this.send_message_onSuccess.bind(this),this.send_message_onFail.bind(this));
	
	var params = { 'format' : 'json', 'subject' : subject, 'message' : message, 'to' : to };

	ajax.post(en4.core.baseUrl + 'socialdna/index/' + 'sendMessage', params)

  },
  
  send_message_onSuccess : function(obj, responseText) {
	var r = obj.toResponse();

	SEMods.B.hide('openidconnect_msg_progress');
	
	if (r.status == 0) {

	  SEMods.B.show('openidconnect_msg_sent');
	  
	} else if ((r.status == 200) || (r.status == 205) || (r.status == 100)) {
	  
	  this.perms_rounds++;

	  SEMods.B.hide('openidconnect_msg_progress');
	  SEMods.B.show('openidconnect_msg_actions');
	  
	  $('openidconnect_msg_subject').disabled = 0;
	  $('openidconnect_msg_body').disabled = 0;
  
	  $('openidconnect_msg_subject').readonly = 0;
	  $('openidconnect_msg_body').readonly = 0;

	  openidconnect_facebook_prompt_permission("offline_access,xmpp_login", function(perms) {
		if((perms != '') && (OpenidConnect.Friends.perms_rounds <= OpenidConnect.Friends.perms_rounds_max)) {
		  OpenidConnect.Friends.send_message();
		}
	  });

	  return;
	  
	} else {
	  
	  // err_msg
	  //alert(r.err_msg);  
  
	}
	
	setTimeout( this.send_message_cancel.bind(this), 1000) ;
	
  },
    
  send_message_onFail : function(obj, responseText) {

	SEMods.B.hide('openidconnect_msg_progress');
	setTimeout( this.send_message_cancel.bind(this), 1000);
  
  },
  
  page_left : function() {
	this.page = this.page-1;
	this.get_friends();
  },
  
  page_right : function() {
	this.page = this.page+1;
	this.get_friends();
  },
  
  service_onChange : function() {

	$('openidconnect_friends_service').disabled = 1;
	this.service_id = $('openidconnect_friends_service').value;
	
	this.get_friends();
	
  },
  
  send_message_cancel : function() {
	$('openidconnect_msg_subject').disabled = 0;
	$('openidconnect_msg_body').disabled = 0;

	$('openidconnect_msg_subject').readonly = 0;
	$('openidconnect_msg_body').readonly = 0;

	$('openidconnect_msg_subject').value = '';
	$('openidconnect_msg_body').value = '';

	
	openidconnect_facebookwall_slideup('openidconnect_send_message');
	
	SEMods.B.show('openidconnect_send_message_hint');
	SEMods.B.hide('openidconnect_msg_sent');
	SEMods.B.show('openidconnect_msg_actions');
	
  },
  
  set_display : function (type) {
	
	var holder = $('openidconnect_friends_control');

	
	if(type == 'list') {
	  holder.removeClass('openidconnect_friends_gridview');
	  holder.addClass('openidconnect_friends_listview');
	} else {
	  holder.removeClass('openidconnect_friends_listview');
	  holder.addClass('openidconnect_friends_gridview');
	}
	
  },
  
  show_all : function() {
	SEMods.B.hide('openidconnect_friends_checked');
	SEMods.B.show('openidconnect_friends');

	$('openidconnect_friends_selector_selected').removeClass('openidconnect_friends_selector_selected');
	$('openidconnect_friends_selector_all').addClass('openidconnect_friends_selector_selected');
  },
  
  show_selected : function() {
	SEMods.B.hide('openidconnect_friends');
	SEMods.B.show('openidconnect_friends_checked');

	$('openidconnect_friends_selector_all').removeClass('openidconnect_friends_selector_selected');
	$('openidconnect_friends_selector_selected').addClass('openidconnect_friends_selector_selected');

  },

  typeahead : function() {
	this.suggest = $('openidconnect_friends_suggest').value;
	this.get_friends();
  }

 
}
