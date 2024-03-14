<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionKbItemStoreDetailGetKbItemShopDetailRequest;

class AlibabaAlscUnionKbItemStoreDetailGetRequest {

    /**
        门店详情查询rquest
     **/
    private $queryRequest;


    public function getQueryRequest() : AlibabaAlscUnionKbItemStoreDetailGetKbItemShopDetailRequest{
        return $this->queryRequest;
    }

    public function setQueryRequest(AlibabaAlscUnionKbItemStoreDetailGetKbItemShopDetailRequest $queryRequest){
        $this->queryRequest = $queryRequest;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.item.store.detail.get";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->queryRequest)) {
            $requestParam["query_request"] = TopUtil::convertStruct($this->queryRequest);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

