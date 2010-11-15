<?php
  $this->headScript()
    ->appendFile($this->baseUrl() . 'application/modules/Semods/externals/scripts/semods.js')
    ->appendFile($this->baseUrl() . 'application/modules/Socialdna/externals/scripts/socialdna.js')
    ->appendFile($this->baseUrl() . 'application/modules/Lifestream/externals/scripts/lifestream.js')
?>

<?php if (!$this->wall_via_ajax): ?>    

<script>
  var lifestream_url = '<?php echo $this->url(array('module' => 'core', 'controller' => 'widget', 'action' => 'index', 'content_id' => $this->identity), 'default', true) ?>';
</script>


<?php endif; ?>
  

  <?php if ($this->wait_for_data): ?>

  <div id='facebookwall_wrapper'>

    <div id='facebookwall_loading' style='text-align: center'>
      <div style="width: 100px; margin: 50px auto">
        <img border='0' src="application/modules/Socialdna/externals/images/icons/ajaxprogress2.gif">          
      </div>
    </div>
    
    <?php if ($this->service_connected): ?>
    <div class="facebookwall_servicelogos" id="facebookwall_servicelogos" style="display:none">
      <div class="facebookwall_servicelogo"><span style="color: #888"><?php echo $this->translate('lifestream_socialstream_updatesfrom') ?></span></div>
      <?php foreach($this->openid_services as $openid_service): ?>
      <div class="facebookwall_servicelogo"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></div>
      <?php endforeach; ?>
      <div class="facebookwall_servicelogo" style="float: right"><a href="javascript:void(0)" onclick="OpenidConnect.FacebookWall.reload(); this.blur();"><span style="color: #888"><?php echo $this->translate('refresh') ?></span></a><span style='padding-left: 3px; padding-right: 3px; color: #EEE'>|</span><a href="<?php echo $this->url(array(),'socialdna') ?>"><span style="color: #888"><?php echo $this->translate('lifestream_socialstream_connectmore') ?></span></a></div>
      <div style="clear: both"></div>    
    </div>
    <div class='facebookwall_content' id='facebookwall_content'>
    </div>
    <?php endif; ?>

  </div>
  
  <?php else: ?>

  <?php if (!$this->wall_via_ajax): ?>
    <?php if ($this->service_connected): ?>
    <div class="facebookwall_servicelogos" id="facebookwall_servicelogos">
      <div class="facebookwall_servicelogo"><span style="color: #888"><?php echo $this->translate('lifestream_socialstream_updatesfrom') ?></span></div>
      <?php foreach($this->openid_services as $openid_service): ?>
      <div class="facebookwall_servicelogo"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></div>
      <?php endforeach; ?>
      <div class="facebookwall_servicelogo" style="float: right"><a href="javascript:void(0)" onclick="OpenidConnect.FacebookWall.reload(); this.blur();"><span style="color: #888"><?php echo $this->translate('refresh') ?></span></a><span style='padding-left: 3px; padding-right: 3px; color: #EEE'>|</span><a href="<?php echo $this->url(array(),'socialdna') ?>"><span style="color: #888"><?php echo $this->translate('lifestream_socialstream_connectmore') ?></span></a></div>
      <div style="clear: both"></div>    
    </div>
    <div id='facebookwall_loading' style='text-align: center; display: none'>
      <div style="width: 100px; margin: 50px auto">
        <img border='0' src="application/modules/Socialdna/externals/images/icons/ajaxprogress2.gif">          
      </div>
    </div>
    <?php endif; ?>
    <div class='facebookwall_content' id='facebookwall_content'>
  <?php endif; ?>
  
    <?php if ($this->service_connected): ?>
    
    <?php if ($this->permissions_required): ?>

    <div id="facebookwall_stories" class='content'>
      <br>
      <br>
      <table cellpadding='0' cellspacing='0' style='margin: 0px auto'>
      <tr><td>

        <a href="javascript:openidconnect_facebook_prompt_permission('read_stream',openidconnect_facebookwall_reload)"> <?php echo $this->translate('lifestream_socialstream_enable_facebook') ?> </a>
  
      </td></tr>
      </table>
  
      <br>
      <br>
    </div>
    
    <?php else: ?>
    
    <?php if ($this->page == 1): ?>    
    <div id="facebookwall_stories" class='content'>
    <?php endif; ?>
    
    <?php if (!($this->wall_via_ajax AND count($this->newsfeed) == 0)): ?>
    <div class="UIIntentionalStream_Content" <?php if ($this->wait_for_data): ?>style='display:none'<?php endif; ?>>
    <?php endif; ?>
      
    <?php if (is_array($this->newsfeed) && (count($this->newsfeed) > 0) ) : ?>
    <?php foreach($this->newsfeed as $index => $stream_item) : // name=facebookwall_loop} ?>
    <?php $stream_action_date = $stream_item['created_time']; ?>

    <div class="UIStream">
      <div class="<?php if ($index == 0 AND $this->page == 1): ?>UIStory_First<?php endif; ?> UIStory UIIntentionalStory GenericStory">
        <?php /*
        <div class="openidconnect_feed_friend_service openidconnect_friend_service_<?php echo $stream_item.service_id ?>"></div>
        <div class="UIStreamLinks">        
          <div><a target=_blank href="<?php echo $stream_item.actor.url ?>">View Profile</a></div>
          <div style="padding-top: 3px"><a href="javascript:void(0)" onclick="openidconnect_show_send_message('<?php echo $stream_item.actor.id ?>','1')"><?php echo $this->translate('lifestream_socialstream_send_message') ?></a></div>
        </div>
              */ ?>
        <!--<div style="width: 50px;">-->
        <a target=_blank title="<?php echo $stream_item['actor']['name'] ?>" class="UIIntentionalStory_Pic" href="<?php echo $stream_item['actor']['url'] ?>"><img src="<?php echo $stream_item['actor']['pic_square'] ?>" class="UIProfileImage UIProfileImage_LARGE" alt="<?php echo $stream_item['actor']['name'] ?>"/></a>
        <!--</div>-->
        <div class="UIIntentionalStory_Header">
          <h3 class="UIIntentionalStory_Message">
            <span class="UIIntentionalStory_Names"><a target=_blank href="<?php echo $stream_item['actor']['url'] ?>"><?php echo $stream_item['actor']['name'] ?></a></span>
            <span class="UIStory_Message"><?php echo $stream_item['message'] // |split:50:true} ?> </span>
          </h3>
        </div>
        <?php if (is_array($stream_item['attachment']) AND !empty($stream_item['attachment'])): ?>
          <div class="UIStoryAttachment">
            <?php if (isset($stream_item['attachment']['media']) && is_array($stream_item['attachment']['media']) AND !empty($stream_item['attachment']['media'])): ?>
              <?php if ($stream_item['attachment']['media'][0]['type'] == 'music'): ?>
                <div class="UIStoryAttachment_Media UIStoryAttachment_MediaSingle">
                  <div class="UIMediaItem">
                    <div class="UIMediaItem">
                      <div id="mp3player_feed_mp3_4ab5bf04561da64940719714ab5bf045c6957277177496" class="mp3player_holder">
                        <embed width="195px"  Xwidth="300px" height="29px"
                               flashvars="width=195&amp;height=29&amp;audio_log=http%3A%2F%2Fwww.facebook.com%2Fajax%2Fapplications%2Fmusicplayer%2Faudio_listen_log.php&amp;fbt_artist=Artist&amp;fbt_title=Song&amp;fbt_album=Album&amp;fbt_unavailable=Unavailable&amp;show_title=0&amp;src=<?php echo $stream_item['attachment']['media'][0]['encrypted_src'] ?>&amp;song=<?php if (isset($stream_item['attachment']['media'][0]['title'])): ?><?php echo $stream_item['attachment']['media'][0]['title'] ?><?php endif; ?>&amp;artist=Unknown+Artist&amp;string_table=http://b.static.ak.fbcdn.net/js_strings.php/t87043/en_US&amp;swf_id=so_feed_mp3_4ab5bf04561da6494071971_4ab5bf045c7ea6d48718385"
                               wmode="transparent"
                               allowscriptaccess="always"
                               scale="noscale"
                               quality="high"
                               bgcolor="#ffffff"
                               name="so_feed_mp3_4ab5bf04561da6494071971_4ab5bf045c7ea6d48718385"
                               id="so_feed_mp3_4ab5bf04561da6494071971_4ab5bf045c7ea6d48718385"
                               style=""
                               src="http://static.ak.fbcdn.net/rsrc.php/z3ZXH/hash/7s3ti32z.swf"
                               type="application/x-shockwave-flash"/>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if (isset($stream_item['attachment']['description'])): ?> 
                <div class="UIStoryAttachment_Copy">
                  <div class="CopyTitle"><?php echo $stream_item['attachment']['description'] ?></div>
                </div>
                <?php endif; ?>

              <?php elseif ($stream_item['attachment']['media'][0]['type'] == 'video') : ?>

                <div class="UIStoryAttachment_Media UIStoryAttachment_MediaSingle">
                  <div class="UIMediaItem">
                    <div class="UIMediaItem_video">
                      <div class="share_media clearfix">
                        <div class="video_extra" id="so_164933368661_4ab843ca7112f37064adf_holder">
                          <?php if (isset($stream_item['meta']) AND isset($stream_item['meta']['video_url']) AND isset($stream_item['meta']['streamable']) AND ($stream_item['meta']['streamable'] == 1)): ?>
                          <a title="<?php echo $this->translate('lifestream_socialstream_media_click_play_video') ?>" class="video_extra_anchor" onclick="openidconnect_facebookwall_slidedown('socialstream_media_<?php echo $stream_item['id'] ?>');return false;">
                          <?php else: ?>
                          <a target=_blank href="<?php echo $stream_item['permalink'] ?>" title="Click to play video" class="video_extra_anchor" Xonclick="facebookwall_play_video();return false;">
                          <?php endif; ?>
                            <div class="video_thumb">
                              <span class="thumb">
                                <img alt="" src="<?php echo $stream_item['attachment']['media'][0]['video']['preview_img'] ?>"/>
                              </span>
                              <span class="play">
                                <img alt="" src="<?php echo $stream_item['attachment']['media'][0]['video']['preview_img'] ?>"/>
                              </span>
                              <img class="decoy" alt="" src="<?php echo $stream_item['attachment']['media'][0]['video']['preview_img'] ?>"/>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php if (isset($stream_item['attachment']['description'])): ?>                 
                <div class="UIStoryAttachment_Copy">
                  <?php echo $stream_item['attachment']['description'] ?>
                </div>                
                <?php endif; ?>

              <?php elseif ($stream_item['attachment']['media'][0]['type'] == 'link') : ?>

                <?php if (count($stream_item['attachment']['media']) == 1): ?>
                <div class="UIStoryAttachment_Media UIStoryAttachment_MediaSingle">
                  <div class="UIMediaItem">
                    <div class="UIMediaItem">
                        <a target=_blank href="<?php echo $stream_item['attachment']['media'][0]['href'] ?>">
                        <div style="" class="UIMediaItem_Wrapper">
                          <img alt="" src="<?php echo $stream_item['attachment']['media'][0]['src'] ?>"/>
                        </div>
                      </a>
                    </div>              
                  </div>
                </div>
                <?php else: ?>
                  <div class="UIStoryAttachment_Media UIStoryAttachment_MediaWide">
                    <?php foreach( $stream_item['attachment']['media'] as $attachment_media_key => $attachment_media) : // name=facebookwall_attachment_media_loop ?>
                    <div class="<?php if ($attachment_media_key !=0): ?>UIIntentionalStory_MediaExtra <?php endif; ?>UIMediaItem_ManyItems UIMediaItem">
                      <a target=_blank href="<?php echo $attachment_media['href'] ?>">
                        <div class="UIMediaItem_Wrapper" style="">
                          <img src="<?php echo $attachment_media['src'] ?>" alt="">
                        </div>
                      </a>
                    </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
                <?php if (isset($stream_item['attachment']['description']) OR isset($stream_item['attachment']['name'])): ?> 
                <div class="UIStoryAttachment_Info">
                  <?php if (isset($stream_item['attachment']['name'])): ?> 
                  <div class="UIStoryAttachment_Title">
                    <a target=_blank href="<?php echo $stream_item['permalink'] ?>" target="_blank"><?php echo $stream_item['attachment']['name'] ?></a>
                  </div>
                  <?php endif; ?>
                  <?php if (isset($stream_item['attachment']['description'])): ?> 
                  <div class="UIStoryAttachment_Copy">
                    <?php echo $stream_item['attachment']['description'] ?>
                  </div>
                  <?php endif; ?> 
                </div>
                <?php endif; ?>                
                <?php if (isset($stream_item['attachment']['caption'])): ?><div class="UIStoryAttachment_Caption"><?php echo $stream_item['attachment']['caption'] ?></div><?php endif; ?>
                <?php if (is_array($stream_item['attachment']['properties']) AND !empty($stream_item['attachment']['properties'])): ?>
                  <div class="UIStoryAttachment_Table">
                    <?php foreach($stream_item['attachment']['properties'] as $attachment_property): ?>
                    <div>
                      <?php if (isset($attachment_property['name'])): ?><span class="UIStoryAttachment_Label"><?php echo $attachment_property['name'] ?>:</span><?php endif; ?>
                      <span class="UIStoryAttachment_Value"><?php echo $attachment_property['text'] ?></span>
                    </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; /* properties */ ?>
              <?php elseif ($stream_item['attachment']['media'][0]['type'] == 'swf') : ?>
                <div class="UIStoryAttachment_Media UIStoryAttachment_MediaSingle">
                  <div class="UIMediaItem">
                    <a target=_blank href="<?php echo $stream_item['permalink'] ?>" class="uiVideoThumb" title="<?php echo $this->translate("Click to play video")?>" >
                      <img class="img" src="<?php echo $stream_item['attachment']['media'][0]['swf']['preview_img'] ?>" width="<?php echo $stream_item['attachment']['media'][0]['swf']['width'] ?>" height="<?php echo $stream_item['attachment']['media'][0]['swf']['height'] ?>">
                      <i></i>
                    </a>
                  </div>
                </div>
                <div class="UIStoryAttachment_Info">
                  <div class="UIStoryAttachment_Title">
                    <a href="<?php echo $stream_item['permalink'] ?>" target="_blank"><?php echo $stream_item['attachment']['name'] ?></a>
                  </div>
                  <?php if (isset($stream_item['attachment']['description'])): ?> 
                  <div class="UIStoryAttachment_Copy">
                    <?php echo $stream_item['attachment']['description'] ?>
                  </div>
                  <?php endif; ?>
                </div>
              <?php elseif ($stream_item['attachment']['media'][0]['type'] == 'photo') : ?>
                <div class="UIStoryAttachment_Media UIStoryAttachment_MediaWide">
                  <?php foreach( $stream_item['attachment']['media'] as $attachment_media_key => $attachment_media) : //name=facebookwall_attachment_media_loop item= ?>
                  <div class="<?php if ($attachment_media_key !=0): ?>UIIntentionalStory_MediaExtra <?php endif; ?>UIMediaItem_ManyItems UIMediaItem UIMediaItem_Photo">
                    <a target=_blank href="<?php echo $attachment_media['href'] ?>">
                      <div class="UIMediaItem_Wrapper" style="">
                        <img src="<?php echo $attachment_media['src'] ?>" alt="">
                      </div>
                    </a>
                  </div>
                  <?php endforeach; ?>
                </div>
                <?php if (isset($stream_item['attachment']['href']) AND isset($stream_item['attachment']['name'])): ?>
                <div class="UIStoryAttachment_Title UIStoryAttachment_TitleBelow">
                  <a target=_blank href="<?php echo $stream_item['attachment']['href'] ?>"><?php echo $stream_item['attachment']['name'] ?></a>
                </div>
                <?php endif; ?>
                <?php if (isset($stream_item['attachment']['caption']) AND ($stream_item['attachment']['caption'] != '')): ?>
                <div class="UIStoryAttachment_Caption"><?php echo $stream_item['attachment']['caption'] ?></div>
                <?php endif; ?>
                <?php /*
                <div class="UIStoryAttachment_Caption"><?php echo $stream_item.attachment.caption ?></div>
                <?php if (is_array($stream_item.attachment.properties) AND !empty($stream_item.attachment.properties)): ?>
                  <div class="UIStoryAttachment_Table">
                    <?php foreach($this->view->stream_item.attachment.properties as $attachment_property): ?>
                    <div>
                      <?php if (isset($attachment_property.name)): ?><span class="UIStoryAttachment_Label"><?php echo $attachment_property.name ?>:</span><?php endif; ?>
                      <span class="UIStoryAttachment_Value"><?php echo $attachment_property.text ?></span>
                    </div>
                    <?php endforeach; ?>
                  </div>
                <?php endif; ?> {* properties * }
                      */ ?>
              <?php endif; /* media type */ ?>

            <?php elseif (isset($stream_item['attachment']['caption'])) : /* no media */ ?>

              <div class="UIStoryAttachment_BlockQuote">
                <div class="UIStoryAttachment_Title">
                  <a target="_blank" href="<?php echo $stream_item['attachment']['href'] ?>"><?php echo $stream_item['attachment']['name'] ?></a>
                </div>
                <div class="UIStoryAttachment_Caption"><?php echo $stream_item['attachment']['caption'] ?></div>
              </div>            

            <?php elseif (isset($stream_item['attachment']['name']) && isset($stream_item['attachment']['href'])) : /* no media */ ?>

              <div class="UIStoryAttachment_BlockQuote">
                <div class="UIStoryAttachment_Title">
                  <a target="_blank" href="<?php echo $stream_item['attachment']['href'] ?>"><?php echo $stream_item['attachment']['name'] ?></a>
                </div>
                <?php if (isset($stream_item['attachment']['description'])): ?>
                <div class="UIStoryAttachment_Copy">
                  <?php echo $stream_item['attachment']['description'] ?>
                </div>
                <?php endif; ?>
              </div>            

            <?php elseif (isset($stream_item['attachment']['description'])) : /* no media */ ?>

            <div class="UIStoryAttachment_Copy">
              <?php echo $stream_item['attachment']['description'] ?>
            </div>
            
          <?php endif; /* media */ ?> 
        </div>
        <?php endif; /* attachment */ ?> 
        <div class="commentable_item no_comments autoexpand_mode">
            <span class="UIActionLinks UIActionLinks_bottom UIIntentionalStory_Info">
              <div class="UIImageBlock clearfix">
                <?php if (is_array($stream_item['attachment']) AND !empty($stream_item['attachment']) AND $stream_item['attachment']['icon'] != ''): ?>
                <a target=_blank title="<?php echo $stream_item['attribution'] ?>" class="UIImageBlock_Image" href="<?php echo $stream_item['app_link'] ?>"><img src="<?php echo $stream_item['attachment']['icon'] ?>" class="spritemap_icons sx_icons_hidden" alt=""/></a>
                <?php endif; ?>
                <div class="UIImageBlock_Content"><span class="UIIntentionalStory_InfoText">
                <span class="UIIntentionalStory_Time">
                  <a target=_blank href="<?php echo $stream_item['permalink'] ?>"><?php if($stream_item['created_time'] != 0) : ?><?php echo $this->timestamp($stream_item['created_time']) ?><?php endif; ?></a>
                </span>
                </span> &#8901;
                <?php if ($stream_item['service_id'] == 1): ?>
                <?php if ($stream_item['permalink'] != ''): ?><span><a target=_blank href="<?php echo $stream_item['permalink'] ?>"><?php echo $this->translate('lifestream_socialstream_comment') ?></a></span> &#8901; <span class="like_link like_not_exists" id="like_link_<?php echo $stream_item['id'] ?>"><a target=_blank href="<?php echo $stream_item['permalink'] ?>"><?php echo $this->translate('lifestream_socialstream_like') ?></a><span class="hidden_separator"> / </span><a target=_blank href="<?php echo $stream_item['permalink'] ?>"><?php echo $this->translate('lifestream_socialstream_unlike') ?></a></span><?php if (!$stream_item['actor']['is_owner']): ?> &#8901; <span class="like_link like_not_exists"><a href="javascript:void(0)" onclick="OpenidConnect.FacebookWall.send_message_start('<?php echo $stream_item['id'] ?>');"><?php echo $this->translate('lifestream_socialstream_message') ?></a></span><?php endif; ?><?php endif; ?>
                <?php endif; ?>
                <?php if ($stream_item['service_id'] == 10): ?>
                <?php if ($stream_item['permalink'] != ''): ?><?php if (!$stream_item['actor']['is_owner']): ?><span><a href="javascript:void(0)" onclick="OpenidConnect.FacebookWall.send_message_start('<?php echo $stream_item['id'] ?>','updateStatus', '@<?php echo $stream_item['actor']['nickname'] ?> ', '<?php echo $stream_item['id'] ?>','twitter');"><?php echo $this->translate('lifestream_socialstream_reply') ?></a></span> &#8901; <span><a href="javascript:void(0)" onclick="OpenidConnect.FacebookWall.send_message_start('<?php echo $stream_item['id'] ?>','updateStatus', 'RT @<?php echo $stream_item['actor']['nickname'] ?>: <?php echo $stream_item['message_jssafe'] ?>', '<?php echo $stream_item['id'] ?>','twitter')"><?php echo $this->translate('lifestream_socialstream_retweet') ?></a></span> &#8901; <span class="like_link like_not_exists"><a href="javascript:void(0)" onclick="OpenidConnect.FacebookWall.send_message_start('<?php echo $stream_item['id'] ?>');"><?php echo $this->translate('lifestream_socialstream_message') ?></a></span><?php endif; ?><?php endif; ?>
                <?php endif; ?>
                <?php if ($stream_item['service_id'] == 12): ?>
                <?php if (!$stream_item['actor']['is_owner']): ?><span class="like_link like_not_exists"><a href="javascript:void(0)" onclick="OpenidConnect.FacebookWall.send_message_start('<?php echo $stream_item['id'] ?>');"><?php echo $this->translate('lifestream_socialstream_message') ?></a></span><?php endif; ?>
                <?php endif; ?>
                <?php /* if ($stream_item.service_id == 26) AND ($stream_item.meta.track_id != '0') */ ?>
                <?php if ($stream_item['service_id'] == 26): ?>
                <!-- <span class="like_link like_not_exists"><a href="javascript:void(0)" onclick="LFM.Flash.Player.player_id='socialstream_media_<?php echo $stream_item['id'] ?>_player'; openidconnect_facebookwall_slidedown('socialstream_media_<?php echo $stream_item['id'] ?>')"><?php echo $this->translate('lifestream_socialstream_media_play_song') ?></a></span> -->
                <?php endif; ?>
                <?php if ($stream_item['service_id'] == 34): ?>
                <span class="like_link like_not_exists"><a href="javascript:void(0)" onclick="openidconnect_facebookwall_slidedown('socialstream_media_<?php echo $stream_item['id'] ?>')"><?php echo $this->translate('lifestream_socialstream_media_play_video') ?></a></span>
                <?php endif; ?>
                </div>
              </div>
            </span>
        </div>
        <?php if ($stream_item['service_id'] == 26): ?>
        <div class="socialstream_media" id="socialstream_media_<?php echo $stream_item['id'] ?>" style="display: none; text-align: center; Xposition: relative; margin-top: 10px; padding: 5px; border: 1px solid #EEE">
            <img style="float: right; Xposition: absolute; right: 2px; top: 2px;" onclick="LFM.Flash.Player.stop('socialstream_media_<?php echo $stream_item['id'] ?>_player'); openidconnect_facebookwall_slideup('socialstream_media_<?php echo $stream_item['id'] ?>')" width=16 height=16 src='application/modules/Lifestream/externals/images/icon_close.gif'>
              <div style="visibility: visible; display: block">
                <embed id="socialstream_media_<?php echo $stream_item['id'] ?>_player" height="221" width="300" align="middle" swliveconnect="true" name="lfmPlayer" id="lfmPlayer" allowfullscreen="true" allowscriptaccess="always" flashvars="lang=en&amp;lfmMode=playlist&amp;FOD=true&amp;resourceID=<?php echo $stream_item['meta']['track_id'] ?>&amp;resname=<?php echo $stream_item['meta']['song_name'] ?>&amp;restype=track&amp;artist=<?php echo $stream_item['meta']['artist_name'] ?>&amp;Xautostart=true" bgcolor="#fff" wmode="transparent" quality="high" menu="true" pluginspage="http://www.macromedia.com/go/getflashplayer" src="http://cdn.last.fm/webclient/pixel/55/lfmPlayer.swf"  Xsrc="http://cdn.last.fm/webclient/s12n/s/53/lfmPlayer.swf" type="application/x-shockwave-flash"></embed>
              </div>
        </div>
        <?php endif; ?>
        <?php if ($stream_item['service_id'] == 34): ?>
        <div class="socialstream_media" id="socialstream_media_<?php echo $stream_item['id'] ?>" style="display: none; text-align: center; Xposition: relative; margin-top: 10px; padding: 5px; border: 1px solid #EEE">
            <img style="float: right; Xposition: absolute; right: 2px; top: 2px;" onclick="openidconnect_facebookwall_slideup('socialstream_media_<?php echo $stream_item['id'] ?>')" width=16 height=16 src='application/modules/Lifestream/externals/images/icon_close.gif'>

              <div style="visibility: visible; display: block">
                
                <object width="425" height="350">
                  <param name="movie" value="<?php echo $stream_item['meta']['video_url'] ?>&autoplay=1"></param>
                  <param name="wmode" value="transparent"></param>
                  <embed id="socialstream_media_<?php echo $stream_item['id'] ?>_player" align="middle" src="<?php echo $stream_item['meta']['video_url'] ?>&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350" allowfullscreen="true" bgcolor="#fff" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
                </object>
        
              </div>
        </div>
        <?php endif; ?>
        <div class="socialstream_messagebox" id="socialstream_messagebox_<?php echo $stream_item['id'] ?>" style="display: none; position: relative; margin-top: 5px; padding:7px 0 0 60px;">
          <input class="socialstream_message_to"  type='hidden' value='<?php echo $stream_item['actor']['id'] ?>,<?php echo $stream_item['service_id'] ?>'>
          <a href="javascript:void(0)" class="UIIntentionalStory_Pic" title="">
            <?php echo $this->user_avatar ?>
          </a>
          <div>
            <textarea id="socialstream_messageboxtext_<?php echo $stream_item['id'] ?>" style='width: 80%' class='textarea socialstream_msg_body'></textarea>
            <?php if ($stream_item['service_id'] == 1): ?>
            <div style='color: #808080'><?php echo $this->translate('lifestream_facebook_message_note') ?></div>
            <?php endif; ?>
          </div>
          <div style='margin-top: 6px;'>
            <div class='socialstream_msg_actions'>
              <button onclick="OpenidConnect.FacebookWall.send_message()" class="button"><?php echo $this->translate('lifestream_socialstream_send') ?></button>
              <button onclick="OpenidConnect.FacebookWall.send_message_cancel()" class="button"><?php echo $this->translate('lifestream_socialstream_cancel') ?></button>
            </div>
            <div class="socialstream_msg_progress" style='display:none; width: 80%'>
              <table cellpadding='0' cellspacing='0' align='center'>
              <tr><td style="padding: 5px">
                <img src='application/modules/Socialdna/externals/images/icons/ajaxprogress1.gif' border='0' style='float: left; padding-right: 5px'><?php echo $this->translate('lifestream_socialstream_sending') ?>
              </td></tr>
              </table>
            </div>
            <div class="socialstream_msg_sent" style='display:none; color: green; border: 1px solid green; font-weight: bold; padding: 5px; width: 80%'>
              <table cellpadding='0' cellspacing='0' align='center'>
              <tr><td>
                <?php echo $this->translate('lifestream_socialstream_sent') ?>
              </td></tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; else : ?>

    <?php if (!$this->wall_via_ajax): ?>
    <?php echo $this->translate('lifestream_socialstream_no_updates') ?>
    <?php endif; ?>
    
    <?php endif;  ?>
    
    <?php if (!($this->wall_via_ajax AND count($this->newsfeed) == 0)): ?>
    </div>
    <?php endif; ?>
    <?php if ($this->page == 1): ?>    
    </div>
    <?php endif; ?>
    <?php if (count($this->newsfeed) > 0 AND ($this->page == 1) AND !$this->hide_pager): ?>
    <a href="javascript:void(0)" onclick="OpenidConnect.FacebookWall.load_more(); this.blur()" id="facebookwall_feed_view_more" class="buttonlink icon_viewmore" href="javascript:void(0)"><?php echo $this->translate('View More') ?></a>
    <div style="display: none;" id="facebookwall_feed_view_more_loading" class="feed_viewmore">
      <img style="float: left; margin-right: 5px;" src="application/modules/Core/externals/images/loading.gif">
      <?php echo $this->translate('Loading ...') ?>
    </div>
    <?php endif; ?>
    
    

    <?php endif; /* perms */ ?> 
    
    <?php else: /* service_connected */ ?>

      <br>
      <br>
      <table cellpadding='0' cellspacing='0' align='center'>
      <tr><td>
  
        <?php echo $this->translate('lifestream_socialstream_not_connected') ?> <a href="<?php echo $this->url(array(),'socialdna') ?>"><?php echo $this->translate('lifestream_socialstream_connect1') ?></a> <?php echo $this->translate('lifestream_socialstream_connect2') ?><br><br>
        
        <div style="width: 160px; margin: 0px auto">
          <?php foreach($this->enabled_openid_services as $openid_service): ?>
          <div class="facebookwall_servicelogo"><a href="<?php echo $this->url(array(), 'socialdna') ?>"><img border='0' width=16 height=16 src="application/modules/Socialdna/externals/images/brands/<?php echo $openid_service['openidservice_logo_mini'] ?>" alt="<?php echo $openid_service['openidservice_displayname'] ?>"></a></div>
          <?php endforeach; ?>
          <div style="clear: both"></div>    
        </div>
  
      </td></tr>
      </table>
  
      <br>
      <br>
    
    <?php endif; ?>
  
  <?php if (!$this->wall_via_ajax): ?>    
  </div>
  <?php endif; ?>



  <?php endif; ?> 

    
    
    <?php if ($this->wait_for_data): ?>
    <script>
      //$(document).ready( function() OpenidConnect.Friends.get_friends(); );
      OpenidConnect.FacebookWall.load();
    </script>
    <?php endif; ?>
    
    