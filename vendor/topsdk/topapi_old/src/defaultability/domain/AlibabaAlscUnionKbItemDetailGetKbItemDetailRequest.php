<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemDetailGetKbItemDetailRequest {

    /**
        商品ID
     **/
    public $item_id;

    /**
        城市ID
     **/
    public $city_id;

    /**
        业务类型（cps/cpa）
     **/
    public $biz_type;


    public function getItemId() : string{
        return $this->item_id;
    }

    public function setItemId(string $itemId){
        $this->item_id = $itemId;
    }

    public function getCityId() : string{
        return $this->city_id;
    }

    public function setCityId(string $cityId){
        $this->city_id = $cityId;
    }

    public function getBizType() : string{
        return $this->biz_type;
    }

    public function setBizType(string $bizType){
        $this->biz_type = $bizType;
    }


}

