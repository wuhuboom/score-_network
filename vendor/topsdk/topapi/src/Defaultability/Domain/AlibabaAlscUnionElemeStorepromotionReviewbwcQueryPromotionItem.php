<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemeStorepromotionReviewbwcQueryPromotionItem {

    /**
        小程序appId
     **/
    public $wx_appid;

    /**
        微信小程序path链接
     **/
    public $wx_path;


    public function getWxAppid() : string{
        return $this->wx_appid;
    }

    public function setWxAppid(string $wxAppid){
        $this->wx_appid = $wxAppid;
    }

    public function getWxPath() : string{
        return $this->wx_path;
    }

    public function setWxPath(string $wxPath){
        $this->wx_path = $wxPath;
    }


}

