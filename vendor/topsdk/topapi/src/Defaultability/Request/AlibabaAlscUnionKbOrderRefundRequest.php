<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionKbOrderRefundOrderRefundDto;

class AlibabaAlscUnionKbOrderRefundRequest {

    /**
        退款对象
     **/
    private $orderRefundDto;


    public function getOrderRefundDto() : AlibabaAlscUnionKbOrderRefundOrderRefundDto{
        return $this->orderRefundDto;
    }

    public function setOrderRefundDto(AlibabaAlscUnionKbOrderRefundOrderRefundDto $orderRefundDto){
        $this->orderRefundDto = $orderRefundDto;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.order.refund";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->orderRefundDto)) {
            $requestParam["order_refund_dto"] = TopUtil::convertStruct($this->orderRefundDto);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

