<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbOrderPayOrderPayDto {

    /**
        渠道订单号
     **/
    public $outer_order_id;

    /**
        淘宝子单号
     **/
    public $biz_order_id;


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


}

