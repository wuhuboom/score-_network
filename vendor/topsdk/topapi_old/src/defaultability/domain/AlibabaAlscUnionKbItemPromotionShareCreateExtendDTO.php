<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbItemPromotionShareCreateExtendDTO {

    /**
        微信推广图片下载链接
     **/
    public $img_url;

    /**
        微信小程序的appid
     **/
    public $wx_appid;

    /**
        微信小程序的路径
     **/
    public $wx_path;

    /**
        微信小程序码
     **/
    public $mini_qr_code;

    /**
        支付宝推广图片地址
     **/
    public $alipay_img_url;

    /**
        支付宝吱口令
     **/
    public $alipay_watchword;

    /**
        支付宝吱口令的引导文案
     **/
    public $alipay_watchword_suggest;

    /**
        支付宝小程序码
     **/
    public $alipay_mini_qr_code;

    /**
        支付宝小程序path
     **/
    public $alipay_scheme_url;

    /**
        支付宝的h5链接
     **/
    public $h5_url;


    public function getImgUrl() : string{
        return $this->img_url;
    }

    public function setImgUrl(string $imgUrl){
        $this->img_url = $imgUrl;
    }

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

    public function getMiniQrCode() : string{
        return $this->mini_qr_code;
    }

    public function setMiniQrCode(string $miniQrCode){
        $this->mini_qr_code = $miniQrCode;
    }

    public function getAlipayImgUrl() : string{
        return $this->alipay_img_url;
    }

    public function setAlipayImgUrl(string $alipayImgUrl){
        $this->alipay_img_url = $alipayImgUrl;
    }

    public function getAlipayWatchword() : string{
        return $this->alipay_watchword;
    }

    public function setAlipayWatchword(string $alipayWatchword){
        $this->alipay_watchword = $alipayWatchword;
    }

    public function getAlipayWatchwordSuggest() : string{
        return $this->alipay_watchword_suggest;
    }

    public function setAlipayWatchwordSuggest(string $alipayWatchwordSuggest){
        $this->alipay_watchword_suggest = $alipayWatchwordSuggest;
    }

    public function getAlipayMiniQrCode() : string{
        return $this->alipay_mini_qr_code;
    }

    public function setAlipayMiniQrCode(string $alipayMiniQrCode){
        $this->alipay_mini_qr_code = $alipayMiniQrCode;
    }

    public function getAlipaySchemeUrl() : string{
        return $this->alipay_scheme_url;
    }

    public function setAlipaySchemeUrl(string $alipaySchemeUrl){
        $this->alipay_scheme_url = $alipaySchemeUrl;
    }

    public function getH5Url() : string{
        return $this->h5_url;
    }

    public function setH5Url(string $h5Url){
        $this->h5_url = $h5Url;
    }


}

