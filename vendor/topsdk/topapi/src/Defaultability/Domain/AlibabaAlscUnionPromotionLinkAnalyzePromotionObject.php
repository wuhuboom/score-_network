<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionPromotionLinkAnalyzePromotionObject {

    /**
        推广对象类型（1-商品；2-店铺；3-活动；4-卡券；5-SKU；6-营销活动）
     **/
    public $object_type;

    /**
        推广对象ID
     **/
    public $object_id;


    public function getObjectType() : int{
        return $this->object_type;
    }

    public function setObjectType(int $objectType){
        $this->object_type = $objectType;
    }

    public function getObjectId() : string{
        return $this->object_id;
    }

    public function setObjectId(string $objectId){
        $this->object_id = $objectId;
    }


}

