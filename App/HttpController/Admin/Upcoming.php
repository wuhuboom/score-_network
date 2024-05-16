<?php
namespace App\HttpController\Admin;

use App\Service\LeagueService;
use App\Service\TeamService;
use App\Service\UpcomingService as Service;
use EasySwoole\HttpClient\HttpClient;

class Upcoming extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
	    if(!empty($this->param['league_name'])) {
		    $where["league"] = ["league->'$.name' like '%{$this->param['league_name']}%'", 'special'];
	    }
	    if(!empty($this->param['home_name'])) {
		    $where["home"] = ["home->'$.name' like '%{$this->param['home_name']}%'", 'special'];
	    }
	    if(!empty($this->param['away_name'])) {
		    $where["home"] = ["away->'$.name' like '%{$this->param['away_name']}%'", 'special'];
	    }

        $field = '*';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = Service::create()->getLists($where,$field,$page,$limit,'id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 请求联赛数据
     */
    public function getDataByApi(){
	    try {
		    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
		    $task->async(new \App\Task\Upcoming([]));
		    $this->AjaxJson(1,[],'请求数据任务提交成功！');
	    }catch (\Throwable $e){
		    $this->AjaxJson(0,[],$e->getMessage());
	    }

    }
	/**
	 * 新增
	 */
	public function add(){
		try{
			$data = $this->param;

			if(empty($this->param['league_id'])){
				$this->AjaxJson(0, [], '联赛ID必须');return false;
			}
			if(empty($this->param['home_id'])){
				$this->AjaxJson(0, [], '主队ID必须');return false;
			}
			if(empty($this->param['away_id'])){
				$this->AjaxJson(0, [], '客队ID必须');return false;
			}
			if(empty($this->param['soccer'])){
				$this->AjaxJson(0, [], '全场比分必须填写');return false;
			}
			if(empty($this->param['event'])){
				$this->AjaxJson(0, [], '比赛事件必须填写');return false;
			}
			if(empty($this->param['odds'])){
				$this->AjaxJson(0, [], '比赛赔率必须填写');return false;
			}
			if(empty($this->param['stats'])){
				$this->AjaxJson(0, [], '比赛数据必须填写');return false;
			}
			$data['extra']['round'] =  $data['round']??'';
			if(!empty($data['stadium'])){
				$data['stadium_data'] = ['name'=>$data['stadium']];
			}
			$events = [];
			if(!empty($data['event']['time'])){
				foreach ($data['event']['time'] as $k=>$v){
					$time = $v??0;
					$text = $data['event']['text'][$k]??'';
					$events[] = [
						"id"=>$k,
						"text"=> $time."' ".$text
					];
				}
			}
			$data['events'] = $events;
			$data['league'] = LeagueService::create()->get($data['league_id'])->toArray(false,false);
			$data['home'] = TeamService::create()->get($data['home_id'])->toArray(false,false);
			$data['away'] = TeamService::create()->get($data['away_id'])->toArray(false,false);
			$data['time_status'] = 0;
			$data['sport_id'] = 1;
			$data['time'] = strtotime($data['time']);
			$data['is_generate'] = 1;
			$data['create_time'] = date('Y-m-d H:i:s');
			$data['update_time'] = date('Y-m-d H:i:s');
			$result = \App\Service\UpcomingService::create()->validateData($data,'add');
			if($result!==true) {
				$this->AjaxJson(0,$data,$result);return false;
			}

			if($insert_id =  Service::create()->save($data)){
				$this->AjaxJson(1, ['insert_id'=>$insert_id], '新增成功');return false;
			}else{
				$this->AjaxJson(0, [], '新增失败');return false;
			}
		}catch (\Exception $e){
			$this->AjaxJson(0,['status'=>0], '插入数据库错误：'.$e->getMessage());return false;
		}
	}

	/**
	 * 更新
	 */
	public function edit(){

		try {
			if (!empty($this->param['id'])) {
				$data                = $this->param;
				$data['time'] = strtotime($data['time']);
                $data['update_time'] = date('Y-m-d H:i:s');


				if (Service::create()->update($this->param['id'],$data )) {
					$this->AjaxJson(1, ['id'   => $this->param['id'], 'data' => $data], '更新成功');
					return false;
				} else {
					$this->AjaxJson(0, ['status' => 0], '更新失败');
					return false;
				}

			} else {
				$this->AjaxJson(0, ['status' => 0], 'ID不存在');
			}
		} catch (\Exception $e) {
			$this->AjaxJson(0, ['status' => 0], '更新出错：' . $e->getMessage());
		}
		return false;
	}


    /**
     * 删除
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( Service::create()->delete(['id'=>[$ids,'in']])){
                $this->AjaxJson(1, ['status'=>1], '删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的联赛');
        }
        return false;
    }


}

