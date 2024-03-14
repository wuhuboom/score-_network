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
                $where['username'] = ["%{$this->param['username']}%", 'like'];
            }
            if(!empty($this->param['id'])) {
                $where['id'] = [$this->param['id'], '='];
            }
            if(!empty($this->param['agent_id'])) {
                $where['agent_id'] = [$this->param['agent_id'], '='];
            }
            if(!empty($this->param['parent_id'])) {
                $where['parent_id'] = [$this->param['parent_id'], '='];
            }
            if(!empty($this->param['type'])) {
                $where['type'] = [$this->param['type'], '='];
            }
            if(!empty($this->param['status'])) {
                $where['status'] = [$this->param['status']==1?1:0, '='];
            }
            if(!empty($this->param['is_active'])) {
                $where['is_active'] = [$this->param['is_active']==1?1:0, '='];
            }
            if(!empty($this->param['is_v'])) {
                $where['is_v'] = [$this->param['is_v']==1?1:0, '='];
            }

            $field = '*';
            $page = (int)($this->param['page']??1);
            $limit = (int)($this->param['limit']??10);
            $data = UserService::create()->getLists($where,$field,$page,$limit,'id desc');

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
        if(strlen($data['username'])!=8){
            $this->AjaxJson(0, [], '请输入正确的8位手机号');return false;
        }
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
                if(strlen($data['username'])!=8){
                    $this->AjaxJson(0, [], '请输入正确的8位手机号');return false;
                }

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
     * 设置测试员
     */
    public function isTest(){
        $id = $this->param['id'];
        if(empty($id)){ $this->AjaxJson(0,  [], '用户ID必须'); return false;}
        $field ='is_test';
        $value = (int)$this->param['value']??0;
        $msg = $value==1?'开启测试员身份':'关闭测试员身份';
        $data = [$field=>$value,'update_time'=>time()];
        if(UserModel::create()->where('id',$id)->update($data)){
            $this->AjaxJson(1, $data, $msg.'成功');
        }else{
            $this->AjaxJson(0, ['status'=>0], $msg.'失败');
        }
        return true;
    }
    /**
     * 更新账户状态
     * param id
     * param status
     * return bool
     */
    public function doStatus(){
        $id = $this->param['id'];
        if(empty($id)){ $this->writeJson(Status::CODE_OK,  ['status'=>0], '账户ID必须'); return false;}
        $value = (int)$this->param['value']??0;
        $msg = $value==1?'恢复账户':'禁用账户';
        if(UserModel::create()->update(['status'=>$value,'update_time'=>time()],['id'=>$id])){
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
     * 用户增加余额
     */
    public function addBalance(){
        try {
            DbManager::getInstance()->startTransaction();
            $id = $this->param['user_id'];
            $amount = $this->param['amount']??0;
            $remark = $this->param['remark']??'';
//            if($amount<0){
//                DbManager::getInstance()->rollback();
//                $this->AjaxJson(0,  [], '要增加的余额必须>0'); return false;
//            }
            $user = UserModel::create()->where('id',$id)->find();
            if(empty($user)){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,  [], '用户不存在'); return false;
            }
            if($amount>0){
                //首单奖励只能赠送一次
                if(!empty($this->param['is_first'])&&$this->param['is_first']==1){
                    if(UserBalanceDetailsModel::create()->where('user_id',$this->param['user_id'])->where('type',6)->find()){
                        $this->AjaxJson(0,  [], '首单奖励已经赠送过了！'); return false;
                    }
                }
                $res              = UserModel::create()->where('id', $id)->update([
                    'money'      => QueryBuilder::inc($amount),
                    'update_time' => date('Y-m-d H:i:s'),
                ]);
                $balanceDetailsId = \App\HttpController\Common\User::writeBalanceDetails($this->param['user_id'],  $amount, $user['money']+$amount, 6,$remark);
                $msg = '给用户'.$user['username'].'增加余额【'.$amount.'】成功';
                \App\HttpController\Common\User::firstOrderReward($balanceDetailsId);
            }else{
                if(empty($remark)){
                    DbManager::getInstance()->rollback();
                    $this->AjaxJson(0,  [], '请输入扣款原因！'); return false;
                }
                $res              = UserModel::create()->where('id', $id)->update([
                    'money'      => QueryBuilder::dec(0-$amount),
                    'update_time' => date('Y-m-d H:i:s'),
                ]);
                $balanceDetailsId = \App\HttpController\Common\User::writeBalanceDetails($this->param['user_id'],  $amount, $user['money']+$amount, 7,$remark);
                $msg = '给用户'.$user['username'].'减少余额【'.$amount.'】成功';
            }


            if($res&&$balanceDetailsId){
                DbManager::getInstance()->commit();
                $this->AjaxJson(1,  [], $msg); return false;
            }else{
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,  [], '赠送/减少余额失败'); return false;
            }
        }catch (\Throwable $e){
            DbManager::getInstance()->rollback();
            $this->AjaxJson(0,  [], $e->getMessage()); return false;
        }

    }
    /**
     * 用户减少余额
     */
    public function descBalance(){
        try {
            DbManager::getInstance()->startTransaction();
            $id = $this->param['user_id'];
            $amount = $this->param['amount']??0;
            if($amount>0){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,  [], '要减少的余额必须《0'); return false;
            }
            $user = UserModel::create()->where('id',$id)->find();
            if(empty($user)){
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,  [], '用户不存在'); return false;
            }
            $res              = UserModel::create()->where('id', $id)->update([
                'money'      => QueryBuilder::dec($amount),
                'update_time' => date('Y-m-d H:i:s'),
            ]);
            $balanceDetailsId = \App\HttpController\Common\User::writeBalanceDetails($this->uid,  $amount, $user['money']+$amount, 7);
            if($res&&$balanceDetailsId){
                DbManager::getInstance()->commit();
                $this->AjaxJson(1,  [], '减少【'.$amount.'】给用户'.$user['username'].'成功'); return false;
            }else{
                DbManager::getInstance()->rollback();
                $this->AjaxJson(0,  [], '赠送余额失败'); return false;
            }
        }catch (\Throwable $e){
            DbManager::getInstance()->rollback();
            $this->AjaxJson(0,  [], $e->getMessage()); return false;
        }

    }



    /**
     * 拉黑/恢复用户
     */
    public function joinBlack(){
        $id = $this->param['user_id'];
        if(empty($id)){ $this->AjaxJson(0,  ['status'=>0], '账户ID必须'); return false;}
        $value = (int)$this->param['value']??0;
        $msg = $value==1?'加入黑名单':'移出黑名单';
        $data = ['is_black'=>$value,'black_time'=>date('Y-m-d H:i:s'),'black_cause'=>$this->param['black_cause']??''];
        if($value==0){
            unset($data['black_cause']);
        }
        if(UserModel::create()->update($data,['id'=>$id])){
            CacheData::updateUserInfo($id);//更新用户缓存信息
            $user = CacheData::userInfo($id);
            $this->AjaxJson(1,  $user, $msg.'成功111');
        }else{
            $user = CacheData::userInfo($id);
            $this->AjaxJson(0,  $user, $msg.'失败111');
        }
        return true;
    }

    /**
     * 绑定上级
     */
    public function bindPromoter(){
        if(empty($this->param['user_id'])){
            $this->AjaxJson(0,  ['status'=>0], '用户ID必须'); return false;
        }
        $parent_id = $this->param['parent_id']??0;

        if(UserModel::create()->where('id',$this->param['user_id'])->update(['parent_id'=>$parent_id,'update_time'=>date('Y-m-d H:i:s')])){
            $this->AjaxJson(1,  ['status'=>1], '绑定推广人成功');
        }else{
            $this->AjaxJson(0,  ['status'=>0], '绑定推广人失败');
        }
        return true;
    }


    /**
     * 用户收货地址
     */
    public function address(){
        $list = UserAddressModel::create()->where('user_id',$this->param['user_id'])->order('id','desc')->select();
        $this->AjaxJson(1, ['total'=>count($list),'list'=>$list], 'success');
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

