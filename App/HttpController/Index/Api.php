<?php

namespace App\HttpController\Index;

use App\Log\LogHandler;
use App\Model\ApiModel;
use App\Model\ApiGroupModel;
use App\Service\EndedService;
use App\Service\InplayService;
use App\Service\LeagueService;
use App\Service\LeagueTableService;
use App\Service\LeagueToplistService;
use App\Service\StatsTrendService;

use App\Service\TeamSquadService;
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
	    if(!empty($this->param['skipE'])){
		    $where["league"] = ["league->'$.name' not like '%Esoccer%'", 'special'];
	    }
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
			//$where["league_id"] = [$this->param['league_id'], '='];
		}
		if(!empty($this->param['skipE'])){
			$where["league"] = ["league->'$.name' not like '%Esoccer%'", 'special'];
		}
		$where["time"] = [time()-3600*24, '>'];
		$field = '*';
		$page = $this->param['page']??0;
		$limit = $this->param['limit']??0;
		$data = UpcomingService::create()->getLists($where,$field,$page,$limit,'time desc');
		foreach ($data['list'] as $k=>$v){
			$view = ViewService::create()->get($v['id']);
			$data['list'][$k]['view'] = [
				'round'=>$view['extra']['round']??'',
				'home_pos'=>$view['extra']['home_pos']??'',
				'away_pos'=>$view['extra']['away_pos']??'',
			];
			$data['list'][$k]['time'] = ShowDate($v['time'],$this->time_one,'m/d H:i');
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

	//比赛结果
	public function getEnded()
	{
		$where = [];
		if(!empty($this->param['league_id'])) {
//			$where["league"] = ["league->'$.id' = '{$this->param['league_id']}'", 'special'];
			$where["league_id"] = [$this->param['league_id'], '='];
		}
		if(!empty($this->param['team_id'])) {
			$team_id = $this->param['team_id'];
			$where["team_id"] = ["(home_id = '{$team_id}' or away_id = {$team_id})", 'special'];
		}
		if(!empty($this->param['date'])){
			$date = $this->param['date'];
			$start_time = strtotime($date.' 00:00:00');
			$end_time = strtotime($date.' 23:59:59');
			$where['time'] = [[$start_time,$end_time],'between'];
		}

		if(!empty($this->param['skipE'])){
			$where["league"] = ["league->'$.name' not like '%Esoccer%'", 'special'];
		}
		//
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
			$data['list'][$k]['time'] = ShowDate($v['time'],$this->time_one,'m/d H:i');
			$ss = explode('-',$v['ss']);
			if(trim($ss[0])>trim($ss[1])){
				$win =1;
			}else if(trim($ss[0])<trim($ss[1])){
				$win =-1;
			}else{
				$win = 0;
			}
			if(!empty($this->param['team_id'])) {
				if($this->param['team_id']==$v['home']['id']){
					$data['list'][$k]['win'] = $win;
				}else{
					switch ($win){
						case 1:$data['list'][$k]['win']=-1;break;
						case -1:$data['list'][$k]['win']=1;break;
						case 0:$data['list'][$k]['win']=0;break;
					}
				}
			}
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

	//获取球队阵容
	public function getTeamSquad(){
		if(!empty($this->param['team_id'])) {
			$TeamSquad = TeamSquadService::create()->getListsByTeamId($this->param['team_id']??0);
		}
		foreach ($TeamSquad as $k=>$v){
			$TeamSquad[$k]['age'] = getAgeByDate($v['birthdate']);
		}
		$result = [
			'data'=>$TeamSquad,
			'code'=>0,
			'count'=>0,
			'msg'=>'OK'
		];
		$this->response()->write(json_encode($result,JSON_UNESCAPED_UNICODE));
		return true;
	}

	//获取比赛统计
	public function getStatsTrend(){
		$event_id = $this->param['event_id']??0;
		$stats_trend = StatsTrendService::create()->where(['event_id'=>[$event_id,'=']])->get();

		if(empty($stats_trend)){
			try {
				$result = \App\HttpController\Common\BetsApi::getStatsTrend($event_id);

				if($result['success']==1&&$result['results']){
					$save_data = [];
					foreach ($result['results'] as $field=>$value){
						$save_data[$field]  = $value;
					}
					$save_data['event_id'] = $event_id;
					$save_data['update_time'] =date('Y-m-d H:i:s');
					$log_contents = "【{$event_id}】".json_encode($save_data,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'StatsTrend');
					if($res = StatsTrendService::create()->getOne(['event_id'=>$event_id])){
						StatsTrendService::create()->update($res['id'],$save_data );
					}else{
						$save_data['create_time'] =date('Y-m-d H:i:s');
						$id = StatsTrendService::create()->save($save_data);

						$log_contents = $id;
						LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'StatsTrend');
					}
					$stats_trend = $save_data;

				}
			}catch (\Throwable $e){
				$log_contents = $e->getMessage();
				$this->AjaxJson(1,$e->getTrace(),$log_contents);return false;
				LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'TaskError');
			}
        }
		/**
		 * 	const Attacks                     = 'Attacks';
		const Dangerous_Attacks           = 'Dangerous Attacks';
		const On_Target                   = 'On Target';
		const Off_Target                  = 'Off Target';
		const Possession                  = 'Possession';
		 */
		if($stats_trend){
			//进攻
			$attacks['x_data'] = array_column($stats_trend['attacks']['home'],'time_str');
			$attacks['home_data'] = array_column($stats_trend['attacks']['home'],'val');
			$attacks['away_data'] = array_column($stats_trend['attacks']['away'],'val');
			//危险进攻
			$dangerous_attacks['x_data'] = array_column($stats_trend['dangerous_attacks']['home'],'time_str');
			$dangerous_attacks['home_data'] = array_column($stats_trend['dangerous_attacks']['home'],'val');
			$dangerous_attacks['away_data'] = array_column($stats_trend['dangerous_attacks']['away'],'val');
			//射正球门
			$on_target['x_data'] = array_column($stats_trend['on_target']['home'],'time_str');
			$on_target['home_data'] = array_column($stats_trend['on_target']['home'],'val');
			$on_target['away_data'] = array_column($stats_trend['on_target']['away'],'val');
			//射偏球门
			$off_target['x_data'] = array_column($stats_trend['off_target']['home'],'time_str');
			$off_target['home_data'] = array_column($stats_trend['off_target']['home'],'val');
			$off_target['away_data'] = array_column($stats_trend['off_target']['away'],'val');
			//球权%
			$possession['x_data'] = array_column($stats_trend['possession']['home'],'time_str');
			$possession['home_data'] = array_column($stats_trend['possession']['home'],'val');
			$possession['away_data'] = array_column($stats_trend['possession']['away'],'val');
			$data =[
				'attacks'=>$attacks,
				'dangerous_attacks'=>$dangerous_attacks,
				'on_target'=>$on_target,
				'off_target'=>$off_target,
				'possession'=>$possession
			];
			$this->AjaxJson(1,$data,'111');return false;
		}
		$this->AjaxJson(1,$stats_trend,'ok');
	}

}

