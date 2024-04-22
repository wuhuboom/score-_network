<?php
namespace App\HttpController\Admin;

use App\Service\TeamMembersService as Service;
use App\Service\TeamService;
use EasySwoole\HttpClient\HttpClient;

class TeamMembers extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
	    $where = [];

	    if(!empty($this->param['name'])) {$where['tm.name'] = ["%{$this->param['name']}%", 'like'];}
	    if(!empty($this->param['team_name'])) {$where['t.name'] = ["%{$this->param['team_name']}%", 'like'];}

	    $field = 'tm.*,t.name as team_name';
	    $page = (int)($this->param['page']??1);
	    $limit = (int)($this->param['limit']??10);
	    $data = Service::create()->joinSelectList($where,$field,$page,$limit,'tm.id desc');

	    $this->writeJson(200, $data, 'success');
	    return true;
    }
    /**
     * 请求联赛数据
     */
    public function getDataByApi(){

	    try {
		    // 投递异步任务
		    $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
		    $task->async(new \App\Task\TeamMembers([]));
		    $this->AjaxJson(1,[],'请求数据任务提交成功！');return false;
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
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = Service::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if(Service::create()->getOne(['name'=>$data['name']])){
                $this->AjaxJson(0, [], '联赛名称已存在');return false;
            }
            if(Service::create()->getOne(['cc'=>$data['cc']])){
                $this->AjaxJson(0, [], '联赛简称已存在');return false;
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

                if(Service::create()->getOne(['name'=>$data['name'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '联赛名称已存在');return false;
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


}

