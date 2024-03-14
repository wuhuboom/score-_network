<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemeStorepromotionReviewbwcDetailGetReviewBwcActivity {

    /**
        活动ID
     **/
    public $activity_id;

    /**
        开始时间（秒）
     **/
    public $start_time;

    /**
        结束时间（秒）
     **/
    public $end_time;

    /**
        活动的日库存
     **/
    public $daily_stock;

    /**
        活动日剩余库存
     **/
    public $daily_remain_stock;

    /**
        返现金额（分）
     **/
    public $reward_cent;

    /**
        返现门槛（分）
     **/
    public $reward_threshold_cent;

    /**
        佣金比例
     **/
    public $commission_rate;

    /**
        预估佣金（分）
     **/
    public $commission;


    public function getActivityId() : string{
        return $this->activity_id;
    }

    public function setActivityId(string $activityId){
        $this->activity_id = $activityId;
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

    public function getDailyStock() : int{
        return $this->daily_stock;
    }

    public function setDailyStock(int $dailyStock){
        $this->daily_stock = $dailyStock;
    }

    public function getDailyRemainStock() : int{
        return $this->daily_remain_stock;
    }

    public function setDailyRemainStock(int $dailyRemainStock){
        $this->daily_remain_stock = $dailyRemainStock;
    }

    public function getRewardCent() : string{
        return $this->reward_cent;
    }

    public function setRewardCent(string $rewardCent){
        $this->reward_cent = $rewardCent;
    }

    public function getRewardThresholdCent() : string{
        return $this->reward_threshold_cent;
    }

    public function setRewardThresholdCent(string $rewardThresholdCent){
        $this->reward_threshold_cent = $rewardThresholdCent;
    }

    public function getCommissionRate() : string{
        return $this->commission_rate;
    }

    public function setCommissionRate(string $commissionRate){
        $this->commission_rate = $commissionRate;
    }

    public function getCommission() : string{
        return $this->commission;
    }

    public function setCommission(string $commission){
        $this->commission = $commission;
    }


}

