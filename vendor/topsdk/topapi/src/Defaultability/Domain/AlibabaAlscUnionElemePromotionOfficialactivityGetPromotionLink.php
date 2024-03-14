<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionOfficialactivityGetPromotionLink {

    /**
        小程序appId
     **/
    public $wx_appid;

    /**
        微信小程序path链接
     **/
    public $wx_path;

    /**
        推广图片地址
     **/
    public $picture;

    /**
        支付宝小程序推广链接
     **/
    public $alipay_mini_url;

    /**
        h5推广地址
     **/
    public $h5_url;

    /**
        淘宝二维码图片地址
     **/
    public $tb_qr_code;

    /**
        微信独立二维码
     **/
    public $mini_qrcode;

    /**
        淘宝独立二维码
     **/
    public $tb_mini_qrcode;

    /**
        饿了么唤端链接
     **/
    public $ele_scheme_url;

    /**
        h5推广地址短链
     **/
    public $h5_short_link;

    /**
        H5二维码图片地址
     **/
    public $h5_mini_qrcode;

    /**
        饿了么口令（有效期30天，建议到期前重新获取）
     **/
    public $eleme_word;


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

    public function getAlipayMiniUrl() : string{
        return $this->alipay_mini_url;
    }

    public function setAlipayMiniUrl(string $alipayMiniUrl){
        $this->alipay_mini_url = $alipayMiniUrl;
    }

    public function getH5Url() : string{
        return $this->h5_url;
    }

    public function setH5Url(string $h5Url){
        $this->h5_url = $h5Url;
    }

    public function getTbQrCode() : string{
        return $this->tb_qr_code;
    }

    public function setTbQrCode(string $tbQrCode){
        $this->tb_qr_code = $tbQrCode;
    }

    public function getMiniQrcode() : string{
        return $this->mini_qrcode;
    }

    public function setMiniQrcode(string $miniQrcode){
        $this->mini_qrcode = $miniQrcode;
    }

    public function getTbMiniQrcode() : string{
        return $this->tb_mini_qrcode;
    }

    public function setTbMiniQrcode(string $tbMiniQrcode){
        $this->tb_mini_qrcode = $tbMiniQrcode;
    }

    public function getEleSchemeUrl() : string{
        return $this->ele_scheme_url;
    }

    public function setEleSchemeUrl(string $eleSchemeUrl){
        $this->ele_scheme_url = $eleSchemeUrl;
    }

    public function getH5ShortLink() : string{
        return $this->h5_short_link;
    }

    public function setH5ShortLink(string $h5ShortLink){
        $this->h5_short_link = $h5ShortLink;
    }

    public function getH5MiniQrcode() : string{
        return $this->h5_mini_qrcode;
    }

    public function setH5MiniQrcode(string $h5MiniQrcode){
        $this->h5_mini_qrcode = $h5MiniQrcode;
    }

    public function getElemeWord() : string{
        return $this->eleme_word;
    }

    public function setElemeWord(string $elemeWord){
        $this->eleme_word = $elemeWord;
    }


}

