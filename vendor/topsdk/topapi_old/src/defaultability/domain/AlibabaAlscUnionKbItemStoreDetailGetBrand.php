<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemStoreDetailGetBrand {

    /**
        品牌Id
     **/
    public $brand_id;

    /**
        品牌名
     **/
    public $brand_name;


    public function getBrandId() : string{
        return $this->brand_id;
    }

    public function setBrandId(string $brandId){
        $this->brand_id = $brandId;
    }

    public function getBrandName() : string{
        return $this->brand_name;
    }

    public function setBrandName(string $brandName){
        $this->brand_name = $brandName;
    }


}

