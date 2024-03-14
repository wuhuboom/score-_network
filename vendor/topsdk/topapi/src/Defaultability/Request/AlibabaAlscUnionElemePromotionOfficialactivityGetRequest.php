<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionElemePromotionOfficialactivityGetActivityRequest;

class AlibabaAlscUnionElemePromotionOfficialactivityGetRequest {

    /**
        查询rquest
     **/
    private $queryRequest;


    public function getQueryRequest() : AlibabaAlscUnionElemePromotionOfficialactivityGetActivityRequest{
        return $this->queryRequest;
    }

    public function setQueryRequest(AlibabaAlscUnionElemePromotionOfficialactivityGetActivityRequest $queryRequest){
        $this->queryRequest = $queryRequest;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.eleme.promotion.officialactivity.get";
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

