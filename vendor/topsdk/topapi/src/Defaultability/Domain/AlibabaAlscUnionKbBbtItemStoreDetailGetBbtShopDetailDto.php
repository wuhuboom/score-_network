<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemStoreDetailGetBbtShopDetailDto {

    /**
        门店基本信息
     **/
    public $basic_info;

    /**
        门店统计信息
     **/
    public $statistics;


    public function getBasicInfo() : AlibabaAlscUnionKbBbtItemStoreDetailGetStoreBasicInfo{
        return $this->basic_info;
    }

    public function setBasicInfo(AlibabaAlscUnionKbBbtItemStoreDetailGetStoreBasicInfo $basicInfo){
        $this->basic_info = $basicInfo;
    }

    public function getStatistics() : AlibabaAlscUnionKbBbtItemStoreDetailGetStoreStatistics{
        return $this->statistics;
    }

    public function setStatistics(AlibabaAlscUnionKbBbtItemStoreDetailGetStoreStatistics $statistics){
        $this->statistics = $statistics;
    }


}

