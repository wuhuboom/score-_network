<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionElemeStorepromotionReviewbwcDetailGetRequest {

    /**
        渠道PID
     **/
    private $pid;

    /**
        三方扩展id
     **/
    private $sid;

    /**
        门店ID（加密）
     **/
    private $shopId;

    /**
        活动ID
     **/
    private $activityId;


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

    public function getShopId() : string{
        return $this->shopId;
    }

    public function setShopId(string $shopId){
        $this->shopId = $shopId;
    }

    public function getActivityId() : string{
        return $this->activityId;
    }

    public function setActivityId(string $activityId){
        $this->activityId = $activityId;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.eleme.storepromotion.reviewbwc.detail.get";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->pid)) {
            $requestParam["pid"] = TopUtil::convertBasic($this->pid);
        }

        if (!TopUtil::checkEmpty($this->sid)) {
            $requestParam["sid"] = TopUtil::convertBasic($this->sid);
        }

        if (!TopUtil::checkEmpty($this->shopId)) {
            $requestParam["shop_id"] = TopUtil::convertBasic($this->shopId);
        }

        if (!TopUtil::checkEmpty($this->activityId)) {
            $requestParam["activity_id"] = TopUtil::convertBasic($this->activityId);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

