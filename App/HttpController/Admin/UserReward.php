<?php
namespace App\HttpController\Admin;


use App\Model\UserCashOutModel;
use App\Service\UserRewardService;


class UserReward extends \App\HttpController\Admin\Base
{
    /**
     * 余额明细
     */
    public function Lists(){
        $where = [];
        if(!empty($this->param['user_id']) ){ $where['r.user_id'] = [$this->param['user_id'],'='];}
        if(!empty($this->param['username']) ){$where['u.create_time'] = ["%{$this->param['username']}%",'like'];}
        if(!empty($this->param['start'])){ $where['r.create_time'] = [$this->param['start'],'>='];  }
        if(!empty($this->param['end'])){ $where['r.create_time'] = [$this->param['end'],'<='];  }
        if(!empty($this->param['balance_type'])){ $where['r.balance_type'] = [$this->param['balance_type'],'='];  }
	    if($this->getAgentId()){
		    $where['u.agent_id'] = [$this->getAgentId(), '='];
	    }
	    if($this->getEmployeeId()){
		    $where['u.employee_id'] = [$this->getEmployeeId(), '='];
	    }
        $limit =$this->param['limit']??10;
        $page =$this->param['page']??1;
        $field = 'r.*,u.username,u.nickname,admin.nickname as admin_name';
        $data = UserRewardService::create()->joinSelectList($where,$field,$page,$limit,'r.id desc');

        $this->writeJson(200, $data, 'success');

        return true;

    }


    /**
     * 导出订单
     */
    public function exp(){
        $model = UserCashOutModel::create();
        if(!empty($this->param['real_name']) ){$model->where("(r.real_name like '%{$this->param['real_name']}%' or r.alipay_number like '%{$this->param['real_name']}%')");}
        if(!empty($this->param['username']) ){$model->where('u.username like "%'.$this->param['username'].'%" or u.nickname like "%'.$this->param['username'].'%"');}
        if(!empty($this->param['user_id'])){ $model->where('r.user_id',$this->param['user_id']); }
        if(!empty($this->param['start'])){ $model->where('r.create_time',$this->param['start'],'>='); }
        if(!empty($this->param['end'])){ $model->where('r.create_time',$this->param['end'],'<='); }
        if(!empty($this->param['pay_type'])){ $model->where('r.pay_type',$this->param['pay_type']); }
        if(!empty($this->param['is_pay'])){ $model->where('r.is_pay',$this->param['is_pay']==2?0:$this->param['is_pay']); }
        $fields = 'r.order_no,u.username,u.nickname,r.real_name,r.alipay_number,r.amount,r.remaining_amount,CONCAT("`",r.transaction_id,"`") as transaction_id,r.is_pay,r.pay_time,r.create_time';
        $list = $model->withTotalCount()->alias('r')->field($fields)
                      ->join('td_user u', 'u.id=r.user_id', 'LEFT')
                      ->order('r.id', 'desc')->select();
        $data = [];
        foreach ($list as $k=>$v){
            switch ($v['is_pay']){
                case 1: $pay_status = '已付款';break;
                case -1: $pay_status = '已拒绝';break;
                case 0: $pay_status = '待付款';break;
                default:$pay_status = '待付款';
            }
            $data[] = [$v['order_no'],$v['username'],$v['nickname'],$v['real_name'],$v['alipay_number'],$v['amount'],$v['remaining_amount'],$v['transaction_id'],$pay_status,$v['pay_time'],$v['create_time']];
        }
        $th = [
            [
                "订单号",
                "用户账户",
                "用户昵称",
                "支付宝姓名",
                "支付宝账号",
                "提现金额",
                "提现后余额",
                "流水账单号",
                "支付状态",
                "支付时间",
                "发起提现时间"
            ]
        ];
        unset($list);
        $this->excelExp($th,$data);
        //生成文件后，使用response输出
        $this->response()->write(file_get_contents(EASYSWOOLE_ROOT.'/public/uploads/excel/test.xlsx'));
        $this->response()->withHeader('Content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $this->response()->withHeader('Content-Disposition', 'attachment;filename="用户提现列表.xlsx"');
        $this->response()->withHeader('Cache-Control','max-age=0');
        $this->response()->end();
        return false;
    }
}

