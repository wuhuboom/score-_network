<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbBbtItemPromotionFilterListFilterTableNameDTO {

    /**
        筛选项key值
     **/
    public $filter_key;

    /**
        筛选项展示名称
     **/
    public $filter_name;


    public function getFilterKey() : string{
        return $this->filter_key;
    }

    public function setFilterKey(string $filterKey){
        $this->filter_key = $filterKey;
    }

    public function getFilterName() : string{
        return $this->filter_name;
    }

    public function setFilterName(string $filterName){
        $this->filter_name = $filterName;
    }


}

