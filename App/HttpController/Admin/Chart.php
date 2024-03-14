<?php

namespace App\HttpController\Admin;


use App\Model\OrderModel;
use App\Model\ShopModel;
use App\Model\UserCashOutModel;
use App\Model\UserMemberModel;
use App\Model\UserModel;


class Chart extends Base
{
    /**
     * 顶部数据
     */
    public function getTopData(){
        try {
            $dateTime = $this->getParamDateTime();
            $data['shop_total'] = $this->getShopTotal($this->getSearchResellerId(),$dateTime['start_time'],$dateTime['end_time']);
            $order_data = $this->getOrderTotal($this->getSearchResellerId(),$dateTime['start_time'],$dateTime['end_time']);
            $data['order_total'] = ['total_num'=>$order_data['total_num'][0]??0,'num'=>$order_data['num'][0]??0];
            $data['order_income_total'] =['total_num'=>$order_data['total_num'][1]??0,'num'=>$order_data['num'][1]??0];
            $data['user_member_total'] =['total_num'=>$order_data['total_num'][4]??0,'num'=>$order_data['num'][4]??0];
            $data['user_total'] =['total_num'=>$order_data['total_num'][5]??0,'num'=>$order_data['num'][5]??0];

//            $data['order_income_total'] =$this->getOrderIncomeTotal($this->getSearchResellerId(),$dateTime['start_time'],$dateTime['end_time']);
//            $data['user_member_total'] = $this->getMemberTotal($this->getSearchResellerId(),$dateTime['start_time'],$dateTime['end_time']);
//            $data['user_total'] = $this->getUserTotal($this->getSearchResellerId(),$dateTime['start_time'],$dateTime['end_time']);
            $data['spread_people_total'] = $this->getSpreadPeopleTotal($this->getSearchResellerId(),$dateTime['start_time'],$dateTime['end_time']);
            $this->AjaxJson(1,$data,'ok');return false;
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }

    }

    /**
     * 订单数据统计
     */
    public function getOrderData(){
        try {
            $dateTime = $this->getParamDateTime();
            $x = $this->periodDate($dateTime['start_time'],$dateTime['end_time']);
            $y_one=$y_two=array_pad([0], count($x), 0);
            if($reseller_ids = $this->getSearchResellerId()){
                if(is_array($reseller_ids)){
                    $where['reseller_id'] =[$reseller_ids,'in'];
                }else{
                    $where['reseller_id'] =$reseller_ids;
                }
            }
            $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
            $list = OrderModel::create()->where($where)->where('is_cancel',0)->field("DATE_FORMAT(create_time, '%Y-%m-%d') AS time, COUNT(*) AS num")->group('time')->order('time','desc')->select();
            $data1 = array_column($list,'num','time');
            $list = OrderModel::create()->where($where)->where('is_cancel',1)->field("DATE_FORMAT(create_time, '%Y-%m-%d') AS time, COUNT(*) AS num")->group('time')->order('time','desc')->select();
            $data2 = array_column($list,'num','time');
            foreach ($x as $k=>$v){
                $y_one[$k] = isset($data1[$v])?$data1[$v]:0;
                $y_two[$k] = isset($data2[$v])?$data2[$v]:0;
            }
            $this->AjaxJson(1,['x'=>array_values($x),'y_one'=>array_values($y_one),'y_two'=>array_values($y_two)],'OK');return false;
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());

        }

    }
    /**
     * 用户新增统计分析
     */
    public function getUserData(){
        try {
            $userModel = UserModel::create();
            $UserMemberModel = UserMemberModel::create();
            $dateTime = $this->getParamDateTime();
            $x = $this->periodDate($dateTime['start_time'],$dateTime['end_time']);
            $y_one = $y_two = array_pad([0], count($x), 0);
            if($reseller_ids = $this->getSearchResellerId()){
                if(is_array($reseller_ids)){
                    $where['reseller_id'] =[$reseller_ids,'in'];
                    $member_where['u.reseller_id'] =[$reseller_ids,'in'];
                }else{
                    $where['reseller_id'] =$reseller_ids;
                    $member_where['u.reseller_id'] =$reseller_ids;
                }
            }

            $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
            $member_where['m.is_pay'] =[1,'='];
            $member_where['m.create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
            $member = $UserMemberModel->alias('m')->where($member_where)->join('td_user u','u.id=m.user_id')->field("DATE_FORMAT(m.create_time, '%Y-%m-%d') AS time, COUNT(*) AS num")->group('time')->order('time','desc')->select();
            $user = $userModel->where($where)->field("DATE_FORMAT(create_time, '%Y-%m-%d') AS time, COUNT(*) AS num")->group('time')->order('time','desc')->select();
            $data1 = array_column($member,'num','time');
            $data2 = array_column($user,'num','time');
            foreach ($x as $k=>$v){
                $y_one[$k] = isset($data1[$v])?$data1[$v]:0;
                $y_two[$k] = isset($data2[$v])?$data2[$v]:0;
            }
            $this->AjaxJson(1,['x'=>array_values($x),'y_one'=>array_values($y_one),'y_two'=>array_values($y_two),$data1,$data2],'OK');return false;
        }catch (\Throwable $e){
            $this->AjaxJson(1,[],$e->getMessage());
        }

    }

    /**
     * 两个时间段的所有日期数组
     * @param $startDate
     * @param $endDate
     *
     * @return array
     */
    protected function periodDate($startDate,$endDate){
        $startTime = strtotime($startDate);
        $endTime   = strtotime($endDate);
        $arr       = array();
        while ($startTime<=$endTime){
            $arr[] = date('Y-m-d', $startTime);
            $startTime = $startTime+3600*24;
        }
        return $arr;
    }

    /**
     * 商家数量
     */
    protected function getShopTotal($reseller_id=0,$start_time='',$end_time=''){
        $model = ShopModel::create();
        $dateTime = $this->getParamDateTime();
        $where['id'] = [0,'>'];
        if($reseller_ids = $this->getSearchResellerId()){
            if(is_array($reseller_ids)){
                $where['reseller_id'] =[$reseller_ids,'in'];
            }else{
                $where['reseller_id'] =$reseller_ids;
            }
        }

        $total_num = ShopModel::create()->where($where)->count();
        $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];

        $num = $model->where($where)->count()??0;
        return compact('total_num','num');
    }
    /**
     * 订单数量
     */
    protected function getOrderTotal($reseller_id=0,$start_time='',$end_time=''){
        $model = OrderModel::create();
        $dateTime = $this->getParamDateTime();
        if($reseller_ids = $this->getSearchResellerId()){
            if(is_array($reseller_ids)){
                $where['reseller_id'] =[$reseller_ids,'in'];
            }else{
                $where['reseller_id'] =$reseller_ids;
            }
        }
        $where['is_cancel'] = [0,'='];
//        $total_num = OrderModel::create()->where($where)->count();
//        $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
//        $num = $model->where($where)->count()??0;
        $total_num = OrderModel::create()->where($where)->field('`status`,count(*) as num')->group('status')->select();
        $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
        $num = OrderModel::create()->where($where)->field('`status`,count(*) as num')->group('status')->select();
        $total_num = array_column($total_num,'num','status');
        $num = array_column($num,'num','status');
        return compact('total_num','num');
    }

    /**
     * 会员数量统计
     */
    protected function getMemberTotal($reseller_id=0,$start_time='',$end_time=''){
        $model = UserMemberModel::create();
        $model->where('m.is_pay',1)->alias('m');
        $model->join('td_user u','u.id=m.user_id','LEFT');

        $dateTime = $this->getParamDateTime();
        if($reseller_ids = $this->getSearchResellerId()){
            if(is_array($reseller_ids)){
                $where['u.reseller_id'] =[$reseller_ids,'in'];
                $user_where['reseller_id'] =[$reseller_ids,'in'];
            }else{
                $where['u.reseller_id'] = [$reseller_ids,'='];
                $user_where['reseller_id'] = [$reseller_ids,'='];
            }
        }
        $user_where['is_member'] = [1,'='];
        $user_where['member_expiry_time'] = [date('Y-m-d H:i:s'),'>='];
        $total_num = UserModel::create()->where($user_where)->count();
        $where['m.create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
        $res = $model->where($where)->field('COUNT(DISTINCT(m.user_id)) as num')->find();
        $num = $res['num']??0;
        $sql  = $model->lastQuery()->getLastPrepareQuery();
        return compact('total_num','num','sql');
    }
    /**
     * 用户量统计
     */
    protected function getUserTotal($reseller_id=0,$start_time='',$end_time=''){
        $model = UserModel::create();
        $dateTime = $this->getParamDateTime();
        if($reseller_ids = $this->getSearchResellerId()){
            if(is_array($reseller_ids)){
                $where['reseller_id'] =[$reseller_ids,'in'];
            }else{
                $where['reseller_id'] =$reseller_ids;
            }
        }

        $where['parent_id'] = [0,'>='];
        $total_num = UserModel::create()->where($where)->count();
        $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
        $num = $model->where($where)->count()??0;
        return compact('total_num','num');
    }
    /**
     * 推广用户统计
     */
    protected function getSpreadPeopleTotal($reseller_id=0,$start_time='',$end_time=''){
        $model = UserModel::create();
        $dateTime = $this->getParamDateTime();
        if($reseller_ids = $this->getSearchResellerId()){
            if(is_array($reseller_ids)){
                $where['reseller_id'] =[$reseller_ids,'in'];
            }else{
                $where['reseller_id'] =$reseller_ids;
            }
        }
        $where['parent_id'] = [0,'>'];
        $total_num = UserModel::create()->where($where)->count();
        $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
        $num = $model->where($where)->count()??0;
        return compact('total_num','num');
    }

    /**
     * 订单收益统计
     * 商家应付（商家补贴+佣金）-用户提现金额
     */
    protected function getOrderIncomeTotal($reseller_id=0,$start_time='',$end_time=''){
        $dateTime = $this->getParamDateTime();
        if($reseller_ids = $this->getSearchResellerId()){
            if(is_array($reseller_ids)){
                $where['reseller_id'] =[$reseller_ids,'in'];
                $cash_where['u.reseller_id'] =[$reseller_ids,'in'];
            }else{
                $where['reseller_id'] = [$reseller_ids,'='];
                $cash_where['u.reseller_id'] =[$reseller_ids,'='];
            }
        }

        $where['status'] = [5,'='];
        $cash_where['c.is_pay'] = [1,'='];
        $order_total_num = OrderModel::create()->where($where)->sum('`shop_pay_amount`');
        $cash_out_total_num = UserCashOutModel::create()->where($cash_where)->alias('c')->join('td_user u','u.id=c.user_id','LEFT')->sum('c.amount');
        $where['refund_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
        $cash_where['c.create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
        $order_num = OrderModel::create()->where($where)->sum('`shop_pay_amount`')??0;
        $cash_out_num = UserCashOutModel::create()->where($cash_where)->alias('c')->join('td_user u','u.id=c.user_id','LEFT')->sum('c.amount');
        $total_num = round($order_total_num-$cash_out_total_num,2);
        $num =  round($order_num-$cash_out_num,2);
        return compact('total_num','num','cash_out_total_num','order_total_num','cash_out_num','order_num');
    }


    /**
     * 获取查询的开始日期和结束日期
     */
    protected function getParamDateTime(){
        $start_time = $end_time = '';
        if(!empty($this->param['start_date'])||!empty($this->param['end_date'])){
            $start_time  = !empty($this->param['start_date'])?$this->param['start_date'].' 00:00:00':date('Y-m-d 00:00:00',strtotime($this->param['end_date'].' 00:00:00')-3600*24*29);
            $end_time  = !empty($this->param['end_date'])?$this->param['end_date'].' 23:59:59':date('Y-m-d 23:59:59',strtotime($this->param['start_date'].' 23:59:59')+3600*24*29);

        }else{
            switch ($this->param['type']??'7'){
                case '7':
                    $start_time = date('Y-m-d 00:00:00',time()-6*3600*24);
                    $end_time = date('Y-m-d 23:59:59');
                    break;
                case '30':
                    $start_time = date('Y-m-d 00:00:00',time()-29*3600*24);
                    $end_time = date('Y-m-d 23:59:59');
                    break;
                case 'last_month':
                    $start_time =date('Y-m-01 00:00:01',strtotime("-1 months",time()));
                    $day = date('t',strtotime("-1 months",time()));
                    $end_time = date("Y-m-{$day} 23:59:59", strtotime("-1 months", time()));
                    break;
                case 'month':
                    $start_time = date('Y-m-01 00:00:00',time());
                    $end_time = date('Y-m-d 23:59:59');
                    break;
                default:
                    $start_time = date('Y-m-d 00:00:00',time()-6*3600*24);
                    $end_time = date('Y-m-d 23:59:59');
            }
        }
        return compact('start_time','end_time');
    }

    /**
     * 商家类型分布占比
     */
    public function getCategoryShopData(){
        $model = ShopModel::create();
        $dateTime = $this->getParamDateTime();
        if($reseller_ids = $this->getSearchResellerId()){
            if(is_array($reseller_ids)){
                $model->where('s.reseller_id',$reseller_ids,'in');
            }else{
                $model->where('s.reseller_id',$reseller_ids);
            }
        }

        $where['s.create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];

        $list = $model->where($where)->group('category_id')->alias('s')
            ->join('td_category c','c.id=s.category_id','LEFT')
                                    ->field('c.name,count(*) as value')->order('value','DESC')->select();
        $this->AjaxJson(1,$list,'OK');
    }

    /**
     * 用户类型占比
     */
    public function getUserTypeData(){
        try {
            $dateTime = $this->getParamDateTime();
            if($reseller_ids = $this->getSearchResellerId()){
                if(is_array($reseller_ids)){
                    $where['reseller_id'] =[$reseller_ids,'in'];
                }else{
                    $where['reseller_id'] =$reseller_ids;
                }
            }
            $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
            $user_member_num = UserModel::create()
                                        ->where($where)
                                        ->where('is_black', 0)
                                        ->where('is_cancel', 0)

                                        ->where('create_order_num', 1, '>=')
                                        ->where('member_expiry_time', date('Y-m-d H:i:s'), '>=')
                                        ->count() ?? 0;

            $user_num = UserModel::create()
                                 ->where($where)
                                 ->where('is_black', 0)
                                 ->where('is_cancel', 0)
                                 ->where('create_order_num', 0, '>')
                                 ->where('member_expiry_time', date('Y-m-d H:i:s'), '<')
                                 ->count()??0;;
            $user_invalid_num = UserModel::create()->where($where)->where('create_order_num=0 and is_member=0')->count();


            $data[] =['name'=>'会员用户','value'=>$user_member_num];
            $data[] =['name'=>'普通用户','value'=>$user_num];
            $data[] =['name'=>'无效用户','value'=>$user_invalid_num];
            $this->AjaxJson(1,$data,'OK');
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }


    }

    /**
     * 用户按平台分布
     */
    public function getUserPlatformData(){
        $dateTime = $this->getParamDateTime();
        if($reseller_ids = $this->getSearchResellerId()){
            if(is_array($reseller_ids)){
                $where['reseller_id'] =[$reseller_ids,'in'];
            }else{
                $where['reseller_id'] =$reseller_ids;
            }
        }

        $where['create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
        $h5 = UserModel::create()->where($where)->where('openid !=""')->count();
        $app = UserModel::create()->where($where)->where('app_openid !=""')->count();
        $applet = UserModel::create()->where($where)->where('applet_openid !=""')->count();
        $data[] =['name'=>'公众号H5','value'=>$h5];
        $data[] =['name'=>'APP','value'=>$app];
        $data[] =['name'=>'小程序','value'=>$applet];
        $this->AjaxJson(1,$data,'OK');
    }

    /**
     * 用户全国分布
     */
    public function getUserDistribution(){
        try {
            $model = UserModel::create();
            $where =[];
            if($reseller_ids = $this->getSearchResellerId()){
                if(is_array($reseller_ids)){
                    $where['reseller_id'] =[$reseller_ids,'in'];
                }else{
                    $where['reseller_id'] =$reseller_ids;
                }
                $data =  $model->field('count(*) as value,city as name')->where($where)->group('city')->select();
            }else{
                $data =  $model->field('count(*) as value,province as name')->group('province')->select();
            }
            $this->AjaxJson(1,$data,'OK');
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }


    }
    /**
     * 商家订单量TOP10
     */
    public function getShopOrderRank(){
        try {
            $model = OrderModel::create();
            $dateTime = $this->getParamDateTime();
            if($reseller_ids = $this->getSearchResellerId()){
                if(is_array($reseller_ids)){
                    $where['o.reseller_id'] =[$reseller_ids,'in'];
                }else{
                    $where['o.reseller_id'] =$reseller_ids;
                }
            }
            $where['o.status'] = [5,'='];
            $where['o.create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
            $list =  $model->where($where)->field('s.logo,s.name,count(*) as value,"单" as text')->alias('o')
                           ->join('td_shop s', 's.id=o.shop_id', 'LEFT')
                           ->group('shop_id')->page(1, 10)->order('value', 'desc')->select();
            $this->AjaxJson(1,$list,'OK');
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }

    }
    /**
     * 业务员上店TOP10
     */
    public function getSalesShopRank(){
        try {
            $model = ShopModel::create();
            $dateTime = $this->getParamDateTime();
            if($reseller_ids = $this->getSearchResellerId()){
                if(is_array($reseller_ids)){
                    $where['s.reseller_id'] =[$reseller_ids,'in'];
                }else{
                    $where['s.reseller_id'] =$reseller_ids;
                }
            }
            $where['s.is_del'] = [0,'='];
            $where['s.create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
            $list =  $model->where($where)->field('"/public/uploads/shop/shop_logo.png" as logo,a.realname as name,count(*) as value,"家" as text')->alias('s')
                           ->join('td_business a', 'a.id=s.user_id', 'LEFT')
                           ->group('s.user_id')->page(1, 10)->order('value', 'desc')->select();
            $this->AjaxJson(1,$list,'OK'.$model->lastQuery()->getLastPrepareQuery());
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }

    }

    /**
     * 订单审核TOP10
     */
    public function getOrderCheckRank(){
        try {
            $model = OrderModel::create();
            $dateTime = $this->getParamDateTime();
            if($reseller_ids = $this->getSearchResellerId()){
                if(is_array($reseller_ids)){
                    $where['o.reseller_id'] =[$reseller_ids,'in'];
                }else{
                    $where['o.reseller_id'] =$reseller_ids;
                }
            }

            $where['o.is_cancel'] =[0,'>='];
            $where['o.create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
            $model->where($where);
            $list =  $model->field('"/public/uploads/shop/shop_logo.png" as logo,s.realname as name,count(*) as value,"单" as text')->alias('o')
                           ->join('td_admins s', 's.uid=o.check_user_id', 'LEFT')
                            ->where('o.is_cancel',0)
                            ->where('s.uid',1,'>=')
                           ->group('o.check_user_id')->page(1, 10)->order('value', 'desc')->select();
            $this->AjaxJson(1,$list,'OK');
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }


    }

    /**
     * 推广排行TOP10
     */
    public function getPromotionRank(){
        try {
            $model = UserModel::create();
            $dateTime = $this->getParamDateTime();
            if($reseller_ids = $this->getSearchResellerId()){
                if(is_array($reseller_ids)){
                    $where['u.reseller_id'] =[$reseller_ids,'in'];
                }else{
                    $where['u.reseller_id'] =$reseller_ids;
                }
            }

            $where['u.parent_id'] =[1,'>='];
            $where['u.create_time'] =[[$dateTime['start_time'],$dateTime['end_time']],'BETWEEN'];
            $list =  $model->where($where)->field('p.id,u.parent_id,p.avatar as logo,p.nickname as name,count(*) as value,"人" as text')->alias('u')
                           ->join('td_user p', 'p.id=u.parent_id', 'LEFT')
                           ->group('u.parent_id')->page(1, 10)->order('value', 'desc')->select();
            $this->AjaxJson(1,$list,'OK'.$model->lastQuery()->getLastPrepareQuery());
        }catch (\Throwable $e){
            $this->AjaxJson(0,[],$e->getMessage());
        }

    }

//    /**
//     * 获取当前查询的运营商ID
//     */
//    public function getSearchResellerId(){
//
//        $reseller_id = '';
//        if(!empty($this->param['reseller_id'])){
//            $reseller_id = $this->param['reseller_id'];
//        }else{
//            if ($this->uid != 1) {
//                $reseller_id = $this->reseller_id;
//            }
//        }
//        return $reseller_id;
//    }



}

