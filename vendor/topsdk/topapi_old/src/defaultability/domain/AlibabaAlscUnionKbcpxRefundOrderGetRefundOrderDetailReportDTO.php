<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbcpxRefundOrderGetRefundOrderDetailReportDTO {

    /**
        商品标题
     **/
    public $title;

    /**
        商品图片url
     **/
    public $pic_url;

    /**
        店铺名称
     **/
    public $shop_name;

    /**
        付款金额
     **/
    public $pay_amount;

    /**
        订单结算时间
     **/
    public $settle_time;

    /**
        维权创建时间
     **/
    public $explain_start_time;

    /**
        维权结束时间
     **/
    public $explain_end_time;

    /**
        淘宝子单号
     **/
    public $biz_order_id;

    /**
        淘宝主单号
     **/
    public $parent_order_id;

    /**
        主商品ID，针对CPS订单
     **/
    public $main_item_id;

    /**
        主商品信息，针对CPS订单
     **/
    public $main_item_title;

    /**
        维权状态，0-维权成功 1-维权创建 2-维权关闭 3-维权失败
     **/
    public $explain_state;

    /**
        维权成功后的佣金返回状态 0-待返回 1-已返回
     **/
    public $return_commission_state;

    /**
        维权退款金额
     **/
    public $refund_amount;

    /**
        应返回商家金额
     **/
    public $settle;

    /**
        更新时间
     **/
    public $gmt_modified;

    /**
        会员标识
     **/
    public $sid;

    /**
        1口碑，2饿了么
     **/
    public $platform_type;

    /**
        活动ID
     **/
    public $activity_id;

    /**
        pid
     **/
    public $pid;

    /**
        卡券订单号
     **/
    public $relation_order_id;

    /**
        场景值，7卡券订单，8卡券核销订单
     **/
    public $flow_type;

    /**
        活动信息明细
     **/
    public $activity_info_remark_list;

    /**
        权益ID（flow_type=10或11时为媒体出资活动ID）
     **/
    public $channel_right_id;


    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getPicUrl() : string{
        return $this->pic_url;
    }

    public function setPicUrl(string $picUrl){
        $this->pic_url = $picUrl;
    }

    public function getShopName() : string{
        return $this->shop_name;
    }

    public function setShopName(string $shopName){
        $this->shop_name = $shopName;
    }

    public function getPayAmount() : string{
        return $this->pay_amount;
    }

    public function setPayAmount(string $payAmount){
        $this->pay_amount = $payAmount;
    }

    public function getSettleTime() : string{
        return $this->settle_time;
    }

    public function setSettleTime(string $settleTime){
        $this->settle_time = $settleTime;
    }

    public function getExplainStartTime() : string{
        return $this->explain_start_time;
    }

    public function setExplainStartTime(string $explainStartTime){
        $this->explain_start_time = $explainStartTime;
    }

    public function getExplainEndTime() : string{
        return $this->explain_end_time;
    }

    public function setExplainEndTime(string $explainEndTime){
        $this->explain_end_time = $explainEndTime;
    }

    public function getBizOrderId() : string{
        return $this->biz_order_id;
    }

    public function setBizOrderId(string $bizOrderId){
        $this->biz_order_id = $bizOrderId;
    }

    public function getParentOrderId() : string{
        return $this->parent_order_id;
    }

    public function setParentOrderId(string $parentOrderId){
        $this->parent_order_id = $parentOrderId;
    }

    public function getMainItemId() : string{
        return $this->main_item_id;
    }

    public function setMainItemId(string $mainItemId){
        $this->main_item_id = $mainItemId;
    }

    public function getMainItemTitle() : string{
        return $this->main_item_title;
    }

    public function setMainItemTitle(string $mainItemTitle){
        $this->main_item_title = $mainItemTitle;
    }

    public function getExplainState() : int{
        return $this->explain_state;
    }

    public function setExplainState(int $explainState){
        $this->explain_state = $explainState;
    }

    public function getReturnCommissionState() : int{
        return $this->return_commission_state;
    }

    public function setReturnCommissionState(int $returnCommissionState){
        $this->return_commission_state = $returnCommissionState;
    }

    public function getRefundAmount() : string{
        return $this->refund_amount;
    }

    public function setRefundAmount(string $refundAmount){
        $this->refund_amount = $refundAmount;
    }

    public function getSettle() : string{
        return $this->settle;
    }

    public function setSettle(string $settle){
        $this->settle = $settle;
    }

    public function getGmtModified() : string{
        return $this->gmt_modified;
    }

    public function setGmtModified(string $gmtModified){
        $this->gmt_modified = $gmtModified;
    }

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }

    public function getPlatformType() : int{
        return $this->platform_type;
    }

    public function setPlatformType(int $platformType){
        $this->platform_type = $platformType;
    }

    public function getActivityId() : int{
        return $this->activity_id;
    }

    public function setActivityId(int $activityId){
        $this->activity_id = $activityId;
    }

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getRelationOrderId() : int{
        return $this->relation_order_id;
    }

    public function setRelationOrderId(int $relationOrderId){
        $this->relation_order_id = $relationOrderId;
    }

    public function getFlowType() : int{
        return $this->flow_type;
    }

    public function setFlowType(int $flowType){
        $this->flow_type = $flowType;
    }

    public function getActivityInfoRemarkList() : string{
        return $this->activity_info_remark_list;
    }

    public function setActivityInfoRemarkList(string $activityInfoRemarkList){
        $this->activity_info_remark_list = $activityInfoRemarkList;
    }

    public function getChannelRightId() : string{
        return $this->channel_right_id;
    }

    public function setChannelRightId(string $channelRightId){
        $this->channel_right_id = $channelRightId;
    }


}

