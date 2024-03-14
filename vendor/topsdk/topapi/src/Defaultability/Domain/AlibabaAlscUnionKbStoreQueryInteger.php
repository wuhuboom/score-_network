<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbStoreQueryInteger {

    /**
        门店ID
     **/
    public $store_id;

    /**
        门店名称
     **/
    public $name;

    /**
        封面图
     **/
    public $cover;

    /**
        门店所属行业分类
     **/
    public $categories;

    /**
        位置信息
     **/
    public $location;

    /**
        距离（米）
     **/
    public $distance;


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

    public function getCategories() : array{
        return $this->categories;
    }

    public function setCategories(array $categories){
        $this->categories = $categories;
    }

    public function getLocation() : AlibabaAlscUnionKbStoreQueryLocation{
        return $this->location;
    }

    public function setLocation(AlibabaAlscUnionKbStoreQueryLocation $location){
        $this->location = $location;
    }

    public function getDistance() : int{
        return $this->distance;
    }

    public function setDistance(int $distance){
        $this->distance = $distance;
    }


}

