<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemDetailGetBbtItemDetailRequest {

    /**
        品ID
     **/
    public $item_id;

    /**
        城市ID
     **/
    public $city_id;


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


}

