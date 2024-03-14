<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionKbOrderCreateOrderDto;

class AlibabaAlscUnionKbOrderCreateRequest {

    /**
        订单对象
     **/
    private $orderDto;


    public function getOrderDto() : AlibabaAlscUnionKbOrderCreateOrderDto{
        return $this->orderDto;
    }

    public function setOrderDto(AlibabaAlscUnionKbOrderCreateOrderDto $orderDto){
        $this->orderDto = $orderDto;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.order.create";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->orderDto)) {
            $requestParam["order_dto"] = TopUtil::convertStruct($this->orderDto);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

