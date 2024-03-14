<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionStorepromotionGetPromotionLink {

    /**
        小程序appId
     **/
    public $wx_appid;

    /**
        微信小程序path链接
     **/
    public $wx_path;

    /**
        推广图片地址，图片上展示店铺小程序二维码
     **/
    public $picture;

    /**
        小程序appId-立减活动
     **/
    public $reduce_wx_appid;

    /**
        微信小程序path链接-立减活动
     **/
    public $reduce_wx_path;

    /**
        推广图片地址-立减活动，图片上展示店铺小程序二维码
     **/
    public $reduce_picture;

    /**
        独立微信二维码
     **/
    public $mini_qrcode;

    /**
        小程序appId-媒体出资活动
     **/
    public $media_activity_wx_appid;

    /**
        微信小程序path链接-媒体出资活动
     **/
    public $media_activity_wx_path;


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

    public function getPicture() : string{
        return $this->picture;
    }

    public function setPicture(string $picture){
        $this->picture = $picture;
    }

    public function getReduceWxAppid() : string{
        return $this->reduce_wx_appid;
    }

    public function setReduceWxAppid(string $reduceWxAppid){
        $this->reduce_wx_appid = $reduceWxAppid;
    }

    public function getReduceWxPath() : string{
        return $this->reduce_wx_path;
    }

    public function setReduceWxPath(string $reduceWxPath){
        $this->reduce_wx_path = $reduceWxPath;
    }

    public function getReducePicture() : string{
        return $this->reduce_picture;
    }

    public function setReducePicture(string $reducePicture){
        $this->reduce_picture = $reducePicture;
    }

    public function getMiniQrcode() : string{
        return $this->mini_qrcode;
    }

    public function setMiniQrcode(string $miniQrcode){
        $this->mini_qrcode = $miniQrcode;
    }

    public function getMediaActivityWxAppid() : string{
        return $this->media_activity_wx_appid;
    }

    public function setMediaActivityWxAppid(string $mediaActivityWxAppid){
        $this->media_activity_wx_appid = $mediaActivityWxAppid;
    }

    public function getMediaActivityWxPath() : string{
        return $this->media_activity_wx_path;
    }

    public function setMediaActivityWxPath(string $mediaActivityWxPath){
        $this->media_activity_wx_path = $mediaActivityWxPath;
    }


}

