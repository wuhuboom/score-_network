<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbOrderRefundOrderVoucherDto {

    /**
        淘宝子单号
     **/
    public $biz_order_id;

    /**
        订单状态
     **/
    public $order_status;


    public function getBizOrderId() : int{
        return $this->biz_order_id;
    }

    public function setBizOrderId(int $bizOrderId){
        $this->biz_order_id = $bizOrderId;
    }

    public function getOrderStatus() : string{
        return $this->order_status;
    }

    public function setOrderStatus(string $orderStatus){
        $this->order_status = $orderStatus;
    }


}

