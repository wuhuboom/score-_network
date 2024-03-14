<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbOrderPayOrderVoucherDto {

    /**
        渠道订单号
     **/
    public $outer_order_id;

    /**
        淘宝子单号
     **/
    public $biz_order_id;

    /**
        订单状态，创建成功后的状态
     **/
    public $order_status;


    public function getOuterOrderId() : string{
        return $this->outer_order_id;
    }

    public function setOuterOrderId(string $outerOrderId){
        $this->outer_order_id = $outerOrderId;
    }

    public function getBizOrderId() : string{
        return $this->biz_order_id;
    }

    public function setBizOrderId(string $bizOrderId){
        $this->biz_order_id = $bizOrderId;
    }

    public function getOrderStatus() : string{
        return $this->order_status;
    }

    public function setOrderStatus(string $orderStatus){
        $this->order_status = $orderStatus;
    }


}

