<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\Common;
use App\Model\AdminsModel;
use App\Service\AgentService;
use App\Service\EmployeeService;
use App\Service\UserService;

class Employee extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['name'])) {
            $where['e.name'] = ["%{$this->param['name']}%", 'like'];
        }
        if(!empty($this->param['code'])) {
            $where['e.code'] = ["%{$this->param['code']}%", 'like'];
        }
        if(!empty($this->param['agent_id'])) {
            $where['e.agent_id'] = [$this->param['agent_id'], '='];
        }
        $field = 'e.*,admin.username,u.username as user_account,u.invitation_code,a.name as agent_name';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = EmployeeService::create()->joinSelectList($where,$field,$page,$limit,'e.id asc ');
        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 新增微信产品
     */
    public function add(){
        try{
            $data = $this->param;
            $data['invitation_code'] = Common::getRandomStr(5);
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = EmployeeService::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }
            if(EmployeeService::create()->getOne(['code'=>$data['code']])){
                $this->AjaxJson(0, [], '员工编码已存在');return false;
            }
            while (EmployeeService::create()->getOne(['invitation_code'=>$data['invitation_code']])){
                $data['invitation_code'] = Common::getRandomStr(5);
            }

            if($insert_id =  EmployeeService::create()->save($data)){
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
                $result              = EmployeeService::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(EmployeeService::create()->getOne(['code'=>$data['code'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '员工编码已存在');return false;
                }
                if (EmployeeService::create()->update($this->param['id'],$data )) {

                    $this->AjaxJson(1, ['id'   => $this->param['id'], 'data' => $data], '更新成功'.$result);
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

    public function generateAccount(){
        try {
            if (!empty($this->param['id'])) {
                $employee             = EmployeeService::create()->get($this->param['id']);
                if(empty($employee)){
                    $this->AjaxJson(0, ['status' => 0], '员工不存在');return false;
                }
                if($employee['is_generate_account']){
                    $this->AjaxJson(0, $employee, '不能重复生成账号');return false;
                }
                //生成管理员账号
                $admin_data['username'] = 'sales'.autoFillDigits($employee['id'],5);
                $admin_data['name'] = $employee['name'];
                $admin_data['nickname'] = $employee['name'];
                $admin_data['realname'] = $employee['name'];
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
	            $user_data['employee_id'] = $this->param['id'];
	            $user_data['agent_id'] = $employee['agent_id'];
                $user_data['invitation_code'] = Common::getRandomStr(5);
                while (UserService::create()->getOne(['invitation_code'=>$user_data['invitation_code']])){
                    $user_data['invitation_code'] = Common::getRandomStr(5);
                }
                $user_data['create_time'] = date('Y-m-d H:i:s');
                $user_data['update_time'] = date('Y-m-d H:i:s');
                $user_id = UserService::create()->save($user_data);
                //更新
                $employee_data['admin_id'] = $admin_id;
                $employee_data['user_id'] = $user_id;
                $employee_data['is_generate_account'] = 1;
                $employee_data['update_time'] = date('Y-m-d H:i:s');;
                if (EmployeeService::create()->update($employee['id'],$employee_data )) {
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
            if( EmployeeService::create()->delete(['id'=>[$ids,'in']])){
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
	    if($this->getEmployeeId()){
		    $where['id'] = [$this->getEmployeeId(),'='];
	    }
        $list = EmployeeService::create()->getLists($where,'id as value, name',0,0,'id asc');
        $this->AjaxJson(1, $list['list'], 'OK');
        return true;
    }

}

