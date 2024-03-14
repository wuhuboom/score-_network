<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionItempromotionQueryPromotionLink {

    /**
        微信小程序appId
     **/
    public $wx_appid;

    /**
        微信小程序path链接
     **/
    public $wx_path;

    /**
        微信小程序二维码
     **/
    public $wx_mini_qrcode;


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

    public function getWxMiniQrcode() : string{
        return $this->wx_mini_qrcode;
    }

    public function setWxMiniQrcode(string $wxMiniQrcode){
        $this->wx_mini_qrcode = $wxMiniQrcode;
    }


}

