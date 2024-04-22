<?php

namespace App\HttpController\Index;

use App\Model\ApiModel;
use App\Model\ApiGroupModel;
use App\Service\EndedService;
use App\Service\InplayService;
use App\Service\LeagueService;
use App\Service\LeagueTableService;
use App\Service\UpcomingService;

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
			$where["league"] = ["league->'$.id' = '{$this->param['league_id']}'", 'special'];
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
			$where["league"] = ["league->'$.id' = '{$this->param['league_id']}'", 'special'];
		}
		$field = '*';
		$page = $this->param['page']??0;
		$limit = $this->param['limit']??0;
		$data = EndedService::create()->getLists($where,$field,$page,$limit,'time desc');
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

	//api接口文档
	public function api(){

		$api = ApiModel::create()->where('id',$this->param['id']??0)->find();
		$group = ApiGroupModel::create()->where('type',1)->field('id,name,type')->order('sort','asc')->select();
		foreach ($group as $k=>$v){
			$group[$k]['lists'] = ApiModel::create()->where('group_id',$v['id'])->field('id,title,type')->order('sort','asc')->select();
		}
		$this->assign['group'] =$group;

		$this->assign['api'] =  $api;
		if(empty($api)){
			$this->view('/index/index/api_global',$this->assign);
		}else{
			$this->view('/index/index/api',$this->assign);
		}
	}

	//


}

