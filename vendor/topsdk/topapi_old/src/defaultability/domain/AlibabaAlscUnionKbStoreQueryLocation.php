<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbStoreQueryLocation {

    /**
        经度
     **/
    public $longitude;

    /**
        纬度
     **/
    public $latitude;

    /**
        地址
     **/
    public $address;


    public function getLongitude() : string{
        return $this->longitude;
    }

    public function setLongitude(string $longitude){
        $this->longitude = $longitude;
    }

    public function getLatitude() : string{
        return $this->latitude;
    }

    public function setLatitude(string $latitude){
        $this->latitude = $latitude;
    }

    public function getAddress() : string{
        return $this->address;
    }

    public function setAddress(string $address){
        $this->address = $address;
    }


}

