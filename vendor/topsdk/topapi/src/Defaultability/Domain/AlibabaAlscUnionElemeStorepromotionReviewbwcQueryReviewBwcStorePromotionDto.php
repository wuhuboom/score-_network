<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemeStorepromotionReviewbwcQueryReviewBwcStorePromotionDto {

    /**
        门店ID（加密）
     **/
    public $shop_id;

    /**
        门店名称
     **/
    public $shop_name;

    /**
        门店主图
     **/
    public $shop_picture;

    /**
        月销量（模糊）
     **/
    public $indistinct_monthly_sales;

    /**
        一级类目ID
     **/
    public $category_1_id;

    /**
        一级类目名称
     **/
    public $category_1_name;

    /**
        配送距离（米）
     **/
    public $delivery_distance;

    /**
        配送时间（分）
     **/
    public $delivery_time;

    /**
        起送价（分）
     **/
    public $delivery_price_cent;

    /**
        服务评级
     **/
    public $service_rating;

    /**
        推广链接
     **/
    public $link;

    /**
        活动
     **/
    public $activities;


    public function getShopId() : string{
        return $this->shop_id;
    }

    public function setShopId(string $shopId){
        $this->shop_id = $shopId;
    }

    public function getShopName() : string{
        return $this->shop_name;
    }

    public function setShopName(string $shopName){
        $this->shop_name = $shopName;
    }

    public function getShopPicture() : string{
        return $this->shop_picture;
    }

    public function setShopPicture(string $shopPicture){
        $this->shop_picture = $shopPicture;
    }

    public function getIndistinctMonthlySales() : string{
        return $this->indistinct_monthly_sales;
    }

    public function setIndistinctMonthlySales(string $indistinctMonthlySales){
        $this->indistinct_monthly_sales = $indistinctMonthlySales;
    }

    public function getCategory1Id() : string{
        return $this->category_1_id;
    }

    public function setCategory1Id(string $category1Id){
        $this->category_1_id = $category1Id;
    }

    public function getCategory1Name() : string{
        return $this->category_1_name;
    }

    public function setCategory1Name(string $category1Name){
        $this->category_1_name = $category1Name;
    }

    public function getDeliveryDistance() : int{
        return $this->delivery_distance;
    }

    public function setDeliveryDistance(int $deliveryDistance){
        $this->delivery_distance = $deliveryDistance;
    }

    public function getDeliveryTime() : int{
        return $this->delivery_time;
    }

    public function setDeliveryTime(int $deliveryTime){
        $this->delivery_time = $deliveryTime;
    }

    public function getDeliveryPriceCent() : int{
        return $this->delivery_price_cent;
    }

    public function setDeliveryPriceCent(int $deliveryPriceCent){
        $this->delivery_price_cent = $deliveryPriceCent;
    }

    public function getServiceRating() : string{
        return $this->service_rating;
    }

    public function setServiceRating(string $serviceRating){
        $this->service_rating = $serviceRating;
    }

    public function getLink() : AlibabaAlscUnionElemeStorepromotionReviewbwcQueryPromotionItem{
        return $this->link;
    }

    public function setLink(AlibabaAlscUnionElemeStorepromotionReviewbwcQueryPromotionItem $link){
        $this->link = $link;
    }

    public function getActivities() : array{
        return $this->activities;
    }

    public function setActivities(array $activities){
        $this->activities = $activities;
    }


}

