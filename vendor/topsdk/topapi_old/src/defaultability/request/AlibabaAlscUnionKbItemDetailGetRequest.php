<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionKbItemDetailGetKbItemDetailRequest;

class AlibabaAlscUnionKbItemDetailGetRequest {

    /**
        商品详情rquest
     **/
    private $queryRequest;


    public function getQueryRequest() : AlibabaAlscUnionKbItemDetailGetKbItemDetailRequest{
        return $this->queryRequest;
    }

    public function setQueryRequest(AlibabaAlscUnionKbItemDetailGetKbItemDetailRequest $queryRequest){
        $this->queryRequest = $queryRequest;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.item.detail.get";
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

