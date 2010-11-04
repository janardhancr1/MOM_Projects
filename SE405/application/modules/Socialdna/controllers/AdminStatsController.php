<?php

require_once APPLICATION_PATH_COR . DS . 'modules' . DS . 'Socialdna' . DS . 'include' . DS . 'fusioncharts.php';
require_once APPLICATION_PATH_COR . DS . 'modules' . DS . 'Socialdna' . DS . 'include' . DS . 'fusioncharts_gen.php';

class Socialdna_AdminStatsController extends Core_Controller_Action_Admin
{

  public function indexAction()
  {
    
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
      ->getNavigation('socialdna_admin_main', array(), 'socialdna_admin_main_stats');

    // top links
    $max_top_links = 25;

    $link_stats_table = Engine_Api::_()->getDbTable('linkstats','socialdna');
    $select = $link_stats_table->select()
              ->from($link_stats_table->info('name'),array('COUNT(*) as total','*'))
              ->group('openidlinkstat_link')
              ->order('total DESC');
              
    $top_links = $link_stats_table->fetchAll($select);
    
    
    // recent links
    
    $max_recent_links = 25;


    $link_stats_table = Engine_Api::_()->getDbTable('linkstats','socialdna');
    $services_table = Engine_Api::_()->getDbTable('services','socialdna');
    $users_table = Engine_Api::_()->getDbTable('users','user');
    

    $select = $link_stats_table->select()
              ->setIntegrityCheck(false)
              ->from($users_table->info('name'),'*')
              ->join($link_stats_table->info('name'), "`{$link_stats_table->info('name')}`.`openidlinkstat_user_id` = `{$users_table->info('name')}`.`user_id`", '*' )
              ->join($services_table->info('name'), "`{$link_stats_table->info('name')}`.`openidlinkstat_service_id` = `{$services_table->info('name')}`.`openidservice_id`", '*' )
              ->order('openidlinkstat_id DESC')
              ->limit($max_recent_links);

    $recent_links = $link_stats_table->fetchAll($select);
    
    
    
    $charts = array();

    $chart = new FusionCharts("MSLine","400","276");
    $chart_data_url = $this->view->url(array('task' => 'feeds', 'action' => 'statsdata'), 'admin_default');
    $charts['feeds'] = $chart->renderChartJS( 'application/modules/Socialdna/externals/swf/FCF_MSLine.swf', urlencode($chart_data_url), '', "chartfeeds", "400","276");

    $chart = new FusionCharts("MSLine","400","276");
    $chart_data_url = $this->view->url(array('task' => 'status', 'action' => 'statsdata'), 'admin_default');
    $charts['status'] = $chart->renderChartJS( 'application/modules/Socialdna/externals/swf/FCF_MSLine.swf', urlencode($chart_data_url), '', "chartstatus", "400","276");
    
    $chart = new FusionCharts("MSLine","400","276");
    $chart_data_url = $this->view->url(array('task' => 'messages', 'action' => 'statsdata'), 'admin_default');
    $charts['messages'] = $chart->renderChartJS( 'application/modules/Socialdna/externals/swf/FCF_MSLine.swf', urlencode($chart_data_url), '', "chartmessages", "400","276");
    
    $chart = new FusionCharts("MSLine","400","276");
    $chart_data_url = $this->view->url(array('task' => 'clicks', 'action' => 'statsdata'), 'admin_default');
    $charts['clicks'] = $chart->renderChartJS( 'application/modules/Socialdna/externals/swf/FCF_MSLine.swf', urlencode($chart_data_url), '', "chartclicks", "400","276");
    
    $chart = new FusionCharts("MSLine","400","276");
    $chart_data_url = $this->view->url(array('task' => 'signups', 'action' => 'statsdata'), 'admin_default');
    $charts['signups'] = $chart->renderChartJS( 'application/modules/Socialdna/externals/swf/FCF_MSLine.swf', urlencode($chart_data_url), '', "chartsignups", "400","276");
    
    $chart = new FusionCharts("Pie2D","400","276");
    $chart_data_url = $this->view->url(array('task' => 'openidusers', 'action' => 'statsdata'), 'admin_default');
    $charts['openidusers'] = $chart->renderChartJS( 'application/modules/Socialdna/externals/swf/FCF_Pie2D.swf', urlencode($chart_data_url), '', "chartopenidusers", "400","276");

    $this->view->top_links = $top_links;
    $this->view->recent_links =$recent_links;
    $this->view->charts = $charts;

  }



  public function resetAction()
  {
    
   
    Engine_Api::_()->getDbTable('clickstats','socialdna')->delete("1=1");
    Engine_Api::_()->getDbTable('feedstats','socialdna')->delete("1=1");
    //Engine_Api::_()->getDbTable('linkstats','socialdna')->delete("1=1");
    Engine_Api::_()->getDbTable('msgstats','socialdna')->delete("1=1");
    Engine_Api::_()->getDbTable('signupstats','socialdna')->delete("1=1");
    Engine_Api::_()->getDbTable('statusstats','socialdna')->delete("1=1");
    Engine_Api::_()->getDbTable('stats','socialdna')->delete("1=1");

    return $this->_helper->_redirector->gotoRoute(array('module' => 'socialdna', 'controller' => 'stats', 'action' => 'index'), 'admin_default', true);

  }


  public function statsdataAction()
  {
 

    // Disable layout and viewrenderer
    $this->_helper->layout->disableLayout();
    $this->_helper->viewRenderer->setNoRender(true);

 
    $task = $this->getRequest()->get('task');
     
    $period = $this->getRequest()->get('period','week');
    $period = !empty($period) ? $period : 'week';
    $from = (int)$this->getRequest()->get('from');
    

    $services = array(  1   => 'Facebook',
                        2   => 'MySpace',
                        4   => 'Yahoo',
                        6   => 'Friendster',
                        10  => 'Twitter',
                        12  => 'LinkedIn',
                        //35  => 'Foursquare',
                        37  => 'Orkut',
                        );

    $feed_chart = null;
    $pie_chart = false;
    
    switch($task) {
      
      case "feeds":

      $services = array(  1   => 'Facebook',
                          2   => 'MySpace',
                          4   => 'Yahoo',
                          6   => 'Friendster',
                          10  => 'Twitter',
                          12  => 'LinkedIn',
                          37  => 'Orkut',
                          );

        $feed_chart = new FusionCharts("MSLine","400","276");
        $feed_chart->setSwfPath( 'application/modules/Socialdna/externals/swf/' );
        
        $strParam="caption=Daily Newsfeed Updates;pieSliceDepth=30;showBorder=1;showNames=1;formatNumberScale=0;numberSuffix=;decimalPrecision=0";
        $feed_chart->setChartParams($strParam);
        
        $stat_table = Engine_Api::_()->getDbTable('feedstats','socialdna');
        $select = $stat_table->select()->order('openidstat_time ASC');
        
        $stats = $stat_table->fetchAll($select);

        break;



      case "messages":

        $feed_chart = new FusionCharts("MSLine","400","276");
        $feed_chart->setSwfPath( 'application/modules/Socialdna/externals/swf/' );
        
        $strParam="caption=Daily Messages Sent;pieSliceDepth=30;showBorder=1;showNames=1;formatNumberScale=0;numberSuffix=;decimalPrecision=0";
        $feed_chart->setChartParams($strParam);
        
        $stat_table = Engine_Api::_()->getDbTable('msgstats','socialdna');
        $select = $stat_table->select()->order('openidstat_time ASC');
        
        $stats = $stat_table->fetchAll($select);

        break;



      case "clicks":

        $feed_chart = new FusionCharts("MSLine","400","276");
        $feed_chart->setSwfPath( 'application/modules/Socialdna/externals/swf/' );
        
        $strParam="caption=Referred Daily Traffic;pieSliceDepth=30;showBorder=1;showNames=1;formatNumberScale=0;numberSuffix=;decimalPrecision=0";
        $feed_chart->setChartParams($strParam);
        
        $stat_table = Engine_Api::_()->getDbTable('clickstats','socialdna');
        $select = $stat_table->select()->order('openidstat_time ASC');
        
        $stats = $stat_table->fetchAll($select);

        break;



      case "status":

        $feed_chart = new FusionCharts("MSLine","400","276");
        $feed_chart->setSwfPath( 'application/modules/Socialdna/externals/swf/' );
        
        $strParam="caption=Daily Status Updates;subCaption=Per Service;pieSliceDepth=30;showBorder=1;showNames=1;formatNumberScale=0;numberSuffix=;decimalPrecision=0";
        $feed_chart->setChartParams($strParam);

        $stat_table = Engine_Api::_()->getDbTable('statusstats','socialdna');
        $select = $stat_table->select()->order('openidstat_time ASC');
        
        $stats = $stat_table->fetchAll($select);

        break;



      case "signups":

      // all services
      $services = array(  1   => 'Facebook',
                          2   => 'MySpace',
                          3   => 'Google',
                          4   => 'Yahoo',
                          6   => 'Friendster',
                          10  => 'Twitter',
                          12  => 'LinkedIn',
                          35  => 'Foursquare',
                          37  => 'Orkut',
                          );

        $feed_chart = new FusionCharts("MSLine","400","276");
        $feed_chart->setSwfPath( 'application/modules/Socialdna/externals/swf/' );
        
        $strParam="caption=Daily Signups;subCaption=Per Service;pieSliceDepth=30;showBorder=1;showNames=1;formatNumberScale=0;numberSuffix=;decimalPrecision=0";
        $feed_chart->setChartParams($strParam);
        
        $stat_table = Engine_Api::_()->getDbTable('signupstats','socialdna');
        $select = $stat_table->select()->order('openidstat_time ASC');
        
        $stats = $stat_table->fetchAll($select);

        break;


      case "openidusers":
        
        $pie_chart = true;

        $feed_chart = new FusionCharts("Pie2D","400","276");
        $feed_chart->setSwfPath( 'application/modules/Socialdna/externals/swf/' );
        
        //$strParam="caption=Connected Users;pieSliceDepth=30;showBorder=1;showNames=1;formatNumberScale=0;numberSuffix=;decimalPrecision=0";
        $strParam="caption=Connected Users;showNames=1;decimalPrecision=0";
        $feed_chart->setChartParams($strParam);

        $services_table = Engine_Api::_()->getDbTable('services','socialdna');
        $users_table = Engine_Api::_()->getDbTable('users','socialdna');

        $select = $services_table->select()
                  ->setIntegrityCheck(false)
                  ->from($services_table->info('name'),array('COUNT(openid_id) AS total_users', 'openidservice_displayname'))
                  ->joinLeft($users_table->info('name'), "`{$services_table->info('name')}`.`openidservice_id` = `{$users_table->info('name')}`.`openid_service_id`", '*' )
                  ->group('openidservice_id');

        $stats = $services_table->fetchAll($select);
        
        
        foreach($stats as $stat) {
          $feed_chart->addChartData( $stat['total_users'], "name=" . $feed_chart->encodeSpecialChars($stat['openidservice_displayname']) );
        }

        break;

    }

    if($feed_chart) {

      if(!$pie_chart) {

        // date
        foreach($stats as $stat) {
          $feed_chart->addCategory( date("d/m", $stat['openidstat_time']) );
        }
        
        foreach($services as $service_id => $service_name) {

          $feed_chart->addDataset($service_name);
          
          foreach($stats as $stat) {
            $feed_chart->addChartData( $stat['openidstat_service_'.$service_id] );
          }
          
        }

      }

      header('Content-type: text/xml');
      
      $this->getResponse()->setBody( $feed_chart->getXML() );
    }
      
    
  }



}