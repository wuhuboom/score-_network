<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionMediaZoneGetRequest {

    /**
        页码，从1开始
     **/
    private $page;

    /**
        每页展示条数
     **/
    private $limit;


    public function getPage() : int{
        return $this->page;
    }

    public function setPage(int $page){
        $this->page = $page;
    }

    public function getLimit() : int{
        return $this->limit;
    }

    public function setLimit(int $limit){
        $this->limit = $limit;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.media.zone.get";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->page)) {
            $requestParam["page"] = TopUtil::convertBasic($this->page);
        }

        if (!TopUtil::checkEmpty($this->limit)) {
            $requestParam["limit"] = TopUtil::convertBasic($this->limit);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

