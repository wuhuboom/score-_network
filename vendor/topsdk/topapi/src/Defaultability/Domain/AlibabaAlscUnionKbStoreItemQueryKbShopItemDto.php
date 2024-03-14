<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbStoreItemQueryKbShopItemDto {

    /**
        商品ID
     **/
    public $item_id;

    /**
        商品标题
     **/
    public $title;

    /**
        商品图
     **/
    public $main_picture;

    /**
        活动价（分）
     **/
    public $activity_price_cent;

    /**
        券后价（分）
     **/
    public $price_with_coupon_cent;

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

    public function getLink() : AlibabaAlscUnionKbStoreItemQueryPromotionLink{
        return $this->link;
    }

    public function setLink(AlibabaAlscUnionKbStoreItemQueryPromotionLink $link){
        $this->link = $link;
    }


}

