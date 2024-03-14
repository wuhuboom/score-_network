<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionStorepromotionGetPromotionActivity {

    /**
        活动Id
     **/
    public $activity_id;

    /**
        营销计划服务费（分）
     **/
    public $service_fee_cent;

    /**
        奖励金红包面额（分）
     **/
    public $bonus_cent;

    /**
        活动的日库存
     **/
    public $daily_quantity;

    /**
        活动日剩余库存
     **/
    public $daily_sellable_quantity;

    /**
        起始时间（秒）
     **/
    public $start_time;

    /**
        结束时间（秒）
     **/
    public $end_time;

    /**
        奖励金门槛 (分)
     **/
    public $bounty_min_limit_cent;


    public function getActivityId() : string{
        return $this->activity_id;
    }

    public function setActivityId(string $activityId){
        $this->activity_id = $activityId;
    }

    public function getServiceFeeCent() : int{
        return $this->service_fee_cent;
    }

    public function setServiceFeeCent(int $serviceFeeCent){
        $this->service_fee_cent = $serviceFeeCent;
    }

    public function getBonusCent() : int{
        return $this->bonus_cent;
    }

    public function setBonusCent(int $bonusCent){
        $this->bonus_cent = $bonusCent;
    }

    public function getDailyQuantity() : int{
        return $this->daily_quantity;
    }

    public function setDailyQuantity(int $dailyQuantity){
        $this->daily_quantity = $dailyQuantity;
    }

    public function getDailySellableQuantity() : int{
        return $this->daily_sellable_quantity;
    }

    public function setDailySellableQuantity(int $dailySellableQuantity){
        $this->daily_sellable_quantity = $dailySellableQuantity;
    }

    public function getStartTime() : int{
        return $this->start_time;
    }

    public function setStartTime(int $startTime){
        $this->start_time = $startTime;
    }

    public function getEndTime() : int{
        return $this->end_time;
    }

    public function setEndTime(int $endTime){
        $this->end_time = $endTime;
    }

    public function getBountyMinLimitCent() : int{
        return $this->bounty_min_limit_cent;
    }

    public function setBountyMinLimitCent(int $bountyMinLimitCent){
        $this->bounty_min_limit_cent = $bountyMinLimitCent;
    }


}

