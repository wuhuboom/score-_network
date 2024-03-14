<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionKbStoreQueryRequest {

    /**
        页码（默认1）
     **/
    private $pageNumber;

    /**
        每页数目（默认10）
     **/
    private $pageSize;

    /**
        会话ID（分页场景首次请求结果返回，后续请求必须携带，服务根据session_id相同请求次数自动翻页返回）
     **/
    private $sessionId;

    /**
        场景类型（"kb_natural";）
     **/
    private $bizType;

    /**
        排序类型，默认normal（"normal"-门店创建时间倒序;"distance_asc"-距离最近）
     **/
    private $sortType;

    /**
        城市ID
     **/
    private $cityId;

    /**
        口碑二级类目（逗号分隔）
     **/
    private $kbCategory2Ids;

    /**
        口碑三级类目（逗号分隔）
     **/
    private $kbCategory3Ids;

    /**
        经度（经纬度、范围配合使用）
     **/
    private $longitude;

    /**
        纬度（经纬度、范围配合使用）
     **/
    private $latitude;

    /**
        范围（单位：米，经纬度、范围配合使用）
     **/
    private $range;

    /**
        口碑一级类目（逗号分隔）
     **/
    private $kbCategory1Ids;


    public function getPageNumber() : int{
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber){
        $this->pageNumber = $pageNumber;
    }

    public function getPageSize() : int{
        return $this->pageSize;
    }

    public function setPageSize(int $pageSize){
        $this->pageSize = $pageSize;
    }

    public function getSessionId() : string{
        return $this->sessionId;
    }

    public function setSessionId(string $sessionId){
        $this->sessionId = $sessionId;
    }

    public function getBizType() : string{
        return $this->bizType;
    }

    public function setBizType(string $bizType){
        $this->bizType = $bizType;
    }

    public function getSortType() : string{
        return $this->sortType;
    }

    public function setSortType(string $sortType){
        $this->sortType = $sortType;
    }

    public function getCityId() : string{
        return $this->cityId;
    }

    public function setCityId(string $cityId){
        $this->cityId = $cityId;
    }

    public function getKbCategory2Ids() : string{
        return $this->kbCategory2Ids;
    }

    public function setKbCategory2Ids(string $kbCategory2Ids){
        $this->kbCategory2Ids = $kbCategory2Ids;
    }

    public function getKbCategory3Ids() : string{
        return $this->kbCategory3Ids;
    }

    public function setKbCategory3Ids(string $kbCategory3Ids){
        $this->kbCategory3Ids = $kbCategory3Ids;
    }

    public function getLongitude() : string{
        return $this->longitude;
    }

    public function setLongitude(string $longitude){
        $this->longitude = $longitude;
    }

    public function getLatitude() : string{
        return $this->latitude;
    }

    public function setLatitude(string $latitude){
        $this->latitude = $latitude;
    }

    public function getRange() : int{
        return $this->range;
    }

    public function setRange(int $range){
        $this->range = $range;
    }

    public function getKbCategory1Ids() : string{
        return $this->kbCategory1Ids;
    }

    public function setKbCategory1Ids(string $kbCategory1Ids){
        $this->kbCategory1Ids = $kbCategory1Ids;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.store.query";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->pageNumber)) {
            $requestParam["page_number"] = TopUtil::convertBasic($this->pageNumber);
        }

        if (!TopUtil::checkEmpty($this->pageSize)) {
            $requestParam["page_size"] = TopUtil::convertBasic($this->pageSize);
        }

        if (!TopUtil::checkEmpty($this->sessionId)) {
            $requestParam["session_id"] = TopUtil::convertBasic($this->sessionId);
        }

        if (!TopUtil::checkEmpty($this->bizType)) {
            $requestParam["biz_type"] = TopUtil::convertBasic($this->bizType);
        }

        if (!TopUtil::checkEmpty($this->sortType)) {
            $requestParam["sort_type"] = TopUtil::convertBasic($this->sortType);
        }

        if (!TopUtil::checkEmpty($this->cityId)) {
            $requestParam["city_id"] = TopUtil::convertBasic($this->cityId);
        }

        if (!TopUtil::checkEmpty($this->kbCategory2Ids)) {
            $requestParam["kb_category_2_ids"] = TopUtil::convertBasic($this->kbCategory2Ids);
        }

        if (!TopUtil::checkEmpty($this->kbCategory3Ids)) {
            $requestParam["kb_category_3_ids"] = TopUtil::convertBasic($this->kbCategory3Ids);
        }

        if (!TopUtil::checkEmpty($this->longitude)) {
            $requestParam["longitude"] = TopUtil::convertBasic($this->longitude);
        }

        if (!TopUtil::checkEmpty($this->latitude)) {
            $requestParam["latitude"] = TopUtil::convertBasic($this->latitude);
        }

        if (!TopUtil::checkEmpty($this->range)) {
            $requestParam["range"] = TopUtil::convertBasic($this->range);
        }

        if (!TopUtil::checkEmpty($this->kbCategory1Ids)) {
            $requestParam["kb_category_1_ids"] = TopUtil::convertBasic($this->kbCategory1Ids);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

