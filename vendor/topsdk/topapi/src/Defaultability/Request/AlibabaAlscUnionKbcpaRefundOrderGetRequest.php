<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionKbcpaRefundOrderGetRequest {

    /**
        时间维度，1.订单结算时间 2.维权创建时间 3.维权完成时间 4更新时间
     **/
    private $dateType;

    /**
        查询结束时间
     **/
    private $endDate;

    /**
        每页返回数据大小，默认20，最大返回50
     **/
    private $pageSize;

    /**
        页码，默认第一页，取值范围1~50
     **/
    private $pageNumber;

    /**
        查询开始时间
     **/
    private $startDate;

    /**
        推广位pid
     **/
    private $pid;


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

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kbcpa.refund.order.get";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->dateType)) {
            $requestParam["date_type"] = TopUtil::convertBasic($this->dateType);
        }

        if (!TopUtil::checkEmpty($this->endDate)) {
            $requestParam["end_date"] = TopUtil::convertBasic($this->endDate);
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

        if (!TopUtil::checkEmpty($this->pid)) {
            $requestParam["pid"] = TopUtil::convertBasic($this->pid);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

