<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionKbcpxPunishOrderGetRequest {

    /**
        时间维度，1.订单结算时间 2.维权创建时间 3.维权完成时间 4更新时间
     **/
    private $dateType;

    /**
        查询截止时间。开始和结束时间不能超过31天
     **/
    private $endDate;

    /**
        1-CPA 2-CPS
     **/
    private $bizUnit;

    /**
        每页返回数据大小，默认10，最大返回50
     **/
    private $pageSize;

    /**
        页码，默认第一页，取值范围1~50
     **/
    private $pageNumber;

    /**
        查询起始时间。开始和结束时间不能超过31天
     **/
    private $startDate;

    /**
        场景值，支持多场景（英文逗号分隔）查询7卡券订单，8卡券核销订单，10-媒体出资CPS红包，11-媒体出资霸王餐加码红包
     **/
    private $flowType;

    /**
        推广位pid
     **/
    private $pid;

    /**
        淘宝子订单号
     **/
    private $orderId;


    public function getDateType() : int{
        return $this->dateType;
    }

    public function setDateType(int $dateType){
        $this->dateType = $dateType;
    }

    public function getEndDate() : string{
        return $this->endDate;
    }

    public function setEndDate(string $endDate){
        $this->endDate = $endDate;
    }

    public function getBizUnit() : int{
        return $this->bizUnit;
    }

    public function setBizUnit(int $bizUnit){
        $this->bizUnit = $bizUnit;
    }

    public function getPageSize() : int{
        return $this->pageSize;
    }

    public function setPageSize(int $pageSize){
        $this->pageSize = $pageSize;
    }

    public function getPageNumber() : int{
        return $this->pageNumber;
    }

    public function setPageNumber(int $pageNumber){
        $this->pageNumber = $pageNumber;
    }

    public function getStartDate() : string{
        return $this->startDate;
    }

    public function setStartDate(string $startDate){
        $this->startDate = $startDate;
    }

    public function getFlowType() : string{
        return $this->flowType;
    }

    public function setFlowType(string $flowType){
        $this->flowType = $flowType;
    }

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getOrderId() : string{
        return $this->orderId;
    }

    public function setOrderId(string $orderId){
        $this->orderId = $orderId;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kbcpx.punish.order.get";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->dateType)) {
            $requestParam["date_type"] = TopUtil::convertBasic($this->dateType);
        }

        if (!TopUtil::checkEmpty($this->endDate)) {
            $requestParam["end_date"] = TopUtil::convertBasic($this->endDate);
        }

        if (!TopUtil::checkEmpty($this->bizUnit)) {
            $requestParam["biz_unit"] = TopUtil::convertBasic($this->bizUnit);
        }

        if (!TopUtil::checkEmpty($this->pageSize)) {
            $requestParam["page_size"] = TopUtil::convertBasic($this->pageSize);
        }

        if (!TopUtil::checkEmpty($this->pageNumber)) {
            $requestParam["page_number"] = TopUtil::convertBasic($this->pageNumber);
        }

        if (!TopUtil::checkEmpty($this->startDate)) {
            $requestParam["start_date"] = TopUtil::convertBasic($this->startDate);
        }

        if (!TopUtil::checkEmpty($this->flowType)) {
            $requestParam["flow_type"] = TopUtil::convertBasic($this->flowType);
        }

        if (!TopUtil::checkEmpty($this->pid)) {
            $requestParam["pid"] = TopUtil::convertBasic($this->pid);
        }

        if (!TopUtil::checkEmpty($this->orderId)) {
            $requestParam["order_id"] = TopUtil::convertBasic($this->orderId);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

