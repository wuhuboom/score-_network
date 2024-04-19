<?php

namespace App\HttpController\Index;




use App\Service\EndedService;
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
        $results = EndedService::create()->getLists($where,'*',$page,$limit,'time asc');
        if(empty($results['list'])){
            $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
            $res = $task->sync(new \App\Task\Ended(['team_id'=>$team_id]));
            $results = EndedService::create()->getLists($where,'*',$page,$limit,'time asc');
        }
        $results['count'] = ceil($results['total']/$limit);
        $this->assign['results'] = $results;
        //赛程
        $fixtures= UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
        if(empty($fixtures['list'])){
            $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
            $res = $task->sync(new \App\Task\Upcoming(['team_id'=>$team_id]));
            $fixtures = UpcomingService::create()->getLists($where,'*',$page,$limit,'time desc');
        }
        $this->assign['fixtures'] = $fixtures;
        $this->assign['team']  = TeamService::create()->get($team_id);
        $this->assign['team_squad']  = TeamSquadService::create()->get(['team_id'=>$team_id]);
        $this->assign['team_members']  = TeamMembersService::create()->get(['team_id'=>$team_id]);
        $this->view('/index/team/index',$this->assign);
        return false;
    }


}

