<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionKbOrderPayOrderPayDto;

class AlibabaAlscUnionKbOrderPayRequest {

    /**
        订单支付对象
     **/
    private $orderPayDto;


    public function getOrderPayDto() : AlibabaAlscUnionKbOrderPayOrderPayDto{
        return $this->orderPayDto;
    }

    public function setOrderPayDto(AlibabaAlscUnionKbOrderPayOrderPayDto $orderPayDto){
        $this->orderPayDto = $orderPayDto;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.order.pay";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->orderPayDto)) {
            $requestParam["order_pay_dto"] = TopUtil::convertStruct($this->orderPayDto);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

