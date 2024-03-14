<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbOrderRefundOrderRefundDto {

    /**
        用户退款原因，必填
     **/
    public $reason;

    /**
        本地生活订单号，，必填
     **/
    public $biz_order_id;

    /**
        退款明细
     **/
    public $voucher_list;

    /**
        扩展参数，json格式
     **/
    public $ext_info;


    public function getReason() : string{
        return $this->reason;
    }

    public function setReason(string $reason){
        $this->reason = $reason;
    }

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

    public function getExtInfo() : string{
        return $this->ext_info;
    }

    public function setExtInfo(string $extInfo){
        $this->ext_info = $extInfo;
    }


}

