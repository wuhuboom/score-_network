<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionKbBbtItemPromotionFilterListRequest {

    /**
        获取筛选项集合的类型。category类目列表，city城市列表
     **/
    private $filterType;

    /**
        产品线，固定bbt
     **/
    private $bizType;

    /**
        固定2cps
     **/
    private $bizUnit;


    public function getFilterType() : string{
        return $this->filterType;
    }

    public function setFilterType(string $filterType){
        $this->filterType = $filterType;
    }

    public function getBizType() : string{
        return $this->bizType;
    }

    public function setBizType(string $bizType){
        $this->bizType = $bizType;
    }

    public function getBizUnit() : int{
        return $this->bizUnit;
    }

    public function setBizUnit(int $bizUnit){
        $this->bizUnit = $bizUnit;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.bbt.item.promotion.filter.list";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->filterType)) {
            $requestParam["filter_type"] = TopUtil::convertBasic($this->filterType);
        }

        if (!TopUtil::checkEmpty($this->bizType)) {
            $requestParam["biz_type"] = TopUtil::convertBasic($this->bizType);
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

