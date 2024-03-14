<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbOrderQueryOrderQueryDto {

    /**
        淘宝子单号
     **/
    public $biz_order_id;


    public function getBizOrderId() : string{
        return $this->biz_order_id;
    }

    public function setBizOrderId(string $bizOrderId){
        $this->biz_order_id = $bizOrderId;
    }


}

