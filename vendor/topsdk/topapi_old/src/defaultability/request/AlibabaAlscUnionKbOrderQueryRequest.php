<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;
use Topsdk\Topapi\Defaultability\Domain\AlibabaAlscUnionKbOrderQueryOrderQueryDto;

class AlibabaAlscUnionKbOrderQueryRequest {

    /**
        查询对象
     **/
    private $orderQueryDto;


    public function getOrderQueryDto() : AlibabaAlscUnionKbOrderQueryOrderQueryDto{
        return $this->orderQueryDto;
    }

    public function setOrderQueryDto(AlibabaAlscUnionKbOrderQueryOrderQueryDto $orderQueryDto){
        $this->orderQueryDto = $orderQueryDto;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.order.query";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->orderQueryDto)) {
            $requestParam["order_query_dto"] = TopUtil::convertStruct($this->orderQueryDto);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

