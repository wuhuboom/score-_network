<?php
namespace Topsdk\Topapi\Defaultability\Domain;

class AlibabaAlscUnionElemePromotionItempromotionGetSingleItemPromotionRequest {

    /**
        商品类型（hoard_coupon-囤券券）
     **/
    public $biz_type;

    /**
        推广位
     **/
    public $pid;

    /**
        商品ID
     **/
    public $item_id;

    /**
        会员ID（需要联系运营申请）
     **/
    public $sid;

    /**
        是否返回微信推广图片
     **/
    public $include_wx_img;


    public function getBizType() : string{
        return $this->biz_type;
    }

    public function setBizType(string $bizType){
        $this->biz_type = $bizType;
    }

    public function getPid() : string{
        return $this->pid;
    }

    public function setPid(string $pid){
        $this->pid = $pid;
    }

    public function getItemId() : string{
        return $this->item_id;
    }

    public function setItemId(string $itemId){
        $this->item_id = $itemId;
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


}

