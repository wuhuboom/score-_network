<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemStoreDetailGetStoreBasicInfo {

    /**
        门店ID
     **/
    public $store_id;

    /**
        店名
     **/
    public $name;

    /**
        cover
     **/
    public $cover;

    /**
        门店电话
     **/
    public $mobiles;

    /**
        营业信息
     **/
    public $business;

    /**
        位置信息
     **/
    public $location;

    /**
        品牌
     **/
    public $brand;

    /**
        门店所属行业分类
     **/
    public $categories;

    /**
        门店资质
     **/
    public $qualifications;


    public function getStoreId() : string{
        return $this->store_id;
    }

    public function setStoreId(string $storeId){
        $this->store_id = $storeId;
    }

    public function getName() : string{
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getCover() : string{
        return $this->cover;
    }

    public function setCover(string $cover){
        $this->cover = $cover;
    }

    public function getMobiles() : array{
        return $this->mobiles;
    }

    public function setMobiles(array $mobiles){
        $this->mobiles = $mobiles;
    }

    public function getBusiness() : AlibabaAlscUnionKbItemStoreDetailGetStoreBusiness{
        return $this->business;
    }

    public function setBusiness(AlibabaAlscUnionKbItemStoreDetailGetStoreBusiness $business){
        $this->business = $business;
    }

    public function getLocation() : AlibabaAlscUnionKbItemStoreDetailGetLocation{
        return $this->location;
    }

    public function setLocation(AlibabaAlscUnionKbItemStoreDetailGetLocation $location){
        $this->location = $location;
    }

    public function getBrand() : AlibabaAlscUnionKbItemStoreDetailGetBrand{
        return $this->brand;
    }

    public function setBrand(AlibabaAlscUnionKbItemStoreDetailGetBrand $brand){
        $this->brand = $brand;
    }

    public function getCategories() : array{
        return $this->categories;
    }

    public function setCategories(array $categories){
        $this->categories = $categories;
    }

    public function getQualifications() : array{
        return $this->qualifications;
    }

    public function setQualifications(array $qualifications){
        $this->qualifications = $qualifications;
    }


}

