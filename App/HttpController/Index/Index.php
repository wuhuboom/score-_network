<?php

namespace App\HttpController\Index;

use App\HttpController\Common\BetsApi;
use App\HttpController\Common\CacheData;
use App\HttpController\Common\Common;
use App\HttpController\Common\GetData;
use App\Log\LogHandler;
use App\Service\CountryService;
use App\Service\EndedService;
use App\Service\HistoryService;
use App\Service\InplayService;
use App\Service\LeagueService;
use App\Service\LeagueTableService;
use App\Service\LeagueToplistService;
use App\Service\LineupService;
use App\Service\StatsTrendService;
use App\Service\TeamService;
use App\Service\UpcomingService;
use App\Service\ViewService;
use App\Utility\MyQueue;
use App\Model\ApiGroupModel;
use App\Model\ApiModel;
use EasySwoole\Component\Di;


/**
 * Class Users
 * Create With Automatic Generator
 */
class Index extends Base
{
    //首页
    public function index()
    {
	    $data = InplayService::create()->getLists(['time'=>[time()-7200,'>'],'time_status'=>[3,'<']],'*',0,0,'time desc');
	    foreach ($data['list'] as $k=>$v){

		    if($v['is_generate']){
			    $event_id  = $v['id']??0;
			    $upcoming = UpcomingService::create()->get($event_id);
			    $scores = $this->getScores(strtotime($upcoming['time']),$upcoming['extra']['length']??90,$upcoming['events'],$upcoming['ss']);
			    $length = round((time()-strtotime($v['time']))/60);
			    $length = $length>$upcoming['extra']['length']?$upcoming['extra']['length']:$length;
			    $data['list'][$k]['timer']['tm'] = $length;
			    $data['list'][$k]['ss'] = $scores['home'].'-'.$scores['away'];
			    $data['list'][$k]['odds'] = $upcoming['odds'];
		    }else{
			    $data['list'][$k]['odds'] = json_decode($v['odds'],1);
		    }

	    }
	    $this->assign['inplay'] = $data['list'];
        $this->assign['cate'] ='index';
        $this->view('/index/index/index',$this->assign);
        return false;
    }
    //首页
    public function home()
    {
	    $data = InplayService::create()->getLists(['time'=>[time()-3600,'>']],'*',0,0,'time desc');
        $this->assign['inplay'] = $data['list'];
        $this->assign['cate'] ='index';
        $this->assign['title'] = $this->lang=='En'?'Index':'首页';
        $this->view('/index/index/home',$this->assign);
        return false;
    }
    //首页
    public function search()
    {
    	if(empty($this->param['q'])){
		    $this->assign['teams'] = [];
		    $this->assign['league'] = [];
	    }else{
		    $team = TeamService::create()->getLists(['name'=>["%{$this->param['q']}%",'like']],'*',1,50,'id desc');
		    $this->assign['team'] = $team['list'];
		    $league= LeagueService::create()->getLists(['name'=>["%{$this->param['q']}%",'like']],'*',1,50,'id desc');
		    $this->assign['league'] = $league['list'];
	    }
	    $this->assign['q'] = $this->param['q'];
        $this->assign['title'] = $this->lang=='En'?'Search':'搜索';
        $this->view('/index/index/search',$this->assign);
        return false;
    }
	//足球
	public function soccer(){
		$page = 1;
		$limit = 30;
		$date = $this->param['date']??date('Y-m-d');
		$start_time = strtotime($date.' 00:00:00');
		$end_time = strtotime($date.' 23:59:59');
		$where = [];
		$where['time'] = [[$start_time,$end_time],'between'];
        if(!empty($this->param['skipE'])){
            $where["league"] = ["league->'$.name' not like '%Esoccer%'", 'special'];
        }

        //结果
		$results = EndedService::create()->getLists($where,'*',$page,$limit,'time asc');
		if(empty($results['list'])){
			$task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
			$res = $task->sync(new \App\Task\Ended(['day'=>date('Ymd',strtotime($start_time))]));
			$results = EndedService::create()->getLists($where,'*',$page,$limit,'time asc');
		}
		$results['count'] = ceil($results['total']/$limit);
		$this->assign['results'] = $results;
		//赛程
		$fixtures= UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
		if(empty($fixtures['list'])){
			$task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
			$res = $task->sync(new \App\Task\Upcoming(['day'=>date('Ymd',strtotime($start_time))]));
			$fixtures = UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
		}
		$fixtures['count'] = ceil($fixtures['total']/$limit);
		$this->assign['fixtures'] = $fixtures;
		$this->assign['cate'] ='soccer';
        $this->assign['title'] = $this->lang=='En'?'Soccer':'足球';
		$this->view('/index/index/soccer',$this->assign);
	}
	//足球数据
	public function soccerData(){
		$country = CountryService::create()->getLists([],'*',0,0,'cc asc');
		$this->assign['country'] = $country['list'];
		$this->assign['cate'] ='soccer_data';
        $this->assign['title'] = $this->lang=='En'?'Soccer Data':'足球数据';
		$this->view('/index/index/soccer_data',$this->assign);
	}

    //赛程
    public function fixtures(){
	    $page = $this->param['page']??1;
	    $limit = 100;
	    if(empty($this->param['date'])){
		    $date = date('Y-m-d');
	    }else{
		    $date = $this->param['date'];
	    }

	    $start_time = strtotime($date.' 00:00:00');
	    $end_time = strtotime($date.' 23:59:59');
	    $where = [];
	    $where['time'] = [[$start_time,$end_time],'between'];
        if(!empty($this->param['skipE'])){
            $where["league"] = ["league->'$.name' not like '%Esoccer%'", 'special'];
        }
	    $fixtures= UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
		foreach ($fixtures['list'] as $k=>$v){
			$fixtures['list'][$k]['ss'] = '';
		}

	    $fixtures['count'] = ceil($fixtures['total']/$limit);
	    $this->assign['fixtures'] = $fixtures;
	    $this->assign['page']  =  $page;
	    $this->assign['limit'] = $limit;
	    $this->assign['date'] = $date;
	    $this->assign['cate'] ='fixtures';
        $this->assign['title'] = $this->lang=='En'?'Fixtures':'赛程';
	    $this->view('/index/index/fixtures',$this->assign);
	    return false;
    }
	//赛程
	public function results(){
        $page = $this->param['page']??1;
        $limit = 120;
        if(empty($this->param['date'])){
            $date = date('Y-m-d');
        }else{
            $date = $this->param['date'];
        }

//        $start_time = strtotime($date.' 00:00:00');
//        $end_time = strtotime($date.' 23:59:59');
//        $where = [];
//        $where['time'] = [[$start_time,$end_time],'between'];
//        if(!empty($this->param['skipE'])){
//            $where["league"] = ["league->'$.name' not like '%Esoccer%'", 'special'];
//        }
//		$results = EndedService::create()->getLists($where,'*',$page,$limit,'time asc');
//		if(empty($results['list'])){
//			$task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
//			$res = $task->sync(new \App\Task\Ended(['day'=>date('Ymd',strtotime($start_time))]));
//			$results = EndedService::create()->getLists($where,'*',$page,$limit,'time asc');
//		}
//        $results['count'] = ceil($results['total']/$limit);
//		$this->assign['results'] = $results;
        $this->assign['page'] = $page;
        $this->assign['date'] = $date;
        $this->assign['cate'] ='results';
        $this->assign['title'] = $this->lang=='En'?'Results':'结果';
		$this->view('/index/index/results',$this->assign);
		return false;
	}

    //比赛
    public function competition(){
        $event_id  = $this->param['event_id']??0;
	    $upcoming = UpcomingService::create()->get($event_id);

	    if(!empty($upcoming)&&$upcoming['is_generate']==1){
//		    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
//			$res = $task->async(new \App\Task\History(['home_id'=>$upcoming['home']['id'],'away_id'=>$upcoming['away']['id'],'time'=>$upcoming['time'],'event_id'=>$event_id]));

		    //ViewService::create()->update($event_id,['events'=>$upcoming['events'],'is_generate'=>1]);
		    $competition = ViewService::create()->get($event_id);
		    $scores = $this->getScores($upcoming['time'],$upcoming['extra']['length']??90,$upcoming['events'],$upcoming['ss']);
		    //$scores = $this->getScores(time()-6*60,$upcoming['extra']['length']??90,$upcoming['events'],$upcoming['ss']);
		    $corners = $this->getCorners($upcoming['time'],$upcoming['extra']['length']??90,$upcoming['events'],$upcoming['stats']['corners']);
		    $events = $this->getEvents($upcoming['time'],$upcoming['events']);

		    $competition['ss'] = $scores['home'].'-'.$scores['away'];
		    $competition['events'] = $events;

		    $this->assign['home_scores'] = $scores['home'];
		    $this->assign['away_scores'] = $scores['away'];
		    $this->assign['home_corners'] = $corners['home'];
		    $this->assign['away_corners'] = $corners['away'];
		    if(empty($competition)){
			    $competition = $upcoming;
		    }
		    $this->assign['competition'] = $competition;

		    $this->assign['view'] = $competition;
		    $this->assign['history'] = HistoryService::create()->where(['event_id'=>$event_id])->find();
		    $this->assign['lineups'] = [];
	    }else{
		    $competition = ViewService::create()->findByEventId($event_id);
		    if(empty($competition)){
			    $competition = EndedService::create()->get($event_id);
		    }
		    $this->assign['competition'] = $competition;
		    $this->assign['view'] = $competition;
		    $this->assign['history'] = HistoryService::create()->findByEventId($event_id);
		    $league_id = $competition['league']['id'];

		    if($competition['has_lineup']){
			    $this->assign['lineups'] = LineupService::create()->findByEventId($event_id);
		    }else{
			    $this->assign['lineups'] = [];
		    }
	    }




        $this->view('/index/index/competition',$this->assign);
    }




}

