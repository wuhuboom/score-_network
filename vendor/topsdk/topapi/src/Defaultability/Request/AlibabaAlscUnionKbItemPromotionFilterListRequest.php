<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionKbItemPromotionFilterListRequest {

    /**
        获取筛选项集合的类型。city-城市列表；category-类目列表
     **/
    private $filterType;

    /**
        1-cpa,2-cps.默认不填为cpa
     **/
    private $bizUnit;


    public function getFilterType() : string{
        return $this->filterType;
    }

    public function setFilterType(string $filterType){
        $this->filterType = $filterType;
    }

    public function getBizUnit() : int{
        return $this->bizUnit;
    }

    public function setBizUnit(int $bizUnit){
        $this->bizUnit = $bizUnit;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.item.promotion.filter.list";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->filterType)) {
            $requestParam["filter_type"] = TopUtil::convertBasic($this->filterType);
        }

        if (!TopUtil::checkEmpty($this->bizUnit)) {
            $requestParam["biz_unit"] = TopUtil::convertBasic($this->bizUnit);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

