<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemQueryKbItemPromotionDTO {

    /**
        商品ID
     **/
    public $item_id;

    /**
        标题
     **/
    public $title;

    /**
        商品图
     **/
    public $main_picture;

    /**
        原价（分）
     **/
    public $original_price_cent;

    /**
        活动价（分）
     **/
    public $activity_price_cent;

    /**
        券后价（分）
     **/
    public $price_with_coupon_cent;

    /**
        券价格（分）
     **/
    public $coupon_price_cent;

    /**
        九十天销量
     **/
    public $ninety_sales;

    /**
        总销量
     **/
    public $total_sales;

    /**
        推广链接
     **/
    public $link;


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

    public function getPriceWithCouponCent() : int{
        return $this->price_with_coupon_cent;
    }

    public function setPriceWithCouponCent(int $priceWithCouponCent){
        $this->price_with_coupon_cent = $priceWithCouponCent;
    }

    public function getCouponPriceCent() : int{
        return $this->coupon_price_cent;
    }

    public function setCouponPriceCent(int $couponPriceCent){
        $this->coupon_price_cent = $couponPriceCent;
    }

    public function getNinetySales() : int{
        return $this->ninety_sales;
    }

    public function setNinetySales(int $ninetySales){
        $this->ninety_sales = $ninetySales;
    }

    public function getTotalSales() : int{
        return $this->total_sales;
    }

    public function setTotalSales(int $totalSales){
        $this->total_sales = $totalSales;
    }

    public function getLink() : AlibabaAlscUnionKbItemQueryPromotionLink{
        return $this->link;
    }

    public function setLink(AlibabaAlscUnionKbItemQueryPromotionLink $link){
        $this->link = $link;
    }


}

