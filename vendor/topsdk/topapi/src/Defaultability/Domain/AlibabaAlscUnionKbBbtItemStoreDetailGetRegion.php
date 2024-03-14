<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemStoreDetailGetRegion {

    /**
        省份编码
     **/
    public $province_id;

    /**
        省份名称
     **/
    public $province_name;

    /**
        城市编码
     **/
    public $city_id;

    /**
        城市名称
     **/
    public $city_name;

    /**
        行政区编码
     **/
    public $district_id;

    /**
        行政区名称
     **/
    public $district_name;


    public function getProvinceId() : string{
        return $this->province_id;
    }

    public function setProvinceId(string $provinceId){
        $this->province_id = $provinceId;
    }

    public function getProvinceName() : string{
        return $this->province_name;
    }

    public function setProvinceName(string $provinceName){
        $this->province_name = $provinceName;
    }

    public function getCityId() : string{
        return $this->city_id;
    }

    public function setCityId(string $cityId){
        $this->city_id = $cityId;
    }

    public function getCityName() : string{
        return $this->city_name;
    }

    public function setCityName(string $cityName){
        $this->city_name = $cityName;
    }

    public function getDistrictId() : string{
        return $this->district_id;
    }

    public function setDistrictId(string $districtId){
        $this->district_id = $districtId;
    }

    public function getDistrictName() : string{
        return $this->district_name;
    }

    public function setDistrictName(string $districtName){
        $this->district_name = $districtName;
    }


}

