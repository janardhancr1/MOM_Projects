<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 * @version    $Id: Encode.php 6584 2010-06-25 01:54:49Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Video
 * @copyright  Copyright 2006-2010 Webligo Developments
 * @license    http://www.socialengine.net/license/
 */
class Video_Plugin_Task_Encode extends Core_Plugin_Task_Abstract
{
  public function execute()
  {
    // select video table where status == 2 (being encoded)
    //$video = Engine_Api::_()->getItem('video', 14);
    //$video->status = 2;
    //$video->save();

    //$this->processAction(14);
    $table  = Engine_Api::_()->getDbTable('videos', 'video');

    $rName = $table->info('name');
    $select = $table->select()
                    ->where('status = ?', 2);
    $row = $table->fetchAll($select);

    $jobs = (int) Engine_Api::_()->getApi('settings', 'core')->video_jobs;

    if (count($row)<$jobs){
    // if there are less than 2 videos being encoded,
    // get the oldest video with status == 0 and start encoding
      $rName = $table->info('name');
      $select = $table->select()
                      ->where('status = ?', 0)
                      ->limit(1)
                      ->order( 'creation_date ASC' );
      $row = $table->fetchRow($select);
      if(!empty($row) && isset($row->code)){
        $row->status = 2;
        $row->save();
        $this->processAction($row->video_id, $row->code);
      }
    }

  }

  public function processAction($video_id, $filetype){
    $ffmpeg_path = Engine_Api::_()->getApi('settings', 'core')->video_ffmpeg_path;
    if( !$ffmpeg_path ) {
      throw new Video_Model_Exception('Ffmpeg not found');
    }
    //$ffmpeg_path = 'C:\xampp\htdocs\ffmpeg\ffmpeg.exe';
    $db = Engine_Api::_()->getDbtable('videos', 'video')->getAdapter();
    $db->beginTransaction();

    try
    {
    // this will process a video
    $video = Engine_Api::_()->getItem('video', $video_id);

    $org_location = APPLICATION_PATH.'/temporary/video/'.$video->video_id.".".$filetype;
    //$base_filename = substr($org_location, 0, strrpos($org_location, '.'));
    $flv_filename = APPLICATION_PATH . '/temporary/video/'.$video->video_id.'_vconverted.flv';
    $img_filename = APPLICATION_PATH . '/temporary/video/'.$video->video_id.'_vthumb.jpg';
    // process conversion
    // 480x386
    // $shell_script .= "ffmpeg -i {$directory}{$new_filename}.original.{$video_ext} -ab 64k -ar 44100 -qscale 5 -vcodec flv -f flv -r 25 -s {$setting['setting_video_width']}x{$setting['setting_video_height']} {$directory}{$new_filename}.flv  2>&1)";
    // ffmpeg -v 5 -i inputfile -f null -
    //"$ffmpeg_path -v 5 -i $org_location -f null -";
    $command = "$ffmpeg_path -i $org_location -ab 64k -ar 44100 -qscale 5 -vcodec flv -f flv -r 25 -s 480x386 -v 2 -y $flv_filename 2>&1";
    $shell = $org_location.$flv_filename;
    $shell .= shell_exec($command);

    if(APPLICATION_ENV == 'development'){
      //$log_filename = APPLICATION_PATH . '/temporary/log/video.log';
      //$log = fread($handle, filesize($log_filename));
      
      //$f = fopen($log_filename, "w");
      //fwrite($f, $video->video_id.$shell);
      //fclose($f);


      // open video log file
      $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/temporary/log/video.log');
      $logger = new Zend_Log($writer);

      // write to the log
      $logger->info($shell);

    }

    $success = false;

    if (!preg_match("/Unknown format/i", $shell) && !preg_match("/Unsupported codec/i", $shell) && !preg_match("/video:0kB/i", $shell) && !preg_match("/patch welcome/i", $shell)){
      $success = true;
    }

    if ($success){
      //$command = "$ffmpeg_path -i $org_location -ab 64k -ar 44100 -qscale 5 -vcodec flv -f flv -r 25 -s 480x386 -v 2 -y $flv_filename 2>&1";
      //$shell = $org_location.$flv_filename;
      //$shell .= shell_exec($command);
      $duration = $shell;
      $search='/Duration: (.*?)[.]/';
      $duration=preg_match($search, $duration, $matches, PREG_OFFSET_CAPTURE);
      $duration = $matches[1][0];
      list($hours, $minutes, $seconds) = preg_split('[:]', $duration);
      $duration = ceil($seconds + $minutes*(60) + $hours*(3600));
      $success = false;
      if(APPLICATION_ENV == 'development'){
        $log_filename = APPLICATION_PATH . '/temporary/video/'.$video->video_id."_development_video_log2.txt";
        $f = fopen($log_filename, "w");
        fwrite($f, $shell);
        fclose($f);
      }

      // make thumbnail
      // divide the second by half?
      $command = "$ffmpeg_path -i $flv_filename -f image2 -ss 4.00 -v 2 -vframes 1 $img_filename";
      $shell = shell_exec($command);
      if(true){
        // after thumbnail is made store it, the code below is using the wrong file path.
        // need to get the correct address
        $video_params = Array('parent_id'=>$video->video_id, 'parent_type'=>$video->getType());
        try 
        {
          $videoFile = Engine_Api::_()->storage()->create($flv_filename, $video_params);
        }
        catch (Exception $e)
        {
          $video->status = 7;
          $video->save();
          $db->commit();
          return;
        }
        $image = Engine_Image::factory();
        $image->open($img_filename)
          ->resize(120, 240)
          ->write($img_filename)
          ->destroy();
        try 
        {
          $thumbFileRow = Engine_Api::_()->storage()->create($img_filename, $video_params);
        }
        catch (Exception $e)
        {
          $video->status = 7;
          $video->save();
          $db->commit();
          return;
        }
      }


      $video->photo_id = $thumbFileRow->file_id;
      $video->file_id = $videoFile->file_id;
      $video->duration = $duration;
      $video->status = 1;
      $video->save();

      $owner = $video->getOwner();

      // new action
      $action = Engine_Api::_()->getDbtable('actions', 'activity')->addActivity($owner, $video, 'video_new');
      if ($action!=null) Engine_Api::_()->getDbtable('actions', 'activity')->attachActivity($action, $video);

      // notify the owner
      Engine_Api::_()->getDbtable('notifications', 'activity')->addNotification($owner, $owner, $video, 'video_processed');



      // delete the files from temp dir
      unlink($org_location);
      unlink($flv_filename);
      unlink($img_filename);
    }
    else {
      if (preg_match("/Unsupported codec/i", $shell)){
        $video->status = 3;
      }
      else if (preg_match("/video:0kB/i", $shell)){
        $video->status = 5;
      }
      else $video->status = 3;
      
      $video->save();

      // output a log file to the temp directory with the filename as the id of the video in question
      //APPLICATION_PATH . '/temporary/video/'.$video->video_id.".".$file_ext;
      $log_filename = APPLICATION_PATH . '/temporary/video/'.$video->video_id."_failed.txt";
      $f = fopen($log_filename, "w");
      fwrite($f, $shell);
      fclose($f);

      // video failed notification?
    }
    $db->commit();
  }
  catch( Exception $e )
  {
    $db->rollBack();
    return;
  }
  }


}