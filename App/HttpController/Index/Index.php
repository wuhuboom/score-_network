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
		$this->assign['cate'] ='soccer';
        $this->assign['title'] = $this->lang=='En'?'Soccer Data':'足球数据';
		$this->view('/index/index/soccer_data',$this->assign);
	}

    //赛程
    public function fixtures(){
	    $page = $this->param['page']??1;
	    $limit = 120;
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
//	    if(empty($fixtures['list'])){
//		    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
//		    $res = $task->sync(new \App\Task\Upcoming(['day'=>date('Ymd',strtotime($start_time))]));
//		    $fixtures = UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
//	    }
	    $fixtures['count'] = ceil($fixtures['total']/$limit);
	    $this->assign['fixtures'] = $fixtures;
	    $this->assign['page'] = $page;
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

        $start_time = strtotime($date.' 00:00:00');
        $end_time = strtotime($date.' 23:59:59');
        $where = [];
        $where['time'] = [[$start_time,$end_time],'between'];
        if(!empty($this->param['skipE'])){
            $where["league"] = ["league->'$.name' not like '%Esoccer%'", 'special'];
        }
		$results = EndedService::create()->getLists($where,'*',$page,$limit,'time asc');
		if(empty($results['list'])){
			$task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
			$res = $task->sync(new \App\Task\Ended(['day'=>date('Ymd',strtotime($start_time))]));
			$results = EndedService::create()->getLists($where,'*',$page,$limit,'time asc');
		}
        $results['count'] = ceil($results['total']/$limit);
		$this->assign['results'] = $results;
        $this->assign['page'] = $page;
        $this->assign['date'] = $date;
        $this->assign['cate'] ='results';
        $this->assign['title'] = $this->lang=='En'?'Results':'结果';
		$this->view('/index/index/results',$this->assign);
		return false;
	}

    //比赛
    public function competition(){
        $event_id  = $this->param['event_id']??7965240;
        $competition = ViewService::create()->get($event_id);
        if(empty($competition)){
	        $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
	        $res = $task->sync(new \App\Task\View(['event_id'=>$event_id]));
	        $competition = ViewService::create()->getOne(['id'=>$event_id]);
        }
        $this->assign['competition'] = $competition;
        $stats_trend = StatsTrendService::create()->where(['event_id'=>[$event_id,'=']])->get();
//        if(empty($stats_trend)){
//            $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
//            $res = $task->sync(new \App\Task\StatsTrend(['event_id'=>$event_id]));
//            $stats_trend = StatsTrendService::create()->where(['event_id'=>$event_id])->get();
//        }
        $this->assign['stats_trend'] = $stats_trend;
        $this->assign['view'] = $competition;//ViewService::create()->findByEventId($event_id);
        $this->assign['history'] = HistoryService::create()->findByEventId($event_id);
        $league_id = $competition['league']['id'];
//        $this->assign['league_toplist'] = \EasySwoole\EasySwoole\Task\TaskManager::getInstance()->sync(function () use ($league_id){
//
//            try {
//                if($league_id){
//                    $LeagueToplist =  LeagueToplistService::create()->get(['league_id'=>$league_id]);
//                    if(empty($LeagueToplist)){
//                        $result = \App\HttpController\Common\BetsApi::getLeagueToplist($league_id);
//                        if($result['success']==1&&$result['results']){
//                            $save_data = [];
//                            foreach ($result['results'] as $field=>$value){
//                                $save_data[$field]  = json_encode($value, JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_NUMERIC_CHECK);
//                            }
//                            $save_data['league_id'] = $league_id;
//                            $save_data['update_time'] =date('Y-m-d H:i:s');
//                            $log_contents = "【{$league_id}】".json_encode($save_data,JSON_UNESCAPED_UNICODE);
//                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueToplist');
//                            if($res = LeagueToplistService::create()->getOne(['league_id'=>$league_id])){
//                                LeagueToplistService::create()->update($res['id'],$save_data );
//                            }else{
//                                $save_data['create_time'] =date('Y-m-d H:i:s');
//                                $id = LeagueToplistService::create()->save($save_data);
//                                $log_contents = $id;
//                                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueToplist');
//                            }
//                            $LeagueToplist =  LeagueToplistService::create()->get(['league_id'=>$league_id]);
//                        }
//                    }
//                    return $LeagueToplist??[];
//
//                }else{
//                    return [];
//                }
//
//            }catch (\Throwable $e){
//                $log_contents = $e->getMessage();
//                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TaskError');
//                return [];
//            }
//
//        });;
//        $this->assign['league_table'] = \EasySwoole\EasySwoole\Task\TaskManager::getInstance()->sync(function () use ($league_id){
//            $log_contents = $league_id;
//            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
//            try {
//                if($league_id){
//                    $LeagueTable =  LeagueTableService::create()->get(['league_id'=>$league_id]);
//                    if(1){//empty($LeagueTable)
//                        $result = \App\HttpController\Common\BetsApi::getLeagueTable($league_id);
//                        if($result['success']==1&&$result['results']){
//                            $save_data = [];
//                            foreach ($result['results'][0] as $field=>$value){
//                                $save_data[$field]  = $value??[];
//                            }
//                            $save_data['league_id'] = $league_id;
//                            $save_data['update_time'] =date('Y-m-d H:i:s');
//                            $log_contents = "【{$league_id}】".json_encode($save_data,JSON_UNESCAPED_UNICODE);
//                            LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
//                            if($res = LeagueTableService::create()->getOne(['league_id'=>$league_id])){
//                                $log_contents = "更新";
//                                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
//                                LeagueTableService::create()->update($res['id'],$save_data );
//                            }else{
//                                $log_contents = "新增";
//                                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
//                                $save_data['create_time'] =date('Y-m-d H:i:s');
//                                $id = LeagueTableService::create()->save($save_data);
//
//                            }
//                            $LeagueTable =  LeagueTableService::create()->get(['league_id'=>$league_id]);
//                        }
//                    }
//                    return $LeagueTable??[];
//
//                }else{
//                    return [];
//                }
//
//            }catch (\Throwable $e){
//                $log_contents = $e->getMessage().json_encode($e->getTrace(),JSON_UNESCAPED_UNICODE);
//                LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueTable');
//                return [];
//            }
//
//        });;
	    $this->assign['lineups'] = LineupService::create()->findByEventId($event_id);
        $this->view('/index/index/competition',$this->assign);
    }

	//限流测试
	public function limiter(){
		$system = Common::getSystem();
		$qps_time = (int)$system['qps_time'];
		$qps_num = (int)$system['qps_num'];
		//限流器
		$this->autoLimiter = Di::getInstance()->get('auto_limiter');

		$this->autoLimiter->setLimitQps($qps_time);
		$path              = $this->request()->getUri()->getPath();//控制器路径 /xxxx/xxxx/xxxx
		$client_ip         = $this->getRealIp();                   //客户端真实IP

		//为方便测试，设置1s只能访问1次
		if (!$this->autoLimiter->access($path.$client_ip, $qps_num)){
			$qps = $this->autoLimiter->qps($path.$client_ip);
			$this->writeJson(200, ['qps'=>$qps,'path'=>$path], '当前限流'.$qps_time.'s内只能访问'.$qps_num.'次，当前IP【'.$this->getRealIp().'】访问【'.$path.'】太过频繁,当前QPS('.$system['qps_time'].'s内请求次数):'.$qps);
			return false;
		}else{
			$this->writeJson(200, ['path'=>$path], '正常访问');
		}
	}


}

