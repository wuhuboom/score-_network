<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbOrderRefundOrderVoucherDetailDto {

    /**
        商品ID，必填
     **/
    public $item_id;

    /**
        凭证ID，必填
     **/
    public $voucher_id;


    public function getItemId() : string{
        return $this->item_id;
    }

    public function setItemId(string $itemId){
        $this->item_id = $itemId;
    }

    public function getVoucherId() : string{
        return $this->voucher_id;
    }

    public function setVoucherId(string $voucherId){
        $this->voucher_id = $voucherId;
    }


}

