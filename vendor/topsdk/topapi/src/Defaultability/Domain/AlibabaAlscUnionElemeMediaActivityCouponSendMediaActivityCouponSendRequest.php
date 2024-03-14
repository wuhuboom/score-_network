<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemeMediaActivityCouponSendMediaActivityCouponSendRequest {

    /**
        领券手机号
     **/
    public $mobile;

    /**
        媒体出资活动ID
     **/
    public $media_activity_id;


    public function getMobile() : string{
        return $this->mobile;
    }

    public function setMobile(string $mobile){
        $this->mobile = $mobile;
    }

    public function getMediaActivityId() : string{
        return $this->media_activity_id;
    }

    public function setMediaActivityId(string $mediaActivityId){
        $this->media_activity_id = $mediaActivityId;
    }


}

