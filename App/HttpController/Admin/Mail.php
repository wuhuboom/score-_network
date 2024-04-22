<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\Common;


use App\Service\MailService;
class Mail extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['user_id'])) {
            $where['m.user_id'] = [$this->param['user_id'], '='];
        }
        if(!empty($this->param['agent_id'])) {
            $where['u.agent_id'] = [$this->param['agent_id'], '='];
        }
        if(!empty($this->param['type'])) {
            $where['u.type'] = [$this->param['type'], '='];
        }
        if(!empty($this->param['username'])) {
            $where['u.username'] = ["%{$this->param['username']}%", 'like'];
        }
        if(!empty($this->param['title'])) {
            $where['m.title'] = ["%{$this->param['title']}%", 'like'];
        }

        if(!empty($this->param['is_read'])) {
            $where['m.is_read'] = [$this->param['is_read']==1?1:0, '='];
        }
     
        $field = 'm.*,u.username,u.nickname,a.name as agent_name';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = MailService::create()->joinSelectList($where,$field,$page,$limit,'m.id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 新增微信产品
     */
    public function add(){
        try{
            $data = $this->param;
            $data['admin_id']    = $this->uid;
	        if(empty($data['user_id'])){
		        $task = \EasySwoole\EasySwoole\Task\TaskManager::getInstance();
		        $task->async(new \App\Task\SendMail($data));
		        $this->AjaxJson(1, [], '给所有用户发送站内站成功！');return false;
	        }else{
		        $data['create_time'] = date('Y-m-d H:i:s');
		        $data['update_time'] = date('Y-m-d H:i:s');
		        $result = MailService::create()->validateData($data,'add');
		        if($result!==true) {
			        $this->AjaxJson(0,$data,$result);return false;
		        }

		        if($insert_id =  MailService::create()->save($data)){
			        $this->AjaxJson(1, ['insert_id'=>$insert_id], '新增成功');return false;
		        }else{
			        $this->AjaxJson(0, [], '新增失败');return false;
		        }
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
                $data['admin_id']    = $this->uid;
                $data['update_time'] = date('Y-m-d H:i:s');

                $result              = MailService::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }
                if(!empty($data['is_read'])){
                    $data['read_time'] = date('Y-m-d H:i:s');
                }
                if (MailService::create()->update($this->param['id'],$data )) {
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
            if( MailService::create()->delete(['id'=>[$ids,'in']])){
                $this->AjaxJson(1, ['status'=>1], '永久删除成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '永久删除失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要永久删除的数据');
        }
        return false;
    }



}

