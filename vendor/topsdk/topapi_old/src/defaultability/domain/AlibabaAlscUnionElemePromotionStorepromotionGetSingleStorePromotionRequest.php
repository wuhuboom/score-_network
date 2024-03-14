<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionStorepromotionGetSingleStorePromotionRequest {

    /**
        渠道PID
     **/
    public $pid;

    /**
        门店ID（加密，具有时效性，建议每天更新一次）
     **/
    public $shop_id;

    /**
        活动ID
     **/
    public $activity_id;

    /**
        三方扩展id
     **/
    public $sid;

    /**
        是否返回微信推广图片
     **/
    public $include_wx_img;

    /**
        媒体出资活动ID
     **/
    public $media_activity_id;


    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getShopId() : string{
        return $this->shop_id;
    }

    public function setShopId(string $shopId){
        $this->shop_id = $shopId;
    }

    public function getActivityId() : string{
        return $this->activity_id;
    }

    public function setActivityId(string $activityId){
        $this->activity_id = $activityId;
    }

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }

    public function getIncludeWxImg() : bool{
        return $this->include_wx_img;
    }

    public function setIncludeWxImg(bool $includeWxImg){
        $this->include_wx_img = $includeWxImg;
    }

    public function getMediaActivityId() : string{
        return $this->media_activity_id;
    }

    public function setMediaActivityId(string $mediaActivityId){
        $this->media_activity_id = $mediaActivityId;
    }


}

