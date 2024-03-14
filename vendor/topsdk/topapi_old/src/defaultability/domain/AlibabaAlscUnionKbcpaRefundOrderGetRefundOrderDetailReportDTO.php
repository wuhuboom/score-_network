<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbcpaRefundOrderGetRefundOrderDetailReportDTO {

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
        结算金额
     **/
    public $settle_amount;

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
        维权状态，0-维权成功 1-维权创建 2-维权关闭 3-维权失败
     **/
    public $explain_state;

    /**
        渠道应结算金额
     **/
    public $settle;

    /**
        申诉之后的佣金返回状态 1-已结算 2-未结算
     **/
    public $settle_state;

    /**
        淘宝子单号
     **/
    public $biz_order_id;

    /**
        父订单号
     **/
    public $parent_order_id;

    /**
        更新时间
     **/
    public $gmt_modified;


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

    public function getSettleAmount() : string{
        return $this->settle_amount;
    }

    public function setSettleAmount(string $settleAmount){
        $this->settle_amount = $settleAmount;
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

    public function getExplainState() : int{
        return $this->explain_state;
    }

    public function setExplainState(int $explainState){
        $this->explain_state = $explainState;
    }

    public function getSettle() : string{
        return $this->settle;
    }

    public function setSettle(string $settle){
        $this->settle = $settle;
    }

    public function getSettleState() : int{
        return $this->settle_state;
    }

    public function setSettleState(int $settleState){
        $this->settle_state = $settleState;
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

    public function getGmtModified() : string{
        return $this->gmt_modified;
    }

    public function setGmtModified(string $gmtModified){
        $this->gmt_modified = $gmtModified;
    }


}

