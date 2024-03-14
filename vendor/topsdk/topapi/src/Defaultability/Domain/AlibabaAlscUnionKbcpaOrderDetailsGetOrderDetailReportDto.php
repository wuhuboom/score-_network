<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbcpaOrderDetailsGetOrderDetailReportDto {

    /**
        商品标题
     **/
    public $title;

    /**
        商品图片url
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
        订单付款时间
     **/
    public $pay_time;

    /**
        收货时间
     **/
    public $receive_time;

    /**
        订单结算时间
     **/
    public $settle_time;

    /**
        订单状态，0-已失效 1-已下单 2-已付款 4-已收货 
     **/
    public $order_state;

    /**
        结算状态，1.已结算 2.未结算
     **/
    public $settle_state;

    /**
        结算预估收入
     **/
    public $settle;

    /**
        技术服务费
     **/
    public $service;

    /**
        淘宝子单号
     **/
    public $biz_order_id;

    /**
        淘宝主单号
     **/
    public $parent_order_id;

    /**
        点击时间
     **/
    public $trace_time;

    /**
        商品id
     **/
    public $item_id;

    /**
        商品数量
     **/
    public $product_num;

    /**
        商品单价
     **/
    public $unit_price;

    /**
        联盟补贴金额
     **/
    public $subsidy_fee;

    /**
        激励金额（第二阶段分佣金额）
     **/
    public $award_fee;

    /**
        技术服务费率
     **/
    public $platform_commission_rate;

    /**
        技术服务费
     **/
    public $platform_commission_fee;

    /**
        媒体id
     **/
    public $media_id;

    /**
        媒体名称
     **/
    public $media_name;

    /**
        推广位id
     **/
    public $ad_zone_id;

    /**
        推广位名称
     **/
    public $ad_zone_name;

    /**
        类目名称
     **/
    public $category_name;

    /**
        创建时间
     **/
    public $tk_create_time;

    /**
        预估收入
     **/
    public $income;

    /**
        更新时间
     **/
    public $gmt_modified;


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

    public function getPayTime() : string{
        return $this->pay_time;
    }

    public function setPayTime(string $payTime){
        $this->pay_time = $payTime;
    }

    public function getReceiveTime() : string{
        return $this->receive_time;
    }

    public function setReceiveTime(string $receiveTime){
        $this->receive_time = $receiveTime;
    }

    public function getSettleTime() : string{
        return $this->settle_time;
    }

    public function setSettleTime(string $settleTime){
        $this->settle_time = $settleTime;
    }

    public function getOrderState() : int{
        return $this->order_state;
    }

    public function setOrderState(int $orderState){
        $this->order_state = $orderState;
    }

    public function getSettleState() : int{
        return $this->settle_state;
    }

    public function setSettleState(int $settleState){
        $this->settle_state = $settleState;
    }

    public function getSettle() : string{
        return $this->settle;
    }

    public function setSettle(string $settle){
        $this->settle = $settle;
    }

    public function getService() : string{
        return $this->service;
    }

    public function setService(string $service){
        $this->service = $service;
    }

    public function getBizOrderId() : string{
        return $this->biz_order_id;
    }

    public function setBizOrderId(string $bizOrderId){
        $this->biz_order_id = $bizOrderId;
    }

    public function getParentOrderId() : string{
        return $this->parent_order_id;
    }

    public function setParentOrderId(string $parentOrderId){
        $this->parent_order_id = $parentOrderId;
    }

    public function getTraceTime() : string{
        return $this->trace_time;
    }

    public function setTraceTime(string $traceTime){
        $this->trace_time = $traceTime;
    }

    public function getItemId() : string{
        return $this->item_id;
    }

    public function setItemId(string $itemId){
        $this->item_id = $itemId;
    }

    public function getProductNum() : int{
        return $this->product_num;
    }

    public function setProductNum(int $productNum){
        $this->product_num = $productNum;
    }

    public function getUnitPrice() : string{
        return $this->unit_price;
    }

    public function setUnitPrice(string $unitPrice){
        $this->unit_price = $unitPrice;
    }

    public function getSubsidyFee() : string{
        return $this->subsidy_fee;
    }

    public function setSubsidyFee(string $subsidyFee){
        $this->subsidy_fee = $subsidyFee;
    }

    public function getAwardFee() : string{
        return $this->award_fee;
    }

    public function setAwardFee(string $awardFee){
        $this->award_fee = $awardFee;
    }

    public function getPlatformCommissionRate() : string{
        return $this->platform_commission_rate;
    }

    public function setPlatformCommissionRate(string $platformCommissionRate){
        $this->platform_commission_rate = $platformCommissionRate;
    }

    public function getPlatformCommissionFee() : string{
        return $this->platform_commission_fee;
    }

    public function setPlatformCommissionFee(string $platformCommissionFee){
        $this->platform_commission_fee = $platformCommissionFee;
    }

    public function getMediaId() : int{
        return $this->media_id;
    }

    public function setMediaId(int $mediaId){
        $this->media_id = $mediaId;
    }

    public function getMediaName() : string{
        return $this->media_name;
    }

    public function setMediaName(string $mediaName){
        $this->media_name = $mediaName;
    }

    public function getAdZoneId() : int{
        return $this->ad_zone_id;
    }

    public function setAdZoneId(int $adZoneId){
        $this->ad_zone_id = $adZoneId;
    }

    public function getAdZoneName() : string{
        return $this->ad_zone_name;
    }

    public function setAdZoneName(string $adZoneName){
        $this->ad_zone_name = $adZoneName;
    }

    public function getCategoryName() : string{
        return $this->category_name;
    }

    public function setCategoryName(string $categoryName){
        $this->category_name = $categoryName;
    }

    public function getTkCreateTime() : string{
        return $this->tk_create_time;
    }

    public function setTkCreateTime(string $tkCreateTime){
        $this->tk_create_time = $tkCreateTime;
    }

    public function getIncome() : string{
        return $this->income;
    }

    public function setIncome(string $income){
        $this->income = $income;
    }

    public function getGmtModified() : string{
        return $this->gmt_modified;
    }

    public function setGmtModified(string $gmtModified){
        $this->gmt_modified = $gmtModified;
    }


}

