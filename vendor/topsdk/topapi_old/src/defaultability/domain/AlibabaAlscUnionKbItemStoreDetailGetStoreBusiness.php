<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemStoreDetailGetStoreBusiness {

    /**
        营业状态（0-营业中，1-暂停营业，2-休息中，-1-关店）
     **/
    public $business_status;

    /**
        营业状态描述
     **/
    public $business_desc;

    /**
        营业时间
     **/
    public $business_time;

    /**
        店铺公告
     **/
    public $promotion;


    public function getBusinessStatus() : int{
        return $this->business_status;
    }

    public function setBusinessStatus(int $businessStatus){
        $this->business_status = $businessStatus;
    }

    public function getBusinessDesc() : string{
        return $this->business_desc;
    }

    public function setBusinessDesc(string $businessDesc){
        $this->business_desc = $businessDesc;
    }

    public function getBusinessTime() : AlibabaAlscUnionKbItemStoreDetailGetStoreBusinessTime{
        return $this->business_time;
    }

    public function setBusinessTime(AlibabaAlscUnionKbItemStoreDetailGetStoreBusinessTime $businessTime){
        $this->business_time = $businessTime;
    }

    public function getPromotion() : string{
        return $this->promotion;
    }

    public function setPromotion(string $promotion){
        $this->promotion = $promotion;
    }


}

