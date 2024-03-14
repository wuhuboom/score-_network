<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemStoreDetailGetKbShopDetailDto {

    /**
        门店基本信息
     **/
    public $basic_info;

    /**
        门店统计信息
     **/
    public $statistics;


    public function getBasicInfo() : AlibabaAlscUnionKbItemStoreDetailGetStoreBasicInfo{
        return $this->basic_info;
    }

    public function setBasicInfo(AlibabaAlscUnionKbItemStoreDetailGetStoreBasicInfo $basicInfo){
        $this->basic_info = $basicInfo;
    }

    public function getStatistics() : AlibabaAlscUnionKbItemStoreDetailGetStoreStatistics{
        return $this->statistics;
    }

    public function setStatistics(AlibabaAlscUnionKbItemStoreDetailGetStoreStatistics $statistics){
        $this->statistics = $statistics;
    }


}

