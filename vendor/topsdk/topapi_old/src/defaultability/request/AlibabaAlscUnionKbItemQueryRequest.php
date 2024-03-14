<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionKbItemQueryRequest {

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
        推广位
     **/
    private $pid;

    /**
        淘宝二级类目（逗号分隔）
     **/
    private $tbCategory2Ids;

    /**
        淘宝三级类目（逗号分隔）
     **/
    private $tbCategory3Ids;

    /**
        城市ID
     **/
    private $cityId;

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

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getTbCategory2Ids() : string{
        return $this->tbCategory2Ids;
    }

    public function setTbCategory2Ids(string $tbCategory2Ids){
        $this->tbCategory2Ids = $tbCategory2Ids;
    }

    public function getTbCategory3Ids() : string{
        return $this->tbCategory3Ids;
    }

    public function setTbCategory3Ids(string $tbCategory3Ids){
        $this->tbCategory3Ids = $tbCategory3Ids;
    }

    public function getCityId() : string{
        return $this->cityId;
    }

    public function setCityId(string $cityId){
        $this->cityId = $cityId;
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


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.item.query";
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

        if (!TopUtil::checkEmpty($this->pid)) {
            $requestParam["pid"] = TopUtil::convertBasic($this->pid);
        }

        if (!TopUtil::checkEmpty($this->tbCategory2Ids)) {
            $requestParam["tb_category_2_ids"] = TopUtil::convertBasic($this->tbCategory2Ids);
        }

        if (!TopUtil::checkEmpty($this->tbCategory3Ids)) {
            $requestParam["tb_category_3_ids"] = TopUtil::convertBasic($this->tbCategory3Ids);
        }

        if (!TopUtil::checkEmpty($this->cityId)) {
            $requestParam["city_id"] = TopUtil::convertBasic($this->cityId);
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

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

