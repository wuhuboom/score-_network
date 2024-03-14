<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemStoreDetailGetStoreStatistics {

    /**
        服务评级
     **/
    public $service_rating;

    /**
        人均价格
     **/
    public $avg_price;


    public function getServiceRating() : string{
        return $this->service_rating;
    }

    public function setServiceRating(string $serviceRating){
        $this->service_rating = $serviceRating;
    }

    public function getAvgPrice() : string{
        return $this->avg_price;
    }

    public function setAvgPrice(string $avgPrice){
        $this->avg_price = $avgPrice;
    }


}

