<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbOrderCreateOrderDto {

    /**
        渠道订单号，需保证全局唯一
     **/
    public $outer_order_id;

    /**
        商品ID
     **/
    public $item_id;

    /**
        购买数量
     **/
    public $quantity;

    /**
        等同sell_price
     **/
    public $pay_order_fee;

    /**
        商品的原价*份数，单位分
     **/
    public $order_fee;

    /**
        商品的活动价*份数，单位分
     **/
    public $sell_price;

    /**
        商品名称
     **/
    public $title;

    /**
        扩展参数，json格式
     **/
    public $ext_info;

    /**
        true预下单不支付，false下单并支付
     **/
    public $skip_pay;

    /**
        加密后的手机号
     **/
    public $phone;


    public function getOuterOrderId() : string{
        return $this->outer_order_id;
    }

    public function setOuterOrderId(string $outerOrderId){
        $this->outer_order_id = $outerOrderId;
    }

    public function getItemId() : string{
        return $this->item_id;
    }

    public function setItemId(string $itemId){
        $this->item_id = $itemId;
    }

    public function getQuantity() : int{
        return $this->quantity;
    }

    public function setQuantity(int $quantity){
        $this->quantity = $quantity;
    }

    public function getPayOrderFee() : int{
        return $this->pay_order_fee;
    }

    public function setPayOrderFee(int $payOrderFee){
        $this->pay_order_fee = $payOrderFee;
    }

    public function getOrderFee() : int{
        return $this->order_fee;
    }

    public function setOrderFee(int $orderFee){
        $this->order_fee = $orderFee;
    }

    public function getSellPrice() : int{
        return $this->sell_price;
    }

    public function setSellPrice(int $sellPrice){
        $this->sell_price = $sellPrice;
    }

    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getExtInfo() : string{
        return $this->ext_info;
    }

    public function setExtInfo(string $extInfo){
        $this->ext_info = $extInfo;
    }

    public function getSkipPay() : bool{
        return $this->skip_pay;
    }

    public function setSkipPay(bool $skipPay){
        $this->skip_pay = $skipPay;
    }

    public function getPhone() : string{
        return $this->phone;
    }

    public function setPhone(string $phone){
        $this->phone = $phone;
    }


}

