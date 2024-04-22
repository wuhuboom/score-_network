<?php

namespace App\HttpController\Admin;


use App\HttpController\Common\Common;
use App\Model\OrderModel;
use App\Model\ShopModel;
use App\Model\UserCashOutModel;
use App\Model\UserLogModel;
use App\Model\UserMemberModel;
use App\Model\UserModel;
use App\Service\AgentService;
use App\Service\EmployeeService;
use App\Service\OrderSettlementService;
use App\Service\UserCashOutService;
use App\Service\UserLogService;
use App\Service\UserRechargeService;
use App\Service\UserService;


class Chart extends Base
{
    /**
     * 顶部数据
     */
    public function getTopData(){
        try {
	        $agent_employee_where =  [];
	        $user_ids = [];
	        $my_user_ids = [];
	        $user_ids_where = [];
	        if($this->getAgentId()){
		        $agent_employee_where['agent_id'] = [$this->getAgentId(), '='];
		        $my_user_ids = UserService::create()->where(['agent_id'=>$this->getAgentId()])->column('id')??[];
	        }
	        if($this->getEmployeeId()){
		        $agent_employee_where['employee_id'] = [$this->getEmployeeId(), '='];
		        $my_user_ids = UserService::create()->where(['employee_id'=>$this->getEmployeeId()])->column('id')??[];
	        }
	        if ($my_user_ids) {
		        $user_ids_where['user_id'] = [$my_user_ids, 'in'];
		        $user_ids['id'] = [$my_user_ids, 'in'];
	        }
            $today_start = date('Y-m-d 00:00:00');
            $today_end = date('Y-m-d 23:59:59');
            $system  = Common::getSystem();
            $all_user_num = UserService::create()->where($agent_employee_where)->where(['id'=>[1,'>=']])->count()??0;
            $data[] = [
                'header_left'=>'激活客户数',
                'header_right'=>'今日',
                'value'=>UserService::create()->where($agent_employee_where)->where(['is_active'=>1,'active_time'=>[[$today_start,$today_end],'between']])->count()??0,
                'footer_left'=>'总激活客户数量',
                'footer_right'=>UserService::create()->where($agent_employee_where)->where(['is_active'=>1])->count()??0,
                'date_time'=>date('Y-m-d H:i:s'),
            ];
            $data[] = [
                'header_left'=>'注册客户数量',
                'header_right'=>'今日',
                'value'=>UserService::create()->where($agent_employee_where)->where(['create_time'=>[[$today_start,$today_end],'between']])->count()??0,
                'footer_left'=>'总注册客户数量',
                'footer_right'=>$all_user_num,
            ];
            $data[] = [
                'header_left'=>'充值',
                'header_right'=>'今日',
                'value'=>UserRechargeService::create()->where($user_ids_where)->where(['status'=>1,'create_time'=>[[$today_start,$today_end],'between']])->sum('received_money')??0,
                'footer_left'=>'总充值',
                'footer_right'=>UserRechargeService::create()->where($user_ids_where)->where(['status'=>1])->sum('received_money')??0,
            ];
            $data[] = [
                'header_left'=>'提现',
                'header_right'=>'今日',
                'value'=>UserCashOutService::create()->where($user_ids_where)->where(['status'=>1,'create_time'=>[[$today_start,$today_end],'between']])->sum('money')??0,
                'footer_left'=>'总提现',
                'footer_right'=>UserCashOutService::create()->where($user_ids_where)->where(['status'=>1])->sum('money')??0,
            ];
            $active_users = UserLogService::create()->where($user_ids_where)->where(['create_time'=>[[$today_start,$today_end],'between']])->group('user_id')->count()??0;
            $is_active_users = UserLogModel::create()->where($user_ids_where)->alias('l')->join('td_user u','u.id=l.user_id','LEFT')->where(['l.create_time'=>[[$today_start,$today_end],'between'],'u.is_active'=>1])->group('l.user_id')->count('l.id')??0;
            $data[] = [
                'header_left'=>'活跃客户数量（激活活跃）',
                'header_right'=>'今日',
                'value'=>$active_users."（{$is_active_users}）",
                'footer_left'=>'总注册客户',
                'footer_right'=>$all_user_num,
            ];
            $online_start_time = date('Y-m-d H:00:00');
            $online_end_time = date('Y-m-d H:59:59');
	        $online_users = UserService::create()->where($user_ids)->where(['last_login_time'=>[[$online_start_time,$online_end_time],'between']])->count()??0;
	        $online_active_users = UserService::create()->where($user_ids)->where(['is_active'=>1,'last_login_time'=>[[$online_start_time,$online_end_time],'between']])->count()??0;

	        $data[] = [
		        'header_left'=>'当前在线客户',
		        'header_right'=>'总在线数（活跃客户数）',
		        'value'=>$online_users."（{$online_active_users}）",
		        'footer_left'=>'总注册客户',
		        'footer_right'=>$all_user_num,
	        ];
            $balance_out = UserService::create()->where($agent_employee_where)->sum('balance_out')??0;
            $today_balance_out = UserService::create()->where($agent_employee_where)->where(['balance_out'=>[$system['withdrawal_config']['min_amount'],'>=']])->field("sum(if(balance_out>{$system['withdrawal_config']['max_amount']},{$system['withdrawal_config']['max_amount']},balance_out)) as balance_out")->find()['balance_out']??0;
            $data[] = [
                'header_left'=>'当前客户可提余额（提现余额大于最低提现金额）',
                'header_right'=>'当前',
                'value'=>$balance_out.'('.$today_balance_out.')',
                'footer_left'=>'总可提现余额',
                'footer_right'=> UserService::create()->where($agent_employee_where)->where(['balance_out'=>[$system['withdrawal_config']['min_amount'],'>=']])->sum('(`balance_out`+`balance_in`)')??0,
            ];
            $data[] = [
                'header_left'=>'客户充值余额',
                'header_right'=>'当前',
                'value'=> UserService::create()->where($agent_employee_where)->where(['balance_out'=>[$system['withdrawal_config']['min_amount'],'>=']])->sum('`balance_in`')??0,
                'footer_left'=>'',
                'footer_right'=> UserService::create()->where($agent_employee_where)->where(['balance_out'=>[$system['withdrawal_config']['min_amount'],'>=']])->sum('(`balance_out`+`balance_in`)')??0,
            ];
            $system = Common::getSystem();
            $withdrawal_end_time = date('Y-m-d ',time()+3600*24).$system['withdrawal_config']['end_time'];
	        $data[] = [
		        'header_left'=>'现在至明日提现截止时间将结算到账金额',
		        'header_right'=>'所有',
		        'value'=> OrderSettlementService::create()->where($my_user_ids)->where(['settle_status'=>0,'status'=>1,'execute_time'=>[[date('Y-m-d H:s:s'),$withdrawal_end_time],'between']])->sum('settle_money')??0,
		        'footer_left'=>'总可提现余额',
		        'footer_right'=> UserService::create()->where($my_user_ids)->where(['balance_out'=>[$system['withdrawal_config']['min_amount'],'>=']])->sum('balance_out')??0,
	        ];
	        $online = UserLogService::create()->where($my_user_ids)->where(['create_time'=>[[$today_start,$today_end],'between']])
		        ->field("create_time,DATE_FORMAT(create_time, '%H') AS hour, COUNT(*)  as num")->group('hour')->order('num','DESC')->find();
	        $data[] = [
		        'header_left'=>'最高在线用户数',
		        'header_right'=>date('Y-m-d ').$online['hour']??0,
		        'value'=> $online['num']??0,
		        'footer_left'=>'',
		        'footer_right'=>'',
	        ];
	        $user = [];
	        if($this->getAgentId()){
		      $agent = AgentService::create()->get($this->getAgentId());
		      $user = UserService::create()->get($agent['user_id']);
	        }
	        if($this->getEmployeeId()){
		        $employee = EmployeeService::create()->get($this->getEmployeeId());
		        $user = UserService::create()->get($employee['user_id']);
	        }
            $this->AjaxJson(1,$data,$this->host.'?invitation_code='.$user['invitation_code']);return false;
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }

    }





}

