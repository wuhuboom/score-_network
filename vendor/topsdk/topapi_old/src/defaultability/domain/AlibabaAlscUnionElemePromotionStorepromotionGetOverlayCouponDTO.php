<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionStorepromotionGetOverlayCouponDTO {

    /**
        券id
     **/
    public $template_id;

    /**
        券金额，单位元
     **/
    public $amount;

    /**
        活动有效期天（发出去的有效期）
     **/
    public $valid_period;

    /**
        活动开始时间
     **/
    public $start_time;

    /**
        活动结束时间
     **/
    public $end_time;


    public function getTemplateId() : int{
        return $this->template_id;
    }

    public function setTemplateId(int $templateId){
        $this->template_id = $templateId;
    }

    public function getAmount() : string{
        return $this->amount;
    }

    public function setAmount(string $amount){
        $this->amount = $amount;
    }

    public function getValidPeriod() : int{
        return $this->valid_period;
    }

    public function setValidPeriod(int $validPeriod){
        $this->valid_period = $validPeriod;
    }

    public function getStartTime() : string{
        return $this->start_time;
    }

    public function setStartTime(string $startTime){
        $this->start_time = $startTime;
    }

    public function getEndTime() : string{
        return $this->end_time;
    }

    public function setEndTime(string $endTime){
        $this->end_time = $endTime;
    }


}

