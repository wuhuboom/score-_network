<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\Common;
use App\HttpController\Common\Invite;
use App\Model\AdminsModel;
use App\Model\VipModel;
use App\Service\AgentService;
use App\Service\UserService;

class Agent extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['name'])) {
            $where['a.name'] = ["%{$this->param['name']}%", 'like'];
        }
        if(!empty($this->param['code'])) {
            $where['a.code'] = ["%{$this->param['code']}%", 'like'];
        }
	    if($this->getAgentId()){
		    $where['a.id'] = [$this->getAgentId(), '='];
	    }

        $field = 'a.*,admin.username,u.username as user_account,u.invitation_code';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = AgentService::create()->joinSelectList($where,$field,$page,$limit,'a.code asc ');
        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 新增微信产品
     */
    public function add(){
        try{
            $data = $this->param;
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = AgentService::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if(AgentService::create()->getOne(['code'=>$data['code']])){
                $this->AjaxJson(0, [], '代理编码已存在');return false;
            }
            if($insert_id =  AgentService::create()->save($data)){
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
                $result              = AgentService::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(AgentService::create()->getOne(['code'=>$data['code'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '代理编码已存在');return false;
                }
                if (AgentService::create()->update($this->param['id'],$data )) {
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

    //
    public function generateAccount(){
        try {
            if (!empty($this->param['id'])) {
                $agent             = AgentService::create()->get($this->param['id']);
                if(empty($agent)){
                    $this->AjaxJson(0, ['status' => 0], '代理商不存在');return false;
                }
                if($agent['is_generate_account']){
                    $this->AjaxJson(0, $agent, '不能重复生成账号');return false;
                }
                //生成管理员账号
                $admin_data['username'] = 'agent'.autoFillDigits($agent['id'],5);
                $admin_data['name'] = $agent['name'];
                $admin_data['nickname'] = $agent['name'];
                $admin_data['realname'] = $agent['name'];
                $admin_data['password'] = md5($admin_data['username'].'pswstr');;
                $admin_data['status'] = 1;

                $admin_data['create_time'] = date('Y-m-d H:i:s');
                $admin_data['update_time'] = date('Y-m-d H:i:s');
                $admin_id = AdminsModel::create()->data($admin_data)->save();
                //生成用户账户
                $user_data['username'] = $admin_data['username'];
                $user_data['password'] = Common::hashPassword($user_data['username']);
                $user_data['avatar'] = '/public/uploads/user/avatar.png';
                $user_data['parent_id'] = 0;
	            $user_data['agent_id'] = $agent['id']??0;
                $user_data['invitation_code'] = Common::getRandomStr(5);
                while (UserService::create()->getOne(['invitation_code'=>$user_data['invitation_code']])){
                    $user_data['invitation_code'] = Common::getRandomStr(5);
                }
                $user_data['create_time'] = date('Y-m-d H:i:s');
                $user_data['update_time'] = date('Y-m-d H:i:s');
                $user_id = UserService::create()->save($user_data);
                //更新
                $agent_data['admin_id'] = $admin_id;
                $agent_data['user_id'] = $user_id;
                $agent_data['is_generate_account'] = 1;
                $agent_data['update_time'] = date('Y-m-d H:i:s');;
                if (AgentService::create()->update($agent['id'],$agent_data )) {
                    $this->AjaxJson(1, [], '生成管理员账号和用户账户成功');
                    return false;
                } else {
                    $this->AjaxJson(0, ['status' => 0], '生成管理员账号和用户账户失败');
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
            if( AgentService::create()->delete(['id'=>[$ids,'in']])){
                $this->AjaxJson(1, ['status'=>1], '删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的');
        }
        return false;
    }

    /**
     * 全部
     */
    public function all(){
    	$where = [];
    	if($this->getAgentId()){
		    $where['id'] = [$this->getAgentId(),'='];
	    }
        $list = AgentService::create()->getLists($where,'id as value, name',0,0,'id asc');

        $this->AjaxJson(1, $list['list'], 'OK'.$this->getAgentId().$this->agent_id);
        return true;
    }

}

