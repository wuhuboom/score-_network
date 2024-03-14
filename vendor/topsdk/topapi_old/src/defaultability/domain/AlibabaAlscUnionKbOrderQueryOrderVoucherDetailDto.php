<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbOrderQueryOrderVoucherDetailDto {

    /**
        商品ID
     **/
    public $item_id;

    /**
        商品名称
     **/
    public $title;

    /**
        凭证ID
     **/
    public $voucher_id;

    /**
        核销码。使用时需要生成二维码，并提示“请商家用阿里本地通（原口碑掌柜）核销”，否则用户核销时会被商家拒绝
     **/
    public $ticket_code;

    /**
        凭证状态。可用EFFECTIVE、已用USED、失效CANCELED
     **/
    public $voucher_status;

    /**
        总份数
     **/
    public $total_amount;

    /**
        已使用份数
     **/
    public $used_amount;

    /**
        已退款份数（售中、售后）
     **/
    public $refund_amount;

    /**
        凭证生效时间
     **/
    public $effect_time;

    /**
        凭证过期时间
     **/
    public $expire_time;

    /**
        扩展字段
     **/
    public $ext_info;

    /**
        凭证退款类型。售中退BEFORE_USE_REFUND、售后退AFTER_USE_REFUND、过期退EXPIRATION_REFUND、冲正REVERSE
     **/
    public $refund_type;

    /**
        小程序地址或http地址
     **/
    public $ticket_url;


    public function getItemId() : string{
        return $this->item_id;
    }

    public function setItemId(string $itemId){
        $this->item_id = $itemId;
    }

    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getVoucherId() : string{
        return $this->voucher_id;
    }

    public function setVoucherId(string $voucherId){
        $this->voucher_id = $voucherId;
    }

    public function getTicketCode() : string{
        return $this->ticket_code;
    }

    public function setTicketCode(string $ticketCode){
        $this->ticket_code = $ticketCode;
    }

    public function getVoucherStatus() : string{
        return $this->voucher_status;
    }

    public function setVoucherStatus(string $voucherStatus){
        $this->voucher_status = $voucherStatus;
    }

    public function getTotalAmount() : int{
        return $this->total_amount;
    }

    public function setTotalAmount(int $totalAmount){
        $this->total_amount = $totalAmount;
    }

    public function getUsedAmount() : int{
        return $this->used_amount;
    }

    public function setUsedAmount(int $usedAmount){
        $this->used_amount = $usedAmount;
    }

    public function getRefundAmount() : int{
        return $this->refund_amount;
    }

    public function setRefundAmount(int $refundAmount){
        $this->refund_amount = $refundAmount;
    }

    public function getEffectTime() : string{
        return $this->effect_time;
    }

    public function setEffectTime(string $effectTime){
        $this->effect_time = $effectTime;
    }

    public function getExpireTime() : string{
        return $this->expire_time;
    }

    public function setExpireTime(string $expireTime){
        $this->expire_time = $expireTime;
    }

    public function getExtInfo() : string{
        return $this->ext_info;
    }

    public function setExtInfo(string $extInfo){
        $this->ext_info = $extInfo;
    }

    public function getRefundType() : string{
        return $this->refund_type;
    }

    public function setRefundType(string $refundType){
        $this->refund_type = $refundType;
    }

    public function getTicketUrl() : string{
        return $this->ticket_url;
    }

    public function setTicketUrl(string $ticketUrl){
        $this->ticket_url = $ticketUrl;
    }


}

