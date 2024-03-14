<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemQueryBbtItemDto {

    /**
        商品ID
     **/
    public $item_id;

    /**
        标题
     **/
    public $title;

    /**
        主图
     **/
    public $main_picture;

    /**
        售卖起始时间（秒）
     **/
    public $sale_start_time;

    /**
        售卖结束时间（秒）
     **/
    public $sale_end_time;

    /**
        原价（分）
     **/
    public $original_price_cent;

    /**
        活动价（分）
     **/
    public $activity_price_cent;

    /**
        佣金比例
     **/
    public $commission_rate;

    /**
        适用门店数量（city_id不为空则返回当前城市可用门店数，否则返回全部可用门店数）
     **/
    public $apply_shop_count;

    /**
        销量
     **/
    public $total_sales;

    /**
        库存
     **/
    public $stock;

    /**
        商品子类型
     **/
    public $item_sub_type;

    /**
        使用次数
     **/
    public $use_times;

    /**
        商品可用城市
     **/
    public $apply_city_ids;

    /**
        当前商品购买是否需要手机号
     **/
    public $need_phone;

    /**
        淘宝二级类目ID
     **/
    public $tb_category_2_id;

    /**
        淘宝二级类目名称
     **/
    public $tb_category_2_name;

    /**
        淘宝三级类目ID
     **/
    public $tb_category_3_id;

    /**
        淘宝三级类目名称
     **/
    public $tb_category_3_name;

    /**
        限购份数（-1表示不限购）
     **/
    public $buy_limit;

    /**
        品牌
     **/
    public $brand;

    /**
        三方服务商名称
     **/
    public $tripartite_name;

    /**
        三方服务商appKey
     **/
    public $tripartite_appkey;

    /**
        三方站点名称
     **/
    public $tripartite_site_name;


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

    public function getMainPicture() : string{
        return $this->main_picture;
    }

    public function setMainPicture(string $mainPicture){
        $this->main_picture = $mainPicture;
    }

    public function getSaleStartTime() : int{
        return $this->sale_start_time;
    }

    public function setSaleStartTime(int $saleStartTime){
        $this->sale_start_time = $saleStartTime;
    }

    public function getSaleEndTime() : int{
        return $this->sale_end_time;
    }

    public function setSaleEndTime(int $saleEndTime){
        $this->sale_end_time = $saleEndTime;
    }

    public function getOriginalPriceCent() : int{
        return $this->original_price_cent;
    }

    public function setOriginalPriceCent(int $originalPriceCent){
        $this->original_price_cent = $originalPriceCent;
    }

    public function getActivityPriceCent() : int{
        return $this->activity_price_cent;
    }

    public function setActivityPriceCent(int $activityPriceCent){
        $this->activity_price_cent = $activityPriceCent;
    }

    public function getCommissionRate() : string{
        return $this->commission_rate;
    }

    public function setCommissionRate(string $commissionRate){
        $this->commission_rate = $commissionRate;
    }

    public function getApplyShopCount() : int{
        return $this->apply_shop_count;
    }

    public function setApplyShopCount(int $applyShopCount){
        $this->apply_shop_count = $applyShopCount;
    }

    public function getTotalSales() : int{
        return $this->total_sales;
    }

    public function setTotalSales(int $totalSales){
        $this->total_sales = $totalSales;
    }

    public function getStock() : int{
        return $this->stock;
    }

    public function setStock(int $stock){
        $this->stock = $stock;
    }

    public function getItemSubType() : string{
        return $this->item_sub_type;
    }

    public function setItemSubType(string $itemSubType){
        $this->item_sub_type = $itemSubType;
    }

    public function getUseTimes() : int{
        return $this->use_times;
    }

    public function setUseTimes(int $useTimes){
        $this->use_times = $useTimes;
    }

    public function getApplyCityIds() : array{
        return $this->apply_city_ids;
    }

    public function setApplyCityIds(array $applyCityIds){
        $this->apply_city_ids = $applyCityIds;
    }

    public function getNeedPhone() : bool{
        return $this->need_phone;
    }

    public function setNeedPhone(bool $needPhone){
        $this->need_phone = $needPhone;
    }

    public function getTbCategory2Id() : string{
        return $this->tb_category_2_id;
    }

    public function setTbCategory2Id(string $tbCategory2Id){
        $this->tb_category_2_id = $tbCategory2Id;
    }

    public function getTbCategory2Name() : string{
        return $this->tb_category_2_name;
    }

    public function setTbCategory2Name(string $tbCategory2Name){
        $this->tb_category_2_name = $tbCategory2Name;
    }

    public function getTbCategory3Id() : string{
        return $this->tb_category_3_id;
    }

    public function setTbCategory3Id(string $tbCategory3Id){
        $this->tb_category_3_id = $tbCategory3Id;
    }

    public function getTbCategory3Name() : string{
        return $this->tb_category_3_name;
    }

    public function setTbCategory3Name(string $tbCategory3Name){
        $this->tb_category_3_name = $tbCategory3Name;
    }

    public function getBuyLimit() : int{
        return $this->buy_limit;
    }

    public function setBuyLimit(int $buyLimit){
        $this->buy_limit = $buyLimit;
    }

    public function getBrand() : AlibabaAlscUnionKbBbtItemQueryBrand{
        return $this->brand;
    }

    public function setBrand(AlibabaAlscUnionKbBbtItemQueryBrand $brand){
        $this->brand = $brand;
    }

    public function getTripartiteName() : string{
        return $this->tripartite_name;
    }

    public function setTripartiteName(string $tripartiteName){
        $this->tripartite_name = $tripartiteName;
    }

    public function getTripartiteAppkey() : string{
        return $this->tripartite_appkey;
    }

    public function setTripartiteAppkey(string $tripartiteAppkey){
        $this->tripartite_appkey = $tripartiteAppkey;
    }

    public function getTripartiteSiteName() : string{
        return $this->tripartite_site_name;
    }

    public function setTripartiteSiteName(string $tripartiteSiteName){
        $this->tripartite_site_name = $tripartiteSiteName;
    }


}

