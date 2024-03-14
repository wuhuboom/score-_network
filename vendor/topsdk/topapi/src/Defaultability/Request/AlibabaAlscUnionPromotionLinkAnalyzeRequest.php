<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionPromotionLinkAnalyzePromotionLinkAnalyzeRequest;

class AlibabaAlscUnionPromotionLinkAnalyzeRequest {

    /**
        查询request对象
     **/
    private $promotionLinkAnalyzeRequest;


    public function getPromotionLinkAnalyzeRequest() : AlibabaAlscUnionPromotionLinkAnalyzePromotionLinkAnalyzeRequest{
        return $this->promotionLinkAnalyzeRequest;
    }

    public function setPromotionLinkAnalyzeRequest(AlibabaAlscUnionPromotionLinkAnalyzePromotionLinkAnalyzeRequest $promotionLinkAnalyzeRequest){
        $this->promotionLinkAnalyzeRequest = $promotionLinkAnalyzeRequest;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.promotion.link.analyze";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->promotionLinkAnalyzeRequest)) {
            $requestParam["promotion_link_analyze_request"] = TopUtil::convertStruct($this->promotionLinkAnalyzeRequest);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

