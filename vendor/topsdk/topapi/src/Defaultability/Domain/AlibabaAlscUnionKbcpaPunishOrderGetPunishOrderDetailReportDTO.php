<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbcpaPunishOrderGetPunishOrderDetailReportDTO {

    /**
        商品标题
     **/
    public $title;

    /**
        商品图片
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
        维权状态，0.待申诉 1.待审核 2.审核中 3.申诉成功 4.申诉失败 5.申诉过期
     **/
    public $explain_state;

    /**
        渠道应结算金额
     **/
    public $settle;

    /**
        返佣完成状态 0-待返回 1-已返回
     **/
    public $return_commission_state;

    /**
        订单流水号
     **/
    public $serial_no;


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

    public function getReturnCommissionState() : int{
        return $this->return_commission_state;
    }

    public function setReturnCommissionState(int $returnCommissionState){
        $this->return_commission_state = $returnCommissionState;
    }

    public function getSerialNo() : string{
        return $this->serial_no;
    }

    public function setSerialNo(string $serialNo){
        $this->serial_no = $serialNo;
    }


}

