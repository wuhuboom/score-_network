<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\CacheData;
use App\HttpController\Common\Common;
use App\HttpController\Common\Regex;
use App\Log\LogHandler;
use App\Model\DistributionIncomeModel;
use App\Model\UserAddressModel;
use App\Model\UserBalanceDetailsModel;
use App\Model\UserModel;
use App\Model\UserRevisitRecordModel;
use App\Service\EmployeeService;
use App\Service\UserService;
use EasySwoole\Http\Message\Status;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

class User extends Base
{
    /**
     * 普通用户列表
     */
    public function lists(){
        try {
            $where = [];
            if(!empty($this->param['username'])) {
                $where['u.username'] = ["%{$this->param['username']}%", 'like'];
            }
            if(!empty($this->param['invitation_code'])) {
                $where['u.invitation_code'] = ["%{$this->param['invitation_code']}%", 'like'];
            }
	        if(!empty($this->param['vip_id'])) {
		        $where['u.vip_id'] = [$this->param['vip_id'], '='];
	        }
            if(!empty($this->param['agent_id'])) {
                $where['u.agent_id'] = [$this->param['agent_id'], '='];
            }
            if(!empty($this->param['employee_id'])) {
                $where['u.employee_id'] = [$this->param['employee_id'], '='];
            }
            if(!empty($this->param['parent_id'])) {
                $where['u.parent_id'] = [$this->param['parent_id'], '='];
            }
            if(!empty($this->param['id'])) {
                $where['u.id'] = [$this->param['id'], '='];
            }
            if(!empty($this->param['type'])) {
                $where['u.type'] = [$this->param['type'], '='];
            }
            if(!empty($this->param['status'])) {
                $where['u.status'] = [$this->param['status']==1?1:0, '='];
            }
            if(!empty($this->param['is_active'])) {
                $where['u.is_active'] = [$this->param['is_active']==1?1:0, '='];
            }
            if(!empty($this->param['is_v'])) {
                $where['u.is_v'] = [$this->param['is_v']==1?1:0, '='];
            }
	        if($this->getAgentId()){
		        $where['u.agent_id'] = [$this->getAgentId(), '='];
	        }
	        if($this->getEmployeeId()){
		        $where['u.employee_id'] = [$this->getEmployeeId(), '='];
	        }
            $field = 'u.*,v.name as vip_name,v.level,a.name as agent_name,e.name as employee_name';
            $page = (int)($this->param['page']??1);
            $limit = (int)($this->param['limit']??10);
            $data = UserService::create()->joinSelectList($where,$field,$page,$limit,'u.id desc');
			foreach ($data['list'] as $k=>$v){
				$data['list'][$k]['parent_register_num'] = UserService::create()->where(['parent_id'=>$v['id']])->count()??0;
				$data['list'][$k]['parent_active_num'] = UserService::create()->where(['parent_id'=>$v['id'],'is_active'=>1])->count()??0;
				$data['list'][$k]['parent_parent_register_num'] = UserService::create()->where(['parent_parent_id'=>$v['id']])->count()??0;
				$data['list'][$k]['parent_parent_active_num'] = UserService::create()->where(['parent_parent_id'=>$v['id'],'is_active'=>1])->count()??0;
				$data['list'][$k]['parent_parent_parent_register_num'] = UserService::create()->where(['parent_parent_parent_id'=>$v['id']])->count()??1;
				$data['list'][$k]['parent_parent_parent_active_num'] = UserService::create()->where(['parent_parent_parent_id'=>$v['id'],'is_active'=>1])->count()??0;
			}

            $this->writeJson(200, $data, 'success');
            return true;
        }catch (\Throwable $e){
            $this->AjaxJson(0, [], $e->getMessage());
        }

    }

    /**
     * 新增用户
     */
    public function add(){
	    $data = $this->param;
	    $data['create_time'] =  date('Y-m-d H:i:s');
	    $data['update_time'] =  date('Y-m-d H:i:s');
        $data['invitation_code'] = Common::getRandomStr(5);
        while (UserService::create()->getOne(['invitation_code'=>$data['invitation_code']])){
            $data['invitation_code'] = Common::getRandomStr(5);
        }
        $result = UserService::create()->validateData($data,'add');
        if($result!==true) {
            $this->AjaxJson(0,$data,$result);return false;
        }
        if(UserService::create()->getOne(['username'=>$data['username']])){
            $this->AjaxJson(0, [], '客户账户已存在');return false;
        }
//        if(strlen($data['username'])!=8){
//            $this->AjaxJson(0, [], '请输入正确的8位手机号');return false;
//        }
        if(strlen($data['password'])>12||strlen($data['password'])<6){
            $this->AjaxJson(0, [], '请输入6-12位的密码');return false;
        }
	    try{
            $password = $data['password'];
            $data['password'] = Common::hashPassword($data['password']);
            $data['verify_password'] = Common::passwordVerify($password,$data['password']);

		    if($last_id = UserModel::create()->data($data)->save()){
			    $this->AjaxJson(1, ['status'=>1], '新增成功');return false;
		    }else{
			    $this->AjaxJson(0, ['status'=>0], '新增失败');return false;
		    }
	    }catch (\Exception $e){
		    $this->AjaxJson(0,$data, '插入数据库错误：'.$e->getMessage());return false;
	    }
    }
    /**
     * 获取全部账户列表
     */
    public function all(){
        $model = new UserModel();
        if(empty($this->param['keyword'])){
            if(!empty($this->param['user_id'])){
                $model->where('id',$this->param['user_id']);
            }else{
                $this->AjaxJson(0, [], 'ok');return false;
            }

        }

        if(!empty($this->param['keyword'])){ $model->where('( nickname like "%'.$this->param['keyword'].'%" or username like "%'.$this->param['keyword'].'%" )'); }

        $field = "id as value, CONCAT('【',id,'】',username) as name";
        $list = $model->withTotalCount()->order('id', 'DESC')->page(1,1000)->field($field)->select();
        $this->AjaxJson(0, $list, 'ok');return false;

    }
    /**
     * 更新账户
     */
    public function edit(){
	    try {
		    if (!empty($this->param['id'])) {
                $data = $this->param;

			    $data['update_time'] = date('Y-m-d H:i:s');

                $result = UserService::create()->validateData($data,'edit');
                if($result!==true) {
                    $this->AjaxJson(0,$data,$result);return false;
                }
                if(UserService::create()->getOne(['username'=>$data['username'],'id'=>[$this->param['id'],'<>']])){
                    $this->AjaxJson(0, [], '客户账户已存在');return false;
                }
//                if(strlen($data['username'])!=8){
//                    $this->AjaxJson(0, [], '请输入正确的8位手机号');return false;
//                }

			    if(!empty($data['password'])){
                    if(strlen($data['password'])>12||strlen($data['password'])<6){
                        $this->AjaxJson(0, [], '请输入6-12位的密码');return false;
                    }
                    $data['password'] = Common::hashPassword($data['password']);
			    }else{
				    unset($data['password']);
			    }
                if(!empty($data['cash_password'])){
                    if(strlen($data['cash_password'])!=6){
                        $this->AjaxJson(0, [], '请输入6位的提现密码');return false;
                    }
                    $data['cash_password'] = Common::hashPassword($data['cash_password']);
                }else{
                    unset($data['password']);
                }
			    if (UserService::create()->update($this->param['id'],$data)) {
				    $this->AjaxJson(1, ['status' => 1,'data'=>$data], '更新成功');
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
     * 更新账户状态
     * param id
     * param status
     * return bool
     */
    public function isV(){
        $id = $this->param['id'];
        if(empty($id)){ $this->writeJson(Status::CODE_OK,  ['status'=>0], '账户ID必须'); return false;}
        $value = (int)$this->param['value']??0;
        $msg = $value==1?'标识大V':'取消大V';
        if(UserModel::create()->update(['is_v'=>$value,'update_time'=>time()],['id'=>$id])){
            $this->writeJson(Status::CODE_OK,  ['status'=>1], $msg.'成功');
        }else{
            $this->writeJson(Status::CODE_OK,  ['status'=>0], $msg.'失败');
        }
        return true;
    }
    /**
     * 删除用户
     */
    public function del(){
        if(!empty($this->param['ids'])){
            $ids = is_array($this->param['ids'])?$this->param['ids']:explode(',',$this->param['ids']);
            if( UserModel::create()->where('id',$ids,'in')->update(['is_cancel'=>1,'cancel_time'=>date('Y-m-d H:i:s')])){
                $this->AjaxJson(1, ['status'=>1], '删除账户成功');return false;
            }else{
                $this->AjaxJson(0, ['status'=>0], '删除账户失败');return false;
            }
        }else{
            $this->AjaxJson(0, ['status'=>0,'param'=>$this->param], '请选择要删除的账户');
        }
        return false;
    }


    /**
     * 变更充值余额
     */
    public function changeBalanceIn(){
        try {
            DbManager::getInstance()->startTransaction();
            $id = $this->param['user_id'];
            $amount = $this->param['amount']??0;
            $remark = $this->param['remark']??'';

            $user = UserModel::create()->where('id',$id)->find();
            if(empty($user)){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,  [], '用户不存在'); return false;
            }
            if(!$amount){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,  [], '请输入正确的金额'); return false;
            }
            if($amount>0){
                $result              = UserService::create()->update($user['id'],[
                    'balance_in'      => QueryBuilder::inc($amount) ,
//                    'sum_balance_in'      => QueryBuilder::inc($amount) ,
                    'update_time' => date('Y-m-d H:i:s')
                ]);
                $balance_type = 1;
                $type = 8;
                $balance = $amount;
                $before_balance = $user['balance_in'];
                $after_balance = $user['balance_in']+$balance;
                $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($this->param['user_id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);

                if($result&&$UserBalanceDetailsId){
                    $msg = '给用户'.$user['username'].'增加充值余额【'.$amount.'】成功';
                    DbManager::getInstance()->commit();
                    $this->AjaxJson(1, ['sql' => $result],    $msg);
                    return false;
                }else{
                    $msg = '给用户'.$user['username'].'增加充值余额【'.$amount.'】失败';
                    DbManager::getInstance()->rollback();
                    $this->AjaxJson(0, ['status' => 0], $msg);
                    return false;
                }
            }else{
                if(empty($remark)){
                    DbManager::getInstance()->rollback();
                    $this->AjaxJson(0,  [], '请输入扣款原因！'); return false;
                }
                $result              = UserService::create()->update($id,[
                    'balance_in'      => QueryBuilder::dec(abs($amount)) ,
                    'update_time' => date('Y-m-d H:i:s'),
                ]);
                $balance_type = 1;
                $type = 9;
                $balance = $amount;
                $before_balance = $user['balance_in'];
                $after_balance = $user['balance_in']-$balance;
                $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($this->param['user_id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);

                if($result&&$UserBalanceDetailsId){
                    $msg = '给用户'.$user['username'].'减少充值余额【'.$amount.'】成功';
                    DbManager::getInstance()->commit();
                    $this->AjaxJson(1, ['status' => 0],    $msg);
                    return false;
                }else{
                    $msg = '给用户'.$user['username'].'减少充值余额【'.$amount.'】失败';
                    DbManager::getInstance()->rollback();
                    $this->AjaxJson(0, ['status' => 0], $msg);
                    return false;
                }
            }

        }catch (\Throwable $e){
            DbManager::getInstance()->rollback();
            $this->AjaxJson(0,  [], $e->getMessage()); return false;
        }

    }
    /**
     * 变更充值余额
     */
    public function changeBalanceOut(){
        try {
            DbManager::getInstance()->startTransaction();
            $id = $this->param['user_id'];
            $amount = $this->param['amount']??0;
            $remark = $this->param['remark']??'';

            $user = UserModel::create()->where('id',$id)->find();
            if(empty($user)){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,  [], '用户不存在'); return false;
            }
            if($amount>0){
                $result              = UserService::create()->update($id,[
                    'balance_out'      => QueryBuilder::inc($amount) ,
                    'update_time' => date('Y-m-d H:i:s'),
                ]);
                $balance_type = 2;
                $type = 8;
                $balance = $amount;
                $before_balance = $user['balance_in'];
                $after_balance = $user['balance_in']+$balance;
                $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($id,$balance_type,$type,$balance,$before_balance,$after_balance,$remark);

                if($result&&$UserBalanceDetailsId){
                    $msg = '给用户'.$user['username'].'增加提现余额【'.$amount.'】成功';
                    DbManager::getInstance()->commit();
                    $this->AjaxJson(1, ['status' => 0],    $msg);
                    return false;
                }else{
                    $msg = '给用户'.$user['username'].'增加提现余额【'.$amount.'】失败';
                    DbManager::getInstance()->rollback();
                    $this->AjaxJson(0, ['status' => 0], $msg);
                    return false;
                }
            }else{
                if(empty($remark)){
                    DbManager::getInstance()->rollback();
                    $this->AjaxJson(0,  [], '请输入扣款原因！'); return false;
                }
                $result              = UserService::create()->update($id,[
                    'balance_out'      => QueryBuilder::dec(abs($amount)) ,
                    'update_time' => date('Y-m-d H:i:s'),
                ]);
                $balance_type = 2;
                $type = 9;
                $balance = $amount;
                $before_balance = $user['balance_in'];
                $after_balance = $user['balance_in']-$balance;
                $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($id,$balance_type,$type,$balance,$before_balance,$after_balance,$remark);

                if($result&&$UserBalanceDetailsId){
                    $msg = '给用户'.$user['username'].'减少提现余额【'.$amount.'】成功';
                    DbManager::getInstance()->commit();
                    $this->AjaxJson(1, ['status' => 0],    $msg);
                    return false;
                }else{
                    $msg = '给用户'.$user['username'].'减少提现余额【'.$amount.'】失败';
                    DbManager::getInstance()->rollback();
                    $this->AjaxJson(0, ['status' => 0], $msg);
                    return false;
                }
            }

        }catch (\Throwable $e){
            DbManager::getInstance()->rollback();
            $this->AjaxJson(0,  [], $e->getMessage()); return false;
        }

    }

    /**
     * 拉黑/恢复用户
     */
    public function doStatus(){
        $id = $this->param['id'];
        if(empty($id)){ $this->AjaxJson(0,  ['status'=>0], '账户ID必须'); return false;}
        $value = (int)$this->param['value']??0;
        $msg = $value==1?'账号恢复正常':'账号禁止使用';
        $data = ['status'=>$value,'update_time'=>date('Y-m-d H:i:s')];
        if(UserService::create()->update($id,$data)){
            $this->AjaxJson(1,  [], $msg.'成功');return false;
        }else{
            $this->AjaxJson(0,  [], $msg.'失败');return false;
        }
    }

    /**
     * 设置VIP解绑
     */
    public function giveVip(){
        if(empty($this->param['user_ids'])){
            $this->AjaxJson(0,  ['status'=>0], '用户ID必须'); return false;
        }
        $vip_id = $this->param['vip_id']??0;

        if(UserModel::create()->where('id',$this->param['user_ids'],'in')->update(['vip_id'=>$vip_id,'update_time'=>date('Y-m-d H:i:s')])){
            $this->AjaxJson(1,  ['status'=>1], '设置VIP级别成功');
        }else{
            $this->AjaxJson(0,  ['status'=>0], '设置VIP级别失败');
        }
        return true;
    }
    /**
     * 绑定上级
     */
    public function bindPromoter(){
        if(empty($this->param['user_ids'])){
            $this->AjaxJson(0,  ['status'=>0], '用户ID必须'); return false;
        }
        $parent_id = $this->param['parent_id']??0;

        if(UserModel::create()->where('id',$this->param['user_ids'],'in')->update(['parent_id'=>$parent_id,'update_time'=>date('Y-m-d H:i:s')])){
            $this->AjaxJson(1,  ['status'=>1], '绑定推广人成功');
        }else{
            $this->AjaxJson(0,  ['status'=>0], '绑定推广人失败');
        }
        return true;
    }
    /**
     * 绑定员工
     */
    public function bindEmployeeId(){
        if(empty($this->param['user_ids'])){
            $this->AjaxJson(0,  ['status'=>0], '用户ID必须'); return false;
        }
        $employee_id = $this->param['employee_id']??0;

        if(UserModel::create()->where('id',$this->param['user_ids'],'in')->update(['employee_id'=>$employee_id,'update_time'=>date('Y-m-d H:i:s')])){
            $this->AjaxJson(1,  ['status'=>1], '绑定员工成功');
        }else{
            $this->AjaxJson(0,  ['status'=>0], '绑定员工失败');
        }
        return true;
    }
    /**
     * 绑定代理
     */
    public function bindAgentId(){
        if(empty($this->param['user_ids'])){
            $this->AjaxJson(0,  ['status'=>0], '用户ID必须'); return false;
        }
        $agent_id = $this->param['agent_id']??0;
        if(UserModel::create()->where('id',$this->param['user_ids'],'in')->update(['agent_id'=>$agent_id,'update_time'=>date('Y-m-d H:i:s')])){
            $this->AjaxJson(1,  ['status'=>1], '绑定员工成功');
        }else{
            $this->AjaxJson(0,  ['status'=>0], '绑定员工失败');
        }
        return true;
    }




    /**
     * 导出订单
     */
    public function exp(){
        try {
            $model = UserModel::create();
            $model->where('u.is_black',0);
            $model->where('u.is_cancel',0);
            if(isset($this->param['create_order_num'])&&$this->param['create_order_num']!=''){

                if($this->param['create_order_num']==1){
                    $model->where('u.create_order_num',1,'>=');
                    $model->where('u.member_expiry_time',date('Y-m-d H:i:s'),'>=');
                }else if($this->param['create_order_num']=='0'){
                    $model->where('u.create_order_num',0);
                }else if($this->param['create_order_num']=='all'){
                    $model->where('u.create_order_num',0,'>');
                    $model->where('u.member_expiry_time',date('Y-m-d H:i:s'),'<');
                }else if($this->param['create_order_num']>1){
                    $model->where('u.create_order_num',$this->param['create_order_num'],'>=');
                }
            }

            if(!empty($this->param['type'])){ $model->where('u.is_vip',$this->param['type']==1?1:0); }
            if($reseller_ids = $this->getSearchResellerId()){
                if(is_array($reseller_ids)){
                    $model->where('u.reseller_id',$reseller_ids,'in');
                }else{
                    $model->where('u.reseller_id',$reseller_ids);
                }
            }
            if(!empty($this->param['revisit_time'])){
                $revisit_time = date('Y-m-d H:i:s',time()-$this->param['revisit_time']*24*3600);
                $model->where('u.revisit_time',$revisit_time,'<');
                $model->where('u.create_time',$revisit_time,'<');
            }
            if(!empty($this->param['last_order_day'])){
                $last_order_time = date('Y-m-d H:i:s',time()-$this->param['last_order_day']*24*3600);
                $model->where('u.last_order_time',$last_order_time,'<');
                $model->where('u.create_time',$last_order_time,'<');
            }
            if(!empty($this->param['last_order_time'])){
                $create_time   = explode(' - ',$this->param['last_order_time']);
                $model->where('u.last_order_time',[trim($create_time[0]).' 00:00:00',trim($create_time[1]).' 23:59:59'],'between');
            }
            if(!empty($this->param['create_time'])){
                $create_time   = explode(' - ',$this->param['create_time']);
                $model->where('u.create_time',[trim($create_time[0]).' 00:00:00',trim($create_time[1]).' 23:59:59'],'between');
            }
//            $model->where('u.money < 0');
            if(!empty($this->param['min_money'])){ $model->where('u.money',$this->param['min_money'],'>'); }
            if(!empty($this->param['max_money'])){ $model->where('u.money <'.$this->param['max_money']); }
            if(!empty($this->param['province'])){ $model->where('( u.province like "%'.$this->param['province'].'%")'); }
            if(!empty($this->param['city'])){ $model->where('( u.city like "%'.$this->param['city'].'%")'); }
            if(!empty($this->param['nickname'])){ $model->where('( u.nickname like "%'.$this->param['nickname'].'%" or u.username like "%'.$this->param['nickname'].'%" )'); }
            if(!empty($this->param['parent_name'])){ $model->where('( p.nickname like "%'.$this->param['parent_name'].'%" or p.username like "%'.$this->param['parent_name'].'%" )'); }

            if(!empty($this->param['order'])){
                $order = explode(' ',$this->param['order']);
            }else{
                $order = ['u.id','desc'];
            }
            $field = "u.*,p.nickname as parent_nickname,p.username as parent_username,s.name as reseller_name";
            $list = $model->alias('u')
                          ->join('td_user p','p.id=u.parent_id','LEFT')
                          ->join('td_reseller s','s.id=u.reseller_id','LEFT')
                          ->order($order[0], $order[1])->field($field)->select();

            $data = [];
            $title =['1'=>'已打款','0'=>'已驳回','-1'=>'提现中'];
            foreach ($list as $k=>$v){
                $is_member = $v['is_member']==1?$v['member_expiry_time']>date('Y-m-d H:i:s')?'已开通':'已过期':'未开通';
                $add_wechat = $v['add_wechat']==1?'已添加':'未添加';
                $data[] = [$v['id'],$v['username'],$v['nickname'],$v['money'],$v['all_money'],$v['income_money'],$v['income_order_num'],$v['create_income_money'],$v['create_order_num'],$v['province'],$v['city'],$is_member,$add_wechat,$v['parent_nickname'],$v['reseller_name'],$v['last_order_time'],$v['member_expiry_time'],$v['create_time']];
            }
            $th = [
                [
                    "ID",
                    "账号",
                    "昵称",
                    "账户余额",
                    "累计省钱",
                    "累计收益",
                    "收益订单数",
                    "创造收益",
                    "订单数",
                    "所在省份",
                    "所在城市",
                    "会员状态",
                    "微信状态",
                    "推荐人",
                    "运营商",
                    "最后下单时间",
                    "会员到期时间",
                    "注册时间",
                ]
            ];
            unset($list);
            $file_name = '会员用户'.date('YmdHis').'.csv';
            $this->excelExp($th,$data,$file_name,'csv');
            $src = $this->host.'/public/uploads/excel/'.$file_name;
            $this->AjaxJson(1,['src'=>$src,'sql'=>$model->lastQuery()->getLastPrepareQuery()],'会员用户导出成功！');return false;
            return true;
        }catch (\Throwable $e){
            $this->AjaxJson(0, [], $e->getMessage());
        }



    }



}

