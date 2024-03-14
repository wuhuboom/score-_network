<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionStorepromotionGetStorePromotionDto {

    /**
        门店名称
     **/
    public $title;

    /**
        门店logo
     **/
    public $shop_logo;

    /**
        模糊销量
     **/
    public $indistinct_monthly_sales;

    /**
        佣金比例
     **/
    public $commission_rate;

    /**
        店铺类型（"activityCps":活动cps,"ordinaryCps":基础cps）
     **/
    public $biz_type;

    /**
        活动数据
     **/
    public $activity;

    /**
        推广链接
     **/
    public $link;

    /**
        一级类目ID
     **/
    public $category_1_id;

    /**
        起送价（元）
     **/
    public $delivery_price;

    /**
        推荐理由
     **/
    public $recommend_reasons;

    /**
        服务评级
     **/
    public $service_rating;

    /**
        推荐商品
     **/
    public $items;

    /**
        一级类目名称
     **/
    public $category_1_name;

    /**
        叠加券活动数据
     **/
    public $overlay_coupon;


    public function getTitle() : string{
        return $this->title;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function getShopLogo() : string{
        return $this->shop_logo;
    }

    public function setShopLogo(string $shopLogo){
        $this->shop_logo = $shopLogo;
    }

    public function getIndistinctMonthlySales() : string{
        return $this->indistinct_monthly_sales;
    }

    public function setIndistinctMonthlySales(string $indistinctMonthlySales){
        $this->indistinct_monthly_sales = $indistinctMonthlySales;
    }

    public function getCommissionRate() : string{
        return $this->commission_rate;
    }

    public function setCommissionRate(string $commissionRate){
        $this->commission_rate = $commissionRate;
    }

    public function getBizType() : string{
        return $this->biz_type;
    }

    public function setBizType(string $bizType){
        $this->biz_type = $bizType;
    }

    public function getActivity() : AlibabaAlscUnionElemePromotionStorepromotionGetPromotionActivity{
        return $this->activity;
    }

    public function setActivity(AlibabaAlscUnionElemePromotionStorepromotionGetPromotionActivity $activity){
        $this->activity = $activity;
    }

    public function getLink() : AlibabaAlscUnionElemePromotionStorepromotionGetPromotionLink{
        return $this->link;
    }

    public function setLink(AlibabaAlscUnionElemePromotionStorepromotionGetPromotionLink $link){
        $this->link = $link;
    }

    public function getCategory1Id() : string{
        return $this->category_1_id;
    }

    public function setCategory1Id(string $category1Id){
        $this->category_1_id = $category1Id;
    }

    public function getDeliveryPrice() : string{
        return $this->delivery_price;
    }

    public function setDeliveryPrice(string $deliveryPrice){
        $this->delivery_price = $deliveryPrice;
    }

    public function getRecommendReasons() : array{
        return $this->recommend_reasons;
    }

    public function setRecommendReasons(array $recommendReasons){
        $this->recommend_reasons = $recommendReasons;
    }

    public function getServiceRating() : string{
        return $this->service_rating;
    }

    public function setServiceRating(string $serviceRating){
        $this->service_rating = $serviceRating;
    }

    public function getItems() : array{
        return $this->items;
    }

    public function setItems(array $items){
        $this->items = $items;
    }

    public function getCategory1Name() : string{
        return $this->category_1_name;
    }

    public function setCategory1Name(string $category1Name){
        $this->category_1_name = $category1Name;
    }

    public function getOverlayCoupon() : AlibabaAlscUnionElemePromotionStorepromotionGetOverlayCouponDTO{
        return $this->overlay_coupon;
    }

    public function setOverlayCoupon(AlibabaAlscUnionElemePromotionStorepromotionGetOverlayCouponDTO $overlayCoupon){
        $this->overlay_coupon = $overlayCoupon;
    }


}

