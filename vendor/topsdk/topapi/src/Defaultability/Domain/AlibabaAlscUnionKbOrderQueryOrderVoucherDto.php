<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbOrderQueryOrderVoucherDto {

    /**
        淘宝子单号
     **/
    public $biz_order_id;

    /**
        凭证列表
     **/
    public $voucher_list;

    /**
        订单状态。当前只有PAID一个状态
     **/
    public $order_status;


    public function getBizOrderId() : string{
        return $this->biz_order_id;
    }

    public function setBizOrderId(string $bizOrderId){
        $this->biz_order_id = $bizOrderId;
    }

    public function getVoucherList() : array{
        return $this->voucher_list;
    }

    public function setVoucherList(array $voucherList){
        $this->voucher_list = $voucherList;
    }

    public function getOrderStatus() : string{
        return $this->order_status;
    }

    public function setOrderStatus(string $orderStatus){
        $this->order_status = $orderStatus;
    }


}

