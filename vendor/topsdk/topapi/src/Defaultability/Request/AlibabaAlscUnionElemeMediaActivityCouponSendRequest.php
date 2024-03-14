<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionElemeMediaActivityCouponSendMediaActivityCouponSendRequest;

class AlibabaAlscUnionElemeMediaActivityCouponSendRequest {

    /**
        请求对象
     **/
    private $sendRequest;


    public function getSendRequest() : AlibabaAlscUnionElemeMediaActivityCouponSendMediaActivityCouponSendRequest{
        return $this->sendRequest;
    }

    public function setSendRequest(AlibabaAlscUnionElemeMediaActivityCouponSendMediaActivityCouponSendRequest $sendRequest){
        $this->sendRequest = $sendRequest;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.eleme.media.activity.coupon.send";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->sendRequest)) {
            $requestParam["send_request"] = TopUtil::convertStruct($this->sendRequest);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

