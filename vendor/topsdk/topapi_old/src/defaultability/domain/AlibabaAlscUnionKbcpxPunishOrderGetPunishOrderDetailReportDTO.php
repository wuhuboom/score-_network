<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbcpxPunishOrderGetPunishOrderDetailReportDTO {

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
        订单流水号
     **/
    public $serial_no;

    /**
        主商品ID，针对CPS订单
     **/
    public $main_item_id;

    /**
        主商品信息，针对CPS订单
     **/
    public $main_item_title;

    /**
        维权状态，0.待申诉 1.待审核 2.审核中 3.申诉成功 4.申诉失败 5.申诉过期
     **/
    public $explain_state;

    /**
        维权成功后的返佣状态，0-待返回 1-已返回
     **/
    public $return_commission_state;

    /**
        渠道应结算金额
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
        订单号
     **/
    public $biz_order_id;


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

    public function getSerialNo() : string{
        return $this->serial_no;
    }

    public function setSerialNo(string $serialNo){
        $this->serial_no = $serialNo;
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

    public function getExplainState() : string{
        return $this->explain_state;
    }

    public function setExplainState(string $explainState){
        $this->explain_state = $explainState;
    }

    public function getReturnCommissionState() : int{
        return $this->return_commission_state;
    }

    public function setReturnCommissionState(int $returnCommissionState){
        $this->return_commission_state = $returnCommissionState;
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

    public function getBizOrderId() : string{
        return $this->biz_order_id;
    }

    public function setBizOrderId(string $bizOrderId){
        $this->biz_order_id = $bizOrderId;
    }


}

