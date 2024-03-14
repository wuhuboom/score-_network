<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemStoreDetailGetKbItemShopDetailRequest {

    /**
        门店ID
     **/
    public $store_id;


    public function getStoreId() : string{
        return $this->store_id;
    }

    public function setStoreId(string $storeId){
        $this->store_id = $storeId;
    }


}

