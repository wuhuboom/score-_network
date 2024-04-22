<?php

namespace App\HttpController\Index;



use App\HttpController\Common\BetsApi;
use App\HttpController\Common\GetData;
use App\Service\EndedService;
use App\Service\LeagueService;
use App\Service\LeagueTableService;
use App\Service\LeagueToplistService;
use App\Service\TeamService;
use App\Service\UpcomingService;

/**
 * Class Users
 * Create With Automatic Generator
 */
class League extends Base
{
    //球队
    public function index()
    {
	    $page = 1;
	    $limit = 15;
    	$league_id  = $this->param['id']??0;
	    $league = LeagueService::create()->get($league_id);
	    $this->assign['league'] = $league;
	    $where = [];
	    $where["league_id"] = ["league->'$.id' = '{$league_id}'", 'special'];

	    //结果
	    $results = EndedService::create()->getLists($where,'*',$page,100,'time desc');

	    if(empty($results['list'])||(strtotime($results['list'][0]['update_time'])<time()-24*3600)){
		    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
		    $res = $task->sync(new \App\Task\Ended(['league_id'=>$league_id]));
		    $results = EndedService::create()->getLists($where,'*',$page,$limit,'time desc');
	    }

	    $results['count'] = ceil($results['total']/$limit);
	    $this->assign['results'] = $results;

	    //赛程
	    $fixtures= UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
	    if(empty($fixtures['list'])||(strtotime($fixtures['list'][0]['update_time'])<time()-24*3600)){
		    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
		    $res = $task->sync(new \App\Task\Upcoming(['league_id'=>$league_id]));
		    $fixtures = UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
	    }
	    $this->assign['fixtures'] = $fixtures;
	    $this->assign['leagueToplist'] = LeagueToplistService::create()->getLeagueToplistByLeagueId($league_id);
	    $this->assign['leagueTable'] = LeagueTableService::create()->getLeagueTableByLeagueId($league_id);
	    $this->assign['title'] = $this->lang=='En'?'League':'联赛';

        $this->view('/index/league/index',$this->assign);
        return false;
    }

}

