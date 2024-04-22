<?php

namespace App\HttpController\Index;

use App\Service\EndedService;
use App\Service\PlayerService;
use App\Service\TeamMembersService;
use App\Service\TeamService;
use App\Service\TeamSquadService;
use App\Service\UpcomingService;

class Team extends Base
{
    //球队
    public function index()
    {
        $page = 1;
        $limit = 15;
        $team_id = $this->param['id']??0;

        $where = [];
        $where["team_id"] = ["(home->'$.id' = '{$team_id}' or away->'$.id' = '{$team_id}')", 'special'];
        //结果
        $results = EndedService::create()->getLists($where,'*',$page,100,'time desc');

        if(empty($results['list'])||(strtotime($results['list'][0]['update_time'])<time()-24*3600)){
            $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
            $res = $task->sync(new \App\Task\Ended(['team_id'=>$team_id]));
            $results = EndedService::create()->getLists($where,'*',$page,$limit,'time desc');
        }

        $results['count'] = ceil($results['total']/$limit);
        $this->assign['results'] = $results;

        //赛程
        $fixtures= UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
        if(empty($fixtures['list'])||(strtotime($fixtures['list'][0]['update_time'])<time()-24*3600)){
            $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
            $res = $task->sync(new \App\Task\Upcoming(['team_id'=>$team_id]));
            $fixtures = UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
        }

        $this->assign['fixtures'] = $fixtures;
        $this->assign['team']  = TeamService::create()->get($team_id);

        $this->assign['team_squad']  = TeamSquadService::create()->getListsByTeamId($team_id);


//        $this->assign['team_members']  = TeamMembersService::create()->getListsByTeamId($team_id);
//	    $this->AjaxJson(1,$this->assign['team_members'],'ok3');return false;
        $this->view('/index/team/index',$this->assign);
        return false;
    }

    //球员信息
	public function player()
	{
		$player_id= $this->param['id']??0;
		$this->assign['player']  = PlayerService::create()->getPlayerById($player_id);
		$this->view('/index/team/player',$this->assign);
		return false;
	}
}

