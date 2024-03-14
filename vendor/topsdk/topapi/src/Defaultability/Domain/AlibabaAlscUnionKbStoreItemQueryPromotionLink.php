<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionKbStoreItemQueryPromotionLink {

    /**
        支付宝schema
     **/
    public $alipay_scheme_url;

    /**
        支付宝小程序h5 url
     **/
    public $alipay_h5_url;


    public function getAlipaySchemeUrl() : string{
        return $this->alipay_scheme_url;
    }

    public function setAlipaySchemeUrl(string $alipaySchemeUrl){
        $this->alipay_scheme_url = $alipaySchemeUrl;
    }

    public function getAlipayH5Url() : string{
        return $this->alipay_h5_url;
    }

    public function setAlipayH5Url(string $alipayH5Url){
        $this->alipay_h5_url = $alipayH5Url;
    }


}

