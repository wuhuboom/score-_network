<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionItempromotionQueryItemPromotionDto {

    /**
        商品ID
     **/
    public $item_id;

    /**
        标题
     **/
    public $item_name;

    /**
        图片
     **/
    public $picture;

    /**
        商品类型
     **/
    public $biz_type;

    /**
        原价（分）
     **/
    public $original_price_cent;

    /**
        售价（分）
     **/
    public $sell_price_cent;

    /**
        折扣
     **/
    public $discount;

    /**
        起始时间（秒）
     **/
    public $start_ime;

    /**
        结束时间（秒）
     **/
    public $end_time;

    /**
        佣金比例
     **/
    public $commission_rate;

    /**
        预估佣金（分）
     **/
    public $commission;

    /**
        库存
     **/
    public $stock;

    /**
        适用城市数量
     **/
    public $apply_city_count;

    /**
        适用门店数量
     **/
    public $apply_shop_count;

    /**
        分享链接
     **/
    public $link;


    public function getItemId() : string{
        return $this->item_id;
    }

    public function setItemId(string $itemId){
        $this->item_id = $itemId;
    }

    public function getItemName() : string{
        return $this->item_name;
    }

    public function setItemName(string $itemName){
        $this->item_name = $itemName;
    }

    public function getPicture() : string{
        return $this->picture;
    }

    public function setPicture(string $picture){
        $this->picture = $picture;
    }

    public function getBizType() : string{
        return $this->biz_type;
    }

    public function setBizType(string $bizType){
        $this->biz_type = $bizType;
    }

    public function getOriginalPriceCent() : int{
        return $this->original_price_cent;
    }

    public function setOriginalPriceCent(int $originalPriceCent){
        $this->original_price_cent = $originalPriceCent;
    }

    public function getSellPriceCent() : int{
        return $this->sell_price_cent;
    }

    public function setSellPriceCent(int $sellPriceCent){
        $this->sell_price_cent = $sellPriceCent;
    }

    public function getDiscount() : string{
        return $this->discount;
    }

    public function setDiscount(string $discount){
        $this->discount = $discount;
    }

    public function getStartIme() : int{
        return $this->start_ime;
    }

    public function setStartIme(int $startIme){
        $this->start_ime = $startIme;
    }

    public function getEndTime() : int{
        return $this->end_time;
    }

    public function setEndTime(int $endTime){
        $this->end_time = $endTime;
    }

    public function getCommissionRate() : string{
        return $this->commission_rate;
    }

    public function setCommissionRate(string $commissionRate){
        $this->commission_rate = $commissionRate;
    }

    public function getCommission() : int{
        return $this->commission;
    }

    public function setCommission(int $commission){
        $this->commission = $commission;
    }

    public function getStock() : int{
        return $this->stock;
    }

    public function setStock(int $stock){
        $this->stock = $stock;
    }

    public function getApplyCityCount() : int{
        return $this->apply_city_count;
    }

    public function setApplyCityCount(int $applyCityCount){
        $this->apply_city_count = $applyCityCount;
    }

    public function getApplyShopCount() : int{
        return $this->apply_shop_count;
    }

    public function setApplyShopCount(int $applyShopCount){
        $this->apply_shop_count = $applyShopCount;
    }

    public function getLink() : AlibabaAlscUnionElemePromotionItempromotionQueryPromotionLink{
        return $this->link;
    }

    public function setLink(AlibabaAlscUnionElemePromotionItempromotionQueryPromotionLink $link){
        $this->link = $link;
    }


}

