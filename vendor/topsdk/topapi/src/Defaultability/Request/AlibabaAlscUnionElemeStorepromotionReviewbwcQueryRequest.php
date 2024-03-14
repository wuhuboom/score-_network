<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionElemeStorepromotionReviewbwcQueryRequest {

    /**
        每页数量（1~20，默认20）
     **/
    private $pageSize;

    /**
        会话ID（分页场景首次请求结果返回，后续请求必须携带，服务根据session_id相同请求次数自动翻页返回）
     **/
    private $sessionId;

    /**
        渠道PID
     **/
    private $pid;

    /**
        经度
     **/
    private $longitude;

    /**
        纬度
     **/
    private $latitude;

    /**
        排序类型，默认normal，排序规则包括:{"normal":"佣金倒序","distance_asc":"距离由近到远","commission_desc":"佣金倒序","month_sales_desc":"月销量从高到低","commission_rate_desc":"佣金比例倒序", "activity_reward_desc":"返现金额倒序"}
     **/
    private $sortType;

    /**
        店铺佣金比例下限，代表筛选店铺全店佣金大于等于0.01的店铺
     **/
    private $minCommissionRate;

    /**
        三方扩展id
     **/
    private $sid;

    /**
        以一级类目进行类目限定，以,或者|进行类目分隔
     **/
    private $filterFirstCategories;

    /**
        1.5级类目查询，以"|"分隔
     **/
    private $filterOnePointFiveCategories;

    /**
        城市ID（经纬度范围覆盖多个城市时，精准召回）
     **/
    private $filterCityId;

    /**
        搜索内容（店铺名）
     **/
    private $searchContent;


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

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
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

    public function getSortType() : string{
        return $this->sortType;
    }

    public function setSortType(string $sortType){
        $this->sortType = $sortType;
    }

    public function getMinCommissionRate() : string{
        return $this->minCommissionRate;
    }

    public function setMinCommissionRate(string $minCommissionRate){
        $this->minCommissionRate = $minCommissionRate;
    }

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }

    public function getFilterFirstCategories() : string{
        return $this->filterFirstCategories;
    }

    public function setFilterFirstCategories(string $filterFirstCategories){
        $this->filterFirstCategories = $filterFirstCategories;
    }

    public function getFilterOnePointFiveCategories() : string{
        return $this->filterOnePointFiveCategories;
    }

    public function setFilterOnePointFiveCategories(string $filterOnePointFiveCategories){
        $this->filterOnePointFiveCategories = $filterOnePointFiveCategories;
    }

    public function getFilterCityId() : string{
        return $this->filterCityId;
    }

    public function setFilterCityId(string $filterCityId){
        $this->filterCityId = $filterCityId;
    }

    public function getSearchContent() : string{
        return $this->searchContent;
    }

    public function setSearchContent(string $searchContent){
        $this->searchContent = $searchContent;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.eleme.storepromotion.reviewbwc.query";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->pageSize)) {
            $requestParam["page_size"] = TopUtil::convertBasic($this->pageSize);
        }

        if (!TopUtil::checkEmpty($this->sessionId)) {
            $requestParam["session_id"] = TopUtil::convertBasic($this->sessionId);
        }

        if (!TopUtil::checkEmpty($this->pid)) {
            $requestParam["pid"] = TopUtil::convertBasic($this->pid);
        }

        if (!TopUtil::checkEmpty($this->longitude)) {
            $requestParam["longitude"] = TopUtil::convertBasic($this->longitude);
        }

        if (!TopUtil::checkEmpty($this->latitude)) {
            $requestParam["latitude"] = TopUtil::convertBasic($this->latitude);
        }

        if (!TopUtil::checkEmpty($this->sortType)) {
            $requestParam["sort_type"] = TopUtil::convertBasic($this->sortType);
        }

        if (!TopUtil::checkEmpty($this->minCommissionRate)) {
            $requestParam["min_commission_rate"] = TopUtil::convertBasic($this->minCommissionRate);
        }

        if (!TopUtil::checkEmpty($this->sid)) {
            $requestParam["sid"] = TopUtil::convertBasic($this->sid);
        }

        if (!TopUtil::checkEmpty($this->filterFirstCategories)) {
            $requestParam["filter_first_categories"] = TopUtil::convertBasic($this->filterFirstCategories);
        }

        if (!TopUtil::checkEmpty($this->filterOnePointFiveCategories)) {
            $requestParam["filter_one_point_five_categories"] = TopUtil::convertBasic($this->filterOnePointFiveCategories);
        }

        if (!TopUtil::checkEmpty($this->filterCityId)) {
            $requestParam["filter_city_id"] = TopUtil::convertBasic($this->filterCityId);
        }

        if (!TopUtil::checkEmpty($this->searchContent)) {
            $requestParam["search_content"] = TopUtil::convertBasic($this->searchContent);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

