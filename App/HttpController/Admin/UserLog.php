<?php

namespace App\HttpController\Admin;

use App\Service\UserLogService;
class UserLog extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['user_id'])) {
            $where['l.user_id'] = [$this->param['user_id'], '='];
        }
        if(!empty($this->param['username'])) {
            $where['u.username'] = ["%{$this->param['username']}%", 'like'];
        }
        if(!empty($this->param['nickname'])) {
            $where['u.nickname'] = ["%{$this->param['nickname']}%", 'like'];
        }
	    if(!empty($this->param['start_time'])){
		  $where['l.create_time'] = [$this->param['start_time'],'>='];
	    }
	    if(!empty($this->param['end_time'])){  $where['l.create_time'] = [$this->param['end_time'],'>=']; }
	    if($this->getAgentId()){
		    $where['u.agent_id'] = [$this->getAgentId(), '='];
	    }
	    if($this->getEmployeeId()){
		    $where['u.employee_id'] = [$this->getEmployeeId(), '='];
	    }
        $field = 'l.*,u.username,u.nickname';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = UserLogService::create()->joinSelectList($where,$field,$page,$limit,'l.id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }


}

