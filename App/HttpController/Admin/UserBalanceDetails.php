<?php

namespace App\HttpController\Admin;

use App\Model\UserBalanceDetailsModel;
use App\Service\UserBalanceDetailsService;


/**
 * Class Users
 * Create With Automatic Generator
 */
class UserBalanceDetails extends \App\HttpController\Admin\Base
{
    /**
     * 余额明细
     */
    public function Lists(){
        $where = [];
	    if(!empty($this->param['employee_id']) ){ $where['u.employee_id'] = [$this->param['employee_id'],'='];}
	    if(!empty($this->param['agent_id']) ){ $where['u.agent_id'] = [$this->param['agent_id'],'='];}
	    if(!empty($this->param['parent_id']) ){ $where['u.parent_id'] = [$this->param['parent_id'],'='];}
	    if(!empty($this->param['id']) ){ $where['u.id'] = [$this->param['id'],'='];}
	    if(!empty($this->param['username']) ){$where['u.username'] = ["%{$this->param['username']}%",'like'];}
	    if(!empty($this->param['start'])){ $where['b.create_time'] = [$this->param['start'],'>='];  }
	    if(!empty($this->param['end'])){ $where['b.end'] = [$this->param['end'],'<='];  }
	    if(!empty($this->param['type'])){ $where['b.type'] = [$this->param['type'],'='];  }
	    if($this->getAgentId()){
		    $where['u.agent_id'] = [$this->getAgentId(), '='];
	    }
	    if($this->getEmployeeId()){
		    $where['u.employee_id'] = [$this->getEmployeeId(), '='];
	    }
        $limit =$this->param['limit']??10;
        $page =$this->param['page']??1;
        $field = 'b.*,u.username,u.nickname,u.agent_id,u.employee_id,a.name as agent_name,e.name as employee_name';
        $data = UserBalanceDetailsService::create()->joinSelectList($where,$field,$page,$limit,'b.id desc');

        $this->writeJson(200, $data, 'success');

        return true;

    }
    /**
     * 导出余额明细列表
     */
    public function exp(){
        $where = [];
        if(!empty($this->param['user_id']) ){ $where['b.user_id'] = [$this->param['user_id'],'='];}
        if(!empty($this->param['username']) ){$where['u.create_time'] = ["%{$this->param['username']}%",'like'];}
        if(!empty($this->param['start'])){ $where['b.create_time'] = [$this->param['start'],'>='];  }
        if(!empty($this->param['end'])){ $where['b.end'] = [$this->param['end'],'<='];  }
        if(!empty($this->param['type'])){ $where['b.type'] = [$this->param['type'],'='];  }

        $field = 'b.*,u.username,u.nickname,u.agent_id,u.employee_id,a.name as agent_name,e.name as employee_name';
        $list = UserBalanceDetailsService::create()->joinSelectList($where,$field,0,0,'b.id desc');

        $data = [];
        $bill_type = [
            '1'=>'充值',
            '2'=>'提现',
            '3'=>'提现退回',
            '4'=>'购买产品',
            '5'=>'产品收益',
            '6'=>'获得奖励',
            '7'=>'佣金收益',
        ];

        foreach ($list['list'] as &$v){
            $data[] = [$v['id'],$bill_type[$v['bill_type']]??'其他',"{$v['agent_name']}【{$v['agent_id']}】","{$v['employee_name']}【{$v['employee_id']}】","【{$v['user_id']}】{$v['username']}【{$v['nickname']}】",$v['before_balance'],$v['balance'],$v['after_balance'],$v['create_time']];
        }

        $th = [
            [
                "ID",
                "账单类型",
                "所属代理",
                "所属员工",
                "客户账户",
                "更新前金额",
                "变更金额",
                "更新后余额",
                "创建时间"
            ]
        ];
        unset($list);
        $file_name = '用户余额明细'.date('YmdHis').'.csv';
        $this->excelExp($th,$data,$file_name,'csv');
        $src = $this->host.'/public/uploads/excel/'.$file_name;
        $this->AjaxJson(1,['src'=>$src],'用户余额明细导出成功！');return false;
    }



}

