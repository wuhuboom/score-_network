<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionKbBbtItemQueryBbtItemQueryRequest;

class AlibabaAlscUnionKbBbtItemQueryRequest {

    /**
        爆爆团商品查询rquest
     **/
    private $queryRequest;


    public function getQueryRequest() : AlibabaAlscUnionKbBbtItemQueryBbtItemQueryRequest{
        return $this->queryRequest;
    }

    public function setQueryRequest(AlibabaAlscUnionKbBbtItemQueryBbtItemQueryRequest $queryRequest){
        $this->queryRequest = $queryRequest;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.bbt.item.query";
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

