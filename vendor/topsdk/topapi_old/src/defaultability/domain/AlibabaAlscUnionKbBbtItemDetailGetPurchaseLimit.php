<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemDetailGetPurchaseLimit {

    /**
        商品限购-每人每天限购（-1表示不限购）
     **/
    public $item_daily_limit_per_user;

    /**
        商品限购-每人终身限购（-1表示不限购）
     **/
    public $item_limit_per_user;

    /**
        商品限购-每人每订单限购（-1表示不限购）
     **/
    public $item_limit_per_user_order;

    /**
        活动限购-每人每天限购（-1表示不限购）
     **/
    public $activity_daily_limit_per_user;

    /**
        活动限购-每人每活动限购（-1表示不限购）
     **/
    public $activity_limit_per_user;


    public function getItemDailyLimitPerUser() : int{
        return $this->item_daily_limit_per_user;
    }

    public function setItemDailyLimitPerUser(int $itemDailyLimitPerUser){
        $this->item_daily_limit_per_user = $itemDailyLimitPerUser;
    }

    public function getItemLimitPerUser() : int{
        return $this->item_limit_per_user;
    }

    public function setItemLimitPerUser(int $itemLimitPerUser){
        $this->item_limit_per_user = $itemLimitPerUser;
    }

    public function getItemLimitPerUserOrder() : int{
        return $this->item_limit_per_user_order;
    }

    public function setItemLimitPerUserOrder(int $itemLimitPerUserOrder){
        $this->item_limit_per_user_order = $itemLimitPerUserOrder;
    }

    public function getActivityDailyLimitPerUser() : int{
        return $this->activity_daily_limit_per_user;
    }

    public function setActivityDailyLimitPerUser(int $activityDailyLimitPerUser){
        $this->activity_daily_limit_per_user = $activityDailyLimitPerUser;
    }

    public function getActivityLimitPerUser() : int{
        return $this->activity_limit_per_user;
    }

    public function setActivityLimitPerUser(int $activityLimitPerUser){
        $this->activity_limit_per_user = $activityLimitPerUser;
    }


}

