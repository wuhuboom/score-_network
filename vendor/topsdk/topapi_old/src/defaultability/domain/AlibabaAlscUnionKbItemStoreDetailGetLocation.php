<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemStoreDetailGetLocation {

    /**
        地址
     **/
    public $address;

    /**
        地址备注(如交通信息等)
     **/
    public $address_memo;

    /**
        所属区域
     **/
    public $region;

    /**
        经度
     **/
    public $longitude;

    /**
        纬度
     **/
    public $latitude;


    public function getAddress() : string{
        return $this->address;
    }

    public function setAddress(string $address){
        $this->address = $address;
    }

    public function getAddressMemo() : string{
        return $this->address_memo;
    }

    public function setAddressMemo(string $addressMemo){
        $this->address_memo = $addressMemo;
    }

    public function getRegion() : AlibabaAlscUnionKbItemStoreDetailGetRegion{
        return $this->region;
    }

    public function setRegion(AlibabaAlscUnionKbItemStoreDetailGetRegion $region){
        $this->region = $region;
    }

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


}

