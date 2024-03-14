<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemPromotionKbItemPromotionDTO {

    /**
        商品可售卖截止时间,时间戳(秒)
     **/
    public $item_sale_end_time;

    /**
        原始价格，单位元
     **/
    public $original_price;

    /**
        口碑微信小程序appId
     **/
    public $wx_app_id;

    /**
        折扣
     **/
    public $discount;

    /**
        商品标题
     **/
    public $title;

    /**
        月销量
     **/
    public $thirty_sold_quantity;

    /**
        商品id
     **/
    public $item_id;

    /**
        售卖价格,折扣后价格
     **/
    public $price;

    /**
        商品图片
     **/
    public $image_url;

    /**
        点击商品后，微信小程序的承接页  	
     **/
    public $wx_path;

    /**
        预估佣金，单位元
     **/
    public $commission;

    /**
        商品可适用门店数量
     **/
    public $apply_shop_num;

    /**
        库存
     **/
    public $stock;

    /**
        商品可售卖开始时间,单位元
     **/
    public $item_sale_start_time;

    /**
        可使用城市列表
     **/
    public $valid_cities;

    /**
        核销后奖励佣金,单位元;cpa业务类型返回
     **/
    public $bonus_commission;

    /**
        总销量
     **/
    public $total_sales;

    /**
        商品可售卖的端类型。1支付宝端商品，2微信端商品，3全部
     **/
    public $item_type;


    public function getItemSaleEndTime() : int{
        return $this->item_sale_end_time;
    }

    public function setItemSaleEndTime(int $itemSaleEndTime){
        $this->item_sale_end_time = $itemSaleEndTime;
    }

    public function getOriginalPrice() : string{
        return $this->original_price;
    }

    public function setOriginalPrice(string $originalPrice){
        $this->original_price = $originalPrice;
    }

    public function getWxAppId() : string{
        return $this->wx_app_id;
    }

    public function setWxAppId(string $wxAppId){
        $this->wx_app_id = $wxAppId;
    }

    public function getDiscount() : string{
        return $this->discount;
    }

    public function setDiscount(string $discount){
        $this->discount = $discount;
    }

    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getThirtySoldQuantity() : int{
        return $this->thirty_sold_quantity;
    }

    public function setThirtySoldQuantity(int $thirtySoldQuantity){
        $this->thirty_sold_quantity = $thirtySoldQuantity;
    }

    public function getItemId() : int{
        return $this->item_id;
    }

    public function setItemId(int $itemId){
        $this->item_id = $itemId;
    }

    public function getPrice() : string{
        return $this->price;
    }

    public function setPrice(string $price){
        $this->price = $price;
    }

    public function getImageUrl() : string{
        return $this->image_url;
    }

    public function setImageUrl(string $imageUrl){
        $this->image_url = $imageUrl;
    }

    public function getWxPath() : string{
        return $this->wx_path;
    }

    public function setWxPath(string $wxPath){
        $this->wx_path = $wxPath;
    }

    public function getCommission() : string{
        return $this->commission;
    }

    public function setCommission(string $commission){
        $this->commission = $commission;
    }

    public function getApplyShopNum() : int{
        return $this->apply_shop_num;
    }

    public function setApplyShopNum(int $applyShopNum){
        $this->apply_shop_num = $applyShopNum;
    }

    public function getStock() : int{
        return $this->stock;
    }

    public function setStock(int $stock){
        $this->stock = $stock;
    }

    public function getItemSaleStartTime() : int{
        return $this->item_sale_start_time;
    }

    public function setItemSaleStartTime(int $itemSaleStartTime){
        $this->item_sale_start_time = $itemSaleStartTime;
    }

    public function getValidCities() : array{
        return $this->valid_cities;
    }

    public function setValidCities(array $validCities){
        $this->valid_cities = $validCities;
    }

    public function getBonusCommission() : string{
        return $this->bonus_commission;
    }

    public function setBonusCommission(string $bonusCommission){
        $this->bonus_commission = $bonusCommission;
    }

    public function getTotalSales() : int{
        return $this->total_sales;
    }

    public function setTotalSales(int $totalSales){
        $this->total_sales = $totalSales;
    }

    public function getItemType() : int{
        return $this->item_type;
    }

    public function setItemType(int $itemType){
        $this->item_type = $itemType;
    }


}

