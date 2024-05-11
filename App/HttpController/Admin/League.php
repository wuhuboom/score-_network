<?php
namespace App\HttpController\Admin;

use App\HttpController\Common\BetsApi;
use App\Log\LogHandler;
use App\Service\LeagueService;
use App\Service\LeagueService as Service;
use App\Service\LeagueTableService;
use App\Service\LeagueToplistService;
use EasySwoole\HttpClient\HttpClient;

class League extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['name'])) {$where['name'] = ["%{$this->param['name']}%", 'like'];}
        if(!empty($this->param['cc'])) {
            $where['cc'] = ["%{$this->param['cc']}%", 'like'];
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
            $task->async(new \App\Task\League([]));
            $this->AjaxJson(1,[],'请求数据任务提交成功！');
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }

    }

	/**
	 * 更新联赛积分榜
	 */
	public function table(){
		if(!empty($this->param['league_id'])){
			$league_id = $this->param['league_id'];
			$league = LeagueService::create()->get($league_id);
			if(!$league['has_leaguetable']){
				$this->AjaxJson(0,[],'此联赛没有积分榜！');return false;
			}
			$result = BetsApi::getLeagueTable($league_id);
			if($result['success']==1&&$result['results']) {
				try {
					$save_data = $result['results'][0];
					foreach ($save_data as $field => $value) {
						$save_data[$field] = $value ?? '';
					}
					$save_data['league_id'] = $league_id;
					$save_data['update_time'] = date('Y-m-d H:i:s');

					if ($res = LeagueTableService::create()->get(['league_id' => $league_id])) {
						$update_res = LeagueTableService::create()->update($res['id'], $save_data);
						$this->AjaxJson(1,[],'更新联赛积分榜成功！');return false;
					} else {
						$save_data['create_time'] = date('Y-m-d H:i:s');
						$id = LeagueTableService::create()->save($save_data);
						$this->AjaxJson(1,[],'更新联赛积分榜成功！');return false;
					}
				} catch (\Throwable $e) {
					$this->AjaxJson(0,[],'更新联赛积分榜失败！'.$e->getMessage());return false;
				}
			}else{
				$this->AjaxJson(0,$result,'更新失败，请求无结果！');return false;
			}
		}else{
			$this->AjaxJson(0,[],'联赛ID必须！');return false;
		}

	}
	/**
	 * 更新联赛积分榜
	 */
	public function topList(){
		if(!empty($this->param['league_id'])){
			$league_id = $this->param['league_id'];
			$league = LeagueService::create()->get($league_id);
			if(!$league['has_toplist']){
				$this->AjaxJson(0,[],'此联赛没有最佳名单！');return false;
			}
			$result = BetsApi::getLeagueToplist($league_id);
			if($result['success']==1&&$result['results']){
				try {
					$save_data = $result['results'];
					$log_contents = json_encode($save_data,JSON_UNESCAPED_UNICODE);
					LogHandler::getInstance()->log($log_contents,LogHandler::getInstance()::LOG_LEVEL_INFO,'LeagueToplist');
					foreach ($save_data as $field=>$value){
						$save_data[$field]  = $value??'';
					}
					$save_data['league_id'] = $league_id;
					$save_data['update_time'] =date('Y-m-d H:i:s');

					if($res = LeagueToplistService::create()->get(['league_id'=>$league_id])){
						$update_res = LeagueToplistService::create()->update($res['id'],$save_data );
						$this->AjaxJson(1,[],'更新联赛最佳名单成功！');return false;
					}else{
						$save_data['create_time'] =date('Y-m-d H:i:s');
						$id = LeagueToplistService::create()->save($save_data);
						$this->AjaxJson(1,[],'更新联赛最佳名单成功！');return false;
					}
				}catch (\Throwable $e){
					$this->AjaxJson(1,[],'更新联赛最佳名单插入失败'.$e->getMessage());return false;
				}

			}else{
				$this->AjaxJson(0,$result,'更新失败，请求无结果！');return false;
			}
		}else{
			$this->AjaxJson(0,[],'联赛ID必须！');return false;
		}

	}
    /**
     * 新增
     */
    public function add(){
        try{
            $data = $this->param;
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = Service::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if(Service::create()->getOne(['name'=>$data['name']])){
                $this->AjaxJson(0, [], '联赛名称已存在');return false;
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
                $data['update_time'] = date('Y-m-d H:i:s');
                $result              = Service::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(Service::create()->getOne(['cc'=>$data['cc'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '联赛简称已存在');return false;
                }


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

    /**
     * 全部
     */
    public function all(){
        $where = [];
        if(empty($this->param['keyword'])){
            if(!empty($this->param['user_id'])){
                $where['id'] = $this->param['user_id'];
            }else{
                $this->AjaxJson(0, [], 'ok');return false;
            }
        }

        if(!empty($this->param['keyword'])){
            $where['name'] =["%{$this->param['keyword']}%",'like'];
        }
        $list = Service::create()->getLists($where,'id as value,name',0,0,'id asc');
        $this->AjaxJson(1, $list['list'], 'OK');
        return true;
    }

}

