<?php

namespace App\HttpController\Index;

use App\Model\ApiModel;
use App\Model\ApiGroupModel;
use App\Service\EndedService;
use App\Service\InplayService;
use App\Service\LeagueService;
use App\Service\LeagueTableService;
use App\Service\LeagueToplistService;
use App\Service\UpcomingService;
use App\Service\ViewService;

class Api extends Base
{
	//获取联赛
	public function getLeague()
	{
		$where = [];
		if(!empty($this->param['name'])) {$where['name'] = ["%{$this->param['name']}%", 'like'];}
		if(!empty($this->param['cc'])) {
			$where['cc'] = [$this->param['cc'], '='];
		}

		$field = '*';
		$page = (int)($this->param['page']??1);
		$limit = (int)($this->param['limit']??50);
		$data = LeagueService::create()->getLists($where,$field,$page,$limit,'name asc');

		$result = [
			'data'=>$data['list'],
			'code'=>0,
			'count'=>$data['total'],
			'msg'=>'OK'
		];
		$this->response()->write(json_encode($result,JSON_UNESCAPED_UNICODE));
		return true;

	}
    //正在进行的比赛
    public function getInplay()
    {
        $where = [];
	    if(!empty($this->param['league_id'])) {
		    $where["league"] = ["league->'$.id' = '{$this->param['league_id']}'", 'special'];
	    }
	    $where["time"] = [time()-3600, '>'];
//	    $where["league"] = ["league->'$.name' = 'Esoccer Battle - 8 mins play'", 'special'];
        $field = '*';
        $data = InplayService::create()->getLists($where,$field,0,0,'time desc');
        $result = [
            'data'=>$data['list'],
            'code'=>0,
            'count'=>count($data['list']),
            'msg'=>'OK'
        ];
       $this->response()->write(json_encode($result,JSON_UNESCAPED_UNICODE));
        return true;
    }

	//即将进行比赛
	public function getUpcoming()
	{
		$where = [];
		if(!empty($this->param['league_id'])) {
			//$where["league"] = ["league->'$.id' = '{$this->param['league_id']}'", 'special'];
			$where["league_id"] = [$this->param['league_id'], '='];
		}
		$where["time"] = [time()-3600*24, '>'];
		$field = '*';
		$page = $this->param['page']??0;
		$limit = $this->param['limit']??0;
		$data = UpcomingService::create()->getLists($where,$field,$page,$limit,'time desc');
		$result = [
			'data'=>$data['list'],
			'code'=>0,
			'count'=>$data['total'],
			'msg'=>'OK'
		];
		$this->response()->write(json_encode($result,JSON_UNESCAPED_UNICODE));
		return true;
	}

	//比赛结果
	public function getEnded()
	{
		$where = [];
		if(!empty($this->param['league_id'])) {
//			$where["league"] = ["league->'$.id' = '{$this->param['league_id']}'", 'special'];
			$where["league_id"] = [$this->param['league_id'], '='];
		}
		$field = '*';
		$page = $this->param['page']??0;
		$limit = $this->param['limit']??0;
		$data = EndedService::create()->getLists($where,$field,$page,$limit,'time desc');
		foreach ($data['list'] as $k=>$v){
			$view = ViewService::create()->get($v['id']);
			$data['list'][$k]['view'] = [
				'round'=>$view['extra']['round']??'',
				'home_pos'=>$view['extra']['home_pos']??'',
				'away_pos'=>$view['extra']['away_pos']??'',
			];
			$data['list'][$k]['time'] = date('m/d H:i',strtotime($v['time']));
		}
		$result = [
			'data'=>$data['list'],
			'code'=>0,
			'count'=>$data['total'],
			'msg'=>'OK'
		];
		$this->response()->write(json_encode($result,JSON_UNESCAPED_UNICODE));
		return true;
	}

	//比赛表积分榜数据
	public function getLeagueTable()
	{
		$where = [];
		if(!empty($this->param['league_id'])) {
			$where["league"] = ["league->'$.id' = '{$this->param['league_id']}'", 'special'];
		}
		$field = '*';
		$page = $this->param['page']??0;
		$limit = $this->param['limit']??0;
		$data = LeagueTableService::create()->getLists($where,$field,$page,$limit,'time desc');
		$result = [
			'data'=>$data['list'],
			'code'=>0,
			'count'=>$data['total'],
			'msg'=>'OK'
		];
		$this->response()->write(json_encode($result,JSON_UNESCAPED_UNICODE));
		return true;
	}
	//比赛表积分榜数据
	public function getLeagueToplist()
	{
		$league_toplist = LeagueToplistService::create()->getLeagueToplistByLeagueId($this->param['league_id']??0);
		$this->AjaxJson(1,$league_toplist,'ok');
//		$this->response()->write(json_encode($result,JSON_UNESCAPED_UNICODE));
		return true;
	}

}

