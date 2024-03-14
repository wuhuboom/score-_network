<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionElemeStorepromotionReviewbwcStockLockRequest {

    /**
        渠道PID
     **/
    private $pid;

    /**
        门店ID（加密）
     **/
    private $shopId;

    /**
        活动ID
     **/
    private $activityId;

    /**
        三方扩展id
     **/
    private $sid;

    /**
        领取手机号
     **/
    private $mobile;

    /**
        领取ID（渠道用户领取资格的唯一标识）
     **/
    private $outerOrderId;


    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
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

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }

    public function getMobile() : string{
        return $this->mobile;
    }

    public function setMobile(string $mobile){
        $this->mobile = $mobile;
    }

    public function getOuterOrderId() : string{
        return $this->outerOrderId;
    }

    public function setOuterOrderId(string $outerOrderId){
        $this->outerOrderId = $outerOrderId;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.eleme.storepromotion.reviewbwc.stock.lock";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->pid)) {
            $requestParam["pid"] = TopUtil::convertBasic($this->pid);
        }

        if (!TopUtil::checkEmpty($this->shopId)) {
            $requestParam["shop_id"] = TopUtil::convertBasic($this->shopId);
        }

        if (!TopUtil::checkEmpty($this->activityId)) {
            $requestParam["activity_id"] = TopUtil::convertBasic($this->activityId);
        }

        if (!TopUtil::checkEmpty($this->sid)) {
            $requestParam["sid"] = TopUtil::convertBasic($this->sid);
        }

        if (!TopUtil::checkEmpty($this->mobile)) {
            $requestParam["mobile"] = TopUtil::convertBasic($this->mobile);
        }

        if (!TopUtil::checkEmpty($this->outerOrderId)) {
            $requestParam["outer_order_id"] = TopUtil::convertBasic($this->outerOrderId);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

