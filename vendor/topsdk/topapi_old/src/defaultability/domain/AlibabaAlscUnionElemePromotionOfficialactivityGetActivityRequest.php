<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionOfficialactivityGetActivityRequest {

    /**
        渠道PID
     **/
    public $pid;

    /**
        活动ID
     **/
    public $activity_id;

    /**
        三方会员id。长度限制50
     **/
    public $sid;

    /**
        是否返回微信推广图片
     **/
    public $include_wx_img;

    /**
        是否包含二维码，如果为false，不返回二维码和图片，只有链接
     **/
    public $include_qr_code;


    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
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

    public function getIncludeQrCode() : bool{
        return $this->include_qr_code;
    }

    public function setIncludeQrCode(bool $includeQrCode){
        $this->include_qr_code = $includeQrCode;
    }


}

