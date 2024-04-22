<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\Common;
use App\Service\TasksReceiveService;


class TasksReceive extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['user_id'])) {
            $where['r.user_id'] = [$this->param['user_id'], '='];
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
        if(!empty($this->param['tasks_name'])) {
            $where['t.name'] = ["%{$this->param['tasks_name']}%", 'like'];
        }

        if(!empty($this->param['status'])) {
            $where['r.status'] = [$this->param['status']==1?1:0, '='];
        }
     
        $field = 'r.*,u.username,u.nickname,t.name as tasks_name,t.active_number';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = TasksReceiveService::create()->joinSelectList($where,$field,$page,$limit,'r.id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }


}

