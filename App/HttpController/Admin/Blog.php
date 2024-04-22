<?php

namespace App\HttpController\Admin;

use App\HttpController\Common\Common;


use App\Service\BlogService;
use App\Service\UserService;
use EasySwoole\Mysqli\QueryBuilder;
use EasySwoole\ORM\DbManager;

class Blog extends \App\HttpController\Admin\Base
{
    /**
     * 产品列表
     */
    public function lists(){
        $where = [];
        if(!empty($this->param['user_id'])) {
            $where['b.user_id'] = [$this->param['user_id'], '='];
        }
        if(!empty($this->param['agent_id'])) {
            $where['u.agent_id'] = [$this->param['agent_id'], '='];
        }
        if(!empty($this->param['type'])) {
            $where['u.type'] = [$this->param['type'], '='];
        }
        if(!empty($this->param['status'])) {
            $where['b.status'] = [$this->param['status'], '='];
        }
        if(!empty($this->param['is_img'])) {
            $where['b.is_img'] = [$this->param['is_img'], '='];
        }
        if(!empty($this->param['is_img'])) {
            $where['b.is_img'] = [$this->param['is_img']==1?1:0, '='];
        }
	    if($this->getAgentId()){
		    $where['u.agent_id'] = [$this->getAgentId(), '='];
	    }
	    if($this->getEmployeeId()){
		    $where['u.employee_id'] = [$this->getEmployeeId(), '='];
	    }
        $create_time = $this->param['create_time']??'';
        if ($create_time) {
            $time = explode(' - ', $create_time);
            $time[0] = trim($time[0]) . ' 00:00:00';
            $time[1] = trim($time[1]) . ' 23:59:59';
            $where['b.create_time']  = [$time,'between'];
        }
        if(!empty($this->param['username'])) {
            $where['u.username'] = ["%{$this->param['username']}%", 'like'];
        }

        $field = 'b.*,u.username,u.nickname,a.name as agent_name';
        $page = (int)($this->param['page']??1);
        $limit = (int)($this->param['limit']??10);
        $data = BlogService::create()->joinSelectList($where,$field,$page,$limit,'b.id desc');

        $this->writeJson(200, $data, 'success');
        return true;
    }
    /**
     * 新增微信产品
     */
    public function add(){
        try{
            $data = $this->param;
            $data['status'] = 1;
            $data['is_img'] = empty($data['image']) ? 0 : 1;
            $data['create_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $result = BlogService::create()->validateData($data,'add');
            if($result!==true) {
                $this->AjaxJson(0,$data,$result);return false;
            }

            if($insert_id =  BlogService::create()->save($data)){
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
                $data['is_img'] = empty($data['image']) ? 0 : 1;
                $data['update_time'] = date('Y-m-d H:i:s');

                $result              = BlogService::create()->validateData($data, 'edit');
                if ($result !== true) {
                    $this->AjaxJson(0, $data, $result);
                    return false;
                }


                DbManager::getInstance()->startTransaction();
                $blog = BlogService::create()->get($this->param['id']);
                if($blog['status']==4){
                    $this->AjaxJson(0, [], '奖励已到账，不可再操作！');
                    return false;
                }
                if($data['status']==4){
                	$user = UserService::create()->get($blog['user_id']);
					$system  = Common::getSystem();
					$balance_field = $system['customer_config']['blog_balance_type']==1?'balance_in':'balance_out';
                    $data['finish_time'] = date('Y-m-d H:i:s');
	                $res              = UserService::create()->update($blog['user_id'],[
		                $balance_field      => QueryBuilder::inc($data['reward_amount']) ,
		                'update_time' => date('Y-m-d H:i:s'),
	                ]);
	                $balance_type = $system['customer_config']['blog_balance_type']==1?1:2;
	                $type = 6;
	                $balance = $data['reward_amount'];
	                $before_balance = $user[$balance_field];
	                $after_balance = $user[$balance_field]+$balance;
	                $remark = '发帖奖励';

	                $UserBalanceDetailsId = \App\HttpController\Common\User::writeUserBalanceDetails($this->param['user_id'],$balance_type,$type,$balance,$before_balance,$after_balance,$remark);
	                $UserRewardId = \App\HttpController\Common\User::writeUserReward($this->param['user_id'],$balance_type,1,$balance,'发帖奖励');
	                if(!$result||!$UserBalanceDetailsId||!$UserRewardId){
		                DbManager::getInstance()->rollback();
		                $this->AjaxJson(0, ['status' => 0], '审核失败');
		                return false;
	                }

                }
                if (BlogService::create()->update($this->param['id'],$data )) {
	                DbManager::getInstance()->commit();
                    $this->AjaxJson(1, ['id'   => $this->param['id'], 'data' => $data], '更新成功');
                    return false;
                } else {
	                DbManager::getInstance()->rollback();
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
            if( BlogService::create()->delete(['id'=>[$ids,'in']])){
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

