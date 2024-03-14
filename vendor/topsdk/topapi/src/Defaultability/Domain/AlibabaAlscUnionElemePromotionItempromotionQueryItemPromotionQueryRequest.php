<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionItempromotionQueryItemPromotionQueryRequest {

    /**
        会话ID（查询第一页为空，从第二页开始赋值，取值来自第一页返回结果）
     **/
    public $session_id;

    /**
        商品类型（hoard_coupon-囤券券）
     **/
    public $biz_type;

    /**
        推广位
     **/
    public $pid;

    /**
        城市编码（国标）
     **/
    public $city_code;

    /**
        排序（normal-佣金倒序，commission_desc-佣金倒序，commission_rate_desc-佣金比例倒序，month_sales_desc-月销量从高到低，sell_price_asc-价格正序，sell_price_desc-价格倒序）
     **/
    public $sort_type;

    /**
        请求页（从1开始）
     **/
    public $page_number;

    /**
        每页数（1~20）
     **/
    public $page_size;

    /**
        会员ID（需要联系运营申请）
     **/
    public $sid;

    /**
        品牌搜索
     **/
    public $search_content;


    public function getSessionId() : string{
        return $this->session_id;
    }

    public function setSessionId(string $sessionId){
        $this->session_id = $sessionId;
    }

    public function getBizType() : string{
        return $this->biz_type;
    }

    public function setBizType(string $bizType){
        $this->biz_type = $bizType;
    }

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getCityCode() : string{
        return $this->city_code;
    }

    public function setCityCode(string $cityCode){
        $this->city_code = $cityCode;
    }

    public function getSortType() : string{
        return $this->sort_type;
    }

    public function setSortType(string $sortType){
        $this->sort_type = $sortType;
    }

    public function getPageNumber() : int{
        return $this->page_number;
    }

    public function setPageNumber(int $pageNumber){
        $this->page_number = $pageNumber;
    }

    public function getPageSize() : int{
        return $this->page_size;
    }

    public function setPageSize(int $pageSize){
        $this->page_size = $pageSize;
    }

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }

    public function getSearchContent() : string{
        return $this->search_content;
    }

    public function setSearchContent(string $searchContent){
        $this->search_content = $searchContent;
    }


}

