<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemQueryBbtItemQueryRequest {

    /**
        页码
     **/
    public $page_number;

    /**
        排序类型（0-时间倒序，1-佣金比例倒序）
     **/
    public $sort_type;

    /**
        会话ID
     **/
    public $session_id;

    /**
        二级类目ID
     **/
    public $category2_id;

    /**
        每页数目
     **/
    public $page_size;

    /**
        城市ID
     **/
    public $city_id;

    /**
        是否返回需要手机号的商品，false仅返回不需要手机号的品；true全部返回
     **/
    public $include_phone;

    /**
        三方供给标识，","隔开，不为空时include_phone必须为true
     **/
    public $tripartite_appkeys;


    public function getPageNumber() : int{
        return $this->page_number;
    }

    public function setPageNumber(int $pageNumber){
        $this->page_number = $pageNumber;
    }

    public function getSortType() : int{
        return $this->sort_type;
    }

    public function setSortType(int $sortType){
        $this->sort_type = $sortType;
    }

    public function getSessionId() : string{
        return $this->session_id;
    }

    public function setSessionId(string $sessionId){
        $this->session_id = $sessionId;
    }

    public function getCategory2Id() : string{
        return $this->category2_id;
    }

    public function setCategory2Id(string $category2Id){
        $this->category2_id = $category2Id;
    }

    public function getPageSize() : int{
        return $this->page_size;
    }

    public function setPageSize(int $pageSize){
        $this->page_size = $pageSize;
    }

    public function getCityId() : string{
        return $this->city_id;
    }

    public function setCityId(string $cityId){
        $this->city_id = $cityId;
    }

    public function getIncludePhone() : bool{
        return $this->include_phone;
    }

    public function setIncludePhone(bool $includePhone){
        $this->include_phone = $includePhone;
    }

    public function getTripartiteAppkeys() : string{
        return $this->tripartite_appkeys;
    }

    public function setTripartiteAppkeys(string $tripartiteAppkeys){
        $this->tripartite_appkeys = $tripartiteAppkeys;
    }


}

