<?php
namespace App\HttpController\Admin;

use App\Service\InplayService as Service;
use App\Service\LeagueService;
use App\Service\TeamService;
use EasySwoole\HttpClient\HttpClient;

class Inplay extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
	    if(!empty($this->param['is_generate'])){$where['is_generate']=[$this->param['is_generate']==1?1:0,'='];}
	    if(!empty($this->param['league_name'])) {
		    $where["league"] = ["league->'$.name' like '%{$this->param['league_name']}%'", 'special'];
	    }
	    if(!empty($this->param['home_name'])) {
		    $where["home"] = ["home->'$.name' like '%{$this->param['home_name']}%'", 'special'];
	    }
	    if(!empty($this->param['away_name'])) {
		    $where["home"] = ["away->'$.name' like '%{$this->param['away_name']}%'", 'special'];
	    }
	    if(!empty($this->param['start_time'])){$where['time']=[strtotime($this->param['start_time']),'>='];}
	    if(!empty($this->param['end_time'])){  $where['time']=[strtotime($this->param['end_time']),'<=']; }
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
            $task->async(new \App\Task\Inplay([]));
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
            $data['league'] = LeagueService::create()->get($data['league_id'])->toArray(false,false);
            $data['home'] = TeamService::create()->get($data['home_id'])->toArray(false,false);
            $data['away'] = TeamService::create()->get($data['away_id'])->toArray(false,false);
            $data['time_status'] = 1;
            $data['sport_id'] = 1;
            $data['scores'] = [];
            $data['time'] = strtotime($data['time']);
            $data['timer'] =  [
	            "tm"=> $data['timer'],
	            "ts"=> $data['timer'],
	            "tt"=> 1,
	            "ta"=> 0,
	            "md"=>1
            ];

            $data['is_generate'] = 1;
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = Service::create()->validateData($data,'add');
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
	            $data['timer'] =  [
		            "tm"=> $data['timer_tm']??0,
		            "ts"=> $data['timer_tm']??0,
		            "tt"=> 1,
		            "ta"=> 0,
		            "md"=>1
	            ];
//                $data['update_time'] = date('Y-m-d H:i:s');
//                $result              = Service::create()->validateData($data, 'edit');
//                if ($result !== true) {
//                    $this->AjaxJson(0, $data, $result);
//                    return false;
//                }

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

