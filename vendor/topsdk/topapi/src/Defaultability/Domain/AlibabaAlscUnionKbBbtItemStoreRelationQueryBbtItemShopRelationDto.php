<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemStoreRelationQueryBbtItemShopRelationDto {

    /**
        门店ID（city_id不为空则返回当前城市门店，否则返回全部门店）
     **/
    public $store_id;


    public function getStoreId() : string{
        return $this->store_id;
    }

    public function setStoreId(string $storeId){
        $this->store_id = $storeId;
    }


}

