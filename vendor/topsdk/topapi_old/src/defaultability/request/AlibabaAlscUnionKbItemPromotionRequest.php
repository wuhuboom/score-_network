<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionKbItemPromotionRequest {

    /**
        页码，默认第一页，取值范围1~50
     **/
    private $pageNumber;

    /**
        排序类型 normal-默认排序 reservePrice-折后价从高到低  commission-佣金从高到低 totalSales-月销量从高到低
     **/
    private $sortType;

    /**
        每页返回数据大小，默认20，最大返回20
     **/
    private $pageSize;

    /**
        推广参数
     **/
    private $pid;

    /**
        用来分页，翻页时将上一次结果的sessionId带下来
     **/
    private $sessionId;

    /**
        推广物料结算模型 1-cpa 2-cps，3spu
     **/
    private $settleType;

    /**
        类目筛选，多个类目逗号分隔（通过alibaba.alsc.union.kb.item.promotion.filter.list获取）
     **/
    private $filterCategoryIds;

    /**
        城市id(国标)筛选，多个城市逗号分隔（通过alibaba.alsc.union.kb.item.promotion.filter.list获取）
     **/
    private $filterCityIds;

    /**
        关键词搜索，多个词逗号分割
     **/
    private $searchKeyword;

    /**
        指定itemId查询推广信息，多个逗号分割
     **/
    private $hitItemIds;

    /**
        第三方会员id扩展
     **/
    private $sid;

    /**
        商品可售卖的端类型。1支付宝端商品，2微信端商品，3全部
     **/
    private $itemType;


    public function getPageNumber() : int{
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber){
        $this->pageNumber = $pageNumber;
    }

    public function getSortType() : string{
        return $this->sortType;
    }

    public function setSortType(string $sortType){
        $this->sortType = $sortType;
    }

    public function getPageSize() : int{
        return $this->pageSize;
    }

    public function setPageSize(int $pageSize){
        $this->pageSize = $pageSize;
    }

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getSessionId() : string{
        return $this->sessionId;
    }

    public function setSessionId(string $sessionId){
        $this->sessionId = $sessionId;
    }

    public function getSettleType() : int{
        return $this->settleType;
    }

    public function setSettleType(int $settleType){
        $this->settleType = $settleType;
    }

    public function getFilterCategoryIds() : string{
        return $this->filterCategoryIds;
    }

    public function setFilterCategoryIds(string $filterCategoryIds){
        $this->filterCategoryIds = $filterCategoryIds;
    }

    public function getFilterCityIds() : string{
        return $this->filterCityIds;
    }

    public function setFilterCityIds(string $filterCityIds){
        $this->filterCityIds = $filterCityIds;
    }

    public function getSearchKeyword() : string{
        return $this->searchKeyword;
    }

    public function setSearchKeyword(string $searchKeyword){
        $this->searchKeyword = $searchKeyword;
    }

    public function getHitItemIds() : string{
        return $this->hitItemIds;
    }

    public function setHitItemIds(string $hitItemIds){
        $this->hitItemIds = $hitItemIds;
    }

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }

    public function getItemType() : int{
        return $this->itemType;
    }

    public function setItemType(int $itemType){
        $this->itemType = $itemType;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.item.promotion";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->pageNumber)) {
            $requestParam["page_number"] = TopUtil::convertBasic($this->pageNumber);
        }

        if (!TopUtil::checkEmpty($this->sortType)) {
            $requestParam["sort_type"] = TopUtil::convertBasic($this->sortType);
        }

        if (!TopUtil::checkEmpty($this->pageSize)) {
            $requestParam["page_size"] = TopUtil::convertBasic($this->pageSize);
        }

        if (!TopUtil::checkEmpty($this->pid)) {
            $requestParam["pid"] = TopUtil::convertBasic($this->pid);
        }

        if (!TopUtil::checkEmpty($this->sessionId)) {
            $requestParam["session_id"] = TopUtil::convertBasic($this->sessionId);
        }

        if (!TopUtil::checkEmpty($this->settleType)) {
            $requestParam["settle_type"] = TopUtil::convertBasic($this->settleType);
        }

        if (!TopUtil::checkEmpty($this->filterCategoryIds)) {
            $requestParam["filter_category_ids"] = TopUtil::convertBasic($this->filterCategoryIds);
        }

        if (!TopUtil::checkEmpty($this->filterCityIds)) {
            $requestParam["filter_city_ids"] = TopUtil::convertBasic($this->filterCityIds);
        }

        if (!TopUtil::checkEmpty($this->searchKeyword)) {
            $requestParam["search_keyword"] = TopUtil::convertBasic($this->searchKeyword);
        }

        if (!TopUtil::checkEmpty($this->hitItemIds)) {
            $requestParam["hit_item_ids"] = TopUtil::convertBasic($this->hitItemIds);
        }

        if (!TopUtil::checkEmpty($this->sid)) {
            $requestParam["sid"] = TopUtil::convertBasic($this->sid);
        }

        if (!TopUtil::checkEmpty($this->itemType)) {
            $requestParam["item_type"] = TopUtil::convertBasic($this->itemType);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

