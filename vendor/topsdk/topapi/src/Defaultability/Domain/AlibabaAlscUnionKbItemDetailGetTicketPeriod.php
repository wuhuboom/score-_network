<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetTicketPeriod {

    /**
        有效周期类型
     **/
    public $period_type;

    /**
        相对有效期，单位：天
     **/
    public $period;

    /**
        是否自然日
     **/
    public $nature_day;

    /**
        起始时间（秒）
     **/
    public $start_time;

    /**
        终止时间（秒）
     **/
    public $end_time;


    public function getPeriodType() : string{
        return $this->period_type;
    }

    public function setPeriodType(string $periodType){
        $this->period_type = $periodType;
    }

    public function getPeriod() : int{
        return $this->period;
    }

    public function setPeriod(int $period){
        $this->period = $period;
    }

    public function getNatureDay() : bool{
        return $this->nature_day;
    }

    public function setNatureDay(bool $natureDay){
        $this->nature_day = $natureDay;
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


}

