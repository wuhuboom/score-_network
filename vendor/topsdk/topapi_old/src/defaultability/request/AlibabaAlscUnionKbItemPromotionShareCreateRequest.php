<?php
namespace Topsdk\Topapi\Defaultability\Request;
use Topsdk\Topapi\TopUtil;

class AlibabaAlscUnionKbItemPromotionShareCreateRequest {

    /**
        推广位pid
     **/
    private $pid;

    /**
        商品ID，默认CPA的品，如果推广其他业务单元的品，请填写对应的biz_unit
     **/
    private $itemId;

    /**
        业务单元，1-CPA，2-CPS，3-SPU。默认1-CPA
     **/
    private $bizUnit;

    /**
        废弃
     **/
    private $includeMiniQrCode;

    /**
        废弃
     **/
    private $includeMiniQrCodeHyaline;

    /**
        废弃
     **/
    private $includeImgUrl;

    /**
        第三方会员id扩展
     **/
    private $sid;

    /**
        是否合成微信推广图
     **/
    private $includeWxImgUrl;

    /**
        是否合成支付宝推广图
     **/
    private $includeAlipayImgUrl;

    /**
        是否返回吱口令
     **/
    private $includeAlipayWathword;


    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getItemId() : string{
        return $this->itemId;
    }

    public function setItemId(string $itemId){
        $this->itemId = $itemId;
    }

    public function getBizUnit() : int{
        return $this->bizUnit;
    }

    public function setBizUnit(int $bizUnit){
        $this->bizUnit = $bizUnit;
    }

    public function getIncludeMiniQrCode() : bool{
        return $this->includeMiniQrCode;
    }

    public function setIncludeMiniQrCode(bool $includeMiniQrCode){
        $this->includeMiniQrCode = $includeMiniQrCode;
    }

    public function getIncludeMiniQrCodeHyaline() : bool{
        return $this->includeMiniQrCodeHyaline;
    }

    public function setIncludeMiniQrCodeHyaline(bool $includeMiniQrCodeHyaline){
        $this->includeMiniQrCodeHyaline = $includeMiniQrCodeHyaline;
    }

    public function getIncludeImgUrl() : bool{
        return $this->includeImgUrl;
    }

    public function setIncludeImgUrl(bool $includeImgUrl){
        $this->includeImgUrl = $includeImgUrl;
    }

    public function getSid() : string{
        return $this->sid;
    }

    public function setSid(string $sid){
        $this->sid = $sid;
    }

    public function getIncludeWxImgUrl() : bool{
        return $this->includeWxImgUrl;
    }

    public function setIncludeWxImgUrl(bool $includeWxImgUrl){
        $this->includeWxImgUrl = $includeWxImgUrl;
    }

    public function getIncludeAlipayImgUrl() : bool{
        return $this->includeAlipayImgUrl;
    }

    public function setIncludeAlipayImgUrl(bool $includeAlipayImgUrl){
        $this->includeAlipayImgUrl = $includeAlipayImgUrl;
    }

    public function getIncludeAlipayWathword() : bool{
        return $this->includeAlipayWathword;
    }

    public function setIncludeAlipayWathword(bool $includeAlipayWathword){
        $this->includeAlipayWathword = $includeAlipayWathword;
    }


    public function getApiName() : string {
        return "alibaba.alsc.union.kb.item.promotion.share.create";
    }

    public function toMap() : array{
        $requestParam = array();
        if (!TopUtil::checkEmpty($this->pid)) {
            $requestParam["pid"] = TopUtil::convertBasic($this->pid);
        }

        if (!TopUtil::checkEmpty($this->itemId)) {
            $requestParam["item_id"] = TopUtil::convertBasic($this->itemId);
        }

        if (!TopUtil::checkEmpty($this->bizUnit)) {
            $requestParam["biz_unit"] = TopUtil::convertBasic($this->bizUnit);
        }

        if (!TopUtil::checkEmpty($this->includeMiniQrCode)) {
            $requestParam["include_mini_qr_code"] = TopUtil::convertBasic($this->includeMiniQrCode);
        }

        if (!TopUtil::checkEmpty($this->includeMiniQrCodeHyaline)) {
            $requestParam["include_mini_qr_code_hyaline"] = TopUtil::convertBasic($this->includeMiniQrCodeHyaline);
        }

        if (!TopUtil::checkEmpty($this->includeImgUrl)) {
            $requestParam["include_img_url"] = TopUtil::convertBasic($this->includeImgUrl);
        }

        if (!TopUtil::checkEmpty($this->sid)) {
            $requestParam["sid"] = TopUtil::convertBasic($this->sid);
        }

        if (!TopUtil::checkEmpty($this->includeWxImgUrl)) {
            $requestParam["include_wx_img_url"] = TopUtil::convertBasic($this->includeWxImgUrl);
        }

        if (!TopUtil::checkEmpty($this->includeAlipayImgUrl)) {
            $requestParam["include_alipay_img_url"] = TopUtil::convertBasic($this->includeAlipayImgUrl);
        }

        if (!TopUtil::checkEmpty($this->includeAlipayWathword)) {
            $requestParam["include_alipay_wathword"] = TopUtil::convertBasic($this->includeAlipayWathword);
        }

        return $requestParam;
    }

    public function toFileParamMap() : array{
        $fileParam = array();
        return $fileParam;
    }

}

