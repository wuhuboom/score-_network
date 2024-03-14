<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionKbStoreItemQueryRequest {

    /**
        门店ID
     **/
    private $storeId;

    /**
        场景类型（"kb_natural";）
     **/
    private $bizType;

    /**
        推广位
     **/
    private $pid;

    /**
        sid（申请权限后可用）
     **/
    private $sid;


    public function getStoreId() : string{
        return $this->storeId;
    }

    public function setStoreId(string $storeId){
        $this->storeId = $storeId;
    }

    public function getBizType() : string{
        return $this->bizType;
    }

    public function setBizType(string $bizType){
        $this->bizType = $bizType;
    }

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.store.item.query";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->storeId)) {
            $requestParam["store_id"] = TopUtil::convertBasic($this->storeId);
        }

        if (!TopUtil::checkEmpty($this->bizType)) {
            $requestParam["biz_type"] = TopUtil::convertBasic($this->bizType);
        }

        if (!TopUtil::checkEmpty($this->pid)) {
            $requestParam["pid"] = TopUtil::convertBasic($this->pid);
        }

        if (!TopUtil::checkEmpty($this->sid)) {
            $requestParam["sid"] = TopUtil::convertBasic($this->sid);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

